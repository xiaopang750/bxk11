<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:获取用户权限菜单列表
 *author:yanyalong
 *date:2014/03/24
 */
class  user extends  MY_Controller {
    function __construct(){
        parent::__construct();
    }
    /**
     *description:经销商平台首页
     *author:yanyalong
     *date:2014/03/25
     */
    //public function index(){
		//$this->config->load('view');
		//$config = $this->config->item('lgwx');
        //$this->load->view($config['service_index']);	
    //}
    /**
     *description:添加自账号
     *author:yanyalong
     *date:2014/03/27
     */
    public function add(){
        $this->CheckAccessByKey('user_add');
		$this->config->load('view');
		$config = $this->config->item('action');
        $this->load->view($config['user_add']);	
    }
    /**
     *description:编辑自账号
     *author:yanyalong
     *date:2014/03/27
     */
    public function edit(){
        $this->CheckAccessByKey('user_edit');
        $action_id = (isset($_GET['id']))?$_GET['id']:'';
        $this->load->model("t_service_module_action_model");
        $action= $this->t_service_module_action_model->get($action_id);
        $data['title'] = $action->action_name;
		$this->config->load('view');
		$config = $this->config->item('action');
        $this->load->view($config['user_edit'],$data);	
    }
}
