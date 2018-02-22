<?php
/**
 * Created by PhpStorm.
 * User: sdqhw
 */
header ( "Content-type: text/html; charset=utf-8" );
error_reporting(0);
date_default_timezone_set('PRC');

/**
 * 记录时间（微秒）或 内存使用情况
 * @param string            $start 开始标签
 * @param string            $end 结束标签
 * @param integer|string    $dec 小数位 如果是m 表示统计内存占用 p表示内存峰值情况
 * @return mixed
 */
function used($start, $end = '', $dec = 6){
    static $_info = array();
    static $_mem = array();

    if(empty($end)){ // 记录时间、内存占用、内存峰值情况

        $_info[$start] = microtime(true);
        $_mem [$dec][$start] = memory_get_usage ();
        $_mem [$dec][$start] = memory_get_peak_usage();

    } elseif (is_float($end) && is_int($dec)){ // 如果传入的是时间，直接记录时间

        $_info [$start] = $end;

    } else { // 进行计算

        if(is_int($dec)){ // 时间小数位
            if(! isset($_info[$end] ))$_info[$end] = microtime(true);
            return number_format ( ($_info [$end] - $_info [$start]), $dec );
        } else {
            if (in_array($dec,['m','p'])){
                if($dec == 'm' && ! isset( $_mem[$dec][$end] )) $_mem [$dec][$end] = memory_get_usage ();
                if($dec == 'p' && ! isset( $_mem[$dec][$end] )) $_mem [$dec][$end] = memory_get_peak_usage ();

                $size = $_mem[$dec][$end] - $_mem[$dec][$start];
                $a    = ['B', 'KB', 'MB', 'GB', 'TB'];
                $pos  = 0;
                while ($size >= 1024) {
                    $size /= 1024;
                    $pos++;
                }
                return number_format ( $size ). " " . $a[$pos];
            }else{
                return '未知请求';
            }
        }

    }

    return '未知错误';
}

// 测试用例
used('api_start');
sleep(1);
$curlHandle = curl_init ();
curl_setopt ( $curlHandle, CURLOPT_URL, "http://api.hitokoto.cn/" );
curl_setopt ( $curlHandle, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt ( $curlHandle, CURLOPT_TIMEOUT, 10 );
$result = curl_exec ( $curlHandle );
curl_close ( $curlHandle );
used('api_end');
var_dump( used('api_start', 'api_end') );


//used('api_start', 'api_end');
//used('api_start', 'api_end', 'm');
//used('api_start', 'api_end', 'p');