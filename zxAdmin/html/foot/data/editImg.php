<?php
header("Content-Type:text/html; charset=utf-8");
$filename=$_FILES['file']['name'];
$tmpname=$_FILES['file']['tmp_name'];
$arrname=explode(".",$filename);//将$filename以.为界划分，组成一个数组
//规定能上传的文件类型
$fileType=array('jpg','png','gif','jpeg');
if(in_array($arrname[1], $fileType)){
    function randName($len){//随机产生文件名
        $randN="Z-";//以Z-开头
        $char="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        for ($i=0;$i<$len;$i++){
            $randN.=$char[mt_rand(0,strlen($char)-1)];
        }
        return $randN;
    }

    do{//判断是否有重名
        $arrname[0]=randName(6);
        $newfn=implode(".", $arrname);
        $newfname="../../../files/".$newfn;
    }while (file_exists($newfname));
    $flag=move_uploaded_file($tmpname,$newfname);
    if($flag){//如果图片上传成功，则将数据加入数据库中
        $footId=trim($_REQUEST['footId']);
       
        $link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
        $link->query("set names utf8");
        $result=$link->exec("UPDATE zx_foots SET imgsrc='$filename',path='$newfn' WHERE footId='$footId'");      
        if($result){
            echo "新的菜品图片上传成功！";
        }else {
            echo "新的菜品图片上传失败！";
        }
        $link=null;
    }
}else {
    echo "亲，你选择的图片格式不对，请选择".implode('、', $fileType)."的图片类型！";
}