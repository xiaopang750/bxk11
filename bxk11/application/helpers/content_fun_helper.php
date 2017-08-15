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
 * 根据key获取模块名
 * @author liuguangping
 * @param string modelname 表名
 * @param array id 条件标识 字段 id 值
 * @date：2013/11/15 19
 */
if(!function_exists('getModelByKey'))
{
	function getModelByKey($modelname,$key,$field){
		$CI = &get_instance();
		$CI->load->model($modelname);
		$result = $CI->{$modelname}->getMoAcName($key);
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
 * 根据key获取模块名
 * @author liuguangping
 * @param string modelname 表名
 * @param array id 条件标识 字段 id 值
 * @date：2013/3/22 13
 */
if(!function_exists('getBrandByName'))
{
	function getBrandByName($modelname,$where,$field){

		$CI = &get_instance();
		$CI->load->model($modelname);
		$result = $CI->{$modelname}->getBrandByName('*',$where);
		if($result){
			if($field == ''){
				return $result;
			}else{
				return $result->{$field};
			}
		}else{
			return false;//没有找到
		}
	}
}

/**
 * 根据key获取模块名
 * @author liuguangping
 * @param string modelname 表名
 * @param array id 条件标识 字段 id 值
 * @date：2013/3/22 13
 */
if(!function_exists('getValueName'))
{
	function getValueName($modelname,$where,$field){

		$CI = &get_instance();
		$CI->load->model($modelname);
		$result = $CI->{$modelname}->getValueName('*',$where);
		if($result){
			if($field == ''){
				return $result;
			}else{
				return $result->{$field};
			}
		}else{
			return false;//没有找到
		}
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

/**
 * 字符串全角半角字符转换 utf-8
 * @author liuguangping
 * @param house_id
 * @return boolean
 */
if(!function_exists('UtfToString'))
{
	function UtfToString($string){

		$string = iconv('UTF-8', 'GB2312//IGNORE', $string);
		$string = iconv('GB2312', 'UTF-8//IGNORE', $string);
		return $string;
	}
}

/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 * @author 刘广平 <liuguangpingtest@163.com>
 */
if(!function_exists('list_to_tree'))
{
	function list_to_tree($list, $pk='id', $pid = 'pid', $child = '_child', $root = 0) {
	    // 创建Tree
	    $tree = array();
	    if(is_array($list)) {
	        // 创建基于主键的数组引用
	        $refer = array();
	        foreach ($list as $key => $data) {
	            $refer[$data[$pk]] =& $list[$key];
	           $list[$key][$child] = '';
	        }
	        foreach ($list as $key => $data) {
	            // 判断是否存在parent
	            $parentId =  $data[$pid];
	            if ($root == $parentId) {
	                $tree[] =& $list[$key];
	            }else{
	                if (isset($refer[$parentId])) {
	                    $parent =& $refer[$parentId];
	                    $parent[$child][] =& $list[$key];
	                }
	            }


	        }
	    } 
	    return $tree;
	}
}


/**
* 对查询结果集进行排序
* @access public
* @param array $list 查询结果
* @param string $field 排序的字段名
* @param array $sortby 排序类型
* asc正向排序 desc逆向排序 nat自然排序
* @return array
*/
if(!function_exists('list_sort_by'))
{
	function list_sort_by($list,$field, $sortby='asc') {
	   if(is_array($list)){
	       $refer = $resultSet = array();
	       foreach ($list as $i => $data)
	           $refer[$i] = &$data[$field];
	       switch ($sortby) {
	           case 'asc': // 正向排序
	                asort($refer);
	                break;
	           case 'desc':// 逆向排序
	                arsort($refer);
	                break;
	           case 'nat': // 自然排序
	                natcasesort($refer);
	                break;
	       }
	       foreach ( $refer as $key=> $val)
	           $resultSet[] = &$list[$key];
	       return $resultSet;
	   }
	   return false;
	}
}

/**
 * 将list_to_tree的树还原成列表
 * @param  array $tree  原来的树
 * @param  string $child 孩子节点的键
 * @param  string $order 排序显示的键，一般是主键 升序排列
 * @param  array  $list  过渡用的中间数组，
 * @return array        返回排过序的列表数组
 * @author 刘广平 <liuguangpingtest@163.com>
 */
if(!function_exists('tree_to_list'))
{
	function tree_to_list($tree, $child = '_child', $order='id', &$list = array()){
	    if(is_array($tree)) {
	        $refer = array();
	        foreach ($tree as $key => $value) {
	            $reffer = $value;
	            if(isset($reffer[$child])){
	                unset($reffer[$child]);
	                tree_to_list($value[$child], $child, $order, $list);
	            }
	            $list[] = $reffer;
	        }
	        $list = list_sort_by($list, $order, $sortby='asc');
	    }
	    return $list;
	}
}


/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 * @author 刘广平 <liuguangpingtest@163.com>
 */
if(!function_exists('format_bytes'))
{
	function format_bytes($size, $delimiter = '') {
	    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
	    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
	    return round($size, 2) . $delimiter . $units[$i];
	}
}


/**
 * 系统加密方法
 * @param string $data 要加密的字符串
 * @param string $key  加密密钥
 * @param int $expire  过期时间 单位 秒
 * @return string
 * @author 刘广平 <liuguangpingtest@163.com>
 */
if(!function_exists('lgwx_encrypt'))
{
	function lgwx_encrypt($data, $key = '', $expire = 0) {
	    $key  = md5(empty($key) ? C('DATA_AUTH_KEY') : $key);
	    $data = base64_encode($data);
	    $x    = 0;
	    $len  = strlen($data);
	    $l    = strlen($key);
	    $char = '';

	    for ($i = 0; $i < $len; $i++) {
	        if ($x == $l) $x = 0;
	        $char .= substr($key, $x, 1);
	        $x++;
	    }

	    $str = sprintf('%010d', $expire ? $expire + time():0);

	    for ($i = 0; $i < $len; $i++) {
	        $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1)))%256);
	    }
	    return str_replace('=', '',base64_encode($str));
	}
}

/**
 * 系统解密方法
 * @param  string $data 要解密的字符串 （必须是think_encrypt方法加密的字符串）
 * @param  string $key  加密密钥
 * @return string
 * @author 刘广平 <liuguangpingtest@163.com>
 */
if(!function_exists('lgwx_decrypt'))
{
	function lgwx_decrypt($data, $key = ''){
	    $key    = md5(empty($key) ? C('DATA_AUTH_KEY') : $key);
	    $x      = 0;
	    $data   = base64_decode($data);
	    $expire = substr($data,0,10);
	    $data   = substr($data,10);

	    if($expire > 0 && $expire < time()) {
	        return '';
	    }

	    $len  = strlen($data);
	    $l    = strlen($key);
	    $char = $str = '';

	    for ($i = 0; $i < $len; $i++) {
	        if ($x == $l) $x = 0;
	        $char .= substr($key, $x, 1);
	        $x++;
	    }

	    for ($i = 0; $i < $len; $i++) {
	        if (ord(substr($data, $i, 1))<ord(substr($char, $i, 1))) {
	            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
	        }else{
	            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
	        }
	    }
	    return base64_decode($str);
	}
}
/**
 * 数据签名认证
 * @param  array  $data 被认证的数据
 * @return string       签名
 * @author 刘广平 <liuguangpingtest@163.com>
 */
if(!function_exists('data_auth_sign'))
{
	function data_auth_sign($data) {
	    //数据类型检测
	    if(!is_array($data)){
	        $data = (array)$data;
	    }
	    ksort($data); //排序
	    $code = http_build_query($data); //url编码并生成query字符串
	    $sign = sha1($code); //生成签名
	    return $sign;
	}
}

/**
 * 数据签名认证
 * @param  array  $d 被转换的对象数据
 * @return string       签名
 * @author 刘广平 <liuguangpingtest@163.com>
 */
if(!function_exists('objectToArray'))
{
	function objectToArray($d) 
	{
	        if (is_object($d)) {

	            $d = get_object_vars($d);
	        }
	   
	        if (is_array($d)) {
	       
	            return array_map(__FUNCTION__, $d);
	        }
	        else {
	      
	            return $d;
	        }
	}
}
/* End of file array_helper.php */
/* Location: ./system/helpers/array_helper.php */