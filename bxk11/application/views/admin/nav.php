<!-- BEGIN SIDEBAR -->

		<div class="page-sidebar nav-collapse collapse">

			<!-- BEGIN SIDEBAR MENU -->        

			<ul class="page-sidebar-menu">

				<li>

					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->

					<div class="sidebar-toggler hidden-phone"></div>

					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->

				</li>

				<li>

					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->

					<form class="sidebar-search">

						<div class="input-box">

							<a href="javascript:;" class="remove"></a>

							<input type="text" placeholder="Search..." />

							<input type="button" class="submit" value=" " />

						</div>

					</form>

					<!-- END RESPONSIVE QUICK SEARCH FORM -->

				</li>

				<li class="start active ">

					<a href="index.html">

					<i class="icon-home"></i> 

					<span class="title">管理中心</span>

					<span class="selected"></span>

					</a>

				</li>


				<li class="">

					<a href="javascript:;">

					<i class="icon-map-marker"></i> 

					<span class="title">3D设置</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">

						<li >

							<a href="<?php echo site_url('/admin/three_config/index');?>">

							全局配制</a>

						</li>

						<li >

							<a href="<?php echo site_url('/admin/three_config/three_thumb');?>">

							索引图导航设置</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('/admin/three_config/three_control');?>">

							控制面板设置</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('/admin/three_config/three_info');?>">
							信息面板设置
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('/admin/three_config/three_face');?>">
							logo设置
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('/admin/three_config/three_hotspot');?>">
							热点设置
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('/admin/three_config/three_map');?>">

							地图导航设置</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('/admin/three_config/createxml');?>">

							生成全局xml文件</a>

						</li>

					</ul>

				</li>

			
				<li class="">
					<a href="javascript:;">
					<i class="icon-file-text"></i> 
					<span class="title">用户管理</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li >
							<a href="<?php echo site_url('/admin/user/userlist');?>">用户列表</a>
						</li>
						<li >
							<a href="<?php echo site_url('/admin/user/useradd');?>">添加新用户</a>
						</li>
						<!-- <li >
							<a href="<?php echo site_url('/admin/user/c_dynamic');?>">用户博文动态</a>
						</li>
						<li >
							<a href="<?php echo site_url('/admin/user/q_dynamic');?>">用户装修问题动态</a>
						</li> -->
					</ul>

				</li>

				<li class="">
					<a href="javascript:;">
					<i class="icon-file-text"></i> 
					<span class="title">微信选项</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">

						<li >
							<a href="<?php echo site_url('/admin/weixinMenu/index');?>">选项列表</a>
						</li>
						
						<li >
							<a href="<?php echo site_url('/admin/weixinMenu/add');?>">添加选项</a>
						</li>
					
					</ul>

				</li>

				<li class="">
					<a href="javascript:;">
					<i class="icon-file-text"></i> 
					<span class="title">推广</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">

						<li >
							<a href="<?php echo site_url('/admin/spreaderRebate/index');?>">推广返利列表</a>
						</li>
						
						<li >
							<a href="<?php echo site_url('/admin/spreaderRebate/add');?>">添加返利项</a>
						</li>
					
					</ul>

				</li>


				<!-- <li class="">
					<a href="javascript:;">
					<i class="icon-file-text"></i> 
					<span class="title">增值服务</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">

						<li >
							<a href="<?php echo site_url('/admin/vasService/index');?>">增值列表</a>
						</li>
						
						<li >
							<a href="<?php echo site_url('/admin/vasService/add');?>">添加增值</a>
						</li>
					
					</ul>

				</li> -->

				<li class="">
					<a href="javascript:;">
					<i class="icon-file-text"></i> 
					<span class="title">系统设置</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li >
							<a href="<?php echo site_url('/admin/score');?>">积分设置</a>
						</li>
						<li >
							<a href="<?php echo site_url('/admin/sys_recommend/index');?>">系统推荐项</a>
						</li>
						<li >
							<a href="<?php echo site_url('/admin/sys_recommend/add');?>">添加推荐项</a>
						</li>
						
						<li >
							<a href="<?php echo site_url('/admin/sys_recommend/syncSet');?>">第三方同步管理</a>
						</li>
						
						<li >
							<a href="<?php echo site_url('/admin/sys_recommend/notice');?>">站内通知</a>
						</li>
					</ul>

				</li>

				<li class="">
					<a href="javascript:;">
					<i class="icon-file-text"></i> 
					<span class="title">系统产品分类</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">

						<li >
							<a href="<?php echo site_url('/admin/productClass/index');?>">产品分类列表</a>
						</li>
						
						<li >
							<a href="<?php echo U('admin/productClass/add');?>">添加分类</a>
						</li>
					
					</ul>

				</li>
				
				<li class="">
					<a href="javascript:;">
					<i class="icon-file-text"></i> 
					<span class="title">地区管理</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li >
							<a href="<?php echo site_url('/admin/area/index');?>">地区配制</a>
						</li>
						
					</ul>

				</li>	
				<li class="">
					<a href="javascript:;">
					<i class="icon-file-text"></i> 
					<span class="title">广告投放</span>
					<span class="arrow "></span>
					</a>
						<ul class="sub-menu">
							<li >
								<a href="<?php echo site_url('/admin/ad/page');?>">页面模块管理</a>
							</li>
							<li >
								<a href="<?php echo site_url('/admin/ad/admanage');?>">广告管理</a>
							</li>
						</ul>
			</li>	
			
				<?php if($_SESSION['admin_id']==2){
						echo  "<li class=''>";
				}else
				{
						echo "<li class='' style='display:none' >".$_SESSION['admin_id'];
				}
				
				?>
				
					<a href="javascript:;">
					<i class="icon-file-text"></i> 
					<span class="title">管理员</span>
					<span class="arrow "></span>
					</a>				
					<ul class="sub-menu">
						<li >
							<a href="<?php echo site_url('/admin/administrator/adminadd');?>">添加管理员</a>
						</li>
						<li >
							<a href="<?php echo site_url('/admin/administrator/adminlist');?>">管理员列表</a>
						</li>						
					</ul>		
					
				</li>
			</ul>

			<!-- END SIDEBAR MENU -->

		</div>

		<!-- END SIDEBAR -->
