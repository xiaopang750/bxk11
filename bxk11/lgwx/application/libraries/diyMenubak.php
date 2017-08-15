<?php

class DiyMenu{
	
    private $menu_diy;
    private $menu_config;
    private $weixin;
    private $information;
	private $CI;
    public $service_token;

	public function __construct(){

		$this->CI = &get_instance();
		$this->CI->load->model("t_service_menu_diy_model");
        $this->menu_diy= $this->CI->t_service_menu_diy_model;
        $this->CI->load->model("t_weixin_model");
        $this->weixin= $this->CI->t_weixin_model;
        $this->CI->load->model("t_service_menu_config_model");
        $this->menu_config= $this->CI->t_service_menu_config_model;
        $this->CI->load->model("t_service_information_model");
        $this->information= $this->CI->t_service_information_model;
        $this->CI->load->helper('import_excel');
	}

	    //获取菜单
    public function getMenuList(){

        $list = array();
        $menuR = $this->parentStringToArray();
        if($menuR){
            $list = $this->editMenuList();
        }else{
            $list = $this->initMenuList();
        }

        return $list;
        
    }

    //格式父级字符串成数组
    /**
    * return array(array('c_id'=>0,'c_name'=>''),......)
    */
    public function parentStringToArray(){
        $service_token = isset($this->service_token) && $this->service_token?$this->service_token:echojson(1,'','您还没有绑定公众账号哦');
        //$service_token = 'liuguangping';
        $where['service_token'] = $service_token;
        $menuR = $this->menu_diy->getSortArray('*',$where,3);
    
        if($menuR){
            $smd_nameSA = array();
            foreach ($menu_R as $key => $value) {
                $where['smd_pid'] = $value->smd_id;
                $menuChiledR = $this->menu_diy->getOne('*',$where);

                $smd_nameSA[$key]['smd_pid'] = $value->smd_id;
                $smd_nameSA[$key]['smd_pname'] = $value->smd_name;
                $smd_nameSA[$key]['smd_psort'] = $key+1;
                if($menuChiledR){
                    $smd_nameSA[$key]['smd_ptype'] = '';
                    $smd_nameSA[$key]['smd_pcontent'] = '';
                }else{
                    if($value->smd_type){
                        $smd_nameSA[$key]['smd_ptype'] = $value->smd_type;
                    }else{
                        $smd_nameSA[$key]['smd_ptype'] = '';
                    }
                    $smd_nameSA[$key]['smd_pcontent'] = $value->smd_content;
                }
            }
            return $smd_nameSA;

        }else{
            return false;
        }
    }

     //子级字符串格式成父子级数据
    public function editMenuList(){
        $parentA = $this->parentStringToArray();//父级选中
        $sonA = $this->sonStringToArray();//子级选中的
        if($parentA){
            $list = array();
            foreach ($parentA as $key => $value) {
                $list[$key]['smd_son_list'] = $this->sonStringToArray($value['smd_pid']);
            }

            $list['menu_list'] = $list;
            return $list;
        }else{
            return $this->initMenuList();
        }
    }

    //获取子级格式成数组
    public function sonStringToArray($pid){

        $where['smd_pid'] = $pid;
        $where['service_token'] = $this->service_token;
        $sonR = $this->menu_diy->getSortArray('*',$where,5);
        $list = array();
        if($sonR){
            foreach($sonR as $key=>$value){
                $list[$key]['smd_id'] = $value->smd_id;
                $list[$key]['smd_sort'] = $key+1;
                $list[$key]['smd_name'] = $value->smd_name;
                $list[$key]['smd_type'] = $value->smd_type;
                if($value->smd_type == 1){
                    $list[$key]['smd_content'] = $value->smd_content;
                    $list[$key]['smd_type'] = $value->smd_type;
                }elseif($value->smd_type == 2){
                    if($value->smd_content){
                        $inId = explode(',', $value->smd_content);
                        foreach ($inId as $ke =>$va) {
                            $whereInO['si_id'] = $va;
                            $whereInO['si_status'] = 1;
                            $infoOneR = $this->information->getOne('*',$whereInO);
                            $list[$key]['smd_content'][$ke]['si_url'] = $infoOneR->si_pic;
                            $list[$key]['smd_content'][$ke]['si_title'] = $infoOneR->si_title;
                            $list[$key]['smd_content'][$ke]['si_pic'] = $infoOneR->si_pic;
                        }
                    }else{
                       $list[$key]['smd_content'] = ''; 
                    }
                }elseif($value->smd_type == 3){
                    if($value->smd_content){
                        $cId = explode(',', $value->smd_content);
                        $list[$key]['smd_content'] = $this->getMenuConfig($cId);
                    }else{
                        $list[$key]['smd_content'] = $this->getMenuConfig();
                    }
                }else{
                    $list[$key]['smd_type'] = '';
                    $list[$key]['smd_content'] = '';
                }
            }
        }else{
            $list = '';
        }
        return $list;

    }

    //获取咨讯列表
    public function getServiceIdToInfoList(){
        $service_token = isset($this->service_token) && $this->service_token?$this->service_token:echojson(1,'','您还没有绑定公众账号哦');
        $where['service_token'] = $service_token;
        $whereW['wx_type'] = 1;
        $whereW['service_token'] = $service_token;
        $whereW['wx_status'] = 1;
        $serviceR = $this->weixin->getOne('service_id',$whereW);
        
        if($serviceR){

            $whereI['si_status'] = 1;
            $whereI['service_id'] = $serviceR->service_id;
            $informationR = $this->information->getArray('*',$whereI);
            if($informationR) return $informationR; else return false;

        }else{
            return false;
        }
    }

    public function getMenuConfig($c_idR = array()){
        $menu_configA = $this->menu_config->get_all();
        $list = array();
        if($menu_configA){
            foreach ($menu_configA as $key => $value) {
                $list[$key]['c_id'] = $value->c_id;
                $list[$key]['c_name'] = $value->c_name;
                if(in_array($value,$c_idR)){
                    $list[$key]['is_select'] = 1;
                }else{
                    $list[$key]['is_select'] = 0;
                }
               
            }
        }
        return $list;
    }

    //无数据时初化数据
    public function initMenuList(){
        $list['menu_list'] = "";
        return $list;
    }

}