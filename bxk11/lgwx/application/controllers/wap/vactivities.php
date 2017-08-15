<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  Vactivities extends  Wap_Controller {
    function __construct(){
        parent::__construct();
        loadLib('WinXinSourl');
        $this->SouriObj = new WinXinSourlClass();
    }
    /**
     *description:促销活动列表页
     *author:yanyalong
     *date:2014/04/26
     */
    public function getlist(){
       echojson(1,"","无相关数据"); 
    }
    /**
     *description:我参加的活动
     *author:yanyalong
     *date:2014/04/27
     */
    public function likelist(){
       echojson(1,"","无相关数据"); 
    }
}
