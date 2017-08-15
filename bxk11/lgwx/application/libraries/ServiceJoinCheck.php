<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class ServiceJoinCheckFactory{
    public static function createObj($step){
        $classname = "ServiceJoinCheckStep".$step;
        $obj = new $classname($_POST);
        if($obj instanceof JoinCheckAbstract){
            return $obj->postCheck();
        }else{
            return false;	
        }
    }
}

//抽象类
abstract class JoinCheckAbstract{
    public $post;
    public $step;
    abstract public function postCheck();
    public function __construct($post){
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_info_model');
        $this->CI->load->model('t_service_brands_apply_model');
        $this->post= $post;
    }
}

/**
 *description:检测服务商家加盟表单提交数据(第一步)
 *author:yanyalong
 *date:2014/03/20
 */
class ServiceJoinCheckStep1 extends JoinCheckAbstract{
    //检测装修案例提交数据
    public function postCheck(){
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $service_info = $this->CI->t_service_info_model->get($service_id);
        $join_name= $this->post['join_name'];
        $join_email= $this->post['join_email'];
        $join_license_code= $this->post['join_license_code'];
        $join_license= $this->post['join_license'];
        $join_code= $this->post['join_code'];
        $join_person= $this->post['join_person'];
        $join_person_work= $this->post['join_person_work'];
        $join_phone= $this->post['join_phone'];
        //企业名称
        if(trim($join_name)==""){
            echojson(1,'','企业名称不能为空');
        }
        if((strlen(trim($join_name)) + mb_strlen(trim($join_name),'UTF8'))/2>60){
            echojson(1,"","企业名称不能超过30个字");
        }
        //$service_info = $this->CI->t_service_info_model->getServiceInfoByCompany($join_name);
        //if($service_info!=false){
        //echojson(1,'','存在同名商户名称');
        //}
        //企业邮箱
        if(trim($join_email)==""){
            echojson(1,'','企业邮箱不能为空');
        }
        if(!preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',$join_email)){
            echojson(1,'','企业邮箱格式不正确');
        }		
        //if($service_info==false||($service_info->join_email!=$join_email)){
        //$this->CI->t_service_info_model->join_email= $join_email;
        //$service_info = $this->CI->t_service_info_model->getServiceJoinInfoByEmail();
        //if($service_info!=false){
        //echojson(1,'','当前邮箱已经被申请过');
        //}
        //}
        //$service_info = $this->CI->t_service_info_model->getServiceInfoByEmail($join_email);
        //if($service_info!=false){
        //echojson(1,'','当前邮箱已经被申请过');
        //}
        //联系人开始
        if(trim($join_person)==""){
            echojson(1,'','负责人名称不能为空');
        }
        if((strlen(trim($join_person)) + mb_strlen(trim($join_person),'UTF8'))/2>12){
            echojson(1,"","负责人名称不能超过6个字");
        }
        //营业执照注册号
        if(trim($join_license_code)==""){
            echojson(1,'','营业执照注册号不能为空');
        }
        //营业执照
        if(trim($join_license)==""){
            echojson(1,'','营业执照不能为空');
        }
        //组织机构代码开始
        if(trim($join_code)==""){
            echojson(1,'','组织机构代码不能为空');
        }
        //if(trim($join_code)!=""&&!preg_match('/^[1-9][0-9]{10,10}$/',$join_code)){
        //echojson(1,"","组织机构代码格式错误");
        //}
        //联系人姓名
        //if(trim($join_person)==""){
        //echojson(1,'','负责人姓名不能为空');
        //}
        //if((strlen(trim($join_person)) + mb_strlen(trim($join_person),'UTF8'))/2>20){
        //echojson(1,"","联系人姓名不能超过10个字");
        //}
        //联系人职务
        if(trim($join_person_work)==""){
            echojson(1,'','负责人职务不能为空');
        }
        if((strlen(trim($join_person_work)) + mb_strlen(trim($join_person_work),'UTF8'))/2>20){
            echojson(1,"","负责人职务不能超过10个字");
        }
        //联系电话开始
        if(trim($join_phone)==""){
            echojson(1,'','手机号不能为空');
        }
        if(!preg_match('/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/',$join_phone)){
            echojson(1,"","手机号格式错误");
        }
    }
}

/**
 *description:检测服务商家加盟表单添加品牌提交数据(第二步)
 *author:yanyalong
 *date:2014/03/20
 */
class ServiceJoinCheckStep2 extends JoinCheckAbstract{
    //检测装修案例提交数据
    public function postCheck(){
        //品牌中文名称开始
        $apply_brand_name = $_POST['apply_brand_name'];
        if(trim($apply_brand_name)=="") echojson(1,'','品牌中文名称不能为空');
        if((strlen(trim($apply_brand_name)) + mb_strlen(trim($apply_brand_name),'UTF8'))/2>20) echojson(1,"","请输入不超过10个字的中文名称");
        //品牌英文名称开始
        $apply_brand_ename = $_POST['apply_brand_ename'];
        if($apply_brand_ename!=""){
            if((strlen(trim($apply_brand_ename)) + mb_strlen(trim($apply_brand_ename),'UTF8'))/2>40) echojson(1,"","请输入不超过20个字的英文名称");
        }
        //品牌logo文件
        $apply_brand_img = $_POST['apply_brand_img'];
        if(trim($apply_brand_img)=="") echojson(1,'','品牌logo必须上传');
        //品牌所属品类
        $brand_class= $_POST['brand_class'];
        if(trim($brand_class)=="") echojson(1,'','您至少选择一种品牌产品品类');
        //品牌文字介绍
        $apply_brand_seodesc= $_POST['apply_brand_seodesc'];
        if(trim($apply_brand_seodesc)=="") echojson(1,'','品牌介绍不能为空');
        if((strlen(trim($apply_brand_seodesc)) + mb_strlen(trim($apply_brand_seodesc),'UTF8'))/2>400) echojson(1,"","请输入不超过200个字的文字描述");
    }
}

/**
 *description:检测服务商家加盟表单添加实体实体店提交数据(第三步)
 *author:yanyalong
 *date:2014/03/20
 */
class ServiceJoinCheckStep3 extends JoinCheckAbstract{
    //检测装修案例提交数据
    public function postCheck(){
        $shop_name= $this->post['shop_name'];
        $shop_province= $this->post['shop_province'];
        $shop_tel = $this->post['shop_tel'];
        $shop_city= $this->post['shop_city'];
        $shop_address= $this->post['shop_address'];
        $_pic_list= $this->post['pic_list'];
        $shop_explain= $this->post['shop_explain'];
        $shop_longitude = $this->post['shop_longitude'];
        $shop_latitude= $this->post['shop_latitude'];
        //实体店名称开始
        if(trim($shop_name)==""){
            echojson(1,'','实体店名称不能为空');
        }
        if((strlen(trim($shop_name)) + mb_strlen(trim($shop_name),'UTF8'))/2>60){
            echojson(1,"","实体店名称不能超过30个字");
        }
        if(trim($shop_province)==""){
            echojson(1,'','请选择实体店所在省份');
        }
        if(trim($shop_city)==""){
            echojson(1,'','请选择实体店所在城市');
        }
        //地址开始
        if(trim($shop_address)==""){
            echojson(1,'','实体店地址不能为空');
        }
        if((strlen(trim($shop_address)) + mb_strlen(trim($shop_address),'UTF8'))/2>100){
            echojson(1,"","实体店地址不能超过50个字");
        }
        if(trim($shop_tel)==""){
            echojson(1,'','实体店联系电话不能为空');
        }
        ////联系电话开始
        //if(!preg_match("/^(((d{3}))|(d{3}-))?((0d{2,3})|0d{2,3}-)?[1-9]d{6,8}$/",$shop_tel)&&!preg_match("/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/",$shop_tel)){
            //echojson(1,"","电话号码格式错误");
        //}
        //实体店介绍开始
        if(trim($shop_explain)==""){
            echojson(1,'','店面描述不能为空');
        }
        if((strlen(trim($shop_explain)) + mb_strlen(trim($shop_explain),'UTF8'))/2>400){
            echojson(1,"","店面描述不能超过200个字");
        }
        //经纬度
        if($shop_longitude==""||$shop_latitude==""){
            echojson(1,"","请通过点击地图选择实体店经纬度");
        }
    }
}
