<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        dinghaochenAuthor: ��껳�
 *        Email: dotnet010@gmail.com

 */
class Sys_recommend extends Admin_Controller
{	
	public $content;
	public $navpage;
	public $libs;
	public $t_system_class;
	public $limit;
	public $tag_model;
	public $t_system;
	public $t_service_info;
	public $t_user_notice;
	public function __construct(){
		parent::__construct();
		$this->content = 'index';
		$this->navpage = 'nav';
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->load->model('t_system_model');
		$this->load->model('t_system_class_model');
		$this->t_system = $this->t_system_model;
		$this->load->model('t_tag_model');
		$this->tag_model = $this->t_tag_model;
		$this->t_system_class = $this->t_system_class_model;
		
		//TODO 通知后期改
		$this->load->model('t_service_info_model');
		$this->t_service_info = $this->t_service_info_model;
		$this->load->model('t_user_notice_model');
		$this->t_user_notice = $this->t_user_notice_model;
		
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');
		$this->limit = 10;
	}
	public function index(){
		$data['title']='家178-管理中心-系统推荐';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'sys/recommend';
		$this->navpage = $this->navpage ;
		$sys_key = trim($this->input->get('sys_key'));
		$total_rows =  $this->t_system->count_search('sys_key',$sys_key);
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;

		$offset =  ($page-1)*($this->limit);
		
		$result['re'] = $this->t_system->search('sys_key', $sys_key, $this->limit, $offset, 'sys_key', 'DESC');
		$this->libs->base_url = site_url('admin/sys_recommend/index').'?search=0&sys_key='.$sys_key;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$result['sys_key'] = $sys_key;
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function add(){
		$data['title']='家178-管理中心-添加推荐项';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'sys/recommend_add';
		$this->navpage = $this->navpage ;
		$result = array();
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function add_edit(){
		$data['title']='家178-内容管理-标签';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'sys/sys_add_edit';
		$this->navpage = $this->navpage;
		$sys_key = strip_tags($this->input->get('sys_key'));
		$result['re'] = $this->t_system->get($sys_key);
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function dosys_recommend(){
		$sys_key = $this->input->post('sys_key',true);
		$data['sys_key_cn'] = $this->input->post('sys_key_cn',true);
		$data['sys_group'] = $this->input->post('sys_group',true);
		if($sys_key == 'baidu_key'){
			$data['sys_value'] = $this->input->post('sys_value',true);
		}
		$where = array('sys_key'=>$sys_key);
		if($this->t_system->updates_global($data,$where)){
			echo "<script>alert('编辑成功！');window.location.href='".site_url('admin/sys_recommend/index')."'</script>";
		}else{
			echo "<script>alert('添加失败！');window.location.href='".site_url('admin/sys_recommend/add_edit')."?sys_key={$sys_key}'</script>";
		}
	}
	
	public function dodel(){
		$ids = $this->input->post('ids');
		$idarr = explode(',',$ids);
		$temarr = array();

		foreach($idarr as $val){
			
			if($this->t_system->delete($val)){
				$temarr[] = $val;
			}
		}
		if($temarr){
			echo json_encode($temarr);
		}else{
			echo "0";
		}
	}
	
	public function doiskey(){
		$sys_key = $this->input->post('sys_key',true);
		if($this->t_system->get($sys_key)){
			echo "0";
		}else{
			echo "1";
		}
	}
	
	public function dorecommend_add(){
		$sys_key = $this->input->post('sys_key',true);
		
		$sys_key_cn = $this->input->post('sys_key_cn',true);
		$sys_group = $this->input->post('sys_group',true);
		if(trim($sys_key)){
			if($this->t_system->get($sys_key)){
				echo "<script>alert('设置项以占用，不能再添加！');window.location.href='".site_url('admin/sys_recommend/add')."'</script>";
			}else{
				$this->t_system->sys_key = $sys_key;
				$this->t_system->sys_key_cn = $sys_key_cn;
				$this->t_system->sys_group = $sys_group;
				if($this->t_system->inserts()){
					echo "<script>alert('添加成功！');window.location.href='".site_url('admin/sys_recommend/index')."'</script>";
				}else{
					echo "<script>alert('添加失败！');window.location.href='".site_url('admin/sys_recommend/add')."'</script>";
				}
			}
		}else{
			echo "<script>alert('设置项不能为空！');window.location.href='".site_url('admin/sys_recommend/add')."'</script>";
		}
	}
	
	public function syncSet(){
		$data['title']='家178-内容管理-第三方同步管理';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'sys/syncSet';
		$this->navpage = $this->navpage;
		$strings = $this->t_system->get('sync');
		$result['sync_key'] = $strings->sys_key;
		if(!$strings){
			echo "<script>alert('请先配制项！');window.location.href='".site_url('admin/sys_recommend/add')."'</script>";exit;
		}
		$strings = unserialize($strings->sys_value);

		$result['re'] = $strings;
		
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function dosyncSet(){		
		$sys_key = $this->input->post('sys_key',true);
		$results = $this->input->post();

		$result = array(
				'sina'=>array(
						'open'=>isset($results['open']['0'])?$results['open']['0']:0,
						'key'=>$results['sina_wb_akey'],
						'secret'=>$results['sina_wb_skey']
						),
				'qq'=>array(
						'open'=>isset($results['open']['1'])?$results['open']['1']:0,
						'key'=>$results['qzone_key'],
						'secret'=>$results['qzone_secret']
						),
				'renren'=>array(
						'open'=>isset($results['open']['2'])?$results['open']['2']:0,
						'key'=>$results['renren_key'],
						'secret'=>$results['renren_secret']
				)
			); 
		$saveResult = serialize($result);
		if($this->t_system->updates_global(array('sys_value'=>$saveResult),array('sys_key'=>$sys_key))){
			echo "<script>alert('成功！');window.location.href='".site_url('admin/sys_recommend/syncSet')."'</script>";
		}else{
			echo "<script>alert('失败！');window.location.href='".site_url('admin/sys_recommend/syncSet')."'</script>";
		}
		
	}
	
	//站内通知
	public function notice(){
		$data['title']='家178-内容管理-站内通知';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'sys/notice';
		$this->navpage = $this->navpage;
		$strings = $this->t_system->get('sync');
		$result['sync_key'] = $strings->sys_key;
		if(!$strings){
			echo "<script>alert('请先配制项！');window.location.href='".site_url('admin/sys_recommend/add')."'</script>";exit;
		}
		$strings = unserialize($strings->sys_value);
		
		$result['re'] = $strings;
		
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function donotice(){
		
		$where = "service_status < 10";
		$result = $this->t_service_info->get_tag('service_id,service_name',$where);

		//$this->t_user_notice->notice_expiry = date('Y-m-d H:i:s',time()+3600*2);
		$this->t_user_notice->notice_title = $this->input->post('notice_title');
		$this->t_user_notice->notice_content = $this->input->post('notice_content');
		$this->t_user_notice->notice_type = 0;
		$successA = array();
		$errorA = array();
		foreach ($result as $value){
			$this->t_user_notice->service_id = $value['service_id'];
			if($notice_id = $this->t_user_notice->insert()){
				$successA[] = $value['service_name'];
			}else{
				$errorA[] = $value['service_name'];
			}
		}
		$url = site_url('admin/sys_recommend/notice');
		if($errorA){
			$errorS = implode(',', $errorA);
			jumpAjax($errorS."插入失败！其余插入成功！", $url);
		}else{
			jumpAjax("插入成功！", $url);
		}
	}
}

?>