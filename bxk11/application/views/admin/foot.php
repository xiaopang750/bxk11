
	</div>

	<!-- END CONTAINER -->

	<!-- BEGIN FOOTER -->

	<div class="footer">

		<div class="footer-inner">

			2013 &copy;  2013-2013 Jia178.Com .

		</div>

		<div class="footer-tools">

			<span class="go-top">

			<i class="icon-angle-up"></i>

			</span>

		</div>

	</div>

	<!-- END FOOTER -->

<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-37564768-1']);  _gaq.push(['_setDomainName', 'keenthemes.com']);  _gaq.push(['_setAllowLinker', true]);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script></body>

<!-- END BODY -->

</html>
<?php include("js.php")?>
<script type="text/javascript">

	$(document).ready(function(){
		
		 // 在这里写你的代码...
		$("input[ack_data='tag_checkboxs']").toggle(function(){
			$(".checker span").addClass('checked');
			
		}, function(){
			$(".checker span").removeClass('checked');
		});
		$("#tag_types").change(function(){
			
			if(this.value !=2){
				$("#zhuti").hide();
			}else{
				$("#zhuti").show();
			}
		});
	});

	var jsv={
			"status":function(status,question_id,flg,name){
				var url,apply_name,service_id;
				if(flg == 'question'){
					 url = "<?php echo site_url('admin/question/dostatus')?>";
				}else if(flg == 'scheme'){
					 url = "<?php echo site_url('admin/scheme/dostatus')?>";
				}else if(flg == 'room'){
					 url = "<?php echo site_url('admin/room/dostatus')?>";
				}else if(flg == 'house'){
					 url = "<?php echo site_url('admin/house/dostatus')?>";
				}else if(flg == 'apartment'){
					 url = "<?php echo site_url('admin/house/doapartmentstatus')?>";
				}else if(flg == 'item'){
					 url = "<?php echo site_url('admin/room/doitemstatus')?>";
				}else if(flg == 'product'){
					 url = "<?php echo site_url('admin/product/dostatus')?>";
				}else if(flg == 'service'){
					 url = "<?php echo site_url('admin/member/dostatus')?>";
				}else if(flg == 'module'){
					 url = "<?php echo site_url('admin/service/dostatus')?>";
				}else if(flg == 'action'){
					 url = "<?php echo site_url('admin/service/doactionstatus')?>";
				}else if(flg == 'series'){
					 url = "<?php echo site_url('admin/product/doseriesstatus')?>";
				}else if(flg == 'apply'){
					 apply_name = name;
					 url = "<?php echo site_url('admin/member/doapplystatus')?>";
				}else if(flg == 'newapply'){
					 apply_name = name;
					 url = "<?php echo site_url('admin/member/donewapplystatus')?>";
				}else if(flg == 'shop'){
					if(status == 1){
						resul = window.confirm("你确定要把该门店置为旗舰店，其它门店为普通门店！");
						if(!resul){
							return false;
						}
					}
					service_id = "<?php echo isset($_GET['service_id'])?$_GET['service_id']:'';?>";
					url = "<?php echo site_url('admin/shop/doapplystatuss')?>";
				}else if(flg == 'join'){
					 url = "<?php echo site_url('admin/member/dojoinstatus')?>";
				}else if(flg == 'newjoin'){
					 url = "<?php echo site_url('admin/member/donewjoinstatus')?>";
				}else if(flg == 'code'){
					 url = "<?php echo site_url('admin/member/doCode')?>";
				}else if(flg == 'goods'){
					 url = "<?php echo site_url('admin/serviceProduct/doGoodsStatus')?>";
				}else if(flg == 'serviceUser'){
					 url = "<?php echo site_url('admin/serviceUser/doServiceUserStatus')?>";
				}else if(flg == 'template'){
					 url = "<?php echo site_url('admin/wapTpl/dostatus')?>";
				}else{
					 url = "<?php echo site_url('admin/blog/dostatus')?>";
				}
				$.post(url,{status:status,question_id:question_id,apply_name:apply_name,service_id:service_id},function(msg){
					
					if(flg == 'shop' || flg == 'join' || flg=='apply'|| flg == 'newjoin'|| flg == 'newapply'|| flg == 'code'){
						myDialog = art.dialog();
						myDialog.content(msg);// 填充对话框内容
						myDialog.title('反馈信息');
					}else{
						if(msg == 1){
							if(flg == 'join' && status == 2){
								window.open ("<?php echo site_url('admin/member/add').'?join_id="+question_id+"';?>") 
								
							}else{
								window.location.reload();
							}
							
						}else{
							alert("修改失败");	
						}
					}
					
				});
			},
		'room_is_hot':function(status,ids,flg){
			var url;
				if(flg == 'room'){
					 url = "<?php echo site_url('admin/room/dois_hot')?>";
				}else if(flg == 'house'){
					 url = "<?php echo site_url('admin/house/dois_hot')?>";
				}else if(flg == 'apartment'){
					 url = "<?php echo site_url('admin/house/doapartmentis_hot')?>";
				}else if(flg == 'product'){
					 url = "<?php echo site_url('admin/product/dois_hot')?>";
				}else if(flg == 'product_index'){
					 url = "<?php echo site_url('admin/product/dois_index')?>";
				}else{
					 url = "<?php echo site_url('admin/scheme/dois_hot')?>";
				}
				$.post(url,{status:status,ids:ids},function(msg){
					if(msg == 1){
						window.location.reload();
					}else{
						alert("修改失败");	
					}
				});
		},
		"check":function(){
			var url,flg=1;
			var tag_name = $("#tagname_one").val();
			var tag_type = $("select[name='tag_type']").val();
			if(tag_name == ''){
				$("#tag_name").show();
				$("#tag_error").html("标签名不能为空！");
				flg = 0;
			}else{
				url = "<?php echo site_url('admin/tag/dotagonly')?>";
				$.post(url,{tag_name:tag_name,tag_type:tag_type},function(msg){
					if(msg ==1){
						flg =  1;
					}else{
						$("#tag_name").show();
						$("#tag_error").html("该类型下的标签己有不能在添加！");
						flg = 0;
					}
					
				});
			}
			if(flg ==1){
				return true;
			}else{
				return false;
			}
		},
		"go":function(urls){
			window.location.href=urls;
		},
		'check_all':function(){
			var arr = [];

			var aInput = $('#sample_editable_1 input[type=checkbox]');
				
				aInput.each(function(i){
					if(aInput.eq(i).parent().attr('class') == 'checked' && aInput.eq(i).val() != 2){
						arr.push(aInput.eq(i).val());
					}
				});
			
			return arr;
		},
		'del':function(id){
		
			var ids,
				cAll,
				resu;
			ids = null;
			cAll = this.check_all();
		
			if(id){
				ids = id;
			}else{
				ids = cAll.toString();
			}
			if(ids == ''){
				alert('请选择删除项！');return false;
			}
			resu = window.confirm('你确定要删除该项以及它的子级？');
			if(resu){

				url = "<?php echo site_url('admin/system_disable/dodel')?>";
				
				$.post(url,{ids:ids},function(msg){
					msg = eval(msg);
					if(msg == 0){
						alert('删除失败！');
					}else{
						//for(i = 0;i<msg.length;i++){
							
							//$("#t_s"+msg[i]).remove();
						//}
						window.location.reload();
					}
				});
			}
			
			
		},
		'check_type':function(){

			var url,flg=1;
			var s_class_name_one= $("#s_class_name_one").val();
			
			var s_class_type = $("select[name='s_class_type']").val();
			var s_class_pid = $("select[name='s_class_id']").val();
			if(s_class_name_one == ''){
				$("#s_class_name").show();
				$("#s_class_error").html("分类名不能为空！");
				return false;
			}else{
				
				url = "<?php echo site_url('admin/type/dotagonly')?>";
				$.post(url,{s_class_name:s_class_name_one,s_class_type:s_class_type,s_class_pid:s_class_pid},function(msg){
					if(msg ==1){
						flg =  1;
						return false;
					}else{
						$("#s_class_name").show();
						$("#s_class_error").html("该类型下的标签己有不能在添加！");
						flg = 0;
						return false;
					}
				
				});
				if(flg == 1){
					return true;
				}else{
					return false;
				}
				
			}
		
		},
		"all_check":function(){
			var arr = [];

			var aInput = $('#sample_editable_1 input[type=checkbox]');
				
				aInput.each(function(i){
					if( aInput.eq(i).val() != 2){
						arr.push(aInput.eq(i).val());
					}
				});
				return arr;
		},
		"typedel":function(id){
			var ids,
			cAll,
			resu;
			ids = null;
			cAll = this.check_all();
		
			if(id){
				ids = id;
			}else{
				ids = cAll.toString();
			}
	
			if(ids == ''){
				alert('请选择删除项！');return false;
			}
			
			resu = window.confirm('你确定要删除该项以及它的子级？');
			if(resu){
			
				url = "<?php echo site_url('admin/type/dodel')?>";
				$.post(url,{ids:ids},function(msg){
					msg = eval(msg);
					if(msg == 0){
						alert('删除失败！');
					}else{
						//for(i = 0;i<msg.length;i++){
							
							//$("#t_s"+m	sg[i]).remove();
						//}
						window.location.reload();
					}
				});
			}
		
			},
			'del_s':function(id){
					
				var ids,
				cAll,
				resu;
				ids = null;
				cAll = this.check_all();
			
				if(id){
					ids = id;
				}else{
					ids = cAll.toString();
				}
		
				if(ids == ''){
					alert('请选择删除项！');return false;
				}
	
				resu = window.confirm('你确定要删除该项以及它的子级？');
				if(resu){
				
					url = "<?php echo site_url('admin/s_class_tag/dodel')?>";
					
					$.post(url,{ids:ids},function(msg){
						msg = eval(msg);
						if(msg == 0){
							alert('删除失败！');
						}else{
							for(i = 0;i<msg.length;i++){
								$("#t_ct"+msg[i]).remove();
							}
							//window.location.reload();
						}
					});
				}
			},
			"del_t":function(id,t_s_id){
				var ids,
				cAll;

				ids = null;
				cAll = this.check_all();
			
				if(id){
					ids = id;
				}else{
					ids = cAll.toString();
				}
		
				if(ids == ''){
					alert('请选择项！');return false;
				}
				url = "<?php echo site_url('admin/tag/add_system_tag')?>";
				
				$.post(url,{ids:ids,t_s_id:t_s_id},function(msg){
					msg = eval(msg);
					if(msg == 0){
						alert('添加失败！');
					}else{
						for(var i = 0;i<msg.length;i++){
							$("#t_ctt"+msg[i]).remove();
						}
						//window.location.reload();
					}
				});
			},
			"del_pattern":function(id){
				var ids,
				cAll,
				resu;
				ids = null;
				cAll = this.check_all();
			
				if(id){
					ids = id;
				}else{
					ids = cAll.toString();
				}
		
				if(ids == ''){
					alert('请选择删除项！');return false;
				}
	
				resu = window.confirm('你确定要删除该项以及它的子级？');
				if(resu){
				
					url = "<?php echo site_url('admin/product/dodelpattern')?>";
					
					$.post(url,{ids:ids},function(msg){
						msg = eval(msg);
						if(msg == 0){
							alert('删除失败！');
						}else{
							for(i = 0;i<msg.length;i++){
								$("#t_pat"+msg[i]).remove();
							}
							//window.location.reload();
						}
					});
				}
			},
			"del_series":function(id){
				var ids,
				cAll,
				resu;
				ids = null;
				cAll = this.check_all();
			
				if(id){
					ids = id;
				}else{
					ids = cAll.toString();
				}
		
				if(ids == ''){
					alert('请选择删除项！');return false;
				}
	
				resu = window.confirm('你确定要删除该项以及它的子级？');
				if(resu){
				
					url = "<?php echo site_url('admin/product/dodelseries')?>";
					
					$.post(url,{ids:ids},function(msg){
						msg = eval(msg);
						if(msg == 0){
							alert('删除失败！');
						}else{
						/*	for(i = 0;i<msg.length;i++){
								$("#t_ser"+msg[i]).remove();
							}*/
							window.location.reload();
						}
					});
				}
			},
			"del_brand":function(id){
				var ids,
				cAll,
				resu;
				ids = null;
				cAll = this.check_all();
			
				if(id){
					ids = id;
				}else{
					ids = cAll.toString();
				}
		
				if(ids == ''){
					alert('请选择删除项！');return false;
				}
				resu = window.confirm('你确定要删除品牌该项的系列和接触类的关系？');
				if(resu){
				
					url = "<?php echo site_url('admin/product/dodelbrand')?>";
					
					$.post(url,{ids:ids},function(msg){
						msg = eval(msg);
						if(msg == 0){
							alert('删除失败！');
						}else{
							for(i = 0;i<msg.length;i++){
								$("#t_s"+msg[i]).remove();
							}
							//window.location.reload();
						}
					});
				}
			},
			'check_recommend':function(){

				var url,flg=1;
				var sys_key = $("#sys_key").val();
			
				if(sys_key == ''){
					$("#sys_key_id").show();
					$("#sys_key_error").html("设置项不能为空！");
					return false;
				}else{
					
					url = "<?php echo site_url('admin/sys_recommend/doiskey')?>";
					
					$.post(url,{sys_key:sys_key},function(msg){
						if(msg ==1){
							flg =  1;
							return true;
						}else{
							$("#sys_key_id").show();
							$("#sys_key_error").html("该项以有不能再添加！");
							flg = 0;
							return false;
						}
					});
			
					if(flg == 1){
						return true;
					}else{
						return false;
					}
					
				}
			
			},
			'del_sys':function(id){
				
				var ids,
					cAll,
					resu;
				ids = null;
				cAll = this.check_all();
			
				if(id){
					ids = id;
				}else{
					ids = cAll.toString();
				}
				if(ids == ''){
					alert('请选择删除项！');return false;
				}
				resu = window.confirm('你确定要删除该项？');
				if(resu){
					url = "<?php echo site_url('admin/sys_recommend/dodel')?>";
					
					$.post(url,{ids:ids},function(msg){
						msg = eval(msg);
						if(msg == 0){
							alert('删除失败！');
						}else{
							//for(i = 0;i<msg.length;i++){
								
								//$("#t_s"+msg[i]).remove();
							//}
							window.location.reload();
						}
					});
				}
				
				
			},
			'province':function(){
				var house_province_pid = $('#house_province').val();
				if(house_province_pid != '0'){
					var url = "<?php echo site_url('admin/house/doprovince')?>";
					var html = '';
					$.post(url,{house_province_pid:house_province_pid},function(msg){
						msg = eval('('+msg+')');
						if(msg.err== 0){
							$("#house_city").html("<option value='0'>请选择 </option>");
							$("#house_id").html("<option value='0'>请选择 </option>");
							alert(msg.msg);
						}else{
							
							for(i in msg.data){
								html += "<option value='"+msg.data[i].district_code+"' >"+msg.data[i].district_name+"</option>";
								$("#house_city").html(html);
							}
						}
					});
				}else{
					$("#house_city").html("<option value='0'>请选择 </option>");
					$("#house_id").html("<option value='0'>请选择 </option>");
		
				}
					
				
			},
			'city':function(){
				var house_city_pid = $('#house_city').val();
				if(house_city_pid != '0'){
					var url = "<?php echo site_url('admin/house/docity')?>";
					var html = '';
					$.post(url,{house_city_pid:house_city_pid},function(msg){
						msg = eval('('+msg+')');
						//alert(msg.err);
						$("#house_id").html("<option value='0'>请选择</option>");
						if(msg.err== 0){
							$("#house_id").html("<option value='0'>请选择 </option>");
							alert(msg.msg);
						}else{
							for(i in msg.data){
								html += "<option value='"+msg.data[i].house_id+"' >"+msg.data[i].house_name+"</option>";
								$("#house_id").html(html);
							}
						}
					});
				}else{
					$("#house_id").html("<option value='0'>请选择</option>");
				
				}
					
				
			},
			'house':function(){
				var house_name = $("#house_name").val();
				var house_province = $("#house_province").val();
				var house_city = $("#house_city").val();
				var house_sort = $("#house_sort").val();
				if(house_name == ''){
					alert('楼盘名不能空');return false;
				}
				if(house_province == 0){
					alert('请选择省份！');return false;
				}
				if(house_city == 0){
					alert('请选择市！');return false;
				}
				if(parseInt(house_sort) != house_sort){
					alert('排序只能为数字！');return false;
				}
				return true;
			},
			'apartment':function(){
				var house_id = $("#house_id").val();
				var apartment_category_id = $("#apartment_category_id").val();
				var apartment_size = $("#apartment_size").val();
				var apartment_sort = $("#apartment_sort").val();
				if(house_id == 0){
					alert('楼盘名不能空');return false;
				}
				if(apartment_category_id == 0){
					alert('户型不能为,请选择！！');return false;
				}
				
				if(!floatCheck(apartment_size)){
					alert('面积只能为数字！');return false;
				}
				if(parseInt(apartment_sort) != apartment_sort){
					alert('排序只能为数字！');return false;
				}
				return true;
			},
			'disbale_add':function(){
				var sdisable_value = $('#sdisable_value').val();
				if(!sdisable_value){
					alert("请填写屏蔽内容");
					return false;
				}
				return true;
			},

			'disable_del':function(id){
					
					var ids,
						cAll,
						resu;
					ids = null;
					cAll = this.check_all();
				
					if(id){
						ids = id;
					}else{
						ids = cAll.toString();
					}
					if(ids == ''){
						alert('请选择删除项！');return false;
					}
					
					resu = window.confirm('你确定要删除该项？');
					if(resu){
						url = "<?php echo site_url('admin/system_disable/dodel')?>";
						
						$.post(url,{ids:ids},function(msg){
							msg = eval(msg);
							if(msg == 0){
								alert('删除失败！');
							}else{
								//for(i = 0;i<msg.length;i++){
									
									//$("#t_s"+msg[i]).remove();
								//}
								window.location.reload();
							}
						});
					}
					
					
				},
			'provincec':function(){
				var house_province_pid = $('#province').val();
				if(house_province_pid != ''){

					var url = "<?php echo site_url('admin/house/doprovince')?>";
					var html = '';
					$.post(url,{house_province_pid:house_province_pid},function(msg){
						msg = eval('('+msg+')');
						if(msg.err== 0){
							$("#city").html("<option value=''>-城市-</option>");
							$("#district").html("<option value=''>-州县-</option>");
							$("#service_id").html("<option value=''>-请选择-</option>");
							$("#brand_id").html("<option value=''>-请选择-</option>");
							$("#series_id").html("<option value=''>-请选择-</option>");
							$("#s_class_id").html("<option value=''>-请选择-</option>");
							alert(msg.msg);
						}else{
							html += '<option value="">-城市-</option>';
							for(i in msg.data){
								html += "<option value='"+msg.data[i].district_code+"' >"+msg.data[i].district_name+"</option>";
								$("#city").html(html);
							}
							$("#district").html("<option value=''>-州县-</option>");
							$("#service_id").html("<option value=''>-请选择-</option>");
							$("#brand_id").html("<option value=''>-请选择-</option>");
							$("#series_id").html("<option value=''>-请选择-</option>");
							$("#s_class_id").html("<option value=''>-请选择-</option>");
						}
					});
				}else{
					$("#city").html("<option value=''>-城市-</option>");
					$("#district").html("<option value=''>-州县-</option>");
					$("#service_id").html("<option value=''>-请选择-</option>");
					$("#brand_id").html("<option value=''>-请选择-</option>");
					$("#series_id").html("<option value=''>-请选择-</option>");
					$("#s_class_id").html("<option value=''>-请选择-</option>");
				}
			},
		'cityr':function(){
				var house_province_pid = $('#city').val();
				if(house_province_pid != ''){

					var url = "<?php echo site_url('admin/house/doprovince')?>";
					var html = '';
					$.post(url,{house_province_pid:house_province_pid},function(msg){
						msg = eval('('+msg+')');
						if(msg.err== 0){
							$("#district").html("<option value=''>-州县-</option>");
							$("#service_id").html("<option value=''>-请选择-</option>");
							$("#brand_id").html("<option value=''>-请选择-</option>");
							$("#series_id").html("<option value=''>-请选择-</option>");
							$("#s_class_id").html("<option value=''>-请选择-</option>");
							alert(msg.msg);
						}else{
							html += "<option value=''>-州县-</option>";
							for(i in msg.data){
								html += "<option value='"+msg.data[i].district_code+"' >"+msg.data[i].district_name+"</option>";
								$("#district").html(html);
								$("#brand_id").html("<option value=''>-请选择-</option>");
								$("#series_id").html("<option value=''>-请选择-</option>");
								$("#s_class_id").html("<option value=''>-请选择-</option>");
							}

						}
					});
				}else{
					$("#district").html("<option value=''>-州县-</option>");
					$("#service_id").html("<option value=''>-请选择-</option>");
					$("#brand_id").html("<option value=''>-请选择-</option>");
					$("#series_id").html("<option value=''>-请选择-</option>");
					$("#s_class_id").html("<option value=''>-请选择-</option>");
				}
			},
			'serviceInfo':function(){
				var city = $('#city').val();
				if(city != ''){
					var url = "<?php echo site_url('admin/serviceProduct/doServiceInfo')?>";
					var html = '';
					$.post(url,{city:city},function(msg){
						msg = eval('('+msg+')');
						if(msg.err== 0){
							$("#service_id").html("<option value=''>-请选择-</option>");
							$("#brand_id").html("<option value=''>-请选择-</option>");
							$("#series_id").html("<option value=''>-请选择-</option>");
							$("#s_class_id").html("<option value=''>-请选择-</option>");
							alert(msg.msg);
						}else{
							html += "<option value=''>-请选择-</option>";
							for(i in msg.data){
								html += "<option value='"+msg.data[i].service_id+"' >"+msg.data[i].service_company+"</option>";
								$("#service_id").html(html);
								$("#brand_id").html("<option value=''>-请选择-</option>");
								$("#series_id").html("<option value=''>-请选择-</option>");
								$("#s_class_id").html("<option value=''>-请选择-</option>");
							}
						}
					});
				}else{
					$("#service_id").html("<option value=''>-请选择-</option>");
					$("#brand_id").html("<option value=''>-请选择-</option>");
					$("#series_id").html("<option value=''>-请选择-</option>");
					$("#s_class_id").html("<option value=''>-请选择-</option>");
				}
			},
			'BrandInfo':function(){
				var service_id = $('#service_id').val();
				if(service_id != ''){

					var url = "<?php echo site_url('admin/serviceProduct/doServiceBrandInfo')?>";
					var html = '';
					$.post(url,{service_id:service_id},function(msg){
						msg = eval('('+msg+')');
						if(msg.err== 0){
							$("#brand_id").html("<option value=''>-请选择-</option>");
							$("#series_id").html("<option value=''>-请选择-</option>");
							$("#s_class_id").html("<option value=''>-请选择-</option>");
							alert(msg.msg);
						}else{
							html += "<option value=''>-请选择-</option>";
							for(i in msg.data){
								html += "<option value='"+msg.data[i].brand_id+"' >"+msg.data[i].apply_brand_name+"</option>";
								$("#brand_id").html(html);
							}
						}
					});
				}else{
					$("#brand_id").html("<option value=''>-请选择-</option>");
					$("#series_id").html("<option value=''>-请选择-</option>");
					$("#s_class_id").html("<option value=''>-请选择-</option>");
				}
			},
			'category':function(){
				var series_id = $('#series_id').val();
				if(service_id != ''){
					var url = "<?php echo site_url('admin/serviceProduct/doServiceCategory')?>";
					var html = '';
					$.post(url,{series_id:series_id},function(msg){
						msg = eval('('+msg+')');
						if(msg.err== 0){
							$("#s_class_id").html("<option value=''>-请选择-</option>");
							alert(msg.msg);
						}else{
							html += "<option value=''>-请选择-</option>";
							for(i in msg.data){
								html += "<option value='"+msg.data[i].s_class_id+"' >"+msg.data[i].s_class_name+"</option>";
								$("#s_class_id").html(html);
							}
						}
					});
				}else{
					$("#s_class_id").html("<option value=''>-请选择-</option>");
				}
			},
		'editName':function(id,name){
			$("#district_name_"+id).html("<input type='text' id='edit_name"+id+"' onblur='jsv.doeditname("+id+");' value='"+name+"'>");
		},
		'doeditname':function(id){
			var pname = $("#edit_name"+id).val();

			var url = "<?php echo site_url('admin/area/doeditdistrict_name')?>";
			$.post(url,{district_name:pname,district_id:id},function(msg){
						msg = eval('('+msg+')');
						if(msg.err== 0){
							alert(msg.msg);
							$("#district_name_"+id).html(pname);
						}else{
							$("#district_name_"+id).html(pname);
						}
					});
		},
		'areaadd':function(){

			var oTr = $("#sample_editable_1 tbody").eq(0);	
			var ids = $("#sample_editable_1 tbody tr").eq(0).attr('id');

			if(!ids){
				 $("#sample_editable_1 tbody tr").eq(0).remove();
			}
			oTr.prepend("<tr><td>地区名：</td><td><input type='text' value='' id='area_name'></td><td>邮编：</td><td><input type='text' value='' id='area_code'></td><td><a href='javascript:jsv.doareaadd()'>Add</a></td></tr>");
			
		},
		'doareaadd':function(){
			
			var district_pcode,province,district,url,district_code,district_name,flg,html;

			province = $('#province').val();
			city = $('#city').val();
		    district = $("#district").val();
			if(province){
				district_pcode = province;
			}
			if(city){
				district_pcode = city;
			}
			if(district){
				district_pcode = district;
			}

			if(!district_pcode){
				district_pcode = 0;
			}
			flg = true;
			district_name = $("#area_name").val();
			district_code = $("#area_code").val();
			
			if(!district_name){
				alert('地区名不能为空');

				flg = false;
				
			}
			if(!district_code){
				alert('邮编不能为空');

				flg = false;
			}
			if(parseInt(district_code) != district_code){
					alert('邮编只能为数字！');flg = false;
			}
			if(district_code.length >6){
					alert('邮编不能在于6位！');flg = false;
			}
			url = "<?php echo site_url('admin/area/doareaadd')?>";
			if(flg){
					$.post(url,{district_name:district_name,district_pcode:district_pcode,district_code:district_code},function(msg){
						msg = eval('('+msg+')');
						if(msg.err== 0){
							alert(msg.msg);
						}else{

								html = '<tr id="area_"'+district_code+'>';
								html += '<td>';
								html += '<div class="checker">';
								html += '<span>';
								html += '<input type="checkbox" value="" name="newsletter">';
								html += '</span>';
								html += '</div>';
								html += '</td>';
								html += '<td id="district_name_'+msg.data+'"> '+district_name+' </td>';
								html += '<td> '+district_code+' </td>';
								html += '<td>';
								html += '<a class="edit" href="javascript:jsv.editName(\''+msg.data+'\',\''+district_name+'\')">Edit</a>';
								html += '</td><td>';
								html += '<a class="delete" href="javascript:jsv.delarea('+msg.data+')">Delete</a>';
								html += '</td></tr>';

							 $("#sample_editable_1 tbody tr").eq(0).replaceWith(html);
							
						}
					});
			}
		
		},
		'delarea':function(id){
					var ids,
						cAll,
						resu;
					ids = null;
					cAll = this.check_all();
				
					if(id){
						ids = id;
					}else{
						ids = cAll.toString();
					}
					if(ids == ''){
						alert('请选择删除项！');return false;
					}
				
					resu = window.confirm('你确定要删除该项？');
					if(resu){
						url = "<?php echo site_url('admin/area/dodel')?>";
						
						$.post(url,{ids:ids},function(msg){
							msg = eval(msg);
							if(msg == 0){
								alert('删除失败！');
							}else{
								for(i = 0;i<msg.length;i++){
									
									$("#area_"+msg[i]).remove();
								}
								
							}
						});
					}
					
					
		},
		'scheme_recommend':function(){
			//var scheme_recommend = $("input[tar_key='check']").eq(0);
			if($("#scheme_title-1").val()==''){
				
					alert('推荐设计师标题不能为空');return false;
			}
			
		
			for(var i=0;i<5;i++){
				var inputvalue = $("input[tar_key='check']").eq(i).val();
				if(parseInt(inputvalue) != inputvalue) {

					alert('推荐项只能为数字，不能为空！');	return false;
				}
				
			}


			return true;
		
		},
		'index3D':function(){
				
			if(parseInt($("#index3D").val()) != inputvalue){
				alert('推荐项只能为数字，不能为空！');	return false;
			}
		},
		"scheme_tag":function(){
			var str;
			var  a = new Array();
			str=$("#scheme_tag").val(); //这是一字符串
			var strs= new Array(); //定义一数组

			strs=str.split(",")||str.split("，"); //字符分割     

			if(this.notnull(strs)){
				alert('推荐项不能重复');return false;
			}
			if(strs.length>=10)
			{
				alert('推荐项个数只能为10以内');return false;
			}		
			return true;
		},
		'notnull':function(a){
			 return /(\x0f[^\x0f]+)\x0f[\s\S]*\1/.test("\x0f"+ a.join("\x0f\x0f") +"\x0f");
		},
		"product_add":function(){
			var prid = $('#product_add').val();
				if(prid != ''){

					var url = "<?php echo site_url('admin/product/dogetProductNameByPid')?>";
					var html = '';
					$.post(url,{prid:prid},function(msg){
						msg = eval('('+msg+')');
						if(msg.err== 0){
							$("#pattern_add").html("<option value=''>-请选择-</option>");
							$("#s_c_tag_id").html("<option value=''>-请选择-</option>");
							$("#pattern_id").html("<option value=''>-请选择-</option>");
							$("#series_id").html("<option value=''>-请选择-</option>");
						}else{
							html += '<option value="">-请选择-</option>';
							for(i in msg.data){
								html += "<option value='"+msg.data[i].s_class_id+"' >"+msg.data[i].s_class_name+"</option>";
								$("#pattern_add").html(html);
							}
						}
					});
				}else{
					$("#pattern_add").html("<option value=''>-请选择-</option>");
					$("#s_c_tag_id").html("<option value=''>-请选择-</option>");
					$("#pattern_id").html("<option value=''>-请选择-</option>");
					$("#series_id").html("<option value=''>-请选择-</option>");
				}
		},
		"pattern_add":function(){
			var p_pid = $('#pattern_add').val();
				if(p_pid != ''){

					var url = "<?php echo site_url('admin/product/doproductbChild')?>";
					var html = '';
					$.post(url,{p_pid:p_pid},function(msg){
						msg = eval('('+msg+')');
						if(msg.err== 0){
							$("#s_c_tag_id").html("<option value=''>-请选择-</option>");
							//alert(msg.msg);
						}else{
							html += '<option value="">-请选择-</option>';
							for(i in msg.data){
								html += "<option value='"+msg.data[i].tag_id+"' >"+msg.data[i].tag_name+"</option>";
								$("#s_c_tag_id").html(html);
							}
						}
					});
				}else{
					$("#s_c_tag_id").html("<option value=''>-请选择-</option>");
				}
		},
		'checkpattern_add':function(){
			//var scheme_recommend = $("input[tar_key='check']").eq(0);
			if($("#s_c_tag_id").val()==0){
				
					alert('分类不能为空');return false;
			}
			
			if($("#pattern_type").val()==''){
				
					alert('款式名称不能为空');return false;
			}
			
			return true;
		
		},

		'checkbrands_add':function(){
			/*//var scheme_recommend = $("input[tar_key='check']").eq(0);
			if($("#pattern_add").val()==0){
				
					alert('分类不能为空');return false;
			}*/
			
			if($("#brand_name").val()==''){
				
					alert('品牌名称不能为空');return false;
			}
			//if(!IsURL($("#brand_url").val())){
			//	alert('请填写正确的网址');return false;
			//}
			return true;
		
		},
		"brands_series_add":function(){
			var p_pid = $('#pattern_add').val();
				if(p_pid != ''){

					var url = "<?php echo site_url('admin/product/dobrands')?>";
					var html = '';
					$.post(url,{p_pid:p_pid},function(msg){
						msg = eval('('+msg+')');
						if(msg.err== 0){
							$("#s_c_tag_id").html("<option value=''>-请选择-</option>");
							//alert(msg.msg);
						}else{
							html += '<option value="">-请选择-</option>';
							for(i in msg.data){
								html += "<option value='"+msg.data[i].brand_id+"' >"+msg.data[i].brand_name+"</option>";
								$("#s_c_tag_id").html(html);
							}
						}
					});
				}else{
					$("#s_c_tag_id").html("<option value=''>-请选择-</option>");
				}
		},
		"checkbrands_series_add":function(){
			//var scheme_recommend = $("input[tar_key='check']").eq(0);
			if($("#s_c_tag_id").val()==0){
				
					alert('品牌不能为空');return false;
			}
			
			if($("#series_name").val()==''){
				
					alert('系列名称不能为空');return false;
			}
			return true;
		},
		"brandshow":function(){
			var p_pid = $('#pattern_add').val();
				if(p_pid != ''){

					var url = "<?php echo site_url('admin/product/dobrands')?>";
					var html = '';
					$.post(url,{p_pid:p_pid},function(msg){
						msg = eval('('+msg+')');
						if(msg.err== 0){
							$("#brand_id").html("<option value=''>-请选择-</option>");
							//alert(msg.msg);
						}else{
							html += '<option value="">-请选择-</option>';
							for(i in msg.data){
								html += "<option value='"+msg.data[i].brand_id+"' >"+msg.data[i].brand_name+"</option>";
							
							}
								$("#brand_id").html(html);
						}
					});
				}else{
					$("#brand_id").html("<option value=''>-请选择-</option>");
				}
			},
			"productshow":function(){
				var sid = $('#s_c_tag_id').val();
				var c_id = $('#pattern_add').val();
				if(sid != ''){
					var url = "<?php echo site_url('admin/product/dogetPatternNameBySid')?>";
					var html = '';
					$.post(url,{sid:sid,c_id:c_id},function(msg){
						msg = eval('('+msg+')');
						if(msg.err== 0){
							$("#pattern_id").html("<option value=''>-请选择-</option>");
							//alert(msg.msg);
						}else{
							html += '<option value="">-请选择-</option>';
							for(i in msg.data){
								html += "<option value='"+msg.data[i].pattern_id+"' >"+msg.data[i].pattern_type+"</option>";
								
							}
							$("#pattern_id").html(html);
						}
					});
				}else{
					$("#pattern_id").html("<option value=''>-请选择-</option>");
				}
		},
		"seriesshow":function(){
			var bid = $('#brand_id').val();
			var service_id = $("#service_id").val();
			if(!service_id){
				service_id = 0;
			}
			if(bid != ''){
				var url = "<?php echo site_url('admin/product/dogetSeriesNameByBid')?>";
				var html = '';
				$.post(url,{bid:bid,service_id:service_id},function(msg){
					msg = eval('('+msg+')');
					if(msg.err== 0){
						$("#series_id").html("<option value=''>-请选择-</option>");
						//alert(msg.msg);
					}else{
						html += '<option value="">-请选择-</option>';
						for(i in msg.data){
							html += "<option value='"+msg.data[i].series_id+"' >"+msg.data[i].series_name+"</option>";
					
						}
						$("#series_id").html(html);
					}
				});
			}else{
				$("#series_id").html("<option value=''>-请选择-</option>");
			}
		},
		"checkproductadd":function(){
			//var scheme_recommend = $("input[tar_key='check']").eq(0);
			if($("#brand_id").val()==0 || $("#brand_id").val()==''){
				
					alert('品牌不能为空');return false;
			}
			
			//if($("#series_id").val()=='' || $("#series_id").val()==0){
				
					//alert('品牌系列名称不能为空');return false;
			//}
			//if($("#pattern_id").val()=='' || $("#pattern_id").val()==0){
				//alert('品牌款式不能为空');return false;
			//}
			if($("#product_name").val() == ''){
				alert('产品名称不能为空');return false;
			}
			if(!floatCheck($("#product_price").val())){
				alert('产品参考价格格式有误');return false;
			}
			//if($("#product_unit").val() == ''){
			//	alert('产品单位不能为空');return false;
			//}
			//if($("#product_long").val() == ''){
				//alert('产品长不能为空');return false;
			//}
			//if($("#product_width").val() == ''){
				//alert('产品宽不能为空');return false;
			//}
			//if($("#product_high").val() == ''){
				//alert('产品高不能为空');return false;
			//}
			//if($("#product_brand_code").val() == ''){
				//alert('品牌编号不能为空');return false;
			//}
			return true;
		},
		"searchProduct":function(){
			var brand_id = $('#brand_id').val();
			var series_id = $('#series_id').val();
			var pattern_id = $('#pattern_id').val();
			var key_word = $('#product_key_word').val();
			var code = $('#code').val();
			var url = "<?php echo site_url('admin/room/dogetProduct')?>";
			var html = '';
			$.post(url,{brand_id:brand_id,series_id:series_id,pattern_id:pattern_id,key_word:key_word,code:code},function(msg){
				msg = eval('('+msg+')');
				if(msg.err== 0){
					$("#product_id").html("<option value=''>-请选择-</option>");
					//alert(msg.msg);
				}else{
					html += '<option value="">-请选择-</option>';
					for(i in msg.data){
						html += "<option value='"+msg.data[i].product_id+"' >"+msg.data[i].product_name+":"+msg.data[i].product_long+"*"+msg.data[i].product_width+"*"+msg.data[i].product_high+"</option>";
				
					}
					$("#product_id").html(html);
				}
			});
			
		},
		"checkProductItem":function(){
			//var scheme_recommend = $("input[tar_key='check']").eq(0);
			if($("#product_id").val()==0 || $("#product_id").val()==''){
				
					alert('产品不能为空');return false;
			}
			
			//if(!IsURL($("#poduct_url").val())){
				
					//alert('产品链接地址格式不正确');return false;
			//}
		
			if(!minusfloatCheck($("#hot_x").val())){
				alert('热点U坐标不是数字');return false;
			}

			
			if(!reg.exec($("#hot_y").val())){
			alert($("#hot_y").val());
				alert('热点V坐标不是数字');return false;
			}
			return true;
		},
		"toshow":function(){
		
			if($("#action").val() == 'toShow'){
				$(".toShow").show();
			}else{
				$(".toShow").hide();
			}
			
		},
		'del_item':function(id){
					
				var ids,
				cAll,
				resu;
				ids = null;
				cAll = this.check_all();
			
				if(id){
					ids = id;
				}else{
					ids = cAll.toString();
				}
		
				if(ids == ''){
					alert('请选择删除项！');return false;
				}
	
				resu = window.confirm('你确定要删除该项？');
				if(resu){
				
					url = "<?php echo site_url('admin/room/dodel_item')?>";
					
					$.post(url,{ids:ids},function(msg){
						msg = eval(msg);
						if(msg == 0){
							alert('删除失败！');
						}else{
							for(i = 0;i<msg.length;i++){
								$("#t_ct"+msg[i]).remove();
							}
							//window.location.reload();
						}
					});
				}
			},
			"checitem":function(){
				
				//if(!IsURL($("#poduct_url").val())){
					
						//alert('产品链接地址格式不正确');return false;
				//}
			
				if(!minusfloatCheck($("#hot_x").val())){
					alert('热点U坐标不是数字');return false;
				}
				if(!minusfloatCheck($("#hot_y").val())){
					alert('热点V坐标不是数字');return false;
				}
				return true;
			},
			"checkproductedit":function(){
				
				if($("#product_name").val() == ''){
					alert('产品名称不能为空');return false;
				}
				if(!floatCheck($("#product_price").val())){
					alert('产品参考价格格式有误');return false;
				}
				if($("#product_unit").val() == ''){
					alert('产品单位不能为空');return false;
				}
				if($("#product_long").val() == ''){
					alert('产品长不能为空');return false;
				}
				if($("#product_width").val() == ''){
					alert('产品宽不能为空');return false;
				}
				if($("#product_high").val() == ''){
					alert('产品高不能为空');return false;
				}
				if($("#product_brand_code").val() == ''){
					alert('品牌编号不能为空');return false;
				}
				return true;
			},
			"system_action_group_add":function(){
				$group_id = $("#group_id").val();
				if($group_id == 'creat_group'){
					$("#group_name").show();
				}else{
					$("#group_name").hide();
				}
			},
			"system_admin_group_add":function(){
			
				$group_ids = $("#agroup_id").val();
				if($group_ids == 'creat_group'){
					
					window.location.href ="<?php echo site_url('admin/system/create_group');?>";
				}else{
					//this.flg['1'] = 1;
					$("#group_name").hide();
				}
			},
			"packProduct":function(pack_id,id){

				var ids,
				cAll,
				resu,url,alls;
				ids = null;
				cAll = this.check_all();
				alls = this.all_check();

				if(id){
					ids = id;
				}else{
					ids = cAll.toString();
				}
		
			
				url = "<?php echo site_url('admin/product/dopackitemAdd')?>";
					
					$.post(url,{ids:ids,pack_id:pack_id,alls:alls.toString()},function(msg){
						msg = eval(msg);
						if(msg == 0){
							alert(' 操作成功！');
						}else{
							alert(msg+'操作失败！');
						}
					});
			},
			"teston":function(name,set,url){
				var flg = 1;
				var service_ename = $("#service_ename").val();
				if(!url){
					url = "<?php echo site_url('admin/member/dois_user')?>";
				}
				
	   			 $.ajax({ 
	              type : "POST", 
	              url : url, 
	              data : "service_name=" + name+"&set=" + set +"&service_ename=" + service_ename, 
	              async : false, 
	              success : function(data){ 
	                data = eval("(" + data + ")"); 
	              	if(data == 1){
	              		flg = 0;
	              	}
	              } 
	              });  
   			 	if(flg == 1){
   			 		return true;
   			 	}else{
   			 		return false;
   			 	}
			},
			"is_user":function(vb,set){
				if(!this.teston(vb.value,set)){
					alert('登录名己占用，不能添加！');
				}
			},

			"isService_ename":function(vb,set){
				var url = "<?php echo site_url('admin/member/doService_ename');?>";
				if(!this.teston(vb.value,set,url)){
					alert('经销商会员己占用，不能添加！');
				}
			},
			"isCompany":function(vb,set){
				var url = "<?php echo site_url('admin/member/doIsCompany');?>";
				if(!this.teston(vb.value,set,url)){
					alert('公司名己占用，不能添加！');
				}
			},
			"memberSub":function(){

				var service_name = $("#service_name").val();
				
				var service_company = $("#service_company").val();
				var service_id = $("#service_id").val();
				var join_id =  $("input[name='join_id']").val();
				var service_license = $("input[name='service_license']").val();
				var service_license_bak = $("input[name='service_license_bak']").val();
				
				if(!service_name){
					alert('登录名不能为空！');
					return false;
				}
				
				if(!service_company){
					alert('公司名不能为空！');
					return false;
				}
				
				if(join_id || service_id){
					if(!service_license_bak && !service_license){
						alert("请上传营业执照图片");return false;
					}
				}else{

					if(!service_license){
						alert("请上传营业执照图片");return false;
					}
				}
				$isService_ename = "<?php echo site_url('admin/member/doService_ename');?>";
				$isCompany = "<?php echo site_url('admin/member/doIsCompany');?>";

   			 	if(!this.teston(service_name,service_id)){
					alert('登录名己占用，不能添加！');
					return false;
					
				}else if(!this.teston(service_company,service_id)){
					alert('公司名己占用，不能添加！');
					return false;
					
				}else{
					return true;
				}
			},
			"subnewJoin":function(){
				var service_name = $("#service_name").val();
				var service_id = $("#service_id").val();
				if(service_name){
					if(!service_name){
						alert('会员名不能为空！');
						return false;
					}
			
					$isService_name = "<?php echo site_url('admin/member/doService_name');?>";
	   			 	if(!this.teston(service_name,service_id,$isService_name)){
						alert('会员名己占用，不能添加！');
						return false;
					}else{
						return true;
					}
				}else{
					return true;
				}
			},
			"del_All":function(id,url){

					var ids,
						cAll,
						resu;
					ids = null;
					cAll = this.check_all();
				
					if(id){
						ids = id;
					}else{
						ids = cAll.toString();
					}
					if(ids == ''){
						alert('请选择删除项！');return false;
					}
				
					resu = window.confirm('你确定要删除该项？');
					if(resu){
						url = url;
				
						$.post(url,{ids:ids},function(msg){
							msg = eval(msg);
							if(msg == 0){
								alert('删除失败！');
							}else{
								for(i = 0;i<msg.length;i++){
									
									$("#area_"+msg[i]).remove();
								}
								
							}
						});
					}
					
			},
			'is_modules':function(url,key,id){
				var service_id = $("#service_id").val();
				var flg = 1;
	   			 $.ajax({ 
	              type : "POST", 
	              url : url, 
	              data : "key=" + key +"&id=" + id +"&service_id=" + service_id, 
	              async : false, 
	              success : function(data){ 
	                data = eval("(" + data + ")"); 
	              	if(data == 1){
	              		flg = 0;
	              	}
	              } 
	              });  
   			 	if(flg == 1){
   			 		return true;
   			 	}else{
   			 		return false;
   			 	}
			},
			'modules':function(){
				var url,id,name,key;
				url = "<?php echo site_url('admin/service/dois_modules')?>";
				name = $("#module_name").val();
				if( name == ''){
					alert('模块名称不能为空');return false;
				}
				key = $("#module_key").val();
				if(!keyCheck(key)){
					alert('模块KEY不能为空,只能由12位字母，数字匹配');return false;
				}
				id = $("#module_id").val();
				if(id){
					if(!this.is_modules(url,key,id)){
						alert('模块KEY不能重复，只能唯一');return false;
					}
				}else{
					if(!this.is_modules(url,key,id)){
						alert('模块KEY不能重复，只能唯一');return false;
					}
				}
				return true;
			},
			"action":function(){
				var url,id,name,key;
				url = "<?php echo site_url('admin/service/dois_action')?>";
				name = $("#action_name").val();
				if( name == ''){
					alert('功能名称不能为空');return false;
				}
				key = $("#action_key").val();
				if(!keyCheck(key)){
					alert('功能KEY不能为空,只能由12位字母，数字匹配');return false;
				}
				id = $("#action_id").val();
				if(id){
					if(!this.is_modules(url,key,id)){
						alert('功能KEY不能重复，只能唯一');return false;
					}

				}else{
					if(!this.is_modules(url,key,id)){
						alert('功能KEY不能重复，只能唯一');return false;
					}
				}
				return true;
			},
			"del_Module":function(){
				this.del_MoAcdule('',"<?php echo site_url('admin/service/doDelModule');?>");
			},
			"del_Action":function(){
				this.del_MoAcdule('',"<?php echo site_url('admin/service/doDelAction');?>");
			},
			"del_MoAcdule":function(id,url){

					var ids,
						cAll,
						resu;
					ids = null;
					cAll = this.check_all();
				
					if(id){
						ids = id;
					}else{
						ids = cAll.toString();
					}
					if(ids == ''){
						alert('请选择删除项！');return false;
					}

					resu = window.confirm('你确定要删除该项？');
					if(resu){
						url = url;
				
						$.post(url,{ids:ids},function(msg){
							msg = eval(msg);
							if(msg == 0){
								alert('删除失败！');return false;
							}else{
								window.location.reload();
							}
						});
					}
					
			},
			"action_module":function(){
				var module_key = $('#module_key').val();
				var url = "<?php echo site_url('admin/service/dogetActionModule')?>";
				var html = '';
				$.post(url,{module_key:module_key},function(msg){
					msg = eval('('+msg+')');
					if(msg.err== 0){
						$("#action_pkey").html("<option value='0'>顶级功能</option>");
						//alert(msg.msg);
					}else{
						html += '<option value="0">顶级功能</option>';
						for(i in msg.data){
							html += "<option value='"+msg.data[i].action_id+"' >&nbsp;&nbsp;"+msg.data[i].action_name+"</option>";
					
						}
						$("#action_pkey").html(html);
					}
				});
			},
			"is_shop":function(){

				if(!this.is_doshop()){
					alert("服务商下门店名己占用，不能添加！");
				}
			},
			"is_doshop":function(){

				var service_id,shop_name,url,shop_id;
				service_id = $("select[name='service_id']").val();
				shop_name = $("#shop_name").val();
				if($('#shop_id').val()){
					shop_id = $('#shop_id').val();
				}else{
					shop_id = "";
				}
		
				url = "<?php echo site_url('admin/shop/is_Ajaxshop')?>";
					
				if(!this.is_modules(url,shop_name,service_id+"@"+shop_id)){

					return false;
					
				}else{
					return true;
				}

			},
			"shopSub":function(){
				var shop_name = $("#shop_name").val();
				var service_id = $("select[name='service_id'").val();
				if(!shop_name){
					alert('门店不能为空！');
					return false;
				}
   			 	if(!this.is_doshop()){
					alert('门店名己占用，不能添加！');
					return false;
				}
				return true;
			},
			"addBrandOfShop":function(shop_id,id){
				var ids,
					cAll,
					resu,
					url;
					ids = null;
					url = "<?php echo site_url('admin/shop/doAddBrandOfShop');?>";
					cAll = this.check_all();
				
					if(id){
						ids = id;
					}else{
						ids = cAll.toString();
					}
					if(ids == ''){
						alert('请选择项！');return false;
					}
				
					resu = window.confirm('你确定该项？');
					if(resu){
						$.post(url,{ids:ids,shop_id:shop_id},function(msg){
							msg = eval(msg);
							if(msg == 0){
								alert('关联失败！');
							}else{
								for(i = 0;i<msg.length;i++){
									$("#t_ctt"+msg[i]).remove();
								}
							}
						});
					}
			},
			"delBrandShop":function(id){
				var ids,
					cAll,
					resu,
					url;
					ids = null;
					url = "<?php echo site_url('admin/shop/doDelBrandShop');?>";
					cAll = this.check_all();
				
					if(id){
						ids = id;
					}else{
						ids = cAll.toString();
					}
					if(ids == ''){
						alert('请选择解除项！');return false;
					}
				
					resu = window.confirm('你确定解除该项？');
					if(resu){
						$.post(url,{ids:ids},function(msg){
							msg = eval(msg);
							if(msg == 0){
								alert('解除关联失败！');
							}else{
								for(i = 0;i<msg.length;i++){
									$("#t_ct"+msg[i]).remove();
								}
							}
						});
					}
			},
			"serviceShop":function(){
				var service_id = $("#service_id").val(),
					url = "<?php echo site_url('admin/serviceUser/doGetShopInfo')?>",
					service_user_id = $("#service_user_id").val();
					if(!service_user_id){
						service_user_id = '';
					}
				$.post(url,{service_id:service_id,service_user_id:service_user_id},function(msg){
					//msg = eval(msg);
					if(msg != 0){
						$("#shopInfod").html(msg);
					}else{
						$("#shopInfod").html("");
					}
				});
			},
			"is_ServiceUser":function(){
				if(!this.is_doServiceUser()){
					alert("登录名只能唯一");
				}
			},
			"is_doServiceUser":function(){
				var service_user_name,service_user_id;
		
				service_user_name = $("#service_user_name").val();
		
				if($("#service_user_id").val()){
					service_user_id = $("#service_user_id").val();
				}else{
					service_user_id = "";
				}
		
				url = "<?php echo site_url('admin/serviceUser/is_AjaxServiceUser')?>";
				if(!this.is_modules(url,service_user_name,service_user_id)){

					return false;
					
				}else{
					return true;
				}

			},
			"serviceUserSub":function(){
				var service_user_name = $("#service_user_name").val();
				if(!service_user_name){
					alert('登录名不能为空！');
					return false;
				}
   			 	if(!this.is_doServiceUser()){
					alert('登录名被占用，不能添加！');
					return false;
				}
				return true;
			},
			"delete":function(id,url){
				var ids,
					cAll,
					resu,len;
				ids = null;
				cAll = this.check_all();
			
				if(id){
					ids = id;
				}else{
					ids = cAll.toString();
				}
				if(ids == ''){
					alert('请选择删除项！');return false;
				}
				resu = window.confirm('你确定要删除该项以及它的子级？');
				if(resu){
					$.post(url,{ids:ids},function(msg){
						msg = eval('('+msg+')');
						if(msg.err == 1){
							alert(msg.msg);
						}else{
							
							len = msg.data.length;
							for(i = 0;i<len;i++){			
								$("#t_s"+msg.data[i]).remove();
							}
						}
					});
				}
			},
			"delServiceUser":function(id){
			  var url = "<?php echo site_url('admin/serviceUser/dodel')?>",
			  	  result = this.delete(id,url);
			},
			"serviceBrSe":function(){
				var service_id = $('#service_id').val();
				if(service_id != '0'){
					var url = "<?php echo site_url('admin/serviceBrSe/doBrandsBServiceId')?>";
					var html = '';
					$.post(url,{service_id:service_id},function(msg){
						msg = eval('('+msg+')');
						if(msg.err== 0){
							$("#s_c_tag_id").html("<option value='0'>请选择 </option>");
							alert(msg.msg);
						}else{
								html+="<option value='0'>请选择 </option>";
							for(i in msg.data){
								html += "<option value='"+msg.data[i].brand_id+"' >"+msg.data[i].apply_brand_name+"</option>";
								$("#s_c_tag_id").html(html);
							}
						}
					});
				}else{
					$("#s_c_tag_id").html("<option value='0'>请选择 </option>");
	
		
				}
			},
			"serviceProductSub":function(){
				var service_id,brand_id,series_id,goods_title,goods_id,flg,addColor,editColor,colorTileCount_bak,colorTileCount;
				flg = false;
				goods_id = $("input[name='goods_id']").val();
				for (var i=1; i <= 5; i++) { 
					if($("input[name='good_pic"+i+"']").val()){
						flg = true;
					}
				}
				if(goods_id){
					for (var j=1; j <= 5; j++) { 
						if($("input[name='good_pic"+j+"_bak']").val()){
							flg = true;
						}
					}
				}
				service_id = $("#service_id").val();
				brand_id = $("#brand_id").val();
				series_id = $("#series_id").val();
				goods_title = $("#goods_title").val();
				if(!service_id){
					alert("请选择经销商");
					return false;
				}
				if(!brand_id){
					alert("请选择品牌");
					return false;
				}
				if(!series_id){
					alert("请选择系列");
					return false;
				}
				if(!goods_title){
					alert("标题不能为空");
					return false;
				}
				addColor = $("input[name='goods_color[]']").val();
				editColor = $("input[name='images_bak[]']").val();
				if(goods_id){
					if(!addColor && !editColor){
						alert("至少上传一张颜色贴面！");
						return false;
					}

				}else{
					if(!addColor){
						alert("至少上传一张颜色贴面！");
						return false;
					}
				}

				colorTileCount_bak = $("input[name='goods_color_title_bak[]']").length;
				for (var i=0; i < colorTileCount_bak; i++) { 
					if(!$("input[name='goods_color_title_bak[]']").eq(i).val()){
						alert("贴面图描述不能为空！");return false;
					}
				}
				colorTileCount = $("input[name='goods_color_title[]']").length;
				for (var j=0; j < colorTileCount; j++) { 
					if(!$("input[name='goods_color_title[]']").eq(j).val()){
						alert("贴面图描述不能为空！");return false;
					}
				}
				if(!flg){
					alert("至少上传一张缩略图！");
					return false;
				}
				return true;
			},
			'join_brand':function(id,service_id){
				var ids,
					cAll,
					resu,len;
				ids = null;
				cAll = this.check_all();
			
				if(id){
					ids = id;
				}else{
					ids = cAll.toString();
				}
				if(ids == ''){
					alert('请选择项！');return false;
				}
				url = "<?php echo site_url('admin/member/dojoin_brand')?>";
				resu = window.confirm('你确定要添加？');
				if(resu){
					$.post(url,{ids:ids,service_id:service_id},function(msg){
						msg = eval('('+msg+')');
						if(msg.err == 1){
							alert(msg.msg);
						}else{
							
							len = msg.data.length;
							for(i = 0;i<len;i++){			
								$("#t_s"+msg.data[i]).remove();
							}
						}
					});
				}
			},
			"goodsColorUnlink":function(unlinUrl){
				var delInputVal,url;
				delInputVal = $("#delGoddsColor").val();
				if(unlinUrl){
					if(delInputVal){
						url = delInputVal+'@'+unlinUrl;
					}else{
						url = unlinUrl;
					}	
				}else{
					url = delInputVal;
				}
				 $("#delGoddsColor").val(url);
			},
			"changeSeriesC":function(){
				var s_c_tag_id = $("#s_c_tag_id").val(),
				url = "<?php echo site_url('admin/product/doClassByBrand_id')?>";	
				$.post(url,{brand_id:s_c_tag_id},function(msg){
					if(msg != 0){
						$("#brand_class").html(msg);
					}else{
						$("#brand_class").html("");
					}
				});
			},
			"updatePwd":function(id,flg){
				var url;
				if(flg =='service'){
					url = "<?php echo U('admin/member/updatePwd'); ?>";
				}else if(flg == 'user'){
					url = "<?php echo U('admin/serviceUser/updatePwd'); ?>";
				}else if(flg == 'rank'){
					url = "<?php echo U('admin/member/updateRank'); ?>";
				}else{
					alert("请正确操作！");return false;
				}
				$.post(url,{id:id},function(msg){
					myDialog = art.dialog();
					myDialog.content(msg);// 填充对话框内容 
					myDialog.title('密码重置');
					
				});
			},
			"pwdCallback":function(){
				var newPwd = $("#newPwd").val();
				var newActPwd = $("#newActPwd").val();
				if(!passwordCheck(newPwd)){
					alert("密码只能字母,数字,逗号,叹号,横线,问号,百分号，请输入正确！");
					return false;
				}
				if(!passwordCheck(newActPwd)){
					alert("密码只能字母,数字,逗号,叹号,横线,问号,百分号，请输入正确！");
					return false;
				}
				if(newPwd != newActPwd){
					alert("两次输入的密码不对，请重新输入！");
					return false;
				}
				return true;
				
			},
			"check_Menu":function(){
				var c_id = $("#c_id").val();
				var c_name = $("#c_name").val();
				var c_pic = $("#c_pic").val();
				var c_url = $("#c_url").val();
				if(!c_name){
					alert('菜单名称不能为空');
					return false;
				} 
				/*if(!IsURL(c_url)){
					alert('菜单链接地址不能为空'); 
					return false;
				} 
*/	
				if(!c_url){
					alert('菜单链接地址不能为空'); 
					return false;
				} 
				var url = "<?php echo site_url('admin/weixinMenu/is_AjaxMenuOpt');?>";
				if(!this.is_modules(url,c_name,c_id)){
					alert("菜单名称己占用");
					return false;
				}
				return true;
			},
			"check_Vas":function(){
				var vas_id = $("#vas_id").val();
				var vas_name = $("#vas_name").val();
				
				if(!vas_name){
					alert('服务名称不能为空');
					return false;
				} 
				
				var url = "<?php echo site_url('admin/vasService/is_AjaxVas');?>";
				if(!this.is_modules(url,vas_name,vas_id)){
					alert("服务名称己占用");
					return false;
				}
				return true;
			},
			
			"showDiv":function(eThis){
				var value,
					 oKey,
					 oType;

				value = eThis.value;
				oKey  = $("[sc=key]");
				oType = $("[sc=type]"); 
				if(value == 3){
					oKey.show();
					oType.show();
				}else{
					oKey.hide();
					oType.hide();
				}
			},
			"delAll":function(id,url){
				var ids,
					cAll,
					resu,len;
				ids = null;
				cAll = this.check_all();
			
				if(id){
					ids = id;
				}else{
					ids = cAll.toString();
				}
				if(ids == ''){
					alert('请选择项！');return false;
				}
		
				resu = window.confirm('你确定要删除？');
				if(resu){
					$.post(url,{ids:ids},function(msg){
						msg = eval('('+msg+')');
						if(msg.err == 1){
							alert(msg.msg);
						}else{
							
							len = msg.data.length;
							for(i = 0;i<len;i++){			
								$("#t_s"+msg.data[i]).remove();
							}
						}
					});
				}
			},
			"sysInforMation":function(){
				var si_title,it_id,si_abstract,si_pic;
				si_title = $("#si_title").val();
				it_id = $("#it_id").val();
				si_abstract = $("#si_abstract").val();
				si_pic = $("#si_pic").val();
				if(!si_title || !it_id){
					alert('标题，分类，图片不能为空，请正确操作！');
					return false;
				}
				return true;
			},
			"newAuth":function(){
				var rr_card_number = $("#rr_card_number").val();
				var ss_type = $("#ss_type").val();
				var spreader_code = $("#spreader_code").val();
				if( spreader_code && (ss_type == 1)  && !rr_card_number){
					alert('充值卡号不能为空，请填写卡号！');
					return false;
				}
				return true;
			},
			"check_product":function(){
				var pc_id = $("#pc_id").val();
				var pc_name = $("#pc_name").val();
				
				if(!pc_name){
					alert('产品分类名称不能为空');
					return false;
				} 
				
				var url = "<?php echo site_url('admin/productClass/is_AjaxProduct');?>";
				if(!this.is_modules(url,pc_name,pc_id)){
					alert("产品分类名称己占用");
					return false;
				}
				return true;
			}
				
				

	};
	
</script>
