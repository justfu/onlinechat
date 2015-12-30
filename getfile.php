<?php
/**
 * Created by PhpStorm.
 * User: 宏
 * Date: 2015/12/30
 * Time: 12:13
 */
if(!isset($_GET['room'])){
    die("请求非法");
}

$room=$_GET['room'];
$path="./$room/";
$url="./filedown.php?room={$room}&filename=";
$all_file=scandir($path);
for($i=2;$i<count($all_file);$i++){
    $value=urldecode($all_file[$i]);
    echo "&nbsp;&nbsp;&nbsp;"."<a href='$url$value'>".$value."</a><br/>";

}