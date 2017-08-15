<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:经销商加盟
 *author:yanyalong
 *date:2014/03/20
 */

class join extends  MY_Controller {
    function __construct(){
        parent::__construct();
    }

    /**
     *description:经销商加盟页面
     *author:yanyalong
     *date:2014/03/20
     */
    public function index(){
        $this->config->load('view');
        $config = $this->config->item('lgwx');
        $this->load->view($config['service_join']);	
    }
}

