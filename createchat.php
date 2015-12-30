<?php
/**
 * Created by PhpStorm.
 * User: 宏
 * Date: 2015/12/29
 * Time: 17:33
 */
$conn=new mysqli("localhost","root","","chat");
$conn2=new mysqli("localhost","root","","chatonline");
if(mysqli_connect_error()){
    die("数据库连接失败");
}
if(isset($_POST['chatroom'])){
    $chatroom=$_POST['chatroom'];
}

//①创建共享文件夹
$path="./$chatroom/";
if(!file_exists($path)){
    mkdir($path);
}

$chat_person=$chatroom."person";
$conn->query("set names utf8");
$conn2->query("set names utf8");
//创建存储聊天记录的表
$sql="CREATE TABLE `chat`.`$chatroom` ( `id` INT NOT NULL AUTO_INCREMENT , `send` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `send_content` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `receive` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `biaoqing` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `color` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , `time` DATETIME NOT NULL , PRIMARY KEY (`id`) ) ENGINE = InnoDB";
$sql1="CREATE TABLE `chatonline`.`$chatroom` ( `id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(10) NOT NULL , PRIMARY KEY (`id`) ) ENGINE = InnoDB";
$res=$conn->query($sql);
$res1=$conn2->query($sql1);
if($res&&$res1){
    echo "<script type='text/javascript'>alert('创建成功,只差最后一步了哦');</script>";
    header("location:./inputname.php?room={$chatroom}");
    //header("location:chat.php?room={$chatroom}");
}else{
    echo "服务器睡着了";
    header("location:selectroom.php");
}
