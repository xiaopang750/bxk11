//日期匹配
function dateCheck(s){ 
	var   reg=  /^\d{4}-\d{2}-\d{2}$|^\d{4}-\d{2}-\d{2} \d{1,2}:\d{1,2}:\d{1,2}$/;
	return reg.exec(s);
}

//Email格式的检查  /^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/
function EmailCheck(s){ 
	var   reg=  /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
	return reg.exec(s);
}

//字母数字-_的匹配
function nameCheck(s){
	//var reg = /^[A-Za-z0-9][A-Za-z0-9_\-\.]*[A-Za-z0-9]$/;
	var reg = /^[A-Za-z0-9][\w\-\.]*$/;
  	return reg.exec(s);	 
}

//字母数字-_的匹配
function keyCheck(s){
	//var reg = /^[A-Za-z0-9][A-Za-z0-9_\-\.]*[A-Za-z0-9]$/;
	var reg = /^[A-Za-z0-9_]*$/;
  	return reg.exec(s);	 
}

//密码的匹配(字母,数字,逗号,叹号,横线,问号,百分号)
function passwordCheck(s){
	var reg = /^[A-Za-z0-9][\w\-\.\!\?\%]*$/;
  	return reg.exec(s);	
}

//姓名的匹配(汉字,字母,数字,逗号)
function trueNameCheck(s){
	var reg = /^[\u4E00-\u9FFF|A-Za-z0-9][\u4E00-\u9FFF|A-Za-z0-9\.]*[\u4E00-\u9FFF|A-Za-z0-9]$/;
  	return reg.exec(s);	
}

//验证码的匹配
function YZMCheck(s){
	var reg = /[0-9]{4}/;
  	return reg.exec(s);		
}

//数字的匹配
function digitalCheck(s){
	var reg = /^\d+$/;
  	return reg.exec(s);		
}

//匹配非负整数（正整数+0）
function integerCheck(s){
	var reg = /^[0-9]\d*$/;
  	return reg.exec(s);		
}

//不为零的数字
function digitalNoZeroCheck(s){
		var reg = /^[1-9][0-9]*$/;
	  	return reg.exec(s);	
}

function IsURL(str_url){
        var strRegex = "^((https|http|ftp|rtsp|mms)?://)"
        + "?(([0-9a-z_!~*'().&=+$%-]+: )?[0-9a-z_!~*'().&=+$%-]+@)?" //ftp的user@
        + "(([0-9]{1,3}\.){3}[0-9]{1,3}" // IP形式的URL- 199.194.52.184
        + "|" // 允许IP和DOMAIN（域名）
        + "([0-9a-z_!~*'()-]+\.)*" // 域名- www.
        + "([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\." // 二级域名
        + "[a-z]{2,6})" // first level domain- .com or .museum
        + "(:[0-9]{1,4})?" // 端口- :80
        + "((/?)|" // a slash isn't required if there is no file name
        + "(/[0-9a-z_!~*'().;?:@&=+$,%#-]+)+/?)$";
        var re=new RegExp(strRegex);
        //re.test()
        if (re.test(str_url)){
            return (true);
        }else{
            return (false);
        }
}

//小数的匹配
function floatCheck(s){
	var reg = /^(\d+)(\.(\d{1,2}))?$/;
  	return reg.exec(s);		
}

//金额的匹配
function moneyCheck(s){
	var reg = /^(([1-9]\d*(,\d{3})*)|([0-9]\d*))(\.(\d{1,2}))?$/; 
  	return reg.exec(s);		
}

// 用空字符串替代
function trim(s) {
	return s.replace(/(^\s*)|(\s*$)/g, "");
}

//手机号码匹配
function mobileCheck(s){
	var reg = /^(1[358][0-9]{1})[0-9]{8}$/;
	return reg.exec(s);
}

//电话号码匹配
function phoneCheck(s){
	var reg = /^(\d{3,4}-)?\d{7,8}$/;
	return reg.exec(s);
}

//数字的匹配
function minusCheck(s){
	var reg = /^[1-9\-][0-9]*$/;
  	return reg.exec(s);		
}


//正负小数的匹配
function minusfloatCheck(s){
	var reg = /^[0-9\-](\d+)(\.(\d{1,2}))?$/;
  	return reg.exec(s);		
}
function dateCompare(startDate,endDate){  
     sDate=startDate.replace(/-/g,"/");  
 	 eDate=endDate.replace(/-/g,"/"); 

	if (Date.parse(sDate)-Date.parse(eDate)>0){
		return false;
	}
	
	return true;
}

//check user name length 
function checkLoginNameLength(name,minLength,maxLength){
	var i=0,sum=0;
	for(i=0;i<name.length;i++){
		if ((name.charCodeAt(i)>=0) && (name.charCodeAt(i)<=255))  
			sum=sum+1;
		else
			sum=sum+2;  
	}
	if (sum < minLength || sum > maxLength){
		return false;
	}

	return true;
}

//check user name valid
function checkLoginNameValid(name){
	var reg = new RegExp("^[^a-zA-Z\d\u4e00-\u9fa5|_]+$");
	if (reg.test(name)){
		return false;
	}
	return true;	
}

function floatAdd(arg1,arg2)
{
    var r1,r2,m;
    try
    {
        r1=arg1.toString().split(".")[1].length;
    }
    catch(e)
    {
        r1=0;
    }
    
    try
    {
        r2=arg2.toString().split(".")[1].length;
    }
    catch(e)
    {
        r2=0;
    }
    m = Math.pow(10,Math.max(r1,r2));
    //return ((arg1*m+arg2*m)/m).toString().replace(/^(\d+\.\d{2})\d*$/,"$1");
    return arg1*m + arg2*m;
}

//取得当期月份的第一天
function currentFirstDay(){
	var month = new Date().getMonth()+1; 
	if(parseInt(month)<10){
		month = "0"+month;
	}
	var year = new Date().getFullYear();
	var date = new Date().getDate();
	if(parseInt(date)<10){
		date = "0"+date;
	}
     
	return year + "-" + month + "-01"; 
}

//获得当前月最后一天
function currentLastDay() {
	var month = new Date().getMonth()+1; 
	if(parseInt(month)<10){
		month = "0"+month;
	}
	var year = new Date().getFullYear();
	var day = new Date(year,month,0).getDate();
	return year + "-" + month + "-" + day; 
}

//取得当前日期
function currentDate(){
	var month = new Date().getMonth()+1; 
	if(parseInt(month)<10){
		month = "0"+month;
	}
	var year = new Date().getFullYear();
	var day = new Date().getDate();
	if(parseInt(day)<10){
		day = "0"+day;
	}
	return year + "-" + month + "-" + day; 
}

//关闭当前窗口
function doCloseWindows(){
	parent.window.opener = null;
	parent.window.open("", "_self");
	parent.window.close();
}
