<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class ServiceSetCheckFactory{
    public static function createObj(){
         $obj = new serviceSet();
        if($obj instanceof ServiceSetCheckAbstract){
            return $obj->postCheck();
        }else{
            return false;	
        }
    }
}

//抽象类
abstract class ServiceSetCheckAbstract{
    public $post;
    abstract public function postCheck();
    public function __construct(){
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_info_model');
    }
}

/**
 *description:检测服务商家加盟表单提交数据(第一步)
 *author:yanyalong
 *date:2014/03/20
 */
class serviceSet extends ServiceSetCheckAbstract{
    //检测装修案例提交数据
    public function postCheck(){
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $service_info= $this->CI->t_service_info_model->get($service_id);
        $service_company = $_POST['service_company'];
        $service_email = $_POST['service_email'];
        $service_license_code = $_POST['service_license_code'];
        $service_organization_code = $_POST['service_organization_code'];
        $service_person = $_POST['service_person'];
        $service_person_work = $_POST['service_person_work'];
        $service_person_phone = $_POST['service_person_phone'];
        $service_desc= $_POST['service_desc'];
        //企业名称
        if($service_company==""){
            echojson(1,"","企业名称不能为空");
        }
        if((strlen(trim($service_company)) + mb_strlen(trim($service_company),'UTF8'))/2>60){
            echojson(1,"","企业名称不能超过30个字");
        }
        //if(($service_info->service_company!=$service_company)){
            //$this->CI->t_service_info_model->service_company = $service_company;
            //$joinInfo = $this->CI->t_service_info_model->getServiceJoinInfoByName();
            //if($joinInfo!=false){
                //echojson(1,'','存在同名商户名称');
            //}
        //}
        //企业邮箱
        if(trim($service_email)==""){
            echojson(1,'','企业邮箱不能为空');
        }
        if(!preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',$service_email)){
            echojson(1,'企业邮箱格式不正确');
        }		
        //if($service_info==false||($service_info->service_email!=$service_email)){
        //$this->CI->t_service_info_model->service_email= $service_email;
        //$joinInfo = $this->CI->t_service_info_model->getServiceJoinInfoByEmail();
        //if($joinInfo!=false){
            //echojson(1,'','当前邮箱已经被申请过');
        //}
        //}
        //营业执照注册号
        if(trim($service_license_code)==""){
            echojson(1,'','营业执照注册号不能为空');
        }
        //组织机构代码开始
        if(trim($service_organization_code)==""){
            echojson(1,'','组织机构代码不能为空');
        }
        if(trim($service_organization_code)!=""&&!preg_match('/^[a-zA-Z0-9]{8}-[a-zA-Z0-9]$/',$service_organization_code)){
            echojson(1,"","组织机构代码格式错误");
        }
        //联系人开始
        if(trim($service_person)==""){
            echojson(1,'','负责人姓名不能为空');
        }
        if((strlen(trim($service_person)) + mb_strlen(trim($service_person),'UTF8'))/2>12){
            echojson(1,"","负责人姓名不能超过6个字");
        }
        //联系人职务
        if(trim($service_person_work)==""){
            echojson(1,'','负责人职务不能为空');
        }
        if((strlen(trim($service_person_work)) + mb_strlen(trim($service_person_work),'UTF8'))/2>20){
            echojson(1,"","负责人职务不能超过10个字");
        }
        //联系电话开始
        if(trim($service_person_phone)==""){
            echojson(1,'','手机号码不能为空');
        }
        //联系电话开始
        if(!preg_match('/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/',$service_person_phone)){
            echojson(1,"","手机号码格式错误");
        }
        //企业概述
        if(trim($service_desc)==""){
            echojson(1,'','企业概述不能为空');
        }
        if((strlen(trim($service_desc)) + mb_strlen(trim($service_desc),'UTF8'))/2>400){
            echojson(1,"","企业概述不能超过200个字");
        }
    }
}

