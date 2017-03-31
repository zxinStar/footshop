<?php
    $loginName=trim($_POST['logName']);
    $loginPw=trim($_POST['logPw']);
    $link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
    $link->query("set names utf8");
    $result=$link->query("select userId,loginName,userTel from zx_userinfos where loginName='$loginName' and loginPw=md5('$loginPw')");
    $row=$result->fetch();

    if($row){
        $arr['flag']=1;
        session_start();
        $_SESSION['key']= $row;
        echo json_encode($arr);
    }else {
        $arr['flag']=2;
        echo json_encode($arr);
    }
