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
    protected $port = '22';

    /**
     * @var string
     */
    protected $user;

    protected $key;

    /**
     * @var array
     */
    protected $commands;

    /**
     * DeployCommand constructor.
     * @param string $user
     * @param array $commands
     */
    public function __construct(string $user, string $key, array $commands = [])
    {
        $this->user = $user;
        $this->key = $key;
        $this->commands = $commands;
    }

    /**
     * @param string $user
     * @return $this
     */
    public function setUser(string $user)
    {
        $this->user = $user;

        return $this;
    }

    public function key()
    {
        return $this->key;
    }

    public function user()
    {
        return $this->user;
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

    /**
     * @param string $port
     * @return $this
     */
    public function setPort(string $port)
    {
        $this->port = $port;

        return $this;
    }

    public function port()
    {
        return $this->port;
    }
}