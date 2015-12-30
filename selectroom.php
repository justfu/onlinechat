<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>选择一个聊天室进入</title>
</head>
<body>

<script type="text/javascript">
    function aa(evt){
        window.open(evt,"_blank","toolbar=yes, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes, width=1000, height=600");
    }
</script>
<?php
/**
 * Created by PhpStorm.
 * User: 宏
 * Date: 2015/12/29
 * Time: 18:35
 */
$conn=new mysqli("localhost","root","","chat");
if(mysqli_connect_error()){
    die("数据库连接失败");
}
$conn->query("set names utf8");
$sql="show tables";
$res=$conn->query($sql);
echo "<center>";
echo "<h1>请在下面选择一个房间进入</h1>";
echo "</center>";
while($row=$res->fetch_assoc()){

    $href="./inputname.php?room=".$row['Tables_in_chat'];
    echo "<a onclick=aa('{$href}') href='javascript:;'>";
    echo "<div class='rm'>";
    echo $row['Tables_in_chat'];
    echo "</div>";
    echo "</a>";

}

?>
</div>

</body>
<style type="text/css">
    a{
        text-decoration: none;
        color: #7C4697;
        font-family: "Microsoft Yahei UI", "Microsoft Yahei", Verdana, Simsun, "Segoe UI", "Segoe UI Web Regular", "Segoe UI Symbol", "Helvetica Neue", "BBAlpha Sans", "S60 Sans", Arial, sans-serif;
        font-size: 30px;
    }
    .rm{
        width: 200px;height: 200px;background-color: #D2C4E0;
        text-align: center;
        float: left;
        margin-left: 20px;
        line-height: 160px;
    }
    .rm:hover{
        border: 2px #7C4697 solid;
    }
</style>
</html>
