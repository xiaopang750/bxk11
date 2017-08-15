<?php
class Activities extends Wap_Controller {
	function __construct(){
		parent::__construct();
	}
    /**
     *description:促销活动列表
     *author:yanyalong
     *date:2014/04/26
     */
    public function getlist(){
        $this->viewdata['title'] = "促销活动";
        $this->load->view($this->view_config['activitieslist'],$this->viewdata);	
    }
    /**
     *description:我参加的活动列表
     *author:yanyalong
     *date:2014/04/26
     */
    public function likelist(){
        $this->viewdata['title'] = "我参加的活动";
        $this->load->view($this->view_config['activitieslikes'],$this->viewdata);	
    }
}

