<?php

namespace Samueletur\IpagLaravel\Abstracts;

use Samueletur\IpagLaravel\Http\Config;

abstract class Session
{
    public const IN_FILE = 'file';

    public const IN_DATABASE = 'database';

    /**
     * @var \Samueletur\IpagLaravel\Http\Config
     */
    protected $config;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $sessions;

    /**
     * @var array
     */
    protected $session;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getPartnerCredentials(): array
    {
        return [$this->config->get('credentials.partner.id'), $this->config->get('credentials.partner.hash')];
    }
}
