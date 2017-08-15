<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  service extends  Wap_Controller {
    function __construct(){
        parent::__construct();
    }
    /**
     *description:我关注的商家列表
     *author:yanyalong
     *date:2014/04/26
     */
    public function likelist(){
        $this->viewdata['title'] = "我关注的商家";
        $this->load->view($this->view_config['servicelikes'],$this->viewdata);	
    }
}

