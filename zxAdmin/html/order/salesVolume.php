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
</style>
<template id="orderInfo">
	<tr>
		<td>{{eatTel}}</td>
		<td>{{eatTime}}</td>
		<td>{{footname}}</td>
		<td>{{footPrice}}</td>
		<td>{{orderNum}}</td>
		<td>{{totalPrice}}</td>
	</tr>
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
						<i class="menu-icon fa fa-tag"></i>
						<a href="#">销量统计</a>
					</li>
				</ul><!-- /.breadcrumb -->
			</div>

			<!-- /section:basics/content.breadcrumbs -->
			<div class="page-content">
				<!-- /section:settings.box -->
				<div class="page-content-area">
					<div class="row">
						<div class="col-sm-12">
							<div class="widget-box">
								<div class="widget-header">
									<h4 class="widget-title">销量统计--搜索条件</h4>
									<span class="widget-toolbar">
										<a href="#" data-action="collapse">
											<i class="ace-icon fa fa-chevron-up"></i>
										</a>

										<a href="#" data-action="close">
											<i class="ace-icon fa fa-times"></i>
										</a>
									</span>
								</div>
								<div class="widget-body">
									<div class="widget-main" style="padding: 6px">
										<form class="row" id="searchForm">
											<div class="form-group col-xs-12 col-sm-4" style="margin: 0;">
												<label class="col-sm-3 no-padding-right">订餐时间:</label>
												<div class="input-daterange input-group col-sm-9">
													<input type="text" class="input-sm form-control" name="startTime" id="startTime" />
													<span class="input-group-addon">
														<i class="fa fa-exchange"></i>
													</span>
													<input type="text" class="input-sm form-control" name="endTime" id="endTime" />
												</div>
											</div>
											<div class="form-group col-xs-12 col-sm-3" style="margin: 0;">
												<label class="col-sm-4 no-padding-right">菜品名称:</label>
												<div class="input-group col-sm-8">
													<input type="text" class="input-sm form-control" name="footName" id="footName" />
												</div>
											</div>
											<div class="form-group col-xs-12 col-sm-3" style="margin: 0;">
												<label class="col-sm-3 no-padding-right">订餐人:</label>
												<div class="input-group col-sm-9">
													<input type="text" class="input-sm form-control" name="eatTel" id="eatTel" />
												</div>
											</div>
											<button id="btnSub" class="btn btn-purple btn-sm col-xs-1" style="margin:-2px 0 0 16px">
												搜索<i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
											</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<table id="orderTable" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th class="center">订餐人</th>
										<th class="center">订餐时间</th>
										<th class="center">菜品名称</th>
										<th class="center">单价(元)</th>
										<th class="center">数量</th>
										<th class="center">合计(元)</th>
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
	</div><!-- /.main-container -->

	<!-- basic scripts -->
	<?php include("../common/footer.php"); ?>

	<!-- page specific plugin scripts -->
	
	<script src="../../assets/js/date-time/bootstrap-datepicker.min.js"></script>

	<script>
		/*给导航添加*/
		$('.nav-list li').eq(10).addClass("active");
		$('.input-daterange').datepicker({autoclose:true});
	</script>
	<!-- inline scripts related to this page -->
	<script src="js/salesVolume.js"></script>
</body>
</html>