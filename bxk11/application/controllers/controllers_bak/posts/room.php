<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room extends User_Controller {
	public $roomlib_class; 
	function __construct(){
		parent::__construct();
		//$this->ajax_checklogin();
	}

	public function addroom(){
		safeFilter();
		$_POST = disableCheck();
		$room_type = isset($_POST['room_type'])?$this->input->post('room_type',true):'';
		$floor_id = isset($_POST['floor_id'])?$this->input->post('floor_id',true):'';
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$room_size= isset($_POST['room_size'])?$this->input->post('room_size',true):'';
		$room_keyword= isset($_POST['room_keyword'])?$this->input->post('room_keyword',true):'';
		$room_name= isset($_POST['room_name'])?$this->input->post('room_name',true):'';
		$room_thinking= isset($_POST['room_thinking'])?$this->input->post('room_thinking',true):'';
		$tag_idlist = isset($_POST['tag_idlist'])?$this->input->post('tag_idlist',true):'';
		$mapx= isset($_POST['mapx'])?$this->input->post('mapx',true):'';
		$mapy= isset($_POST['mapy'])?$this->input->post('mapy',true):'';
		$room_name= isset($_POST['room_name'])?$this->input->post('room_name',true):'';
		//新建方案,返回方案id
		$floor_room =model("t_project_floor_room")->getRoomByFloor($floor_id);
		if($floor_room!=false){
			if(count($floor_room)>9){
				echojson(1,'','每个楼层最多创建十个房间');
			}
		}
		if(intval(trim($floor_id)=="")){
			echojson(1,'','楼层id不能为空');
		}
		$floor = model("t_project_floor")->get($floor_id);
		$this->load->model('t_project_room_model');
		$this->t_project_room_model->scheme_id= $floor->scheme_id;
		$this->t_project_room_model->user_id= $user_id;
		$this->t_project_room_model->room_type=$room_type;
		$this->t_project_room_model->room_keyword=$room_keyword;
		$this->t_project_room_model->room_thinking=$room_thinking;
		$this->t_project_room_model->room_name=$room_name;
		$this->t_project_room_model->room_status=21;
		$this->t_project_room_model->room_thinking=$room_thinking;
		$this->t_project_room_model->room_size=floatval($room_size);
		$room_id = $this->t_project_room_model->insert();	
		if($room_id!=false){
			//插入房间标签关系表
			$this->load->model('t_project_room_tag_model');
			foreach (explode(',',trim($tag_idlist)) as $key=>$val) {
				$this->t_project_room_tag_model->room_id= $room_id;
				$this->t_project_room_tag_model->tag_id= $val;
				$this->t_project_room_tag_model->insert();	
			}
			//插入楼层房间关系表
			$this->load->model('t_project_floor_room_model');
			$this->t_project_floor_room_model->room_id= $room_id;
			$this->t_project_floor_room_model->floor_id= $floor_id;
			$this->t_project_floor_room_model->user_id= $user_id;
			$this->t_project_floor_room_model->insert();	
			if($room_type==1){
				$this->load->model('t_project_room_plane_model');
				$this->t_project_room_plane_model->room_id= $room_id;
				$this->t_project_room_plane_model->insert();	
			}
			//更新楼层表
			$this->load->model('t_project_floor_model');
			$floor = $this->t_project_floor_model->get($floor_id);
			$floor_map_coor = trim(($floor->floor_map_coor.'|'.$room_id.",".$room_name.",".$mapx.",".$mapy),'|');
			$param = array('floor_map_coor'=>$floor_map_coor);
			$this->t_project_floor_model->upfloor($floor_id,$param);	
			$data['room_id'] = $room_id;	
			if($room_type==2){
				$this->config->load('url');
				$config = $this->config->item('url');
				$data['preview3d'] = $config['preview3d'].$room_id;	
			}
			echojson(0,$data);
		}else{
			echojson(1,'','创建失败');
		}
	}
	/**
	 *description:点击完成后更新房间信息
	 *author:yanyalong
	 *date:2013/12/16
	 */
	//"room_size": "房间大小",
	//"room_tags": "关键词",
	//"room_thinking": "房间描述",
	public function uproom(){
		safeFilter();
		$_POST = disableCheck();
		$room_thinking= isset($_POST['room_thinking'])?$this->input->post('room_thinking',true):'';
		$tag_idlist = isset($_POST['tag_idlist'])?$this->input->post('tag_idlist',true):'';
		$room_size= isset($_POST['room_size'])?$this->input->post('room_size',true):'';
		$room_keyword= isset($_POST['room_keyword'])?$this->input->post('room_keyword',true):'';
		$room_id= isset($_POST['room_id'])?$this->input->post('room_id',true):'';
		$floor_id= isset($_POST['floor_id'])?$this->input->post('floor_id',true):'';
		$imgname= isset($_POST['imgname'])?$this->input->post('imgname',true):'';
		$mapx= isset($_POST['mapx'])?$this->input->post('mapx',true):'';
		$mapy= isset($_POST['mapy'])?$this->input->post('mapy',true):'';
		$room_name= isset($_POST['room_name'])?$this->input->post('room_name',true):'';
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$this->load->model('t_project_room_model');
		$param = array('room_size'=>$room_size,'room_keyword'=>$room_keyword,'room_thinking'=>$room_thinking,'room_name'=>$room_name,'room_status'=>'1');
		$res = $this->t_project_room_model->uproom($room_id,$param);	
		if($res!=false){
			$this->load->model('t_project_room_tag_model');
			$this->t_project_room_tag_model->delTagByRoom($room_id);
			foreach (explode(',',trim($tag_idlist)) as $key=>$val) {
				$this->t_project_room_tag_model->tag_id= $val;
				$this->t_project_room_tag_model->room_id= $room_id;
				$this->t_project_room_tag_model->insert();	
			}
			//更新房间平面信息表
			$countimg = 0;
			$picinfo = "";
			if($imgname!=""){
				foreach(explode('|^|',rtrim($imgname,'|^|')) as $key=>$info){
					$imginfo[] = explode('^|^',trim($info,','));
				}	
				loadLib("Content_Class");
				$Content_Class= new Content_Class();	
				foreach ($imginfo as $key=>$val) {
					$pic_content = $Content_Class->replace_str($val[1]);
					$picinfo .= $val[0].':'.$pic_content."|";
					$countimg++;
				}
			}
			$picinfo = rtrim($picinfo,'|');
			$this->load->model('t_project_room_plane_model');
			$param = array('room_pics'=>$countimg,'room_content'=>"$picinfo");
			$res = $this->t_project_room_plane_model->uproomplane($room_id,$param);	
			//更新楼层表
			$this->load->model('t_project_floor_model');
			$floor = $this->t_project_floor_model->get($floor_id);
			$floor_map_coor = explode('|',$floor->floor_map_coor);
			foreach ($floor_map_coor as $key=>$val) {
				$res = explode(',',$val);		
				if($res['0']==$room_id){
					$res['1']= $room_name;
					$res['2']= $mapx;
					$res['3']= $mapy;
				}
			}
			$floor_map_coor[$key] = implode(',',$res);
			if(isset($floor_map_coor)){
				$floor_map_coor = implode('|',$floor_map_coor);
			}
			$param = array('floor_map_coor'=>$floor_map_coor);
			$res = $this->t_project_floor_model->upfloor($floor_id,$param);	
			$floor_room =model("t_project_floor_room")->getRoomByFloor($floor_id);
			if($floor_room==false){
				$data['room_id']	= "";
				$data['room_name']	= "";
				$data['name']	= "";
				$data['room_size']	= "";
				$data['room_keyword']	= "";
				$data['tags']	= "";
				$data['mapx']	="";
				$data['mapy']	= "";
				$data['room_thinking']	= "";
			}else{
				$data['room_num']= count($floor_room);
				$res = $floor_room[count($floor_room)-1];
				$room = model("t_project_room")->get($res->room_id);
				$data['room_id']	= $room->room_id;
				$data['room_name']	= $room->room_name;
				$data['room_size']	= $room->room_size;
				$data['room_keyword']	= $room->room_keyword;
				$keyword = explode(',',$room->room_keyword);
				$data['name']	= $keyword['0'];
				$data['tags']	= model("t_project_room_tag")->getTaglist($room->room_id);
				$roommap = roommap($floor_map_coor,$room->room_id);
				$data['mapx']	= $roommap['mapx'];
				$data['mapy']	= $roommap['mapy'];
				$data['room_thinking']= $room->room_thinking;
				switch ($room->room_type) {
				case '1':
					$roomcontent = model("t_project_room_plane")->roomContent($room->room_id);
					$data['roomcontent']	= $roomcontent;
					$data['imglist']	= "";
					break;
				case '2':
					//生成长条图
					//生成xml
					loadLib("Roomlib_Class");	
					$xmlaction_bak = new Roomlib_Class();
					$this->roomlib_class = $xmlaction_bak;
					$xmlflag = $this->roomlib_class->createThumbXml($room_id);
					if($xmlflag==true){
						$data['xmlflag']	= "生成xml文件成功";
					}else{
						$data['xmlflag']	= "生成xml文件失败";
					}
					//生成长条图结束
					$data['room_content']	= "";
					$data['imglist']	= roomurlpic($room->room_id);
					break;
				}
			}
			if($res==true){
				echojson(0,$data);
				//$msg = "";
				//$status = 0;
				//echo "{".'"err":'.intval($status).",".'"data"'.":".json_encode($data).",".'"msg"'.":".json_encode($msg)."}";
				//if($room->room_type==1){
				//$imglist = $room_id.",";
				//foreach ($imginfo as $key=>$val) {
				//$imglist.=$val[0].',';		
				//}
				//pclose(popen('D:\wamp\bin\php\php5.3.3\php.exe D:\bxk11\yibu\caiqie.php '.$imglist, 'r'));
				//}
				//exit;
			}else{
				echojson(1,'','更新失败');
			}
		}else{
			echojson(1,'','更新失败');
		}
	}
	/**
	 *description:删除房间信息
	 *author:yanyalong
	 *date:2013/12/16
	 */
	public function delroom(){
		safeFilter();
		$room_id = isset($_POST['room_id'])?$this->input->post('room_id',true):'';
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($room_id!=""){
			$roominfo = model("t_project_room")->get($room_id);
			if($roominfo==false){
				echojson(1,'','异常操作');
			}
			$this->load->model('t_project_room_pic_model');
			$this->t_project_room_pic_model->delPicByRoom($room_id);
			$this->load->model('t_project_room_tag_model');
			$this->t_project_room_tag_model->delTagByRoom($room_id);
			switch ($roominfo->room_type) {
			case '1':
				$thumb = array('source','thumb_1','thumb_2','thumb_3','thumb_4','thumb_5');		
				foreach ($thumb as $key=>$val) {
					$thumb_dir = $_SERVER['DOCUMENT_ROOT'].d2roomurl($room_id,$val);
					if(file_exists($thumb_dir)){
						removeDir($thumb_dir);
					}
				}
				break;
			case '2':
				$thumb_dir = $_SERVER['DOCUMENT_ROOT'].roomurl($room_id);
				if(file_exists($thumb_dir)){
					removeDir($thumb_dir);
				}
			}
			//删除房间信息
			$this->load->model('t_project_room_model');
			$this->t_project_room_model->modRoomStatus($room_id,'99');
			//获取所有调用该房间的楼层		
			$this->load->model('t_project_floor_room_model');
			$res = $this->t_project_floor_room_model->getFloorByRoom($room_id);	
			$this->load->model('t_project_floor_model');
			//更新楼层表
			foreach ($res as $key=>$val) {
				$floor = $this->t_project_floor_model->get($val->floor_id);
				$floor_map_coor = explode('|',$floor->floor_map_coor);
				foreach ($floor_map_coor as $keys=>$vals) {
					$res = explode(',',$vals);		
					if($res['0']==$room_id){
						unset($floor_map_coor[$keys]);
					}
				}
				$floor_map_coor = implode('|',$floor_map_coor);
				$param = array('floor_map_coor'=>$floor_map_coor);
				$this->t_project_floor_model->upfloor($val->floor_id,$param);	
			}
			if($res!=false){
				echojson(0,'','取消成功');
			}else{
				echojson(1,'','取消失败');
			}
		}else{
			echojson(1,'','取消成功');
		}
	}
	/**
	 *description:删除房间2d图片记录
	 *author:yanyalong
	 *date:2013/12/17
	 */
	public function delRoomPic(){
		safeFilter();
		$room_id = isset($_POST['room_id'])?$this->input->post('room_id',true):'';
		$pic_md5 = isset($_POST['pic_md5'])?$this->input->post('pic_md5',true):'';
		$res = model("t_project_room_pic")->delRoomPic($room_id,$pic_md5);
		if($res!=false){
			echojson(0,'','删除成功');
		}else{
			echojson(1,'','删除失败');
		}
	}
	/**
	 *description:添加一条评论
	 *author:yanyalong
	 *date:2013/11/07
	 */
	public function adddiscu(){
		safeFilter();
		$_POST = disableCheck();
		$this->load->model('t_room_discussion_model');
		$room_id= $this->input->post('rid');
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(2,"",'未登录');
		}
		//$room_id = 708;
		//loadLib("Score_Class");
		//$Score_Class = new Score_Class($user_id,"discussion_add");
		//if($Score_Class->checkScore()==false){
		//echojson(1,'',"积分不足");
		//}			
		$disc_con = $this->input->post('disc_con');
		$disc_id = $this->t_room_discussion_model->manage($room_id,$user_id,$disc_con);
		$room= model("t_project_room")->get($room_id);
		$is_black = model("t_user_disable")->is_black($room->user_id,$user_id);	
		if($is_black=='1'){
			echojson(1,"",'根据对方设置，您无法进行该操作');
		}
		if($disc_id!=false){
			//if($Score_Class->checkMax()==true){
			//$Score_Class->modScore();
			//}			
			$discinfo = $this->t_room_discussion_model->new_disc($disc_id);		
			$discinfo['disc_num'] = model('t_room_discussion')->count_num($room_id);
			//model("t_user")->user_status($user_id,'user_discussions','+');
			//loadLib("Notice");
			//$notice = new Notice("GetNoticeByDisc",$user_id,$room_id,1);
			//loadLib("User_Feed");
			//new Feed("GetFeedByDiscContent",$user_id,$room_id);
			echojson(0,$discinfo);
		}else{
			echojson(1,"","评论失败");
		}
	}
	/**
	 *description:发表回复
	 *author:yanyalong
	 *date:2013/08/20
	 */
	public	function addreply()
	{	
		safeFilter();
		$_POST = disableCheck();
		$disc_pid= $this->input->post('did',true);
		//$disc_pid = 4;
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(2,"",'未登录');
		}
		//loadLib("Score_Class");
		//$Score_Class = new Score_Class($user_id,"discussion_add");
		//if($Score_Class->checkScore()==false){
		//echojson(1,'',"积分不足");
		//}			
		$disc_con = $this->input->post('reply_str',true);
		$this->load->model('t_room_discussion_model');
		$res = $this->t_room_discussion_model->new_disc($disc_pid);		
		$room = model("t_project_room")->get($res['room_id']);
		$is_black = model("t_user_disable")->is_black($room->user_id,$user_id);	
		if($is_black=='1'){
			echojson(1,"",'根据对方设置，您无法进行该操作');
		}
		$disc_id = $this->t_room_discussion_model->reply($user_id,$disc_con,$disc_pid);
		if($disc_id==false){
			echojson(1,"","回复失败");
		}else{
			//if($Score_Class->checkMax()==true){
			//$Score_Class->modScore();
			//}			
			$discinfo = $this->t_room_discussion_model->new_disc($disc_id);		
			//loadLib("Notice");
			//$notice = new Notice("GetNoticeByReply",$user_id,$disc_id,1);
			$discinfo['disc_num'] = model('t_room_discussion')->count_num($discinfo['room_id']);
			//model("t_user")->user_status($user_id,'user_discussions','+');
			//loadLib("User_Feed");
			//new Feed("GetFeedByReplyContent",$user_id,$discinfo['room_id']);
			echojson(0,$discinfo,"回复成功");
		}
	}
	/**
	 *description:喜欢、取消喜欢
	 *author:yanyalong
	 *date:2013/11/08
	 */
	public function like(){
		safeFilter();
		$room_id= $this->input->post('rid');
		//$room_id = 708;
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(2,"",'未登录');
		}
		//loadLib("Score_Class");
		//$Score_Class = new Score_Class($user_id,"like_add");
		//if($Score_Class->checkScore()==false){
		//echojson(1,'',"积分不足");
		//}			
		$this->load->model('t_like_room_model');				
		$is_like = $this->t_like_room_model->is_like($room_id,$user_id);	
		$this->t_like_room_model->room_id= $room_id;
		$this->t_like_room_model->user_id = $user_id;
		if($is_like=="1"){
			if($this->t_like_room_model->dellike()!=false){
				//model("t_user")->user_status($user_id,'user_likes','-');
				//model("t_content")->content_status($room_id,'content_likes','-');
				echojson(0,"",'取消喜欢成功');
			}else{
				echojson(1,"",'取消喜欢失败');
			}												
		}else{
			if($this->t_like_room_model->insert()!=false){
				//if($Score_Class->checkMax()==true){
				//$Score_Class->modScore();
				//}			
				//model("t_user")->user_status($user_id,'user_likes','+');
				//model("t_content")->content_status($room_id,'content_likes','+');
				//loadLib("Notice");
				//$notice = new Notice("GetNoticeByLikes",$user_id,$room_id,"1","","","");
				//loadLib("User_Feed");
				//new Feed("GetFeedByLikeContent",$user_id,$room_id);
				echojson(0,"",'喜欢成功');
			}else{
				echojson(1,"",'喜欢失败');
			}
		}
	}

	/**
	 *description:将样板间加入用户diy方案
	 *author:yanyalong
	 *date:2013/12/25
	 */
	public function tomyscheme(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(2,"",'未登录');
		}
		safeFilter();
		$_POST = disableCheck();
		$scheme_name= isset($_POST['scheme_name'])?$this->input->post('scheme_name',true):'';
		$scheme_id= isset($_POST['sid'])?$this->input->post('sid',true):'';
		$room_id= isset($_POST['rid'])?$this->input->post('rid',true):'';
		//$scheme_id = 783;
		//$scheme_name = "案例".rand(1,10000);
		//$room_id = 805;
		$this->load->model("t_project_room_model");
		if($room_id==""||($this->t_project_room_model->get($room_id)==false)){
			echojson(1,"",'非法操作');
		}
		$this->load->model("t_user_model");
		$this->load->model("t_project_scheme_model");
		$userinfo = $this->t_user_model->get($user_id);
		if($userinfo==false||($scheme_id==""&&$scheme_name=="")){
			echojson(1,"",'非法操作');
		}
		//判断用户是否是普通用户
		if($userinfo->group_id>10){
			echojson(1,"",'只有普通用户可以操作哦');
		}
			$this->load->model("t_project_model");
			$projectinfo = $this->t_project_model->GetProjectInfoByDefault($user_id);
			if($projectinfo==false){
				echojson(1,"",'请设置默认项目');
			}
			$project_id = $projectinfo->project_id;
		$this->load->model("t_project_scheme_use_model");
		//判断当前是新建案例还是选择案例
		if($scheme_id==""){
			//获取当前用户默认项目
			$this->load->model('t_project_scheme_model');
			//检测装修案例名称开始
			if(trim($scheme_name)==""){
				echojson(1,'','案例的名称的名称不能为空');
			}
			if((strlen(trim($scheme_name)) + mb_strlen(trim($scheme_name),'UTF8'))/2>50){
				echojson(1,"","方案名称不能超过25个字");
			}
			$is_exist = $this->t_project_scheme_model->is_has($scheme_name,$user_id,$project_id);
			if($is_exist!=false){
				echojson(1,'','您已经在当前项目中创建过了相同名称的方案');
			}
			$is_exist = $this->t_project_scheme_model->is_has($scheme_name,$user_id,$project_id);
			//检测装修案例名称开始
			$this->load->model('t_project_scheme_model');
			$this->t_project_scheme_model->project_id= $project_id;
			$this->t_project_scheme_model->user_id= $user_id;
			$this->t_project_scheme_model->apartment_id= $projectinfo->apartment_id;
			$this->t_project_scheme_model->house_id= $projectinfo->house_id;
			$this->t_project_scheme_model->scheme_type= 2;
			$this->t_project_scheme_model->scheme_name= $scheme_name;
			$this->t_project_scheme_model->scheme_user_type=1;
			$this->t_project_scheme_model->scheme_designer_id = ""; 
			$this->t_project_scheme_model->scheme_designer="";
			$this->t_project_scheme_model->scheme_status=1;
			$scheme_id= $this->t_project_scheme_model->insert();	
			if($scheme_id==false){
				echojson(1,'','创建diy案例失败');
			}
			//更新用户默认项目方案数
			$this->t_project_model->project_status($project_id,"project_schemes",'+');	
			//插入方案应用表
			$this->t_project_scheme_use_model->user_id=$user_id;	
			$this->t_project_scheme_use_model->project_id=$project_id;	
			$this->t_project_scheme_use_model->scheme_id=$scheme_id;	
			$this->t_project_scheme_use_model->scheme_use_is_now=0;	
			$scheme_use_id = $this->t_project_scheme_use_model->insert();
			if($scheme_use_id==false){
				echojson(1,'','插入方案应用失败');
			}
			//插入默认楼层
			$this->load->model('t_project_floor_model');
			$this->t_project_floor_model->scheme_id= $scheme_id;
			$floor_id = $this->t_project_floor_model->insert();	
			if($floor_id==false){
				echojson(1,'','创建案例楼层失败');
			}
			$floor_map_coor= "";
		//检测当前项目是否存在默认方案
		$defaultSchemeIsHas = $this->t_project_scheme_use_model->getDefaultByUser($user_id,$project_id);
		//若不存在默认方案则将当前方案设为默认方案
		if($defaultSchemeIsHas==false){
			$this->t_project_scheme_use_model->scheme_status($scheme_use_id,$project_id,$user_id,'1',"=");	
		}
		}else{
			//若是选择案例，获取楼层信息		
			$this->load->model('t_project_floor_model');
			$floorlist = $this->t_project_floor_model->floorlist($scheme_id);
			if($floorlist==false){
				echojson(1,'','无楼层信息');
			}
			//获取楼层id
			$floor_id = $floorlist[0]->floor_id;
			$floor_map_coor= $floorlist[0]->floor_map_coor;
		}
		$this->load->model('t_project_floor_room_model');
		//获取楼层下房间列表
		$roomlist = $this->t_project_floor_room_model->getFloorByRoom($floor_id);
		if(count($roomlist)>9){
			echojson(1,'','每个diy方案最多添加10个房间');
		}
		//获取发方案一层是否存在该房间
		$roomflag= $this->t_project_floor_room_model->getListByFloorRoom($floor_id,$room_id);
		if($roomflag!=false){
			echojson(1,'','该案例已经加入过本房间了');
		}
		//若没有加入过判断该用户是否下载过该房间
		$this->load->model("t_user_down_model");
		$checkDown= $this->t_user_down_model->checkDownBySchemeUser($room_id,$user_id,2);	
		$downset_score = 0;
		$downset_gold= 0;
		if($checkDown==false){
			$this->load->model("t_system_model");
			$room_down = $this->t_system_model->get('room_down');	
			if($room_down!=false){
				$downset_score = $room_down->sys_value;	
				if($userinfo->user_score<$downset_score){
					echojson(1,"",'积分不足');
				}
			}
		}
		$this->load->model("t_user_down_model");
		$this->t_user_down_model->user_id=$user_id;	
		$this->t_user_down_model->user_down_type=1;	
		$this->t_user_down_model->user_down_objid=$room_id;	
		$this->t_user_down_model->room_downscore=$downset_score;	
		$user_down_id = $this->t_user_down_model->insert();
		if($user_down_id==false){
			echojson(1,"",'插入用户下载信息失败');
		}else{
			//插入楼层房间关系表
			$this->t_project_floor_room_model->room_id=$room_id;	
			$this->t_project_floor_room_model->floor_id=$floor_id;	
			$this->t_project_floor_room_model->user_id=$user_id;	
			$floor_room_id = $this->t_project_floor_room_model->insert();
			if($floor_room_id==false){
				echojson(1,"",'插入楼层表失败');
			}else{
				$this->load->library('upload');
				$this->upload->floor_pic1($scheme_id,$floor_id);
				loadLib('Roomlib_Class');
				$roomlib_bak = new Roomlib_Class();
				$this->roomlib_class = $roomlib_bak;
				$flag = $this->roomlib_class->diy3D($scheme_id);
				if($flag==false){
					echojson(1,"",'生成xml失败');
				}
				//更新用户积分信息	
				$this->t_user_model->user_status($user_id,"user_score",'-',$downset_score);	
				//更新房间下载数		
				$this->load->model("t_project_room_model");
				$this->t_project_room_model->room_status($room_id,"room_downs",'+');	
				$msg = "恭喜，操作成功";
				if($downset_score!=0){
					$msg .= "消耗了".$downset_score."积分,您当前的积分为".($userinfo->user_score-$downset_score);
				}
				echojson(0,"",$msg);
			}	
		}
	}
	
	
}


