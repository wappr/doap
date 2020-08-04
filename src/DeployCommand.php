<?php

namespace Wappr\Doap;

/**
 * Class DeployCommand
 * @package Wappr\Doap
 */
class DeployCommand implements DeployCommandInterface
{
    /**
     * @var string
     */
    protected $ssh = 'ssh';

    /**
     * @var string
     */
    protected $user;

    /**
     * @var array
     */
    protected $commands;

    /**
     * DeployCommand constructor.
     * @param string $user
     * @param array $commands
     */
    public function __construct(string $user, array $commands = [])
    {
        $this->user = $user;
        $this->commands = $commands;
    }

    /**
     * @param string $user
     */
    public function setUser(string $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function commands()
    {
        return $this->commands;
    }

    /**
     * @param string $ssh
     * @return $this
     */
    public function setSsh(string $ssh)
    {
        $this->ssh = $ssh;

        return $this;
    }

    /**
     * @return string
     */
    public function ssh()
    {
        return $this->ssh;
    }
}