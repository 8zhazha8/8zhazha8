<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/12/15
 * Time: 9:03
 */
session_start();

function getLoginStatus(){

    //是否有token COOKIES值
    if(empty($_COOKIE['Token'])){
        return false;
    }
    $token = $_COOKIE['Token'];
    //判断是否SESSION中是否有对于的token项
    if(empty($_SESSION[$token])){
        return false;
    }
    return true;
}

/**
 * 存钱函数
 * @param $cardId :银行卡ID
 * @param $money： 存钱金额
 *
 */
function moneyIn($cardId,$money){
    //1. 存钱
    $Sql = "update bankcard set CardMoney=CardMoney+ $money where CardId=".$cardId;
    $result = DbTools::noSelect($Sql);
    if(!$result['status']){
        return $result;
    }
    //2.添加日志
    $Sql = "insert into cardexchange(CardId,MoneyInBank,MoneyOutBank,ExchangeTime) 
          values($cardId,$money,0,NOW())";
    $result = DbTools::noSelect($Sql);
    return $result;
}

/**
 * 取钱函数
 * @param $cardId :银行卡ID
 * @param $money： 存钱金额
 *
 */
function moneyout($cardId,$money){
    //1. 存钱
    $Sql = "update bankcard set CardMoney=CardMoney- $money where CardId=$cardId and CardMoney>=$money";
    $result = DbTools::noSelect($Sql);
    if(!$result['status']){
        return $result;
    }
    //2.添加日志
    $Sql = "insert into cardexchange(CardId,MoneyInBank,MoneyOutBank,ExchangeTime) 
          values($cardId,0,$money,NOW())";
    $result = DbTools::noSelect($Sql);
    return $result;
}
//存取钱：
//$type 1：存钱 2取钱
function moneyInOut($type,$cardId,$money){
    $real_money = 0;
    $inMoney = 0;
    $outMoney = 0;
    if($type == 1){
        $real_money = $money;
        $inMoney = $money;
    }else{
        $real_money = -$money;
        $outMoney = $money;
    }
    //1. 存取钱
    $Sql = "update bankcard set CardMoney=CardMoney+ $real_money where CardId=".$cardId;
    if($type==2){
        $Sql .=" and CardMoney>=$money";
    }
    $result = DbTools::noSelect($Sql);
    if(!$result['status']){
        return $result;
    }
    //2.添加日志
    $Sql = "insert into cardexchange(CardId,MoneyInBank,MoneyOutBank,ExchangeTime) 
          values($cardId,$inMoney,$outMoney,NOW())";
    $result = DbTools::noSelect($Sql);
    return $result;
}
//存取钱2：
//$type 1：存钱 2取钱
function moneyInOut2($type,$cardId,$money){
    //1. 存钱
    if($type==1){
        $Sql = "update bankcard set CardMoney=CardMoney+ $money where CardId=".$cardId;
    }else{
        $Sql = "update bankcard set CardMoney=CardMoney- $money where CardId=$cardId and CardMoney>=$money";
    }
    $result = DbTools::noSelect($Sql);
    if(!$result['status']){
        return $result;
    }
    //2.添加日志
    if($type==1){
        $Sql = "insert into cardexchange(CardId,MoneyInBank,MoneyOutBank,ExchangeTime) 
          values($cardId,$money,0,NOW())";
    }else{
        $Sql = "insert into cardexchange(CardId,MoneyInBank,MoneyOutBank,ExchangeTime) 
          values($cardId,0,$money,NOW())";
    }
    $result = DbTools::noSelect($Sql);
    return $result;
}


function getcarid($carnum){
     $sql="SELECT CardId FROM bankcard WHERE CardNo = $carnum";
     $result=DbTools::select($sql);
     return $result[0]['CardId'];
}

//转账
function transfer($outCardId,$inCardId,$money){
    //减钱
    $Sql = "update bankcard set CardMoney=CardMoney- $money where CardId=$outCardId and CardMoney>=$money";
    $result = DbTools::noSelect($Sql);
    if(!$result['status']){
        return $result;
    }
    //加钱
    $Sql = "update bankcard set CardMoney=CardMoney+ $money where CardId=".$inCardId;
    $result = DbTools::noSelect($Sql);
    if(!$result['status']){
        return $result;
    }
    //添加记录
    $Sql = "insert into cardtransfer(CardIdOut,CardIdIn,TransferMoney,TransferTime) 
          values($outCardId,$inCardId,$money,NOW())";
    $result = DbTools::noSelect($Sql);
    return $result;
}
//根据卡ID获取余额
function getMoneyByCardId($CardId){
    $sql="SELECT CardMoney FROM bankcard WHERE CardId = $CardId";
    $result=DbTools::select($sql);
    return $result[0]['CardMoney'];
}