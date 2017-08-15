<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        dinghaochenAuthor: ��껳�
 *        Email: dotnet010@gmail.com

 */
class Administrator extends Admin_Controller
{	

	public $navpage;
	public function __construct(){
		parent::__construct();	
		$this->load->model('T_system_admin_model');
	}

	public function adminlist()
	{
		$data['title']='管理员列表';
		$data['menu']="administrator";//顶端选中
		$this->navpage = 'administrator/nav';	
		$reg['reg'] = $this->T_system_admin_model->get_all();
		
		
		$this->load->view('admin/top',$data);
		$this->load->view("admin/nav");		
		$this->load->view('admin/administrator/adminlist',$reg);	
		$this->load->view('admin/foot');
		
	}

	public function adminadd()
	{
		$data['title']='添加管理员';
		$data['menu']="administrator";//顶端选中
		$this->navpage = 'administrator/nav';

		$this->load->view('admin/top',$data);
		$this->load->view("admin/nav");		
		$this->load->view('admin/administrator/adminadd');	
		$this->load->view('admin/foot');
		
	}
	public function admineditor()
	{
		$data['title']='编辑管理员';
		$data['menu']="administrator";//顶端选中
		$this->navpage = 'administrator/nav';
		
		$reg['reg']=$this->T_system_admin_model->get1($_GET['id']);
		
		$this->load->view('admin/top',$data);
		$this->load->view("admin/nav");		
		$this->load->view('admin/administrator/admineditor',$reg);	
		$this->load->view('admin/foot');
		
	}
	public function adminpass()
	{
		$data['title']='修改管理员密码';
		$data['menu']="administrator";//顶端选中
		$this->navpage = 'administrator/nav';		
		$reg['reg']=$_GET['id'];
		$this->load->view('admin/top',$data);
		$this->load->view("admin/nav");		
		$this->load->view('admin/administrator/adminpass',$reg);	
		$this->load->view('admin/foot');
		
	}
	public function doadminpass()
	{
		if($_POST['admin_pass']=="")
		{
			echo '<script>alert("修改失败,不能为空");history.go(-1)</script>';
			return false;
		}
		$reg=$this->T_system_admin_model->update2($_POST);
		if($reg==true)
		{
			echo '<script>alert("修改成功");window.location.href="./adminlist"</script>';
		}else
		{
			return false;
		}
		
	}
	public function doadmineditor()
	{
		if($_POST['admin_name']=="")
		{
			echo '<script>alert("修改失败");history.go(-1)</script>';
			return false;
		}
		$reg=$this->T_system_admin_model->update($_POST);
		if($reg==true)
		{
			echo '<script>alert("修改成功");window.location.href="./adminlist"</script>';
		}else
		{
			return false;
		}
		
	}
	public function doadminadd()
	{

		$i=1;
		if($_POST['admin_name']=='')
		{
			$i=0;
			echo '<script>alert("添加失败,账号不能为空");history.go(-1)</script>';
		}
		if($_POST['admin_pass']=='')
		{
			$i=0;
			echo '<script>alert("添加失败,密码不能为空");history.go(-1)</script>';
		}
		if($_POST['admin_nikename']=='')
		{
			$i=0;
			echo '<script>alert("添加失败,名字不能为空");history.go(-1)</script>';
		}
		if($i==1){
			$reg = $this->T_system_admin_model->insert($_POST);
		}
		else{
			echo '<script>alert("添加失败");history.go(-1)</script>';
		}
		if($reg==false)
		{
			echo '<script>alert("添加失败");history.go(-1)</script>';
		}else
		{
			echo '<script>alert("添加成功");window.location.href="./adminlist"</script>';		
		}
		
	}
	public function admindel()
	{		
		
		$reg = $this->T_system_admin_model->delete1($_GET['id']);
		if($reg==false)
		{
			echo '<script>alert("删除失败");history.go(-1)</script>';
		}else
		{
			echo '<script>alert("删除成功");window.location.href="./adminlist"</script>';		
		}

	}
	
}

?>