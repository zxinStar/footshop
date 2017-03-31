<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>西餐订餐系统--注册/登录</title>
    <link rel="stylesheet" href="css/jquery.mobile.css">
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/jquery.mobile.js"></script>
</head>
<body>
<div data-role="page">
    <header data-role="header">
        <a href="#" data-role="button" data-icon="back" data-rel="back" data-iconpos="notext">后退</a>
        <h1>鑫茜里西餐厅</h1>
        <a href="index.html" data-icon="home" data-iconpos="notext">首页</a>
    </header><!--头部-->
    <figure style="margin:0 0 10px;background-color: #fff">
    <?php
        $footId=$_GET['id'];
        $link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
        $link->query("set names utf8");
        $result=$link->query("select * from foot where footId=$footId");
        $row=$result->fetch();
        $link=null;
    ?>
        <img src="../admin/files/<?php echo $row['path']?>" alt="" style="width:100%;max-height:250px;object-fit:cover">
        <figcaption>
            <h4 style="margin:.2em .3em"><?php echo $row['footName']?></h4>
            <p style="display:flex;justify-content:space-between;margin:.4em 0;padding:4px 6px 8px;">
                <span>茜茜价:<price style="color:#ff2b3c;font-weight:bold">￥<?php echo $row['footPrice']?></price></span>
                <span style="color:#999;">评价:1044条</span>
            </p>
        </figcaption>
    </figure>

    <main data-role="content">
        <ul data-role="listview">
            <li><a href="#">评价<span class="ui-li-count">1044</span></a></li>
            <li style="background-color:#fff">
                <p style="display:flex;justify-content:space-between;">
                    <span>zxzxzx</span>
                    <span style="color:#999">2016.02.20</span>
                </p>
                <p style="font-size:0.8rem;margin:0;color:#666">很好；非常美味！</p>
            </li>
            <li style="background-color:#fff">
                <p style="display:flex;justify-content:space-between;">
                    <span>zxzxzx</span>
                    <span style="color:#999">2016.02.20</span>
                </p>
                <p style="font-size:0.8rem;margin:0;color:#666">很好；非常美味！</p>
            </li>
            <li style="background-color:#fff">
                <p style="display:flex;justify-content:space-between;">
                    <span>zxzxzx</span>
                    <span style="color:#999">2016.02.20</span>
                </p>
                <p style="font-size:0.8rem;margin:0;color:#666">很好；非常美味！</p>
            </li>
        </ul>

    </main><!--内容-->

        <footer data-role="footer" data-position="fixed">
            <div data-role="navbar" data-iconpos="top">
                <ul>
                    <li><a href="index.html"  target="_top" data-icon="home">主页</a></li>
                    <li><a href="brand.php"  target="_top" data-icon="more">品牌</a></li>
                    <li><a href="showPro.php"  target="_top" class="ui-btn-active" data-icon="grid">菜品</a></li>
                    <li><a href="cart.php"  target="_top" data-icon="check">购物车</a></li>
                    <li><a href="myinfo.php"  target="_top" data-icon="info">信息</a></li>
                </ul>
            </div>
        </footer><!--尾部-->

</div>

</body>
</html>