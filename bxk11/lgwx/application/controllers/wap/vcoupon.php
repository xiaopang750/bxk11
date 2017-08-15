<?php
class Vcoupon extends Wap_Controller {
	function __construct(){
		parent::__construct();
        loadLib('WinXinSourl');
        $this->SouriObj = new WinXinSourlClass();
	}
    /**
     *description:我的优惠券列表
     *author:yanyalong
     *date:2014/04/26
     */
    public function getlist(){
       echojson(1,"","无相关数据"); 
    }
}

