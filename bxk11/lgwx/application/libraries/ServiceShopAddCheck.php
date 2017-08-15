<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class ServiceShopAddCheckFactory{
    public static function createObj(){
        $obj = new ShopAddCheck($_POST);
        if($obj instanceof ShopAddCheckAbstract){
            return $obj->postCheck();
        }else{
            return false;	
        }
    }
}

//抽象类
abstract class ShopAddCheckAbstract{
    public $post;
    public $user_id;
    abstract public function postCheck();
    public function __construct($post){
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_shop_model');
        $this->post= $post;
    }
}

/**
 *description:检测经销商添加门店表单提交数据
 *author:yanyalong
 *date:2014/03/20
 */
class ShopAddCheck extends ShopAddCheckAbstract{
    //检测装修案例提交数据
    public function postCheck(){
        $brands= $this->post['brands'];
        $shop_name= $this->post['shop_name'];
        $shop_province= $this->post['shop_province'];
        $shop_city= $this->post['shop_city'];
        $shop_address= $this->post['shop_address'];
        $shop_logo= $this->post['shop_logo'];
        $shop_pic1= $this->post['shop_pic1'];
        $shop_pic2= $this->post['shop_pic2'];
        $shop_license= $this->post['shop_license'];
        $shop_explain= $this->post['shop_explain'];
        $shop_tel= $this->post['shop_tel'];
        //门店名称开始
        if(trim($brands)==""){
            echojson(1,'','您至少需要选择一种经营品牌');
        }
        //门店名称开始
        if(trim($shop_name)==""){
            echojson(1,'','门店名称不能为空');
        }
        if((strlen(trim($shop_name)) + mb_strlen(trim($shop_name),'UTF8'))/2>50){
            echojson(1,"","门店名称不能超过25个字");
        }
        if(trim($shop_province)==""){
            echojson(1,'','请选择门店所在省份');
        }
        if(trim($shop_city)==""){
            echojson(1,'','请选择门店所在城市');
        }
        //地址开始
        if(trim($shop_address)==""){
            echojson(1,'','门店地址不能为空');
        }
        if((strlen(trim($shop_address)) + mb_strlen(trim($shop_address),'UTF8'))/2>50){
            echojson(1,"","门店地址不能超过25个字");
        }
        //门店联系电话
        if(trim($shop_tel)==""){
            echojson(1,'','门店联系电话不能为空');
        }
        //logo图片开始
        if(trim($shop_logo)==""){
            echojson(1,'','门店logo必须上传');
        }
        //logo图片开始
        if(trim($shop_pic1)==""||trim($shop_pic2)==""){
            echojson(1,'','实景图片必须上传完整哦');
        }
        //资信文件开始
        if(trim($shop_license)==""){
            echojson(1,'','营业执照必须上传');
        }
        //门店介绍开始
        if(trim($shop_explain)==""){
            echojson(1,'','门店介绍不能为空');
        }
        if((strlen(trim($shop_explain)) + mb_strlen(trim($shop_explain),'UTF8'))/2>400){
            echojson(1,"","门店地址不能超过200个字");
        }
    }
}


