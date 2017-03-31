<?php
include("./common.php");
$fname=htmlspecialchars($_POST['fname']);
$email=htmlspecialchars($_POST['email']);
$info=htmlspecialchars($_POST['info']);
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");

if($_POST){
	if (is_file("../js/sensitive_words.txt")){//判断给定文件名是否为一个正常的文件
	   	$filter_word = file("../js/sensitive_words.txt");//把整个文件读入一个数组中
		for($i=0;$i<count($filter_word);$i++){//应用For循环语句对敏感词进行判断
			if(preg_match("/".trim($filter_word[$i])."/i",$info)){//应用正则表达式，判断传递的留言信息中是否含有敏感词
				$arr['flag']=3;
				echo json_encode($arr);
			 	exit;
			}
		}
		if(preg_match("/([\x{4e00}-\x{9fa5}].+)\\1{4,}/u",$info)){//同字重复５次以上
			$arr['flag']=4;
		}else if(preg_match("/^[0-9a-zA-Z]*$/",$info)){//全数字，全英文或全数字英文混合的
			$arr['flag']=5;
		}else if(strlen($info)<10){//输入字符长度过短
			$arr['flag']=6;
		}else{
			$result=$link->query("INSERT INTO zx_messages(userName,userEmail,feedback) VALUES ('$fname','$email','$info')");
			if($result){
			    $arr['flag']=1;//反馈成功
			}else{
			    $arr['flag']=2;//反馈失败
			}
		}	
	}
}
echo json_encode($arr);

