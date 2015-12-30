<?php
/**
 * Created by PhpStorm.
 * User: 宏
 * Date: 2015/12/30
 * Time: 13:03
 */
$room=$_GET['room'];
$filename=$_GET['filename'];
$filename=urlencode($filename);
$file_sub_dir="/onlinechat/$room/";
filedown($filename,$file_sub_dir);
function filedown($file_name,$file_sub_dir){

    $file_name=iconv("utf-8","gb2312",$file_name);

    $file_path=$_SERVER['DOCUMENT_ROOT'].$file_sub_dir.$file_name;//绝对路径，建议使用绝对路径，查找速度会加块，相对于给出相对路径
    if(!file_exists($file_path)){//判断文件是否存在
        echo "不存在你要下载的文件，请返回";
        return;
    }
    $fp=fopen($file_path,'r');//打开文件
    $file_size=filesize($file_path);
//获取文件大小
    header("Content-type:application/octet-stream");
//返回的文件
    header("Accept-Ranges:bytes");
//按照字节大小返回
    header("Accept-Length:$file_size");
//返回文件大小
    header("Content-Disposition:attachment;filename=".$file_name);
//这里客户端的弹出对话框，对应的文件名

    $file_count=0;//为了下载的安全，做一个文件字节读取计数器
    $buffer=1024;//定义每次读取的文件大小
    while(!feof($fp) && ($file_size-$file_count>0)){
        //判断文件是否读取完成
        $file_data=fread($fp,$buffer);
        $file_count+=$buffer;
        //统计总共读取了多少个字节
        echo $file_data;
    }
    fclose($fp);//*******关键一步*******一定得关闭文件
}