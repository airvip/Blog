<?php
/**
 * Created by PhpStorm.
 * User: sdqhw
 */

/**
 * 默认写入 2 M 的文件
 * @param $all_path 存放文件全路径
 * @param $str 要写入的字符串
 * @param $line 默认10行才写入文件
 * @param $file_size 默认 2m 才重写文件
 */
function wfile($all_path, $msg, $line = 10, $file_size = 2097152){

    static $log_box = [];

    $log_box[] = $msg;
    if( count($log_box) > $line ){
        $f_path = str_replace('\\','/',$all_path);
        $f_dir = dirname($f_path); //获取目录

        //如果文件所在目录不存在生成
        if(!file_exists($f_dir)){
            mkdir($f_dir,0777,true);
            chmod($f_dir,0777);
        }

        //检测日志文件大小，超过配置大小则备份日志文件重新生成
        if (is_file($f_path) && floor($file_size) <= filesize($f_path)) {
            rename($f_path, $f_dir . '/' . time() . '-' . basename($f_path));
        }

        $depr = "----------------------------------------------\r\n";
        $info = '';
        foreach ( $log_box as $key => $val ){
            if (!is_string($msg)) {
                $msg = var_export($msg, true);
            }
            $info .=  $msg . "\r\n";
        }
        $log_box = [];
        $now = date('Y-m-d H:i:s');
        return error_log("\r\n日志写入时间:[{$now}]\r\n{$info}\r\n{$depr}", 3, $f_path);

    }else{
        return true;
    }
}


// 测试实例
for( $i = 0; $i < 1000; $i++){
    $str = <<<EOF
['order_no' => what,'user_id'=> user_id,//预约者id]
EOF;
    if($i % 3 == 0)$str = '{"ResultCode":"-330002","ResultContent":"\u7cfb\u7edf\u4e2d\u672a\u627e\u5230positAmount":"0"}';
    if($i % 3 == 1)$str = "阿尔维奇是一个大帅哥，阿尔维奇是一个大帅哥，阿尔维奇是一个大帅哥，阿尔维奇是一个大帅哥，阿尔维奇是一个大帅哥";
    var_dump('<pre>'.wfile('air.log',$str,10,8096).'</pre>');
}