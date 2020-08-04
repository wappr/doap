<?php

namespace Wappr\Doap;

interface DeployCommandInterface
{
    /**
     * @param string $user
     * @return $this
     */
    public function setUser(string $user);

    public function user();

    public function key();

    /**
     * @return array
     */
    public function commands();

    /**
     * @param string $ssh
     * @return $this
     */
    public function setSsh(string $ssh);

    /**
     * @return string
     */
    public function ssh();

    /**
     * @param string $port
     * @return $this
     */
    public function setPort(string $port);

    public function port();
}
