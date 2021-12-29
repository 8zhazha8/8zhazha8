<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/12/6
 * Time: 16:14
 */
$userName = $_POST['username'];
$password = $_POST['psd'];
//empty isset

//empty 判断为空情况: 1.变量没有定义 2.变量为空（'',null,0,false）
if(!isset($_POST['type'])){
    echo '没有类型值';
}else{
    echo '类型正常';
}

