<?php
/*description:个人喜欢灵感页面
 *author:yanyalong
 *date:2013/08/01
 */
class Like extends Temp_Controller {

	function __construct(){
		parent::__construct();
	}
	//个人空间我喜欢的原文灵感列表展示页面	
	function index(){ 
		
		$this->load->view('/index/fav/artical');
	}
	//个人空间我喜欢的灵感原文列表展示内容
	public function mylikeinfo(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$p= $this->input->post('p',true);
		$rows = 5;
		$likelist = model('bxk_user_like_model')->mylike($user_id,$p,$rows);		
		if(!empty($likelist)){
			echojson(1,$likelist);
		}else{
			echojson(0,'无相关数据');
		}
	}
}


