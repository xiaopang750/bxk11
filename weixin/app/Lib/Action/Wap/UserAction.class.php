<?php
class UserAction extends BaseAction{
	public $product_cart;
	public $t_user;
	private $t_user_info;
	public $wecha_id;
	public function __construct(){
		$this->product_cart= D('Product_cart');
		$this->t_user= D('T_user');
		$this->t_user_info= D('T_user_info');
		parent::check_wecha();
	}
	/**
	 *description:用户中心
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function index(){
		$view = C('ViewUserIndex');
		$this->display($view);
	}
	/**
	 *description:用户中心数据
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function getindex(){
		$token= $_REQUEST['token'];
		//$token= "ceskro1390846219";
		$wecha_id = $_REQUEST['wecha_id'];
		$this->wecha_id = $wecha_id;
		//$wecha_id= "ofkDmt67kkFkwxpUp_MQzmF6yEvc";
		$userinfo = $this->t_user_info->getInfoByWecha_id($wecha_id);
		$user_id = $userinfo->user_id;
		$t_user= D('T_user');
		$t_like_Service= D('T_like_service');
		$res = $t_user->get($user_id);		
		$data['open_id'] = $wecha_id;
		$data['user_id'] = $user_id;
		$data['nickname'] = $res->user_nickname;
		$data['userscore'] = $res->user_score;
		$data['dealers']= $t_like_Service->serviceLikes($user_id);		
		$data['dealerUrl'] = C('UrlMyDealers')."&token=".$token."&wecha_id=".$wecha_id;
		$t_like_Product = D('T_like_product');
		$data['products'] = $t_like_Product->productLikes($user_id);
		$data['productLikeUrl'] = C('UrlProductLikes')."&token=".$token."&wecha_id=".$wecha_id;
		$like_article= D('Likes');
		$data['acts']= $like_article->activeLikes($user_id);		
		$data['actsLikeUrl'] = C('UrlArticleLikes')."&token=".$token."&wecha_id=".$wecha_id;
		$data['tuans'] = count($this->product_cart->tuanLikeList($wecha_id));
		$data['tuanLikesUrl'] = C('UrlTuanLikes')."&token=".$token."&wecha_id=".$wecha_id;
		$data['notes'] = "";
		$data['notesLikesUrl'] = "";
		$data['coupons'] = "";
		$data['couponLikesUrl'] = "";
		$data['apartments'] = "";
		$data['apartmentsLikesUrl'] = "";
		echojson(0,$data);
	}
	/**
	 *description:用户信息
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function userinfo(){
		$token= $_REQUEST['token'];
		$token= "ceskro1390846219";
		//$user_id = 348;
		$wecha_id = $_REQUEST['wecha_id'];
		$t_user= D('T_user');
		$res = $t_user->get($user_id);		
		$data['open_id'] = $wecha_id;
		$data['user_id'] = $user_id;
		$data['nickname'] = $res->user_nickname;
		$data['usercenter'] = C('UrlUserSpace')."&tokey=".$token."&wecha_id=".$wecha_id;
		echojson(0,$data);
	}
	/**
	 *description:我关注的经销商页面
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function mydealers(){
		$view = C('ViewUserDealers');
		$this->display($view);
	}
	/**
	 *description:我关注的经销商
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function getmydealers(){
		$token= $_REQUEST['token'];
		$wecha_id = $_REQUEST['wecha_id'];
		$userinfo = $this->t_user_info->getInfoByWecha_id($wecha_id);
		$user_id = $userinfo->user_id;
		$t_like_service= D('T_like_service');
		$res = $t_like_service->serviceLikeList($user_id,$p,$row);		
		$list = array();
		foreach ($res as $key=>$val) {
			$list[$key]['dealer_id'] = $val->service_id;
			$list[$key]['dealer_url'] = C('UrlWapIndex')."&token=".$val->service_token."&wecha_id=".$wecha_id;
			$list[$key]['dealer_pic'] = $val->service_id;
			$list[$key]['dealer_name'] = $val->service_name;
			$list[$key]['follow_url'] = C('UrlFollowSeries')."&token=".$token."&wecha_id=".$wecha_id; 
			$list[$key]['dealer_group'] = "0";
		}
		echojson(0,$list);
	}
	/**
	 *description:我关注的活动页面
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function myacts(){
		$view = C('ViewUserActs');
		$this->display($view);
	}
	/**
	 *description:我关注的活动
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function getmyacts(){
		$p = $_REQUEST['p'];
		$row = $_REQUEST['row'];
		$token= $_REQUEST['token'];
		$wecha_id = $_REQUEST['wecha_id'];
		$userinfo = $this->t_user_info->getInfoByWecha_id($wecha_id);
		$user_id = $userinfo->user_id;
		$like_article= D('Likes');
		$res = $like_article->articleLikeList($user_id,$p,$row);		
		$list = array();
		foreach ($res as $key=>$val) {
			$list[$key]['act_id'] = $val->article_id;
			$list[$key]['act_url'] = C('UrlActact')."&token=".$val->service_token."&wecha_id=".$wecha_id."&actid=".$val->article_id;
			$list[$key]['act_like'] = C('UrlActLikes')."&token=".$val->service_token."&wecha_id=".$wecha_id."&actid=".$val->article_id;
			$list[$key]['act_pic'] = $val->imgs;
			$list[$key]['act_name'] = $val->title;
			if($val->author=='1'){
				$act_type = "活动";	
			}elseif($val->author=='2'){
				$act_type = "组合";	
			}
			$list[$key]['act_type'] = $val->author;
		}
		echojson(0,$list);
	}
	/**
	 *description:我收藏的产品
	 *author:yanyalong
	 *date:2014/02/26
	 */
	public function myproducts(){
		$view = C('ViewUserProduct');
		$this->display($view);
	}
	/**
	 *description:我收藏的产品列表数据
	 *author:yanyalong
	 *date:2014/02/26
	 */
	public function getmyproducts(){
		$p = $_REQUEST['p'];
		$row = $_REQUEST['row'];
		$token= $_REQUEST['token'];
		$wecha_id= $_REQUEST['wecha_id'];
		$userinfo = $this->t_user_info->getInfoByWecha_id($wecha_id);
		$user_id = $userinfo->user_id;
		$t_like_product= D('T_like_product');
		$res = $t_like_product->productListByUid($user_id,$p,$row);		
		$count = count($t_like_product->productListByUid($user_id));		
		$list = array();
		$productLikeUrl = C('UrlLikeProduct');
		foreach ($res as $key=>$val) {
			$list['list'][$key]['product_id'] = $val->pid;
			$list['list'][$key]['product_url'] =  C('UrlSeriesInfo')."&token=".$val->service_token."&wecha_id=".$wecha_id."&pid=".$val->pid;
			$list['list'][$key]['like_url'] = $productLikeUrl."&token=".$val->service_token."&wecha_id=".$wecha_id."&product_id=".$val->pid;
			$list['list'][$key]['product_name'] = $val->product_name;
			if($val->product_resultpic!=""){
				$picarr = explode('|',$val->product_resultpic); 
				$jia178URL= C('Jia178WebSite');
				$list['list'][$key]['product_pic'] = $jia178URL.'uploads/product/source'.$picarr['0'];				
			}else{
				$list['list'][$key]['product_pic'] = $jia178URL."uploads/theme/source/8b4c90690ad4adc4195abe2b07fee692.jpg";				
			}
			$list['list'][$key]['product_price'] = $val->goods_price;
			$list['list'][$key]['product_upset'] = $val->goods_upset;
		}
		$list['count'] = $count;
		echojson(0,$list);
	}
	/**
	 *description:我报名的团购页面
	 *author:yanyalong
	 *date:2014/02/26
	 */
	public function mytuan(){
		$view = C('ViewUserTuan');
		$this->display($view);
	}
	/**
	 *description:我报名的团购数据
	 *author:yanyalong
	 *date:2014/02/26
	 */
	public function getmytuan(){
		$p = $_REQUEST['p'];
		$row = $_REQUEST['row'];
		$token = $_REQUEST['token'];
		$wecha_id = $_REQUEST['wecha_id'];
		$res = $this->product_cart->tuanLikeList($wecha_id,$p,$row);
		$data = array();
		foreach ($res as $key=>$val) {
			$data[$key]['act_url'] = C('UrlTuanCart')."&token=".$val->token."&wecha_id=".$wecha_id."&actid=".$val->product_id; 
			$data[$key]['act_name'] = $val->name;
			$data[$key]['act_end'] = date("Y年m月d日",$val->endtime);
		}
		echojson(0,$data);
	}
}


