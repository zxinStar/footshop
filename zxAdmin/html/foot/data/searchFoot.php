<?php
$link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
$link->query("set names utf8");

$curPage=$_POST['curPage'];
$classify=$_POST['classify'];
$footPrice=$_POST['footPrice'];
$footName=$_POST['footName'];

    $recStar=$curPage*8;
    $result=$link->query("select footName,classify,path,footNum,footPrice,footId from zx_foots where footName like '%" .$footName. "%' and classify like '%" .$classify. "%' and footPrice like '%" .$footPrice. "%' ");

    $rows=$result->rowCount();//总记录输
    $arr['total']=$rows;
    $result=$link->query("select footName,classify,path,footNum,footPrice,footId from zx_foots where footName like '%" .$footName. "%' and classify like '%" .$classify. "%' and footPrice like '%" .$footPrice. "%' order by footId desc limit $recStar,8");
    $arr['flag']=0;
    if($result){
    	while ($row=$result->fetch()){
        	$arr['list'][]=$row;
        	$arr['flag']=1;
    	}
    }
    
echo json_encode($arr);
$link=null;