<?php
/**
 *description:案例
 *author:yanyalong
 *date:2013/12/10
 */
class scheme extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:为项目添加方案(2D)
	 *author:yanyalong
	 *date:2013/12/10
	 */
	public function addscheme(){
		safeFilter();
		$this->checkdesign();
		$data['config']	= $this->myinfo();
		$data['title']	= "添加项目设计方案";
		$data['seo']	="seo";
		$data['scheme_type'] = array(1=>'平面效果方案',2=>'3D全景方案');
		$data['warn'] = "只有认证设计时才能上传3D全景方案";
		$url = "/index.php/user/home";
$project_id= isset($_GET['pid'])?$this->input->get('pid'):"";
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if(intval(trim($project_id))==""){
			$url = "/index.php/user/home";
			header("Location:$url");exit;
		}
		$ishas = model("t_project")->is_hasByPid($project_id,$user_id);
		if($ishas==false){
			$url = "/index.php/user/home";
			header("Location:$url");exit;
		}
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['addscheme'],$data);	
	}
	/**
	 *description:为项目添加方案(3d)
	 *author:yanyalong
	 *date:2013/12/10
	 */
	public function addscheme3d(){
		$this->checkdesign();
		safeFilter();
		$data['config']	= $this->myinfo();
		$data['title']	= "添加项目设计方案";
		$data['seo']	="seo";
		$data['scheme_type'] = array(1=>'平面效果方案',2=>'3D全景方案');
		$url = "/index.php/user/home";
$project_id= isset($_GET['pid'])?$this->input->get('pid'):"";
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if(intval(trim($project_id))==""){
			$url = "/index.php/user/home";
			header("Location:$url");exit;
		}
		$ishas = model("t_project")->is_hasByPid($project_id,$user_id);
		if($ishas==false){
			$url = "/index.php/user/home";
			header("Location:$url");exit;
		}
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['addscheme3d'],$data);	
	}
	/**
	 *description:发布成功
	 *author:yanyalong
	 *date:2013/12/10
	 */
	public function success(){
		$data['config']	= $this->myinfo();
		$data['title']	= "发布成功";
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['addsuccess'],$data);	
	}
	/**
	 *description:案例主页
	 *author:yanyalong
	 *date:2013/12/21
	 */
	public function index(){
		$data['config']	= $this->myinfo();
		$data['title']	= "案例主页";
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['schemeindex'],$data);	
	}
	/**
	 *description:案例搜索页
	 *author:yanyalong
	 *date:2013/12/21
	 */
	public function search(){
		$data['config']	= $this->myinfo();
		$data['title']	= "案例搜索";
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['schemesearch'],$data);	
	}
	/**
	 *description:案例详情页
	 *author:yanyalong
	 *date:2013/12/24
	 */
	public function info(){
		safeFilter();
		$scheme_id= isset($_GET['sid'])?$this->input->get('sid',true):'';
		$schemeinfo= model("t_project_scheme")->get($scheme_id);
		if($schemeinfo==false){
			header("Location:/index.php/user/home");exit;
		}
		$data['config']	= $this->myinfo();
		$data['title']	= $schemeinfo->scheme_name;
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['schemeinfo'],$data);	
	}
}


