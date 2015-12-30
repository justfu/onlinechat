<?php
/**
 * Created by PhpStorm.
 * User: 宏
 * Date: 2015/12/29
 * Time: 21:15
 */
if(!empty($_POST['username'])){
    $send=$_POST['username'];
}else{
    $send="无名使者";
}

$room=$_POST['chatroom'];
$msg_color=$_POST['msg_color'];
$receiver=$_POST['receiver'];
$content=$_POST['content'];
$biaoqing=$_POST['biaoqing'];
$conn=new mysqli("localhost","root","","chat");
if(mysqli_connect_error()){
    die("数据库连接失败");
}
$conn->query("set names utf8");//date("Y-m-d H:i:s");
$time=date("Y-m-d H:i:s");
$sql="insert into {$room} VALUE (null,'$send','$content','$receiver','$biaoqing','$msg_color','$time')";
$res=$conn->query($sql);
if($res){
    echo "回复成功";
}else{
    echo "回复失败";
}

