<?php
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");

$result=$link->query("select classify,blurb,classiifyId as id from zx_classifys order by classiifyId desc");
while ($row=$result->fetch()){
    $arr[]=$row;
}

echo json_encode($arr);
$link=null;