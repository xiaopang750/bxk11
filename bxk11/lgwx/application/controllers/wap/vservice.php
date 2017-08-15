<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  Vservice extends  Wap_Controller {
    function __construct(){
        parent::__construct();
        loadLib('WinXinSourl');
        $this->SouriObj = new WinXinSourlClass();
        $this->load->model('t_like_service_model');
        $this->load->model('t_user_info_model');
    }
    /**
     *description:我关注的商家列表
     *author:yanyalong
     *date:2014/04/26
     */
    public function likelist(){
        $userinfo = $this->t_user_info_model->getInfoByWeixinid($this->SouriObj->openid);
        if($userinfo==false){
            echojson(1,"","用户信息异常");
        }
        $user_id = $userinfo->user_id;
        $res = $this->t_like_service_model->getlistByLike($user_id);         
        if($res==false) echojson(1,"","无相关数据"); 
        $this->config->load('uploads');
        $this->uploadconfig = $this->config->item("ServiceSeriesGoodsThumb");		
        foreach ($res as $key=>$val) {
            $data[$key]['service_id']=$val->service_id;
            $data[$key]['service_url'] = $this->url_config['wapindex']."&service_id=".$val->service_id."&openid=".$this->SouriObj->openid;
            $data[$key]['service_pic']=$val->service_logo;
            $data[$key]['service_company'] = $val->service_company;
        }
        echojson(0,$data);
    }
}

