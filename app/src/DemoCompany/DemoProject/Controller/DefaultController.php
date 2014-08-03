<?php
/**
 * User: dongww
 * Date: 14-1-28
 * Time: 下午3:32
 */

namespace DemoCompany\DemoProject\Controller;

use Dongww\SilexBase\Core\Controller;
use App\Application;

class DefaultController extends Controller
{
    public function indexAction(Application $app)
    {
        return $app->redirect($app->path('demo'));
    }
}
