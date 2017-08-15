<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/11/21 16:14:31 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class score extends CI_Controller
{
	/**
	 * 数组，传递到Views试图中
	 */
	private $data;

	/**
	 * 分页中的每页显示的记录条数
	 */
	private $per_page = 10;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url'); 
		$this->load->model('T_system_score_model');
	}

	public function index($page = 1)
	{
		if(!is_numeric($page) || $page < 1)
			$page = 1;
	
		$this->load->library('pagination');

		$config['base_url'] = site_url('admin/score/index/');
		$config['total_rows'] = $this->T_system_score_model->count_all();
		$config['uri_segment'] = 4;
		$config['num_links'] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = $this->per_page;
		$config['first_link'] = '第一页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$config['last_link'] = '最后一页';
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();

		$limit = $this->per_page;
		$offset = ($page - 1) * $limit;
		$this->data['list'] = $this->T_system_score_model->get_list($limit, $offset);

		$this->load->view('admin/t_system_score/list', $this->data);
	}

	// /admin/t_system_score/search/field_name,keywords/1
	public function search($content, $page = 1)
	{
		if(empty($content)) return;

		$search_types = explode(',', $content);
		if(empty($search_types) || count($search_types) != 2) return;

		$search_field = $search_types[0];
		$search_keywords = $search_types[1];
		$limit = $this->per_page;
		$offset = ($page - 1) * $limit;

		$this->load->library('pagination');

		$config['base_url'] = site_url('admin/score/search/').$content.'/';
		$config['total_rows'] = $this->T_system_score_model->count_search($search_field, $search_keywords);
		$config['uri_segment'] = 5;
		$config['num_links'] = 4;
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = $this->per_page;
		$config['first_link'] = '第一页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$config['last_link'] = '最后一页';
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();

		$this->data['search_list'] =  $this->T_system_score_model->search($search_field, $search_keywords, $limit, $offset);

		//$this->load->view('{_search_view_file_}', $this->data);
	}

	public function detail($score_id)
	{
		if(empty($score_id)) { return; }


		$this->data['detail'] = $this->T_system_score_model->get($score_id);
		$this->load->view('admin/t_system_score/detail', $this->data);
	}

	public function add()
	{
	}

	public function edit($score_id)
	{
		if(empty($score_id)) { return; }


	}
	
	public function delete($score_id)
	{
		if(empty($score_id)) { return; }

	}
}
