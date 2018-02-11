<?php
/**
 * Created by PhpStorm.
 * User: Admin
 */

/**
 * 立刻写入文件，会重复打开关闭文件
 * @param $all_path
 * @param $str
 */
function wfile_now($all_path,$str){
    $tmp_path = str_replace('\\','/',$all_path);
    $file_path = dirname($tmp_path); //获取目录

    //如果文件所在目录不存在生成
    if(!file_exists($file_path)){
        mkdir($file_path,0777,true);
        chmod($file_path,0777);
    }

    //开始做文件写入
    $fp = fopen($tmp_path,"a");
    flock($fp, LOCK_EX) ;
    $len = fwrite($fp,"记录时间：".date("Y-m-d H:i:s")."\r\n".$str."\r\n");
    flock($fp, LOCK_UN);
    fclose($fp);
    return $len;
}


// 测试实例
$res = wfile_now(date('Y-m/d').'record.log','执行之后立即写入到指定文件中');