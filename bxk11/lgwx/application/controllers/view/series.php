<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:系列管理
 *author:yanyalong
 *date:2014/04/08
 */
class  series extends  MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('t_product_brands_model');
        $this->load->model('t_service_goods_model');
        $this->load->model('t_system_class_model');
        $this->load->model('t_product_brands_series_model');
    }
    /**
     *description:添加系列
     *author:yanyalong
     *date:2014/04/08
     */
    public function add(){
        //$this->CheckAccessByKey('series_add');
        $brandid = isset($_POST['brand_id'])?$_POST['brand_id']:"";
        //获取品牌信息
        $_brandInfo = $this->t_product_brands_model->getBrandInfoById($brandid);
        if($_brandInfo==false) echojson(1,"","您选择的品牌不存在");
        $data['brand_name'] = $_brandInfo->brand_name;
        $data['series_id'] = "";
        $data['series_name'] = "";
        $data['series_ename'] = "";
        $data['series_seodesc'] = "";
        $data['series_img'] = "";
        //$_classList = implode(',',explode('|',$_brandInfo->apply_classid));
        //$classList = $this->t_system_class_model->getSysClassListById($_classList);
        //foreach ($classList as $key=>$val) {
        //$data['class_list'][$key]['class_id']  = $val->s_class_id; 
        //$data['class_list'][$key]['class_name']  = $val->s_class_name; 
        //}
        echojson(0,$data);
    }
    /**
     *description:编辑系列
     *author:yanyalong
     *date:2014/03/26
     */
    public function edit(){
        //$this->CheckAccessByKey('series_edit');
        //$_POST['seriesid']  = "79";
        $series_id= isset($_POST['series_id'])?$_POST['series_id']:"";
        $_series_info = $this->t_product_brands_series_model->get($series_id);
        if($_series_info == false) echojson(1,"","数据异常");
        //获取品牌信息
        $_brandInfo = $this->t_product_brands_model->getBrandInfoById($_series_info->brand_id);
        if($_brandInfo==false) echojson(1,"","您选择的品牌不存在");
        $data['brand_name'] = $_brandInfo->brand_name;
        $data['series_id'] = $_series_info->series_id;
        $data['series_name'] = $_series_info->series_name;
        $data['series_ename'] = $_series_info->series_ename;
        $data['series_seodesc'] = $_series_info->series_seodesc;;
        $this->config->load('uploads');		
        $config = $this->config->item("serviceBrandSeries");		
        $data['series_img'] = $config['relative_thumb_1_path'].$_series_info->series_img;
        echojson(0,$data);
    }
    /**
     *description:品牌系列列表
     *author:yanyalong
     *date:2014/04/08
     */
    public function getlist(){
        //$this->CheckAccessByKey('series_list');
        $data['series_add_url'] = $this->actionList->series_add;
        $data['series_edit_url'] = $this->actionList->series_edit;
        $data['series_del_url'] = $this->actionList->series_del;
        $data['goods_list_url'] = $this->actionList->goods_list;
        $data['goods_add_url'] = $this->actionList->goods_add;
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:"";
        loadlib('ServiceBrandManage');
        $columnArr = array('apply_id'=>'apply_id','apply_brand_name'=>'apply_brand_name','brand_id'=>'brand_id');
        $this->config->load('status');		
        $config = $this->config->item("apply_brand_search");		
        $apply_status= $config['1'];
        $brandlist= ServiceApplyBrandManageFactory::creatObj($service_id,$columnArr,true,$apply_status);
        if($brandlist==false){
            $data['brand_add'] = $this->actionList->brand_add;
            echojson(2,$data['brand_add'],"您至少需要添加一种品牌");
        }
        foreach ($brandlist as $key=>$val) {
            $data['brand_list'][$key]['brand_id'] = $val['brand_id'];
            $data['brand_list'][$key]['brand_name'] = $val['apply_brand_name'];
            $goods_list = $this->t_service_goods_model->getGoodsListByBrand($val['brand_id']);
            $data['brand_list'][$key]['goods_count'] = ($goods_list==false)?"0":count($goods_list);
            $res = $this->t_product_brands_series_model->getSeriesByBrand($service_id,$val['brand_id'],2);
            if($res==false){
                $data['brand_list'][$key]['series_list'] = "";
                $data['brand_list'][$key]['series_count'] = "0";
            }else{
                foreach ($res as $keys=>$vals) {
                    $data['brand_list'][$key]['series_list'][$keys]['series_id'] = $vals->series_id;
                    $data['brand_list'][$key]['series_list'][$keys]['series_name'] = $vals->series_name;
                }
                $data['brand_list'][$key]['series_count'] = count($res);
            }
        }
        echojson(0,$data);
    }
    /**
     *description:获取经销商系列列表数据
     *author:yanyalong
     *date:2014/04/14
     */
    public function search(){
        $this->CheckAccessByKey('flash_edit');
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:"";
        if($service_id=="") echojson(1,"","操作异常");
        loadlib('ServiceBrandManage');
        $columnArr = array('brand_id'=>'brand_id');
        $this->config->load('status');		
        $config = $this->config->item("apply_brand_search");		
        $apply_status= $config['1'];
        $brandlist= ServiceApplyBrandManageFactory::creatObj($service_id,$columnArr,true,$apply_status);
        if($brandlist==false){
            echojson(1,"","数据异常，您至少需要有一种已认证品牌");
        }
        $data = array();
        foreach ($brandlist as $key=>$val) {
            $res = $this->t_product_brands_series_model->getSeriesByBrand($service_id,$val['brand_id'],2);
            if($res!=false)
                foreach ($res as $keys=>$vals) {
                    $data[$keys]['series_id'] = $vals->series_id;
                    $data[$keys]['series_name'] = $vals->series_name;
                }
        }
        if(empty($data)) echojson(1,"","无相关数据");
        echojson(0,$data);
    }
    /**
     *description:获取经销商系列列表
     *author:yanyalong
     *date:2014/04/15
     */
    public function searchSeries(){
        $this->CheckAccessByKey('flash_edit');
        $brand_id= isset($_POST['brandid'])?$_POST['brandid']:'';
        $p= isset($_POST['p'])?$_POST['p']:'';
        $num= isset($_POST['num'])?$_POST['num']:'';
        $keywords= isset($_POST['keywords'])?$_POST['keywords']:'';
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:"";
        //$brand_id = 54;
        //$keywords="1";
        $res = $this->t_product_brands_series_model->getSeriesByBrand($service_id,$brand_id,2,$keywords,$p,$num);
        if($res==false) echojson(1,"","无相关数据");
        $res_count = $this->t_product_brands_series_model->getSeriesByBrand($service_id,$brand_id,2,$keywords);
        $this->config->load('uploads');		
        $series_config = $this->config->item("serviceBrandSeries");		
        if($res!=false)
            foreach ($res as $key=>$val) {
                $data['serieslist'][$key]['series_id'] = $val->series_id;
                $data['serieslist'][$key]['series_name'] = $val->series_name;
                $data['serieslist'][$key]['brand_name'] = $val->apply_brand_name;
                $data['serieslist'][$key]['series_img'] = $series_config['relative_upload'].$val->series_img;
            }
        $data['count'] = count($res_count);
        $data['current_count'] = count($res);
        $data['flash_type'] = 'series';
        echojson(0,$data);
    }
    /**
     *description:根据品牌id级联获取系列id
     *author:yanyalong
     *date:2014/06/16
     */
    public function brandToSeries(){
        $brand_id = isset($_POST['brandid'])?$_POST['brandid']:'';
        if(!$brand_id){
            $brand_id= isset($_POST['brand_id'])?$_POST['brand_id']:'';
        }
        if(!$brand_id) echojson(1,"","无相关选项");
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:"";
        $res = $this->t_product_brands_series_model->getSeriesByBrand($service_id,$brand_id,2);
        if($res==false)  echojson(1,"","无相关选项");
        $series = array();
        foreach ($res as $keys=>$vals) {
            $series[$keys]['series_id'] = $vals->series_id;
            $series[$keys]['series_name'] = $vals->series_name;
            $data['series_list'] = $series;
        }
        echojson(0,$data);
    }
}


