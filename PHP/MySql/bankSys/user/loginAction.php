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
//执行业务
//$loginSql = "select * from bankcard where CardNo='$username' and CardPwd='$password'";
$loginSql = "select *,
(
	select RealName from accountinfo where accountinfo.AccountId=bankcard.AccountId
)RealName
from bankcard 
where CardNo='$username' and CardPwd='$password'";

$result = DbTools::select($loginSql);
if(!empty($result)){
    $msg = '登入成功';
    $flag = true;
    $token = md5($username.$password.time());
    setcookie('Token',$token,time()+3600,'/');
    $_SESSION[$token] = [
        'username' =>$username,
        'password'=>$password,
        'RealName'=>$result[0]['RealName'],
        'CardId'=>$result[0]['CardId'],
        'AccountId'=>$result[0]['AccountId'],
    ];
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
