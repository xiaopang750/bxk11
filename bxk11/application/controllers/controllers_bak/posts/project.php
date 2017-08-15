<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends User_Controller {
	function __construct(){
		parent::__construct();
		//$this->ajax_checklogin();
	}
	/**
	 *description:创建装修项目提交
	 *author:yanyalong
	 *date:2013/12/15
	 */
	public function addproject(){
		safeFilter();
		loadLib("Project_Class");
		ProjectCheckFactory::createObj($_POST,'add');	
		$_POST = disableCheck();
		$project_name= $this->input->post('project_name');
		$project_budget= $this->input->post('project_budget');
		$project_owner= $this->input->post('project_owner');
		$project_demand= $this->input->post('project_demand');
		$project_status= $this->input->post('project_status');
		$house_id= $this->input->post('house_id');
		$house_name= $this->input->post('house_name');
		$house_city= $this->input->post('house_city');
		$apartment_id= $this->input->post('apartment_id');
		$apartment_category_id= $this->input->post('apartment_category_id');
		$apartment_floor_pic= $this->input->post('apartment_floor_pic');
		$apartment_size= $this->input->post('apartment_size');
		$apartment_floor_pic=basename($apartment_floor_pic);
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		//获取省份id信息
		$city= model("t_system_district")->getcityinfo($house_city);
		if($city==false){
			echojson(1,'','操作异常');
		}
		$province = model("t_system_district")->getcityinfo($city->district_pcode);
		if($province==false){
			echojson(1,'','操作异常');
		}
		if($house_id=="0"){
			$this->load->model('t_house_model');
			$this->t_house_model->house_name= $house_name;
			$this->t_house_model->user_id= $user_id;
			$this->t_house_model->house_province= $province->district_code;
			$this->t_house_model->house_city= $house_city;
			$this->t_house_model->house_type= 2;
			$house_id= $this->t_house_model->insert();	
		}
		//若是新建楼盘
		$category = model("t_tag")->get($apartment_category_id);
		if($category==false){
			echojson(1,'','操作异常');
		}
		//若户型id为空则插入户型
		if($apartment_id==""){
			//获取省份id信息
			$this->load->model('t_house_apartment_model');
			$this->t_house_apartment_model->house_id= $house_id;
			$this->t_house_apartment_model->apartment_size= $apartment_size;
			$this->t_house_apartment_model->apartment_type= 2;
			$this->t_house_apartment_model->user_id= $user_id;
			$this->t_house_apartment_model->apartment_floor_pic1= $apartment_floor_pic;
			$this->t_house_apartment_model->apartment_status=1;
			$this->t_house_apartment_model->apartment_category_id=$apartment_category_id;
			$this->t_house_apartment_model->apartment_category = $category->tag_name;
			$apartment_id= $this->t_house_apartment_model->insert();	
			//裁切户型图
			$apartmentdir= apartmentdir($apartment_id);
			$this->load->library('image_lib');	
			$this->image_lib->apartment_thumb($apartmentdir.$apartment_floor_pic,$apartment_id);			
		}
		//插入装修项目数据
		//生成项目名称
		$this->load->model('t_project_model');
		$project_name = $province->district_name.$city->district_name.$category->tag_name.$apartment_size.$project_owner;
		$this->t_project_model->apartment_id= $apartment_id;
		$this->t_project_model->house_id= $house_id;
		$this->t_project_model->project_name=$project_name;
		$this->t_project_model->user_id= $user_id;
		$this->t_project_model->project_user_type= 1;
		$this->t_project_model->project_budget=$project_budget;
		$this->t_project_model->project_demand=$project_demand;
		$this->t_project_model->project_owner=$project_owner;
		$this->t_project_model->project_status=$project_status;
		$project_id = $this->t_project_model->insert();	
		if($project_id!=false){
			$this->config->load('url');
			$urlconfig = $this->config->item('url');
			$projecturl = $urlconfig['addscheme'].$project_id;
			$data['url'] = $projecturl;
			echojson(0,$data);
		}else{
			echojson(1,'','创建失败');
		}
	}
}

