<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:门店管理
 *author:yanyalong
 *date:2014/03/24
 */
class  shop extends  MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('t_service_shop_model');
        $this->load->model('t_service_shop_brands_model');
        $this->load->model('t_service_goods_model');
        $this->load->model('t_product_brands_series_model');
    }
    /**
     *description:门店管理
     *author:yanyalong
     *date:2014/03/24
     */
    public function getlist(){
        $this->CheckAccessByKey('shop_list');
        $service_user_id= isset($_SESSION['service_user_id'])?$_SESSION['service_user_id']:"";
        $status = isset($_POST['status']) && $_POST['status']?$_POST['status']:'1';
        $this->load->model('t_service_user_model');
        loadlib('ServiceShopManage');
        ServiceShopManageFactory::creatObj($service_user_id);
        $res = ServiceShopManageFactory::searchServiceShopManageList($status);
        $res['shop_add'] =$this->actionList->shop_add;
        if($res==false) echojson(0,$res,'无相关门店信息');
        if(!isset($res['shoplist'])) echojson(0,$res,'无相关门店信息'); else echojson(0,$res);
       
    }
    /**
     *description:获取经销商经营品牌
     *author:yanyalong
     *date:2014/03/26
     */
    public function getbrandlist(){
        $this->CheckAccessByKey('brand_list');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:"";
        $this->load->model('t_service_brands_apply_model');
        $brandsList = $this->t_service_brands_apply_model->getBrandsListByUid($service_id);
        if($brandsList==false){
            echojson(1,$this->actionList->brand_add,"无相关品牌,请先添加品牌");
        }else{
            foreach ($brandsList as $key=>$val) {
                $data[$key]['brand_id'] = $val->brand_id;
                $data[$key]['brand_name'] = $val->apply_brand_name;
            }
            echojson(0,$data);
        }
    }
    /**
     *description:门店添加数据获取
     *author:yanyalong
     *date:2014/03/26
     */
    public function add(){
        $this->CheckAccessByKey('shop_add');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $data['shop_name'] = ""; 
        loadlib('Area');
        $data['shop_area']=GetAreaListFactory::getAreaList();
        $data['shop_address'] =  "";
        $data['shop_pic1'] =  "";
        $data['shop_pic2'] = ""; 
        $data['shop_pic3'] = "";
        $data['shop_tel'] ="";
        $data['shop_explain'] =  "";
        $data['shop_longitude'] =  "";
        $data['shop_latitude'] =  "";
        echojson(0,$data);
    }
    /**
     *description:门店编辑数据获取
     *author:yanyalong
     *date:2014/03/26
     */
    public function edit(){
        $this->CheckAccessByKey('shop_edit');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:"";
        $shop_id = (isset($_POST['shopid'])&&$_POST['shopid']!="")?$_POST['shopid']:echojson(1,"","异常操作");
        $res = $this->t_service_shop_model->get($shop_id);
        if($res==false){
            echojson(1,"","无相关数据"); 
        }
        $this->config->load('uploads');		
        $uploads_config= $this->config->item('serviceShop');
        $data['shop_name'] = $res->shop_name; 
        loadlib('Area');
        $data['shop_area']=GetAreaListFactory::getAreaList($res->shop_province_code,$res->shop_city_code);
        $data['shop_address'] =  $res->shop_address;
        $data['shop_pic1'] =  ($res->shop_pic1!="")?$uploads_config['relative_thumb_1_path'].$res->shop_pic1:"";
        $data['shop_pic2'] =  ($res->shop_pic2!="")?$uploads_config['relative_thumb_1_path'].$res->shop_pic2:"";
        $data['shop_pic3'] =  ($res->shop_pic3!="")?$uploads_config['relative_thumb_1_path'].$res->shop_pic3:"";
        $data['shop_explain'] =  $res->shop_explain;
        $data['shop_longitude'] =  $res->shop_longitude;
        $data['shop_latitude'] =  $res->shop_latitude;
        $data['shop_tel'] =$res->shop_tel;
        echojson(0,$data);
    }
    /**
     *description:添加子帐号地址
     *author:yanyalong
     *date:2014/04/01
     */
    public function addurl(){
        //$this->CheckAccessByKey('user_add');
        $this->config->load('status');
        $service_shop= $this->config->item('service_shop');
        $data['shop_add'] =$this->actionList->shop_add;
        foreach ($service_shop as $key=>$val) {
            $shop_search[$key]['id'] = $key;
            $shop_search[$key]['name'] = $val;
        }
        $data['shop_search'] = array_values($shop_search); 
        loadLib('ServiceUserAccess');
        $data['shop_search_url'] = $this->actionList->shop_search;
        echojson(0,$data);
    }
    /**
     *description:未关联品牌
     *author:yanyalong
     *date:2014/05/07
     */
    public function shoptobrand(){
        $this->CheckAccessByKey('shop_edit');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        $shop_id= isset($_POST['shopid'])?$_POST['shopid']:echojson(1,"","没有接收到shopid");
        $this->load->model('t_service_brands_apply_model');
        $brands = $this->t_service_shop_brands_model->getBrandsByShop($shop_id);
        if($brands==false){
            $brands_select[0] = "";
        }else{
            foreach ($brands as $key=>$val) {
                $brands_select[$key] = $val->brand_id;
            }
        }
        $brandsList = $this->t_service_brands_apply_model->getBrandsListByUid($service_id);
        if($brandsList==false){
            echojson(1,"","没有可选品牌,请至少添加一条品牌");
        }else{
            $data['selectdbrands'] = "";
            $data['noselectdbrands'] = "";
            foreach ($brandsList as $key=>$val) {
                if(in_array($val->brand_id,$brands_select)){
                    $data['selectdbrands'][$key]['brand_id'] = $val->brand_id;
                    $data['selectdbrands'][$key]['brand_name'] = $val->apply_brand_name;
                }else{
                    $data['noselectdbrands'][$key]['brand_id'] = $val->brand_id;
                    $data['noselectdbrands'][$key]['brand_name'] = $val->apply_brand_name;
                }
            }
            if(!empty($data['selectdbrands'])){
            $data['selectdbrands'] = array_values($data['selectdbrands']);
            }
            if(!empty($data['noselectdbrands'])){
            $data['noselectdbrands'] = array_values($data['noselectdbrands']);
            }
            echojson(0,$data);
        } 
    }
} 
