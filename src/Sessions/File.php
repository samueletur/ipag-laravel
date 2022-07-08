<?php

namespace Samueletur\IpagLaravel\Sessions;

use Illuminate\Support\Arr;
use Samueletur\IpagLaravel\Abstracts\Session;
use Samueletur\IpagLaravel\Contracts\Session as ContractsSession;
use Samueletur\IpagLaravel\Http\Config;

class File extends Session implements ContractsSession
{
    const IPAG_SESSIONS = 'ipag_sessions.json';

    /**
     * @param \Samueletur\IpagLaravel\Http\Config $config
     */
    public function __construct(Config $config)
    {
        parent::__construct($config);

        $this->loadSessions();
    }

    /**
     * @param int|string|null $clientIpagId ipag_id from the ipag_clients table
     */
    public function getClientCredentials($clientIpagId = null): array
    {
        return [$this->config->get('credentials.client.id'), $this->config->get('credentials.client.hash')];
    }

    public function getSession($clientIpagId)
    {
        if ($this->sessions->count() == 0) return null;

        if (is_null($this->session) || $this->session['client_ipag_id'] != $clientIpagId) {
            $this->session = $this->sessions->first(function ($item) use ($clientIpagId) {
                return $item['client_ipag_id'] == $clientIpagId;
            });
        }

        return $this->session;
    }

    public function expired($clientIpagId): bool
    {
        $session = $this->getSession($clientIpagId);

        if (!$session) return true;

        return is_null($session['expires_in']) || $session['expires_in'] <= time();
    }

    public function updateOrCreate($clientIpagId, $values = []): void
    {
        $data = Arr::add($values, 'client_ipag_id', $clientIpagId);

        $sessionKey = $this->sessions->search(function ($item) use ($clientIpagId) {
            return $item['client_ipag_id'] == $clientIpagId && !empty($item['access_token']);
        });

        if (!is_bool($sessionKey))
            $this->sessions->pull($sessionKey);
        else $this->sessions->push($data);

        file_put_contents($this->getDirectory(), $this->sessions->toJson());
    }

    public function remove($clientIpagId): bool
    {
        $sessionKey = $this->sessions->search(function ($item) use ($clientIpagId) {
            return $item['client_ipag_id'] == $clientIpagId;
        });

        $this->sessions->pull($sessionKey);

        file_put_contents($this->getDirectory(), $this->sessions->toJson());

        return $this->sessions->where('client_ipag_id', '=', $clientIpagId)->count() == 0;
    }

    private function getDirectory(): string
    {
        return sprintf('%s/%s', sys_get_temp_dir(), static::IPAG_SESSIONS);
    }

    private function loadSessions()
    {
        $dir = $this->getDirectory();

        if (!file_exists($dir)) touch($dir);

        if (empty(file_get_contents($dir))) {
            $this->sessions = collect([]);
        } else {
            $content = json_decode(file_get_contents($this->getDirectory()), true);

            $this->sessions = collect($content)->sortBy('client_ipag_id')->reject(function ($session) {
                return empty($session['access_token']) || (isset($session['expires_in']) && $session['expires_in'] <= time());
            });

            file_put_contents($dir, $this->sessions->toJson());
        }
    }
}
