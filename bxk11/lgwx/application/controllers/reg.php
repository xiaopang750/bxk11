<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:经销商注册
 *author:yanyalong
 *date:2014/03/20
 */

class  reg extends   MY_Controller {
    function __construct(){
        parent::__construct();
    }
    
    /**
     *description:经销商注册页面
     *author:yanyalong
     *date:2014/03/20
     */
    public function index(){
		$this->config->load('view');
		$config = $this->config->item('lgwx');
        $data['title'] = "注册-jia178移动营销自助平台";
        $data['login_url'] = $this->actionList->service_login;
        //更新推广链接点击次数

        $spreader_code = isset($_GET['flg'])?$_GET['flg']:'';
        if($spreader_code){
            loadLib('LgwxSpreader');
            $this->lgwxSpreader = new LgwxSpreader();
            $this->lgwxSpreader->setIncrease($spreader_code,'ss_clicks','up');
        }
        $this->load->view($config['service_reg'],$data);	
    }
}



