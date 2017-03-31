<?php
$flag=trim($_POST['flag']);
$userId=trim($_POST['id']);

$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");

if($flag == 1){
	$result=$link->query("select admName,admEmail,admTel from zx_adminfos where id='$userId'");
	while ($row=$result->fetch()){
        $arr[]=$row;
    }
}else if($flag == 2){
	$admName=trim($_POST['admName']);
	$check=$link->query("select admName from zx_adminfos where admName='$admName'");
	$row=$check->fetch();
	if($row){
		$arr['flag']=3;//该手机号码已经存在
	}else{
		$result=$link->exec("UPDATE zx_adminfos SET admName='$admName' WHERE id='$userId'");
	    if($result){
	        $arr['flag']=1;//修改成功
	    }else {
	        $arr['flag']=2;//修改失败
	    }
	}
}else if($flag == 3){
	$admTel=trim($_POST['admTel']);
	$check=$link->query("select admTel from zx_adminfos where admTel='$admTel'");
	$row=$check->fetch();
	if($row){
		$arr['flag']=3;//该手机号码已经存在
	}else{
		$result=$link->exec("UPDATE zx_adminfos SET admTel='$admTel' WHERE id='$userId'");
	    if($result){
	        $arr['flag']=1;//修改成功
	    }else {
	        $arr['flag']=2;//修改失败
	    }
	}
}else if($flag == 4){
	$admEmail=trim($_POST['admEmail']);
	$check=$link->query("select admEmail from zx_adminfos where admEmail='$admEmail'");
	$row=$check->fetch();
	if($row){
		$arr['flag']=3;//该手机号码已经存在
	}else{
		$result=$link->exec("UPDATE zx_adminfos SET admEmail='$admEmail' WHERE id='$userId'");
	    if($result){
	        $arr['flag']=1;//修改成功
	    }else {
	        $arr['flag']=2;//修改失败
	    }
	}
}else{
	$oldpw=trim($_POST['oldpw']);
	$loginpw=trim($_POST['loginpw']);
	$old=$link->query("select admPw from zx_adminfos where id='$userId' and admPw=md5('$oldpw')");
	$r=$old->fetch();
	if($r){
		$check=$link->query("select admPw from zx_adminfos where id='$userId' and admPw=md5('$loginpw')");
		$row=$check->fetch();
		if($row){
			$arr['flag']=6;//与旧密码保持一致
		}else{
			$result=$link->exec("UPDATE zx_adminfos SET admPw=md5('$loginpw') WHERE id='$userId'");
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
