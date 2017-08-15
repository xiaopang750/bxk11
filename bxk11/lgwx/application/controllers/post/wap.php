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
     *description:保存快捷方式列表
     *author:yanyalong
     *date:2014/05/18
     */
    public function shortcutlist(){
        $shortcut = isset($_POST['shortcut'])?$_POST['shortcut']:echojson(1,"","参数异常");
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,"","参数错误");
        $tempuse = $this->t_service_wap_template_model->getTemplateUseInfoByService($service_id);
        $data['shortcut_menu'] = $shortcut; 
        $res = $this->t_service_wap_template_model->updates_global($data,array('swt_id'=>$tempuse->swt_id));
        if($res==true) echojson(0,"","保存成功");
        else  echojson(1,"","保存成功");
    }
    /**
     *description:获取主菜单列表
     *author:yanyalong
     *date:2014/05/18
     */
    public function main_list(){
        $mainmenu= isset($_POST['mainmenu'])?$_POST['mainmenu']:echojson(1,"","参数异常");
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,"","参数错误");
        $tempuse = $this->t_service_wap_template_model->getTemplateUseInfoByService($service_id);
        $data['main_menu'] = $mainmenu; 
        $res = $this->t_service_wap_template_model->updates_global($data,array('swt_id'=>$tempuse->swt_id));
        if($res==true) echojson(0,"","保存成功");
        else  echojson(1,"","保存成功");
    }
    /**
     *description:应用模版
     *author:yanyalong
     *date:2014/05/23
     */
    public function template_apply(){
        //$_POST['template_id'] = 1;
        $this->config->load('wap_template');		
        $template_config = $this->config->item("template");		
        $template_id = isset($_POST['template_id'])?$_POST['template_id']:echojson(1,"","参数错误"); 
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,"","参数错误");
        $oldtemp = $this->t_service_wap_template_model->getTemplateUseInfoByService($service_id);
        if($oldtemp==false) echojson(1,"","应用失败，数据异常");
        $url = $this->actionList->template_list;
        if($oldtemp->template_id==$template_id) echojson(0,$url,"应用成功");
        //判断是否应用过该模版
        //1.应用过，，修改新模版应用状态为使用中，修改当前应用中模版状态为未使用  
        //2.未引用过,插入一条数据到模版应用表中，并将应用状态设置为应用中 然后修改当前应用中模版状态未使用
        $service_templist = $this->t_service_wap_template_model->getTemplateListByService($service_id);
        $tempflag = false;
        foreach ($service_templist as $key=>$val) {
            if($val->template_id==$template_id){
                $swt_id = $val->swt_id;
                $tempflag = true;
                break;
            }
        }
        if($tempflag==true){
            $new_temp['is_use'] = 1;
            $this->t_service_wap_template_model->updates_global($new_temp,array('swt_id'=>$swt_id));
        }else{
            $template_list = $this->t_service_wap_menu_model->geLsitByServiceType(1);
            $wap_template = $this->t_wap_template_model->get($template_id);
            $main_menu = "";
            $i = 0;
            foreach ($template_list as $keys=>$vals) {
                if($vals->menu_level==1){
                    $main_menu .= $vals->menu_id."|".$vals->menu_url."|".$vals->menu_name.',';
                    $i++;
                }else{
                    continue; 
                }
            }
            $shortcut_menu = "";
            //$menucount = $wap_template->main_menu_count+$wap_template->shortcut_menu_count;
            //$j = $wap_template->main_menu_count;
            $i=1;
            $template_list = $this->t_service_wap_menu_model->geLsitByServiceType(1,2);
            foreach ($template_list as $key=>$val) {
                if($val->menu_level=="2"){
                    $pic = $template_config['shortcut_url'].$wap_template->template_code."/".$i.".png";
                    $shortcut_menu .=  $val->menu_id."|".$val->menu_url."|".$val->menu_name."|".$pic.',';
                    //$j++;
                    $i++;
                }else{
                    continue; 
                }
            }
            $this->t_service_wap_template_model->template_id = $template_id;
            $this->t_service_wap_template_model->service_id= $service_id;
            $this->t_service_wap_template_model->main_menu= trim($main_menu,',');
            $this->t_service_wap_template_model->shortcut_menu= trim($shortcut_menu,',');
            $this->t_service_wap_template_model->is_use=1;
            $this->t_service_wap_template_model->insert();
        }
        //旧模板信息
        $old_temp['is_use'] = 0;
        $res = $this->t_service_wap_template_model->updates_global($old_temp,array('swt_id'=>$oldtemp->swt_id));
        if($res==true) echojson(0,$url,"应用成功");
        else  echojson(1,$url,"应用失败");
    }
    /**
     *description:还原模版
     *author:liuguangping
     *date:2014/07/09
     */
    public function template_reset(){
        $this->config->load('wap_template');        
        $template_config = $this->config->item("template");     
        $template_id = isset($_POST['template_id'])?$_POST['template_id']:echojson(1,"","参数错误"); 
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,"","参数错误");
        $wap_template = $this->t_wap_template_model->get($template_id);
        
        $data['service_wap_template_pic'] = '';
        $map['service_id'] = $service_id;
        if(model('t_service_info')->updates_global($data,$map)){
            $mine_template['template_cover'] = $template_config['coverpic'].$wap_template->template_code."/bg.jpg";
            $mine_template['template_name'] = $wap_template->template_name;
            //$mine_template['template_id'] = $wap_template->template_id;
           // $data['mine_template'] = $mine_template;
            echojson(0,$mine_template);
        }else{
            echojson(1,'',"模板还原默认失败");
        }
    }
    /**
     *description:删除一个素材文件
     *author:yanyalong
     *date:2014/05/25
     */
    public function delalbum(){
        safeFilter();
        $albumfile  = (isset($_POST['pic_url'])&&file_exists($_SERVER['DOCUMENT_ROOT'].$_POST['pic_url']))?$_SERVER['DOCUMENT_ROOT'].$_POST['pic_url']:echojson(1,"","您正在操作一条不存在的文件");
        $url = $this->actionList->album_list;
        (unlink($albumfile))?echojson(0,$url,"删除成功"):echojson(0,$url,"删除失败");
    }
}

