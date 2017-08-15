<?php

class  Album extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:灵感辑详情
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function info(){
		//$this->config->load('view');
		//$config = $this->config->item('index');
        //$_a= array(
            //'title'=>'a',
            //'content'=>'b',
            //'3'=>'c',
            //'4'=>'d',
        //);
        $title = $_POST[''];
        foreach ($res as $key=>$val) {
           $data['top_slide'][$key]['title']  = $val['1'];
        }
        //$data = json_encode($data);
		$this->load->view("index/album/info.html",$data);	
	}
	
	/**
	 *description:
	 *author:冀帅
	 *QQ:75426585
	 *date:2014-7-15
	 */
	/*灵感辑列表*/
	public function albumlist(){
		$this->load->model('t_album_model');
		$res = $this->t_album_model->getAll();
		//var_dump($res);
	//	exit();
		$data['res'] = $res;
		$this->load->view('main/album/list',$data);	
	}
	
	
	/*灵感辑添加*/
	public function add(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['albumadd']);	
	}
	/*灵感辑删除*/
	public function del(){
		$this->load->model('t_album_model');
		
		$id = (int)($_GET['album_id']);
		//$id = (int)($_POST['album_id']);
	
		if($this->t_album_model->delete($id)){
			jumpAjax('删除成功',U('album/albumlist'));
		} else {
			jumpAjax('删除成功',U('album/albumlist'));
		}
	}
	
	/*灵感辑编辑*/
	public function edit(){
		
		$id = (int)($_GET['album_id']);
		
		$this->load->model('t_album_model');
		$res = $this->t_album_model->getOne('*',array('album_id'=>$id));
		$data['album_name'] = $res->album_name;
		$data['album_explain'] = $res->album_explain;
		$data['album_id'] = $id;
		
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['albumedit'],$data);
	}
}



