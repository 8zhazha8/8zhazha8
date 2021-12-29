<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/12/8
 * Time: 8:36
 */

echo '用户中心<br/>';
//获取用户的COOKIES

//数据库（关系型数据库，MySQL，SQLSERVER ）
//内存：SESSION memcache
//非关系据库： REDIS: NOSQL(NOT NONLY SQL)
session_start();

if(isset($_COOKIE['Token'])){
    //3.SESSION取值
    if(isset($_SESSION[$_COOKIE['Token']])){
        $userName = $_SESSION[$_COOKIE['Token']]['userName'];
        echo "登入成功 <br />$userName<a href='user/logout.php'>退出登入</a>";
    }else{
        echo 'TOKEN异常 <br /><a href="loginui.php">请登入</a>';
    }
}else{
    echo '你尚未登入，<a href="loginui.php">请登入</a>';
}





