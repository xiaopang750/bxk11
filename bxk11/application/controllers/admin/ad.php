<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
	/*
 * Generator By "Auto Codeigniter" 广告页面及模块管理 Author: 冀帅 QQ: 75426585
 */
class Ad extends Admin_Controller {
	public $navpage;
	public function __construct() {
		parent::__construct ();
		
		$this->navpage = 'nav';
	}
	
	/*获取全部页面*/
	public function page() {
		$data ['title'] = '家178-广告投放-页面模块管理';
		$data ['menu'] = 'index';
		$this->load->model ( 't_ad_page_module_model' );
		$this->page = $this->t_ad_page_module_model->page_list ();
		$data ['page'] = $this->page;
		$this->data = $data;

		$this->page = 'ad/pagemanage';
		$this->navpage = $this->navpage;
		parent::_initpage ();
	}
	
	/*获取某个页面下全部模块*/
	public function model() {
		$data ['title'] = '家178-广告投放-页面模块管理';
		$data ['menu'] = 'index';
		$this->load->model ( 't_ad_page_module_model' );
		
		$id = (int)($_GET['id']);
		$this->page = $this->t_ad_page_module_model->model_list ($id);
		$data ['page'] = $this->page;
		$this->data = $data;
	
		$this->page = 'ad/modelmanage';
		$this->navpage = $this->navpage;
		parent::_initpage ();
	}
	public function pageadd() {
		$data ['title'] = '家178-广告投放-页面添加';
		$data ['menu'] = 'index';
		$this->data = $data;
		$this->page = 'ad/pageadd';
		$this->navpage = $this->navpage;
		
		parent::_initpage ();
	}
	public function modeladd() {
		$data ['title'] = '家178-广告投放-模块添加';
		$data ['menu'] = 'index';
		
		$this->load->model ( 't_ad_page_module_model' );
		$result ['option_str'] = $this->t_ad_page_module_model->option_str ();
		$this->pagedata = $result;
		$this->data = $data;
		$this->page = 'ad/modeladd';
		$this->navpage = $this->navpage;
		parent::_initpage ();
	}
	
	/* 广告页面提交 */
	public function pagesave() {
		safeFilter ();
	
		$this->load->model('t_ad_page_module_model');
		//$this->model = $this->t_ad_page_module_model->model_list();
		$this->t_ad_page_module_model->apm_pid = isset ( $_POST ['model_pid'] ) ? $this->input->post ( 'model_pid', true ) : '';
		$this->t_ad_page_module_model->apm_name = isset ( $_POST ['page_name'] ) ? $this->input->post ( 'page_name', true ) : '';
		$this->t_ad_page_module_model->apm_desc = isset ( $_POST ['page_intro'] ) ? $this->input->post ( 'page_intro', true ) : '';
	
		if(! isset($_GET['id'])){
			$res = $this->t_ad_page_module_model->page_add ();
		} else {
			$id = (int)($_GET['id']);
			$where = array('apm_id'=>$id);
			$res = $this->t_ad_page_module_model->update ($this->t_ad_page_module_model,$where);
		}
	
		if ($res) {
			jumpAjax('成功', U('admin/ad/page'));
		} else {
			jumpAjax('失败', U('admin/ad/page'));
		}
	}
	
	public function del() {
		$data ['title'] = '家178-广告投放-删除';
		$data ['menu'] = 'index';
		$id = ( int ) ($_GET ['id']);
		$this->load->model ( 't_ad_page_module_model' );
		$res = $this->model = $this->t_ad_page_module_model->delete ( $id );
		
	if ($res) {
			jumpAjax ( '删除成功', U ( 'admin/ad/page' ) );
		} else {
			jumpAjax ( '删除失败', U ( 'admin/ad/page' ) );
		}
	}
	public function edit() {
		$data ['title'] = '家178-广告投放-修改';
		$data ['menu'] = 'index';
		$id = ( int ) ($_GET ['id']);
		$this->load->model ( 't_ad_page_module_model' );
		$where = array (
				'apm_id' => $id 
		);
		$res = $this->model = $this->t_ad_page_module_model->getOne ( '*', $where );
		
		$data ['res'] = $res;
		
		$data ['id'] = $id;
		$data ['option_str'] = $this->model = $this->t_ad_page_module_model->option_str ();
		$this->data = $data;
		$this->page = 'ad/pageedit';
		$this->navpage = $this->navpage;
		parent::_initpage ();
	}
	
	public function modeledit() {
		$data ['title'] = '家178-广告投放-模块修改';
		$data ['menu'] = 'index';
		$id = ( int ) ($_GET ['id']);
		$this->load->model ( 't_ad_page_module_model' );
		$where = array (
				'apm_id' => $id
		);
		$res = $this->model = $this->t_ad_page_module_model->getOne ( '*', $where );
	
		$data ['res'] = $res;
	
		$data ['id'] = $id;
		$data ['option_str'] = $this->model = $this->t_ad_page_module_model->option_str ($res->apm_pid);
		$this->data = $data;
		$this->page = 'ad/modeledit';
		$this->navpage = $this->navpage;
		parent::_initpage ();
	}
	
	/* ajax获取一个model下的数据 */
	public function getall() {
		$id = ( int ) ($_GET ['id']);
		$this->load->model ( 't_ad_model' );
		$where = array (
				'apm_id' => $id 
		);
		
		$res = $this->model = $this->t_ad_model->getAll ( '*', $where );
		// var_dump($res);
		// exit();
		$res_str = '<tr><th width="300">标题</th><th width="300">操作</th></tr>';
		foreach ( $res as $v ) {
			$res_str .= '<tr><td>' . $v->ad_title . '</td>';
			$res_str .= '<td><a class="is_del" href="' . U ( 'admin/ad/addel', array (
					'id' => $v->ad_id 
			) ) . '">删除</a><a href="' . U ( 'admin/ad/adedit', array (
					'id' => $v->ad_id 
			) ) . '">修改</a></tr>';
		}
		
		echo $res_str;
	}
	public function admanage() {
		$data ['title'] = '家178-广告投放-广告管理';
		$data ['menu'] = 'index';
		
		$this->load->model ( 't_ad_model' );
		$this->t_ad = $this->t_ad_model;
		$result ['option_str'] = $this->t_ad->option_str ();
		$this->pagedata = $result;
		$this->data = $data;
		$this->page = 'ad/admanage';
		$this->navpage = $this->navpage;
		parent::_initpage ();
	}
	
	/* 广告增加 */
	public function adadd() {
		$data ['title'] = '家178-广告投放-广告添加';
		$data ['menu'] = 'index';
		
		$this->load->model ( 't_ad_model' );
		$this->t_ad = $this->t_ad_model;
		$result ['option_str'] = $this->t_ad->option_str ();
		
		$this->pagedata = $result;
		$this->data = $data;
		$this->page = 'ad/adadd';
		$this->navpage = $this->navpage;
		parent::_initpage ();
	}
	
	/*广告提交*/
	public function adaddsave() {
		safeFilter ();
		$this->load->model('t_ad_model');
		$this->model = $this->t_ad_model->model_list();
		$this->t_ad_model->apm_id = isset ( $_POST ['module_id'] ) ? $this->input->post ( 'module_id', true ) : '';
		$this->t_ad_model->ad_title = isset ( $_POST ['ad_name'] ) ? $this->input->post ( 'ad_name', true ) : '';
		$this->t_ad_model->ad_key = isset ( $_POST ['ad_key'] ) ? $this->input->post ( 'ad_key', true ) : '';
		$this->t_ad_model->ad_desc = isset ( $_POST ['page_intro'] ) ? $this->input->post ( 'page_intro', true ) : '';
		$this->t_ad_model->ad_type = isset ( $_POST ['ad_type'] ) ? $this->input->post ( 'ad_type', true ) : '';
		$this->t_ad_model->ad_data_id = isset ( $_POST ['recom'] ) ? $this->input->post ( 'recom', true ) : '';
		$this->t_ad_model->ad_url = isset ( $_POST ['ad_url'] ) ? $this->input->post ( 'ad_url', true ) : '';
	
		$this->config->load('uploads');
		$config = $this->config->item("system_ad");
	
		$this->load->library('upload');
		$this->upload->initialize($config);
	
		$upinfo = $this->upload->do_upload('ad_pic');
		$fileinfo = $this->upload->data();
		$file_url = 'uploads/ad/'.$fileinfo['file_name'];
		$this->t_ad_model->ad_pic =  $file_url;
		if(isset($_GET['id'])){
			$id = (int)($_GET['id']);
			$this->t_ad_model->apm_id = isset ( $_POST ['module_id'] ) ? $this->input->post ( 'module_id', true ) : '';
			$res = $this->t_ad_model->update (array('ad_id'=>$id));
		} else{
			$res = $this->t_ad_model->insert ();
		}
	
		if ($res) {
			jumpAjax('成功', U('admin/ad/admanage'));
		} else {
			jumpAjax('失败', U('admin/ad/admanage'));
		}
	}
	
	/* 广告删除 */
	public function addel() {
		$id = ( int ) ($_GET ['id']);
		$this->load->model ( 't_ad_model' );
		$res = $this->t_ad_model->delete ( $id );
		if ($res) {
			jumpAjax ( '删除成功', U ( 'admin/ad/admanage' ) );
		} else {
			jumpAjax ( '删除失败', U ( 'admin/ad/admanage' ) );
		}
	}
	
	/* 广告修改 */
	public function adedit() {
		$data ['title'] = '家178-广告投放-广告添加';
		$data ['menu'] = 'index';
		
		$id = ( int ) ($_GET ['id']);
		$this->load->model ( 't_ad_model' );
		$this->t_ad = $this->t_ad_model;
		$result ['option_str'] = $this->t_ad->option_str ();
		$result ['id'] = $id;
		
		$ad_info = $this->t_ad_model->getOne ( '*', array (
				'ad_id' => $id 
		) );
		// var_dump($ad_info);
		// exit();
		$result ['ad_info'] = $ad_info;
		$this->pagedata = $result;
		$this->data = $data;
		$this->page = 'ad/adedit';
		$this->navpage = $this->navpage;
		parent::_initpage ();
	}
	
	/* 后台Ajax获取模块选择项 */
	public function option_module() {
		$this->load->model ( 't_ad_model' );
		$this->t_ad = $this->t_ad_model;
		echo $this->t_ad->option_module ( $_POST ['id'] );
	}
}
?>
