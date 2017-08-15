<?php
/*description:单一标签聚合
 *author:yanyalong
 *date:2013/07/28
 */
class Tag extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:标签，主题聚合页精选灵感列表内容
	 *author:yanyalong
	 *date:2013/08/30
	 */
	public function index(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$rows = 4;
		//$p= isset($_POST['p'])?$this->input->post('p',true):"1";
		$p= isset($_POST['p'])?$this->input->post('p',true):"1";
		$class= isset($_POST['type'])?$this->input->post('type',true):"装修风格";
		if($class==""){
			$class = "装修风格";
		}
		$tag_name= isset($_POST['tag'])?$this->input->post('tag',true):"";
		if($tag_name==""&&$class==""){
			echojson(1,"","无相关数据");
		}elseif($tag_name==""&&$class!=""){
			$classinfo = model("t_system_class")->classinfobyname($class);
			if($classinfo!=false){
				$res = model("t_system_class")->contentlistbyclass($classinfo->s_class_id,$p,5,"hot");		
			}else{
				echojson(1,"","无相关数据");
			}
		}else{
			$taginfo= model("t_tag")->taginfobyname($tag_name);		
			if($taginfo!=false){
				$res = model("t_content_tag")->tagcontentlist($taginfo['tag_id'],$p,$rows);			
				if($res==false){
					echojson(1,"","无相关数据");
				}
			}else{
				echojson(1,"","无相关数据");
			}
		}
		$contentlist = array();
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($res as $key=>$val) {
			$contentlist[$key]['project_num']= $val->content_project;
			$contentlist[$key]['title'] = $val->content_title;	
			$contentlist[$key]['tags'] = model('t_tag')->taglist_url(11,$val->content_tag,5);
			$contentlist[$key]['likes'] = $val->content_likes;	
			$contentlist[$key]['disc'] = $val->content_disc;	
			$contentlist[$key]['url'] = $config['contenturl'].$val->content_id;
			$content = model("t_content")->content_analytic($val->content_content);
			foreach ($content['pic_md5'] as $keys=>$vals) {
				if($keys<3){
				$contentlist[$key]['pic_list'][$keys]['pic_url2'] = $vals['thumb_2'];
				$contentlist[$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
				}
			}
		}
		$con['contentlist'] = $contentlist;
		echojson(0,$con);
	}
	/**
	 *description:获取标签分类列表
	 *author:yanyalong
	 *date:2013/12/02
	 */
	public function classlist(){
		$res = model("t_system_class")->classlist(11);		
		if($res==false){
			echojson(1,"","无相关数据");
		}
		$bclass = array();
		foreach ($res as $key=>$val) {
			$bclass[] = $val->class_pname;
		}
		$bclass = array_values(array_unique($bclass));
		$classlist = array();
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($bclass as $key=>$val) {
			$i=0;
			foreach ($res as $keys=>$vals) {
				$classlist[$key]['bname'] = $val;	
				if($vals->class_pname==$val){
					$classlist[$key]['sname'][$i]['name'] = $vals->s_class_name;	
					$classlist[$key]['sname'][$i]['url'] = $config['tagurl'].$vals->s_class_name;
				}
				$i++;
			}
		}
		echojson(0,$classlist);
	}
	//单一主题聚合最新展示页展示内容
	public function tagnew(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$p= isset($_POST['p'])?$this->input->post('p'):"1";
		$class= isset($_POST['type'])?$this->input->post('type'):"装修风格";
		if($class==""){
			$class = "装修风格";
		}
		$tag_name= isset($_POST['tag'])?$this->input->post('tag'):"";
		if($tag_name==""&&$class==""){
			echojson(1,"","无相关数据");
		}elseif($tag_name==""&&$class!=""){
			$classinfo = model("t_system_class")->classinfobyname($class);
			if($classinfo!=false){
				$res = model("t_system_class")->contentlistbyclass($classinfo->s_class_id,$p,5);		
			}else{
				echojson(1,"","无相关数据");
			}
		}else{
			$res = model("t_tag")->contentlistbytag($tag_name,$p,5);		
			if($res==false){
				echojson(1,"","无相关数据");
			}
		}
		$contentlist = array();
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($res as $key=>$val) {
			$contentlist[$key]['cid'] = $val->content_id;	
			$contentlist[$key]['project_num']= $val->content_project;
			$contentlist[$key]['title'] = $val->content_title;	
			$contentlist[$key]['tags'] = model('t_tag')->taglist_url(11,$val->content_tag,5);
			$contentlist[$key]['likes'] = $val->content_likes;	
			$contentlist[$key]['disc'] = $val->content_disc;	
			$contentlist[$key]['uid'] = $val->user_id;	
			$userinfo = model("t_user")->get($val->user_id);
			$contentlist[$key]['nickname'] = ($userinfo->user_nickname!="")?$userinfo->user_nickname:$userinfo->user_email;
			$contentlist[$key]['userspace'] = $config['userspace'].$val->user_id;	
			$contentlist[$key]['pic'] = model("t_user_info")->avatar($val->user_id);
			$contentlist[$key]['is_follow'] = model('t_user_follow')->is_follow($user_id,$val->user_id);	
			$contentlist[$key]['sub_time'] = $val->content_subtime;	
			if($val->user_id!=$user_id){
				$contentlist[$key]['is_like'] = model('t_like_questions')->is_like($val->content_id,$user_id);	
				$contentlist[$key]['is_me'] = "0";
			}else{
				$contentlist[$key]['is_like'] = "0";
				$contentlist[$key]['is_me'] = "1";
			}
			$contentlist[$key]['url'] = $config['contenturl'].$val->content_id;
			$content = model("t_content")->content_analytic($val->content_content);
			$contentlist[$key]['pic_num'] = $content['pic_num'];
			$this->load->model('t_pic_pin_model');
			foreach ($content['pic_md5'] as $keys=>$vals) {
				$contentlist[$key]['pic_list'][$keys]['pic_url1'] = $vals['thumb_1'];
				$contentlist[$key]['pic_list'][$keys]['pic_url2'] = $vals['thumb_1'];
				$contentlist[$key]['pic_list'][$keys]['pic_content'] = $vals['pic_content'];
			}
		}
		echojson(0,$contentlist);
	}

	/**
	 *description:获取标签基本信息
	 *author:yanyalong
	 *date:2013/09/11
	 */
	public function taginfo(){
		safeFilter();
		$class= isset($_POST['type'])?$this->input->post('type'):"装修风格";
		if($class==""){
			$class = "装修风格";
		}
		$tag_name= isset($_POST['tag'])?$this->input->post('tag'):"";
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$this->config->load('uploads');
		$config = $this->config->item('theme');
		$this->config->load('url');
		$urlconfig = $this->config->item('url');
		$tag = array();
		if($tag_name!=""){
			$res = model("t_tag")->taginfobyname($tag_name);		
			if(empty($res)){
				echojson(1,'无相关数据');
			}
			if($user_id==""){
				$taginfo['is_take'] = "0";	
			}else{
				$taginfo['is_take'] = model('t_tag_take')->exist_take($res['tag_id'],$user_id);
			}
			$taginfo['likes'] = $res['tag_likes'];
			//获取标签订阅数	
			$taginfo['takes']= $res['tag_users'];
			$taginfo['contents']= $res['tag_count'];
			$taginfo['desc']= $res['tag_seodesc'];
			if($res['tag_img']!=''){
				if(!file_exists($config['upload_path'].$res['tag_img'])){
					$taginfo['img'] = $this->config->base_url().$config['default_3']; 	
				}else{
					$taginfo['img'] = $this->config->base_url().$config['relative_path'].'source/'.$res['tag_img'];
				}
			}else{
					$taginfo['img'] = $this->config->base_url().$config['default_3']; 	
			}
			$taginfo['name'] = $res['tag_name'];
			$taginfo['id'] = $res['tag_id'];
			$taglist = model("t_s_class_tag")->taglist($res['tag_id'],$class);
			foreach ($taglist as $key=>$val) {
				$tag['taglist'][$key]['url']= $urlconfig['tagurl'].$class.$urlconfig['tagpara'].$val->tag_name;
				$tag['taglist'][$key]['tag']= $val->tag_name;
			}
		}else{
			$res = model("t_system_class")->classinfobyname($class);		
			if(empty($res)){
				echojson(1,'无相关数据');
			}
			$this->load->model("t_system_class_model");
			$taginfo['likes'] = $this->t_system_class_model->countbyclass($res->s_class_id)->likes;
			$taginfo['contents'] = $this->t_system_class_model->countbyclass($res->s_class_id)->contents;
			$taginfo['takes'] = $this->t_system_class_model->countbyclass($res->s_class_id)->takes;
			$taginfo['desc']= $res->s_class_seodesc;
			if(trim($res->s_class_img)!=''){
				if(!file_exists($config['upload_path'].$res->s_class_img)){
					$taginfo['img'] = $this->config->base_url().$config['default_3']; 	
				}else{
					$taginfo['img'] = $this->config->base_url().$config['relative_path'].'source/'.$res->s_class_img;
				}
			}else{
				$taginfo['img'] = $this->config->base_url().$config['default_3']; 	
			}
			$taginfo['name'] = $res->s_class_name;

			$taglist = model("t_system_class")->taglist($class);
			foreach ($taglist as $key=>$val) {
				$tag['taglist'][$key]['url']= $urlconfig['tagurl'].$class.$urlconfig['tagpara'].$val->tag_name;
				$tag['taglist'][$key]['tag']= $val->tag_name;
			}
		}
		$taginfo['likes'] = ($taginfo['likes']==null)?"0":$taginfo['likes'];
		$taginfo['contents'] = ($taginfo['contents']==null)?"0":$taginfo['contents'];
		$taginfo['takes'] = ($taginfo['takes']==null)?"0":$taginfo['takes'];
		$tag['taginfo'] = $taginfo;
		$tag['tagnum'] = count($taglist);
		echojson(0,$tag);
	}

	/**
	 *description:获取标签下明星用户
	 *author:yanyalong
	 *date:2013/08/24
	 */
	public function tagstar(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$tag_name= $this->input->post('tag',true);
		$tag_id = model("t_tag")->get_tag_id($tag_name);
		if($tag_id==false){
			echojson(1,"",'无相关数据');
		}
		$user_idarr= model("t_tag")->tagstar($tag_id,$user_id,10);
		$this->config->load('url');
		$config = $this->config->item('url');
		if(!empty($user_idarr)){
			foreach ($user_idarr as $key=>$val) {
				if($user_id==""){
					$user_idarr[$key]['is_follow'] = "0"; 
					$user_idarr[$key]['is_me'] = "0";
				}else{
					$user_idarr[$key]['is_follow'] =  model('t_user_follow')->is_follow($user_id,$val['user_id']); 
					$user_idarr[$key]['is_me'] = ($user_id==$val['user_id'])?"1":"0";
				}
				$user_idarr[$key]['user_type'] = ($val['user_type']=='2')?"明星用户":"";
				$user_idarr[$key]['userspace'] = $config['userspace'].$val['user_id'];	
				$user_idarr[$key]['pic'] = model("t_user_info")->avatar($val['user_id']);
			}
			echojson(0,$user_idarr);
		}else{
			echojson(1,"",'无相关数据');
		}
	}
	/**
	 *description:我的订阅列表数据
	 *author:yanyalong
	 *date:2013/11/13
	 */
	public function takelist(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:'';
		$takelist = model("t_tag_take")->getbytake($user_id);
		if($takelist==false){
			echojson("1","","无相关数据");	
		}
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($takelist as $key=>$val) {
			$take[$key]['tid'] = $val->tag_id;
			$take[$key]['tag'] = $val->tag_name;
			$take[$key]['tag_url'] = $config['tagurl'].$val->tag_name;
			$take[$key]['takes'] = $val->tag_users;
			$take[$key]['sum'] = $val->tag_count;
		}
		echojson("0",$take);	
	}
	/**
	 *description:标签浏览页
	 *author:yanyalong
	 *date:2013/11/13
	 */

	public function browsetag(){
		$this->load->model('t_system_model');
		$tags = $this->t_system_model->theme_recommend(9);
		$tag['motif_list'] = $tags;	
		$tagrank = model('t_content_tag')->tagrank(1,15);			
		$tag['tag_list']= $tagrank;
		echojson(0,$tag);
	}
	/**
	 *description:主题TOP10
	 *author:yanyalong
	 *date:2013/11/14
	 */
	public function recommend(){
		$res = model('t_content_tag')->themerank(10);			
		if($res==false){
			echojson(1,"","无相关数据");
		}
		$this->config->load('url');
		$config = $this->config->item('url');
		$this->config->load('uploads');
		$theme_config = $this->config->item('theme');
		$themerank = array();
		foreach ($res as $key=>$val) {
			$themerank[$key]['takes'] = $val->tag_users;		
			$themerank[$key]['tag'] = $val->tag_name;		
			$themerank[$key]['tag_url'] = $config['tagurl'].$val->tag_name;		
			if(!file_exists($theme_config['thumb_2'].$val->tag_img)){
				$themerank[$key]['tag_pic'] = $this->config->base_url().$theme_config['default_2']; 	
			}else{
				$themerank[$key]['tag_pic'] = $theme_config['relative_path'].'thumb_2/'.$val->tag_img;	
			}
		}
		echojson(0,$themerank);
	}
}



