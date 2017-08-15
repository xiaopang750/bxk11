<?php
class Content extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	
	public function edit()
	{
		$user_id=isset($_SESSION['user_id'])?$_SESSION['user_id']:378;
		$_POST['content_id']='3';
		$this->load->model('t_content_model');
		$content_id = $_POST['content_id'];
		$content_info=$this->t_content_model->getOne("",array("content_id"=>$content_id));		
		$content_tag_id=explode(',',$content_info->content_tag_id);		
		$content_tag_name=explode(',',$content_info->content_tag);
		$this->load->model('t_album_content_model');
		$this->load->model('t_album_model');
		$album_list=$this->t_album_model->getAll("",array('user_id' =>$user_id));
		$album_id=$this->t_album_content_model->getOne("album_id",array("content_id"=>$content_id));
		$this->load->model('t_pic_model');
		$pic_url=$this->t_pic_model->get($content_info->pic_id);
		$return_arr=array(
				"err"=>"0"
		);
		
		foreach ($content_tag_id as $key => $value) {
			$return_arr["data"]['tag_selectlist'][$key]['tag_id']=$value;
			$return_arr["data"]['tag_selectlist'][$key]['tag_name']=$content_tag_name[$key];
		}		
		foreach ($album_list as $key1 => $value1) {

			$return_arr["data"]['album_list'][$key1]['album_id']=$value1->album_id;
			$return_arr["data"]['album_list'][$key1]['album_name']=$value1->album_name;
			$n=0;
			
			if($album_id->album_id==$value1->album_id)
			{
				$n=1;
			}
			$return_arr["data"]['album_list'][$key1]['is_select']=$n;
		}
		
		$return_arr["data"]['content_info']['content_id']=$content_info->content_id;
		$return_arr["data"]['content_info']['content_content']=$content_info->content_content;
		$return_arr["data"]['content_info']['pic_url']=$pic_url;
		$return_arr=json_encode($return_arr);
		print_r($return_arr);
	}
}

