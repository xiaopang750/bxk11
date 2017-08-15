<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  Vgoods extends  Wap_Controller {
    function __construct(){
        parent::__construct();
        loadLib('WinXinSourl');
        $this->SouriObj = new WinXinSourlClass();
        $this->load->model('t_product_brands_series_model');
        $this->load->model('t_product_brands_model');
        $this->load->model('t_like_service_goods_model');
        $this->load->model('t_user_info_model');
        $this->load->model('t_service_goods_model');
        $this->load->model('t_service_goods_match_model');
        $this->load->model('t_service_shop_brands_model');
        $this->load->model('t_service_shop_model');
        $this->load->model('t_product_class_brands_model');
        $this->load->model('t_user_note_model');
        $this->load->model('t_product_class_model');
        $this->load->model('t_service_info_model');
        $this->load->model('t_service_brands_apply_model');
    }
    /**
     *description:在线商城搜索项数据
     *author:yanyalong
     *date:2014/04/26
     */
    public function searchoptions(){
        $this->config->load('status');	
        $config = $this->config->item("wap_apply_brand_search");		
        $apply_status= $config['1'];
        $brandsList = $this->t_service_brands_apply_model->getApplyBrandsByServiceId($this->SouriObj->service_id,$apply_status);
        if($brandsList==false){
            $data['brands'] = "";
        }else{
            $data['brands'] = "";
            $brandstr = "";
            foreach ($brandsList as $key=>$val) {
                $data['brands'][$key]['brand_id'] = $val->brand_id;
                $data['brands'][$key]['brand_name'] = $val->apply_brand_name;
                $brandstr .=$val->brand_id.",";
            }
            if(!empty($data['brands'])){
                $data['brands'] = array_values($data['brands']);
            }
        }
        $data['series'] = "";
        $data['classlist'] = "";
        echojson("0",$data);
    }
    /**
     *description:商品搜索
     *author:yanyalong
     *date:2014/04/26
     */
    public function getlist(){
        $service_id= isset($_POST['service_id'])?$_POST['service_id']:"";
        $p= isset($_POST['p'])?$_POST['p']:"";
        $series_id = isset($_POST['series_id'])?$_POST['series_id']:"";
        $brand_id = isset($_POST['brand_id'])?$_POST['brand_id']:"";
        $class_id = isset($_POST['class_id'])?$_POST['class_id']:"";
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
            //获取服务商在线商城
            $service_shop = $this->t_service_shop_model->getShopByServiceJoin($service_id,"1");
            if($service_shop==false)  
            echojson(1,"","未检测到在线商城");
            foreach ($goodslist as $key=>$val) {
                $data['goods_list'][$key]['goods_url'] = $this->url_config['goodsinfo'].$this->SouriObj->sourl."&shop_id=".$service_shop->shop_id."&goods_id=".$val->goods_id;
                $data['goods_list'][$key]['goods_name'] = $val->goods_title;
                $data['goods_list'][$key]['goods_price'] = $val->goods_price;
                $data['goods_list'][$key]['goods_pic'] =$goods_thumb_config['relative_thumb_1_path'].$val->goods_pic1;
            }
            echojson(0,$data);
        }
    }
    /**
     *description:收藏商品
     *author:yanyalong
     *date:2014/04/26
     */
    public function like(){
        $this->checkLogin();
        $user_id = $this->user_id;
        $goods_id= isset($_POST['goods_id'])?$_POST['goods_id']:'';
        $shop_id= isset($_POST['shop_id'])?$_POST['shop_id']:'';
        $is_like = $this->t_like_service_goods_model->is_like($user_id,$goods_id,$shop_id);		
        if($is_like=='1'){
            if($this->t_like_service_goods_model->del_like($user_id,$goods_id,$shop_id)!=false){
                echojson(0,"",'取消成功');
            }else{
                echojson(1,"",'取消失败');
            }
        }else{
            $this->t_like_service_goods_model->goods_id = $goods_id;
            $this->t_like_service_goods_model->user_id = $user_id;
            $this->t_like_service_goods_model->shop_id= $shop_id;
            $this->t_like_service_goods_model->like_addtime= date("Y-m-d H:i:s");
            if($this->t_like_service_goods_model->insert()!=false){
                echojson(0,"",'收藏成功');
            }else{
                echojson(1,"",'收藏失败');
            }
        }
    }
    /**
     *description:商品详情
     *author:yanyalong
     *date:2014/04/26
     */
    public function info(){
        $goods_id= isset($_POST['goods_id'])?$_POST['goods_id']:'';
        $shop_id= isset($_POST['shop_id'])?$_POST['shop_id']:'';
        if($shop_id==""){
            $_shopinfo = $this->t_service_shop_model->getShopByServiceId($this->SouriObj->service_id,'1','',"1"); 
            $shopinfo = $_shopinfo['0'];
        }else{
            $shopinfo = $this->t_service_shop_model->get($shop_id); 
        }
        $res = $this->t_service_goods_model->get($goods_id);		
        if($res==false) echojson(1,"","您正在操作一个不存在的商品");
        $data['goods_code'] = $res->goods_code;
        $data['goods_size'] = $res->goods_size;
        $data['goods_materials'] = $res->goods_material;
        $data['goods_desc'] = $res->goods_desc;
        //获取商品收藏数
        $goodslikes = $this->t_like_service_goods_model->getAll('',array('goods_id'=>$goods_id));
        $data['goodslikes'] = count($goodslikes);
        $data['sales'] = "";
        $data['goods_url'] = $_SERVER['HTTP_HOST'].$this->url_config['goodsinfo']."&service_id=".$this->SouriObj->service_id."&goods_id=".$goods_id;
        //$seriesinfo = $this->t_product_brands_series_model->get($res->series_id);		
        //if($seriesinfo==false) $data['goods_series'] = "";
        //$data['goods_series'] = $seriesinfo->series_name;
        $this->config->load('uploads');		
        $goods_thumb_config = $this->config->item("ServiceSeriesGoodsThumb");		
        for ($i = 1; $i <=5; $i++) {
            $goods_pic = "goods_pic".$i;
            if($res->$goods_pic!=""){
                $data['goods_piclist'][] = $goods_thumb_config['relative_thumb_3_path'].$res->$goods_pic;				
            }
        }
        $data['goods_member_price'] = $res->goods_member_price;
        $data['goods_price'] = $res->goods_price;
        if($this->user_id==""){
            $data['is_like'] = "0";
        }else{
            $data['is_like'] = $this->t_like_service_goods_model->is_like($this->user_id,$goods_id,$shop_id);
        }
        if($res->goods_recommend==""){
                $data['goods_recommend_list'] = "";
        }else{
        $goods_recommend_list= $this->t_service_goods_model->getListByIdList($res->goods_recommend);
        if($goods_recommend_list==false){
            $data['goods_recommend_list'] = "";
        }else{
            //获取服务商在线商城
            $service_shop = $this->t_service_shop_model->getShopByServiceJoin($this->SouriObj->service_id,"1");
            if($service_shop==false)  
            echojson(1,"","未检测到在线商城");
            foreach ($goods_recommend_list as $key=>$val) {
                $data['goods_recommend_list'][$key]['goods_pic'] = $goods_thumb_config['relative_thumb_1_path'].$val->goods_pic1;				
                $data['goods_recommend_list'][$key]['goods_name'] = $val->goods_title;				
                $data['goods_recommend_list'][$key]['goods_url'] = $this->url_config['goodsinfo'].$this->SouriObj->sourl."&shop_id=".$service_shop->shop_id."&goods_id=".$val->goods_id;
            }
        }
        }
        //装修案例
        $data['goods_scheme_list'][0]['scheme_name'] = "80平方米客厅地中海风格装修";
        $data['goods_scheme_list'][0]['scheme_url'] = "";
        $data['goods_scheme_list'][0]['scheme_likes'] = rand(1,999);
        $data['goods_scheme_list'][1]['scheme_name'] = "30平方米主卧地中海风格装修";
        $data['goods_scheme_list'][1]['scheme_url'] = "";
        $data['goods_scheme_list'][1]['scheme_likes'] = rand(1,999);
        $data['goods_scheme_list'][2]['scheme_name'] = "15平方米厨房简约风格装修";
        $data['goods_scheme_list'][2]['scheme_url'] = "";
        $data['goods_scheme_list'][2]['scheme_likes'] = rand(1,999);
        $data['goods_scheme_list'][3]['scheme_name'] = "24平方米主次卧新中式风格装修";
        $data['goods_scheme_list'][3]['scheme_url'] = "";
        $data['goods_scheme_list'][3]['scheme_likes'] = rand(1,999);
        //经销网点
        $shoplist= $this->t_service_shop_brands_model->getShopsByBrand($this->SouriObj->service_id,$res->brand_id);
        $data['shop_list'] = "";
        if($shoplist!=false){
            $i=0;
            foreach ($shoplist as $key=>$val) {
                if($shop_id==$val->shop_id){
                    $data['shop_list'][$i]['shop_name'] = $val->shop_name;
                    if($val->shop_status!="1"){
                        $data['shop_list'][$i]['shop_url'] = $this->url_config['shopinfo'].$this->SouriObj->sourl."&shop_id=".$val->shop_id;
                    }else{
                        $data['shop_list'][$i]['shop_url'] = $this->url_config['goodslist'].$this->SouriObj->sourl;
                    }
                    $i++;
                }
            }
            foreach ($shoplist as $key=>$val) {
                if($shopinfo->shop_id!=$val->shop_id){
                    $data['shop_list'][$i]['shop_name'] = $val->shop_name;
                    if($val->shop_status!="1"){
                        $data['shop_list'][$i]['shop_url'] = $this->url_config['shopinfo'].$this->SouriObj->sourl."&shop_id=".$val->shop_id;
                    }else{
                        $data['shop_list'][$i]['shop_url'] = $this->url_config['goodslist'].$this->SouriObj->sourl;
                    }
                    $i++;
                }
            }
        }
        //装修笔记，获取门店名称
        //获取品牌名称
        $brand_info = $this->t_product_brands_model->get($res->brand_id);    
        $data['addnote']['date'] = date("Y年m月d日");
        $service_info = $this->t_service_info_model->get($this->SouriObj->service_id);
        $data['addnote']['showmsg'] = "我在".$service_info->service_name.$shopinfo->shop_name."体验了".$brand_info->brand_name.$res->goods_title;
        $data['addnote']['savemsg'] = "我体验了".$brand_info->brand_name.$res->goods_title;
        $data['shop_name'] = $shopinfo->shop_name;
        $data['shop_id'] = $shopinfo->shop_id;
        echojson(0,$data);
    }
    /**
     *description:商品搭配套餐列表页
     *author:yanyalong
     *date:2014/04/26
     */
    //public function getpacklist(){
    //echojson(1,"","无相关数据"); 
    //}
    /**
     *description:相关案例
     *author:yanyalong
     *date:2014/04/26
     */
    //public function getroomlist(){
    //echojson(1,"","无相关数据"); 
    //}
    /**
     *description:我收藏的商品
     *author:yanyalong
     *date:2014/04/26
     */
    public function likelist(){
        $p= isset($_POST['p'])?$_POST['p']:'';
        $num= isset($_POST['num'])?$_POST['num']:'';
        $user_id = $this->user_id;
        $userinfo = $this->t_user_info_model->get($user_id);
        if($userinfo==false){
            echojson(1,"","用户信息异常");
        }
        $user_id = $userinfo->user_id;
        $res = $this->t_like_service_goods_model->getlistByLike($user_id,$p,$num);         
        $res_count = count($this->t_like_service_goods_model->getlistByLike($user_id));         
        if($res==false) echojson(1,"","无相关数据"); 
        $this->config->load('uploads');
        $this->uploadconfig = $this->config->item("ServiceSeriesGoodsThumb");		
        foreach ($res as $key=>$val) {
            $data['likegoodslist'][$key]['goods_url'] = $this->url_config['goodsinfo']."&service_id=".$val->service_id."&shop_id=".$val->shop_id."&goods_id=".$val->goods_id;
            $data['likegoodslist'][$key]['goods_name']=$val->goods_title;
            $data['likegoodslist'][$key]['goods_pic'] =$this->uploadconfig['relative_thumb_1_path'].$val->goods_pic1;
            $data['likegoodslist'][$key]['goods_price'] = $val->goods_price;
        }
        $data['count'] = $res_count;
        echojson(0,$data);
    }
    /**
     *description:保存装修笔记
     *author:yanyalong
     *date:2014/06/21
     */
    public function addnote(){
        $this->checkLogin();
        $goods_id = isset($_POST['goods_id'])?$_POST['goods_id']:echojson(1,$url,"未接收到商品id");
        $shop_name = isset($_POST['shop_name'])?$_POST['shop_name']:echojson(1,$url,"未接收到门店名称");
        $shop_id = isset($_POST['shop_id'])?$_POST['shop_id']:echojson(1,$url,"未接收到门店id");
        $note_content =  isset($_POST['note_content'])?$_POST['note_content']:echojson(1,$url,"笔记内容不能为空");
        $note_facade =  isset($_POST['note_facade'])?$_POST['note_facade']:echojson(1,$url,"请为外观打分");
        $note_comfort=  isset($_POST['note_comfort'])?$_POST['note_comfort']:echojson(1,$url,"请为舒适度打分");
        $note_price=  isset($_POST['note_price'])?$_POST['note_price']:echojson(1,$url,"请为价格打分");
        $this->t_user_note_model->goods_id = $goods_id;
        $this->t_user_note_model->shop_id= $shop_id;
        $this->t_user_note_model->user_id= $this->user_id;
        $this->t_user_note_model->note_content= $note_content;
        $this->t_user_note_model->note_facade= $note_facade;
        $this->t_user_note_model->note_comfort= $note_comfort;
        $this->t_user_note_model->note_price= $note_price;
        $this->t_user_note_model->shop_name= $shop_name;
        $this->t_user_note_model->note_addtime= date("Y-m-d H:i:s");
        $goods_id = $this->t_user_note_model->insert();
        ($goods_id!=false)?echojson(0,"","装修笔记添加成功"):echojson(1,"","装修笔记添加失败");
    }
    /**
     *description:热门排行
     *author:yanyalong
     *date:2014/06/23
     */
    public function hotrank(){
       echojson(1,"","无相关数据"); 
    }
    /**
     *description:新品上市
     *author:yanyalong
     *date:2014/06/23
     */
    public function newgoods(){
       echojson(1,"","无相关数据"); 
    }
}
