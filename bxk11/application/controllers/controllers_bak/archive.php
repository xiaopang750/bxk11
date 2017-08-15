<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("content-type:text/html;charset=utf-8"); 
/**
 *description:前台归档
 *author:chenyuda
 *date:2013/08/22
 */
class Archive extends Temp_Controller {
	function __construct(){
        parent::__construct();
    }
	//显示当前登录用户所拥有的归档
	public function archive_show()
	{
		
		$this->load->model('Bxk_user_class_model');
		$user_id = $_SESSION['user_id'];
		$arr=$this->Bxk_user_class_model->show_archive($user_id);
		if(!empty($arr)){
			echojson(1,$arr);
		}else{
			echojson(0,'无相关数据');
		}
	}
	
	/**
	 *description:创建归档
	 *author:yanyalong
	 *date:2013/09/24
	 */
	public function archive_set(){
				
		safeFilter();
		$this->load->model('Bxk_user_class_model');
		$user_id = $this->input->post('user_id',true);
		$class_type = $this->input->post('class_type',true);
		$class_name = $this->input->post('class_name',true);
		if($class_name==''){
			echojson(0,'归档名称不能为空');
		}
		if((strlen(trim($class_name)) + mb_strlen(trim($class_name),'UTF8'))/2>20){
			echojson(0,'归档名称不能超过10个字');
		}
		$res=$this->Bxk_user_class_model->add_class($user_id,$class_name,$class_type);
		if($res=='0'){
			echojson(0,'已存在的归档名称');
		}elseif($res=='1'){
			echojson(0,'创建失败');
		}else{
			echojson(1,$res);
		}
	}
	//删除归档
	public function archive_del()
	{
				
		$this->load->model('Bxk_user_class_model');
		$class_id = $this->input->post('class_id');
		$arr=$this->Bxk_user_class_model->del_archive($class_id);
		if($arr==true){
			echojson(1,'取消成功');
		}else{
			echojson(0,'取消失败');
		}
	}

	//将某个灵感博文添加到相应的归档下
	function archive_add()
	{
				
		$this->load->model('Bxk_user_class_model');
		$content_id = $this->input->post('content_id');
		$user_id = $this->input->post('user_id');
		$class_id = $this->input->post('class_id');
		$arr=$this->Bxk_user_class_model->add_archive($content_id,$user_id,$class_id);
		if($arr==true){
			echojson(1,'添加成功');
		}else{
			echojson(0,'添加失败');
		}

	}



	//显示归档中心
	function show_mydoc()
	{
		$this->load->view("index/user/addDoc");
	}
	
	//显示归档中心的所有内容
	function show_mydoc_content()
	{
		$this->load->model('Bxk_content_model');
		$user_id = $this->input->post('user_id');
		$array = $this->Bxk_content_model->mycontentall($user_id);
		if(!empty($array)){
			echojson(1,$array);
		}else{
			echojson(0,'无相关数据');
		}
	}

	//根据点击标题栏中的归档名称进行查询
	function soso_content()
	{
				
		$this->load->model('Bxk_content_model');
		$class_id = $this->input->post('class_id');
		$user_id = $this->input->post('user_id');
		$array = $this->Bxk_content_model->contentbyclass($class_id,$user_id);
		if(!empty($array)){
			echojson(1,$array);
		}else{
			echojson(0,'无相关数据');
		}
	}

	//展现选择归档名称
	function sel_class()
	{
		$this->load->model('Bxk_user_class_model');
        $user_id = $this->input->post('user_id');
		$arr = $this->Bxk_user_class_model->sel_class_name($user_id);
		if(!empty($arr)){
			echojson(1,$arr);
		}else{
			echojson(0,'无相关数据');
		}
	}

	
	//展现归档标题
	function sel_class_page()
	{
				
		$this->load->model('Bxk_user_class_model');
        $content_id = $this->input->post('class_content_id',true);
		$user_id = $_SESSION['user_id'];
		$arr = $this->Bxk_user_class_model->sel_class_name_page($user_id,$content_id);
		if(!empty($arr)){
			echojson(1,$arr);
		}else{
			echojson(0,'无相关数据');
		}
	}


//	添加某个灵感博文到某个归档当中
	function add_archive(){
				
		$this->load->model('Bxk_user_class_model');
		$class_id = $this->input->post('class_id');
		$user_id = $this->input->post('user_id');
		$content_id = $this->input->post('content_id');
		$arr = $this->Bxk_user_class_model->add_archive_name($class_id,$user_id,$content_id);
		if($arr==true){
			echojson(1,'添加成功');
		}else{
			echojson(0,'添加失败');
		}
	}

	//删除某个归档当中的灵感博文
	function del_archive()
	{
				
		$this->load->model('Bxk_user_class_model');
		$content_id = $this->input->post('content_id');
		$user_id = $this->input->post('user_id');
		$arr = $this->Bxk_user_class_model->del_some_archive($user_id,$content_id);
		if($arr==true){
			echojson(1,'删除成功');
		}else{
			echojson(0,'删除失败');
		}
	}

	//喜欢归档
	function like_archive()
	{
				
		$this->load->model('Bxk_content_model');
		$user_id = $this->input->post('user_id');
		$array = $this->Bxk_content_model->mycontentall_like($user_id);
		if($array!=false){
			echojson(1,$array);
		}else{
			echojson(0,'无相关数据');
		}
	}

	//推荐归档
	function rec_archive()
	{
				
		$this->load->model('Bxk_content_model');
		$user_id = $this->input->post('user_id');
		$array = $this->Bxk_content_model->mycontentall_rec($user_id);
		if($array!=false){
			echojson(1,$array);
		}else{
			echojson(0,'无相关数据');
		}
	}

	//订阅归档
	function sub_archive()
	{
		$this->load->model('Bxk_content_model');
		$user_id = $this->input->post('user_id');
		$array = $this->Bxk_content_model->mycontentall_sub($user_id);
		if(!empty($array)){
			echojson(1,$array);
		}else{
			echojson(0,'无相关数据');
		}
		
	}


	//取消批量操作
	function batch_delete(){
				
		$this->load->model('Bxk_content_model');
		$user_id = $this->input->post('user_id');
		$content_id = $this->input->post('content_id');
		$type =$this->input->post('type');
		$arr = $this->Bxk_content_model->batch_del_contentall($user_id,$content_id,$type);
		if($arr==true){
			echojson(1,'取消成功');
		}else{
			echojson(0,'取消失败');
		}
	}
}

