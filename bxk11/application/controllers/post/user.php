<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:首页登录注册
 *author:chenyuda
 *date:2013/08/01
 */
class User extends User_Controller {
	public $bate=true;
	function __construct(){
		parent::__construct();
	}
	/**
	 *description:注册提交
	 *author:yanyalong
	 *date:2013/11/05
	 */
	public function regist()
	{
		if($this->bate)
		{
			safeFilter();
			$this->ajax_checklogin();
			$user_email= $this->input->post('reguser_name',true);
			$user_passwd= $this->input->post('regpass_word',true);
			$group_id = $this->input->post('group_id',true);
			if($group_id==""){
				echojson(1,'请选择用户类型');
			}
			$img= $this->input->post('check_code',true);
			$regcode= $this->input->post('invite_code',true);
			if(!preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',$user_email)){
				echojson(1,'邮箱格式不正确');
			}		
			if(!preg_match('/^[a-zA-Z\d_]{6,16}$/',$user_passwd)){
				echojson(1,'密码格式不正确');
			}		
			if($group_id=='1'){
				$this->load->model('t_house_model');
				$houseinfo = $this->t_house_model->getHouseInfoByName("家178");
				if($houseinfo==false){
					echojson(1,'','无默认楼盘信息，无法注册');
				}else{
					$this->load->model('t_house_apartment_model');
					$apartmentinfo = $this->t_house_apartment_model->getApartmentInfoByHouseId($houseinfo->house_id);
					if($apartmentinfo==false){
						echojson(1,'','无默认户型信息，无法注册');
					}				
				}
			}
			$arr = model("t_user")->sign($user_email,$user_passwd,$img,$group_id);
			if($arr==1){
				echojson(1,"","用户名和密码不能为空");
			}elseif($arr==2){
				echojson(1,"","该邮箱已存在");
			}elseif($arr==3){
				echojson(1,"","验证码不正确");
			}else{
				$user_id = $_SESSION['user_id'];
				loadLib("Score_Class");
				$Score_Class = new Score_Class($user_id,"user_reg");
				$Score_Class->modScore();
				$this->load->model("t_user_info_model");
				$this->t_user_info_model->user_id = $user_id;	
				$this->t_user_info_model->insert();
				if($group_id==1){
					$this->load->model("t_project_model");
					$this->t_project_model->house_id= $houseinfo->house_id;	
					$this->t_project_model->project_name= "默认项目";	
					$this->t_project_model->apartment_id = $apartmentinfo->apartment_id;	
					$this->t_project_model->user_id=$user_id;	
					$this->t_project_model->project_user_type=2;	
					$this->t_project_model->project_status=5;	
					$this->t_project_model->insert();
				}
				echojson(0,"index.php/user/my/","注册成功");
			}
		}
		echojson(0,"","测试中,请联系本站获取邀请码");
	}
	//登录
	public function login_on()
	{
		safeFilter();
		$this->ajax_checklogin();
		$user_email= $this->input->post('user_name',true);
		$password = $this->input->post('pass_word',true);
		$remeber = $this->input->post('save_cookie',true);
		$res=model("t_user")->login_on_get($user_email,$password,$remeber);
		if($res==true){
			echojson(0,"","登陆成功");
		}else{
			echojson(1,"","用户名或密码错误");
		}
	}
	/**
	 *description:添加留言
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function addmsg(){
		safeFilter();
		$_POST = disableCheck();
		$this->load->model('t_user_space_msg_model');
		$touid= $this->input->post('touid',true);
		$msg= $this->input->post('msg',true);
		$user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
		if($user_id==""){
			echojson(2,"","未登录");
		}
		$nickname= isset($_SESSION['user_nickname'])?$_SESSION['user_nickname']:"";
		$this->t_user_space_msg_model->msg_content= $msg;
		$this->t_user_space_msg_model->user_id = $touid;
		$this->t_user_space_msg_model->msg_send_uid= $user_id;
		$this->t_user_space_msg_model->msg_send_user_nick = $nickname;
		$res=$this->t_user_space_msg_model->insert();
		if($res==true){
			echojson(0,"","留言成功");
		}else{
			echojson(1,"","留言失败");
		}

	}
}

