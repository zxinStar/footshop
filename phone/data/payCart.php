<?php
session_start();
include("./common.php");
$footName=htmlspecialchars($_POST['footName']);
$orderNum=htmlspecialchars($_POST['orderNum']);
$footPrice=htmlspecialchars($_POST['footPrice']);
$footId=htmlspecialchars($_POST['footId']);
$userId=htmlspecialchars($_POST['userId']);
$orderId=htmlspecialchars($_POST['orderId']);

$conn = mysql_connect('localhost','root','') or die ("数据连接错误!!!");
mysql_select_db('zx__ordsystem',$conn);
mysql_query("set names 'utf8'");
mysql_query("START TRANSACTION"); 

$sql1 = "INSERT INTO zx_orderdetails(orderId,footId,orderNum,footPrice,footname) VALUES ('$orderId','$footId','$orderNum','$footPrice','$footName')"; 
$sql2 = "DELETE FROM zx_carts WHERE footId='$footId' and userId='$userId'"; 
$sql3 = "UPDATE zx_foots SET footNum=footNum-'$orderNum' WHERE footId='$footId'"; 

$res1 = mysql_query($sql1); 
$res2 = mysql_query($sql2);  
$res3 = mysql_query($sql3);  
if($res1 && $res2 && $res3){  
	mysql_query("COMMIT");  
	//unset($goods[$footName]);
	$arr['flag']=1;//反馈成功
}else{  
 	mysql_query("ROLLBACK");  
 	$arr['flag']=2;//数据回滚 
}
mysql_query("END");

echo json_encode($arr);
