<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/16 16:10:17 
 *       liuguangpingAuthor: liuguangping
 *        Email: liuguangpingtest@163.com

 */
class Area extends Admin_Controller
{	
	public $content;
	public $navpage;
	public $t_system_district;

	public function __construct(){
		parent::__construct();
		$this->content = 'index';
		$this->navpage = 'nav';
		$this->load->model('t_system_district_model');
		$this->t_system_district = $this->t_system_district_model;
		$this->load->helper('import_excel');


	}
	public function index(){
		$data['title']='家178-管理中心-系统推荐';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'area/index';
		$this->navpage = $this->navpage;
		$result = array();
		$province = $this->input->post('province');
		//echo $province;die;
		$city = $this->input->post('city');
		$district = $this->input->post('district');
		$this->t_system_district->district_pcode = '0';
		$result['provincere'] = $this->t_system_district->getbypid();
		if($province == ''){
			$this->t_system_district->district_pcode = 0;
		
		}elseif($province && !$city){
			$this->t_system_district->district_pcode = $province;
			$result['cityre'] = $this->t_system_district->getbypid();
			$this->t_system_district->district_pcode = $province;
		
		}elseif($city && !$district){
			
			$this->t_system_district->district_pcode = $province;
			$result['cityre'] = $this->t_system_district->getbypid();
			$this->t_system_district->district_pcode = $city;
			$result['disre'] = $this->t_system_district->getbypid();
			
			$this->t_system_district->district_pcode = $city;
			
		}else{
			
			$this->t_system_district->district_pcode = $province;
			$result['cityre'] = $this->t_system_district->getbypid();
			
			$this->t_system_district->district_pcode = $city;
			$result['disre'] = $this->t_system_district->getbypid();
			
			$this->t_system_district->district_pcode = $district;
		}
		$result['re'] = $this->t_system_district->getbypid();

		$result['pxid'] = $province;
		$result['cid'] = $city;
		$result['did'] = $district;
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function doeditdistrict_name(){
		
		$district_name = $this->input->post('district_name');
		$district_id = $this->input->post('district_id');
		$row = $this->t_system_district->get($district_id);
		$this->t_system_district->district_pcode = $row->district_pcode;
		$result = $this->t_system_district->getbypid();
		
		if($result){
			$name = twotoone_array($result,"district_name");
			if(in_array($district_name, $name)){
				echo echojson(0, '','添加失败,该名在该区域下己有,不能重复');
			}else{
				$where = array('district_id'=>$district_id);
				$data = array('district_name'=>$district_name);
				if($this->t_system_district->updates_global($data,$where)){
					echo echojson(1, '','修改成功！');
				}else{
					echo echojson(0, '','修改失败！');
				}
			}
		}else{
				$where = array('district_id'=>$district_id);
				$data = array('district_name'=>$district_name);
				if($this->t_system_district->updates_global($data,$where)){
					echo echojson(1, '','修改成功！');
				}else{
					echo echojson(0, '','修改失败！');
				}
		}
		
	}
	
	public function doareaadd(){
		$district_name = $this->input->post('district_name');
		$district_pcode = $this->input->post('district_pcode');
		$district_code = $this->input->post('district_code');
		
		$this->t_system_district->district_pcode = $district_pcode;
		$result = $this->t_system_district->getbypid();
		
		if($result){
			$name = twotoone_array($result,"district_name");
			if(in_array($district_name, $name)){
				echo echojson(0, '','添加失败,该名在该区域下己有,不能重复');
			}else{
				$where = array('district_code'=>$district_code);
				$data = $this->t_system_district->get_data($where);

				$code = twotoone_array($data,"district_code");
				if(in_array($district_code, $code)){
					echo echojson(0, '','该邮编己存在,不能重复');
				}else{
					$where = array('district_code'=>$district_pcode);
					$data = $this->t_system_district->get_data($where);
			
					$this->t_system_district->district_name = $district_name;
					$this->t_system_district->district_pcode = $district_pcode;
					$this->t_system_district->district_code = $district_code;
					if($district_pcode == 0){
						$data[0]['district_depth'] = '-1';
					}
					$this->t_system_district->district_depth = $data[0]['district_depth']+1;
					if($ids = $this->t_system_district->insert()){
						echojson(1, $ids,'添加成功！');
					}else{
						echojson(0, '','添加失败！');
					}
				}
			}
		}else{
			$where = array('district_code'=>$district_pcode);
			$data = $this->t_system_district->get_data($where);
			$this->t_system_district->district_name = $district_name;
			$this->t_system_district->district_pcode = $district_pcode;
			$this->t_system_district->district_code = $district_code;
			if($district_pcode == 0){
				$data[0]['district_depth'] = '-1';
			}
			$this->t_system_district->district_depth = $data[0]['district_depth']+1;
			if($ids = $this->t_system_district->insert()){
				echojson(1, $ids,'添加成功！');
			}else{
				echojson(0, '','添加失败！');
			}
		}
		
	}
	

	
	public function dodel(){
		$ids = $this->input->post('ids');
		$idarr = explode(',',$ids);
		$temarr = array();
		$ids = array();
		foreach($idarr as $val){
			$ids[] = $val;
			$row = $this->t_system_district->get($val);
			$this->t_system_district->district_pcode = $row->district_code;
			$result = $this->t_system_district->getbypid();
			if($result){
				$idss = twotoone_array($result,"district_id");
				foreach ($idss as $valsz){
					$ids[] = $valsz;
					$row = $this->t_system_district->get($valsz);
					$this->t_system_district->district_pcode = $row->district_code;
					$result = $this->t_system_district->getbypid();
					if($result){
						$idsz = twotoone_array($result,"district_id");
						foreach ($idsz as $a){
							$ids[] = $a;
						}
					}
				
				}
			}
			
	
			foreach ($ids as $vl){
				if($this->t_system_district->delete($vl)){
					$temarr[] = $val;
				}
			}
			
		}
		if($temarr){
			echo json_encode($temarr);
		}else{
			echo "0";
		}
	}
	

}

