define('/static/script/lib/array/arrDelete', [], function(require, exports, module) {

	function arrDelete()
	{
		Array.prototype.deletes=function(vArg)
		{	
			var num=this.length;

			var _str=" "+vArg+" ";

			for (var i=0;i<num;i++)
		    { 
			  	if(" "+this[i]+" "===_str)
			  	{ 
			  		this.splice(i,1);
			  	}
		    }
		};
	}

	return arrDelete();

});