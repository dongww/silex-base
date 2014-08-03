<?php
/**
 * User: dongww
 * Date: 14-3-20
 * Time: 上午10:11
 */

namespace DemoCompany\DemoProject\Controller;

use Dongww\SilexBase\Core\Controller;
use App\Application;

class AdminController extends Controller
{
    public function indexAction(Application $app)
    {
        return $app->render('DemoCompany/DemoProject:Admin/index.twig');
    }
}
