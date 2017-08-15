<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        liuguangpingAuthor: 服务商管理
 *        Email: liuguangpingtest@163.com

 */
class Shop extends Admin_Controller
{	
	public $member;
	public $navpage;
	public $limit;
	public $libs;
	public $t_system_district;
	public $t_service_shop;
	public $t_service_brands_apply;
	public $t_service_shop_brands;
	public $t_service_info;
	public $t_service_user;
	public $t_service_join;
	//public $t_service_module;
	public $t_service_action;
	public function __construct(){
		parent::__construct();
		$this->member = 'member';
		$this->navpage = 'member/nav';

		$this->load->model('t_service_info_model');
		$this->t_service_info = $this->t_service_info_model;
		$this->load->model('t_system_district_model');
		$this->t_system_district = $this->t_system_district_model;
		$this->load->model('t_service_shop_model');
		$this->t_service_shop = $this->t_service_shop_model;
		$this->load->model('t_service_brands_apply_model');
		$this->t_service_brands_apply = $this->t_service_brands_apply_model;
		$this->load->model('t_service_shop_brands_model');
		$this->t_service_shop_brands = $this->t_service_shop_brands_model;
		$this->load->model('t_service_user_model');
		$this->t_service_user = $this->t_service_user_model;
		$this->load->model('t_service_join_model');
		$this->t_service_join = $this->t_service_join_model;
	/*	$this->load->model('t_service_module_model');
		$this->t_service_module = $this->t_service_module_model;*/

		$this->load->model('t_service_module_action_model');
		$this->t_service_action = $this->t_service_module_action_model;

		$this->load->helper('import_excel');
		$this->load->helper('content_fun');
		
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->limit = 10;
		$this->load->helper('url');

	}
	public function index(){
		$data['title']='家178-管理中心-服务商门店';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'shop/index';
		$this->navpage = $this->navpage;
		$result = array();
		$key_word = $this->input->get('key_word');
		$shop_status = $this->input->get('shop_status');
		$service_name = $this->input->get('service_name');
		$province = $this->input->get('province');
		$service_id = $this->input->get('service_id');

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
		$total_rows = count($this->t_service_shop->admin_search_count($province,$city,$district,$shop_status,$key_word,$service_name,$service_id));
		$office =  ($page-1)*($this->limit);
		$result['re'] = $this->t_service_shop->admin_search($province,$city,$district,$shop_status,$key_word,$service_name,$service_id,$office,$this->limit);
		
		$this->libs->base_url = site_url('admin/shop/index').'?search=0&province='.$province."&city=".$city."&district=".$district."&shop_status=".$shop_status."&key_word=".$key_word."&service_id=".$service_id;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$result['pxid'] = $province;
		$result['cid'] = $city;
		$result['did'] = $district;
		$result['shop_status'] = $shop_status;
		$result['service_name'] = $service_name;
		$result['service_id'] = $service_id;
		$result['key_word'] = $key_word;
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function add()
	{

		$data['title'] = '家178-服务门店添加';
		$data['menu'] = $this->member;
		$this->data = $data;
		$this->page = 'shop/add';
		$this->t_system_district->district_pcode = '0';
		$result['provincere'] = $this->t_system_district->getbypid();
		$result['service'] = $this->t_service_info->getServiceList();
		$result['service_id'] = $this->input->get('service_id');
		//向导设置参数
		$result['tags'] = $this->input->get('tags',true);
		//从向导进入的必需关联一个品牌、
		if(isset($result['tags']) && $result['tags'] == 1){
			$map['service_id'] = $result['service_id'];
			$field = '*';
			$applyR = $this->t_service_brands_apply->get_tag($field,$map);
			if(!$applyR){
				$url = site_url("admin/product/brands_add")."?service_id=".$result['service_id'];
				jumpAjax("请添加或关联品牌后在添加门店！",$url);
			}
			if($this->t_service_shop->get_tag('shop_id',$map)){
				$url = site_url("admin/member/doAuditing")."?service_id=".$result['service_id'];
				jumpAjax("",$url);
			}
		}
		
		$this->navpage = $this->navpage;
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function doadd(){

		$shop_name = $this->input->post('shop_name',true);
		//向导设置
		$tags = $this->input->post('tags',true);
		$service_id = $this->input->post('service_id',true);
		$shop_id = $this->input->post('shop_id',true);
		$is_shop = $this->is_shop($shop_name,$service_id."@".$shop_id);
		if(!$is_shop || empty($shop_name)){
			if(isset($tags) && $tags == 1){
				$url = site_url('admin/shop/add')."?service_id=".$service_id."&tags=".$tags;
				jumpAjax("门店不能为空或重复！",$url);
			}else{
				jumpAjax("门店不能为空或重复！",site_url('admin/shop/add'));
			}
			
		}
		$this->load->library('upload');
		$shop_logoUrl = $this->upload->upLicenseModule("shop_logo");
		if($shop_logoUrl){
			$this->t_service_shop->shop_logo = $shop_logoUrl;
		}else{
			if(isset($tags) && $tags == 1){
				$url = site_url('admin/shop/add')."?service_id=".$service_id."&tags=".$tags;
				jumpAjax("门店logo图片上传失败！",$url);
			}else{
				jumpAjax("门店logo图片上传失败！",site_url('admin/shop/add'));
			}
		}
		$shop_pic1 = $this->upload->upLicenseModule("shop_pic1");
		$shop_pic2 = $this->upload->upLicenseModule("shop_pic2");
		$shop_pic3 = $this->upload->upLicenseModule("shop_pic3");
		$shop_license = $this->upload->upLicenseModule("shop_license");

		$this->t_service_shop->shop_pic1 = $shop_pic1;
		$this->t_service_shop->shop_pic2 = $shop_pic2;
		$this->t_service_shop->shop_pic3 = $shop_pic3;
		$this->t_service_shop->shop_license = $shop_license;

		$this->t_service_shop->shop_views = 0;
		$this->t_service_shop->shop_flash1 = "";
		$this->t_service_shop->shop_flash2 = '';
		$this->t_service_shop->shop_flash3 = '';
		$this->t_service_shop->shop_flash4 = '';
		$this->t_service_shop->shop_flash5 = '';

		$this->t_service_shop->shop_name =  $shop_name;
		$this->t_service_shop->service_id =  $service_id;
		$this->t_service_shop->shop_province_code = $this->input->post('province',true);
		$this->t_service_shop->shop_city_code =  $this->input->post('city',true);
		$this->t_service_shop->shop_address = $this->input->post('shop_address',true);
		$this->t_service_shop->shop_map = $this->input->post('shop_map',true);

		$this->t_service_shop->shop_sort = $this->input->post('shop_sort',true);
		$this->t_service_shop->shop_explain =  $this->input->post('shop_explain',true);
		$this->t_service_shop->shop_status = $this->input->post('shop_status',true);
		$this->t_service_shop->shop_addtime = date("Y-m-d H:i:s",time());
		$this->t_service_shop->shop_longitude = $this->input->post('shop_longitude',true);
		$this->t_service_shop->shop_latitude = $this->input->post('shop_latitude',true);
		if($this->t_service_shop->shop_status == 1){
			$updateD['shop_status'] = 2;
			$map['service_id'] = $service_id;
			$map['shop_status'] = 1;
			$updataS = $this->t_service_shop->updates_global($updateD,$map);
		}
		if($shop_idv =$this->t_service_shop->insert()){
			//向服务商账户加入所属门店(根据账号名称和服务商id找到账号id)
			$serviceRe = $this->t_service_info->get($service_id);
			$where['service_id'] = $service_id;
			$whwer['service_user_name'] = $serviceRe->service_name;
			$service_userR = $this->t_service_user->get_tag('service_user_id,service_user_shop',$where);
			$service_user_id = $service_userR['0']['service_user_id'];
			$data['service_user_shop'] = trim($service_userR['0']['service_user_shop'].",".$shop_idv,',');
			$shopWhere['service_user_id'] = $service_user_id;
			if($this->t_service_user->updates_global($data,$shopWhere)){

				if(isset($tags) && $tags == 1){

					$maps['service_user_id'] = $service_user_id;
					$datas['service_user_status'] = 1;
					$datas['service_user_actions'] = $this->roleResulte();
					$this->t_service_user->updates_global($datas,$maps);
					

					//只有关联了品牌才能审核通过
					$mapW['service_id'] = $service_id;
					$dats['service_status'] = 1;
					$this->t_service_info->updates_global($dats,$mapW);
					//添加门店后把加盟商状态变为5 成功 这个是为了防止审核中出错
					$this->t_service_join->updates_global(array('join_status'=>5),array('service_id'=>$service_id));
					//向导添加门店下一步添加账号
					$this->load->model('t_user_notice_model');
					$this->t_user_notice_model->notice_type=0;
		            $this->t_user_notice_model->notice_title="加盟申请审核通过通知";
		            $this->t_user_notice_model->notice_content="恭喜，您的加盟申请已经审核通过，您的会员号是".$serviceRe->service_ename."，管理员账号是：".$serviceRe->service_name."，，请您退出系统重新登录，感谢您的加盟！";
		            $this->t_user_notice_model->service_id=$service_id;
		            $this->t_user_notice_model->insert();
					$url = site_url('admin/serviceUser/add')."?service_id=".$service_id."&tags=".$tags;
					jumpAjax("添加成功，请添加子账号！",$url);
				}else{
					jumpAjax('添加成功！',site_url('admin/shop/index'));
				}

				
			}else{

				if(isset($tags) && $tags == 1){
					//向导添加门店下一步添加账号
					$url = site_url('admin/shop/add')."?service_id=".$service_id."&tags=".$tags;
					jumpAjax("主账号加入所属门店失败！",$url);
				}else{
					jumpAjax('主账号加入所属门店失败！',site_url('admin/shop/add'));
				}
			}
		}else{
				if(isset($tags) && $tags == 1){
					//向导添加门店下一步添加账号
					$url = site_url('admin/shop/add')."?service_id=".$service_id."&tags=".$tags;
					jumpAjax("添加失败！",$url);
				}else{
					jumpAjax('添加失败！',site_url('admin/shop/add'));
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
				//$kemodules = "'".$value->module_key."'";
				//$resultArr[$kemodules][$kesy] = $val['action_key'];
				$resultArr[] = "'".$val['action_key']."'";
			}
			
		}

		if($resultArr){
			return $resultS = implode(',', $resultArr);
			//return serialize($resultS);
		}else{
			return '';
		}
	}

	public function is_shop($shop_name,$sShop_id){
		$service_id = $sShop_id;
		$where['shop_name'] = $shop_name;
		$shopService = explode('@', $service_id);
		$where['service_id'] = $shopService['0'];
		$is_service_name = $this->t_service_shop->get_tag('shop_id,shop_name',$where);
		if($is_service_name){
			if(isset($shopService['1']) && !empty($shopService['1'])){
				$is_service = twotoone_array($is_service_name,'shop_id');
				foreach($is_service as $va){
					if($shopService['1'] != $va){
						return false;
					}
				}
				return true;
			}else{
				return false;
			}
			
		}else{
			return true;
		}
	}

	//验证该服务商下的门店是不是唯一
	public function is_Ajaxshop(){
		$shop_name = $this->input->post('key',true);
		$service_id = $this->input->post('id',true);
		if($this->is_shop($shop_name,$service_id)){
			echo "0";exit;
		}else{
			echo "1";exit;
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
		$this->page = 'shop/edit';
		
		$shop_id = $this->input->get('shop_id',true);
		$shop = $this->t_service_shop->get($shop_id);
		$result['service'] = $this->t_service_info->getServiceList();
		$result['result'] = $shop;

		$province = $shop->shop_province_code;

		$city = $shop->shop_city_code;
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

		$result['pxid'] = $province;
		$result['cid'] = $city;
		$result['did'] = $district;
		$this->navpage = $this->navpage;
		$this->pagedata = $result;
		parent::_initpage();
	}	
	
	public function readShop(){
		
		$data['title'] = '家178-服务编辑';
		$data['menu'] = $this->member;
		$this->data = $data;
		$this->page = 'shop/readShop';
		$this->config->load('uploads');
		$config = $this->config->item('service_license');
		$result['shop_url'] = $config['relative_path'].'source/';
		$shop_id = $this->input->get('shop_id',true);
		$shop = $this->t_service_shop->get($shop_id);
		$result['service'] = $this->t_service_info->getServiceList();
		$result['result'] = $shop;
		$this->navpage = $this->navpage;
		$this->pagedata = $result;
		parent::_initpage();

	}

	public function doedit(){

		$shop_name = $this->input->post('shop_name',true);
		$service_id = $this->input->post('service_id',true);
		$shop_id = $this->input->post('shop_id',true);
		$is_shop = $this->is_shop($shop_name,$service_id."@".$shop_id);
		if(!$is_shop || empty($shop_name)){
			echo "<script type='text/javascript'>alert('门店不能为空或重复！');window.location.href='".site_url('admin/shop/add')."'</script>";exit;
		}

		//图片移动
		$this->config->load('uploads');
		$config = $this->config->item('service_license');
		$this->load->library('upload');
		$time = date("Y/m",time());
		$shop_picDestPath = $config['upload_path'].$time;
	
		$this->load->library('upload');
		$shop_logoUrl = $this->upload->upLicenseModule("shop_logo");
		if($shop_logoUrl){
			$shop_logo_bakUrl = ".".$this->input->post('shop_logo_bak',true);
			@unlink($shop_logo_bakUrl);
			$data['shop_logo'] = $shop_logoUrl;
		}else{

			$shop_logoSoPath = $_SERVER['DOCUMENT_ROOT'].$this->input->post('shop_logo_bak',true);
			if($this->upload->moveFile($shop_logoSoPath,$shop_picDestPath)){
				@unlink($shop_logoSoPath);
				$data['shop_logo'] = $config['relative_path'].'source/'.$time."/".basename(($shop_logoSoPath));
			}else{

				$data['shop_logo']  =  $this->input->post('shop_logo_bak',true);
			}
			
		}
		$shop_pic1 = $this->upload->upLicenseModule("shop_pic1");
		$shop_pic2 = $this->upload->upLicenseModule("shop_pic2");
		$shop_pic3 = $this->upload->upLicenseModule("shop_pic3");
		$shop_license = $this->upload->upLicenseModule("shop_license");
		if($shop_pic1){
			//对图片编辑了则删除原来的图片

			$shop_pic1_bakUrl = ".".$this->input->post('shop_pic1_bak',true);
			@unlink($shop_pic1_bakUrl);
			$data['shop_pic1'] = $shop_pic1;
		}else{
			$shop_pic1SoPath = $_SERVER['DOCUMENT_ROOT'].$this->input->post('shop_pic1_bak',true);
			if($this->upload->moveFile($shop_pic1SoPath,$shop_picDestPath)){
				@unlink($shop_pic1SoPath);
				$data['shop_pic1'] = $config['relative_path'].'source/'.$time."/".basename(($shop_pic1SoPath));
			}else{
			
				$data['shop_pic1']  =  $this->input->post('shop_pic1_bak',true);
			}
		
		}
		if($shop_pic2){
			$shop_pic2_bakUrl = ".".$this->input->post('shop_pic2_bak',true);
			@unlink($shop_pic2_bakUrl);
			$data['shop_pic2'] = $shop_pic2;
		}else{
			$shop_pic2SoPath = $_SERVER['DOCUMENT_ROOT'].$this->input->post('shop_pic2_bak',true);
			if($this->upload->moveFile($shop_pic2SoPath,$shop_picDestPath)){
				@unlink($shop_pic2SoPath);
				$data['shop_pic2'] = $config['relative_path'].'source/'.$time."/".basename(($shop_pic2SoPath));
			}else{
			
				$data['shop_pic2']  =  $this->input->post('shop_pic2_bak',true);
			}
		}
		if($shop_pic3){
			$shop_pic3_bakUrl = ".".$this->input->post('shop_pic3_bak',true);
			@unlink($shop_pic3_bakUrl);
			$data['shop_pic3'] = $shop_pic3;
		}else{
			$shop_pic3SoPath = $_SERVER['DOCUMENT_ROOT'].$this->input->post('shop_pic3_bak',true);
			if($this->upload->moveFile($shop_pic3SoPath,$shop_picDestPath)){
				@unlink($shop_pic3SoPath);
				$data['shop_pic3'] = $config['relative_path'].'source/'.$time."/".basename(($shop_pic3SoPath));
			}else{
			
				$data['shop_pic3']  =  $this->input->post('shop_pic3_bak',true);
			}
		}
		if($shop_license){
			$shop_license_bakUrl = ".".$this->input->post('shop_license',true);
			@unlink($shop_license_bakUrl);
			$data['shop_license'] = $shop_license;
		}else{
		
			$shop_licenseSoPath = $_SERVER['DOCUMENT_ROOT'].$this->input->post('shop_license_bak',true);
			if($this->upload->moveFile($shop_licenseSoPath,$shop_picDestPath)){
				@unlink($shop_licenseSoPath);
				$data['shop_license'] = $config['relative_path'].'source/'.$time."/".basename(($shop_licenseSoPath));
			}else{
			
				$data['shop_license']  =  $this->input->post('shop_license_bak',true);
			}
		}

		$data['shop_views'] = 0;
		$data['shop_flash1'] = "";
		$data['shop_flash2'] = '';
		$data['shop_flash3'] = '';
		$data['shop_flash4'] = '';
		$data['shop_flash5'] = '';

		$data['shop_name'] =  $shop_name;
		$data['service_id'] =  $service_id;
		$data['shop_province_code'] = $this->input->post('province',true);
		$data['shop_city_code'] =  $this->input->post('city',true);
		$data['shop_address'] = $this->input->post('shop_address',true);
		$data['shop_map'] = $this->input->post('shop_map',true);
		$data['shop_longitude'] = $this->input->post('shop_longitude',true);
		$data['shop_latitude'] = $this->input->post('shop_latitude',true);

		$data['shop_sort'] = $this->input->post('shop_sort',true);
		$data['shop_explain'] =  $this->input->post('shop_explain',true);
		//$data['shop_status'] = $this->input->post('shop_status',true);
		$where['shop_id'] = $this->input->post('shop_id');
		/*if($data['shop_status'] == 1){
			$updateD['shop_status'] = 2;
			$map['service_id'] = $service_id;
			$map['shop_status'] = 1;
			$updataS = $this->t_service_shop->updates_global($updateD,$map);
		}*/
		if($this->t_service_shop->updates_global($data,$where)){
			jumpAjax('操作成功！',site_url('admin/shop/index'));
			
		}else{
			$url = site_url('admin/shop/edit')."?shop_id=".$where['shop_id'];
			jumpAjax('操作失败！',$url);
		}
	
	}	

	//审核门店
	public function doapplystatus(){
		$status  = $this->input->post('status');
		$shop_id  = $this->input->post('question_id');
		$data['shop_status'] = $status;
		$where['shop_id'] = $shop_id;
		if($this->t_service_shop->updates_global($data,$where)){
			echo 1;
		}else{
			echo 0;
		}	
		
	}

	//未关联
	public function detailed(){

		$data['title']='家178-内容管理-关联品牌';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'member/detailed';
		$this->navpage = $this->navpage ;
		$service_id = $this->input->get('service_id',true);
		$shop_id = $this->input->get('shop_id',true);
		$status = "11,''";
		$page = $this->input->get('current_page');
	
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		
		$office =  ($page-1)*($this->limit);

		$total_rows = count($this->t_service_brands_apply->getBrandsBySericeId($service_id,$status,$shop_id));

		$result['re'] = $this->t_service_brands_apply->getBrandsPageBySericeId($service_id,$status,$shop_id,$office,$this->limit);

		$this->libs->base_url = site_url('admin/shop/detailed').'?service_id='.$service_id .'&shop_id='.$shop_id;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;

		$result['p'] = $this->libs->show_page();
		$result['shop_id'] = $shop_id;
		$result['service_id'] = $service_id;
		$result['num'] = $total_rows;
		$this->pagedata = $result;
		parent::_initpage();
	}

	//关联
	public function existing(){

		$data['title']='家178-内容管理-关联品牌';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'member/existing';
		$this->navpage = $this->navpage ;
		$shop_id = $this->input->get('shop_id',true);

		$page = $this->input->get('current_page');
	
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
	
		$office =  ($page-1)*($this->limit);

		$total_rows = count($this->t_service_shop_brands->getBrandsByShopId($shop_id));
	
		$result['re'] = $this->t_service_shop_brands->getBrandsPageByShopId($shop_id,$office,$this->limit);

		$this->libs->base_url = site_url('admin/shop/existing').'?shop_id='.$shop_id;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();

		$result['shop_id'] = $shop_id;
		$result['num'] = $total_rows;
		$this->pagedata = $result;
		parent::_initpage();
	}

	//添加关联
	public function doAddBrandOfShop(){
		$brand_id = $this->input->post('ids');
		$shop_id = $this->input->post('shop_id');
		$field = "shop_brands_id";
		$where['shop_id'] = $shop_id;
		$success='';
		$brand_idArr = explode(',', $brand_id);

		if(!empty($brand_idArr)){
			foreach ($brand_idArr as $key => $value) {
				$where['brand_id'] = $value;
				if(!$this->t_service_shop_brands->get_tag($field,$where)){
					$this->t_service_shop_brands->brand_id = $value;
					$this->t_service_shop_brands->shop_id = $shop_id;
					$this->t_service_shop_brands->shop_brands_sort = 1;
					if($this->t_service_shop_brands->insert()){
						$success[] = $value;
					}
				}
			}
			if(empty($success)){
				echo 0;exit;
			}else{
				echo json_encode($success);exit;
			}
		}else{
			echo 0;exit;
		}

	}

	public function doapplystatuss(){
		$data['shop_status']  = $this->input->post('status');
		$data['shop_id']  = $this->input->post('question_id');
		$data['service_id']  = $this->input->post('service_id');
		$result = $this->t_service_shop->get($data['shop_id']);
		//如果想把旗舰店置为非旗舰店的情况下，则必需选择一个分店置为旗舰店，
		//不选择或者没有分店的情况下该服务商停用
		if($result->shop_status == 1){
			$map['service_id'] = $result->service_id;
			$map['shop_status'] = 2;
			$data['shop_re'] = $this->t_service_shop->get_tag('shop_id,shop_name',$map);
		}else{
			$data['shop_re'] = '';
		}
		$data['shop_flg'] = $result->shop_status;
		$data['service_id_feidian'] = $result->service_id;
		//echo "<pre>";var_dump($data['shop_re']);
 		$this->load->view('admin/shop/shopCallback',$data);
	}

	public function doShopCallback(){
		$shop_fei = $this->input->post('shop_fei');
		$shop_flg = $this->input->post('shop_flg');
		$status  = $this->input->post('shop_status');
		$shop_id  = $this->input->post('shop_id');
		$service_id = $this->input->post('service_id');
		$service_id_feidian = $this->input->post('service_id_feidian');
		$shop_explain = $this->input->post('content');

		
		//如果旗舰店则先把该服务商下的旗舰店置为普通店
		if($status == 1){
			$shopR = $this->t_service_shop->get($shop_id);
			$updateD['shop_status'] = 2;
			$map['service_id'] = $shopR->service_id;
			$map['shop_status'] = 1;
			$updataS = $this->t_service_shop->updates_global($updateD,$map);
		}



		$data['shop_status'] = $status;
		$data['shop_laudit_desc'] = $shop_explain;
		$where['shop_id'] = $shop_id;
		$flg = $service_id?"?service_id=".$service_id:'';
		$url = site_url('admin/shop/index').$flg;
		
		//旗舰店置为非旗舰店，则必需选择一个分店置为旗舰店，不选择或者没有分店的情况下该服务商停用
		if($shop_flg == 1){
			if(!$service_id_feidian){ 
				jumpAjax('操作失败！',$url);
			}
			if($shop_fei){
				$updatefeidian['shop_status'] = 1;
				$mapFeidian['shop_id'] = $shop_fei;
				$this->t_service_shop->updates_global($updatefeidian,$mapFeidian);
			}else{
				$updateService['service_status'] = 12;
				$mapService['service_id'] = $service_id_feidian;
				if(!$this->t_service_info->updates_global($updateService,$mapService)){
					jumpAjax('操作失败！',$url);	
				}
	
			}
		}


		$shopRe = $this->t_service_shop->get($shop_id);
		//图片移动
		$this->config->load('uploads');
		$config = $this->config->item('service_license');
		$this->load->library('upload');
		$time = date("Y/m",time());
		$shop_logoSoPath = $_SERVER['DOCUMENT_ROOT'].$shopRe->shop_logo;
		$shop_pic1SoPath = $_SERVER['DOCUMENT_ROOT'].$shopRe->shop_pic1;
		$shop_pic2SoPath = $_SERVER['DOCUMENT_ROOT'].$shopRe->shop_pic2;
		$shop_pic3SoPath = $_SERVER['DOCUMENT_ROOT'].$shopRe->shop_pic3;
		$shop_picDestPath = $config['upload_path'].$time;
		if($this->upload->moveFile($shop_logoSoPath,$shop_picDestPath)){
			@unlink($shop_logoSoPath);
			$data['shop_logo'] = $config['relative_path'].'source/'.$time."/".basename(($shopRe->shop_logo));
		}
		if($this->upload->moveFile($shop_pic1SoPath,$shop_picDestPath)){
			@unlink($shop_pic1SoPath);
			$data['shop_pic1'] = $config['relative_path'].'source/'.$time."/".basename(($shopRe->shop_pic1));
		}
		if($this->upload->moveFile($shop_pic2SoPath,$shop_picDestPath)){
			@unlink($shop_pic2SoPath);
			$data['shop_pic2'] = $config['relative_path'].'source/'.$time."/".basename(($shopRe->shop_pic2));
		}
		if($this->upload->moveFile($shop_pic3SoPath,$shop_picDestPath)){
			@unlink($shop_pic3SoPath);
			$data['shop_pic3'] = $config['relative_path'].'source/'.$time."/".basename(($shopRe->shop_pic3));
		}

		if($status == 1 && $updataS === true){
			if($this->t_service_shop->updates_global($data,$where)){

				/*//把门店加入本服务商的超级用户
				if($status == 1 || $status == 2){
					$this->shopAddServiceUser($service_id,$shop_id);
				}
*/
				jumpAjax('操作成功！',$url);
			}else{
				jumpAjax('操作失败！',$url);
			}	
		}else{
			if($this->t_service_shop->updates_global($data,$where)){

				/*//把门店加入本服务商的超级用户
				if($status == 1 || $status == 2){
					$this->shopAddServiceUser($service_id,$shop_id);
				}*/

				jumpAjax('操作成功！',$url);
			}else{
				jumpAjax('操作失败！',$url);
			}	
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

	//解除关联
	public function doDelBrandShop(){
		$shop_brands_id = $this->input->post('ids',true);
		$success = '';
		if($shop_brands_id){
			$shop_brands_idArr = explode(',', $shop_brands_id);
			if(!empty($shop_brands_idArr)){
				foreach ($shop_brands_idArr as $ke => $val) {
					if($this->t_service_shop_brands->delete($val)){
						$success[] = $val;
					}
				}
				if(empty($success)){
					echo 0;exit;
				}else{
					echo json_encode($success);exit;
				}
			}else{
				echo 0;exit;
			}
		}else{
			echo 0;exit;
		}
	}
	
	//获取经纬度
	public function setlatlng(){

		$systemR = model('t_system')->get('baidu_key');
		if($systemR){
			$data['key'] = $systemR->sys_value;
		}
		
		$this->load->view('admin/shop/setlatlng',$data);
	}
	
}

?>