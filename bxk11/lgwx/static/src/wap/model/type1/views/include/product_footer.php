<section class="product_footer" script-role="product_footer">
	<div class="inner">
		<ul class="box">
			<li class="flex1">
				<span class="loc <?php if($is_like == 1) {echo "active";} ?>" script-role="fav"></span>
			</li>
			<li class="flex1 <?php if( $page_name == "店长推荐") {echo "active";} ?>" script-role="product_list" sname="店长推荐"><a href="<?php echo $shoprecommend ?>">店长推荐</a></li>
			<li class="flex1 <?php if( $page_name == "店铺商品") {echo "active";} ?>" script-role="product_list" sname="店铺商品"><a href="<?php echo $shopgoods ?>">店铺商品</a></li>
			<li class="flex1 <?php if( $page_name == "到店体验") {echo "active";} ?>" script-role="product_list" sname="到店体验"><a href="<?php echo $shopinfo ?>">到店体验</a></li>
			<li class="flex1"></li>
		</ul>
	</div>
</section>

<div id="cover">
	<img src="<?php echo APP_LINK; ?>global/images/lib/loading/bxk_logo.png" id="jia178_loading">
</div>