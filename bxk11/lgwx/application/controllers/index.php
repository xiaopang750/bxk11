<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description: 全局页面加载中转控制器
 *author:yanyalong
 *date:2014/03/20
 */
define('DEFAULT_DIR', __DIR__."/./view/");
require(DEFAULT_DIR . 'user.php');
class Index extends  user {
    function __construct(){
        parent::__construct();

    }
    /**
     *description:经销商平台页面加载控制中心
     *author:yanyalong
     *date:2014/03/20
     */
    public function index(){
        safeFilter();
        $action_id = (isset($_GET['id']))?$_GET['id']:'';
        $this->load->model("t_service_module_action_model");
        $action= $this->t_service_module_action_model->get($action_id);
        if($action==false){
            echojson(1,"","没有相关模块");	
        }
        $this->config->load('view');
        $config = $this->config->item('action');
        if(array_key_exists($action->ma_key,$config)){
            $data['title'] = $action->ma_desc;
            $data['key'] = $action->ma_key;

            //top数据
            $this->is_json = true;
            $data['topdata'] = $this->top();

            //这个是左测菜单列表
            loadLib('ServiceUserAccess');
            $serviceModuleActionMenu = new serviceModuleActionMenu(true);
            $data['actiondata'] = $serviceModuleActionMenu->accessAction;

            //面包屑导航
            loadlib('Breadcrumbs');
            $res = BreadcrumbsFactory::CerateObjById($action_id);
            $data['crumbsdata'] = $res;
            //echojson(1,$data);
            //echo "<pre>";var_dump($data);die;
            $this->sm->assign($data);
            $this->sm->display($config[$action->ma_key]);
            //$this->load->view($config[$action->ma_key],$data);	
        }else{
            echojson(1,"","该模块暂未开放！");	
        }
    }

}
