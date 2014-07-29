<?php
/**
 * User: dongww
 * Date: 14-7-29
 * Time: 下午3:30
 */

namespace App\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Asset\Parser;

class AssetCommand extends CommandAbstract
{
    protected function configure()
    {
        $this
            ->setName('sb:asset:dump')
            ->setDescription('输出 Asset 到网站目录');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $configFile = $this->app['config_path'] . '/asset.yml';
        $am         = Parser::parseFromYaml($configFile);

        foreach($am->getNames() as $name){

        }
    }
}
