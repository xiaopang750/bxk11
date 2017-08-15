<?php
/**
	 *description:
	 *author:冀帅
	 *QQ:75426585
	 *date:2014-7-16
	 */
class User extends User_Controller {
	function __construct() {
		parent::__construct ();
	}
	/* 获取灵感辑的页面 */
	public function album_list() {
		$this->load->model ( 't_album_model' );
		$field = array('album_id','album_name');
		$res = $this->t_album_model->getAll ($field);
		
		$data['album_list'] = $res;
		if ($res) {
			echojson ( '0', $data );
		} else {
			echo echojson ( '1', '', '无相关数据' );
		}
	}
	
	/* 获取灵感辑添加页面 */
	public function album_add() {
		$this->config->load('view');
		$config = $this->config->item('index');
		
		$data['config'] = $config;
		
		$this->load->view($config['albumadd'],$data);
	}
	public function tag_list(){
		$res = model("t_tag")->tagrank_byhot();				
		if($res==false){
			echojson(1,"","无相关推荐");
		}
		$this->load->helper('py');
		$arr = array();
		foreach ($res as $key=>$val) {
			$arr[$key]['name'] = $val['tag_name'];
			$ptag = Pinyin($val['tag_name'],'utf-8');
			if($ptag!=""){
				$arr[$key]['pinyin'] =$ptag;
			}else{
				$arr[$key]['pinyin'] =$val['tag_name'];
			}
		}
		echojson(0,$arr);
	}

	
	
	
	
	
}

?>