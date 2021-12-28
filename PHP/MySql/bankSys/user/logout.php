<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/12/15
 * Time: 9:26
 */
include_once '../common/common.php';
$isLogin = getLoginStatus();
if($isLogin){
    $token = $_COOKIE['Token'];
    setcookie('Token','',time()-3600,'/');
    unset($_SESSION[$token]);
}
echo '<a href="loginUi.php">重新登入</a>';die;