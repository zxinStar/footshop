<?php
include("./common.php");
session_start();
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");

$userId=include("./common.php");($_POST['userId']);
$result=$link->query("select orderId,eatTime,memo,tag from zx_orders where userId='$userId'");
$arr['flag']=1;
if($result){
	while ($row=$result->fetch()){
    	$arr['message'][]=$row;
	}
	$count = count($arr['message']);

	for ($i=0; $i < $count; $i++) {
		$orderId = $arr['message'][$i]['orderId'];
		$res=$link->query("select footname,footPrice,orderNum from zx_orderdetails where orderId='$orderId'");
		while ($r=$res->fetch()){
	    	$arr['message'][$i]['foot'][]=$r;
		}
	}
}
echo json_encode($arr);
$link=null;