<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>头像上传成功</title>
</head>
<body>
<?php
$old_file_names = $_FILES['file']['name']; /**得到上传的图片的地址*/
$dest_path = ''; /**设置目的地址为空*/

if(is_array($old_file_names)){      /**判断$old_file_names是否为数组*/
    /**用于接收多张图片*/
    foreach (  $old_file_names as $key=> $item){

        $tempPath = $_FILES['file']['tmp_name'][$key];  /**设置临时地址*/
        $newName = md5($item.time().rand(10000,99999));  /**加密地址*/
        $arr = explode('.',$item);    /**以.切割地址*/
        $dest_path = 'public/image/'.$newName.'.'.$arr[1]; /**拼接地址*/
        move_uploaded_file($tempPath,$dest_path);  /**移动到新的文件夹*/
    }
}else{

    $old_file_name =  $_FILES['file']['name'];
    $tempPath =  $_FILES['file']['tmp_name'];
    $newName = md5($old_file_name.time().rand(10000,99999));
    $arr = explode('.',$old_file_name);
    $dest_path = 'public/image/'.$newName.'.'.$arr[1];
    move_uploaded_file($tempPath,$dest_path);
}
?>

</body>
<h1>你的头像是</h1>
<img src="<?echo $dest_path ?>" />
</html>
