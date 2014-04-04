<?php
/**
 * User: dongww
 * Date: 14-4-4
 * Time: 下午1:53
 */

namespace SilexBase\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use DebugBar\StandardDebugBar;

class DebugBarProvider implements ServiceProviderInterface
{
    protected $app;

    public function register(Application $app)
    {
        $this->app = $app;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $app = $this->app;
        $basePath = $event->getRequest()->getBasePath();

        if ($app['debug'] && !isset($app['debugbar_renderer'])) {
            $app['debug_bar'] = new StandardDebugBar();
            $app['debugbar_renderer'] = $app['debug_bar']->getJavascriptRenderer($basePath . '/js/debug-bar');
        }
    }

    public function boot(Application $app)
    {
        $app['dispatcher']->addListener(KernelEvents::REQUEST, array($this, 'onKernelRequest'), 192);
    }
}
 