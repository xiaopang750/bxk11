define('/static/script/lib/array/arrIndexof', [], function(require, exports, module) {

	function ArrayIndexOf()
	{
		Array.prototype.indexOf=function(vArg)
		{	
		   var num=this.length;

		   switch(typeof vArg)
		   {
		   	 	case 'object':

		   	 		for (var i=0;i<num;i++)
				    { 
					  	if(this[i]===vArg)
					  	{
					  		return i;
					  	}
				    }
				   
				   return -1;

		   	 	break;

		   	 	default :

		   	 		var _str=" "+vArg+" ";
		   
				    for (var i=0;i<num;i++)
				    { 
					  	if(" "+this[i]+" "===_str)
					  	{
					  		return i;
					  	}
				    }
				   
				   return -1;

		   	 	break;
		   }
		   
		};
	}

	return ArrayIndexOf();

});