<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        dinghaochenAuthor: ��껳�
 *        Email: dotnet010@gmail.com

 */
class Blog extends Admin_Controller
{	
	public $content;
	public $navpage;
	public $libs;
	public $content_model;
	public $limit;
	public function __construct(){
		parent::__construct();
		$this->content = 'content';
		$this->navpage = 'content/nav';
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->load->model('t_content_model');
		$this->blog_model = $this->t_content_model;
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');
		$this->limit = 10;
	}
	public function index()
	{
		
		$data['title']='家178-内容管理-博文';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/blog';
		$this->navpage = $this->navpage ;
		
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
	
		$content_status = $this->input->get('content_status');
		$content_type = $this->input->get('content_type');
		$a_start = $this->input->get('a_start');
		$a_end = $this->input->get('a_end');
		$user_name = trim($this->input->get('user_name'));
		$content_title = trim($this->input->get('content_title'));

		if($a_start >$a_end){
			$a_start ="";
			$a_end = '';
		}
		$total_rows = count($this->blog_model->admin_search_count($content_status,$content_type,$a_start,$a_end,$user_name,$content_title));

		//$total_rows = $this->blog_model->count_all();
		
		$office =  ($page-1)*($this->limit);
		
		//$result['re'] = $this->blog_model->get_list($this->limit,$office,'content_id','DESC');
		$result['content_status'] = $content_status;
		$result['content_type'] = $content_type;
		$result['a_start'] = $a_start;
		$result['a_end'] = $a_end;
		$result['user_name'] = $user_name;
		$result['content_title'] = $content_title;
		
		$result['re'] = $this->blog_model->admin_search($content_status,$content_type,$a_start,$a_end,$user_name,$content_title,$office,$this->limit);
		$this->libs->base_url = site_url('admin/blog/index').'?search=0&content_status='.$content_status."&content_type=".$content_type."&a_start=".$a_start."&a_end=".$a_end."&user_name=".$user_name."&content_title=".$content_title;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$this->pagedata = $result;
		/* var_dump($result);die; */
		parent::_initpage();
	}
	public function dostatus(){
		$status = $this->input->post('status',true);
		$question_id = $this->input->post('question_id',true);
		$data = array('content_status'=>$status);
		$where = array('content_id'=>$question_id);
		if($this->blog_model->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}
}

?>