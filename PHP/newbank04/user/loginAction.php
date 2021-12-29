<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/12/15
 * Time: 8:26
 */
include_once '../tools/DbTools.php';

#开始session
session_start();
$username = $_POST['username'];
$password= $_POST['password'];
$flag = false;
$msg = '';

//初始化数据库连接
DbTools::init();
/**调用静态init方法*/
//执行业务
//$loginSql = "select * from bankcard where CardNo='$username' and CardPwd='$password'";
$loginSql = "select *,
(
	select RealName from accountinfo where accountinfo.AccountId=bankcard.AccountId
)RealName
from bankcard 
where CardNo='$username' and CardPwd='$password'";

$result = DbTools::select($loginSql);/**获得查询结果*/
if(!empty($result)){  /**如果查询结果不为空*/
    $msg = '登入成功';
    $flag = true;
    $token = md5($username.$password.time());
    setcookie('Token',$token,time()+3600,'/');
    $_SESSION[$token] = [
        'username' =>$username,
        'password'=>$password,
        'RealName'=>$result[0]['RealName'],
        'CardId'=>$result[0]['CardId'],
        'AccountId'=>$result[0]['AccountId'],  /**《查询其它卡》功能要用到的id*/
    ];
    /**
    Array--------------这是$result存放的值当username=6225098234234;
    (                                     password=123456
    [0] => Array
    (
    [CardId] => 4
    [CardNo] => 6225098234234
    [AccountId] => 2
    [CardPwd] => 123456
    [CardMoney] => 101800.0000
    [CardState] => 0
    [CardTime] => 2021-08-10 16:04:00
    [RealName] => 刘备
    )

    )
     */
}else{
    $msg = '登入失败';
}

//关闭连接
DbTools::close();
?>

<html>
    <body>
       <input type="hidden" id="flag" value="<?php echo $flag;?>">
       <input type="hidden" id="msg" value="<?php echo $msg;?>">
    </body>
</html>

<script type="text/javascript">
    var flagValue = document.getElementById('flag').value;
    var msg = document.getElementById('msg').value;
    onload = function(){
        alert(msg);
        if (flagValue){
            location.href='userInfoAction.php';
        }else{
            location.href='loginUi.php';
        }
    }
</script>
