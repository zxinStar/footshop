<?php
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");

$flag=trim($_POST['flag']);
$id=trim($_POST['id']);

if($flag == 1){
    $classify=trim($_POST['classify']);
    $blurb=trim($_POST['blurb']);

    $result=$link->exec("UPDATE zx_classifys SET classify='$classify',blurb='$blurb' WHERE classiifyId='$id'");       
        if($result){
            $arr=2;//分类编辑成功
        }else {
            $arr=3;//分类编辑失败
        }
    //判断修改是否重名，存在逻辑问题   
    /*$check=$link->query("select classify from zx_classifys where classify='$classify'");   
    $row=$check->fetch();
    if($row){
        $arr=1;//该分类已存在
    }else {
        $result=$link->exec("UPDATE zx_classifys SET classify='$classify',blurb='$blurb' WHERE classiifyId='$id'");       
        if($result){
            $arr=2;//分类编辑成功
        }else {
            $arr=3;//分类编辑失败
        }
    }*/
}else{  
    $result=$link->exec("DELETE FROM zx_classifys WHERE classiifyId='$id'");
    if($result){
        $arr=4;//分类删除成功
    }else{
        $arr=5;//分类删除失败
    }
}
echo $arr;
$link=null;