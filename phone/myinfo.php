<!DOCTYPE html>
<html lang="en">
    <?php include("common/head.php"); ?>
<body>
<div data-role="page">
    <?php include("common/header.php"); ?>

    <section style="text-align:center;background-color:#4083c3;padding:10px;color:#fff">
        <img src="img/head.jpg" alt="头像" style="width: 80px;height: 80px;border-radius: 50%">
        <h3 id="title"></h3>
    </section>

    <main data-role="content">
        <ul data-role="listview">
            <li><a onclick="javascript:window.location.href='myOrder.php'">我的订单</a></li>
            <li><a onclick="javascript:window.location.href='cart.php'">购物车</a></li>
        </ul>
        <ul data-role="listview" style="margin-top: 30px">
            <li><a onclick="javascript:window.location.href='perinfo.php'">个人信息</a></li>
            <li><a onclick="javascript:window.location.href='contUs.php'">联系我们</a></li>
            <li><a href="#" data-icon="gear" id="exit">注销</a></li>
        </ul>
    </main><!--内容-->

    <?php include("common/footer.php"); ?>

    <script>
        //获取userName
        $(document).on('pageinit',function(){
            $.get('data/isKey.php',{flag:1},function(data){
                if (data){
                    $('h3#title').html("欢迎你："+ data.loginName)
                }else {
                    window.location.href='login.php';
                    window.close();
                }
            },'json')
        });

        //注销
        $('a#exit').on('tap',function(e){
            e.preventDefault();
            $.get('data/isKey.php',{flag:2},function(data){
                if (data){
                    location.reload()//刷新页面
                }
            },'text')
        })
    </script>
</div>

</body>
</html>