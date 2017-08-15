<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Information extends  Wap_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('t_service_information_model');
    }
    /**
     *description:最新资讯列表
     *author:yanyalong
     *date:2014/04/25
     */
    public function getlist(){
        $this->viewdata['title'] = "最新资讯";
        $this->load->view($this->view_config['informationlist'],$this->viewdata);	
    }
    /**
     *description:资讯详情
     *author:yanyalong
     *date:2014/04/26
     */
    public function info(){
        $si_id = isset($_GET['si_id'])?$_GET['si_id']:'';
        $res = $this->t_service_information_model->get($si_id);
        $this->viewdata['title'] = $res->si_title;
        $this->load->view($this->view_config['informationinfo'],$this->viewdata);	
    }
}

