<?php
session_start();
$vCode=trim($_POST['admCode']);
// echo "{$vCode}--{$_SESSION['vCode']}";调试是否获取到vCode的值
if(strtolower($vCode)==$_SESSION['vCode']){
    $admName=trim($_POST['admName']);
    $admPw=trim($_POST['admPw']);
    //连接数据库
    $link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
    $link->query("set names utf8");
    $result=$link->query("select * from adminfo where admName='$admName' and admPw='$admPw'");
    $row=$result->fetch();
    if($row){
        $_SESSION['key']= $row['admName'];
        $arr['flag']=3;//验证通过，登录成功
        $arr['admName']=$row['admName'];
    }else{
        $arr['flag']=2;//用户名或密码不正确
    }     
}else{
    $arr['flag']=1;//验证码不正确
}
echo json_encode($arr);
