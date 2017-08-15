<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:灵感博文处理类
 *author:yanyalong
 *date:2013/11/22
 */
class Content_Class{

	public $replace;

	function __construct(){
		$this->replace[] = "[content]";
		$this->replace[] = "[/content]";
		$this->replace[] = "{";
		$this->replace[] = "}";
		$this->replace[] = "[img]";
		$this->replace[] = "[/img]";
	}
	//处理博文表单数据
	public function replace_str($str){
		$str = str_replace(',','，',$str);

		foreach ($this->replace as $key=>$val) {
			$str = str_replace($val,'',$str);
		}
		return $str;
	}
}
