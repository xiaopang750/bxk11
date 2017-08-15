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

					<a href="<?php echo site_url('admin/content/index')?>">

					<i class="icon-home"></i> 

					<span class="title">内容管理</span>

					<span class="selected"></span>

					</a>

				</li>

				<li class="">

					<a href="javascript:;">

					<i class="icon-cogs"></i> 

					<span class="title">问题</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">

						<li >

							<a href="<?php echo site_url('admin/question/index')?>">问题列表</a>

						</li>

					</ul>

				</li>

			
				<li class="">

					<a href="javascript:;">

					<i class="icon-gift"></i> 

					<span class="title">博文</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">

						<li >

							<a href="<?php echo site_url('admin/blog/index')?>">

							博文列表</a>
							<a href="<?php echo site_url('admin/t_admin_importexception/index')?>" target="_left">

							批量导入博文标签</a>

						</li>

					</ul>

				</li>

				<li>

					<a class="active" href="javascript:;">

					<i class="icon-sitemap"></i> 

					<span class="title"> 标签</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">
					
						<li >

							<a href="<?php echo site_url('admin/type/index')?>">
								分类列表
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/type/add')?>">
								添加分类
							</a>

						</li>

						<li >

							<a href="<?php echo site_url('admin/tag/index')?>">
								标签列表
							</a>

						</li>

						<li >

							<a href="<?php echo site_url('admin/tag/add')?>">
							添加标签</a>
						</li>
						<li >
							<a href="<?php echo site_url('admin/tag/importtt')?>">
							 导入分类与标签</a>
						</li>
					</ul>

				</li>
				
				<li>

					<a class="active" href="javascript:;">

					<i class="icon-sitemap"></i> 

					<span class="title">方案管理</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">
					
						<li >

							<a href="<?php echo site_url('admin/scheme/index')?>">
								案例列表
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/scheme/schemeUpade')?>" target="_blank">
								一键更新案例
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/room/index')?>">
								样板间列表
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/room/roomUpade')?>" target="_blank">
								一键更新样板间
							</a>

						</li>
					
						<li >

							<a href="<?php echo site_url('admin/house/index')?>">
								楼盘列表
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/house/add')?>">
								添加楼盘
							</a>

						</li>

						<li >

							<a href="<?php echo site_url('admin/house/house_apartment')?>">
								户型列表
							</a>

						</li>

						<li >

							<a href="<?php echo site_url('admin/house/house_apartment_add')?>">
							添加户型</a>
						</li>
						<li >
							<a href="<?php echo site_url('admin/tag/importtt')?>">
							 导入分类与标签</a>
						</li>
						
						
					</ul>

				</li>
				
				
				<li>

					<a class="active" href="javascript:;">

					<i class="icon-sitemap"></i> 

					<span class="title">系统禁止</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">
					
						<li >

							<a href="<?php echo site_url('admin/system_disable/index')?>">
								 禁止内容列表
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/system_disable/add')?>">
								添加内容
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/system_disable/replace')?>">
								 敏感词替换
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/system_disable/import_disable')?>">
								导入数据
							</a>

						</li>
						

					</ul>

				</li>

				<li>

					<a class="active" href="javascript:;">

					<i class="icon-sitemap"></i> 

					<span class="title">方案推荐操作</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">
					
						<li >

							<a href="<?php echo site_url('admin/scheme_recommend/index')?>">
								频道首页轮播
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/scheme_recommend/index3D')?>">
								首页3D推荐
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/scheme_recommend/scheme_designer')?>">
								频道首页推荐设计师
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/scheme_recommend/scheme_downs')?>">
								频道首页方案下载排行榜
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/scheme_recommend/scheme_diy')?>">
								案例频道首页DIY组合家装
							</a>

						</li>
						
						
						<li >

							<a href="<?php echo site_url('admin/scheme_recommend/scheme_room')?>">
								频道首页推荐样板间
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/scheme_recommend/scheme_tag')?>">
								样板间标题
							</a>

						</li>

					</ul>

				</li>
			

			</ul>

			<!-- END SIDEBAR MENU -->

		</div>

		<!-- END SIDEBAR -->
