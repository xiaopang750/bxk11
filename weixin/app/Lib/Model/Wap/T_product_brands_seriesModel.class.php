<?php 
class T_product_brands_seriesModel extends Model {
	protected $dbName="jia178";

	/**
	 *description:获取经销商品牌系列
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function getSeriesList($service_token,$p="",$row=""){
		$limit = "";
		if($p!=""&&$row!=""){
			$limit = " limit ".($p-1)*$row.",".$row;
		}

	//return $this->result("select * from $this->dbName.t_product_brands_series pb left join  $this->dbName.t_brands_service_license bs on bs.series_id=pb.series_id left join $this->dbName.t_service_info si on bs.service_id=si.service_id where si.service_token='$service_token' $limit");			
	return $this->result("select *,pb.series_id sid from $this->dbName.t_product_brands_series pb left join  $this->dbName.t_brands_service_license bs on bs.series_id=pb.series_id left join $this->dbName.t_service_info si on bs.service_id=si.service_id where 1 $limit");			
	}
	/**
	 *description:获取经销商系列信息
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function getInfoBySeriesId($series_id){
		return $this->row("select * from $this->dbName.t_product_brands_series pb where pb.series_id='$series_id'");			
	}
}

