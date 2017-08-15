<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:wap首页
 *author:yanyalong
 *date:2014/03/20
 */
class Index extends  Wap_Controller {
    function __construct(){
        parent::__construct();
    }
    /**
     *description:wap首页
     *author:yanyalong
     *date:2014/04/25
     */
    public function index(){
        $this->viewdata['title'] = "首页";
        $this->load->view($this->view_config['wapindex'],$this->viewdata);	
    }
}

