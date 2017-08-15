<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  Vshop extends  Wap_Controller {
    function __construct(){
        parent::__construct();
        loadLib('WinXinSourl');
        $this->SouriObj = new WinXinSourlClass();
        $this->load->model('t_service_wap_slide_model');
        $this->load->model('t_service_shop_model');
        $this->load->model('t_service_info_model');
        $this->load->model('t_like_service_shop_model');
        $this->load->model('t_service_brands_apply_model');
        $this->load->model('t_service_shop_brands_model');
        $this->load->model('t_service_goods_model');
        $this->load->model('t_product_class_model');
        $this->load->model('t_product_brands_series_model');
        $this->load->model('t_service_goods_match_model');
        $this->load->model('t_like_service_goods_model');
    }
    /**
     *description:经销网络列表页
     *author:yanyalong
     *date:2014/04/25
     */
    public function getlist(){
        $this->config->load('uploads');
        $uploadconfig = $this->config->item("serviceShop");		
        $p= isset($_POST['p'])?$_POST['p']:'1';
        $num= isset($_POST['num'])?$_POST['num']:'10';
        $res = $this->t_service_shop_model->getShopListByServiceId($this->SouriObj->service_id,$p,$num);                    
        if($res==false) echojson(1,"","无相关数据");
        $count_res = $this->t_service_shop_model->getShopListByServiceId($this->SouriObj->service_id);
        $data['count'] = count($count_res);
        foreach ($res as $key=>$val) {
            $data['shoplist'][$key]['shop_name'] = $val->shop_name;
            $data['shoplist'][$key]['shop_address'] = $val->shop_address;
            $data['shoplist'][$key]['shop_url'] = $this->url_config['shoprecommend'].$this->SouriObj->sourl."&shop_id=".$val->shop_id;
            $data['shoplist'][$key]['shop_pic1'] = $uploadconfig['relative_thumb_2_path'].$val->shop_pic1;
            $data['shoplist'][$key]['shop_tel'] = $val->shop_tel;
            if(in_array($val->shop_status,array(1,2))){
                $data['shoplist'][$key]['certified_status'] = "1";
            }else{
                $data['shoplist'][$key]['certified_status'] = "0";
            }
        }
        echojson(0,$data);
    }
    /**
     *description:门店详情
     *author:yanyalong
     *date:2014/04/26
     */
    public function info(){
        $shop_id= isset($_POST['shop_id'])?$_POST['shop_id']:'';
        if($shop_id=="") echojson(1,"","操作异常");
        $this->config->load('uploads');
        $uploadconfig = $this->config->item("serviceShop");		
        $res = $this->t_service_shop_model->get($shop_id);
        if($res==false) echojson(1,"","您正在操作一个不存在的门店");
        $data['shop_about'] = $res->shop_explain;
        $data['shop_address'] = $res->shop_address;
        $data['shop_longitude'] = $res->shop_longitude;
        $data['shop_latitude'] = $res->shop_latitude;
        $data['shop_tel'] = $res->shop_tel;
        for ($i=1; $i<4; $i++) {
            $pic = 'shop_pic'.$i;
            if($res->$pic!=""){
                $data['shop_pic'][] = $uploadconfig['relative_thumb_3_path'].$res->$pic;
            }
        }
        if($this->user_id==""){
            $data['is_like'] = "0";
        }else{
            $data['is_like'] = $this->t_like_service_shop_model->is_like($this->user_id,$shop_id);
        }
        if(in_array($res->shop_status,array(1,2))){
            $data['certified_status'] = "1";
        }else{
            $data['certified_status'] = "0";
        }
        echojson(0,$data);
    }
    /**
     *description:联系我们
     *author:yanyalong
     *date:2014/04/26
     */
    public function index(){
        $service_id = $this->SouriObj->service_id;
        if($service_id==false) echojson(1,"","操作异常");
        $res = $this->t_service_info_model->get($service_id);
        if($res==false) echojson(1,"","数据异常");
        if($res->service_status<21)  $data['join_status'] = "1"; 
        else $data['join_status'] = "0"; 
        $data['service_company'] = $res->service_company;
        $data['service_email'] = $res->service_email;
        $data['service_person'] = $res->service_person;
        $data['service_person_work'] = $res->service_person_work;
        $data['service_person_phone'] = $res->service_person_phone;
        $data['service_desc'] = $res->service_desc;
        echojson(0,$data);
    }
    /**
     *description:收藏门店
     *author:yanyalong
     *date:2014/06/21
     */
    public function like(){
        $this->checkLogin();
        $user_id = $this->user_id;
        $shop_id = isset($_POST['shop_id'])?$_POST['shop_id']:'';
        $is_like = $this->t_like_service_shop_model->is_like($user_id,$shop_id);		
        if($is_like=='1'){
            if($this->t_like_service_shop_model->del_like($user_id,$shop_id)!=false){
                echojson(0,"",'取消成功');
            }else{
                echojson(1,"",'取消失败');
            }
        }else{
            $this->t_like_service_shop_model->shop_id = $shop_id;
            $this->t_like_service_shop_model->user_id = $user_id;
            if($this->t_like_service_shop_model->insert()!=false){
                echojson(0,"",'收藏成功');
            }else{
                echojson(1,"",'收藏失败');
            }
        }
    }
    /**
     *description:店铺商品选项
     *author:yanyalong
     *date:2014/06/21
     */
    public function shopGoodsOptions(){
        $shop_id = isset($_POST['shop_id'])?$_POST['shop_id']:'';
        //获取门店关联品牌
        $brands = $this->t_service_shop_brands_model->getBrandsByShop($shop_id);
        if($brands==false){
            $brands_select[0] = "";
        }else{
            foreach ($brands as $key=>$val) {
                $brands_select[$key] = $val->brand_id;
            }
        }
        $brandsList = $this->t_service_brands_apply_model->getBrandsListByUid($this->SouriObj->service_id);
        if($brandsList==false){
            $data['brands'] = "";
        }else{
            $data['brands'] = "";
            $brandstr = "";
            foreach ($brandsList as $key=>$val) {
                if(in_array($val->brand_id,$brands_select)){
                    $data['brands'][$key]['brand_id'] = $val->brand_id;
                    $data['brands'][$key]['brand_name'] = $val->apply_brand_name;
                    $brandstr .=$val->brand_id.",";
                }
            }
            if(!empty($data['brands'])){
                $data['brands'] = array_values($data['brands']);
            }
            ////获取品牌下商品列表
            //$goodslist= $this->t_service_goods_model->getGoodsListByBrand(trim($brandstr,','));
            ////获取门店关联品牌所涉及小分类
            //$classlist = "";
            //foreach ($goodslist as $key=>$val) {
            //$classlist .=$val->pc_id.","; 
            //}
            //$classlist = $this->t_product_class_model->getListByIdList(trim($classlist,','));
            //foreach ($classlist as $key=>$val) {
            //$data['classlist'][$key]['class_id'] = $val->pc_id;
            //$data['classlist'][$key]['class_name'] = $val->pc_name;
            //}
            ////获取品牌下系列列表
            //$res = $this->t_product_brands_series_model->getSeriesByBrand($this->SouriObj->service_id,trim($brandstr,','),2);
            //if($res==false)  echojson(1,"","无相关选项");
            //$series = array();
            //foreach ($res as $keys=>$vals) {
            //if($vals->series_name!='默认系列'){
            //$data['series'][$keys]['series_id'] = $vals->series_id;
            //$data['series'][$keys]['series_name'] = $vals->series_name;
            //}
            //}
        }
        $data['series'] = "";
        $data['classlist'] = "";
        echojson(0,$data);
    }
    /**
     *description:获取店铺商品数据
     *author:yanyalong
     *date:2014/06/22
     */
    public function getShopGoods(){
        $service_id = $this->SouriObj->service_id;
        $p= isset($_POST['p'])?$_POST['p']:"";
        $series_id = isset($_POST['series_id'])?$_POST['series_id']:"";
        $brand_id = isset($_POST['brand_id'])?$_POST['brand_id']:"";
        $class_id = isset($_POST['class_id'])?$_POST['class_id']:"";
        $shop_id= isset($_POST['shop_id'])?$_POST['shop_id']:"";
        $num= isset($_POST['num'])?$_POST['num']:"";
        $goodslist = $this->t_service_goods_model->getGoodsList($service_id,$class_id,$brand_id,$series_id,"",$p,$num);
        if($goodslist==false) {
            $data['goods_list'] = ""; 
            $data['count'] = 0;
            $data['current_count'] = 0;
            echojson(1,"","无相关数据");
        }else{
            $countres = $this->t_service_goods_model->getGoodsList($service_id,$class_id,$brand_id,$series_id);
            $data['current_count'] = count($goodslist);
            $data['count'] = count($countres);
            if($goodslist==false){
                $data['goods_list'] = "";
            }
            $this->config->load('uploads');		
            $goods_thumb_config = $this->config->item("ServiceSeriesGoodsThumb");		
            foreach ($goodslist as $key=>$val) {
                $data['goods_list'][$key]['goods_url'] = $this->url_config['goodsinfo'].$this->SouriObj->sourl."&shop_id=".$shop_id."&goods_id=".$val->goods_id;
                $data['goods_list'][$key]['goods_name'] = $val->goods_title;
                $data['goods_list'][$key]['goods_price'] = $val->goods_price;
                $data['goods_list'][$key]['goods_pic'] =$goods_thumb_config['relative_thumb_1_path'].$val->goods_pic1;
            }
            echojson(0,$data);
        }
    }
    /**
     *description:店长推荐
     *author:yanyalong
     *date:2014/06/22
     */
    public function recommend(){
        $shop_id = isset($_POST['shop_id'])?$_POST['shop_id']:'52';
        //店铺橱窗
        $service_id = $this->SouriObj->service_id;
        $slide_list = $this->t_service_wap_slide_model->getSlideListByService($service_id,0,$shop_id); 
        if($slide_list==false){
            $slide_list = $this->t_service_wap_slide_model->getSlideListByService($service_id,1); 
            if($slide_list==false) echojson(1,"","数据异常");
        }
        $this->config->load('uploads');	
        $uploads_config = $this->config->item("serviceFlash");
        foreach ($slide_list as $key=>$val) {
            $data['slide'][$key]['slide_url'] =$val->slide_url.$this->SouriObj->sourl;
            $data['slide'][$key]['slide_pic'] = $uploads_config['relative_thumb_1_path'].$val->slide_pic;
        }
        //热门排行 
        $goods_rank_list = $this->t_like_service_goods_model->getRankByShopId($shop_id,1,5);
        $goods_config = $this->config->item("ServiceSeriesGoodsThumb");
        foreach ($goods_rank_list as $key=>$val) {
            $data['goods_rank'][$key]['goods_url'] = $this->url_config['goodsinfo'].$this->SouriObj->sourl."&shop_id=".$shop_id."&goods_id=".$val->goods_id;
            $data['goods_rank'][$key]['goods_title'] = $val->goods_title;
            $data['goods_rank'][$key]['goods_likes'] = $val->like_count; 
            $data['goods_rank'][$key]['goods_pic'] =$goods_config['relative_thumb_1_path'].$val->goods_pic1;
        }
        //优惠套餐
        $match_list = $this->t_service_goods_match_model->getList($service_id);
        $match_config = $this->config->item("serviceGoodsMatch");
        foreach ($match_list as $key=>$val) {
            $data['packs'][$key]['pack_url'] = "#";
            $data['packs'][$key]['pack_pic'] = $match_config['relative_thumb_2_path'].$val->gm_pic;
            $data['packs'][$key]['pack_title'] = $val->gm_name;
            $goods_price = $this->t_service_goods_model->getListByIdList($val->gm_list);
            $data['packs'][$key]['all_price'] = 0;
            foreach ($goods_price as $keys=>$vals) {
                $data['packs'][$key]['all_price'] += $vals->goods_price;
            }
            $data['packs'][$key]['pack_price'] = $val->gm_price;
        }
        //促销活动
        for ($i = 0; $i <5; $i++) {
            $data['acts'][$i]['act_url'] = "#";
            $data['acts'][$i]['act_title'] = "促销活动".rand(1,99);
            $data['acts'][$i]['act_likes'] = rand(1,999);
        }
        echojson(0,$data);
    }
    /**
     *description:根据品牌获取门店和系列
     *author:yanyalong
     *date:2014/06/25
     */
    public function getShopSeriesByBrand(){
        $brand_id= isset($_POST['brand_id'])?$_POST['brand_id']:'';
        if($brand_id==""){
            $data['classlist'] = "";
            $data['series'] = "";
        }else{
            //获取品牌下商品列表
            $goodslist= $this->t_service_goods_model->getGoodsListByBrand($brand_id);
            if($goodslist==false){
                $data['classlist'] = ""; 
                $data['series'] = ""; 
            }else{
            //获取门店关联品牌所涉及小分类
            $classlist = "";
            foreach ($goodslist as $key=>$val) {
                $classlist .=$val->pc_id.","; 
            }
            $classlist = $this->t_product_class_model->getListByIdList(trim($classlist,','));
            foreach ($classlist as $key=>$val) {
                $data['classlist'][$key]['class_id'] = $val->pc_id;
                $data['classlist'][$key]['class_name'] = $val->pc_name;
            }
            //获取品牌下系列列表
            $res = $this->t_product_brands_series_model->getSeriesByBrand($_REQUEST['service_id'],$brand_id,2);
            if($res==false) $data['series'] = "";
            else{
                $series = array();
                foreach ($res as $keys=>$vals) {
                    $data['series'][$keys]['series_id'] = $vals->series_id;
                    $data['series'][$keys]['series_name'] = $vals->series_name;
                }
            }
            }
        }
        echojson(0,$data);
    }
}
