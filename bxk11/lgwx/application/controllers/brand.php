<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:品牌管理 
 *author:yanyalong
 *date:2014/03/20
 */
class Brand extends   MY_Controller {
    function __construct(){
        parent::__construct();
    }
    /**
     *description:添加品牌
     *author:yanyalong
     *date:2014/04/02
     */
    public function add(){
        $this->CheckAccessByKey('brand_add');
        $this->config->load('view');
        $config = $this->config->item('action');
        $data['title'] = "添加品牌-jia178移动营销自助平台";
        $this->load->view($config['brand_add'],$data);	
    }
    /**
     *description:编辑品牌
     *author:yanyalong
     *date:2014/04/02
     */
    public function edit(){
        $this->CheckAccessByKey('apply_repeat');
        $this->config->load('view');
        $config = $this->config->item('action');
        $data['title'] = "编辑品牌-jia178移动营销自助平台";
        $this->load->view($config['apply_repeat'],$data);	
    }
    /**
     *description:添加品牌操作地址
     *author:yanyalong
     *date:2014/04/02
     */
    public function addAction(){
        //$this->CheckAccessByKey('brand_add');
        $data['cancel'] = $this->actionList->brand_list;
        $data['submit'] =  $this->actionList->brand_add;
        echojson(0,$data);
    }
    /**
     *description:编辑品牌操作地址
     *author:yanyalong
     *date:2014/04/02
     */
    public function editAction(){
        //$this->CheckAccessByKey('apply_repeat');
        $data['cancel'] = $this->actionList->brand_list;
        $data['submit'] =  $this->actionList->brand_edit;
        echojson(0,$data);
    }
}


