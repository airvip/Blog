<?php
/**
 * Created by PhpStorm.
 * User: sdqhw
 */

$zip = new \ZipArchive(); // 实例化ZipArchive的对象
$zip_name = time().'.zip'; // 设置zip名
// 开始操作.zip压缩包
if($zip->open($zip_name, \ZipArchive::CREATE)===TRUE){
    //向.zip压缩包里添加文件
    $zip->addFile("airvip.jpg");
    $zip->addFile("airvip.docx");
    //文件添加完，关闭ZipArchive的对象
    $zip->close();
    // 下载压缩包
    header("Cache-Control: max-age=0"); // max-age<=0 时 向server 发送http 请求确认 ,该资源是否有修改有的话 返回200 ,无的话 返回304.
    header("Content-Description: File Transfer"); // 描述信息
    header("Content-Transfer-Encoding: binary"); // 声明一个下载的文件
    header("Content-Type: application/zip"); // 设置文件内容类型为zip
    header('Content-disposition: attachment; filename=' . basename($zip_name)); // 声明文件名
    header('Content-Length: ' . filesize($zip_name)); // 声明文件大小
    // 读入一个文件并写入到输出缓冲。@readfile() 形式调用该函数，来隐藏错误信息。
    @readfile($zip_name);
    // unlink($zip_name); //删除压缩包临时文件
    exit;
}
