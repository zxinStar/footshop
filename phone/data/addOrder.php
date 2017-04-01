<?php
include("./common.php");
$eatName=htmlspecialchars($_POST['eatName']);
$eatTel=htmlspecialchars($_POST['eatTel']);
$eatNum=htmlspecialchars($_POST['eatNum']);
$eatTime=htmlspecialchars($_POST['eatTime']);
$memo=htmlspecialchars($_POST['memo']);
$userId=htmlspecialchars($_POST['userId']);

$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");
function randName($len){//随机订单编号产生
    $randN="";//以Z-开头
    $char="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    for ($i=0;$i<$len;$i++){
        $randN.=$char[mt_rand(0,strlen($char)-1)];
    }
    return $randN;
}
$orderNo=randName(21);

$resultNo=$link->prepare("select orderNo from zx_orders where orderNo=:orderNo");
$resultNo->execute(array(':orderNo' =>$orderNo));
$resultNo=$resultNo->fetch();
if($resultNo){
	$orderNo=randName(21);
}else{
	$result=$link->prepare("INSERT INTO zx_orders (eatName,eatTel,eatNum,memo,eatTime,orderNo,userId) VALUES (:eatName,:eatTel,:eatNum,:memo,:eatTime,:orderNo,:userId)");
	$result->execute(array(':eatName' =>$eatName , ':eatTel' =>$eatTel ,':eatNum' =>$eatNum, ':memo' =>$memo ,':eatTime' =>$eatTime, ':orderNo' =>$orderNo ,':userId' =>$userId ));	
	if($result){
		$res=$link->prepare("select orderId from zx_orders where orderNo=:orderNo");
		$res->execute(array(':orderNo' =>$orderNo));	
    	$arr['flag']=1;//失败
    	while ($row=$res->fetch()){
	        $arr['message']=$row;//反馈成功
	        $arr['flag']=3;
    	}
	}else{
	    $arr['flag']=2;//反馈失败
	}
}

echo json_encode($arr);
