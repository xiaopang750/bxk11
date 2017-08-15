<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
/**
 * description:广告提交
 * author:冀帅
 * QQ:75426585
 * date:2014-7-11
 */
class Ad extends User_Controller {
	function __construct() {
		parent::__construct ();
		
		
	}
	/* 广告页面提交 */
	public function page() {
		safeFilter ();
		
		$this->load->model('t_ad_page_module_model');
		$this->model = $this->t_ad_page_module_model->model_list();
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
			jumpAjax('添加成功', U('admin/ad/page'));
		} else {
			jumpAjax('添加失败', U('admin/ad/page'));
		}
	}
	
	/*广告提交*/
	public function adadd() {
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
				jumpAjax('添加成功', U('admin/ad/admanage'));
			} else {
				jumpAjax('添加失败', U('admin/ad/admanage'));
		}
	}
}