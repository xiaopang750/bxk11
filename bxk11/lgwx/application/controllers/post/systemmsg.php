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
    public function del(){
        $this->CheckAccessByKey('system_notice_list');
        safeFilter();
        $notice_list = isset($_POST['notice_id'])?$_POST['notice_id']:echojson(1,"","操作异常");
        $res = $this->t_user_notice_model->del_notices($notice_list);
        $url = $this->actionList->system_notice_list;
        ($res==true)?echojson(0,$url,"删除成功"):echojson(1,"","删除失败");
    }
}

