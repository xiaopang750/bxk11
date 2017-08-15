<?php
/**
 *description:装修项目
 *author:yanyalong
 *date:2013/12/16
 */
class Project extends User_Controller {

	function __construct(){
		parent::__construct();
	}

	/**
	 *description:获取装修项目列表
	 *author:yanyalong
	 *date:2013/12/11
	 */
	public function getlist(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(1,"","无相关数据");
		}
		$list = model("t_project")->projectlist($user_id);		
		if($list==false){
			echojson(1,"","无相关数据");
		}
		$project = array();
		$this->config->load('url');
		$urlconfig = $this->config->item('url');
		foreach($list as $key=>$val){
			$project[$key]['project_id'] = $val->project_id;
			$project[$key]['project_name'] = $val->project_name;
			$project[$key]['url'] = $urlconfig['addscheme'].$val->project_id;
		}
		echojson(0,$project);
	}

	/**
	 *description:获取省份城市信息
	 *author:yanyalong
	 *date:2013/12/11
	 */
	public function getarea(){
		safeFilter();
		//所在地区开始
		$house_id= isset($_POST['house_id'])?$this->input->post('house_id',true):'';
		//$house_id = 1;
		$this->load->model("t_system_district_model");
		if($house_id!=""){
			$houseinfo = model("t_house")->get($house_id);	
			if($houseinfo==false){
				echojson(1,"","非法操作");
			}else{
				$province_select = $houseinfo->house_province;	
				$this->t_system_district_model->district_pcode = "0";
				$district_province= $this->t_system_district_model->getDepthByPcode();
				foreach ($district_province as $key=>$val) {
					if(in_array($province_select,$val)){
						$district_province[$key]['select'] = "1";	
					}
					continue;
				}
				$city_select = $houseinfo->house_city;	
				$this->t_system_district_model->district_pcode = $province_select;
				$district_city= $this->t_system_district_model->getDepthByPcode();
				foreach ($district_city as $key=>$val) {
					if(in_array($province_select,$val)){
						$district_city[$key]['select'] = "1";	
					}
					continue;
				}
			}
		}else{
			$this->t_system_district_model->district_pcode = "0";
			$district_province= $this->t_system_district_model->getDepthByPcode();
			$province_select=$district_province[0]['district_code'];
			$this->t_system_district_model->district_pcode=$province_select;
			$district_city= $this->t_system_district_model->getDepthByPcode();
			$city_select =$district_city[0]['district_code'];
		}
		foreach ($district_province as $key=>$val) {
			if(in_array($province_select,$val)){
				$district_province[$key]['select'] = "1";	
			}
			continue;
		}
		foreach ($district_city as $key=>$val) {
			if(in_array($city_select,$val)){
				$district_city[$key]['select'] = "1";	
			}
			continue;
		}
		$area['province'] = $district_province;
		$area['city'] = $district_city;
		echojson(0,$area);
	}
}


