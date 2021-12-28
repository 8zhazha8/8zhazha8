<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/12/3
 * Time: 14:58
 */

//print_r($_POST);

$userName = $_POST['username'];
$password = $_POST['psd'];

//
//if(!isset($_POST['type'])){
//    echo '没有类型值';
//}else{
//    echo '类型正常';
//}
//
//die;


if($userName=='admin'&& $password=='123456'){
    echo '登入成功!';
}else{
    echo '用户名或密码错误!';
}

//empty is_set








