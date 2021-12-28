<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2021/12/13
 * Time: 15:15
 */

//面向过程--函数式编程
//面向对象--类模板

//弱类型语言《=》强类型语言


class DbTools
{
    //数据库连接对象
    private static $conn;
    private static $host='127.0.0.1';
    private static $user='root';
    private static $password='root';
    private static $database='newbank04' ;

    //初始化数据库连接
    public static function init($host='', $user='', $password='', $database=''){
        //如果外部有参数输入，则用外部参数；否则用默认值
        if(!empty($host)){
            self::$host = $host;
        }
        if(!empty($user)){
            self::$user = $user;
        }
        if(!empty($password)){
            self::$password = $password;
        }
        if(!empty($database)){
            self::$database = $database;
        }


        //1. 创建mysqli对象
        self::$conn = new mysqli();
        //2. 连接数据库
        self::$conn ->connect(self::$host, self::$user, self::$password, self::$database);
        if(!empty(  self::$conn ->connect_error)){
            echo '数据库连接失败： '. self::$conn ->connect_error;
            die;
        }
        //echo '数据库连接成功<br />';
    }
    /**
     * 查询
     * 参数： $sql --查询语句
     *
     * 返回值：数组
     */
    public static function select($sql){
        $data = [];
        $result =  self::$conn ->query($sql);
        if(empty( self::$conn ->error)){
            while (true){
                $row = $result->fetch_assoc();
                if(empty($row)){
                    break;
                }
                $data[] = $row;
            }
        }
        //关闭查询结果集
        $result->close();
        return $data;
    }
    /**
     * 非查询：增删改
     * 参数： $sql --增删改语句
     *
     * 返回值：数组
     */
    public static function noSelect($sql){
        $result =  self::$conn ->query($sql);
        if($result){//执行成功
            if( self::$conn ->affected_rows>0){
                return [
                    'status'=>true,
                    'message'=>''
                ];
            }else{
                return [
                    'status'=>false,
                    'message'=>'影响数为0'
                ];
            }
        }else{//执行失败
            return [
                'status'=>false,
                'message'=> self::$conn ->error
            ];
        }
    }
    //关闭数据库连接
    public static function close(){
        self::$conn ->close();
    }
}