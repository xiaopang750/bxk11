<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description: 全局页面加载中转控制器
 *author:yanyalong
 *date:2014/03/20
 */
class Index extends   MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("t_service_shop_model");
    }
    /**
     *description:切换门店
     *author:yanyalong
     *date:2014/04/04
     */
    public function changeshop(){
        $shop_id = (isset($_POST['shopid'])&&$_POST['shopid']!="")?$_POST['shopid']:echojson(1,"","异常操作");
        $res = $this->t_service_shop_model->get($shop_id);
        $_SESSION['shop_id'] = $shop_id;
        $_SESSION['shop_name'] = $res->shop_name;
        $url = $this->actionList->user_info;
        echojson(0,$url,"切换成功");
    }
}


