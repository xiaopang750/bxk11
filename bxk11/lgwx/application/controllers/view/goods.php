<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:商品管理
 *author:yanyalong
 *date:2014/04/08
 */
class goods extends  MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('t_product_class_model');
        $this->load->model('t_product_brands_model');
        $this->load->model('t_product_brands_series_model');
        $this->load->model('t_service_goods_model');
        $this->load->model('t_service_brands_apply_model');
        $this->load->model('t_product_unit_model');
        $this->load->model('t_product_class_brands_model');
        $this->load->model('t_service_goods_match_model');
        $this->load->model('t_service_shop_model');
    }
    /**
     *description:添加商品
     *author:yanyalong
     *date:2014/04/08
     */
    public function add(){
        $this->CheckAccessByKey('goods_add');
        $series_id= isset($_POST['series_id'])?$_POST['series_id']:"";
        $data['series_list'] = $this->actionList->series_list;
        //获取系列信息
        $_series_info = $this->t_product_brands_series_model->get($series_id);
        if($_series_info==false||$_series_info->series_status>10)
            echojson(1,$data,"异常操作，您可能正在操作一个不存在的系列");
        //获取品牌信息
        $_brandInfo = $this->t_product_brands_model->get($_series_info->brand_id);
        if($_brandInfo==false) echojson(1,$data,"无相关品牌或当前所选品牌无所属品类");
        $data['brand_name'] = $_brandInfo->brand_name;
        $data['series_id'] = $series_id;
        $data['series_name'] = $_series_info->series_name;
        $data['goods_title'] = "";
        $data['goods_model_number'] = "";
        $data['goods_code'] = "";
        $data['goods_price'] = "";
        $data['goods_member_price'] = "";
        $data['goods_material'] = "";
        $data['goods_size'] = "";
        $data['goods_desc'] = "";
        $data['pic_list'] = "";
        $data['goods_price_is_show'] = "";
        $data['gm_selection_list'] = "";
        //获取计价单位列表
        $unitlist = $this->t_product_unit_model->getUnitList();
        foreach ($unitlist as $key=>$val) {
            $data['unitlist'][$key]['pu_id'] = $val->pu_id;
            $data['unitlist'][$key]['pu_name'] = $val->pu_name;
            $data['unitlist'][$key]['is_select'] = "0";
        }
        $_classList = $this->t_product_class_brands_model->getClassInfoByBrand($_series_info->brand_id);
        foreach ($_classList as $key=>$val) {
            $val = $this->t_product_class_model->get($val->pc_id);
            $data['class_plist'][$key]['class_id']  = $val->pc_id; 
            $data['class_plist'][$key]['class_name']  = $val->pc_name; 
            $data['class_plist'][$key]['is_select']  = 0; 
        }
        echojson(0,$data);
    }
    /**
     *description:编辑商品
     *author:yanyalong
     *date:2014/03/26
     */
    public function edit(){
        $this->CheckAccessByKey('goods_edit');
        $data['series_list'] = $this->actionList->series_list;
        $goods_id = isset($_POST['goods_id'])?$_POST['goods_id']:"";
        //获取商品信息
        $_goods_info = $this->t_service_goods_model->get($goods_id);
        if($_goods_info==false||$_goods_info->goods_status>10)
            echojson(1,$data,"异常操作，您可能正在操作一个不存在的商品");
        //获取系列信息
        $_series_info  = $this->t_product_brands_series_model->get($_goods_info->series_id);
        if($_series_info==false||$_series_info->series_status>10)
            echojson(1,$data,"异常操作，您可能正在操作一个不存在的系列");
        //获取品牌信息
        $_brandInfo = $this->t_product_brands_model->get($_series_info->brand_id);
        if($_brandInfo==false) echojson(1,$data,"无相关品牌或当前所选品牌无所属品类");
        $data['goods_id'] = $goods_id;
        $data['series_id'] = $_goods_info->series_id;
        $data['brand_name'] = $_brandInfo->brand_name;
        $data['series_name'] = $_series_info->series_name;
        $data['goods_title'] = $_goods_info->goods_title;
        $data['goods_model_number'] = $_goods_info->goods_model_number;
        $data['goods_code'] = $_goods_info->goods_code;
        $data['goods_size'] = $_goods_info->goods_size;
        $data['goods_material'] = $_goods_info->goods_material;
        $data['goods_price'] = $_goods_info->goods_price;
        $data['goods_member_price'] = $_goods_info->goods_member_price;
        $data['goods_desc'] =htmlspecialchars_decode($_goods_info->goods_desc);
        $data['goods_price_is_show'] = $_goods_info->goods_price_is_show;

        //获取计价单位列表
        $unitlist = $this->t_product_unit_model->getUnitList();
        foreach ($unitlist as $key=>$val) {
            $data['unitlist'][$key]['pu_id'] = $val->pu_id;
            $data['unitlist'][$key]['pu_name'] = $val->pu_name;
            if($val->pu_id==$_goods_info->pu_id)
                $data['unitlist'][$key]['is_select'] = "1";
            else
                $data['unitlist'][$key]['is_select'] = "0";
        }
        $this->config->load('uploads');		
        $goods_thumb_config = $this->config->item("ServiceSeriesGoodsThumb");		
        $pic_list = array();
        for ($i = 1; $i <= 5; $i++) {
            $goods_pic = 'goods_pic'.strval($i);
            if($_goods_info->$goods_pic!=""){
                $data['pic_list'][]= $goods_thumb_config['relative_thumb_1_path'].$_goods_info->$goods_pic; 
            }
        }
        //获取商品分类信息
        $pc_info = $this->t_product_class_model->get($_goods_info->pc_id);
        $pc_pinfo = $this->t_product_class_model->get($pc_info->pc_pid);
        $_classList = $this->t_product_class_brands_model->getClassInfoByBrand($_series_info->brand_id);
        foreach ($_classList as $key=>$val) {
            $val = $this->t_product_class_model->get($val->pc_id);
            $data['class_plist'][$key]['class_id']  = $val->pc_id; 
            $data['class_plist'][$key]['class_name']  = $val->pc_name; 
            if($val->pc_id==$pc_pinfo->pc_id)
                $data['class_plist'][$key]['is_select']  = 1; 
            else
                $data['class_plist'][$key]['is_select']  = 0; 
        }
        loadLib('ProductClass');
        $classSonList = ProductClassFactory::getProductClass($pc_pinfo->pc_id);
        foreach ($classSonList as $key=>$val) {
            $val = $this->t_product_class_model->get($val->pc_id);
            $data['class_sonlist'][$key]['class_id']  = $val->pc_id; 
            $data['class_sonlist'][$key]['class_name']  = $val->pc_name; 
            if($val->pc_id==$pc_info->pc_id)
                $data['class_sonlist'][$key]['is_select']  = 1; 
            else
                $data['class_sonlist'][$key]['is_select']  = 0; 
        }

        //获取商品id列表
        $recommend_list = str_replace('，', ',', trim($_goods_info->goods_recommend));
        $data['gm_selection_list'] = array();
        if($recommend_list){
            $goods_recommend_list = $this->t_service_goods_model->getListByIdList($recommend_list);
            $this->config->load('uploads');     
            $goods_thumb_config = $this->config->item("ServiceSeriesGoodsThumb");       
            foreach ($goods_recommend_list as $key=>$val) {
                $result['goods_id'] = $val->goods_id;
                //$result['goods_name'] = $val->goods_title;
                $result['goods_pic1'] =$goods_thumb_config['relative_upload'].$val->goods_pic1;
                array_push($data['gm_selection_list'], $result);
            }
        }
        echojson(0,$data);
    }
    /**
     *description:商品列表
     *author:yanyalong
     *date:2014/04/09
     */
    public function getlist(){
        $this->CheckAccessByKey('goods_list');
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:"";
        $p= isset($_POST['p'])?$_POST['p']:"";
        $series_id = isset($_POST['series_id'])?$_POST['series_id']:"";
        $brand_id = isset($_POST['brand_id'])?$_POST['brand_id']:"";
        $num= isset($_POST['num'])?$_POST['num']:"";
        $goodslist = $this->t_service_goods_model->getGoodsListBySeriesId($service_id,$brand_id,$series_id,$p,$num);
        if($goodslist==false) {
            $data['goods_list'] = ""; 
            $data['count'] = 0;
            $data['current_count'] = 0;
        }else{
            $countres = $this->t_service_goods_model->getGoodsListBySeriesId($service_id,$brand_id,$series_id);
            $data['current_count'] = count($goodslist);
            $data['count'] = count($countres);
            if($goodslist==false){
                $data['goods_list'] = "";
            }
            $this->config->load('uploads');		
            $goods_thumb_config = $this->config->item("ServiceSeriesGoodsThumb");		
            foreach ($goodslist as $key=>$val) {
                $data['goods_list'][$key]['goods_id'] = $val->goods_id;
                $data['goods_list'][$key]['goods_name'] = $val->goods_title;
                $data['goods_list'][$key]['goods_code'] = $val->goods_code;
                $data['goods_list'][$key]['goods_pic1'] =$goods_thumb_config['relative_thumb_1_path'].$val->goods_pic1;
            }
        }
        //获取品牌列表
        $this->config->load('status');	
        $config = $this->config->item("apply_brand_search");		
        $apply_status= $config['1'];
        $brandlist = $this->t_service_brands_apply_model->getApplyBrandsByServiceId($service_id,$apply_status);
        if($brandlist==false) 
            $data['brandlist']= "";
        foreach ($brandlist as $key=>$val) {
            if($brand_id==$val->brand_id) $data['brandlist'][$key]['is_select'] = "1";
            else  $data['brandlist'][$key]['is_select'] = "0";
            $data['brandlist'][$key]['brand_id'] =  $val->brand_id;
            $data['brandlist'][$key]['brand_name'] =  $val->apply_brand_name;
        }
        if($brand_id){
          //获取系列列表
            $serieslist = $this->t_product_brands_series_model->getSeriesByBrand($service_id,$brand_id,2);
            if($serieslist==false) 
                $data['brandlist']= "";
            foreach ($serieslist as $key=>$val) {
                if($series_id==$val->series_id) $data['serieslist'][$key]['is_select'] = "1";
                else  $data['serieslist'][$key]['is_select'] = "0";
                $data['serieslist'][$key]['series_id'] =  $val->series_id;
                $data['serieslist'][$key]['series_name'] =  $val->series_name;
            }  
        }else{
            $data['serieslist'] = '';
        }

        $data['goods_add'] = $this->actionList->goods_add."&series_id=".$series_id;
        $data['goods_edit']= $this->actionList->goods_edit;
        if(!isset($data['goods_list']) || $data['goods_list'] == '') echojson(0,$data,'无相关数据'); else echojson(0,$data);
        
    }
    /**
     *description:商品查询
     *author:yanyalong
     *date:2014/04/14
     */
    public function search(){
        $this->CheckAccessByKey('goods_list');
        $p= isset($_POST['p'])?$_POST['p']:'';
        $num= isset($_POST['num'])?$_POST['num']:'';
        $code= isset($_POST['code'])?$_POST['code']:'';
        $classid= isset($_POST['classid'])?$_POST['classid']:'';
        $brandid= isset($_POST['brandid'])?$_POST['brandid']:'';
        $seriesid= isset($_POST['seriesid'])?$_POST['seriesid']:'';
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        loadLib('ShopGoodsSearch');
        $data = ShopGoodsSearchFactory::createObj($service_id,$classid,$brandid,$seriesid,$code,$p,$num);
        ($data==false)?echojson(1,"","无相关数据"):echojson(0,$data);
    }
    /**
     *description:商品搭配列表
     *author:yanyalong
     *date:2014/06/13
     */
    public function matchlist(){
        $this->CheckAccessByKey('goods_match_list');
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:"";
        $p= isset($_POST['p'])?$_POST['p']:"1";
        $num= isset($_POST['num'])?$_POST['num']:"1";
        $res = $this->t_service_goods_match_model->getList($service_id,$p,$num);
        if($res==false){
            $data['matchlist'] = "";
            $data['current_count'] = "0";
            $data['count'] ="0";
        }else{
            $countres = $this->t_service_goods_match_model->getList($service_id);
            $data = array();
            $this->config->load('uploads');		
            $goods_thumb_config = $this->config->item("ServiceSeriesGoodsThumb");		
            $goods_match_config = $this->config->item("serviceGoodsMatch");		
            foreach ($res as $key=>$val) {
                $data['matchlist'][$key]['gm_id'] = $val->gm_id; 
                $data['matchlist'][$key]['gm_name'] = $val->gm_name; 
                $data['matchlist'][$key]['gm_pic'] = $goods_match_config['relative_thumb_1_path'].$val->gm_pic; 
                //获取搭配商品id列表
                $goods_match_list = $this->t_service_goods_model->getListByIdList($val->gm_list);
                foreach ($goods_match_list as $keys=>$val) {
                    $data['matchlist'][$key]['goods_list'][$keys]['goods_pic1'] =$goods_thumb_config['relative_thumb_1_path'].$val->goods_pic1;
                }
            }
            $data['current_count'] = count($res);
            $data['count'] = count($countres);
        }
        $data['match_edit'] = $this->actionList->goods_match_edit;
        $data['match_add'] = $this->actionList->goods_match_add;
        echojson(0,$data);
    }
    /**
     *description:商品搭配添加
     *author:yanyalong
     *date:2014/06/13
     */
   /* public function matchadd(){
        $this->CheckAccessByKey('goods_match_add');
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:"";
        $p= isset($_POST['p'])?$_POST['p']:"";
        $num= isset($_POST['num'])?$_POST['num']:"";
        $series_id = isset($_POST['seriesid'])?$_POST['seriesid']:"";
        $brand_id = isset($_POST['brand_id'])?$_POST['brand_id']:"";
        $goodslist = $this->t_service_goods_model->getGoodsListBySeriesId($service_id,$service_id,$brand_id,$series_id,$p,$num);
        if($goodslist==false) {
            $data['gm_selection_list'] = ""; 
            $data['count'] = 0;
            $data['current_count'] = 0;
        }else{
            $countres = $this->t_service_goods_model->getGoodsListBySeriesId($service_id,$service_id,$brand_id,$series_id,"");
            $data['current_count'] = count($goodslist);
            $data['count'] = count($countres);
            if($goodslist==false){
                $data['gm_selection_list'] = "";
            }
            $this->config->load('uploads');		
            $goods_thumb_config = $this->config->item("ServiceSeriesGoodsThumb");		
            foreach ($goodslist as $key=>$val) {
                $data['gm_selection_list'][$key]['goods_id'] = $val->goods_id;
                $data['gm_selection_list'][$key]['goods_name'] = $val->goods_title;
                $data['gm_selection_list'][$key]['goods_pic1'] =$goods_thumb_config['relative_upload'].$val->goods_pic1;
            }
        }
        //获取品牌列表
        $this->config->load('status');		
        $config = $this->config->item("apply_brand_search");		
        $apply_status= $config['1'];
        $brandlist = $this->t_service_brands_apply_model->getApplyBrandsByServiceId($service_id,$apply_status);
        if($brandlist==false) 
            $data['brandlist']= "";
        foreach ($brandlist as $key=>$val) {
            if($brand_id==$val->brand_id) $data['brandlist'][$key]['is_select'] = "1";
            else  $data['brandlist'][$key]['is_select'] = "0";
            $data['brandlist'][$key]['brand_id'] =  $val->brand_id;
            $data['brandlist'][$key]['brand_name'] =  $val->apply_brand_name;
        }
        //获取系列列表
        $serieslist = $this->t_product_brands_series_model->getSeriesByBrand($service_id);        
        if($serieslist==false) 
        $data['brandlist']= "";
        $data['serieslist'] = '';
        $data['gm_id'] = "";
        $data['gm_name'] = "";
        $data['gm_pic'] = "";
        $data['gm_list'] = array();
        $count = count($data['gm_list']);
        for ($i=0; $i < 10-$count; $i++) { 
            $padding['goods_id'] = '';
            $padding['goods_name'] = '';
            $padding['goods_pic1'] = '';
            array_push($data['gm_list'],$padding);
        }
        echojson(0,$data);
   }*/

    /**
     *description:商品搭配添加
     *author:yanyalong
     *date:2014/06/13
     */
    public function matchadd(){

        $this->CheckAccessByKey('goods_match_add');
        $data['gm_id'] = "";
        $data['gm_name'] = "";
        $data['gm_pic'] = "";
        $data['gm_price'] = "";
        $data['goods_price'] = '';
        $data['gm_selection_list'] = array();
        $data['countPrice'] = 0;
        echojson(0,$data);
    }

    /**
     *description:商品搭配编辑
     *author:yanyalong
     *date:2014/06/13
     */
/*    public function matchedit(){
        $this->CheckAccessByKey('goods_match_edit');
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:"";
        $p= isset($_POST['p'])?$_POST['p']:"";
        $num= isset($_POST['num'])?$_POST['num']:"";
        $series_id = isset($_POST['seriesid'])?$_POST['seriesid']:"";
        $brand_id = isset($_POST['brand_id'])?$_POST['brand_id']:"";
        $gm_id = isset($_POST['gm_id'])?$_POST['gm_id']:"";
        //获取搭配详情
        $matchinfo = $this->t_service_goods_match_model->get($gm_id);
        //获取搭配商品id列表
        $goods_match_list = $this->t_service_goods_model->getListByIdList($matchinfo->gm_list);
        $this->config->load('uploads');		
        $goods_thumb_config = $this->config->item("ServiceSeriesGoodsThumb");		
        $i = 0;
        foreach ($goods_match_list as $key=>$val) {
            $data['gm_list'][$i]['goods_id'] = $val->goods_id;
            $data['gm_list'][$i]['goods_name'] = $val->goods_title;
            $data['gm_list'][$i]['goods_pic1'] =$goods_thumb_config['relative_upload'].$val->goods_pic1;
            $i++;
        }
        $count = count($goods_match_list);
        for ($i; $i<10; $i++) {
            $data['gm_list'][$i]['goods_id'] = "";
            $data['gm_list'][$i]['goods_name'] = "";
            $data['gm_list'][$i]['goods_pic1'] = "";
        }
        $goodslist = $this->t_service_goods_model->getGoodsListBySeriesId($service_id,$brand_id,$series_id,$p,$num);
        if($goodslist==false) {
            $data['gm_selection_list'] = ""; 
            $data['count'] = 0;
            $data['current_count'] = 0;
        }else{
            $countres = $this->t_service_goods_model->getGoodsListBySeriesId($service_id,$brand_id,$series_id,"");
            $data['current_count'] = count($goodslist);
            $data['count'] = count($countres);
            if($goodslist==false){
                $data['gm_selection_list'] = "";
            }
            $gm_idarr = explode(',',$matchinfo->gm_list);
            foreach ($goodslist as $key=>$val) {
                if(in_array($val->goods_id,$gm_idarr)) 
                    $data['gm_selection_list'][$key]['is_select'] = "1";
                else
                    $data['gm_selection_list'][$key]['is_select'] = "0";
                    $data['gm_selection_list'][$key]['goods_id'] = $val->goods_id;
                    $data['gm_selection_list'][$key]['goods_name'] = $val->goods_title;
                    $data['gm_selection_list'][$key]['goods_pic1'] =$goods_thumb_config['relative_upload'].$val->goods_pic1;
            }
        }
        //获取品牌列表
        $this->config->load('status');		
        $config = $this->config->item("apply_brand_search");		
        $apply_status= $config['1'];
        $brandlist = $this->t_service_brands_apply_model->getApplyBrandsByServiceId($service_id,$apply_status);
        if($brandlist==false) 
            $data['brandlist']= "";
        foreach ($brandlist as $key=>$val) {
            if($brand_id==$val->brand_id) $data['brandlist'][$key]['is_select'] = "1";
            else  $data['brandlist'][$key]['is_select'] = "0";
            $data['brandlist'][$key]['brand_id'] =  $val->brand_id;
            $data['brandlist'][$key]['brand_name'] =  $val->apply_brand_name;
        }
        //获取系列列表
        $serieslist = $this->t_product_brands_series_model->getSeriesByBrand($service_id);        
        if($serieslist==false) 
            $data['brandlist']= "";
        foreach ($serieslist as $key=>$val) {
            if($series_id==$val->series_id) $data['serieslist'][$key]['is_select'] = "1";
            else  $data['serieslist'][$key]['is_select'] = "0";
            $data['serieslist'][$key]['series_id'] =  $val->series_id;
            $data['serieslist'][$key]['series_name'] =  $val->series_name;
        }
        $serviceGoodsMatchConfig = $this->config->item("serviceGoodsMatch");		
        $data['gm_id'] = $matchinfo->gm_id;
        $data['gm_name'] = $matchinfo->gm_name;
        $data['gm_pic'] = $serviceGoodsMatchConfig['relative_upload'].$matchinfo->gm_pic;
        echojson(0,$data);
}*/
    /**
     *description:商品搭配编辑
     *author:yanyalong
     *date:2014/06/13
     */
    public function matchedit(){
        $this->CheckAccessByKey('goods_match_edit');
        $gm_id = isset($_POST['gm_id'])?$_POST['gm_id']:"";
        if(!$gm_id) echojson('1','','非法操作');
        //获取搭配详情
        $matchinfo = $this->t_service_goods_match_model->get($gm_id);
        //获取搭配商品id列表
        $goods_match_list = $this->t_service_goods_model->getListByIdList($matchinfo->gm_list);
        $this->config->load('uploads');     
        $goods_thumb_config = $this->config->item("ServiceSeriesGoodsThumb"); 
        $data['gm_selection_list'] = array();
        $count = 0;    
        foreach ($goods_match_list as $key=>$val) {
            $result['goods_id'] = $val->goods_id;
            $result['goods_name'] = $val->goods_title;
            $result['goods_pic1'] = $goods_thumb_config['relative_thumb_1_path'].$val->goods_pic1;
            $result['goods_price'] = $val->goods_price;
            $count = $count+($val->goods_price);
            array_push($data['gm_selection_list'], $result);
        }
        $serviceGoodsMatchConfig = $this->config->item("serviceGoodsMatch");
        $data['gm_id'] = $matchinfo->gm_id;       
        $data['countPrice'] = $count;
        $data['gm_name'] = $matchinfo->gm_name;
        $data['gm_pic'] = $serviceGoodsMatchConfig['relative_thumb_1_path'].$matchinfo->gm_pic;
        $data['gm_price'] = $matchinfo->gm_price;
        echojson(0,$data);
    }
    /**
     *description:待选商品列表
     *author:liuguangping
     *date:2014/06/15
     */
    public function selection_list(){
        $this->CheckAccessByKey('goods_match_add');
        $p= isset($_POST['p'])?$_POST['p']:"";
        $num= isset($_POST['num'])?$_POST['num']:"";
        $series_id = isset($_POST['series_id'])?$_POST['series_id']:"";
        $brand_id = isset($_POST['brand_id'])?$_POST['brand_id']:"";
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:"";
        $selected_id = isset($_POST['selected_id'])?$_POST['selected_id']:'';
        $goods_id = isset($_POST['goods_id'])?$_POST['goods_id']:'';
        $selected_arr = array();
        $selected_arr = explode(',', str_replace('，', ',', $selected_id));
        $goodslist = $this->t_service_goods_model->getGoodsListBySeriesId($service_id,$brand_id,$series_id,$p,$num,$goods_id);
        if($goodslist==false) {
            $data['gm_selection_list'] = ""; 
            $data['count'] = 0;
            $data['current_count'] = 0;
        }else{
            $countres = $this->t_service_goods_model->getGoodsListBySeriesId($service_id,$brand_id,$series_id,"",$goods_id);
            $data['current_count'] = count($goodslist);
            $data['count'] = count($countres);
            if($goodslist==false){
                $data['gm_selection_list'] = "";
            }
            $this->config->load('uploads');     
            $goods_thumb_config = $this->config->item("ServiceSeriesGoodsThumb");       
            foreach ($goodslist as $key=>$val) {
                    $data['gm_selection_list'][$key]['goods_id'] = $val->goods_id;
                    $data['gm_selection_list'][$key]['goods_name'] = $val->goods_title;
                    $data['gm_selection_list'][$key]['goods_code'] = $val->goods_code;
                    $data['gm_selection_list'][$key]['goods_price'] = $val->goods_price;
                    $data['gm_selection_list'][$key]['goods_pic1'] =$goods_thumb_config['relative_thumb_1_path'].$val->goods_pic1;
                    if(in_array($val->goods_id, $selected_arr)){
                        $data['gm_selection_list'][$key]['selected'] = 1;
                    }else{
                        $data['gm_selection_list'][$key]['selected'] = 0; 
                    }
            }
        }
        //获取品牌列表

        $this->config->load('status');      
        $config = $this->config->item("apply_brand_search");        
        $apply_status= $config['1'];
        $brandlist = $this->t_service_brands_apply_model->getApplyBrandsByServiceId($service_id,$apply_status);
        if($brandlist==false) 
            $data['brandlist']= "";
        $data['series_id'] = '';
        foreach ($brandlist as $key=>$val) {
            if($brand_id==$val->brand_id) $data['brandlist'][$key]['is_select'] = "1";
            else  $data['brandlist'][$key]['is_select'] = "0";
            $data['brandlist'][$key]['brand_id'] =  $val->brand_id;
            $data['brandlist'][$key]['brand_name'] =  $val->apply_brand_name;
        }
        $data['series_id'] = $series_id;
        echojson(0,$data);
    }
    /**
     *description:套餐商品选择完成返回的值操作
     *author:liuguangping
     *date:2014/06/26
     */

    public function seGoConsole(){
        $goods_idStr = isset($_POST['goods_id'])?$_POST['goods_id']:"";
        $selected_arr = array();
        $selected_arr = explode(',', str_replace('，', ',', trim($goods_idStr)));
        if(count($selected_arr) > 10  || count($selected_arr) < 2 ){
            echojson('1','','搭配套餐2-10件商品');
        }
        $count = 0;
        $result['gm_selection_list'] = array();
        $this->config->load('uploads');     
        $goods_thumb_config = $this->config->item("ServiceSeriesGoodsThumb");
        foreach ($selected_arr as $key => $value) {
            $goodsR = $this->t_service_goods_model->get($value);
            if($goodsR){
                $goodsA['goods_id'] = $goodsR->goods_id;
                $goodsA['goods_name'] = $goodsR->goods_title;
                $goodsA['goods_price'] = $goodsR->goods_price;
                $goodsA['goods_pic1'] =$goods_thumb_config['relative_upload'].$goodsR->goods_pic1;
                array_push($result['gm_selection_list'],$goodsA);
                $count = $count+($goodsR->goods_price);
            }
        }
        $result['countPrice'] = $count;
        echojson(0,$result);
    }

    /**
     *description:商品相关推荐选择完成返回的值操作
     *author:liuguangping
     *date:2014/06/26
     */
    public function goReConsole(){
        $goods_idStr = isset($_POST['goods_id'])?$_POST['goods_id']:"";
        $selected_arr = array();
        $selected_arr = explode(',', str_replace('，', ',', trim($goods_idStr)));
        if(count($selected_arr) > 10 ){
            echojson('1','','商品相关推荐最多10个');
        }
        $result['gm_selection_list'] = array();
        $this->config->load('uploads');     
        $goods_thumb_config = $this->config->item("ServiceSeriesGoodsThumb");
        foreach ($selected_arr as $key => $value) {
            $goodsR = $this->t_service_goods_model->get($value);
            if($goodsR){
                $goodsA['goods_id'] = $goodsR->goods_id;
                $goodsA['goods_price'] = $goodsR->goods_price;
                $goodsA['goods_pic1'] =$goods_thumb_config['relative_upload'].$goodsR->goods_pic1;
                array_push($result['gm_selection_list'],$goodsA);
            }
        }
        echojson(0,$result);
    }

    /**
     *description:幻灯片商品指向选择完成返回的值操作
     *author:liuguangping
     *date:2014/06/26
     */
    public function slGoConsole(){
        $goods_idStr = isset($_POST['goods_id'])?$_POST['goods_id']:247;
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson('1','','非法操作');
        $selected_arr = array();
        $selected_arr = explode(',', str_replace('，', ',', trim($goods_idStr)));
        if(count($selected_arr) > 1){
            echojson('1','','幻灯片商品指向最多1个');
        }
        $this->config->load('uploads');     
        $goods_thumb_config = $this->config->item("ServiceSeriesGoodsThumb");

        $goodsR = $this->t_service_goods_model->get(trim($goods_idStr));
        if($goodsR){
            $result['goods_id'] = $goodsR->goods_id;
            $shop_idRow = $this->t_service_shop_model->getInfoByService($service_id);
            $this->config->load('wap_url');     
            $config = $this->config->item("wap");
            if(!$shop_idRow) echojson('1','','你还没有在线商城，非法操作');
            $slide_url = $config['goodsinfo']."&service_id=".$service_id."&goods_id=".$result['goods_id']."&shop_id=".$shop_idRow->shop_id;
            $result['slide_url'] = $slide_url;
            $result['slide_pic'] = $goods_thumb_config['relative_upload'].$goodsR->goods_pic1;
            $result['slide_thumb'] = $goods_thumb_config['relative_thumb_1_path'].$goodsR->goods_pic1;
            $result['slide_type'] = "2";
            echojson(0,$result);
        }else{
            echojson(1,'','非法操作');
        }
    }

    /**
     *description:产品分类二级联动
     *author:yanyalong
     *date:2014/06/17
     */
    public function getSonClass(){
        $pc_id = isset($_POST['class_id'])?$_POST['class_id']:"";
        loadLib('ProductClass');
        $_classList = ProductClassFactory::getProductClass($pc_id);
        if($_classList==false) echojson(1,"","无相关数据");
        foreach ($_classList as $key=>$val) {
            $data['class_sonlist'][$key]['class_id'] = $val->pc_id; 
            $data['class_sonlist'][$key]['class_name'] = $val->pc_name; 
        }
        echojson(0,$data);
    }
}
