<?php
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");
$flag=$_GET['flag'];
if($flag==1){
    $result=$link->query("select * from addclassify order by id desc");
    while ($row=$result->fetch()){
        $arr[]=$row;
    }
}else if($flag==2){
    $id=$_GET['id'];
    $classify=$_GET['classify'];
    $blurb=$_GET['blurb'];
    $result=$link->exec("UPDATE addclassify SET classify='$classify',blurb='$blurb' WHERE id='$id'");
    if($result){
        $arr['flag']=2;//分类编辑成功
    }else {
        $arr['flag']=3;//分类编辑失败
    }
/*  判断修改是否重名，存在逻辑问题   
    $check=$link->query("select classify from addclassify where classify='$classify'");   
    $row=$check->fetch();
    if($row){
        $arr['flag']=1;//该分类已存在
    }else {
        $result=$link->exec("UPDATE addclassify SET classify='$classify',blurb='$blurb' WHERE id='$id'");       
        if($result){
            $arr['flag']=2;//分类编辑成功
        }else {
            $arr['flag']=3;//分类编辑失败
        }
    }
*/
}else if($flag==3){
    $id=$_GET['id'];  
    $result=$link->exec("DELETE FROM addclassify WHERE id='$id'");
    if($result){
        $arr['flag']=4;//分类删除成功
    }else{
        $arr['flag']=5;//分类删除失败
    }
}
echo json_encode($arr);
$link=null;