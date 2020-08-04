<?php

namespace Wappr\Doap;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Deploy
{
    protected $droplets;

    protected $command;

    protected $output = [];

    public function __construct(DropletsInterface $droplets, DeployCommandInterface $command)
    {
        $this->droplets = $droplets;
        $this->command = $command;
    }

    public function now()
    {
        foreach($this->droplets->ipAddresses() as $ip) {
            $this->process($ip);
        }
    }

    public function output()
    {
        return $this->output;
    }

    protected function process($ip)
    {
        foreach($this->command->commands() as $command) {
            $cmd = implode(' ', [
                $this->command->ssh(),
                '-i ' . $this->command->key(),
                '-o StrictHostKeyChecking=no',
                '-o UserKnownHostsFile=/dev/null',
                $this->command->user().'@'.$ip,
                '-p ' . $this->command->port(),
                '"' . $command . '"'
            ]);
            $process = Process::fromShellCommandline($cmd);

            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $this->output[] = $process->getOutput();
        }
    }
}
