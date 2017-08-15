<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class ProjectCheckFactory{
	public static function createObj($post,$postType='add'){
		switch ($postType){
		case 'add':
			$obj = new ProjectAddCheck($post);
			if($obj instanceof ProjectCheck_Class){
				return $obj->postCheck();
			}else{
				return false;	
			}
			break;
		}
	}
}

//抽象类
abstract class ProjectCheck_Class{
	public $post;
	public $user_id;

	abstract public function postCheck();
	public function __construct($post){
		$this->CI = &get_instance();
		$this->CI->load->model('t_project_model');
		$this->CI->load->model('t_house_model');
		$this->post= $post;
		$this->user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
	}
}

/**
 *description:检测创建项目提交数据
 *author:yanyalong
 *date:2013/12/16
 */
class ProjectAddCheck extends ProjectCheck_Class{
	//检测创建项目提交数据
	public function postCheck(){
		//$project_name =  $this->post['project_name'];
		$project_budget=  $this->post['project_budget'];
		$project_owner=  $this->post['project_owner'];
		$project_demand=  $this->post['project_demand'];
		$project_status= $this->post['project_status'];
		$house_id=$this->post['house_id'];
		$house_name=$this->post['house_name'];
		$house_city=$this->post['house_city'];
		$apartment_id=$this->post['apartment_id'];
		$apartment_category_id=$this->post['apartment_category_id'];
		$apartment_floor_pic=$this->post['apartment_floor_pic'];
		$apartment_size=$this->post['apartment_size'];
		////检测项目名称开始
		//if(trim($project_name)==""){
			//echojson(1,'','项目的名称不能为空');
		//}
		//if((strlen(trim($project_name)) + mb_strlen(trim($project_name),'UTF8'))/2>40){
			//echojson(1,"","标题不能超过20个字");
		//}
		//$is_exist = $this->CI->t_project_model->is_has($project_name,$this->user_id);
		//if($is_exist!=false){
			//echojson(1,'','您已经创建过了相同名称的项目');
		//}
		//检测项目名称结束
		//检测项目城市开始
		if(intval(trim($house_city))==""){
			echojson(1,'','请选择项目城市');
		}
		//检测项目城市结束
		//检测楼盘名称和楼盘id开始
		if(intval(trim($house_id))==0&&trim($house_name)==""){
			echojson(1,'','请选择楼盘名称或新建楼盘');
		}
		if(intval(trim($house_id))!=0&&trim($house_name)!=""){
			echojson(1,'','异常操作');
		}
		if((strlen(trim($house_name)) + mb_strlen(trim($house_name),'UTF8'))/2>20){
			echojson(1,"","楼盘名称不能超过20个字");
		}
		$is_exist = $this->CI->t_house_model->is_has($house_name,$this->user_id,$house_city);
		if($is_exist!=false){
			echojson(1,'','系统已存在该楼盘或您已经创建过了相同名称的楼盘');
		}
		//检测楼盘名称和楼盘id结束
		//检测项目户型类型开始
		if(intval(trim($apartment_category_id))==0){
			echojson(1,'','请选择户型类型');
		}
		//检测项目户型类型结束
		//检测项目户型图开始
		if(intval(trim($apartment_id))==0&&trim($apartment_floor_pic)==""){
			echojson(1,'','请选择户型图或上传新的户型图');
		}
		if(intval(trim($apartment_id))!=0&&trim($apartment_floor_pic)!=""){
			echojson(1,'','异常操作');
		}
		//检测项目户型图结束
		//检测项目户型面积开始
		if(floatval(trim($apartment_size))==0){
			echojson(1,'','请输入户型面积');
		}
		if(floatval(trim($apartment_size))>5000){
			echojson(1,'','户型面积不能超过5000平方米');
		}
		//检测项目户型面积结束
		//检测项目装修预算开始
		if(floatval(trim($project_budget))==0){
			echojson(1,'','请输入装修预算');
		}
		//检测项目装修预算结束
		//检测项目客户称谓开始
		if(trim($project_owner)==""){
			echojson(1,'','请输入客户称谓');
		}
		if((strlen(trim($project_owner)) + mb_strlen(trim($project_owner),'UTF8'))/2>10){
			echojson(1,"","客户称谓太长");
		}
		//检测项目客户称谓结束
		//检测项目装修需求开始
		if(trim($project_demand)==""){
			echojson(1,'','请输入装修需求');
		}
		if((strlen(trim($project_demand)) + mb_strlen(trim($project_demand),'UTF8'))/2>400){
			echojson(1,"","装修需求太长");
		}
		//检测项目装修需求结束
	}
}

