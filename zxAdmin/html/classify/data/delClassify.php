<?php
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");

$id=trim($_POST['id']);

$result=$link->exec("DELETE FROM zx_classifys WHERE classiifyId='$id'");
    if($result){
        $arr=1;//分类删除成功
    }else{
        $arr=2;//分类删除失败
    }
echo $arr;
$link=null;