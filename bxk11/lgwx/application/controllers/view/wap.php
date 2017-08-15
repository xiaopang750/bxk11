<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:wap相关信息
 *author:yanyalong
 *date:2014/05/18
 */
class  wap extends  MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('t_wap_template_model');
        $this->load->model('t_service_wap_template_model');
        $this->load->model('t_service_wap_menu_model');
    }
    /**
     *description:模版设置
     *author:yanyalong
     *date:2014/05/23
     */
    public function template_list(){
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        $service_template_info = $this->t_service_wap_template_model->getTemplateUseInfoByService($service_id);
        $wap_template = $this->t_wap_template_model->get($service_template_info->template_id);
        $template_list = $this->t_wap_template_model->geLsitByServiceType(1);
        $this->config->load('wap_template');		
        $template_config = $this->config->item("template");		
        $templist= array();
        foreach ($template_list as $key=>$val) {
            if($val->template_id==$wap_template->template_id){
                $templist[$key]['is_select']= "1";
            }else{
                $templist[$key]['is_select']= "0";
            }
            $templist[$key]['template_id']= $val->template_id;
            $templist[$key]['template_name']= $val->template_name;
            $templist[$key]['template_cover'] = $template_config['coverpic'].$val->template_code."/bg.jpg";
        }
        $mine_template['template_name'] = $wap_template->template_name;
        $mine_template['template_id'] = $wap_template->template_id;
        $row = model("t_service_info")->get($service_id);
        
        if($row && $row->service_wap_template_pic){
            $serviceLogo_config = $this->config->item("serviceLogo"); 
            $mine_template['template_cover'] = $serviceLogo_config['relative_upload'].$row->service_wap_template_pic;
         }else{
            $mine_template['template_cover'] = $template_config['coverpic'].$wap_template->template_code."/bg.jpg";
         }     
        
        $data['mine_template'] = $mine_template;
        $data['template_list'] = $templist;
        echojson(0,$data);
    }
    /**
     *description:获取快捷方式列表
     *author:yanyalong
     *date:2014/05/18
     */
    public function shortcutlist(){
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,"","参数错误");
                
        $template_info = $this->t_service_wap_template_model->getTemplateUseInfoByService($service_id);
        
        $wap_template = $this->t_wap_template_model->get($template_info->template_id);

        $this->config->load('wap_template');		
        $template_config = $this->config->item("template");		

        $dirfiles = getDirFiles($template_config['shortcut_dir'].$wap_template->template_code."/");

        foreach ($dirfiles as $key=>$val) { 
            if(pathinfo($val,PATHINFO_EXTENSION)=="png"){
                $dirfile[$key]= $template_config['shortcut_url'].$wap_template->template_code."/".$val; 
            }
        }
        $data['shortcutpic'] = $dirfile;

        $menulist= explode(',',$template_info->shortcut_menu);

        $shortcutlist = array();
        $menu_list = $this->t_service_wap_menu_model->geLsitByServiceType(1,2);
        foreach ($menulist as $key=>$val) {
            $shortcut = explode('|',$val); 
            $shortcutlist[$key]['menu_id'] = $shortcut[0]; 
            $shortcutlist[$key]['url'] = $shortcut[1]; 
            $shortcutlist[$key]['title'] = $shortcut[2];
            $picSelected = isset($shortcut[3])?$shortcut[3]:'';
           foreach ($dirfile as $keys => $values) {
              $shortcutlist[$key]['pic'][$keys]['name'] = $values;
              if($values == $picSelected){
                $shortcutlist[$key]['pic'][$keys]['select'] = 1;
              }else{
                $shortcutlist[$key]['pic'][$keys]['select'] = 0;
              }
           }
            $shortcutlist[$key]['sort'] = $key; 
            foreach ($menu_list as $keys=>$vals) {
                $shortcutlist[$key]['menulist'][$keys]['menu_id'] = $vals->menu_id; 
                $shortcutlist[$key]['menulist'][$keys]['menu_name'] = $vals->menu_name; 
                $shortcutlist[$key]['menulist'][$keys]['menu_url'] = $vals->menu_url; 
                if($shortcut[0]==$vals->menu_id){
                    $shortcutlist[$key]['menulist'][$keys]['select'] = "1"; 
                }else{
                    $shortcutlist[$key]['menulist'][$keys]['select'] = "0"; 
                }
            }
        }
        $data['shortcutlist'] = $shortcutlist;
        echojson(0,$data);
    }
    /**
     *description:获取主菜单列表
     *author:yanyalong
     *date:2014/05/18
     */
    public function main_list(){
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,"","参数错误");
        $template_info = $this->t_service_wap_template_model->getTemplateUseInfoByService($service_id);
        $menulist= explode(',',$template_info->main_menu);
        $mainmenulist= array();
        $menu_list = $this->t_service_wap_menu_model->geLsitByServiceType(1);
        foreach ($menulist as $key=>$val) {
            $shortcut = explode('|',$val); 
            $mainmenulist[$key]['menu_id'] = $shortcut[0]; 
            $mainmenulist[$key]['url'] = $shortcut[1]; 
            $mainmenulist[$key]['title'] = $shortcut[2]; 
            $mainmenulist[$key]['sort'] = $key; 
            foreach ($menu_list as $keys=>$vals) {
                $mainmenulist[$key]['menulist'][$keys]['menu_id'] = $vals->menu_id; 
                $mainmenulist[$key]['menulist'][$keys]['menu_name'] = $vals->menu_name; 
                $mainmenulist[$key]['menulist'][$keys]['menu_url'] = $vals->menu_url; 
                if($shortcut[0]==$vals->menu_id){
                    $mainmenulist[$key]['menulist'][$keys]['select'] = "1"; 
                }else{
                    $mainmenulist[$key]['menulist'][$keys]['select'] = "0"; 
                }
            }
        }
        $data['mainmenulist'] = $mainmenulist;
        echojson(0,$data);
    }
    /**
     *description:服务商素材管理列表
     *author:yanyalong
     *date:2014/05/23
     */
    public function album(){
        $this->CheckAccessByKey('album_list');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,"","参数错误");
        $p= isset($_POST['p'])?$_POST['p']:'2';
        $num= isset($_POST['num'])?$_POST['num']:'5';
        $start = ($p-1)*$num;
        $end = ($p-1)*$num+$num+1;
        $this->config->load('uploads');		
        $config = $this->config->item("serviceInformationContent");		
        $files = array();
        $arr = array();
        if(file_exists($config['upload_path'].$service_id."/")){
            $dirfiles = getDirFiles($config['upload_path'].$service_id."/");
            $dirArr = array(); 
            foreach ($dirfiles as $key=>$val) {
                $document_url = $config['upload_path'].$service_id."/".$val;
                $dirArr[$key]['filename'] = $val;
                $dirArr[$key]['fileatime'] = filectime($document_url); 
            }
              
           $dirfiles = sortArrayDesc($dirArr,'fileatime');

            if(!empty($dirfiles)){
                $count = count($dirfiles);

                foreach ($dirfiles as $key=>$val) {

                    if($key>=$start&&$key<$end){

                        $document_url = $config['upload_path'].$service_id."/".$val['filename']; 
                        $imginfo =getimagesize($document_url);
                        $files['pic_url']= $config['relative_upload'].$service_id."/".$val['filename']; 
                        $files['pic_size']= $imginfo['0']."*".$imginfo['1']; 
                        $files['pic_kb']= ceil(filesize($document_url)/1024)."KB"; 
                        $files['document_url']= $document_url; 
                        $files['pic_name']= basename($document_url);
                        array_push($arr, $files);
                    }
                }
            }else{

                $files = ""; 
                $count= "0";
            }
        }

        $data['album_list'] = $arr ? $arr : array();
        $data['count'] = isset($count) ? $count : 0;
        echojson(0,$data);
    }

}

