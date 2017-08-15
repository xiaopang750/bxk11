define('/static/script/lib/plugin/form/info_modify', [
	'/static/script/lib/css/css',
	'/static/script/lib/event/click',
	'/static/script/lib/event/blur',
	'/static/script/lib/broswer/test',
	'/static/script/lib/http/ajax'
	], function(require, exports, module) {

	var css=require('/static/script/lib/css/css');
	var click=require('/static/script/lib/event/click');
	var blur=require('/static/script/lib/event/blur');
	var test=require('/static/script/lib/broswer/test');
	var ajax=require('/static/script/lib/http/ajax');

	function info_modify(options)
	{	
		/*user*/
		var oEle=options.oEle||null;

		var zIndex=options.zIndex||1;

		var oBtn=options.oBtn||null;

		var url=options.url||'';

		var name=options.name||'';

		var data=options.data||{};

		var fnDo=options.fnDo||'';
		/*sys*/
		var nWidth=options.width||'auto';

		var nHeight=oEle.offsetHeight;

		var nLeft=oEle.offsetLeft;

		var nTop=oEle.offsetTop;

		var oParent=oEle.parentNode;

		var oInput=creatInput();

		setOparent(oParent);

		setOinput(oInput,nLeft,nTop,nWidth,nHeight,zIndex);

		oParent.appendChild(oInput);

		addEvent(oBtn,oInput,oEle,url,name,data,fnDo);

	}

	function creatInput()
	{
		var oInput=document.createElement('input');

		return oInput;
	}

	function setOparent(obj)
	{
		css([obj],{position:'relative'});
	}

	function setOinput(obj,left,top,w,h,zIndex)
	{	
		obj.type='text';

		css([obj],{
			position:'absolute',
			left:left+'px',
			top:top+'px',
			zIndex:zIndex,
			width:w+'px',
			height:h+'px',
			lineHeight:h+'px',
			border:'1px solid #ccc',
			paddingLeft:'2px',
			background:'none',
			display:'none'
		});
	}

	function addEvent(oBtn,oInput,oEle,url,name,data,fnDo)
	{	
		var str,btn;

		click([oBtn],function(){

			str=oEle.innerHTML;

			if(!btn)oInput.value=str;

			if(oInput.style.display==='block')
			{	
				submit(oBtn,oInput,oEle,str,url,name,data,fnDo);
				btn=false;
			}
			else
			{	
				show(oBtn,oInput,oEle);
				btn=true;
			}

			return false;
			
		});

		click([document],function(){
			
			if(!btn)return;
			
			submit(oBtn,oInput,oEle,str,url,name,data,fnDo);

			btn=false;

		});

		click([oInput],function(){
			return false;
		});
	}

	function submit(oBtn,oInput,oEle,str,url,name,data,fnDo)
	{	
		oEle.innerHTML=oInput.value===""?str:oInput.value;

		hide(oBtn,oInput,oEle,url,name,data,fnDo,str);
	}

	function show(oBtn,oInput,oEle)
	{
		oInput.style.display='block';
		oEle.style.display='none';
		oBtn.innerHTML='确定';
		oInput.focus();	
		changeMove(oInput);
	}

	function hide(oBtn,oInput,oEle,url,name,data,fnDo,str)
	{	
		oInput.style.display='none';
		oEle.style.display='block';
		oBtn.innerHTML='修改';
		oInput.value=oInput.value?oInput.value:str;
		request(url,name,oInput.value,fnDo,data,str,oEle);
	}

	function changeMove(oInput)
	{
		var length=oInput.value.length;

		var ie=test().ie;

		if(!ie)
		{	
			oInput.selectionStart=length;

			oInput.selectionEnd=length;
		}
		else
		{
			var oSel = oInput.createTextRange();

			oSel.move("character",length); 

			oSel.select();
		}
	
	}

	function request(url,name,str,fnDo,data,org,oEle)
	{	
		data[name]=str;

		ajax({

			url:url,

			data:data,

			success:function(data)
			{	
				var err=parseInt(data.err);

				if(!err)
				{	
					//fnDo&&fnDo(data);

					bxk_head_tip.down('修改成功');	

					bxk_head_tip.up();
				}
				else
				{	
					oEle.innerHTML=org;

					fnDo&&fnDo(data);
					
					bxk_head_tip.down('修改失败');

					bxk_head_tip.up();					
				}
				
			}
		})
	}

	return info_modify;

});