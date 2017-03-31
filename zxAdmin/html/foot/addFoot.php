<!DOCTYPE html>
<html lang="en">
<?php include("../common/header.php"); ?>
<body class="no-skin">
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
						<i class="menu-icon fa fa-cutlery"></i>
						<a href="#">菜品管理</a>
					</li>
					<li class="active">
						<a href="#">新增菜品</a>
					</li>
				</ul><!-- /.breadcrumb -->
			</div>

			<!-- /section:basics/content.breadcrumbs -->
			<div class="page-content">
				<div class="row">
					<form class="form-horizontal" role="form" id="addFoot">
						<div class="col-xs-8 col-xs-offset-1">
							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="footName">菜品名称: </label>
								<div class="col-xs-12 col-sm-9">
									<div class="clearfix">
										<input type="text" name="footName" id="footName" placeholder="请输入菜品名称" class="col-xs-12" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="selClass">菜品类别: </label>
								<div class="col-xs-12 col-sm-9">
									<div class="clearfix">
										<select class="chosen-select" id="selClass" name="classify" data-placeholder="请选择菜品类别"></select>
									</div>					
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="footNum">数量(个): </label>
								<div class="col-xs-12 col-sm-9">
									<div class="clearfix">
										<input type="number" name="footNum" id="footNum" placeholder="请输入菜品数量" class="col-xs-12" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="footPrice">单价(元): </label>
								<div class="col-xs-12 col-sm-9">
									<div class="clearfix">
										<input type="text" name="footPrice" id="footPrice" placeholder="请输入菜品单价" class="col-xs-12" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="addClass">菜品图片: </label>
								<div class="col-xs-12 col-sm-9">
									<div class="clearfix">
										<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
										<input multiple="" type="file" id="imgfile" class="form-control" name="file"/>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix form-actions col-xs-12">
							<div class="col-md-offset-4 col-md-8">
								<button class="btn" type="reset">
									<i class="ace-icon fa fa-undo bigger-110"></i>
									取消
								</button>
								&nbsp; &nbsp; &nbsp;
								<button class="btn btn-info" type="submit">
									<i class="ace-icon fa fa-check bigger-110"></i>
									添加新类别
								</button>
							</div>
						</div>
					</form>
				</div>
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
	<script src="../../assets/js/jquery.validate.min.js"></script>
	<script src="../../assets/js/chosen.jquery.min.js"></script><!-- input select -->
	<script src="./js/ajaxfileupload.js"></script><!-- 图片上传 -->
	<script src="./js/addFoot.js"></script>	
	<script>
		/*给导航添加*/
		$('.nav-list .foot').addClass("active open");
		$('.nav-list .foot').find('li').eq(0).addClass("active");

		//上传菜品图片
		$('#imgfile').ace_file_input({
			style:'well',
			btn_choose:'请选择菜品图片上传',
			btn_change:null,
			no_icon:'ace-icon fa fa-cloud-upload',
			droppable:true,
			thumbnail:'large',
		});
	</script>
</body>
</html>