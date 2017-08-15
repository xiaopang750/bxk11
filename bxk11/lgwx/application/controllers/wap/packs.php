<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  Packs extends  Wap_Controller {
    function __construct(){
        parent::__construct();
    }
    /**
     *description:优惠套餐
     *author:yanyalong
     *date:2014/04/25
     */
    public function getlist(){
        $this->viewdata['title'] = "优惠套餐";
        $this->load->view($this->view_config['packs'],$this->viewdata);	
    }
}

