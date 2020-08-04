<?php

namespace Wappr\Doap;

use GuzzleHttp\Client;

class Droplets implements DropletsInterface
{
    protected $servers;

    protected $client;

    protected $tag;

    protected $key;

    public function __construct(string $key, string $tag)
    {
        $this->client = new Client(['base_uri' => 'https://api.digitalocean.com/v2/']);

        $this->key = $key;
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

        foreach($this->servers->droplets as $server) {
            foreach($server->networks->v4 as $ip) {
                if($ip->type == 'public') {
                    $ips[$server->id] = $ip->ip_address;
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
        $response = $this->client->get(
            'droplets',
            [
                'auth' => [$this->key, ':'],
                'query' => [
                    'tag_name' => $this->tag
                ]
            ]
        );
        $this->servers = json_decode((string) $response->getBody());
    }
}
