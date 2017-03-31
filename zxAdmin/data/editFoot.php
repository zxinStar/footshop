<?php
header("Content-Type:text/html; charset=utf-8");

        $footId=trim($_REQUEST['id']);
        $footName=trim($_REQUEST['fName']);
        $classify=trim($_REQUEST['sClass']);
        $footNum=trim($_REQUEST['fNum']);
        $footPrice=trim($_REQUEST['fPrice']);
       
        $link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
        $link->query("set names utf8");
        $result=$link->exec("UPDATE foot SET classify='$classify',footName='$footName',footNum='$footNum',footPrice='$footPrice' WHERE footId='$footId'");

        if($result){
            $arr['flag']=1;//菜品修改成功
        }else {
            $arr['flag']=2;//菜品修改失败
        }
        echo json_encode($arr);
        $link=null;
