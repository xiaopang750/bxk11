<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description: 全局页面加载中转控制器
 *author:yanyalong
 *date:2014/03/20
 */
class Index extends   MY_Controller {
    const INFIDEA_URL= "http://www.infidea.cn/static/build/views/main/list.php?";
    const LGWX_REG_URL = "/lgwx/index.php/reg/index";
    function __construct(){
        parent::__construct();
        $this->load->model("t_service_shop_model");
        $this->load->model("t_service_user_model");
    }
    /**
     *description:获取面包屑导航
     *author:yanyalong
     *date:2014/04/02
     */
    public function crumbs(){
        $action_id = isset($_POST['id'])?$_POST['id']:"";
        loadlib('Breadcrumbs');
        $res = BreadcrumbsFactory::CerateObjById($action_id);
        $url= $this->actionList->index;
        if($res==false) echojson(1,$url,"无相关数据");
        echojson(0,$res);
    }

    /**
     *description:用户桌面
     *author:yanyalong
     *date:2014/05/08
     */
    public function desktop(){
        $data['banner']['pic'] = "/lgwx/static/src/lgwx/img/lib/banner/home_banner.jpg";
        $data['banner']['imgurl'] = $this->actionList->join_status;

        $data['menu'][0]['action_name'] = "企业认证";
        $data['menu'][0]['action_url'] = $this->actionList->join_status;
        $data['menu'][1]['action_name'] = "管理品牌";
        $data['menu'][1]['action_url'] =  $this->actionList->brand_list;
        $data['menu'][2]['action_name'] = "管理店铺";
        $data['menu'][2]['action_url'] =  $this->actionList->shop_list;
        $data['menu'][3]['action_name'] = "绑定微信";
        $data['menu'][3]['action_url'] =  $this->actionList->weixin_add;
        $data['menu'][4]['action_name'] = "分享朋友圈";
        $data['menu'][4]['action_url'] = "";
        $data['menu'][5]['action_name'] = "密码修改";
        $data['menu'][5]['action_url'] = $this->actionList->service_user_mod;

        //平台资讯
        $this->load->model("t_service_information_model");

        $p = 0;$row = "5";$field="*";$order_field='si_addtime';$order_type='DESC';
        $where['service_id'] = 0;
        $where['si_status'] = 1;
        $where['it_id'] = 2;//企业动态
        $res = $this->t_service_information_model->getInfoList($field,$where,$p,$row,$order_field,$order_type);
        if($res==false) $data['industry_list'] = "";
        foreach ($res as $key=>$val) {
            $data['industry_list'][$key]['indu_title'] = $val->si_title;
            $data['industry_list'][$key]['indu_time'] = date("Y-m-d",strtotime($val->si_addtime));
            $data['industry_list'][$key]['indu_url'] = self::INFIDEA_URL.$val->si_id;
        }
        $p = 0;$row = "5";$field="*";$order_field='si_addtime';$order_type='DESC';
        $where['service_id'] = 0;
        $where['si_status'] = 1;
        $where['it_id'] = 3;//促销活动
        $res = $this->t_service_information_model->getInfoList($field,$where,$p,$row,$order_field,$order_type);
        if($res==false) $data['activities_list'] = "";
        foreach ($res as $key=>$val) {
            $data['activities_list'][$key]['pa_title'] = $val->si_title;
            $data['activities_list'][$key]['pa_time'] = date("Y-m-d",strtotime($val->si_addtime));
            $data['activities_list'][$key]['pa_url'] = self::INFIDEA_URL.$val->si_id;
        }
        $data['spread'] = $this->spread();
        echojson(0,$data);
    }

    /**
     *description:推广数据
     *author:liuguangping
     *date:2014/06/11
     */
    public function spread(){

        //生成推广二维码和分享地址
        loadLib('LgwxSpreader');
        $this->lgwxSpreader = new LgwxSpreader();

        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,'','您还没登录，请登录。');
        $service_user_id = isset($_SESSION['service_user_id'])?$_SESSION['service_user_id']:echojson(1,'','您还没登录，请登录。');
        $serviceInfo = model("t_service_info")->get($service_id);
        $serviceUser = model("t_service_user")->get($service_user_id);

        $this->lgwxSpreader->nickname = $serviceInfo->service_name?$serviceInfo->service_name:"管理员";
        $this->lgwxSpreader->openid  = $service_id;
        $this->lgwxSpreader->service_id = $service_id;
        $this->lgwxSpreader->ss_phone =  $serviceInfo->service_person_phone?$serviceInfo->service_person_phone:$serviceUser->service_user_phone;
        $this->lgwxSpreader->ss_type = 2;

        $result = $this->lgwxSpreader->insertSpreader();
        $text = "我注册了JIA178移动营销自助平，免费的哦，马上拥有移动官网、商城、手机也可以访问，推荐给大家";
        if($result['status'] == 1){
            $spreader_code = md5($service_id);
            
            $url = $_SERVER['HTTP_HOST'].self::LGWX_REG_URL."?flg=".$spreader_code;
            if(stripos($url, 'http://') === FALSE)
                $url = "http://".$url;
            $data['text'] = $text.$url;
            $data['text_url'] =  $url;
            $where['spreader_code'] = $spreader_code;
            $spreaderR = model('t_service_spreader')->getOne('ss_qr',$where);

            $config = C('uploads','serviceQr');
            $qr_url = $_SERVER['HTTP_HOST'].$config['relative_upload'].$spreaderR->ss_qr;
            if(stripos($qr_url, 'http://') === FALSE)
                $qr_url = "http://".$qr_url;
            $data['qr_url'] = $qr_url;

            //echojson(0,$data,"获取数据成功！");

        }elseif($result['status'] == 0){

             //注册成功更新服务商表的推广标识
             $whereS['service_id'] = $service_id;
             $dataS['spreader_code'] = md5($service_id);
             model("t_service_info")->updates_global($dataS,$whereS);
             $data['text'] = $text.$result['data']['text_url'];
             $data['text_url'] =  $result['data']['text_url'];
             $data['qr_url'] = $result['data']['qr_url'];
            //echojson(0,$data,"获取数据成功！");

        }else{
             $data['text'] = "";
             $data['text_url'] = '';
             $data['qr_url'] = '';
             //echojson(1,$data,"获取数据失败！");
        }
        return $data;
    }
}

