<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Floor extends User_Controller {
	function __construct(){
		parent::__construct();
		//$this->ajax_checklogin();
	}

	/**
	 *description:创建楼层
	 *author:yanyalong
	 *date:2013/12/19
	 */
	public function addfloor(){
		safeFilter();
		$scheme_id= isset($_POST['scheme_id'])?$this->input->post('scheme_id',true):'';
		$this->load->model('t_project_floor_model');
		if($this->t_project_floor_model->numByScheme($scheme_id)->count>2){
			echojson(1,"","最多添加三层楼层");
		}
		//新建楼层,返回楼层id
		$this->t_project_floor_model->scheme_id= $scheme_id;
		$floor_id = $this->t_project_floor_model->insert();	
		if($floor_id!=false){
			echojson(0,$floor_id);
		}else{
			echojson(1,"","创建失败");
		}
	}

	/**
	 *description:更新装修案例提交
	 *author:yanyalong
	 *date:2013/12/15
	 */

	public function release(){
		safeFilter();
		loadLib("Scheme_Class");
		SchemeCheckFactory::createObj($_POST,'mod');	
		$scheme_name= isset($_POST['scheme_name'])?$this->input->post('scheme_name',true):'';
		$scheme_status= isset($_POST['scheme_status'])?$this->input->post('scheme_status',true):'';
		$scheme_id= isset($_POST['scheme_id'])?$this->input->post('scheme_id',true):'';
		$scheme_cost= isset($_POST['scheme_cost'])?$this->input->post('scheme_cost',true):'';
		$scheme_thinking= isset($_POST['scheme_thinking'])?$this->input->post('scheme_thinking',true):'';
		//更新装修案例主表
		$param = array('scheme_name'=>$scheme_name,'scheme_status'=>$scheme_status,'scheme_cost'=>$scheme_cost,'scheme_thinking'=>$scheme_thinking);
		$res = $this->t_project_scheme_model->upscheme($scheme_id,$param);	
		//删除当前案例旧标签关联数据
		$this->load->model('t_project_scheme_tag_model');
		$this->t_project_scheme_tag_model->delTagByScheme($scheme_id);
		//获取当前案例下所有房间的标签id信息	
		$tag_idarr = $this->t_project_scheme_tag_model->TagListByScheme($scheme_id);
		foreach ($tag_idarr as $key=>$val) {
			$this->t_project_scheme_tag_model->tag_id= $val->tag_id;
			$this->t_project_scheme_tag_model->scheme_id= $scheme_id;
			$this->t_project_scheme_tag_model->insert();	
		}
		echojson(0,'','更新成功');
	}
	/**
	 *description:删除案例
	 *author:yanyalong
	 *date:2013/12/17
	 */
	public function delScheme(){
		//检测案例id
		safeFilter();
		$scheme_id= isset($_POST['scheme_id'])?$this->input->post('scheme_id',true):'';
		if($scheme_id==""){
			echojson(0,'','取消成功');
		}
		//删除当前案例旧标签关联数据
		$this->load->model('t_project_scheme_model');
		$param = array('scheme_status'=>'99');
		$res = $this->t_project_scheme_model->upscheme($scheme_id,$param);	
		if($res==false){
			echojson(1,'','取消失败');
		}else{
			echojson(0,'','取消成功');
		}
	}
}

