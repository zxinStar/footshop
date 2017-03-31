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
#printmeBody div,#classBody div,#imgBody div{width:500px;}
.chosen-single div b:before{display: none;}
#printmeBody div, #classBody div, #imgBody div{}
</style>
<template id="orderInfo">
	<tr>
		<td>{{footName}}</td>
		<td>{{classify}}</td>
		<td><img src="../../files/{{path}}" style="height: 50px;width: auto;"></td>
		<td>{{footNum}}</td>
		<td>{{footPrice}}</td>
		<td>
			<div class="btn-group">
				<button style="margin: 2px 4px;" class="btn btn-xs btn-success see" title="编辑菜品基本信息" attr-id="{{footId}}">
					<i class="ace-icon fa fa-pencil bigger-130"></i>信息
				</button>
				<button style="margin: 2px 4px;" class="btn btn-xs btn-success editClass" title="编辑菜品类别" attr-id="{{footId}}">
					<i class="ace-icon fa fa-pencil bigger-130"></i>类别
				</button><br>
				<button style="margin: 2px 4px;" class="btn btn-xs btn-success editImg" title="编辑菜品图片" attr-id="{{footId}}">
					<i class="ace-icon fa fa-pencil bigger-130"></i>图片
				</button>
				<button style="margin: 2px 4px;" class="btn btn-xs btn-danger del" title="删除菜品" attr-id="{{footId}}">
					<i class="ace-icon fa fa-trash-o bigger-130"></i>删除
				</button>
			</div>
		</td>
	</tr>
</template>
<template id="editFoot">
<div class="col-xs-12">
    <div class="form-group">
        <label class="control-label col-xs-2 no-padding-right" for="footName">菜品名称: </label>
        <input type="text" name="footName" id="footName" value="{{footname}}" class="col-xs-9" />
    </div>
    <div class="form-group">
        <label class="control-label col-xs-2 no-padding-right" for="footNum">数量(个): </label>
        <input type="number" name="footNum" id="footNum" value="{{footNum}}" class="col-xs-9" />
     </div>
    <div class="form-group">
        <label class="control-label col-xs-2 no-padding-right" for="footPrice">单价(元): </label>
		<input type="text" name="footPrice" id="footPrice" value="{{footPrice}}" class="col-xs-9" />
    </div>
    <input type="hidden" value="{{footId}}" id="footId">
</div>
</template>
<template id="tempImg">
	<form id="imgForm">
		<input type="hidden" name="footId" value="{{footId}}">
		<div class="form-group">
			<div class="clearfix">
			<input type="hidden" name="MAX_FILE_SIZE" value="20000000">
			<input multiple="" type="file" id="imgfile" class="form-control" name="file"/>
			</div>
		</div>
	</form>
</template>
<template id="tempClass">
	
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
						<i class="menu-icon fa fa-cutlery"></i>
						<a href="#">菜品管理</a>
					</li>
					<li class="active">
						<a href="#">菜品管理</a>
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
									<h4 class="widget-title">菜品管理--搜索条件</h4>
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
											<div class="form-group col-xs-12 col-sm-3" style="margin: 0;">
												<label class="col-sm-4 no-padding-right">菜品名称:</label>
												<div class="input-group col-sm-8">
													<input type="text" class="input-sm form-control" name="footName" id="footName" placeholder="请输入菜品名称" />
												</div>
											</div>
											<div class="form-group col-xs-12 col-sm-3" style="margin: 0;">
												<label class="col-sm-4 no-padding-right">菜品类别:</label>
												<div class="input-group col-sm-8">
													<input type="text" class="input-sm form-control" name="classify" id="classify" placeholder="请输入菜品类别" />
												</div>
											</div>
											<div class="form-group col-xs-12 col-sm-3" style="margin: 0;">
												<label class="col-sm-4 no-padding-right">菜品单价:</label>
												<div class="input-group col-sm-8">
													<input type="text" class="input-sm form-control" name="footPrice" id="footPrice" placeholder="请输入菜品单价,如45"/>
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
										<th class="center">菜品名称</th>
										<th class="center">菜品类别</th>
										<th class="center">菜品图片</th>
										<th class="center">数量(个)</th>
										<th class="center">单价(元)</th>
										<th class="center">操作</th>
									</tr>
								</thead>
								<tbody class="center"></tbody>
							</table>
						</div><!-- /.col -->
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
	<!-- <script src="../../assets/js/jquery.validate.min.js"></script>
	<script src="../../js/classify.js"></script> -->
	<div class="ui-widget-overlay ui-front  hidden" style="z-index: 2!important;"></div>
	<section id="dialogsd" class="center hidden dialogsd" style="position:absolute;z-index: 3;padding:10px;top:20%;left:calc(50% - 200px);border:1px solid #ddd;background-color: #fff;">
        <div id="printmeBody">
            
        </div>
        <div class="row" style="padding: 10px;clear: both;">
            <button class="btn btn-xs btn-warning" onclick="colseDialogsd()">
                <i class="ace-icon fa fa-undo icon-on-right bigger-110"></i>
                <span class="hidden-sm hidden-xs">取消</span>
            </button>
            <button class="btn btn-xs btn-primary" onclick="subInfo()">
                <i class="ace-icon fa fa-check bigger-120"></i>
                <span class="hidden-sm hidden-xs">确定</span>
            </button>
        </div>
	</section>
	<section id="dialogsdClass" class="center hidden dialogsd" style="position:absolute;z-index: 3;padding:10px;top:20%;left:calc(50% - 200px);border:1px solid #ddd;background-color: #fff;">
		<h2>修改菜品类别</h2>
        <div id="classBody">
		    <div class="clearfix">
		        <select class="chosen-select" id="selClass" name="classify" data-placeholder="请选择菜品类别"></select>
		    </div>                  
        </div>
        <div class="row" style="padding: 10px;clear: both;">
            <button class="btn btn-xs btn-warning" onclick="colseDialogsd()">
                <i class="ace-icon fa fa-undo icon-on-right bigger-110"></i>
                <span class="hidden-sm hidden-xs">取消</span>
            </button>
            <button class="btn btn-xs btn-primary subClass">
                <i class="ace-icon fa fa-check bigger-120"></i>
                <span class="hidden-sm hidden-xs">确定</span>
            </button>
        </div>
	</section>
	<section id="dialogsdImg" class="center hidden dialogsd" style="position:absolute;z-index: 3;padding:10px;top:20%;left:calc(50% - 200px);border:1px solid #ddd;background-color: #fff;">
		<h2>修改菜品图片</h2>
        <div id="imgBody">
            
        </div>
        <div class="row" style="padding: 10px;clear: both;">
            <button class="btn btn-xs btn-warning" onclick="colseDialogsd()">
                <i class="ace-icon fa fa-undo icon-on-right bigger-110"></i>
                <span class="hidden-sm hidden-xs">取消</span>
            </button>
            <button class="btn btn-xs btn-primary subImg">
                <i class="ace-icon fa fa-check bigger-120"></i>
                <span class="hidden-sm hidden-xs">确定</span>
            </button>
        </div>
	</section>

	<script src="../../assets/js/jquery.validate.min.js"></script>
	<script src="../../assets/js/chosen.jquery.min.js"></script><!-- input select -->
	<script src="./js/ajaxfileupload.js"></script><!-- 图片上传 -->
	<script src="./js/addFoot.js"></script>	
	<script>
		/*给导航添加*/
		$('.nav-list .foot').addClass("active open");
		$('.nav-list .foot').find('li').eq(1).addClass("active");
	</script>

	<!-- inline scripts related to this page -->
	<script src="js/editFoot.js"></script>
</body>
</html>