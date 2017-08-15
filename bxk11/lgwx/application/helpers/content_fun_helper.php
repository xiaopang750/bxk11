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
 * @mes 内容
 * @ulr 地址
 * $ulr = 'http://localhost:8080/curl_ini/upload.php'
 * @author liuguangping
 * @param content 博文内容
 * @param type = pic_num 数目 question_content内容 pic_md5 pic_content
 * @date：2013/10/8 
*/
if(!function_exists('question_content'))
{
	function question_content($content,$type = '',$flg='questions'){
		
		$CI = &get_instance();
		if($flg == 'questions'){
			$CI->load->model('t_questions_model');
			$result = $CI->t_questions_model->content_analytic($content);
		}else{
		
			$CI->load->model('t_content_model');
			$result = $CI->t_content_model->content_analytic($content);
		}
		if(empty($type)){
			return $result;
		}else{
			if(!isset($result[$type]) || empty($result[$type]) || is_null($result[$type])){
				$result[$type] = "暂无";
			}
			return $result[$type];
		}
		
		
	}
}

/**
 * @mes 内容
 * @ulr 地址
 * $ulr = 'http://localhost:8080/curl_ini/upload.php'
 * @author liuguangping
 * @param content 博文内容
 * @param type = pic_num 数目 question_content内容 pic_md5 pic_content
 * @date：2013/10/8
 */
if(!function_exists('question_contents'))
{
	function question_contents($content,$type = '',$flg='questions'){

		$CI = &get_instance();
		if($flg == 'questions'){
			$CI->load->model('t_questions_model');
			$result = $CI->t_questions_model->content_analytic($content);
		}else{
			$CI->load->model('t_content_model');
			$result = $CI->t_content_model->content_analytic($content);
		}
		if(empty($type)){
			return $result;
		}else{
			return $result[$type];
		}


	}
}



/**
 * 
 * @author liuguangping
 * @param s_class_id 是系统分类标识id
 * @date：2013/11/15 19
 */
if(!function_exists('is_parent'))
{
	function is_parent($s_class_id){
		$CI = &get_instance();
		$field = 's_class_id';
		$where = array('s_class_pid'=>$s_class_id);
		$CI->load->model('t_system_class_model');
		$result = $CI->t_system_class_model->get_tag($field,$where);
		if(count($result)>0){
			return false;//为父级
		}else{
			return true;//最下一层，没子级
		}
	}
}



/**
 *
 * @author liuguangping
 * @param string modelname 表名
 * @param array id 条件标识 字段 id 值
 * @date：2013/11/15 19
 */
if(!function_exists('get_tag_name'))
{
	function get_tag_name($modelname,$id,$field){
		$CI = &get_instance();
		$CI->load->model($modelname);
		$result = $CI->{$modelname}->get($id);
		if($result){
			if($field == ''){
				return $result;
			}else{
				return $result->{$field};
			}
		}else{
			return "被删除或没有";
		}
	}
}


/**
 * 从string 中去除 value字符
 * @author liuguangping
 * @param string value 要去除的字段  3
 * @param string string 从中去除的字符串 1,2,3
 * @return string data 1,2
 * @date：2013/11/15 19
 */
if(!function_exists('del_same'))
{
	function del_same($value,$string){
		$return = array();
		$array = explode(',',$string);	
		if(in_array($value,$array)){
			foreach($array as $val){
				if($val != $value){
					$return[] = $val; 
				}
			}
		}else{
			$return = $array;
		}
		return implode(',',$return);
	}
}


/**
 * 从string 中去除 value字符
 * @author liuguangping
 * @date：2013/11/15 19
 */
if(!function_exists('getdisablecontent'))
{
	function getdisablecontent($type_id){

		$CI = &get_instance();
		$CI->config->load('type');
		$type_config = $CI->config->item('system_disable');

		foreach($type_config['type'] as $value){
			if($value['type'] == $type_id){
				return $value['type_content'];
			}
		}
		return false;
	}
}

/**
 * 获致房间坐标和信息
 * @author liuguangping
 * @param string value 要去除的字段  3
 * @param string string 从中去除的字符串 1,2,3
 * @return string data 1,2
 * @date：2013/11/15 19
 */
if(!function_exists('getfloorroom'))
{
	function getfloorroom($floor_map_coor){
		$result = array();
		if($floor_map_coor){
			$floor_map_coor = explode('|', $floor_map_coor);
			if($floor_map_coor){
				foreach($floor_map_coor as $value){
					$value = str_replace('，', ',', $value);
					$room = explode(',', $value);
					$result[]=array('room_id'=>$room[0],'room_name'=>$room[1],'mapx'=>$room[2],'mapy'=>$room[3]);
				}
				return $result;
			}
		}
		return false;
	}
}

/**
 * 根据房间id判断是否有房间装修单表
 * @author liuguangping
 * @param room_id
 * @return boolean
 */
if(!function_exists('getroombill'))
{
	function getroombillitem($room_id){
		$result = array();
		if($room_id){
			$CI = &get_instance();
			$CI->load->model('t_project_room_bill_item_model');
			$result  = $CI->t_project_room_bill_item_model->getBillitemByItem('item_id',array('room_id'=>$room_id));
			if($result){
				return true;
			}else{
				return false;
			}
		}
		return false;
	}
}

/**
 * 根据地区id取地区名
 * @author liuguangping
 * @param district_code
 * @return boolean
 */
if(!function_exists('getAraeName'))
{
	function getAraeName($district_code){
		
		if($district_code){
			$CI = &get_instance();
			$CI->load->model('t_system_district_model');
			$result  = $CI->t_system_district_model->getcityinfo($district_code);
			if(isset($result)&& $result !=''){
				return $result->district_name;
			}else{
				return false;
			}
		}
		return false;
	}
}


/**
 * 根据用户id得用户名
 * @author liuguangping
 * @param user_id
 * @return boolean
 */
if(!function_exists('getUserName'))
{
	function getUserName($user_id){
		
		if($user_id){
			$CI = &get_instance();
			$CI->load->model('t_user_model');
			$result  = $CI->t_user_model->get($user_id);
			if(isset($result)&& $result !=''){
				return $result->user_nickname;
			}else{
				return false;
			}
		}
		return false;
	}
}

/**
 * 根据楼盘id得到楼盘名
 * @author liuguangping
 * @param house_id
 * @return boolean
 */
if(!function_exists('getHouseApartmentName'))
{
	function getHouseApartmentName($house_id){

		if($house_id){
			$CI = &get_instance();
			$CI->load->model('t_house_model');
			$result  = $CI->t_house_model->get($house_id);
			if(isset($result)&& $result !=''){
				return $result->house_name;
			}else{
				return false;
			}
		}
		return false;
	}
}
/* End of file array_helper.php */
/* Location: ./system/helpers/array_helper.php */