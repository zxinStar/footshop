<?php
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");

    $result=$link->query("select userName,userEmail,feedback,mesId as id from zx_messages order by mesId desc");
    while ($row=$result->fetch()){
        $arr[]=$row;
    }
    echo json_encode($arr);

$link=null;