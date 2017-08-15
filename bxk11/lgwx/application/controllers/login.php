<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:经销商登录
 *author:yanyalong
 *date:2014/03/20
 */

class  login extends   MY_Controller {
    function __construct(){
        parent::__construct();
    }
    
    /**
     *description:经销商登录页面
     *author:yanyalong
     *date:2014/03/20
     */
    public function index(){
		$this->config->load('view');
		$config = $this->config->item('lgwx');
        $data['title'] = "登录-jia178移动营销自助平台";
        $data['reg_url'] = $this->actionList->service_reg;
        $this->load->view($config['service_login'],$data);	
    }
}


