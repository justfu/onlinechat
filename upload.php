<?php
/**
 * Created by PhpStorm.
 * User: 宏
 * Date: 2015/12/30
 * Time: 11:28
 */
$room=$_POST['room'];
if($_FILES['files']['error']>0){
    exit("上传文件失败");
}
//①获得上传文件的文件名,还有需要保存到的地方
$path="./$room/";
if(!file_exists($path)){
    mkdir($path);
}
$name=$_FILES['files']['name'];
$name=urlencode($name);
$path=$path.rand(1,1000).$name;
//②从临时文件夹移动文件到想要保存到的文件夹
$res=move_uploaded_file($_FILES['files']['tmp_name'], $path);
if($res){
    echo "上传成功";
}else{
    echo "上传失败";
}
?>