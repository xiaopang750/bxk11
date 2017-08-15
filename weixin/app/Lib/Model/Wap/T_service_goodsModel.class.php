<?php 
class T_service_goodsModel extends Model {
	protected $dbName="jia178";
	
	/**
	 *description:根据产品id获取经消商产品相关信息
	 *author:liuguangping
	 *date:2014/02/25
	 */
	public function getProductInfotByProductId($product_id){
		  return $this->where("product_id=".$product_id)->find();
	}


}