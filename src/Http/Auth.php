<?php

namespace Samueletur\IpagLaravel\Http;

use Samueletur\IpagLaravel\Http\Config;

final class Auth
{
    /**
     * Ipag authentication as a partner?
     * 
     * @var bool
     */
    private $authAsPartner;

    /**
     * Config current instance
     * 
     * @var \Samueletur\IpagLaravel\Http\Config
     */
    private $config;

    /**
     * Request
     * 
     * @var \Samueletur\IpagLaravel\Http\Request
     */
    private $request;

    /**
     * Session manager
     * 
     * @var \Samueletur\IpagLaravel\Contracts\Session
     */
    private $sessionManager;

    /**
     * @param \Samueletur\IpagLaravel\Http\Config $config
     */
    public function __construct(Config $config, Request $request)
    {
        $this->config = $config;

        $this->request = $request;

        $this->authAsPartner = $this->config->get('auth_as_partner', false);

        if ($this->config->get('session_driver') == 'database') {
            $this->sessionManager = new \Samueletur\IpagLaravel\Sessions\Database($this->config);
        } else {
            $this->sessionManager = new \Samueletur\IpagLaravel\Sessions\File($this->config);
        }
    }

    /**
     * Get authorization token
     * 
     * @return string
     */
    public function getAuthorizationToken($clientIpagId)
    {
        $session = $this->sessionManager->getSession($clientIpagId);
        return sprintf("%s %s", data_get($session, 'token_type'), data_get($session, 'access_token'));
    }

    /**
     * Check if the session has expired
     * 
     * @return bool
     */
    public function sessionExpired($clientIpagId): bool
    {
        return $this->sessionManager->expired($clientIpagId);
    }

    /**
     * Authenticate to the Ipag
     * 
     * @return void
     * @throws \Samueletur\IpagLaravel\Exceptions\AuthorizationException
     * @throws \Samueletur\IpagLaravel\Exceptions\IpagRequestException
     */
    public function authenticate($clientIpagId): void
    {
        $endpoint = $this->config->endpoint('authenticate');

        $options = [
            'auth' => $this->sessionManager->getClientCredentials($clientIpagId),
            'json' => ['grant_type' => 'authorization_code', 'scope' => $this->config->get('scopes')]
        ];

        if ($this->authAsPartner) $options['headers'] = [
            'AuthorizationPartner' => ' ' . base64_encode(join(':', $this->sessionManager->getPartnerCredentials()))
        ];

        dd($options);

        $response = $this->request->send($endpoint['method'], $endpoint['route'], $options);

        $this->sessionManager->updateOrCreate($clientIpagId, [
            'scope' => $response['scope'],
            'token_type' => $response['token_type'],
            'access_token' => $response['access_token'],
            'expires_in' => $response['expires_in'] + time()
        ]);
    }
}
