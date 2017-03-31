<?php
$num=trim($_POST['num']);
$userId=trim($_POST['userId']);
$footId=trim($_POST['footId']);

$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");
$check=$link->query("select orderNum from zx_carts where footId='$footId' and userId='$userId'");
$row=$check->fetch();

if($num == 1 && $row){
	$arr['flag']=7;
	$result=$link->exec("UPDATE zx_carts SET orderNum=orderNum+1 WHERE footId='$footId' and userId='$userId'");
    if($result){
        $arr['flag']=5;//购物车某种菜品数量修改成功
    }else {
        $arr['flag']=6;//购物车某种菜品数量修改失败
    }
}else if($num == 2 && $row){
	$arr['flag']=10;
	$result=$link->exec("UPDATE zx_carts SET orderNum=orderNum-1 WHERE footId='$footId' and userId='$userId'");
    if($result){
        $arr['flag']=11;//购物车某种菜品数量修改成功
    }else {
        $arr['flag']=12;//购物车某种菜品数量修改失败
    }
}else if($num == 3 && $row){
	$result=$link->exec("DELETE FROM zx_carts WHERE footId='$footId' and userId='$userId'");
    if($result){
        $arr['flag']=8;//删除成功
    }else{
        $arr['flag']=9;//删除失败
    }
}else{
	if($row){
		$orderNum=trim($_POST['orderNum']);
    	$result=$link->exec("UPDATE zx_carts SET orderNum=orderNum+'$orderNum' WHERE footId='$footId' and userId='$userId'");
	    if($result){
	        $arr['flag']=1;//购物车某种菜品数量修改成功
	    }else {
	        $arr['flag']=2;//购物车某种菜品数量修改失败
	    }
	}else{
	    $result=$link->query("INSERT INTO zx_carts(userId,footId,orderNum) VALUES ('$userId','$footId',1)");
	    if($result){
	        $arr['flag']=3;//添加成功
	    }else{
	        $arr['flag']=4;//添加失败
	    }
	}
}
echo json_encode($arr);
