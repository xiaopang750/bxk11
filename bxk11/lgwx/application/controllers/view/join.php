<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:经销商加盟
 *author:yanyalong
 *date:2014/03/20
 */
class join extends   MY_Controller {
    private $t_service_info;
    function __construct(){
        parent::__construct();
        $this->load->model('t_service_info_model');
        $this->load->model('t_service_brands_apply_model');
        $this->load->model('t_product_class_brands_model');
        $this->load->model('t_service_shop_model');
        loadLib('ServiceJoinStatusCheck');
    }
    /**
     *description:加盟状态
     *author:yanyalong
     *date:2014/04/24
     */
    public function join_status(){
        $this->CheckAccessByKey('join_status');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $service_info= $this->t_service_info_model->get($service_id);
        $url= $this->actionList->join_step1;
        if($service_info->service_status<21) {
            $data['join_status'] = "您的认证申请审核已通过，请不要重复申请，如果企业认证信息发生变更，请联系客户专员";
            $data['join_url']= $this->actionList->index;
            $data['is_redirect'] = "0";
            $data['show_type'] = "1";
        }elseif($service_info->service_status<23){
            $data['join_status'] = "您还没有提交认证申请哦";
            $data['join_url']= $this->actionList->join_step1;
            $data['is_redirect'] = "1";
            $data['show_type'] = "";
        }elseif($service_info->service_status==23){
            $data['join_status'] = "";
            $data['join_url']= $this->actionList->join_step4;
            $data['is_redirect'] = "1";
            $data['show_type'] = "";
        }elseif($service_info->service_status==24){
            $data['join_status'] = "您的认证申请审核未通过";
            $data['join_url']= $this->actionList->join_step1;
            $data['is_redirect'] = "0";
            $data['show_type'] = "2";
        }
        $data['join_laudit_desc'] = $service_info->service_laudit_desc;
        echojson(0,$data);
    }
    /**
     *description:加盟信息
     *author:yanyalong
     *date:2014/05/05
     */
    public function step1(){
        $this->CheckAccessByKey('join_step1');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        $res = $this->t_service_info_model->get($service_id);
        if(!in_array($res->service_status,array(21,22,24))) //判断通行状态
            ServiceJoinStatusCheckFactory::createobj($res->service_status);//根据当前实际状态进行判断跳转地址
        $data['join_name'] = $res->service_company;
        $data['join_email'] = $res->service_email;
        $data['join_license_code'] = $res->service_license_code;
        $uploads_config= $this->config->item('serviceJoin');
        $data['join_license'] = ($res->service_license!="")?$uploads_config['relative_upload'].$res->service_license:"";
        $data['join_code'] = $res->service_organization_code;
        $data['join_person'] = $res->service_person;
        $data['join_person_work'] = $res->service_person_work;
        $data['join_phone'] = $res->service_person_phone;
        echojson(0,$data);
    }
    /**
     *description:加盟默认品牌添加信息
     *author:yanyalong
     *date:2014/05/05
     */
    public function step2(){
        $this->CheckAccessByKey('join_step2');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $res = $this->t_service_info_model->get($service_id);
        if(!in_array($res->service_status,array(21,22,24))) //判断通行状态
            ServiceJoinStatusCheckFactory::createObj($res->service_status);//根据当前实际状态进行判断跳转地址
        if($res->service_status!=22) echojson(1,$this->actionList->join_step1,"请您先完善您的企业信息");
        $res = $this->t_service_brands_apply_model->getApplyByServiceJoin($service_id,4);
        loadLib('ProductClass');
        $_classList = ProductClassFactory::getProductClass(0);
        if($res==false){
            $data['apply_brand_name'] = ""; 
            $data['apply_brand_ename'] = "";
            $data['apply_license_begin'] = "";
            $data['apply_license_end'] =  "";
            $data['apply_license_file'] =  "";
            $data['apply_brand_seodesc'] = ""; 
            $data['apply_brand_img'] = "";
            foreach ($_classList as $key=>$val) {
                $classList[$key]['class_id']  = $val->pc_id; 
                $classList[$key]['class_name']  = $val->pc_name; 
            }
        }else{
            $data['apply_brand_name'] = $res->apply_brand_name;
            $data['apply_brand_ename'] = $res->apply_brand_ename;
            $data['apply_license_begin'] = (strtotime($res->apply_license_begin)!=false)?$res->apply_license_begin:"";
            $data['apply_license_end'] = (strtotime($res->apply_license_end)!=false)?$res->apply_license_end:"";
            $uploads_config= $this->config->item('serviceBrandLicense');
            $data['apply_license_file'] = ($res->apply_license_file!="")?$uploads_config['relative_upload'].$res->apply_license_file:"";
            $data['apply_brand_seodesc'] = $res->apply_brand_seodesc;
            $brand_uploads_config= $this->config->item('serviceApplyBrand');
            $data['apply_brand_img'] = $brand_uploads_config['relative_upload'].$res->apply_brand_img;
            $classlist = $this->t_product_class_brands_model->getClassInfoByBrand($res->brand_id);
            $_classSelect = array();
            if(!empty($classlist)){
                foreach ($classlist as $key=>$val) {
                    $_classSelect[$key] = $val->pc_id;
                }
            }
            foreach ($_classList as $key=>$val) {
                if(in_array($val->pc_id,$_classSelect)){
                    $classList[$key]['select']  = '1';
                }
                $classList[$key]['class_id']  = $val->pc_id; 
                $classList[$key]['class_name']  = $val->pc_name; 
            }
        }
        $data['classlist'] = $classList;
        $brand_list = $this->t_service_brands_apply_model->getApplyBrandsByServiceId($service_id,2);
        if($brand_list!=false){ 
            foreach ($brand_list as $key=>$val) {
                $data['brand_list'][$key]['apply_id'] = $val->apply_id;
                $data['brand_list'][$key]['apply_brand_name'] = $val->apply_brand_name;
            }
        }else{
            $data['brand_list'] = "";
        }
        echojson(0,$data);
    }
    /**
     *description:添加实体店铺
     *author:yanyalong
     *date:2014/05/05
     */
    public function step3(){
        $this->CheckAccessByKey('join_step3');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $res = $this->t_service_info_model->get($service_id);
        if(!in_array($res->service_status,array(21,22,24))) //判断通行状态
            ServiceJoinStatusCheckFactory::createobj($res->service_status);//根据当前实际状态进行判断跳转地址
        if($res->service_status!=22) echojson(1,$this->actionList->join_step1,"请您先完善您的企业信息");
        $apply_brand_info = $this->t_service_brands_apply_model->getApplyByServiceJoin($service_id);
        if($apply_brand_info==false) echojson(1,$this->actionList->join_step2,"您还没有填写经营品牌哦");
        $res = $this->t_service_shop_model->getShopByServiceJoin($service_id,4);
        if($res==false){
            $data['shop_name'] = ""; 
            loadlib('Area');
            $data['shop_area']=GetAreaListFactory::getAreaList();
            $data['shop_address'] =  "";
            $data['shop_pic1'] =  "";
            $data['shop_pic2'] = ""; 
            $data['shop_pic3'] = "";
            $data['shop_explain'] =  "";
            $data['shop_longitude'] =  "";
            $data['shop_latitude'] =  "";
            $data['shop_tel'] =  "";
        }else{
            $uploads_config= $this->config->item('serviceShop');
            $data['shop_name'] = $res->shop_name; 
            loadlib('Area');
            $data['shop_area']=GetAreaListFactory::getAreaList($res->shop_province_code,$res->shop_city_code);
            $data['shop_address'] =  $res->shop_address;
            $data['shop_pic1'] = ($res->shop_pic1!="")?$uploads_config['relative_thumb_1_path'].$res->shop_pic1:"";
            $data['shop_pic2'] =($res->shop_pic2!="")?$uploads_config['relative_thumb_1_path'].$res->shop_pic2:"";
            $data['shop_pic3'] = ($res->shop_pic3!="")?$uploads_config['relative_thumb_1_path'].$res->shop_pic3:"";
            $data['shop_explain'] =  $res->shop_explain;
            $data['shop_longitude'] =  $res->shop_longitude;
            $data['shop_latitude'] =  $res->shop_latitude;
            $data['shop_tel'] =  $res->shop_tel;
        }
        $shop_list= $this->t_service_shop_model->getShopInfoByServiceId($service_id,3);
        if($shop_list!=false){ 
            foreach ($shop_list as $key=>$val) {
                $data['shop_list'][$key]['shop_id'] = $val->shop_id;
                $data['shop_list'][$key]['shop_name'] = $val->shop_name;
            }
        }else{
            $data['shop_list'] = "";
        }
        echojson(0,$data);
    }
    /**
     *description:提交认证成功后绑定公众号
     *author:yanyalong
     *date:2014/05/07
     */
    public function step4(){
        $this->CheckAccessByKey('join_step4');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") {
            session_unset(); 
            echojson(1,"","异常操作");
        }
        $res= $this->t_service_info_model->get($service_id);
        if(!in_array($res->service_status,array(23))) //判断通行状态
            ServiceJoinStatusCheckFactory::createobj($res->service_status);//根据当前实际状态进行判断跳转地址
        $data['add_weixin']= $this->actionList->weixin_add;
        $data['reg_weixin']= "https://mp.weixin.qq.com/";
        $data['skip']= $this->actionList->index;
        echojson(0,$data);
    }
}

