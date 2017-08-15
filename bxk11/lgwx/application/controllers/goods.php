<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:商品管理
 *author:yanyalong
 *date:2014/04/08
 */
class goods extends  MY_Controller {
    function __construct(){
        parent::__construct();
    }
    /**
     *description:添加商品
     *author:yanyalong
     *date:2014/04/08
     */
    public function add(){
        $this->CheckAccessByKey('goods_add');
        $this->config->load('view');
        $config = $this->config->item('action');
        $data['title'] = "添加商品-jia178移动营销自助平台";
        $this->load->view($config['goods_add'],$data);	
    }
    /**
     *description:编辑商品
     *author:yanyalong
     *date:2014/03/26
     */
    public function edit(){
        $this->CheckAccessByKey('goods_edit');
        $this->config->load('view');
        $config = $this->config->item('action');
        $data['title'] = "编辑商品-jia178移动营销自助平台";
        $this->load->view($config['goods_edit'],$data);	
    }
   /**
    *description:查看商品列表
    *author:yanyalong
    *date:2014/04/09
    */
    public function index(){
        $this->CheckAccessByKey('goods_list');
        $this->config->load('view');
        $config = $this->config->item('action');
        $data['title'] = "商品管理-jia178移动营销自助平台";
        $this->load->view($config['goods_list'],$data);	
    }
}
