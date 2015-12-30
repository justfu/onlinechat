<?php
if(isset($_GET['room'])) {
    $room = $_GET['room'];
}else{
    die("请求非法");
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>最后一步 嘻嘻</title>
</head>
<body>
<center>
    <h1>\(^o^)/YES!最后一步了 输入你的用户名  不输入好友没办法识别你了 \(^o^)/YES!</h1>
    <form style="margin-top: 200px;" action="./dealonline.php" method="post">
        <input list="names" type="text" style="width: 200px;height: 50px;" name="username" />
        <input type="hidden" value="<?php echo $room;?>" name="room" />
        <datalist id="names">
            <option value="小明">
            <option value="小红">
            <option value="小样">
            <option value="剑豪">
            <option value="大帅哥">
            <option value="大美女">
            <option value="小鲜肉">
            <option value="老油条">
        </datalist>
        <button style="width: 50px;height: 50px;" >提交</button>
    </form>
</center>
</body>
</html>