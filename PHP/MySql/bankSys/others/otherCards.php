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
//查询用户的其它卡
$sql = "select * from bankcard where CardState=0 and AccountId=".$userInfo['AccountId'].' and CardId!='.$userInfo['CardId'];
$result = DbTools::select($sql);
//关闭连接
DbTools::close();
?>


<html>
    <head>
        <title>其它卡列表</title>
    </head>
    <body>
    <p><a href="../user/userInfoAction.php">回到个人中心</a></p>
        <form action="removeOtherCards.php" method="post">
            <table border="1" cellspacing="0" cellpadding="10px">
                <tr>
                    <th><input type="checkbox" onchange="doCheck();" id="chk1"></th>
                    <th>序号</th>
                    <th>卡号</th>
                    <th>余额</th>
                </tr>

                <?php foreach ($result as $key=>$row){
                    ?>
                    <tr>
                        <th><input type="checkbox" name="cardids[]" VALUE="<? echo $row['CardId'];?>"></th>
                        <td><? echo $key+1;?></td>
                        <td><? echo $row['CardNo'];?></td>
                        <td><? echo $row['CardMoney'];?></td>
                    </tr>
                <?php }?>

            </table>
            <p><button type="submit">注销卡</button></p>
        </form>


    </body>
    <script>
        function doCheck() {
            var chk1obj = document.getElementById('chk1');
            var inpuobj = document.getElementsByTagName('input');
            for(var i=1;i<inpuobj.length;i++){
                inpuobj[i].checked=chk1obj.checked;
            }
        }
    </script>
</html>


