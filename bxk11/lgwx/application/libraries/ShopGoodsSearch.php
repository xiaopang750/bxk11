<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:商品搜索
 *author:yanyalong
 *date:2014/04/14
 */
class ShopGoodsSearch{
    private $classid;
    private $service_id;
    private $brandid;
    private $seriesid;
    private $code;
    private $p;
    private $num;
    private $goods_list;
    private $uploadconfig;
    private $sort;
    public function __construct($service_id,$classid="",$brandid="",$seriesid="",$code="",$p="",$num="",$sort=""){
        $this->classid = $classid;
        $this->brandid = $brandid;
        $this->seriesid = $seriesid;
        $this->service_id= $service_id;
        $this->code = $code;
        $this->p = $p;
        $this->num = $num;
        $this->sort= $sort;
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_goods_model');
        $this->CI->config->load('uploads');
        $this->uploadconfig = $this->CI->config->item("ServiceSeriesGoodsThumb");		
    }
    /**
     *description:查询商品
     *author:yanyalong
     *date:2014/04/14
     */
    public function SearchGoodsList(){
        $this->goods_list= $this->CI->t_service_goods_model->getGoodsList($this->service_id,$this->classid,$this->brandid,$this->seriesid,$this->code,$this->p,$this->num,$this->sort);
        if($this->goods_list!=false){
            $this->goods_listcount = $this->CI->t_service_goods_model->getGoodsList($this->service_id,$this->classid,$this->brandid,$this->seriesid,$this->code,"","","");
             $this->count = count($this->goods_listcount);
        }else $this->count = "0";
        return $this->goods_list;
    }
    /**
     *description:门店幻灯片数据
     *author:yanyalong
     *date:2014/04/14
     */
    public function getShopFlash(){
        $res = $this->SearchGoodsList();
        if($res==false) return false;
        foreach ($res as $key=>$val) {
            $data['goods_list'][$key] = array(
                'goods_id' => $val->goods_id,
                'goods_title' => $val->goods_title,
                'goods_code' => $val->goods_code,
                'goods_pic' => $this->uploadconfig['relative_upload'].$val->good_pic1
            );
        }
        $data['count'] = $this->count;
        $data['current_count'] = count($res);
        $data['flash_type'] = 'goods';
        return $data;
    }
    /**
     *description:获取搜索的商品列表
     *author:yanyalong
     *date:2014/04/14
     */
    public function getShopList(){
        $res = $this->SearchGoodsList();
        if($res==false) return false;
        return $res;
    }
    /**
     *description:获取数据总数
     *author:yanyalong
     *date:2014/04/26
     */
    public function getcount(){
       return $this->count; 
    }
}
/**
 *description:商品搜索工厂
 *author:yanyalong
 *date:2014/04/14
 */
class ShopGoodsSearchFactory{
    //平台幻灯片功能商品搜索
    static function createObj($service_id,$classid="",$brandid="",$seriesid="",$code="",$p="",$num="",$sort=""){
        $ShopGoodsSearch = new ShopGoodsSearch($service_id,$classid,$brandid,$seriesid,$code,$p,$num,$sort); 
        return $ShopGoodsSearch->getShopFlash();
    }
    //商品搜索
    static function createObjlist($service_id,$classid="",$brandid="",$seriesid="",$code="",$p="",$num="",$sort=""){
        $ShopGoodsSearch = new ShopGoodsSearch($service_id,$classid,$brandid,$seriesid,$code,$p,$num,$sort); 
        return $ShopGoodsSearch->getshoplist();
    }
}
