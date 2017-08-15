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
        $this->load->model('t_product_brands_model');
        $this->load->model('t_product_class_brands_model');
        $this->load->model('t_product_brands_series_model');
    }
    /**
     *description:添加品牌
     *author:yanyalong
     *date:2014/04/02
     */
    public function add(){
      
        $this->CheckAccessByKey('brand_add');
        safeFilter();
        loadLib('ServiceJoinCheck');
        ServiceJoinCheckFactory::createObj('2');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $this->t_service_brands_apply_model->apply_brand_name= trim($_POST['apply_brand_name']);
        $this->t_service_brands_apply_model->service_id= $service_id;
        $res = $this->t_service_brands_apply_model->getServiceBrandInfo();
        if($res!=false) echojson(1,'','已存在重名品牌');
        $this->config->load('uploads');		
        $license_config = $this->config->item("serviceBrandLicense");		
        $logo_config = $this->config->item("serviceApplyBrand");		
        $this->load->library('upload');
        $license_timedir = $this->upload->mktimedir($license_config['service_path']);
        $logo_timedir = $this->upload->mktimedir($logo_config['service_path']);
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $success_url = $this->actionList->brand_list;
        $error_url = $this->actionList->brand_add;
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        $this->t_service_brands_apply_model->service_id= $service_id;
        $this->t_service_brands_apply_model->brand_id= '';
        $this->t_service_brands_apply_model->apply_brand_name=$_POST['apply_brand_name'];
        $this->t_service_brands_apply_model->apply_brand_ename=$_POST['apply_brand_ename'];
        $this->t_service_brands_apply_model->apply_license_begin=$_POST['apply_license_begin'];
        $this->t_service_brands_apply_model->apply_license_end=$_POST['apply_license_end'];
        $this->t_service_brands_apply_model->apply_brand_seodesc=  $_POST['apply_brand_seodesc'];
        $this->t_service_brands_apply_model->apply_status = 2;
        $this->t_service_brands_apply_model->apply_laudit_desc= "";
        $_apply_brand_img = basename($_POST['apply_brand_img']);
        $_apply_license_file = basename($_POST['apply_license_file']);
        $apply_brand_img= ($_apply_brand_img!=""&&file_exists($logo_config['upload_path'].$_apply_brand_img))?(copy($logo_config['upload_path'].$_apply_brand_img,$logo_timedir.$_apply_brand_img)).(unlink($logo_config['upload_path'].$_apply_brand_img)):false;
        $apply_license_file= ($_apply_license_file!=""&&file_exists($license_config['upload_path'].$_apply_license_file))?(copy($license_config['upload_path'].$_apply_license_file,$license_timedir.$_apply_license_file)).(unlink($license_config['upload_path'].$_apply_license_file)):false;
        $this->t_service_brands_apply_model->apply_license_file = ($apply_license_file==false)?"":$time_relative_path.$_apply_license_file;
        $this->t_service_brands_apply_model->apply_brand_img =  ($apply_brand_img==false)?"":$time_relative_path.$_apply_brand_img;
        $apply_id= $this->t_service_brands_apply_model->insert();
        if($apply_id!=false){
            $this->t_product_brands_model->c_brand_id=0;
            $this->t_product_brands_model->brand_name = $_POST['apply_brand_name'];
            $this->t_product_brands_model->brand_ename = $_POST['apply_brand_ename'];
            $this->t_product_brands_model->brand_seodesc = $_POST['apply_brand_seodesc'];
            $this->t_product_brands_model->brand_img=$this->t_service_brands_apply_model->apply_brand_img;
            $this->t_product_brands_model->brand_products=0;
            $this->t_product_brands_model->brand_seokey="";
            $brand_id = $this->t_product_brands_model->insert();
            $classlist = explode('|',$_POST['brand_class']);
            foreach ($classlist as $key=>$val) {
                $this->t_product_class_brands_model->brand_id=$brand_id;
                $this->t_product_class_brands_model->pc_id=$val;
                $this->t_product_class_brands_model->insert();
            }
            $this->t_product_brands_series_model->brand_id= $brand_id;
            $this->t_product_brands_series_model->service_id= $service_id;
            $this->t_product_brands_series_model->series_name= "默认系列";
            $this->t_product_brands_series_model->series_img = "";
            $this->t_product_brands_series_model->series_status= 2;
            $series_id= $this->t_product_brands_series_model->insert();
            $data['brand_id'] = $brand_id;
            $updateFlag = $this->t_service_brands_apply_model->updates_global($data,array('apply_id'=>$apply_id));
            ($updateFlag!=false)?echojson(0,$success_url,"经营品牌添加成功"):echojson(1,$error_url,"添加失败");
        }
    }
    /**
     *description:编辑品牌
     *author:yanyalong
     *date:2014/04/02
     */
    public function edit(){
        $this->CheckAccessByKey('brand_edit');
        safeFilter();
        loadLib('ServiceJoinCheck');
        ServiceJoinCheckFactory::createObj('2');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $apply_id= isset($_POST['apply_id'])?$_POST['apply_id']:'';
        if($apply_id=="") echojson(1,"","异常操作");
        $apply_brand_info = $this->t_service_brands_apply_model->get($apply_id);
        $this->t_service_brands_apply_model->apply_brand_name= trim($_POST['apply_brand_name']);
        $this->t_service_brands_apply_model->service_id= $service_id;
        $res = $this->t_service_brands_apply_model->getServiceBrandInfo();
        if($res!=false&&$apply_brand_info->apply_brand_name!=trim($_POST['apply_brand_name'])) echojson(1,'','已存在重名品牌');
        $this->config->load('uploads');		
        $license_config = $this->config->item("serviceBrandLicense");		
        $logo_config = $this->config->item("serviceApplyBrand");		
        $this->load->library('upload');
        $license_timedir = $this->upload->mktimedir($license_config['service_path']);
        $logo_timedir = $this->upload->mktimedir($logo_config['service_path']);
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $success_url =$this->actionList->brand_list;
        $error_url = $this->actionList->brand_edit;
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        if($logo_config['relative_upload'].$apply_brand_info->apply_brand_img!=$_POST['apply_brand_img']){
            $_apply_brand_img = basename($_POST['apply_brand_img']);
            $apply_brand_img= ($_POST['apply_brand_img']!=""&&file_exists($logo_config['upload_path'].$_apply_brand_img))?(copy($logo_config['upload_path'].$_apply_brand_img,$logo_timedir.$_apply_brand_img)).(unlink($logo_config['upload_path'].$_apply_brand_img)):false;
            $data['apply_brand_img'] =  ($apply_brand_img==false)?"":$time_relative_path.$_apply_brand_img;
        }
        if($logo_config['relative_upload'].$apply_brand_info->apply_license_file!=$_POST['apply_license_file']){
            $_apply_license_file = basename($_POST['apply_license_file']);
            $apply_license_file= ($_POST['apply_license_file']!=""&&file_exists($logo_config['upload_path'].$_apply_license_file))?(copy($logo_config['upload_path'].$_apply_license_file,$license_timedir.$_apply_license_file)).(unlink($logo_config['upload_path'].$_apply_license_file)):false;
            $data['apply_license_file'] =  ($apply_license_file==false)?"":$time_relative_path.$_apply_license_file;
        }
        $data['service_id'] = $service_id;
        $data['apply_brand_name']=$_POST['apply_brand_name'];
        $data['apply_brand_ename']=$_POST['apply_brand_ename'];
        $data['apply_license_begin']=$_POST['apply_license_begin'];
        $data['apply_license_end']=$_POST['apply_license_end'];
        $data['apply_brand_seodesc']=  $_POST['apply_brand_seodesc'];
        $data['apply_status'] = 2;
        $this->t_service_brands_apply_model->updates_global($data,array('apply_id'=>$apply_brand_info->apply_id));
        $this->t_product_class_brands_model->delClsssByBrand($apply_brand_info->brand_id);
        $classlist = explode('|',$_POST['brand_class']);
        foreach ($classlist as $key=>$val) {
            $this->t_product_class_brands_model->brand_id=$apply_brand_info->brand_id;
            $this->t_product_class_brands_model->pc_id=$val;
            $this->t_product_class_brands_model->insert();
        }
        $pbdata['brand_name'] = $_POST['apply_brand_name'];
        $pbdata['brand_ename'] = $_POST['apply_brand_ename'];
        $pbdata['brand_seodesc'] = $_POST['apply_brand_seodesc'];
        if(isset($data['apply_brand_img'])) $pbdata['brand_img'] = $data['apply_brand_img'];
        $updateFlag = $this->t_product_brands_model->updates_global($pbdata,array('brand_id'=>$apply_brand_info->brand_id));
        ($updateFlag!=false)?echojson(0,$success_url,"经营品牌编辑成功"):echojson(1,$error_url,"申请失败");
    }
    /**
     *description:认证品牌
     *author:yanyalong
     *date:2014/04/02
     */
    public function certified(){
        $this->CheckAccessByKey('brand_certified');
        //判断是否通过审核(审核通过之前无法进行此操作)
        loadLib('ServiceJoinStatusCheck');
        ServiceJoinStatusIsTrueFactory::createObj('brand_list','ajax');
        safeFilter();
        loadLib('ServiceJoinCheck');
        ServiceJoinCheckFactory::createObj('2');
        if($_POST['apply_license_begin']=="") echojson(1,"","请选择认证开始时间");
        if($_POST['apply_license_end']=="") echojson(1,"","请选择认证结束时间");
        if($_POST['apply_license_file']=="") echojson(1,"","请上传品牌授权资质文件");
        if($_POST['apply_license_begin']==$_POST['apply_license_end']||$_POST['apply_license_begin']>$_POST['apply_license_end']) echojson(1,"","认证结束时间不得早于开始时间");
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $apply_id= isset($_POST['apply_id'])?$_POST['apply_id']:'';
        if($apply_id=="") echojson(1,"","异常操作");
        $apply_brand_info = $this->t_service_brands_apply_model->get($apply_id);
        $this->t_service_brands_apply_model->apply_brand_name= trim($_POST['apply_brand_name']);
        $this->t_service_brands_apply_model->service_id= $service_id;
        $res = $this->t_service_brands_apply_model->getServiceBrandInfo();
        if($res!=false&&$apply_brand_info->apply_brand_name!=trim($_POST['apply_brand_name'])) echojson(1,'','已存在重名品牌');
        $this->config->load('uploads');		
        $license_config = $this->config->item("serviceBrandLicense");		
        $logo_config = $this->config->item("serviceApplyBrand");		
        $this->load->library('upload');
        $license_timedir = $this->upload->mktimedir($license_config['service_path']);
        $logo_timedir = $this->upload->mktimedir($logo_config['service_path']);
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $success_url =$this->actionList->brand_list;
        $error_url = $this->actionList->brand_edit;
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        if($logo_config['relative_upload'].$apply_brand_info->apply_brand_img!=$_POST['apply_brand_img']){
            $_apply_brand_img = basename($_POST['apply_brand_img']);
            $apply_brand_img= ($_POST['apply_brand_img']!=""&&file_exists($logo_config['upload_path'].$_apply_brand_img))?(copy($logo_config['upload_path'].$_apply_brand_img,$logo_timedir.$_apply_brand_img)).(unlink($logo_config['upload_path'].$_apply_brand_img)):false;
            $data['apply_brand_img'] =  ($apply_brand_img==false)?"":$time_relative_path.$_apply_brand_img;
        }
        if($logo_config['relative_upload'].$apply_brand_info->apply_license_file!=$_POST['apply_license_file']){
            $_apply_license_file = basename($_POST['apply_license_file']);
            $apply_license_file= ($_POST['apply_license_file']!=""&&file_exists($logo_config['upload_path'].$_apply_license_file))?(copy($logo_config['upload_path'].$_apply_license_file,$license_timedir.$_apply_license_file)).(unlink($logo_config['upload_path'].$_apply_license_file)):false;
            $data['apply_license_file'] =  ($apply_license_file==false)?"":$time_relative_path.$_apply_license_file;
        }
        $data['service_id'] = $service_id;
        $data['apply_brand_name']=$_POST['apply_brand_name'];
        $data['apply_brand_ename']=$_POST['apply_brand_ename'];
        $data['apply_license_begin']=$_POST['apply_license_begin'];
        $data['apply_license_end']=$_POST['apply_license_end'];
        $data['apply_brand_seodesc']=  $_POST['apply_brand_seodesc'];
        $data['apply_status'] = 11;
        $this->t_service_brands_apply_model->updates_global($data,array('apply_id'=>$apply_brand_info->apply_id));
        $this->t_product_class_brands_model->delClsssByBrand($apply_brand_info->brand_id);
        $classlist = explode('|',$_POST['brand_class']);
        foreach ($classlist as $key=>$val) {
            $this->t_product_class_brands_model->brand_id=$apply_brand_info->brand_id;
            $this->t_product_class_brands_model->pc_id=$val;
            $this->t_product_class_brands_model->insert();
        }
        $pbdata['brand_name'] = $_POST['apply_brand_name'];
        $pbdata['brand_ename'] = $_POST['apply_brand_ename'];
        $pbdata['brand_seodesc'] = $_POST['apply_brand_seodesc'];
        if(isset($data['apply_brand_img'])) $pbdata['brand_img'] = $data['apply_brand_img'];
        $updateFlag = $this->t_product_brands_model->updates_global($pbdata,array('brand_id'=>$apply_brand_info->brand_id));
        ($updateFlag!=false)?echojson(0,$success_url,"经营品牌认证提交成功"):echojson(1,$error_url,"提交失败");
    }
    /**
     *description:删除品牌
     *author:yanyalong
     *date:2014/04/04
     */
    public function del(){
        $this->CheckAccessByKey('brand_edit');
        $apply_id = isset($_POST['aid'])?$_POST['aid']:"";
        if($apply_id=="") echojson(1,"","异常操作");
        $data['apply_status'] = 99;
        $updateFlag = $this->t_service_brands_apply_model->updates_global($data,array('apply_id'=>$apply_id));
        $url = $this->actionList->brand_list;
        if($updateFlag!=false){
            echojson(0,"","操作成功");
        }else{
            echojson(1,"","操作失败");
        }
    }
    /**
     *description:取消品牌认证
     *author:yanyalong
     *date:2014/04/04
     */
    public function cancel(){
        $this->CheckAccessByKey('brand_edit');
        $apply_id = isset($_GET['aid'])?$_GET['aid']:"";
        if($apply_id=="") echojson(1,"","异常操作");
        $data['apply_status'] = 2;
        $updateFlag = $this->t_service_brands_apply_model->updates_global($data,array('apply_id'=>$apply_id));
        $url = $this->actionList->brand_list;
        if($updateFlag!=false){
            //echo "<script>alert('取消认证成功');</script>";
            header("location:$url");exit;
            exit;
        }else{
            //echo "<script>alert('取消认证成功');</script>";
            header("location:$url");exit;
            exit;
            //echo "<script>alert('取消认证失败'); window.history.back();</script>";exit;
        }

    }
    /**
     *description:品牌下架
     *author:yanyalong
     *date:2014/04/04
     */
    public function down(){
        $this->CheckAccessByKey('brand_edit');
        $apply_id = isset($_POST['aid'])?$_POST['aid']:"";
        if($apply_id=="") echojson(1,"","异常操作");
        $data['apply_status'] = 3;
        $updateFlag = $this->t_service_brands_apply_model->updates_global($data,array('apply_id'=>$apply_id));
        $url = $this->actionList->brand_list;
        if($updateFlag!=false){
            echojson(0,$this->actionList->brand_edit.'&aid='.$apply_id,"操作成功");
        }else{
            echojson(1,"","操作失败");
        }
    }
    
}

