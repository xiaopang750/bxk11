<?php

/**
 *description:设计方案
 *author:yanyalong
 *date:2013/12/16
 */
class room extends user_controller {

	function __construct(){
		parent::__construct();
	}

	/**
	 *description:获取房间标签列表
	 *author:yanyalong
	 *date:2013/12/16
	 */

	public function typelist(){
		$list = model("t_system_class")->classlist(13,"设计");		
		if($list==false){
			echojson(1,"","无相关数据");
		}
		$bclass = array();
		foreach ($list as $key=>$val) {
			$bclass[] = $val->s_class_name;
		}
		$bclass = array_values(array_unique($bclass));
		$taglis = array();
		foreach ($bclass as $key=>$val) {
			$i=0;
			foreach ($list as $keys=>$vals) {
				$taglist[$key]['bname'] = $val;	
				if($vals->s_class_name==$val){
					$res= model("t_system_class")->taglist($vals->s_class_name);
					foreach ($res as $keyss=>$valss) {
						$taglist[$key]['sname'][$keyss]['tag_id'] = $valss->tag_id;
						$taglist[$key]['sname'][$keyss]['tag_name'] = $valss->tag_name;
					}
				}
				$i++;
			}
		}
		echojson(0,$taglist);		
	}
	/**
	 *description:获取2d房间图片信息
	 *author:yanyalong
	 *date:2013/12/17
	 */
	public function getroompic(){
		safeFilter();
		$room_id = isset($_post['room_id'])?$this->input->post('room_id',true):'';
		$roominfo= model("t_project_room")->get($room_id);
		if($roominfo==false){
			echojson(1,'','不存在的房间');
		}
		$room_arr = array();
		switch ($roominfo->room_type) {
		case '1':
			$res = model("t_project_room_pic")->getroompic($room_id);
			if($res==false){
				echojson(1,'','无相关数据');
			}
			foreach ($res as $key=>$val) {
				$room_arr[] = $val->room_pic_md5;				
			}
			break;
		case '2':
			$room_arr = roomurl($room_id);
			break;
		}
		echojson(0,$room_arr);
	}

	/**
	 *description:获取3d房间预览地址
	 *author:liuguangping
	 *date:2013/12/18
	 */
	public function getroompreview(){
		safeFilter();
		$room_id = isset($_post['room_id'])?$this->input->post('room_id',true):'';
		//预览xml接口
		$this->config->load('uploads');
		$room3d_name = $this->config->item('room_3d');
		if(!is_numeric($room_id)){
			echojson(1, '','房间号只能为数字');
		}
		$roomurl = roomurl($room_id);

		$isexists = $_server['document_root'].$roomurl.'f.jpg';
		if(!file_exists($isexists)){
			echojson(1, '','该房间不存在，预览失败！');
		}

		//生成3d长条图和缩略图各预览图
		$this->load->library('image_lib');
		if(!$this->image_lib->pic_group($roomimag)){
			echojson(1, '','预览图片生成失败！');
		}

		$this->load->library('roomlib_class');
		if($this->roomlib_class->preview($room_id)){
			$this->config->load('view');
			$url = $this->config->item('index');
			$this->load->helper('url');
			$array = array('xml'=>site_url($url['roompreview']).'?room_id='.$room_id);
			echojson(0, $array,'生成成功！');
		}else{
			echojson(1, '','生成xml失败！');
		}
	}

	/**
	 *description:获取3d方案地址
	 *author:liuguangping
	 *date:2013/12/18
	 */
	public function get3dxml(){
		safeFilter();
		$scheme_id = isset($_post['scheme_id'])?$this->input->post('scheme_id',true):'';
		//$scheme_id = 6;
		if(!is_numeric($scheme_id)){
			echojson(1, '','方案id只能为数字');
		}
		$this->load->library('roomlib_class');
		if($this->roomlib_class->xml3d($scheme_id)){
			$this->config->load('view');
			$url = $this->config->item('index');
			$this->load->helper('url');
			$array = array('xml'=>site_url($url['xml3d']).'?scheme_id='.$scheme_id);
			echojson(0, $array,'生成成功！');
		}else{
			echojson(1, '','生成xml失败！');
		}
	}
	/**
	 *description:搜索筛选项
	 *author:yanyalong
	 *date:2013/12/21
	 */
	public function option(){
		$this->config->load('project');
		$schemeconfig= $this->config->item('room');
		//面积
		$i = 0;
		foreach ($schemeconfig['area'] as $key=>$val) {
			$area['tag_list'][$i]['tag_id'] = $key;
			$area['tag_list'][$i]['tag_name'] = $val;
			$area['option_name'] = "面积";
			$area['option_type'] = "area";
			$i++;
		}
		$taglist['t2'] = $area;
		//空间,风格,色调
		$list = model("t_system_class")->classlist(13,"设计");		
		$bclass = array();
		foreach ($list as $key=>$val) {
			$bclass[] = $val->s_class_name;
		}
		$bclass = array_values(array_unique($bclass));
		$taglis = array();
		foreach ($bclass as $key=>$val) {
			if($val=='房间功能'||$val=='设计风格'||$val=='色系'){
				foreach ($list as $keys=>$vals) {
					if($vals->s_class_name==$val){
						$res= model("t_system_class")->taglist($vals->s_class_name);
						$i=1;
						$j=1;
						$k=1;
						$taglist['t1']['tag_list'][0]['tag_id'] = "0";
						$taglist['t1']['tag_list'][0]['tag_name'] = "不限";
						$taglist['t3']['tag_list'][0]['tag_id'] = "0";
						$taglist['t3']['tag_list'][0]['tag_name'] = "不限";
						$taglist['t4']['tag_list'][0]['tag_id'] = "0";
						$taglist['t4']['tag_list'][0]['tag_name'] = "不限";
						foreach ($res as $keyss=>$valss) {
							switch ($val) {
							case '房间功能':
								$taglist['t1']['tag_list'][$i]['tag_id'] = $valss->tag_id;
								$taglist['t1']['tag_list'][$i]['tag_name'] = $valss->tag_name;
								$taglist['t1']['option_type'] = "func";	
								$taglist['t1']['option_name'] = "空间";	
								break;
							case '设计风格':
								$taglist['t3']['tag_list'][$j]['tag_id'] = $valss->tag_id;
								$taglist['t3']['tag_list'][$j]['tag_name'] = $valss->tag_name;
								$taglist['t3']['option_type'] = "style";	
								$taglist['t3']['option_name'] = "风格";	
								break;
							case '色系':
								$taglist['t4']['tag_list'][$k]['tag_id'] = $valss->tag_id;
								$taglist['t4']['tag_list'][$k]['tag_name'] = $valss->tag_name;
								$taglist['t4']['option_type'] = "style";	
								$taglist['t4']['option_name'] = "色系";	
								break;
							}
							$i++;
							$j++;
							$k++;
						}
					}
				}
			}
		}
		$tagarr = array();
		$tagarr['t1'] = $taglist['t1'];
		$tagarr['t2'] = $taglist['t2'];
		$tagarr['t3'] = $taglist['t3'];
		$tagarr['t4'] = $taglist['t4'];
		echojson(0,$tagarr);

	}
	/**
	 *description:搜索样板间
	 *author:yanyalong
	 *date:2013/12/21
	 */
	public function search(){
		safeFilter();
		$sort= isset($_POST['sort'])?$this->input->post('sort'):"1";
		$func= isset($_POST['t1'])?$this->input->post('t1'):"";
		if($func=="0"){
			$func = "";	
		}
		$area= isset($_POST['t2'])?$this->input->post('t2'):"";
		if($area=="0"){
			$area= "";	
		}
		$style= isset($_POST['t3'])?$this->input->post('t3'):"";
		if($style=="0"){
			$style= "";	
		}
		$color= isset($_POST['t4'])?$this->input->post('t4'):"";
		if($color=="0"){
			$color= "";	
		}
		$keyword= isset($_POST['keyword'])?$this->input->post('keyword'):"";
		$p= isset($_POST['p'])?$this->input->post('p'):"";
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$row = 5;
		loadLib("SearchRoomList");
		$res = SearchRoomFactory::createObj($sort,$area,$color,$style,$func,$keyword,$p,$row);	
		if($res==false){
			echojson(1,"","无相关数据");
		}
		$data = array();
		$this->config->load('url');
		$config = $this->config->item('url');
		$this->load->model('t_user_info_model');
		$this->load->model('t_project_room_model');
		foreach ($res as $key=>$val) {
			$data[$key]['room_name'] = $val->room_name;
			$data[$key]['room_thinking'] = $val->room_thinking;
			$data[$key]['room_views'] = $val->room_views;
			$data[$key]['room_url'] = $config['roominfo'].$val->room_id;
			$data[$key]['room_pic'] =  roomurl($val->room_id)."rectangle_thumb.jpg";
			$data[$key]['user_pic'] = $this->t_user_info_model->avatar($val->user_id);
			$data[$key]['user_id'] = $val->user_id;
			$data[$key]['designer'] = $val->user_nickname;
			$data[$key]['company'] = $val->user_company;
			$data[$key]['userspace'] = $config['userspace'].$val->user_id;
			$data[$key]['sendmsg'] = $config['sendmsg'];
			$tagarr = explode(',',$val->room_keyword);
			//$tagarr =model("t_project_room_tag")->getTagByRoom($val->room_id); 
			foreach ($tagarr as $keys=>$vals) {
				$data[$key]['roomtag_list'][$keys]['tag_name']= $vals; 
				$data[$key]['roomtag_list'][$keys]['tag_url']= "#"; 
			}
			if($user_id==""){
				$data[$key]['is_follow'] = "0";		
			}else{
				$data[$key]['is_follow'] = model('t_user_follow')->is_follow($user_id,$val->user_id);	
			}
			$data[$key]['is_me'] = ($val->user_id==$user_id)?"1":"0";
		}
		echojson(0,$data);
	}
	/**
	 *description:样板间详情页
	 *author:yanyalong
	 *date:2013/12/24
	 */
	public function info(){
		safeFilter();
		$room_id= isset($_POST['rid'])?$this->input->post('rid'):"";
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($room_id==""){
			echojson(1,"","无相关数据");
		}
		$this->config->load('url');
		$config = $this->config->item('url');
		$this->config->load('uploads');		
		$floor_config = $this->config->item("floor_pic1");		
		$this->load->model('t_project_scheme_model');
		$this->load->model('t_project_floor_model');
		$this->load->model('t_project_room_model');
		//更新方案查看数		
		$this->t_project_room_model->room_status($room_id,"room_views",'+');	
		$this->load->model('t_project_room_tag_model');
		$this->load->model('t_user_info_model');
		$res = $this->t_project_room_model->getTheRoomInfoById($room_id);	
		$data['swf_url'] = $config['previewShow3d'].$room_id;
		$data['project_name'] = $res->project_name;
		$data['scheme_url'] = $config['schemeinfo'].$res->scheme_id;
		$data['scheme_name'] = $res->scheme_name;
		$room_type = $this->t_project_room_tag_model->getFuncByRoomId($room_id,'房间功能');
		if($room_type!=false){
			$data['room_type'] = $room_type->tag_name;	
		}else{
			$data['room_type']= "";
		}
		$data['room_size'] = $res->room_size;
		$data['room_thinking'] = $res->room_thinking;
		$data['room_name'] = $res->room_name;
		$data['room_id'] = $res->room_id;
		$data['designer'] = $res->scheme_designer;
		$data['user_id'] = $res->scheme_designer_id;
		$data['company'] = $res->user_company;
		$data['send_message'] = $res->user_company;
		$data['floor_pic1'] = getfloor1url($res->scheme_id,$res->floor_id).'pic1_1.jpg';
		$data['width'] = $floor_config['thumb_size_1_x'];
		$data['width'] = $floor_config['thumb_size_1_y'];
		$data['hight'] = $res->user_company;
		$data['userspace'] = $config['userspace'].$res->scheme_designer_id;
		$data['user_pic'] = $this->t_user_info_model->avatar($res->scheme_designer_id);
		if($user_id==""){
			$data['is_follow'] = "0";		
			$data['is_collect'] = "0";		
		}else{
			$data['is_collect'] = model('t_like_room')->is_like($room_id,$user_id);	
			$data['is_follow'] = model('t_user_follow')->is_follow($user_id,$res->scheme_designer_id);	
		}
		$data['user_level'] = $res->group_id;
		$data['is_me'] = ($res->scheme_designer_id==$user_id)?"1":"0";
		$map = roommap($res->floor_map_coor,$room_id);
		$data['mapx']= $map['mapx'];
		$data['mapy']= $map['mapy'];
		$tagarr =$this->t_project_room_tag_model->getTagByRoom($room_id); 
		//相关样板间
		$roomlist  =$this->t_project_room_model->getTheRoomListByTheme($res->scheme_id,$room_id);
		foreach ($roomlist as $key=>$val) {
			$data['room_list'][$key]['room_pic'] = roomurl($val->room_id)."big_thumb.jpg";	
			$data['room_list'][$key]['room_url'] = $config['roominfo'].$val->room_id; 
			$data['room_list'][$key]['room_name'] = $val->room_name;
		}
		foreach ($tagarr as $key=>$val) {
			$data['roomtag_list'][]= $val->tag_name; 
		}
		echojson(0,$data);
	}
	/**
	 *description:获取房间评论列表
	 *author:yanyalong
	 *date:2013/11/07
	 */
	public function getdiscu(){
		safeFilter();
		$p= $this->input->post('p',true);
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$room_id= $this->input->post('rid',true);
		//$room_id = 708;
		$this->load->model('t_room_discussion_model');
		$roominfo = $this->t_room_discussion_model->room_show($room_id,$p,10);
		if(empty($roominfo)){
			echojson(1,"",'暂无任何评论');
		}		
		foreach ($roominfo as $key=>$val) {
			if($user_id!=""){
				$roominfo[$key]['is_black']= model('t_user_disable')->is_black($user_id,$val['user_id']);
			}else{
				$roominfo[$key]['is_black']= "";
			}
		}
		echojson(0,$roominfo);
	}
	/**
	 *description:房间家居产品
	 *author:yanyalong
	 *date:2013/12/26
	 */
	public function bill(){
		safeFilter();
		$room_id= $this->input->post('rid');
		$this->load->model("t_project_room_model");
		if($room_id==""||($this->t_project_room_model->get($room_id)==false)){
			echojson(1,"",'非法操作');
		}
		$this->config->load('url');
		$config = $this->config->item('url');
		$this->load->model('t_project_room_bill_item_model');
		$res = $this->t_project_room_bill_item_model->getProductListByDesignRoomId($room_id);
		if($res==false){
			echojson(1,"","无相关数据");
		}
		$this->config->load('uploads');		
		$upload_config= $this->config->item("product");		
		$data = array();
		$count = count($res);
		$cost = "";
		foreach ($res as $key=>$val) {
			$cost +=$val->product_price;
			$data['product_list'][$key]['product_id'] = $val->product_id;
			$data['product_list'][$key]['product_name'] = $val->product_name;
			$data['product_list'][$key]['product_price'] = $cost;
			$data['product_list'][$key]['product_url'] =$config['productinfo'].$val->product_id;
			$data['product_list'][$key]['product_size'] =$val->product_long."*".$val->product_width."*".$val->product_high;
			$data['product_list'][$key]['product_pic'] =$upload_config['relative_path']."index".$val->product_pic;
		}
		$data['bill_name'] = "当前房间家居产品";
		$data['bill_cost'] = $cost; 
		$data['bill_off'] =  "节省了100元";
		echojson(0,$data);
	}

	/**
	 *description:生成3dJsXml文件
	 *author:liuguangping
	 *date:2014/3/3
	 */
	public function createJsXml(){
		safeFilter();
		$room_id= $this->input->get('room');
		$roomurl = roomurl($room_id);
		$xmlPath = $_SERVER['DOCUMENT_ROOT'].$roomurl.'ok.xml';
		header('Access-Control-Allow-Origin: *');
		header("Content-type: text/xml");
		$xml = file_get_contents($xmlPath);
		echo $xml;exit;
	}

}

