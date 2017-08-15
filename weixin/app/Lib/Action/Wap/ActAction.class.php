<?php

class ActAction extends BaseAction{
	public $article;
	public $product;
	public $product_cart;
	public $t_certified_pack;
	public $product_cart_list;
	public $like;
	public $t_service_info;
	public $t_certified_product;
	public $t_service_goods;
	public $t_like_product;
	public $weixi_id;
	public $token;

	public function _initialize(){
		parent::check_wecha();
		$this->weixi_id = $this->_get('wecha_id','trim')? $this->_get('wecha_id','trim'): echojson(1,'','非法接入，请正确接入！');
		$this->token = $this->_get('token','trim')?$this->_get('token','trim'):echojson(1,'','非法接入，请正确接入！');
		$this->article = D('Article');
		$this->product = D('Product');
		$this->product_cart = D("Product_cart");
		$this->product_cart_list = D('Product_cart_list');
		$this->t_certified_pack = D('T_certified_pack');
		$this->t_service_info = D('T_service_info');
		$this->t_certified_product = D('T_certified_product');
		$this->t_service_goods = D('T_service_goods');
		$this->t_like_product= D('T_like_product');
		$this->likes = D('Likes');
	}
	
	public function index(){
		$this->display(C('ViewActIndex'));
	}
	// 品牌动态
	public function getindex(){
		//$wx_id = $this->_get('wecha_id','trim');
		$weixi_id = $this->weixi_id;

		$mainUrl = C('Jia178WebSite');
		$p = $this->_post('p','intval,trim',0);
		$row = $this->_post('row','intval,trim',C('PAGE_COUNT'));
		//@todo 后期需要验证
		$token = $this->token;
		$t_service_info = $this->t_service_info->getInfoByToken($token);
		$service_id = $t_service_info->service_id;
		//套餐(导购)3
		//dump($this->t_certified_pack->getProducByPackid(1));exit;
		$packResult = $this->t_certified_pack->getPackBySeriesId($service_id);
		//团购2
		$productResult = $this->product->getProductInfo($token);
		//促销（活动）1
		$ArticleResult = $this->article->getArticleInfo($token);
		//var_dump($packResult);DIE;
		foreach ($packResult as $keys => $values) {

			$pack_result = $this->t_certified_pack->getProducByPackid($values['pack_id']);
			if($pack_result->product_id){
				$productInfo = $this->t_certified_pack->getProductInfo($pack_result->product_id);
			}else{
				continue;
			}
			$resultPack[$keys]['act_name'] = $values['pack_name'];
			$resultPack[$keys]['act_url'] =  U("Wap/Act/pack",array('token'=>$token,'actid'=>$pack_result->product_id,'wecha_id'=>$weixi_id));
			$resultPack[$keys]['act_pic'] = $mainUrl."/uploads/product/index".$productInfo[0]->product_pic;
			$resultPack[$keys]['act_type'] = 3;
			$resultPack[$keys]['time'] = date("Y-m-d",time()-3600*24*$keys);
			$resultPack[$keys]['act_day'] = 7;
		}
			
		foreach ($productResult as $ke => $valu) {
			$resultProduct[$ke]['act_name'] = $valu['name'];
			//$pack_result = $this->t_certified_pack->getProducByPackid($value['pack_id']);
			$resultProduct[$ke]['act_url'] =  U("Wap/Act/tuan",array('token'=>$token,'actid'=>$valu['id'],'wecha_id'=>$weixi_id));
			
			if(intval($valu['productid']) != 0){
				$certifiedInfo = $this->t_certified_product->getProductInfo($valu['productid']);
				$resultProduct[$ke]['act_pic'] = $mainUrl."/uploads/product/index".$certifiedInfo['product_pic'];
			}else{
				$resultProduct[$ke]['act_pic'] = $valu['logourl'];
			}
			
			$resultProduct[$ke]['act_type'] = 2;
			$resultProduct[$ke]['sum'] = $valu['salecount']+$valu['fakemembercount'];
			$resultProduct[$ke]['time'] = date("Y-m-d",$valu['time']);
			$day = ceil(($valu['endtime']-$valu['time'])/(24*3600));
			if($day<=0){
				$resultProduct[$ke]['act_day'] = 0;
			}else{
				$resultProduct[$ke]['act_day'] = $day;
			}
	
		}

		foreach ($ArticleResult as $k => $val) {
			$resultArticle[$k]['act_name'] = $val['title'];
			//$pack_result = $this->t_certified_pack->getProducByPackid($value['pack_id']);
			$resultArticle[$k]['act_url'] =   U("Wap/Act/act",array('token'=>$token,'actid'=>$val['id'],'wecha_id'=>$weixi_id));
			$resultArticle[$k]['act_pic'] = $val['imgs'];
			$resultArticle[$k]['act_type'] = 1;
			$resultArticle[$k]['time'] = date("Y-m-d",$val['createtime']);
			$resultArticle[$k]['act_day'] = 7;
		}
		$resultPack = $resultPack?$resultPack:array(''=>'');
		$resultProduct = $resultProduct?$resultProduct:array(''=>'');
		$resultArticle = $resultArticle?$resultArticle:array('' => '' );
		$result = array_merge($resultPack,$resultProduct,$resultArticle);
		$resultCount = $this->quick_sort($result);
		
		if($p<=0){
			$p = 1;
		}
		$listRows = ($p-1)*$row;
		$resultCounts = array();
		foreach ($resultCount as $kez => $valuez) {
			if($valuez){
				$resultCounts[] = $valuez;
			}
			
		}
		$resultJson = array_slice($resultCounts,$listRows,$row);
		
		$results['count'] = count($resultCounts);
		
		$results['act_list'] = $resultJson;
		echojson(0, $results,'成功！');

	}
	
	public function info(){
		$view = C('ViewRoominfo');
		$this->display($view);
	}
	
	public function getinfo(){
		//echojson(0, $data)
		//$this->display(C('ViewRoominfo'));
	}
	//促销套餐
	public function act(){
		$view = C("ViewActInfo");
		$this->display($view);
	}

	public function getact(){
		$id = $this->_get('actid','trim,intval');
		//$wx_id = $this->_get("wecha_id",'trim');
		$weixi_id = $this->weixi_id;
		$token = $this->token;
		$Article = $this->article->getArticle($id);
		//获取用户信息 
		$user_info = D('T_user_info')->getInfoByWecha_id($weixi_id);

		if(!$user_info){
			echojson(1,'','用户不存在');
		}else{

		
			if(D('Likes')->is_follow($user_info->user_id,$id,1)){
				$is_follow = 1;
			}else{
				$is_follow = 0;
			}
		}
		if($Article){
			$ArticleResult['act_id'] = $id;
			$ArticleResult['act_pic'] = $Article['imgs'];
			$ArticleResult['act_name'] = $Article['title'];
			$ArticleResult['act_begin'] = date('Y-m-d',time()+$id*3600*24);
			$ArticleResult['act_end'] = date("Y-m-d",time()+$id*3600*24*2);
			$ArticleResult['is_follow'] = $is_follow;
			$ArticleResult['act_price'] = $id*62;
			$ArticleResult['act_listprice'] = $id*121;
			$ArticleResult['act_content'] = $Article['description'];
			$ArticleResult['follow_url'] = U("Wap/Act/like",array("token"=>$token,"wecha_id"=>$weixi_id,'type'=>1,'actid'=>$id));
			
			echojson('0',$ArticleResult,'成功！');
		}else{
			echojson(1, ''," 数据出错");
		}
		$this->display(C("ViewActPack"));
	}
	public function roompic(){
		$view = C('ViewRoomPic');
		$this->display($view);
	}

	public function tuan(){
		$view = C("ViewActGroup");
		$this->display($view);
	}

	public function gettuan(){

		$id = $this->_get('actid','trim,intval');
		//$wx_id = $this->_get("wecha_id",'trim');
		$weixi_id = $this->weixi_id;
		$token = $this->token;
		$product = $this->product->getProductInfoById($id);
		$mainUrl = C('Jia178WebSite');
		//获取用户信息 
		$user_info = D('T_user_info')->getInfoByWecha_id($weixi_id);

		if(!$user_info){
			echojson(1,'','用户不存在');
		}else{

			if(D('Likes')->is_follow($user_info->user_id,$id,2)){
				$is_follow = 1;
			}else{
				$is_follow = 0;
			}
		}

		if($this->product_cart_list->is_tuangou($id,$token,$weixi_id)){
			$is_join = 1;
		}else{
			$is_join = 0;
		}

		if($product){
			
			$ArticleResult['act_id'] = $id;

			if(intval($product['productid']) !=0){

				$certifiedInfo = $this->t_certified_product->getProductInfo($product['productid']);
				$ArticleResult['act_pic'] = $mainUrl."/uploads/product/index".$certifiedInfo['product_pic'];
			}else{
				$ArticleResult['act_pic']= $product['logourl'];
			}
			$ArticleResult['act_name'] = $product['name'];
			$ArticleResult['is_product'] = 0;
			$ArticleResult['product_name'] = '';
			$ArticleResult['product_pic'] = '';
			$ArticleResult['product_url'] = '';
			$ArticleResult['act_begin'] = date('Y-m-d',$product['time']);
			$day = time()-$product['time'];
			if($day<=0){
				$ArticleResult['act_numday'] = 0;	
			}else{
				$ArticleResult['act_numday'] = ceil($day/(24*3600));
			}
			$ArticleResult['act_end'] = date("Y-m-d",$product['endtime']);
			$ArticleResult['is_follow'] = $is_follow;
			$ArticleResult['act_price'] = $product['price'];
			$ArticleResult['act_listprice'] = $product['oprice'];
			$ArticleResult['act_content'] = $product['keyword'];
			$ArticleResult['act_joins'] = $product['salecount']+$product['fakemembercount'];

			$ArticleResult['follow_url'] = U("Wap/Act/addGroups",array("token"=>$token,'wecha_id'=>$weixi_id,'price'=>$product['price'],'actid'=>$id));
			$ArticleResult['is_join'] = $is_join;
			//dump($ArticleResult);die;
			echojson('0',$ArticleResult,'成功！');
		}else{
			echojson(1, ''," 数据出错");
		}
		//$this->display(C("ViewActPack"));
	}
	
  	public function quick_sort($array){
   		if (count($array) <= 1) return $array;  
   	    $key = $array[0];   
   	    $left_arr = array(); 
   	    $right_arr = array();  
   	    for ($i=1; $i<count($array); $i++){   
   	    	if ($array[$i]['time'] >= $key['time'])  
   	    		 $left_arr[] = $array[$i];   
   	    	else   $right_arr[] = $array[$i];  
   	     }  
   	      $left_arr = $this->quick_sort($left_arr);  
   	      $right_arr = $this->quick_sort($right_arr); 
   	      return array_merge($left_arr, array($key), $right_arr);
      }
      
      /*
       * 用户关注
       */
      public function like(){
      	$actid = $_REQUEST['actid'];
      	$type = $_REQUEST['type'];
      	//$wx_id = $this->_get("wecha_id",'trim');
		$weixi_id = $this->weixi_id;

      	$user_info = D('T_user_info')->getInfoByWecha_id($weixi_id);

		if(!$user_info){
			echojson(1,'','用户不存在');
		}
		if($this->likes->is_follow($user_info->user_id,$actid,$type)){
			if($this->likes->cancelFollow($user_info->user_id,$actid,$type)){
      			echojson(0,'','取消成功！');
	      	}else{
	      		echojson(1,'','取消失败！');
	      	}
		}else{
			if($this->likes->addFollow($user_info->user_id,$actid,$type)){
      			echojson(0,'','关注成功！');
      		}else{
      			echojson(1,'','关注失败！');
      		}
		}
      
      }

      /*
       * 取消关注
       */
      public function cancelLike(){
      	$actid = $_REQUEST['actid'];
      	$type = $_REQUEST['type'];
      	//$wx_id = $this->_get("wecha_id",'trim');
		$weixi_id = $this->weixi_id;

      	$user_info = D('T_user_info')->getInfoByWecha_id($weixi_id);

		if(!$user_info){
			echojson(1,'','用户不存在');
		}
      	if($this->likes->cancelFollow($user_info->user_id,$actid,$type)){
      		echojson(0,'','取消成功！');
      	}else{
      		echojson(1,'','取消失败！');
      	}
      }
      /**
      **加入团购ceskro1390846219
	  ** liuguangping	
      */
      public function addGroups(){
      	$id = $this->_get('actid','trim,intval');

		//$wx_id = $this->_get("wecha_id",'trim');
		$weixi_id = $this->weixi_id;
		$token = $this->token;
		$price = $this->_get("price",'trim,intval',100);
      	$data['token'] = $token;
      	$data['wecha_id'] =$weixi_id;
      	$data['info'] = serialize(array('count'=>1,"price"=>$price));
      	$data['total'] = 1;
      	$data['price'] = $price;
      	$data['truename'] = "liuguangping";
      	$data['time'] = time();
      	$data['buytime'] = time();
      	$data['tel'] =	"13071150091";
      	$data['address'] = "北京";
  
      	if($data['cartid'] = $this->product_cart->addCart($data)){
	        $data['productid'] = $id;
	        $data['wecha_id'] = $weixi_id;
	        $data['token'] = $token;
	      	if($cartList = $this->product_cart_list->addCartList($data)){
	      		$user_info = D('T_user_info')->getInfoByWecha_id($weixi_id);
	      		if($user_info){
	      			$this->likes->cancelFollow($user_info->user_id,$id,2);
	      		}
	      		echojson(0,'',"参加团购成功！");
	      	}else{
	      		echojson(1,'',"参加团购失败！");
	      	}
      	}else{
      		echojson(1,'',"参加团购失败！");
      	}
      
      }

      /**
      *取消团购
      *@todo 后期在做
      */
      public function cancelGroups(){
      	$id = $this->_get('actid','trim,intval');
		//$wx_id = $this->_get("wecha_id",'trim');
		$weixi_id = $this->weixi_id;
		$token = $this->token;
		//查找购物车
		$cartResult = $this->product_cart_list->getTungouInfo(1,"ceskro1390846219","ofkDmt67kkFkwxpUp_MQzmF6yEvc");
		$cartId = twotoone_array($cartResult,'cartid');	dump($cartId);
      }
      //套餐
	 public function productpack(){
		$view = C('ViewProductPack');
		$this->display($view);
	 }
	 //搭配套餐
	 public function getproductpack(){
	 	
	 	$token = $this->token;
	 	$pid = $this->_get('pid',"intval,trim");

	 	$wx_id = $this->weixi_id;
	 	$mainUrl = C('Jia178WebSite');
	/* 	$p = $this->_post('p','intval,trim',0);
		$row = $this->_post('row','intval,trim',C('PAGE_COUNT'));
 */
		$weixi_id = $wx_id;
		$t_service_info = $this->t_service_info->getInfoByToken($token);
		$service_id = $t_service_info->service_id;
		$user_info = D('T_user_info')->getInfoByWecha_id($weixi_id);

/* 		if($p<=0){
			$p = 1;
		}
		$listRows = ($p-1)*$row; */
		//$packResult = $this->t_certified_pack->getPackAllByProductid($pid,$service_id,$listRows,$row);
		$packResult = $this->t_certified_pack->getPackAllByProductid($pid,$service_id);
		foreach ($packResult as $key => $value) {

			$ProductInfo = $this->t_certified_pack->getProductInftByPackId($value['pack_id']);
			$Product_Ids = twotoone_array($ProductInfo,'product_id');
			$is_follow = 1;
			foreach ($Product_Ids as $key => $values) {

				$is_like = $this->t_like_product->is_like($user_info->user_id,$values);
				if($is_like != 1 ){
					$is_follow = 0;
					break;
				}
			}
		
			foreach ($ProductInfo as $ke => $val) {
				
				$serviceGoods = $this->t_service_goods->getProductInfotByProductId($val->product_id);
	
				$product_list[$ke]['product_url'] = U("Wap/Products/info",array('token'=>$token,'pid'=>$val->product_id,'wecha_id'=>$this->weixi_id));
				$product_list[$ke]['product_price'] =$serviceGoods['goods_price'];
				$product_list[$ke]['poduct_name'] =$val->poduct_name;
				$product_list[$ke]['product_pic'] =$mainUrl."/uploads/product/index".$val->product_pic;
				$product_list[$ke]['goods_price'] = $serviceGoods['goods_price'];
				$product_list[$ke]['poduct_id'] = $val->product_id;
				$countPrice +=intval($serviceGoods['goods_price']); 
				$countUpset +=intval($serviceGoods['goods_upset']);
			}
			
			$ProductInfoResult['list'][$value['pack_id']]['product_list'] =$product_list;
			$ProductInfoResult['list'][$value['pack_id']]['product_price'] = $countPrice;
			$ProductInfoResult['list'][$value['pack_id']]['goods_upset'] = $countUpset;
			$ProductInfoResult['list'][$value['pack_id']]['product_count'] = count($product_list);
			$ProductInfoResult['list'][$value['pack_id']]['pack_name'] = $value['pack_name'];
		 	$ProductInfoResult['list'][$value['pack_id']]['is_follow'] = $is_follow;
		 	$ProductInfoResult['list'][$value['pack_id']]['follow_url'] = U('Wap/Products/likes',array('token'=>$token,'wecha_id'=>$this->weixi_id));
			
		}
		$ProductInfoResult['count'] = count($ProductInfoResult['list']);
		echojson(0,$ProductInfoResult,'成功！');

	 }
}

