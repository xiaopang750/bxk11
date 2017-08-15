<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:企业信息
 *author:yanyalong
 *date:2014/04/08
 */
class  service extends  MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('t_service_info_model');
        //$this->load->model('t_vas_list_model');
        //$this->load->model('t_aleady_pay_vas_model');
        $this->load->model("t_service_wap_slide_model");
        $this->load->model("t_information_type_model");
        $this->load->model("t_service_information_model");
        $this->load->model("t_service_shop_model");
    }
    /**
     *description:企业基本信息设置
     *author:yanyalong
     *date:2014/05/06
     */
    public function serviceSet(){
        $this->CheckAccessByKey('service_set');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        $res = $this->t_service_info_model->get($service_id);
        if($res==false) echojson(1,"","数据异常");
        if($res->service_status<21)  $data['join_status'] = "1"; //开放企业邮箱，职务，手机号码，企业概述修改 
        if(in_array($res->service_status,array(21,22,24)))  $data['join_status'] = "21"; //开放所有修改 
        if(in_array($res->service_status,array(23)))  $data['join_status'] = "23";//开放企业概述修改
        $data['service_company'] = $res->service_company;
        $data['service_email'] = $res->service_email;
        $data['service_logo'] = $res->service_logo;
        $data['service_license_code'] = $res->service_license_code;
        $data['service_organization_code'] = $res->service_organization_code;
        $data['service_person'] = $res->service_person;
        $data['service_person_work'] = $res->service_person_work;
        $data['service_person_phone'] = $res->service_person_phone;
        $data['service_desc'] = $res->service_desc;
        echojson(0,$data);
    }
    /**
     *description:增值服务管理
     *author:yanyalong
     *date:2014/05/11
     */
    public function vas_list(){
        $this->CheckAccessByKey('vas_list');
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:"";
        $p= isset($_POST['p'])?$_POST['p']:"1";
        $num= isset($_POST['num'])?$_POST['num']:"10";
        $type= isset($_POST['type'])?$_POST['type']:"vas";
        if($type=="vas"){
            //平台增值服务项
            $vas_list= $this->t_vas_list_model->getVasList("",$p,$num);
            $countres = $this->t_vas_list_model->getVasList();
            if($countres!=false) $vas['count'] = count($countres);
            else $vas['count'] = 0;
            if($vas_list!=false) $vas['current_count'] = count($vas_list);
            else $vas['current_count'] = 0;
            if($vas_list==false){
                $vas['list'] = "";
            }
            foreach ($vas_list as $key=>$val) {
                $vas['list'][$key]['vas_id'] = $val->vas_id;
                $vas['list'][$key]['vas_name'] = $val->vas_name;
                $vas['list'][$key]['vas_price'] = $val->vas_price;
                $vas['list'][$key]['vas_unit'] =$val->vas_unit;
                $vas['list'][$key]['vas_status'] = $val->status;
            }
            $data = $vas;
        }else{
            //已购增值服务
            $apv_list= $this->t_aleady_pay_vas_model->getApvList($service_id,$p,$num);
            $countres = $this->t_aleady_pay_vas_model->getApvList($service_id);
            if($countres!=false) $apv['count'] = count($countres);
            else $apv['count'] = 0;
            if($apv_list!=false) $apv['current_count'] = count($apv_list);
            else $apv['current_count'] = 0;
            if($apv_list==false){
                $apv['list'] = "";
            }
            foreach ($apv_list as $key=>$val) {
                $apv['list'][$key]['apv_id'] = $val->apv_id;
                $apv['list'][$key]['vas_name'] = $val->vas_name;
                $apv['list'][$key]['vas_price'] = $val->apv_price;
                $apv['list'][$key]['vas_status'] = $val->status;
                $apv['list'][$key]['apv_addtime'] = $val->apv_addtime;
                $apv['list'][$key]['vas_unit'] = $val->vas_unit;
            }
            $data = $apv;
        }
        $data['type'] = $type;
        echojson(0,$data);
    }
    /**
     *description:新增幻灯片页面数据
     *author:yanyalong
     *date:2014/05/25
     */
    public function slide_add(){
        $url = $this->actionList->slide_list;
        $shop_id = (isset($_POST['shop_id']))?$_POST['shop_id']:echojson(1,$url,"参数错误");
        $res = $this->t_service_shop_model->get($shop_id);
        $data = array(
            "slide_id"=>"",
            "slide_title"=>"",
            "slide_type"=>"",
            "slide_url"=>"",
            "slide_pic"=>"",
            "shop_id"=>$shop_id,
            "shop_name"=>$res->shop_name
        );
        echojson(0,$data);
    }
    /**
     *description:编辑幻灯片
     *author:yanyalong
     *date:2014/05/25
     */
    public function slide_edit(){
        //$_POST['slide_id'] = 1;
        $url = $this->actionList->slide_list;
        $slide_id = (isset($_POST['slide_id']))?$_POST['slide_id']:echojson(1,$url,"参数错误");
        $this->config->load('uploads');	
        $config = $this->config->item("serviceFlash");
        $res = $this->t_service_wap_slide_model->get($slide_id);
        $shopR = $this->t_service_shop_model->get($res->shop_id);
        $data = array(
            "slide_id"=>$slide_id,
            "slide_title"=>$res->slide_title,
            "slide_type"=>$res->slide_type,
            "slide_url"=>$res->slide_url,
            "shop_id"=>$res->shop_id,
            "shop_name"=>$shopR->shop_name,
            "slide_pic"=>$config['relative_thumb_1_path'].$res->slide_pic
        );
        echojson(0,$data);
    }
    /**
     *description:幻灯片列表数据
     *author:yanyalong
     *date:2014/05/25
     */
    public function slide_list(){
        $service_id = $_SESSION['service_id'];
        $shop_id = isset($_POST['shop_id'])?$_POST['shop_id']:'';
        $resShop = $this->t_service_shop_model->getShopInfoByServiceId($service_id);
        $data = array();
        if(!$shop_id){
            $data['add_url'] = $this->actionList->slide_add."&shop_id=".$shop_id;
            if(!$resShop) echojson('0',$data,'无相关数据');
            else
                $shop_id = $resShop[0]->shop_id;
        }

        $data['shop_list'] = array();
        if($resShop){
            foreach ($resShop as $ke=>$value) {
                if($value->shop_id == $shop_id)
                    $shop['selected'] = 1;
                else
                    $shop['selected'] = 0;
                $shop['shop_id'] = $value->shop_id;
                $shop['shop_name'] = $value->shop_name;
                array_push($data['shop_list'], $shop);
            }
        }

        $res = $this->t_service_wap_slide_model->getSlideListByService($service_id,0,$shop_id);

        if($res==false){
            $data['slide_list'] = '';
            $data['add_url'] = $this->actionList->slide_add."&shop_id=".$shop_id;
            echojson(0,$data,"无相关数据");
        }else{
            $this->config->load('uploads');	
            $config = $this->config->item("serviceFlash");
            foreach ($res as $key=>$val) {
                $data['slide_list'][$key]['slide_id'] = $val->slide_id;
                $data['slide_list'][$key]['slide_title'] = $val->slide_title;
                $data['slide_list'][$key]['slide_pic'] = $config['relative_thumb_1_path'].$val->slide_pic;
            }
        } 
        $data['edit_url'] = $this->actionList->slide_edit."&shop_id=".$shop_id."&slide_id=";
        $data['add_url'] = $this->actionList->slide_add."&shop_id=".$shop_id;
        echojson(0,$data);
    }

     /**
     *description:幻灯片门店列表数据
     *author:yanyalong
     *date:2014/05/25
     */
    public function slide_shop_list(){
        $service_id = $_SESSION['service_id'];
        $res = $this->t_service_shop_model->getShopInfoByServiceId($service_id);
        $data['shop_list'] = array();
        if($res==false){
            echojson(1,$data,"无相关数据");
        }else{
            foreach ($res as $key=>$val) {
                $shop['shop_id'] = $val->shop_id;
                $shop['shop_name'] = $val->shop_name;
                array_push($data['shop_list'], $shop);
            }
            echojson(0,$data);
        }
       
    }

    /**
     *description:获取资讯分类列表
     *author:yanyalong
     *date:2014/05/26
     */
    public function information_type(){
        $res = $this->t_information_type_model->getList();
        if($res==false) echojson(1,"","无分类");
        $data = array();
        foreach ($res as $key=>$val) {
           $data[$key]['it_id'] = $val->it_id;
           $data[$key]['it_name'] = $val->it_name;
        }
        echojson(0,$data);
    }
    /**
     *description:幻灯片选择资讯列表
     *author:yanyalong
     *date:2014/05/26
     */
    public function slide_information(){
        $this->CheckAccessByKey('information_list');
        $p= isset($_POST['p'])?$_POST['p']:'1';
        $num= isset($_POST['num'])?$_POST['num']:'10';
        $keywords = isset($_POST['keywords'])?$_POST['keywords']:'';
        $it_id= isset($_POST['it_id'])?$_POST['it_id']:'';
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        $res = $this->t_service_information_model->getList($service_id,$keywords,$p,$num,$it_id);
        $data['keywords'] = $keywords;
        if($res==false){
            $data['informationlist'] = "";
            $data['count'] = "0";
            $data['current_count'] = "0";
        }
        $count_res = $this->t_service_information_model->getList($service_id,$keywords,"","",$it_id);
        $data['count'] = count($count_res);
        $data['current_count'] = count($res);
        $this->config->load('uploads');		
        $uploads_config= $this->config->item('serviceInformation');
        foreach ($res as $key=>$val) {
            $data['informationlist'][$key]['si_id'] = $val->si_id;
            $data['informationlist'][$key]['si_title'] = $val->si_title;
            $data['informationlist'][$key]['si_pic'] = $uploads_config['relative_thumb_1_path'].$val->si_pic;
            $data['informationlist'][$key]['si_addtime'] = $val->si_addtime;
        }
        echojson(0,$data);
    }
}


