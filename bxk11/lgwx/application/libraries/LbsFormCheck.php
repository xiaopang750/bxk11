<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class LbsAddFormCheckFactory{
    public static function createObj($actionType){
        if($actionType=='add')
            new LbsAdd(); 
        elseif($actionType=='edit')
            new LbsEdit(); 
    }
}
//检测系列添加
class  LbsAdd{
    public function __construct(){
        $this->CI = &get_instance();
        $this->postCheck(); 
    }
    public function postCheck(){
        //公司名称
        $lbs_name= isset($_POST['lbs_name'])?$_POST['lbs_name']:"";
        if(trim($lbs_name)=="") echojson(1,'','此项为必填');
        if((strlen(trim($lbs_name)) + mb_strlen(trim($lbs_name),'UTF8'))/2>50){
            echojson(1,"","名称不能超过25个字");
        }
        //公司简称
        $lbs_shortname= isset($_POST['lbs_shortname'])?$_POST['lbs_shortname']:"";
        if(trim($lbs_shortname)=="") echojson(1,'','公司简称');
        if((strlen(trim($lbs_name)) + mb_strlen(trim($lbs_name),'UTF8'))/2>50){
            echojson(1,"","简称不能超过25个字");
        }
        //电话
        $lbs_phone= isset($_POST['lbs_phone'])?$_POST['lbs_phone']:"";
        if(!preg_match('/^((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)$/',$lbs_phone)){
            echojson(1,"","电话号格式错误");
        }
        //手机号
        $lbs_tel= isset($_POST['lbs_tel'])?$_POST['lbs_tel']:"";
        if(!preg_match('/^13[0-9]{1}[0-9]{8}$|15[012356789]{1}[0-9]{8}$|18[012356789]{1}[0-9]{8}$|14[57]{1}[0-9]$/',$lbs_tel)){
            echojson(1,"","手机号码格式错误");
        }
        //公司地址
        $lbs_shortname= isset($_POST['lbs_shortname'])?$_POST['lbs_shortname']:"";
        if(trim($lbs_shortname)=="") echojson(1,'','公司地址不能为空');
        if((strlen(trim($lbs_name)) + mb_strlen(trim($lbs_name),'UTF8'))/2>100){
            echojson(1,"","简称不能超过50个字");
        }
        //经度
        $lbs_longitude= isset($_POST['lbs_longitude'])?$_POST['lbs_longitude']:"";
        if(trim($lbs_longitude)=="") echojson(1,'','经度不能为空');
        //纬度
        $lbs_latitude= isset($_POST['lbs_latitude'])?$_POST['lbs_latitude']:"";
        if(trim($lbs_latitude)=="") echojson(1,'','纬度不能为空');
        //公司logo
        $lbs_logourl= isset($_POST['lbs_logourl'])?$_POST['lbs_logourl']:"";
        if(trim($lbs_logourl)=="") echojson(1,'','logo必须上传');
    }
}
