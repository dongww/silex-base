<?php
/**
 * User: dongww
 * Date: 14-1-28
 * Time: 下午3:32
 */

namespace Controllers;

use SilexBase\Core\Application;
use Symfony\Component\HttpFoundation\Response;
use SilexBase\Core\Controller;

class DefaultController extends Controller
{
    public function indexAction(Application $app, $name)
    {
        return new Response($app['twig']->render('Default/index.twig', array(
            'name' => $name
        ))/*, 200, array(
            'Cache-Control' => 's-maxage=5',
        )*/);
    }
}