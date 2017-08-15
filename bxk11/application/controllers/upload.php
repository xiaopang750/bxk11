<?php
/*description:上传功能控制器
 *author:yanyalong
 *date:2013/08/01
 */
class Upload extends User_Controller {
	function __construct(){
		parent::__construct();
		//$this->ajax_checklogin();
	}
	//上传头像
	public function avatar(){
		$this->config->load('uploads');
		$config = $this->config->item('avatar');
		if($_FILES['userfile']['size']>($config['max_size']*1024)){
			echo
			"<script type='text/javascript'>
			var oHead=window.parent.document.getElementById('view_wrap');
			oHead.setAttribute('status',2);
			var oScript=window.parent.document.createElement('script');
			oScript.src='/static/script/modify_head/modify_fail_do.js';
			window.parent.document.body.appendChild(oScript);
			</script>";exit;
		}
		$this->load->library('upload');
		$data = $this->upload->img_upload_file($config);
		if($data==false){
			echo
			"<script type='text/javascript'>
			var oHead=window.parent.document.getElementById('view_wrap');
			oHead.setAttribute('status',0);
			var oScript=window.parent.document.createElement('script');
			oScript.src='/static/script/modify_head/modify_fail_do.js';
			window.parent.document.body.appendChild(oScript);
			</script>";exit;
		}else{
			$sourceimg = $config['upload_path'].$data['upload_data']['file_name'];
			$imginfo = getimagesize($sourceimg);
			if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
				unlink($sourceimg);
				echo 
				"<script type='text/javascript'>
				var oHead=window.parent.document.getElementById('view_wrap');
				oHead.setAttribute('status',1);
				oHead.setAttribute('minHeight',$config[min_height]);
				oHead.setAttribute('minWidth',$config[min_width]);
				var oScript=window.parent.document.createElement('script');
				oScript.src='/static/script/modify_head/modify_fail_do.js';
				window.parent.document.body.appendChild(oScript);
				</script>";exit;
			}else{
				$imgurl = '/uploads/avatar/tmp/'.$data['upload_data']['file_name'];
				echo 
				"<script type='text/javascript'>
				window.parent.document.getElementById('view_wrap').setAttribute('_src','$imgurl');
				var oScript=window.parent.document.createElement('script');
				oScript.src='/static/script/modify_head/modify_success_do.js';
				window.parent.document.body.appendChild(oScript);
				</script>";exit;
			}
		}
	}
	//修剪头像
	public function cropavatar(){
		safeFilter();
		$user_id = $_SESSION['user_id'];
		$sourceimg= $_SERVER['DOCUMENT_ROOT'].$this->input->post('source_img',true);
		$x= $this->input->post('x',true);
		$y= $this->input->post('y',true);
		$cutwidth= $this->input->post('cutwidth',true);
		$cutheight= $this->input->post('cutheight',true);
		$this->load->library('image_lib');	
		$this->image_lib->cropavatar($user_id,$sourceimg,$x,$y,$cutwidth,$cutheight);
	}

	//上传主题图片
	public function theme(){
		$this->config->load('uploads');
		$config = $this->config->item('theme');
		if($_FILES['userfile']['size']>($config['max_size']*1024)){
			echo "<script>alert('上传失败，字节太大')</script>";exit;
		}
		$this->load->library('upload');
		//上传图片文件
		$data = $this->upload->img_upload_file($config);
		if($data==false){
			echo "<script>alert('上传失败')</script>";exit;
		}else{
			$sourceimg = $config['upload_path'].$data['upload_data']['file_name'];
			$imginfo = getimagesize($sourceimg);
			if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
				unlink($sourceimg);
				echo "<script>alert('上传失败,上传图片最小应为1000*316')</script>";exit;
			}
			$this->load->library('image_lib');	
			$thumb = $this->image_lib->theme_thumb($sourceimg);
			if($thumb==true){
				echo "<script>alert('上传成功')</script>";exit;
			}else{
				echo "<script>alert('上传失败')</script>";exit;
			}
		}
	}

	//上传装修问题图片
	public function question(){
		$item = "question";
		$this->config->load('uploads');		
		$config = $this->config->item($item);		
		if($_FILES['userfile']['size']>($config['max_size']*1024)){
			echo
				"<script type='text/javascript'>
				var oHead=window.parent.document.getElementById('header');
			oHead.setAttribute('status',2);
			var oScript=window.parent.document.createElement('script');
			oScript.src='/static/script/publish/request_fail_do.js';
			window.parent.document.body.appendChild(oScript);
			</script>";exit;
		}
		$this->load->library('upload');
		//上传图片文件
		$is_upload = $this->upload->img_upload_file($config);
		if(empty($is_upload)){
			echo
			"<script type='text/javascript'>
			var oHead=window.parent.document.getElementById('header');
			oHead.setAttribute('status',0);
			var oScript=window.parent.document.createElement('script');
			oScript.src='/static/script/publish/request_fail_do.js';
			window.parent.document.body.appendChild(oScript);
			</script>";exit;
		}else{
			$sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
			$imginfo = getimagesize($sourceimg);
			if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
				unlink($sourceimg);
				echo 
				"<script type='text/javascript'>
				var oHead=window.parent.document.getElementById('header');
				oHead.setAttribute('status',1);
				oHead.setAttribute('minHeight',$config[min_height]);
				oHead.setAttribute('minWidth',$config[min_width]);
				var oScript=window.parent.document.createElement('script');
				oScript.src='/static/script/publish/request_fail_do.js';
				window.parent.document.body.appendChild(oScript);
				</script>";exit;
			}
			$this->load->library('image_lib');	
			$thumb = $this->image_lib->question_thumb($sourceimg);
			if($thumb==true){
				$imgurl = $config['relative_path'].'thumb_2/'.$is_upload['upload_data']['file_name'];
				echo 
					"<script type='text/javascript'>
					window.parent.document.getElementById('header').setAttribute('_src','$imgurl');
				var oScript=window.parent.document.createElement('script');
				oScript.src='/static/script/publish/request_success_do.js';
				window.parent.document.body.appendChild(oScript);
				</script>";exit;
			}else{
				echo
				"<script type='text/javascript'>
				var oHead=window.parent.document.getElementById('header');
				oHead.setAttribute('status',0);
				var oScript=window.parent.document.createElement('script');
				oScript.src='/static/script/publish/request_fail_do.js';
				window.parent.document.body.appendChild(oScript);
				</script>";exit;
			}
	}
}
/**
 *description:批量上传
 *author:yanyalong
 *date:2013/12/05
 */
	public function uploadlist(){
		safeFilter();
		$content_type= isset($_POST['content_type'])?$this->input->post('content_type',true):'';
		if($content_type==''){
			$content_type = "1";
		}
		switch ($content_type) {
		case '1':
			$item = 'design';
			break;
		case '2':
			$item = 'product';
			break;
		}
		$this->config->load('uploads');		
		$config = $this->config->item($item);		
	  $file = array();
	 foreach ($_FILES["pictures"]["error"] as $key => $error) {  
		 if ($error == UPLOAD_ERR_OK) {  
			 $file[$key]['name'] = $_FILES['pictures']['name'][$key];
			 $file[$key]['type'] = $_FILES['pictures']['type'][$key];
			 $file[$key]['tmp_name'] = $_FILES['pictures']['tmp_name'][$key];
			 $file[$key]['error'] = $_FILES['pictures']['error'][$key];
			 $file[$key]['size'] = $_FILES['pictures']['size'][$key];
		 }	
	 }
	$this->load->library('upload');
	 foreach ($file as $key=>$val) {  
		 $_FILES['userfile'] = $val; //这句很重要，需要与CI上传类数据保持一致 
		 if ($val['error'] == UPLOAD_ERR_OK) {  
		if($val['size']>($config['max_size']*1024)){
			echo "<pre>";var_dump("文件太大")."<br>";
			continue;
		}
		//上传图片文件
		$is_upload = $this->upload->img_upload_file($config);
		if(empty($is_upload)){
			echo "<pre>";var_dump("上传失败")."<br>";
			continue;
		}else{
			$sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
			$imginfo = getimagesize($sourceimg);
			if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
				unlink($sourceimg);
					echo "<pre>";var_dump("小于最小要求，上传失败")."<br>";
			continue;
			}
			$this->load->library('image_lib');	
			$thumb= $this->image_lib->blog_thumb($sourceimg);			
			if($thumb==true){
					echo "<pre>";var_dump("上传成功并裁切成功")."<br>";
			continue;
			}else{
					echo "<pre>";var_dump("上传成功裁切失败")."<br>";
			continue;
			}
		}
	 }  
	}  
	}
		/**
		 *description:灵感博文图片swfupload批量上传
		 *author:yanyalong
		 *date:2013/12/05
		 */
		public function index(){
		safeFilter();
			//$content_type= isset($_POST['content_type'])?$this->input->post('content_type',true):'';
			$user_id= isset($_POST['uid'])?$this->input->post('uid',true):'';
			$defaultimg= '/uploads/blog/default/thumb_3.jpg';
			if($user_id==""){
				echo $defaultimg;exit;
			}
			//if($content_type==''){
			//$content_type = "1";
			//}
		//switch ($content_type) {
		//case '1':
			//$item = 'design';
			//break;
		//case '2':
			//$item = 'product';
			//break;
		//}
		$item = 'design';
		$this->config->load('uploads');		
		$config = $this->config->item($item);		
		$timedir = $this->config->item('timedir');		
		$_FILES['userfile'] = $_FILES['Filedata'];
		if($_FILES['userfile']['size']>($config['max_size']*1024)){
			echo $defaultimg;exit;
		}
		$this->load->library('upload');
		$defaultimg= '/uploads/blog/default/thumb_4.jpg';
		//上传图片文件
		$is_upload = $this->upload->swf_upload_file($config,'blog');
		if(empty($is_upload)){
				echo $defaultimg;exit;
				//echo 1;exit;
		}else{
			$sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
			$imginfo = getimagesize($sourceimg);
			if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
				unlink($sourceimg);
				echo $defaultimg;exit;
				//echojson(1,"","小于最小要求，上传失败");
			}
			$this->load->library('image_lib');	
			$thumb= $this->image_lib->blog_thumb($sourceimg);			
			if($thumb==true){
				model("t_pic")->pic_add($sourceimg,$user_id,'',date("Y-m-d H:i:s",$config['time']));
				$imgurl = '/uploads/blog/thumb_4/'.$config['timedir'].$is_upload['upload_data']['file_name'];
					echo $imgurl;exit;
			}else{
				echo $defaultimg;exit;
				//echo 1;exit;
			}
		}
	}
	//上传户型图
	public function apartment(){
		$this->config->load('uploads');		
		$config = $this->config->item("apartment");		
		if(!isset($_FILES['userfile'])){
		$_FILES['userfile'] = $_FILES['Filedata'];
		}
		if($_FILES['userfile']['size']>($config['max_size']*1024)){
			echojson(1,"","图片过大");
		}
		$this->load->library('upload');
		//上传图片文件
		$is_upload = $this->upload->swf_upload_file($config,'apartment');
		if(empty($is_upload)){
			echojson(1,"","上传失败");
		}else{
			$sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
			$imginfo = getimagesize($sourceimg);
			if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
				unlink($sourceimg);
				echojson(1,"","图片大小不符合标准");
			}
			//$this->load->library('image_lib');	
			//$thumb= $this->image_lib->apartment_thumb($sourceimg,123123);			
			//if($thumb==true){
				$imgurl = '/uploads/temp/apartment/'.$is_upload['upload_data']['file_name'];
				echojson(0,$imgurl);
			//}else{
				//echo "上传成功，裁切失败";
			//echo $defaultimg;exit;
			//}
		}
	} 
	
	/**
	 *description:上传布置图
	 *author:yanyalong
	 *date:2013/12/13
	 */
	public function floor_pic1(){
		$this->config->load('uploads');		
		$config = $this->config->item("floor_pic1");		
			if(!file_exists($config['pic1_temp'])){
				mkdir($config['pic1_temp']);
			}
		if(!isset($_FILES['userfile'])){
			$_FILES['userfile'] = $_FILES['Filedata'];
		}
		if($_FILES['userfile']['size']>($config['max_size']*1024)){
			echojson(1,"","图片过大");
		}
		$this->load->library('upload');
		//上传图片文件
		//$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].$imgurl;
		$is_upload = $this->upload->swf_upload_file($config,'floor_pic1');
		if(empty($is_upload)){
			echojson(1,"","上传失败");
		}else{
			$sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
			$copyimg = $config['upload_path'].md5($sourceimg).'.jpg';
			copy("$sourceimg","$copyimg");	
			$copyimg = $config['temp_path'].md5($sourceimg).'.jpg'; 
			$imginfo = getimagesize($sourceimg);
			if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
				unlink($sourceimg);
				echojson(1,"","图片大小不符合标准");
			}
			$this->load->library('image_lib');	
			$thumb= $this->image_lib->floor_pic1_thumb($sourceimg,$config,1);			
			if($thumb!=false){
				$sourceimg = $config['temp_path'].$is_upload['upload_data']['file_name'];
				$imgurl = $config['temp_path'].$thumb;
		echo "{err:0,data:{'width':"."'$imginfo[0]'".",'height':"."'$imginfo[1]'".",'url':"."'$imgurl'".",'source':"."'$sourceimg'".",'copyimg':"."'$copyimg'"."}}";exit;
			}else{
				echojson(1,"","上传成功，裁切失败");
			}
		}
	}
	/**
	 *description:旋转图片
	 *author:yanyalong
	 *date:2013/12/13
	 */
	public function img_rotation(){
		safeFilter();
		$imgurl= isset($_POST['imgurl'])?$this->input->post('imgurl',true):'';
		$sourceimg= isset($_POST['source'])?$this->input->post('source',true):'';
		if($imgurl==""){
			echojson(0,"/uploads/scheme/default/pic1_1.jpg");
		}
		$this->load->library('image_lib');	
		$this->image_lib->img_rotation($_SERVER['DOCUMENT_ROOT'].$imgurl,270);			
		$this->image_lib->img_rotation($_SERVER['DOCUMENT_ROOT'].$sourceimg,270);			
		$imginfo = getimagesize($_SERVER['DOCUMENT_ROOT'].$sourceimg);
		$urlinfo = array();
		$urlinfo['width'] = $imginfo['0'];
		$urlinfo['height'] = $imginfo['1'];
		$urlinfo['url'] = $imgurl;
		$urlinfo['source'] = $sourceimg;
		echojson(0,$urlinfo);
	}
	/**
	 *description:裁切布置图
	 *author:yanyalong
	 *date:2013/12/14
	 */
	public function crop_floor_pic1(){
		safeFilter();
		//前端接收设计方案id，若值为空，则表示当前为新建设计方案 ，则插入设计方案表返回方案id
		//前端接收楼层id，若值为空，则插入楼层表,返回楼层id
		$sourceimg= isset($_POST['source'])?$this->input->post('source',true):'';
		$tempimg= isset($_POST['tmpimg'])?$this->input->post('tmpimg',true):'';
		$scheme_id = isset($_POST['scheme_id'])?$this->input->post('scheme_id',true):'';
		$floor_id= isset($_POST['floor_id'])?$this->input->post('floor_id',true):'';
		$copyimg= isset($_POST['tmpimg'])?$this->input->post('copyimg',true):'';
		$x= $this->input->post('x',true);
		$y= $this->input->post('y',true);
		$cutwidth= $this->input->post('cutwidth',true);
		$cutheight= $this->input->post('cutheight',true);
			//图片裁切逻辑：
			//1.接收裁切过的临时图片(用于上传后预览以及旋转预览)
			//2.接收旋转过的原图(用于赋值临时裁切备用源，参数计算，裁切完成后，随即删除)
			//3.接收未旋转过的原图复制品(用以存放用户上传原图文件)
		$sourceimg= $_SERVER['DOCUMENT_ROOT'].$sourceimg;
		$this->load->library('upload');
		if(file_exists($sourceimg)){
		$imgurl = $this->upload->floor_pic1($scheme_id,$floor_id);
		$pic1_sourceimg= $_SERVER['DOCUMENT_ROOT'].$imgurl.'/pic1_source.jpg';
		$cropimg= $_SERVER['DOCUMENT_ROOT'].$imgurl.'/pic1_temp.jpg';
		$copy =  $_SERVER['DOCUMENT_ROOT'].$imgurl.'/pic1_copy.jpg';
		copy("$sourceimg","$cropimg");	
		unlink($sourceimg);	
			$tempimg = $_SERVER['DOCUMENT_ROOT'].$tempimg;
			if(file_exists($tempimg)){
				unlink($tempimg);	
			}
			$copyimg = $_SERVER['DOCUMENT_ROOT'].$copyimg;
			if(file_exists($copyimg)){
				copy("$copyimg","$pic1_sourceimg");	
				unlink($copyimg);	
			}
		}else{
			echojson(1,"","异常操作");
		}
		$this->load->library('image_lib');	
		$thumb = $this->image_lib->cropfloor_pic1($cropimg,$x,$y,$cutwidth,$cutheight);
		if($thumb){
		$config = $this->config->item('floor_pic1');
			echojson(0,$imgurl.'/'.$config['pic1_2']);
		}else{
			echojson(1,"","上传成功，裁切失败");
		}
	}	
	/**
	 *description:批量上传房间效果图
	 *author:yanyalong
	 *date:2013/12/14
	 */
	public function room_2d(){
		safeFilter();
		$room_id= isset($_POST['room_id'])?$this->input->post('room_id',true):'';
		//判断传过来的房间id是否为空 若房间id为空，则为新建房间
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($room_id==""){
			echojson(1,"","操作异常");
		}
		$this->config->load('uploads');		
		$config = $this->config->item("room_2d");		
		if(!isset($_FILES['userfile'])){
			$_FILES['userfile'] = $_FILES['Filedata'];
		}
		if($_FILES['userfile']['size']>($config['max_size']*1024)){
			echojson(1,"","图片过大");
		}
		$this->load->library('upload');
		$imgurl= $this->upload->room_2d($room_id);
		//上传图片文件
		$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].$imgurl;
		$is_upload = $this->upload->swf_upload_file($config,'room_2d');
		if(empty($is_upload)){
			echojson(1,"","上传失败");
		}else{
			$sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
			$imginfo = getimagesize($sourceimg);
			if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
				unlink($sourceimg);
				echojson(1,"","图片大小不符合标准");
			}
			$this->load->library('image_lib');	
			$thumb= $this->image_lib->room_2d_thumb($sourceimg,$room_id);			
			//$thumb = true;
				//插入房间图片信息表
				$this->load->model('t_project_room_pic_model');
				$this->t_project_room_pic_model->room_pic_width=$imginfo['0'];
				$this->t_project_room_pic_model->room_pic_high=$imginfo['1'];
				$this->t_project_room_pic_model->room_pic_size =  filesize($sourceimg);
				$this->t_project_room_pic_model->room_id= $room_id;
				$this->t_project_room_pic_model->room_pic_md5= basename($sourceimg);
				$this->t_project_room_pic_model->insert();	
			if($thumb==true){
				$picurl = "/uploads/room/source/".ceil($room_id/1000).'/'.$room_id.'/'.$is_upload['upload_data']['file_name'];
				echojson(0,$picurl);
			}else{
				echojson(1,"","上传成功，裁切失败");
			}
		}	
	}
	/**
	 *description:批量上传房间全景图
	 *author:yanyalong
	 *date:2013/12/14
	 */
	public function room_3d(){
		safeFilter();
		$room_id= isset($_POST['room_id'])?$this->input->post('room_id',true):'';
		$this->config->load('uploads');		
		$config = $this->config->item("room_3d");		
		if(!isset($_FILES['userfile'])){
			$_FILES['userfile'] = $_FILES['Filedata'];
		}
		if($_FILES['userfile']['size']>($config['max_size']*1024)){
			echojson(1,"","图片过大");
		}
		$this->load->library('upload');
		$imgurl= $this->upload->room_3d($room_id);
		//上传图片文件
		$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].$imgurl;
		$is_upload = $this->upload->swf_upload_file($config,'room_3d');
		if(empty($is_upload)){
			echojson(1,"","上传失败");
		}else{
			$sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
			$imginfo = getimagesize($sourceimg);
			//if(($imginfo[0]!=$imginfo[1])||($imginfo[0]<$config['min_width'])||($imginfo[0]>$config['max_width'])){
				//echojson(1,"","图片宽度必须大于".$config['min_width']."且于".$config['max_width']."规格的正方形");
				//unlink($sourceimg);
			//}
			
			$imgname = basename($sourceimg);	
			$room_3d_name = $this->config->item("room_3d_name");		
			$room_3d_rname = $this->config->item("room_3d_rname");		
				$replace = "";
				foreach ($room_3d_name as $key=>$val) {
					$pattern = "/([\s\S]*?".$val."\.(?:png|jpg|gif))/i";
					$flag = preg_match($pattern,$imgname);	
					if($flag==1){
							$replace = $val;
							break;
					}
				}
				if($replace!=""){
					rename($sourceimg,dirname($sourceimg).'/'.$room_3d_rname[$replace]);			
				}else{
					unlink($sourceimg);
					echojson(1,"","文件名称不符合标准");
				}
				$img['url'] = roomurl($room_id).$room_3d_rname[$replace];
				$img['name'] = $room_3d_rname[$replace];
			echojson(0,$img);
		}	
	}
	/**
	 *description:生成长条图
	 *author:yanyalong
	 *date:2013/12/14
	 */
	public function createlong(){
		safeFilter();
		$room_id= isset($_POST['room_id'])?$this->input->post('room_id',true):'';
		$this->load->library('upload');
		$imgurl= $this->upload->room_3d($room_id);
		//上传图片文件
		$roompath = $_SERVER['DOCUMENT_ROOT'].$imgurl;
			$this->load->library('image_lib');	
			$thumb= $this->image_lib->pic_group($roompath);			
	}
	/**
	 *description:上传布置图
	 *author:yanyalong
	 *date:2013/12/13
	 */
	public function floor_pic1_reply(){
		safeFilter();
		//前端接收设计方案id，若值为空，则表示当前为新建设计方案 ，则插入设计方案表返回方案id
		//前端接收楼层id，若值为空，则插入楼层表,返回楼层id
		$scheme_id= isset($_POST['scheme_id'])?$this->input->post('scheme_id',true):'';
		$floor_id = isset($_POST['floor_id'])?$this->input->post('floor_id',true):'';
		$this->config->load('uploads');		
		$config = $this->config->item("floor_pic1");		
		if(!isset($_FILES['userfile'])){
			$_FILES['userfile'] = $_FILES['Filedata'];
		}
		if($_FILES['userfile']['size']>($config['max_size']*1024)){
			echojson(1,"","图片过大");
		}
		$this->load->library('upload');
		$imgurl = $this->upload->floor_pic1($scheme_id,$floor_id);
		//上传图片文件
		$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].$imgurl;
		$is_upload = $this->upload->swf_upload_file($config,'floor_pic1');
		if(empty($is_upload)){
			echojson(1,"","上传失败");
		}else{
			$sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
			$imginfo = getimagesize($sourceimg);
			if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
				unlink($sourceimg);
				echojson(1,"","图片大小不符合标准");
			}
			$this->load->library('image_lib');	
			$thumb= $this->image_lib->floor_pic1_thumb($sourceimg,$config,1);			
			if($thumb==true){
				$imgurl = $imgurl.$config['pic1_temp'];
			echo "{err:0,data:{'width':"."'$imginfo[0]'".",'height':"."'$imginfo[1]'".",'url':"."'$imgurl'".",'scheme_id':"."'$scheme_id'".",'floor_id':"."'$floor_id'"."}}";exit;
			}else{
				echojson(1,"","上传成功，裁切失败");
			}
		}
	}
	/**
	 *description:上传产品图片
	 *author:yanyalong
	 *date:2013/12/29
	 */
	public function  product_admin(){
		$this->config->load('uploads');		
		$config = $this->config->item("product");		
		$_FILES['userfile'] = $_FILES['Filedata'];
		if($_FILES['userfile']['size']>($config['max_size']*1024)){
			return false;
		}
		$this->load->library('upload');
		$datedir= $this->upload->product_dir();
		//上传图片文件
		$config['upload_path'].=$datedir;
		$config['thumb_1'].=$datedir;
		$config['thumb_2'].=$datedir;
		$config['thumb_3'].=$datedir;
		$is_upload = $this->upload->swf_upload_file($config,'product');
		if(empty($is_upload)){
			return false;
		}else{
			$sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
			$imginfo = getimagesize($sourceimg);
			if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
				unlink($sourceimg);
				return false;
			}
			$this->load->library('image_lib');	
			$thumb= $this->image_lib->product_thumb($sourceimg,$config);			
			if($thumb==true){
				$imgurl = '/'.$datedir.$is_upload['upload_data']['file_name'];
					echo $imgurl;
			}else{
				return false;
			}
		}
	}

	/**
	 *description:上传品牌
	 *author:liuguangping
	 *date:2013/12/29
	 */
	public function  product_brand_admin(){
		$this->config->load('uploads');	
		$flg = $this->input->post('flg');
		if(isset($flg) && $flg == 'series'){
			$config = $this->config->item("series");
			$config['flg'] = 'series';
		}else{
			$config = $this->config->item("brand");	
			$config['flg'] = "brand";
		}
		$_FILES['userfile'] = $_FILES['Filedata'];
		if($_FILES['userfile']['size']>($config['max_size']*1024)){
			return false;
		}
		$this->load->library('upload');
		if(isset($flg) && $flg == 'series'){
			$datedir= $this->upload->seriesDir();
		}else{
			$datedir= $this->upload->brandDir();
		}
		//上传图片文件
		$config['upload_path'].=$datedir;
		//echo $config['upload_path'];die;
		$config['thumb_1'].=$datedir;
		if($flg == 'brand'){
			$config['thumb_2'].=$datedir;
			$config['thumb_3'].=$datedir;
		}
		
		$is_upload = $this->upload->swf_upload_file($config,'brand');
		if(empty($is_upload)){
			return false;
		}else{
			$sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
			$imginfo = getimagesize($sourceimg);
			if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
				unlink($sourceimg);
				return false;
			}
			if($is_upload['upload_data']['file_size']>$config['max_size']){
				unlink($sourceimg);
				return false;
			}
			$this->load->library('image_lib');	
			$thumb= $this->image_lib->product_BrSe_thumb($sourceimg,$config);		
			if($thumb==true){
				$imgurl=trim($datedir.$is_upload['upload_data']['file_name']);
				echo $imgurl;
			}else{
				return false;
			}
		}
	}

	/**
	 *description:上传产品缩略图片
	 *author:yanyalong
	 *date:2013/12/29
	 */
	public function  product_index_admin(){
		$this->config->load('uploads');		
		$config = $this->config->item("product");		
		$_FILES['userfile'] = $_FILES['Filedata'];
		if($_FILES['userfile']['size']>($config['max_size']*1024)){
			return false;
		}
		$this->load->library('upload');
		$datedir= $this->upload->product_dir();
		//上传图片文件
		$config['upload_path'].=$datedir;
		$config['index'].=$datedir;
		$is_upload = $this->upload->swf_upload_file($config,'product');
		if(empty($is_upload)){
			return false;
		}else{
			$sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
			$imginfo = getimagesize($sourceimg);
			if($imginfo[0]<$config['thumb_size_index_x']||$imginfo[1]<$config['thumb_size_index_x']){
				unlink($sourceimg);
				return false;
			}
			$this->load->library('image_lib');	
			$thumb= $this->image_lib->product_index_thumb($sourceimg,$config);			
			if($thumb==true){
				$imgurl = '/'.$datedir.$is_upload['upload_data']['file_name'];
					echo $imgurl;
			}else{
				return false;
			}
		}
	}
	
	
	/**
	 *description:上传产品缩略图导入
	 *author:yanyalong
	 *date:2013/12/29
	 */
	public function  product_index_admin_import($source){
		$this->load->library('upload');
		$datedir= $this->upload->product_dir();
		$this->config->load('uploads');
		$config = $this->config->item("product");
		//上传图片文件
		$config['upload_path'].=$datedir;
		$config['index'].=$datedir;

		$filename = $config['file_name'];
		$destination =  $config['upload_path'].$config['file_name'];
		if(copy($source,$destination)){
			$imginfo = getimagesize($destination);
			if($imginfo[0]<$config['thumb_size_index_x']||$imginfo[1]<$config['thumb_size_index_x']){
				unlink($destination);
				return false;
			}
			$this->load->library('image_lib');
			$thumb= $this->image_lib->product_index_thumb($destination,$config);
			if($thumb==true){
				
				$imgurl = '/'.$datedir.$filename;
				return $imgurl;
			}else{
				return false;
			}
		}else{
			return false;
		}
			
	}


    /**
     *description:上传灵感图片
     *author:yanyalong
     *date:2014/05/22
     */
    public function content(){
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';

        $this->config->load('uploads');		
        $config = $this->config->item("content");		

        $this->load->library('upload');
   
        //上传图片文件
        $is_upload = $this->upload->img_upload_file($config);
        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            $imginfo = getimagesize($sourceimg);
            if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
                //unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败,宽至少大于".$config['min_width']."高至少大于".$config['min_height']);
                return false;
            }
            $url = $config['relative_upload'].$time_relative_path.$is_upload['upload_data']['file_name'];
            $name = $is_upload['upload_data']['file_name'];
            $this->outPut(0, $cb, $url, $name, "上传成功");
        }
    }
     public function content1(){
       $this->load->helper(array('form', 'url'));
       $this->load->view('up.php');
    }

    public function outPut($code, $cb, $url, $name, $msg) {
        $arr = array();
        $arr['url'] = $url;

        $arr['name'] = $name;
        $data = json_encode( $arr );
        echo "<script>window.parent.$cb({err:$code, data:$data, msg:\"$msg\"})</script>"; 
    }
}

