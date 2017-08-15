<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        liuguangpingAuthor: 服务商管理
 *        Email: liuguangpingtest@163.com

 */
class Member extends Admin_Controller
{	
	public $member;
	public $navpage;
	public $t_system_district;
	public $t_service_info;
	public $limit;
	public $libs;

	public $t_service_user;
	//public $t_service_module;
	public $t_service_action;
	public $t_service_brands_apply;
	public $t_service_join;
	public $t_product_brands;
	public $t_product_class_brands;
	public $t_service_shop;
	public $t_certified_brand;
	public $pay_vas;
	public $vas_list;
	public function __construct(){
		parent::__construct();
		$this->member = 'member';
		$this->navpage = 'member/nav';
		$this->load->model('t_system_district_model');
		$this->t_system_district = $this->t_system_district_model;
		$this->load->model('t_service_user_model');
		$this->t_service_user = $this->t_service_user_model;
		$this->load->model('t_product_brands_model');
		$this->t_product_brands = $this->t_product_brands_model;
		$this->load->model('t_product_class_brands_model');
		$this->t_product_class_brands = $this->t_product_class_brands_model;
		$this->load->model('t_service_shop_model');
		$this->t_service_shop = $this->t_service_shop_model;
		$this->load->model('t_service_info_model');
		$this->t_service_info = $this->t_service_info_model;
		$this->load->model('t_certified_brand_model');
		$this->t_certified_brand = $this->t_certified_brand_model;

	
		$this->load->model('t_service_brands_apply_model');
		$this->t_service_brands_apply = $this->t_service_brands_apply_model;

		/*$this->load->model('t_service_module_model');
		$this->t_service_module = $this->t_service_module_model;*/
		
		$this->load->model('t_service_module_action_model');
		$this->t_service_action = $this->t_service_module_action_model;

		/*//$this->load->model('t_service_join_model');
		//$this->t_service_join = $this->t_service_join_model;

		$this->load->model('t_aleady_pay_vas_model');
		$this->pay_vas = $this->t_aleady_pay_vas_model;*/

		/*$this->load->model('t_vas_list_model');
		$this->vas_list = $this->t_vas_list_model;*/

		$this->load->helper('import_excel');
		$this->load->helper('content_fun');
		
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->limit = 10;
		$this->load->helper('url');

	}

	
	public function index()
	{   

		$data['title']='家178-管理中心-服务商';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'member/index';
		$this->navpage = $this->navpage;
		$result = array();
		$key_word = $this->input->get('key_word');
		$service_status = $this->input->get('service_status');
		$province = $this->input->get('province');

		$city = $this->input->get('city');
		$district = $this->input->get('district');
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
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$total_rows = count($this->t_service_info->admin_search_count($province,$city,$district,$service_status,$key_word));
		$office =  ($page-1)*($this->limit);
		$result['re'] = $this->t_service_info->admin_search($province,$city,$district,$service_status,$key_word,$office,$this->limit);
		$this->libs->base_url = site_url('admin/member/index').'?search=0&province='.$province."&city=".$city."&district=".$district."&service_status=".$service_status."&key_word=".$key_word;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		
		$result['pxid'] = $province;
		$result['cid'] = $city;
		$result['did'] = $district;
		$result['service_status'] = $service_status;
		$result['key_word'] = $key_word;
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function add()
	{

		$data['title'] = '家178-服务管理添加';
		$data['menu'] = $this->member;
		$this->data = $data;
		$this->page = 'member/add';
		$join_id = $this->input->get('join_id');
		//向导设置参数
		$result['tags'] = $this->input->get('tags',true);
		$result['service_name'] = 'admin';
		$result['service_ename'] = '';
		if(isset($join_id) && is_numeric($join_id) && $join_id){
			//加盟商审核步骤
			$joinR = $this->t_service_join->get($join_id);
			if(isset($result['tags']) && $result['tags'] == 1){
				$service_infoR = $this->t_service_info->get($joinR->service_id);
				if($service_infoR->service_status == 21){
					$wheres['service_id'] = $joinR->service_id; 
					$userR = $this->t_service_user->get_tag('service_id,service_user_name',$wheres);
					$result['service_name'] = $userR[0]['service_user_name'];
					//$result['service_ename'] = md5($join_id."jia178");
				}else{
					$result['service_name'] = $service_infoR->service_name;
					//$result['service_ename'] = $service_infoR->service_ename;
				}
				
			}
			$result['re'] = $joinR;
			if(is_numeric($joinR->join_province_code) && $joinR->join_province_code){
				$province = $joinR->join_province_code;
			}else{
				$province = "";
			}

			if(is_numeric($joinR->join_city_code) && $joinR->join_city_code){
				$city = $joinR->join_city_code;
			}else{
				$city = "";
			}
			$district = "";
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
			$result['pxid'] = $province;
			$result['cid'] = $city;
			$result['did'] = $district;
			$result['join_id'] = $join_id;
		}else{
			$this->t_system_district->district_pcode = '0';
			$result['provincere'] = $this->t_system_district->getbypid();
		}

		$this->navpage = $this->navpage;
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function doadd(){

		//向导设置
		$tags = $this->input->post('tags',true);
		$servicename = $this->input->post('service_name',true);
		$service_ename = $this->input->post('service_ename',true);
		$service_company = $this->input->post('service_company',true);
		$join_id = $this->input->post('join_id',true);
		$service_license_bak = $this->input->post('service_license_bak',true);
		//$is_user = $this->users->is_user($servicename);
		//$is_service_ename = $this->t_service_info->get_tag('service_id,service_name',array('service_ename'=>$service_ename));
		$is_service_company = $this->t_service_info->get_tag('service_id,service_name',array('service_company'=>$service_company));
		$is_service_name = $this->t_service_info->get_tag('service_id,service_name',array('service_name'=>$servicename,'service_ename'=>$service_ename));
		
		if($servicename == ''  || $is_service_name || $service_company == '' || $is_service_company){
			
			if( $servicename == '' || $is_service_name ){
				$message = "登录名不能为空或重复";
			}

			if( $service_company == '' || $is_service_company ){
				$message = "公司不能为空或重复";
			}
			//未加盟的用户申请经销商
			if(isset($tags) && $tags == 1){
				$url = site_url('admin/member/add')."?join_id=".$join_id."&tags=".$tags;
				
			}else{
				$url = site_url('admin/member/add')."?join_id=".$join_id;
			}
			
			jumpAjax( $message,$url);
		}

		$this->load->library('upload');
		if( isset($join_id) && $join_id){
			//复制申请的图片
			$this->config->load('uploads');
			$config = $this->config->item("service_license");
			$time = date("Y/m/");
			$destPath = $config['upload_path'];
			$relative_path = $config['relative_path'];
			//第一步选择用户是否替换的第二选择申请的图片
			if($service_licenseUrl = $this->upload->upService("service_license")){
				$service_licenseUrl = $service_licenseUrl;
			}else{
				if(isset($service_license_bak) && $service_license_bak){
					
					$soucrPath = $_SERVER['DOCUMENT_ROOT'].$service_license_bak;
					if($this->upload->moveFile($soucrPath,$destPath.$time)){

						$service_licenseUrl = $relative_path."source/".$time.basename($soucrPath);
					}
				}
				
			}
			
		}else{
			$service_licenseUrl = $this->upload->upService("service_license");
		}
	
		if(isset($service_licenseUrl) && $service_licenseUrl){
			$this->t_service_info->service_license = $service_licenseUrl;
		}else{

			//未加盟的用户申请经销商
			if(isset($tags) && $tags == 1){
				$url = site_url('admin/member/add')."?join_id=".$join_id."&tags=".$tags;
			}else{
				$url = site_url('admin/member/add')."?join_id=".$join_id;
			}
			
			jumpAjax('营业执照图片 上失败！',$url);
		}

		$service_doc1 = $this->upload->upService("service_doc1");
		$service_doc2 = $this->upload->upService("service_doc2");
		$this->t_service_info->service_doc1 = $service_doc1;
		$this->t_service_info->service_doc2 = $service_doc2;
		
		$this->t_service_info->service_name =  $servicename;

		$this->t_service_info->service_ename =  $service_ename;
		$this->t_service_info->service_company = $service_company;

		$this->t_service_info->service_phone = $this->input->post('service_phone',true);
		$this->t_service_info->service_person = $this->input->post('service_person',true);
		$this->t_service_info->service_person_phone = $this->input->post('service_person_phone',true);
		$this->t_service_info->service_province_code = $this->input->post('province',true);
		$this->t_service_info->service_city_code =  $this->input->post('city',true);
		
		$this->t_service_info->service_address = $this->input->post('service_address',true);
		$this->t_service_info->service_class = $this->input->post('service_class',true);

		$this->t_service_info->service_products = 0;
		$this->t_service_info->service_deposit = $this->input->post('service_deposit',true);
		$this->t_service_info->service_website = $this->input->post('service_website',true);
		$this->t_service_info->service_balance = 0;
		$this->t_service_info->service_recharge = 0;
		$this->t_service_info->service_freeze_amount = 0;
		$this->t_service_info->service_cpa = $this->input->post('service_cpa',true);
		$this->t_service_info->service_cps = $this->input->post('service_cps',true);

		$this->t_service_info->service_status = 11;

		
		$this->t_service_info->service_vipstart = $this->input->post('service_vipstart',true);
		$this->t_service_info->service_vipend = $this->input->post('service_vipend',true);
		$this->t_service_info->service_vipfirst = date("Y-m-d H:i:s",time());
		
		if(isset($tags) && $tags == 1){
			$data['service_license'] = $this->t_service_info->service_license;
			$data['service_doc1'] = $this->t_service_info->service_doc1;
			$data['service_doc2'] = $this->t_service_info->service_doc2;
			$data['service_name'] = $this->t_service_info->service_name;
			$data['service_ename'] = $this->t_service_info->service_ename;


			$data['service_company'] = $this->t_service_info->service_company;
			$data['service_phone'] = $this->t_service_info->service_phone;
			$data['service_person'] = $this->t_service_info->service_person;
			$data['service_person_phone'] = $this->t_service_info->service_person_phone;
			$data['service_province_code'] = $this->t_service_info->service_province_code;

			$data['service_city_code'] = $this->t_service_info->service_city_code;
			$data['service_address'] = $this->t_service_info->service_address;
			$data['service_class'] = $this->t_service_info->service_class;
			$data['service_deposit'] = $this->t_service_info->service_deposit;
			$data['service_website'] = $this->t_service_info->service_website;

			$data['service_cpa'] = $this->t_service_info->service_cpa;
			$data['service_cps'] = $this->t_service_info->service_cps;
			$data['service_freeze_amount'] = $this->t_service_info->service_freeze_amount;
			$data['service_recharge'] = $this->t_service_info->service_recharge;
			$data['service_balance'] = $this->t_service_info->service_balance;
			$data['service_products'] = $this->t_service_info->service_products;
			$data['service_vipstart'] = $this->t_service_info->service_vipstart;
			$data['service_vipend'] = $this->t_service_info->service_vipend;
			$data['service_vipfirst'] = $this->t_service_info->service_vipfirst;
			$mapW['service_id'] = $this->t_service_join->get($join_id)->service_id;
			if($this->t_service_info->updates_global($data,$mapW)){
		
				$urlPath = site_url('admin/member/doAuditing')."?service_id=".$mapW['service_id'];
				jumpAjax('操作成功！',$urlPath);
			}else{
				$url = site_url('admin/member/add')."?join_id=".$join_id."&tags=".$tags;
				jumpAjax('操作失败！',$url);
			}
		}else{
			if($service_id =$this->t_service_info->insert()){
		
				$map['service_code'] = md5(md5($service_id).time());

				if($this->t_service_info->updates_global($map,array('service_id'=>$service_id))){
					$this->t_service_user->service_id = $service_id;
					$this->t_service_user->service_user_name = $this->t_service_info->service_name;
					$paw = "123456";
					$this->t_service_user->service_user_password = md5($paw);

					$this->t_service_user->service_user_actions = $this->roleResulte();
					$this->t_service_user->service_user_realname = '';
					$this->t_service_user->service_user_phone = $this->t_service_info->service_person_phone;
					$this->t_service_user->service_user_photo = '';
					$this->t_service_user->service_user_shop = '';
					$this->t_service_user->service_user_addtime = date("Y-m-d H:i:s",time());
					$this->t_service_user->insert();
					//修改加盟商状态
					$data['join_status'] = 4;
					$where['join_id'] = $join_id;
					$this->t_service_join->updates_global($data,$where);

				}
				$url = site_url("admin/product/brands_add")."?service_id=".$service_id;
				jumpAjax('操作成功！',$url);
			
			}else{
				$url = site_url('admin/member/add')."?join_id=".$join_id;
				jumpAjax('操作失败！',$url);
			}
		}
	}

    //最高权限
	public function roleResulte(){
		$resultArr = array();
		$module = $this->t_service_module->get_all();
		$field = 'module_key,action_key';
		foreach ($module as $key => $value) {
			$where['module_key'] = $value->module_key;
			$action_info = $this->t_service_action->get_tag($field,$where);
			foreach ($action_info as $kesy => $val) {
	
				$resultArr[] = "'".$val['action_key']."'";
			}
			
		}

		if($resultArr){
			return $resultS = implode(',', $resultArr);
		
		}else{
			return '';
		}
	}
	//验证用户是不是唯一
	public function dois_user(){
		$user_name = $this->input->post('service_name',true);
		$set = $this->input->post('set',true);
		$service_ename = $this->input->post('service_ename',true);
		$is_service_name = $this->t_service_info->get_tag('service_id,service_name,service_ename',array('service_name'=>$user_name,'service_ename'=>$service_ename));

		if($is_service_name){
			if(!empty($set)){
				$is_service = twotoone_array($is_service_name, 'service_id');
				foreach($is_service as $va){
					if($set != $va){
						echo 1;exit;
					}
				}
				/*
				foreach($is_user as $vas){
					if($vas->service_id != $set){
						echo 1;exit;
					}
				}*/
				echo 0;
			}else{
				echo 1;exit;
			}
			
		}else{
			echo 0;exit;
		}
	}
	
	//验证公司唯一
	public function doIsCompany(){
		$user_name = $this->input->post('service_name',true);
		$set = $this->input->post('set',true);
		$is_service_name = $this->t_service_info->get_tag('service_id,service_ename,service_name',array('service_company'=>$user_name));
		if($is_service_name){
			if(!empty($set)){
				$is_service = twotoone_array($is_service_name, 'service_id');
				foreach($is_service as $va){
					if($set != $va){
						echo 1;exit;
					}
				}
				echo 0;
			}else{
				echo 1;exit;
			}
			
		}else{
			echo 0;exit;
		}
	}

	//验证会员名唯一
	public function doService_ename(){
		$user_name = $this->input->post('service_ename',true);
		$set = $this->input->post('set',true);
		$is_service_name = $this->t_service_info->get_tag('service_id,service_ename,service_name',array('service_ename'=>$user_name));
		if($is_service_name){
			if(!empty($set)){
				$is_service = twotoone_array($is_service_name, 'service_id');
				foreach($is_service as $va){
					if($set != $va){
						echo 1;exit;
					}
				}
				echo 0;
			}else{
				echo 1;exit;
			}
			
		}else{
			echo 0;exit;
		}
	}
	

	//验证登录名唯一
	public function doService_name(){
		$user_name = $this->input->post('service_name',true);
		$set = $this->input->post('set',true);
		$is_service_name = $this->t_service_info->get_tag('service_id,service_ename,service_name',array('service_name'=>$user_name));
		if($is_service_name){
			if(!empty($set)){
				$is_service = twotoone_array($is_service_name, 'service_id');
				foreach($is_service as $va){
					if($set != $va){
						echo 1;exit;
					}
				}
				echo 0;
			}else{
				echo 1;exit;
			}
			
		}else{
			echo 0;exit;
		}
	}

	public function dostatus(){
		$status  = $this->input->post('status');
		$service_id  = $this->input->post('question_id');
		$data = array('service_status'=>$status);
		$where = array('service_id'=>$service_id);
		if($this->t_service_info->updates_global($data,$where)){
			echo 1;
		}else{
			echo 0;
		}

	}
	
	public function edit(){

		$data['title'] = '家178-服务编辑';
		$data['menu'] = $this->member;
		$this->data = $data;
		$this->page = 'member/edit';
		
		$service_id = $this->input->get('service_id',true);
		$service = $this->t_service_info->get($service_id);
		$result['result'] = $service;
		
		$province = $service->service_province_code;
		
		$city = $service->service_city_code;
		$district = '';
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

		$t_service_type = model('t_service_type');
		$result['service_type'] = $t_service_type->get_all();

		$t_service_level_role = model('t_service_level_role');
		$where['service_type_id'] = $service->service_type_id;
		$filed = 'la_rank,la_name';
		$result['role'] = $t_service_level_role->getArray($filed,$where);	

		$result['pxid'] = $province;
		$result['cid'] = $city;
		$result['did'] = $district;
		$this->navpage = $this->navpage;
		$this->pagedata = $result;

		parent::_initpage();
	}	
	
	public function doedit(){
		$serviceid = $this->input->post('service_id',true);
		$servicename = $this->input->post('service_name',true);
		$is_service_name = $this->t_service_info->get_tag('service_id,service_name',array('service_name'=>$servicename));
		//$is_user = $this->users->is_user($servicename);
		if($is_service_name){
			$is_service = twotoone_array($is_service_name, 'service_id');
			foreach($is_service as $va){
				if($serviceid != $va){
					echo "<script type='text/javascript'>alert('登录名不能为空或重复！');window.location.href='".site_url('admin/member/edit')."?service_id=".$serviceid."'</script>";exit;
				}
			}
		}
		$this->load->library('upload');
		$service_licenseUrl = $this->upload->upService("service_license");
		if($service_licenseUrl){
			$this->t_service_info->service_license = $service_licenseUrl;
		}else{
			$this->t_service_info->service_license =  $this->input->post('service_license_bak',true);
		}
		$service_doc1 = $this->upload->upService("service_doc1");
		$service_doc2 = $this->upload->upService("service_doc2");
		if($service_doc1){
			$this->t_service_info->service_doc1 = $service_doc1;
		}else{
			$this->t_service_info->service_doc1  =  $this->input->post('service_doc1_bak',true);
		}
		if($service_doc2){
			$this->t_service_info->service_doc2 = $service_doc2;
		}else{
			$this->t_service_info->service_doc2  =  $this->input->post('service_doc2_bak',true);
		}
	
		$this->t_service_info->service_id = $this->input->post('service_id',true);
		$this->t_service_info->service_name =  $this->input->post('service_name',true);

		$this->t_service_info->service_company = $this->input->post('service_company',true);

		$this->t_service_info->service_phone = $this->input->post('service_phone',true);
		$this->t_service_info->service_person = $this->input->post('service_person',true);
		$this->t_service_info->service_person_phone = $this->input->post('service_person_phone',true);
		$this->t_service_info->service_province_code = $this->input->post('province',true);
		$this->t_service_info->service_city_code =  $this->input->post('city',true);
		
		$this->t_service_info->service_address = $this->input->post('service_address',true);
		$this->t_service_info->service_class = $this->input->post('service_class',true);
		//$this->t_service_info->service_model = $this->input->post('service_model',true);
		$this->t_service_info->service_products = 0;
		$this->t_service_info->service_deposit = $this->input->post('service_deposit',true);
		$this->t_service_info->service_website = $this->input->post('service_website',true);
		$this->t_service_info->service_balance = 0;
		$this->t_service_info->service_recharge = 0;
		$this->t_service_info->service_freeze_amount = 0;
		$this->t_service_info->service_cpa = $this->input->post('service_cpa',true);
		$this->t_service_info->service_cps = $this->input->post('service_cps',true);
		

		$this->t_service_info->service_status = $this->input->post('service_status',true);
		$this->t_service_info->service_vipstart = $this->input->post('service_vipstart',true);
		$this->t_service_info->service_vipend = $this->input->post('service_vipend',true);
	
		
		if($service_id =$this->t_service_info->update()){
			echo "<script type='text/javascript'>alert('修改成功！');window.location.href='".site_url('admin/member/index')."'</script>";exit;
	
		}else{
			echo "<script type='text/javascript'>alert('修改经销商失败！');window.location.href='".site_url('admin/member/edit')."?service_id=".$serviceid."'</script>";exit;
		}
	
	}	

	//TODO (流程改变，己废弃) 2014/05/05 liuguangping
	public function service_brands_apply(){

		$data['title'] = '家178-品牌认证';
		$data['menu'] = $this->member;
		$this->data = $data;
		$this->page = 'member/service_brands_apply';
		$this->navpage = $this->navpage;//左测菜单

		$serviceid = $this->input->get('service_id');
		$apply_status = $this->input->get('apply_status');
		$where['service_id'] = $serviceid;
		$field = "*";

		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$office =  ($page-1)*($this->limit);
		$brand_name = $this->input->get('brand_name');
		//echo $brand_name;die;
		$total_rows = count($this->t_service_brands_apply->admin_search_count($serviceid,$brand_name,$apply_status));
		//var_dump($total_rows);DIE;
		$result['apply_status'] = $apply_status;
		$result['service_id'] = $serviceid;
		$result['brand_name'] = $brand_name;
		if(isset($result['service_id']) && $result['service_id']){
			if($resultRe = $this->t_service_brands_apply->get_tag($field,$where)){
				$result['re'] = $this->t_service_brands_apply->admin_search($serviceid,$brand_name,$apply_status,$office,$this->limit);
			}else{
				jumpAjax('该经销商无品牌申请！',site_url('admin/member/index'));
			}
		}else{
			$result['re'] = $this->t_service_brands_apply->admin_search($serviceid,$brand_name,$apply_status,$office,$this->limit);

		}
		
		$this->libs->base_url = site_url('admin/member/service_brands_apply').'?search=0&service_id='.$serviceid.'&brand_name='.$brand_name."&apply_status=".$apply_status;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$this->pagedata = $result;//向页面加入加载数据
		parent::_initpage();//加载页面		
	}

	// 2014/05/05 liuguangping
	public function newService_brands_apply(){

		$data['title'] = '家178-品牌认证';
		$data['menu'] = $this->member;
		$this->data = $data;
		$this->page = 'member/newService_brands_apply';
		$this->navpage = $this->navpage;//左测菜单

		$serviceid = $this->input->get('service_id');
		$apply_status = $this->input->get('apply_status');
		$where['service_id'] = $serviceid;
		$field = "*";

		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$office =  ($page-1)*($this->limit);
		$brand_name = $this->input->get('brand_name');
		//echo $brand_name;die;
		$total_rows = count($this->t_service_brands_apply->admin_search_count($serviceid,$brand_name,$apply_status));
		//var_dump($total_rows);DIE;
		$result['apply_status'] = $apply_status;
		$result['service_id'] = $serviceid;
		$result['brand_name'] = $brand_name;
		if(isset($result['service_id']) && $result['service_id']){
			if($resultRe = $this->t_service_brands_apply->get_tag($field,$where)){
				$result['re'] = $this->t_service_brands_apply->admin_search($serviceid,$brand_name,$apply_status,$office,$this->limit);
			}else{
				jumpAjax('该经销商无品牌申请！',site_url('admin/member/index'));
			}
		}else{
			$result['re'] = $this->t_service_brands_apply->admin_search($serviceid,$brand_name,$apply_status,$office,$this->limit);

		}
		
		$this->libs->base_url = site_url('admin/member/service_brands_apply').'?search=0&service_id='.$serviceid.'&brand_name='.$brand_name."&apply_status=".$apply_status;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$this->pagedata = $result;//向页面加入加载数据
		parent::_initpage();//加载页面		
	}

	public function doCertifiedBrand(){
		$c_brand_id = $this->input->get('c_brand_id');
		$brand_id = $this->input->get('brand_id');
		$applyR = $this->t_service_brands_apply->get_tag('service_id',array('brand_id'=>$brand_id));
		$dataProduct['c_brand_id'] = $c_brand_id;
		$dataApply['apply_status'] = 1;
		$dataApply['apply_laudit_desc'] = "审核成功";
		$where['brand_id'] = $brand_id;
		$url = site_url('admin/member/newService_brands_apply')."?service_id=".$applyR[0]['service_id'];
		if($this->t_service_brands_apply->updates_global($dataApply,$where)){
			if($this->t_product_brands->updates_global($dataProduct,$where)){
				jumpAjax('操作成功！',$url);
			}else{
				jumpAjax('操作成功！',$url);
			}
		}else{
			jumpAjax('操作成功！',$url);
		}
	}

	//todo 流程己改(废弃)
	public function doapplystatus(){
		$data['apply_status']  = $this->input->post('status');
		$data['apply_id']  = $this->input->post('question_id');
		$data['apply_brand_name'] = $this->input->post('apply_name');
		$data['re'] = $this->t_service_brands_apply->get($data['apply_id']);
 		$this->load->view('admin/member/applyCallback',$data);
	}

	//todo 流程己改(废弃)
	//审核品牌
	public function doApplyCallback(){
		$url = site_url('admin/member/service_brands_apply');
		$status  = $this->input->post('apply_status');
		$content  = $this->input->post('content');
		$apply_id  = $this->input->post('apply_id');
		$apply_brand_name = $this->input->post('apply_brand_name');
		$data = array('apply_status'=>$status,'apply_laudit_desc'=>$content);
		$data['apply_license_begin'] = $this->input->post('apply_license_begin');
		$data['apply_license_end'] = $this->input->post('apply_license_end');
		$where = array('apply_id'=>$apply_id);
		$results = getBrandByName('t_product_brands_model',array('brand_name'=>$apply_brand_name),'brand_id');					
		if(!$results){
			if($status == 13){
				if($this->t_service_brands_apply->updates_global($data,$where)){
					jumpAjax('操作成功！',$url);
				}else{
					jumpAjax('操作失败！',$url);
				}	
			}else{
					jumpAjax('操作失败！',$url);
			}
			
		}else{
			$data['brand_id'] = $results;
		}
		if($results){
			$brandS = $this->t_product_brands->get($data['brand_id']);
			$filed='*';
			$map['brand_id'] = $results;
			$resultArr = $this->t_product_class_brands->get_class_brands_series($filed,$map);
			$s_classA = twotoone_array($resultArr,'s_class_id');
			$data['apply_brand_name'] = $brandS->brand_name;
			$data['apply_brand_ename'] = $brandS->brand_name;
			$data['apply_classid'] = implode('|', $s_classA);
			$this->config->load('uploads');
			$config = $this->config->item('brand');
			//只有通过后才能把系统的图片覆盖申请表中的图片
			if($status == '1'){
				$data['apply_brand_img'] = $config['relative_path'].'source'.$brandS->brand_img;
			}
		}
		if($this->t_service_brands_apply->updates_global($data,$where)){
			jumpAjax('操作成功！',$url);
		}else{
			jumpAjax('操作失败！',$url);
		}	
		
	}

	//todo 流程己改（新）
	public function donewapplystatus(){
		$data['apply_status']  = $this->input->post('status');
		$data['apply_id']  = $this->input->post('question_id');
		$data['apply_brand_name'] = $this->input->post('apply_name');
		$data['re'] = $this->t_service_brands_apply->get($data['apply_id']);
 		$this->load->view('admin/member/newApplyCallback',$data);
	}

	//todo 流程己改（新）
	//审核品牌
	public function doNewApplyCallback(){
		$url = site_url('admin/member/service_brands_apply');
		$status  = $this->input->post('apply_status');
		$content  = $this->input->post('content');
		$apply_id  = $this->input->post('apply_id');
		$apply_brand_name = $this->input->post('apply_brand_name');
		$data = array('apply_status'=>$status,'apply_laudit_desc'=>$content);
		$data['apply_license_begin'] = $this->input->post('apply_license_begin');
		$data['apply_license_end'] = $this->input->post('apply_license_end');
		$where = array('apply_id'=>$apply_id);
		$appR = $this->t_service_brands_apply->get($apply_id);
		$url = site_url('admin/member/newService_brands_apply')."?service_id=".$appR->service_id;
		if($this->t_service_brands_apply->updates_global($data,$where)){
			jumpAjax('操作成功！',$url);
		}else{
			jumpAjax('操作失败！',$url);
		}
		
		
	}

	//查看品牌
	public function readBrand(){
		$data['title']='家178-管理中心-服务商';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'member/readBrand';
		$this->navpage = $this->navpage;
		$result = array();
		$apply_id = $this->input->get('apply_id');
		$result = $this->t_service_brands_apply->get($apply_id);
		$data['result'] = $result;
		//$data['apply_status'] = $result->apply_status;
		/*if($result->apply_status == 1){
			$brandR = $this->t_product_brands->get($result->brand_id);
			$data['result'] = $this->t_certified_brand->get($brandR->c_brand_id);
		}*/
		$this->pagedata = $data;
		parent::_initpage();
	}

	//加盟商审核
	/**
	** @TODO 第一，二，三次流程 （现已不用，以后有可能用，请不要删除）
	*  @VERSION 2014/05/05 liuguangping
	*/
	public function join(){
		$data['title']='家178-管理中心-服务商';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'member/join';
		$this->navpage = $this->navpage;
		$result = array();
		$key_word = $this->input->get('key_word');
		$join_status = $this->input->get('join_status');
		$province = $this->input->get('province');

		$city = $this->input->get('city');
		$district = $this->input->get('district');
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
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$total_rows = count($this->t_service_join->admin_search_count($province,$city,$district,$join_status,$key_word));
		$office =  ($page-1)*($this->limit);
		$result['re'] = $this->t_service_join->admin_search($province,$city,$district,$join_status,$key_word,$office,$this->limit);
		$this->libs->base_url = site_url('admin/member/join').'?search=0&province='.$province."&city=".$city."&district=".$district."&join_status=".$join_status."&key_word=".$key_word;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();

		$result['pxid'] = $province;
		$result['cid'] = $city;
		$result['did'] = $district;
		$result['join_status'] = $join_status;
		$result['key_word'] = $key_word;
		$this->pagedata = $result;
		parent::_initpage();
	}

	//加盟商审核
	/**
	** @TODO这是第四次流程的改动（有可能会废弃)
	*  @VERSION 2014/05/05 liuguangping
	*/
	public function newJoin(){
		$data['title']='家178-管理中心-服务商';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'member/newJoin';
		$this->navpage = $this->navpage;
		$result = array();
		$key_word = $this->input->get('key_word');
		$join_status = $this->input->get('join_status');
		$province = $this->input->get('province');

		$city = $this->input->get('city');
		$district = $this->input->get('district');
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
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$total_rows = count($this->t_service_join->admin_search_count($province,$city,$district,$join_status,$key_word));
		$office =  ($page-1)*($this->limit);
		$result['re'] = $this->t_service_join->admin_search($province,$city,$district,$join_status,$key_word,$office,$this->limit);
		$this->libs->base_url = site_url('admin/member/newJoin').'?search=0&province='.$province."&city=".$city."&district=".$district."&join_status=".$join_status."&key_word=".$key_word;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();

		$result['pxid'] = $province;
		$result['cid'] = $city;
		$result['did'] = $district;
		$result['join_status'] = $join_status;
		$result['key_word'] = $key_word;
		$this->pagedata = $result;
		parent::_initpage();
	}

	public function dojoinstatus(){
		$data['join_status']  = $this->input->post('status');
		$data['join_id']  = $this->input->post('question_id');
 		$this->load->view('admin/member/joinCallback',$data);
	}

	public function donewjoinstatus(){
		$data['service_status']  = $this->input->post('status');
		$data['service_id']  = $this->input->post('question_id');

		if(!$data['service_id'] || !$data['service_status']){
			jumpAjax('非法申请！',site_url("admin/member/index"));
		}

		//认证后推广数据操作 如ss_type 1 微信时 发放充值卡 2 加积分
		$result = $this->t_service_info->get($data['service_id']);
		$data['ss_type'] = '';
		if($result->spreader_code_source){
			$where['spreader_code'] = $result->spreader_code_source;
			$where['ss_status'] = 1;
			$ss_typeR = model('t_service_spreader')->getOne('ss_type',$where);
			$data['ss_type'] = $ss_typeR->ss_type;
		}
		
		$data['re']  = $result;
 		$this->load->view('admin/member/newJoinCallback',$data);
	}

	public function doJoinCallback(){
		$status  = $this->input->post('join_status');
		$shop_id  = $this->input->post('join_id');
		//$service_id = $this->input->post('service_id');
		$shop_explain = $this->input->post('content');
		$data['join_status'] = $status;
		$data['join_laudit_desc'] = $shop_explain;
		$where['join_id'] = $shop_id;
		if($status == 2){
			$re = $this->t_service_join->get($shop_id);
			//这是先加盟再加登录的用户审核
			if($re->service_id == ''){
				$url = site_url('admin/member/add')."?join_id=".$shop_id;
			}else{

				$url = site_url('admin/member/add')."?join_id=".$shop_id."&tags=1";
				jumpAjax('',$url);
			}
			
		}else{
			$url = site_url('admin/member/join');
		}
		
		if($this->t_service_join->updates_global($data,$where)){
			jumpAjax('操作成功！',$url);
		}else{
			jumpAjax('操作失败！',$url);
		}	
	}

	public function sendNotice($notice_type,$notice_title,$notice_content,$service_id){
		$this->load->model('t_user_notice_model');
		$this->t_user_notice_model->notice_type=$notice_type;
        $this->t_user_notice_model->notice_title=$notice_title;
        $this->t_user_notice_model->notice_content=$notice_content;
        $this->t_user_notice_model->service_id=$service_id;
        $this->t_user_notice_model->insert();
	}

	public function doNewJoinCallback(){

			$flg = true;
			$status  = $this->input->post('service_status');
			$service_id = $this->input->post('service_id');
			$info = $this->t_service_info->get($service_id);
			if(!$info) jumpAjax('非法申请！',site_url("admin/member/index"));
			$service_name = $info->service_name;
			$shop_explain = $this->input->post('content');
			$url = site_url("admin/member/index");
			$spreader_code  = $this->input->post('spreader_code');
			$ss_type = $this->input->post('ss_type');

		
			if($status == 1){
				
				//这是先加盟再加登录的用户审核
				if($service_id == '' || !$info->service_name){
					jumpAjax('非法申请！',site_url("admin/member/index"));
				}else{
			
					//经销商商信息表(改)
					$infoWhere['service_id'] = $service_id;
					$infoData['service_status'] = 1;
					$infoData['la_rank'] = 2;
					$infoData['service_laudit_desc'] = $shop_explain;
					if(!$this->t_service_info->updates_global($infoData,$infoWhere)){
						$flg = false;
					}else{ 



						$whereS = "vas_status = '1' AND (vas_id = '1' OR vas_id = '2')";
						// 初始化经销商已购买增值服务
						$ArrayR = $this->vas_list->getArray('*',$whereS);
						if($ArrayR){
							$wherePay['service_id'] = $service_id;
							foreach ($ArrayR as $key => $rowR) {
								$wherePay['vas_id'] = $rowR->vas_id;
								if(!$this->pay_vas->getOne('*',$wherePay)){
									$this->pay_vas->service_id = $service_id;
									$this->pay_vas->vas_id = $rowR->vas_id;
									$this->pay_vas->apv_status = 1;
									$this->pay_vas->apv_addtime = date("Y-m-d H:i:s");
									$this->pay_vas->apv_starttime = date("Y-m-d H:i:s");
									$yearTime = time()+3600*24*365;
									$this->pay_vas->apv_endtime = date("Y-m-d H:i:s",$yearTime);
									$this->pay_vas->apv_price = 0;
									if(!$this->pay_vas->insert()){
										$flg = false;
									}
								}
							}
						}

					}
				}
				
			}else{
				$infoWheres['service_id'] = $service_id;
				$infoDatas['service_status'] = $status;
				$infoDatas['service_laudit_desc'] = $shop_explain;
				if($this->t_service_info->updates_global($infoDatas,$infoWheres)){
					if($status == 24){
						$notice_title = "经销商申请审核失败通知";
						$this->load->model('t_service_module_action_model');
						$resultStu = $this->t_service_module_action_model->getOne('ma_id',array('ma_key'=>'join_status'));
						$action_id = $resultStu->ma_id;
						$urls = "/lgwx/index.php/index/index?id=$action_id";
						$notice_content = "抱歉您的企业认证审核失败了，<a href=".$urls.">查看详情</a>";
						$this->sendNotice(0,$notice_content,$notice_content,$service_id);
					}
					
					jumpAjax('操作成功！',$url);
				}else{
					
					jumpAjax('操作失败！',$url);
				}
			}
			
			if($flg){
				if($status == 1){
					//把门店加入本服务商的超级用户
					$shopR = $this->t_service_shop->get_tag('shop_id,service_id',array("service_id"=>$service_id));
					if($status == 1 && $shopR){
						//修改品牌状态2门店状态为3
						$apply_array['apply_status'] = 2;
						$wherev['service_id'] = $service_id;
						$wherev['apply_status'] = 4;
						$applyR = $this->t_service_brands_apply->getOne("apply_id",$wherev);
						if($applyR){
							$wheres['apply_id'] = $applyR->apply_id;
							$this->t_service_brands_apply->updates_global($apply_array,$wheres);
						}

						$datashopR['shop_status'] = 3;
						$shopW['service_id'] = $service_id;
						$shopW['shop_status'] = 4;

						$shopRs = $this->t_service_shop->getOne("shop_id",$shopW);
						if($shopRs){
							$shopwheres['shop_id'] = $shopRs->shop_id;
							$this->t_service_shop->updates_global($datashopR,$shopwheres);
						}
						
					}
				}

				/*******************服务商认证通过，更新推广联盟表数据的推广认证成功数 如果是微信则发放充值卡如果是商户则更新积分**************************/
				
				$spreader_code  = $this->input->post('spreader_code');
				$ss_type = $this->input->post('ss_type');

				if($spreader_code){
					/*if($ss_type == 1){ //微信推广
						$rr_card_number = $this->input->post('rr_card_number');
						$spW['spreader_code'] = $spreader_code;
						$spW['service_id'] = $service_id;
						$spD['rr_card_number'] = $rr_card_number;
						$spD['rr_grant_time'] = date("Y-m-d H:i:s"); 
						//更新发放充值卡
						if(model('t_service_spreader_rebate_record')->updates_global($spD,$spW)){
							model("t_service_spreader")->setIncrease($spreader_code,'ss_certifieds','up');//更新推广认证成功数
							$this->sendNotice(0,"返利通知","恭喜，你通过返利途径注册，系统以向你的发放充值卡，卡号为:".$rr_card_number,$service_id);//通知注册服务商
						}
						
					}else*/if($ss_type == 2){

						$spW['spreader_code'] = $spreader_code;
						$spW['service_id'] = $service_id;
						$spD['rr_grant_time'] = date("Y-m-d H:i:s");
						//更新发放时间
						if(model('t_service_spreader_rebate_record')->updates_global($spD,$spW)){

							$rebate_record = model('t_service_spreader_rebate_record')->getOne('rr_amount',$spW); //推广后的积分
							$spreaderR = $this->t_service_info->getOne('service_id',array('spreader_code'=>$spreader_code));//查询推广来源者的服务商id

							if($rebate_record && $spreaderR){
								$sorce = $this->t_service_info->setIncrease($spreader_code,'service_score','up','spreader_code',$rebate_record->rr_amount);//更新积分

								if(model("t_service_spreader")->setIncrease($spreader_code,'ss_certifieds','up') && $sorce)
									$this->sendNotice(0,"返利通知","恭喜，你通过返利途径注册，以认证成功！，你可以返利途径来赚取相应的积分",$service_id);//通知注册服务商
								
								if($spreaderR->service_id){
									$this->sendNotice(0,"返利通知","恭喜，你分享的推广注册以成功注册，系统以向你发送了:".$rebate_record->rr_amount."积分",$spreaderR->service_id);//通知推广者服务商
								}
							}
							
						}
					}
				}

				/********************************************/

				//$sericeR = $this->t_service_user->get_tag('service_user_name',array('service_id'=>$service_id,'service_user_status'=>1));
				$notice_title = "经销商申请审核通过通知";
				$notice_content = "您的申请已经审核通过，您的会员名是".$service_name.",感谢您的加盟！";
				$this->sendNotice(0,$notice_title,$notice_content,$service_id);
				jumpAjax('操作成功！',$url);
			}else{
				$notice_title = "经销商申请审核失败通知";
				$this->load->model('t_service_module_action_model');
				$resultStu = $this->t_service_module_action_model->get_tag('action_id',array('action_key'=>'join_status'));
				$action_id = $resultStu['0']['action_id'];
				$urls = "/lgwx/index.php/index/index?id=$action_id";
				$notice_content = "抱歉您的企业认证审核失败了，<a href=".$urls.">查看详情</a>";
				$this->sendNotice(0,$notice_title,$notice_content,$service_id);
				jumpAjax('操作失败！',$url);
			}	
		}
	


	//把门店加入本服务商的超级用户
	public function shopAddServiceUser($service_id,$shop_idv){
		//分店和旗舰店时把这个
		if( $service_id != ""){
			//向服务商账户加入所属门店(根据账号名称和服务商id找到账号id)
			$serviceRe = $this->t_service_info->get($service_id);
			$wheres['service_id'] = $service_id;
			$whwers['service_user_name'] = $serviceRe->service_name;
			$service_userR = $this->t_service_user->get_tag('service_user_id,service_user_shop',$wheres);
			$service_user_id = $service_userR['0']['service_user_id'];
			if($service_userR['0']['service_user_shop']){
				$shopInfo = explode(',',$service_userR['0']['service_user_shop']);
				if(!in_array($shop_idv, $shopInfo)){
					$data['service_user_shop'] = trim($service_userR['0']['service_user_shop'].",".$shop_idv,',');
					$shopWhere['service_user_id'] = $service_user_id;
					$this->t_service_user->updates_global($data,$shopWhere);
				}
			}else{
				$data['service_user_shop'] = trim($shop_idv,',');
				$shopWhere['service_user_id'] = $service_user_id;
				$this->t_service_user->updates_global($data,$shopWhere);
			}
				
		}
	}
	
	//加盟商查看
	public function readJoin(){

		$data['title'] = '家178-服务编辑';
		$data['menu'] = $this->member;
		$this->data = $data;
		$this->page = 'member/readJoin';

		//服务商
		$service_id = $this->input->get('service_id',true);
		$service = $this->t_service_info->get($service_id);
		$this->config->load('uploads');


		//品牌
		$brand_r = $this->t_service_brands_apply->get_tag('*',array("service_id"=>$service->service_id));
		$result['brand_url'] = "/uploads/service/brand/";
		if($brand_r){
			$result['brand_r'] = $brand_r['0'];
		}else{
			$result['brand_r'] = "";
		}
		

		//门店

		$this->config->load('uploads');
		$configs = $this->config->item('service_license');
		$result['shop_url'] = $configs['relative_path'].'source/';
		$shop_r = $this->t_service_shop->get_tag("*",array("service_id"=>$service->service_id));
		
		if($brand_r){
			$result['shop_r'] = $shop_r['0'];
		}else{
			$result['shop_r'] = "";
		}
	
		$config = $this->config->item('service');
		$result['serviceJoin_url'] = $config['relative_path'].'source/';
		$result['result'] = $service;
		$this->navpage = $this->navpage;
		$this->pagedata = $result;
		/*echo "<pre>";var_dump($result);die;*/
		parent::_initpage();

	}

	//添加系统关联
	public function service_brands_apply_system(){
		$data['title']='家178-管理中心-服务商品牌管理';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'member/systemSeBrandM';
		$this->navpage = $this->navpage;
		$result = array();
		$key_word = $this->input->get('key_word');
		$service_id = $this->input->get('service_id');
		$tags = $this->input->get('tags');
		//echo $service_id;die;
		if(!$service_id){
			jumpAjax('非法操作！' , site_url('admin/member/index'));
		}
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$total_rows = count($this->t_service_brands_apply->systemSeB_search_count($service_id,$key_word));
		$office =  ($page-1)*($this->limit);
		$result['re'] = $this->t_service_brands_apply->systemSeB_search($service_id,$key_word,$office,$this->limit);
		$this->libs->base_url = site_url('admin/member/service_brands_apply_system').'?search=0&service_id='.$service_id."&key_word=".$key_word."&tags=1";
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();

		$result['service_id'] = $service_id;
		$result['key_word'] = $key_word;
		//向导设置所需参数
		$result['tags'] = $tags;
		$this->pagedata = $result;
		parent::_initpage();
	}

	//向经销商品牌申请表
	public function dojoin_brand(){
		$service_id = $this->input->post('service_id');
		$brand_ids = $this->input->post('ids');
		$brand_idArr = explode(',', $brand_ids);
		$flg='';
		foreach ($brand_idArr as $key => $value) {

			$result = $this->t_product_brands->get($value);
			$brandArr = $this->t_product_class_brands->get_class_brands_series('*',array('brand_id'=>$value));
			if($brandArr){
				$explodeId = twotoone_array($brandArr, 's_class_id');
				$apply_classidS = implode('|', $explodeId);
			}else{
				$apply_classidS = '';
			}
			$this->config->load('uploads');
			$config = $this->config->item('brand');
			$this->t_service_brands_apply->service_id = $service_id;
			$this->t_service_brands_apply->brand_id = $value;
			$this->t_service_brands_apply->apply_brand_name = $result->brand_name;
			$this->t_service_brands_apply->apply_brand_ename = $result->brand_ename;
			$this->t_service_brands_apply->apply_classid = $apply_classidS;
			$this->t_service_brands_apply->apply_brand_img = $config['relative_path'].'source'.$result->brand_img;
			$this->t_service_brands_apply->apply_license_file = '';
			$this->t_service_brands_apply->apply_license_begin = date('Y-m-d H:i:s',time());
			$this->t_service_brands_apply->apply_license_end = date('Y-m-d H:i:s',time()+3600);//初始化一天
			$this->t_service_brands_apply->apply_brand_seodesc = $result->brand_seodesc;
			$this->t_service_brands_apply->apply_laudit_desc = '';
			$this->t_service_brands_apply->apply_status = 1;
			if($inserid = $this->t_service_brands_apply->insert()){
				$flg[] = $value;
			}
		}

		if(empty($flg)){
			echojson('1','','操作失败！');
		}else{
			echojson('0',$flg,'操作成功！');
		}
	}
	
	//继续审核
	public function doAuditing(){
		$service_id = $this->input->get('service_id');
		$where['service_id'] = $service_id;
		$field = "apply_id";
		$brand_applyR= $this->t_service_brands_apply->get_tag($field,$where);
		$shopR = $this->t_service_shop->get_tag('shop_id',$where);
		if(!$brand_applyR){
			$url = site_url("admin/product/brands_add")."?service_id=".$service_id;
			jumpAjax('请关联品牌！',$url);
		}elseif(!$shopR) {
			$url = site_url("admin/shop/add")."?service_id=".$service_id."&tags=1";
			jumpAjax('请添加门店！',$url);
		}else{
			$service_infoR = $this->t_service_info->get($service_id);
			//后加盟的修改默认账号的

			$userfiled = 'service_user_id';
			$map['service_id'] = $service_id;
			$map['service_user_name'] = $service_infoR->service_name;
			$service_userR = $this->t_service_user->get_tag($userfiled,$map);
			$service_user_id = $service_userR[0]['service_user_id'];
			$maps['service_user_id'] = $service_user_id;
			$maps['service_user_status'] = 1;
			$datas['service_user_actions'] = $this->roleResulte();
			if(!$this->t_service_user->updates_global($datas,$maps)){
				jumpAjax('审核失败！',site_url('admin/member/join'));
			}
			

			$url = site_url('admin/member/index');
			$data['service_status'] = 1;
			if($this->t_service_info->updates_global($data,$where) && $this->t_service_join->updates_global(array('join_status'=>5),array('service_id'=>$service_id))){
				
				$this->load->model('t_user_notice_model');
				$this->t_user_notice_model->notice_type=0;
	            $this->t_user_notice_model->notice_title="加盟申请审核通过通知";
	            $this->t_user_notice_model->notice_content="恭喜，您的加盟申请已经审核通过，您的管理员账号是：".$service_infoR->service_name."，请您退出系统重新登录，感谢您的加盟！";
	            $this->t_user_notice_model->service_id=$service_id;
	            $this->t_user_notice_model->insert();

				jumpAjax('审核成功！',$url);
			}else{
			
				jumpAjax('审核失败！',$url);
			}
			
		}
		
	}

	//重置密码
	public function updatePwd(){
		$service_id = $this->input->post('id');
		$data['service_id'] = $service_id;
		$this->load->view('admin/member/updatePwdCallback',$data);
	}

	//重置客户等级
	public function updateRank(){
		$service_id = $this->input->post('id');
		$data['service_id'] = $service_id;
		$result = $this->t_service_info->get($service_id);
		$t_service_level_role = model('t_service_level_role');
		$where['service_type_id'] = $result->service_type_id;
		$data['la_rank'] = $result->la_rank;
		$filed = 'la_rank,la_name';
		$data['role'] = $t_service_level_role->getArray($filed,$where);
		$this->load->view('admin/member/updateRankCallback',$data);
	}

	//重置客户等级
	public function doUpdateRankCallback(){
		$service_id = $this->input->post('service_id');
		$la_rank = $this->input->post('la_rank');
		$where['service_id'] = $service_id;
		$data['la_rank'] = $la_rank;
		
		$url = U('admin/member/index');
		$this->t_service_info->updates_global($data,$where)?jumpAjax('客户级别授权成功！',$url):jumpAjax('客户级别授权失败！',$url);
	}

	//充值卡发放
	public function sedCodeList(){

		$data['title']='家178-管理中心-充值卡';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'member/sedCodeList';
		$this->navpage = $this->navpage;
		$result = array();
		$key_word = $this->input->get('key_word');

		$province = $this->input->get('province');

		$is_code = $this->input->get('is_code');

		$city = $this->input->get('city');
		$district = $this->input->get('district');
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
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$total_rows = count($this->t_service_info->code_search_count($province,$city,$district,$is_code,$key_word));

		$office =  ($page-1)*($this->limit);
		$result['re'] = $this->t_service_info->code_search($province,$city,$district,$is_code,$key_word,$office,$this->limit);
		$this->libs->base_url = site_url('admin/member/sedCodeList').'?search=0&province='.$province."&city=".$city."&district=".$district."&is_code=".$is_code."&key_word=".$key_word;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		
		$result['pxid'] = $province;
		$result['cid'] = $city;
		$result['did'] = $district;
		$result['key_word'] = $key_word;
		$result['is_code'] = $is_code;
		$this->pagedata = $result;
		parent::_initpage();
	}

	public function doCode(){
		$data['service_status']  = $this->input->post('status');
		$data['service_id']  = $this->input->post('question_id');

		if(!$data['service_id'] || !$data['service_status']){
			jumpAjax('非法操作！',U("admin/member/sedCodeList"));
		}

		//认证后推广数据操作 如ss_type 1 微信时 发放充值卡 2 加积分
		$result = $this->t_service_info->get($data['service_id']);
		$data['ss_type'] = '';
		if($result->spreader_code_source){
			$where['spreader_code'] = $result->spreader_code_source;
			$where['ss_status'] = 1;
			$ss_typeR = model('t_service_spreader')->getOne('ss_type',$where);
			$data['ss_type'] = $ss_typeR->ss_type;
		}
		
		$data['re']  = $result;
 		$this->load->view('admin/member/codeCallback',$data);
	}
	public function doCodeCallback(){
		$spreader_code  = $this->input->post('spreader_code');
		$ss_type = $this->input->post('ss_type');
		$service_id = $this->input->post('service_id');
		$url = U("admin/member/sedCodeList");
		if($spreader_code){
			if($ss_type == 1){ //微信推广
				$rr_card_number = $this->input->post('rr_card_number');
				$spW['spreader_code'] = $spreader_code;
				$spW['service_id'] = $service_id;
				$spD['rr_card_number'] = $rr_card_number;
				$spD['rr_grant_time'] = date("Y-m-d H:i:s"); 
				//更新发放充值卡
				if(model('t_service_spreader_rebate_record')->updates_global($spD,$spW)){
					model("t_service_spreader")->setIncrease($spreader_code,'ss_certifieds','up');//更新推广认证成功数
					$this->sendNotice(0,"返利通知","恭喜，你通过返利途径注册，系统以向你的发放充值卡，卡号为:".$rr_card_number,$service_id);//通知注册服务商
					jumpAjax('发放充值卡成功！',$url);
				}else{
					jumpAjax('发放充值卡失败！',$url);
				}
				
			}
		}
	}
	
}
