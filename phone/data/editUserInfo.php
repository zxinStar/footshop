<?php
include("./common.php");
$flag=htmlspecialchars($_POST['flag']);
$userId=htmlspecialchars($_POST['userId']);

$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");

if($flag == 1){
	$userTel=htmlspecialchars($_POST['userTel']);
	$check=$link->query("select userTel from zx_userinfos where userTel='$userTel'");
	$row=$check->fetch();
	if($row){
		$arr['flag']=3;//该手机号码已经存在
	}else{
		$result=$link->exec("UPDATE zx_userinfos SET userTel='$userTel' WHERE userId='$userId'");
	    if($result){
	        $arr['flag']=1;//修改成功
	    }else {
	        $arr['flag']=2;//修改失败
	    }
	}
}else{
	$oldpw=htmlspecialchars($_POST['oldpw']);
	$loginpw=htmlspecialchars($_POST['loginpw']);
	$old=$link->query("select loginpw from zx_userinfos where userId='$userId' and loginpw=md5('$oldpw')");
	$r=$old->fetch();
	if($r){
		$check=$link->query("select loginpw from zx_userinfos where userId='$userId' and loginpw=md5('$loginpw')");
		$row=$check->fetch();
		if($row){
			$arr['flag']=6;//与旧密码保持一致
		}else{
			$result=$link->exec("UPDATE zx_userinfos SET loginpw=md5('$loginpw') WHERE userId='$userId'");
		    if($result){
		        $arr['flag']=4;//修改成功
		    }else {
		        $arr['flag']=5;//修改失败
		    }
		}
	}else{
		$arr['flag']=7;//原密码输入不正确
	}
	
}
echo json_encode($arr);
