<?php
loadLib("Weixin/wechat.class");
class WechatMenu{
	
	private $token;
	private $appid;
	private $appsecret;
	private $weObj;

	// 以下是定义model属性
	private $t_weixin;//微信公众号基本信息表
	private $CI;

	public function __construct($token){

		safeFilter();
		if(!$token) echojson('1','','非法操作');

		//查看appid和appsercret
		$this->CI = &get_instance();
		$this->CI->load->model('t_weixin_model');
		$this->t_weixin = $this->CI->t_weixin_model;
		$where['service_token'] = $token;
		$where['wx_status'] = 1;
		$time = date('Y-m-d H:i:s');
		$weixinR = $this->t_weixin->getWeixiInfo($where,$time);

		$this->token = $token;
		if($weixinR){
			$this->appid = $weixinR->wx_appid;
			$this->appsecret = $weixinR->wx_appsecret;
		}else{
			echojson(1,'','该公众号状态不正常，请联系工作人员');
		}
		$options = array(
				'token'=>$this->token, //填写你设定的key
				'appid'=>$this->appid,
				'appsecret'=>$this->appsecret
			);

		$this->weObj = new Wechat($options);
	}

	public function index(){

	}

	/**
	 * 用户创菜单
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	*/
	public function createMenu(){

		loadLib('diyMenu');
        $diyMenu = new DiyMenu();
        $diyMenu->service_token = $this->token;
		$menuList = $diyMenu->getMenuList();
		$parentA = isset($menuList['menu_list'])?$menuList['menu_list']:'';
	
		if($parentA){
			foreach ($parentA as $key => $value) {

				$sonArrC = isset($value['smd_son_list'])?$value['smd_son_list']:'';//孩子节点
				
				if($sonArrC){
					$meCvc = array();
					foreach ($sonArrC as $keys => $values) {
						//$smd_type = isset($values['smd_type'])?$values['smd_type']:'';//动作类型
						//$smd_content = isset($values['smd_content'])?$values['smd_content']:'';//动作内容
						//if(!$smd_type || !$smd_content) echojson(1,'','存在还未设置响应动作的菜单或数据删除或不正常，请检查');

						$clickc['type'] = 'click';
						$clickc['key'] = $values['smd_id'];
						$clickc['name'] = $values['smd_name'];
						$meCvc[] = $clickc;
					}

					$childR['name'] = $value['smd_pname'];
					$childR['sub_button'] = $meCvc;
					$meCv[] = $childR;
				}else{
			
					$smd_ptype = isset($value['smd_ptype'])?$value['smd_ptype']:'';//动作类型
					$smd_pcontent = isset($value['smd_content'])?$value['smd_content']:'';//动作内容
					if(!$smd_ptype || !$smd_pcontent) echojson(1,'','存在还未设置响应动作的菜单或数据删除或不正常，请检查');
					$click['type'] = 'click';
					$click['key'] = $value['smd_pid'];
					$click['name'] = $value['smd_pname'];
					$meCv[] = $click;
					
				}
			}
			$newmenu['button'] = $meCv;
			$result = $this->weObj->createMenu($newmenu); 
			if(!$result){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	}

	/**
	 * 删除菜单
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	*/
	public function deleteMenu(){
    	$result = $this->weObj->deleteMenu();
    	if(!$result){
   			echojson(1,'','菜单删除失败！');
    	}else{
			echojson(0,'','菜单删除成功！');
    	}
	}

}