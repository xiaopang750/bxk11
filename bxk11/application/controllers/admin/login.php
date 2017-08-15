<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:13 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class Login extends MY_Controller
{	public $title;
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		ob_start();
	}
	function index()
	{


		$this->title='家178';
		$this->load->view('admin/login',$this);
	}

	//测试用,别按这个写
	function check()
	{ 
		$_debug=false;
		if(!$this->input->post("username"))
		{
			echo "<script type='text/javascript'>alert('请输入账号');window.location.href='".site_url('admin/login')."'</script>";
			exit;
		}

		if(!$this->input->post("password"))
		{

			echo "<script type='text/javascript'>alert('请输入密码');window.location.href='".site_url('admin/login')."'</script>";
			exit;
		}
		$_username=$this->input->post("username");
		$_password=$this->input->post("password");
		if($_debug)
		{
			echo $_username;
			echo $_password;
			echo $_SESSION['adminid']; 
			echo "Location:".site_url($_url);
		}
		$_url="admin/home";
		$_SESSION['adminid']='admin1';
		$this->load->model('t_system_admin_model');

		$this->t_system_admin_model->get_by_name($_username);
		if(!isset($this->t_system_admin_model->admin_name))
		{

			echo "<script type='text/javascript'>alert('用户不存在');window.location.href='".site_url('admin/login')."'</script>";
			exit;
		}
		if(md5($_password)===$this->t_system_admin_model->admin_pass)
		{
			$_SESSION['admin_id'] = $this->t_system_admin_model->admin_id;
			//echo '密码正确';
			//echo $arr;
			header("Location:".site_url($_url));
			exit;
		}
		else{
			echo "<script type='text/javascript'>alert('密码错误');window.location.href='".site_url('admin/login')."'</script>";
		}
		exit;
	}


	//测试用,别按这个写
	private function object_to_array($obj){
		$ret = array();
		foreach($obj as $key =>$value){
			if(gettype($value) == 'array' || gettype($value) == 'object'){
				$ret[$key] = objtoarr($value);
			}
			else{
				$ret[$key] = $value;
			}
		}
		return $ret;
	}
	//登出
	public function logout(){
		unset($_SESSION['adminid']);
		unset($_SESSION['allname']);
		unset($_SESSION['admin_id']);
		if(isset($_SESSION['adminid'])){
			$_SESSION['adminid'] = '';
		}else{
			echo "<script type='text/javascript'>alert('己退出');window.location.href='".site_url('admin/login')."'</script>";
		}
	
	}
}
