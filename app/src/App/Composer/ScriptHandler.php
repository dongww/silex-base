<?php
/**
 * User: dongww
 * Date: 14-7-29
 * Time: 上午11:04
 */

namespace App\Composer;

use Symfony\Component\Process\PhpExecutableFinder;
use Composer\Script\CommandEvent;
use Symfony\Component\Process\Process;

class ScriptHandler
{
    public static function clearCache(CommandEvent $event)
    {
        $timeout = $event->getComposer()->getConfig()->get('process-timeout');
        static::executeCommand($event, 'sb:cache:clean', $timeout);
    }

    public static function assetDump(CommandEvent $event)
    {
        $timeout = $event->getComposer()->getConfig()->get('process-timeout');
        static::executeCommand($event, 'sb:asset:dump', $timeout);
    }

    protected static function executeCommand(CommandEvent $event, $cmd, $timeout = 300)
    {
        $extra  = $event->getComposer()->getPackage()->getExtra();
        $binDir = $extra['sb-bin-dir'];
        if (!is_dir($binDir)) {
            echo 'The sb-bin-dir (' . $binDir . ') specified in composer.json was not found in ' . getcwd() . ', can not clear the cache.' . PHP_EOL;

            return;
        }

        $php = escapeshellarg(self::getPhp());

        $console = escapeshellarg($binDir . '/sb');
        if ($event->getIO()->isDecorated()) {
            $console .= ' --ansi';
        }

        $process = new Process($php . ' ' . $console . ' ' . $cmd, null, null, null, $timeout);
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });

        if (!$process->isSuccessful()) {
            throw new \RuntimeException(sprintf('An error occurred when executing the "%s" command.', escapeshellarg($cmd)));
        }
    }

    protected static function getPhp()
    {
        $phpFinder = new PhpExecutableFinder;
        if (!$phpPath = $phpFinder->find()) {
            throw new \RuntimeException('The php executable could not be found, add it to your PATH environment variable and try again');
        }

        return $phpPath;
    }
}
