<?php 
class Product_cartModel extends Model {
	/**
	 *description:获取用户报名的团购
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function tuanLikeList($wecha_id,$p="",$row=""){
		$limit = "";
		if($p!=""&&$row!=""){
			$limit = " limit ".($p-1)*$row.",".$row;
		}
		return $this->result("select *,p.id product_id from  product_cart pc left join  product_cart_list pcl on pcl.cartid=pc.id left join product p on p.id=pcl.productid where pc.wecha_id='$wecha_id' order by pc.id desc $limit");			
	}
	/**
	 *description:添加购物车
	 *author:liuguangping
	 *date:2014/02/25
	 */
	public function addCart($data){
		return $this->data($data)->add();
	}
}


