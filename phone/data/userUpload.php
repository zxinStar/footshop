<?php
header("Content-Type:text/html;charset=UTF-8");
$vCode=trim($_POST['vcode']);
session_start();

if ($vCode==$_SESSION['vCode']){
    //获取value值
    $loginName=trim($_POST['fname']);
    $userTel=trim($_POST['tel']);

    //连接数据库
    $link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
    $link->query("set names utf8");
    $resName=$link->query("select userId from zx_userinfos where loginName='$loginName'");
    $rowName=$resName->fetch();
    $resTel=$link->query("select userId from zx_userinfos where userTel='$userTel'");
    $rowTel=$resTel->fetch();
    
    if($rowName){
        $arr['flag']=4;
    }else if($rowTel){
        $arr['flag']=5;
    }else {
        $loginPw=trim($_POST['password']);
        $result=$link->query("INSERT INTO zx_userinfos(loginName,userTel,loginPw) VALUES('$loginName','$userTel',md5('$loginPw'))");
        if($result){
            $arr['flag']=2;
        }else {
            $arr['flag']=3;
        }
        $link=null;
    }
}else {
    $arr['flag']=1;
}
echo json_encode($arr);