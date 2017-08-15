<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:liuguangping
 *date:2013/12/04
 */
class WeixinImgReplyFormCheck{
    public static function createObj($actionType){
        if($actionType=='add')
            new WeixinImgReplyAdd(); 
        elseif($actionType=='edit')
            new WeixinImgReplyEdit(); 
    }
}
//检测公众普通添加
include "httpCheckInterFace.php";
include_once "application/helpers/import_excel_helper.php";
include_once "application/helpers/fromcheck_helper.php";
class  WeixinImgReplyAdd implements httpCheckInterFace{
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
        $service_token = isset($_SESSION['service_token']) && $_SESSION['service_token']?$_SESSION['service_token']:echojson(1,'','服务商token为空，非法操作！');
        //关键字
        $reply_keyword = $_POST['reply_keyword'];
        if(trim($reply_keyword)=="") echojson(1,'','此项为必填');
        if(strlen_utf8($reply_keyword)>25) echojson(1,"","请输入不超过25个字的中文名称");

        //关键字匹配类型
        $reply_match_type = $_POST['reply_match_type'];
        if(trim($reply_match_type)=="") echojson(1,'','此项为必填');
        if(!is_numeric(intval($reply_match_type))) echojson(1,'','公众号原始id不是数字');
    

        // 回复描述
        $reply_desc = $_POST['reply_desc'];
        if(trim($reply_desc)=="") echojson(1,'','此项为必填');
        if(strlen_utf8($reply_desc)>200) echojson(1,"","请输入不超过200个字的中文名称");

        //回复标题
        $reply_title = $_POST['reply_title'];
        if(trim($reply_title)=="") echojson(1,'','此项为必填');
        if(strlen_utf8($reply_title)>25) echojson(1,"","请输入不超过25个字的中文名称");

        //图文外链网址   
        $reply_outurl = $_POST['reply_outurl'];
        if(trim($reply_outurl)!=""){
            if(!CheckHttp($reply_outurl))echojson(1,'','外链地址格式不正确');
        }

    }

    public function getCheck(){
        return false;
    }
}

//检测公众普编辑
class  WeixinImgReplyEdit implements httpCheckInterFace{
    //private $CI;
    public function __construct(){
        /*$this->CI = &get_instance();
        $this->CI->load->helper('import_excel');
        $this->CI->load->helper('fromCheck');*/
        $this->postCheck(); 
    }
    public function postCheck(){

        //自增id主键
        $reply_id = $_POST['reply_id'];
        if($reply_id == '')echojson(1,'','图文id为空，非法操作！');
        $service_token = isset($_SESSION['service_token']) && $_SESSION['service_token']?$_SESSION['service_token']:echojson(1,'','服务商token为空，非法操作！');
        //关键字
        $reply_keyword = $_POST['reply_keyword'];
        if(trim($reply_keyword)=="") echojson(1,'','此项为必填');
        if(strlen_utf8($reply_keyword)>25) echojson(1,"","请输入不超过25个字的中文名称");

        //关键字匹配类型
        $reply_match_type = $_POST['reply_match_type'];
        if(trim($reply_match_type)=="") echojson(1,'','此项为必填');
        if(!is_numeric(intval($reply_match_type))) echojson(1,'','公众号原始id不是数字');
    

        // 回复描述
        $reply_desc = $_POST['reply_desc'];
        if(trim($reply_desc)=="") echojson(1,'','此项为必填');
        if(strlen_utf8($reply_desc)>200) echojson(1,"","请输入不超过200个字的中文名称");

        //回复标题
        $reply_title = $_POST['reply_title'];
        if(trim($reply_title)=="") echojson(1,'','此项为必填');
        if(strlen_utf8($reply_title)>25) echojson(1,"","请输入不超过25个字的中文名称");

        //图文外链网址   
        $reply_outurl = $_POST['reply_outurl'];
        if(trim($reply_outurl)!=""){
            if(!CheckHttp($reply_outurl))echojson(1,'','外链地址格式不正确');
        }

    }

    public function getCheck(){
        return false;
    }
}

