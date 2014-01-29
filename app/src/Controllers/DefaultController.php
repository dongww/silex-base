<?php
/**
 * User: dongww
 * Date: 14-1-28
 * Time: 下午3:32
 */

namespace Controllers;

use SilexBase\Core\Application;

class DefaultController
{
    public function indexAction(Application $app, $name)
    {
        return $app['twig']->render('Default/index.twig', array(
            'name' => $name
        ));
    }
} 