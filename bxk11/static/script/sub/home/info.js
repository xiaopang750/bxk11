define(function(require, exports, module) {
	
	var mvc = require('../../lib/prototype/prototype');
	var globalFnDo = require('../../lib/module/globalFnDo');

	var _parent = new mvc();
	var UserInfo = _parent.extend(null,{

		showNavAct: function()
		{	
			var sType,
			    aLi,
			    aName,
			    str,
			    _this;
			
			sType = $('[page_type]').attr('page_type');
			aLi = $('[script-role = nav_list]');
			_this = this;

			aLi.each(function(i){

				aName = aLi.eq(i).find('[script-role = nav_name]');
				aName.attr('href', _this._navLink[i]);
				str = aName.html();

				if(sType.indexOf(str.replace(/\s+/gi, '')) != -1)
				{	
					aLi.eq(i).addClass('act');
				}

			});
		},
		judeType: function(level)
		{	
			var n,
				sType,
				oMain;

			n = parseInt(level);
			oMain = $('[script-role = user_head]');

			oMain.attr('level', n);
		}

	});

		
	var data = UserInfo.parse();

	/* link */
	UserInfo._navLink = [
		'/index.php/user/index?uid=' + data.uid,
		'/index.php/user/album?uid=' + data.uid,
		'/index.php/user/scheme?uid=' + data.uid,
		'/index.php/user/product?uid=' + data.uid,
		'#'
	];

	/* m */	
	
	UserInfo.param.uid = data.uid;
	UserInfo.requestUri = '/index.php/view/user/info';
	UserInfo.async = 'false';
	var data = UserInfo.load();
	

	UserInfo.data = data.data;
	UserInfo.tempId = 'tpl_user_info';
	UserInfo.tempWrap = $('[script-role = user_head]');
	UserInfo.render();
	UserInfo.showNavAct();
	UserInfo.save($('[script-role = data_head_info]'), data.data);
	UserInfo.judeType(data.data.user_level);
	

	var pageDo = new globalFnDo({
		oWrap : $('[script-role = user_head]'),
		listName : 'data_head_info'
	});

	pageDo.init();

});