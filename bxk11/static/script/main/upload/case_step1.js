define(function(require, exports, module) {
	
	var case_com = require('../../sub/upload/case_com');

	var com = require('../../sub/upload/upload_com');

	var relatedInput = require('../../lib/plugin/form/relatedInput');

	var formcheck = require('../../lib/plugin/form/formCheck');

	var request = require('../../lib/http/request');

	var temp = 
	'<li class="pic_list" script-role="self_list">'+
		'<dl>'+
			'<dt>'+
				'<img src="" width="97" height="93" /  script-role="self_type_image">'+
			'</dt>'+
			'<dd>'+
				'<p class="pt_5 pb_5" script-role="self_type"></p>'+
				'<p>'+
					'<span script-role="self_detail"></span>'+
					'<span script-role="self_square"></span>'+
				'</p>'+
			'</dd>'+
		'</dl>'+
	'</li>';

	/* 获取装修项目 */
	(function(){

		var oSelect,
			target,
			oCreate;

		oSelect = $('[script-role = project]');
		target = '/index.php/view/project/getlist';
		oCreate = $('[script-role = create_inspir]');

		com.checkCreate(oSelect, oCreate, 'show');

		com.getSelectData(oSelect, target, null, function(data){

			com.renderOption(oSelect, data.data, 'project_id', 'project_name', '创建装修项目', 'check');

		}, function(name, id ,url){

			if(url)
			{
				window.location = url;
			}
			else
			{
				com.checkCreate(oSelect, oCreate, 'show', '创建装修项目');
			}

		}, '创建装修项目');

	})();

	/* 获取省市 */
	(function(){

		var oProvince,
			oCity,
			sProvinceUrl,
			sChangeUrl,
			sStartId;

		oProvince = $('[script-role = province]');
		oCity = $('[script-role = city]');
		sProvinceUrl = '/index.php/view/project/getarea';
		sChangeUrl = '/index.php/posts/userset/getdistrict';

		com.getSelectData(oProvince, sProvinceUrl, null, function(data){

			com.renderOption(oProvince, data.data.province, 'district_code', 'district_name');
			
			com.renderOption(oCity, data.data.city, 'district_code', 'district_name');

		}, function(name, id){

			com.getSelectData(oProvince, sChangeUrl, {district_pcode: id}, function(data){

				com.renderOption(oCity, data.data, 'district_code', 'district_name');

			});

		});

	})();

	/* 上传 */
	(function(){

		var oList,
			oImage,
			oType,
			oDetail,
			oSquare,
			realData,
			oRg;

		com.upload({
			sRole: 'upload_btn_area',
			sId: 'upload_btn_area',
			temp: temp,
			width: 164,
			height: 111,
			btnClass: 'case2',
			btnbg: 'url("/static/images/lib/button/button.png") no-repeat -341px -321px',
			target: '/index.php/upload/apartment',
			queueId: 'step1_list',
			addWay : 'prepend',
			queueSizeLimit : 1,
			onStart: function()
			{
				if(oList)oList.remove();
			},
			onSelectErr: function()
			{
				alert('户型图只限上传一张');
			},
			onsuc: function(file, data)
			{	
				oList = $('[script-role = self_list]');
				oImage = $('[script-role = self_type_image]');

				realData = eval('('+ data +')');
				
				if(!realData.err)
				{
					oImage.attr('src', realData.data);
				}
				else
				{	
					oList.remove();

					alert(realData.msg);
				}
			}
		});

	})();

	/* 联想楼盘名称 */
	(function(){

		var oProvince,
			oCity,
			sProvince,
			sCity,
			oBuild,
			oType,
			sGetUrl,
			newJson,
			oUl,
			oSquare;

		oType = $('[script-role = house_type]');

		oProvince = $('[script-role = province]');

		oCity = $('[script-role = city]');

		sGetUrl = '/index.php/view/apartment/typelist';

		oUl = $('[script-role = list_wrap]');

		oSquare = $('[script-role = squre]');

		oBuild = $('[script-role = building_name]');

		selectList(oUl);

		oBuild.attr('house_id', '');		

		var related = new relatedInput({
			oWrap: $('[script-role = building_name]'),
			postName: 'house',
			url: '/index.php/view/house/getlist',
			onchange: function(param)
			{	
				param.house_city = oCity.get(0).options[oCity.get(0).selectedIndex].id;
			},
			getValue: function(oLi,oInput)
			{	
				//oInput.attr('house_id', oLi.attr('id'));
			},
			fnDo: function(data, oWrap)
			{	
				var i,
					num,
					oLi;

				num = data.data.length;
				
				for(i=0; i<num; i++)
				{
					oLi = $('<li id='+ data.data[i].house_id +'><span></span></li>');

					oLi.children(0).html(data.data[i].house_name);

					oWrap.append(oLi);
				}
			},
			blur: function(sName, aLi, oInput)
			{	
				var result = false;

				if(aLi.length)
				{
					aLi.each(function(i){

						if(aLi.eq(i).text() == sName)
						{	
							oInput.attr('house_id', aLi.eq(i).attr('id'));

							result = true;
						}

					});

					if(!result)
					{
						oInput.attr('house_id', '');

						if($('[script-role = sys_list]')) $('[script-role = sys_list]').remove();

						oType.get(0).selectedIndex = 0;
					}
				}
			}
		});

		
		/* 选择户型 */

		com.getSelectData(oType, sGetUrl, newJson, function(data){

			com.renderOption(oType, data.data, 'tag_id', 'tag_name', null, 'check');

		},function(name, id){

			var newJson = {};

			newJson.tag_id = id;

			newJson.house_id = oBuild.attr('house_id');

			makeList(newJson);

		});

		related.addEvent();

		function makeList(param)
		{
			var i,
				num,
				html,
				tId,
				oLi,
				realData;

			sUrl = '/index.php/view/apartment/getfloorpic';
			
			tId = 'case1_uploadList';

			if(!param.house_id)return;

			request({
				url: sUrl,

				data: param,

				sucDo: function(data)
				{
					if($('[script-role = sys_list]')) $('[script-role = sys_list]').remove();

					realData = data.data;

					num = realData.length;

					for(i=0; i<num; i++)
					{
						oLi = $('<li class="pic_list" script-role="sys_list" apartment_id='+ realData[i].apartment_id +'></li>');

						oLi.get(0).innerHTML = 
						'<dl>'+
							'<dt>'+
								'<img src="' + realData[i].apartment_floor_pic1 + '" width="97" height="93" /  script-role="type_image">'+
							'</dt>'+
							'<dd>'+
								'<p class="pt_5 pb_5" script-role="type">' + realData[i].apartment_category + '</p>'+
								'<p>'+
									'<span script-role="detail">'+ realData[i].apartment_title +'</span>'+
									'<span script-role="square">'+ realData[i].apartment_size +'</span>'+
								'</p>'+
							'</dd>'+
						'</dl>';

						oUl.prepend(oLi);
					}
				}
			});
		}

		function selectList(oWrap)
		{	
			var nSquare;

			oWrap.on('click', '[script-role = sys_list]', function(){

				$(this).addClass('actb').siblings().removeClass('actb');

				nSquare = parseInt($(this).find('[script-role = square]').text());

				oSquare.attr('readonly', 'readonly');

				oSquare.val(nSquare);

			});

			oWrap.on('click', '[script-role = self_list]', function(){

				$('[script-role = sys_list]').removeClass('actb');

				$(this).addClass('actb');

				oSquare.val('');

				oSquare.removeAttr('readonly');

			});
		}

	})();

	/* makeName */
	(function(){

		var oProvince,
			oCity,
			oHouse,
			oType,
			oSquare,
			oName,
			oProjectName,
			sName,
			fps;

		oProvince = $('[script-role = province]');	
		oCity = $('[script-role = city]');	
		oHouse = $('[script-role = building_name]');	
		oType = $('[script-role = house_type]');	
		oSquare = $('[script-role = squre]');	
		oName = $('[script-role = namespace]');
		oProjectName = $('[script-role = project_name]');
		fps = 1000;

		setInterval(getName,fps);

		function getName()
		{
			sName = oProvince.val() + '+' + oCity.val() + '+' + (oHouse.val() ? oHouse.val() : '楼盘名称') + '+' + (oType.val() ? oType.val() : '户型名称') + '+' + (oSquare.val() ? oSquare.val() : '面积') + '+' + (oName.val() ? oName.val() : '客户称谓');

			oProjectName.html(sName);
		}

	})();


	(function(){

		var result = false;

		var oFormcheck = new formcheck({
			subUrl: '/index.php/posts/project/addproject',
			btnName: 'upload_confirm_btn',
			boundName: 'step1_check',
			fnSumbit: function(data)
			{	
				data.project_status = data.project_status == '1' ? '1' : '2';

				data.house_city = $('[script-role = city]').get(0).options[$('[script-role = city]').get(0).selectedIndex].id;

				data.house_id = $('[script-role = building_name]').attr('house_id') ? $('[script-role = building_name]').attr('house_id') : '0';

				data.house_name = $('[script-role = building_name]').attr('house_id') ? '' : $('[script-role = building_name]').val();

				data.apartment_category_id = $('[script-role = house_type]').get(0).options[$('[script-role = house_type]').get(0).selectedIndex].id;


				data.apartment_id = $('[script-role = list_wrap]').find('li.actb').attr('apartment_id') ? $('[script-role = list_wrap]').find('li.actb').attr('apartment_id') : '';

				data.apartment_floor_pic = $('[script-role = list_wrap]').find('li.actb').attr('apartment_id')  ? '' : $('[script-role = list_wrap]').find('li.actb').find('img').attr('src').replace(/\/uploads\/temp\/apartment\//,'');

			},
			sucDo: function(data)
			{	
				window.location = data.data.url;
			},
			failDo: function(msg)
			{	
				alert(msg);

				var sUrl = window.location;

				window.location = sUrl;
			},
			otherCheck: {
				
				'tag_namelist' : [
					function()
					{	
						var stepList = $('[script-role = list_wrap]').children();

						stepList.each(function(i){

							if(stepList.eq(i).hasClass('actb'))
							{
								result = true;
							}

						});

						if(result)
						{
							return true;
						}
						else
						{
							return false;
						}
					},
					function()
					{
						return true;
					}
				]
			}
		});

		oFormcheck.check();

	})();

});