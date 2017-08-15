<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @description 系统标签分类模块 
 * @author		yanyl
 */
class Product_Class{

	public $p_class_pid;

	/**获取产品分类列表(用于家居美图)
	 *description:
	 *author:yanyalong
	 *date:2013/10/30
	 */
	public function getProdutClass(){
		$this->CI = &get_instance();
		$this->CI->load->model('t_product_class_model');
		$this->CI->t_product_class_model->p_class_pid = $this->p_class_pid;
		$productClass = $this->CI->t_product_class_model->getProdutClass();
		if(empty($productClass)) return false;
		$productarr = array();
		$i=0;
		foreach ($productClass as $key=>$val) {
			$productarr[$i]['p_class_id'] = $val['p_class_id'];
			$productarr[$i]['p_class_name'] = $val['p_class_name'];
			$i++;
		}
		return $productarr;
	}
}
