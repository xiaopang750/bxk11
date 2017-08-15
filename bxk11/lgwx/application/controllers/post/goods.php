
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:商品管理
 *author:yanyalong
 *date:2014/04/08
 */
class goods extends  MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('t_system_class_model');
        $this->load->model('t_product_brands_model');
        $this->load->model('t_product_brands_series_model');
        $this->load->model('t_service_goods_model');
        $this->load->model('t_service_goods_match_model');
    }
    /**
     *description:添加商品
     *author:yanyalong
     *date:2014/04/08
     */
    public function add(){
        $this->CheckAccessByKey('goods_add');
        loadLib('SeriesGoodsFormCheck');
        SeriesGoodsFormCheckFactory::createObj('add');
        $_series_id = $_POST['series_id'];
        $pc_id= $_POST['class_id'];
        $_goods_title= $_POST['goods_title'];
        $goods_model_number= $_POST['goods_model_number'];
        $_goods_code= $_POST['goods_code'];
        $_goods_size  = $_POST['goods_size'];
        $_goods_material = $_POST['goods_material'];
        $_pic_list= $_POST['pic_list'];
        $goods_recommend_list= $_POST['goods_recommend'];//商品id
        $_goods_price= $_POST['goods_price'];
        $goods_member_price= $_POST['goods_member_price'];
        $pu_id= $_POST['pu_id'];
        $goods_price_is_show= $_POST['goods_price_is_show'];
        $goods_desc = isset($_REQUERT['goods_desc'])?$_REQUERT['goods_desc']:"";
        $goods_desc = $goods_desc?$goods_desc:$_POST['goods_desc'];
        $_goods_desc=  htmlspecialchars($goods_desc);
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $this->config->load('uploads');		
        $goods_thumb_config = $this->config->item("ServiceSeriesGoodsThumb");		
        $this->load->library('upload');
        $timedir = $this->upload->mktimedir($goods_thumb_config['service_path']);
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        //商品缩略图
        $this->upload->mktimedir($goods_thumb_config['thumb_1']);
        $this->upload->mktimedir($goods_thumb_config['thumb_2']);
        $this->upload->mktimedir($goods_thumb_config['thumb_3']);
        $this->upload->mktimedir($goods_thumb_config['thumb_4']);
        $_pic_arr = explode('|',$_pic_list);
        foreach ($_pic_arr as $key=>$val) {
            $goods_img = basename($val);
            if(file_exists($goods_thumb_config['upload_path'].$goods_img)){
                copy($goods_thumb_config['upload_path'].$goods_img,$timedir.$goods_img);
                //unlink($goods_thumb_config['upload_path'].$goods_img);
                $goods_img_flag = true; 
            }else{
                $goods_img_flag = false; 
            }
            $this->load->library('image_lib');	
            $sourceimg = $goods_thumb_config['service_path'].$time_relative_path.$goods_img;
            ($this->image_lib->goods_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
            $goods_pic= 'goods_pic'.strval($key+1);
            $this->t_service_goods_model->$goods_pic = ($goods_img_flag==false)?"":$time_relative_path.$goods_img;
        }
        $recommend_list = str_replace('，', ',', trim($goods_recommend_list));
        $recommend_arr = explode(',', str_replace('，', ',', $recommend_list));
        if(count($recommend_arr)>10) echojson('1','','商品相关推荐最多10个'); 
        $this->t_service_goods_model->service_id= (isset($_SESSION['service_id']))?$_SESSION['service_id']:"";
        $_series_info  = $this->t_product_brands_series_model->get($_series_id);
        $this->t_service_goods_model->brand_id= $_series_info->brand_id;
        $this->t_service_goods_model->pc_id= $pc_id;
        $this->t_service_goods_model->series_id= $_series_id;
        $this->t_service_goods_model->goods_title= $_goods_title;
        $this->t_service_goods_model->goods_price= $_goods_price;
        $this->t_service_goods_model->goods_member_price= $goods_member_price;
        $this->t_service_goods_model->goods_code= $_goods_code;
        $this->t_service_goods_model->goods_size= $_goods_size;
        $this->t_service_goods_model->goods_addtime=  date("Y-m-d H:i:s");
        $this->t_service_goods_model->goods_material= $_goods_material;
        $this->t_service_goods_model->pu_id= $pu_id;
        $this->t_service_goods_model->goods_desc= $_goods_desc;
        $this->t_service_goods_model->goods_model_number= $goods_model_number;
        $this->t_service_goods_model->goods_price_is_show= $goods_price_is_show;
        $this->t_service_goods_model->goods_status= 1;
        $this->t_service_goods_model->goods_recommend = $recommend_list;
        $goods_id = $this->t_service_goods_model->insert();
        $url = $this->actionList->goods_list."&series_id=".$_series_id;
        ($goods_id!=false)?echojson(0,$url,"商品添加成功"):echojson(1,$url,"商品添加失败");

    }
    /**
     *description:编辑商品
     *author:yanyalong
     *date:2014/03/26
     */
    public function edit(){
        $this->CheckAccessByKey('goods_edit');
        loadLib('SeriesGoodsFormCheck');
        SeriesGoodsFormCheckFactory::createObj('edit');
        $_goods_id = $_POST['goods_id'];
        $pc_id= $_POST['class_id'];
        $_goods_title= $_POST['goods_title'];
        $_goods_code= $_POST['goods_code'];
        $_goods_size  = $_POST['goods_size'];
        $_goods_material = $_POST['goods_material'];
        $_pic_list= $_POST['pic_list'];
        $goods_recommend_list= $_POST['goods_recommend'];//商品id
        $_goods_price= $_POST['goods_price'];
        $goods_member_price= $_POST['goods_member_price'];
        $goods_desc = isset($_REQUERT['goods_desc'])?$_REQUERT['goods_desc']:"";
        $goods_desc = $goods_desc?$goods_desc:$_POST['goods_desc'];
        $_goods_desc=  htmlspecialchars($goods_desc);
        $goods_model_number= $_POST['goods_model_number'];
        $pu_id= $_POST['pu_id'];
        $goods_price_is_show= $_POST['goods_price_is_show'];
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $this->config->load('uploads');		
        $goods_thumb_config = $this->config->item("ServiceSeriesGoodsThumb");		
        $this->load->library('upload');
        $timedir = $this->upload->mktimedir($goods_thumb_config['service_path']);
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        //获取商品信息
        $_goods_info  = $this->t_service_goods_model->get($_goods_id);
        if($_goods_info==false||$_goods_info->goods_status>10)
            echojson(1,"","异常操作，您可能正在操作一个不存在的商品");
        //商品缩略图
        $_pic_arr = explode('|',$_pic_list);
        $this->load->library('image_lib');	
        $this->upload->mktimedir($goods_thumb_config['thumb_1']);
        $this->upload->mktimedir($goods_thumb_config['thumb_2']);
        $this->upload->mktimedir($goods_thumb_config['thumb_3']);
        $this->upload->mktimedir($goods_thumb_config['thumb_4']);
        for ($i = 0; $i <5; $i++) {
            $goods_pic= 'goods_pic'.strval($i+1);
            $data[$goods_pic] = "";
        }
        foreach ($_pic_arr as $key=>$val) {
            $goods_pic= 'goods_pic'.strval($key+1);
            $goods_img = basename($val);
                if(file_exists($_SERVER['DOCUMENT_ROOT'].$val)&&strpos($val,'/thumb_1/')){
                    $pic_data = explode("thumb_1/",$val);
                    $data[$goods_pic] = $pic_data['1'];
            }elseif(file_exists($goods_thumb_config['upload_path'].$goods_img)){
                copy($goods_thumb_config['upload_path'].$goods_img,$timedir.$goods_img);
                unlink($goods_thumb_config['upload_path'].$goods_img);
                $data[$goods_pic] = $time_relative_path.$goods_img;
            $sourceimg = $timedir.$goods_img;
            ($this->image_lib->goods_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
            }else{
                $data[$goods_pic] =  "";
            }
        }
        $recommend_list = str_replace('，', ',', trim($goods_recommend_list));
        $recommend_arr = explode(',', str_replace('，', ',', $recommend_list));
        if(count($recommend_arr)>10) echojson('1','','商品相关推荐最多10个'); 
        $data['pc_id']= $pc_id;
        $data['goods_title']= $_goods_title;
        $data['goods_price']= $_goods_price;
        $data['goods_member_price']= $goods_member_price;
        $data['goods_model_number']= $_POST['goods_model_number'];
        $data['pu_id']= $_POST['pu_id'];
        $data['goods_price_is_show']= $_POST['goods_price_is_show'];
        $data['goods_code']= $_goods_code;
        $data['goods_size']= $_goods_size;
        $data['goods_material']= $_goods_material;
        $data['goods_recommend']= $recommend_list;
        $data['goods_desc']=  htmlspecialchars($_goods_desc);
        $updateFlag = $this->t_service_goods_model->updates_global($data,array('goods_id'=>$_goods_id));
        $url = $this->actionList->goods_list;
        ($updateFlag!=false)?echojson(0,$url,"操作成功"):echojson(1,$url,"操作失败");
    }
    /**
     *description:删除商品
     *author:yanyalong
     *date:2014/04/09
     */
    public function del(){
        $this->CheckAccessByKey('goods_edit');
        safeFilter();
        $_goods_id = isset($_POST['goods_id'])?$_POST['goods_id']:echojson(0,$url,"异常操作");
        $data['goods_status']= 99;
        $updateFlag = $this->t_service_goods_model->updates_global($data,array('goods_id'=>$_goods_id));
        ($updateFlag!=false)?echojson(0,"","操作成功"):echojson(0,"","操作失败");
    }
    /**
     *description:商品搭配添加
     *author:yanyalong
     *date:2014/06/13
     */
    public function matchadd(){
        $this->CheckAccessByKey('goods_match_add');
        $gm_name = isset($_POST['gm_name'])?$_POST['gm_name']:"";
        $service_id= (isset($_SESSION['service_id']))?$_SESSION['service_id']:"";
        $gm_price = isset($_POST['gm_price'])?$_POST['gm_price']:echojson(1,"","请输入套餐价");//套餐价
        if(!is_numeric($gm_price)) echojson(1,'','套餐价不是数字');
        if(trim($gm_name)=="") echojson(1,'','搭配名称不能为空');
        if((strlen(trim($gm_name)) + mb_strlen(trim($gm_name),'UTF8'))/2>50) echojson(1,"","请输入不超过25个字的中文名称");
        $gm_info= $this->t_service_goods_match_model->getGmInfoByName($service_id,$gm_name);
        if($gm_info!=false){
            echojson(1,'','您已经添加过同名搭配了');
        }
        $_gm_pic = $_POST['gm_pic'];
        if(trim($_gm_pic)=="") echojson(1,'','您必须为商品搭配上传一张封面图片');
        $gm_list = explode(',',$_POST['gm_list']);
        if(count($gm_list)<2) echojson(1,'','您必须为您的商品搭配选择最少2个商品');
        if(count($gm_list)>10) echojson(1,'','您最多为您的商品搭配选择10个商品');
        $count = 0;
        foreach ($gm_list as $key => $value) {
            $goodsR = $this->t_service_goods_model->get($value);
            if($goodsR){
                $count = $count+($goodsR->goods_price);
            }
        }
        if($gm_price>$count) echojson(1,'','套餐价格不高于总原价');

        $this->load->library('upload');
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $this->config->load('uploads');	
        $this->load->library('image_lib');
        $config = $this->config->item("serviceGoodsMatch");
        $timedir = $this->upload->mktimedir($config['service_path']);
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        $this->upload->mktimedir($config['service_path']);
        $gm_pic= basename($_gm_pic);
        $gm_pic_flag = (file_exists($_SERVER['DOCUMENT_ROOT'].$_gm_pic))?(copy($_SERVER['DOCUMENT_ROOT'].$_gm_pic,$timedir.$gm_pic)):false;
        $this->load->library('image_lib');	
        $sourceimg = $config['service_path'].$time_relative_path.$gm_pic;
        $this->upload->mktimedir($config['thumb_1']);
        $this->upload->mktimedir($config['thumb_2']);
        $this->upload->mktimedir($config['thumb_3']);
        $this->upload->mktimedir($config['thumb_4']);
        ($this->image_lib->goods_match_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
        $this->t_service_goods_match_model->gm_pic= ($gm_pic_flag==false)?"":$time_relative_path.$gm_pic;
        $this->t_service_goods_match_model->gm_name = $gm_name;
        $this->t_service_goods_match_model->gm_list = implode(',',$gm_list);
        $this->t_service_goods_match_model->gm_desc = "";
        $this->t_service_goods_match_model->service_id= $service_id;
        $this->t_service_goods_match_model->gm_price = $gm_price;
        $gm_id = $this->t_service_goods_match_model->insert();
        if($gm_id!=false) echojson(0,$this->actionList->goods_match_list,'添加成功');
        else echojson(1,'','添加失败');
    }
    /**
     *description:商品搭配编辑
     *author:yanyalong
     *date:2014/06/13
     */
    public function matchedit(){
        $this->CheckAccessByKey('goods_match_edit');
        $gm_id = isset($_POST['gm_id'])?$_POST['gm_id']:echojson(1,"","参数异常");
        $gminfo = $this->t_service_goods_match_model->get($gm_id);
        $gm_name = isset($_POST['gm_name'])?$_POST['gm_name']:"";
        $service_id= (isset($_SESSION['service_id']))?$_SESSION['service_id']:"";
        if(trim($gm_name)=="") echojson(1,'','搭配名称不能为空');
        $gm_price = isset($_POST['gm_price'])?$_POST['gm_price']:0;//套餐价
        //$gm_ma_price = isset($_POST['gm_ma_price'])?$_POST['gm_ma_price']:0;//套餐价
        if(!is_numeric($gm_price)) echojson(1,'','套餐价不是数字');
        if((strlen(trim($gm_name)) + mb_strlen(trim($gm_name),'UTF8'))/2>50) echojson(1,"","请输入不超过25个字的中文名称");
        $gm_info= $this->t_service_goods_match_model->getGmInfoByName($service_id,$gm_name);
        if($gm_info!=false&&$gm_info->gm_name!=$gm_name){
            echojson(1,'','您已经添加过同名搭配了');
        }

        $_gm_pic = $_POST['gm_pic'];
        if(trim($_gm_pic)=="") echojson(1,'','您必须为商品搭配上传一张封面图片');
        $gm_list = explode(',',$_POST['gm_list']);
        if(count($gm_list)<2) echojson(1,'','您必须为您的商品搭配选择最少2个商品');
        if(count($gm_list)>10) echojson(1,'','您最多为您的商品搭配选择10个商品');
        $count = 0;
        foreach ($gm_list as $key => $value) {
            $goodsR = $this->t_service_goods_model->get($value);
            if($goodsR){
                $count = $count+($goodsR->goods_price);
            }
        }
        if($gm_price>$count) echojson(1,'','套餐价格不高于总原价');
        $gm_pic= basename($_gm_pic);
        if(basename($gm_info->gm_pic)!=$gm_pic){
            $this->load->library('upload');
            $time = time();
            $joinTime = date('Y-m-d H:i:s',$time);
            $this->config->load('uploads');	
            $this->load->library('image_lib');
            $config = $this->config->item("serviceGoodsMatch");
            $timedir = $this->upload->mktimedir($config['service_path']);
            $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
            $this->upload->mktimedir($config['service_path']);
            $gm_pic_flag = (file_exists($_SERVER['DOCUMENT_ROOT'].$_gm_pic))?(copy($_SERVER['DOCUMENT_ROOT'].$_gm_pic,$timedir.$gm_pic)):false;
            $this->load->library('image_lib');	
            $sourceimg = $config['service_path'].$time_relative_path.$gm_pic;
            $this->upload->mktimedir($config['thumb_1']);
            $this->upload->mktimedir($config['thumb_2']);
            $this->upload->mktimedir($config['thumb_3']);
            $this->upload->mktimedir($config['thumb_4']);
            ($this->image_lib->goods_match_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
            $data['gm_pic'] = ($gm_pic_flag==false)?"":$time_relative_path.$gm_pic;
        }
        $data['gm_name'] = $gm_name;
        $data['gm_list'] = implode(',',$gm_list);
        $data['gm_price'] = $gm_price;
        $updateFlag = $this->t_service_goods_match_model->updates_global($data,array('gm_id'=>$_POST['gm_id']));
        if($updateFlag!=false) echojson(0,$this->actionList->goods_match_list,'操作成功');
        else echojson(1,'','操作失败');
    }
    /**
     *description:商品搭配删除
     *author:yanyalong
     *date:2014/06/13
     */
    public function matchdel(){
        $this->CheckAccessByKey('goods_match_edit');
        $gm_id = isset($_POST['gm_id'])?$_POST['gm_id']:echojson(0,$url,"异常操作");
        $res = $this->t_service_goods_match_model->delete($gm_id);
        ($res!=false)?echojson(0,"","操作成功"):echojson(1,"","操作失败");
    }
}
