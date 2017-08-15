<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class SeriesGoodsFormCheckFactory{
    public static function createObj($actionType){
        if($actionType=='add')
            new GoodsAdd(); 
        elseif($actionType=='edit')
            new GoodsEdit(); 
    }
}
//检测商品添加
class  GoodsAdd{
    public function __construct(){
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_goods_model');
        $this->postCheck(); 
    }
    public function postCheck(){
        //系列id
        $series_id = isset($_POST['series_id'])?$_POST['series_id']:"";
        if(trim($series_id)=="") echojson(1,'','异常操作');
        //分类id
        $class_id = isset($_POST['class_id'])?$_POST['class_id']:"";
        if(trim($class_id)=="") echojson(1,'','您需要为商品选择一种类型');
        //商品名称
        $goods_title = isset($_POST['goods_title'])?$_POST['goods_title']:"";
        if(trim($goods_title)=="") echojson(1,'','商品名称不能为空');
        if((strlen(trim($goods_title)) + mb_strlen(trim($goods_title),'UTF8'))/2>120) echojson(1,"","请输入不超过60个字的中文名称");
        $series_info = $this->CI->t_service_goods_model->getGoodsInfoByTitle($series_id,$goods_title);
        if($series_info!=false){
            echojson(1,'','当前系列下已经存在同名商品');
        }
        //商品编码
        $goods_code = isset($_POST['goods_code'])?$_POST['goods_code']:"";
        if(trim($goods_code)=="") echojson(1,'','商品编码不能为空');
        if((strlen(trim($goods_code)) + mb_strlen(trim($goods_code),'UTF8'))/2>30) echojson(1,"","商品编码不能15个字");
        $series_info = $this->CI->t_service_goods_model->getGoodsInfoByCode($series_id,$goods_code);
        if($series_info!=false){
            echojson(1,'','当前系列下已经存在相同编码的商品');
        }
        //商品规格
        $goods_size = isset($_POST['goods_size'])?$_POST['goods_size']:"";
        if(trim($goods_size)=="") echojson(1,'','商品规格不能为空');
        if((strlen(trim($goods_size)) + mb_strlen(trim($goods_size),'UTF8'))/2>50) echojson(1,"","商品编码不能25个字");
        //商品材质
        $goods_material = isset($_POST['goods_material'])?$_POST['goods_material']:"";
        if(trim($goods_material)=="") echojson(1,'','商品材质不能为空');
        if((strlen(trim($goods_material)) + mb_strlen(trim($goods_material),'UTF8'))/2>50) echojson(1,"","商品材质不能25个字");
        ////颜色贴面
        //$color_list = isset($_POST['color_list'])?$_POST['color_list']:"";
        //if(trim($color_list)=="") echojson(1,'','颜色贴图不能为空');
        //$_color_arr = explode(',',$color_list);
        //foreach ($_color_arr as $key=>$val) {
            //$_val = explode('|',$val);
            //if(count($_val)!=3||!file_exists($_SERVER['DOCUMENT_ROOT'].$_val[1])){
                //echojson(1,'','颜色贴面数据填写不完整');
            //}
        //}
        //商品缩略图
        $pic_list = isset($_POST['pic_list'])?$_POST['pic_list']:"";
        if(trim($pic_list)=="") echojson(1,'','商品缩略图不能为空');
        ////商品描述
        $goods_desc = isset($_REQUERT['goods_desc'])?$_REQUERT['goods_desc']:"";
        $goods_desc = $goods_desc?$goods_desc:$_POST['goods_desc'];
        if(trim($goods_desc)=="") echojson(1,'','商品描述不能为空');
        //if((strlen(trim($goods_desc)) + mb_strlen(trim($goods_desc),'UTF8'))/2>1000) echojson(1,"","请输入不超过500个字的文字描述");
        //商品价格
        $goods_price = isset($_POST['goods_price'])?$_POST['goods_price']:"";
        if(trim($goods_price)=="") echojson(1,'','请输入正确的商品价格');
        //会员价格
        $goods_member_price = isset($_POST['goods_member_price'])?$_POST['goods_member_price']:"";
        if(trim($goods_member_price)=="") echojson(1,'','请输入正确的会员价格');
        if($goods_member_price>$goods_price) echojson(1,'','会员价格不能高于商品价格');
        //计价单位
        $pu_id = isset($_POST['pu_id'])?$_POST['pu_id']:"";
        if(trim($pu_id)=="") echojson(1,'','请选择计价单位');
    }
}
//检测商品编辑
class  GoodsEdit{
    public function __construct(){
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_goods_model');
        $this->postCheck(); 
    }
    public function postCheck(){
        //商品id
        $goods_id = isset($_POST['goods_id'])?$_POST['goods_id']:"";
        if(trim($goods_id)=="") echojson(1,'','异常操作');
        $_goods_info = $this->CI->t_service_goods_model->get($goods_id);
        if($_goods_info==false) echojson(1,'','您可能正在编辑不存在的商品');
        //分类id
        $class_id = isset($_POST['class_id'])?$_POST['class_id']:"";
        if(trim($class_id)=="") echojson(1,'','您需要为商品选择一种类型');
        //商品名称
        $goods_title = isset($_POST['goods_title'])?$_POST['goods_title']:"";
        if(trim($goods_title)=="") echojson(1,'','商品名称不能为空');
        if((strlen(trim($goods_title)) + mb_strlen(trim($goods_title),'UTF8'))/2>120) echojson(1,"","请输入不超过60个字的中文名称");
        if($goods_title!=$_goods_info->goods_title){
            $goods_info= $this->CI->t_service_goods_model->getGoodsInfoByTitle($_goods_info->series_id,$goods_title);
            if($goods_info!=false){
                echojson(1,'','当前系列下已经存在同名商品');
            }
        }
        //商品编码
        $goods_code = isset($_POST['goods_code'])?$_POST['goods_code']:"";
        if(trim($goods_code)=="") echojson(1,'','商品编码不能为空');
        if((strlen(trim($goods_code)) + mb_strlen(trim($goods_code),'UTF8'))/2>30) echojson(1,"","商品编码不能15个字");
        if($goods_code!=$_goods_info->goods_code){
            $goods_info= $this->CI->t_service_goods_model->getGoodsInfoByCode($_goods_info->series_id,$goods_code);
            if($goods_info!=false){
                echojson(1,'','当前系列下已经存在相同编码的商品');
            }
        }
        //商品规格
        $goods_size = isset($_POST['goods_size'])?$_POST['goods_size']:"";
        if(trim($goods_size)=="") echojson(1,'','商品规格不能为空');
        if((strlen(trim($goods_size)) + mb_strlen(trim($goods_size),'UTF8'))/2>50) echojson(1,"","商品编码不能25个字");
        //商品材质
        $goods_material = isset($_POST['goods_material'])?$_POST['goods_material']:"";
        if(trim($goods_material)=="") echojson(1,'','商品材质不能为空');
        if((strlen(trim($goods_material)) + mb_strlen(trim($goods_material),'UTF8'))/2>50) echojson(1,"","商品材质不能25个字");
        ////颜色贴面
        //$color_list = isset($_POST['color_list'])?$_POST['color_list']:"";
        //if(trim($color_list)=="") echojson(1,'','颜色贴图不能为空');
        //$_color_arr = explode(',',$color_list);
        //foreach ($_color_arr as $key=>$val) {
            //$_val = explode('|',$val);
            //if(count($_val)!=3||!file_exists($_SERVER['DOCUMENT_ROOT'].$_val[1])){
                //echojson(1,'','颜色贴面数据填写不完整');
            //}
        //}
        //商品缩略图
        $pic_list = isset($_POST['pic_list'])?$_POST['pic_list']:"";
        if(trim($pic_list)=="") echojson(1,'','商品缩略图不能为空');
        ////商品描述
        $goods_desc = isset($_REQUERT['goods_desc'])?$_REQUERT['goods_desc']:"";
        $goods_desc = $goods_desc?$goods_desc:$_POST['goods_desc'];
        if(trim($goods_desc)=="") echojson(1,'','商品描述不能为空');
        //if((strlen(trim($goods_desc)) + mb_strlen(trim($goods_desc),'UTF8'))/2>1000) echojson(1,"","请输入不超过500个字的文字描述");
        //商品价格
        $goods_price = isset($_POST['goods_price'])?$_POST['goods_price']:"";
        if(trim($goods_price)=="") echojson(1,'','请输入正确的商品价格');
        //会员价格
        $goods_member_price = isset($_POST['goods_member_price'])?$_POST['goods_member_price']:"";
        if(trim($goods_member_price)=="") echojson(1,'','请输入正确的会员价格');
        if($goods_member_price>$goods_price) echojson(1,'','会员价格不能高于商品价格');
        //计价单位
        $pu_id = isset($_POST['pu_id'])?$_POST['pu_id']:"";
        if(trim($pu_id)=="") echojson(1,'','请选择计价单位');
    }
}
