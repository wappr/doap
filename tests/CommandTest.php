<?php

use PHPUnit\Framework\TestCase;

final class CommandTest extends TestCase
{
    public function testGetSSHClient()
    {
        $command = (new Wappr\Doap\DeployCommand('root', ['deploy.sh']))->setSsh('sshclient');
        $this->assertEquals('sshclient', $command->ssh());
        $this->assertIsString($command->ssh());
    }

    public function testGetCommands()
    {
        $command = (new Wappr\Doap\DeployCommand('root', ['deploy.sh']));
        $this->assertIsArray($command->commands());
    }

    public function testStuff()
    {
        $cmd = new \Wappr\Doap\DeployCommand('root', ['deploy.sh', 'echo "hi"']);
        $droplets = new \Wappr\Doap\Droplets('key');
        $droplets->getAll('webservers');
        $deployer = new \Wappr\Doap\Deploy();
        $deployer->deploy($droplets, $cmd);
    }
}
