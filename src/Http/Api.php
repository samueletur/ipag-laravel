<?php

namespace Samueletur\IpagLaravel\Http;

use Samueletur\IpagLaravel\Http\Auth;
use Samueletur\IpagLaravel\Http\Config;
use Samueletur\IpagLaravel\Exceptions\AuthorizationException;

use Samueletur\IpagLaravel\Traits\Api\ResolveArguments;
use Samueletur\IpagLaravel\Traits\Api\ValidateArguments;

/**
 * Ipag API client
 */
final class Api
{
    use ResolveArguments, ValidateArguments;

    /**
     * Auth current instance
     * 
     * @var \Samueletur\IpagLaravel\Http\Auth
     */
    private $auth;

    /**
     * Config current instance
     * 
     * @var \Samueletur\IpagLaravel\Http\Config
     */
    private $config;

    /**
     * Request instance
     * 
     * @var \Samueletur\IpagLaravel\Http\Request
     */
    private $request;

    /**
     * Request options
     * 
     * @var string[]
     */
    private $options;

    /**
     * Initialize Ipag Api
     * 
     * @param \Samueletur\IpagLaravel\Http\Config|null $config
     * @return void
     */
    public function __construct(Config $config, Request $request)
    {
        $this->config = $config;

        $this->request = $request;

        $this->options = $this->config->options();

        $this->auth = new Auth($this->config, $this->request);
    }

    /**
     * Set config
     * 
     * @param \Samueletur\IpagLaravel\Http\Config $config
     * @return $this
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Set request options
     * 
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options = [])
    {
        $this->options = $this->config->options(array_merge($this->options, $options));

        return $this;
    }

    /**
     * Send request
     * 
     * @param string $name
     * @param array $arguments
     * @return array|void
     * @throws \Throwable
     */
    public function send(string $name, array $arguments)
    {

        $endpoint = $this->config->endpoint($name);

        $this->validateArguments($name, $endpoint, $arguments);

        $route = $this->resolve($endpoint, $arguments, $clientIpagId);
        if (empty($clientIpagId)) $clientIpagId = $this->config->get('credentials.client.id');

        try {
            // if ($this->auth->sessionExpired($clientIpagId))
            //     $this->auth->authenticate($clientIpagId);

            // $this->setAuthorizationHeader($clientIpagId);

            return $this->request->send($endpoint['method'], $route, $this->options);
        } catch (AuthorizationException $e) {
            dd($e->getMessage());
            $this->auth->authenticate($clientIpagId);

            $this->setAuthorizationHeader($clientIpagId);

            return $this->request->send($endpoint['method'], $route, $this->options);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * Set authorization token in request header
     * 
     * @return void
     */
    private function setAuthorizationHeader($clientIpagId): void
    {
        $this->options['headers'] = array_merge($this->options['headers'], [
            'Accept'        => 'application/json',
            'Authorization' => $this->auth->getAuthorizationToken($clientIpagId)
        ]);
    }
}
