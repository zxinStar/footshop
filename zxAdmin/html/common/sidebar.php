<div id="sidebar" class="sidebar responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<!-- #section:basics/sidebar.layout.shortcuts -->
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>

						<!-- /section:basics/sidebar.layout.shortcuts -->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="">
						<a href="../system/admIndex.php">
							<i class="menu-icon fa fa-home"></i>
							<span class="menu-text"> 首页 </span>
						</a>
						<b class="arrow"></b>
					</li>

					<li class="classify">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> 菜品分类 </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="../classify/addClassify.php">
									<i class="menu-icon fa fa-caret-right"></i>
									新增分类
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="../classify/classify.php">
									<i class="menu-icon fa fa-caret-right"></i>
									分类管理
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="foot">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cutlery"></i>
							<span class="menu-text"> 菜品管理 </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="../foot/addFoot.php">
									<i class="menu-icon fa fa-caret-right"></i>
									新增菜品
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="../foot/foot.php">
									<i class="menu-icon fa fa-caret-right"></i>
									菜品管理
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="">
						<a href="../manage/user.php">
							<i class="menu-icon fa fa-users"></i>
							<span class="menu-text"> 用户管理 </span>
						</a>
					</li>
					<li class="">
						<a href="../manage/message.php">
							<i class="menu-icon fa fa-file-o"></i>
							<span class="menu-text"> 留言管理 </span>
						</a>
					</li>
					<li class="">
						<a href="../order/order.php">
							<i class="menu-icon fa fa-bar-chart-o"></i>
							<span class="menu-text"> 订单管理 </span>
						</a>
					</li>
					<li class="">
						<a href="../order/salesVolume.php">
							<i class="menu-icon fa fa-tag"></i>
							<span class="menu-text"> 销量统计 </span>
						</a>
					</li>
				</ul><!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>