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
					<div class="row">
						<form class="form-horizontal" role="form" id="addFoot">
							<div class="col-xs-8 col-xs-offset-1">
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="admName">用户名：</label>
									<div class=" col-xs-12 col-sm-9">
										<div class="input-group">
											<input type="text" class="form-control search-query" name="admName" id="admName" placeholder="请输入联系方式" />
											<span class="input-group-btn">
												<button type="button" class="btn btn-purple btn-sm" id="subName">
													<i class="ace-icon fa fa-check bigger-110"></i>
													修改
												</button>
											</span>
										</div>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="admTel">联系方式：</label>
									<div class=" col-xs-12 col-sm-9">
										<div class="input-group">
											<input type="text" class="form-control search-query" name="admTel" id="admTel" placeholder="请输入联系方式" />
											<span class="input-group-btn">
												<button type="button" class="btn btn-purple btn-sm" id="subTel">
													<i class="ace-icon fa fa-check bigger-110"></i>
													修改
												</button>
											</span>
										</div>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="admEmail">邮箱：</label>
									<div class=" col-xs-12 col-sm-9">
										<div class="input-group">
											<input type="text" class="form-control search-query" name="admEmail" id="admEmail" placeholder="请输入联系方式" />
											<span class="input-group-btn">
												<button type="button" class="btn btn-purple btn-sm" id="subEmail">
													<i class="ace-icon fa fa-check bigger-110"></i>
													修改
												</button>
											</span>
										</div>
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="oldPassword">旧密码：</label>
									<div class="col-xs-12 col-sm-9">
										<div class="clearfix">
											<input type="password" name="oldPassword" id="oldPassword" placeholder="请输入您的旧密码" class="col-xs-12" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">新密码：</label>
									<div class="col-xs-12 col-sm-9">
										<div class="clearfix">
											<input type="password" name="password" id="password" placeholder="请输入您的新密码" class="col-xs-12" />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="pwAgain">重复密码：</label>
									<div class="col-xs-12 col-sm-9">
										<div class="clearfix">
											<input type="password" name="pwAgain" id="pwAgain" placeholder="请再次输入新密码" class="col-xs-12" />
										</div>
									</div>
								</div>
							</div>
							<div class="clearfix form-actions col-xs-12">
									<div class="col-xs-offset-4 col-xs-8">
										<button class="btn" type="reset">
											<i class="ace-icon fa fa-undo bigger-110"></i>
											取消
										</button>
										&nbsp; &nbsp; &nbsp;
										<button class="btn btn-info" type="button" id="subBtn">
											<i class="ace-icon fa fa-check bigger-110"></i>
											修改密码
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
			//获取用户信息
			var param = {
				id:0,
				flag:1
			};
			$.post('data/editUser.php',param,function(data){
				$('#admName').val(data[0].admName);
				$('#admEmail').val(data[0].admEmail);
				$('#admTel').val(data[0].admTel);
			},'json')
			
			//修改用户名
			$('#subName').click(function(){
                var admName = $('#admName').val();
                if(admName==''){
                    alert('用户名不能为空');
                }else{
                    var reg = /^\w{6,20}$/;
                    if(reg.test(admName)){
                        var param = {
                            flag : 2,
                            id:0,
                            admName : admName
                        }
                        $.post('data/editUser.php', param, function (data) {
                            switch (data.flag) {
                                case 1:
                                    alert("用户名已经修改成功！");
                                    window.location.reload();
                                    break;
                                case 2:
                                    alert("修改失败，请检查您的网络！");
                                    break;
                                case 3:
                                    alert("该用户名已经存在，请重新输入！");
                                    break;
                            }
                        }, 'json');
                    }else{
                        alert('请输入正确的用户名,至少6位！')
                    }
                }
                return false;
            })
			//修改联系方式
			$('#subTel').click(function(){
                var admTel = $('#admTel').val();
                if(admTel==''){
                    alert('联系方式不能为空');
                }else{
                    var reg = /^(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$/;
                    if(reg.test(admTel)){
                        var param = {
                            flag : 3,
                            id:0,
                            admTel : admTel
                        }
                        $.post('data/editUser.php', param, function (data) {
                            switch (data.flag) {
                                case 1:
                                    alert("联系方式已经修改成功！");
                                    window.location.reload();
                                    break;
                                case 2:
                                    alert("修改失败，请检查您的网络！");
                                    break;
                                case 3:
                                    alert("该联系方式已经存在，请重新输入！");
                                    break;
                            }
                        }, 'json');
                    }else{
                        alert('请输入正确的联系方式！')
                    }
                }
                return false;
            })
			//修改邮箱
			$('#subEmail').click(function(){
                var admEmail = $('#admEmail').val();
                if(admEmail==''){
                    alert('邮箱不能为空');
                }else{
                    var reg = /^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/;
                    if(reg.test(admEmail)){
                        var param = {
                            flag : 4,
                            id:0,
                            admEmail : admEmail
                        }
                        $.post('data/editUser.php', param, function (data) {
                            switch (data.flag) {
                                case 1:
                                    alert("邮箱已经修改成功！");
                                    window.location.reload();
                                    break;
                                case 2:
                                    alert("修改失败，请检查您的网络！");
                                    break;
                                case 3:
                                    alert("该邮箱已经存在，请重新输入！");
                                    break;
                            }
                        }, 'json');
                    }else{
                        alert('请输入正确的邮箱！')
                    }
                }
                return false;
            })
			//修改用户密码
			$('#subBtn').click(function(){
                    var oldpw = $('#oldPassword').val();
                    var loginpw = $('#password').val();
                    var pwAgain = $('#pwAgain').val();
                    if(loginpw==''&& oldpw==''){
                        alert('请输入需要修改的密码！');
                    }else{
                        if(loginpw != pwAgain){
                            alert("两次输入的密码不一致！");
                        }else if(loginpw==''||oldpw==''){
                            alert('请输入新密码！')
                        }else{
                            var reg = /^\w{6,20}$/;
                            if(reg.test(oldpw)&&reg.test(loginpw)&&reg.test(pwAgain)){
                                var param = {
                                    flag : 5,
                                    id : 0,
                                    oldpw : oldpw,
                                    loginpw : loginpw
                                }
                                console.log(param);
                                $.post('data/editUser.php', param, function (data) {
                                    switch (data.flag) {
                                        case 4:
                                            alert("新密码已经生效，请重新登录！");
                                            $.get('data/isKey.php',{flag:2},function(data){
                                                if (data){
                                                    location.reload()//刷新页面
                                                }
                                            },'text')
                                            break;
                                        case 5:
                                            alert("修改失败，请检查您的网络！");
                                            break;
                                        case 6:
                                            alert("新密码与旧密码不能一致，请重新输入！");
                                            break;
                                        case 7:
                                            alert("原密码输入不正确，请重新输入！");
                                            break;
                                    }
                                }, 'json');
                            }else{
                                alert('请输入正确的密码：至少6位！')
                            }
                        }
                    }
                    return false;
                })
		</script>
	</body>
</html>
