<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album extends User_Controller {
	function __construct(){
		parent::__construct();
		$this->ajax_checklogin();
	}

	/**
	 *descr iption:添加项目灵感辑
	 *author:baohanbin
	 *date:2013/11/07
	 */
	//public function addcontent(){
		//$project_name = strip_tags($this->input->post('name'));
		//$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		//if($user_id==""){
			//echojson(1,'','未登录');
		//}
		//if($project_name == '')
		//{
			//echojson(1,'','项目的名称不能为空');
		//}
		//$this->load->model('t_project_model');
		//$this->t_project_model->user_id = $user_id;
		//$this->t_project_model->project_type = 1;
		//$this->t_project_model->project_name = $project_name;
		//$this->t_project_model->project_numbers = 0;
		//// 判断 t_project_model 存不存在数据
		//$obj = $this->t_project_model->get_uset_type($user_id,$project_name);
		//if($obj){
			//echojson(1,'','请不要重复加入同一个灵感集');
		//}
		//else{
			//$insert_id = $this->t_project_model->insert();
			//if($insert_id){
				//echojson(0,'','添加成功');
			//}else{
				//echojson(1,'','添加失败');
			//}
		//}
	//}
	/**
	 *description:添加博文至项目灵感辑
	 *author:baohanbin
	 *date:2013/11/07
	 */
	public function addtocontent(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(2,'','未登录');
		}
		safeFilter();
		$_POST = disableCheck();
		$album_name= strip_tags($this->input->post('name'));
		$content_id = $this->input->post('cid',true);
		//$reason = strip_tags($this->input->post('reason'));
		//if($album_name== ''){
			//echojson(1,'','项目的名称不能为空');
		//}
		loadLib("Album_Class");
		$res = AlbumFactory::createObj($album_name,$content_id,$user_id);
		switch ($res) {
		case '0':
			echojson(1,'','添加失败');
			break;
		case '1':
			echojson(0,"",'添加成功');
			break;
		case '2':
			echojson(1,"",'不能重复加入同一个灵感集');
			break;
		}
	}

	/**
	 *description:添加问题至项目灵感辑
	 *author:baohanbin
	 *date:2013/11/07
	 */

	//public function addtoquestion()
	//{
		//$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		//if($user_id==""){
			//echojson(1,'','未登录');
		//}
		//$qa_id = $this->input->post('qid',true);
		//$project_id = $this->input->post('project_id',true);
		//$album_name= strip_tags($this->input->post('name'));
		//$reason = strip_tags($this->input->post('reason'));

		//if($album_name== '')
		//{
			//echojson(1,'','项目的名称不能为空');
		//}
		//$this->load->model('t_project_model');
		//$this->load->model('t_project_questions_model');
		//$this->t_project_model->user_id = $user_id;
		//$this->t_project_model->project_type = 1;
		//$this->t_project_model->project_name = $project_name;
		//$this->t_project_model->project_numbers = 0;
		//$this->t_project_questions_model->p_user_id = $user_id;
		//$this->t_project_questions_model->p_questions_id = $qa_id;
		//$this->t_project_questions_model->p_reason = $reason;
		//判断 get_uset_type 存不存在这条数据
		//$obj = $this->t_project_model->get_uset_type($user_id,$project_name);
		//if($obj)
		//{
			//判断 t_project_questions_model 数据是否存在
			//$this->t_project_questions_model->p_project_id = $obj;
			//$is_tocontent = $this->t_project_questions_model->is_tocontent();
			//if($is_tocontent == false)
			//{
				//修改 t_project_questions_model/t_questions_model 中的数据
				//$insert_id = $this->t_project_questions_model->insert();
				//$this->load->model('t_questions_model');

				//$this->t_questions_model->question_id = $qa_id;
				//$this->t_questions_model->up_question($qa_id);
				//$res = $this->t_project_model->project_id = $obj;
				//if($res)
				//{
					//$this->t_project_model->up_project($obj);
					//loadLib("Notice");
					//$notice = new Notice("GetNoticeByProject",$user_id,$qa_id,"2","","","");
					//echojson(0,'','添加成功');
				//}
				//else
				//{
					//echojson(1,'','添加失败');
				//}
			//}
			//else
			//{
				//echojson(1,'','请不要重复加入同一个灵感集');
			//}
		//}
		//else
		//{
			//向 t_project_model 插入数据
			//$insert_project_id = $this->t_project_model->insert();
			//if($insert_project_id)
			//{
				//修改 t_project_questions_model/t_questions_model 中的数据
				//$this->t_project_questions_model->p_project_id = $insert_project_id;
				//$insert_id = $this->t_project_questions_model->insert();
				//$this->load->model('t_questions_model');
				//$this->t_questions_model->question_id = $qa_id;
				//$mes = $this->t_questions_model->up_question($qa_id);
				//if($mes == true)
				//{
					//$this->t_project_model->project_id = $insert_project_id;
					//$this->t_project_model->up_project($insert_project_id);
					//loadLib("Notice");
					//$notice = new Notice("GetNoticeByProject",$user_id,$qa_id,"2","","","");
					//echojson(0,$insert_project_id,'成功');
				//}
				//else
				//{
					//echojson(1,'','失败');
				//}
			//} 
		//}
	//}
	
	
	/**
	 *description:
	 *author:冀帅
	 *QQ:75426585
	 *date:2014-7-15
	 */
	
	/*添加灵感辑*/
	public function add(){
		//var_dump($_POST);
		//exit;
		
		$this->load->model('t_album_model');
		
		$this->t_album_model->album_name = (isset($_POST['album_name']))?$_POST['album_name']:'';
		$this->t_album_model->album_explain = (isset($_POST['album_explain']))?$_POST['album_explain']:'';
		$this->t_album_model->album_ctime = (isset($_POST['album_name']))?$_POST['album_name']:'';
		$this->t_album_model->album_count = 0;
		$this->t_album_model->album_ctime = date('y-m-d h:i:s',time());
		$this->t_album_model->user_id = $_SESSION['user_id'];

		if($this->t_album_model->add()){
			jumpAjax('添加成功',U('album/albumlist'));
		} else {
			jumpAjax('添加成功',U('album/albumlist'));
		}
		
	}
	
	/*添加灵感辑*/
	public function edit(){
		//var_dump($_POST);
		//exit;
		$this->load->model('t_album_model');
		$id = (int)($_GET['album_id']);
		
		$data['album_name'] = (isset($_POST['album_name']))?$_POST['album_name']:'';
		$data['album_explain'] = (isset($_POST['album_explain']))?$_POST['album_explain']:'';
		$where = array('album_id'=>$id);
	
		$res = $this->t_album_model->update($data,$where);

		if($res){
			echojson('0', $data);
		}else{
			echojson('1', '','无相关数据');
		}
	
	}
	
	
}

