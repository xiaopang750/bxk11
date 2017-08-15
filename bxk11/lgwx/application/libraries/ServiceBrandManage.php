<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:品牌管理
 *author:yanyalong
 *date:2014/04/01
 */
class ApplyBrand{
    private $service_id;
    private $columnArr;
    private $action;
    private $apply_status;
    public function __construct($service_id,$columnArr,$action=true,$apply_status=""){
        $this->service_id = $service_id;
        $this->columnArr = $columnArr;
        $this->action= $action;
        $this->apply_status= $apply_status;
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_brands_apply_model');
        $this->CI->load->model('t_service_info_model');
        $this->CI->config->load('status');
        $this->brand_status= $this->CI->config->item('brand_status');
        $this->CI->config->load('uploads');
        $this->upload_config= $this->CI->config->item('serviceApplyBrand');
        $this->brand_action_name= $this->CI->config->item('brand_action_name');
        $this->brand_action= $this->CI->config->item('brand_action');
        //$this->service_shop= $this->CI->config->item('service_shop');
        //$this->service_shop_search= $this->CI->config->item('service_shop_search');
        loadLib('ServiceUserAccess');
        $this->actionList = ServiceUserAccessFactory::getActionUrlList();
    }    
    /**
     *description:根据经销商id获取旗下所有品牌
     *author:yanyalong
     *date:2014/04/01
     */
    public function getBrandsByService(){
        $config = $this->CI->config->item("apply_brand_search");		
        $apply_status= $this->apply_status?$this->apply_status:$config['1'];
        $res = $this->CI->t_service_brands_apply_model->getApplyBrandsByServiceId($this->service_id,$apply_status);
        if($res==false) return false;
        $list = array();
        foreach ($res as $key=>$val) {
            foreach ($this->columnArr as $keys=>$vals) {
                $list[$key][$vals] = $val->$keys;
                $list[$key]['apply_brand_img'] = $this->upload_config['relative_upload'].$val->apply_brand_img;
            }
            $list[$key]['apply_status'] = $this->brand_status[$val->apply_status];
            //操作项
            $brand_action= explode('|',$this->brand_action[$val->apply_status]);
            $list[$key]['brand_action'] = "";
            $service_info= $this->CI->t_service_info_model->get($this->service_id);
            foreach ($brand_action as $keys=>$vals) {
                if($vals!=""){
                    $actionUrl = $this->actionList->$vals."&aid=".$val->apply_id;
                    if($this->actionList->$vals!=""){
                        if($vals=="brand_del"&&$val->apply_status!="4"){
                            $list[$key]['brand_action'].= "<a href='$actionUrl'  sc='remove'  scid='$val->apply_id'>".$this->brand_action_name[$vals]."</a>";
                        }elseif($vals=="brand_down"&&$val->apply_status!="4"){
                            $list[$key]['brand_action'].= "<a href='$actionUrl'  sc='down'  scid='$val->apply_id'>".$this->brand_action_name[$vals]."</a>";
                        }elseif($vals=="brand_certified"){
                            if($service_info->service_status<"21"){
                            $list[$key]['brand_action'].= "<a href='$actionUrl'>".$this->brand_action_name[$vals]."</a>";
                            }else{
                                $list[$key]['brand_action'].= "";
                            }
                        }else{
                            $list[$key]['brand_action'].= "<a href='$actionUrl'>".$this->brand_action_name[$vals]."</a>";
                        }
                    }else{
                        $list[$key]['brand_action'].= "<a href='#' title='$val->apply_laudit_desc'>".$this->brand_action_name[$vals]."</a>";
                    }
                    if($keys<count($brand_action)-1){
                        if($vals=="brand_certified"&&$service_info->service_status>"20"){
                            $list[$key]['brand_action'].= "";
                        }else{
                            $list[$key]['brand_action'].= "&nbsp;|&nbsp;";
                        }
                    }
                }
            }
        }
        return array_values($list);
    }
}
/**
 *description:系统分类工厂
 *author:yanyalong
 *date:2014/04/02
 */
class ServiceApplyBrandManageFactory{
    public function creatObj($service_id,$columnArr,$action,$apply_status=""){
        $ApplyBrand = new ApplyBrand($service_id,$columnArr,$action,$apply_status);
        return $ApplyBrand->getBrandsByService();
    }
}


