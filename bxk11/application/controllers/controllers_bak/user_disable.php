<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:添加黑名单
 *author:chenyuda
 *date:2013/08/01
 */
class User_disable extends Temp_Controller {
	function __construct(){
        parent::__construct();	
    }
	//添加黑名单
	function blacklist()
	{
				
		safeFilter();
		$user_id = $_SESSION['user_id'];
		$user_nickname = $this->input->post('user_nickname');
		$res=model("Bxk_user_disable_model")->add_black($user_id,$user_nickname);
		if($res=='0'){
			echojson(0,'添加失败');
		}elseif($res=='1'){
			echojson(0,'用户名不能为空');
		}elseif($res=='2'){
			echojson(0,'不存在的用户名');
		}elseif($res=='3'){
			echojson(0,'不能将自己拉入黑名单');
		}elseif($res=='4'){
			echojson(0,'该用户已经在您的黑名单中了');
		}else{
			echojson(1,$res);
		}
	}
}
