<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class diyMenuFormCheck{
    public static function createObj($actionType){
        if($actionType=='add')
            new WeixinMenuAdd(); 
        elseif($actionType=='edit')
            new WeixinMenuEdit(); 
    }
}
//检测公众普通添加
include "httpCheckInterFace.php";
include_once "application/helpers/import_excel_helper.php";
include_once "application/helpers/fromcheck_helper.php";
class  WeixinMenuAdd implements httpCheckInterFace{
    //private $CI;
    public function __construct(){
        //$this->CI = &get_instance();
        //$this->CI->load->helper('import_excel');
        //$this->CI->load->helper('fromCheck');
        $this->postCheck(); 
    }
    public function postCheck(){

        $service_token = isset($_POST['service_token']) && $_POST['service_token']?$_POST['service_token']:echojson(1,'','服务商token为空，非法操作！');
        $smd_name = $_POST['smd_name'];
        if(trim($smd_name)=="") echojson(1,'','菜单名称必填');
        $smd_pid = $_POST['smd_pid'];
        if(!isset($smd_pid)) echojson(1,'','非法操作');

        if($smd_pid){
            if(stringLen_utf8($smd_name)>16) echojson(1,"","二级菜单最多7个汉字或14个英文字母");
        }else{
            if(stringLen_utf8($smd_name)>8) echojson(1,"","一级菜单最多4个汉字或8个英文字母");
        }

    }

    public function getCheck(){
        return false;
    }
}

//检测自定义菜单编辑
class  WeixinMenuEdit implements httpCheckInterFace{

    public function __construct(){
        
        $this->postCheck(); 
    }
    public function postCheck(){

        $service_token = isset($_POST['service_token']) && $_POST['service_token']?$_POST['service_token']:echojson(1,'','服务商token为空，非法操作！');
        
        //父类id
        $smd_id = $_POST['smd_id'];
        if(!is_numeric($smd_id)) echojson(1,'','菜单id填写非法');
        
        $diyInfo = model('t_service_menu_diy')->get($smd_id);
        //菜单名称
        $smd_name = $_POST['smd_name'];
        if(trim($smd_name)=="") echojson(1,'','此项为必填');
        if($diyInfo->smd_pid == 0){
            if(stringLen_utf8($smd_name)>8) echojson(1,"","一级菜单最多4个汉字或8个英文字母");
        }else{
            if(stringLen_utf8($smd_name)>16) echojson(1,"","二级菜单最多7个汉字或14个英文字母");
        }
    }

    public function getCheck(){
        return false;
    }
}

