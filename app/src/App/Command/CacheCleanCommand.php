<?php
/**
 * User: dongww
 * Date: 14-6-28
 * Time: 下午1:38
 */

namespace App\Command;

use Dongww\SilexBase\Core\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Dongww\SilexBase\Developer\Cleaner;

class CacheCleanCommand extends Command
{
    protected $app;

    public function __construct(Application $app)
    {
        parent::__construct();
        $this->app = $app;
    }

    protected function configure()
    {
        $this
            ->setName('sb:cache:clean')
            ->setDescription('更新缓存。');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Routes caches clean!');

        $tc = new Cleaner\TwigCacheCleaner(
            $this->app['cache_path'] . '/twig'
        );

        $tc->clean();
        $output->writeln('Twig caches clean!');
    }
}
