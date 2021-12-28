<?php

include_once '../tools/DbTools.php';
session_start();

include_once '../common/common.php';
$isLogin = getLoginStatus();
if(!$isLogin){
    echo '尚未登入，<a href="../user/loginUi.php">请先登入</a>';die;
}
//到这里，表示已经登入
$token = $_COOKIE['Token'];
$userInfo = $_SESSION[$token];

//初始化数据库连接
DbTools::init();

$cardIds = $_POST['cardids'];

if(empty($cardIds)){
    echo '尚未选择任何卡，<a href="otherCards.php">请重新选择</a>';die;
}

$all_ok = true;
for($i=0;$i<count($cardIds);$i++){
    $tempCardId = $cardIds[$i];
    //0.查询卡余额
    $money = getMoneyByCardId($tempCardId);
    if($money>0){
        //1.转移资金
        $result = transfer($tempCardId,$userInfo['CardId'],$money);
        if(!$result['status']){
            echo '转账失败';
            $all_ok = false;
            break;
        }
    }
    //2.设置卡状态
    $sql = "update bankcard set CardState=-1 where CardId=$tempCardId";
    $result = DbTools::noSelect($sql);
    if(!$result['status']){
        echo '设置卡状态失败';
        $all_ok = false;
        break;
    }
}
if($all_ok){
    echo '销卡成功<a href="otherCards.php">继续销卡</a>';
}
//关闭连接
DbTools::close();
?>

