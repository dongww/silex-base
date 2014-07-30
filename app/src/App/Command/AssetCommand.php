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
use Symfony\Component\Filesystem\Filesystem;

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
        $targetRoot = $this->app['web_path'] . '/resources';
        $am         = Parser::parseFromYaml($configFile);
        $fs         = new Filesystem();

        $fs->remove($targetRoot);

        foreach ($am->getNames() as $name) {
            $assets = $am->get($name);

            foreach ($assets as $asset) {
                $root = $asset->getSourceRoot();
                $path = $asset->getSourcePath();

                $outputFile = $targetRoot . '/' . $root . '/' . $path;
                $fs->dumpFile($outputFile, $asset->dump());
            }
        }

        $output->writeln('asset dumped.');
    }
}
