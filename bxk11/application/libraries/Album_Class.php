<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class AlbumFactory{
	public static function createObj($album_name,$data_id,$user_id){
			$obj = new Content($album_name,$data_id,$user_id);
			if($obj instanceof Album_Class){
				return $obj->addalbum();
			}else{
				return false;	
			}
	}
}

//抽象类
abstract class Album_Class{
	public $album_name;
	public $data_id;
	public $user_id;

	abstract public function addalbum();
	public function __construct($album_name,$data_id,$user_id){
		$this->CI = &get_instance();
		$this->CI->load->model('t_album_content_model');
		$this->CI->load->model('t_content_model');
		$this->CI->load->model('t_album_model');
		//$this->CI->config->load('url');
		//$this->urlConfig = $this->CI->config->item('url');
		$this->data_id = $data_id;
		$this->album_name= $album_name;
		$this->user_id= $user_id;
	}
}

/**
 *description:加入项目灵感
 *author:yanyalong
 *date:2013/12/04
 */
class Content extends Album_Class{
	//添加家居灵感到项目灵感集
	public function addalbum(){
		if((strlen(trim($this->album_name)) + mb_strlen(trim($this->album_name),'UTF8'))/2>20){
			echojson(1,"","名称不能超过10个字");
		}
		$this->CI->t_album_model->user_id = $this->user_id;
		$this->CI->t_album_model->album_name= $this->album_name;
		$this->CI->t_album_model->album_count = 0;
		// 判断 t_album_model 存不存在数据
		$obj = $this->CI->t_album_model->get_uset_type($this->user_id,$this->album_name);	
		if($obj){
			$this->CI->t_album_content_model->p_user_id = $this->user_id;
			$this->CI->t_album_content_model->p_content_id = $this->data_id;
			$this->CI->t_album_content_model->p_project_id = $obj;
			// 判断 t_album_content_model 存不存在数据
			$is_tocontent = $this->CI->t_album_content_model->is_tocontent();
			if($is_tocontent == false){
				$insert_id = $this->CI->t_album_content_model->insert();
				$this->CI->t_content_model->content_id = $this->data_id;
				$this->CI->t_content_model->up_album();
				$res = $this->CI->t_album_model->album_id = $obj;
				// 判断 t_album_model 存不存在数据
				if($res){
					// 更新 t_album_model 其中的数据
					$this->CI->t_album_model->up_album($obj);
					loadLib("Notice");
					$notice = new Notice("GetNoticeByAlbum",$this->user_id,$this->data_id,"1","","","");
					return 1;
				}else{
					return 0;
				}
			}
			else{
				return 2;
			}
		}else{
			// 向 t_album_model 插入一条数据
			$insert_id = $this->CI->t_album_model->insert();
			if($insert_id){
				// 修改 t_content_model/t_album_content_model 其中的数据
				$this->CI->t_content_model->content_id = $this->data_id;
				$res = $this->CI->t_content_model->up_album($this->data_id);
				$this->CI->t_album_content_model->p_user_id = $this->user_id;
				$this->CI->t_album_content_model->p_content_id = $this->data_id;
				$this->CI->t_album_content_model->p_project_id = $insert_id;
				//$this->t_album_content_model->p_reason = $reason;
				$this->CI->t_album_content_model->insert();
				if($res){
					$this->CI->t_album_model->album_id = $insert_id;
					$this->CI->t_album_model->up_album($insert_id);
					loadLib("Notice");
					$notice = new Notice("GetNoticeByAlbum",$this->user_id,$this->data_id,"1","","","");
					return 1;
				}else{
					return 0;
				}
			} 
		}		
	}
	//public function addalbum_restr(){
		
		//$res=$this->addalbum();
		//$str="";
		//switch ($res) {
		//case '0':
		//$str='0,添加失败';
			//break;
		//case '1':
			//echojson(0,"",'添加成功');
			//break;
		//case '2':
			//echojson(1,"",'不能重复加入同一个灵感集');
			//break;
		//}
		//return $str;
	//}
}

