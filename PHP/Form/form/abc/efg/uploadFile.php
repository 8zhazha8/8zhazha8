<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>个人中心</title>
</head>
<body>
<form action="uploadmultiple.php" method="post" enctype="multipart/form-data">
    <p>个人中心</p>
    <p>上传产品图：<input type="file" name="file" id="file" multiple onchange="showimage();"></p>
    <img src="" id="imgid">
    <input type="submit" name="" id="" value="提交" />

</form>
<!--<button onclick="showimage();">显示图片</button>-->
</body>
<script>
    function showimage() {
        // var fileValue = document.getElementById('file').value;
        // console.log(fileValue)
        // document.getElementById('imgid').src = fileValue;

        var fileObj = document.getElementById('file');
        var URL = window.URL || window.webkitURL;
        var imgURL = URL.createObjectURL(fileObj.files[0]);
        document.getElementById('imgid').src=imgURL;

    }
</script>
</html>
