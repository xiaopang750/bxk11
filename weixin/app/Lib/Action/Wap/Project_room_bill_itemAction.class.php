<?php
class Project_room_bill_itemAction extends BaseAction{

	private $t_project_room_bill_item;
	private $t_certified_product;
	private $t_project_room;
	public $weixi_id;
	public $token;
	public function __construct(){
		$this->weixi_id = $this->_get('wecha_id','trim')? $this->_get('wecha_id','trim'): echojson(1,'','非法接入，请正确接入！');
		$this->token = $this->_get('token','trim')?$this->_get('token','trim'):echojson(1,'','非法接入，请正确接入！');
		$this->t_project_room_bill_item= D('T_project_room_bill_item');
		$this->t_certified_product= D('T_certified_product');
		$this->t_project_room = D("T_project_room");
		parent::check_wecha();
	}
	public function index(){
		$this->display(C('ViewProductItemIndex'));
	}
	public function getindex(){
		$room_id = $this->_get('room','intval');
		//$key = $this->_get('token','trim');
		$token = $this->token;
		$roomList = $this->t_project_room_bill_item->getProductItemList($room_id);
		$mainUrl = C('Jia178WebSite');
		if($roomList){
			$countPrice = 0;
			$roomResult = $this->t_project_room->getInfoByRoom_id($room_id);
			foreach ($roomList as $key => $value) {
				$productInfo = $this->t_certified_product->getProductInfo($value->product_id);
				$roomProduct[$key]['product_name'] = $value->poduct_name;
				$roomProduct[$key]['product_picurl'] = $mainUrl."/uploads/product/index".$productInfo['product_pic'];
				$roomProduct[$key]['product_nubmber'] = 1;
				$roomProduct[$key]['product_id'] = $value->product_id;
				$roomProduct[$key]['product_price'] = $productInfo['product_price'];
				$countPrice += $productInfo['product_price'];
				$roomProduct[$key]['product_size'] = $productInfo['product_size'];
				$roomProduct[$key]['product_unit'] = $productInfo['product_unit'];
				$roomProduct[$key]['product_url'] = U("Wap/Products/info",array('token'=>$token,'pid'=>$value->product_id,'wecha_id'=>$this->weixi_id));
			}

			$roomProductItem['product_list'] = $roomProduct;
			$roomProductItem['product_count'] = count($roomProductItem['product_list']);
			$roomProductItem['product_countPrice'] = $countPrice;
			$roomProductItem['room_name'] = $roomResult->room_name;
			//dump($roomProductItem);exit;
			echojson(0,$roomProductItem,'获取成功！');
		}else{
			echojson(1,'',"无数据！");
		}
	}

			
	
}

