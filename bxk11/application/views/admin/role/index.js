define(function(require, exports, module){
	
	/*
		@parame 
		removeUrl: 删除地址
		postUrl: 提交地址
		getDataUrl: 获取数据地址

		调用:
		moduleList('aaa.php','bbb.php','ccc.php');
	*/

	moduleList('/index.php/admin/service/del','/index.php/admin/service/ConsoleData','/index.php/admin/service/postAction')


	function moduleList(removeUrl, postUrl, getDataUrl)  {


		var template = require('./template');

		var oTarget,
			sRole,
			oModuleWrap;

		oModuleWrap = $('[sc = module-wrap]');	

		render();

		$(document).on('click', function(e){

			oTarget = $(e.target);
			sRole = oTarget.attr('sc');

			switch( sRole ) {

				case 'module-add':
					moduleAdd();
				break;

				case 'module2-add':
					module2Add(oTarget);
				break;

				case 'module3-add':
					module3Add(oTarget);
				break;

				case 'remove':
					remove(oTarget);
				break;

				case 'module-save':
					save();
				break;

				case 'realremove':
					realremove(oTarget);
				break;

				case 'slide':
					slide(oTarget);
				break;

			}

		});

		function moduleAdd() {

			var html = 
			'<div class="module-list" sc="module-list">'+
				'<div class="level1" sc="level1">'+
					'<span class="slide" sc="slide">[-]</span>'+
					'<input type="text" class="type1" value="" sc="lv1-rank" />'+
					'<input type="text" class="type2" value="" sc="lv1-name" />'+
				'</div>'+
				'<div class="level2-list" sc="level2-list"></div>'+
				'<button class="module2-add" sc="module2-add">添加新版块</button>'+
			'</div>';

			var oNewModule = $(html);
			oModuleWrap.append( oNewModule );
		}

		function module2Add(oThis) {

			var oWrap;

			oWrap = oThis.parents('[sc = module-list]').find('[sc = level2-list]');

			var html = 
			'<div class="level2" sc="level2">'+
				'<input type="text" class="type1" value="" sc="lv2-rank" />'+
				'<input type="text" class="type2" value="" sc="lv2-name" />'+
				'<button sc="module3-add">+</button>'+
				'<button sc="remove">x</button>'+
				'<div class="level3-list" sc="level3-list"></div>'+
			'</div>';


			var oNewModule = $(html);
			oWrap.append( oNewModule );
		}


		function module3Add(oThis) {

			var oWrap;

			oWrap = oThis.parents('[sc = level2]').find('[sc = level3-list]');

			var html = 
			'<div class="level3" sc="level3">'+
				'<input type="text" class="type1" value="" sc="lv3-rank" />'+
				'<input type="text" class="type2" value="" sc="lv3-name" />'+
				'<button sc="remove">x</button>'+
			'</div>';

			var oNewModule = $(html);
			oWrap.append( oNewModule );

		}

		function remove(oThis) {

			oThis.parent().remove();

		}

		function render() {

			$.ajax({
				url:getDataUrl,
				dataType:'json',
				async:false,
				success: function(data){

					var html = template('haha', data);

					oModuleWrap.html( html );

				}
			})

		}

		function save() {

			var data = {};
			var arr2 = [];
			var data2;
			var data3 = {};

			var level1 = $('[sc = level1]');
			var level2,
				level3;

			level1.each(function(i){

				data2 = {};
				data2.rank = level1.eq(i).find('[sc = lv1-rank]').val();
				data2.name = level1.eq(i).find('[sc = lv1-name]').val();
				data2.id = level1.eq(i).attr('scid');
				level2 = level1.eq(i).parents('[sc = module-list]').find('[sc = level2]');

				data2.son = [];
				level2.each(function(i){

					var data = {};
					data.rank = level2.eq(i).find('[sc = lv2-rank]').val();
					data.name = level2.eq(i).find('[sc = lv2-name]').val();
					data.id = level2.eq(i).attr('scid');
					data.son = {};

					data2.son.push( data );

					level3 = level2.eq(i).find('[sc = level3]');
					data3.son = [];
					level3.each(function(i){

						var haha = {};
						haha.rank = level3.eq(i).find('[sc = lv3-rank]').val();
						haha.name = level3.eq(i).find('[sc = lv3-name]').val();
						haha.id = level3.eq(i).attr('scid');
						data3.son.push( haha );

						data.son = data3.son;

					});

				});

				arr2.push(data2);

			});

			data.list = arr2;

			var result = JSON.stringify( data );



			$.post(postUrl, {data:result}, function(data){	

				alert(data.msg);

				window.location = window.location;

			},'json');
		}


		function realremove(oThis) {

			var id = oThis.attr('scid');

			var result = confirm('你确定要删除?');

			if( result ) {

				$.post(removeUrl, {id:id}, function(data){

					alert(data.msg);

					window.location = window.location;

				},'json');


			}

		}

		function slide(oThis) {

			var isShow,
				oList,
				oParent,
				oAddBtn;

			oParent = oThis.parents('[sc = module-list]');
			oList = oParent.find('[sc = level2-list]');
			oAddBtn = oParent.find('[sc = module2-add]');
			isShow = oList.is(':visible');

			if( isShow ) {

				oList.hide();
				oAddBtn.hide();
				oThis.html('[+]');

			} else {

				oList.show();
				oAddBtn.show();
				oThis.html('[-]');

			}

		}


	}

});


