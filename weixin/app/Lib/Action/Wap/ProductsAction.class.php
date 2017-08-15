<?php
class ProductsAction extends BaseAction{
	private $t_certified_product;
	private $t_user_info;
	private $user_id;
	private $t_like_product;
	private $product;
	private $t_system_class;
	public function __construct(){
		$this->t_certified_product= D('T_certified_product');
		$this->t_user_info= D('T_user_info');
		$this->t_like_product= D('T_like_product');
		$this->product= D('Products');
		$this->t_system_class= D('T_system_class');
		parent::check_wecha();
	}
	/**
	 *description:精选产品页面
	 *author:yanyalong
	 *date:2014/02/21
	 */
	public function seriesinfo(){
		$view = C('ViewSeriesInfo');
		$this->display($view);
	}
	/**
	 *description:精选产品数据
	 *author:yanyalong
	 *date:2014/02/21
	 */
	public function getseriesinfo(){
		$p = $_REQUEST['p'];
		$row = $_REQUEST['row'];
		$series_id= $_REQUEST['series_id'];
		$token= $_REQUEST['token'];
		$wecha_id = $_REQUEST['wecha_id'];
		$userinfo = $this->t_user_info->getInfoByWecha_id($wecha_id);
		$user_id = $userinfo->user_id;
		$t_product_brands_series= D('T_product_brands_series');
		$service_info= $t_product_brands_series->getInfoBySeriesId($series_id);		
		$data['series_name'] = $service_info->series_name;
		$res = $this->t_certified_product->getProductListBySeriesId($series_id,$p,$row);		
		$count = count($this->t_certified_product->getProductListBySeriesId($series_id));		
		$product_list = array();
		$UrlSeriesInfo= C('UrlSeriesInfo')."&token=".$token."&wecha_id=".$wecha_id."&pid=";
		$productLikeUrl = C('UrlLikeProduct');
		foreach ($res as $key=>$val) {
			$product_list[$key]['product_url'] =$UrlSeriesInfo.$val->pid;
			$product_list[$key]['product_name'] = $val->product_long."*".$val->product_width."*".$val->product_high.$val->product_name;
			if($val->product_resultpic!=""){
				$picarr = explode('|',$val->product_resultpic); 
				$jia178URL= C('Jia178WebSite');
				$product_list[$key]['product_pic'] = $jia178URL.'uploads/product/thumb_1'.$picarr['0'];				
			}else{
				$product_list[$key]['product_pic'] = $jia178URL."uploads/theme/source/8b4c90690ad4adc4195abe2b07fee692.jpg";				
			}
			$product_list[$key]['is_sale'] = $val->product_is_hot;
			$product_list[$key]['product_price'] = $val->goods_price;
			$product_list[$key]['product_upset'] = $val->goods_upset;
			$product_list[$key]['is_like'] = $this->t_like_product->is_like($user_id,$val->pid);
			$product_list[$key]['likeurl'] = $productLikeUrl."&token=".$token."&wecha_id=".$wecha_id."&product_id=".$val->pid;
		}
		$data['product_list'] = $product_list;
		$data['count'] = $count;
		echojson(0,$data);
	}

	/**
	 *description:产品详情页面
	 *author:yanyalong
	 *date:2014/02/27
	 */
	public function info(){
		$view = C('ViewProductInfo');
		$this->display($view);
	}
	/**
	 *description:获取产品详情
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function getinfo(){
		$product_id = $_REQUEST['pid'];
		$token= $_REQUEST['token'];
		$wecha_id = $_REQUEST['wecha_id'];
		$userinfo = $this->t_user_info->getInfoByWecha_id($wecha_id);
		$user_id = $userinfo->user_id;
		$res = $this->t_certified_product->getProductInfoBySeriesId($product_id);		
		$data['product_name'] = $res->product_name;
		$data['product_brand'] = $res->brand_name;
		$data['product_code'] = $res->product_system_code;
		$data['product_size'] = $res->product_long."*".$res->product_width."*".$res->product_high;
		$data['product_unit'] = $res->product_unit;
		$data['product_description'] = $res->product_description;
		$data['product_materials'] = $res->product_materials;
		$data['product_auxiliary'] = $res->product_auxiliary;
		$data['product_series'] = $res->series_name;
		$data['product_pattern'] = $res->pattern_type;
		$jia178URL= C('Jia178WebSite');
		if($res->product_resultpic!=""){
			foreach (explode('|',$res->product_resultpic) as $key=>$val) {
				$data['product_piclist'][$key]['product_pic'] = $jia178URL.'uploads/product/source'.$val;				
			}
		}else{
			$data['product_piclist'][0]['product_pic'] = "http://www.jia178.com/uploads/source/8b4c90690ad4adc4195abe2b07fee692.jpg";
		}
		$data['product_price'] = $res->goods_price;
		$data['product_upset'] = $res->goods_upset;
		$data['is_like']= $this->t_like_product->is_like($user_id,$product_id);		
		$data['like_url'] = C('UrlLikeProduct')."&token=".$token."&wecha_id=".$wecha_id."&product_id=".$product_id; 
		$tuaninfo = $this->product->getTuanInfoByPid($product_id);
		if($tuaninfo!=false){
			$tuan_url = C('UrlTuanCart')."&token=".$token."&wecha_id=".$wecha_id."&actid=".$product_id; 
			$data['tuans'] = "<a href='$tuan_url'>".已有.$tuaninfo->salecount.$tuaninfo->fakemembercount.人报名."</a>";
		}else{
			$data['tuans'] = "";
		}
		$data['sales'] = "暂无";
		echojson(0,$data);
	}
	/**
	 *description:收藏产品
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function like(){
		$token= $_REQUEST['token'];
		$wecha_id= $_REQUEST['wecha_id'];
		$userinfo = $this->t_user_info->getInfoByWecha_id($wecha_id);
		$user_id = $userinfo->user_id;
		$product_id = $_REQUEST['product_id'];
		$is_like = $this->t_like_product->is_like($user_id,$product_id);		
		if($is_like=='1'){
			if($this->t_like_product->del_like($user_id,$product_id)!=false){
				echojson(0,'取消成功');
			}else{
				echojson(1,'取消失败');
			}
		}else{
			$data['product_id'] =$product_id;
			$data['user_id'] = $user_id;
			if($this->t_like_product->add($data)!=false){
				echojson(0,"",'收藏成功');
			}else{
				echojson(1,"",'收藏失败');
			}
		}
	}
	/**
	 *description:收藏产品多个产品
	 *author:liuguangping
	 *date:2014/02/25
	 */
	public function likes(){
		$token= $_REQUEST['token'];
		$wecha_id= $_REQUEST['wecha_id'];
		$userinfo = $this->t_user_info->getInfoByWecha_id($wecha_id);
		$user_id = $userinfo->user_id;
		$product_id = $_REQUEST['product_id'];

		$product_ids = explode(',', $product_id);
		$is_follow = 1;
		foreach ($product_ids as $key => $value) {
			$is_like = $this->t_like_product->is_like($user_id,$value);		
			if($is_like!='1'){
				$data['product_id'] =$product_id;
				$data['user_id'] = $user_id;
				if($this->t_like_product->add($data)==false){
					$is_follow = 0;
					continue;
				}
			}
		}
		if($is_follow != 1){
			echojson(1,"",'收藏失败');
		}else{
			echojson(0,"",'收藏成功');
		}
	}
	/**
	 *description:全部商品页面
	 *author:yanyalong
	 *date:2014/02/26
	 */
	public function classlist(){
		$view = C('ViewClassList');
		$this->display($view);
	}
	/**
	 *description:全部商品数据
	 *author:yanyalong
	 *date:2014/02/26
	 */
	public function getclasslist(){
		$p = $_REQUEST['p'];
		$row = $_REQUEST['row'];
		$token= $_REQUEST['token'];
		$wecha_id = $_REQUEST['wecha_id'];
		$order = $_REQUEST['order'];
		$sort = $_REQUEST['sort'];
		$is_sale = $_REQUEST['sale'];
		$class_id= $_REQUEST['class'];
		//$class_id =163;
		//$order = "discount";
		//$sort = "asc";
		//$is_sale = 1;
		$userinfo = $this->t_user_info->getInfoByWecha_id($wecha_id);
		$user_id = $userinfo->user_id;
		$count = count($this->t_certified_product->getProductListByWecha_id($is_sale,$order,$sort,$class_id));		
		$res = $this->t_certified_product->getProductListByWecha_id($is_sale,$order,$sort,$class_id,$p,$row);		
		$product_list = array();
		$UrlSeriesInfo= C('UrlSeriesInfo')."&token=".$token."&wecha_id=".$wecha_id."&pid=";
		$productLikeUrl = C('UrlLikeProduct');
		foreach ($res as $key=>$val) {
			$product_list[$key]['product_url'] =$UrlSeriesInfo.$val->pid;
			$product_list[$key]['product_id'] =$val->pid;
			$product_list[$key]['product_name'] = $val->product_long."*".$val->product_width."*".$val->product_high.$val->product_name;
			if($val->product_resultpic!=""){
				$picarr = explode('|',$val->product_resultpic); 
				$jia178URL= C('Jia178WebSite');
				$product_list[$key]['product_pic'] = $jia178URL.'uploads/product/thumb_1'.$picarr['0'];				
			}else{
				$product_list[$key]['product_pic'] = "http://www.jia178.com/static/images/lib/logo/header_logo.jpg";
			}
			$product_list[$key]['is_sale'] = $val->product_is_hot;
			$product_list[$key]['product_price'] = ($val->goods_price==null)?"0":$val->goods_price;
			$product_list[$key]['product_upset'] = ($val->goods_upset==null)?"0":$val->goods_upset;
			$product_list[$key]['is_like'] = $this->t_like_product->is_like($user_id,$val->pid);
			$product_list[$key]['likeurl'] = $productLikeUrl."&token=".$token."&wecha_id=".$wecha_id."&product_id=".$val->pid;
		}
		$data['product_list'] = $product_list;
		$data['count'] = $count;
		echojson(0,$data);
	}
	/**
	 *description:获取产品分类(家具)
	 *author:yanyalong
	 *date:2014/03/06
	 */
	public function getallclass(){
		$token= $_REQUEST['token'];
		$wecha_id = $_REQUEST['wecha_id'];
		$class_type = 12;
		$s_class_depth = 2;
		$res = $this->t_system_class->getClassListByClassType($class_type,$s_class_depth);
		$data = array();
		foreach ($res as $key=>$val) {
			$data[$key]['class_id']	 		= $val->s_class_id;
			$data[$key]['class_name'] 		= $val->s_class_name;
			$data[$key]['class_pic'] 		= "";
			$data[$key]['class_products']	= "0";
		}
		echojson(0,$data);
	}
}

