<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vinformation extends  Wap_Controller {
    function __construct(){
        parent::__construct();
        loadLib('WinXinSourl');
        $this->SouriObj = new WinXinSourlClass();
        $this->load->model('t_service_information_model');
        //$this->load->model('t_like_service_model');
        //$this->load->model('t_user_info_model');
    }
    /**
     *description:获取最新一条资讯
     *author:yanyalong
     *date:2014/04/26
     */
    public function newone(){
        $res = $this->t_service_information_model->getOneByNew($this->SouriObj->service_id);  
        if($res==false) echojson(1,"","无相关数据");
        $data['si_url'] = $this->url_config['informationinfo'].$this->SouriObj->sourl."&si_id=".$res->si_id;
        $data['si_title'] = $res->si_title;
        //$userinfo = $this->t_user_info_model->getInfoByWeixinid($this->SouriObj->openid);
        //if($userinfo==false){
            //echojson(1,"","用户信息异常");
        //}
		//$user_id = $userinfo->user_id;
        //$data['is_follow'] = $this->t_like_service_model->is_follow($user_id,$this->SouriObj->service_id);
        echojson(0,$data);
    }
    /**
     *description:资讯列表页
     *author:yanyalong
     *date:2014/04/26
     */
    public function getlist(){
        $res = $this->t_service_information_model->getList($this->SouriObj->service_id,"",1,10,2);
        if($res==false) echojson(1,"","无相关数据");
        $data['count'] = count($res);
        $this->config->load('uploads');		
        $config = $this->config->item("serviceInformation");		
        foreach ($res as $key=>$val) {
           $data['informationlist'][$key]['si_url'] = $this->url_config['informationinfo'].$this->SouriObj->sourl."&si_id=".$val->si_id;
           $data['informationlist'][$key]['si_title'] = $val->si_title;
           if($key==0)
            $data['informationlist'][$key]['si_pic'] =$config['relative_thumb_3_path'].$val->si_pic;
           else
            $data['informationlist'][$key]['si_pic'] =$config['relative_thumb_1_path'].$val->si_pic;
        }
        echojson(0,$data);
    }
    /**
     *description:资讯详情页
     *author:yanyalong
     *date:2014/04/26
     */
    public function info(){
        $si_id= isset($_POST['si_id'])?$_POST['si_id']:echojson(1,"","操作异常");
        $information_info = $this->t_service_information_model->get($si_id);       
        if($information_info==false) echojson(1,"","您正在操作一篇不存在的资讯");
        $data['si_title'] = $information_info->si_title;
        $data['si_content'] = htmlspecialchars_decode($information_info->si_content);
        echojson(0,$data);
    }
}

