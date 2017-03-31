<?php
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");

$curPage=$_POST['curPage'];
$startTime=$_POST['startTime'];
$endTime=$_POST['endTime'];
$footName=$_POST['footName'];
$eatTel=$_POST['eatTel'];

    $recStar=$curPage*8;
    $result=$link->query("select o.eatTel,o.eatTime,d.footname,d.footPrice,d.orderNum from zx_orderdetails d join zx_orders o on d.orderId=o.orderId where o.tag=0 and o.eatTime >= '".$startTime."' and o.eatTime <= '".$endTime."' and d.footname like '%" .$footName. "%' and o.eatTel like '%" .$eatTel. "%' ");

    $rows=$result->rowCount();//总记录输
    $arr['total']=$rows;
    $result=$link->query("select o.eatTel,o.eatTime,d.footname,d.footPrice,d.orderNum from zx_orderdetails d join zx_orders o on d.orderId=o.orderId where tag=0 and (o.eatTime between '".$startTime."' and '".$endTime."') and d.footname like '%" .$footName. "%' and o.eatTel like '%" .$eatTel. "%' order by o.eatTime desc limit $recStar,8");
    $arr['flag']=0;
    if($result){
    	while ($row=$result->fetch()){
        	$arr['list'][]=$row;
        	$arr['flag']=1;
    	}
    }
    
echo json_encode($arr);
$link=null;