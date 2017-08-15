<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vbrand extends  Wap_Controller {
    function __construct(){
        parent::__construct();
        loadLib('WinXinSourl');
        $this->SouriObj = new WinXinSourlClass();
        $this->load->model('t_service_brands_apply_model');
        $this->load->model('t_system_class_model');
        $this->load->model('t_product_class_brands_model');
        $this->load->model('t_product_brands_model');
        $this->load->model('t_service_goods_model');
        $this->load->model('t_service_goods_match_model');
    }
    /**
     *description:品牌介绍列表
     *author:yanyalong
     *date:2014/04/25
     */
    public function getlist(){
        $this->config->load('status');	
        $config = $this->config->item("wap_apply_brand_search");		
        $apply_status= $config['1'];
        $res = $this->t_service_brands_apply_model->getApplyBrandsByServiceId($this->SouriObj->service_id,$apply_status);
        if($res==false) 
            echojson('1',"","无相关品牌信息"); 
        $this->config->load('uploads');		
        $upload_config= $this->config->item('serviceApplyBrand');
        foreach ($res as $key=>$val) {
            $data[$key]['apply_brand_img'] =  $upload_config['relative_upload'].$val->apply_brand_img;
            $data[$key]['apply_brand_name'] =  $val->apply_brand_name;
            //$data[$key]['apply_brand_ename'] =  $val->apply_brand_ename;
            $data[$key]['apply_brand_seodesc'] =  $val->apply_brand_seodesc;
            $data[$key]['brandinfo_url'] = $this->url_config['brandinfo'].$this->SouriObj->sourl."&brand_id=".$val->brand_id;
            if($val->apply_status=="1"){
                $data[$key]['certified_status'] = "1";
            }else{
                $data[$key]['certified_status'] = "0";
            }
        }
        echojson(0,$data);
    }
    /**
     *description:品牌展厅
     *author:yanyalong
     *date:2014/06/21
     */
    public function info(){
        $brand_id= isset($_POST['brand_id'])?$_POST['brand_id']:'';
        if($brand_id=="") echojson(1,"","操作异常");
        $data['room_space'] = "客厅";
        $data['room_size'] = "100*100*100";
        $data['room_style'] = "新中式";
        $data['room_desc'] = "样板间";
        $data['room_pic'] = "http://www.jia178.com/static/images/lib/bg/regist_login_bg.jpg";
        $data['room_url'] = "#";
        //商品搭配
        //获取品牌下商品列表
        $goodslist= $this->t_service_goods_model->getGoodsListByBrand($brand_id);
        if($goodslist==false){
            $data['goods_match_list']  = "";
        }else{
            $match_flag = false;
            $i = 0;
            $match = array();
            foreach ($goodslist as $key=>$val) {
                $match_list = $this->t_service_goods_match_model->getListByGoodsId($val->goods_id);
                if($match_list!=false){
                    $match_flag=true;
                    $serviceGoodsMatch = $this->config->item("serviceGoodsMatch");		
                    foreach ($match_list as $key=>$val) {
                        if(!in_array($val->gm_id,$match)){
                        $match[] = $val->gm_id;
                        $data['goods_match_list'][$i]['gm_name'] =$val->gm_name;
                        $data['goods_match_list'][$i]['gm_pic'] = $serviceGoodsMatch['relative_upload'].$val->gm_pic;
                        $i++;
                        }
                    }
                }else
                    continue;
            }
            $data['goods_match_list'] = ($match_flag==false)?"":$data['goods_match_list'];
            $data['last_url'] = "#";
            $data['prev_url'] = "#";
            $data['brand_url'] = $this->url_config['brandlist']."&service_id=".$this->SouriObj->service_id;
            $data['current_num'] = rand(1,10);
            $data['count_num'] = 10;
        }
        echojson(0,$data);
    }
}

