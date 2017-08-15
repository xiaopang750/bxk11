<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  goods3d extends  Wap_Controller {
    function __construct(){
        parent::__construct();
    }
    /**
     *description:全景展厅列表页
     *author:yanyalong
     *date:2014/04/26
     */
    public function getlist(){
        $this->viewdata['title'] = "全景展厅";
        $this->load->view($this->view_config['goods3dlist'],$this->viewdata);	
    }
    /**
     *description:全景展厅详情页
     *author:yanyalong
     *date:2014/04/26
     */
    public function info(){
        $this->viewdata['title'] = "全景展厅";
        $this->load->view($this->view_config['goods3dinfo'],$this->viewdata);	
    }
}

