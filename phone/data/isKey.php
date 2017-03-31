<?php
$flag=$_GET['flag'];
session_start();
if($flag==1){
    if(isset($_SESSION['key'])){
        echo json_encode($_SESSION['key']);
    }
}else if($flag==2){
    if(isset($_SESSION['key'])){
        session_destroy();
        echo true;
    }
}
?>