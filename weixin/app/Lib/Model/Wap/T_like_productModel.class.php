<?php 
class T_like_productModel extends Model {
	protected $dbName="jia178";

	/**
	 *description:获取用户是否关注过该产品
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function is_like($user_id,$product_id){
		if($product_id=="") return '0';
		$res = $this->row("select * from $this->dbName.t_like_product where user_id='$user_id' and product_id=$product_id");			
		if(!empty($res)) return '1';
		return '0';
	}
	/**
	 *description:取消关注产品
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function del_like($user_id,$product_id){
		return $this->execute("delete from $this->dbName.t_like_product where product_id='$product_id' and user_id='$user_id'");			
	}
	/**
	 *description:获取收藏产品统计数
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function productLikes($user_id){
		return $this->row("select count(*) count  from $this->dbName.t_like_product where user_id='$user_id'")->count;			
	}
	/**
	 *description:获取我收藏的产品数据
	 *author:yanyalong
	 *date:2014/02/26
	 */
	public function productListByUid($user_id,$p,$row){
		$limit = "";
		if($p!=""&&$row!=""){
			$limit = " limit ".($p-1)*$row.",".$row;
		}
		return $this->result("select *,lp.product_id pid from $this->dbName.t_like_product lp left join $this->dbName.t_certified_product cp on lp.product_id=cp.product_id left join $this->dbName.t_certified_product_info cpi on cpi.product_id=cp.product_id left join $this->dbName.t_service_goods sg on sg.product_id=cp.product_id left join $this->dbName.t_service_info si on si.service_id=sg.service_id where lp.user_id='$user_id' and cp.product_status<11  $limit");			
	}
}


