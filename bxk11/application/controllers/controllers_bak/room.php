<?php
/**
 *description:用户信息
 *author:yanyalong
 *date:2013/11/05
 */
class Room extends User_Controller {
	public $xmldata;
	public $roomlib;
	function __construct(){
		parent::__construct();
		
		loadLib("Roomlib_Class");
		$this->roomlib = new Roomlib_Class();
/* 		$this->load->library('xmldata_class');	
		$this->load->library('roomlib_class');
		$this->roomlib = $this->roomlib_class;
		$this->xmldata = $this->xmldata_class; */
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');
		$this->load->helper('url');
	}
	/**
	 * 样板间预览并生成
	 * @author liuguangping
	 * @param room_id 请求过来的值
	 * @todo 当xml没有和数据更新时则去更新xml
	 */
	public function preview(){
		safeFilter();
		//$this->checkdesign();
		$room_id = $this->input->get('rid',true);
		$home_url = site_url('user/home');
		$this->config->load('uploads');
		$room3d_name = $this->config->item('room_3d');
		$roomurl = roomurl($room_id);
		$this->load->model("t_user_model");
	
		if(!isset($_SESSION['user_id'])){
			echo "<script>alert('该用户还未全登入，请登入！');window.location.href='".$home_url."'</script>";exit;
		}
		$user_id = $_SESSION['user_id'];
		//预览xml接口
		if(!is_numeric($room_id)){
			echo "<script>alert('房间号只能为数字！');window.location.href='".$home_url."'</script>";exit;
			//echojson(1, '','房间号只能为数字');
		}
		
		//判断设计师
		if(!$this->t_user_model->is_designer($user_id)){
			echo "<script>alert('该用户不是设计师，没有权力生成 ，非法访问！');window.location.href='".$home_url."'</script>";exit;
		}
		$isexists = $_SERVER['DOCUMENT_ROOT'].$roomurl.'f.jpg';
		if(!file_exists($isexists)){
			echo "<script>alert('你上传的素材没找到，不能生成！');window.location.href='".$home_url."'</script>";exit;
			//echojson(1, '','该房间不存在，预览失败！');
		}
		$this->load->model('t_project_room_model');
		$t_project_room = $this->t_project_room_model;
		$room_fist = $t_project_room->get($room_id);
		if(!$room_fist || $room_fist->room_status == 11 || $room_fist->room_status == 99 || $room_fist->room_status == 12){//没有这个房间或者是不正常的房间
			echo "<script>alert('没有这个房间或者是不正常的房间!');window.location.href='".$home_url."'</script>";exit;
		}
		if(!$this->roomlib->createThumbXml($room_id)){
			echo "<script>alert('生成预览失败！');window.location.href='".$home_url."'</script>";exit;
		}
		//判断js3dxml是不是生成
		if(!$this->roomlib->createJs3D($room_id)){
			echo "<script>alert('生成Wapxml失败！');window.location.href='".$home_url."'</script>";exit;
		}
		$isexists = $roomurl.$room3d_name['room_xml_name'].'.xml';
		$this->config->load('view');
		$url = $this->config->item('index');
		$result  = array('xml'=>$isexists,'title'=>'样板间');
		$this->load->view($url['roompreview'],$result);

	}

	/**
	 * 样板间预览
	 * @author liuguangping
	 * @param room_id 请求过来的值
	 */
	public function previewShow(){
		safeFilter();
		$room_id = $this->input->get('rid',true);
		//这里room_type有值则是infidea官网所要的xml
		$room_type = $this->input->get('type',true);
		$home_url = site_url('user/home');
		$this->config->load('uploads');
		$room3d_name = $this->config->item('room_3d');
		$roomurl = roomurl($room_id);
		$isexists = $roomurl.$room3d_name['room_xml_name'].'.xml';
		//这里room_type有值则是infidea官网所要的xml
		if(isset($room_type) && ($room_type == 'infidea')) 
			$isexists = $roomurl.$room_type.'.xml';
		//echo $isexists;die;
		$this->config->load('view');
		$url = $this->config->item('index');
		$result  = array('xml'=>$isexists,'title'=>'样板间');
		$this->load->view($url['roomshow'],$result);
	}
	
	/**
	 * 3d全景场景预览并生成
	 * @author liuguangping
	 * @param room_id 请求过来的值
	 * @todo 当xml没有和数据更新时则去更新xml
	 */
	public function xml3d(){
		safeFilter();
		//预览xml接口
		$scheme_id = $this->input->get('sid',true);
		$home_url = site_url('user/home');
		$this->load->model("t_user_model");
		if(!isset($_SESSION['user_id'])){
			echo "<script>alert('该用户还未全登入，请登入！');window.location.href='".$home_url."'</script>";exit;
		}
		$user_id = $_SESSION['user_id'];
		if(!is_numeric($scheme_id)){

			echo "<script>alert('方案ID只能为数字！');window.location.href='".$home_url."'</script>";exit;
			//echojson(1,'','方案ID只能为数字');
		}
		//判断设计师
		if(!$this->t_user_model->is_designer($user_id)){
			echo "<script>alert('该用户不是设计师，没有权力生成 ，非法访问！');window.location.href='".$home_url."'</script>";exit;
		}
		if(!$this->roomlib->xml3d($scheme_id)){
			echo "<script>alert('生成方案失败！');window.location.href='".$home_url."'</script>";exit;
		}
		$this->config->load('uploads');
		$room3d_name = $this->config->item('room_3d');
		$roomurl = xmlurl($scheme_id);
		$isexists = $roomurl.$room3d_name['room_xml_name'].'.xml';
		$this->config->load('view');
		$url = $this->config->item('index');
		$result  = array('xml'=>$isexists,'title'=>'方案');
		$this->load->view($url['xml3d'],$result);
	}
	
	
	/**
	 * 3d全景场景预览
	 * @author liuguangping
	 * @param sid 请求过来的值
	 * @todo 当xml没有和数据更新时则去更新xml
	 */
	public function xml3dShow(){
		safeFilter();
		//预览xml接口
		$scheme_id = $this->input->get('sid',true);
		$this->config->load('uploads');
		$room3d_name = $this->config->item('room_3d');
		$roomurl = xmlurl($scheme_id);
		$isexists = $roomurl.$room3d_name['room_xml_name'].'.xml';
		$this->config->load('view');
		$url = $this->config->item('index');
		$result  = array('xml'=>$isexists,'title'=>'方案');
		$this->load->view($url['xml3d'],$result);
	}
	
	/**
	 * 3d全景场景预览
	 * @author liuguangping
	 * @param sid 请求过来的值
	 * @todo 当xml没有和数据更新时则去更新xml
	 */
	public function xml3dRecommend(){
		safeFilter();
		//预览xml接口
		$scheme_id = $this->input->get('sid',true);
		$this->config->load('uploads');
		$room3d_name = $this->config->item('room_3d');
		$roomurl = xmlurl($scheme_id);
		$isexists = $roomurl.$room3d_name['recommend_xml_name'].'.xml';
		$this->config->load('view');
		$url = $this->config->item('index');
		$result  = array('xml'=>$isexists,'title'=>'方案');
		$this->load->view($url['xml3d'],$result);
	}
	
	/**
	 * 3d diy全景场景生成并预览
	 * @author liuguangping
	 * @param scheme_id 请求过来的值 方案
	 * @todo 当xml没有和数据更新时则去更新xml
	 */
	public function xml3Ddiy(){
		safeFilter();
		//预览xml接口
		$scheme_id = $this->input->get('sid',true);
		$home_url = site_url('user/home');
	
		$this->load->model("t_user_model");
		if(!isset($_SESSION['user_id'])){
			echo "<script>alert('该用户还未全登入，请登入！');window.location.href='".$home_url."'</script>";exit;
		}
		$user_id = $_SESSION['user_id'];
		if(!is_numeric($scheme_id)){
			echo "<script>alert('方案ID只能为数字！');window.location.href='".$home_url."'</script>";exit;
			//echojson(1,'','方案ID只能为数字');
		}
		//判断设计师
		if(!$this->t_user_model->get($user_id)){
			echo "<script>alert('该用户不存在，没有权力生成 ，非法访问！');window.location.href='".$home_url."'</script>";exit;
		}
		
		if(!$this->roomlib->diy3D($scheme_id)){
			echo "<script>alert('生成方案失败！');window.location.href='".$home_url."'</script>";exit;
		}
		$this->config->load('uploads');
		$room3d_name = $this->config->item('room_3d');
		$roomurl = xmlurl($scheme_id);
		$isexists = $roomurl.$room3d_name['diy_xml_name'].'.xml';
		$this->config->load('view');
		$url = $this->config->item('index');
		$result  = array('xml'=>$isexists,'title'=>'DIY方案');
		$this->load->view($url['diy3d'],$result);
	}
	
	/**
	 * 
	 */
	public function xml3DdiyShow(){
		safeFilter();
		//预览xml接口
		$scheme_id = $this->input->get('sid',true);
		$this->config->load('uploads');
		$room3d_name = $this->config->item('room_3d');
		$roomurl = xmlurl($scheme_id);
		$isexists = $roomurl.$room3d_name['diy_xml_name'].'.xml';
		$this->config->load('view');
		$url = $this->config->item('index');
		$result  = array('xml'=>$isexists,'title'=>'DIY方案');
		$this->load->view($url['diy3d'],$result);
	}
	/**
	 *description:样板间搜索页
	 *author:yanyalong
	 *date:2013/12/21
	 */
	public function search(){
		$data['config']	= $this->myinfo();
		$data['title']	= "样板间搜索";
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['roomsearch'],$data);	
	}

	/**
	 *description:案例详情页
	 *author:yanyalong
	 *date:2013/12/24
	 */
	public function info(){
		safeFilter();
		$room_id= isset($_GET['rid'])?$this->input->get('rid',true):'';
		$roominfo= model("t_project_room")->get($room_id);
		if($roominfo==false){
			header("Location:/index.php/user/home");exit;
		}
		$data['config']	= $this->myinfo();
		$data['title']	= $roominfo->room_name;
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['roominfo'],$data);	
	}
}

