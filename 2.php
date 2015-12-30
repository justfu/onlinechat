<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>第二步</title>
</head>
<script type="text/javascript">
      function check(){

       var fm=document.getElementsByTagName('form')[0];
          var fd=new FormData(fm);

            var xhr=new XMLHttpRequest();


            xhr.onreadystatechange=function(){
                if(xhr.readyState==4){
                    document.getElementById('notice').innerHTML=xhr.responseText;
                }
            }

           xhr.open("post","./queryroom.php");

           xhr.send(fd);

           return false;


   }
</script>
<body>
<center>
    <span style="font: sans-serif;font-size: 85px;">输入你创建聊天室的房间名</span><br/><br/><br/><br/><br/><br/><br/><br/>
    <form action="./createchat.php" method="post">
        <input style="height: 50px;" type="text" name="chatroom" />
        <input style="height: 50px;width: 60px;"type="submit" value="创建" />
        <div id="notice"></div>
    </form>
    <button onclick="check()" style="height: 50px;width: 200px;">检查你的房间名是否合法</button>
</center>
</body>
</html>