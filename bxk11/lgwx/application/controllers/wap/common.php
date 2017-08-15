<?php
class Common extends Wap_Controller {
    function __construct(){
        parent::__construct();
        loadLib('WinXinSourl');
        $this->SouriObj = new WinXinSourlClass();
        //$this->load->model('t_user_info_model');
        //$this->load->model('t_like_service_model');
        $this->load->model('t_service_wap_template_model');
    }
    /**
     *description:顶部菜单数据
     *author:yanyalong
     *date:2014/04/26
     */
    public function topmenu(){
        $this->config->load('wap_menu');
        $menu_config = $this->config->item('wapmenu');
        $urlkey = isset($_POST['urlkey'])?$_POST['urlkey']:'wapindex';
        //$levelpage = isset($_POST['levelpage'])?$_POST['levelpage']:'1';
        //switch ($levelpage) {
        //case '1':
            $service_id = $this->SouriObj->service_id;
            $wapTempInfo = $this->t_service_wap_template_model->getTemplateUseInfoByService($service_id);
            $data['title'] = $menu_config[$urlkey];
            $data['currentPage'] = $menu_config[$urlkey];
            $data['menulist']['0']['menu_name'] = $menu_config['wapindex'];
            $data['menulist']['0']['menu_url'] = $this->url_config['wapindex'];
            foreach (explode(',',$wapTempInfo->main_menu) as $key=>$val) {
                $menu = explode('|',$val);
                $data['menulist'][$key+1]['menu_name'] = $menu['2'];
                $data['menulist'][$key+1]['menu_url'] =  $menu['1'];
            }
            foreach ($data['menulist'] as $key=>$val) {
                $data['menulist'][$key]['menu_url'] = $val['menu_url'].$this->SouriObj->sourl;
            }
            $data['userspace'] =  $this->url_config['userspace'].$this->SouriObj->sourl;
            //break;
        //}
        echojson(0,$data);
    }
    /**
     *description:经销商加关注
     *author:yanyalong
     *date:2014/04/26
     */
    public function service_like(){
        $userinfo = $this->t_user_info_model->getInfoByWeixinid($this->SouriObj->openid);
        if($userinfo==false){
            echojson(1,"","用户信息异常");
        }
        $user_id = $userinfo->user_id;
        $is_follow = $this->t_like_service_model->is_follow($user_id,$this->SouriObj->service_id);		
        if($is_follow=='1'){
            if($this->t_like_service_model->del_follow($user_id,$this->SouriObj->service_id)!=false){
                echojson(0,'取消成功');
            }else{
                echojson(1,'取消失败');
            }
        }else{
            $this->t_like_service_model->service_id = $this->SouriObj->service_id;
            $this->t_like_service_model->user_id = $user_id;
            if($this->t_like_service_model->insert()!=false){
                echojson(0,"",'关注成功');
            }else{
                echojson(1,"",'关注失败');
            }
        }
    }
    /**
     *description:关于我们
     *author:yanyalong
     *date:2014/04/26
     */
    public function contact_us(){
        $data['contact_us'] = "联系我们 Copyright2013-2014 平台支持: 灵感无限";
        echojson(0,$data); 
    }
}

