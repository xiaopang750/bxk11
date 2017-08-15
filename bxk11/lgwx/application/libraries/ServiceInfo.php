<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:根据帐号id获取用户基本信息
 *author:yanyalong
 *date:2014/03/20
 */
class getServiceInfo{
    private $service_user_id;
    private $serviceInfo;
    public function __construct(){
        $this->service_user_id = (isset($_SESSION['service_user_id'])&&$_SESSION['service_user_id']!="")?$_SESSION['service_user_id']:"";
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_user_model');
        $this->CI->load->model('t_system_district_model');
        $this->setServiceInfoByUid();
        $this->getServiceInfoByUid();
    }    
    /**
     *description:根据帐号id获取用户基本信息
     *author:yanyalong
     *date:2014/03/20
     */
    private function setServiceInfoByUid(){
        $this->CI->t_service_user_model->service_user_id = $this->service_user_id;    
        $this->serviceInfo = $this->CI->t_service_user_model->getServiceInfoByUid();    
    }
    /**
     *description:获取账户基本信息
     *author:yanyalong
     *date:2014/03/24
     */
    private function getServiceInfoByUid(){
        $data = array();
        if($this->serviceInfo==false){
            echojson(1,"",'无相关结果');
        }else{
            $data['service_company']  = $this->serviceInfo->service_company;
            $data['service_phone']  = $this->serviceInfo->service_phone;
            $data['service_person']  = $this->serviceInfo->service_person;
            $data['service_ename']  = $this->serviceInfo->service_ename;
            $data['service_city']  = $this->serviceInfo->district_name;
            $this->CI->t_system_district_model->district_code=$this->serviceInfo->district_pcode;
            $data['service_province']  = $this->CI->t_system_district_model->getInfoByCode()->district_name; 
            $data['service_address']  = $this->serviceInfo->service_address;
            $data['service_license']  = $this->serviceInfo->service_license;
            $data['service_doc1']  = $this->serviceInfo->service_doc1;
            $data['service_doc2']  = $this->serviceInfo->service_doc2;
            $data['service_logo']  = $this->serviceInfo->shop_logo;
            $data['explain']  = $this->serviceInfo->shop_explain;
            $data['shop_id']  = $this->serviceInfo->shop_id;
            $data['service_company']  = $this->serviceInfo->service_company;
            $data['service_ename']  = $this->serviceInfo->service_ename;
            $data['service_user_id']  = $this->serviceInfo->service_user_id;
            $data['service_id']  = $this->serviceInfo->service_id;
            echojson(0,$data);
        }
    }
}
/**
 *description:获取帐号基本信息工厂
 *author:yanyalong
 *date:2014/03/20
 */
class ServiceInfoFactory{
    public static function getServiceInfo(){
        return new getServiceInfo();
    }
}

