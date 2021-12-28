<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>头像上传成功</title>
	</head>
	<body>
    <?php
    //获取文件名数组
    $old_file_names =  $_FILES['file']['name'];
    $dest_path = '';
    $newName2 = '';
    if(is_array($old_file_names)){
        foreach (  $old_file_names as $key=> $item){
            $tempPath = $_FILES['file']['tmp_name'][$key];
            $newName = md5($item.time().rand(10000,99999));
            $arr = explode('.',$item);
            $dest_path = '../../public/image/'.$newName.'.'.$arr[1];
            $newName2 = $newName.'.'.$arr[1];
            move_uploaded_file($tempPath,$dest_path);
        }
    }else{
        $old_file_name =  $_FILES['file']['name'];
        $tempPath =  $_FILES['file']['tmp_name'];
        $newName = md5($old_file_name.time().rand(10000,99999));
        $arr = explode('.',$old_file_name);
        $dest_path = '../../public/image/'.$newName.'.'.$arr[1];
        $newName2 = $newName.'.'.$arr[1];
        move_uploaded_file($tempPath,$dest_path);
    }

    ?>
你的头像是
		<img src="/public/image/<?echo $newName2 ?>" />
	</body>

</html>
