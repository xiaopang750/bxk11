<?php
/*description:单一标签聚合
 *author:yanyalong
 *date:2013/07/28
 */
class tags extends Temp_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:标签、主题判断跳转
	 *author:yanyalong
	 *date:2013/08/29
	 */
	public function index(){
		$tag_name= $this->input->post('tag_name',true);
		$url=$_SERVER['PHP_SELF'];
		$urlarr = explode('/',$url);
		$count = count($urlarr);
		$tag_name = $urlarr[$count-1];	
		$taginfo = model("Bxk_tag_model")->taginfobyname($tag_name);
		if($taginfo['tag_type']<50&&$taginfo['tag_type']!=2){
			$tagurl = $this->config->site_url()."/tags/tagshow/".$tag_name;
		}elseif($taginfo['tag_type']==2){
			$tagurl = $this->config->site_url()."/theme/index/".$tag_name;
		}
		header("Location:$tagurl");exit;
	}
	/**
	 *description:标签聚合展示页
	 *author:yanyalong
	 *date:2013/08/30
	 */
	public function tagshow(){
		$this->load->view('/index/inspiration/tag');
	}
	/**
	 *description:主题聚合展示页
	 *author:yanyalong
	 *date:2013/08/30
	 */
	public function themeshow(){
		$this->load->view('/index/inspiration/theme_new');
	}
	/**
	 *description:标签聚合页灵感列表内容
	 *author:yanyalong
	 *date:2013/08/30
	 */
	public function tagnew(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$p= $this->input->post('p',true);
		$tag_name= $this->input->post('tag_name',true);
		$taginfo = model("Bxk_tag_model")->taginfobyname($tag_name);		
		if(empty($taginfo)){
			echojson(0,'无相关数据');
		}
		$contentlist = model("Bxk_content_tag_model")->tagcontentlist($taginfo['tag_id'],$user_id,$p,4,1,0);			
		if(!empty($contentlist)){
			echojson(1,$contentlist);
		}else{
			echojson(0,'无相关数据');
		}
	}
	/**
	 *description:获取标签基本信息
	 *author:yanyalong
	 *date:2013/09/11
	 */
	public function taginfo(){
		$tag_name= $this->input->post('tag_name',true);
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$taginfo = model("Bxk_tag_model")->taginfobyname($tag_name);		
		if(empty($taginfo)){
			echojson(0,'无相关数据');
		}
		$taginfo['is_take'] = model('bxk_tag_take_model')->exist_take($taginfo['tag_id'],$user_id);
		//获取标签订阅数	
		$taginfo['subcount'] = model("Bxk_tag_take_model")->numbytag($taginfo['tag_id']);
		//获取标签灵感数
		$taginfo['concount'] = model("Bxk_content_tag_model")->numbytag($taginfo['tag_id']);
		if($taginfo['tag_img']!=''){
			$this->config->load('uploads');
			$config = $this->config->item('theme');
				if(!file_exists($config['thumb_3'].$taginfo['tag_img'])){
					$taginfo['tag_img'] = $this->config->base_url().$config['default_3']; 	
				}else{
				$taginfo['tag_img'] = $this->config->base_url().$config['relative_path'].'thumb_3/'.$taginfo['tag_img'];
				}
		}
			echojson(1,$taginfo);
	}
	
	/**
	 *description:获取标签下明星用户
	 *author:yanyalong
	 *date:2013/08/24
	 */
	public function tagstar(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$tag_name= $this->input->post('tag_name',true);
		$tag_id = model("Bxk_tag_model")->get_tag_id($tag_name);
		if($tag_id==false){
			echojson(0,'无相关数据');
		}
		$user_idarr= model("Bxk_content_model")->tagstar($tag_id,$user_id,10);
		if(!empty($user_idarr)){
			echojson(1,$user_idarr);
		}else{
			echojson(0,'无相关数据');
		}
	}
	/**
	 *description:为灵感批量添加标签
	 *author:yanyalong
	 *date:2013/08/29
	 */
	public function addcontenttag(){
		$content_id = $this->input->post('content_id',true);
		$tags_name = trim('sfdsfs,sdsadad,1710,3287,我3,adfsd',',');
		$this->load->model('Bxk_tag_model');
		$taglist = $this->Bxk_tag_model->tags_add($tags_name);		
		$this->load->model('Bxk_content_model');
		$res = $this->Bxk_content_model->addtags($content_id,$taglist);
		if($res){
			echojson(1,'添加成功');
		}else{
			echojson(0,'删除失败');
		}
	}
	/**
	 *description:为灵感删除一个标签
	 *author:yanyalong
	 *date:2013/08/29
	 */
	public function delcontenttag(){
		$tag_id = 1039;
		$content_id = 6;
		//$tag_id = $this->input->post('tag_id',true);
		$this->load->model('Bxk_content_model');
		$res = $this->Bxk_content_model->del_content_tag($tag_id,$content_id);
		if($res){
			echojson(1,'删除成功');
		}else{
			echojson(0,'删除失败');
		}
	}
	/**
	 *description:删除一个标签
	 *author:yanyalong
	 *date:2013/08/29
	 */
	public function deltag(){
		$tag_id = 661;
		//$tag_id = $this->input->post('tag_id',true);
		$this->load->model('Bxk_tag_model');
		$res = $this->Bxk_tag_model->delete_tag($tag_id);
		if($res=='1'){
			echojson(1,'删除成功');
		}else{
			echojson(0,'删除失败');
		}
	}
}


