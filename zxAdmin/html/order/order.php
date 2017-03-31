<!DOCTYPE html>
<html lang="en">
<?php include("../common/header.php"); ?>
<body class="no-skin">
<style>
#page{display:flex;background:#eff3f8;clear:both;padding:6px 0;}
#page div{flex:1;padding:2px 4px;}
#page div span{text-align:left;margin-left:10px;cursor:pointer;margin-top:4px;}
#page div:nth-child(3){text-align:right;margin-right:10px;}
#page ul{list-style:none;margin:0;}

#printmeBody div{width:500px;}
#printmeBody div p{display:flex;border-bottom:1px solid #e9e9e9;padding-bottom:10px;}
#printmeBody div p span{flex:1;display:inline-block;text-align:center;}
/*#page ul li{display:inline-block;background:#fff;border:1px solid #eee;padding:2px 4px;}*/
</style>
<template id="orderInfo">
	<tr>
		<td>{{orderNo}}</td>
		<td>{{eatName}}</td>
		<td>{{eatTel}}</td>
		<td>{{eatNum}}</td>
		<td>{{eatTime}}</td>
		<td>{{memo}}</td>
		<td>
			<div class="btn-group">
				<button class="btn btn-xs btn-success see" title="查看菜单" attr-id="{{orderId}}">
					<i class="ace-icon fa fa-search-plus bigger-130"></i>
				</button>
				<button class="btn btn-xs btn-danger del" title="取消订单" attr-id="{{orderId}}">
					<i class="ace-icon fa fa-trash-o bigger-130"></i>
				</button>
			</div>
		</td>
	</tr>
</template>

<template id="print">
	<p>
		<span>{{footname}}</span>
		<span class="price">{{footPrice}}</span>
		<span class="number">{{orderNum}}</span>
	</p>
</template>

	<?php include("../common/navbar.php"); ?>
	<!-- /section:basics/navbar.layout -->
	<div class="main-container" id="main-container">
		<script type="text/javascript">
			try{ace.settings.check('main-container' , 'fixed')}catch(e){}
		</script>

		<!-- #section:basics/sidebar -->
		<?php include("../common/sidebar.php"); ?>

		<!-- /section:basics/sidebar -->
		<div class="main-content">
			<!-- #section:basics/content.breadcrumbs -->
			<div class="breadcrumbs" id="breadcrumbs">
				<script type="text/javascript">
					try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
				</script>

				<ul class="breadcrumb">
					<li>
						<i class="menu-icon fa fa-bar-chart-o"></i>
						<a href="#">订单管理</a>
					</li>
				</ul><!-- /.breadcrumb -->
			</div>

			<!-- /section:basics/content.breadcrumbs -->
			<div class="page-content">
				<!-- /section:settings.box -->
				<div class="page-content-area">
					<div class="row">
					<div class="col-xs-12">
						<table id="orderTable" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="center">订单编号</th>
								<th class="center">订餐人</th>
								<th class="center">联系方式</th>
								<th class="center">就餐人数</th>
								<th class="center">就餐时间</th>
								<th class="center">备注</th>
								<th class="center">操作</th>
							</tr>
						</thead>
						<tbody class="center"></tbody>
						</table>
					</div><!-- /.span -->
					<nav id="page"></nav>
					</div><!-- /.row -->
				</div><!-- /.page-content-area -->
			</div><!-- /.page-content -->
		</div><!-- /.main-content -->

		<div class="footer">
			<div class="footer-inner">
				<!-- #section:basics/footer -->
				<div class="footer-content">
					<span class="bigger-120">
						鑫茜里西餐订餐管理系统 &copy; 2016-2017
					</span>
				</div>
				<!-- /section:basics/footer -->
			</div>
		</div>

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>

		<div class="ui-widget-overlay ui-front  hidden" style="z-index: 2!important;"></div>
    	<section id="dialogsd" class="center hidden" style="position:absolute;z-index: 3;padding:10px;top:20%;left:calc(50% - 200px);border:1px solid #ddd;background-color: #fff;">
			<h6>打印预览</h6>
	        <div id="printmeBody">
	        	<p class="sales">总计:222.00元</p>
				<div>
					<p>
						<span>菜名</span>
						<span>单价(元)</span>
						<span>数量(份)</span>
					</p>
				</div>
	            <div class="addPrint"></p>
	        </div>
	        <div class="row">
	            <button class="btn btn-xs btn-warning" onclick="colseDialogsd()">
	                <i class="ace-icon fa fa-undo icon-on-right bigger-110"></i>
	                <span class="hidden-sm hidden-xs">取消</span>
	            </button>
	            <button class="btn btn-xs btn-primary" onclick="printme()">
	                <i class="ace-icon glyphicon glyphicon-th-list bigger-120"></i>
	                <span class="hidden-sm hidden-xs">打印</span>
	            </button>
	        </div>
    	</section>
	</div><!-- /.main-container -->

	<!-- basic scripts -->
	<?php include("../common/footer.php"); ?>

	<!-- page specific plugin scripts -->
	<script>
		/*给导航添加*/
		$('.nav-list li').eq(9).addClass("active");
	</script>
	
	<!-- ace scripts -->
	<!-- inline scripts related to this page -->
	<script src="js/order.js"></script>
</body>
</html>