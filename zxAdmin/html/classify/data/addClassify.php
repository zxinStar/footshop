<?php
$classify=trim($_POST['addClass']);
$blurb=trim($_POST['addBlurb']);

$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");
$check=$link->query("select classify from zx_classifys where classify='$classify'");
$row=$check->fetch();
if($row){
    $arr['flag']=1;//该分类已存在
}else{
    $result=$link->query("INSERT INTO zx_classifys(classify,blurb) VALUES ('$classify','$blurb')");
    if($result){
        $arr['flag']=2;//添加分类成功
    }else{
        $arr['flag']=3;//添加分类失败
    }
}
echo json_encode($arr);
