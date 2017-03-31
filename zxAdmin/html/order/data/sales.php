<?php
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");
$flag=$_GET['flag'];

$flag=$_GET['flag'];
if($flag==1){
    $curPage=$_GET['curPage'];
    $recStar=$curPage*8;
    $result=$link->query("select o.eatTel,o.eatTime,d.footname,d.footPrice,d.orderNum from zx_orderdetails d join zx_orders o on d.orderId=o.orderId where tag=0");
    $rows=$result->rowCount();//总记录输
    $arr['total']=$rows;
    $result=$link->query("select o.eatTel,o.eatTime,d.footname,d.footPrice,d.orderNum from zx_orderdetails d join zx_orders o on d.orderId=o.orderId where tag=0 order by o.eatTime desc limit $recStar,8");
    while ($row=$result->fetch()){
        $arr['list'][]=$row;
    }
}else if($flag==2){
    $orderId=$_GET['orderId'];
    $result=$link->exec("UPDATE zx_orders SET tag=1 WHERE orderId='$orderId'");
    if($result){
        $arr['flag']=1;//分类删除成功
    }else{
        $arr['flag']=2;//分类删除失败
    }
}else if($flag==3){
     $orderId=$_GET['orderId'];
     $result=$link->query("select footname,footPrice,orderNum from zx_orderdetails where orderId='$orderId'");
     while ($row=$result->fetch()){
        $arr[]=$row;
     }
 }
echo json_encode($arr);
$link=null;

