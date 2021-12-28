<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/12/8
 * Time: 8:30
 */
//1. 不设置有效期：就是会话Cookies
//setcookie('abc','110');

//2. 设置有效期
//setcookie('abc','110',time()+24*3600);

print_r($_POST);

$userName = $_POST['uesrname'];
$password = $_POST['password'];

//1.开启SEESSION功能
session_start();


if(!empty($userName) && !empty($password)){
    echo '登入成功';
    echo '<br />';
    $token = md5($userName.$password);
    if($userName == 'admin' && $password=='123456'){
        setcookie('Token',$token,time()+24*3600,'/');
    }else if($userName == 'test' && $password=='666666'){
        setcookie('Token',$token,time()+24*3600,'/');
    }else if($userName == 'zhangsan' && $password=='888888'){
        setcookie('Token',$token,time()+24*3600,'/');
    }
    //2.设置SESSION
    $_SESSION[$token] = [
        'userName' =>$userName,
        'password' =>$password
    ];
    echo '当前SEESION值： ';
    print_r($_SESSION);
    echo '<a href="../user.php">进入个人中心</a>';
}else{
    echo '用户名或密码错误';
}


