<?php        
   session_start();//将session中的商品信息(即购物车中的商品)和总价显示到页面
    
    if(!isset($_SESSION['goods'])){ 
      $_SESSION['goods'] = array(); //session销毁之后变为空   
    }else{
        $goods = $_SESSION['goods'];
    }
    //var_dump($goods);
?>
<!DOCTYPE html>
<html lang="en">
    <?php include("common/head.php"); ?>
<body>
<div data-role="page">
<style>
    .userList li{clear:both;}
    .userList li img{float:left;}
    .userList li h2{display:inline-block;margin:.8rem 0;}
    .userList li p{margin:0;}
    .userList li p label{margin-right:.2rem;}
    .userList li p button{border:1px solid #9e9e9e;border-radius:50%;width:30px;height:30px;margin-top:2px;}
    .userList li p .num{display:inline-block;margin-top:6px;}
</style>
<template>
    <li>
        <img src="../zxAdmin/files/{{path}}" style="width:80px;height:80px;object-fit:cover;margin:10px 6px">
        <h2 attr-path="{{path}}" attr-footId="{{footId}}">{{footName}}</h2>
        <p style="display:flex;justify-content: space-between">
            <span style="color:#ff261e;font-size:1rem;line-height: 38px">
                <small>￥</small><price>{{footPrice}}</price>
            </span>
            <label style="display:flex;justify-content: space-between">
                <button data-class="reduce" data-icon="minus" data-iconpos="notext">-</button>
                    <span class="num" style="width:20px;line-height:22px;padding:0;text-align: center;">{{orderNum}}</span>
                <button data-class="add"  data-icon="add" data-iconpos="notext">+</button>
            </label>
        </p>
    </li>
</template>
    
    <?php include("common/header.php"); ?>

    <main data-role="content">
        
        <ul data-role="listview" id="cartBox">
        <?php if(count($goods)==0){ ?>
            <p style="text-align: center;margin: 50px;">您的购物车空空的，赶紧去把它填满吧！</p>
        <?php }else{
            foreach ($goods as $value) { ?>
            <li>
                <img src="../zxAdmin/files/<?php echo $value['path'] ?>" style="width:80px;height:80px;object-fit:cover;margin:10px 6px">
                <h2 attr-path="<?php echo $value['path'] ?>" attr-footId="<?php echo $value['footId'] ?>"><?php echo $value['footName'] ?></h2>
                <p style="display:flex;justify-content: space-between">
                    <span style="color:#ff261e;font-size:1rem;line-height: 38px">
                        <small>￥</small><price><?php echo $value['footPrice'] ?></price>
                    </span>
                    <label style="display:flex;justify-content: space-between">
                        <button data-class="reduce" data-icon="minus" data-iconpos="notext"></button>
                        <span class="num" style="dispaly:inline-block;width:20px;line-height:22px;padding:0;text-align: center;margin-top:8px;"><?php echo $value['number'] ?></span>
                        <button data-class="add"  data-icon="add" data-iconpos="notext"></button>
                    </label>
                </p>
            </li>
        <?php }} ?>
        </ul>
    </main><!--内容-->

    <footer data-role="footer" data-position="fixed" style="display: flex;justify-content: space-between">
        <span style="line-height: 35px;padding: 0 6px">总计: <label id="sumprice">0</label></span>
        <a onclick="goOrder()" href="#" style="margin-right: 6px">去结算</a>
    </footer><!--尾部-->
    <script>
    $(document).on('pageinit',function(){
            $.get('data/isKey.php',{flag:1},function(data){
                if (data){
                    var userId = data.userId;
                    var param = {
                        flag:1,
                        userId:userId
                    }
                    var $cartBox=$('#cartBox');
                    $.post('data/userShowCart.php',param,function(data){
                        $cartBox.empty();//清空否则每次调用到多一倍tbody内容
                        if(data.flag==1){
                            $cartBox.html('<p style="text-align:center;">您的购物车空空的，赶紧去把它填满吧！</p>');
                        }else{
                            var classHtml=$('template').html();
                            $.each(data.message, function () {
                                $(classHtml.replace(/\{\{path\}\}/g,this.path)
                                           .replace('{{footId}}',this.footId)
                                           .replace('{{footPrice}}',this.footPrice)
                                           .replace('{{footName}}',this.footName)
                                           .replace('{{orderNum}}',this.orderNum)).appendTo($cartBox);
                            });
                            $('ul#cartBox').addClass("userList");
                            var lis = $('ul#cartBox li');
                            total(lis);
                            //加，减，删除单行商品
                            lis.delegate('button', 'click', function () {
                                var className = $(this).data('class');
                                var $input = $(this).parents('label').find(".num");
                                var num;
                                var $footName = $(this).parents('p').prev('h2');
                                var footId = $footName.attr('attr-footid');
                              
                                switch (className) {
                                    case 'reduce':
                                        if ($input.text() > '1') {
                                            num = $input.text();
                                            num--;
                                            $input.text(num);
                                            total(lis);
                                            var param = {
                                                num:2,
                                                userId:userId,
                                                footId:footId
                                            }
                                            $.post('data/addCart.php',param,function(data){
                                                console.log(data);
                                            },'json');
                                        }
                                        else {
                                            if (confirm("只剩一件商品了，您确定删除吗?")) {
                                                var param = {
                                                    num:3,
                                                    userId:userId,
                                                    footId:footId
                                                }
                                                $.post('data/addCart.php',param,function(data){
                                                    console.log(data);
                                                },'json');
                                                location.reload();
                                            }
                                        }
                                        total(lis);
                                        break;
                                    case 'add':
                                        num = $input.text();
                                        num++;
                                        $input.text(num);
                                        total(lis);
                                        var param = {
                                            num:1,
                                            userId:userId,
                                            footId:footId
                                        }
                                        console.log(param);
                                        $.post('data/addCart.php',param,function(data){
                                            //console.log(data);
                                        },'json');
                                        break;
                                }
                            });
                        }
                    },'json');
                }else{
                    var lis = $('ul#cartBox li');
                    total(lis);
                    //加，减，删除单行商品
                    lis.delegate('button', 'click', function () {
                                var className = $(this).data('class');
                                var $input = $(this).parents('label').find(".num");
                                var num;
                                var price = $(this).parents('label').prev().find("price").text();
                                var $footName = $(this).parents('p').prev('h2');
                                var footName = $footName.text();
                                var footId = $footName.attr('data-footId');
                                var path = $footName.attr('data-path');

                                switch (className) {
                                    case 'reduce':
                                        if ($input.text() > '1') {
                                            num = $input.text();
                                            num--;
                                            $input.text(num);
                                            total(lis);
                                            var param = {
                                                flag:2,
                                                footName:footName,
                                                path:path,
                                                footId:footId,
                                                footPrice:price
                                            }
                                            $.post('data/showCart.php',param,'json');
                                        }
                                        else {
                                            if (confirm("只剩一件商品了，您确定删除吗?")) {
                                                var param = {
                                                    flag:3,
                                                    footName:footName,
                                                    path:path,
                                                    footId:footId,
                                                    footPrice:price
                                                }
                                                $.post('data/showCart.php',param,'json');
                                                location.reload();
                                            }
                                        }
                                        total(lis);
                                        break;
                                    case 'add':
                                        num = $input.text();
                                        num++;
                                        $input.text(num);
                                        total(lis);
                                        var param = {
                                            flag:1,
                                            footName:footName,
                                            path:path,
                                            footId:footId,
                                            footPrice:price
                                        }
                                        $.post('data/showCart.php',param,'json');
                                        break;
                                }
                            });
                }
            },'json')
        });
        
        //合计商品数量和价格
                            function total(obj) {
                                var sum = 0, num = 0, insetImg = '';
                                $.each(obj, function () {
                                    num=parseInt($(this).find(".num").text());
                                    sum+=parseFloat($(this).find("price").text())*num;
                                });
                                $('#sumprice').html(sum.toFixed(2));
                            }
        function goOrder(){
            window.location.href='order.php';
        }
    </script>
</div>

</body>
</html>
