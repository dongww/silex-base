<?php
/**
 * User: dongww
 * Date: 14-1-28
 * Time: 下午3:32
 */

namespace Controllers;


class DefaultController
{
    public function indexAction($name)
    {
        return sprintf('Hello %s!', $name);
    }
} 