<?php
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");
$flag=$_POST['flag'];

if($flag==1){
    $footName=$_POST['footName'];
    $check=$link->query("select footName from zx_foots where footName='$footName'");   
    $row=$check->fetch();
    if($row){
        $arr['flag']=3;//重名
    }else{
        $footNum=$_POST['footNum'];
        $footPrice=$_POST['footPrice'];
        $footId=$_POST['footId'];

        $result=$link->exec("UPDATE zx_foots SET footName='$footName',footNum='$footNum',footPrice='$footPrice' WHERE footId='$footId'");
        if($result){
            $arr['flag']=1;
        }else{
            $arr['flag']=2;
        }
    }
}else if($flag==2){
    $classify=$_POST['classify'];
    $footId=$_POST['footId'];
    $check=$link->query("select classify from zx_foots where classify='$classify' and footId='$footId'");   
    $row=$check->fetch();
    if($row){
        $arr['flag']=6;//重名
    }else{
        $result=$link->exec("UPDATE zx_foots SET classify='$classify' WHERE footId='$footId'");
        if($result){
            $arr['flag']=4;
        }else{
            $arr['flag']=5;
        }
    }
}
echo json_encode($arr);
$link=null;
