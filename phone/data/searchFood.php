<?php
include("./common.php");
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");


$classify=htmlspecialchars($_POST['classify']);
$footPrice=htmlspecialchars($_POST['footPrice']);
$footName=htmlspecialchars($_POST['footName']);

$result=$link->query("select footName,classify,path,footNum,footPrice,footId from zx_foots where footName like '%" .$footName. "%' and classify like '%" .$classify. "%' and footPrice like '%" .$footPrice. "%' ");

    $arr['flag']=0;
    if($result){
    	while ($row=$result->fetch()){
        	$arr['list'][]=$row;
        	$arr['flag']=1;
    	}
    }
echo json_encode($arr);
$link=null;