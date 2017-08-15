<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class BrandActionFormCheck{
    public static function createObj($actionType){
        if($actionType=='add')
            new BrandAdd(); 
        elseif($actionType=='edit')
            new BrandEdit(); 
    }
}
//检测品牌添加
class  BrandAdd{
    public function __construct(){
        $this->postCheck(); 
    }
    public function postCheck(){
        //品牌中文名称开始
        $apply_brand_name = $_POST['apply_brand_name'];
        if(trim($apply_brand_name)=="") echojson(1,'','此项为必填');
        if((strlen(trim($apply_brand_name)) + mb_strlen(trim($apply_brand_name),'UTF8'))/2>50) echojson(1,"","请输入不超过25个字的中文名称");
        //品牌英文名称开始
        $apply_brand_ename = $_POST['apply_brand_ename'];
        if(trim($apply_brand_ename)=="") echojson(1,'','此项为必填');
        if((strlen(trim($apply_brand_ename)) + mb_strlen(trim($apply_brand_ename),'UTF8'))/2>50) echojson(1,"","请输入不超过50个字的英文名称");
        //授权开始时间
        $apply_license_begin = $_POST['apply_license_begin'];
        if($apply_license_begin=="") echojson(1,'','此项为必填');
        //授权结束时间
        $apply_license_end = $_POST['apply_license_end'];
        if(trim($apply_license_end)=="") echojson(1,'','此项为必填');
        //品牌授权文件
        $apply_license_file = $_POST['apply_license_file'];
        if(trim($apply_license_file)=="") echojson(1,'','此项为必填');
        //品牌logo文件
        $apply_brand_img = $_POST['apply_brand_img'];
        if(trim($apply_brand_img)=="") echojson(1,'','此项为必填');
        //品牌所属品类
        $brand_class= $_POST['brand_class'];
        if(trim($brand_class)=="") echojson(1,'','此项为必填');
        //品牌所属品类
        $apply_brand_seodesc= $_POST['apply_brand_seodesc'];
        if(trim($apply_brand_seodesc)=="") echojson(1,'','此项为必填');
        if((strlen(trim($apply_brand_seodesc)) + mb_strlen(trim($apply_brand_seodesc),'UTF8'))/2>1000) echojson(1,"","请输入不超过500个字的文字描述");
    }
}

//检测品牌添加
class  BrandEdit{
    public function __construct(){
        $this->postCheck(); 
    }
    public function postCheck(){
        //品牌中文名称开始
        $apply_brand_name = $_POST['apply_brand_name'];
        if(trim($apply_brand_name)=="") echojson(1,'','此项为必填');
        if((strlen(trim($apply_brand_name)) + mb_strlen(trim($apply_brand_name),'UTF8'))/2>50) echojson(1,"","请输入不超过25个字的中文名称");
        //品牌英文名称开始
        $apply_brand_ename = $_POST['apply_brand_ename'];
        if(trim($apply_brand_ename)=="") echojson(1,'','此项为必填');
        if((strlen(trim($apply_brand_ename)) + mb_strlen(trim($apply_brand_ename),'UTF8'))/2>50) echojson(1,"","请输入不超过50个字的英文名称");
        //授权开始时间
        $apply_license_begin = $_POST['apply_license_begin'];
        if($apply_license_begin=="") echojson(1,'','此项为必填');
        //授权结束时间
        $apply_license_end = $_POST['apply_license_end'];
        if(trim($apply_license_end)=="") echojson(1,'','此项为必填');
        //品牌授权文件
        $apply_license_file = $_POST['apply_license_file'];
        if(trim($apply_license_file)=="") echojson(1,'','此项为必填');
        //品牌logo文件
        $apply_brand_img = $_POST['apply_brand_img'];
        if(trim($apply_brand_img)=="") echojson(1,'','此项为必填');
        //品牌所属品类
        $brand_class= $_POST['brand_class'];
        if(trim($brand_class)=="") echojson(1,'','此项为必填');
        //品牌所属品类
        $apply_brand_seodesc= $_POST['apply_brand_seodesc'];
        if(trim($apply_brand_seodesc)=="") echojson(1,'','此项为必填');
        if((strlen(trim($apply_brand_seodesc)) + mb_strlen(trim($apply_brand_seodesc),'UTF8'))/2>1000) echojson(1,"","请输入不超过500个字的文字描述");
    }
}

