<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  Vpacks extends  Wap_Controller {
    function __construct(){
        parent::__construct();
        loadLib('WinXinSourl');
        $this->SouriObj = new WinXinSourlClass();
    }
    /**
     *description:优惠套餐
     *author:yanyalong
     *date:2014/04/25
     */
    public function getlist(){
       echojson(1,"","无相关数据"); 
    }
}

