<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        dinghaochenAuthor: ��껳�
 *        Email: dotnet010@gmail.com

 */
class S_class_tag extends Admin_Controller
{	
	public $content;
	public $navpage;
	public $s_class_tag_model;
	public $limit;
	public $libs;
	public function __construct(){
		parent::__construct();
		$this->content = '';
		$this->navpage = 'content/nav';
		$this->load->model('t_s_class_tag_model');
		$this->s_class_tag_model = $this->t_s_class_tag_model;
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->load->helper('content_fun');
		$this->limit = 10;
	}
	public function index()
	{
		
		$data['title']='家178-内容管理-关联标签';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/s_class_tag';
		$this->navpage = $this->navpage ;
		$s_class_id = $this->input->get('s_class_id');	
		$order_field = 's_c_tag_id';
		$order_type = 'DESC';
		$select_filed = '*';
		$where = array('s_class_id'=>$s_class_id);
	
		$page = $this->input->get('current_page');
	
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		
		$office =  ($page-1)*($this->limit);

		$total_rows = $this->s_class_tag_model->count_one($select_filed,$where);
		$result['re'] = $this->s_class_tag_model->get_page($select_filed,$order_field,$order_type,$where,$this->limit,$office);
	
		$this->libs->base_url = site_url('admin/s_class_tag/index').'?s_class_id='.$s_class_id.'&search=0';
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$result['s_class_id'] = $s_class_id;
		$result['num'] = $total_rows;
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function dodel(){
		$ids = $this->input->post('ids');
		$idarr = explode(',',$ids);
		$temarr = array();
		foreach($idarr as $val){
			if($this->s_class_tag_model->delete($val)){
				$temarr[] = $val;
			}
		}
		if($temarr){
			echo json_encode($temarr);
		}else{
			echo "0";
		}
	}
}

?>