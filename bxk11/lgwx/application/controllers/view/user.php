<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:获取用户权限菜单列表
 *author:yanyalong
 *date:2014/03/24
 */
class  user extends  MY_Controller {

    //这个是用来取top中是否打印还是返出 true 返出 无或flase打印
    protected $is_json; 
    function __construct(){
        parent::__construct();
        $this->load->model('t_service_module_action_model');        
        $this->load->model("t_service_user_model");
        $this->load->model("t_service_info_model");
    }
    /**
     *description:获取用户模块权限菜单
     *author:yanyalong
     *date:2014/03/24
     */
    public function action(){
        safeFilter();
        loadLib('ServiceUserAccess');
        ServiceUserAccessFactory::serviceModuleActionMenu();
    }
    /**
     *description:获取账户基本信息
     *author:yanyalong
     *date:2014/03/24
     */
    public function info(){
        $this->CheckAccessByKey('user_info');
        loadLib('ServiceInfo');
        ServiceInfoFactory::getServiceInfo();
    }
    /**
     *description:获取顶部菜单项
     *author:yanyalong
     *date:2014/03/25
     */
    public function top(){
        $data['logout'] = $this->actionList->loginOut;
        $data['password_mod'] = $this->actionList->service_user_mod;
        $data['service_user_name'] = (isset($_SESSION['service_user_name'])&&$_SESSION['service_user_name']!="")?$_SESSION['service_user_name']:"";
        $service_id = (isset($_SESSION['service_id'])&&$_SESSION['service_id']!="")?$_SESSION['service_id']:"";
        $service_info = $this->t_service_info_model->get($service_id);
        $data['service_name'] = $service_info->service_name;
        $data['index'] = $this->actionList->index;
        $service_info= $this->t_service_info_model->get($service_id);
        if($service_info->service_status<21){
            $data['join_status'] = "1";
        }elseif($service_info->service_status==23){
            $data['join_status'] = "1";
        }elseif($service_info->service_status==24){
            $data['join_status'] = "0";
        }else{
            $data['join_status'] = "0";
        }
        $data['to_certified']['action_url'] = $this->actionList->join_status;
        $h=date('G');
        if ($h<11) $greet = '早上好';
        else if ($h<13) $greet = '中午好';
        else if ($h<17) $greet = '下午好';
        else $greet = '晚上好';
        $data['welcome'] = $greet.",欢迎您";
        $data['new_fans']['title'] = "新增粉丝";
        $data['new_fans']['count'] = "0";
        $data['new_visit']['title'] = "今日到访";
        $data['new_visit']['count'] = "0";
        $data['new_like']['title'] = "今日收藏";
        $data['new_like']['count'] = "0";
        $data['new_apply']['title'] = "今日报名";
        $data['new_apply']['count'] = "0";
        $data['service_user_name'] = (isset($_SESSION['service_user_name'])&&$_SESSION['service_user_name']!="")?$_SESSION['service_user_name']:"";
        $this->load->model('t_user_notice_model');
        $res = $this->t_user_notice_model->getListByService($service_id,1,1);
        if($res==false) $data['new_notice'] = "当前无最新消息！";
        else $data['new_notice'] = $res[0]->notice_title;
        if($this->is_json) return $data; else echojson(0,$data);

    }
    /**
     *description:管理子账号列表数据
     *author:yanyalong
     *date:2014/03/25
     */
    public function getlist(){
        $this->CheckAccessByKey('user_list');
        $service_id = (isset($_SESSION['service_id'])&&$_SESSION['service_id']!="")?$_SESSION['service_id']:"";
        $this->t_service_user_model->service_id= $service_id;
        $res = $this->t_service_user_model->getServiceUserListById($service_id);
        $data = array();
        loadlib('ServiceShopManage');
        foreach ($res as $key=>$val) {
            $editurl = $this->actionList->user_edit."&uid=".$val->service_user_id;
            $delurl = $this->actionList->user_del;
            $is_manage = ($val->service_name==$val->service_user_name)?true:false; //当前遍历是否管理员 
            //如果当前登录帐号本人是管理员，则当前遍历是管理员的只显示编辑
            if($_SESSION['is_manage']&&$is_manage) $data[$key]['user_action'] = "<a href='$editurl'>编辑</a>";
            //不论当前登录帐号是否是管理员，只要遍历数据不是管理员数据则一定显示编辑和删除
            if(!$is_manage&&($val->service_user_id!=$_SESSION['service_user_id'])) $data[$key]['user_action'] = "<a href='$editurl'>编辑</a> | <a href='$delurl'>删除</a>";
            $_is_show = true;
            if((!$_SESSION['is_manage']&&$is_manage)||(!$_SESSION['is_manage']&&!$is_manage&&$val->service_user_id==$_SESSION['service_user_id'])){
                $_is_show = false;
            }
            //如果当前帐号不是管理员，且遍历数据数据是管理员则不显示数据
            if($_is_show){
                $data[$key]['user_name'] = $val->service_user_name;
                $data[$key]['user_realname'] = $val->service_user_realname;
                if($val->service_user_shop==""){
                    $data[$key]['user_shop'][] = "";
                }else{
                    ServiceShopManageFactory::creatObj($val->service_user_id);
                    $ShopList = ServiceShopManageFactory::searchServiceShopList(1,array('shop_id','shop_name'));
                    foreach (explode(',',$val->service_user_shop) as $keys=>$vals) {
                        $shop_select[$keys] = $vals;
                    }
                    foreach ($ShopList as $keys=>$vals) {
                        if(in_array($vals['shop_id'],$shop_select)){
                            $data[$key]['user_shop'][$keys] = $vals['shop_name'];
                        }
                    }
                }
                $user_actions = $this->t_service_module_action_model->getModuleActionlist($val->service_user_actions);
                $array_keys = array();
                foreach ($user_actions as $keys=>$vals) {
                    if(!in_array($vals->module_key,$array_keys)){
                        $data[$key]['user_module'][$keys]['module_key'] = $vals->module_key;
                        $data[$key]['user_module'][$keys]['module_name'] = $vals->module_name;
                        $array_keys[] = $vals->module_key;
                    } 
                }
            }
        }
        $list['list'] = $data;
        echojson(0,$list);
    }
    /**
     *description:获取经销商门店列表
     *author:yanyalong
     *date:2014/03/27
     */
    public function getShopList(){
        $this->CheckAccessByKey('shop_list');
        $service_user_id= isset($_SESSION['service_user_id'])?$_SESSION['service_user_id']:"";
        $this->load->model('t_service_user_model');
        loadlib('ServiceShopManage');
        ServiceShopManageFactory::creatObj($service_user_id);
        $ShopList = ServiceShopManageFactory::searchServiceShopList(1,array('shop_id','shop_name'));
        if($ShopList==false){
            echojson(1,$this->actionList->shop_add,"没有可选门店");
        }else{
            echojson(0,$ShopList);
        } 
    }
    /**
     *description:获取功能模块
     *author:yanyalong
     *date:2014/03/27
     */
    public function getModule(){
        $res = $this->t_service_module_action_model->get_modules();    
        $data = array();
        foreach ($res as $key=>$val) {
            $data[$key]['module_key'] = $val->module_key;
            $data[$key]['module_name'] = $val->module_name;
        }
        echojson(0,$data);
    }
    /**
     *description:根据功能模块获取子功能模块
     *author:yanyalong
     *date:2014/03/27
     */
    public function getAction(){
        $module_key = (isset($_POST['module_key'])&&$_POST['module_key']!="")?$_POST['module_key']:echojson(1,"","操作异常");
        //$module_key = "123456789121";
        $res = $this->t_service_module_action_model->getActionByModule($module_key);    
        if($res==false){echojson(1,'','无相关数据');}
        $data = array();
        foreach ($res as $key=>$val) {
            $data[$key]['action_key'] = $val->action_key;
            $data[$key]['action_name'] = $val->action_name;
        }
        echojson(0,$data);
    }
    /**
     *description:编辑子帐号数据
     *author:yanyalong
     *date:2014/03/27
     */
    public function edit(){
        $this->CheckAccessByKey('user_edit');
        //$_POST['service_user_id']= 1;
        $service_user_id = (isset($_POST['service_user_id'])&&$_POST['service_user_id']!="")?$_POST['service_user_id']:echojson(1,"","异常操作");
        $userInfo= $this->t_service_user_model->get($service_user_id);
        if($userInfo==false){
            echojson(1,"","无相关数据"); 
        }
        $serviceInfo = $this->t_service_info_model->get($userInfo->service_id);
        $data['is_manage'] = ($serviceInfo->service_name==$userInfo->service_user_name)?"1":"0";
        $data['user_name'] = $userInfo->service_user_name;
        $data['user_photo']=$userInfo->service_user_photo;
        $data['user_phone']=$userInfo->service_user_phone;
        $data['user_realname']= $userInfo->service_user_realname;
        $this->load->model('t_service_user_model');
        loadlib('ServiceShopManage');
        ServiceShopManageFactory::creatObj($service_user_id);
        $ShopList = ServiceShopManageFactory::searchServiceShopList(1,array('shop_id','shop_name'));
        foreach (explode(',',$userInfo->service_user_shop) as $key=>$val) {
            $shop_select[$key] = $val;
        }
        foreach ($ShopList as $key=>$val) {
            if(in_array($val['shop_id'],$shop_select)){
                $data['user_shop'][$key]['select'] = "1";
            }
            $data['user_shop'][$key]['shop_id'] = $val['shop_id'];
            $data['user_shop'][$key]['shop_name'] = $val['shop_name'];
        }
        $user_modules= $this->t_service_module_action_model->get_modules();    
        $user_actions = $this->t_service_module_action_model->getModuleActionlist($userInfo->service_user_actions);
        $user_module = array();
        foreach ($user_modules as $key=>$val) {
            foreach ($user_actions as $keys=>$vals) {
                if($vals->module_key==$val->module_key){
                    $data['user_module'][$key]['select'] ="1";
                }
            }
            $data['user_module'][$key]['module_key'] = $val->module_key;
            $data['user_module'][$key]['module_name'] = $val->module_name;
        }
        echojson(0,$data);
    }
    /**
     *description:添加子帐号地址
     *author:yanyalong
     *date:2014/04/01
     */
    public function addurl(){
        $this->CheckAccessByKey('user_add');
        $this->config->load('url');
        $config = $this->config->item('url');
        echojson(0,$config['user_add']);
    }
    /**
     *description:获取用户信息修改数据
     *author:yanyalong
     *date:2014/05/25
     */
    public function userinfo(){
        $service_user_id= isset($_SESSION['service_user_id'])?$_SESSION['service_user_id']:'';

        $serviceUserInfo = $this->t_service_user_model->get($service_user_id);
        $data['service_user_id'] = $serviceUserInfo->service_user_id;
        $data['service_user_phone'] = $serviceUserInfo->service_user_phone;
        $data['service_user_email'] = $serviceUserInfo->service_user_email;
        echojson(0,$data);
    }
}
