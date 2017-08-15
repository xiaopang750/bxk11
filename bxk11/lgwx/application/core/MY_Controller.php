<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:项目控制器父类
 *author:yanyalong
 *date:2014/03/20
 */
class MY_Controller extends CI_Controller{

    function __construct(){
        session_start();
        parent::__construct();
        $this->load->library('sm');
        $this->CheckLoginAndAccess();
        $_GET['id']= (isset($_GET['id'])&&$_GET['id']!="")?$_GET['id']:64;
        $this->config->load('view');
        $this->view_config= $this->config->item('action');
        $this->config->load('uploads');
        $this->CheckActionAccess();
        //loadLib('ServiceUserAccess');
        //ServiceUserAccessFactory::CheckActionAccess($_GET['id']);
    }
    /**
     *description:登录及权限验证
     *author:yanyalong
     *date:2014/03/20
     */
    private function CheckLoginAndAccess(){
        //登录验证
        loadLib('ServiceLogin');
        ServiceLoginFactory::checkServiceLogin();
        //验证权限
        $action_id= (isset($_GET['id']))?$_GET['id']:'';
        loadLib('ServiceUserAccess');
        ServiceUserAccessFactory::checkServiceUserAccess($action_id);
        //初始化全局url地址
        $this->actionList = ServiceUserAccessFactory::getActionUrlList();
    }
    /**
     *description:根据操作key非页面操作权限验证
     *author:yanyalong
     *date:2014/04/09
     */
    public function CheckAccessByKey($action_key){
        loadLib('ServiceUserAccess');
        ServiceUserAccessFactory::CheckAccessByKey($action_key);
    }

    public function CheckActionAccess(){

        if((!isset($_GET['id'])||$_GET['id']=="")) return false;
        $id = $_GET['id'];
        $actioninfo= model('t_service_module_action')->get($id);
        if($actioninfo && $actioninfo->ma_key){
            $actionString = $actioninfo->ma_key;

        }else{
            return false;
        }
        $config = C('status',$actionString);
        if((!isset($_GET[$config['id_key']])||$_GET[$config['id_key']]=="")) return false;
        $val_id = $_GET[$config['id_key']];
        loadLib('ServiceUserAccess');
        ServiceUserAccessFactory::CheckActionAccess($id,$val_id);

    }
}


/**
 *description:微信wap站父控制器
 *author:yanyalong
 *date:2014/03/13
 */
class Wap_Controller extends CI_Controller{
    function __construct(){
        session_start();
        parent::__construct();
        $this->load->library('sm');
        $this->load->model('t_wap_template_model');
        $this->load->model('t_service_wap_template_model');
        $this->config->load('wap_url');
        $this->url_config = $this->config->item('wap');
        $this->user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
        $service_template_info = $this->t_service_wap_template_model->getTemplateUseInfoByService($_REQUEST['service_id']);
        $wap_template = $this->t_wap_template_model->get($service_template_info->template_id);
        $this->viewdata['template_code'] = $wap_template->template_code;
        $this->config->load('wap_view');
        $this->view_config = $this->config->item('wapview');
        foreach ($this->view_config as $key=>$val) {
           $this->view_config[$key] = '/type1/views/'.$val;
        }
        if(!isset($_REQUEST['service_id'])){
            die("失效的链接地址，请从正常通道进入当前页面");
        }
        $_SESSION['wap_service_id'] = $_REQUEST['service_id'];
        $this->viewdata['index_url'] = $this->url_config['wapindex']."&service_id=".$_REQUEST['service_id'];
        $this->viewdata['user_url'] = $this->url_config['userspace']."&service_id=".$_REQUEST['service_id'];
        $this->viewdata['contact_us_url'] = $this->url_config['shopindexinfo']."&service_id=".$_REQUEST['service_id'];
        $this->viewdata['reg_spreader_url']= "http://".$_SERVER['HTTP_HOST']."/lgwx/index.php/reg/index?flg=".md5($_REQUEST['service_id']); 
    }
    /**
     *description:判断用户是否登录
     *author:yanyalong
     *date:2014/06/21
     */
    public function checkLogin(){
        $user_id = isset($_SESSION['user_id'])?$_SESSION['user_id']:"";
        if($user_id==""){
        $url = $this->url_config['login']."&service_id=".$_REQUEST['service_id'];
            if(strpos($_SERVER['REQUEST_URI'],"?")==false){
                $_SESSION['current_url'] = "http://".$_SERVER['HTTP_REFERER'];
                echojson(2,$url,"未登录");
            }else{
                $_SESSION['current_url'] = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                header("location:$url");exit;
            }
        }
    }
}

