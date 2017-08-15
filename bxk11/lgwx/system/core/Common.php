<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Common Functions
 *
 * Loads the base classes and executes the request.
 *
 * @package		CodeIgniter
 * @subpackage	codeigniter
 * @category	Common Functions
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/
 */

// ------------------------------------------------------------------------

/**
 * Determines if the current version of PHP is greater then the supplied value
 *
 * Since there are a few places where we conditionally test for PHP > 5
 * we'll set a static variable.
 *
 * @access	public
 * @param	string
 * @return	bool	TRUE if the current version is $version or higher
 */
if ( ! function_exists('is_php'))
{
    function is_php($version = '5.0.0')
    {
        static $_is_php;
        $version = (string)$version;

        if ( ! isset($_is_php[$version]))
        {
            $_is_php[$version] = (version_compare(PHP_VERSION, $version) < 0) ? FALSE : TRUE;
        }

        return $_is_php[$version];
    }
}

// ------------------------------------------------------------------------

/**
 * Tests for file writability
 *
 * is_writable() returns TRUE on Windows servers when you really can't write to
 * the file, based on the read-only attribute.  is_writable() is also unreliable
 * on Unix servers if safe_mode is on.
 *
 * @access	private
 * @return	void
 */
if ( ! function_exists('is_really_writable'))
{
    function is_really_writable($file)
    {
        // If we're on a Unix server with safe_mode off we call is_writable
        if (DIRECTORY_SEPARATOR == '/' AND @ini_get("safe_mode") == FALSE)
        {
            return is_writable($file);
        }

        // For windows servers and safe_mode "on" installations we'll actually
        // write a file then read it.  Bah...
        if (is_dir($file))
        {
            $file = rtrim($file, '/').'/'.md5(mt_rand(1,100).mt_rand(1,100));

            if (($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE)
            {
                return FALSE;
            }

            fclose($fp);
            @chmod($file, DIR_WRITE_MODE);
            @unlink($file);
            return TRUE;
        }
        elseif ( ! is_file($file) OR ($fp = @fopen($file, FOPEN_WRITE_CREATE)) === FALSE)
        {
            return FALSE;
        }

        fclose($fp);
        return TRUE;
    }
}

// ------------------------------------------------------------------------

/**
 * Class registry
 *
 * This function acts as a singleton.  If the requested class does not
 * exist it is instantiated and set to a static variable.  If it has
 * previously been instantiated the variable is returned.
 *
 * @access	public
 * @param	string	the class name being requested
 * @param	string	the directory where the class should be found
 * @param	string	the class name prefix
 * @return	object
 */
if ( ! function_exists('load_class'))
{
    function &load_class($class, $directory = 'libraries', $prefix = 'CI_')
    {
        static $_classes = array();

        // Does the class exist?  If so, we're done...
        if (isset($_classes[$class]))
        {
            return $_classes[$class];
        }

        $name = FALSE;

        // Look for the class first in the local application/libraries folder
        // then in the native system/libraries folder
        foreach (array(APPPATH, BASEPATH) as $path)
        {
            if (file_exists($path.$directory.'/'.$class.'.php'))
            {
                $name = $prefix.$class;

                if (class_exists($name) === FALSE)
                {
                    require($path.$directory.'/'.$class.'.php');
                }

                break;
            }
        }

        // Is the request a class extension?  If so we load it too
        if (file_exists(APPPATH.$directory.'/'.config_item('subclass_prefix').$class.'.php'))
        {
            $name = config_item('subclass_prefix').$class;

            if (class_exists($name) === FALSE)
            {
                require(APPPATH.$directory.'/'.config_item('subclass_prefix').$class.'.php');
            }
        }

        // Did we find the class?
        if ($name === FALSE)
        {
            // Note: We use exit() rather then show_error() in order to avoid a
            // self-referencing loop with the Excptions class
            exit('Unable to locate the specified class: '.$class.'.php');
        }

        // Keep track of what we just loaded
        is_loaded($class);

        $_classes[$class] = new $name();
        return $_classes[$class];
    }
}

// --------------------------------------------------------------------

/**
 * Keeps track of which libraries have been loaded.  This function is
 * called by the load_class() function above
 *
 * @access	public
 * @return	array
 */
if ( ! function_exists('is_loaded'))
{
    function &is_loaded($class = '')
    {
        static $_is_loaded = array();

        if ($class != '')
        {
            $_is_loaded[strtolower($class)] = $class;
        }

        return $_is_loaded;
    }
}

// ------------------------------------------------------------------------

/**
 * Loads the main config.php file
 *
 * This function lets us grab the config file even if the Config class
 * hasn't been instantiated yet
 *
 * @access	private
 * @return	array
 */
if ( ! function_exists('get_config'))
{
    function &get_config($replace = array())
    {
        static $_config;

        if (isset($_config))
        {
            return $_config[0];
        }

        // Is the config file in the environment folder?
        if ( ! defined('ENVIRONMENT') OR ! file_exists($file_path = APPPATH.'config/'.ENVIRONMENT.'/config.php'))
        {
            $file_path = APPPATH.'config/config.php';
        }

        // Fetch the config file
        if ( ! file_exists($file_path))
        {
            exit('The configuration file does not exist.');
        }

        require($file_path);

        // Does the $config array exist in the file?
        if ( ! isset($config) OR ! is_array($config))
        {
            exit('Your config file does not appear to be formatted correctly.');
        }

        // Are any values being dynamically replaced?
        if (count($replace) > 0)
        {
            foreach ($replace as $key => $val)
            {
                if (isset($config[$key]))
                {
                    $config[$key] = $val;
                }
            }
        }

        return $_config[0] =& $config;
    }
}

// ------------------------------------------------------------------------

/**
 * Returns the specified config item
 *
 * @access	public
 * @return	mixed
 */
if ( ! function_exists('config_item'))
{
    function config_item($item)
    {
        static $_config_item = array();

        if ( ! isset($_config_item[$item]))
        {
            $config =& get_config();

            if ( ! isset($config[$item]))
            {
                return FALSE;
            }
            $_config_item[$item] = $config[$item];
        }

        return $_config_item[$item];
    }
}

// ------------------------------------------------------------------------

/**
 * Error Handler
 *
 * This function lets us invoke the exception class and
 * display errors using the standard error template located
 * in application/errors/errors.php
 * This function will send the error page directly to the
 * browser and exit.
 *
 * @access	public
 * @return	void
 */
if ( ! function_exists('show_error'))
{
    function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered')
    {
        $_error =& load_class('Exceptions', 'core');
        echo $_error->show_error($heading, $message, 'error_general', $status_code);
        exit;
    }
}

// ------------------------------------------------------------------------

/**
 * 404 Page Handler
 *
 * This function is similar to the show_error() function above
 * However, instead of the standard error template it displays
 * 404 errors.
 *
 * @access	public
 * @return	void
 */
if ( ! function_exists('show_404'))
{
    function show_404($page = '', $log_error = TRUE)
    {
        $_error =& load_class('Exceptions', 'core');
        $_error->show_404($page, $log_error);
        exit;
    }
}

// ------------------------------------------------------------------------

/**
 * Error Logging Interface
 *
 * We use this as a simple mechanism to access the logging
 * class and send messages to be logged.
 *
 * @access	public
 * @return	void
 */
if ( ! function_exists('log_message'))
{
    function log_message($level = 'error', $message, $php_error = FALSE)
    {
        static $_log;

        if (config_item('log_threshold') == 0)
        {
            return;
        }

        $_log =& load_class('Log');
        $_log->write_log($level, $message, $php_error);
    }
}

// ------------------------------------------------------------------------

/**
 * Set HTTP Status Header
 *
 * @access	public
 * @param	int		the status code
 * @param	string
 * @return	void
 */
if ( ! function_exists('set_status_header'))
{
    function set_status_header($code = 200, $text = '')
    {
        $stati = array(
            200	=> 'OK',
            201	=> 'Created',
            202	=> 'Accepted',
            203	=> 'Non-Authoritative Information',
            204	=> 'No Content',
            205	=> 'Reset Content',
            206	=> 'Partial Content',

            300	=> 'Multiple Choices',
            301	=> 'Moved Permanently',
            302	=> 'Found',
            304	=> 'Not Modified',
            305	=> 'Use Proxy',
            307	=> 'Temporary Redirect',

            400	=> 'Bad Request',
            401	=> 'Unauthorized',
            403	=> 'Forbidden',
            404	=> 'Not Found',
            405	=> 'Method Not Allowed',
            406	=> 'Not Acceptable',
            407	=> 'Proxy Authentication Required',
            408	=> 'Request Timeout',
            409	=> 'Conflict',
            410	=> 'Gone',
            411	=> 'Length Required',
            412	=> 'Precondition Failed',
            413	=> 'Request Entity Too Large',
            414	=> 'Request-URI Too Long',
            415	=> 'Unsupported Media Type',
            416	=> 'Requested Range Not Satisfiable',
            417	=> 'Expectation Failed',

            500	=> 'Internal Server Error',
            501	=> 'Not Implemented',
            502	=> 'Bad Gateway',
            503	=> 'Service Unavailable',
            504	=> 'Gateway Timeout',
            505	=> 'HTTP Version Not Supported'
        );

        if ($code == '' OR ! is_numeric($code))
        {
            show_error('Status codes must be numeric', 500);
        }

        if (isset($stati[$code]) AND $text == '')
        {
            $text = $stati[$code];
        }

        if ($text == '')
        {
            show_error('No status text available.  Please check your status code number or supply your own message text.', 500);
        }

        $server_protocol = (isset($_SERVER['SERVER_PROTOCOL'])) ? $_SERVER['SERVER_PROTOCOL'] : FALSE;

        if (substr(php_sapi_name(), 0, 3) == 'cgi')
        {
            header("Status: {$code} {$text}", TRUE);
        }
        elseif ($server_protocol == 'HTTP/1.1' OR $server_protocol == 'HTTP/1.0')
        {
            header($server_protocol." {$code} {$text}", TRUE, $code);
        }
        else
        {
            header("HTTP/1.1 {$code} {$text}", TRUE, $code);
        }
    }
}

// --------------------------------------------------------------------

/**
 * Exception Handler
 *
 * This is the custom exception handler that is declaired at the top
 * of Codeigniter.php.  The main reason we use this is to permit
 * PHP errors to be logged in our own log files since the user may
 * not have access to server logs. Since this function
 * effectively intercepts PHP errors, however, we also need
 * to display errors based on the current error_reporting level.
 * We do that with the use of a PHP error template.
 *
 * @access	private
 * @return	void
 */
if ( ! function_exists('_exception_handler'))
{
    function _exception_handler($severity, $message, $filepath, $line)
    {
        // We don't bother with "strict" notices since they tend to fill up
        // the log file with excess information that isn't normally very helpful.
        // For example, if you are running PHP 5 and you use version 4 style
        // class functions (without prefixes like "public", "private", etc.)
        // you'll get notices telling you that these have been deprecated.
        if ($severity == E_STRICT)
        {
            return;
        }

        $_error =& load_class('Exceptions', 'core');

        // Should we display the error? We'll get the current error_reporting
        // level and add its bits with the severity bits to find out.
        if (($severity & error_reporting()) == $severity)
        {
            $_error->show_php_error($severity, $message, $filepath, $line);
        }

        // Should we log the error?  No?  We're done...
        if (config_item('log_threshold') == 0)
        {
            return;
        }

        $_error->log_exception($severity, $message, $filepath, $line);
    }
}

// --------------------------------------------------------------------

/**
 * Remove Invisible Characters
 *
 * This prevents sandwiching null characters
 * between ascii characters, like Java\0script.
 *
 * @access	public
 * @param	string
 * @return	string
 */
if ( ! function_exists('remove_invisible_characters'))
{
    function remove_invisible_characters($str, $url_encoded = TRUE)
    {
        $non_displayables = array();

        // every control character except newline (dec 10)
        // carriage return (dec 13), and horizontal tab (dec 09)

        if ($url_encoded)
        {
            $non_displayables[] = '/%0[0-8bcef]/';	// url encoded 00-08, 11, 12, 14, 15
            $non_displayables[] = '/%1[0-9a-f]/';	// url encoded 16-31
        }

        $non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127

        do
        {
            $str = preg_replace($non_displayables, '', $str, -1, $count);
        }
        while ($count);

        return $str;
    }
}

// ------------------------------------------------------------------------

/**
 * Returns HTML escaped variable
 *
 * @access	public
 * @param	mixed
 * @return	mixed
 */
if ( ! function_exists('html_escape'))
{
    function html_escape($var)
    {
        if (is_array($var))
        {
            return array_map('html_escape', $var);
        }
        else
        {
            return htmlspecialchars($var, ENT_QUOTES, config_item('charset'));
        }
    }
}
/**
 *description:实例化model
 *author:yanyalong
 *date:2013/08/12
 */
if ( ! function_exists('model'))
{
    function model($tablename)
    {
        $CI = &get_instance();
        $modelname = $tablename."_model";
        $CI->load->model($modelname);
        $model= $CI->$modelname;
        return $model;
    }
}

/**
 *description:获取配置信息内容
 *author:liuguangping
 *date:2014/05/15
 */
if ( ! function_exists('C'))
{
    function C($configName='',$item='')
    {

        if(!$configName) return $config = & get_config();
        // Is the config file in the environment folder?
        if ( ! defined('ENVIRONMENT') OR ! file_exists($file_path = APPPATH.'config/'.ENVIRONMENT."/{$configName}.php"))
        {
            $file_path = APPPATH."config/{$configName}.php";
        }

        // Fetch the config file
        if ( ! file_exists($file_path))
        {
            exit('The configuration file does not exist.');
        }

        require($file_path);

        // Does the $config array exist in the file?
        if ( ! isset($config) OR ! is_array($config))
        {
            exit('Your config file does not appear to be formatted correctly.');
        }

        if($item){
            if(isset($config[$item])) return $config[$item];else return false;
            
        }else{
            return $config;
        }


    }
}

/**
 *description:获取地址信息
 *author:liuguangping
 *date:2014/05/15
 */
if ( ! function_exists('U'))
{
    function U($url='',$array=array())
    {
        $CI = &get_instance();
        $CI->load->helper('url');
        // Does the $config array exist in the file?
        if($url){
            if(empty($array)){
                return site_url($url);
            }else{
                if(is_array($array)){
                    $explode = array();
                    foreach ($array as $key => $value) {
                        $explode[] = $key.'='.$value;
                    }
                    $implode = implode('&', $explode);
                    return site_url($url)."?".$implode;
                }else{
                    return site_url($url);
                }
            }
        }else{
            return site_url();
        }
    }
}

/**
 * 记录和统计时间（微秒）和内存使用情况
 * 使用方法:
 * <code>
 * G('begin'); // 记录开始标记位
 * // ... 区间运行代码
 * G('end'); // 记录结束标签位
 * echo G('begin','end',6); // 统计区间运行时间 精确到小数后6位
 * echo G('begin','end','m'); // 统计区间内存使用情况
 * 如果end标记位没有定义，则会自动以当前作为标记位
 * 其中统计内存使用需要 MEMORY_LIMIT_ON 常量为true才有效
 * </code>
 * @param string $start 开始标签
 * @param string $end 结束标签
 * @param integer|string $dec 小数位或者m
 * @return mixed
 */
if ( ! function_exists('G'))
{   
    
    // 记录内存初始使用
    define('MEMORY_LIMIT_ON',function_exists('memory_get_usage'));
    function G($start,$end='',$dec=4) {
        static $_info       =   array();
        static $_mem        =   array();
        if(is_float($end)) { // 记录时间
            $_info[$start]  =   $end;
        }elseif(!empty($end)){ // 统计时间和内存使用
            if(!isset($_info[$end])) $_info[$end]       =  microtime(TRUE);
            if(MEMORY_LIMIT_ON && $dec=='m'){
                if(!isset($_mem[$end])) $_mem[$end]     =  memory_get_usage();
                return number_format(($_mem[$end]-$_mem[$start])/1024);
            }else{
                return number_format(($_info[$end]-$_info[$start]),$dec);
            }

        }else{ // 记录时间和内存使用
            $_info[$start]  =  microtime(TRUE);
            if(MEMORY_LIMIT_ON) $_mem[$start]           =  memory_get_usage();
        }
    }
}

/**
 *description:根据二维数组某个索引值进行排序
 *author:yanyalong
 *date:2013/08/28
 */
if(!function_exists('arraysort'))
{
    function arraysort(&$array, $key_name, $sort_order = 'SORT_ASC', $sort_type = 'SORT_REGULAR') {
        if (!is_array($array)) {
            return $array;
        }
        $arg_count = func_num_args();
        for ($i = 1; $i < $arg_count; $i++) {
            $arg = func_get_arg($i);
            if (!preg_match('/SORT/', $arg)) {
                $key_name_list[] = $arg;
                $sort_rule[] = '$'.$arg;
            } else {
                $sort_rule[] = $arg;
            }
        }
        foreach ($array as $key => $info) {
            foreach ($key_name_list as $key_name) {
                ${$key_name}[$key] = $info[$key_name];
            }
        }
        $eval_str = 'array_multisort('.implode(',', $sort_rule).', $array);';
        eval($eval_str);
        return $array;
    }
}


/**
 *description:json返回
 *author:yanyalong
 *param:$flag 0：数据结果为空或执行失败等,1：执行成功或存在相应数据，message:消息说明
 *date:2013/09/16
 */
if(!function_exists('echojson'))
{
    function echojson($status,$data,$msg="") {
        echo "{".'"err":'.intval($status).",".'"data"'.":".json_encode($data).",".'"msg"'.":".json_encode($msg)."}";exit;
    }
}
/**
 *description: 加载类包并实例化
 *author:yanyalong
 *param:libName:类包名
 *date:2013/11/01
 */
if(!function_exists('loadLib'))
{
    function loadLib($libName){
        include_once $_SERVER['DOCUMENT_ROOT']."/lgwx/application/libraries/$libName.php";
    }
}

/**
 *description:前端加载静态文件
 *author:yanyalong
 *date:2013/11/27
 */
function loadStatic($url){
    echo "/static".$url;
}

/**
 *description:根据房间id获取全景房间路径
 *author:yanyalong
 *date:2013/12/14
 */
function roomurl($room_id){
    return '/uploads/room/'.ceil($room_id/1000).'/'.$room_id.'/';
}

/**
 *description:根据房间id获取房间路径
 *author:liuguangping
 *date:2013/12/14
 */
function roomimage($room_id){
    return 'uploads/room/'.ceil($room_id/1000).'/'.$room_id;
}
/**
 *description:根据房间id获取全景房间图片路径
 *author:yanyalong
 *date:2013/12/14
 */
function roomurlpic($room_id){
    $CI = &get_instance();
    $CI->config->load('uploads');
    $config = $CI->config->item('room_3d_rname');
    foreach ($config as $key=>$val) {
        $res = $_SERVER['DOCUMENT_ROOT'].'/uploads/room/'.ceil($room_id/999).'/'.$room_id.'/'.$val;
        if(!file_exists($res)){
            $pic[] = '/static/images/lib/global/blank.gif';
        }else{
            $pic[] = '/uploads/room/'.ceil($room_id/1000).'/'.$room_id.'/'.$val;
        }
    }
    return $pic;
}

/**
 *description:根据方案id获取整体方案全景xml地址
 *author:yanyalong
 *date:2013/12/14
 */
function xmlurl($scheme_id){
    $picurl = '/uploads/scheme/'.ceil($scheme_id/1000).'/'.$scheme_id.'/';
    return $picurl;
}

/**
 *description:根据方案id获取整体方案地址
 *author:liuguangping
 *date:2013/12/24
 */
function xmlurlimage($scheme_id){
    $picurl = 'uploads/scheme/'.ceil($scheme_id/1000).'/'.$scheme_id;
    return $picurl;
}

/**
 *description:根据房间id获取平面房间路径
 *author:yanyalong
 *date:2013/12/14
 */
function d2roomurl($room_id,$dir){
    return '/uploads/room/'.$dir.'/'.ceil($room_id/1000).'/'.$room_id.'/';
}
/**
 *description:根据户型id获取户型图路径
 *author:yanyalong
 *date:2013/12/15
 */
function apartmenturl($apartmentid,$apartment_floor_pic1=""){
    $CI = &get_instance();
    $CI->config->load('uploads');
    $config = $CI->config->item('apartment');
    $pic = $_SERVER['DOCUMENT_ROOT'].$config['relative_path']."thumb_1/".ceil($apartmentid/1000)."/".$apartment_floor_pic1;
    $pic2 = $config['relative_path'].'thumb_1/'.ceil($apartmentid/1000)."/".$apartment_floor_pic1;	
    if(!file_exists($pic)||$apartment_floor_pic1==""){
        $pic2 = $config['default_1'];
    }
    return $pic2;
}
/**
 *description:根据户型id获取户型图目录
 *author:yanyalong
 *date:2013/12/15
 */
function apartmentdir($apartmentid){
    $CI = &get_instance();
    $CI->config->load('uploads');
    $config = $CI->config->item('apartment');
    $url = $config['upload_path'];
    return $url;
}

/**
 *description: 获取户型地址
 *author:liuguangping
 *date:2013/12/14
 */
function removeapartment($apartmentid,$filename){
    return 'uploads/apartment/'.$filename.'/'.ceil($apartmentid/1000)."/";
}
/**
 *description:递归删除非空目录
 *author:yanyalong
 *date:2013/12/16
 */
function removeDir($dirName)
{
    if(! is_dir($dirName))
    {
        return false;
    }
    $handle = @opendir($dirName);
    while(($file = @readdir($handle)) !== false)
    {
        if($file != '.' && $file != '..')
        {
            $dir = $dirName . '/' . $file;
            is_dir($dir) ? removeDir($dir) : @unlink($dir);
        }
    }
    closedir($handle);

    return rmdir($dirName) ;
} 

/**
 *description:获取楼层平面布置图地址
 *author:yanyalong
 *date:2013/12/18
 */
function getfloor1url($scheme_id,$floor_id){
    $picurl = '/uploads/scheme/'.ceil($scheme_id/1000).'/'.$scheme_id.'/'.$floor_id.'/';
    return $picurl;
}
/**
 *description:获取房间坐标信息
 *author:yanyalong
 *date:2013/12/19
 */
function roommap($floor_map_coor,$room_id){
    $map = explode('|',$floor_map_coor);	
    $roommap = array();
    foreach ($map as $key=>$val) {
        $room = explode(',',$val);	
        if(intval($room_id)==intval($room['0'])){
            $roommap['mapx'] = $room['2'];
            $roommap['mapy'] = $room['3'];
            continue;
        }
    }
    if($roommap['mapx']==""&&$roommap['mapy']==""){
        $roommap['mapx'] =  "0";
        $roommap['mapy'] = "0";
    }
    return $roommap;
}

/**
 * @abstract 生成随机平台编码
 * @author liuguangping
 * @version 2013/12/28
 * @return String
 */

if ( ! function_exists('randcode'))
{
    function randcode($length)
    {
        $hash = '';  
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';  
        $max = strlen($chars) - 1;  
        PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);  
        for($i = 0; $i < $length; $i++) {  
            $hash .= $chars[mt_rand(0, $max)];  
        }  
        return $hash;  

    }
}

/**
 *description:加载防sql注入类库
 *author:yanyalong
 *date:2014/01/07
 */
if ( ! function_exists('safeFilter'))
{
    function safeFilter()
    {
        loadLib("Safe_filter");
    }
}

/**
 *description:敏感词校验
 *author:yanyalong
 *date:2014/01/16
 */
if ( ! function_exists('disableCheck'))
{
    function disableCheck()
    {
        loadLib("Disable_Check");
        $_POST =DisableCheckFactory::createObj();
        return $_POST;
    }
}

/**
 *description:获取客户端真实ip
 *author:yanyalong
 *date:2014/03/21
 */
if ( ! function_exists('getIP')){
    function getIP(){
        static $realip;
        if (isset($_SERVER)){
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")){
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }
        return $realip;
    }
}
/**
 *description:根据控制器操作路径获取控制器名称和控制器操作名称
 *author:yanyalong
 *date:2014/03/25
 */
function getActionByUrl($url){
    $urlarr = explode('index.php/',trim($url,'/'));
    return $urlarr[count($urlarr)-1];
}

/**
 *description:根据二维数组某个值进行升序排序
 *author:yanyalong
 *date:2014/04/24
 */
function sortArrayAsc($preData,$sortType=''){    
    $sortData = array();    
    foreach ($preData as $key_i => $value_i){    
        $price_i = $value_i[$sortType];    
        $min_key = '';    
        $sort_total = count($sortData);    
        foreach ($sortData as $key_j => $value_j){    
            if($price_i<$value_j[$sortType]){    
                $min_key = $key_j+1;    
                break;    
            }    
        }    
        if(empty($min_key)){  
            array_push($sortData, $value_i);     
        }else {    
            $sortData1 = array_slice($sortData, 0,$min_key-1);     
            array_push($sortData1, $value_i);    
            if(($min_key-1)<$sort_total){    
                $sortData2 = array_slice($sortData, $min_key-1);     
                foreach ($sortData2 as $value){    
                    array_push($sortData1, $value);    
                }    
            }    
            $sortData = $sortData1;    
        }    
    }    
    return $sortData;    
}    
/**
 *description:根据二维数组某个值进行升序排序
 *author:yanyalong
 *date:2014/04/24
 */
function sortArrayDesc($preData,$sortType=''){    
    $sortData = array();    
    foreach ($preData as $key_i => $value_i){    
        $price_i = $value_i[$sortType];    
        $min_key = '';    
        $sort_total = count($sortData);    
        foreach ($sortData as $key_j => $value_j){    
            if($price_i>$value_j[$sortType]){    
                $min_key = $key_j+1;    
                break;    
            }    
        }    
        if(empty($min_key)){    
            array_push($sortData, $value_i);     
        }else {    
            $sortData1 = array_slice($sortData, 0,$min_key-1);     
            array_push($sortData1, $value_i);    
            if(($min_key-1)<$sort_total){    
                $sortData2 = array_slice($sortData, $min_key-1);     
                foreach ($sortData2 as $value){    
                    array_push($sortData1, $value);    
                }    
            }    
            $sortData = $sortData1;    
        }    
    }    
    return $sortData;    
}    

/**
 *description:获取指定目录下的所有文件
 *author:yanyalong
 *date:2014/05/23
 */
function getDirFiles($dirname){
    $dir_handle=opendir($dirname);
    $data = array();
    while($file=readdir($dir_handle)){
        if($file!="."&&$file!="..")
        $data[] = $file;
    }
    closedir($dir_handle);    
    return $data;
}

/**
 * @abstract 生成随机平台编码
 * @author liuguangping
 * @version 2013/3/25
 * @return String
 */

if ( ! function_exists('jumpAjax'))
{
    function jumpAjax($message,$url)
    {
        if($message && $url){
            echo "<script type='text/javascript'>alert('".$message."');window.location.href='".$url."'</script>";exit;
        }elseif(!$message && $url){
            header("Location:$url");exit;
            //echo "<script type='text/javascript'>window.location.href='".$url."'</script>";exit;
        }elseif($message && !$url){
            echo "<script type='text/javascript'>alert('".$message."');</script>";exit;
        }else{
            return true;
        }

    }
}

/**
 * @abstract 生成第三方地址
 * @author liuguangping
 * @version 2013/3/25
 * @return String
 */
if ( ! function_exists('authorizeURL'))
{
    function authorizeURL()
    {
        //qqweibo
        $qqweiboConfig = C('sns','qqweibo');
        $client_id = $qqweiboConfig['QW_CLIENT_ID'];
        $client_secret = $qqweiboConfig['QW_CLIENT_SECRET'];
        $redirect_uriqqWeibo = urlencode($qqweiboConfig['QW_CALLBACK_URL']);
        $redt['qqweibo_code_url'] = "https://open.t.qq.com/cgi-bin/oauth2/authorize?client_id=".$client_id."&redirect_uri=".$redirect_uriqqWeibo."&response_type=code&wap=0";
        //sina
        loadLib( 'sns/sina/saetv2.ex.class' );
        $sinaConfig = C('sns','sina');
        $sinaObj = new SaeTOAuthV2( $sinaConfig['WB_AKEY'] , $sinaConfig['WB_SKEY'] );
        $redt['sina_code_url'] = $sinaObj->getAuthorizeURL( $sinaConfig['WB_CALLBACK_URL'] );
        //weixin
        loadLib( 'sns/weixin/wechat.class' );
        $weixinConfig = C('sns','weixin');
        $options = array(
                'appid'=>$weixinConfig['appid'],
                'appsecret'=>$weixinConfig['secret'],
                'debug'=>$weixinConfig['debug']
            );
        $weixinObj = new Wechat($options);
        $state = md5('jia178');
        //$redt['weixin_code_url'] = $weixinObj->getOauthRedirect( $weixinConfig['redirect_uri'] , $state);
        $redt['weixin_code_url'] = $weixinObj->getOauthRedirect( $weixinConfig['redirect_uri_snsapi_base'] , $state,'snsapi_base');
        //qzone
        loadLib( 'sns/qzone/API/qqConnectAPI');
        $qzoneObj = new QC();
        $qzoneConfig = C('sns','qzone');
        $redt['qzone_code_url'] = $qzoneObj->getAuthorizeURL();

        //renren
        loadLib( 'sns/renren/RennClient');
        $renrenConfig = C('sns','renren');
        $renrenObj = new RennClient ( $renrenConfig['app_key'], $renrenConfig['app_secret'] );
        $renrenObj->setDebug ( $renrenConfig['debug'] );
        // 生成state并存入SESSION，以供CALLBACK时验证使用
        $state = uniqid ( 'renren_', true );
        $_SESSION ['renren_state'] = $state;
        // 得认证授权的url
        $redt['renren_code_url'] = $renrenObj->getAuthorizeURL ( $renrenConfig['callback_url'], 'code', $state );
        return $redt;
    }
}

/**
 *description:获取客户端IP
 *author:liuguangping
 *date:2014/06/21
 */
if ( ! function_exists('getClientIp'))
{
   function getClientIp()
    {
        if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
            $ip = getenv ( "HTTP_CLIENT_IP" );
        else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
            $ip = getenv ( "HTTP_X_FORWARDED_FOR" );
        else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
            $ip = getenv ( "REMOTE_ADDR" );
        else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
            $ip = $_SERVER ['REMOTE_ADDR'];
        else
            $ip = "unknown";
        return ($ip);
    }
}
/* End of file Common.php */
/* Location: ./system/core/Common.php */


