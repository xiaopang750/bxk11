<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:发送邮箱(以及邮箱操作)
 *author:baohanbin
 *date:2013/11/14
 */

class Findpass extends CI_Controller {
	function __construct(){
        parent::__construct();	
    }

	//显示忘记密码页面
	public function forgetpassword()
	{
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['find_pwd']);
	}

	/**
	 *description:发送邮箱连接修改密码
	 *author:baohanbin
	 *date:2013/11/14
	 */	
	public function set_email()
	{
		safeFilter();
		$user_email = $this->input->post('user_email');
		$realm = $_SERVER['HTTP_HOST'];
		// $user_email = 'baoyelail@163.com';
		if(!preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',$user_email)){
			echojson(1,'','邮箱格式不正确');
		}else
		{
			$res=$this->find_code($user_email,$realm);
			if($res==false){
			echojson(1,'','发送邮件失败，不存在该邮箱！');
			}else{
			echojson(0,'','发送邮件成功，快去邮箱查看您的新密码吧！');
			}
		}
		
	}
	
	/**
	 *description:邮箱找回密码连接
	 *author:baohanbin
	 *date:2013/11/14
	 */
	public function find_code($user_email,$realm)
	{
		$time = strtotime(date('Y-m-d H:i:s'));
		/*根据用户填写的邮箱进行发送相应的连接*/
		require_once($_SERVER['DOCUMENT_ROOT']."/application/libraries/emial/class.phpmailer.php");
		// 可选,否则会在class.phpmailer.php中包含
		include_once($_SERVER['DOCUMENT_ROOT']."/application/libraries/emial/class.smtp.php");							
		$mail = new PHPMailer(true);							//实例化PHPMailer类,true表示出现错误时抛出异常
		$mail->IsSMTP();										// 使用SMTP
		try{
			$mail->CharSet= "UTF-8";							//设定邮件编码
			$mail->Host       = "smtp.163.com";					// SMTP server
			$mail->SMTPDebug  = 1;								// 启用SMTP调试 1 = errors  2 =  messages
			$mail->SMTPAuth   = true;							// 服务器需要验证
			$mail->Port       = 25;								//默认端口
			$mail->Username   = "lingganwuxian123@163.com";		//SMTP服务器的用户帐号
			$mail->Password   = "linggan123";					//SMTP服务器的用户密码
			$mail->AddReplyTo($user_email, '回复');				//收件人回复时回复到此邮箱,可以多次执行该方法
			$mail->AddAddress($user_email);						//收件人如果多人发送循环执行AddAddress()方法即可 还有一个方法
			$mail->SetFrom('lingganwuxian123@163.com', 'jia178修改密码邮件');			//发件人的邮箱 
			$mail->Subject = '修改密码' . date('Y-m-d H:i:s');
			/*以下是邮件内容*/
			$userinfo = $this->show_new_password($user_email);	
			if(empty($userinfo))
			{
				return false;
			}
			// $url = 'http://bxk.test.com/index.php/view/email/new_pass?'.urlencode("code=$userinfo->feed_content");
			// $url = "http://site_url/index.php/findpass/new_pass?code=$userinfo->feed_content";
			// $url = "http://".$_SERVER['HTTP_HOST']."/index.php/findpass/new_pass?code=$userinfo->feed_content";
			$url = "http://$realm/index.php/findpass/new_pass?code=$userinfo->feed_content";
			$mail->Body = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
							<html xmlns='http://www.w3.org/1999/xhtml'>
							<head>
							<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
							<title>jia178</title>
							</head>

							<body>
							取回密码说明<br />
							<p>这封信是由 jia178 发送的。</p>
							<p>您收到这封邮件，是由于这个邮箱地址在 jia178 被登记为用户邮箱，且该用户请求使用 Email 密码重置功能所致。</p>
							<p>----------------------------------------------------------------------<br />
							    <strong>重要！</strong><br />
							  ----------------------------------------------------------------------</p>
							<p>如果您没有提交密码重置的请求或不是 jia178   的注册用户，请立即忽略并删除这封邮件。只有在您确认需要重置密码的情况下，才需要继续阅读下面的内容。</p>
							<p>----------------------------------------------------------------------<br />
						    <strong>密码重置说明</strong><br />
						  	----------------------------------------------------------------------</p>
							<p>通过点击下面的链接重置您的密码：<br />
						  	<a href='$url' target='_blank'>$url</a> <br />
							(如果上面不是链接形式，请将该地址手工粘贴到浏览器地址栏再访问) </p>
							<p>在上面的链接所打开的页面中输入新的密码后提交，您即可使用新的密码登录网站了。</p>
							</body>
							</html>";
			$mail->IsHTML(true);
			$mail->Send();
			return true;
		} 
		catch (phpmailerException $mail) {
			echo $mail->errorMessage();					 		//从PHPMailer捕获异常
		} catch (Exception $mail) {
			echo $mail->getMessage();
		}
	}

	/**
	 *description:
	 *author:baohanbin
	 *date:2013/11/14
	 */
	public function show_new_password($user_email)
	{
		if($user_email == "") return false;
		$this->load->model('t_user_model');
		$this->t_user_model->user_email = $user_email;
		$res = $this->t_user_model->emailname();
		$feedstime = time();
		if($res){
			$this->load->model('t_user_feeds_model');
			$this->t_user_feeds_model->user_id = $res['user_id'];
			$this->t_user_feeds_model->feed_content = substr(md5(md5(time()).$res['user_id']),8,16);
			$this->t_user_feeds_model->feed_type = 21;
			$feeds = $this->t_user_feeds_model->inser_time();
			if(empty($feeds)){
				$insert_id = $this->t_user_feeds_model->insert();
				if($insert_id){
					$mes = $this->t_user_feeds_model->get($insert_id);
					return $mes;
				}else{
					return false;
				}
			}
			else{
				if($feedstime > (strtotime($feeds['feed_time']) + 7200)){
					$insert_id = $this->t_user_feeds_model->insert();
					if($insert_id){
						$mes = $this->t_user_feeds_model->get($insert_id);
						return $mes;
					}else{
						return false;
					}
				}else{
					$insert_id = $feeds['feed_id'];
					$mes = $this->t_user_feeds_model->get($insert_id);
					return $mes;
				}
			}
		}else{
			return false;
		}
	}
	/**
	 *description:显示用户修改密码页面
	 *author:baohanbin
	 *date:2013/11/14
	 */
	public function new_pass()
	{
		$this->config->load('view');
		// $data['details'] = $this->input->get('code');
		$config = $this->config->item('index');
		$this->load->view($config['new_pwd']);
	}

	/**
	 *description:用户修改密码
	 *author:baohanbin
	 *date:2013/11/14
	 */
	public function pass_word()
	{
		$details = strip_tags($this->input->post('details'));
		$email = strip_tags($this->input->post('email'));
		$pwd1 = strip_tags($this->input->post('pwd1'));
		$pwd2 = strip_tags($this->input->post('pwd2'));
		$feedstime = time();
		if(!preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',$email)){
			echojson(1,'','邮箱格式不正确');
		}
		if(!preg_match('/^[a-zA-Z\d_]{6,16}$/',$pwd1)){
			echojson(1,'','密码格式不正确');
		}
		if(!preg_match('/^[a-zA-Z\d_]{6,16}$/',$pwd2)){
			echojson(1,'','密码格式不正确');
		}
		$this->load->model('t_user_feeds_model');
		$feeds = $this->t_user_feeds_model->select_time($details);	
		if($feedstime > (strtotime($feeds['feed_time']) + 7200)){
			$url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php/findpass/forgetpassword';
			echojson(1,$url,'校验码已过期，请重新找回密码');	
			// exit();	
		}else{
			$this->load->model('t_user_model');
			$res = $this->t_user_model->codeemail($email,$details);
			if(empty($res))
			{
				echojson(1,'','请仔细确认您的邮箱');
			}
			else
			{
				if($pwd1 != $pwd2){
					echojson(1,'','2次密码不一致');
				}
				$this->t_user_model->user_id = $res['user_id'];
				$this->t_user_model->user_passwd = md5($pwd1);
				$mes = $this->t_user_model->updatepwd();
				if($mes == true){
					echojson(0,'','修改密码成功');
				}else{
					echojson(1,'','修改密码失败');
				}
			}
		}
	}
}
