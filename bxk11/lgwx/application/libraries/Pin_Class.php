<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:图钉模块
 *author:yanyalong
 *date:2013/11/01
 */
class Pin_Class{

	public $pinStr;
	public $pin_id;
	public $pic_id;
	public $user_id;
	public $pin_product_name;
	public $pin_content;
	public $pin_product_class_id;
	public $pin_product_class_name;
	public $pin_product_id;
	public $pin_product_url;
	public $pin_type;
	public $pin_dig;
	public $pin_down;
	public $pin_subtime;
	public $pin_status;
	public $pin_top;
	public $pin_left;
	public $pin_img;

	/**
	 *description:用于检测并解析发布家居美图post图钉数据字段
	 *author:yanyalong
	 *date:2013/11/01
	 */
	public function checkPinStr(){
		$pinarr = array();
		if($this->pinStr!=''){
			foreach (explode('|^|',$this->pinStr) as $key=>$val) {
				$pinone = explode('^|^',$val);
				if(count($pinone)!=6){
					return false;
				}
				$pinarr[$key]['pin_product_name'] = $pinone[0];	
				$pinarr[$key]['pin_content'] = $pinone[1];	
				$pinarr[$key]['pin_product_class_id'] = $pinone[2];	
				$pinarr[$key]['pin_product_class_name'] = $pinone[3];	
				$pinarr[$key]['pin_top'] = $pinone[4];	
				$pinarr[$key]['pin_left'] = $pinone[5];	
			}
		}
		return $pinarr;
	}
}

