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
						<li class="active">
							<i class="ace-icon fa fa-home home-icon"></i>
							<a href="#">首页</a>
						</li>
					</ul><!-- /.breadcrumb -->
				</div>

				<!-- /section:basics/content.breadcrumbs -->
				<div class="page-content">
					
				</div><!-- /.page-content -->
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							鑫鑫西餐订餐管理系统 &copy; 2016-2017
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

		<script>
			/*给导航添加*/
			$('.nav-list li').eq(0).addClass("active");
		</script>
	</body>
</html>
