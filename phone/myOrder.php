k<!DOCTYPE html>
<html lang="en">
    <?php include("common/head.php"); ?>
<body>
<div data-role="page">    
    <?php include("common/header.php"); ?>

    <main data-role="content" id="myOrder">
    </main><!--内容-->

    <?php include("common/footer.php"); ?>
    <script>
    $(document).on('pageinit',function(){
            $.get('data/isKey.php',{flag:1},function(data){
                if (data){
                    var userId = data.userId;
                    var param = {
                        userId:userId
                    }
                    var $cartBox=$('#cartBox');
                    $('#myOrder').html('<p style="text-align:center;">您目前没有订单，快去下单吧！</p>');
                    $.post('./data/showMyOreder.php',param,function(data){
                        if(data){
                            var str = '';
                            $.each(data.message, function () {
                                if(this.memo == ''){
                                    this.memo='无';
                                }
                                str +='<ul data-role="listview" class="cartBox">'
                                    + '<p class="orderListTop">'
                                    +'<time>'+this.eatTime+'</time>';
                                if(this.tag == 0){
                                    var tag = '';
                                }else{
                                    var tag = '订单已取消';
                                    str += '<span>状态：'+tag+'</span>';
                                }
                                str +='</p>';
                                $.each(this.foot,function(){
                                    str += '<li>'
                                        +' <img src="../zxAdmin/files/Z-0G5R72.jpg" style="width:80px;height:80px;object-fit:cover;margin:10px 6px">'
                                        +'<h2>'+this.footname+'</h2>'
                                        +'<p style="display:flex;justify-content: space-between">'
                                        +'<span style="color:#ff261e;font-size:1rem;line-height: 38px">'
                                        +'<small>￥</small><price>'+this.footPrice+'</price>'
                                        +'</span>'
                                        +'<label class="num" style="display:flex;justify-content: space-between">'+this.orderNum+'</label>'
                                        +'</li>';
                                })
                                str +='<div class="orderListBot">'
                                    +'<aside>备注:'+this.memo+'</aside>'
                                    +'<totalPrice>总计:<span></span></totalPrice>'
                                    +'</div></ul>';
                            });
                            $('#myOrder').html(str);

                            var lis = $('.cartBox li');
                            total(lis);
                        }
                    },'json');
                }else{
                    
                }
            },'json')
        });
        
        //合计商品数量和价格
        function total(obj) {
            $('.cartBox').each(function(){
                var sum = 0, num = 0, insetImg = '';
                var lis = $(this).find('li');
                $.each(lis, function () {
                    num=parseInt($(this).find(".num").text());
                    sum+=parseFloat($(this).find("price").text())*num;
                });
                $(this).find('totalPrice span').html(sum.toFixed(2));
            })
        }
    </script>
</div>

</body>
</html>
