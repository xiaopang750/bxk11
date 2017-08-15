<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/16 16:10:17 
 *       liuguangpingAuthor: liuguangping
 *        Email: liuguangpingtest@163.com

 */
class Scheme_recommend extends Admin_Controller
{	
	public $content;
	public $navpage;
	public $libs;
	public $limit;
	public $t_system;
	public $t_project_scheme;
	public $t_user;
	public $t_project_room;

	public function __construct(){
		parent::__construct();
		$this->content = 'content';
		$this->navpage = 'content/nav';
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->load->model('t_system_model');
		$this->t_system = $this->t_system_model;
		$this->load->model('t_project_scheme_model');
		$this->t_project_scheme = $this->t_project_scheme_model;
		
		$this->load->model('t_user_model');
		$this->t_user = $this->t_user_model;
		$this->load->model('t_project_room_model');
		$this->t_project_room = $this->t_project_room_model;

		$this->load->helper('content_fun');
		$this->load->helper('import_excel');
		//$this->load->helper('file');
		$this->limit = 10;
	}
	public function index(){
		$data['title']='家178-内容管理-标签列表';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/scheme_recommend';
		$this->navpage = $this->navpage ;
		$result = array();
		$strings = $this->t_system->get('scheme_recommend');
		if(!$strings){
			echo "<script>alert('请先配制项！');window.location.href='".site_url('admin/sys_recommend/add')."'</script>";exit;
		}
		$result['scheme_recommend'] = explode(',', $strings->sys_value);

		$this->pagedata = $result;
		parent::_initpage();
	}
	public function doscheme_recommend(){
		$post_result[] = $this->input->post('scheme_recommend-1');
		$post_result[] = $this->input->post('scheme_recommend-2');
		$post_result[] = $this->input->post('scheme_recommend-3');
		$post_result[] = $this->input->post('scheme_recommend-4');
		$post_result[] = $this->input->post('scheme_recommend-5');
		$strings = str_replace('。', ',', implode(',', $post_result));
		if(substr($strings, -1) == ','){
			$strings = substr($strings,0,-1);
		}

		$this->config->load('threed');
		$xmlsave = $this->config->item('xml');
		$xmlPath = $xmlsave['upload_path'].$xmlsave['recommend_xml'].'.xml';
		if(!file_exists($xmlPath)){
			echo "<script>alert('请先生成全局xml文件！');window.location.href='".site_url('admin/scheme_recommend/index')."'</script>";
		}
		if(count(array_unique($post_result)) != 5){
			echo "<script>alert('推荐不能重复！');window.location.href='".site_url('admin/scheme_recommend/index')."'</script>";
		}else{
			
			if(count($this->t_project_scheme->is_scheme($strings)) == 5){
				$error = '';
				foreach($post_result as $vals){
					loadLib('Roomlib_Class');
					$roomlib_bak = new Roomlib_Class();
					$this->roomlib_class = $roomlib_bak;
					$this->load->library('image_lib');
					$order_room_id = $this->roomlib_class->getSchemeFloorOneRoom($vals);
					$this->roomlib_class->flg = 1;
					//生成推荐xml
					if($order_room_id && $this->roomlib_class->xml3d($vals)){
						//参数方案，和 房间id
						if(!$this->image_lib->createFirstRoomThumb($vals,$order_room_id)){
							$error[] = $vals;
						}
					}else{
						$error[] = $vals;
					}
					
				}
				if($error){
					$string = implode(',',$error);
					$string = $string."推荐裁切图片失败";
				}else{
					$string = '';
				}
				if($this->t_system->updates_global(array('sys_value'=>$strings),array('sys_key'=>'scheme_recommend'))){
					
					echo "<script>alert('{$string}推荐成功！');window.location.href='".site_url('admin/scheme_recommend/index')."'</script>";
				}else{
					echo "<script>alert('{$string}推荐失败！');window.location.href='".site_url('admin/scheme_recommend/index')."'</script>";
				}
			}else{
				echo "<script>alert('你推荐项不正常,推荐失败！');window.location.href='".site_url('admin/scheme_recommend/index')."'</script>";
			}
			
		}
		
	}
	
	//首页3D推荐
	public function index3D(){
		$data['title']='家178-内容管理-首页3D推荐';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/index3D';
		$this->navpage = $this->navpage ;
		$result = array();
		$strings = $this->t_system->get('index_3D');
		if(!$strings){
			echo "<script>alert('请先配制项！');window.location.href='".site_url('admin/sys_recommend/add')."'</script>";exit;
		}
		$result['index_3D'] = $strings->sys_value;
	
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function doindex3D_recommend(){
		$post_result = $this->input->post('index3D');
		if(!is_numeric($post_result)){
			echo "<script>alert('你推荐项id不是数字,推荐失败！');window.location.href='".site_url('admin/scheme_recommend/index3D')."'</script>";exit;
		}
		$this->config->load('threed');
		$xmlsave = $this->config->item('xml');
		$xmlPath = $xmlsave['upload_path'].$xmlsave['recommend_xml'].'.xml';
		loadLib('Roomlib_Class');
		$roomlib_bak = new Roomlib_Class();
		$this->roomlib_class = $roomlib_bak;
		$this->load->library('image_lib');
		$order_room_id = $this->roomlib_class->getSchemeFloorOneRoom($post_result);
		$this->roomlib_class->flg = 1;
		//生成推荐xml
		if($order_room_id && $this->roomlib_class->xml3d($post_result)){
			//参数方案，和 房间id
			if(!$this->image_lib->createFirstRoomThumb($post_result,$order_room_id)){
				echo "<script>alert('你推荐项的缩略图生成失败,推荐失败！');window.location.href='".site_url('admin/scheme_recommend/index3D')."'</script>";exit;
			}else{
				if($this->t_system->updates_global(array('sys_value'=>$post_result),array('sys_key'=>'index_3D'))){
					echo "<script>alert('推荐成功！');window.location.href='".site_url('admin/scheme_recommend/index3D')."'</script>";exit;
				}else{
					echo "<script>alert('推荐失败！');window.location.href='".site_url('admin/scheme_recommend/index3D')."'</script>";exit;
				}
				
				
			}
		}else{
			echo "<script>alert('你推荐项生成xml失败,可能是数据错误,推荐失败！');window.location.href='".site_url('admin/scheme_recommend/index3D')."'</script>";exit;
		}
	}
	//案例频道首页推荐设计师
	public function scheme_designer(){
		$data['title']='家178-内容管理-标签列表';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/scheme_designer';
		$this->navpage = $this->navpage ;
		$result = array();
		$strings = $this->t_system->get('designer_recommend');
		if(!$strings){
			echo "<script>alert('请先配制项！');window.location.href='".site_url('admin/sys_recommend/add')."'</script>";exit;
		}
		$result['des_rec_title'] = $this->t_system->get('des_rec_title')->sys_value;
	
		$result['designer_recommend'] = explode(',', $strings->sys_value);

		$this->pagedata = $result;
		parent::_initpage();
	}
	
	//案例频道首页推荐设计师
	public function doscheme_designer(){
		if(!$this->input->post('scheme_title-1')){
				echo "<script>alert('首项推荐标题不能为空！');window.location.href='".site_url('admin/scheme_recommend/scheme_designer')."'</script>";
		}
		$post_result[] = $this->input->post('scheme_recommend-1');
		$post_result[] = $this->input->post('scheme_recommend-2');
		$post_result[] = $this->input->post('scheme_recommend-3');
		$post_result[] = $this->input->post('scheme_recommend-4');
		$post_result[] = $this->input->post('scheme_recommend-5');
		$post_result[] = $this->input->post('scheme_recommend-6');
		$post_result[] = $this->input->post('scheme_recommend-7');
		
		$strings = str_replace('。', ',', implode(',', $post_result));
		if(substr($strings, -1) == ','){
			$strings = substr($strings,0,-1);
		}

		//echo "<pre>";var_dump($post_result);die;
		if(count(array_unique($post_result)) != 7){
			echo "<script>alert('推荐不能重复！');window.location.href='".site_url('admin/scheme_recommend/scheme_designer')."'</script>";
		}else{
			
			if(count($this->t_user->is_designer($strings)) == 7){
				$des_rec_title = $this->input->post('scheme_title-1');
				
				if($this->t_system->updates_global(array('sys_value'=>$strings),array('sys_key'=>'designer_recommend'))&&$this->t_system->updates_global(array('sys_value'=>$des_rec_title),array('sys_key'=>'des_rec_title'))){
					echo "<script>alert('推荐成功！');window.location.href='".site_url('admin/scheme_recommend/scheme_designer')."'</script>";
				}else{
					echo "<script>alert('推荐失败！');window.location.href='".site_url('admin/scheme_recommend/scheme_designer')."'</script>";
				}
			}else{
	
				echo "<script>alert('你推荐项不正常或不是设计师,推荐失败！');window.location.href='".site_url('admin/scheme_recommend/scheme_designer')."'</script>";
			}
			
		}
		
	}
	
	//案例频道首页方案下载排行榜
	public function scheme_downs(){
		$data['title']='家178-内容管理-标签列表';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/scheme_downs';
		$this->navpage = $this->navpage ;
		$result = array();
		$strings = $this->t_system->get('downs_s_recommend');
		if(!$strings){
			echo "<script>alert('请先配制项！');window.location.href='".site_url('admin/sys_recommend/add')."'</script>";exit;
		}
		$result['scheme_recommend'] = explode(',', $strings->sys_value);
	
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	//案例频道首页推荐设计师
	public function doscheme_downs(){
		$post_result[] = $this->input->post('scheme_recommend-1');
		$post_result[] = $this->input->post('scheme_recommend-2');
		$post_result[] = $this->input->post('scheme_recommend-3');
		$post_result[] = $this->input->post('scheme_recommend-4');
		$post_result[] = $this->input->post('scheme_recommend-5');
		$post_result[] = $this->input->post('scheme_recommend-6');
		$post_result[] = $this->input->post('scheme_recommend-7');
		$post_result[] = $this->input->post('scheme_recommend-8');
		$post_result[] = $this->input->post('scheme_recommend-9');
		$post_result[] = $this->input->post('scheme_recommend-10');
		$strings = str_replace('。', ',', implode(',', $post_result));
		if(substr($strings, -1) == ','){
			$strings = substr($strings,0,-1);
		}
		//echo $strings;die;
		if(count(array_unique($post_result)) != 10){
			echo "<script>alert('推荐不能重复！');window.location.href='".site_url('admin/scheme_recommend/scheme_downs')."'</script>";
		}else{
			
			if(count($this->t_project_scheme->is_scheme($strings)) == 10){

				if($this->t_system->updates_global(array('sys_value'=>$strings),array('sys_key'=>'downs_s_recommend'))){
					echo "<script>alert('推荐成功！');window.location.href='".site_url('admin/scheme_recommend/scheme_downs')."'</script>";
				}else{
					echo "<script>alert('推荐失败！');window.location.href='".site_url('admin/scheme_recommend/scheme_downs')."'</script>";
				}
			}else{
				echo "<script>alert('你推荐项不正常,推荐失败！');window.location.href='".site_url('admin/scheme_recommend/scheme_downs')."'</script>";
			}
				
		}
	
	}
	
	//案例频道首页DIY组合家装
	public function scheme_diy(){
		$data['title']='家178-内容管理-标签列表';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/scheme_diy';
		$this->navpage = $this->navpage ;
		$result = array();
		$strings = $this->t_system->get('diy_s_recommend');
		if(!$strings){
			echo "<script>alert('请先配制项！');window.location.href='".site_url('admin/sys_recommend/add')."'</script>";exit;
		}
		$result['scheme_recommend'] = explode(',', $strings->sys_value);

		$this->pagedata = $result;
		parent::_initpage();
	}
	
	//案例频道首页DIY组合家装
	public function doscheme_diy(){
		$post_result[] = $this->input->post('scheme_recommend-1');
		$post_result[] = $this->input->post('scheme_recommend-2');
		$post_result[] = $this->input->post('scheme_recommend-3');
		$post_result[] = $this->input->post('scheme_recommend-4');
		$post_result[] = $this->input->post('scheme_recommend-5');
		$post_result[] = $this->input->post('scheme_recommend-6');
		$strings = str_replace('。', ',', implode(',', $post_result));
		if(substr($strings, -1) == ','){
			$strings = substr($strings,0,-1);
		}

		if(count(array_unique($post_result)) != 6){
			echo "<script>alert('推荐不能重复！');window.location.href='".site_url('admin/scheme_recommend/scheme_diy')."'</script>";
		}else{
				//echo $strings;die;
			if(count($this->t_project_scheme->is_scheme($strings,'1')) == 6){
				if($this->t_system->updates_global(array('sys_value'=>$strings),array('sys_key'=>'diy_s_recommend'))){
					echo "<script>alert('推荐成功！');window.location.href='".site_url('admin/scheme_recommend/scheme_diy')."'</script>";
				}else{
					echo "<script>alert('推荐失败！');window.location.href='".site_url('admin/scheme_recommend/scheme_diy')."'</script>";
				}
			}else{
				echo $strings;die;
				echo "<script>alert('你推荐项不正常,推荐失败！');window.location.href='".site_url('admin/scheme_recommend/scheme_diy')."'</script>";
			}
				
		}
	}
	
	
	//案例频道首页推荐样板间
	public function scheme_room(){
		$data['title']='家178-内容管理-标签列表';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/scheme_room';
		$this->navpage = $this->navpage ;
		$result = array();
		$strings = $this->t_system->get('room_recomend');
		if(!$strings){
			echo "<script>alert('请先配制项！');window.location.href='".site_url('admin/sys_recommend/add')."'</script>";exit;
		}
	
		$result['scheme_recommend'] = explode(',', $strings->sys_value);

		$this->pagedata = $result;
		parent::_initpage();
	}
	

	public function doscheme_room(){
		$post_result[] = $this->input->post('scheme_recommend-1');
		$post_result[] = $this->input->post('scheme_recommend-2');
		$post_result[] = $this->input->post('scheme_recommend-3');
		$post_result[] = $this->input->post('scheme_recommend-4');
		$post_result[] = $this->input->post('scheme_recommend-5');
		$post_result[] = $this->input->post('scheme_recommend-6');
		$strings = str_replace('。', ',', implode(',', $post_result));
		if(substr($strings, -1) == ','){
			$strings = substr($strings,0,-1);
		}
		if(count(array_unique($post_result)) != 6){
			echo "<script>alert('推荐不能重复！');window.location.href='".site_url('admin/scheme_recommend/scheme_room')."'</script>";
		}else{
	
			if(count($this->t_project_room->is_rooms($strings)) == 6){
				if($this->t_system->updates_global(array('sys_value'=>$strings),array('sys_key'=>'room_recomend'))){
					echo "<script>alert('推荐成功！');window.location.href='".site_url('admin/scheme_recommend/scheme_room')."'</script>";
				}else{
					echo "<script>alert('推荐失败！');window.location.href='".site_url('admin/scheme_recommend/scheme_room')."'</script>";
				}
			}else{
				echo "<script>alert('你推荐项不正常,推荐失败！');window.location.href='".site_url('admin/scheme_recommend/scheme_room')."'</script>";
			}
	
		}
	}
	
	public function scheme_tag(){
		$data['title']='家178-内容管理-标签列表';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/scheme_tag';
		$this->navpage = $this->navpage ;
		$result = array();
		$strings = $this->t_system->get('scheme_tag_recomend');
		if(!$strings){
			echo "<script>alert('请先配制项！');window.location.href='".site_url('admin/sys_recommend/add')."'</script>";exit;
		}
		$exp = explode(',', $strings->sys_value);
		if($strings->sys_value){
			foreach($exp as $va){
				$expx = explode('|', $va);
				$input[] =  $expx['1'];
			}
			if(isset($input)){
				$input = implode(',',$input);
			}else{
				$input = '';
			}
		}else{
			$input = '';
		}
		
		$result['scheme_tag'] = $input;
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function doscheme_tag(){
		$post_result = str_replace('，', ',', trim($this->input->post('scheme_tag')));
		$post_result = explode(',',$post_result);
		$post_result =array_unique($post_result);
		if(count($post_result) >= 10){
			echo "<script>alert('推荐太多只能推荐10个以内！');window.location.href='".site_url('admin/scheme_recommend/scheme_tag')."'</script>";
		}else{
			
			$this->config->load('uploads');
			$exp = $this->config->item('recommend');
			$recommendtag = explode(',',$exp['tag']);
			$this->load->model('t_system_class_model');
			$field = 's_class_name,s_class_id';
			$resul = $this->t_system_class_model->getCategoryByTags($recommendtag);
			foreach($resul as $v){
				$newpost[$v['tag_name']] = $v['tag_id'];
			}
			$posts = array();
			$error = '';
		
			$tag_name = twotoone_array($resul, 'tag_name');
			foreach ($post_result as $key=>$name){
				if(isset($newpost[trim($name)])){
					$posts[] = $newpost[trim($name)].'|'.trim($name);
				}
				
			}
	
			if($error){
				$error = implode(',',$error);
			}
			//$strings = implode(',', $posts);
			$strings = str_replace('。', ',', implode(',', $posts));
			if(substr($strings, -1) == ','){
				$strings = substr($strings,0,-1);
			}
			//echo $strings;die;
			if($this->t_system->updates_global(array('sys_value'=>$strings),array('sys_key'=>'scheme_tag_recomend'))){
				if($error){
						echo "<script>alert('{$error}不是该类下的标签,其余推荐失败!！');window.location.href='".site_url('admin/scheme_recommend/scheme_tag')."'</script>";
				}else{
						echo "<script>alert('推荐成功!！');window.location.href='".site_url('admin/scheme_recommend/scheme_tag')."'</script>";
				}
		
			}else{
				echo "<script>alert('推荐失败！');window.location.href='".site_url('admin/scheme_recommend/scheme_tag')."'</script>";
			}
		}
	}
	
	
	
	
	
}

?>
