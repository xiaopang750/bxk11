<?php 
class T_certified_packModel extends Model {
	protected $dbName="jia178";
	/**
	 *description:获取系用户套餐
	 *author:liuguangping
	 *date:2014/02/25
	 */
	public function getPackBySeriesId($series_id){
		$where['goods_id'] = $series_id;
		return $this->where($where)->order('pack_id')->select();
	}
	/**
	 *description:获取套餐第一张图片地址
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function getProducByPackid($pack_id){
		return $this->row("select * from $this->dbName.t_certified_pack_item where pack_id={$pack_id}");
	}

	public function getProductInfo($product_id){
		 return $this->result("select * from $this->dbName.t_service_goods as s left join $this->dbName.t_certified_product as c on s.product_id = c.product_id where s.product_id={$product_id}");
		//return $this->getLastSql();
	}

	/**
	 *description:根据商品id获取某个经销商 相关套餐
	 *author:yanyalong
	 *date:2014/02/25
	 */
	 /* 
	public function getPackAllByProductid($product_id,$series_id,$listRows,$row){
		 return $this->query("select c.pack_id,c.pack_name FROM $this->dbName.t_certified_pack as c LEFT JOIN $this->dbName.t_certified_pack_item as p ON p.pack_id=c.pack_id WHERE p.product_id={$product_id} AND c.goods_id=".$series_id." LIMIT {$listRows},{$row}");
	} */
	
	/**
	 *description:根据商品id获取某个经销商 相关套餐
	 *author:liuguangping
	 *date:2014/02/25
	 */
	public function getPackAllByProductid($product_id,$series_id){
		return $this->query("select c.pack_id,c.pack_name FROM $this->dbName.t_certified_pack as c LEFT JOIN $this->dbName.t_certified_pack_item as p ON p.pack_id=c.pack_id WHERE p.product_id={$product_id} AND c.goods_id=".$series_id);
	}
	/**
	 *description:根据套id信息获取某取相关信息
	 *author:liuguangping
	 *date:2014/02/25
	 */
	public function getProductInftByPackId($pack_id){
		  return $this->result("select * from $this->dbName.t_certified_pack_item as s join $this->dbName.t_certified_product as c on s.product_id = c.product_id where s.pack_id={$pack_id}");
	}


}