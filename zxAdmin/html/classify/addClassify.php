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
						<i class="menu-icon fa fa-list"></i>
						<a href="#">菜品分类</a>
					</li>
					<li class="active">
						<a href="#">新增分类</a>
					</li>
				</ul><!-- /.breadcrumb -->
			</div>

			<!-- /section:basics/content.breadcrumbs -->
			<div class="page-content">
				<div class="row">
					<div class="col-xs-12">
						<form class="form-horizontal" role="form" id="addClassForm">
							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="addClass">菜品类别: </label>

								<div class="col-xs-12 col-sm-9">
									<div class="clearfix">
										<input type="text" name="addClass" id="addClass" placeholder="请输入菜品类别" class="col-xs-12 col-sm-7"/>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="addBlurb">类别简介: </label>

								<div class="col-xs-12 col-sm-7">
									<div class="clearfix">
										<textarea class="form-control col-xs-12 col-sm-6" name="addBlurb" id="addBlurb" rows="12" placeholder="请输入该类别的简介"></textarea>
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
	<script src="./js/classify.js"></script>
	<script>
		/*给导航添加*/
		$('.nav-list .classify').addClass("active open");
		$('.nav-list .classify').find('li').eq(0).addClass("active");
	</script>
</body>
</html>