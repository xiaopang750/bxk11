<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        liuguangpingAuthor: 服务商管理
 *        Email: liuguangpingtest@163.com

 */
class ServiceUser extends Admin_Controller
{	
	public $member;
	public $navpage;
	public $limit;
	public $libs;

	public $t_system_district;
	public $t_service_info;
	public $t_service_user;
	///public $t_service_module;
	public $t_service_action;
	public $t_service_join;
	public $t_service_shop;
	public function __construct(){

		parent::__construct();
		$this->member = 'member';
		$this->navpage = 'member/nav';
		$this->load->model('t_system_district_model');
		$this->t_system_district = $this->t_system_district_model;
		$this->load->model('t_service_info_model');
		$this->t_service_info = $this->t_service_info_model;
		
		$this->load->model('t_service_user_model');
		$this->t_service_user = $this->t_service_user_model;
		/*$this->load->model('t_service_module_model');
		$this->t_service_module = $this->t_service_module_model;*/
		
		$this->load->model('t_service_module_action_model');
		$this->t_service_action = $this->t_service_module_action_model;

		$this->load->model('t_service_join_model');
		$this->t_service_join = $this->t_service_join_model;
		$this->load->model('t_service_shop_model');
		$this->t_service_shop = $this->t_service_shop_model;


		$this->load->helper('import_excel');
		$this->load->helper('content_fun');
		
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->limit = 10;
		$this->load->helper('url');

	}
	public function index(){
		$data['title']='家178-管理中心-账号管理';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'serviceUser/index';
		$this->navpage = $this->navpage;
		$result = array();
		$key_word = $this->input->get('key_word');
		$starttime = $this->input->get('starttime');
		$stoptime = $this->input->get('stoptime');
		$service_id = $this->input->get('service_id');
		$service_user_status = $this->input->get('service_user_status');
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$total_rows = count($this->t_service_user->admin_search_count($service_id,$key_word,$starttime,$stoptime,$service_user_status));
		$office =  ($page-1)*($this->limit);
	    $result['re'] = $this->t_service_user->admin_search($service_id,$key_word,$starttime,$stoptime,$service_user_status,$office,$this->limit);
		$this->libs->base_url = site_url('admin/serviceUser/index').'?search=0&service_id='.$service_id.'&key_word='.$key_word."stoptime=".$stoptime.'&starttime='.$starttime."&service_user_status=".$service_user_status;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$result['key_word'] = $key_word;
		$result['starttime'] = $starttime;
		$result['stoptime'] = $stoptime;
		$result['service_id'] = $service_id;
		$result['service_user_status'] = $service_user_status;
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function add(){

		$data['title'] = '家178-服务管理添加';
		$data['menu'] = $this->member;
		$this->data = $data;
		$this->page = 'serviceUser/add';
		$result['service'] = $this->t_service_info->getServiceList();
		if(empty($result['service'])){
			jumpAjax('请添加经销商后在添加子账号',site_url('admin/member/add'));
		}else{
			$service_id = $this->input->get('service_id',true);
			if(isset($service_id) && $service_id){
				$where['service_id'] = $service_id;
			}else{
				$resultOne = $result['service']['0'];
				$where['service_id'] = $resultOne->service_id;
			}
			$field = "shop_id,shop_name";
			//默认首家服务商的店面
			$result['shopInfo'] = $this->t_service_shop->get_tag($field,$where);
		}
		//权限列表
		$moduleArr = $this->getRoleResulte();
		if($moduleArr){
			$result['moduleArr'] = $moduleArr;
		}else{
			$result['moduleArr'] = '';
		}
		$randLength=6;
		$chars='abcdefghijklmnopqrstuvwxyz';
		$len=strlen($chars);
		$randStr='';
		for ($i=0;$i<$randLength;$i++){
			$randStr.=$chars[rand(0,$len-1)];
		}
		$result['tokenvalue'] = $randStr.time();
		$result['service_id'] = $service_id;
		//向导设置参数
		$result['tags'] = $this->input->get('tags',true);
		$this->navpage = $this->navpage;
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function doadd(){
		//设置向导参数
		$tags = $this->input->post('tags');
		$service_user_name = $this->input->post('service_user_name',true);
		$service_id = $this->input->post('service_id',true);
		$is_username = $this->dois_ServiceUser($service_user_name,'',$service_id);
		$is_service_name = $this->t_service_user->get_tag('service_user_id,service_user_name',array('service_user_name'=>$service_user_name,'service_id '=>$service_id));
		if($service_user_name == '' || $is_service_name || !$is_username){
			jumpAjax('用户名不能为空或重复！',site_url('admin/serviceUser/add'));	
		}
		$this->load->library('upload');
		$service_user_photoUrl = $this->upload->upServiceUser("service_user_photo");
		if($service_user_photoUrl){
			$this->t_service_user->service_user_photo = $service_user_photoUrl;
		}else{
			jumpAjax('员工照片上失败！',site_url('admin/serviceUser/add'));
		}
		$this->t_service_user->service_user_name =  $this->input->post('service_user_name',true);
		$this->t_service_user->service_user_password = md5($this->input->post('service_user_password',true));

		$this->t_service_user->service_user_realname =  $this->input->post('service_user_realname',true);
		$this->t_service_user->service_user_phone = $this->input->post('service_user_phone',true);
		$this->t_service_user->service_id = $service_id ;
		$shopRe = $this->input->post('shop_id',true);
		if($shopRe){
			$this->t_service_user->service_user_shop = implode(',', $shopRe);
		}else{
			$this->t_service_user->service_user_shop = "";
		}
		
		$actionRe = $this->input->post('action_id',true);
		if($actionRe){
			$ca = array();
			foreach ($actionRe as $key => $value) {
				$ca[] = "'".$value."'";
			}
			$this->t_service_user->service_user_actions = implode(',', $ca );
		}else{
			$this->t_service_user->service_user_actions = "";
		}
		
		$this->t_service_user->service_user_addtime = date("Y-m-d H:i:s",time());
		if($serviceUser_id =$this->t_service_user->insert()){
			if(isset($tags) && $tags == 1){
				//向导添加门店下一步添加账号
				$url = site_url('admin/member/index');
				jumpAjax("添加成功！",$url);
			}else{
				jumpAjax('添加成功！',site_url('admin/serviceUser/index'));
			}

		}else{
			if(isset($tags) && $tags == 1){
				//向导添加门店下一步添加账号
				$url = site_url('admin/serviceUser/add')."?service_id".$service_id."&tags=".$tags;
				jumpAjax("添加失败！",$url);
			}else{
				jumpAjax('添加失败！',site_url('admin/serviceUser/add'));
			}
			
		}
		
	}

  
    //最高权限
	public function getRoleResulte(){
		$resultArr = array();
		$module = $this->t_service_module->get_tag('*','module_status in (1,11)');
		$field = 'module_key,action_key,action_name';
		foreach ($module as $key => $value) {
			$resultArr[$key]['module_key'] = $value['module_key'];
			$resultArr[$key]['module_name'] = $value['module_name'];
			$resultArr[$key]['module_id'] = $value['module_id'];
			$where['module_key'] = $value['module_key'];
			$action_info = $this->t_service_action->get_tag($field,$where);
			foreach ($action_info as $kesy => $val) {
				$resultArr[$key]['action'][$kesy] = $val;
			}
		}
		if($resultArr){
			return $resultArr;
		}else{
			return '';
		}
	}

	public function doGetShopInfo(){
		$service_id = $this->input->post('service_id');
		$service_user_id = $this->input->post('service_user_id');
		if($service_user_id){
			$service_user_info = $this->t_service_user->get($service_user_id);
			$service_user_shopRe = explode(',', $service_user_info->service_user_shop);
		}

		$field = "shop_id,shop_name";
		$where['service_id'] = $service_id;
		//默认首家服务商的店面
		$shopInfo = $this->t_service_shop->get_tag($field,$where);
		$html = "";
		if(isset($shopInfo) && $shopInfo){ 
			foreach($shopInfo as $key=>$value){
				if(isset($service_user_shopRe) && $service_user_shopRe){
					//这是为了用户在编辑时选择自己后恢复以前选的门店
					if($service_user_info->service_id == $service_id){
						if(in_array($value['shop_id'], $service_user_shopRe)){
							$html .= "<input type='checkbox' value='".$value['shop_id']."' name='shop_id[]' checked='checked'/>";
						}else{
							$html .= "<input type='checkbox' value='".$value['shop_id']."' name='shop_id[]'/>";
						}	
					}else{
						$html .= "<input type='checkbox' value='".$value['shop_id']."' name='shop_id[]'/>";
					}
					
				}else{
					$html .= "<input type='checkbox' value='".$value['shop_id']."' name='shop_id[]'/>";
				}
				
				$html .= $value['shop_name'];	
	

			}
			echo $html;exit;
		}else{
			echo 0;exit;
		}


	}

	//ajax 验证登录名
	public function is_AjaxServiceUser(){

		$user_name = $this->input->post('key',true);
		$set = $this->input->post('id',true);
		$service_id = $this->input->post('service_id');
		if($this->dois_ServiceUser($user_name,$set,$service_id)){
			echo 0;
		}else{
			echo 1;
		}
	}

	//验证用户是不是唯一
	public function dois_ServiceUser($service_user_name,$service_user_id,$service_id=''){
		$user_name = $service_user_name;
		$set = $service_user_id;
		$service_id = $service_id;
		$is_service_name = $this->t_service_user->get_tag('service_user_id,service_user_name',array('service_user_name'=>$user_name,'service_id'=>$service_id));

		//$is_user = $this->users->is_user($user_name);
		
		if($is_service_name){
			if(!empty($set)){
				$is_service = twotoone_array($is_service_name, 'service_user_id');
				foreach($is_service as $va){
					if($set != $va){
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
	
	
	
	public function edit(){
		$data['title'] = '家178-服务管理添加';
		$data['menu'] = $this->member;
		$this->data = $data;
		$this->page = 'serviceUser/edit';
		$service_user_id = $this->input->get('service_user_id',true);
		$service_id = $this->input->get('service_id',true);
		if(!$service_user_id OR !$service_id){
			jumpAjax('非法操作！',site_url('admin/serviceUser/index'));
		}
		$result['service'] = $this->t_service_info->getServiceList();
		if(empty($result['service'])){
			jumpAjax('请添加经销商后在添加子账号',site_url('admin/member/add'));
		}else{
			$field = "shop_id,shop_name";
			$where['service_id'] = $service_id;
			//默认首家服务商的店面
			$shopInfo = $this->t_service_shop->get_tag($field,$where);
		}
		//子账号详细信息
		$result['re'] = $this->t_service_user->get($service_user_id);
		$action_info = $result['re']->service_user_actions;
		
		//门店选中
		$service_user_shop = $result['re']->service_user_shop;
		$shopInfo = $this->isShopChecked($service_user_shop,$shopInfo);
		if($shopInfo){
			$result['shopInfo'] = $shopInfo;
		}
		//权限列表
		$moduleArr = $this->getRoleResulte();
		//权限选中
		$moduleArr =$this->ismoduleChecked($moduleArr,$action_info);

		if($moduleArr){
			$result['moduleArr'] = $moduleArr;
		}else{
			$result['moduleArr'] = '';
		}
		$this->navpage = $this->navpage;
		$this->pagedata = $result;
		parent::_initpage();
	}	

	/**
	**门店选中是否选中
	**@author liuguangping 2014/03/26
	**@param String $service_user_shop  用户所属门店
	**@param String $shopInfo  服务商所属门店
	**@return array
	*/

	public function isShopChecked($service_user_shop,$shopInfo){
		if($shopInfo){
			$service_user_shopRe = explode(',', $service_user_shop);
			foreach ($shopInfo as $keys => $vals) {
			   if(in_array($vals['shop_id'], $service_user_shopRe)){
			   	  $shopInfo[$keys]['checked'] = true;
			   }else{
			   	  $shopInfo[$keys]['checked'] = false;
			   }
			}
		}
		return $shopInfo;
	}

	/**
	**门店选中是否选中
	**@author liuguangping 2014/03/26
	**@param Array $moduleArr  权限列表
	**@param String $action_info  用户的所属门权限
	**@return Array
	*/

	public function ismoduleChecked($moduleArr,$action_info){
		$action_infoRe = explode(',', $action_info);
		foreach ($moduleArr as $keys => $values) {
			if(count($values) >3){
				foreach ($values['action'] as $ky => $val) {
					if($action_infoRe && in_array("'".$val['action_key']."'", $action_infoRe)){
						$moduleArr[$keys]['action'][$ky]['checked'] = true;
					}else{
						$moduleArr[$keys]['action'][$ky]['checked'] = false;
					}
				}
			}
		}
		return $moduleArr;
	}
	
	public function doedit(){

		$service_user_name = $this->input->post('service_user_name',true);
		$service_user_id = $this->input->post('service_user_id',true);
		$oldservice_id = $this->input->post('getservice_id',true);
		$newservice_id = $this->input->post('service_id',true);
		$is_username = $this->dois_ServiceUser($service_user_name,$service_user_id,$newservice_id);
		
		if($service_user_name == ''  || !$is_username){
			$url = site_url('admin/serviceUser/eidt')."?service_user_id=".$service_user_id."&service_id=".$oldservice_id;
			jumpAjax('用户名不能为空或重复！',$url);	
		}
		//图片移动
		
		$this->config->load('uploads');
		$config = $this->config->item('service_user');
		$time = date("Y/m",time());
		$destPath = $config['upload_path'].$time;
		$this->load->library('upload');
		$service_user_photoUrl = $this->upload->upServiceUser("service_user_photo");
		if($service_user_photoUrl){
			@unlink($_SERVER['DOCUMENT_ROOT'].$this->input->post('service_user_photo_bak',true));
			$data['service_user_photo'] = $service_user_photoUrl;
		}else{
			//图片移动到目录
			$service_user_photoSoPath = $_SERVER['DOCUMENT_ROOT'].$this->input->post('service_user_photo_bak',true);
			if($this->upload->moveFile($service_user_photoSoPath,$destPath)){
				@unlink($service_user_photoSoPath);
				$data['service_user_photo']= $config['relative_path'].'source/'.$time."/".basename(($service_user_photoSoPath));
			}else{
				$data['service_user_photo']  =  $this->input->post('service_user_photo_bak',true);
			}
		}
		$where['service_user_id'] =  $this->input->post('service_user_id',true);
		$data['service_user_name'] =  $service_user_name;
		//$data['service_user_password'] = $this->input->post('service_user_password',true);

		$data['service_user_realname'] =  $this->input->post('service_user_realname',true);
		$data['service_user_phone'] = $this->input->post('service_user_phone',true);
		$data['service_id'] = $newservice_id;
		$shopRe = $this->input->post('shop_id',true);
		if($shopRe){
			$data['service_user_shop'] = implode(',', $shopRe);
		}else{
			$data['service_user_shop'] = "";
		}
		
		$actionRe = $this->input->post('action_id',true);
		if($actionRe){
			$ca = array();
			foreach ($actionRe as $key => $value) {
				$ca[] = "'".$value."'";
			}
			$data['service_user_actions'] = implode(',', $ca );
		}else{
			$data['service_user_actions'] = "";
		}
		
		$data['service_user_addtime'] = $this->input->post('service_user_addtime',true);
		if($serviceUser_id =$this->t_service_user->updates_global($data,$where)){
			jumpAjax('编辑成功！',site_url('admin/serviceUser/index'));
		}else{
			$url = site_url('admin/serviceUser/eidt')."?service_user_id=".$service_user_id."&service_id=".$oldservice_id;	
			jumpAjax('编辑失败！',$url);
		}
	}	
	//删除
	public function dodel(){
		$ids = $this->input->post('ids');
		$service_userArr = explode(',', $ids);
		$success = '';
		foreach ($service_userArr as $key => $value) {
			
			if($this->t_service_user->delete($value)){
				$success[] = $value;
			}
		}
		if(empty($success)){
			echojson(1,$success,'删除失败！');
		}else{
			echojson(0,$success,'删除失败！');
		}
	}
	
	//账号状态
	public function doServiceUserStatus(){
		$status = $this->input->post('status',true);
		$goods_id = $this->input->post('question_id',true);
		$data = array('service_user_status'=>$status);
		$where = array('service_user_id'=>$goods_id);
		if($this->t_service_user->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}

	//重置密码
	public function updatePwd(){
		$service_user_id = $this->input->post('id');
		$data['service_id'] = $service_user_id;
		$this->load->view('admin/serviceUser/updatePwdCallback',$data);
	}

	//重置回调地址操作
	public function doUpdatePwdCallback(){
		$newPwd  = $this->input->post('newPwd');
		$newActPwd  = $this->input->post('newActPwd');
		$service_user_id = $this->input->post('service_id');
		$data['service_user_password'] = md5($newPwd);
		$where['service_user_id'] = $service_user_id;
		$url = site_url("admin/serviceUser/index");
		if($newPwd != $newActPwd){
			jumpAjax('两次输入的密码不对，重置失败！',$url);
		}
		if($this->t_service_user->updates_global($data,$where)){
			jumpAjax('重置成功！',$url);
		}else{
			jumpAjax('重置失败！',$url);
		}	
	}

	
}

?>