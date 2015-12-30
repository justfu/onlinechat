<?php
/**
 * Created by PhpStorm.
 * User: 宏
 * Date: 2015/12/29
 * Time: 19:07
 */
if(empty($_POST['chatroom'])){
    die("请求非法");
}
$chatroom=$_POST['chatroom'];

$conn=new mysqli("localhost","root","","chat");
if(mysqli_connect_error()){
    die("数据库连接失败");
}
$conn->query("set names utf8");
$sql="desc $chatroom";
$res=$conn->query($sql);
if($res){
    echo "<span style='color: red'>不好意思,此聊天室名字已经创建过了哦</span>";
}else{
    echo "<span style='color: deepskyblue'>ok,此名字合法,点击创建按钮以便进入聊天室</span>";
}