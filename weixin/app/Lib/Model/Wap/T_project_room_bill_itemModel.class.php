<?php 
class T_project_room_bill_itemModel extends Model {
	protected $dbName="jia178";

	/**
	 *description:获取产品列表
	 *author:liugangping
	 *date:2014/02/25
	 */
	public function getProductItemList($room_id){
		return $this->result("select * from $this->dbName.t_project_room_bill_item where room_id=".$room_id);
	}
	
	/**
	 *description:获取产品2d相关案例列表
	 *author:yanyalong
	 *date:2014/02/26
	 */
	public function getRoom2dListByProduct_id($product_id){
		return $this->result("select * from $this->dbName.t_project_room_bill_item prbi left join $this->dbName.t_project_room pr on pr.room_id=prbi.room_id left join $this->dbName.t_project_room_plane prp on prp.room_id=prbi.room_id where prbi.product_id='$product_id' and pr.room_type=1");			
	}
	/**
	 *description:获取产品3d相关案例列表
	 *author:yanyalong
	 *date:2014/02/26
	 */
	public function getRoom3dListByProduct_id($product_id){
	 return $this->result("select * from $this->dbName.t_project_room_bill_item prbi left join $this->dbName.t_project_room pr on pr.room_id=prbi.room_id where prbi.product_id='$product_id' and pr.room_type=2");			
	}
	
}

