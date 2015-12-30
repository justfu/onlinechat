<?php
if(isset($_GET['room'])){
 $chatroom=$_GET['room'];
}else{
    die("请求非法");
}
session_start();
if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];
    $id=$_SESSION['userid'];
}else{
    $username="";
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>**<?php echo $chatroom;?>**房间</title>
    <script type="text/javascript">

        var max_id=0;
        function getmsg(){
            var xhr=new XMLHttpRequest();

            xhr.onreadystatechange=function(){
                if(xhr.readyState==4){
                    eval("var info="+xhr.responseText);
                    var s="";

                    for(var i=0;i<info.length;i++){
                        s+="<p style='color:"+info[i].color+";'>";
                        s+=info[i].send+"&nbsp;对&nbsp;"+info[i].receive+"&nbsp;";
                        s+=info[i].biaoqing+"&nbsp;说:"+info[i].send_content+"("+info[i].time;
                        s+=")</p>";

                        max_id=info[i].id;
                    }

                    var msg=document.getElementById('content');
                    msg.innerHTML+=s;

                    msg.scrollTop=msg.scrollHeight;
                }
            }
            xhr.open("get","getroommsg.php?room="+"<?php echo $chatroom?>"+"&max_id="+max_id);

            xhr.send(null);
        }
//        window.onload=function(){
//            getmsg();
//            setInterval("getmsg()",2000);
//        }
    </script>

    <style type="text/css">
        *{
            margin: 0px;
        }
        .left{
            width: 20%;
            height: 100%;
            background-color: aquamarine;
            float: left;
        }
        .right{
            width: 80%;
            height: 100%;
            background-color: burlywood;
            float: left;
        }
        .top{
            width: 80%;
            height: 70%;
            background-color: burlywood;
        }
        .foot{
            width: 100%;
            height: 30%;
            background-color: white;
        }
        .content{
            width: 90%;
            height: 320px;
            border: 1px wheat solid;
            margin-left: 20%;
            overflow: auto;
        }
    </style>
    <script type="text/javascript">
        var mid=0;
        function tongji(){
            var xhr=new XMLHttpRequest();
            xhr.open("get","./deleteuser.php?room="+"<?php echo $chatroom;?>"+"&userid="+"<?php echo $id;?>");
            //xhr.open("get","./test2.php")
            xhr.send(null);
        }

        function jisuan1(){

            var xhr=new XMLHttpRequest();

            var o="";

            xhr.onreadystatechange=function(){
                if(xhr.readyState==4){
                    eval("var online="+xhr.responseText);
                    for(var j=0;j<online.length;j++){
                        o+="<p>"+online[j].username+"</p>";
                    }

                    document.getElementById('onlineperson').innerHTML=o;

                }
            }
            xhr.open("get","./jisuanonline1.php?room="+"<?php echo $chatroom?>"+"&mid="+mid);
            xhr.send(null);
        }
        function jisuan(){
            var node=document.getElementById('user');

            var xhr=new XMLHttpRequest();

            xhr.onreadystatechange=function(){
                if(xhr.readyState==4){
                    eval("var online="+xhr.responseText);
                    for(var j=0;j<online.length;j++){
                        var op=document.createElement('option');
                        op.innerText=online[j].username;
                        node.appendChild(op);
                        mid=online[j].id;
                    }

                }
            }
            xhr.open("get","./jisuanonline.php?room="+"<?php echo $chatroom?>"+"&mid="+mid);
            xhr.send(null);
        }
        window.onload=function(){
            getmsg();
            setInterval("getmsg()",2000);
            jisuan();
            setInterval("jisuan()",1000*20);
            jisuan1();
            setInterval("jisuan1()",1000*20);
        }
        window.onbeforeunload=function(){
            tongji();
        }
    </script>
</head>
<body onbeforeunload="tongji()">
<div id="bo">
<div class="left">
<h1>当前在线人数</h1>
    <div style="margin-left: 22%;margin-top: 30%;font-size: 22px;" id="onlineperson">

    </div>
    <div style="position: absolute;top: 50%;left: 2%;">
        <button onclick="jisuan1()" style="width: 135px;height: 45px;">刷新在线人数</button><br/><br/>
        <button onclick="back()" style="width: 135px;height: 45px;">上传共享文件</button><br/><br/>
        <button onclick="show_see()" style="width: 135px;height: 45px;">查看共享文件</button><br/><br/>
        <button onclick="alert('你还真是无聊【抠鼻】...')" style="width: 135px;height: 45px;">无聊你就点呗</button>
    </div>
</div>
<div class="right">
<div class="top">
    <h1 style="margin-left: 30%">聊天窗口</h1>
    <div class="content" id="content"></div>
</div>
<div class="foot">
    <form>
        <input type="hidden" name="chatroom" value="<?php echo $chatroom;?>">
        <input type="hidden" name="username" value="<?php echo $username;?>">
        <div>
        颜色:<select name="msg_color">
            <option style="color: #FF0000" value="#FF0000">红色</option>
            <option checked style="color: #FF7F00" value="#FF7F00">橙色</option>
            <option style="color: #FFFF00" value="#FFFF00">黄色</option>
            <option style="color: #00FF00" value="#00FF00">绿色</option>
            <option style="color: #00FFFF" value="#00FFFF">青色</option>
            <option style="color: #0000FF" value="#0000FF">蓝色</option>
            <option style="color: #8B00FF" value="#8B00FF">紫色</option>
        </select>
            <span style="margin-left: 20%">
            表情:<select name="biaoqing">
                <option>笑着说</option>
                <option>含情脉脉</option>
                <option>深情的</option>
                <option>一把鼻涕</option>
                <option>傻逼似的</option>
                <option>暗示着</option>
                <option>认真的</option>
                </select>
                </span>
            <span style="margin-left: 20%">
            发送对象:<select name="receiver" id="user">
                <option>所有人</option>
            </select>
                </span>
        </div>
        <textarea name="content" style="width: 80%;height: 70%;float: left;" ></textarea>
        <button style="width: 10%;height: 70%; float: left;" onclick="return send_msg()">发送</button>
        <span id="biaozhi"></span>
    </form>
</div>
<div>
</div>
    <div id="file" style="display:none;width:35%;height:35%;background-color:darkorchid;z-index: 1000;position: absolute;top: 30%;left: 30%;" class="upload">
        <span style="float: right;cursor: pointer;" onclick="cler()">✘</span>
        <form style="text-align: center;padding-top: 20%;">
                <h2>选择你需要共享的文件</h2>
                <input type="file" name="files" />
                <input type="hidden" value="<?php echo $chatroom;?>" name="room">
                <button onclick="return uploadfile()">上传</button>
            </form>
        <div id="a" style="width: 100%;height: 30px;border: 1px chocolate solid;"><div style="width: 0%;height:29px;background-color: #FFFF00;" id="b"></div></div>
    </div>
    <div style="display:none;width: 70%;z-index:1000;position:absolute;top:20%;left:20%;height: 70%;background-color: #00FFFF;" id="seefile">
        <span style="float: right;cursor: pointer;" onclick="cler_see()">✘</span>
        <h1>请选择需要下载的文件点击下载</h1>
        <div id="content_file"></div>
    </div>

</body>
<script type="text/javascript">
    function uploadfile(){
        var fm1=document.getElementsByTagName('form')[1];

        var fd2=new FormData(fm1);

        var xhr=new XMLHttpRequest();

        xhr.upload.onprogress=function(evt){
            var loaded=evt.loaded;
            var total=evt.total;

            var per=Math.floor((loaded/total)*100)+"%";

            document.getElementById('b').innerHTML=per;
            document.getElementById('b').style.width=per;

        }

        xhr.onreadystatechange=function(){
            if(xhr.readyState==4){
                alert(xhr.responseText);
            }
        }
        xhr.open("post","./upload.php");

        xhr.send(fd2);

        return false;
    }

    function back(){
        document.getElementById('file').style.display="block";
    }
    function cler(){
        document.getElementById('file').style.display="none";
    }
    function show_see(){
        document.getElementById('seefile').style.display="block";
        var xhr2=new XMLHttpRequest();
        xhr2.onreadystatechange=function(){
            if(xhr2.readyState==4){
                document.getElementById('content_file').innerHTML=xhr2.responseText;
            }
        }
        xhr2.open("get","./getfile.php?room=<?php echo $chatroom;?>");
        xhr2.send(null);
    }
    function cler_see(){
        document.getElementById('seefile').style.display="none";
    }
    function send_msg(){
        var fm=document.getElementsByTagName('form')[0];
        var fd=new FormData(fm);
        var xhr=new XMLHttpRequest();

        xhr.onreadystatechange=function(){
            if(xhr.readyState==4){
                document.getElementById('biaozhi').innerText=xhr.responseText;
                document.getElementsByTagName('textarea')[0].value="";
                setTimeout("hiddenmsg()",3000);
            }
        }
        xhr.open("post","./send_msg.php");

        xhr.send(fd);

        return false;

    }

    function hiddenmsg(){
        document.getElementById('biaozhi').innerText="";
    }

</script>
</html>