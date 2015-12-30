
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title></title>

    <script type="text/javascript">
     function aa(){
         var xhr=new XMLHttpRequest();
         xhr.onreadystatechange=function(){
             if(xhr.readyState==4){
             }
         }
         xhr.open("get","./test2.php")
         xhr.send(null);
     }
    </script>
</head>
<body onbeforeunload="aa()">

</body>
</html>