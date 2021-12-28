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
$Op_CardNo = $_POST['Op_CardNo'];
if(empty($money) || $money<0){
    echo '转帐金额有误，<a href="transfer.php">重新转帐</a>';die;
}
if(empty($Op_CardNo) ){
    echo '对方卡号有误，<a href="transfer.php">重新转帐</a>';die;
}
$token = $_COOKIE['Token'];
$userInfo = $_SESSION[$token];
$carnum=$_SESSION[$token]['username'];
//$carid= getcarid($carnum);
//
//$carid = $userInfo['CardId'];
////实现从转账放扣钱
//DbTools::init();
//$result = moneyInOut(2,$carid,$money);
//if($result['status']){
//
//}else{
//    echo '转账有无： '.$result['message'];
//}
////DbTools::close();
//
////实现转账金额进入对方卡号
//$carnum2= $_POST['Op_CardNo'];
////获取卡号
//$carid2 =getcarid($carnum2);
//
//
////DbTools::init();
//$result = moneyInOut(1,$carid2,$money);
//if($result['status']){
//
//}else{
//    echo '转账有误： '.$result['message'];
//}
////DbTools::close();
//
//
////添加转账记录
//$id1=$carid;
//$id2=$carid2;
//
////DbTools::init();
//$sql1="INSERT INTO cardtransfer(cardtransfer.CardIdOut,cardtransfer.CardIdIn,cardtransfer.TransferMoney,cardtransfer.TransferTime)
//VALUES($id1,$id2,$money,NOW())";
//$result=DbTools::noSelect($sql1);
//获取对方卡ID
DbTools::init();
$op_carid =getcarid($Op_CardNo);
//转账
$result = transfer($userInfo['CardId'],$op_carid,$money);
if($result['status']){
    echo '转账成功,<a href="transfer.php">重新转帐</a>';
}else{
    echo '转账有误： '.$result['message'];
}
DbTools::close();

