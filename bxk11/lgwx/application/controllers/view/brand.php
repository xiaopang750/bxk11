<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:品牌管理 
 *author:yanyalong
 *date:2014/03/20
 */
class Brand extends   MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('t_service_brands_apply_model');
        $this->load->model('t_system_class_model');
        $this->load->model('t_product_brands_model');
        $this->load->model('t_product_class_brands_model');
    }
    /**
     *description:获取产品品类
     *author:yanyalong
     *date:2014/04/01
     */
    public function getclass(){
        loadLib('SystemClass');
        //产品类型是12
        $classType = "12";
        $columnArr = array('s_class_id'=>'class_id','s_class_name'=>'class_name');
        $classList = SystemClassFactory::creatObj($classType,$columnArr);
        ($classList)?echojson("0",$classList):echojson('1',"","没有相关数据"); 
    }
    /**
     *description:添加
     *author:yanyalong
     *date:2014/04/03
     */
    public function add(){
        $this->CheckAccessByKey('brand_add');
        $data['apply_brand_name'] = ""; 
        $data['apply_brand_ename'] = "";
        $data['apply_license_begin'] = "";
        $data['apply_license_end'] =  "";
        $data['apply_license_file'] =  "";
        $data['apply_brand_seodesc'] = ""; 
        $data['apply_brand_img'] = "";
        loadLib('ProductClass');
        $_classList = ProductClassFactory::getProductClass(0);
        foreach ($_classList as $key=>$val) {
            $classList[$key]['class_id']  = $val->pc_id; 
            $classList[$key]['class_name']  = $val->pc_name; 
        }
        $data['classlist'] = $classList;
        echojson(0,$data);
    }
    /**
     *description:编辑
     *author:yanyalong
     *date:2014/04/03
     */
    public function edit(){
        $this->CheckAccessByKey('brand_edit');
        safeFilter();
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        $apply_id= isset($_POST['apply_id'])?$_POST['apply_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $res = $this->t_service_brands_apply_model->get($apply_id);
        loadLib('ProductClass');
        $_classList = ProductClassFactory::getProductClass(0);
        $data['apply_brand_name'] = $res->apply_brand_name;
        $data['apply_brand_ename'] = $res->apply_brand_ename;
        $data['apply_license_begin'] = (strtotime($res->apply_license_begin)!=false)?$res->apply_license_begin:"";
        $data['apply_license_end'] = (strtotime($res->apply_license_end)!=false)?$res->apply_license_end:"";
        $uploads_config= $this->config->item('serviceBrandLicense');
        $data['apply_license_file'] =  ($res->apply_license_file!="")?$uploads_config['relative_upload'].$res->apply_license_file:"";
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
        $data['classlist'] = $classList;
        echojson(0,$data);
    }
    /**
     *description:品牌管理
     *author:yanyalong
     *date:2014/04/03
     */
    public function getlist(){
        $this->CheckAccessByKey('brand_list');
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:"";
        $this->config->load('status');		
        $config = $this->config->item("apply_brand_search");		
        $apply_status= isset($_POST['status'])?$config[$_POST['status']]:$config['1'];
        if($service_id=="") echojson(0,"","操作异常");
        loadlib('ServiceBrandManage');
        $columnArr = array('apply_id'=>'apply_id','apply_brand_name'=>'apply_brand_name','apply_brand_img'=>'apply_brand_img','apply_status'=>'apply_status','apply_laudit_desc'=>'apply_laudit_desc');
        $brandlist= ServiceApplyBrandManageFactory::creatObj($service_id,$columnArr,true,$apply_status);
        $data['brand_add'] = $this->actionList->brand_add;
        $data['brandlist'] = ($brandlist)?$brandlist:'';
        ($brandlist)?echojson("0",$data):echojson('0',$data,"无相关品牌信息");
    }
    /**
     *description:品牌管理相关地址和数据
     *author:yanyalong
     *date:2014/04/02
     */
    public function brandurl(){
        $this->CheckAccessByKey('brand_list');
        $this->config->load('status');
        $apply_brand= $this->config->item('apply_brand');
        $data['brand_add'] = $this->actionList->brand_add;
        $brand_search = array();
        foreach ($apply_brand as $key=>$val) {
            $brand_search[$key]['id'] = $key;
            $brand_search[$key]['name'] = $val;
        }
        $data['brand_search'] = array_values($brand_search); 
        echojson(0,$data);
    }
    /**
     *description:获取品牌列表数据
     *author:yanyalong
     *date:2014/04/14
     */
    public function search(){
        $this->CheckAccessByKey('brand_list');
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:"";
        if($service_id=="") echojson(1,"","操作异常");
        loadlib('ServiceBrandManage');
        $columnArr = array('brand_id'=>'brand_id','apply_id'=>'apply_id','apply_brand_name'=>'brand_name','apply_brand_img'=>'apply_brand_img','apply_status'=>'apply_status','apply_laudit_desc'=>'apply_laudit_desc');
        $brandlist= ServiceApplyBrandManageFactory::creatObj($service_id,$columnArr,true,1);
        ($brandlist==false)?echojson('1',"","无相关品牌信息"):""; 
        foreach ($brandlist as $key=>$val) {
            $data[$key]['brand_id'] = $val['brand_id'];
            $data[$key]['brand_name'] = $val['brand_name'];
        }
        echojson("0",$data);
    }
    /**
     *description:获取经销商所有品牌所涉及分类
     *author:yanyalong
     *date:2014/04/14
     */
    public function classlist(){
        $this->CheckAccessByKey('brand_list');
        //获取品牌信息
        $_brandInfolist = $this->t_product_brands_model->getBrandInfoList();
        ($_brandInfolist==false)?echojson(1,"","无相关分类"):"";
        $_classArr = array();
        $i = 0;
        foreach ($_brandInfolist as $key=>$val) {
            $_classList = implode(',',explode('|',$val->apply_classid));
            $classList = $this->t_system_class_model->getSysClassListById($_classList);
            if($classList!=false){
                foreach ($classList as $keys=>$vals) {
                    if(!in_array($vals,$_classArr)){
                        $_classArr[] = $vals;
                        $data[$i]['class_id']= $vals->s_class_id;
                        $data[$i]['class_name']= $vals->s_class_name;
                        $i++;
                    }
                }
            }
        }
        echojson(0,$data);
    }
}


