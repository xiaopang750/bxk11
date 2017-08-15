<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  goods extends  Wap_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('t_service_goods_model');
    }
    /**
     *description:在线商城
     *author:yanyalong
     *date:2014/04/25
     */
    public function getlist(){
        $service_id = isset($_GET['service_id'])?$_GET['service_id']:'';
        $this->viewdata['title'] = "在线商城";
        $this->load->view($this->view_config['goodslist'],$this->viewdata);	
    }
    /**
     *description:商品详情
     *author:yanyalong
     *date:2014/04/26
     */
    public function info(){
        $goods_id= isset($_GET['goods_id'])?$_GET['goods_id']:'';
        $res = $this->t_service_goods_model->get($goods_id);
        $this->viewdata['title'] = $res->goods_title;
        $this->load->view($this->view_config['goodsinfo'],$this->viewdata);	
    }
    /**
     *description:搭配套餐
     *author:yanyalong
     *date:2014/04/26
     */
    //public function getpacklist(){
        //$data['title'] = "商品搭配套餐-jia178移动营销自助平台";
        //$goods_id= isset($_GET['goods_id'])?$_GET['goods_id']:'';
        //$data['goodsinfourl'] = $this->url_config['goodsinfo']."&service_id=".$_GET['service_id']."&goods_id=".$goods_id;
        //$data['packlisturl'] = $this->url_config['packlist']."&service_id=".$_GET['service_id']."&goods_id=".$goods_id;
        //$data['roomlisturl'] = $this->url_config['roomlist']."&service_id=".$_GET['service_id']."&goods_id=".$goods_id;
        ////$data['goodsinfourl'] = $this->url_config['goodsinfo']."&service_id=".$_GET['service_id']."&openid=".$_GET['openid']."&goods_id=".$goods_id;
        ////$data['packlisturl'] = $this->url_config['packlist']."&service_id=".$_GET['service_id']."&openid=".$_GET['openid']."&goods_id=".$goods_id;
        ////$data['roomlisturl'] = $this->url_config['roomlist']."&service_id=".$_GET['service_id']."&openid=".$_GET['openid']."&goods_id=".$goods_id;
        //$this->load->view($this->view_config['packlist'],$data);	
    //}
    /**
     *description:相关案例
     *author:yanyalong
     *date:2014/04/26
     */
    //public function getroomlist(){
        //$data['title'] = "商品相关案例-jia178移动营销自助平台";
        //$goods_id= isset($_GET['goods_id'])?$_GET['goods_id']:'';
        //$data['goodsinfourl'] = $this->url_config['goodsinfo']."&service_id=".$_GET['service_id']."&goods_id=".$goods_id;
        //$data['packlisturl'] = $this->url_config['packlist']."&service_id=".$_GET['service_id']."&goods_id=".$goods_id;
        //$data['roomlisturl'] = $this->url_config['roomlist']."&service_id=".$_GET['service_id']."&goods_id=".$goods_id;
        ////$data['goodsinfourl'] = $this->url_config['goodsinfo']."&service_id=".$_GET['service_id']."&openid=".$_GET['openid']."&goods_id=".$goods_id;
        ////$data['packlisturl'] = $this->url_config['packlist']."&service_id=".$_GET['service_id']."&openid=".$_GET['openid']."&goods_id=".$goods_id;
        ////$data['roomlisturl'] = $this->url_config['roomlist']."&service_id=".$_GET['service_id']."&openid=".$_GET['openid']."&goods_id=".$goods_id;
        //$this->load->view($this->view_config['roomlist'],$data);	
    //}
    /**
     *description:我收藏的商品列表
     *author:yanyalong
     *date:2014/04/26
     */
    public function likelist(){
        $this->viewdata['title'] = "我收藏的商品";
        $this->load->view($this->view_config['goodslikes'],$this->viewdata);	
    }
    /**
     *description:热门排行
     *author:yanyalong
     *date:2014/06/23
     */
    public function hotrank(){
        $this->viewdata['title'] = "热门排行";
        $this->load->view($this->view_config['hotrank'],$this->viewdata);	
    }
    /**
     *description:热门排行
     *author:yanyalong
     *date:2014/06/23
     */
    public function newgoods(){
        $this->viewdata['title'] = "新品上市";
        $this->load->view($this->view_config['newgoods'],$this->viewdata);	
    }
}
