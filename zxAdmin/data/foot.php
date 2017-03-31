<?php
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");
$flag=$_GET['flag'];
if($flag==1){
    $curPage=$_GET['curPage'];
    $recStar=$curPage*8;
    $result=$link->query("select * from foot");
    $rows=$result->rowCount();//总记录输
    $arr['total']=$rows;

    $result=$link->query("select * from foot order by footId desc limit $recStar,8");
    while ($row=$result->fetch()){
        $arr['list'][]=$row;
    }
}else if($flag==2){
    $id=$_GET['id'];
    $result=$link->exec("DELETE FROM foot WHERE footId='$id'");
    if($result){
        $arr['flag']=1;//分类删除成功
    }else{
        $arr['flag']=2;//分类删除失败
    }
}else if($flag==3){
     $id=$_GET['id'];
     $result=$link->query("select * from foot where footId='$id'");
     while ($row=$result->fetch()){
        $arr[]=$row;
     }
 }
echo json_encode($arr);
$link=null;
