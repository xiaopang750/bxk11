<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class User extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function fenye($nubs,$counts,$url)
	{
		$this->load->library('Pagination');
		$config['per_page'] = $nubs;
		$config['total_rows'] = $counts;
		$config['base_url'] = $url;
		$config['use_page_numbers'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['prev_link'] = '上一页';
		$config['next_link'] = '下一页';
		$config['first_link'] = '首页';
  		$config['last_link'] = '尾页';
  		$config['full_tag_open'] = '<p>';
  		$config['full_tag_close'] = '</p>';
  		$config['num_links'] = 3;
		$this->pagination->initialize($config); 
		$page = $this->pagination->create_links();
		return $page;
	}
	/**
	 *description:用户详情   动态类别
	 *author:baohanbin
	 *date:2013/11/12
	 */
	public function fees_type(){
		
		$arr = array(
			'1' => '增加博文',
			'2' => '删除博文',
			'3' => '编辑博文',
			'4' => '增加美图',
			'5' => '删除美图',
			'6' => '编辑美图',
			'7' => '提问',
			'8' => '删除问题',
			'9' => '编辑问题',
			'10' => '增加答案',
			'11' => '编辑答案',
			'12' => '删除答案',
			'13' => '增加评论',
			'14' => '修改评论',
			'15' => '删除评论',
			'21' => '增加喜欢',
			'22' => '取消喜欢',
			'23' => '增加关注',
			'24' => '取消关注',
			'25' => '增加订阅',
			'26' => '取消订阅',
			'27' => '添加黑名单',
			'28' => '移除黑名单',
			'29' => '创建项目',
			'30' => '删除项目',
			'31' => '有用',
			'32' => '无用',
			'91' => '用户登录',
			'92' => '用户更改设置',
			'93' => '找回密码',
			'94' => '金币兑换积分',
			'95' => '积分兑换金币',
			);
		return $arr;
	}
	/**
	 *description:用户列表
	 *author:baohanbin
	 *date:2013/11/12
	 */

	public function userlist()
	{
		$nicname = $this->input->get('nicname');
		$email = $this->input->get('email');
		$starttime = $this->input->get('starttime');
		$stoptime = $this->input->get('stoptime');

		$this->load->library('Pagination');
		if(isset($_GET['per_page']) && is_numeric($_GET['per_page'])){
			$p = $_GET['per_page'];
		}else{
			$p=1;
		}
		$this->load->model('t_user_model'); 
		$nubs = $this->t_user_model->count_list_amdin($nicname,$email,$starttime,$stoptime);
		$url = base_url()."index.php/admin/user/userlist?nicname=$nicname&email=$email&starttime=$starttime&stoptime=$stoptime";
		$nb = 10;
		$info['list'] = $this->t_user_model->usrelistadmin($p,$nb,$nicname,$email,$starttime,$stoptime);
		if(empty($info)){
			$this->userlist();
		}
		$info['page'] = $this->fenye($nb,$nubs,$url);

		$data['title']='家178管理后台';
		$data['base_url']=config_item("site_url");
		$data['menu']='index';
		$data['mymenu']=array('批量上传灵感'=>'1','发布中灵感'=>'2','待审核灵感'=>'3','有争议评论'=>'4','创建标签'=>'5','创建主题'=>'6','查看问题'=>'7');
		$data['nicname'] = $nicname;
		$data['email'] = $email;
		$data['starttime'] = $starttime;
		$data['stoptime'] = $stoptime;
		$this->load->view('admin/top',$data);
		$this->load->view('admin/nav');
		$this->load->view('/admin/user/userlists',$info);
		$this->load->view('admin/foot');
	}

	/**
	 *description:显示用户详情（修改）
	 *author:baohanbin
	 *date:2013/11/12
	 */
	public function users()
	{
		$uid = $_GET['uid'];
		$this->load->model('t_user_model');
		$info = $this->t_user_model->userinfo($uid);

		$data['title']='家178管理后台';
		$data['base_url']=config_item("site_url");
		$data['menu']='index';
		$data['mymenu']=array('批量上传灵感'=>'1','发布中灵感'=>'2','待审核灵感'=>'3','有争议评论'=>'4','创建标签'=>'5','创建主题'=>'6','查看问题'=>'7');
		
		$this->load->view('admin/top',$data);
		$this->load->view('admin/nav');
		$this->load->view('/admin/user/userup',$info);
		$this->load->view('admin/foot');
	}

	/**
	 *description:用户详情（修改）
	 *author:baohanbin
	 *date:2013/11/12
	 */
	public function usersup()
	{
		$this->load->model('t_user_model');
		$id = $this->input->post('id');
		$email = strip_tags($this->input->post('email'));
		$name = strip_tags($this->input->post('yname'));
		//$pwd = $this->input->post('pwd');
		$phone = $this->input->post('phone');
		//$this->t_user_model->user_passwd = md5($pwd);
		$data['user_mobile'] = $phone;
		$data['user_email'] = $email;
		$data['user_nickname'] = $name;
		$data['user_type'] = $this->input->post('type');
		$data['user_likes'] = $this->input->post('likes');
		$data['user_follows'] = $this->input->post('follows');
		$data['user_fans'] = $this->input->post('fans');
		$this->t_user_model->user_id = $id;
		$this->t_user_model->user_email = $email;
		$this->t_user_model->user_nickname = $name;

		$mes = $this->t_user_model->sel_email();
		$res = $this->t_user_model->sel_nicname();
		$url = U('admin/user/users',array('uid'=>$id));
		if($mes == false){
			jumpAjax("邮箱已存在，请重新修改",$url);
		}
		if($res == false){
			jumpAjax("昵称已存在，请重新修改",$url);
		}
		$where['user_id'] = $id;
		$info = $this->t_user_model->update($data,$where);
		if($info == true){
			$url = U('admin/user/userlist');
			jumpAjax("修改成功",$url);
		}else{
			jumpAjax("修改失败",$url);
		}
	}
	/**
	 *description:用户详情（修改）邮箱、昵称重复重新加载的页面
	 *author:baohanbin
	 *date:2013/11/12
	 */
	public function useramend($id){
		$uid = $id;
		$this->load->model('t_user_model');
		$info = $this->t_user_model->userinfo($uid);

		$data['title']='家178管理后台';
		$data['base_url']=config_item("site_url");
		$data['menu']='index';
		$data['mymenu']=array('批量上传灵感'=>'1','发布中灵感'=>'2','待审核灵感'=>'3','有争议评论'=>'4','创建标签'=>'5','创建主题'=>'6','查看问题'=>'7');
		
		$this->load->view('admin/top',$data);
		$this->load->view('admin/nav');
		$this->load->view('/admin/user/userup',$info);
		$this->load->view('admin/foot');
	}
	
	/**
	 *description:用户详情（修改）邮箱、昵称重复重新加载的页面
	 *author:baohanbin
	 *date:2013/11/12
	 */
	public function feeds_list()
	{
		if(isset($_GET['per_page']) && is_numeric($_GET['per_page'])){
			$p = $_GET['per_page'];
		}else{
			$p=1;
		}
		$uid = intval($this->input->get('uid',true));
		$email = $this->input->get('email');
		$content = $this->input->get('content');
		$starttime = $this->input->get('starttime');
		$stoptime = $this->input->get('stoptime');
		$type = intval($this->input->get('type',true));

		$this->load->model('t_user_feeds_model');
		$this->t_user_feeds_model->user_id = $uid;
		$this->t_user_feeds_model->feed_type = $type;
		$nubs = $this->t_user_feeds_model->user_info_count($content,$starttime,$stoptime);
		$url = base_url()."index.php/admin/user/feeds_list?uid=$uid&email=$email&content=$content&starttime=$starttime&stoptime=$stoptime&type=$type";
		$nb = 10;
		$info['list'] = $this->t_user_feeds_model->user_dynamic($p,$nb,$content,$starttime,$stoptime,$type);
		$info['email'] = $email;
		$info['uid'] = $uid;
		$info['type'] = '';
		$info['feed'] = $this->fees_type();
		$info['page'] = $this->fenye($nb,$nubs,$url);


		$data['title']='家178管理后台';
		$data['base_url']=config_item("site_url");
		$data['menu']='index';
		$data['mymenu']=array('批量上传灵感'=>'1','发布中灵感'=>'2','待审核灵感'=>'3','有争议评论'=>'4','创建标签'=>'5','创建主题'=>'6','查看问题'=>'7');
		$data['starttime'] = $starttime;
		$data['stoptime'] = $stoptime;
		$data['types'] = $type;
		
		$data['content'] = $content;

		$this->load->view('admin/top',$data);
		$this->load->view('admin/nav');
		$this->load->view('/admin/user/userdynamic',$info);
		$this->load->view('admin/foot');
	}


	/**
	 *description:显示添加用户页面
	 *author:baohanbin
	 *date:2013/11/12
	 */
	public function useradd()
	{
		$data['title']='家178管理后台';
		$data['base_url']=config_item("site_url");
		$data['menu']='index';
		$data['mymenu']=array('批量上传灵感'=>'1','发布中灵感'=>'2','待审核灵感'=>'3','有争议评论'=>'4','创建标签'=>'5','创建主题'=>'6','查看问题'=>'7');
		
		$this->load->view('admin/top',$data);
		$this->load->view('admin/nav');
		$this->load->view('/admin/user/useradd');
		$this->load->view('admin/foot');
	}
	/**
	 *description:添加用户
	 *author:baohanbin
	 *date:2013/11/12
	 */
	public function adduser()
	{
		$emial = strip_tags($this->input->post('emial'));
		$name = strip_tags($this->input->post('yname'));
		$pwd = $this->input->post('pwd');
		$url = U('admin/user/useradd');
		if($emial == ''){
			jumpAjax('邮箱不能为空',$url);
		}
		if($name == ''){
			jumpAjax('昵称不能为空',$url);
		}
		if($pwd == ''){
			jumpAjax('密码不能为空',$url);
		}
		$this->load->model('t_user_model');
		$this->t_user_model->user_email = $emial;
		$this->t_user_model->user_nickname = $name;
		$this->t_user_model->user_passwd = md5($pwd);
		$this->t_user_model->user_type = 1;
		$this->t_user_model->user_likes = 0;
		$this->t_user_model->user_follows = 0;
		$this->t_user_model->user_fans = 0;
		$this->t_user_model->user_contents = 0;

		$res = $this->t_user_model->check_email($emial,'');
		$mes = $this->t_user_model->add_name($name,'');
		$url =  U('admin/user/useradd');
		if($res == true){
			jumpAjax('邮箱已存在，请重新注册',$url);
		}
		if($mes == true){
			jumpAjax('昵称已存在，请重新注册',$url);
		}
		$insert_id = $this->t_user_model->insert();
		if($insert_id){
			jumpAjax('添加成功',$url);	
		}else{
			jumpAjax('添加失败',$url);
		}
	}
	/**
	 *description:删除用户
	 *author:baohanbin
	 *date:2013/11/12
	 */
	public function deluser()
	{
		$uid = $_GET['uid'];
		$this->load->model('t_user_model');
		$this->t_user_model->user_id = $uid;
		$res = $this->t_user_model->del_use_f();
		$url =  U('admin/user/userlist');
		if($res == true){
			jumpAjax('删除成功',$url);
		}else{
			jumpAjax('删除失败',$url);
		}
	}

	public function dels()
	{
		$nub = $this->input->get('uid');
		echo $nub;
	}



	/**
	 *description:设置每日之星
	 *author:baohanbin
	 *date:2013/11/28
	 */
	public function daily_star(){
		$uid = $this->input->get('uid');
		$this->load->model('t_system_model');
		$this->t_system_model->sys_value = $uid;
		$mes = $this->t_system_model->sel_key_cn();
		if($mes == false){
			echo "<script>alert('请先添加系统推荐项，在设置每日之星');window.location.href='".site_url('admin/user/userlist')."'</script>";exit;
			//return $this->userlist();
		}else{
			$this->t_system_model->sys_key = $mes[0]->sys_key;
			$res = $this->t_system_model->up_daily();
			if($res == true){
				echo "<script>alert('设置成功');window.location.href='".site_url('admin/user/userlist')."'</script>";
				//return $this->userlist();
			}else{
				echo "<script>alert('设置失败');window.location.href='".site_url('admin/user/userlist')."'</script>";
				//return $this->userlist();
			}
		}
	}
}

?>
