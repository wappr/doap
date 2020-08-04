<?php

namespace Wappr\Doap;

use DigitalOceanV2\Client;
use DigitalOceanV2\Exception\ExceptionInterface;

class Droplets implements DropletsInterface
{
    protected $servers;

    protected $client;

    protected $tag;

    public function __construct(string $key, string $tag)
    {
        $this->client = new Client;
        $this->client->authenticate($key);

        $this->tag = $tag;
    }

    /**
     * @return array
     * @throws ExceptionInterface
     */
    public function ipAddresses()
    {
        $this->getAll();

        $ips = [];

        foreach($this->servers as $server) {
            foreach($server->networks as $network) {
                if($network->type == 'public' && $network->version == 4) {
                    $ips[] = $network->ipAddress;
                }
            }
        }

        return $ips;
    }

    /**
     * @throws ExceptionInterface
     */
    protected function getAll()
    {
        $this->servers = $this->client->droplet()->getAll($this->tag);
    }
}
