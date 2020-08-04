<?php

namespace Wappr\Doap;

class Deployer
{
    public static function run(string $token, string $user, string $key, array $commands, $tag = '')
    {
        $droplets = new Droplets($token, $tag);
        $command = new DeployCommand($user, $key, $commands);
        $deploy = new Deploy($droplets, $command);
        $deploy->now();

        return $deploy;
    }
}