<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/12/8
 * Time: 9:10
 */

session_start();
//cookies的删除
//方式1： 设置值为空
//setcookie('Token','',time()+24*3600);
//方式2： 设置有效期为过去的时间
//setcookie('Token','64546545546645465',time()-10);
//方式3： 1+2
setcookie('Token','',time()-10,'/');
unset($_SESSION[$_COOKIE['Token']]);
echo '退出登入成功<a href="../loginui.php">重新登入</a>';