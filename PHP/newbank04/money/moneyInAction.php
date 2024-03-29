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
    echo '存款金额有误，<a href="moneyIn.php">重新存款</a>';die;
}
$token = $_COOKIE['Token'];
$userInfo = $_SESSION[$token];

/**-------------------------------------------------------------------*/
//方式1：
//初始化数据库连接
//DbTools::init();
//$Sql = "update bankcard set CardMoney=CardMoney+ $money where CardId=".$userInfo['CardId'];
//$result = DbTools::noSelect($Sql);
//if($result['status']){
//    echo '存款成功<a href="moneyIn.php">继续存款</a>';
//}else{
//    echo '存款有误： '.$result['message'];
//}
////关闭连接
//DbTools::close();

////方式2 函数调用
//DbTools::init();
//$result = moneyIn($userInfo['CardId'],$money);
//if($result['status']){
//    echo '存款成功<a href="moneyIn.php">继续存款</a>';
//}else{
//    echo '存款有误： '.$result['message'];
//}
//DbTools::close();

//方式3 函数调用
DbTools::init(); /**调用静态方法*/
$result = moneyInOut2(1,$userInfo['CardId'],$money);
/**
  *  调用common中的moneyInOut方法
  * function moneyInOut2($type,$cardId,$money)
  *  $type: 1存钱 2取钱
  *  $cardId :银行卡ID
  *  $money： 存钱金额
  *

 */


if($result['status']){
    /**
     * 存款成功的时候print_r($result['status'])的返回值为1;
     *
     *'status' 在DbTools类中定义
    */
    print_r($result['status']);
    echo '存款成功<a href="moneyIn.php">继续存款</a>';
}else{
    echo '存款有误： '.$result['message'];
}
DbTools::close();