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
        $this->load->model('t_service_user_model');
        $this->load->model('t_service_goods_model');
        $this->load->model('t_product_brands_series_model');
    }
    /**
     *description:取消门店申请
     *author:yanyalong
     *date:2014/03/25
     */
    public function clear(){
        $this->CheckAccessByKey('shop_edit');
        safeFilter();
        $shop_id= isset($_GET['shopid'])?$_GET['shopid']:'';
        //$shopid = 3;
        $shopInfo = $this->t_service_shop_model->get($shop_id);
        if($shopInfo==false){
            echojson(1,"","无相关数据"); 
        }
        loadlib('shopManage');
        ShopManageFactory::creatObj($shopInfo);
        ShopManageFactory::clearStatusShop();
    }
    /**
     *description:删除门店
     *author:yanyalong
     *date:2014/03/25
     */
    public function del(){
        $this->CheckAccessByKey('shop_edit');
        safeFilter();
        $shop_id= isset($_POST['shopid'])?$_POST['shopid']:'';
        $shopInfo = $this->t_service_shop_model->get($shop_id);
        loadlib('shopManage');
        ShopManageFactory::creatObj($shopInfo);
        ShopManageFactory::delShop();
    }
    /**
     *description:门店停业
     *author:yanyalong
     *date:2014/03/25
     */
    public function down(){
        $this->CheckAccessByKey('shop_edit');
        safeFilter();
        $shop_id= isset($_POST['shopid'])?$_POST['shopid']:'';
        $shopInfo = $this->t_service_shop_model->get($shop_id);
        loadlib('shopManage');
        ShopManageFactory::creatObj($shopInfo);
        ShopManageFactory::downShop();
    }
    /**
     *description:添加门店
     *author:yanyalong
     *date:2014/03/25
     */
    public function add(){
        $this->CheckAccessByKey('shop_add');
        safeFilter();
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        loadLib('ServiceJoinCheck');
        ServiceJoinCheckFactory::createObj('3');
        if($service_id=="") echojson(1,"","异常操作");
        $success_url = $this->actionList->shop_list;
        $error_url = $this->actionList->shop_add;
        $this->t_service_shop_model->shop_name= $_POST['shop_name'];
        $this->t_service_shop_model->service_id= $service_id;
        $res = $this->t_service_shop_model->getServiceShopInfo();
        if($res!=false) echojson(1,'','已存在重名门店');
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
        $this->upload->mktimedir($shop_thumb_config['thumb_1']);
        $this->upload->mktimedir($shop_thumb_config['thumb_2']);
        $this->upload->mktimedir($shop_thumb_config['thumb_3']);
        $this->upload->mktimedir($shop_thumb_config['thumb_4']);
        foreach ($_pic_arr as $key=>$val) {
            $shop_img = basename($val);
            $shop_img_flag = (file_exists($shop_thumb_config['upload_path'].$shop_img))?(copy($shop_thumb_config['upload_path'].$shop_img,$timedir.$shop_img)).(unlink($shop_thumb_config['upload_path'].$shop_img)):false;
            $this->load->library('image_lib');	
            $sourceimg = $shop_thumb_config['service_path'].$time_relative_path.$shop_img;
            ($this->image_lib->shop_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
            $shop_pic= 'shop_pic'.strval($key+1);
            $this->t_service_shop_model->$shop_pic = ($shop_img_flag==false)?"":$time_relative_path.$shop_img;
        }
        $this->t_service_shop_model->service_id= $service_id;
        $this->t_service_shop_model->shop_name = $_POST['shop_name'];
        $this->t_service_shop_model->shop_province_code= $_POST['shop_province'];
        $this->t_service_shop_model->shop_city_code= $_POST['shop_city'];
        $this->t_service_shop_model->shop_address = $_POST['shop_address'];
        $this->t_service_shop_model->shop_explain = $_POST['shop_explain'];
        $this->t_service_shop_model->shop_longitude= $_POST['shop_longitude'];
        $this->t_service_shop_model->shop_latitude= $_POST['shop_latitude'];
        $this->t_service_shop_model->shop_tel= $_POST['shop_tel'];
        $this->t_service_shop_model->shop_status= 3;
        $this->t_service_shop_model->shop_license= "";
        $this->t_service_shop_model->shop_logo= "";
        $this->t_service_shop_model->shop_addtime= $joinTime;
        $shop_id = $this->t_service_shop_model->insert();
        ($shop_id!=false)?echojson(0,$success_url,"门店添加成功"):echojson(1,$error_url,"门店添加失败");

    }
    /**
     *description:编辑门店
     *author:yanyalong
     *date:2014/03/25
     */
    public function edit(){
        $this->CheckAccessByKey('shop_edit');
        safeFilter();
        loadLib('ServiceJoinCheck');
        ServiceJoinCheckFactory::createObj('3');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        $shop_id= isset($_POST['shopid'])?$_POST['shopid']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $shop_info = $this->t_service_shop_model->get($shop_id);
        $this->t_service_shop_model->shop_name= trim($_POST['shop_name']);
        $this->t_service_shop_model->service_id= $service_id;
        $res = $this->t_service_shop_model->getServiceShopInfo();
        if($res!=false&&$shop_info->shop_name!=trim($_POST['shop_name'])) echojson(1,'','已存在重名门店');
        $success_url = $this->actionList->shop_list;
        $error_url =$this->actionList->shop_edit;
        if($service_id==""){
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
        $this->upload->mktimedir($shop_thumb_config['thumb_1']);
        $this->upload->mktimedir($shop_thumb_config['thumb_2']);
        $this->upload->mktimedir($shop_thumb_config['thumb_3']);
        $this->upload->mktimedir($shop_thumb_config['thumb_4']);
        foreach ($_pic_arr as $key=>$val) {
            $shop_pic= 'shop_pic'.strval($key+1);
            $shop_img = basename($val);
            if(basename($shop_info->$shop_pic)!=$shop_img){
                $shop_img_flag = (file_exists($shop_thumb_config['upload_path'].$shop_img))?(copy($shop_thumb_config['upload_path'].$shop_img,$timedir.$shop_img)).(unlink($shop_thumb_config['upload_path'].$shop_img)):false;
                $this->load->library('image_lib');	
                $sourceimg = $shop_thumb_config['service_path'].$time_relative_path.$shop_img;
                ($this->image_lib->shop_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
                $shop_pic= 'shop_pic'.strval($key+1);
                $data[$shop_pic] = ($shop_img_flag==false)?"":$time_relative_path.$shop_img;
            }
        }
        $data['shop_name'] = $_POST['shop_name'];
        $data['shop_province_code']= $_POST['shop_province'];
        $data['shop_city_code']= $_POST['shop_city'];
        $data['shop_address'] = $_POST['shop_address'];
        $data['shop_explain'] = $_POST['shop_explain'];
        $data['shop_tel'] = $_POST['shop_tel'];
        $data['shop_longitude']= $_POST['shop_longitude'];
        $data['shop_latitude'] = $_POST['shop_latitude'];
        $data['shop_status'] = 3;
        $updateFlag = $this->t_service_shop_model->updates_global($data,array('shop_id'=>$shop_info->shop_id));
        ($updateFlag!=false)?echojson(0,$success_url,"门店编辑成功"):echojson(1,$error_url,"门店编辑失败");
    }
    /**
     *description:实体门店认证
     *author:yanyalong
     *date:2014/03/25
     */
    public function certified(){
        $this->CheckAccessByKey('shop_edit');
        //判断是否通过审核(审核通过之前无法进行此操作)
        safeFilter();
        loadLib('ServiceJoinCheck');
        ServiceJoinCheckFactory::createObj('3');
        if($_POST['pic_list']=="") echojson(1,"","您至少需要上传一张门店照片");
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $shop_id= isset($_POST['shopid'])?$_POST['shopid']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $shop_info = $this->t_service_shop_model->get($shop_id);
        $this->t_service_shop_model->shop_name= trim($_POST['shop_name']);
        $this->t_service_shop_model->service_id= $service_id;
        $res = $this->t_service_shop_model->getServiceShopInfo();
        if($res!=false&&$shop_info->shop_name!=trim($_POST['shop_name'])) echojson(1,'','已存在重名门店');
        $success_url = $this->actionList->shop_list;
        $error_url =$this->actionList->shop_edit;
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
        $this->upload->mktimedir($shop_thumb_config['thumb_1']);
        $this->upload->mktimedir($shop_thumb_config['thumb_2']);
        foreach ($_pic_arr as $key=>$val) {
            $shop_pic= 'shop_pic'.strval($key+1);
            $shop_img = basename($val);
            if(basename($shop_info->$shop_pic)!=$shop_img){
                $shop_img_flag = (file_exists($shop_thumb_config['upload_path'].$shop_img))?(copy($shop_thumb_config['upload_path'].$shop_img,$timedir.$shop_img)).(unlink($shop_thumb_config['upload_path'].$shop_img)):false;
                $this->load->library('image_lib');	
                $sourceimg = $shop_thumb_config['service_path'].$time_relative_path.$shop_img;
                ($this->image_lib->shop_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
                $shop_pic= 'shop_pic'.strval($key+1);
                $data[$shop_pic] = ($shop_img_flag==false)?"":$time_relative_path.$shop_img;
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
        $data['shop_status'] = 11;
        $updateFlag = $this->t_service_shop_model->updates_global($data,array('shop_id'=>$shop_info->shop_id));
        ($updateFlag!=false)?echojson(0,$success_url,"您的认证申请已经成功提交"):echojson(1,$error_url,"您的申请失败了");
    }
    /**
     *description:根据审核状态检索门店
     *author:yanyalong
     *date:2014/03/25
     */
    public function search(){
        $this->CheckAccessByKey('shop_list');
        safeFilter();
        $service_user_id= isset($_SESSION['service_user_id'])?$_SESSION['service_user_id']:"";
        $status= isset($_POST['status'])?$_POST['status']:"1";
        $this->load->model('t_service_user_model');
        loadlib('ServiceShopManage');
        ServiceShopManageFactory::creatObj($service_user_id);
        $res = ServiceShopManageFactory::searchServiceShopManageList($status);
        $res['shop_add'] =$this->actionList->shop_add;
        if($res==false) echojson(0,$res,'无相关数据');
        if(!isset($res['shoplist'])) echojson(0,$res,'无相关数据'); else echojson(0,$res);
        
    }
    /**
     *description:关联品牌
     *author:yanyalong
     *date:2014/05/12
     */
    public function shoptobrand(){
        $this->CheckAccessByKey('shop_edit');
        $shop_id= isset($_POST['shopid'])?$_POST['shopid']:echojson(1,"","未接收到shopid");
        $brandsOldList = $this->t_service_shop_brands_model->getBrandsByShop($shop_id);
        $brands_old = array();
        if($brandsOldList!=false){
            foreach ($brandsOldList as $key=>$val) {
                $brands_old[] = $val->brand_id;
            }
        }
        if($_POST['brands']!=""){
            $brandsarr = explode(',',$_POST['brands']);
            $brands_del = array_diff($brands_old,$brandsarr);
            $brands_add = array_diff($brandsarr,$brands_old);
            if(!empty($brands_add)){
                foreach ($brands_add as $key=>$val) {
                    $this->t_service_shop_brands_model->brand_id = $val;
                    $this->t_service_shop_brands_model->shop_id= $shop_id;
                    $this->t_service_shop_brands_model->shop_brands_sort= "0";
                    $this->t_service_shop_brands_model->insert();
                }
            }        
            if(!empty($brands_del)){
                foreach ($brands_del as $key=>$val) {
                    $this->t_service_shop_brands_model->delByBrandId($val);
                }
            }        
        }else{
            $this->t_service_shop_brands_model->delByShopId($shop_id);
        }
        echojson(0,$this->actionList->shop_list,"操作成功");
    }
}

