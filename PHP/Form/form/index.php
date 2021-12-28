<?php
//empty is_set

//empty 判断为空情况: 1.变量没有定义 2.变量为空（'',null,0,false）
$aa = false;
if(empty($aa)){
    echo '为空<br />';
}else{
    echo '不为空<br />';
}

if(!isset($aa)){
    echo '没有定义<br />';
}else{
    echo '有定义<br />';
}
