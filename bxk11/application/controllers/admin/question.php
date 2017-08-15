<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        dinghaochenAuthor: ��껳�
 *        Email: dotnet010@gmail.com

 */
class Question extends Admin_Controller
{	
	public $content;
	public $navpage;
	public $libs;
	public $question_model;
	public $limit;
	public function __construct(){
		parent::__construct();
		$this->content = 'content';
		$this->navpage = 'content/nav';
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->load->model('t_questions_model');
		$this->question_model = $this->t_questions_model;
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');
		$this->limit = 10;
	}
	public function index()
	{
		
		$data['title']='家178-内容管理-问题';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/question';
		$this->navpage = $this->navpage ;
		
		$question_status = $this->input->get('question_status');

		$a_start = $this->input->get('a_start');
		$a_end = $this->input->get('a_end');
		$user_name = trim($this->input->get('user_name'));
		$question_title = trim($this->input->get('question_title'));
		
		if($a_start >$a_end){
			$a_start ="";
			$a_end = '';
		}
		
		
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		
		//$total_rows = $this->question_model->count_all();
		$total_rows = count($this->question_model->admin_search_count($question_status,$a_start,$a_end,$user_name,$question_title));
		
		$office =  ($page-1)*($this->limit);
		
		$result['question_status'] = $question_status;
		$result['a_start'] = $a_start;
		$result['a_end'] = $a_end;
		$result['user_name'] = $user_name;
		$result['question_title'] = $question_title;
		
		//$result['re'] = $this->question_model->get_list($this->limit,$office,'question_id','DESC');
		$result['re'] = $this->question_model->admin_search($question_status,$a_start,$a_end,$user_name,$question_title,$office,$this->limit);
		$this->libs->base_url = site_url('admin/question/index').'?search=0&question_status='.$question_status."&a_start=".$a_start."&a_end=".$a_end."&user_name=".$user_name."&question_title=".$question_title;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$this->pagedata = $result;

		parent::_initpage();
	}
	public function dostatus(){
		$status = $this->input->post('status',true);
		$question_id = $this->input->post('question_id',true);
		$data = array('question_status'=>$status);
		$where = array('question_id'=>$question_id);
		if($this->question_model->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}
}

?>