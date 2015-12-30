<?php
/**
 * Created by PhpStorm.
 * User: 宏
 * Date: 2015/12/29
 * Time: 20:01
 */
if(isset($_GET['room'])){
    $room=$_GET['room'];
    $max_id=$_GET['max_id'];
}else{
    die("请求非法");
}
$conn=new mysqli("localhost","root","","chat");
if(mysqli_connect_error()){
    die("数据库连接失败");
}
$conn->query("set names utf8");
$sql="select * from {$room} where id>$max_id";

$res=$conn->query($sql);
$info=array();
while($row=$res->fetch_assoc()){
    $info[]=$row;
}
echo json_encode($info);
