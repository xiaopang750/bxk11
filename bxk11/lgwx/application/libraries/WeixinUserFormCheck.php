<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:liuguangping
 *date:2013/12/04
 */
class WeixinUserFormCheck{
    public static function createObj($actionType){
        if($actionType=='add')
            new WeixinUserAdd(); 
        elseif($actionType=='edit')
            new WeixinUserEdit(); 
    }
}
//检测公众普通添加
include "httpCheckInterFace.php";
include_once "application/helpers/import_excel_helper.php";
include_once "application/helpers/fromcheck_helper.php";
class  WeixinUserAdd implements httpCheckInterFace{
    //private $CI;
    public function __construct(){
        //$this->CI = &get_instance();
        //$this->CI->load->helper('import_excel');
        //$this->CI->load->helper('fromCheck');
        $this->postCheck(); 
    }
    public function postCheck(){

        //服务商
         $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,'','服务商为空，非法操作！');

        //服务顾类型
         $wx_type = $_POST['wx_type'];
        if(trim($wx_type)=="" && isset($_POST['wx_type'])) echojson(1,'','此项为必填');


        //公众号名称
        $wx_name = $_POST['wx_name'];
        if(trim($wx_name)=="") echojson(1,'','此项为必填');
        if(strlen_utf8($wx_name)>25) echojson(1,"","请输入不超过25个字的中文名称");


        //公众号邮箱
        $wx_email = $_POST['wx_email'];
        if(trim($wx_email)=="") echojson(1,'','此项为必填');
        if(!CheckEmail($wx_email))echojson(1,'','邮箱格式不正确');

        //公众号原始id
        $wx_id = $_POST['wx_id'];
        if(trim($wx_id)=="") echojson(1,'','此项为必填');
        if(!is_numeric(intval($wx_id))) echojson(1,'','公众号原始id不是数字');
        if(strlen_utf8($wx_id)>25) echojson(1,"","请输入不超过50个字的英文名称");

        // 微信号
        $wx_code = $_POST['wx_code'];
        if(trim($wx_code)=="") echojson(1,'','此项为必填');

     /*   //省
        $wx_province = $_POST['wx_province'];
        if(trim($wx_province)=="") echojson(1,'','此项为必填');

        //市
        $wx_city = $_POST['wx_city'];
        if(trim($wx_city)=="") echojson(1,'','此项为必填');*/

        if($wx_type == 1){

            //微信公众号appid
            $wx_appid = $_POST['wx_appid'];
            if(trim($wx_appid)=="") echojson(1,'','此项为必填');

            //微信公众号appsecret
            $wx_appsecret = $_POST['wx_appsecret'];
            if(trim($wx_appsecret)=="") echojson(1,'','此项为必填');
        }
        

    }

    public function getCheck(){
        return false;
    }
}

//检测公众普编辑
class  WeixinUserEdit implements httpCheckInterFace{
    //private $CI;
    public function __construct(){
        //$this->CI = &get_instance();
        //$this->CI->load->helper('import_excel');
        //$this->CI->load->helper('fromCheck');
        $this->postCheck(); 
    }
    public function postCheck(){

        //服务商
         $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,'','服务商为空，非法操作！');

        //自增id主键
         $wid = $_POST['wid'];
        if($wid == '')echojson(1,'','微信id为空，非法操作！');

         //服务顾类型
         $wx_type = $_POST['wx_type'];
        if(trim($wx_type)=="") echojson(1,'','此项为必填');

        //公众号名称
        $wx_name = $_POST['wx_name'];
        if(trim($wx_name)=="") echojson(1,'','此项为必填');
        if(strlen_utf8($wx_name)>25) echojson(1,"","请输入不超过25个字的中文名称");

        //公众号邮箱
        $wx_email = $_POST['wx_email'];
        if(trim($wx_email)=="") echojson(1,'','此项为必填');
        if(!CheckEmail($wx_email))echojson(1,'','邮箱格式不正确');

        //公众号原始id
        $wx_id = $_POST['wx_id'];
        if(trim($wx_id)=="") echojson(1,'','此项为必填');
        if(!is_numeric(intval($wx_id))) echojson(1,'','公众号原始id不是数字');
        if(strlen_utf8($wx_id)>25) echojson(1,"","请输入不超过50个字的英文名称");

        // 微信号
        $wx_code = $_POST['wx_code'];
        if(trim($wx_code)=="") echojson(1,'','此项为必填');

      /*  //省
        $wx_province = $_POST['wx_province'];
        if(trim($wx_province)=="") echojson(1,'','此项为必填');

        //市
        $wx_city = $_POST['wx_city'];
        if(trim($wx_city)=="") echojson(1,'','此项为必填');*/

         if($wx_type == 1){

            //微信公众号appid
            $wx_appid = $_POST['wx_appid'];
            if(trim($wx_appid)=="") echojson(1,'','此项为必填');

            //微信公众号appsecret
            $wx_appsecret = $_POST['wx_appsecret'];
            if(trim($wx_appsecret)=="") echojson(1,'','此项为必填');
        }


    }

    public function getCheck(){
        return false;
    }
}

