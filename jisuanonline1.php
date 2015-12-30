<?php
/**
 * Created by PhpStorm.
 * User: 宏
 * Date: 2015/12/30
 * Time: 9:20
 */
if(isset($_GET['room'])){
    $room=$_GET['room'];
    $mid=$_GET['mid'];
}else{
    die("请求非法");
}
$conn=new mysqli("localhost","root","","chatonline");
if(mysqli_connect_error()){
    die("数据库连接失败");
}
$conn->query("set names utf8");
$sql="select * from {$room}";
$res=$conn->query($sql);
$info=array();
while($row=$res->fetch_assoc()){
    $info[]=$row;
}
$trueinfo=json_encode($info);
print_r($trueinfo);