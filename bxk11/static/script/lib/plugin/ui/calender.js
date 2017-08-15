define('/static/script/lib/plugin/ui/calender', [
	], function(require, exports, module) {

	function addEvent(obj,sEv,fn)
	{
	    if(obj.attachEvent)
	    {
	        obj.attachEvent('on'+sEv,function(ev){

	            var oEvent=ev||event;

	            if(fn.call(obj,oEvent)==false)
	            {
	                oEvent.cancelBubble=true;
	                return false;
	            }

	        });
	    }
	    else
	    {
	        obj.addEventListener(sEv,function(ev){
	            
	  			var oEvent=ev||event;
	  			
	              if(fn.call(this,oEvent)==false)
	              {
	                  oEvent.cancelBubble=true;
	                  oEvent.preventDefault();
	              }
	              
	        },false)
	    }
	}	

	function getXY(obj)
	{
		var x=0;
	    var y=0;

	    while(obj)
	    {
	        x+=obj.offsetLeft;
	        y+=obj.offsetTop;
	        obj=obj.offsetParent;
	    }
	    return {left:x,top:y};
	}

	function setStyle(obj,json)
	{
		for (var i in json)
		{
			obj.style[i]=json[i];
		}
	}

	function calendar(abj,index,fnSuc)
	{		
	   var num=abj.length;
	   var added=false;
	   if(!index)index=0;
	   
	   for (var i=0;i<num;i++)
	   {
	      _calendar(abj[i],index,fnSuc[i]);  
	   }

	   function _calendar(obj,index,fnDo)
	   { 
	   	  init();

	      var oNewDiv=document.createElement('div');
	      var left=obj.offsetLeft;
		  var top=obj.offsetTop+obj.offsetHeight+5;
		 
		  oNewDiv.className='calenderWrap';
		  setStyle(oNewDiv,{position:'absolute',left:left+'px',top:top+'px',display:'none',zIndex:index});
		  
		  oNewDiv.innerHTML=
		  '<div class="calenderHead">'+
				'<div class="calendar_month_left_btn"><a href="javascript:void(0)" class="left_btn"></a></div>'+
				'<div class="calendar_month_head_content">6</div>'+
				'<div>月</div>'+
				'<div class="calendar_month_right_btn"><a href="javascript:void(0)" class="right_btn"></a></div>'+
				'<div class="calendar_year_left_btn" style="margin-left:32px"><a href="javascript:void(0)" class="left_btn"></a></div>'+
				'<div class="calendar_year_head_content">2012</div>'+
				'<div>年</div>'+
				'<div class="calendar_year_right_btn"><a href="javascript:void(0)" class="right_btn"></a></div>'+ 
		  '</div>'+
		  '<div class="calendar_week">'+
			'<ul>'+
			  '<li>日</li>'+
			  '<li>一</li>'+
			  '<li>二</li>'+
			  '<li>三</li>'+
			  '<li>四</li>'+
			  '<li>五</li>'+
			  '<li>六</li>'+
			'</ul>'+
		  '</div>'+
		  '<div class="calendar_content">'+
			'<ul></ul>'+
		  '</div>';
		  
		  var oMonth_l=oNewDiv.children[0].children[0];
		  var oMonth_r=oNewDiv.children[0].children[3];
		  var oYear_l=oNewDiv.children[0].children[4];
		  var oYear_r=oNewDiv.children[0].children[7];
		  var oMonth=oNewDiv.children[0].children[1];
		  var oYear=oNewDiv.children[0].children[5];
		  var oUl=oNewDiv.children[2].children[0];
		  var iNow=0;
		  
		  addEvent(obj,'click',function(){
		     
			 if(oNewDiv.style.display=='none')
			 {
			    oNewDiv.style.display='block';
			 }
			 else
			 {  
			    oNewDiv.style.display='none';
			 }
			 return false;
		  });
		  
		  addEvent(document,'click',function(){
		     oNewDiv.style.display='none';
		  });
		  
		  refresh(iNow);
		  
		  addEvent(oMonth_l,'click',function(){
		     iNow--;
			 refresh(iNow);
		     return false;
		  });
		  
		  addEvent(oMonth_r,'click',function(){
		     iNow++;
			 refresh(iNow);
		     return false;
		  });
		  
		  addEvent(oYear_l,'click',function(){
		     iNow-=12;
			 refresh(iNow);
		     return false;
		  });
		  
		  addEvent(oYear_r,'click',function(){
		     iNow+=12;
			 refresh(iNow);
		     return false;
		  });

		  function init()
		  {
		  	 obj.parentNode.style.position='relative';
		  }
		  
		  function refresh(iNow)
		  {
			 oUl.innerHTML='';
			 
		     var num_day=howDays();
			 
			 var num_blank=getFisrtDay();
			 
			 var month=getNow().month;
			 
			 var year=getNow().year;
			 
			 oMonth.innerHTML=month;
			 
			 oYear.innerHTML=year;
			 
			 for (var i=0;i<num_blank;i++)
			 {
			   var oLi=document.createElement('li');
			   oLi.style.cursor='default';
			   oUl.appendChild(oLi);
			 }
			 
			 for (var i=0;i<num_day;i++)
			 {
			   var oLi=document.createElement('li');
			   oLi.innerHTML=(i+1);
			   oLi.onclick=function(ev)
			   {  
			      var oEvent=ev||event;
			      obj.value=year+'-'+month+'-'+this.innerHTML;
				  oNewDiv.style.display='none';
				  fnDo&&fnDo();
				  oEvent.cancelBubble=true;
			   };
			   oUl.appendChild(oLi);
			 }
			 
			 while(oUl.children.length<42)
			 {
			    var oLi=document.createElement('li');
				oLi.style.cursor='default';
				oUl.appendChild(oLi);
			 }
			 
		     function howDays()
			 {
			   var oDate=new Date();
			   oDate.setMonth(oDate.getMonth()+iNow+1);
			   oDate.setDate(0);
			   return oDate.getDate();
			 }
			 
			 function getFisrtDay()
			 {
			    var oDate=new Date();
				oDate.setMonth(oDate.getMonth()+iNow);
				oDate.setDate(1);
				return oDate.getDay();
			 }
			 
			 function getNow()
			 {
			    var oDate=new Date();
				oDate.setMonth(oDate.getMonth()+iNow);
				return {month:oDate.getMonth()+1,year:oDate.getFullYear()}
			 }

		  }
		  
		  if(!added)
		  {
		      var oHead=document.getElementsByTagName('head')[0];
			  var oLink=document.createElement('link');
			  oLink.rel='stylesheet';
			  oLink.type='text/css';
			  oLink.href='/static/css/lib/ui/plugin/calender.css';
			  oHead.appendChild(oLink);
			  added=true;
		  }

		  obj.parentNode.appendChild(oNewDiv);
		  
	   }
	    
	}

	return calendar;

});