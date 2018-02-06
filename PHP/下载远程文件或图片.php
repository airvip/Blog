<?php
/**
 * Created by PhpStorm.
 * User: sdqhw
 */


// 测试用例
// https://www.baidu.com/img/bd_logo1.png
// http://cn.ynhdkc.com/Uploads/doctor_qcode/20171124125822932.png
// http://dytapi.ynhdkc.com/Uploads/acc_file/201801/dyt_yb_20180131.txt

//var_dump(httpdown("https://www.baidu.com/img/bd_logo1.png"));
var_dump(httpdown("https://www.baidu.com/img/bd_logo1.png","E:/qr_code.png"));

/**
 * @param $url 请求的资源地址
 * @param string $file 可以为空|直接写全路径及文件名
 * @param int $timeout 超时时间
 * @return bool|mixed|string
 */

function httpdown($url, $file="", $timeout=60)
{
    if(empty($url)) return false;
    $url = str_replace(" ", "%20", $url);
    $file = empty($file) ? pathinfo($url, PATHINFO_BASENAME) : $file;
    $dir = pathinfo($file,PATHINFO_DIRNAME);//获取存储目录
    !is_dir($dir) && @mkdir($dir,0777,true);//不是目录就创建

    if(function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);               // 设置请求的url
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);       // 设置超时时间
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);    // true 返回的内容作为变量储存，而不是直接输出  false 直接输出
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   // 跳过证书检查
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
        $temp = curl_exec($ch);
        //file_put_contents 函数把一个字符串写入文件中。
        if (@file_put_contents($file, $temp) && !curl_error($ch)) {
            return $file;
        } else {
            return false;
        }
    }else {
        $opts = array(
            "http"=>array(
                "method"=>"GET",
                "header"=>"",
                "timeout"=>$timeout)
        );
        // stream_context_create 创建并返回一个文本数据流并应用各种选项
        $context = stream_context_create($opts);
        if(@copy($url, $file, $context)) {
            return $file;
        } else {
            return false;
        }
    }
}