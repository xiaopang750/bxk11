<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @description CI图像处理类库扩展类，用以实现实际业务逻辑
 * @author		yanyl
 */
class MY_Image_lib extends CI_Image_lib{

	public function __construct(){
		parent::__construct();
	}
	/**
	 *author:yanyl
	 *description:修剪图片
	 *param:$x:左侧修剪实际像素
	 *param:$y:上侧修剪实际像素
	 *param:$w:裁切后图片实际宽度
	 *param:$h:裁切后图片实际高度
	 **/
	public function img_crop($source_img,$x,$y,$cutwidth,$cutheight){
		$imginfo = getimagesize($source_img);
		$config['source_image'] = $source_img;
		$config['x_axis'] = $x;
		$config['y_axis'] = $y; 
		$config['width'] = $cutwidth;
		$config['height'] = $cutheight;
		$config['image_library'] = 'gd2';
		$config['maintain_ratio'] =false;
		$this->initialize($config);
		if(!$this->crop()){
			return false;
		}else{
			return $source_img;
		}
	}

	//等比缩放裁切
	function resizeimage($sourceimg,$toimg,$towidth,$toheight=''){
		$imginfo = getimagesize($sourceimg);
		$config['image_library'] = 'gd2';
		$config['source_image'] = $sourceimg;
		$config['maintain_ratio'] = TRUE;
		$config['new_image'] = $toimg;
		if($toheight!=''){
			$config['width'] = $towidth;
			$config['height'] = $toheight;
			//根据宽高缩放比例判断缩放依赖主轴，以比例低的为准
			if(($imginfo['0']/$towidth)>($imginfo['1']/$toheight)){
				$config['master_dim'] = 'height';
			}else{
				$config['master_dim'] = 'width';
			}
		}else{
			$config['master_dim'] = 'width';
			$config['width'] = $towidth;
			$config['height']= $imginfo[1]/($imginfo[0]/$towidth);	
		}
		$this->initialize($config);
		if($this->resize()){
			//$this->img_rotation($sourceimg,90);
			if($toheight!=''){
				$config['maintain_ratio'] = FALSE;
				$config['source_image'] = $config['new_image'];
				$thumb_info = getimagesize($config['new_image']);
				//新图片切割坐标
				if($thumb_info[0]>=$thumb_info[1]){
					$cutwidth = ($thumb_info[0]-$towidth)/2;
					$cutheight = 0;
				}else{
					$cutheight = ($thumb_info[1]-$toheight)/2;
					$cutwidth = 0;
				}
				$this->initialize($config);
				$cropflag = $this->img_crop($config['new_image'],$cutwidth,$cutheight,$towidth,$toheight);
				if($cropflag==false){
					return false;
				}else{
					return true;
				}
			}else{
				return true;
			}
		}else{
			return false;
		}
	}
	//对上传的灵感图像进行缩略图处理
	public function blog_thumb($sourceimg){
		$this->CI = &get_instance();
		$this->CI->load->model('Bxk_user_notice_model');
		$this->CI->config->load('uploads');
		$imgname = basename($sourceimg);
		$thumb_config = $this->CI->config->item('blog');
		$imginfo = getimagesize($sourceimg);
		if($imginfo[0]<$thumb_config['thumb_size_1_x']){
			$thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$imgname,$imginfo[0],$thumb_config['thumb_size_1_y']); 	
		}else{
			$thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$imgname,$thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y']); 	
		}
		if($thumb_1==true){
			$thumb_2 = $this->resizeimage($sourceimg,$thumb_config['thumb_2'].$imgname,$thumb_config['thumb_size_2_x'],$thumb_config['thumb_size_2_y']); 
			if($thumb_2==true){
				$thumb_3 = $this->resizeimage($sourceimg,$thumb_config['thumb_3'].$imgname,$thumb_config['thumb_size_3_x'],$thumb_config['thumb_size_3_y']);    
				if($thumb_3==true){
					$thumb_4 = $this->resizeimage($sourceimg,$thumb_config['thumb_4'].$imgname,$thumb_config['thumb_size_4_x'],$thumb_config['thumb_size_4_y']);   
					if($thumb_4==true){
						chmod($sourceimg,0644);
						chmod($thumb_config['thumb_1'].$imgname,0644);
						chmod($thumb_config['thumb_2'].$imgname,0644);
						chmod($thumb_config['thumb_3'].$imgname,0644);
						chmod($thumb_config['thumb_4'].$imgname,0644);
						return true;
					}else{
						unlink($sourceimg);
						unlink($thumb_config['thumb_1'].$imgname);
						unlink($thumb_config['thumb_2'].$imgname);
						unlink($thumb_config['thumb_3'].$imgname);
						return false;
					}	
				}else{
					unlink($sourceimg);
					unlink($thumb_config['thumb_1'].$imgname);
					unlink($thumb_config['thumb_2'].$imgname);
					return false;
				}
			}else{
				unlink($sourceimg);
				unlink($thumb_config['thumb_1'].$imgname);
				return false;
			}				
		}else{
			unlink($sourceimg);
			return false;
		}				
	}
	//修剪头像
	public function cropavatar($user_id,$sourceimg,$x,$y,$cutwidth,$cutheight){
		$this->CI = &get_instance();
		$this->CI->config->load('uploads');
		$config = $this->CI->config->item('avatar');
		//上传后原比例裁剪为正方形的操作暂忽略
		$img_b =  $config['upload_path'].$user_id.'_b.jpg';
		$img_m =  $config['upload_path'].$user_id.'_m.jpg';
		$img_s =  $config['upload_path'].$user_id.'_s.jpg';

		$crop = $this->img_crop($sourceimg,$x,$y,$cutwidth,$cutheight);			
		if($crop){
			$thumb_b = $this->resizeimage($sourceimg,$img_b,$config['thumb_size_1_x'],$config['thumb_size_1_y']); 
		}
		if($thumb_b==true){
			$thumb_m = $this->resizeimage($sourceimg,$img_m,$config['thumb_size_2_x'],$config['thumb_size_2_y']); 
			if($thumb_m==true){
				$thumb_s = $this->resizeimage($sourceimg,$img_s,$config['thumb_size_3_x'],$config['thumb_size_3_y']); 
				if($thumb_s==true){
					$avatar_dir = intval(ceil($user_id/$config['count'])); 
					$config['true_path'] = $config['true_path'].$avatar_dir.'/';
					if(!file_exists($config['true_path'])){
						mkdir($config['true_path']);
					}
					rename($img_b,$config['true_path'].$user_id.'_b.jpg');	
					rename($img_m,$config['true_path'].$user_id.'_m.jpg');	
					rename($img_s,$config['true_path'].$user_id.'_s.jpg');
					//unlink($sourceimg);
					$imgurl = '/uploads/avatar/'.$avatar_dir.'/'.$user_id.'_b.jpg';
					$user_pic = $avatar_dir;			
					echo "{info:'1',user_pic:'$user_pic',user_show:'$imgurl'}";exit;
				}else{
					unlink($sourceimg);
					unlink($img_b);
					unlink($img_m);
				}
			}else{
				unlink($sourceimg);
				unlink($img_b);
			}				
		}else{
			unlink($sourceimg);
			echo "{info:'0'}";exit;
		}	
	}

	//对上传的装修问题图像进行缩略图处理
	public function question_thumb($sourceimg){
		$this->CI = &get_instance();
		$this->CI->config->load('uploads');
		$imgname = basename($sourceimg);
		$thumb_config = $this->CI->config->item('question');
		$imginfo = getimagesize($sourceimg);
		if($imginfo[0]<$thumb_config['thumb_size_1_x']){
			$thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$imgname,$imginfo[0],$thumb_config['thumb_size_1_y']); 	
		}else{
			$thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$imgname,$thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y']); 	
		}
		if($thumb_1==true){
			$thumb_2 = $this->resizeimage($sourceimg,$thumb_config['thumb_2'].$imgname,$thumb_config['thumb_size_2_x'],$thumb_config['thumb_size_2_y']); 
			if($thumb_2==true){
				return true;
			}else{
				unlink($sourceimg);
				unlink($thumb_config['thumb_1'].$imgname);
				return false;
			}				
		}else{
			unlink($sourceimg);
			return false;
		}				
	}
	//对上传的主题图片进行缩略图处理
	public function theme_thumb($sourceimg){
		$this->CI = &get_instance();
		$this->CI->config->load('images');
		$imgname = basename($sourceimg);
		$thumb_config = $this->CI->config->item('theme');
		$imginfo = getimagesize($sourceimg);
		$thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$imgname,$thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y']); 	
		if($thumb_1==true){
			$thumb_2 = $this->resizeimage($sourceimg,$thumb_config['thumb_2'].$imgname,$thumb_config['thumb_size_2_x'],$thumb_config['thumb_size_2_y']); 
			if($thumb_2==true){
				$thumb_3 = $this->resizeimage($sourceimg,$thumb_config['thumb_3'].$imgname,$thumb_config['thumb_size_3_x'],$thumb_config['thumb_size_3_y']);    
				if($thumb_3==true){
					return true;
				}else{
					unlink($sourceimg);
					unlink($thumb_config['thumb_1'].$imgname);
					unlink($thumb_config['thumb_2'].$imgname);
					return false;
				}
			}else{
				unlink($sourceimg);
				unlink($thumb_config['thumb_1'].$imgname);
				return false;
			}				
		}else{
			unlink($sourceimg);
			return false;
		}				
	}
	/**
	 *description:旋转图片
	 *author:yanyalong
	 *date:2013/12/09
	 */
	public function img_rotation($source_img,$rotation_angle){
		$config['source_image'] = $source_img;
		$config['rotation_angle'] =$rotation_angle;
		$this->initialize($config);
		if(!$this->rotate()){
			return false;
		}else{
			return $source_img;
		}
	}
	/**
	 *description:裁切户型图
	 *author:yanyalong
	 *date:2013/12/13
	 */
	public function apartment_thumb($sourceimg,$apartmentid){
		$this->apartmentdir($apartmentid);
		$this->CI = &get_instance();
		$this->CI->config->load('images');
		$imgname = basename($sourceimg);
		$thumb_config = $this->CI->config->item('apartment');
		$imginfo = getimagesize($sourceimg);
		$dir = ceil($apartmentid/1000)."/";	
		$source_dir= $_SERVER['DOCUMENT_ROOT'].'/uploads/apartment/source/'.$dir;
		$source_new = $source_dir.$imgname;
		copy("$sourceimg","$source_new");	
		$thumb_1_dir = $_SERVER['DOCUMENT_ROOT'].'/uploads/apartment/thumb_1/'.$dir;
		$thumb_1 = $this->resizeimage($sourceimg,$thumb_1_dir.$imgname,$thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y']); 	
		if($thumb_1==true){
			//unlink($sourceimg);
			return true;
		}else{
			unlink($sourceimg);
			return false;
		}				
	}
	/**
	 *description:创建不存在的户型图目录
	 *author:yanyalong
	 *date:2013/12/13
	 */
	public function apartmentdir($apartmentid){
		$dir = ceil($apartmentid/1000)."/";	
		$source =$_SERVER['DOCUMENT_ROOT'].'/uploads/apartment/source/';
		$thumb_1 =$_SERVER['DOCUMENT_ROOT'].'/uploads/apartment/thumb_1/'; 
		$source_dir= $_SERVER['DOCUMENT_ROOT'].'/uploads/apartment/source/'.$dir;
		$thumb_1_dir = $_SERVER['DOCUMENT_ROOT'].'/uploads/apartment/thumb_1/'.$dir;
		//若不存在相关目录则新建
		$this->dircreate($source);
		$this->dircreate($thumb_1);
		$this->dircreate($source_dir);
		$this->dircreate($thumb_1_dir);
	}
	/**
	 *description:若不存在目录则创建
	 *author:yanyalong
	 *date:2013/12/13
	 */
	public function dircreate($dir){
		if(!file_exists($dir)){
			mkdir($dir);
		}
	}
	/**
	 *description:裁切平面布置图
	 *author:yanyalong
	 *date:2013/12/13
	 */
	public function floor_pic1_thumb($sourceimg,$thumb_config,$type){
		if($type == '1'){
			$temp = md5($thumb_config['file_name']).'.jpg'; 
			$thumb_temp = $this->resizeimage($sourceimg,$temp,$thumb_config['thumb_size_temp_x'],$thumb_config['thumb_size_temp_y']); 	
			if($thumb_temp==true){
				return $temp;
			}else{
				return false;		
			}
			return $temp;
		}else{
			$thumb_1 = $this->resizeimage($thumb_config['upload_path'].$thumb_config['pic1_temp'],$thumb_config['pic1_1'],$thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y']); 	
			if($thumb_1==true){
				$thumb_2 = $this->resizeimage($thumb_config['upload_path'].$thumb_config['pic1_temp'],$thumb_config['pic1_2'],$thumb_config['thumb_size_2_x'],$thumb_config['thumb_size_2_y']); 	
				if($thumb_2==true){
					return true;		
				}else{
					unlink($thumb_config['upload_path'].$thumb_config['pic1_temp']);
					unlink($thumb_config['upload_path'].$thumb_config['pic1_1']);
				}
			}else{
				unlink($thumb_config['upload_path'].$thumb_config['pic1_temp']);
				return false;	
			}
		}
	}
	//裁切平面布置图
	public function cropfloor_pic1($sourceimg,$x,$y,$cutwidth,$cutheight){
		$this->CI = &get_instance();
		$this->CI->config->load('uploads');
		$config = $this->CI->config->item('floor_pic1');
		$dirname = dirname($sourceimg);
		//$sourceimg = $_SERVER['DOCUMENT_ROOT'].$sourceimg;
		//上传后原比例裁剪为正方形的操作暂忽略
		$pic1_1= $dirname.'/'.$config['pic1_1'];
		$pic1_2= $dirname.'/'.$config['pic1_2'];
		$crop = $this->img_crop($sourceimg,$x,$y,$cutwidth,$cutheight);			
		if($crop){
			$thumb_1 = $this->resizeimage($sourceimg,$pic1_1,$config['thumb_size_1_x'],$config['thumb_size_1_y']); 
			if($thumb_1==true){
				$thumb_2 = $this->resizeimage($sourceimg,$pic1_2,$config['thumb_size_2_x'],$config['thumb_size_2_y']); 
				if($thumb_2==true){
					unlink($sourceimg);
					return true;
				}else{
					unlink($sourceimg);
					unlink($pic1_1);
					unlink($pic1_2);
				}
			}else{
				unlink($sourceimg);
			}	
		}else{
			return false;	
		}
	}
	//对上传的房间图片进行缩略图处理
	public function room_2d_thumb($sourceimg,$room_id){
		$roomdir = $this->room_2d_dir($room_id);
		$this->CI = &get_instance();
		$this->CI->config->load('uploads');
		$imgname = basename($sourceimg);
		$thumb_config = $this->CI->config->item('room_2d');
		$imginfo = getimagesize($sourceimg);
		if($imginfo[0]<$thumb_config['thumb_size_1_x']){
			$thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$roomdir.$imgname,$imginfo[0],$thumb_config['thumb_size_1_y']); 	
		}else{
			$thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$roomdir.$imgname,$thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y']); 	
		}
		if($thumb_1==true){
			$thumb_2 = $this->resizeimage($sourceimg,$thumb_config['thumb_2'].$roomdir.$imgname,$thumb_config['thumb_size_2_x'],$thumb_config['thumb_size_2_y']); 
			if($thumb_2==true){
				$thumb_3 = $this->resizeimage($sourceimg,$thumb_config['thumb_3'].$roomdir.$imgname,$thumb_config['thumb_size_3_x'],$thumb_config['thumb_size_3_y']);    
				if($thumb_3==true){
					$thumb_4 = $this->resizeimage($sourceimg,$thumb_config['thumb_4'].$roomdir.$imgname,$thumb_config['thumb_size_4_x'],$thumb_config['thumb_size_4_y']);   
					if($thumb_4==true){
						$thumb_5 = $this->resizeimage($sourceimg,$thumb_config['thumb_5'].$roomdir.$imgname,$thumb_config['thumb_size_5_x'],$thumb_config['thumb_size_5_y']);   
						if($thumb_5==true){
							chmod($sourceimg,0644);
							chmod($thumb_config['thumb_1'].$roomdir.$imgname,0644);
							chmod($thumb_config['thumb_2'].$roomdir.$imgname,0644);
							chmod($thumb_config['thumb_3'].$roomdir.$imgname,0644);
							chmod($thumb_config['thumb_4'].$roomdir.$imgname,0644);
							chmod($thumb_config['thumb_5'].$roomdir.$imgname,0644);
							return true;
						}else{
							unlink($sourceimg);
							unlink($thumb_config['thumb_1'].$roomdir.$imgname);
							unlink($thumb_config['thumb_2'].$roomdir.$imgname);
							unlink($thumb_config['thumb_3'].$roomdir.$imgname);
							unlink($thumb_config['thumb_4'].$roomdir.$imgname);
							return false;
						}
					}else{
						unlink($sourceimg);
						unlink($thumb_config['thumb_1'].$roomdir.$imgname);
						unlink($thumb_config['thumb_2'].$roomdir.$imgname);
						unlink($thumb_config['thumb_3'].$roomdir.$imgname);
						return false;
					}	
				}else{
					unlink($sourceimg);
					unlink($thumb_config['thumb_1'].$roomdir.$imgname);
					unlink($thumb_config['thumb_2'].$roomdir.$imgname);
					return false;
				}
			}else{
				unlink($sourceimg);
				unlink($thumb_config['thumb_1'].$roomdir.$imgname);
				return false;
			}				
		}else{
			unlink($sourceimg);
			return false;
		}				
	}
	/**
	 *description:创建不存在的房间平面图目录
	 *author:yanyalong
	 *date:2013/12/13
	 */
	public function room_2d_dir($room_id){
		$dir = ceil($room_id/1000)."/".$room_id.'/';	
		$thumb[] =$_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_1/'; 
		$thumb[] =$_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_2/'; 
		$thumb[] =$_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_3/'; 
		$thumb[] =$_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_4/'; 
		$thumb[] =$_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_5/'; 
		$thumb[] =$_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_1/'.ceil($room_id/1000)."/"; 
		$thumb[] =$_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_2/'.ceil($room_id/1000)."/"; 
		$thumb[] =$_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_3/'.ceil($room_id/1000)."/"; 
		$thumb[] =$_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_4/'.ceil($room_id/1000)."/"; 
		$thumb[] =$_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_5/'.ceil($room_id/1000)."/"; 
		$thumb[] =$_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_1/'.$dir; 
		$thumb[] =$_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_2/'.$dir; 
		$thumb[] =$_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_3/'.$dir; 
		$thumb[] =$_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_4/'.$dir; 
		$thumb[] =$_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_5/'.$dir; 
		//若不存在相关目录则新建
		foreach($thumb as $key=>$val){
			$this->dircreate($val);		
		}
		return $dir;
	}

	/**
	 * 图片拼接、缩略
	 * @author liuguangping 2013/12/14
	 * @param Int $room_id 房间id
	 * @return Boolean
	 */

	public function pic_group($room_id){
		$imgpath = roomimage($room_id);
		$imgpath=  $imgpath.'/';
		$imgs = array();
		$this->CI = &get_instance();
		$this->CI->config->load('uploads');
		$room_3d_config = $this->CI->config->item('room_3d');

		$long_path = $imgpath.$room_3d_config['long_name'];
		$thumb_path = $imgpath.$room_3d_config['thumb_name'];
		$pre_path = $imgpath.$room_3d_config['preview_name'];
		$big_thumb_path = $imgpath.$room_3d_config['big_thumb'];
		$rectangle_thumb_path = $imgpath.$room_3d_config['rectangle_thumb'];

		$imgs['f'] = $imgpath.'/f.jpg';
		$imgs['r'] = $imgpath.'/r.jpg';
		$imgs['b'] = $imgpath.'/b.jpg';
		$imgs['l'] = $imgpath.'/l.jpg';
		$imgs['u'] = $imgpath.'/u.jpg';
		$imgs['d'] = $imgpath.'/d.jpg';
		$jsthumb = $imgpath.'/'.$room_3d_config['js3dthumb_name'];
		
		//生成wap图片
		$this->picThumb($room_3d_config['js3dthumb_width'],$room_3d_config['js3dthumb_height'],$imgs['f'],$jsthumb);
		$this->picThumb($room_3d_config['js3d_width'],$room_3d_config['js3d_height'],$imgs['f'],$imgpath.'/jsf.jpg');
		$this->picThumb($room_3d_config['js3d_width'],$room_3d_config['js3d_height'],$imgs['r'],$imgpath.'/jsr.jpg');
		$this->picThumb($room_3d_config['js3d_width'],$room_3d_config['js3d_height'],$imgs['b'],$imgpath.'/jsb.jpg');
		$this->picThumb($room_3d_config['js3d_width'],$room_3d_config['js3d_height'],$imgs['l'],$imgpath.'/jsl.jpg');
		$this->picThumb($room_3d_config['js3d_width'],$room_3d_config['js3d_height'],$imgs['u'],$imgpath.'/jsu.jpg');
		$this->picThumb($room_3d_config['js3d_width'],$room_3d_config['js3d_height'],$imgs['d'],$imgpath.'/jsd.jpg');
		
		//$target = 'pic/tmp.jpg';//背景图片
		list($width,$height)= getimagesize($imgs['f']);

		$target_img = imagecreatetruecolor($width*6,$height);

		$preview_img = imagecreatetruecolor($room_3d_config['preview_width'],$room_3d_config['preview_height']);

		$thumb_img = imagecreatetruecolor($room_3d_config['thumb_width'],$room_3d_config['thumb_height']);

		$big_thumb_img = imagecreatetruecolor($room_3d_config['big_thumb_width'],$room_3d_config['big_thumb_height']);

		$rectangle_thumb_img = imagecreatetruecolor($room_3d_config['rectangle_thumb_width'],$room_3d_config['rectangle_thumb_height']);

		$white =ImageColorAllocate($thumb_img ,255,255,255);
		ImageFill($thumb_img,0,0,$white);//白色的背景
		$source= array();

		foreach ($imgs as $k=>$v){
			if(!file_exists($v)){
				return false;
				break;
			}
			$source[$k]['source'] = Imagecreatefromjpeg($v);
			list($source[$k]['width'],$source[$k]['height'])= getimagesize($v);
		}

		$tmp = 0;
		//房间长条图
		foreach ($source as $ke=>$va){
			imagecopyresampled($target_img,$source[$ke]['source'],$tmp,0,0,0,$height,$height,$source[$ke]['width'],$source[$ke]['height']);
			$tmp = $tmp+$width;
		}
		//房间缩略图
		$thumb_white = $room_3d_config['thumb_white'];
		$thumb_width = $room_3d_config['thumb_width']-$room_3d_config['thumb_white']*2;
		$thumb_height = $room_3d_config['thumb_height']-$room_3d_config['thumb_white']*2;
		$big_thumb_width = $room_3d_config['big_thumb_width'];
		$big_thumb_height = $room_3d_config['big_thumb_height'];
		$rectangle_thumb_width = $room_3d_config['rectangle_thumb_width'];
		$rectangle_thumb_height = $room_3d_config['rectangle_thumb_height'];
		imagecopyresampled($thumb_img,$source['f']['source'],$thumb_white,$thumb_white,0,0,$thumb_width,$thumb_height,$source['f']['width'],$source['f']['height']);
		imagecopyresampled($big_thumb_img,$source['f']['source'],0,0,0,0,$big_thumb_width,$big_thumb_height,$source['f']['width'],$source['f']['height']);
		if(Imagejpeg($target_img,$long_path)&&Imagejpeg($thumb_img,$thumb_path)&&Imagejpeg($big_thumb_img,$big_thumb_path)){
			$rectangle_path = Imagecreatefromjpeg($big_thumb_path);
			imagecopyresampled($rectangle_thumb_img,$rectangle_path,0,0,($big_thumb_width-$rectangle_thumb_width)/2,($big_thumb_height-$rectangle_thumb_height)/2,$rectangle_thumb_width,$rectangle_thumb_height,$rectangle_thumb_width,$rectangle_thumb_height);
			//房间预览图
			list($width_pre,$height_pre)= getimagesize($long_path);
			imagecopyresampled($preview_img,$target_img,0,0,0,0,$room_3d_config['preview_width'],$room_3d_config['preview_height'],$width_pre,$height_pre);
			if(Imagejpeg($preview_img,$pre_path)&&Imagejpeg($rectangle_thumb_img,$rectangle_thumb_path)){
				imagedestroy($preview_img);
				imagedestroy($target_img);
				imagedestroy($thumb_img);
				imagedestroy($big_thumb_img);
				imagedestroy($rectangle_thumb_img);
				return true;
			}else{
				imagedestroy($preview_img);
				imagedestroy($target_img);
				imagedestroy($thumb_img);
				imagedestroy($big_thumb_img);
				imagedestroy($rectangle_thumb_img);
				@unlink($long_path);	
				@unlink($thumb_path);
				@unlink($pre_path);
				@unlink($big_thumb_path);
				@unlink($rectangle_thumb_path);
				return false;
			}

		}else{
			imagedestroy($preview_img);
			imagedestroy($target_img);
			imagedestroy($thumb_img);
			imagedestroy($big_thumb_img);
			imagedestroy($rectangle_thumb_img);
			@unlink($long_path);	
			@unlink($thumb_path);
			@unlink($pre_path);
			@unlink($big_thumb_path);
			@unlink($rectangle_thumb_path);
			return false;
		}

	}
	
	
	/**
	 * 图片裁切 等比缩放在裁切(定长定宽)
	 * @author liuguangping
	 * @param Int $destWidth 目标图片（所要的图片）宽
	 * @param Int $destHeight 目标图片（所要的图片）高
	 * @param String $sourcePath 资源图片（要等比缩放的图片）地址
	 * @param String $destPath 目标图片（保存的图片）地址
	 * @return Boolean
	 *             ***   destwidth/sourcewidth = 4/5 ----- 1 之间  当小于4/5时则比定的宽小不符合
	 *           ******   destheight/sourceheight = 1/2  ----- 1 之间     所以要取交集 只能在 4/5----1之间取 所以只能是交集最大的值 只能是4/5
	 *           *  * *     取完值是先以1/2比例等比缩放 然后再以destWidth destHeight 裁切
	 ******0**********1****
	 *
	 *
	 */
	public function picThumb($destWidth,$destHeight,$sourcePath,$destPath){

		if(!file_exists($sourcePath)) return false;
		$source = Imagecreatefromjpeg($sourcePath);
		list($width,$height)= getimagesize($sourcePath);
		if(!$width OR ($width< $destWidth) OR !$destWidth) return false;
		if(!$height OR ($height< $destHeight) OR !$destHeight) return false;
		$ratioW = $destWidth/$width;
		$ratioH = $destHeight/$height;
		$ratio = '';
		if($ratioW>$ratioH){
			$ratio = $ratioW;
		}elseif($ratioW<$ratioH) {
			$ratio = $ratioH;
		}else{
			$ratio = $ratioW; //相等时随便那个比例
		}
		$thumbW = $width*$ratio;
		$thumbH = $height*$ratio;
		//创建个(缩略图)真彩画布
		$target_img = ImageCreateTrueColor($thumbW,$thumbH);
		//缩略图
		ImageCopyResampled($target_img ,$source,0,0,0,0,$thumbW,$thumbH,$width,$height);
		if(Imagejpeg($target_img,$destPath)){
			imagedestroy($target_img);
			//裁切图片
			//创建个( 裁切图)真彩画布
			$dest_img = ImageCreateTrueColor($destWidth,$destHeight);
			$dest_source = Imagecreatefromjpeg($destPath);//裁切图片
			ImageCopyResampled($dest_img ,$dest_source,0,0,($thumbW-$destWidth)/2,($thumbH-$destHeight)/2,$destWidth,$destHeight,$destWidth,$destHeight);

			if(Imagejpeg($dest_img,$destPath)){
				imagedestroy($dest_img);
				return true;
			}else{
				imagedestroy($dest_img);
				@unlink($destPath);
				return false;
			}
		}else{
			imagedestroy($target_img);
			return false;
		}
	}

	/**
	 * 根据方案id生成案例的首个房间缩略图
	 * @author liuguangping
	 * @param Int $scheme_id 方案id
	 * @param Int $room_id 
	 * @return Boolean
	 */
	public function createFirstRoomThumb($scheme_id,$room_id){
		$imgpath = roomimage($room_id);
		$imgpath=  $imgpath.'/';

		$schemepath = xmlurlimage($scheme_id);
		$schemepath =  $schemepath.'/';
		$imgs_f = $imgpath.'/f.jpg';
		if(!file_exists($imgs_f)){
			return false;
			break;
		}
		list($width,$height)= getimagesize($imgs_f);
		$this->CI = &get_instance();
		$this->CI->config->load('uploads');
		$room_3d_config = $this->CI->config->item('room_3d');

		$recommend_path = $schemepath.$room_3d_config['recommend_name'];
		$recommend_width = $room_3d_config['recommend_width'];
		$recommend_height = $room_3d_config['recommend_height'];

		$recommend_img = imagecreatetruecolor($recommend_width,$recommend_height);
		$source_source = Imagecreatefromjpeg($imgs_f);

		imagecopyresampled($recommend_img,$source_source,0,0,0,0,$recommend_width,$recommend_height,$width,$height);
		if(Imagejpeg($recommend_img,$recommend_path)){
			imagedestroy($recommend_img);
			return true;
		}else{
			imagedestroy($recommend_img);
			@unlink($recommend_path);
			return false;
		}

	}
	/**
	 *description:裁切产品效果图片
	 *author:yanyalong
	 *date:2013/12/29
	 */
	public function product_thumb($sourceimg,$thumb_config){
		//对上传的灵感图像进行缩略图处理
		$this->CI = &get_instance();
		//$this->CI->load->model('Bxk_user_notice_model');
		$this->CI->config->load('uploads');
		$imgname = basename($sourceimg);
		$imginfo = getimagesize($sourceimg);
		if($imginfo[0]<$thumb_config['thumb_size_1_x']){
			$thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$imgname,$imginfo[0],$thumb_config['thumb_size_1_y']); 	
		}else{
			$thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$imgname,$thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y']); 	
		}
		if($thumb_1==true){
			$thumb_2 = $this->resizeimage($sourceimg,$thumb_config['thumb_2'].$imgname,$thumb_config['thumb_size_2_x'],$thumb_config['thumb_size_2_y']); 
			if($thumb_2==true){
				$thumb_3 = $this->resizeimage($sourceimg,$thumb_config['thumb_3'].$imgname,$thumb_config['thumb_size_3_x'],$thumb_config['thumb_size_3_y']);    
				if($thumb_3==true){
					chmod($sourceimg,0644);
					chmod($thumb_config['thumb_1'].$imgname,0644);
					chmod($thumb_config['thumb_2'].$imgname,0644);
					chmod($thumb_config['thumb_3'].$imgname,0644);
					return true;
				}else{
					unlink($sourceimg);
					unlink($thumb_config['thumb_1'].$imgname);
					unlink($thumb_config['thumb_2'].$imgname);
					return false;
				}
			}else{
				unlink($sourceimg);
				unlink($thumb_config['thumb_1'].$imgname);
				return false;
			}				
		}else{
			unlink($sourceimg);
			return false;
		}				
	}

	/**
	 *description:裁切品牌系列图片
	 *author:yanyalong
	 *update:liuguangping
	 *date:2013/12/29
	 */
	public function product_BrSe_thumb($sourceimg,$thumb_config){
	
		//对上传的灵感图像进行缩略图处理
		$this->CI = &get_instance();
		//$this->CI->load->model('Bxk_user_notice_model');
		$this->CI->config->load('uploads');
		$imgname = basename($sourceimg);
		$imginfo = getimagesize($sourceimg);
		if($imginfo[0]<$thumb_config['thumb_size_1_x']){
			$thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$imgname,$imginfo[0],$thumb_config['thumb_size_1_y']); 	
		}else{
			$thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$imgname,$thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y']); 	
		}
		if($thumb_1==true){
			if($thumb_config['flg'] == 'brand'){
				$thumb_2 = $this->resizeimage($sourceimg,$thumb_config['thumb_2'].$imgname,$thumb_config['thumb_size_2_x'],$thumb_config['thumb_size_2_y']); 
				if($thumb_2==true){
					$thumb_3 = $this->resizeimage($sourceimg,$thumb_config['thumb_3'].$imgname,$thumb_config['thumb_size_3_x'],$thumb_config['thumb_size_3_y']);    
					if($thumb_3==true){
						chmod($sourceimg,0644);
						chmod($thumb_config['thumb_1'].$imgname,0644);
						chmod($thumb_config['thumb_2'].$imgname,0644);
						chmod($thumb_config['thumb_3'].$imgname,0644);
						return true;
					}else{
						unlink($sourceimg);
						unlink($thumb_config['thumb_1'].$imgname);
						unlink($thumb_config['thumb_2'].$imgname);
						return false;
					}
				}else{
					unlink($sourceimg);
					unlink($thumb_config['thumb_1'].$imgname);
					return false;
				}			
			}else{
				return true;
			}
				
		}else{
			unlink($sourceimg);
			return false;
		}				
	}

	/**
	 *description:裁切产品缩略图图片
	 *author:yanyalong
	 *date:2013/12/29
	 */
	public function product_index_thumb($sourceimg,$thumb_config){
		//对上传的灵感图像进行缩略图处理
		$this->CI = &get_instance();
		$this->CI->config->load('uploads');
		$imgname = basename($sourceimg);
		$imginfo = getimagesize($sourceimg);
		$thumb_index = $this->resizeimage($sourceimg,$thumb_config['index'].$imgname,$thumb_config['thumb_size_index_x'],$thumb_config['thumb_size_index_y']); 	
		if($thumb_index==true){
			chmod($sourceimg,0644);
			chmod($thumb_config['index'].$imgname,0644);
			return true;
		}else{
			unlink($sourceimg);
			return false;
		}				
	}

	/**
	 *description:经销商产品缩略图裁切
	 *author:liuguangping
	 *date:2014/4/8
	 */
	public function service_product_picThumb($sourceimg,$thumb_config){
		//对上传的灵感图像进行缩略图处理
		$this->CI = &get_instance();
		$this->CI->config->load('uploads');
		$imgname = basename($sourceimg);
		list($width,$height) = getimagesize($sourceimg);
		$destPath1 = $thumb_config['thumb_1'].$imgname;
		$thumb1 = $this->picThumb($thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y'],$sourceimg,$destPath1); 
		
		if($thumb1){
			return true;
		}else{
			@unlink($sourceimg);
			@unlink($thumb1);
			return false;
		}
	}

	/**
	 *description:经销商产品账面图裁切
	 *author:liuguangping
	 *date:2014/4/8
	 */
	public function service_product_colorThumb($sourceimg,$thumb_config){
		//对上传的灵感图像进行缩略图处理
		$this->CI = &get_instance();
		$this->CI->config->load('uploads');
		$imgname = basename($sourceimg);
		list($width,$height) = getimagesize($sourceimg);
		$destPath1 = $thumb_config['thumb_1'].$imgname;
		$thumb1 = $this->picThumb($thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y'],$sourceimg,$destPath1);
		if($thumb1){
			return true;
		}else{
			@unlink($sourceimg);
			@unlink($thumb1);
			return false;
		}
	}

	/**
	 *description:微信（后台）菜单项缩略图裁切
	 *author:liuguangping
	 *date:2014/4/8
	 */
	public function service_weixinMenu_picThumb($sourceimg,$thumb_config){
		//对上传的灵感图像进行缩略图处理
		$this->CI = &get_instance();
		$this->CI->config->load('uploads');
		$imgname = basename($sourceimg);
		list($width,$height) = getimagesize($sourceimg);
		$destPath1 = $thumb_config['thumb_1'].$imgname;
		$thumb1 = $this->picThumb($thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y'],$sourceimg,$destPath1); 
		
		if($thumb1){
			return true;
		}else{
			@unlink($sourceimg);
			@unlink($thumb1);
			return false;
		}
	}

	/**
	 *description:系统资讯图（后台）裁切
	 *author:liuguangping
	 *date:2014/4/8
	 */
	public function service_InforMation_picThumb($sourceimg,$thumb_config){

		$this->CI = &get_instance();
		$this->CI->config->load('uploads');
		$imgname = basename($sourceimg);
		list($width,$height) = getimagesize($sourceimg);
		$destPath1 = $thumb_config['thumb_1'].$imgname;
		$destPath2 = $thumb_config['thumb_2'].$imgname;
		$thumb1 = $this->picturesThumb($thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y'],$sourceimg,$destPath1);
		$thumb2 = $this->picturesThumb($thumb_config['thumb_size_2_x'],$thumb_config['thumb_size_2_y'],$sourceimg,$destPath2); 
		
		if($thumb1 && $thumb2){
			return true;
		}else{
			@unlink($sourceimg);
			@unlink($thumb1);
			@unlink($thumb2);
			return false;
		}
	}

	/**
	 * 图片裁切 缩放
	 * @author liuguangping
	 * @param Int $destWidth 目标图片（所要的图片）宽
	 * @param Int $destHeight 目标图片（所要的图片）高
	 * @param String $sourcePath 资源图片（要等比缩放的图片）地址
	 * @param String $destPath 目标图片（保存的图片）地址
	 *
	 */
	public function picturesThumb($destWidth,$destHeight,$sourcePath,$destPath){

		if(!file_exists($sourcePath)) return false;
		$source = Imagecreatefromjpeg($sourcePath);
		list($width,$height)= getimagesize($sourcePath);
		
		$target_img = ImageCreateTrueColor($destWidth,$destHeight);
		//缩略图
		ImageCopyResampled($target_img ,$source,0,0,0,0,$destWidth,$destHeight,$width,$height);
		if(Imagejpeg($target_img,$destPath)){
			imagedestroy($target_img);
			return true;
		}else{
			imagedestroy($target_img);
			return false;
		}
	}

}	
