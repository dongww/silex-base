<?php
/**
 * User: dongww
 * Date: 14-5-29
 * Time: 下午1:00
 */

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DbUpdateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('dbal:update')
            ->setDescription('更新数据库。');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $this->getApplication()->find('db:update');

        $arguments = array(
            'command'     => 'db:update',
            '--structure' => 'app/config/db/structure.yml',
        );

        $input = new ArrayInput($arguments);
        $command->run($input, $output);
    }
}
 