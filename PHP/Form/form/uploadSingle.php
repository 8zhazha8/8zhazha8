<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/12/3
 * Time: 15:13
 */


//print_r($_POST);

//TB = 1024G
//GB = 1024m
//MB = 1024k
//KB = 1024B
//Bybt = 8bit
//bit


//Array
//(
//    [file] => Array
//    (
//              [name] => flower18.jpg
//              [type] => image/jpeg
//              [tmp_name] => C:\Users\Administrator\AppData\Local\Temp\phpE25B.tmp
//              [error] => 0
//              [size] => 29617
//        )
//
//)
//echo '<br />';
$old_file_name =  $_FILES['file']['name'];
////echo '<br />';
$tempPath =  $_FILES['file']['tmp_name'];
//
//echo 'public/image/'.$old_file_name;

$newName = md5($old_file_name.time().rand(10000,99999));

$arr = explode('.',$old_file_name);




move_uploaded_file($tempPath,'public/image/'.$newName.'.'.$arr[1]);

echo '上传成功';

//$count = count($_FILES['file']['name']);
//echo $count;




