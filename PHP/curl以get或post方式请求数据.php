<?php
/**
 * Created by PhpStorm.
 * User: sdqhw
 */


/**
 * @param string    $url 请求的地址
 * @param int       $timeout 超时的时间
 * @return mixed
 */
if(!function_exists('curl_get')){
    function curl_get($url, $timeout = 60){
        $ch = curl_init();                               // 启动一个CURL会话
        curl_setopt($ch, CURLOPT_URL, $url);             // 要访问的地址
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);     // 设置超时限制防止死循环
        curl_setopt($ch, CURLOPT_HEADER, 0);             // 显示返回的Header区域内容
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);     // true 返回的内容作为变量储存，而不是直接输出  false 直接输出
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
        $tmpInfo = curl_exec($ch);                       // 执行操作
        curl_close($ch);                                 // 关闭URL请求
        return $tmpInfo;                                 // 返回数据
    }
}

/**
 * @param string    $url 请求的地址
 * @param array     $data 请求的数据
 * @param int       $timeout 超时的时间
 * @return mixed
 */
if(!function_exists('curl_post')){
    function curl_post($url, $data, $timeout=60){
        $data = json_encode($data);//可以尝试注释掉调用接口

        $ch = curl_init();                               // 启动一个CURL会话
        curl_setopt($ch, CURLOPT_URL, $url);             // 要访问的地址
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);     // 使用自动跳转
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);        // 自动设置Referer
        curl_setopt($ch, CURLOPT_POST, 1);               // 发送一个常规的Post请求
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);     // Post提交的数据包
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);     // 设置超时限制防止死循环
        curl_setopt($ch, CURLOPT_HEADER, 0);             // 显示返回的Header区域内容
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);     // true 返回的内容作为变量储存，而不是直接输出  false 直接输出

        $header = array();
        $header[] = 'Accept:application/json';
        $header[] = 'Content-Type:application/json;charset=utf-8';
        $header[] = 'Content-Length:'. strlen($data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);  // 设置 http header
        $tmpInfo = curl_exec($ch);                      // 执行操作
        curl_close($ch);                                // 关闭cURL资源，并且释放系统资源
        return $tmpInfo;                                // 返回数据
    }
}


//测试用例
var_dump(curl_get("https://sslapi.hitokoto.cn/?c=f&encode=text"));
