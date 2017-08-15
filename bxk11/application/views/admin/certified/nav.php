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

					<a href="<?php echo site_url('admin/member/index')?>">

					<i class="icon-home"></i> 

					<span class="title">服务商模块管理</span>

					<span class="selected"></span>

					</a>

				</li>

				<li class="">

					<a href="javascript:;">

					<i class="icon-cogs"></i> 

					<span class="title">服务商</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">

						<li >

							<a href="<?php echo site_url('admin/member/index')?>">成员列表</a>

						</li>
						<li >

							<a href="<?php echo site_url('admin/member/add')?>">成员增加</a>

						</li>
<!-- 
						<li >
							<a href="<?php echo site_url('admin/member/join')?>">加盟商列表</a>
						</li> -->

						<li >
							<a href="<?php echo site_url('admin/member/newJoin')?>">加盟商列表new</a>
						</li>


					</ul>

				</li>


				<li class="">

					<a href="javascript:;">

					<i class="icon-cogs"></i> 

					<span class="title">模块列表</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">

						<li >

							<a href="<?php echo site_url('admin/service/index')?>">服务商模块列表</a>

						</li>
						<li >

							<a href="<?php echo site_url('admin/service/module_add')?>">服务商模块增加</a>

						</li>
						<li >

							<a href="<?php echo site_url('admin/service/action_add')?>">功能添加</a>

						</li>


					</ul>

				</li>

					<li class="">

					<a href="javascript:;">

					<i class="icon-cogs"></i> 

					<span class="title">门店</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">

						<li >

							<a href="<?php echo site_url('admin/shop/index')?>">门店列表</a>

						</li>

						<li >

							<a href="<?php echo site_url('admin/shop/add')?>">门店增加</a>

						</li>

						
						


					</ul>

				</li>

				<li class="">

					<a href="javascript:;">

					<i class="icon-cogs"></i> 

					<span class="title">账号管理</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">

						<li >

							<a href="<?php echo site_url('admin/serviceUser/index')?>">账号列表</a>

						</li>
						<li >

							<a href="<?php echo site_url('admin/serviceUser/add')?>">账号增加</a>

						</li>


					</ul>

				</li>
			
				<li class="">

					<a href="javascript:;">

					<i class="icon-cogs"></i> 

					<span class="title">经销商品牌系列管理</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">

						<li >

							<a href="<?php echo site_url('admin/member/service_brands_apply')?>">经销商品牌列表</a>

						</li>

						<li >

							<a href="<?php echo site_url('admin/product/brands_add')?>" target="_blank">品牌添加</a>

						</li>

						<li >

							<a href="<?php echo site_url('admin/serviceBrSe/series')?>">经销系列列表</a>

						</li>

						<li >
							<a href="<?php echo site_url('admin/serviceBrSe/serviceBrSeadd')?>">系列添加</a>
						</li>



					</ul>

				</li>

				<li class="">

					<a href="javascript:;">

					<i class="icon-cogs"></i> 

					<span class="title">经销商商品管理</span>

					<span class="arrow "></span>

					</a>

					<ul class="sub-menu">

						<li >

							<a href="<?php echo site_url('admin/serviceProduct/index')?>">经销商商品列表</a>

						</li>

						<li >

							<a href="<?php echo site_url('admin/serviceProduct/add')?>">经销商商品添加</a>

						</li>

					

					</ul>

				</li>
								
				<li class="last ">

					<a href="charts.html">

					<i class="icon-bar-chart"></i> 

					<span class="title">Visual Charts</span>

					</a>

				</li>

			</ul>

			<!-- END SIDEBAR MENU -->

		</div>

		<!-- END SIDEBAR -->
