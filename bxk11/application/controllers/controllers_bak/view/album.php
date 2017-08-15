<?php
/**
 *description:
 *author:baohanbin
 *date:2013/11/09
 */
class Album extends User_Controller {

	function __construct(){
		parent::__construct();
		//$this->ajax_checklogin();
	}

	public function albumlist(){
	$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
	if($user_id==""){
		echojson(2,"","未登录");
	}
		$this->load->model('t_album_model');
		$this->t_album_model->user_id = $user_id;
		$info = $this->t_album_model->select_name();
		if(!empty($info))
		{
			echojson(0,$info,'');
		}else{
			echojson(1,"","失败");
		}
	}
	/**
	 *description:灵感集详情
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function info(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$this->config->load('url');
		$config = $this->config->item('url');
		$album_id= isset($_POST['aid'])?$this->input->post('aid'):"";
		$p= isset($_POST['p'])?$this->input->post('p'):"1";
		if($album_id==""){
			echojson(0,"","无相关数据");
		}
		//获取灵感集详情
		$this->load->model('t_album_content_model');
		$res = $this->t_album_content_model->getContentListByAlbumId($album_id,$p,5);
		if($res==false){
			echojson(0,"","无相关数据");
		}
		foreach ($res as $key=>$val) {
			$content = model("t_content")->content_analytic($val->content_content);
			$data[$key]['content_pic'] = $content['pic_md5']['0']['thumb_4'];
			$data[$key]['content_id'] = $val->content_id;
			$data[$key]['content_title'] = $val->content_title;
			$data[$key]['pic_count'] =$content['pic_num'];
			$data[$key]['pic_count'] =$content['pic_num'];
			if($user_id==""){
				$data[$key]['is_like'] = "0";		
			}else{
				$data[$key]['is_like'] = model('t_user_like')->is_like($val->content_id,$user_id);	
			}
			if($user_id==$val->user_id){
				$data[$key]['is_me'] = "1";		
			}else{
				$data[$key]['is_me'] = "0";		
			}
			foreach ($content['pic_md5'] as $keys=>$vals) {
				$data[$key]['pic_list'][$keys]['pic'] = $vals['thumb_1'];
				$data[$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
			}
			$data[$key]['tag_list'] = model('t_tag')->taglist_url(11,$val->content_tag,5);
		}
		echojson(0,$data);
	}
}


