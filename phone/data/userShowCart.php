<?php
session_start();
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");

$userId=trim($_POST['userId']);

    $result=$link->query("select f.footId,f.footName,f.footPrice,f.path,c.orderNum from zx_carts c join zx_foots f on c.footId=f.footId where c.userId='$userId'");
    $arr['flag']=1;
    while ($row=$result->fetch()){
        $arr['message'][]=$row;
        $arr['flag']=0;
    }
    

echo json_encode($arr);
$link=null;