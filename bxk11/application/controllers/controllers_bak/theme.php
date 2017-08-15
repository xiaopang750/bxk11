<?php
/*theme:单一主题聚合
 *author:yanyalong
 *date:2013/07/31
 */
class Theme extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	//单一主题聚合精选展示页
	function index(){ 
		$this->load->view('/index/inspiration/theme_special');
	}
	//单一主题聚合精选展示页展示内容
	public function themegood(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$p= $this->input->post('p',true);
		$rows = 4;
		$tag_name= $this->input->post('tag_name',true);
		$taginfo = model("Bxk_tag_model")->taginfobyname($tag_name);		
		$contentlist['list'] = model("Bxk_content_tag_model")->tagcontentlist($taginfo['tag_id'],$user_id,$p,$rows,2,0);			
		if(!empty($contentlist['list'])){
			echojson(1,$contentlist);
		}else{
			echojson(0,'无相关数据');
		}
	}
}


