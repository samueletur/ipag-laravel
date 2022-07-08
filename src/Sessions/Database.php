<?php

namespace Samueletur\IpagLaravel\Sessions;

use Samueletur\IpagLaravel\Abstracts\Session;
use Samueletur\IpagLaravel\Contracts\Session as ContractsSession;
use Samueletur\IpagLaravel\Http\Config;

class Database extends Session implements ContractsSession
{
    /**
     * @var array
     */
    private $clientsTable;

    /**
     * @var array
     */
    private $sessionsTable;

    /**
     * @param \Samueletur\IpagLaravel\Http\Config $config
     */
    public function __construct(Config $config)
    {
        parent::__construct($config);

        $this->loadTables();
    }

    public function getClientCredentials($clientIpagId = null): array
    {
        if (is_null($clientIpagId)) throw new \Exception('The clientIpagId can not be null.', 1);

        $client = $this->getClient($clientIpagId);

        return [$client[$this->clientsTable['ipag_id']], $client[$this->clientsTable['ipag_hash']]];
    }

    public function getSession($clientIpagId)
    {
        /** @var \Illuminate\Database\Eloquent\Model */
        $Session = $this->sessionsTable['ref'];

        return $Session::whereHas('ipagClient', function ($query) use ($clientIpagId) {
            return $query->where('ipag_id', $clientIpagId);
        })->first();
    }

    public function expired($clientIpagId): bool
    {
        $session = $this->getSession($clientIpagId);

        if (!$session) return true;

        return is_null($session['expires_in']) || $session['expires_in'] <= time();
    }

    public function updateOrCreate($clientIpagId, $values = []): void
    {
        $Session = $this->sessionsTable['ref'];

        $client = $this->getClient($clientIpagId);

        /** @var \Samueletur\IpagLaravel\Models\IpagSession */
        $Session::updateOrCreate([
            $this->sessionsTable['client_id'] => $client->id
        ], [
            $this->sessionsTable['client_id'] => $client->id,
            $this->sessionsTable['scope'] => $values['scope'],
            $this->sessionsTable['expires_in'] => $values['expires_in'],
            $this->sessionsTable['token_type'] => $values['token_type'],
            $this->sessionsTable['access_token'] => $values['access_token']
        ]);
    }

    public function remove($clientIpagId): bool
    {
        $Session = $this->sessionsTable['ref'];

        $session = $Session::whereHas('ipagClient', function ($query) use ($clientIpagId) {
            return $query->where('ipag_id', $clientIpagId);
        })->first();

        return $session && $session->delete();
    }

    /** 
     * @return \Samueletur\IpagLaravel\Models\IpagClient 
     */
    private function getClient($clientIpagId)
    {
        /** @var \Illuminate\Database\Eloquent\Model */
        $Client = $this->clientsTable['ref'];

        return $Client::where('ipag_id', $clientIpagId)->firstOrFail();
    }

    private function loadTables()
    {
        $clientsTable = $this->config->get('ipag_clients');
        $sessionsTable = $this->config->get('ipag_sessions');

        if (!class_exists($clientsTable['ref']))
            throw new \Exception("Ipag client model reference not found", 1);

        if (!class_exists($sessionsTable['ref']))
            throw new \Exception("Ipag session model reference not found", 1);

        $this->clientsTable = $clientsTable;
        $this->sessionsTable = $sessionsTable;
    }
}
