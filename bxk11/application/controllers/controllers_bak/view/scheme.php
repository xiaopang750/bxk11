<?php
/**
 *description:设计方案
 *author:yanyalong
 *date:2013/12/16
 */
class Scheme extends User_Controller {

	function __construct(){
		parent::__construct();
	}

	/**
	 *description:获取装修方案列表
	 *author:yanyalong
	 *date:2013/12/11
	 */
	public function getlist(){
		safeFilter();
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$project_id = $this->input->post('pid',true);
		$scheme_type = $this->input->post('scheme_type',true);
		if($user_id==""){
			echojson(1,"","无相关数据");
		}
		$list = model("t_project_scheme")->schemelist($user_id,$project_id,$scheme_type);		
		if($list==false){
			echojson(1,"","无相关数据");
		}
		$scheme = array();
		foreach($list as $key=>$val){
			$scheme[$key]['scheme_id'] = $val->scheme_id;
			$scheme[$key]['scheme_name'] = $val->scheme_name;
			$scheme[$key]['scheme_cost'] = $val->scheme_cost;
			$scheme[$key]['scheme_thinking'] = $val->scheme_thinking;
		}
		echojson(0,$scheme);
	}
	/**
	 *description:获取方案详情
	 *author:yanyalong
	 *date:2013/12/19
	 */
	public function modinfo(){
		safeFilter();
		$scheme_id = $this->input->post('scheme_id',true);
		if($scheme_id==""){
			echojson(1,"","无相关数据");
		}	
		//获取方案基本信息
		$schemeinfo= model("t_project_scheme")->get($scheme_id);
		if($schemeinfo==false){
			echojson(1,"","无相关数据");
		}	
		$data['schemeinfo']['scheme_id']	= $schemeinfo->scheme_id;
		$data['schemeinfo']['scheme_type']	= $schemeinfo->scheme_type;
		$data['schemeinfo']['scheme_name']	= $schemeinfo->scheme_name;
		$data['schemeinfo']['scheme_cost']	= $schemeinfo->scheme_cost;
		$data['schemeinfo']['scheme_thinking']	= $schemeinfo->scheme_thinking;
		$data['schemeinfo']['scheme_status']	= $schemeinfo->scheme_status;
		//获取楼层列表信息
		$floor = model("t_project_floor")->floorlist($scheme_id);
		foreach ($floor as $key=>$val) {
			$data['floor'][$key]['floorinfo']['floor_id']	= $val->floor_id;
			$data['floor'][$key]['floorinfo']['pic1_1']	=getfloor1url($scheme_id,$val->floor_id)."pic1_1.jpg";
			$data['floor'][$key]['floorinfo']['pic1_2']	=getfloor1url($scheme_id,$val->floor_id)."pic1_2.jpg";
			$floor_room =model("t_project_floor_room")->getRoomByFloor($val->floor_id);
			//$floor_room = false;
			if($floor_room==false){
				$data['floor'][$key]['room']['0']['room_id']	= "";
				$data['floor'][$key]['room']['0']['room_name']	= "";
				$data['floor'][$key]['room'][$keys]['name']	= "";
				$data['floor'][$key]['room']['0']['room_size']	= "";
				$data['floor'][$key]['room']['0']['room_keyword']	= "";
				$data['floor'][$key]['room']['0']['tags']	= "";
				$data['floor'][$key]['room']['0']['mapx']	="";
				$data['floor'][$key]['room']['0']['mapy']	= "";
				$data['floor'][$key]['room']['0']['room_thinking']	= "";
			}else{
				$data['floor'][$key]['floorinfo']['room_num']= count($floor_room);
				foreach ($floor_room as $keys=>$vals) {
					$room = model("t_project_room")->get($vals->room_id);
					$data['floor'][$key]['room'][$keys]['room_id']	= $room->room_id;
					$data['floor'][$key]['room'][$keys]['room_name']	= $room->room_name;
					$data['floor'][$key]['room'][$keys]['room_size']	= $room->room_size;
					$data['floor'][$key]['room'][$keys]['room_keyword']	= $room->room_keyword;
					$keyword = explode(',',$room->room_keyword);
					$data['floor'][$key]['room'][$keys]['name']	= $keyword['0'];
					$data['floor'][$key]['room'][$keys]['tags']	= model("t_project_room_tag")->getTaglist($room->room_id);
					$roommap = roommap($val->floor_map_coor,$room->room_id);
					$data['floor'][$key]['room'][$keys]['mapx']	= $roommap['mapx'];
					$data['floor'][$key]['room'][$keys]['mapy']	= $roommap['mapy'];
					$data['floor'][$key]['room'][$keys]['room_thinking']= $room->room_thinking;
					switch ($schemeinfo->scheme_type) {
					case '1':
						$roomcontent = model("t_project_room_plane")->roomContent($room->room_id);
						$data['floor'][$key]['room'][$keys]['roomcontent']	= $roomcontent;
						$data['floor'][$key]['room'][$keys]['imglist']	= "";
						break;
					case '2':
						$data['floor'][$key]['room'][$keys]['room_content']	= "";
						$data['floor'][$key]['room'][$keys]['imglist']	= roomurlpic($room->room_id);
						break;
					}
				}
			}
		}
		echojson(0,$data);
	}
	/**
	 *description:搜索筛选项
	 *author:yanyalong
	 *date:2013/12/21
	 */
	public function option(){
		$this->config->load('project');
		$schemeconfig= $this->config->item('scheme');
		//户型
		$list = model("t_system_class")->classlist(13,"空间");		
		$bclass = array();
		foreach ($list as $key=>$val) {
			$bclass[] = $val->s_class_name;
		}
		$bclass = array_values(array_unique($bclass));
		$taglist = array();
		foreach ($bclass as $key=>$val) {
			$i=0;
			foreach ($list as $keys=>$vals) {
				if($vals->s_class_name==$val){
					$res= model("t_system_class")->taglist($vals->s_class_name);
					$taglist['t1']['tag_list'][0]['tag_id'] = "0";
					$taglist['t1']['tag_list'][0]['tag_name'] = "不限";
					$i=0;
					foreach ($res as $keyss=>$valss) {
						switch ($val) {
						case '户型':
							$taglist['t1']['tag_list'][$i+1]['tag_id'] = $valss->tag_id;
							$taglist['t1']['tag_list'][$i+1]['tag_name'] = $valss->tag_name;
							$taglist['t1']['option_type'] = "func";	
							$taglist['t1']['option_name'] = "户型";	
							break;
						}
						$i++;
					}
				}
				$i++;
			}
		}
		//风格
		$list = model("t_system_class")->classlist(13,"设计");		
		if($list==false){
			echojson(0,$option);
		}
		$bclass = array();
		foreach ($list as $key=>$val) {
			$bclass[] = $val->s_class_name;
		}
		$bclass = array_values(array_unique($bclass));
		$taglis = array();
		foreach ($bclass as $key=>$val) {
			$i=0;
			if($val=='设计风格'){
				foreach ($list as $keys=>$vals) {
					if($vals->s_class_name==$val){
						$res= model("t_system_class")->taglist($vals->s_class_name);
						$i = 0;
						$taglist['t2']['tag_list'][0]['tag_id'] = "0";
						$taglist['t2']['tag_list'][0]['tag_name'] = "不限";
						foreach ($res as $keyss=>$valss) {
							switch ($val) {
							case '设计风格':
								$taglist['t2']['tag_list'][$i+1]['tag_id'] = $valss->tag_id;
								$taglist['t2']['tag_list'][$i+1]['tag_name'] = $valss->tag_name;
								$taglist['t2']['option_type'] = "style";	
								$taglist['t2']['option_name'] = "风格";	
								break;
							}
							$i++;
						}
					}
					$i++;
				}
			}
		}
		//面积
		$i = 0;
		foreach ($schemeconfig['area'] as $key=>$val) {
			$area['tag_list'][$i]['tag_id'] = $key;
			$area['tag_list'][$i]['tag_name'] = $val;
			$area['option_name'] = "面积";
			$area['option_type'] = "area";
			$i++;
		}
		$taglist['t3'] = $area;
		//造价
		$i = 0;
		foreach ($schemeconfig['cost'] as $key=>$val) {
			$cost['tag_list'][$i]['tag_id'] = $key;
			$cost['tag_list'][$i]['tag_name'] = $val;
			$cost['option_name'] = "造价";
			$cost['option_type'] = "cost";
			$i++;
		}
		$taglist['t4'] = $cost;
		$tagarr = array();
		$tagarr['t1'] = $taglist['t1'];
		$tagarr['t2'] = $taglist['t2'];
		$tagarr['t3'] = $taglist['t3'];
		$tagarr['t4'] = $taglist['t4'];
		echojson(0,$tagarr);
	}
	/**
	 *description:搜索案例
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
		$style= isset($_POST['t2'])?$this->input->post('t2'):"";
		if($style=="0"){
			$style= "";	
		}
		$area= isset($_POST['t3'])?$this->input->post('t3'):"";
		if($area=="0"){
			$area= "";	
		}
		$cost= isset($_POST['t4'])?$this->input->post('t4'):"";
		if($cost=="0"){
			$cost= "";	
		}
		$keyword= isset($_POST['keyword'])?$this->input->post('keyword'):"";
		$p= isset($_POST['p'])?$this->input->post('p'):"1";
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$row = 5;
		loadLib("SearchSchemeList");
		$res = SearchSchemeFactory::createObj($sort,$area,$cost,$style,$func,$keyword,$p,$row);	
		if($res==false){
			echojson(1,"","无相关数据");
		}
		$data = array();
		$this->config->load('url');
		$config = $this->config->item('url');
		$this->config->load('uploads');		
		$upload_config= $this->config->item("room_3d");		
		$this->load->model('t_user_info_model');
		$this->load->model('t_project_room_model');
		$this->load->model('t_project_scheme_tag_model');
		foreach ($res as $key=>$val) {
			$data[$key]['scheme_name'] = $val->scheme_name;
			$data[$key]['scheme_views'] = $val->scheme_views;
			$data[$key]['project_name'] = $val->project_name;
			$data[$key]['scheme_url'] = $config['schemeinfo'].$val->scheme_id;
			$data[$key]['user_pic'] = $this->t_user_info_model->avatar($val->scheme_designer_id);
			$data[$key]['user_id'] = $val->scheme_designer_id;
			$data[$key]['designer'] = $val->scheme_designer;
			$data[$key]['company'] = $val->user_company;
			$data[$key]['userspace'] = $config['userspace'].$val->scheme_designer_id;
			if($user_id==""){
				$data[$key]['is_follow'] = "0";		
			}else{
				$data[$key]['is_follow'] = model('t_user_follow')->is_follow($user_id,$val->scheme_designer_id);	
			}
			$data[$key]['is_me'] = ($val->scheme_designer_id==$user_id)?"1":"0";
			$data[$key]['sendmsg'] = $config['sendmsg'];
			$roomlist  = $this->t_project_room_model->getTheRoomListByTheme($val->scheme_id);
			$count = count($roomlist);
			$data[$key]['room_num'] = $count;
			if($count<2){
				$data[$key]['room_list'][0]['room_pic'] = roomurl($roomlist[0]->room_id)."rectangle_thumb.jpg";	
			}else{
				foreach ($roomlist as $keys=>$vals) {
					if($keys<5){
						$data[$key]['room_list'][$keys]['room_pic'] = roomurl($vals->room_id)."big_thumb.jpg";	
					}
				}
			}
			$data[$key]['schemetag_list'] = $this->t_project_scheme_tag_model->tagListBySchemeId($val->scheme_id);
		}
		echojson(0,$data);
	}
	/**
	 *description:当前方案家居产品
	 *author:yanyalong
	 *date:2013/12/21
	 */
	public function product(){

	}
	/**
	 *description:案例主页
	 *author:yanyalong
	 *date:2013/12/23
	 */
	public function index(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$this->load->model('t_project_scheme_model');
		$this->load->model('t_system_model');
		$this->load->model('t_project_floor_model');
		$this->load->model('t_project_room_model');
		$this->load->model('t_project_room_tag_model');
		$this->load->model('t_user_info_model');
		$this->load->model('t_project_model');
		$this->load->model('t_user_model');
		//获取最新项目设计方案开始
		$scheme_recommend= $this->t_system_model->get("scheme_recommend");
		if($scheme_recommend==false||$scheme_recommend->sys_value==""){
			$topnew = "";
		}
		$res = $this->t_project_scheme_model->schemeListById($scheme_recommend->sys_value,1,5);
		if($res==false){
			$topnew = "";
		}
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($res as $key=>$val) {
			$topnew[$key]['project_name']= $val->project_name;		
			$topnew[$key]['project_owner']= $val->project_owner;		
			$topnew[$key]['subtime']= date("Y年m月",strtotime($val->scheme_subtime));		
			$topnew[$key]['scheme_url']= $config['schemeinfo'].$val->scheme_id;		
			if($key==0){
				$topnew[$key]['pic_url']= "";		
				$topnew[$key]['swf_url']= $config['xml3drecommend'].$val->scheme_id;		
			}else{
				$room_id = $this->t_project_floor_model->getTheOneRoomByScheme($val->scheme_id);
				$topnew[$key]['pic_url']= roomurl($room_id)."big_thumb.jpg";		
				$topnew[$key]['swf_url']= "";
			}
		}
		$data['topnew_list'] = $topnew;
		//获取最新项目设计方案结束
		$designer_recommend= $this->t_system_model->get("designer_recommend");
		if($designer_recommend==false||$designer_recommend->sys_value==""){
			$data['topdesigner'] = "";	
			$data['topdesigner_list'] = "";	
		}
		$designarr = explode(',',$designer_recommend->sys_value);
		$res = $this->t_user_model->getUserByUserIdList($designer_recommend->sys_value,7);
		if($res==false){
			$topdesigner="";			
			$topdesigner_list="";			
		}
		foreach ($res as $key=>$val) {
			if($val->user_id==$designarr['0']){
				$rec_title = $this->t_system_model->get("des_rec_title")->sys_value;
				if($rec_title==""){
				$topdesigner['title'] = "";
				$topdesigner['user_summary'] = "";
				}else{
					$rec_title_arr = explode('|',$rec_title);
				$topdesigner['title'] = $rec_title_arr['0'];
				$topdesigner['user_summary'] = $rec_title_arr['1'];
				}
				$topdesigner['userspace'] =$config['userspace'].$val->user_id; 
				$topdesigner['designer'] =$val->user_nickname; 
				$topdesigner['user_pic'] = $this->t_user_info_model->avatar($val->user_id);
				$scheme_list = $this->t_project_scheme_model->schemeListByUser($val->user_id,1,4);
				foreach ($scheme_list as $key=>$val) {
					$topdesigner['scheme_list'][$key]['scheme_name'] = $val->scheme_name; 
					$room_id = $this->t_project_floor_model->getTheOneRoomByScheme($val->scheme_id);
					$topdesigner['scheme_list'][$key]['scheme_pic'] =roomurl($room_id)."big_thumb.jpg"; 
					$topdesigner['scheme_list'][$key]['scheme_url'] =$config['schemeinfo'].$val->scheme_id;	
				}
			}else{
				$topdesigner_list[$key]['user_pic'] = $this->t_user_info_model->avatar($val->user_id); 
				$topdesigner_list[$key]['userspace'] = $config['userspace'].$val->user_id; 
				$topdesigner_list[$key]['designer'] = $val->user_nickname; 
				$topdesigner_list[$key]['company'] = $val->user_company; 

				$schemecount=$this->t_project_model->getSumSchemeByProject($val->user_id);
				if($schemecount==false){
					$schemes="0";	
				}else{
					$schemes=$schemecount->count;	
				}
				$topdesigner_list[$key]['schemes'] = $schemes;
				$topdesigner_list[$key]['fans'] = $val->user_fans;
			}
		}
		//推荐室内设计师top1开始	
		$data['topdesigner'] = $topdesigner;
		//推荐室内设计师top1结束		
		//推荐室内设计师top7开始	
		$data['topdesigner_list'] = $topdesigner_list;
		//推荐室内设计师top7结束		
		//更多下载方案开始
		$data['topscheme_url'] = $config['schemesearch']."t1=0&t2=0&t3=0&t4=0";
		//更多下载方案结束
		//下载方案列表开始
		$downs_s_recommend= $this->t_system_model->get("downs_s_recommend");
		if($downs_s_recommend==false||$downs_s_recommend->sys_value==""){
			$data['topscheme_list'] = "";	
		}
		$res = $this->t_project_scheme_model->schemeListById($downs_s_recommend->sys_value,1,10);
		if($res==false){
			$topscheme_list="";	
		}
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($res as $key=>$val) {
			$topscheme_list[$key]['scheme_name']= $val->scheme_name;		
			$topscheme_list[$key]['designer']= $val->scheme_designer;		
			$topscheme_list[$key]['scheme_url']= $config['schemeinfo'].$val->scheme_id;		
			$topscheme_list[$key]['user_pic']=$this->t_user_info_model->avatar($val->scheme_designer_id);	
			$topscheme_list[$key]['userspace'] = $config['userspace'].$val->scheme_designer_id; 
		}
		$data['topscheme_list'] = $topscheme_list;
		//下载方案列表结束
		//diy案例推荐开始
		$diy_s_recommend= $this->t_system_model->get("diy_s_recommend");
		if($diy_s_recommend==false||$diy_s_recommend->sys_value==""){
			$data['diyscheme_list'] = "";	
		}
		$res = $this->t_project_scheme_model->schemeListById($diy_s_recommend->sys_value,1,6);
		if($res==false){
			$diyscheme_list="";	
		}
		foreach ($res as $key=>$val) {
			$diyscheme_list[$key]['scheme_name']= $val->scheme_name;		
			$diyscheme_list[$key]['nickname']= $val->user_nickname;		
			$diyscheme_list[$key]['user_id']= $val->user_id;		
			$diyscheme_list[$key]['fans']= $val->user_fans;		
			$room_id = $this->t_project_floor_model->getTheOneRoomByDiyScheme($val->scheme_id);
			$diyscheme_list[$key]['scheme_pic']= roomurl($room_id)."rectangle_thumb.jpg";
			$diyscheme_list[$key]['scheme_url']= $config['schemeinfo'].$val->scheme_id;		
			$diyscheme_list[$key]['user_pic']=$this->t_user_info_model->avatar($val->user_id);	
			$diyscheme_list[$key]['userspace'] = $config['userspace'].$val->user_id; 
		}
		$data['diyscheme_list'] = $diyscheme_list;
		//diy案例推荐结束
		//更多样板间开始
		$data['room_url'] = $config['roomsearch']."t1=0&t2=0&t3=0&t4=0";
		//更多样板间结束
		//推荐关键字开始
		$scheme_tag_recomend= $this->t_system_model->get("scheme_tag_recomend");
		if($scheme_tag_recomend==false||$scheme_tag_recomend->sys_value==""){
			$data['topscheme_list'] = "";	
		}
		$tagarr = explode(",",$scheme_tag_recomend->sys_value);
		foreach ($tagarr as $key=>$val) {
			$taglist[$key]['tag_name'] = $val;
			$taglist[$key]['tag_url'] = $val;
		}
		$data['taglist'] = $taglist;
		//推荐关键字结束
		//推荐样板间开始
		$room_recomend= $this->t_system_model->get("room_recomend");
		if($room_recomend==false||$room_recomend->sys_value==""){
			$data['toproom_list'] = "";	
		}
		$res = $this->t_project_room_model->getRoomById($room_recomend->sys_value,1,6);
		if($res==false){
			$toproom_list="";	
		}
		foreach ($res as $key=>$val) {
			$userinfo = $this->t_user_info_model->get($val->user_id);
			$toproom_list[$key]['room_name'] = $val->room_name;
			$toproom_list[$key]['room_url'] =  $config['roominfo'].$val->room_id;	
			$toproom_list[$key]['room_pic'] = roomurl($val->room_id)."rectangle_thumb.jpg";
			$toproom_list[$key]['room_view'] = $val->room_views;
			$toproom_list[$key]['user_pic'] =$this->t_user_info_model->avatar($val->user_id);
			$toproom_list[$key]['designer'] =$val->user_nickname;
			$toproom_list[$key]['fans'] =$val->user_fans;
			$toproom_list[$key]['userspace'] = $config['userspace'].$val->user_id; 
			$toproom_list[$key]['send_message'] = $config['userspace'].$val->user_id; 
			$toproom_list[$key]['room_thinking'] = $val->room_thinking; 
			$toproom_list[$key]['company'] = $userinfo->user_company; 
			$tagarr = explode(',',$val->room_keyword);
			//$tagarr =model("t_project_room_tag")->getTagByRoom($val->room_id); 
			foreach ($tagarr as $keys=>$vals) {
				$toproom_list[$key]['roomtag_list'][$keys]['tag_name']= $vals; 
				$toproom_list[$key]['roomtag_list'][$keys]['tag_url']= "#"; 
			}
			//$tagarr = $this->t_project_room_tag_model->getTagByRoom($room_id);
			//foreach ($tagarr as $keys=>$vals) {
			//$toproom_list[$key]['roomtag_list'][$keys]['tag_name'] = $vals->tag_name; 
			//$toproom_list[$key]['roomtag_list'][$keys]['tag_url'] = $vals->tag_id; 
			//}
			$toproom_list[$key]['is_me'] = ($val->user_id==$user_id)?"1":"0";
		}
		$data['toproom_list'] = $toproom_list;
		//推荐样板间结束
		echojson(0,$data);
	}
	/**
	 *description:案例详情页
	 *author:yanyalong
	 *date:2013/12/24
	 */
	public function info(){
		safeFilter();
		$scheme_id= isset($_POST['sid'])?$this->input->post('sid'):"";
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($scheme_id==""){
			echojson(1,"","无相关数据");
		}
		$this->config->load('url');
		$config = $this->config->item('url');
		$this->load->model('t_project_scheme_model');
		$this->load->model('t_project_floor_model');
		$this->load->model('t_system_district_model');
		$this->load->model('t_project_room_model');
		$this->load->model('t_project_scheme_tag_model');
		$this->load->model('t_user_info_model');
		//更新方案查看数		
		$this->t_project_scheme_model->scheme_status($scheme_id,"scheme_views",'+');	
		$res = $this->t_project_scheme_model->getSchemeInfo($scheme_id);	
		if($res->scheme_user_type=='1'){
			$data['swf_url'] = $config['xml3ddiyshow'].$scheme_id;
		}elseif($res->scheme_user_type=='2'){
			$data['swf_url'] = $config['xml3d'].$scheme_id;
		}else{
			$data['swf_url'] = "";
		}
		$data['project_name'] = $res->project_name;
		$data['project_size'] = $res->apartment_size;
		$data['project_type'] = $res->apartment_type;
		$data['province'] = $this->t_system_district_model->getcityinfo($res->house_province)->district_name;
		$data['city'] = $this->t_system_district_model->getcityinfo($res->house_city)->district_name;
		$data['house_name'] = $res->house_name;
		$data['project_demand'] = $res->project_demand;
		$data['scheme_id'] = $scheme_id;
		$data['scheme_thinking'] = $res->scheme_thinking;
		$data['scheme_name'] = $res->scheme_name;
		$room_id = $this->t_project_floor_model->getTheOneRoomByScheme($scheme_id);
		$room_info =$this->t_project_room_model->get($room_id); 
		if($room_info!=false){
			$data['room_thinking'] = $room_info->room_thinking;
			$data['room_name'] = $room_info->room_name;
		}else{
			$data['room_thinking'] = "";
			$data['room_name'] = "";
		}
		$data['cost'] = $res->scheme_cost;
		$data['designer'] = $res->scheme_designer;
		$data['user_id'] = $res->user_id;
		$data['company'] = $res->user_company;
		$data['send_message'] = $res->user_company;
		$data['userspace'] = $config['userspace'].$res->user_id;
		$data['user_pic'] = $this->t_user_info_model->avatar($res->user_id);
		$data['user_score'] = $res->user_score;
		if($user_id==""){
			$data['is_follow'] = "0";		
			$data['is_collect'] = "0";		
		}else{
			$data['is_collect'] = model('t_like_scheme')->is_like($scheme_id,$user_id);	
			$data['is_follow'] = model('t_user_follow')->is_follow($user_id,$res->user_id);	
		}
		$data['is_me'] = ($res->user_id==$user_id)?"1":"0";
		$data['schemetag_list']= $this->t_project_scheme_tag_model->tagListBySchemeId($scheme_id);
		$this->load->model("t_user_model");
		if($user_id!=""){
			$userinfo =  $this->t_user_model->get($user_id);
			$this->load->model("t_project_scheme_downset_model");
			$downset = $this->t_project_scheme_downset_model->getDownSetBySchemeId($scheme_id);	
			if($userinfo->group_id<11){
				$data['need_store']= "0";
				if($downset!=false){
					$data['need_store'] =$downset->downset_score;
				}
				//获取当前用户默认项目
				$this->load->model("t_project_model");
				$projectinfo = $this->t_project_model->GetProjectInfoByDefault($user_id);
				if($projectinfo==false){
					echojson(1,"",'请设置默认项目');
				}
				$project_id = $projectinfo->project_id;
				//查询当前项目是否已经应用过该案例
				$this->load->model("t_project_scheme_use_model");
				$scheme_use = $this->t_project_scheme_use_model->getSchemeUseByProjectSchemeUser($project_id,$scheme_id,$user_id);	
				if($scheme_use!=false){
					$data['is_use'] = "1";
				}else{
					$data['is_use'] = "0";
				}
				//查询是否下载过该案例
				$this->load->model("t_user_down_model");
				$checkDown= $this->t_user_down_model->checkDownBySchemeUser($scheme_id,$user_id,2);	
				if($checkDown!=false){
					$data['is_down'] = "1";
				}else{
					$data['is_down'] = "0";
				}
			}
		}
		$data['scheme_user_type'] = $res->scheme_user_type;
		$data['rid'] = $room_id;
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
		//$p =1;
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$scheme_id= $this->input->post('sid',true);
		//$scheme_id = 708;
		$this->load->model('t_scheme_discussion_model');
		$schemeinfo = $this->t_scheme_discussion_model->scheme_show($scheme_id,$p,10);
		if(empty($schemeinfo)){
			echojson(1,"",'暂无任何评论');
		}		
		foreach ($schemeinfo as $key=>$val) {
			if($user_id!=""){
				$schemeinfo[$key]['is_black']= model('t_user_disable')->is_black($user_id,$val['user_id']);
			}else{
				$schemeinfo[$key]['is_black']= "";
			}
		}
		echojson(0,$schemeinfo);
	}
	/**
	 *description:获取用户diy装修方案列表
	 *author:yanyalong
	 *date:2013/12/11
	 */
	public function getDiyList(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$this->load->model("t_user_model");
		$this->load->model("t_project_scheme_model");
		if($user_id==""){
			echojson(1,"","无相关数据");
		}
		$userinfo = $this->t_user_model->get($user_id);
		if($userinfo==false){
			echojson(1,"",'非法操作');
		}
		//判断用户是否是普通用户
		if($userinfo->group_id>10){
			echojson(1,"",'只有普通用户可以操作哦');
		}
		//获取当前用户默认项目
		$this->load->model("t_project_model");
		$projectinfo = $this->t_project_model->GetProjectInfoByDefault($user_id);
		if($projectinfo==false){
			echojson(1,"",'请设置默认项目');
		}
		$project_id = $projectinfo->project_id;
		$list = model("t_project_scheme")->schemelistByUserDiy($user_id,$project_id,1);		
		if($list==false){
			echojson(1,"","无相关数据");
		}
		$scheme = array();
		foreach($list as $key=>$val){
			$scheme[$key]['scheme_id'] = $val->scheme_id;
			$scheme[$key]['scheme_name'] = $val->scheme_name;
		}
		echojson(0,$scheme);
	}
}


