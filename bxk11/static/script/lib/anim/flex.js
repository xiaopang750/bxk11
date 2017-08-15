define('/static/script/lib/anim/flex', [], function(require, exports, module) {
	
	function flex(aEle,jsonStart,jsonEnd,fnDo,type,time,fnEnd)
	{
		var num=aEle.length;

		for (var i=0;i<num;i++)
		{
			_flex(aEle[i],jsonStart,jsonEnd,fnDo,type,time,fnEnd);
		}
	}

	function _flex(obj,jsonStart,jsonEnd,fnDo,type,time,fnEnd)
	{
	   if(!time)time=5;
	   if(!type)type='buffer';
	   if(!obj.iSpeed)obj.iSpeed={};
	   if(!obj.iCur)obj.iCur={};
	   if(!obj.lastMove)obj.lastMove=0;
	   
	   for (var attr in jsonStart)
	   {
	     if(!obj.iSpeed[attr])obj.iSpeed[attr]=0;
		 
		 obj.iCur[attr]=parseInt(jsonStart[attr]);
	   }

	   clearInterval(obj.timer);
	   obj.timer=setInterval(move,30);

	   var now=new Date().getTime();
	   
	   if(now-obj.lastMove>=30)
	   {   
			move();
	   }
	   
	   function move()
	   {
	     var bStop=true;
		 
		 for (var attr in jsonEnd)
		 {  
		    var iTarget=parseInt(jsonEnd[attr])
		 
		    if(type=='buffer')
			{
			   obj.iSpeed[attr]=(iTarget-obj.iCur[attr])/time;
			   obj.iSpeed[attr]=obj.iSpeed[attr]>0?Math.ceil(obj.iSpeed[attr]):Math.floor(obj.iSpeed[attr]);
			} 
			else if(type=='elec')
	 		{
			   obj.iSpeed[attr]+=(iTarget-obj.iCur[attr])/time;
			   obj.iSpeed[attr]*=0.7;
			}
			
			obj.iCur[attr]+=obj.iSpeed[attr];
			
			if(Math.round(obj.iCur[attr])!=iTarget||parseInt(obj.iSpeed[attr])!=0)
			{
			   bStop=false;
			}
			
			fnDo(obj.iCur); 
		 }
		 
		 if(bStop)
		 { 
		   clearInterval(obj.timer);
		   
		   if(fnEnd)
		   {
		     fnEnd();
		   }
		 }
		 
		 obj.lastMove=now;
		
	   }
	}

	return flex;

})