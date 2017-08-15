<?php
class Weixin extends CI_Controller{
	
	private $token;
	private $data;
	private $appid;
	private $appsecret;
	private $debug;
	private $type;
	private $event;
	private $weObj;
	private $content;
	private $touser;
	private $tousername;

	// 以下是定义model属性
	private $follow_reply; //关注自动回复
	private $weixin_reply;//文本图文回复
	private $t_weixin;//微信公众号基本信息表
	private $service_id;
	private $menu_config;
	private $menu_diy;
	private $service_infomation;
	private $sysToken; //系统token
	private $sysAuthCode;//系统验证绑定标识;
	const SYS_TOKEN = '3364b17e6eb66255e895b5714eee36ef';// 系统公众号（灵感无限），单独的公众号做标识
	const LGWX_REG_URL = "/lgwx/index.php/reg/index";

	public function __construct(){
		parent::__construct();

		safeFilter();
		if(!isset($_GET['token'])) die("no access");
		$token = $_GET['token'];

		//查看appid和appsercret
		$this->load->model('t_weixin_model');
		$this->t_weixin = $this->t_weixin_model;
		$this->load->model('t_service_menu_config_model');
		$this->menu_config = $this->t_service_menu_config_model;
		$this->load->model('t_service_menu_diy_model');
		$this->menu_diy = $this->t_service_menu_diy_model;
		$this->load->model("t_service_information_model");
        $this->service_infomation = $this->t_service_information_model;
		$where['service_token'] = $token;
		//$where['wx_status'] = 0;
		$time = date('Y-m-d H:i:s');
		$weixinR = $this->t_weixin->getWeixiInfo($where,$time);

		$this->token = $token;
		$this->service_id = $weixinR->service_id;
		if($weixinR){
			$this->service_id = $weixinR->service_id;
			$this->appid = $weixinR->wx_appid;
			$this->appsecret = $weixinR->wx_appsecret;
		}else{
			$this->service_id = '';
			$this->appid = '';
			$this->appsecret = '';
		}
		$options = array(
				'token'=>$this->token, //填写你设定的key
				'appid'=>$this->appid,
				'appsecret'=>$this->appsecret
			);
		

		$this->load->model('t_service_weixin_follow_reply_model');
		$this->follow_reply = $this->t_service_weixin_follow_reply_model;
		$this->load->model('t_service_weixin_reply_model');
		$this->weixin_reply = $this->t_service_weixin_reply_model;
		$this->load->helper('url');
		$this->debug = true;
		loadLib("WechatMap");

		if($this->debug){
			loadLib("Weixin/wechat.class");
			$this->weObj = new Wechat($options);
			$this->weObj->valid();
			$this->sysToken = "jia178";
			$this->sysAuthCode = "test";
			$this->data = $this->weObj->getRev();//推送数据
			$this->type = $this->weObj->getRevType();
			$this->event = $this->weObj->getRevEvent();
			$this->content = $this->weObj->getRevContent();
			$this->touser = $this->weObj->getRevFrom();
			$this->tousername = $this->weObj->getRevTo();
			//$this->createMenu();
			$this->reply();
		}
		
	}

	public function index(){

	}

	/**
	 * 获取推送事件来回答处理
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function reply(){

		switch($this->type) {
			case Wechat::MSGTYPE_TEXT:
				$this->responseText();
				exit;
				break;
			case Wechat::MSGTYPE_EVENT:
				$this->resonseEvent();
				break;
			case Wechat::MSGTYPE_IMAGE:
				break;
			case Wechat::MSGTYPE_NEWS:
				break;
			case Wechat::MSGTYPE_VOICE:
				break;
			case Wechat::MSGTYPE_VIDEO:
				break;
			case Wechat::MSGTYPE_LOCATION:
				$this->resonseLocation();
				break;
			case Wechat::MSGTYPE_LINK:
				break;
			default:
				$this->responseAutoReply();
		}
	}

	/**
	 * 微信推送过来时文本处理
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function responseText(){
		$content = $this->content;
		if($content){
			if(strtolower($content) == $this->sysAuthCode){
				$this->getTextAuthCode();
			}else{

				if(($this->token == self::SYS_TOKEN) && preg_match("/^sqtg\+?([\s\S]*?)$/", trim(strtolower($content)), $matches)){
					$this->lgwxSpreader($matches['1']);
				}else{
					//先发系统消息	
					$this->getSysReply();
					//这个是回复一条数据 普通接口前期用的
					$this->getTextImgR();
					//TODO 以后在改这个是高级接口才能用
					//$this->getTextImageC();
				}
				
			}
			
		}
	}

	/**
	 * 家一起吧微信手机推广处理
	 * @author liuguangping
	 * @version 1.0 2014/6/12
	 */
	public function lgwxSpread($phone){

		if(!preg_match('/^((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)$/',$phone))
			$this->weObj->text("手机号格式不正确，重新输入sqtg+手机号码")->reply();

			//为单独灵感无限公众号特权
			$userInfo = $this->weObj->getUserInfo($this->touser);
			if($userInfo){
				loadLib('LgwxSpreader');
				$this->lgwxSpreader = new LgwxSpreader();
				$this->lgwxSpreader->nickname = $userInfo['nickname'];
				$this->lgwxSpreader->openid  = $userInfo['openid'];
				$this->lgwxSpreader->token = $this->token;
				$this->lgwxSpreader->service_id = $this->service_id;
				$this->lgwxSpreader->ss_phone = $phone;
				$this->lgwxSpreader->ss_type = 1;
				$md5Code = md5($userInfo['openid']);
				if($result = $this->lgwxSpreader->insertSpreader()){
					$title = "通过点击分享以及复制链接或二维码的方式可赚取积分和增长点";
					if($result['status'] == 0){

						$spreader_code = md5($userInfo['openid']);
						$urls = U('weixin/showSpreader/showSpread',array('spreader_code'=>$spreader_code));
						$mes = "您已经成功加入JIA178平台推广联盟，点击<a href='".$urls."'>马上分享</a>，赢取手机充值卡！";

						$this->weObj->text($mes)->reply();

					}elseif($result['status'] == 1){

						$spreader_code = md5($userInfo['openid']);
						$urls = U('weixin/showSpreader/showSpread',array('spreader_code'=>$spreader_code));
						$mes = "您已经成功加入JIA178平台推广联盟，点击<a href='".$urls."'>马上分享</a>，赢取手机充值卡！";
						$this->weObj->text($mes)->reply();

					}else{
						$this->weObj->text($result['mes'])->reply();
					}
				}else{
					$this->weObj->text("申请失败，重新输入sqtg+手机号码")->reply();
				}

			}else{
				$this->responseAutoReply();
			}
	}

	//是否发送了推广信息
	public function isSpreaderSend(){

		$title = "通过点击分享以及复制链接或二维码的方式可赚取积分和增长点";
		$spreader_code = md5($this->touser);
		$whereP['spreader_code'] = $spreader_code;
		$whereP['ss_status'] = 1;
		$spreaderR = model('t_service_spreader')->getOne('*',$whereP);
		if($spreaderR){


			$urls = U('weixin/showSpreader/showSpread',array('spreader_code'=>$spreader_code));
			$mes = "您已经成功加入JIA178平台推广联盟，点击<a href='".$urls."'>马上分享</a>，赢取手机充值卡！";
			return $mes;

		}else{
			return false;
		}
	}

	//发送一条图文
	public function getSendNews($title,$picUrl,$url,$desc=false){
		$imagArr['Title'] = $title;
		if($desc) $imagArr['Description'] = $desc; else $imagArr['Description'] = "分享地址:".$url."\n二维码:".$picUrl;
		$imagArr['PicUrl'] = $picUrl;
		$imagArr['Url'] = $url;
		return $imagArr;
	}

	//发送验证码
	public function getTextAuthCode(){
		$wx_rand = rand(1000,9999);
		$where['service_token'] = $this->token;
		$data['wx_rand'] = $wx_rand;
		if($this->t_weixin->updates_global($data,$where)){
			$this->weObj->text("公众验证码：".$wx_rand)->reply();
		}else{
			$this->weObj->text("验证码发送失败，重新发送！")->reply();
		}
	}

	//系统关键词回复
	public function getSysReply(){
		$content = $this->content;
		$token = $this->sysToken;
		$where['reply_keyword'] = strtolower($content);
		$where['reply_status'] = 1;
		$where['service_token'] = $token;
		$rowR = $this->weixin_reply->getOne('*',$where);
		if($rowR){
			if($rowR->reply_type == 1){
					$this->weObj->text($rowR->reply_content)->reply();
			}else{
				$imagArr['Title'] = $rowR->reply_title;
				$imagArr['Description'] = $rowR->reply_desc;
				if(stripos($rowR->reply_top_pic,'http://') == FALSE)
					$picUrl = "http://".$rowR->reply_top_pic;
				else
					$picUrl = $rowR->reply_top_pic;
				$imagArr['PicUrl'] = $picUrl;
				if($rowR->reply_outurl == ''){
					$urls = site_url('weixin/showMap/showImgReply')."?reply_id=".$rowR->reply_id.'&appid='.$touserId."&username=".$this->tousername;
				}else{
					$urls = $rowR->reply_outurl;
				}
				$imagArr['Url'] = $urls;
				$array[] = $imagArr;
				if($array){
					$this->weObj->news($array)->reply();
				}
			}
		}
	}

	/**
	 * 微信推送过来时文本处理
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function resonseLocation(){
		$content = $this->weObj->getRevGeo();
		if($content){
			//$this->weObj->text("你现在的位置：纬度：".$content['x']."经度：".$content['y'])->reply();
			$mapObj = new WechatMap();
			//todo分支机构 业务逻辑变化现己撤消
			//$resultR = $mapObj->getCompanyDistance($content['x'],$content['y']);
			$resultR = $mapObj->getShopDistance($content['x'],$content['y']);
			if(is_array($resultR)){
				if($resultR[1] == 'news'){
					$this->weObj->news($resultR[0])->reply();
				}else{
					$this->weObj->text($resultR[0])->reply();
				}
			}
		}else{
			$this->weObj->text("获取位置失败")->reply();
		}
	}

	/**
	 * 图文文本获取库里内容(普通接口不支持模糊查找完全匹配)
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function getTextImgR(){
		
		$touserId = $this->touser;
		$replyContent = $this->content;
		$token = $this->token;
		$where['reply_keyword'] = trim($replyContent);
		$where['reply_status'] = 1;
		$where['service_token'] = $token;
		$result = $this->weixin_reply->getOne('*',$where);
		if($result){
			$rowR = $result;
			if($rowR->reply_type == 1){
				$this->weObj->text($rowR->reply_content)->reply();
			}elseif($rowR->reply_type == 2){
				$reply_content = explode(',', str_replace('，', ',', $rowR->reply_content));
				if($reply_content){
					$array = array();
					foreach ($reply_content as $ke => $va) {
						$whereInO['si_id'] = $va;
					    $whereInO['si_status'] = 1;
					    $infoOneR = $this->service_infomation->getOne('*',$whereInO);
					     //var_dump($infoOneR);die;
					    if($infoOneR){
							if(stripos($infoOneR->si_pic, 'http://') === FALSE) $infoOneR->si_pic = "http://".$infoOneR->si_pic;
							$urls = site_url('weixin/showMap/showInformation')."?si_id=".$infoOneR->si_id.'&appid='.$this->touser."&username=".$this->tousername;
							$array[] = $this->getSendNews($infoOneR->si_title,$infoOneR->si_pic,$urls,$infoOneR->si_desc);
					    }
					}
					if($array){
						$this->weObj->news($array)->reply();
					}else{
						$this->responseAutoReply();
					}
				}else{
					$this->responseAutoReply();
				}	
			}else{
				$this->responseAutoReply();
			}
		}else{
			$this->responseAutoReply();
		}

	}

	/**
	 * 图文文本获取库里内容（高级接口包含匹配）
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function getTextImageC(){
		$touserId = $this->touser;
		$replyContent = $this->content;
		$token = $this->token;

		//把所有内容查出
		$result = $this->weixin_reply->getLikeKeyword(1,$token,$replyContent);
		$imagTx = $this->textControllers($result,$replyContent);
		if($imagTx){
			foreach($imagTx as $key=>$value){
				if($value->reply_type == 1){
					$content['content'] = $value->reply_desc;
				  	$sendData['touser'] = $touserId;
				  	$sendData['msgtype'] = 'text';
				  	$sendData['text'] = $content;
				  	$this->sendMessage($sendData);
				  }else{
				  	$textImageR[] = $value;
				  }
			}
		}
	   
	   	if($textImageR){
	   		$count =  count($textImageR);
	   		if($count<=5){
	   			foreach ($textImageR as $ky=>$vl){
	   				$imagArr['Title'] = $vl->reply_title;
					$imagArr['Description'] = $vl->reply_desc;
					if(strpos($vl->reply_top_pic, 'http://') === false)
					$picurl = "http://".$vl->reply_top_pic;
					else
					$picurl = $vl->reply_top_pic;
					$imagArr['PicUrl'] = $picurl;
					$imagArr['Url'] = $vl->reply_outurl;
	  				$array[] = $imagArr;
	   			}
	   			if($array){
	   				$this->weObj->news($array)->reply();
	   			}else{
	   				$this->responseAutoReply();
	   			}
	   		}else{

				$imageData['touser'] = $touserId;
				$imageData['msgtype'] = 'news';

				foreach ($textImageR as $imaK => $imaValue) {
					$articles = array('title' => $imaValue->reply_title,'description'=>$imaValue->reply_desc,'picurl'=>$imaValue->reply_top_pic,'url'=>$imaValue->reply_outurl);
					$contentIma['articles'][] = $articles;
					if($imaK%5==0){
						$imageData['news'] = $contentIma;
						unset($contentIma);
						$this->sendMessage($imageData);
					}
				}
				//剩下的图片
				if($contentIma['articles']){
					$imageData['news'] = $contentIma;
					unset($contentIma);
					$this->sendMessage($imageData);
				}
	   		}
	   		
	   	}
	}

	//文字回复逻辑
	public function textControllers($result,$replyContent){
	   	if($result){
	   		if($replyContent){
	   			foreach ($result as $key => $value) {
	   				if($value->reply_match_type == 1){
	   					if($value->reply_keyword == $replyContent){
	   						$resultTxIm[] = $value;
	   					}
	   				}else{
	   					$resultTxIm[] = $value;
	   				}
	   			}
	   			return $resultTxIm;
	   		}else{
	   			return false;
	   		}
	   		
	   	}else{
	   		return false;
	   	}
	}

	/**
	 * 客户发送信息
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function sendMessage($sendData){
		$this->weObj->sendCustomMessage($sendData);
	}

	/**
	 * 微信推送过来时事件处理
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function resonseEvent(){
		$event = $this->event;
		switch ($event['event']) {
			case 'subscribe':
				$this->responseSubscribe();
				break;
			case 'CLICK':
				$this->responseClickMenu();
				break;
			default:
				$this->responseAutoReply();
				break;
		}
	}

	/**
	 * 微信推送过来时图片处理
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function responseImage(){
		$this->weObj->text("hello, I'm wechat")->reply();
	}

	/**
	 * 用户关注公众号处理返回信息
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function responseSubscribe(){
		$map['service_token'] = $this->token;
		$map['rwfr_type'] = 1;
		$result = $this->follow_reply->getOne('rwfr_content',$map);
		if($result){
			$string = $result->rwfr_content;
			$this->weObj->text($string)->reply();
		}/*else{
			$string = "欢迎加入Jia178移动营销！";
			$this->weObj->text($string)->reply();
		}*/else{
			$this->weObj->text()->reply();
		}
	}

	/**
	 * 消息自动回复
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function responseAutoReply(){
		$map['service_token'] = $this->token;
		$map['rwfr_type'] = 2;
		$result = $this->follow_reply->getOne('rwfr_content',$map);
		if($result){
			$string = $result->rwfr_content;
			$this->weObj->text($string)->reply();
		}else{
			$this->weObj->text()->reply();
		}
	}

	/**
	 * 用户关注公众号处理取消关注
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function responseUnSubscribe(){
		$this->deleteMenu();
	}

	/**
	 * 用户点击菜单
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function responseClickMenu(){
		$event = $this->event;
		$key = $event['key'];
		$vl = $this->menu_diy->get($key);
		if($vl && $vl->smd_type && $vl->smd_content){
			switch ($vl->smd_type) {
				case '1':
					$this->responseClickActionMeg();
					break;

				case '2':
					$this->responseClickActionInfo();
					break;
				case '3':
					$this->responseClickActionMenuUrl();
					break;
				
				default:
					$this->responseAutoReply();
					break;
			}
		}else{
			$this->responseAutoReply();
		}
	}

	/**
	 * 用户点击菜单 key == 1时的操作（发送信息）
	 * @author liuguangping
	 * @version 1.0 2015/4/17
	 */
	public function responseClickActionMeg(){
		$event = $this->event;
		$key = $event['key'];
		$vl = $this->menu_diy->get($key);
		if($vl){
			if(($this->token == self::SYS_TOKEN) && ($key == 271)){
				$this->responseSpreaderContent();
			}
			if(($this->token == self::SYS_TOKEN) && ($key == 270)){
				/*if($array = $this->isSpreaderSend()){
					$this->weObj->news($array)->reply();
				}*/
				if($array = $this->isSpreaderSend()){
					$this->weObj->text($array)->reply();
				}
			}
			$this->weObj->text($vl->smd_content)->reply();
		}else{
			$this->responseAutoReply();
		}
	}

	/**
	 * 灵感无限返利记录
	 * @author liuguangping
	 * @version 1.0 2014/6/11
	 */
	public function responseSpreaderContent(){
		$userInfo = $this->weObj->getUserInfo($this->touser);
		if($userInfo){
			loadLib('LgwxSpreader');
			$this->lgwxSpreader = new LgwxSpreader();
			$this->lgwxSpreader->openid = $userInfo['openid'];
			$result = $this->lgwxSpreader->getSprReRe();
			if($result['status'] == 0){
				$this->weObj->news($result['data'])->reply();
			}else{
				$this->weObj->text($result['mes'])->reply();
			}
		}else{
			$this->weObj->text("获取数据失败！")->reply();
		}
	}

	/**
	 * 用户点击菜单 key == 2时的操作（发布资讯）
	 * @author liuguangping
	 * @version 1.0 2015/4/17
	 */
	public function responseClickActionInfo(){
		$event = $this->event;
		$key = $event['key'];
		$vl = $this->menu_diy->get($key);
		if($vl){
			$infoId = $vl->smd_content;
			if($infoId){

				$where = "si_id IN ($infoId) AND si_status = '1'";
				$InfoR = $this->service_infomation->getArray('si_id,si_title,si_pic,si_keyword,si_desc',$where);
				if($InfoR){
					$imagArr = array();
					$array = array();
					foreach ($InfoR as $key => $value) {
						$imagArr['Title'] = $value->si_title;
						$imagArr['Description'] = $value->si_desc;
						if(stripos($value->si_pic,'http://') === false)
							$picUrl = "http://".$value->si_pic;
						else
							$picUrl = $value->si_pic;
						$imagArr['PicUrl'] = $picUrl;
						$urls = site_url('weixin/showMap/showInformation')."?si_id=".$value->si_id.'&appid='.$this->touser."&username=".$this->tousername;

						$imagArr['Url'] = $urls;
		  				$array[] = $imagArr;
					}
					if($array){
  						$this->weObj->news($array)->reply();
  					}else{
  						$this->responseAutoReply();
  					}

				}else{
					$this->responseAutoReply();
				}
				
			}else{
				$this->responseAutoReply();
			}
			
		}else{
			$this->responseAutoReply();
		}
	}

	/**
	 * 用户点击菜单 key == 3时的操作（跳转到的网页）
	 * @author liuguangping
	 * @version 1.0 2015/4/17
	 */
	public function responseClickActionMenuUrl(){
		$event = $this->event;
		$key = $event['key'];
		$vls = $this->menu_diy->get($key);

		if($vls){
			if(!$menuCid = $vls->smd_content) $this->responseAutoReply();
			$vl = $this->menu_config->get($menuCid);
			if($vl){
				$imagArr['Title'] = $vl->c_name;
				$imagArr['Description'] = $vl->c_desc;
				$this->config->load('uploads');
				$config = $this->config->item('service_WeixinMenu');

				$picurl = $_SERVER['HTTP_HOST'].$config['relative_path']."thumb_1/".$vl->c_pic;
				$defaultPic = $config['upload_path'].$vl->c_pic;
				if(!file_exists($defaultPic)) $picurl = $_SERVER['HTTP_HOST'].$config['default_1'];
				if(stripos($picurl,'http://') === FALSE) $picurl = "http://".$picurl;

				$imagArr['PicUrl'] = $picurl;

				$urls = $_SERVER['HTTP_HOST'].$vl->c_url."&service_id=".$this->service_id;
				if(stripos($urls,'http://') === FALSE)
					$urls = 'http://'.$urls;
				$imagArr['Url'] = $urls;
				$array[] = $imagArr;
				if($array){
					$this->weObj->news($array)->reply();
				}else{
					$this->responseAutoReply();
				}
			}else{
				$this->responseAutoReply();
			}	
		}else{
			$this->responseAutoReply();
		}
		
	}

	/**
	 * 用户创菜单
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	*/
	public function createMenu(){
		$this->load->model('t_service_menu_diy_model');
		$filed = '*';
		$where['smd_pid'] = 0;
		$where['smd_is_show'] = 1;
		$where['smd_status'] = 1;
		$where['service_token'] = $this->token;
		$menuR = $this->t_service_menu_diy_model->getMenuInfo($filed,$where);
		foreach ($menuR as $keys => $values) {
			$where['smd_pid'] = $values->smd_id;
			$order_field='smd_sort';
			$order_type='ASC';
			$limit=5;
			$menuChildR = $this->t_service_menu_diy_model->getMenuInfo($filed,$where,$order_field,$order_type,$limit);

			if($menuChildR){
				foreach ($menuChildR as $key => $value) {

					if($value->smd_outurl){
						$viewc['type'] = 'view';
						$viewc['url'] = $value->smd_outurl;
						$viewc['name'] = $value->smd_name;
						$meCvc[] = $viewc;
					}else{
						$clickc['type'] = 'click';
						$clickc['key'] = $value->smd_keyword;
						$clickc['name'] = $value->smd_name;
						$meCvc[] = $clickc;

					}
				}
				$childR['name'] = $values->smd_name;
				$childR['sub_button'] = $meCvc;
				$meCv[] = $childR;
			}else{
				if($values->smd_outurl){
					$view['type'] = 'view';
					$view['url'] = $values->smd_outurl;
					$view['name'] = $values->smd_name;
					$meCv[] = $view;
				}else{
					$click['type'] = 'click';
					$click['key'] = $values->smd_keyword;
					$click['name'] = $values->smd_name;
					$meCv[] = $click;
				}
			}
		}
		$newmenu['button'] = $meCv;
       
   		$result = $this->weObj->createMenu($newmenu); 
	    if(!$result){
	    	$this->weObj->text("菜单创建失败！")->reply();
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
       		$this->weObj->text("菜单删除失败！")->reply();
       }else{
       		$this->weObj->text()->reply();
       }
	}

}
