<?php
/**
 * User: dongww
 * Date: 14-4-4
 * Time: 下午1:22
 */

namespace SilexBase\Provider;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class TwigCoreExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            'asset' => new \Twig_Function_Method($this, 'asset', array('needs_environment' => true)),
        );
    }

    public function asset(\Twig_Environment $twig, $asset)
    {
        $globals = $twig->getGlobals();
        $request = $globals['app']['request'];

        return sprintf('%s/%s', $request->getBasePath(), ltrim($asset, '/'));
    }

    public function getName()
    {
        return 'silexBase';
    }
}
