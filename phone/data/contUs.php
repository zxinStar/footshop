<?php
$fname=trim($_POST['fname']);
$email=trim($_POST['email']);
$info=trim($_POST['info']);
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");
$result=$link->query("INSERT INTO messages(userName,userEmail,feedback) VALUES ('$fname','$email','$info')");
if($result){
    $arr['flag']=1;//反馈成功
}else{
    $arr['flag']=2;//反馈失败
}
echo json_encode($arr);