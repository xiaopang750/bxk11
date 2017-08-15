<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class BrandSeriesFormCheckFactory{
    public static function createObj($actionType){
        if($actionType=='add')
            new SeriesAdd(); 
        elseif($actionType=='edit')
            new SeriesEdit(); 
    }
}
//检测系列添加
class  SeriesAdd{
    public function __construct(){
        $this->CI = &get_instance();
        $this->CI->load->model('t_product_brands_series_model');
        $this->postCheck(); 
    }
    public function postCheck(){
        //品牌id
        $brand_id = isset($_POST['brand_id'])?$_POST['brand_id']:"";
        if(trim($brand_id)=="") echojson(1,'','异常操作');
        //系列名称
        $series_name = isset($_POST['series_name'])?$_POST['series_name']:"";
        if(trim($series_name)=="") echojson(1,'','此项为必填');
        if((strlen(trim($series_name)) + mb_strlen(trim($series_name),'UTF8'))/2>50) echojson(1,"","请输入不超过25个字的中文名称");
        $series_info = $this->CI->t_product_brands_series_model->getSeriesInfoByName($brand_id,$series_name);
        if($series_info!=false){
            echojson(1,'','当前品牌下已经存在同名系列');
        }
        //系列英文名称
        $series_ename = isset($_POST['series_ename'])?$_POST['series_ename']:"";
        if(trim($series_ename)=="") echojson(1,'','此项为必填');
        if((strlen(trim($series_ename)) + mb_strlen(trim($series_ename),'UTF8'))/2>50) echojson(1,"","请输入不超过50个字的英文名称");
        $series_info = $this->CI->t_product_brands_series_model->getSeriesInfoByEname($brand_id,$series_ename);
        if($series_info!=false){
            echojson(1,'','当前品牌下已经存在相同英文名系列');
        }
        //系列图片
        $series_img = isset($_POST['series_img'])?$_POST['series_img']:"";
        if(trim($series_img)=="") echojson(1,'','此项为必填');
        ////所属分类
        //$series_class = isset($_POST['series_class'])?$_POST['series_class']:"";
        //if(trim($series_class)=="") echojson(1,'','您至少需要选择一种品类');
        //系列文字介绍
        $series_seodesc = isset($_POST['series_seodesc'])?$_POST['series_seodesc']:"";
        if(trim($series_seodesc)=="") echojson(1,'','此项为必填');
        if((strlen(trim($series_seodesc)) + mb_strlen(trim($series_seodesc),'UTF8'))/2>1000) echojson(1,"","请输入不超过500个字的文字描述");
    }
}
//检测系列编辑
class  SeriesEdit{
    public function __construct(){
        $this->CI = &get_instance();
        $this->CI->load->model('t_product_brands_series_model');
        $this->postCheck(); 
    }
    public function postCheck(){
        //系列id
        $series_id = isset($_POST['series_id'])?$_POST['series_id']:"";
        if(trim($series_id)=="") echojson(1,'','异常操作');
        $_series_info = $this->CI->t_product_brands_series_model->get($series_id);
        if($_series_info==false) echojson(1,'','您可能正在编辑不存在的系列');
        //系列名称
        $series_name = isset($_POST['series_name'])?$_POST['series_name']:"";
        if(trim($series_name)=="") echojson(1,'','此项为必填');
        if((strlen(trim($series_name)) + mb_strlen(trim($series_name),'UTF8'))/2>50) echojson(1,"","请输入不超过25个字的中文名称");
        if($series_name!=$_series_info->series_name){
            $series_info = $this->CI->t_product_brands_series_model->getSeriesInfoByName($_series_info->brand_id,$series_name);
            if($series_info!=false){
                echojson(1,'','当前品牌下已经存在同名系列');
            }
        }
        //系列英文名称
        $series_ename = isset($_POST['series_ename'])?$_POST['series_ename']:"";
        if(trim($series_ename)=="") echojson(1,'','此项为必填');
        if((strlen(trim($series_ename)) + mb_strlen(trim($series_ename),'UTF8'))/2>50) echojson(1,"","请输入不超过50个字的英文名称");
        if($series_ename!=$_series_info->series_ename){
            $series_info = $this->CI->t_product_brands_series_model->getSeriesInfoByName($_series_info->brand_id,$series_ename);
            if($series_info!=false){
                echojson(1,'','当前品牌下已经存在相同英文名的系列');
            }
        }
        //系列图片
        $series_img = isset($_POST['series_img'])?$_POST['series_img']:"";
        if(trim($series_img)=="") echojson(1,'','此项为必填');
        ////所属分类
        //$series_class = isset($_POST['series_class'])?$_POST['series_class']:"";
        //if(trim($series_class)=="") echojson(1,'','您至少需要选择一种品类');
        //系列文字介绍
        $series_seodesc = isset($_POST['series_seodesc'])?$_POST['series_seodesc']:"";
        if(trim($series_seodesc)=="") echojson(1,'','此项为必填');
        if((strlen(trim($series_seodesc)) + mb_strlen(trim($series_seodesc),'UTF8'))/2>1000) echojson(1,"","请输入不超过500个字的文字描述");
    }
}


