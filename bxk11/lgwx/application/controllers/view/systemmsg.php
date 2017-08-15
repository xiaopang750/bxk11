<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:系统消息管理
 *author:yanyalong
 *date:2014/04/21
 */
class  Systemmsg extends   MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("t_user_notice_model");
    }
    /**
     *description:系统消息管理列表
     *author:yanyalong
     *date:2014/04/21
     */
    public function getlist(){
        $this->CheckAccessByKey('system_notice_list');
        $p= isset($_POST['p'])?$_POST['p']:'1';
        $num= isset($_POST['num'])?$_POST['num']:'10';
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        $res = $this->t_user_notice_model->getListByService($service_id,$p,$num);
        if($res==false) echojson(1,"","无相关数据");
        $count_res = $this->t_user_notice_model->getListByService($service_id);
        $data['count'] = count($count_res);
        $data['current_count'] = count($res);
        foreach ($res as $key=>$val) {
           $data['notice_list'][$key]['notice_id'] = $val->notice_id;
           $data['notice_list'][$key]['notice_title'] = $val->notice_title;
           $data['notice_list'][$key]['notice_content'] = $val->notice_content;
        }
        echojson(0,$data);
    }
}



