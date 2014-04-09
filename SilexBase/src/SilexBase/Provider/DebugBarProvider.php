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
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use DebugBar\StandardDebugBar;

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

    /**
     * 注册debugBar
     *
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $app = $this->app;

        if (!isset($app['debug_bar'])) {
            $app['debug_bar'] = $app->share(function () {
                return new StandardDebugBar();
            });

            if ($app['config.main']['providers']['doctrine']) {
                $debugStack = new \Doctrine\DBAL\Logging\DebugStack();
                $app['db']->getConfiguration()->setSQLLogger($debugStack);
                $app['debug_bar']->addCollector(new \DebugBar\Bridge\DoctrineCollector($debugStack));
            }
        }
    }

    /**
     * 输出debugBar，只有当页面有</body>标签时有效。
     *
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $basePath = $event->getRequest()->getBasePath();
        $render = $this->app['debug_bar']->getJavascriptRenderer();

        ob_start();
        echo '<style>', $render->dumpCssAssets(), '</style>',
        '<script type="text/javascript">', $render->dumpJsAssets(), '</script>';
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
 