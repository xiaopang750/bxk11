<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:关注功能
 *author:chenyuda
 *date:2013/08/01
 */
class Follow extends Temp_Controller {
	function __construct(){
        parent::__construct();	
    }
	//显示我关注的页面
	function show_myself_follow()
	{
		
		$this->load->view('index/find/my_focus');
	}

	//我关注的
	function self_follow(){
		
		safeFilter();
		$this->load->model('Bxk_user_follow_model');
		$user_id = $_SESSION['user_id'];
		$p = $this->input->post('p',true);
		$arr = $this->Bxk_user_follow_model->myfollows($user_id,$p,2);
		if($arr!=false){
			echojson(1,$arr);
		}else{
			echojson(0,'无关注用户');
		}
	}

	//他关注的
	function he_follow(){
		safeFilter();
		$this->load->model('Bxk_user_follow_model');
		$user_id= $this->input->post('user_id');
		$arr=$this->Bxk_user_follow_model->ther_follow($user_id);
		print_r(json_encode($arr));
	}


	//搜索我关注的
	function seek_follow()
	{
				
		safeFilter();
		$this->load->model('Bxk_user_follow_model');
		$user_nickname= $this->input->post('user_nickname',true);
		$p= $this->input->post('p',true);
		$arr=$this->Bxk_user_follow_model->follow_seek($user_nickname,$p,2);
		if($arr!=false){
			echojson(1,$arr);
		}else{
			echojson(0,'没有搜索结果');
		}
	}
	
	//关注推荐
	function follow_recommend()
	{	
		
		$this->load->model('Bxk_user_follow_model');
		$user_id = $_SESSION['user_id'];
		$arr=$this->Bxk_user_follow_model->follow_recommend_show($user_id);
		if(!empty($arr)){
			echojson(1,$arr);
		}else{
			echojson(0,'无相关数据');
		}
		
	}
	//添加关注
	function follow_someone()
	{
		
		safeFilter();
		$this->load->model('Bxk_user_follow_model');
		$user_id = $this->input->post('user_id');
		$follow_uid = $this->input->post('follow_uid');
		$arr=$this->Bxk_user_follow_model->follow_people($user_id,$follow_uid);
		print_r($arr);
	}
	
	//取消关注
	function follow_del_some()
	{
		
		safeFilter();
		$this->load->model('Bxk_user_follow_model');
		$user_id = $this->input->post('user_id');
		$follow_uid = $this->input->post('follow_uid');
		$arr=$this->Bxk_user_follow_model->follow_del_people($user_id,$follow_uid);
		print_r($arr);
	}

	//显示粉丝页面
	function fans()
	{
		
		$this->load->view('index/user/funs');
	}

	//点击粉丝详细页面
	function show_fans()
	{
		safeFilter();
		$this->load->model('Bxk_user_follow_model');
		$user_id = $this->input->post('user_id');
		$p= $this->input->post('p');
		$arr=$this->Bxk_user_follow_model->dis_fan($user_id,$p,2);
		if($arr!=false){
			echojson(1,$arr);
		}else{
			echojson(0,'无相关数据');
		}
	}

	//移除粉丝
	function fans_del()
	{
		
		safeFilter();
		$this->load->model('Bxk_user_follow_model');
		$user_id = $this->input->post('user_id');
		$follow_uid = $this->input->post('follow_uid');
		$arr=$this->Bxk_user_follow_model->del_fan($user_id,$follow_uid);
		print_r($arr);
	}

	//添加粉丝 
	function fans_add()
	{
		
		$this->load->model('Bxk_user_follow_model');
		$user_id = $this->input->post('user_id');
		$follow_uid = $this->input->post('follow_uid');
		$follow_id = $this->input->post('follow_id');
		$arr=$this->Bxk_user_follow_model->add_fan($user_id,$follow_uid,$follow_id);
		print_r($arr);
	}

	function asd()
	{
		$this->load->model('Bxk_user_follow_model');
		$user_id = 7;		
		$arr=$this->Bxk_user_follow_model->follow_change($user_id);
		print_r($arr);
	}
}
