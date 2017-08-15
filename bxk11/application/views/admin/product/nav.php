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

					<a href="<?php echo site_url('admin/product/index')?>">

					<i class="icon-home"></i> 

					<span class="title">产品管理</span>

					<span class="selected"></span>

					</a>

				</li>

					<li>

					<a class="active" href="javascript:;">

					<i class="icon-sitemap"></i> 

					<span class="title">认证产品</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">
					
						<li >

							<a href="<?php echo site_url('admin/product/index')?>">
								产品列表
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/product/add')?>">
								产品添加
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/t_admin_importproduct/index')?>" target="_blank">
								产品批量导入
							</a>

						</li>
						
	
					</ul>

				</li>
			
				<li class="">

					<a href="javascript:;">

					<i class="icon-gift"></i> 

					<span class="title">产品款式</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">

						<li >

							<a href="<?php echo site_url('admin/product/pattern')?>">

							款式列表</a>
							<a href="<?php echo site_url('admin/product/pattern_add')?>">

							款式添加</a>

						</li>

					</ul>

				</li>
				
				<li>

					<a class="active" href="javascript:;">

					<i class="icon-sitemap"></i> 

					<span class="title">产品品牌</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">
					
						<li >
							<a href="<?php echo site_url('admin/product/brands')?>">
								产品品牌列表
							</a>
						</li>
						
						<li >

							<a href="<?php echo site_url('admin/product/brands_add')?>">
								产品品牌添加
							</a>

						</li>
					
					</ul>

				</li>
				
				
				<li>

					<a class="active" href="javascript:;">

					<i class="icon-sitemap"></i> 

					<span class="title">产品品牌系列</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">
					
						<li >

							<a href="<?php echo site_url('admin/product/brands_series')?>">
								产品品牌系列列表
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/product/brands_series_add')?>">
								添加产品品牌系列
							</a>

						</li>
						
						

					</ul>

				</li>

				
				<li>

					<a class="active" href="javascript:;">

					<i class="icon-sitemap"></i> 

					<span class="title">套餐</span>

					<span class="arrow "></span>

					</a>

						
					<ul class="sub-menu">
					
						<li >

							<a href="<?php echo site_url('admin/product/pack')?>">
								产品套餐列表
							</a>

						</li>
						
						<li >

							<a href="<?php echo site_url('admin/product/packAdd')?>">
								产品套餐添加
							</a>

						</li>
					</ul>

				</li>
				
		

			</ul>

			<!-- END SIDEBAR MENU -->

		</div>

		<!-- END SIDEBAR -->
