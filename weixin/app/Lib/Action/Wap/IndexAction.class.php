<?php
function strExists($haystack, $needle)
{
	return !(strpos($haystack, $needle) === FALSE);
} class IndexAction extends BaseAction{
	private $tpl;	//微信公共帐号信息
	private $info;	//分类信息
	private $wecha_id;
	private $copyright;
	public $company;
	public $token;
	public $weixinUser;
	public $homeInfo;
	
	private $t_user_info;

	public function _initialize(){
		parent::check_wecha();
		$this->t_user_info= D('T_user_info');
		parent::_initialize();
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"icroMessenger")&&!isset($_GET['show'])) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		//
		$Model = new Model();
		$this->token=$this->_get('token','trim');
		$where['token']=$this->token;

		$tpl=D('Wxuser')->where($where)->find();
		$this->weixinUser=$tpl;

		if (isset($_GET['wecha_id'])&&$_GET['wecha_id']){
			$_SESSION['wecha_id']=$_GET['wecha_id'];
			$this->wecha_id=$this->_get('wecha_id');
		}
		if (isset($_SESSION['wecha_id'])){
			$this->wecha_id=$_SESSION['wecha_id'];
		}
		//dump($where);
		$info=M('Classify')->where(array('token'=>$this->_get('token'),'status'=>1))->order('sorts desc')->select();
		$info=$this->convertLinks($info);//加外链等信息
		$gid=D('Users')->field('gid')->find($tpl['uid']);
		$this->userGroup=M('User_group')->where(array('id'=>$gid['gid']))->find();
		$this->copyright=$this->userGroup['iscopyright'];

		$this->info=$info;
		$tpl['color_id']=intval($tpl['color_id']);
		$this->tpl=$tpl;
		$company_db=M('company');
		$this->company=$company_db->where(array('token'=>$this->token,'isbranch'=>0))->find();
		$this->assign('company',$this->company);
		//
		$homeInfo=M('home')->where(array('token'=>$this->token))->find();
		$this->homeInfo=$homeInfo;
		$this->assign('iscopyright',$this->copyright);//是否允许自定义版权
		$this->assign('siteCopyright',C('copyright'));//站点版权信息
		$this->assign('homeInfo',$homeInfo);
		$this->assign('homeurl',$this->homeurl);
		//
		$this->assign('token',$this->token);
		//
		$this->assign('copyright',$this->copyright);
		//plugmenus
		$plugMenus=$this->_getPlugMenu();
		$this->assign('plugmenus',$plugMenus);
		$this->assign('showPlugMenu',count($plugMenus));
	}
	public function classify(){
		$this->assign('info',$this->info);

		$this->display($this->tpl['tpltypename']);
	}

	public function index(){
		//是否是高级模板
		if ($this->homeInfo['advancetpl']){
			echo '<script>window.location.href="/cms/index.php?token='.$this->token.'&wecha_id='.$this->wecha_id.'";</script>';
			exit();
		}
		//
		$where['token']=$this->_get('token');
		//dump($where);
		//	$where['status']=1;
		$flash=M('Flash')->where($where)->select();
		$flash=$this->convertLinks($flash);
		$count=count($flash);
		$this->assign('flash',$flash);
		$this->assign('info',$this->info);
		$this->assign('num',$count);
		$this->assign('info',$this->info);
		$this->assign('tpl',$this->tpl);
		$this->assign('homeurl',$this->homeInfo['homeurl']);

		$this->display($this->tpl['tpltypename']);
	}

	public function lists(){
		$where['token']=$this->_get('token','trim');
		$db=D('Img');	
		if($_GET['p']==false){
			$page=1;
		}else{
			$page=$_GET['p'];			
		}		
		$where['classid']=$this->_get('classid','intval');
		$count=$db->where($where)->count();	
		$pageSize=8;	
		$pagecount=ceil($count/$pageSize);
		if($page > $count){$page=$pagecount;}
		if($page >=1){$p=($page-1)*$pageSize;}
		if($p==false){$p=0;}
		$res=$db->where($where)->order('createtime DESC')->limit("{$p},".$pageSize)->select();
		$res=$this->convertLinks($res);
		$this->assign('page',$pagecount);
		$this->assign('p',$page);
		$this->assign('info',$this->info);
		$this->assign('tpl',$this->tpl);
		$this->assign('res',$res);
		$this->assign('copyright',$this->copyright);
		if ($count==1){
			$this->content($res[0]['id']);
			exit();
		}
		$this->display($this->tpl['tpllistname']);
	}

	public function content($contentid=0){
		$db=M('Img');
		$where['token']=$this->_get('token','trim');
		if (!$contentid){
			$contentid=intval($_GET['id']);
		}
		$where['id']=array('neq',$contentid);
		$lists=$db->where($where)->limit(5)->order('uptatetime')->select();
		$where['id']=$contentid;
		$res=$db->where($where)->find();
		$this->assign('info',$this->info);	//分类信息
		$this->assign('lists',$lists);		//列表信息
		$this->assign('res',$res);			//内容详情;
		$this->assign('tpl',$this->tpl);				//微信帐号信息
		$this->assign('copyright',$this->copyright);	//版权是否显示
		$this->display($this->tpl['tplcontentname']);
	}

	public function flash(){
		$where['token']=$this->_get('token','trim');
		$flash=M('Flash')->where($where)->select();
		$count=count($flash);
		$this->assign('flash',$flash);
		$this->assign('info',$this->info);
		$this->assign('num',$count);
		$this->display('ty_index');
	}
	/**
	 * 获取链接
	 *
	 * @param unknown_type $url
	 * @return unknown
	 */
	public function getLink($url){
		$urlArr=explode(' ',$url);
		$urlInfoCount=count($urlArr);
		if ($urlInfoCount>1){
			$itemid=intval($urlArr[1]);
		}
		//会员卡 刮刮卡 团购 商城 大转盘 优惠券 订餐 商家订单 表单
		if (strExists($url,'刮刮卡')){
			$link='/index.php?g=Wap&m=Guajiang&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link.='&id='.$itemid;
			}
		}elseif (strExists($url,'大转盘')){
			$link='/index.php?g=Wap&m=Lottery&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link.='&id='.$itemid;
			}
		}elseif (strExists($url,'优惠券')){
			$link='/index.php?g=Wap&m=Coupon&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link.='&id='.$itemid;
			}
		}elseif (strExists($url,'刮刮卡')){
			$link='/index.php?g=Wap&m=Guajiang&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link.='&id='.$itemid;
			}
		}elseif (strExists($url,'商家订单')){
			if ($itemid){
				$link=$link='/index.php?g=Wap&m=Host&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id.'&hid='.$itemid;
			}else {
				$link='/index.php?g=Wap&m=Host&a=Detail&token='.$this->token.'&wecha_id='.$this->wecha_id;
			}
		}elseif (strExists($url,'万能表单')){
			if ($itemid){
				$link=$link='/index.php?g=Wap&m=Selfform&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id.'&id='.$itemid;
			}
		}elseif (strExists($url,'相册')){
			$link='/index.php?g=Wap&m=Photo&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link='/index.php?g=Wap&m=Photo&a=plist&token='.$this->token.'&wecha_id='.$this->wecha_id.'&id='.$itemid;
			}
		}elseif (strExists($url,'全景')){
			$link='/index.php?g=Wap&m=Panorama&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
			if ($itemid){
				$link='/index.php?g=Wap&m=Panorama&a=item&token='.$this->token.'&wecha_id='.$this->wecha_id.'&id='.$itemid;
			}
		}elseif (strExists($url,'会员卡')){
			$link='/index.php?g=Wap&m=Card&a=vip&token='.$this->token.'&wecha_id='.$this->wecha_id;
		}elseif (strExists($url,'商城')){
			$link='/index.php?g=Wap&m=Product&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
		}elseif (strExists($url,'订餐')){
			$link='/index.php?g=Wap&m=Product&a=dining&dining=1&token='.$this->token.'&wecha_id='.$this->wecha_id;
		}elseif (strExists($url,'团购')){
			$link='/index.php?g=Wap&m=Groupon&a=grouponIndex&token='.$this->token.'&wecha_id='.$this->wecha_id;
		}elseif (strExists($url,'首页')){
			$link='/index.php?g=Wap&m=Index&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
		}else {
			if (strpos($url,'?')){
				$link=str_replace('{wechat_id}',$this->wecha_id,$url).'&wecha_id='.$this->wecha_id;
			}else {
				$link=str_replace('{wechat_id}',$this->wecha_id,$url).'?wecha_id='.$this->wecha_id;
			}

		}
		return $link;
	}
	public function convertLinks($arr){
		$i=0;
		foreach ($arr as $a){
			if ($a['url']){
				$arr[$i]['url']=$this->getLink($a['url']);
			}
			$i++;
		}
		return $arr;
	}
	public function _getPlugMenu(){
		$company_db=M('company');
		$this->company=$company_db->where(array('token'=>$this->token,'isbranch'=>0))->find();
		$plugmenu_db=M('site_plugmenu');
		$plugmenus=$plugmenu_db->where(array('token'=>$this->token,'display'=>1))->order('taxis ASC')->limit('0,4')->select();
		if ($plugmenus){
			$i=0;
			foreach ($plugmenus as $pm){
				switch ($pm['name']){
				case 'tel':
					if (!$pm['url']){
						$pm['url']='tel:/'.$this->company['tel'];
					}else {
						$pm['url']='tel:/'.$pm['url'];
					}
					break;
				case 'memberinfo':
					if (!$pm['url']){
						$pm['url']='/index.php?g=Wap&m=Userinfo&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
					}
					break;
				case 'nav':
					if (!$pm['url']){
						$pm['url']='/index.php?g=Wap&m=Company&a=map&token='.$this->token.'&wecha_id='.$this->wecha_id;
					}
					break;
				case 'message':
					break;
				case 'share':
					break;
				case 'home':
					if (!$pm['url']){
						$pm['url']='/index.php?g=Wap&m=Index&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
					}
					break;
				case 'album':
					if (!$pm['url']){
						$pm['url']='/index.php?g=Wap&m=Photo&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
					}
					break;
				case 'email':
					$pm['url']='email:'.$pm['url'];
					break;
				case 'shopping':
					if (!$pm['url']){
						$pm['url']='/index.php?g=Wap&m=Product&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
					}
					break;
				case 'membercard':
					$card=M('member_card_create')->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
					if (!$pm['url']){
						if($card==false){
							$pm['url']=rtrim(C('site_url'),'/').U('Wap/Card/get_card',array('token'=>$this->token,'wecha_id'=>$this->wecha_id));
						}else{
							$pm['url']=rtrim(C('site_url'),'/').U('Wap/Card/vip',array('token'=>$this->token,'wecha_id'=>$this->wecha_id));
						}
					}
					break;
				case 'activity':
					$pm['url']=$this->getLink($pm['url']);
					break;
				case 'weibo':
					break;
				case 'tencentweibo':
					break;
				case 'qqzone':
					break;
				case 'wechat':
					$pm['url']='weixin://addfriend/'.$this->weixinUser['wxid'];
					break;
				case 'music':
					break;
				case 'video':
					break;
				case 'recommend':
					$pm['url']=$this->getLink($pm['url']);
					break;
				case 'other':
					$pm['url']=$this->getLink($pm['url']);
					break;
				}
				$plugmenus[$i]=$pm;
				$i++;
			}

		}else {//默认的
			$plugmenus=array();
			/*
			$plugmenus=array(
			array('name'=>'home','url'=>'/index.php?g=Wap&m=Index&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id),
			array('name'=>'nav','url'=>'/index.php?g=Wap&m=Company&a=map&token='.$this->token.'&wecha_id='.$this->wecha_id),
			array('name'=>'tel','url'=>'tel:'.$this->company['tel']),
			array('name'=>'share','url'=>''),
			);
			 */
		}
		return $plugmenus;
	}

	//以下为二次开发代码
	/**
	 *description:首页信息页面展示
	 *author:yanyalong
	 *date:2014/02/21
	 */
	public function wapindex(){
		//$token= $_REQUEST['token'];
		//$wecha_id= "ofkDmt67kkFkwxpUp_MQzmF6yEvc";
		//$this->assign('actindex',C('UrlActIndex').$token."&wecha_id=".$wecha_id); //品牌动态地址 
		//$this->assign('classlist',C('UrlClassList')."&token=".$token."&wecha_id=".$wecha_id); //全部商品地址 
		//$this->assign('roomindex',C('UrlRoomIndex')."&token=".$token."&wecha_id=".$wecha_id); //全景展厅地址 
		//$this->assign('userspace',C('UrlUserSpace')."&token=".$token."&wecha_id=".$wecha_id); //用户中心地址 
		$view = C('ViewWapIndex');
		$this->display($view);
	}
	/**
	 *description:首页信息数据请求地址
	 *author:yanyalong
	 *date:2014/02/21
	 */
	public function getwapIndex(){
		$p = $_REQUEST['p'];
		$row = $_REQUEST['row'];
		$token= $_REQUEST['token'];
		$wecha_id= $_REQUEST['wecha_id'];
		$t_product_brands_series= D('T_product_brands_series');
		$count = count($t_product_brands_series->getSeriesList($token));		
		$res = $t_product_brands_series->getSeriesList($token,$p,$row);		
		$series = array();
		$url = C('UrlSeriesInfoList')."&token=".$token."&series_id=";
		foreach ($res as $key=>$val) {
			$series[$key]['series_pic'] = C('Jia178WebSite')."uploads/product/thumb_1".$val->series_img;	
			$series[$key]['series_name'] = $val->series_name;	
			$series[$key]['series_adddate'] = $val->series_update;
			$series[$key]['series_desc'] = $val->series_seodesc;	
			$series[$key]['series_piceries_url'] = $url.$val->sid."&wecha_id=".$wecha_id;
		}
		$data['series_list'] = $series;
		$data['count'] = $count;
		echojson(0,$data);
	}
	/**
	 *description:是否关注过当前商家
	 *author:yanyalong
	 *date:2014/02/28
	 */
	public function isfollowserver(){
		$token= $_REQUEST['token'];
		$wecha_id= $_REQUEST['wecha_id'];
		$userinfo = $this->t_user_info->getInfoByWecha_id($wecha_id);
		$user_id = $userinfo->user_id;
		//$wecha_id= "ofkDmt67kkFkwxpUp_MQzmF6yEvc";
		$t_service_info= D('T_service_info');
		$service_id= $t_service_info->getInfoByToken($token)->service_id;		
		$t_like_service= D('T_like_service');
		$data['is_follow'] = $t_like_service->is_follow($user_id,$service_id);		
		$data['follow_url'] = C('UrlFollowSeries')."&token=".$token."&wecha_id=".$wecha_id; 
		$data['followmsg'] = "关注本店即刻获得200元代金券";
		echojson(0,$data);
	}
	

	/**
	 * 获取幻片接口
	 * @author liuguangping
	 * @method GET
	 * @version 2014/02/25
	 */
	public function getSlideIndex(){
		$flash = D('Flash');
		//@todo 后期需要验证
		$toKen = $this->_get('token','trim')?$this->_get('token','trim'):echojson(1,'','非法接入，请正确接入！');
		$result = $flash->getFashList($toKen);
		if($result){
			$flashResult = array();
			foreach ($result as $key=>$value){
				$flashResult[$key]['slide_url'] = $value['url'];
				$flashResult[$key]['slide_pic'] = $value['img'];
			}
			echojson(0,$flashResult,'幻灯片获取成功！');
		}else{
			echojson(1,'','幻灯片获取失败！');
		}
		
	}

	/**
	 *description:关注经销商
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function follow(){
		$token= $_REQUEST['token'];
		$wecha_id = $_REQUEST['wecha_id'];
		//$token= "ceskro1390846219";
		$userinfo = $this->t_user_info->getInfoByWecha_id($wecha_id);
		$user_id = $userinfo->user_id;
		$t_service_info= D('T_service_info');
		$service_id= $t_service_info->getInfoByToken($token)->service_id;		
		$t_like_service= D('T_like_service');
		$is_follow = $t_like_service->is_follow($user_id,$service_id);		
		if($is_follow=='1'){
			if($t_like_service->del_follow($user_id,$service_id)!=false){
				echojson(0,'取消成功');
			}else{
				echojson(1,'取消失败');
			}
		}else{
			$data['service_id'] =$service_id;
			$data['user_id'] = $user_id;
			if($t_like_service->add($data)!=false){
				echojson(0,"",'关注成功');
			}else{
				echojson(1,"",'关注失败');
			}
		}
	}

	/**
	 *description:关于我们
	 *author:yanyalong
	 *date:2014/03/05
	 */
	public function aboutme(){
		$view = C('ViewAboutMe');
		$this->display($view);
	}
}


