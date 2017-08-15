<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:门店管理
 *author:yanyalong
 *date:2014/03/24
 */
class  shop extends  MY_Controller {
    function __construct(){
        parent::__construct();
    }
    /**
     *description:添加门店
     *author:yanyalong
     *date:2014/03/26
     */
    public function add(){
        $this->CheckAccessByKey('shop_add');
        $this->config->load('view');
        $config = $this->config->item('action');
        $this->load->view($config['shop_add']);	
    }
    /**
     *description:编辑门店
     *author:yanyalong
     *date:2014/03/26
     */
    public function edit(){
        $this->CheckAccessByKey('shop_edit');
        $this->config->load('view');
        $config = $this->config->item('action');
        $data['title'] = "编辑门店-jia178移动营销自助平台";
        $this->load->view($config['shop_edit'],$data);	
    }
    /**
     *description:编辑幻灯片
     *author:yanyalong
     *date:2014/04/14
     */
    public function editflash(){
        $this->CheckAccessByKey('flash_edit');
        $this->config->load('view');
        $config = $this->config->item('action');
        $data['title'] = "编辑经销商幻灯片-jia178移动营销自助平台";
        $this->load->view($config['flash_edit'],$data);	
    }
}


