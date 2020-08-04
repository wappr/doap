<?php

namespace Wappr\Doap;

interface DeployCommandInterface
{
    /**
     * @param string $user
     */
    public function setUser(string $user);

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
}
