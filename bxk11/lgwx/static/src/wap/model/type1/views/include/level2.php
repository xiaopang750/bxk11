<div class="level2 mb_20">
	<a href="<?php echo $user_url; ?>">
		<span class="person level2-icon"></span>
	</a>
	<span>
		<?php if(mb_strlen($title)<=10) {echo $title;} else {echo mb_substr($title, 0, 10)."...";} ?>
	</span>
	<a href="<?php echo $index_url; ?>">
		<span class="home level2-icon"></span>
	</a>	
</div>