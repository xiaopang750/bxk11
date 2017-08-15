<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Brand extends  Wap_Controller {
    function __construct(){
        parent::__construct();
    }
    /**
     *description:品牌展厅列表
     *author:yanyalong
     *date:2014/04/25
     */
    public function getlist(){
        $this->viewdata['title'] = "品牌展厅";
        $this->load->view($this->view_config['brandlist'],$this->viewdata);	
    }
    /**
     *description:品牌展厅
     *author:yanyalong
     *date:2014/06/21
     */
    public function info(){
        $this->load->model('t_product_brands_model');
        $res = $this->t_product_brands_model->get($_REQUEST['brand_id']);
        $this->viewdata['title'] = $res->brand_name;
        $this->load->view($this->view_config['brandinfo'],$this->viewdata);	
    }
}
