<?php
include("./common.php");
//开启session
session_start();

//查看当前session中是否已经定义了购物车变量;没有的话就新建一个变量，其值是一个空数组
if(!isset($_SESSION['goods'])){  
  $_SESSION['goods'] = array(); //session销毁之后变为空   
}  

$flag = htmlspecialchars($_POST['flag']);
$footName = htmlspecialchars($_POST['footName']);
$footPrice = htmlspecialchars($_POST['footPrice']);
$footId = htmlspecialchars($_POST['footId']);
$path = htmlspecialchars($_POST['path']);
$goods = $_SESSION['goods'];
if($flag==1){
    if ($footName == $goods[$footName]['footName']) {//买过的话，则总价格增加，相应商品数量增加
      $goods[$footName]['number'] += 1;
    }else{//第一次买的话，将相应的商品信息添加到session中
      $goods[$footName]['footName'] = $footName;
      $goods[$footName]['footId'] = $footId;
      $goods[$footName]['footPrice'] = $footPrice;
      $goods[$footName]['path'] = $path;
      $goods[$footName]['number'] += 1;
    }
}else if($flag==2){
    if ($footName == $goods[$footName]['footName']) {//买过的话，则总价格减少，相应商品数量减少
      $goods[$footName]['number'] -= 1;
    }
}else if($flag==3){
    if ($footName == $goods[$footName]['footName']) {//删除
      	unset($goods[$footName]);
    }
}    
$_SESSION['goods'] = $goods;

echo json_encode($goods);
