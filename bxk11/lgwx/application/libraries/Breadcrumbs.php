<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class BreadcrumbsFactory{
    public function CerateObjById($actionId){
        $MenuCrumbs = new MenuCrumbs($actionId); 
        return $MenuCrumbs->_crumbs;
    }
    public static function CerateObjByKey($actionKey){
        $HideCrumbs = new HideCrumbs($actionKey); 
        return $HideCrumbs->_crumbs;
    }
}
//面包屑导航
abstract class  crumbs{
    protected $_actionKey;
    protected $_actionId;
    public $_crumbs;
    function __construct(){
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_module_action_model');
        $this->_crumbs = "";
        $this->getCrumbs();
    }
    abstract function getCrumbs();
}

/**
 *菜单部分(action_status=1)
 **/
class MenuCrumbs extends crumbs{
    function __construct($actionId){
        $this->_actionId = $actionId;
        parent::__construct();
    }
    public function getCrumbs(){
        $actioninfo= $this->CI->t_service_module_action_model->get($this->_actionId); 
        $menuinfo = $this->CI->t_service_module_action_model->get($actioninfo->ma_pid); 
        $moduleinfo = $this->CI->t_service_module_action_model->get($menuinfo->ma_pid); 
        $this->_crumbs= $moduleinfo->ma_name."&gt;&gt".$menuinfo->ma_name."&gt;&gt".$actioninfo->ma_name; 
    }
}
