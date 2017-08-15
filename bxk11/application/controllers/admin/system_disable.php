<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/16 16:10:17 
 *       liuguangpingAuthor: liuguangping
 *        Email: liuguangpingtest@163.com

 */
class System_disable extends Admin_Controller
{	
	public $content;
	public $navpage;
	public $system_disable;
	public $type_config;
	public $t_system;
	public $libs;
	public $limit;
	
	public function __construct(){
		parent::__construct();
		$this->content = 'content';
		$this->navpage = 'content/nav';
		$this->load->model('t_system_disable_model');
		$this->system_disable = $this->t_system_disable_model;
		$this->config->load('type');
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->type_config = $this->config->item('system_disable');

		$this->load->model('t_system_model');
		$this->t_system = $this->t_system_model;
		$this->limit = 20;
	}

	//系统禁止列表
	public function index(){
	
		$data['title']='家178-管理中心-系统禁止列表';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/system_disable';
		$this->navpage = $this->navpage;
		$result = array();
		$result['type_config'] = $this->type_config['type'];
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
	
		$disable_status = $this->input->get('disable_status');
		$disable_content = $this->input->get('disable_content');

		//type 1所有  不是1 条件
		$total_rows = count($this->system_disable->disable_search($disable_status,$disable_content,'','',1));

		//$total_rows = $this->blog_model->count_all();
		
		$office =  ($page-1)*($this->limit);
		
		//$result['re'] = $this->blog_model->get_list($this->limit,$office,'content_id','DESC');
		$result['disable_status'] = $disable_status;
		$result['disable_content'] = $disable_content;
	
	
		$result['re'] = $this->system_disable->disable_search($disable_status,$disable_content,$office,$this->limit,2);
		$this->libs->base_url = site_url('admin/system_disable/index').'?search=0&disable_status='.$disable_status."&disable_content=".$disable_content;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$this->pagedata = $result;
/* 		echo "<pre>";
		var_dump($result);die; */
		parent::_initpage();
	}
	
	//系统禁止列表
	public function add(){
		$data['title']='家178-管理中心-系统禁止添加';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/system_disable_add';
		$this->navpage = $this->navpage;
		$result = array();

		$result['type_config'] = $this->type_config['type'];
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function dodisable_add(){
		$sdisable_type = $this->input->post('sdisable_type');
		$sdisable_value = $this->input->post('sdisable_value');
		if(!$sdisable_value){
			echo "<script>alert(' 你填写的内容错误！');window.location.href ='".site_url('admin/system_disable/add')."'</script>";
		}else{
			$this->system_disable->sdisable_type = $sdisable_type;
			$content = str_replace('，', ',', $sdisable_value);
		
			$content_arr = explode(',',$content);
			$susscue = '';
			$error = '';
			$replace = '';
			$username = '';
		
			
			foreach ($content_arr as $value){
				$this->system_disable->sdisable_value = trim($value);
				$where = array('sdisable_type'=>$sdisable_type,'sdisable_value'=>$this->system_disable->sdisable_value);
				$field = 'sdisable_id';
				if($this->system_disable->get_disable($field,$where)){
					$replace[]= $value;
					continue;
				}
			
				if(!$this->disable_check($sdisable_type,$value)){
					$username[] = $value;
					continue;
				}
				
				if($this->system_disable->insert()){
					$susscue[] = $value;
				}else{
					$error[] = $value;
				}
			}


			if($sdisable_type == 4){
				if($username){
					$username = implode(',',$username);
					echo "<script>alert('".$username.",无该用户,其余添加成功！');window.location.href ='".site_url('admin/system_disable/index')."'</script>";
				}else{
			
				}
			}
			
			
			if(empty($error)){
			
				if($replace){
					$replace = implode(',',$replace);
					echo "<script>alert('".$replace.",库中己有未添加,其余添加成功！');window.location.href ='".site_url('admin/system_disable/index')."'</script>";
				}else{
					echo "<script>alert('添加成功！');window.location.href ='".site_url('admin/system_disable/index')."'</script>";
				}

			}else{
				$error = implode(',',$error);
				if($replace){
					$replace = implode(',',$replace);
					echo "<script>alert('".$replace.",库中己有,未添加,".$error."添加失败！');window.location.href ='".site_url('admin/system_disable/add')."'</script>";
				}else{
					echo "<script>alert('".$error."添加失败！');window.location.href ='".site_url('admin/system_disable/add')."'</script>";
				}
				
				
				
			}
	
		}
	}
	public function disable_check($type,$check_value){
		switch ($type){
			case 4:
				$this->load->model('t_user_model');
				$result = $this->t_user_model->get($check_value);
				if($result){
					return $result->user_nickname;
				}else{
					return false;
				}
			break;
			default:
				return true;
				
		
		}
	}
	
	public function dodel(){
		$ids = $this->input->post('ids');
		$idarr = explode(',',$ids);
		$temarr = array();
	
		foreach($idarr as $val){
				
			if($this->system_disable->delete($val)){
				$temarr[] = $val;
			}
		}
		if($temarr){
			echo json_encode($temarr);
		}else{
			echo "0";
		}
	}
	
	public function edit(){
		$sdisable_id = $this->input->get('sdisable_id',true);

		$data['title']='家178-管理中心-系统禁止编辑';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/system_disable_edit';
		$this->navpage = $this->navpage;
		$result = array();
		
		$result['type_config'] = $this->type_config['type'];
		
		$result['re'] = $this->system_disable->get($sdisable_id);
		
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function doedit(){
		$sdisable_id = $this->input->post('sdisable_id');
		$sdisable_type = $this->input->post('sdisable_type');
		$sdisable_value = $this->input->post('sdisable_value');
		if(!$sdisable_value){
			echo "<script>alert(' 你填写的内容错误！');window.location.href ='".site_url('admin/system_disable/add')."'</script>";
		}else{
			$this->system_disable->sdisable_type = $sdisable_type;
			if($sdisable_type == 4){
				if($this->disable_check($sdisable_type,$sdisable_value)){
					$this->system_disable->sdisable_value = trim($sdisable_value);
					$where = array('sdisable_type'=>$sdisable_type,'sdisable_value'=>$this->system_disable->sdisable_value);
					$field = 'sdisable_id';
					if($this->system_disable->get_disable($field,$where)){
						echo "<script>alert('你编辑该类型下以有不能编辑！编辑失败');window.location.href ='".site_url('admin/system_disable/edit')."?sdisable_id=$sdisable_id'</script>";
					}else{
						$wheres = array('sdisable_id'=>$sdisable_id);
						$data = array('sdisable_type'=>$sdisable_type,'sdisable_value'=>$sdisable_value);
						if($this->system_disable->updates_global($data,$wheres)){
							echo "<script>alert('编辑成功');window.location.href ='".site_url('admin/system_disable/index')."'</script>";
						}else{
							echo "<script>alert('编辑失败');window.location.href ='".site_url('admin/system_disable/edit')."?sdisable_id=$sdisable_id'</script>";
						}
					}
				}else{
					echo "<script>alert('你编辑的用户id不存在！编辑失败');window.location.href ='".site_url('admin/system_disable/edit')."?sdisable_id=$sdisable_id'</script>";
				}
			}else{
				$this->system_disable->sdisable_value = trim($sdisable_value);
				$where = array('sdisable_type'=>$sdisable_type,'sdisable_value'=>$this->system_disable->sdisable_value);
				$field = 'sdisable_id';
				if($this->system_disable->get_disable($field,$where)){
					echo "<script>alert('你编辑该类型下以有不能编辑！编辑失败');window.location.href ='".site_url('admin/system_disable/edit')."?sdisable_id=$sdisable_id'</script>";
				}else{
					$wheres = array('sdisable_id'=>$sdisable_id);
					$data = array('sdisable_type'=>$sdisable_type,'sdisable_value'=>$sdisable_value);
					if($this->system_disable->updates_global($data,$wheres)){
						echo "<script>alert('编辑成功');window.location.href ='".site_url('admin/system_disable/index')."'</script>";
					}else{
						echo "<script>alert('编辑失败');window.location.href ='".site_url('admin/system_disable/edit')."?sdisable_id=$sdisable_id'</script>";
					}
				}
			}
			
		}
	}
	public function import_disable(){
		
		$data['title']='家178-管理中心-系统禁止编辑';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/import_disable';
		$this->navpage = $this->navpage;
		$result = array();
		
		$result['type_config'] = $this->type_config['type'];
		
		
		$this->pagedata = $result;
		parent::_initpage();

	}
	
	public function doimport(){
		//上传图片文件
		$this->config->load('uploads');
		$config = $this->config->item('importtt');
		$this->load->library('upload');
		$this->upload->initialize($config);
		
		if($this->upload->do_upload()){
			$data = $this->upload->data();
			$tmp_src = $data['full_path'];
			$content = read_dary($tmp_src);
			$exites = '';
			$error = '';
			$str = '';
			if($content){
				$sdisable_type = $this->input->post('sdisable_type');
				foreach ($content as $value){
					if($sdisable_type == 4){
						if($this->disable_check($sdisable_type,$value)){
							$where = array('sdisable_type'=>$sdisable_type,'sdisable_value'=>trim($value));
							$field = 'sdisable_id';
							if(!$this->system_disable->get_disable($field,$where)){
								$this->system_disable->sdisable_type = $sdisable_type;
								$this->system_disable->sdisable_value = trim($value);
								
								if($this->system_disable->insert()){
									continue;
								}else{
									$error .= ','.$value;
									continue;
								}
							}
						}else{
							$exites .= ','.$value;
							continue;
						}
					}else{
						$where = array('sdisable_type'=>$sdisable_type,'sdisable_value'=>trim($value));
						$field = 'sdisable_id';
						if(!$this->system_disable->get_disable($field,$where)){
							$this->system_disable->sdisable_type = $sdisable_type;
							$this->system_disable->sdisable_value = trim($value);
							if($this->system_disable->insert()){
								continue;
							}else{
								$error .= ','.$value;
								continue;
							}
						}
					}
				}
				@unlink($tmp_src);
				if($exites!=''){
					$str .= $exites.'用户不存在 ';
					

				}
				if($error!=''){
					$str .= $error.'数据导入失败 ';
				}
			
				if($str){
					if($error){
						echo "<script>alert('{$str}数据导入失败，请检查后在上传！');window.location.href='".site_url('admin/system_disable/import_disable')."'</script>";
					}else{
						echo "<script>alert('部分数据导入失败，请检查后在上传！');window.location.href='".site_url('admin/system_disable/import_disable')."'</script>";
					}
					
				}else{
					echo "<script>alert('数据导入成功！');window.location.href='".site_url('admin/system_disable/index')."'</script>";
				}
	
			}else{
				@unlink($tmp_src);
				echo "<script>alert('数据读取失败，请检查后在上传！');window.location.href='".site_url('admin/system_disable/import_disable')."'</script>";
			}
		
		}else{
				$error = $this->upload->display_errors();
				@unlink($tmp_src);
				echo "<script>alert('上传失败，请检查后在上传！{$error}');window.location.href='".site_url('admin/system_disable/import_disable')."'</script>";
		}
	}
	//敏感词替换
	public function replace(){
	
		$data['title']='家178-管理中心-敏感词替换';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/system_disable_replace';
		$this->navpage = $this->navpage;
		$result = array();
	
		
		$strings = $this->t_system->get('replace_word');
		//echo "<pre>";var_dump($strings);die;
		if(!$strings){
			echo "<script>alert('请先配制项！');window.location.href='".site_url('admin/sys_recommend/add')."'</script>";exit;
		}
		
		$result['re'] = $strings;
		$this->pagedata = $result;
		parent::_initpage();
	
	}
	
	public function dodisable_replace(){
		$sys_key = $this->input->post('sys_key',true);
		$sys_value = $this->input->post('sys_value',true);

		if($this->t_system->updates_global(array('sys_value'=>$sys_value),array('sys_key'=>$sys_key))){
			echo "<script>alert('成功！');window.location.href='".site_url('admin/system_disable/replace')."'</script>";
		}else{
			echo "<script>alert('失败！');window.location.href='".site_url('admin/system_disable/replace')."'</script>";
		}
	
	}
}
