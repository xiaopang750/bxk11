<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//产品分类
class ProductClass{
    public function __construct($pc_pid){
        $this->CI = &get_instance();
        $this->CI->load->model('t_product_class_model');
        $this->getListByTop($pc_pid);
    }    
    /**
     *description:获取一级产品分类列表
     *author:yanyalong
     *date:2014/06/17
     */
    private function getListByTop($pc_pid="0"){
        $this->classList = $this->CI->t_product_class_model->getListByParentId($pc_pid);    
        return $this->classList;
    }
}


//工厂
class ProductClassFactory{
    public static function getProductClass($pc_pid){
        $productClass = new ProductClass($pc_pid);
        return $productClass->classList;
    }
}

