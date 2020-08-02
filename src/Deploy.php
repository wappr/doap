<?php

namespace Wappr\Doap;

use Symfony\Component\Process\Process;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Deploy extends Command
{
    protected static $defaultName = 'app:deploy';

    protected $tag;

    protected function configure()
    {
        $this->addArgument('tag', InputArgument::REQUIRED);
        $this->addArgument('user', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new \DigitalOceanV2\Client();
        $client->authenticate(getenv('DO_TOKEN'));

        $droplets = [];
        try {
            $droplets = $client->droplet()->getAll($input->getArgument('tag'));
        } catch(\Throwable $e) {
            $output->writeln($e->getMessage());

            return Command::FAILURE;
        }

        foreach($droplets as $droplet) {
            $ip = $droplet->networks[1]->ipAddress;

            $process = new Process(['ssh', $input->getArgument('user').'@'.$ip, './deploy.sh']);
            $process->run();
            echo $process->getOutput();
        }

        return Command::SUCCESS;
    }
}
