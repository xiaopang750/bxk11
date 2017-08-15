/*
 *description:ajaxForm
 *author:fanwei
 *date:2013/11/01
 */
define(function(require, exports, module) {
	
	var request = require('../http/request');
	var bodyParse = require('../http/bodyParse');

	function AjaxForm(options)
	{	
		//checkbox_group
		//radio_group
		//this.oWrap = options.oWrap || null;
		//
		this.oWrap = options.boundName ? $('[script-bound = '+ options.boundName +']') : $('[script-bound = form_check]');

		this.oSub = options.btnName ? this.oWrap.find('[script-role = '+ options.btnName +']') : this.oWrap.find('[script-role = confirm_btn]');

		this.loadOffset = 0;
		
		this.otherCheck = options.otherCheck || null;

		this.subUrl = options.subUrl || '';

		this.arrSelect = [];

		this.arrInput = [];

		this.arrRadio = [];

		this.arrcheckBox = [];

		this.arrOther = [];

		this.otherJude = options.otherJude || null;

		/* return json */
		this.fnSumbit = options.fnSumbit || null;

		this.sucDo = options.sucDo || null;

		this.failDo = options.failDo || null;

		this.noSub = options.noSub || null;

		this.loaddingUrl = options.loaddingUrl || '../../img/lib/loading/btn_loading.gif';

		this.param = {};
	}

	AjaxForm.prototype = {

		upload: function()
		{
			this.getEle();

			this.subMitEvent();
		},
		getEle: function()
		{	
			var _this = this;

			//this.oLoading = this.makeLoading(this.oSub);

			var aChildren = this.oWrap.find('*');

			aChildren.each(function(i){

				if(aChildren.eq(i).attr('form_check'))
				{	
					_this.makeWrapTip(aChildren.eq(i));

					_this.judgeType(aChildren.eq(i));
				}

			});
		},
		judgeType: function(ele)
		{	
			if(ele.attr('form_check') == 'sys')
			{	
				if(ele.get(0).tagName == 'SELECT')
				{	
					this.arrSelect.push(ele);

					this.checkSelect(ele)
				}
				else if(ele.attr('radio_group'))
				{	
					this.arrRadio.push(ele);
					
					this.checkRadio(ele);
				}
				else if(ele.attr('checkbox_group'))
				{	
					this.arrcheckBox.push(ele);

					this.checkBox(ele);
					
				}
				else if(ele.attr('type') == 'text' || ele.attr('type') == 'password' || ele.attr('type') == 'file' || ele.get(0).tagName == 'TEXTAREA')
				{	
					this.arrInput.push(ele);

					this.checkText(ele);
					
				}
			}
			else if(ele.attr('form_check') == 'self')
			{	

				if(ele.get(0).tagName == 'SELECT')
				{	
					this.arrOther.push(ele);
				}
				else if(ele.attr('radio_group'))
				{	
					this.arrOther.push(ele);
				}
				else if(ele.attr('checkbox_group'))
				{	
					this.arrOther.push(ele);
					
				}
				else if(ele.attr('type') == 'text' || ele.attr('type') == 'password' || ele.attr('type') == 'file' || ele.tagName == 'TEXTAREA')
				{	
					this.arrOther.push(ele);
				}

				this.checkother(ele);

			}
			
		},
		makeWrapTip: function(ele)
		{	
			if(ele.attr('ischeck') == 'true')
			{
				ele.parent().css({position:'relative'});

				var oWrongWrap = $('<span class="wrong_area" script-role="wrong_area"></span>');

				var str = 
					'<span class="wrong_content" script-role="wrong_name" script-role="wrong_name"></span>'+
					'<span class="wrrong_bot"></span>';

				oWrongWrap.html(str);
				
				ele.before(oWrongWrap);

				this.tipPosition(ele, oWrongWrap);
			}
		},
		tipPosition: function(ele, oWrongWrap)
		{	
			var left = ele.position().left;
			var width = ele.innerWidth();
			var thisLeft = left /*+ width - oWrongWrap.innerWidth();*/
			var thisTop = ele.outerHeight(true)- 1;

			if (ele.attr('checkbox_group') || ele.attr('type') == 'checkbox') {

				thisTop = thisTop + 10;

			}

			oWrongWrap.css({
				position: 'absolute',
				left: thisLeft,
				top: thisTop,
				zIndex: 2
			});

			
		},
		tipWrong: function(ele ,oTip, str)
		{	
			var _this = this;

			oTip.find('[script-role = wrong_name]').html(str);

			this.tipPosition(ele, oTip);

			setTimeout(function(){

				oTip.addClass('wrong');

			},0);

			oTip.attr('iswrong','true');
			
			ele.parents('[script-role = check_wrap]').addClass('has-error');
		},
		tipRight: function(ele, oTip)
		{	
			
			oTip.removeClass('wrong');

			oTip.attr('iswrong','false');

			ele.parents('[script-role = check_wrap]').removeClass('has-error');
		},
		checkText: function(ele)
		{	
			var oTip,
				sTip,
				sWrong,
				re,
				str,
				_this,
				pressUrl,
				param,
				dataJson;

			_this = this;

			/* 不需要即时验证 */
			if(!ele.attr('pressUrl'))
			{
				ele.blur(function(){
					
					_this.inputJude($(this));

				});
			}
			else
			{	
				var _pid = bodyParse().pid;

				/* 即时验证 */
				ele.keyup(function(){

					_this.pressInput($(this), _pid);

				});

				ele.blur(function(){

					_this.pressInput($(this), _pid);

				});

			}					

			ele.focus(function(){

				oTip = $(this).parent().find('[script-role = wrong_area]');

				_this.tipRight(ele,oTip);

			});
		},
		pressInput: function(ele, sId)
		{	
			var _this = this;

			dataJson = {};

			oTip = ele.parent().find('[script-role = wrong_area]');		
			pressUrl = ele.attr('pressUrl');

			param = ele.attr('param');

			dataJson[param] = ele.val();

			/* 需要改 */
			dataJson['pid'] = sId;

			var oThis = ele;

			request({

				url: pressUrl,

				data: dataJson,

				sucDo: function(data)
				{	
					_this.tipRight(ele,oTip);
				},
				noDataDo: function(msg)
				{	
					_this.tipWrong(oThis, oTip, msg);
				}
			});
		},
		inputJude: function(ele)
		{		
			var oTip,
				sTip,
				sWrong,
				re,
				str,
				_this;

			_this = this;

			if(!ele.attr('pressUrl'))
			{
				oTip = ele.parent().find('[script-role = wrong_area]');
				sTip = ele.attr('tip');
				sWrong = ele.attr('wrong');
				re = new RegExp('^' + ele.attr('re') + '$','gi');
				str = ele.val();

				if(ele.attr('ischeck') == 'true')
				{	
					if(!ele.val())
					{	
						_this.tipWrong(ele, oTip, sTip);
					}
					else
					{	
						if(!re.test(str))
						{	
							_this.tipWrong(ele, oTip, sWrong);
						}
						else
						{	
							_this.tipRight(ele,oTip);
						}
					}
				}
				else
				{		
					if(str)
					{
						if(!re.test(str))
						{
							_this.tipWrong(ele, oTip, sWrong);
						}
						else
						{
							_this.tipRight(ele,oTip);
						}
					}
				} 
			}
			else
			{	
				var pid = bodyParse().pid;

				_this.pressInput(ele, pid);
			}

		},
		checkSelect: function(ele)
		{
			var _this;

			_this = this;

			ele.change(function(){

				_this.selectJude($(this));

			});		
		},
		selectJude: function(ele)
		{	
			if(ele.attr('ischeck') == 'true')
			{	
				var oTip,
					sTip,
					sWrong,
					re,
					str,
					_this;

				oTip = ele.parent().find('[script-role = wrong_area]');
				sTip = ele.attr('tip');

				if(!ele.val())
				{
					this.tipWrong(ele, oTip, sTip);
				}
				else
				{
					this.tipRight(ele,oTip);
				}
			}		
		},
		checkRadio: function(ele)
		{	
			var _this = this;

			ele.click(function(){

				_this.radioJudge(ele);

			});


		},
		radioJudge: function(ele)
		{	
			var aRadio = ele.find('input[type = radio]');
			var result = false;
			var oTip =  ele.parent().find('[script-role = wrong_area]');
			var sTip = ele.attr('tip');

			aRadio.each(function(i){

				if(aRadio.eq(i).attr('checked'))
				{	
					result = true;
				}

			});

			if(ele.attr('ischeck') == 'true')
			{
				if(result)
				{	
					this.tipRight(ele,oTip);

				}
				else
				{	
					this.tipWrong(ele, oTip, sTip);
				}
			}	
		},
		checkBox: function(ele)
		{	
			var _this = this;

			ele.click(function(){

				_this.checkJudge(ele);

			});
		},
		checkJudge: function(ele)
		{	
			var aCheck = ele.find('input[type = checkbox]');
			var result = false;
			var oTip =  ele.parent().find('[script-role = wrong_area]');
			var sTip = ele.attr('tip');

			aCheck.each(function(i){

				if(aCheck.eq(i).attr('checked'))
				{	
					result = true;
				}

			});

			if(ele.attr('ischeck') == 'true')
			{	
				if(result)
				{	
					this.tipRight(ele,oTip);

				}
				else
				{	
					this.tipWrong(aCheck.eq(0), oTip, sTip);
				}
			}
		},
		checkother: function(ele)
		{	
			var _this = this;
			var name = ele.attr('name');
			var tip = ele.attr('tip');
			var oTip;
			var sTip = ele.attr('tip');
			var sWrong =  ele.attr('wrong');

			/* 前空 后不符合要求或者错误 */
			this.oSub.click(function(){

				oTip = ele.parent().find('[script-role = wrong_area]');

				if(!_this.otherCheck[name][0](ele))
				{	
					_this.tipWrong(ele, oTip, sTip);
				}
				else if(!_this.otherCheck[name][1](ele))
				{	
					_this.tipWrong(ele, oTip, sWrong);
				}
				else if(_this.otherCheck[name][0](ele) && _this.otherCheck[name][1](ele))
				{	
					_this.tipRight(ele,oTip);
				}
			});
		},
		subMitEvent: function()
		{	
			var _this = this;

			this.oSub.click(function(){

				_this.subMit();

			});
		},
		subMit: function()
		{	
			var aWrong,
				result;

			aWrong = $('[script-role = wrong_area]');

			result = true;

			this.map(this.arrSelect, function(i){

				this.selectJude(this.arrSelect[i]);					

			});

			this.map(this.arrInput, function(i){

				this.inputJude(this.arrInput[i]);					

			});

			this.map(this.arrRadio, function(i){

				this.radioJudge(this.arrRadio[i]);					

			});

			this.map(this.arrcheckBox, function(i){

				this.checkJudge(this.arrcheckBox[i]);					

			});


			aWrong.each(function(i){

				if(aWrong.eq(i).attr('iswrong') == 'true')
				{	
					result = false;
				}

			});

			if(!result)
			{	/* 系统验证 */
				return;
			}
			else
			{	
				/* 外部验证 */
				if(this.otherJude)
				{	
					var judeResult = true;

					this.map(this.otherJude, function(i){

						if(!this.otherJude[i]())
						{
							judeResult = false;
						}

					});

					if(!judeResult)
					{
						return;
					}
					else
					{
						/* 提交 */
						this.getAllData();
					}
				}
				else
				{	
					/* 提交 */
					this.getAllData();
				}
			}
		},
		map: function(arr,callBack)
		{
			var i,
				num;

			num = arr.length;
			
			for(i=0; i<num; i++)
			{
				callBack.call(this,i);
			}
		},
		getAllData: function()
		{	
			var _this = this;

			this.getInputData(this.arrInput);

			this.getSelectData(this.arrSelect);

			this.map(this.arrRadio, function(i){

				_this.getRadioData(_this.arrRadio[i]);

			});

			this.map(this.arrcheckBox, function(i){

				_this.getCheckData(_this.arrcheckBox[i]);

			});

			if(this.noSub)
			{
				this.noSub();

				return;
			}

			if(this.fnSumbit)
			{
				var newJson = this.fnSumbit(this.param);

				for(key in newJson)
				{	
					this.param[key] = newJson[key];
				}
			}

			request({
				url: this.subUrl,
				data: this.param,
				beforeDo: function()
				{
					_this.loadingShow();
				},
				sucDo: function(data)
				{	
					_this.loadingHide();

					_this.sucDo && _this.sucDo(data);
				},
				noDataDo: function(data)
				{	
					_this.loadingHide();
					
					_this.failDo && _this.failDo(data);
				}
			});
		},
		getInputData: function(ele)
		{	
			var _this = this;

			this.map(ele, function(i){

				if(ele[i].attr('no_upload') == 'false') return;

				_this.param[ele[i].attr('name')] = ele[i].val();	

			});
		},
		getSelectData: function(ele)
		{	
			var _this = this;

			this.map(ele, function(i){

				if(ele[i].attr('no_upload') == 'false') return;

				_this.param[ele[i].attr('name')] = ele[i].get(0).children[ele[i].get(0).selectedIndex].id	

			});
		},
		getRadioData: function(ele)
		{	
			if(ele.attr('no_upload') == 'false') return;

			var aRadio = ele.find('input[type = radio]');
			var name = ele.attr('name');
			var result = '';

			aRadio.each(function(i){

				if(aRadio.eq(i).attr('checked') == 'checked')
				{
					result = aRadio.eq(i).val();
				}
			});

			this.param[name] = result;

		},
		getCheckData: function(ele)
		{	
			if(ele.attr('no_upload') == 'false') return;

			var aCheck = ele.find('input[type = checkbox]');
			var name = ele.attr('name');
			var result = [];

			aCheck.each(function(i){

				if(aCheck.eq(i).attr('checked') == 'checked')
				{	
					result.push(aCheck.eq(i).attr('id'));
				}

			});

			this.param[name] = result.join(',');
		},
		makeLoading: function(oBtn) {
			var left,
				top,
				oImage,
				offset;

			oImage = $('<img src='+ this.loaddingUrl +' width="16" height="16">');

			offset = oBtn.attr('offsetLoad') ? parseInt(oBtn.attr('offsetLoad')) : this.loadOffset;

			oBtn.css({position: 'relative'});	

			left = Math.floor((oBtn.outerWidth() - 16)/2 - offset);
			top =  Math.floor((oBtn.outerHeight() - 16)/2);

			oImage.css({
				position: 'absolute',
				left: left + 'px',
				top: top + 'px',
				zIndex : 2,
				display: 'none'
			});

			oBtn.append(oImage);

			return oImage; 	
		},
		loadingShow: function()
		{	
			this.oSub.addClass('disabled');

			//this.oLoading.show();
		},
		loadingHide: function()
		{	
			this.oSub.removeClass('disabled');

			//this.oLoading.hide();
		}

	}

	module.exports = AjaxForm;

});