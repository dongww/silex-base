<?php
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use DebugBar\StandardDebugBar;

$this->on(KernelEvents::REQUEST, function (GetResponseEvent $event) use ($app) {
    $basePath = $event->getRequest()->getBasePath();

    if ($app['debug'] && !isset($app['debugbar_renderer'])) {
        $app['debug_bar'] = new StandardDebugBar();
        $app['debugbar_renderer'] = $app['debug_bar']->getJavascriptRenderer($basePath . '/js/debug-bar');
    }
});