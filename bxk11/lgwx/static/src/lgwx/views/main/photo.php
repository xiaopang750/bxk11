<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><{$title}></title>
<{php}> include APP_STATIC.'views/include/meta.php';<{/php}>
<{php}> include APP_STATIC.'views/include/globalcss.php';<{/php}>
<link rel="stylesheet" href="<{$smarty.const.APP_LINK}>css/main/photo.css" />
</head>
<body>

<!-- header -->
<{include file="../include/header.php"}>

<!-- tree -->
<{include file="../include/tree.php"}>

<!-- bread -->
<{include file="../include/bread.php"}>

<!-- main -->
<div class="layer-content">
	<div class="table-title clearfix">
		<span class="icon-list-head icon16"></span>
		<span class="text">
			<{$title}>
		</span>

		<form action="/lgwx/index.php/upload/albumService" enctype="multipart/form-data" target="uploadframe" script-role="upload-form" method="post">
			<div class="upload-wrap fr">
				<div script-role="check_wrap">
					<label class="fl col-2">上传:</label>
					<input type="file" class="mt_10 fl" name="userfile" script-role="upload-file" iamgeurl="{{data.join_license}}"/>
					<span class="uploadLoading fl" script-role="uploadLoading">
						<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/btn_loading.gif" />
						上传中...
					</span>
				</div>
				<iframe frameborder="0" name="uploadframe" class="uploadframe"></iframe>
				<div class="fl mt_5">
					<label class="label-control fl col-2"></label>
					<div class="col-2 fl">
						<img src="<{$smarty.const.APP_LINK}>/img/lib/loading/blank.gif" script-role="view_image" height="30">
					</div>	
				</div>
			</div>
		</form>

	</div>
	
	<div script-role = "data_wrap">

	</div>

	
</div>

<script type="text/html" id="photo">
	<div class="form" script-bound="form_check">
		<div class="top rel">
			<div class="line t"></div>
			<div class="line b"></div>
			<table border="0" cellspacing="0" cellspacing="0">
				<tr>
					<td class="bb_n" sc="data-list">
						{{if data.album_list[0].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[0].pic_url}}" />
							<p>名称:{{data.album_list[0].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[0].pic_size}}</span>
								<span>大小:{{data.album_list[0].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[0].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
					<td class="bb_n" sc="data-list">
						{{if data.album_list[1].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[1].pic_url}}" />
							<p>名称:{{data.album_list[1].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[1].pic_size}}</span>
								<span>大小:{{data.album_list[1].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[1].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
					<td class="bb_n" sc="data-list">
						{{if data.album_list[2].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[2].pic_url}}" />
							<p>名称:{{data.album_list[2].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[2].pic_size}}</span>
								<span>大小:{{data.album_list[2].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[2].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
					<td class="bb_n br_n" sc="data-list">
						{{if data.album_list[3].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[3].pic_url}}" />
							<p>名称:{{data.album_list[3].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[3].pic_size}}</span>
								<span>大小:{{data.album_list[3].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[3].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
				</tr>

				<tr>
					<td class="bb_n" sc="data-list">
						{{if data.album_list[4].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[4].pic_url}}" />
							<p>名称:{{data.album_list[4].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[4].pic_size}}</span>
								<span>大小:{{data.album_list[4].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[4].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
					<td class="bb_n" sc="data-list">
						{{if data.album_list[5].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[5].pic_url}}" />
							<p>名称:{{data.album_list[5].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[5].pic_size}}</span>
								<span>大小:{{data.album_list[5].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[5].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
					<td class="bb_n" sc="data-list">
						{{if data.album_list[6].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[6].pic_url}}" />
							<p>名称:{{data.album_list[6].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[6].pic_size}}</span>
								<span>大小:{{data.album_list[6].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[6].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
					<td class="bb_n br_n" sc="data-list">
						{{if data.album_list[7].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[7].pic_url}}" />
							<p>名称:{{data.album_list[7].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[7].pic_size}}</span>
								<span>大小:{{data.album_list[7].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[7].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
				</tr>

				<tr>
					<td sc="data-list">
						{{if data.album_list[8].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[8].pic_url}}" />
							<p>名称:{{data.album_list[8].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[8].pic_size}}</span>
								<span>大小:{{data.album_list[8].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[8].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
					<td sc="data-list">
						{{if data.album_list[9].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[9].pic_url}}" />
							<p>名称:{{data.album_list[9].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[9].pic_size}}</span>
								<span>大小:{{data.album_list[9].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[9].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
					<td sc="data-list">
						{{if data.album_list[10].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[10].pic_url}}" />
							<p>名称:{{data.album_list[10].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[10].pic_size}}</span>
								<span>大小:{{data.album_list[10].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[10].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
					<td class="br_n" sc="data-list">
						{{if data.album_list[11].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[11].pic_url}}" />
							<p>名称:{{data.album_list[11].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[11].pic_size}}</span>
								<span>大小:{{data.album_list[11].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[11].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
				</tr>

				<tr>
					<td class="bb_n" sc="data-list">
						{{if data.album_list[12].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[12].pic_url}}" />
							<p>名称:{{data.album_list[12].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[12].pic_size}}</span>
								<span>大小:{{data.album_list[12].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[12].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
					<td class="bb_n" sc="data-list">
						{{if data.album_list[13].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[13].pic_url}}" />
							<p>名称:{{data.album_list[13].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[13].pic_size}}</span>
								<span>大小:{{data.album_list[13].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[13].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
					<td class="bb_n" sc="data-list">
						{{if data.album_list[14].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[14].pic_url}}" />
							<p>名称:{{data.album_list[14].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[14].pic_size}}</span>
								<span>大小:{{data.album_list[14].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[14].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
					<td class="bb_n br_n" sc="data-list">
						{{if data.album_list[15].pic_url}}
						<div class="outer">
							<img src="{{data.album_list[15].pic_url}}" />
							<p>名称:{{data.album_list[15].pic_name}}</p>
							<p>
								<span>尺寸:{{data.album_list[15].pic_size}}</span>
								<span>大小:{{data.album_list[15].pic_kb}}</span>
							</p>
							<div class="func" sc="func">
								<div class="lay"></div>
								<div class="main">
									<span class="icon-normal del" del-url="{{data.album_list[15].pic_url}}"></span>
								</div>
							</div>
						</div>
						{{/if}}
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="table-bottom">
		<div class="fenye fl col-5 mt_8 ml_5" sc="fenye-wrap">
			{{if data.count}}
			<button class="btn btn-sm btn-primary" sc="first">首页</button>
			<button class="btn btn-sm btn-primary" sc="page-prev">上一页</button>
			<span class="num" sc="num">
				
			</span>
			<button class="btn btn-sm btn-primary" sc="page-next">下一页</button>
			<button class="btn btn-sm btn-primary" sc="last">尾页</button>
			{{/if}}
		</div>	
	</div>
</script>

<script src="<{$smarty.const.APP_SEAJS}>seajs/sea.js"></script>
<script src="<{$smarty.const.APP_SEAJS}>seajs/config.js"></script>
<script>
	seajs.use('main/photo.js');
</script>
</body>
</html>

