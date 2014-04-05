<?php
/**
 * User: dongww
 * Date: 14-1-28
 * Time: 下午3:32
 */

namespace Controller;

use SilexBase\Core\Controller;
use SilexBase\Core\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

class DefaultController extends Controller
{
    public function indexAction(Application $app)
    {
        return $app->redirect($app['url_generator']->generate('demo'));
    }
}