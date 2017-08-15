<?php
class coupon extends Wap_Controller {
	function __construct(){
		parent::__construct();
	}
    /**
     *description:我的优惠券列表
     *author:yanyalong
     *date:2014/04/26
     */
    public function getlist(){
        $this->viewdata['title'] = "我的优惠券";
        $this->load->view($this->view_config['couponlist'],$this->viewdata);	
    }
}
