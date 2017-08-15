<?php
	/**
	 *description:
	 *author:冀帅
	 *QQ:75426585
	 *date:2014-7-17
	 */
class Album extends User_Controller {
	function __construct() {
		parent::__construct ();
	}
	
	/* 获取灵感辑编辑页面 */
	public function edit() {
		$user_id = $_SESSION['user_id'];

		$id = (int)($_GET['content_id']);

		$this->load->model('t_album_model');
		$where = array('user_id'=>$user_id,'album_id'=>$id);
		$res = $this->t_album_model->getOne('*',$where);
		
		$data['album_id'] = $id;
		if($res){
			$data['err'] = 0;
			$data['album_name'] = $res->album_name;
			$data['album_explain'] = $res->album_explain;
			echojson('0', $data);
		}else{
			$data['err'] = 1;
			echojson('1', '','无相关数据');
		}
		
		/*
		$this->config->load('url');
		$config = $this->config->item('album');
	
		$data['config'] = $config;
	
		$this->load->view($config['list'],$data);
		*/
	}
}
?>