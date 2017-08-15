define(function(require, exports, module) {
		
	function enterDo(aInput, foDo)
	{
		if(!window.XMLHttpRequest)
		{
			aInput.keyup(function(e){

				if(e.keyCode == 13)
				{
					foDo && foDo();
				}

			});
		}
		else
		{
			aInput.keydown(function(e){

				if(e.keyCode == 13)
				{
					foDo && foDo();
				}

			});
		}
	}

	return enterDo;

});