<?php
/**
 * User: dongww
 * Date: 14-3-13
 * Time: 下午2:28
 */

namespace SilexBase\Core;

/**
 * 若控制器需要更多功能，可以从该类继承。
 * 该类提供了一些额外的常用方法
 *
 * Class Controller
 * @package SilexBase\Core
 */
abstract class Controller
{
    /**
     * 提示操作的结果，并进行转向
     *
     * @param string $url 转向网址
     * @param string $info 操作结果的提示信息
     * @return string
     */
    public function redirect($url, $info = '操作成功！')
    {
        $out = sprintf('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
            <script>alert("%s");window.location.href = "%s";</script>', $info, $url);
        return $out;
    }
}
