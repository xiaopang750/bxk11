<?php
class Content extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	public function add(){
		$this->load->model('t_content_model');
		$this->load->model('t_pic_model');
		$_SESSION['user_id']=378;
		$_POST=array(
			'album_id'=>3,
			'content_content'=>'灵感描述灵感描述',
			'tag_idlist'=>'12,24,36,42,52,61',
			'pic_url'=>'/uploads/temp/content/480f896cf05b1de9ed24791185b633df.jpg',
			'tag_namelist'=>'黄色,现代时尚,混搭'
			);		

		$_pic_url = $_POST['pic_url'];		
        $this->load->library('upload');
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $this->config->load('uploads');	
        $this->load->library('image_lib');
        $config = $this->config->item("content");
        $timedir = $this->upload->mktimedir($config['service_path']);
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        $this->upload->mktimedir($config['service_path']);

        $pic_url= basename($_pic_url);
        $pic_url_flag = (file_exists($_SERVER['DOCUMENT_ROOT'].$_pic_url))?(copy($_SERVER['DOCUMENT_ROOT'].$_pic_url,$timedir.$pic_url)):false;
     
        $sourceimg = $config['service_path'].$time_relative_path.$pic_url;
        $this->upload->mktimedir($config['thumb_1']);
        $this->upload->mktimedir($config['thumb_2']);
        $this->upload->mktimedir($config['thumb_3']);
        $this->upload->mktimedir($config['thumb_4']);

        ($this->image_lib->content_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
        
        $this->t_pic_model->pic_url= ($pic_url_flag==false)?"":$time_relative_path.$pic_url;          
        $pic_id=$this->t_pic_model->insert();    	
		$data=$_POST;		
		$this->t_content_model->user_id= $_SESSION['user_id'];		
		$this->t_content_model->content_content= $data['content_content'];
		$this->t_content_model->pic_id= $pic_id;
		$this->t_content_model->content_tag_id= $data['tag_idlist'];
		$this->t_content_model->content_tag= $data['tag_namelist'];
		$this->t_content_model->content_subtime=date('y-m-d H:i:s',time());
		$reg=$this->t_content_model->insert();
		if(is_int($reg))
		{
			if($this->add_album_content($data['album_id'],$reg))
			{
				return true;
			}else
			{
				return false;
			}
		}
		
	}
	public function add_album_content($album_id,$content_id){

		$this->load->model('t_album_content_model');
		$this->t_album_content_model->album_id= $album_id;
		$this->t_album_content_model->content_id= $content_id;
		$this->t_album_content_model->add_time=date('y-m-d H:i:s',time());
		$reg=$this->t_album_content_model->insert();
		if($reg==true)
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function edit(){
		$this->load->model('t_content_model');
		$this->load->model('t_pic_model');
		$_POST=array(
			'content_id'=>3,
			'album_id'=>'2',
			'tag_idlist'=>'143,1234,323',
			'content_content'=>'灵感描述灵感描述按时打算的撒',
			'tag_namelist'=>'asdas色,asd时尚,混asd搭'
			);	
		$data=$_POST;	
		$reg=$this->t_content_model->update(array('content_content'=>$data['content_content'],'content_tag_id'=>$data['tag_idlist'],'content_tag'=>$data['tag_namelist']),array('content_id'=>$data['content_id']));
	
		if($this->edit_album_content($data['album_id'],$data['content_id']))
		{
			return true;
		}else
		{
			return false;
		}
		
	}
	public function edit_album_content($album_id,$content_id){

		$this->load->model('t_album_content_model');
		$reg=$this->t_album_content_model->update(array('album_id'=>$album_id),array('content_id'=>$content_id));
		if($reg==true)
		{
			return true;
		}else
		{
			return false;
		}
	}
}


