<?php
/**
 * Created by PhpStorm.
 * User: 宏
 * Date: 2015/12/30
 * Time: 17:39
 */
session_start();
if(isset($_GET['room'])){
    $chatroom=$_GET['room'];
    $id=$_GET['userid'];
}
$conn2=new mysqli("localhost","root","","chatonline");
$conn2->query("set names utf8");//设置数据库操作编码
if(mysqli_connect_error()){
    die("数据库连接失败");
}
$sql="delete from $chatroom where id=$id";
$res=$conn2->query($sql);
$conn2->close();
