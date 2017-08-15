<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        liuguangpingAuthor: 服务商管理
 *        Email: liuguangpingtest@163.com

 */
class Service extends Admin_Controller
{	
	//公共用的
	public $member;
	public $navpage;
	public $limit;
	public $libs;
	
	public $t_service_module;
	public $t_service_action;
	public $level_role;
	public $t_service_type;
	public function __construct(){
		parent::__construct();
		$this->member = "member";
		$this->navpage = 'member/nav';

		
		$this->load->model('t_service_module_action_model');
		$this->t_service_action = $this->t_service_module_action_model;
		$this->t_service_type = model('t_service_type');
		$this->level_role = model('t_service_level_role');
		//共公有的
		$this->load->helper('import_excel');
		$this->load->helper('content_fun');
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->limit = 10;
		$this->load->helper('url');

	}
	public function index()
	{
		
	}
	
	
	public function module_add(){
		$data['title']='家178-管理中心-服务商-模块添加';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'service/module_add'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
		$result=array();
		
		$this->pagedata = $result;//向页面加入加载数据
		parent::_initpage();//加载页面
	}
	
	
	
	//图片上传
	public function upLoadImage($imageName){
		$this->load->library('upload');
		$service_licenseUrl = $this->upload->upServiceModule($imageName);
		if($service_licenseUrl){
			return $service_licenseUrl;
		}else{
			return false;
			/* echo "<script type='text/javascript'>alert('营业执照图片 上失败！');window.location.href='".site_url('admin/member/add')."'</script>";exit; */
		}
	}
	
	//取得参数
	public function post_param(){
		return $this->input->post();
	}
	
	//get参数
	public function get_param(){
		return $this->input->get();
	}
	

	
	//验证key是不是唯一
	public function is_modules($key,$id='',$model="t_service_action",$field="ma_id,ma_pid,ma_name,ma_key",$where="ma_key",$keyflg="ma_id"){
		$is_service_key = $this->{$model}->getArray($field,array($where=>$key));
		if(!$id){
			if($is_service_key){
				return false;//失败
			}else{
				return true;//成功
			}
		}else{
			if($is_service_key){
				
				$moduleArr = twotoone_array($is_service_key,$keyflg);

				if(!in_array($id, $moduleArr)){
					return false;
				}else{
					return true;
				}
			}else{
				return true;
			}
		
		}

	}
	

	
	##======================功能操作====================##


	public function action(){

		$data['title']='家178-管理中心-服务商-模块编辑';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'service/action'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
	
		$result=array();
		
		$this->pagedata = $result;//向页面加入加载数据
		parent::_initpage();//加载页面
	}

	public function postAction(){
		$getResult = $this->get_param();
	
		$getValue = $this->t_service_action->getOrderArray('*');
		$result['list'] = $this->getValue($getValue);
		if($result['list']){
			echojson(0,$result,'数据获取成功！');
		}else{
			echojson(1,'','数据获取失败！');
		}
	}

	public function getValue($getValue,$array=array()){
		$list = array();
		foreach ($getValue as $key => $value) {
			if($value->ma_pid == 0){
				$listOne = array();
				$listOne['rank'] = $value->ma_sort;
				$listOne['name'] = $value->ma_name;
				$listOne['id'] = $value->ma_id;
				$listOne['is_open'] = $value->is_open;
				if(!empty($array)){
					if(in_array($listOne['id'], $array)){
						$listOne['is_selected'] = 1;
					}else{
						$listOne['is_selected'] = 0;
					}
				}else{
					$listOne['is_selected'] = 0;
				}
				foreach ($getValue as $ke => $val) {
					if($val->ma_pid == $value->ma_id){
						$listTwo = array();
						$listTwo['rank'] = $val->ma_sort;
						$listTwo['name'] = $val->ma_name;
						$listTwo['id'] = $val->ma_id;
						$listTwo['is_open'] = $val->is_open;
						if(!empty($array)){
							if(in_array($listTwo['id'], $array)){
								$listTwo['is_selected'] = 1;
							}else{
								$listTwo['is_selected'] = 0;
							}
						}else{
							$listTwo['is_selected'] = 0;
						}
						$listThreebak = array();
						foreach ($getValue as $k => $v) {
							if($v->ma_pid == $val->ma_id){
								$listThree = array();
								$listThree['rank'] = $v->ma_sort;
								$listThree['name'] = $v->ma_name;
								$listThree['id'] = $v->ma_id;
								$listThree['is_open'] = $v->is_open;
								if(!empty($array)){
									if(in_array($listThree['id'], $array)){
										$listThree['is_selected'] = 1;
									}else{
										$listThree['is_selected'] = 0;
									}
								}else{
									$listThree['is_selected'] = 0;
								}
								$listThreebak[] = $listThree;
							}

						}

						if(!isset($listThreebak))
							$listTwo['son'] = array();
						else
							$listTwo['son'] = $listThreebak;
						
						$listOne['son'][] = $listTwo;
					}
					
				}

				if(!isset($listOne['son'])){
					$listOne['son'] = array();
				}
				$list[] = $listOne;
				
			}
			
		}

		return $list;
	}

	public function ConsoleData(){
		$url = '/index.php/admin/service/action';
		$postRe = $this->post_param()?$this->post_param():echojson(1,'','请提交数据');

		$postDataR = json_decode($postRe['data'],true);
		$postData = $postDataR;
		//echo "<pre>";var_dump($postData);die;
		if($postData){
			$errorArr = $this->edit_action($postData);

			if(empty($errorArr)) 
				echojson(0,$url,'操作成功！');
			else
				$name = implode(',', $errorArr);
				echojson(0,$url,'名为'.$name.'模块操作失败！');
		}else{
			echojson(1,$url,'数据格式不正确！');
		}
		
	}

	public function edit_action($postData){

		$errorArr = array();
		//echo "<pre>";var_dump($postData['list']['0']);die;
		foreach ($postData['list'] as $key => $value) {
			$pidOne = 0;
			if(isset($value['id']) && $value['id'] != ''){
				if(!$this->updateConsole($value)) $errorArr[] = $value['name'];
			}else{
				$value['ma_pid'] = $pidOne;
				$value['ma_depth'] = 1;
				if(!$this->InsertConsole($value)) $errorArr[] = $value['name'];
			}
			//two
			$twoSon = $value['son'];
			if(!empty($twoSon)){

				foreach ($twoSon as $ke => $val) {
					$pidTwo = $value['id'];
					if(isset($val['id']) && $val['id'] != ''){
						
						if(!$this->updateConsole($val)) $errorArr[] = $val['name'];
					}else{
						$val['ma_pid'] = $pidTwo;
						$val['ma_depth'] = 2;
						if(!$this->InsertConsole($val)) $errorArr[] = $val['name'];
					}


					//three
					$threeSon = $val['son'];
					if(!empty($threeSon)){
						foreach ($threeSon as $k => $va) {
							$pidThree = $val['id'];
							if(isset($va['id']) && $va['id'] != ''){
								if(!$this->updateConsole($va)) $errorArr[] = $va['name'];
							}else{
								$va['ma_pid'] = $pidThree;
								$va['ma_depth'] = 3;
								if(!$this->InsertConsole($va)) $errorArr[] = $va['name'];
							}
						}
					}

				}
			}

		}
		
		return $errorArr;
		
	}

	public function del(){
		$url = '/index.php/admin/service/action';
		$postRe = $this->post_param()?$this->post_param():echojson(1,$url,'请提交数据');
		if($this->t_service_action->getOrderArray('*',array('ma_pid' =>$postRe['id']))) echojson(1,$url,'存在下级版块，请先返回删除本分类或本版块的下级版块');
		if($this->t_service_action->delete($postRe['id'])){
			echojson(0,$url,'版块删除成功 !');
		}else{
			echojson(1,$url,'版块删除失败 !');
		}
	}
	
	public function updateConsole($datas){
		$where['ma_id'] = $datas['id'];
		$data['ma_name'] = $datas['name'];
		$data['ma_sort'] = $datas['rank'];
		if(!$this->t_service_action->updates_global($data,$where)) return false;
		return true;
	}

	public function InsertConsole($data){
		//echo "<pre>";var_dump($data);die;
		$this->t_service_action->ma_pid = $data['ma_pid'];
		$this->t_service_action->ma_name = $data['name'];
		$this->t_service_action->ma_sort = $data['rank'];
		$this->t_service_action->ma_depth = $data['ma_depth'];
		$this->t_service_action->is_open = 0;
		$this->t_service_action->ma_type = '';	
		if(!$this->t_service_action->insert()) return false;
		return true;
	}

	
	public function action_edit(){
		$data['title']='家178-管理中心-服务商-功能编辑';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'service/action_edit'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
		$getRe = $this->get_param();
		$ma_id = isset($getRe['id'])?$getRe['id']:'';
		if(!$ma_id){
			jumpAjax('请正确操作',U('admin/service/action'));
		}
		$action=array();
		$action = $this->t_service_action->get($ma_id);
		$result['service_type'] = $this->t_service_type->get_all();
		
		$result['actions_info'] = $action;
		$this->pagedata = $result;//向页面加入加载数据
		
		//echo "<pre>";var_dump($result['actions_info']);die;
		parent::_initpage();//加载页面
	}
	
	//处理逻辑
	public function console(){
		$post = $this->post_param();
		$flg = true;
		$result = array();
		
		//图片
/*		if($imageurl = $this->upLoadImage("ma_pic")){
			$this->config->load('uploads');
			$config = $this->config->item('service_module');
			$fileUrl = $config['upload_path'].$post['ma_pic_bak'];
			@unlink($fileUrl);
			$result['ma_pic'] = $imageurl;
		}else{
			$result['ma_pic'] = $post['ma_pic_bak'];
		}
*/
		$result['ma_pic'] = $post['ma_pic'];
		$result['ma_name']   = $post['ma_name'];
		$result['ma_key']   = $post['ma_key'];
		$result['ma_sort']   = $post['ma_sort'];
		$result['service_types'] = $post['service_types'];
		$result['ma_depth'] = $post['ma_depth'];
		$result['ma_desc'] = $post['ma_desc'];
		$result['is_open'] = isset($post['is_open'])?$post['is_open']:'';;
		$result['ma_type'] = isset($post['ma_type'])?$post['ma_type']:'';;
		$result['ma_sort'] = $post['ma_sort'];
		$result['ma_id'] = isset($post['ma_id'])?$post['ma_id']:'';
		$ma_key   = $post['ma_key'];
		if($result['ma_depth'] == 3){
			//判断key
			if($ma_key){
				if($result['ma_id']){
					
					if($this->is_modules($ma_key,$result['ma_id'])){
						$result['ma_key'] = $post['ma_key'];
					}else{
						$flg = false;
					}
				}else{
					if($this->is_modules($ma_key,'')){
						$result['ma_key'] = $post['ma_key'];
					}else{
						$flg = false;
					}
				}
				
			}else{

				$flg = false;
			}
		}
		if($flg){
			return $result;
		}else{
			return false;
		}
	}


	public function doaction_edit(){
		$post_param = $this->post_param();
		if($result = $this->console()){

			$data['ma_name'] = $result['ma_name'];
			
			$data['service_types'] = $result['service_types'];
			$data['ma_pic'] = $result['ma_pic'];
			$data['ma_depth'] = $result['ma_depth'];
			$data['ma_sort'] = $result['ma_sort'];
			$data['ma_desc'] = $result['ma_desc'];
			$data['is_open'] = $result['is_open'];
			if($data['ma_depth'] == 3){
				$data['ma_key'] = $result['ma_key'];
				$data['ma_type'] = $result['ma_type'];
			}
			$where['ma_id'] = $result['ma_id'];
			if($this->t_service_action->updates_global($data,$where)){
				jumpAjax('模块操作成功！',U('admin/service/action'));
				
			}else{
				jumpAjax('模块操作失败！',U('admin/service/action_edit',array('id'=>$post_param['ma_id'])));
			}
		}else{
			jumpAjax('功能KEY不能为空或不能重复,模块操作失败！',U('admin/service/action_edit',array('id'=>$post_param['ma_id'])));
		}
	}

	/******************商户级别权限**********************/
	public function level_role(){
		$data['title']='家178-管理中心-服务商-商户级别权限';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'service/level_role'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
	
		$result=array();

		$result['service_type'] = $this->t_service_type->get_all();
		$key_word = $this->input->get('key_word');
		$service_type_id = $this->input->get('service_type_id');
		
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		

		$total_rows = count($this->level_role->admin_search_count($service_type_id,$key_word));

		$office =  ($page-1)*($this->limit);


		$result['key_word'] = $key_word;
		$result['service_type_id'] = $service_type_id;

		$result['re'] = $this->level_role->admin_search($service_type_id,$key_word,$office,$this->limit);
		$this->libs->base_url = site_url('admin/service/level_role').'?search=0&service_type_id='.$service_type_id."&key_word=".$key_word;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();

		$this->pagedata = $result;//向页面加入加载数据
		parent::_initpage();//加载页面
	}

	public function role_edit(){
		$data['title']='家178-经销产品编辑';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'service/role_edit';
		$this->navpage = $this->navpage;
		$result = array();
		$get_param = $this->get_param();
		$la_id = $get_param['la_id'];
		if(!$la_id){
			jumpAjax('非法操作！',site_url('admin/service/level_role'));
		}
		$result['service_type'] = $this->t_service_type->get_all();
		$result['level_roleR'] = $this->level_role->get($la_id);

		
		$this->pagedata = $result;
		parent::_initpage();
	}

	public function dolevel_edit(){
		$post_param = $this->post_param();
		$data['service_type_id'] = $post_param['service_type_id'];
		$data['la_name'] = $post_param['la_name'];
		$data['la_score'] = $post_param['la_score'];
		$data['la_rank'] = $post_param['la_rank'];
		$data['la_desc'] = isset($post_param['la_desc'])?htmlspecialchars(UtfToString($post_param['la_desc'])):'';

		$data['la_voucher_price'] = $post_param['la_voucher_price'];
		$data['la_buy_price'] = $post_param['la_buy_price'];
		$data['la_ico'] = $post_param['la_ico'];
		$where['la_id'] = $post_param['la_id'];
		if($this->level_role->updates_global($data,$where)){
			jumpAjax('编辑成功！',U('admin/service/level_role'));
		}else{
			jumpAjax('编辑失败！',U('admin/service/role_edit',array('la_id'=>$where['la_id'])));
		}
	}

	public function role_add(){
		$data['title']='家178-经销产品编辑';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'service/role_add';
		$this->navpage = $this->navpage;
		$result = array();
		$result['service_type'] = $this->t_service_type->get_all();
		$this->pagedata = $result;
		parent::_initpage();
	}

	public function dorole_add(){
		$post_param = $this->post_param();

		$this->level_role->service_type_id = $post_param['service_type_id'];
		$this->level_role->la_name = $post_param['la_name'];
		$this->level_role->la_rank = $post_param['la_rank'];

		$this->level_role->la_score = $post_param['la_score'];
		$this->level_role->la_desc = isset($post_param['la_desc'])?htmlspecialchars(UtfToString($post_param['la_desc'])):'';
		$this->level_role->la_voucher_price = $post_param['la_voucher_price'];
		$this->level_role->la_buy_price = $post_param['la_buy_price'];
		$this->level_role->la_auth = '';
		$this->level_role->la_ico = $post_param['la_ico'];
		if($la_id = $this->level_role->insert()){
			jumpAjax('添加成功！',U('admin/service/level_role'));
		}else{
			jumpAjax('添加失败！',U('admin/service/role_add'));
		}

	}

	public function role_list(){
		$get_param = $this->get_param();
		$la_id = $get_param['la_id'];
		if(!isset($la_id)) return jumpAjax("非法操作！",U('admin/service/level_role'));
		$data['title']='家178-管理中心-服务商-模块编辑';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'service/role_list'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
	
		$result=array();

		$result['id'] = $la_id;
		$where['is_open'] = 1;
		$getValue = $this->t_service_action->getOrderArray('*',$where);
		$level_roleR = $this->level_role->get($la_id);

		if(!$level_roleR) return jumpAjax("数据不存在",U('admin/service/level_role'));
		$result['la_name'] = $level_roleR->la_name;
		if($level_roleR->la_auth){
			$la_auth = explode(',', $level_roleR->la_auth);
		}else{
		    $la_auth = array();
		}
		
		$result['list'] = $this->getValue($getValue,$la_auth);
		foreach ($result['list'] as $key => $value) {
			$result['list'][$key]['count'] = count($value['son']);
			
		}
		//echo "<pre>";var_dump($result);die;
		

		$this->pagedata = $result;//向页面加入加载数据
		parent::_initpage();//加载页面
	}

	public function doRoleEdit(){
		$post_param = $this->post_param();
		if($post_param['Threed'] && $post_param['la_id']){
			$data['la_auth'] = implode(',',$post_param['Threed']);
		}else{
			jumpAjax('请选择数据，在操作！',U('admin/service/role_list'));
		}

		$where['la_id'] = $post_param['la_id'];
		if($this->level_role->updates_global($data,$where)){
			jumpAjax('编辑成功！',U('admin/service/level_role'));
		}else{
			jumpAjax('编辑失败！',U('admin/service/role_edit',array('la_id'=>$where['la_id'])));
		}
	}

	public function doDel(){
		$ids = $this->input->post('ids');
		$idarr = explode(',',$ids);
		$temarr = array();
	
		foreach($idarr as $val){
			$result = $this->level_role->get($val);
			if($this->level_role->delete($val)){
				$temarr[] = $val;
			}
		}
		if($temarr){
			echo echojson('0',$temarr);
		}else{
			echo echojson('1',$temarr,'删除失败');
		}
	}

	
}
