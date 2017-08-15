<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:门店管理类
 *author:yanyalong
 *date:2014/03/26
 */
class ServiceShopManage{
    private $service_user_id;
    private $service_user_info;
    private $shopList;
    private $service_shop_status_config;
    private $service_shop_action_name;
    private $service_shop_action;
    private $service_shop;
    private $service_shop_search;
    public function __construct($service_user_id){
        $this->service_user_id = $service_user_id;
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        $this->service_id= $service_id;
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_shop_model');
        $this->CI->load->model('t_service_user_model');
        $this->CI->load->model('t_service_info_model');
        $this->CI->config->load('status');
        $this->service_shop_status= $this->CI->config->item('service_shop_status');
        $this->service_shop_action_name= $this->CI->config->item('service_shop_action_name');
        $this->service_shop_action= $this->CI->config->item('service_shop_action');
        $this->service_shop= $this->CI->config->item('service_shop');
        $this->service_shop_search= $this->CI->config->item('service_shop_search');
        loadLib('ServiceUserAccess');
        $this->actionList = ServiceUserAccessFactory::getActionUrlList();
    }    
    /**
     *description:获取经销商用户基本信息
     *author:yanyalong
     *date:2014/03/26
     */
    public function getServiceUserInfo(){
        $this->service_user_info = $this->CI->t_service_user_model->get($this->service_user_id);
        if($this->service_user_info==false){
            echojson(1,"数据异常");exit;
        }
    }
    /**
     *description:获取门店列表
     *author:yanyalong
     *date:2014/03/26
     */
    public function getServiceShopList(){
        $this->getServiceUserInfo();
         $this->shopList = $this->CI->t_service_shop_model->getShopList($this->service_id,"",true);
    }
    /**
     *description:获取门店列表
     *author:yanyalong
     *date:2014/03/26
     */
    public function ShopList(){
        $this->getServiceUserInfo();
        $this->shopList = $this->CI->t_service_shop_model->getShopListById($this->service_id,"",true);
    }

    /**
     *description:根据门店状态筛选门店列表
     *author:yanyalong
     *date:2014/03/26
     */
    public function searchServiceShopList($status){
        $this->getServiceShopList();
        if(!is_array($this->shopList)){
            $this->shopList = false;
            return;
        }
        foreach ($this->shopList as $key=>$val) {
            $service_shop_search= explode(',',$this->service_shop_search[$status]);
            if(!in_array($val->shop_status,$service_shop_search)){
                unset($this->shopList[$key]);
            }
        }
        $this->shopList = array_values($this->shopList);
    }
    /**
     *description:根据门店状态筛选门店列表(仅id，名称)
     *author:yanyalong
     *date:2014/03/26
     */
    public function getServiceShopListByStatus($status,$columnArr){
        $this->getServiceShopList();
        if(!is_array($this->shopList)){
            $this->shopList = false;
            return;
        }
        foreach ($this->shopList as $key=>$val) {
            $service_shop_search= explode(',',$this->service_shop_search[$status]);
            if(!in_array($val->shop_status,$service_shop_search)){
                unset($this->shopList[$key]);
            }
        }
        $ShopList = array();
        foreach ($this->shopList as $key=>$val) {
            foreach ($columnArr as $keys=>$vals) {
                $ShopList[$key][$vals] = $val->$vals;
            }
        }
        $this->shopList = array_values($ShopList);
    }
    public function returnShopList(){
        return $this->shopList;  
    }
    /**
     *description:获取门店管理列表
     *author:yanyalong
     *date:2014/03/26
     */
    public function getServiceShopManageList(){
        loadlib('Area');
        if($this->shopList==false) return false;
        foreach ($this->shopList as $key=>$val) {
            $province = GetAreaListFactory::getAreaInfoByCode($val->shop_province_code)->district_name;
            $city = GetAreaListFactory::getAreaInfoByCode($val->shop_city_code)->district_name;
            $shoplist[$key]['number'] = strval($key+1);
            $shoplist[$key]['shop_id'] = $val->shop_id;
            $shoplist[$key]['shop_name'] = $val->shop_name;
            $shoplist[$key]['shop_address'] = $province.$city.$val->shop_address;
            $shoplist[$key]['shop_status'] = $this->service_shop_status[$val->shop_status];
            //操作项
            $service_shop_action= explode('|',$this->service_shop_action[$val->shop_status]);
            $shoplist[$key]['shop_action'] = "";
            $service_info= $this->CI->t_service_info_model->get($this->service_id);
            foreach ($service_shop_action as $keys=>$vals) {
                if($vals!=""){
                    $actionUrl = $this->actionList->$vals."&shopid=".$val->shop_id;
                    if($this->actionList->$vals!=""){
                        if($vals=="shop_del"){
                            $shoplist[$key]['shop_action'].= "<a href='$actionUrl' sc='remove'  scid='$val->shop_id'>".$this->service_shop_action_name[$vals]."</a>";
                        }elseif($vals=="shop_down"){
                            $shoplist[$key]['shop_action'].= "<a href='$actionUrl' sc='closeshop'  scid='$val->shop_id'>".$this->service_shop_action_name[$vals]."</a>";
                        }elseif($vals=="shop_certified"){
                            if($service_info->service_status<"21"){
                                $shoplist[$key]['shop_action'].= "<a href='$actionUrl'>".$this->service_shop_action_name[$vals]."</a>";
                            }else{
                                $shoplist[$key]['shop_action'].= "";
                            }
                        }elseif($vals=="shop_clear"){
                            $shoplist[$key]['shop_action'].= "<a href='$actionUrl'>".$this->service_shop_action_name[$vals]."</a>";
                        }else{
                        $shoplist[$key]['shop_action'].= "<a href='$actionUrl'>".$this->service_shop_action_name[$vals]."</a>";
                        }
                    }else{
                        $shoplist[$key]['shop_action'].= "<a href='#' title='$val->shop_laudit_desc'>".$this->service_shop_action_name[$vals]."</a>";
                    }
                    if($keys<count($service_shop_action)-1){
                        if($vals=="shop_certified"&&$service_info->service_status>"20"){
                            $shoplist[$key]['shop_action'].= "";
                        }else{
                            $shoplist[$key]['shop_action'].= "&nbsp;|&nbsp;";
                        }
                    }
                }
            }
        }
        $data['shoplist'] = $shoplist;
        return $data;
    }
}
/**
 *description:经销商门店管理工厂
 *author:yanyalong
 *date:2014/03/26
 */
class ServiceShopManageFactory{
    private $service_user_id;
    private $ServiceShopManage;
    //生成
    public function creatObj($service_user_id){
        $this->service_user_id = $service_user_id;
        $this->ServiceShopManage = new ServiceShopManage($this->service_user_id);
    }
    public function getServiceShopManageList(){
        $this->ServiceShopManage->ShopList();
        return $this->ServiceShopManage->getServiceShopManageList();
    }
    public function searchServiceShopManageList($status){
        $this->ServiceShopManage->searchServiceShopList($status);
        return $this->ServiceShopManage->getServiceShopManageList();
    }
    public function searchServiceShopList($status,$columnArr){
        $this->ServiceShopManage->searchServiceShopList($status);
        $this->ServiceShopManage->getServiceShopListByStatus($status,$columnArr);
        return $this->ServiceShopManage->returnShopList();
    }
}
