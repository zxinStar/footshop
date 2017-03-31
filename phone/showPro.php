<?php        
   session_start();//将session中的商品信息(即购物车中的商品)和总价显示到页面
    
    if(!isset($_SESSION['goods'])){ 
      $_SESSION['goods'] = array(); //session销毁之后变为空   
    }else{
        $goods = $_SESSION['goods'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include("common/head.php"); ?>
<body>
<template>
<figure>
    <a href="#" target="_top">
        <img src="../zxAdmin/files/{{path}} ?>">
    </a>
    <figcaption>
        <p>{{footName}}</p>
        <div>
            <price>￥{{footPrice}}</price>
            <a onclick="addCart(this);" class="addCart" href="#" data-footId="{{footId}}" data-src="{{path}}" data-footName="{{footName}}" data-footPrice="{{footPrice}}"data-role="button" data-icon="plus" data-iconpos="notext" style="margin-top:-.4em">
            <span class="ui-btn-inner">
              <span class="ui-btn-text">+</span>
              <span class="ui-icon ui-icon-plus ui-icon-shadow"></span>
            </span>
            </a>
        </div>
    </figcaption>
</figure>
</template>
<div data-role="page">
    <ul id="goods" class="listview" style="display: none;">
        <?php if(count($goods)==0){ ?>
            <input type="hidden" id="noGoods" value="0">
        <?php }else{
            foreach ($goods as $value) { ?>
            <li>
                <input type="hidden" class="footId" value="<?php echo $value['footId'] ?>">
                <input type="hidden" class="orderNum" value="<?php echo $value['number'] ?>">
            </li>
        <?php }} ?>
    </ul>

    <header data-role="header">
        <a href="#" data-role="button" data-icon="back" data-rel="back" data-iconpos="notext">后退</a>
        <h1>茜茜里西餐厅欢饮您</h1>
        <a href="#pagetwo" data-icon="search" data-iconpos="notext" data-rel="dialog">搜索</a>
    </header>

    <main data-role="content">
      <div class="mainCont">
        <!-- <section class="conLeft" data-position="fixed" style="left:0;tight:80px;">
            <?php
                // 获取数据
                $link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
                $link->query("set names utf8");
                $results=$link->query("select classify from zx_classifys");
                while ($rows=$results->fetch()){
                    $arry[]=$rows;
                };
                $link=null;
            ?>
        <ul>
            <?php foreach ($arry as $keys=>$values) {?>
                <li><a href="#"><?php echo $values['classify'] ?></a></li>
            <?php } ?>
        </ul>
        </section> -->
    
        <section class="conRight">
            <?php
                // 获取数据
                $link=new PDO("mysql:host=localhost;dbname=zx__ordsystem","root","");
                $link->query("set names utf8");
                $result=$link->query("select footId,path,footName,footPrice from zx_foots");
                while ($row=$result->fetch()){
                    $food[]=$row;
                };
                $link=null;
            ?>
            <?php foreach ($food as $key=>$value) {?>
                <figure>
                    <a href="#" target="_top">
                        <img src="../zxAdmin/files/<?php echo $value['path'] ?>" alt="<?php echo $value['footName'] ?>">
                    </a>
                    <figcaption>
                        <p><?php echo $value['footName'] ?></p>
                        <div>
                            <price>￥<?php echo $value['footPrice'] ?></price>
                            <a onclick="addCart(this);" class="addCart" href="#" data-footId="<?php echo $value['footId'] ?>" data-src="<?php echo $value['path'] ?>" data-footName="<?php echo $value['footName'] ?>" data-footPrice="<?php echo $value['footPrice'] ?>"data-role="button" data-icon="plus" data-iconpos="notext" style="margin-top:-.4em">+</a>
                        </div>
                    </figcaption>
                </figure>
            <?php } ?>
        </section>
      </div>
        
      <div id="exitSearch">退出搜索</div>
    </main><!--内容-->

    <?php include("common/footer.php"); ?>

    <link rel="stylesheet" href="css/showPro.css">
</div>

<div data-role="page" id="pagetwo">
  <div data-role="header">
    <h1>搜索菜品</h1>
  </div>

  <div data-role="content">
      <form id="searchForm" data-ajax="false">
          <div data-role="fieldcontain">
              <label for="footName">菜品名称：</label>
              <input type="text" name="footName" id="footName" placeholder="请输入菜品名称">
              <label for="classify">菜品类别：</label>
              <input type="text" name="classify" id="classify" placeholder="请输入菜品类别">
              <label for="footPrice">菜品单价：</label>
              <input type="text" name="footPrice" id="footPrice" placeholder="请输入菜品单价,如45">
          </div>
          <button>搜索</button>
      </form>
  </div>
</div> 
<script src="js/jquery-1.8.3.min.js"></script>
<script>
  $.get('data/isKey.php',{flag:1},function(data){
    if (data){
      $("ul#goods li").each(function(){
        var param = {
          num:0,
          footId:$(this).find('.footId').val(),
          orderNum:$(this).find('.orderNum').val(),
          userId:data.userId
        }
        $.post('data/addCart.php',param,function(data){
          switch(data.flag){
            case 4:
                alert("请检查您的网络！");
                break;
          }
        },'json');
      });
    }
  },'json'); 
  function addCart(obj){
      var footId = $(obj).attr('data-footId');
      var footName = $(obj).attr('data-footName');
      var path = $(obj).attr('data-src');
      var footPrice = $(obj).attr('data-footPrice');
    
      $.get('data/isKey.php',{flag:1},function(data){
          if (data){
                     var param = {
                         num:1,
                         footId:footId,
                         userId:data.userId
                     }
                     console.log(param);
                     $.post('data/addCart.php',param,function(data){
                        console.log(data.flag);
                        switch(data.flag){
                          case 5:
                              alert("已成功添加至购物车！");
                              break;
                          case 3:
                              alert("已成功添加至购物车！");
                              break;
                          default:
                            alert("请检查您的网络！");
                            break;
                        }
                     },'json');
          }else{
            var json = {// 组装发送参数
                flag:1,
                footId:footId,
                footName:footName,
                path:path,
                footPrice:footPrice
            }; 
            console.log(json);
            $.post('data/showCart.php',json,function(data){
              console.log(data);
                alert("已成功添加至购物车！");
            },'json');
          }
      },'json'); 
      return false;
  }
  $('#exitSearch').hide();
  $('#exitSearch').click(function(){
    window.location.reload();
  });
  //搜索
  $('form#searchForm').submit(function(){
        $.post('data/searchFood.php',$('form#searchForm').serialize(),function(data){
          console.log(data);
          if(data.flag==0){
            alert("当前条件查询不到菜品，请重新输入查询条件！");
          }else{
            var $ftbody = $('.conRight');
            $ftbody.empty();
            var classHtml = $('template').html();
            $.each(data.list, function () {
              $(classHtml.replace(/\{\{footName\}\}/g, this.footName)
                  .replace(/\{\{path\}\}/g, this.path)
                  .replace(/\{\{footPrice\}\}/g, this.footPrice)
                  .replace(/\{\{footId\}\}/g, this.footId)).appendTo($ftbody);
              });
            $('#exitSearch').show();
            addCart(obj);
          }
        },'json');
    })
</script>
</body>
</html>