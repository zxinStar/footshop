<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>订餐系统</title>
    <link rel="stylesheet" href="css/jquery.mobile.css">
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/jquery.mobile.js"></script>
    <style>
        .foodBox tr td{text-align:center;}
        .foodBox tr td:first-child{width:50%;}
        .foodBox tr td:nth-child(2){width:20%;}
    </style> 
</head>
<body>
<template>
    <tr attr-footId="{{footId}}">
        <td class="footName">{{footName}}</td>
        <td class="footPrice" style="color:#ff261e;">
            <small>￥</small><price>{{footPrice}}</td>
        </td>
        <td class="number">{{number}}</td>
    </tr>
</template>
<div data-role="page">
    
    <header data-role="header">
        <a href="#" data-role="button" data-icon="back" data-rel="back" data-iconpos="notext">后退</a>
        <h1>结算中心</h1>
        <a href="index.html" data-icon="home" data-iconpos="notext">首页</a>
    </header><!--头部-->

    <main data-role="content">
        <table>
            <thead>
                <th>菜名</th>
                <th>单价/元</th>
                <th>数量/份</th>
            </thead>
            <tbody class="foodBox"></tbody>
        </table>
        <hr>
        <h2 style="color: red;text-align: right;">总计: <label id="sumprice"></label></h2>
        <div id="payInfo">
            <form id="orderForm" data-ajax="false">
                    <div data-role="fieldcontain">
                        <label for="eatName">订餐人：</label>
                        <input type="text" name="eatName" id="eatName" placeholder="请输入您的名字" pattern="[\u4e00-\u9fa5_a-zA-Z0-9_]{2,8}" required>
                        <label for="eatTel">联系方式：</label>
                        <input type="tel" name="eatTel" id="eatTel" placeholder="请输入您的手机号码" required pattern="(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$">
                        <label for="eatTime">到店时间：</label>
                        <input type="datetime-local" name="eatTime" id="eatTime" required/>
                        <label for="eatNum">用餐人数：</label>
                        <input type="number" name="eatNum" id="eatNum" placeholder="请输入用餐人数" required>
                        <label for="memo">备注：</label>
                        <textarea name="memo" id="memo" placeholder="请备注您的口味！"></textarea>  
                    </div>
                    <button class="payBtn">支付宝付款</button>
            </form>
            <!-- <p>请选择支付方式：</p> -->
            <!-- <button class="payBtn">支付宝付款</button> -->
            <!-- <button>到店支付</button> -->
        </div>
        
    </main><!--内容-->

    <script>
        $(document).on('pageinit',function(){
            $.get('data/isKey.php',{flag:1},function(data){
                if (data){
                    $('#eatName').val(data.loginName);
                    $('#eatTel').val(data.userTel);
                    var userId = data.userId;
                    var param = {
                        userId:userId
                    }
                    var $foodBox = $('.foodBox');
                    $.post('data/userShowCart.php',param,function(data){
                        $foodBox.empty();
                        var classHtml=$('template').html();
                        if(data.flag==1){
                            $foodBox.hide();
                            $('#payInfo').hide();
                            $('.ui-content').html('<p style="text-align:center;">当前没有要结算的菜品哦，快去点餐吧！</p>');
                        }else{
                            $.each(data.message, function () {
                                $(classHtml.replace('{{footId}}',this.footId)
                                           .replace('{{footName}}',this.footName)
                                           .replace('{{footPrice}}',this.footPrice)
                                           .replace('{{number}}',this.orderNum)).appendTo($foodBox);
                            });

                            //合计商品数量和价格
                            var trs = $('.foodBox tr');
                            function total() {
                                var sum = 0, num = 0, insetImg = '';
                                $.each(trs, function () {
                                    num=parseInt($(this).find(".number").text());
                                    sum+=parseFloat($(this).find("price").text())*num;
                                });
                                $('#sumprice').html(sum.toFixed(2));
                            }
                            total();
                    
                            $('form#orderForm').submit(function () {
                                if($('#eatTel').val() != ''){
                                    var param = {
                                        eatName:$('#eatName').val(),
                                        eatTel:$('#eatTel').val(),
                                        eatNum:$('#eatNum').val(),
                                        eatTime:$('#eatTime').val(),
                                        memo:$('#memo').val(),
                                        userId:userId
                                    };
                                    $.post('data/addOrder.php', param, function (data) {
                                        switch (data.flag) {
                                            case 3:
                                                $.each(trs, function () {
                                                    var param2 = {
                                                        footName:$(this).find('.footName').text(),
                                                        orderNum:$(this).find('.number').text(),
                                                        footPrice:$(this).find('price').text(),
                                                        footId:$(this).attr('attr-footId'),
                                                        userId:userId,
                                                        orderId:data.message.orderId
                                                    };
                                                    $.post('data/payCart.php', param2, function (data) {
                                                        switch (data.flag) {
                                                            case 2:
                                                                alert("支付失败，请检查您的网络!");
                                                                return false;
                                                            }
                                                    }, 'json');
                                                });
                                                alert("支付成功，请按时到店就餐！");
                                                break;
                                            case 2:
                                                alert("支付失败，请检查您的网络!");
                                                break;
                                        }
                                        window.location.href="myOrder.php";
                                    }, 'json');
                                }
                                else {
                                    alert("联系方式不能为空！");
                                }
                                return false;
                            });    
                        } 
                    },'json'); 
                }else{
                    location.href = "login.php";
                }
            },'json')
        });
    </script>
</div>

</body>
</html>
