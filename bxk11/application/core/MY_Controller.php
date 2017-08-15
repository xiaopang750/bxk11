<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller{
	
	function __construct()
	{
		session_start();
		parent::__construct();
		$this->load->library('sm');

	}
}
/**
 *description:登陆验证控制器
 *author:yanyalong
 *date:2013/08/31
 */
class User_Controller extends CI_Controller{
	function __construct()
	{
		session_start();
		parent::__construct();
		$this->load->library('sm');
		
	}
	public function checklogin(){
		$thisurl =$_SERVER['PHP_SELF']; 
		$user_id = isset($_COOKIE['user_id'])?$_COOKIE['user_id']:'';
		$user_nickname = isset($_COOKIE['user_nickname'])?$_COOKIE['user_nickname']:'';
		$user_email = isset($_COOKIE['user_email'])?$_COOKIE['user_email']:'';
		$_SESSION['user_id'] = (isset($_SESSION['user_id'])&&$_SESSION['user_id']!='')?$_SESSION['user_id']:$user_id;
		$_SESSION['user_email'] = (isset($_SESSION['user_email'])&&$_SESSION['user_email']!='')?$_SESSION['user_email']:$user_email;
		$_SESSION['user_nickname'] = (isset($_SESSION['user_nickname'])&&$_SESSION['user_nickname']!='')?$_SESSION['user_nickname']:$user_nickname;
		if(!isset($_SESSION['user_id'])||$_SESSION['user_id']==''){
			$url = "/index.php/user/login";
			$url2 = "/index.php/user/regist";
			$url3 = "/index.php/user/home";
			$url4 = "/index.php";
			if(rtrim($_SERVER['PHP_SELF'],'/')==$url4){
				header("Location:$url3");exit;
			}
			if((rtrim($_SERVER['PHP_SELF'],'/')!=$url)&&(rtrim($_SERVER['PHP_SELF'],'/')!=$url3)&&(rtrim($_SERVER['PHP_SELF'],'/')!=$url2)){
				header("Location:$url3");exit;
			}
		}else{
			$this->unsetlogin();
			$url = "index.php/user/login";
			$url2 = "index.php/user/regist";
			if(trim($_SERVER['PHP_SELF'],'/')==$url||trim($_SERVER['PHP_SELF'],'/')=="index.php"||trim($_SERVER['PHP_SELF'],'/')==$url2){
				header("Location:/index.php/user/home");exit;
			}
		}
	}
	public function ajax_checklogin(){
		$user_id = isset($_COOKIE['user_id'])?$_COOKIE['user_id']:'';
		$user_nickname = isset($_COOKIE['user_nickname'])?$_COOKIE['user_nickname']:'';
		$user_email = isset($_COOKIE['user_email'])?$_COOKIE['user_email']:'';
		$_SESSION['user_id'] = (isset($_SESSION['user_id'])&&$_SESSION['user_id']!='')?$_SESSION['user_id']:$user_id;
		$_SESSION['user_email'] = (isset($_SESSION['user_email'])&&$_SESSION['user_email']!='')?$_SESSION['user_email']:$user_email;
		$_SESSION['user_nickname'] = (isset($_SESSION['user_nickname'])&&$_SESSION['user_nickname']!='')?$_SESSION['user_nickname']:$user_nickname;
		if(!isset($_SESSION['user_id'])||$_SESSION['user_id']==''){
			$url = "/index.php/posts/user/login_on";
			$url2 = "/index.php/posts/user/regist";
			if((rtrim($_SERVER['PHP_SELF'],'/')!=$url)&&(rtrim($_SERVER['PHP_SELF'],'/')!=$url2)){
				echojson(2,"index.php/user/login");
			}
		}else{
			$this->unsetlogin();
			$url = "index.php/posts/user/login";
			$url2 = "index.php/posts/user/regist";
			if(trim($_SERVER['PHP_SELF'],'/')==$url||trim($_SERVER['PHP_SELF'],'/')=="index.php"||trim($_SERVER['PHP_SELF'],'/')==$url2){
				echojson(2,"index.php/user/home");
			}
		}
	}
	/**
	 *description:用户组判断
	 *author:yanyalong
	 *date:2013/12/26
	 */
	public function checkdesign(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$res = model("t_user")->get($user_id);
		if($res==false||$res->group_id<'21'||$res->group_id>'30'){
		header("Location:/index.php/user/home");exit;
		}
	}
	/**
	 *description:清除登录缓存信息
	 *author:yanyalong
	 *date:2013/12/11
	 */
	public function unsetlogin(){
		$res = model("t_user")->get($_SESSION['user_id']);
		if(model("t_user")->get($_SESSION['user_id'])==false){
			setcookie("user_email","",time()+3600*24*7,'/');
			setcookie("user_nickname","",time()+3600*24*7,'/');
			setcookie("user_id","",time()-3600*24*7,'/');
			setcookie("notice_show",'',time()-3600*24*7,'/');
			unset($_SESSION['user_id']);
			unset($_SESSION['user_nickname']);
			unset($_SESSION['user_email']);
			unset($_SESSION['notice_show']);
		}
	}

	/**
	 *description:获取用户基本数据
	 *author:yanyalong
	 *date:2013/11/28
	 */
	public function myinfo(){
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		$user_info = 'var $CONFIG = {};'."\n";
		if($user_id==""){
			$user_info .= '$CONFIG['.'"islogin"'.'] = '.'"0";'."\n";
		}else{
			$t_user =model("t_user")->get($user_id);
			$user_info .= '$CONFIG['.'"uid"'.'] = '."'$user_id';"."\n";
			$user_info .= '$CONFIG['.'"islogin"'.'] = '."'1';"."\n";
			$avatar =model("t_user_info")->avatar($user_id);  
			$user_info .= '$CONFIG['."'userpic'".'] ='."'$avatar'".';'."\n";
			$likes = $t_user->user_likes;
			$user_info .= '$CONFIG['.'"likes"'.'] ='."'$likes'".';'."\n";
			$nickname= $t_user->user_nickname;
			$user_info .= '$CONFIG['.'"nickname"'.'] ='."'$nickname'".';'."\n";
			$follows = $t_user->user_follows;
			$user_info .= '$CONFIG['.'"follows"'.'] ='."'$follows'".';'."\n";
			$fans= $t_user->user_fans;
			$user_info .= '$CONFIG['.'"fans"'.'] ='."'$fans'".';'."\n";
			$score= $t_user->user_score;
			$user_info .= '$CONFIG['.'"score"'.'] ='."'$score'".';'."\n";
			$contents = strval($t_user->user_questions+$t_user->user_content);
			$user_info .= '$CONFIG['.'"contents"'.'] ='."'$contents'".';'."\n";
			$email= $t_user->user_email;
			$user_info .= '$CONFIG['.'"email"'.'] ='."'$email'".';'."\n";
			$take = model("t_tag_take")->take_nums($user_id);
			$user_info .= '$CONFIG['.'"take"'.'] ='."'$take'".';'."\n";
			$project = model("t_album")->album_num($user_id)->count;
			$user_info .= '$CONFIG['.'"project"'.'] ='."'$project'".';'."\n";
			$letter = model("t_user_msg")->view_nums($user_id);
			$user_info .= '$CONFIG['.'"letter"'.'] ='."'$letter'".';'."\n";
			$this->db->where('user_id',$user_id);
			$notice= strval($this->db->count_all_results('t_user_notice'));
			$user_info .= '$CONFIG['.'"notice"'.'] ='."'$notice'".';'."\n";
			$this->config->load('url');
			$config = $this->config->item('url');
			$userspace = $config['userspace'].$user_id;
			$user_info .= '$CONFIG['.'"userspace"'.'] ='."'$userspace'".';'."\n";
		}
		return $user_info;
	}
}
class Admin_Controller extends CI_Controller {	
	public $page;
	public $data;
	public $navpage;
	public $pagedata;
	public $getParam;
	public $postParam;
	function __construct(){
		parent::__construct();
		session_start(); 
		$this->load->helper('url');
		$_url="admin/login";
		if(!$this->ischeckin())
		{
			header("Location:".site_url($_url));exit;
		}
	}
	function ischeckin(){
		$_flog=true;
		if(!isset($_SESSION['adminid']))
		{
			$_flog=false;
		}
		return $_flog;
	}

	public function _initpage(){
		$data = $this->data;
		$shutcut =$this->_getmenu();
		$data['mymenu'] = $shutcut['shortcut'];
		$data['base_url'] = config_item("site_url");
		$this->load->view('admin/top',$data);
		$this->load->view("admin/{$this->navpage}");
		$this->load->view("admin/{$this->page}",$this->pagedata);
		$this->load->view('admin/foot');
	}
	
	
	protected function _getchannel() {
		return array(
			'shortcut'      =>  '快捷方式',
			'content'		=> '内容管理'
		);
	}
	
	
	protected function _getmenu(){
		$menu = array();
		//注意顺序！！
		// 快捷方式
		$menu['shortcut'] 		=   array(
			'批量上传灵感' => site_url('admin/1'),
			'发布中灵感'  => site_url('admin/2'),
			'待审核灵感'  =>	site_url('admin/1'),
			'有争议评论'  =>	site_url('admin/1'),
			'创建标签'	  =>	site_url('admin/1'),
			'创建主题'    =>	site_url('admin/1'),
			'查看问题'	  =>	site_url('admin/1')
	
		);
	
		//内容
		$menu['content'] 	=   array(
			'问题'		=>  array(
				'问题列表'	=>site_url('Admin/UserManagement/getUserList'),
				'编辑问题'	=>site_url('Admin/UserManagement/addUser')
			),
			'博文'		=>  array(
				'博文列表'	=>site_url('Admin/UserManagement/getUserList'),
				'编辑博文'	=>site_url('Admin/UserManagement/addUser')
			),
			'标签'		=>  array(
				'标签列表'	=>site_url('Admin/UserManagement/getUserList'),
				'添加标签'	=>site_url('Admin/UserManagement/addUser'),
				'编辑标签'	=>site_url('Admin/UserManagement/addUser')
			)
		);
		return $menu;
	}
}


