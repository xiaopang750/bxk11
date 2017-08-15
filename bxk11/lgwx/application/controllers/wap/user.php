<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  User extends  Wap_Controller {
    function __construct(){
        parent::__construct();
    }
    /**
     *description:个人中心
     *author:yanyalong
     *date:2014/04/26
     */
    public function index(){
        if(isset($_SERVER['HTTP_REFERER'])){
            if(strpos($_SERVER['HTTP_REFERER'],"/sns/")==false){
                $_SESSION['backurl'] = $_SERVER['HTTP_REFERER'];
            }
        }else{
            $_SESSION['backurl'] = $this->url_config['wapindex']."&service_id=".$_REQUEST['service_id']; 
        }
        $this->checkLogin();
        $this->viewdata['title'] = "会员中心";
        $this->viewdata['backurl'] = $_SESSION['backurl'];
        $this->load->view($this->view_config['userspace'],$this->viewdata);	
    }
    /**
     *description:我的装修笔记
     *author:yanyalong
     *date:2014/06/22
     */
    public function notelist(){
        $this->checkLogin();
        $this->viewdata['title'] = "我的装修笔记";
        $this->load->view($this->view_config['notelist'],$this->viewdata);	
    }
    /**
     *description:登录授权页
     *author:yanyalong
     *date:2014/06/22
     */
    public function login(){
        if(isset($_SESSION['user_id'])&&($_SESSION['user_id']!="")){
            $url = "http://".$_SERVER['HTTP_REFERER'];
            header("location:$url");exit;
        }
        $this->viewdata['title'] = "会员登录";
        $this->viewdata['urllist'] = authorizeURL();
        $this->load->view($this->view_config['login'],$this->viewdata);	
    }
    /**
     *description:退出登录
     *author:yanyalong
     *date:2014/06/24
     */
    public function logout(){
       session_unset(); 
        $url = $this->url_config['wapindex']."&service_id=".$_REQUEST['service_id'];
        header("location:$url");exit;
    }
}
