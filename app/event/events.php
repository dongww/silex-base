<?php
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

$this->on(KernelEvents::REQUEST, function (GetResponseEvent $event) use ($app) {
    if ($app['twig']) {
        $basePath = $event->getRequest()->getBasePath();
        $app['twig'] = $app->share($app->extend('twig', function ($twig, $app) use ($basePath) {
            $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) use ($basePath) {
                // implement whatever logic you need to determine the asset path

                return sprintf('%s/%s', $basePath, ltrim($asset, '/'));
            }));

            return $twig;
        }));
    }
});