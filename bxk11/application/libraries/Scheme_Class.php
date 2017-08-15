<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class SchemeCheckFactory{
	public static function createObj($post,$postType='add'){
		switch ($postType){
		case 'mod':
			$obj = new ShemeModCheck($post);
			if($obj instanceof ShemeCheck_Class){
				return $obj->postCheck();
			}else{
				return false;	
			}
			break;
		}
	}
}

//抽象类
abstract class ShemeCheck_Class{
	public $post;
	public $user_id;

	abstract public function postCheck();
	public function __construct($post){
		$this->CI = &get_instance();
		$this->CI->load->model('t_project_scheme_model');
		$this->post= $post;
		$this->user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
	}
}

/**
 *description:检测修改装修案例提交数据
 *author:yanyalong
 *date:2013/12/16
 */
class ShemeModCheck extends ShemeCheck_Class{
	//检测装修案例提交数据
	public function postCheck(){
		$scheme_name=  $this->post['scheme_name'];
		$scheme_cost=  $this->post['scheme_cost'];
		$scheme_thinking= $this->post['scheme_thinking'];
		$project_id = $this->post['pid'];
		//检测案例id
		//检测装修案例名称开始
		if(trim($scheme_name)==""){
			echojson(1,'','案例的名称的名称不能为空');
		}
		if((strlen(trim($scheme_name)) + mb_strlen(trim($scheme_name),'UTF8'))/2>50){
			echojson(1,"","方案名称不能超过25个字");
		}
		$is_exist = $this->CI->t_project_scheme_model->is_has($scheme_name,$this->user_id,$project_id);
		if($is_exist!=false){
			echojson(1,'','您已经创建过了相同名称的方案');
		}
		//检测装修案例名称开始
		//检测案例造价开始
		if(floatval(trim($scheme_cost))>100000||floatval(trim($scheme_cost))<0){
			echojson(1,'','方案造价必须在0-100000万元之间');
		}
		//检测案例造价结束
		//检测装修需求开始
		if(trim($scheme_thinking)==""){
			echojson(1,'','请输入设计思路');
		}
		if((strlen(trim($scheme_thinking)) + mb_strlen(trim($scheme_thinking),'UTF8'))/2>400){
			echojson(1,"","设计思路字数不能超过200字");
		}
		//检测装修需求结束
	}
}

