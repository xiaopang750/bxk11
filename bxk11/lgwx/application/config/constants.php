<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
 */
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
 */

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


define('APP_DIR','lgwx');
//全局常量配置，判断当前是wap站还是平台
if(strpos($_SERVER['PHP_SELF'],"index.php/wap/")==false) {
	//lgwx
	define('PROJECT_NAME',		'lgwx');
	define('CUSTOM_VIEW','static/src/'.PROJECT_NAME.'/views/main/'); 

} else {
	//wap
	define('PROJECT_NAME','wap');
	//define('CUSTOM_VIEW','static/src/'.PROJECT_NAME.'/model/type1/views/'); 
	define('CUSTOM_VIEW','static/src/'.PROJECT_NAME.'/model/'); 
	
}

//include(当前站点静态文件目录)
define('APP_STATIC',$_SERVER['DOCUMENT_ROOT'].'/lgwx/static/src/'.PROJECT_NAME.'/'); 

//css img(当前站点静态文件url地址)
define('APP_LINK','http://'.$_SERVER['HTTP_HOST'].'/lgwx/static/src/'.PROJECT_NAME.'/');

//seajs入口文件
define('APP_SEAJS','http://'.$_SERVER['HTTP_HOST'].'/lgwx/');

//root
define('ROOT','http://'.$_SERVER['HTTP_HOST'].'/lgwx/static/src/');  


//wap站模版目录，用以在平台操作wap站图片
define('TEMPLATE_STATIC',$_SERVER['DOCUMENT_ROOT'].'/lgwx/static/system/wap/skin/'); 

//wap站模版url地址，用以在平台操作wap站图片
define('TEMPLATE_LINK','/lgwx/static/system/wap/skin/');

/* End of file constants.php */
/* Location: ./application/config/constants.php */

