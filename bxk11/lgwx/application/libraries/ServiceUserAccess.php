<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:经销商页面权限验证类
 *author:yanyalong
 *date:2014/03/20
 */
class ServiceUserAccess{
    private $action_id;
    private $accessFlag;
    private $access;
    public function __construct($action_id){
        if($action_id==""){
            return true; 
        }
        loadLib('ServiceUserAccess');
        $this->actionList = ServiceUserAccessFactory::getActionUrlList();
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_user_model');
        $this->CI->load->model('t_service_level_role_model');
        $this->CI->load->model('t_service_info_model');
        $this->CI->load->model('t_service_module_action_model');
        $this->action_id        = $action_id; 
        $this->accessFlag       = false;
        $this->checkAccess();
        $this->getAccessFlagJson();
    }    
    /**
     *description:权限验证方法
     *author:yanyalong
     *date:2014/03/20
     */
    private function checkAccess(){
        $roleInfo =  $this->CI->t_service_user_model->getRoleByUserId($_SESSION['service_user_id']);
        if($roleInfo==false||($roleInfo->ra_auth==""&&$roleInfo->is_admin!=1)){
            echo "<script>alert('请联系管理员为您分配功能权限!') window.history.back()</script>";exit;	
        }
        if($roleInfo->is_admin!=1){
            $rolelist = $roleInfo->ra_auth;
        }else{
            $service_info = $this->CI->t_service_info_model->get($_SESSION['service_id']);
            $roleInfo =  $this->CI->t_service_level_role_model->getRoleByRank($service_info->la_rank);
            if($roleInfo==false||$roleInfo->la_auth==""){
                echo "<script>alert('没有检测到商户级别信息或未给该级别商户提供相关权限') window.history.back()</script>";exit;	
            }
            else $rolelist = $roleInfo->la_auth;
        }
        $this->accessFlag = (in_array($this->action_id,explode(',',$rolelist)))?true:false;
    }
    /**
     *description:权限验证结果输出
     *author:yanyalong
     *date:2014/03/20
     */
    private function getAccessFlagJson(){
        if($this->accessFlag==false){
            echo "<script>alert('请联系管理员为您分配更多功能权限！'); window.history.back();</script>";exit;
        }
    }
}

/**
 *description:非页面级操作权限验证，验证以页面key为准，比如删除品牌功能验证就可以直接使用key  brand_list 进行验证
 *author:yanyalong
 *date:2014/03/20
 */
class ServiceAccessByKey{
    private $action_key;
    private $accessFlag;
    private $access;
    public function __construct($action_key){
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_user_model');
        $this->CI->load->model('t_service_level_role_model');
        $this->CI->load->model('t_service_info_model');
        $this->CI->load->model('t_service_module_action_model');
        loadLib('ServiceUserAccess');
        $this->actionList = ServiceUserAccessFactory::getActionUrlList();
        $this->action_key        = $action_key; 
        $this->accessFlag       = false;
        $this->checkAccess();
        $this->getAccessFlagJson();
    }    
    /**
     *description:权限验证方法
     *author:yanyalong
     *date:2014/03/20
     */
    private function checkAccess(){
        $roleInfo =  $this->CI->t_service_user_model->getRoleByUserId($_SESSION['service_user_id']);
        if($roleInfo==false||($roleInfo->ra_auth==""&&$roleInfo->is_admin!=1))echojson(1,"","请联系管理员为您分配功能权限!");	
        if($roleInfo->is_admin!=1){
            $rolelist = $roleInfo->ra_auth;
        }else{
            $service_info = $this->CI->t_service_info_model->get($_SESSION['service_id']);
            $roleInfo =  $this->CI->t_service_level_role_model->getRoleByRank($service_info->la_rank);
            if($roleInfo==false||$roleInfo->la_auth=="") echojson(1,"","没有检测到商户级别信息或未给该级别商户提供相关权限!");	
            else $rolelist = $roleInfo->la_auth;
        }
        $actioninfo = $this->CI->t_service_module_action_model->getActionByKey($this->action_key);
        $this->accessFlag = (in_array($actioninfo->ma_id,explode(',',$rolelist)))?true:false;
    }
    /**
     *description:权限验证结果输出
     *author:yanyalong
     *date:2014/03/20
     */
    private function getAccessFlagJson(){
        ($this->accessFlag==true)?:echojson(1,"","请联系管理员以获取更多功能权限!");	
    }
}
/**
 *description:经销商权限验证类
 *author:yanyalong
 *date:2014/03/20
 */
class serviceModuleActionMenu{
    private $accessFlag;
    private $accessJson;
    public  $accessAction;

    public function __construct($accessJson=''){
        loadLib('ServiceUserAccess');
        $this->actionList = ServiceUserAccessFactory::getActionUrlList();
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_user_model');
        $this->CI->load->model('t_service_level_role_model');
        $this->CI->load->model('t_service_info_model');
        $this->CI->load->model('t_service_module_action_model');
        $this->accessFlag       = false;
        $this->accessJson       = $accessJson;
        $this->getMenu();
    }    
    /**
     *description:权限验证结果输出
     *author:yanyalong
     *date:2014/03/20
     */
    private function getMenu(){

        $roleInfo =  $this->CI->t_service_user_model->getRoleByUserId($_SESSION['service_user_id']);
        if($roleInfo==false||($roleInfo->ra_auth==""&&$roleInfo->is_admin!=1))echojson(1,"","对不起,您无相关权限!");	
        if($roleInfo->is_admin!=1){
            $rolelist = $roleInfo->ra_auth;
        }else{
            $service_info = $this->CI->t_service_info_model->get($_SESSION['service_id']);
            $roleInfo =  $this->CI->t_service_level_role_model->getRoleByRank($service_info->la_rank);
            if($roleInfo==false||$roleInfo->la_auth=="") echojson(1,"","没有检测到商户级别信息或未给该级别商户提供相关权限!");	
            else $rolelist = $roleInfo->la_auth;
        }
        //当前页面所在菜单的key
        $id = ((!isset($_REQUEST['id'])||$_REQUEST['id']==""))?64:$_REQUEST['id'];
        $actioninfo= $this->CI->t_service_module_action_model->get($id); 
        $menuinfo = $this->CI->t_service_module_action_model->get($actioninfo->ma_pid); 
        //获取菜单列表
        $actionlist = $this->CI->t_service_module_action_model->getActionByIdList($rolelist);
        $actionidlist = "";
        foreach ($actionlist as $key=>$val) {
            $actionidlist .= $val->ma_pid.",";  
        }
        $menulist = $this->CI->t_service_module_action_model->getActionByIdList(rtrim($actionidlist,","));

        foreach ($menulist as $key=>$val) {
            //获取当前菜单的第一个页面  
            $actioninfo = $this->CI->t_service_module_action_model->getActionById($val->ma_id);
            $ma_key = $actioninfo->ma_key;
            $val->ma_sid= $this->actionList->$ma_key;
        }
        $menuidlist = "";
        foreach ($menulist as $key=>$val) {
            $menuidlist .= $val->ma_pid.",";  
        }
        $modulelist = $this->CI->t_service_module_action_model->getActionByIdList(rtrim($menuidlist,","));
        $list = array();

        foreach ($modulelist as $key=>$val) {
            $list[$key]['module_name'] = $val->ma_name; 
            $list[$key]['module_img'] = $val->ma_pic;
            foreach ($menulist as $keys=>$vals) {
                if($val->ma_id==$vals->ma_pid){
                    $list[$key]['actions_list'][$keys]['actions_name'] = $vals->ma_name; 
                    $list[$key]['actions_list'][$keys]['actions_id'] = $vals->ma_sid;   
                    if($vals->ma_id==$menuinfo->ma_id){
                        $list[$key]['actions_list'][$keys]['select'] = '1';
                    }else{
                        $list[$key]['actions_list'][$keys]['select'] = '0'; 
                    }
                    if($val->ma_id == $menuinfo->ma_pid){
                        $list[$key]['select'] = '1';
                    }else{
                        $list[$key]['select'] = '0';
                    }
                }
            }
            $list[$key]['actions_list'] = array_values($list[$key]['actions_list']); 
        }
        $data['module_list'] = $list;
        $service_info= $this->CI->t_service_info_model->get($_SESSION['service_id']);
        //echo $service_info->service_logo;die;
        $data['service_logo'] ="/lgwx/static/system/lgwx/person.png";
       
        if($service_info->service_status<21){

            if($service_info->service_qr && file_exists($_SERVER['DOCUMENT_ROOT'].$service_info->service_qr)){
                $data['service_logo'] = $service_info->service_qr;
            }else{
                $data['service_logo'] ="/lgwx/static/system/lgwx/person.png";
            }
            $data['user_level'] = "认证客户";
            $data['join_status'] = "1";
        }elseif($service_info->service_status==23){
            $data['join_status'] = "1";
            $data['user_level'] = "认证中客户";
        }elseif($service_info->service_status==24){
            $data['join_status'] = "0";
            $data['user_level'] = "未认证客户";
            $data['to_certified']['action_name'] = "认证失败";
        }else{
            $data['join_status'] = "0";
            $data['user_level'] = "未认证客户";
            $data['to_certified']['action_name'] = "马上认证";
        }

        if($service_info->service_score && $service_info->service_score >=0){
            $data['service_score'] = $service_info->service_score;
        }else{
            $data['service_score'] = 0;
        }

        $roleInfo =  $this->CI->t_service_level_role_model->getRoleByRank($service_info->la_rank);

        $data['service_level']['la_name'] = $roleInfo->la_name;
        $data['service_level']['la_rank'] = $roleInfo->la_rank;

        //$data['current_menu'] = $menuinfo->ma_key;
        $data['to_certified']['action_url'] = $this->actionList->join_status;
        $weekarray=array("日","一","二","三","四","五","六");
        $data['currentdate'] = date("Y/m/d")." 星期".$weekarray[date("w")];
        $data['service_name'] = $service_info->service_name;
        if($this->accessJson) $this->accessAction = $data; else  echojson('0',$data);
    }
}

/**
 * 获取全局页面url地址
 **/
class GetActionUrlList{
    public $urlList; 
    function __construct(){
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_module_action_model');
        $this->ActionUrl();
    }
    /**
     *description:获取全局页面信息
     *author:yanyalong
     *date:2014/05/21
     */
    public function getActionList(){
        $res = $this->CI->t_service_module_action_model->getAction(); 
        if($res==false) echojson(1,"",'未检测到系统模块');
        $this->urlList = (object) 'urlList';
        foreach ($res as $key=>$val) {
            $ma_key = $val->ma_key;
            $this->urlList->$ma_key = '/'.APP_DIR.'/index.php/index/index?id='.$val->ma_id;
            if($val->ma_type==3){
                $this->urlList->$ma_key .= '&type=edit';
            }
            if($val->ma_type==4){
                $this->urlList->$ma_key .= '&type=certified';
            }
        }
    }
    /**
     *description:操作url地址信息
     *author:yanyalong
     *date:2014/05/21
     */
    public function ActionUrl(){
        $this->getActionList();
        $this->urlList->shop_del = '/'.APP_DIR.'/index.php/post/shop/del';
        //门店停业
        $this->urlList->shop_down = '/'.APP_DIR.'/index.php/post/shop/down';
        //门店停业
        $this->urlList->shop_open = $this->urlList->shop_edit;
        //取消门店申请
        $this->urlList->shop_clear = '/'.APP_DIR.'/index.php/post/shop/clear?unixtime='.time();
        //门店搜索
        $this->urlList->shop_search = '/'.APP_DIR.'/index.php/post/shop/search';
        //上架品牌
        $this->urlList->brand_up = $this->urlList->brand_edit;
        //品牌下架
        $this->urlList->brand_down = '/'.APP_DIR.'/index.php/post/brand/down';
        //取消品牌认证
        $this->urlList->brand_cancel = '/'.APP_DIR.'/index.php/post/brand/cancel?unixtime='.time();
        //删除品牌
        $this->urlList->brand_del = '/'.APP_DIR.'/index.php/post/brand/del';
        //品牌重新认证
        $this->urlList->apply_repeat = $this->urlList->brand_edit;
        //品牌认证失败原因
        $this->urlList->loser_cause = '';
        //公众号注册
        $this->urlList->weixin_regist_url = "http://mp.weixin.qq.com/cgi-bin/readtemplate?t=register/step1_tmpl&lang=zh_CN";
        //退出登录
        $this->urlList->loginOut = '/'.APP_DIR.'/index.php/post/login/loginout';
        //登录地址
        $this->urlList->service_login = '/'.APP_DIR.'/index.php/login/index';
        //登录地址
        $this->urlList->service_reg = '/'.APP_DIR.'/index.php/reg/index';
        //公众平台自定义菜单URL
        //$this->urlList->diy_menu_list = $this->urlList->diy_menu_list'?token=';
        //公众平台URL
        $this->urlList->api_url = '/'.APP_DIR.'/index.php/weixin/weixin/index?token=';
        //公众平台URL
        $this->urlList->weixin_edit = $this->urlList->weixin_edit.'&wid=';
        //删除系列
        $this->urlList->series_del = '/'.APP_DIR.'/index.php/post/series/del';

        //公众平台关注回复
        $this->urlList->follow_reply = $this->urlList->follow_reply.'&service_token=';
        //公众平台消息自动回复
        $this->urlList->msg_reply_list = $this->urlList->msg_reply_list.'&service_token=';
        //公众平台关键词自动回复
        $this->urlList->text_reply_list = $this->urlList->text_reply_list.'&service_token=';

    }
}

/**
 *description:经销商查看操作自己的信息
 *author:liguangping
 *date:2014/05/30
 */
class ServiceActionAccess{
    private $actionString;
    private $val_id;
    private $CI;
    public function __construct($id,$val_id){
        //当前页面所在菜单的key
        
        if((!isset($id)||$id=="")) return true;
        if((!isset($val_id)||$val_id=="")) return true;
        $this->CI = &get_instance();
        $actioninfo= $this->CI->t_service_module_action_model->get($id);
        if($actioninfo && $actioninfo->ma_key){
            $this->actionString = $actioninfo->ma_key;
            $this->val_id = $val_id;
            $this->accessAction();
           
        }else{
            return false;
        }
    }
    private function accessAction(){
        
        $config = C('status',$this->actionString);
        if(!$config) return false;
        $stringValue = $config;
        if(isset($stringValue) && $stringValue){    
            $id_key = $stringValue['id_key'];
            $model_value = $stringValue['model'];
            $service_id = $_SESSION['service_id'];
            $key = $stringValue['key'];
            $query = $this->CI->db->query("SELECT service_id FROM {$model_value} where {$key}={$this->val_id}")->row();
            if($query){
               if($query->service_id != $service_id){
                    $urlList = ServiceUserAccessFactory::getActionUrlList();
                    $url = $_SERVER['SERVER_ADDR'];
                    if(stripos($_SERVER['SERVER_ADDR'],"http://") === FALSE) $url = "http://".$_SERVER['SERVER_ADDR'];
                    $url = $url.$urlList->index;
                    jumpAjax('对不起,您无相关权限!',$url);
               }else{
                    return false;
               }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}

/**
 *description:经销商平台权限验证工厂
 *author:yanyalong
 *date:2014/03/20
 */
class ServiceUserAccessFactory{
    public static function checkServiceUserAccess($action_id){
        new ServiceUserAccess($action_id);
    }
    public static function CheckAccessByKey($action_key){
        new ServiceAccessByKey($action_key);
    }
    public static function serviceModuleActionMenu(){
        $serviceModuleActionMenu = new serviceModuleActionMenu();
        return $serviceModuleActionMenu->menu_list;
    }

    public static function CheckActionAccess($action_id,$action_val){
        new ServiceActionAccess($action_id,$action_val);
    }
    /**
     *description:获取所有url地址
     *author:yanyalong
     *date:2014/05/21
     */
    public static function getActionUrlList(){
        $GetActionUrlList = new GetActionUrlList();
        return $GetActionUrlList->urlList;
    }
}


