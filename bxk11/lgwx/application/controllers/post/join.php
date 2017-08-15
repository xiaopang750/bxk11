<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:经销商加盟提交
 *author:yanyalong
 *date:2014/03/20
 */
class join extends   MY_Controller {
    private $t_service_info;
    function __construct(){
        parent::__construct();
        $this->load->model('t_service_info_model');
        $this->load->model('t_user_notice_model');
        $this->load->model('t_service_brands_apply_model');
        $this->load->model('t_product_brands_model');
        $this->load->model('t_product_class_brands_model');
        $this->load->model('t_service_shop_model');
        $this->load->model('t_service_user_model');
        $this->load->model('t_product_brands_series_model');
        loadLib('ServiceJoinStatusCheck');
    }
    /**
     *description:加盟信息
     *author:yanyalong
     *date:2014/05/05
     */
    public function step1(){
        $this->CheckAccessByKey('join_step1');
        safeFilter();
        loadLib('ServiceJoinCheck');
        ServiceJoinCheckFactory::createObj('1');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $res= $this->t_service_info_model->get($service_id);
        if(!in_array($res->service_status,array(21,22,24))) //判断通行状态
            ServiceJoinStatusCheckFactory::createobj($res->service_status);//根据当前实际状态进行判断跳转地址
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $this->config->load('uploads');		
        $config = $this->config->item("serviceJoin");		
        $this->load->library('upload');
        $timedir = $this->upload->mktimedir($config['service_path']);
        $_join_license = $_POST['join_license'];
        $success_url = $this->actionList->join_step2;
        $error_url =$this->actionList->join_step1;
        if($config['relative_upload'].$res->service_license!=$_join_license){
            $join_license = basename($_join_license);
            $series_img_flag = (file_exists($config['upload_path'].$join_license))?(copy($config['upload_path'].$join_license,$timedir.$join_license)).(unlink($config['upload_path'].$join_license)):false;
            $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
            $data['service_license'] = ($series_img_flag==false)?"":$time_relative_path.$join_license;
        }
        $data['service_join_addtime']= $joinTime;
        $data['service_company'] = $_POST['join_name'];
        $data['service_email'] = $_POST['join_email'];
        $data['service_license_code']= $_POST['join_license_code'];
        $data['service_organization_code'] = $_POST['join_code'];
        $data['service_person']= $_POST['join_person'];
        $data['service_person_work']= $_POST['join_person_work'];
        $data['service_person_phone']= $_POST['join_phone'];
        $data['service_status'] = 22;
        $updateFlag = $this->t_service_info_model->updates_global($data,array('service_id'=>$service_id));
        ($updateFlag!=false)?echojson(0,$success_url,"企业基本信息提交成功,正在进入下一步"):echojson(1,$error_url,"申请失败");
    }
    /**
     *description:品牌信息
     *author:yanyalong
     *date:2014/05/05
     */
    public function step2(){
        $this->CheckAccessByKey('join_step2');
        safeFilter();
        loadLib('ServiceJoinCheck');
        ServiceJoinCheckFactory::createObj('2');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $res= $this->t_service_info_model->get($service_id);
        if(!in_array($res->service_status,array(21,22,24))) //判断通行状态
            ServiceJoinStatusCheckFactory::createobj($res->service_status);//根据当前实际状态进行判断跳转地址
        if($res->service_status!=22) echojson(1,$this->actionList->join_step1,"请您先完善您的企业信息");
        $apply_brand_info = $this->t_service_brands_apply_model->getApplyByServiceJoin($service_id,'4');
        $this->config->load('uploads');		
        $license_config = $this->config->item("serviceBrandLicense");		
        $logo_config = $this->config->item("serviceApplyBrand");		
        $this->load->library('upload');
        $license_timedir = $this->upload->mktimedir($license_config['service_path']);
        $logo_timedir = $this->upload->mktimedir($logo_config['service_path']);
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $success_url = $this->actionList->join_step3;
        $error_url =$this->actionList->join_step2;
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        if($apply_brand_info==false){
            $this->t_service_brands_apply_model->service_id= $service_id;
            $this->t_service_brands_apply_model->apply_brand_name=$_POST['apply_brand_name'];
            $this->t_service_brands_apply_model->apply_brand_ename=$_POST['apply_brand_ename'];
            $this->t_service_brands_apply_model->apply_license_begin=$_POST['apply_license_begin'];
            $this->t_service_brands_apply_model->apply_license_end=$_POST['apply_license_end'];
            $this->t_service_brands_apply_model->apply_brand_seodesc=  $_POST['apply_brand_seodesc'];
            $this->t_service_brands_apply_model->apply_status = 4;
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
                $classlist = explode(',',$_POST['brand_class']);
                foreach ($classlist as $key=>$val) {
                    $this->t_product_class_brands_model->brand_id=$brand_id;
                    $this->t_product_class_brands_model->pc_id=$val;
                    $this->t_product_class_brands_model->insert();
                }
                $data['brand_id'] = $brand_id;
                $updateFlag = $this->t_service_brands_apply_model->updates_global($data,array('apply_id'=>$apply_id));
            $this->t_product_brands_series_model->brand_id= $brand_id;
            $this->t_product_brands_series_model->service_id= $service_id;
            $this->t_product_brands_series_model->series_name= "默认系列";
            $this->t_product_brands_series_model->series_img = "";
            $this->t_product_brands_series_model->series_status= 2;
            $series_id= $this->t_product_brands_series_model->insert();
                ($updateFlag!=false)?echojson(0,$success_url,"经营品牌添加成功,正在进入下一步"):echojson(1,$error_url,"申请失败");
            }else echojson(1,$error_url,"申请失败");
        }else{
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
            $data['apply_status'] = 4;
            $this->t_service_brands_apply_model->updates_global($data,array('apply_id'=>$apply_brand_info->apply_id));
            $this->t_product_class_brands_model->delClsssByBrand($apply_brand_info->brand_id);
            $classlist = explode(',',$_POST['brand_class']);
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
            ($updateFlag!=false)?echojson(0,$success_url,"经营品牌添加成功,正在进入下一步"):echojson(1,$error_url,"申请失败");
        }
    }
    /**
     *description:实体门店
     *author:yanyalong
     *date:2014/05/05
     */
    public function step3(){
        $this->CheckAccessByKey('join_step3');
        safeFilter();
        loadLib('ServiceJoinCheck');
        ServiceJoinCheckFactory::createObj('3');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $res= $this->t_service_info_model->get($service_id);
        if(!in_array($res->service_status,array(21,22,24))) //判断通行状态
            ServiceJoinStatusCheckFactory::createobj($res->service_status);//根据当前实际状态进行判断跳转地址
        if($res->service_status!=22) echojson(1,$this->actionList->join_step1,"请您先完善您的企业信息");
        $apply_brand_info = $this->t_service_brands_apply_model->getApplyByServiceJoin($service_id);
        if($apply_brand_info==false) echojson(1,$this->actionList->join_step2,"您还没有填写经营品牌哦");
        $shop_info = $this->t_service_shop_model->getShopByServiceJoin($service_id,4);
        $success_url = $this->actionList->join_step4;
        $error_url =$this->actionList->join_step3;
        $this->t_service_shop_model->shop_name= $_POST['shop_name'];
        $this->t_service_shop_model->service_id= $service_id;
        if($this->t_service_shop_model->service_id==""){
            echojson(1,'','登录异常');
        }
        $_pic_list= $_POST['pic_list'];
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $this->config->load('uploads');		
        $shop_thumb_config = $this->config->item("serviceShop");		
        $this->load->library('upload');
        $timedir = $this->upload->mktimedir($shop_thumb_config['service_path']);
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        //商品缩略图
        $_pic_arr = explode('|',$_pic_list);
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $this->config->load('uploads');		
        $config = $this->config->item("serviceShop");		
        $this->load->library('upload');
        $timedir = $this->upload->mktimedir($config['service_path']);
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        $this->upload->mktimedir($shop_thumb_config['thumb_1']);
        $this->upload->mktimedir($shop_thumb_config['thumb_2']);
        $this->upload->mktimedir($shop_thumb_config['thumb_3']);
        $this->upload->mktimedir($shop_thumb_config['thumb_4']);
        if($shop_info==false){
            foreach ($_pic_arr as $key=>$val) {
                $shop_pic= 'shop_pic'.strval($key+1);
                $shop_img = basename($val);
                $goods_img_flag = (file_exists($shop_thumb_config['upload_path'].$shop_img))?(copy($shop_thumb_config['upload_path'].$shop_img,$timedir.$shop_img)).(unlink($shop_thumb_config['upload_path'].$shop_img)):false;
                $this->load->library('image_lib');	
                $sourceimg = $shop_thumb_config['service_path'].$time_relative_path.$shop_img;
                ($this->image_lib->shop_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
                $shop_pic= 'shop_pic'.strval($key+1);
                $this->t_service_shop_model->$shop_pic = ($goods_img_flag==false)?"":$time_relative_path.$shop_img;
            }
            $this->t_service_shop_model->service_id= $service_id;
            $this->t_service_shop_model->shop_name = $_POST['shop_name'];
            $this->t_service_shop_model->shop_province_code= $_POST['shop_province'];
            $this->t_service_shop_model->shop_city_code= $_POST['shop_city'];
            $this->t_service_shop_model->shop_address = $_POST['shop_address'];
            $this->t_service_shop_model->shop_explain = $_POST['shop_explain'];
            $this->t_service_shop_model->shop_longitude= $_POST['shop_longitude'];
            $this->t_service_shop_model->shop_latitude= $_POST['shop_latitude'];
            $this->t_service_shop_model->shop_status= 4;
            $this->t_service_shop_model->shop_license= "";
            $this->t_service_shop_model->shop_logo= "";
            $this->t_service_shop_model->shop_tel= $_POST['shop_tel'];
            $this->t_service_shop_model->shop_addtime= $joinTime;
            $shop_id = $this->t_service_shop_model->insert();
        }else{
        foreach ($_pic_arr as $key=>$val) {
            $shop_pic= 'shop_pic'.strval($key+1);
            $shop_img = basename($val);
            if(basename($shop_info->$shop_pic)!=$shop_img){
                $goods_img_flag = (file_exists($shop_thumb_config['upload_path'].$shop_img))?(copy($shop_thumb_config['upload_path'].$shop_img,$timedir.$shop_img)).(unlink($shop_thumb_config['upload_path'].$shop_img)):false;
                $this->load->library('image_lib');	
                $sourceimg = $shop_thumb_config['service_path'].$time_relative_path.$shop_img;
                ($this->image_lib->shop_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
                $shop_pic= 'shop_pic'.strval($key+1);
                $data[$shop_pic] = ($goods_img_flag==false)?"":$time_relative_path.$shop_img;
            }
        }
            $data['shop_name'] = $_POST['shop_name'];
            $data['shop_province_code']= $_POST['shop_province'];
            $data['shop_city_code']= $_POST['shop_city'];
            $data['shop_address'] = $_POST['shop_address'];
            $data['shop_explain'] = $_POST['shop_explain'];
            $data['shop_longitude']= $_POST['shop_longitude'];
            $data['shop_latitude'] = $_POST['shop_latitude'];
            $data['shop_tel'] = $_POST['shop_tel'];
            $data['shop_status'] = 4;
            $this->t_service_shop_model->updates_global($data,array('shop_id'=>$shop_info->shop_id));
        }
        $this->t_user_notice_model->notice_type=0;
        $this->t_user_notice_model->notice_title="您的企业认证申请已经提交审核,将在3个工作日内审核完成！";
        $this->t_user_notice_model->notice_content="您已申请成功,请耐心等待客服人员与您联系";
        $this->t_user_notice_model->service_id=$service_id;
        $this->t_user_notice_model->insert();
        //修改经销商认证状态为认证中
        $service_data['service_status'] = "23";
        $updateFlag = $this->t_service_info_model->updates_global($service_data,array('service_id'=>$service_id));
        ($updateFlag!=false)?echojson(0,$success_url,"您的认证申请已经成功提交"):echojson(1,$error_url,"您的申请失败了");
    }
    /**
     *description:选择待认证企业备用品牌
     *author:yanyalong
     *date:2014/05/11
     */
    public function selectBrand(){
        $this->CheckAccessByKey('brand_edit');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $apply_id = $_POST['apply_id']; 
        $url = $this->actionList->join_step2;
        $res = $this->t_service_brands_apply_model->getApplyByServiceJoin($service_id,4);
        if($res!=false){
            $old_status['apply_status'] = "2";
            $updateFlag = $this->t_service_brands_apply_model->updates_global($old_status,array('apply_id'=>$res->apply_id));
        }
        $new_status['apply_status'] = "4";
        $updateFlag = $this->t_service_brands_apply_model->updates_global($new_status,array('apply_id'=>$apply_id));
        ($updateFlag!=false)?echojson(0,$url,"选择成功"):echojson(1,$url,"选择失败");
    }
    /**
     *description:选择待认证企业备用门店
     *author:yanyalong
     *date:2014/05/11
     */
    public function selectShop(){
        $this->CheckAccessByKey('shop_edit');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $shop_id = $_POST['shop_id']; 
        $url = $this->actionList->join_step3;
        $res = $this->t_service_shop_model->getShopByServiceJoin($service_id,4);
        if($res!=false){
            $old_status['shop_status'] = "3";
            $updateFlag = $this->t_service_shop_model->updates_global($old_status,array('shop_id'=>$res->shop_id));
        }
        $new_status['shop_status'] = "4";
        $updateFlag = $this->t_service_shop_model->updates_global($new_status,array('shop_id'=>$shop_id));
        ($updateFlag!=false)?echojson(0,$url,"选择成功"):echojson(1,$url,"选择失败");
    }
}

