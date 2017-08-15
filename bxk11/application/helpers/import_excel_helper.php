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
 * @date：2013/10/8 
*/
if(!function_exists('write_dary'))
{
	function write_dary($mes,$ulr=''){
		$CI = &get_instance();
		$CI->config->load('uploads');
		$upload_url = $CI->config->item('upload_file');
		if(empty($ulr)) $ulr = $upload_url['error_url'];
		$sta = 0;
		$maxsta = 100;
	
		$handle = @fopen($ulr,'a+');
	
		do{
			if($sta>0){
				usleep(rand(1000,5000));
			}
			$sta++;
	
		} while(!@flock($handle,LOCK_EX) && $sta<=$maxsta);
		if($sta==$maxsta){
			return false;
		}
		$mesv = $mes."-----".date('Y-m-d H:i:s',time())."\r\n";
		@fwrite($handle,$mesv);
		@flock($handle, LOCK_UN);
		@fclose($handle);
		return true;
	}
}


/**
 * @mes 内容输出
 * @ulr 地址
 * $ulr = 'http://localhost:8080/curl_ini/upload.php'
 * @author liuguangping
 * @date：2013/10/8
 */
if(!function_exists('read_dary'))
{
	function read_dary($url=''){
		$result = array();
		$CI = &get_instance();
		$CI->config->load('uploads');
		$upload_url = $CI->config->item('upload_file');
		if(empty($url)) $url = $upload_url['error_url'];
		$handle = @fopen($url,'r');
		while (!@feof($handle)){
			$result[] = @fgets($handle, 4096);
		}
		@fclose($handle);
		return $result;
	}
}


/**
 * @status 状态 0失败 1成功
 * @msg 信息
 * @return array	
 * @author liuguangping
 * @date：2013/10/8 
*/
if(!function_exists('setError'))
{
	function setError($status,$msg){
		return array(
				'status' => $status,
				'msg'	 => $msg
		);
	}
}
/**
 * @参数 arrs 二维数组
 * @键值 keys 要得到的键名
 * @return 以键值为建的一维数组
 * @author liuguangping
 * @date：2013/10/8 
 */
if(!function_exists('twotoone_array'))
{
	function twotoone_array($arrs,$keys){
		$ar = array();
		foreach ($arrs as $ke=>$va){
			foreach ($va as $kes=>$vals){
				if($kes == $keys){
					$ar[] = $vals;
				}
			}
		}
		return $ar;
	}
}

/**
 * @参数 arrs 二维数组
 * @键值 keys 要得到的一个字段值做键名一个字段傎做值
 * @return 以键值为建的一维数组
 * @author liuguangping
 * @date：2013/10/8
 */
if(!function_exists('twoToOneBykey'))
{
	function twoToOneBykey($arrs,$keys,$arraykey){
		$ar = array();
		foreach ($arrs as $ke=>$va){
			foreach ($va as $kes=>$vals){
				if($kes == $keys){
					$ar[$va[$arraykey]] = $vals;
				}
			}
		}
		return $ar;
	}
}

/**
 * @参数 arrs 二维数组
 * @键值 keys 要得到的一个字段值做键名一个字段傎做值
 * @return 以键值为建的一维数组
 * @author liuguangping
 * @date：2013/10/8
 */
if(!function_exists('twoToOneBykeyObj'))
{
	function twoToOneBykeyObj($arrs,$keys,$arraykey){
		
		$ar = array();
		foreach ($arrs as $ke=>$va){
			
			foreach ($va as $kes=>$vals){
				if($kes == $keys){
					$ar[$va->$arraykey] = $vals;
				}
			}
		}
		return $ar;
	}
}


/**
 *  图片复制到source 文件目录中
 *  $source_url 要复制的目录地址
 *  $destination 目标文件地址
 *  @return bool
 */
if(!function_exists('copy_file'))
{
	function copy_file($source_url,$destination){
		//uploads/room/'.ceil($room_id/1000).'/'.$room_id
		$blogdir = 'uploads/blog/source/';
		$thumb_1_dir = 'uploads/blog/thumb_1/';
		$thumb_2_dir = 'uploads/blog/thumb_2/';
		$thumb_3_dir ='uploads/blog/thumb_3/';
		$thumb_4_dir = 'uploads/blog/thumb_4/';
		//若不存在时间目录则新建
		mktimedir($blogdir);
		mktimedir($thumb_1_dir);
		mktimedir($thumb_2_dir);
		mktimedir($thumb_3_dir);
		mktimedir($thumb_4_dir);
		if(copy($source_url,$destination)){
			return 1;
		}else{
			return 0;
		}
	}
}

/**
 *  多目录创建
 *
 */
if(!function_exists('mkdirs'))
{
	function mkdirs($dir)
	{
		if(!is_dir($dir))
		{
			if(!mkdirs(dirname($dir))){
				
				return false;
			}
			if(!mkdir($dir,0777)){
				return false;
			}
		}
		return true;
	}
}

if(!function_exists('mktimedir'))
{
	function mktimedir($dir){
		$datedir = date("Y").'/'.date("m").'/'.date("d").'/';
		$year = date('Y');
		$month = date('m');
		$day = date('d');
		if(!file_exists($dir.$year)){
			mkdirs($dir.$year);
			//echo  $dir.$year;die;
		}
		if(!file_exists($dir.$year.'/'.$month)){
			mkdirs($dir.$year.'/'.$month);
		}
		if(!file_exists($dir.$datedir)){
			mkdirs($dir.$datedir);
		}
	}
}
/**
 * 添加数组
 *
 */
if(!function_exists('add_arr'))
{
	function add_arr($tag_id,$tag_name,$type){
		return $tagthme[]=array(
				'tag_id'=>$tag_id,
				'tag_name'=>$tag_name,
				'type'    =>$type
		);
	}
}
/**
 * 截取URL的文件后缀
 */
if(!function_exists('setExt'))
{
	function setExt($filename) {
		return strtolower(trim(substr(strrchr($filename, '.'), 1)));
	}
}

/**
 * 把gb2312 轮换成utf-8
 */
if(!function_exists('convertUTF8'))
{
	function convertUTF8($str){
		if(empty($str)) return '';
		return  iconv("gb2312","utf-8", $str);
	}
}



/**
 * PHP 截取中文字符
 * @author liuguangping
 * echo cn_substr_utf8($cc,65)
 */
if(!function_exists('cn_substr_utf8')){
	function cn_substr_utf8($str, $start, $len , $flg=false)
	{
		$strlen = $start + $len; // 用$strlen存储字符串的总长度，即从字符串的起始位置到字符串的总长度
		$tmpstr = '';
		for($i = $start; $i < $strlen;) {
			if (ord ( substr ( $str, $i, 1 ) ) > 0xa0) { // 如果字符串中首个字节的ASCII序数值大于0xa0,则表示汉字
				$tmpstr .= substr ( $str, $i, 3 ); // 每次取出三位字符赋给变量$tmpstr，即等于一个汉字
				$i=$i+3; // 变量自加3
			} else{
				$tmpstr .= substr ( $str, $i, 1 ); // 如果不是汉字，则每次取出一位字符赋给变量$tmpstr
				$i++;
			}
		}
		
		if($flg){
			if(strlen($tmpstr)<=strlen($str))
				$tmpstr.="...";
		}
		return $tmpstr; // 返回字符串
		
	}
			
}


/**
 * UTF8字符串长度
 * @author liuguangping
 * 一个字符全部按 1 个长度计算
 * $str = "PHP测试";  
 * echo strlen_utf8($str);  
 */
if(!function_exists('strlen_utf8')){
	function strlen_utf8($str) {  
		$i = 0;  
		$count = 0;  
		$len = strlen ($str);  
		while ($i < $len) {  
			$chr = ord ($str[$i]);  
			$count++;  
			$i++;  
			if($i >= $len) break;  
			if($chr & 0x80) {  
				$chr <<= 1;  
				while ($chr & 0x80) {  
					$i++;  
					$chr <<= 1;  
				}  
			}  
		}  
		return $count;  
	}		
}

/**
 * GBK字符串长度 
 * @author liuguangping
 * GBK字符串长度  
 * 中文字符计算为2个字符，英文字符计算为1个，可以统计中文字符串长度的函数
 * $str = "PHP测试";  
 * echo abslength($str);  
 */
if(!function_exists('abslength')){
	function abslength($str){  
		$len=strlen($str);  
		$i=0;  
		while($i<$len){  
	       if(preg_match("/^[".chr(0xa1)."-".chr(0xff)."]+$/",$str[$i])){  
	         $i+=2;  
	       }else{  
	         $i+=1;  
	       }  
		}  
		return $i;  
	}     
}
/**
 * UTF8字符串所占的字节数 
 * @author liuguangping
 * echo stringLen_utf8($str);  
 */
if(!function_exists('stringLen_utf8')){
	function stringLen_utf8($str){
		if(!$str) return '';
		return (strlen($str) + mb_strlen($str,'UTF8')) / 2;
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

/* End of file array_helper.php */
/* Location: ./system/helpers/array_helper.php */