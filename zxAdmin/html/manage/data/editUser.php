<?php
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");

$flag=trim($_POST['flag']);
if($flag == 1){
    $result=$link->query("select loginName,userTel,userId as id from zx_userinfos order by userId desc");
    while ($row=$result->fetch()){
        $arr[]=$row;
    }
    echo json_encode($arr);
}else if($flag == 2){
    $id=trim($_POST['id']);  
    $loginName=trim($_POST['loginName']);  
    $userTel=trim($_POST['userTel']);  
    $result=$link->exec("UPDATE zx_userinfos SET loginName='$loginName',userTel='$userTel' WHERE userId='$id'");
    if($result){
        $arr=1;//修改成功
    }else{
        $arr=2;//修改失败
    }
    echo $arr;
}
$link=null;