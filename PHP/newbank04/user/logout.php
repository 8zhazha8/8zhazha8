<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/12/15
 * Time: 9:26
 */
include_once '../common/common.php';
$isLogin = getLoginStatus();  /**这个方法是判断是否有COOKIES值,返回值是true*/
if($isLogin){
    $token = $_COOKIE['Token'];
    setcookie('Token','',time()-3600,'/');
    /**清除cookie*/
    unset($_SESSION[$token]);
    /**清除SESSION*/
}
echo '<a href="loginUi.php">重新登入</a>';die;