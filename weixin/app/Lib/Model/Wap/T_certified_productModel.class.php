<?php 
class T_certified_productModel extends Model {

	protected $dbName="jia178";
	/**
	 *description:获取系列产品列表
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function getProductListBySeriesId($series_id,$p,$row){
		$limit = "";
		if($p!=""&&$row!=""){
			$limit = " limit ".($p-1)*$row.",".$row;
		}
		return $this->result("select *,cp.product_id pid from $this->dbName.t_certified_product cp left join $this->dbName.t_certified_product_info cpi on cpi.product_id=cp.product_id left join $this->dbName.t_service_goods sg on cp.product_id=sg.product_id where cp.series_id='$series_id' and cp.product_status<11  order by cp.product_sort desc,cp.product_id desc  $limit");			
	}
	/**
	 *description:获取系列产品详情
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function getProductInfoBySeriesId($product_id){
		return $this->row("select * from $this->dbName.t_certified_product cp left join $this->dbName.t_product_brands pb on pb.brand_id=cp.brand_id left join $this->dbName.t_certified_product_info cpi on cpi.product_id=cp.product_id left join $this->dbName.t_service_goods sg on cp.product_id=sg.product_id left join $this->dbName.t_product_brands_series pbs on pbs.series_id=cp.series_id left join $this->dbName.t_system_product_pattern sp on sp.pattern_id=cp.pattern_id where cp.product_id='$product_id'");			
	}
	/**
	 *description:获取经销商全部产品列表
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function getProductListByWecha_id($is_sale,$order,$sort,$class_id,$p="",$row=""){
		$limit = "";
		if($p!=""&&$row!=""){
			$limit = " limit ".($p-1)*$row.",".$row;
		}
		$sale = "";
		if($is_sale==1){
			$sale = " and  cp.product_is_hot=1 ";
		}
		$orderby = " order by cp.product_sort desc,cp.product_id desc ";
		$discount = "";
		switch ($order) {
		case 'price':
			$orderby = " order by sg.goods_price $sort,cp.product_sort desc,cp.product_id desc ";
			break;
		case 'discount':
			$discount = ",1-sg.goods_upset/sg.goods_price discount ";
			$orderby = " order by discount $sort,cp.product_sort desc,cp.product_id desc ";
			break;
		}
		$joinClass_id = "";
		$andClass_id  = "";
		if($class_id!=""){
			$joinClass_id= " left join $this->dbName.t_product_class_brands_series pcbs on pcbs.brand_id=cp.brand_id ";
			$andClass_id = " and pcbs.s_class_id=$class_id ";
		}
		return $this->result("select *,cp.product_id pid $discount from $this->dbName.t_certified_product cp left outer join $this->dbName.t_certified_product_info cpi on cpi.product_id=cp.product_id left join $this->dbName.t_service_goods sg on cp.product_id=sg.product_id  left join $this->dbName.t_service_info si on si.service_id=sg.service_id $joinClass_id where cp.product_status<11 $sale $andClass_id $orderby $limit");			
	}
	/**
	 *description:获取产品详细信息
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function getProductInfo($product_id){

		return $this->where("product_id=".$product_id)->find();			
	}
}



