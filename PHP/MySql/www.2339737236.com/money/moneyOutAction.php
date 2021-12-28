<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/12/16
 * Time: 14:19
 */

include_once '../tools/DbTools.php';
session_start();

include_once '../common/common.php';
$isLogin = getLoginStatus();
if(!$isLogin){
    echo '尚未登入，<a href="../user/loginUi.php">请先登入</a>';die;
}
$money = $_POST['money'];
if(empty($money) || $money<0){
    echo '取款金额有误，<a href="moneyOut.php">重新取款</a>';die;
}
$token = $_COOKIE['Token'];
$userInfo = $_SESSION[$token];



////方式2 函数调用
//DbTools::init();
//$result = moneyOut($userInfo['CardId'],$money);
//if($result['status']){
//    echo '取款成功<a href="moneyOut.php">继续取款</a>';
//}else{
//    echo '取款有误： '.$result['message'];
//}
//DbTools::close();

//方式3 函数调用
DbTools::init();
$result = moneyInOut(2,$userInfo['CardId'],$money);
if($result['status']){
    echo '取款成功<a href="moneyOut.php">继续取款</a>';
}else{
    echo '取款有误： '.$result['message'];
}
DbTools::close();