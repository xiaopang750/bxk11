<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author liuguangping
 * @date : 2013/10/8

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
 * CodeIgniter Array Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------


/**
 * 邮箱判断
 * @author liuguangping
 * @param String email
 * @return boolean
 */
if(!function_exists('CheckEmail'))
{
	function CheckEmail($email)
	{
		return preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email); 
	} 
}

/**
 * 网址判断
 * @author liuguangping
 * @param String email
 * @return boolean
 */
if(!function_exists('CheckHttp'))
{
	function CheckHttp($url)
	{
		 if (!preg_match("/^http:\/\/[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*$/", $url))
	    {
	        return false;
	    }else{
	    	return true;
	    }
	} 
}
/* End of file array_helper.php */
/* Location: ./system/helpers/array_helper.php */