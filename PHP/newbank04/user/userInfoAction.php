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
$RealName = $_SESSION[$token]['RealName'];
$CardNo = $_SESSION[$token]['username'];

/**-------------------------------------------------------------------*/

//初始化数据库连接
DbTools::init();  /**调用静态init方法*/
$Sql = "select CardMoney from bankcard where CardId=".$_SESSION[$token]['CardId'];
/**查询用户的金额*/
$result = DbTools::select($Sql);
$money = $result[0]['CardMoney'];

/**
 * 返回的结果就是金额，下面是在数组中存储的形式
 * Array ( [0] => Array ( [CardMoney] => xxxxxxxxxxx.xxx ) )
 */
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
<h3>欢迎您，<?php echo $RealName; ?> &nbsp; &nbsp;&nbsp; <a href="logout.php">退出登入</a></h3>
<p>卡号：<?php echo $CardNo; ?>,￥<?php echo $money; ?></p>
<ul>
    <li><a href="../money/moneyIn.php">存钱</a></li>
    <li><a href="../money/moneyOut.php">取钱</a></li>
    <li><a href="../money/transfer.php">转账</a>
</ul>
<ul>
    <li><a href="../others/otherCards.php">查询其他卡</a></li>
</ul>
</body>
</html>
