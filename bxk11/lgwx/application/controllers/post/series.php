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
        safeFilter();
        loadLib('BrandSeriesFormCheck');
        BrandSeriesFormCheckFactory::createObj('add');
        $brand_id = $_POST['brand_id'];
        $_series_name= $_POST['series_name'];
        $_series_ename= $_POST['series_ename'];
        $_series_seodesc  = $_POST['series_seodesc'];
        $_brandInfo = $this->t_product_brands_model->getBrandInfoById($brand_id);
        if($_brandInfo==false) echojson(1,"","不存在的品牌");
        $_series_img = $_POST['series_img'];
        $this->load->library('upload');
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $this->config->load('uploads');	
        $this->load->library('image_lib');
        $config = $this->config->item("serviceBrandSeries");
        $timedir = $this->upload->mktimedir($config['service_path']);
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        $this->upload->mktimedir($config['service_path']);
        $series_img= basename($_series_img);
        $series_img_flag = (file_exists($_SERVER['DOCUMENT_ROOT'].$_series_img))?(copy($_SERVER['DOCUMENT_ROOT'].$_series_img,$timedir.$series_img)):false;
        $this->load->library('image_lib');	
        $sourceimg = $config['service_path'].$time_relative_path.$series_img;
        $this->upload->mktimedir($config['thumb_1']);
        $this->upload->mktimedir($config['thumb_2']);
        $this->upload->mktimedir($config['thumb_3']);
        $this->upload->mktimedir($config['thumb_4']);
        ($this->image_lib->series_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
        $this->t_product_brands_series_model->series_img= ($series_img_flag==false)?"":$time_relative_path.$series_img;
        $this->t_product_brands_series_model->brand_id= $brand_id;
        $this->t_product_brands_series_model->service_id= (isset($_SESSION['service_id']))?$_SESSION['service_id']:"";
        $this->t_product_brands_series_model->series_name = $_series_name;
        $this->t_product_brands_series_model->series_ename = $_series_ename;
        $this->t_product_brands_series_model->series_seodesc= $_series_seodesc;
        $this->t_product_brands_series_model->series_seokey= "";
        $this->t_product_brands_series_model->series_status= "2";
        $series_id = $this->t_product_brands_series_model->insert();
        $url = $this->actionList->series_list;
        ($series_id!=false)?echojson(0,$url,"系列添加成功"):echojson(1,$url,"系列添加失败");
    }
    /**
     *description:编辑系列
     *author:yanyalong
     *date:2014/03/26
     */
    public function edit(){
        //$this->CheckAccessByKey('series_edit');
        //safeFilter();
        loadLib('BrandSeriesFormCheck');
        BrandSeriesFormCheckFactory::createObj('edit');
        $_series_id = $_POST['series_id'];
        $_series_name= $_POST['series_name'];
        $_series_ename= $_POST['series_ename'];
        $_series_seodesc  = $_POST['series_seodesc'];
        $_series_img = $_POST['series_img'];
        //获取品牌信息
        $series_info = $this->t_product_brands_series_model->get($_series_id);
        $_brandInfo = $this->t_product_brands_model->getBrandInfoById($series_info->brand_id);
        if($_brandInfo==false) echojson(1,"","不存在的品牌信息");
        $series_img= basename($_series_img);
        if(basename($series_info->series_img)!=$series_img){
        $this->load->library('upload');
            $time = time();
            $joinTime = date('Y-m-d H:i:s',$time);
            $this->config->load('uploads');	
            $this->load->library('image_lib');
            $config = $this->config->item("serviceBrandSeries");
            $timedir = $this->upload->mktimedir($config['service_path']);
            $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
            $this->upload->mktimedir($config['service_path']);
            $series_img_flag = (file_exists($_SERVER['DOCUMENT_ROOT'].$_series_img))?(copy($_SERVER['DOCUMENT_ROOT'].$_series_img,$timedir.$series_img)):false;
            $this->load->library('image_lib');	
            $sourceimg = $config['service_path'].$time_relative_path.$series_img;
            $this->upload->mktimedir($config['thumb_1']);
            $this->upload->mktimedir($config['thumb_2']);
            $this->upload->mktimedir($config['thumb_3']);
            $this->upload->mktimedir($config['thumb_4']);
            ($this->image_lib->series_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
            $data['series_img'] = ($series_img_flag==false)?"":$time_relative_path.$series_img;
        }
        $data['series_name ']= $_series_name;
        $data['series_ename ']= $_series_ename;
        $data['series_seodesc']= $_series_seodesc;
        $updateFlag = $this->t_product_brands_series_model->updates_global($data,array('series_id'=>$_series_id));
        $url = $this->actionList->series_list;
        ($updateFlag!=false)?echojson(0,$url,"操作成功"):echojson(1,$url,"操作失败");
    }
    /**
     *description:删除系列
     *author:yanyalong
     *date:2014/04/08
     */
    public function del(){
        //$this->CheckAccessByKey('series_edit');
        safeFilter();
        //$_POST = array(
        //'series_id' => '40',
        //);
        $_series_id = isset($_POST['series_id'])?$_POST['series_id']:echojson(0,"","异常操作");
        $data['series_status']= 99;
        $updateFlag = $this->t_product_brands_series_model->updates_global($data,array('series_id'=>$_series_id));
        ($updateFlag!=false)?echojson(0,"","操作成功"):echojson(0,"","操作失败");
    }
}

