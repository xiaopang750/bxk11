<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description: 全局页面加载中转控制器
 *author:yanyalong
 *date:2014/03/20
 */
class  vindex extends   Wap_Controller {
    function __construct(){
        parent::__construct();
        loadLib('WinXinSourl');
        $this->SouriObj = new WinXinSourlClass();
        $this->load->model('t_service_wap_slide_model');
        $this->load->model('t_service_wap_template_model');
    }
    /**
     *description:幻灯片
     *author:yanyalong
     *date:2014/04/26
     */
    public function slide(){
        $service_id = $this->SouriObj->service_id;
        $slide_list = $this->t_service_wap_slide_model->getSlideListByService($service_id,0); 
        if($slide_list==false){
            $slide_list = $this->t_service_wap_slide_model->getSlideListByService($service_id,1); 
            if($slide_list==false) echojson(1,"","数据异常");
        }
        foreach ($slide_list as $key=>$val) {
            $data[$key]['slide_url'] =$val->slide_url.$this->SouriObj->sourl;
            $data[$key]['slide_pic'] =$val->slide_pic;
        }
        echojson(0,$data);
    }
    /**
     *description:快捷菜单
     *author:yanyalong
     *date:2014/04/26
     */
    public function diy_menu_list(){
        $service_id = $this->SouriObj->service_id;
        $wapTempInfo = $this->t_service_wap_template_model->getTemplateUseInfoByService($service_id);
            foreach (explode(',',$wapTempInfo->shortcut_menu) as $key=>$val) {
                $shortcut_menu = explode('|',$val);
                $data['shortcut_menu'][$key]['menu_name'] = $shortcut_menu['2'];
                $data['shortcut_menu'][$key]['menu_url'] =  $shortcut_menu['1'];
                //$data['shortcut_menu'][$key]['menu_pic'] = "/lgwx/static/system/wap/skin/".$this->viewdata['template_code']."/".strval($key+1).".png";
                $data['shortcut_menu'][$key]['menu_pic'] = $shortcut_menu['3'];
            }
        foreach ($data['shortcut_menu'] as $key=>$val) {
            $data['shortcut_menu'][$key]['menu_url'] = $val['menu_url'].$this->SouriObj->sourl;
        }
         $row = model("t_service_info")->get($service_id);
        
        if($row && $row->service_wap_template_pic){
            $this->config->load('uploads');
            $serviceLogo_config = $this->config->item("serviceLogo"); 
            $data['index_bg'] = $serviceLogo_config['relative_upload'].$row->service_wap_template_pic;
         }else{
            $data['index_bg'] = "/lgwx/static/system/wap/skin/".$this->viewdata['template_code']."/bg.jpg";
         }     
       
        echojson(0,$data);
    }
}

