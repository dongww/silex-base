<?php
/**
 * User: dongww
 * Date: 14-3-13
 * Time: 下午2:28
 */

namespace SilexBase\Core;


abstract class Controller
{
    public function redirect($url, $info = '操作成功！')
    {
        $out = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
            <script>alert("' . $info . '");window.location.href = "' . $url . '";</script>';
        return $out;
    }
}
