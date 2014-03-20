<?php
/**
 * User: dongww
 * Date: 14-3-20
 * Time: 上午10:11
 */

namespace Controllers;

use SilexBase\Core\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use SilexBase\Core\Controller;

class AdminController extends Controller
{
    public function indexAction(Application $app)
    {
        return $app['twig']->render('Admin/index.twig');
    }
}
 