<?php
class RoomsAction extends BaseAction{
	private $t_like_product;
	private $t_project_room;
	private $t_user_info;
	private $t_project_room_bill_item;
	private $t_project_room_pic;
	public function __construct(){
		$this->t_certified_product= D('T_certified_product');
		$this->t_project_room= D('T_project_room');
		$this->t_user_info= D('T_user_info');
		$this->t_project_room_bill_item= D('T_project_room_bill_item');
		$this->t_project_room_pic = D('T_project_room_pic');
		parent::check_wecha();
	}
	public function index(){
		$this->display(C('ViewRoomIndex'));
	}
	//全景展厅
	public function getindex(){

		$mainUrl = C('Jia178WebSite');
		$p = $this->_post('p','intval,trim',0);
		$row = $this->_post('row','intval,trim',C('PAGE_COUNT'));
		//@todo 后期需要验证
		$toKey = $this->_get('token','trim')?$this->_get('token','trim'):echojson(1,'','非法接入，请正确接入！');
		$wecha_id = $this->_get('wecha_id','trim')?$this->_get('wecha_id','trim'):echojson(1,'','非法接入，请正确接入！');
		if($p<=0){
			$p = 1;
		}
		$pageCount = $row;
		$listRows = ($p-1)*$pageCount;
		$result = $this->t_project_room->getPageList($listRows,$pageCount);
		foreach ($result as $key=>$value){

			if($value['room_type'] == 2){
				
				$jsonResult[$key]['room_url'] = U("Wap/Rooms/info",array('token'=>$toKey,'wecha_id'=>$wecha_id,'room'=>$value['room_id']));
				$jsonResult[$key]['room_pic'] = $mainUrl.roomurl($value['room_id']).C('Jia178ShowThumb3D');
				//$jsonResult[$key]['room_url'] = U("Wap/Rooms/info",array('token'=>$toKey,'room'=>930));
			}else{
				$jsonResult[$key]['room_url'] = U("Wap/Rooms/roompic",array('token'=>$toKey,'wecha_id'=>$wecha_id,'room'=>$value['room_id']));
				$room_picName = $this->t_project_room_pic->getRoomInfoByRoomId($value['room_id']);
				$jsonResult[$key]['room_pic'] = $mainUrl.d2roomurl($value['room_id'],'source').$room_picName->room_pic_md5;
			}
			
			$jsonResult[$key]['room_name'] = $value['room_name'];
			$jsonResult[$key]['room_type'] = $value['room_type'];
		
			$jsonResult[$key]['room_producturl'] =U("Wap/Project_room_bill_item/index",array('token'=>$toKey,'room'=>$value['room_id'],'wecha_id'=>$wecha_id));
			//$jsonResult[$key]['room_producturl'] =U("Wap/Project_room_bill_item/index",array('token'=>$toKey,'room'=>$value['room_id'],'wecha_id'=>$wecha_id));
		}
		$returnJson['count'] = $this->t_project_room->getPageCount();

		$returnJson['serires_list'] = $jsonResult;
		//dump($returnJson);exit;
		echojson(0, $returnJson,'成功！');
	}
	/**
	 *description:3d设计效果页面
	 *author:liuguangping
	 *date:2014/02/26
	 */
	public function info(){
		$view = C('ViewRoominfo');
		$this->display($view);
	}
	/**
	 *description:2d设计效果页面
	 *author:yanyalong
	 *date:2014/02/26
	 */
	public function roompic(){
		$view = C('View2dDesignInfo');
		$this->display($view);
	}
	/**
	 *description:2d设计效果数据
	 *author:yanyalong
	 *date:2014/02/26
	 */
	public function getroompic(){
		$token = $_REQUEST['token'];
		$room_id = $_REQUEST['room'];
		$wecha_id = $_REQUEST['wecha_id'];
		$res = $this->t_project_room->getInfoByRoom_id($room_id);
		$data = array();
		$jia178URL= C('Jia178WebSite');
			$room_keyword = explode(',',$res->room_keyword);
			$data['room_type'] = $room_keyword['0'];
			$data['room_size'] = $res->room_size;
			$data['room_thinking'] = $res->room_thinking;
			$data['room_id'] = $res->room_id;
			$data['floor_pic1'] = $jia178URL.getfloor1url($res->scheme_id,$res->floor_id)."pic1_2.jpg";
			$roompic = explode(': |',rtrim($res->room_content,': '));
			foreach ($roompic as $keys=>$vals) {
				$data['pic_list'][$keys]['room_pic'] = $jia178URL.d2roomurl($res->room_id,"thumb_3").$vals;
			}
		echojson(0,$data);
	}
	
	/**
	 *description:产品相关案例页面
	 *author:yanyalong
	 *date:2014/02/27
	 */
	public function products(){
		$view = C('ViewSchemeShow');
		$this->display($view);
	}
	/**
	 *description:获取产品相关案例
	 *author:yanyalong
	 *date:2014/02/27
	 */
	public function getproducts(){
		$token= $_REQUEST['token'];
		$product_id = $_REQUEST['pid'];
		$wecha_id= $_REQUEST['wecha_id'];
		$res2d = $this->t_project_room_bill_item->getRoom2dListByProduct_id($product_id);
		$data = array();
		$room2d= array();
		$url2d= C('UrlRoom2d')."&token=".$token."&room=";
		$roomBill= C('UrlRoomBill');
		$jia178URL= C('Jia178WebSite');
		foreach ($res2d as $key=>$val) {
			$room2d[$key]['room_url'] = $url2d.$val->room_id;
			$room2d[$key]['room_name'] = $val->room_name;
			$room2d[$key]['type'] = "1";
			$room2d[$key]['room_bill'] = $roomBill."&token=".$token."&wecha_id=".$wecha_id."&room=".$val->room_id;
			$room_keyword = explode(',',$val->room_keyword);
			$room2d[$key]['room_type'] = $room_keyword['0'];
			$roompic = explode(': |',rtrim($val->room_content,': '));
			$room2d[$key]['room_pic'] = $jia178URL.d2roomurl($val->room_id,"thumb_3").$roompic['0'];
		}
		$res3d = $this->t_project_room_bill_item->getRoom3dListByProduct_id($product_id);
		$room3d= array();
		$url3d= C('UrlRoom3d')."&token=".$token."&room=";
		$jia178URL= C('Jia178WebSite');
		foreach ($res3d as $key=>$val) {
			$room3d[$key]['room_url'] = $url3d.$val->room_id;
			$room3d[$key]['room_name'] = $val->room_name;
			$room3d[$key]['type'] = "2";
			$room3d[$key]['room_bill'] = $roomBill."&token=".$token."&wecha_id=".$wecha_id."&room=".$val->room_id;
			$room_keyword = explode(',',$val->room_keyword);
			$room3d[$key]['room_type'] = $room_keyword['0'];
			$room3d[$key]['room_pic'] = $jia178URL.roomurl($val->room_id)."jsthumb.jpg";
		}
		$data = array_merge($room3d,$room2d);
		echojson(0,$data);
	}
}

