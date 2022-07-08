<?php

namespace Samueletur\IpagLaravel;

use Samueletur\IpagLaravel\Http\Config;
use Samueletur\IpagLaravel\Http\Request;

/**
 * Ipag Service
 */
class Ipag
{
    /**
     * Ipag Api instance
     * 
     * @var \Samueletur\IpagLaravel\Http\Api
     */
    private $api;

    /**
     * Config instance
     * 
     * @var \Samueletur\IpagLaravel\Http\Config
     */
    private $config;

    /**
     * @var \Samueletur\IpagLaravel\Http\Request
     */
    private $request;

    /**
     * Initialize Ipag Service
     * 
     * @return void
     */
    public function __construct()
    {
        $this->config = new Config(config('ipag'));

        $this->request = new Request($this->config->options());

        $this->api = new \Samueletur\IpagLaravel\Http\Api($this->config, $this->request);
    }

    /**
     * Call a Ipag endpoint
     * 
     * @param string $name
     * @param array $arguments
     * @return array
     */
    public function __call($name, $arguments)
    {
        if (empty($arguments))
            $arguments = [(new QueryParams)->all()];

        return $this->api->send($name, $arguments);
    }

    /**
     * Generate Id
     * 
     * @return string
     */
    public function generateId()
    {
        return uniqid('pay-') . '.' . time();
    }

    /**
     * Create URL Query Params
     * 
     * @param string[] $params
     * @return \Samueletur\IpagLaravel\QueryParams
     */
    public function queryParams(array $params = [])
    {
        return new \Samueletur\IpagLaravel\QueryParams($params);
    }

    /**
     * Create data reference saved in Ipag in your DB
     * 
     * @param array $data
     * @return \Samueletur\IpagLaravel\Models\IpagRegistration
     */
    public function register($data)
    {
        return \Samueletur\IpagLaravel\Models\IpagRegistration::create($data);
    }

    /**
     * Create an instance of the http options class
     * 
     * @param array $options
     * @return \Samueletur\IpagLaravel\Http\Options
     */
    public function httpOptions(array $options = [])
    {
        return new \Samueletur\IpagLaravel\Http\Options($options);
    }
}
