<?php 
class ProductModel extends Model {
	/**
	 *description:获取用户参加的团购
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function getProductCartList($user_id,$p,$row){
		$limit = " limit ".($p-1)*$row.",".$row;
		return $this->select("select * from product p left join product_cart pc on p.");			
	}


}

