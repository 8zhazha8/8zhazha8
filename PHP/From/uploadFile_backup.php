<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>个人中心</title>
</head>
<body>
<form action="uploadmultiple_backup.php" method="post" enctype="multipart/form-data"> //接收图片
    <p><h1>个人中心</h1></p>
    <br/>
    <p>上传产品图：<input type="file" name="file" id="file" multiple onchange="showimage();"></p>
    <br/>
    <img src="" id="imgid">
    <br/>
    <input type="submit" name="" id="" value="提交" />

</form>
<!--<button onclick="showimage();">显示图片</button>-->
</body>
<script>
    function showimage() {
        var fileObj = document.getElementById('file');
        var URL = window.URL || window.webkitURL;
        var imgURL = URL.createObjectURL(fileObj.files[0]);
        document.getElementById('imgid').src = imgURL;
    }
</script>
</html>