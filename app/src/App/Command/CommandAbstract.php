<?php
/**
 * User: dongww
 * Date: 14-7-29
 * Time: 下午3:34
 */

namespace App\Command;

use Dongww\SilexBase\Core\Application;
use Symfony\Component\Console\Command\Command;

abstract class CommandAbstract extends Command
{
    protected $app;

    public function __construct(Application $app)
    {
        parent::__construct();
        $this->app = $app;
    }
}
