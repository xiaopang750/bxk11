<?php 
class ProductsModel extends Model {
	public $tableName = "product";
	/**
	 *description:获取一个产品的团购信息
	 *author:yanyalong
	 *date:2014/03/03
	 */
	public function getTuanInfoByPid($product_id){
		return $this->row("select * from product where productid='$product_id'");			
	}
}

