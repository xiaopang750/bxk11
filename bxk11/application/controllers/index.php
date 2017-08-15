<?php

class  Index extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:灵感辑详情
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function index(){
		$_SESSION['user_id']='378';
		$this->load->model ( 't_ad_model' );
		$this->load->model ( 'T_ad_page_module_model');
		$this->load->model ( 't_album_model' );
		$this->load->model ( 't_user_model' );
		$data = array();
        //实现逻辑
        //1.根据key确定模块id
        //2.然后根据模块id获取所有当前模块下的广告位
        //3.循环广告位数组，并根据里面的广告数据类型，查询该广告位数据
		//顶部轮播模块
		for($i=1;$i<=2;$i++)
		{
			$top_slide[$i]=$this->t_ad_model->getOne('',array('ad_key'=>'index_top_slide_'.$i));
			$data['top_slide'][$i-1]['title']=$top_slide[$i]->ad_title;
			
			$album_userid=$this->t_album_model->getOne('user_id',array('album_id'=>$top_slide[$i]->ad_data_id));
			//呢称
			$album_username=$this->t_user_model->getOne('user_nickname',array('user_id'=>$album_userid->user_id));
			$data['top_slide'][$i-1]['user_nickname']=$album_username->user_nickname;
			$data['top_slide'][$i-1]['userspace']='#';
			$data['top_slide'][$i-1]['pic']=$top_slide[$i]->ad_pic;
			$data['top_slide'][$i-1]['url']='#';			
		}	
	}	
}

