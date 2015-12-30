<?php
/**
 * Created by PhpStorm.
 * User: 宏
 * Date: 2015/12/30
 * Time: 15:51
 */
session_start();
if(isset($_POST['room'])){
    $room=$_POST['room'];
    $name=$_POST['username'];
}
$conn=new mysqli("localhost","root","","chatonline");
$conn->query("set names utf8");
if(mysqli_connect_error()){
    die("数据库连接失败");
}
$_SESSION['username']=$name;
$sql="insert into $room values (null,'$name')";
$sql1="select id from $room";
$res=$conn->query($sql);
$res1=$conn->query($sql1);
if($row=$res1->fetch_assoc()){
    $id=$row['id'];
}
$_SESSION['userid']=$id;
if($res){
    echo "<script type='text/javascript'>alert('oh ye!尽情的使用在线聊天室吧')</script>";
    echo "<script type='text/javascript'>window.open('chat.php?room={$room}','_blank','toolbar=yes, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes, width=1000, height=600')</script>";
}else{
    echo "<script type='text/javascript'>alert('oh no!服务器出现异常！')</script>";
    header("location:selectroom.php");
}