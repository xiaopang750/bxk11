<?php
    class Product_cart_listModel extends Model{

    function gettoken(){
		return session('token');
	}

    public function is_tuangou($product_id,$token,$wecha_id){
        $where['productid'] = $product_id;
        $where['token'] = $token;
        $where['wecha_id'] = $wecha_id;
        return $this->where($where)->find();
    }

    public function getTungouInfo($product_id,$token,$wecha_id){
        $where['productid'] = $product_id;
        $where['token'] = $token;
        $where['wecha_id'] = $wecha_id;
        return $this->where($where)->select();
    }

    public function addCartList($info){
        $data['cartid'] = $info['cartid'];
        $data['productid'] = $info['productid'];
        $data['price'] = $info['price'];
        $data['total'] = 1;
        $data['wecha_id'] = $info['wecha_id'];
        $data['token'] = $info['token'];
        $data['time'] = time();
        if($this->data($data)->add()){
            return true;
        }else{
            return false;
        }
    }
}

?>