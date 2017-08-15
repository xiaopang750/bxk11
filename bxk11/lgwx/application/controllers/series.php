<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:系列管理
 *author:yanyalong
 *date:2014/04/08
 */
class  series extends  MY_Controller {
    function __construct(){
        parent::__construct();
    }
    /**
     *description:添加系列
     *author:yanyalong
     *date:2014/04/08
     */
    public function add(){
        $this->CheckAccessByKey('series_add');
        $this->config->load('view');
        $config = $this->config->item('action');
        $data['title'] = "添加系列-jia178移动营销自助平台";
        $this->load->view($config['series_add'],$data);	
    }
    /**
     *description:编辑系列
     *author:yanyalong
     *date:2014/03/26
     */
    public function edit(){
        $this->CheckAccessByKey('series_edit');
        $this->config->load('view');
        $config = $this->config->item('action');
        $data['title'] = "编辑系列-jia178移动营销自助平台";
        $this->load->view($config['series_edit'],$data);	
    }
}



