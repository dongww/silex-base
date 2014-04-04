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
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * DebugBar Provider
 *
 * Class DebugBarProvider
 * @package SilexBase\Provider
 */
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

        if (!isset($app['debug_bar'])) {
            $app['debug_bar'] = $app->share(function () {
                return new StandardDebugBar();
            });
        }
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $basePath = $event->getRequest()->getBasePath();
        $render = $this->app['debug_bar']->getJavascriptRenderer($basePath . '/js/debug-bar');

        ob_start();
        echo $render->renderHead();
        echo $render->render();
        $debugContent = ob_get_contents();
        ob_end_clean();

        $content = $event->getResponse()->getContent();
        $content = str_replace("</body>", $debugContent . '</body>', $content);
        $event->getResponse()->setContent($content);
    }

    public function boot(Application $app)
    {
        $app['dispatcher']->addListener(KernelEvents::REQUEST, array($this, 'onKernelRequest'), 1000);
        $app['dispatcher']->addListener(KernelEvents::RESPONSE, array($this, 'onKernelResponse'), -1000);
    }
}
 