<?php

include_once '../tools/DbTools.php';
session_start();

include_once '../common/common.php';
$isLogin = getLoginStatus();
if(!$isLogin){
    echo '尚未登入，<a href="loginUi.php">请先登入</a>';die;
}
//到这里，表示已经登入
$token = $_COOKIE['Token'];
$userInfo = $_SESSION[$token];

//初始化数据库连接
DbTools::init();
$Sql = "select CardMoney from bankcard where CardId=".$userInfo['CardId'];
$result = DbTools::select($Sql);
$money = $result[0]['CardMoney'];
//关闭连接
DbTools::close();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户中心</title>
</head>
<body>
<p><a href="../user/userInfoAction.php">回到个人中心</a></p>
<form action="moneyOutAction.php" method="post">
    当前余额：<input type="text" name="old_money" id="" value="￥<?php echo $money; ?>" readonly="readonly" disabled="disabled" /><br />
    取钱金额：<input type="text" name="money" id="" value="" />
    <br />
    <input type="submit" value="提交"/>
</form>

</body>
</html>
