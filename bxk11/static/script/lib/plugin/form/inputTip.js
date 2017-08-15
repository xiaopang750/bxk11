define('/static/script/lib/plugin/form/inputTip', 
	[
	'/static/script/lib/event/keypress',
	'/static/script/lib/event/keyup'
	], function(require, exports, module) {

	var keypress=require('/static/script/lib/event/keypress');
	var keyup=require('/static/script/lib/event/keyup');

	function inputTip(oArea,oTip,maxNum,rightClass,wrongClass)
	{	
		var re=/[\u4e00-\u9fa5]/g;

		checkNum();

		keypress([oArea],checkNum);

		function checkNum()
		{
			var str=oArea.value;

			var num=str.length;

			if(num<maxNum)
			{
				oTip.innerHTML='您还可以输入<span class='+rightClass+'>'+(maxNum-num)+'</span>个字';
			}
			else
			{   
				oArea.value=oArea.value.substring(0,500);
				oTip.innerHTML='您还可以输入<span class='+wrongClass+'>'+0+'</span>个字';
			}
		}

	}



	return inputTip;

});