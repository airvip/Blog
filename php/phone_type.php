<?php
/**
 * Created by PhpStorm.
 * User: sdqhw
 */

if (!function_exists('phone_type')) {
    function phone_type()
    {
        //全部变成小写字母
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        //分别进行判断  1安卓 2蘋果
        $type = 1;
        if (strpos($agent, 'iphone') || strpos($agent, 'ipad')) {
            $type = 2;
        }
        return $type;
    }
}