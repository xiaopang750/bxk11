<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  Shop extends  Wap_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('t_service_shop_model');
        $this->load->model('t_like_service_shop_model');
    }
    /**
     *description:经销网络列表页
     *author:yanyalong
     *date:2014/04/25
     */
    public function getlist(){
        $this->viewdata['title'] = "经销网络";
        $this->load->view($this->view_config['shoplist'],$this->viewdata);	
    }
    /**
     *description:门店详情
     *author:yanyalong
     *date:2014/04/26
     */
    public function info(){
        $res = $this->t_service_shop_model->get($_REQUEST['shop_id']);
        $this->viewdata['shoprecommend'] = $this->url_config['shoprecommend']."&service_id=".$_GET['service_id']."&shop_id=".$_REQUEST['shop_id'];
        $this->viewdata['shopinfo'] = $this->url_config['shopinfo']."&service_id=".$_GET['service_id']."&shop_id=".$_REQUEST['shop_id'];
        $this->viewdata['shopgoods'] = $this->url_config['shopgoods']."&service_id=".$_GET['service_id']."&shop_id=".$_REQUEST['shop_id'];
        $this->viewdata['title'] = $res->shop_name;
        $this->viewdata['page_name'] = "到店体验";
        if($this->user_id==""){
            $this->viewdata['is_like'] = "0";
        }else{
            $this->viewdata['is_like'] = $this->t_like_service_shop_model->is_like($this->user_id,$_REQUEST['shop_id']);
        }
        $this->load->view($this->view_config['shopinfo'],$this->viewdata);	
    }
    /**
     *description:店长推荐
     *author:yanyalong
     *date:2014/06/22
     */
    public function recommend(){
        $res = $this->t_service_shop_model->get($_REQUEST['shop_id']);
        $this->viewdata['shoprecommend'] = $this->url_config['shoprecommend']."&service_id=".$_GET['service_id']."&shop_id=".$_REQUEST['shop_id'];
        $this->viewdata['shopinfo'] = $this->url_config['shopinfo']."&service_id=".$_GET['service_id']."&shop_id=".$_REQUEST['shop_id'];
        $this->viewdata['shopgoods'] = $this->url_config['shopgoods']."&service_id=".$_GET['service_id']."&shop_id=".$_REQUEST['shop_id'];
        $this->viewdata['title'] = $res->shop_name;
        $this->viewdata['page_name'] = "店长推荐";
        if($this->user_id==""){
            $this->viewdata['is_like'] = "0";
        }else{
            $this->viewdata['is_like'] = $this->t_like_service_shop_model->is_like($this->user_id,$_REQUEST['shop_id']);
        }
        $this->load->view($this->view_config['shoprecommend'],$this->viewdata);	
    }
    /**
     *description:门店商品
     *author:yanyalong
     *date:2014/06/22
     */
    public function shopgoods(){
        $res = $this->t_service_shop_model->get($_REQUEST['shop_id']);
        $this->viewdata['shoprecommend'] = $this->url_config['shoprecommend']."&service_id=".$_GET['service_id']."&shop_id=".$_REQUEST['shop_id'];
        $this->viewdata['shopinfo'] = $this->url_config['shopinfo']."&service_id=".$_GET['service_id']."&shop_id=".$_REQUEST['shop_id'];
        $this->viewdata['shopgoods'] = $this->url_config['shopgoods']."&service_id=".$_GET['service_id']."&shop_id=".$_REQUEST['shop_id'];
        $this->viewdata['title'] = $res->shop_name;
        $this->viewdata['page_name'] = "店铺商品";
        if($this->user_id==""){
            $this->viewdata['is_like'] = "0";
        }else{
            $this->viewdata['is_like'] = $this->t_like_service_shop_model->is_like($this->user_id,$_REQUEST['shop_id']);
        }
        $this->load->view($this->view_config['shopgoods'],$this->viewdata);	
    }
    /**
     *description:联系我们
     *author:yanyalong
     *date:2014/04/26
     */
    public function index(){
        $this->viewdata['title'] = "联系我们";
        $this->load->view($this->view_config['shopindexinfo'],$this->viewdata);	
    }
    /**
     *description:我关注的店铺
     *author:yanyalong
     *date:2014/06/27
     */
    public function likelist(){
        $this->checkLogin();
        $this->viewdata['title'] = "我关注的店铺";
        $this->load->view($this->view_config['shoplikes'],$this->viewdata);	
    }
}


