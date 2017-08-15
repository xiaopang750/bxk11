<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:资讯管理
 *author:yanyalong
 *date:2014/04/21
 */
class  Information extends   MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("t_service_information_model");
        $this->load->model("t_information_type_model");
    }
    /**
     *description:资讯添加
     *author:yanyalong
     *date:2014/04/21
     */
    public function add(){
        $this->CheckAccessByKey('information_add');
        $data['si_id'] = "";
        $data['si_title'] = "";
        $data['si_desc'] = "";
        $data['si_content'] = "";
        $data['si_author'] = "";
        $data['si_pic'] = "";
        $data['is_show'] = "";
        //获取所有资讯分类数据
        $res = $this->t_information_type_model->getList();
        $it_id = isset($_POST['it_id'])?$_POST['it_id']:'';
        $typelist = array();
        foreach ($res as $key=>$val) {
            $typelist[$key]['it_id'] = $val->it_id;
            $typelist[$key]['it_name'] = $val->it_name;
            if($it_id == $val->it_id) $typelist[$key]['select'] = "1";else $typelist[$key]['select'] = "0";
        }
        $data['it_list'] = $typelist;
        echojson(0,$data);
    }
    /**
     *description:资讯管理列表数据(包括查询)
     *author:yanyalong
     *date:2014/04/21
     */
    public function getlist(){
        $this->CheckAccessByKey('information_list');
        $p= isset($_POST['p'])?$_POST['p']:'1';
        $num= isset($_POST['num'])?$_POST['num']:'10';
        $keywords = isset($_POST['keywords'])?$_POST['keywords']:'';
        $it_id = isset($_POST['it_id'])?$_POST['it_id']:'';
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        $data['information_add'] = $this->actionList->information_add."&it_id=".$it_id;
        $data['information_edit'] = $this->actionList->information_edit."&si_id=";
        $res = $this->t_service_information_model->getList($service_id,$keywords,$p,$num,$it_id);
        $data['keywords'] = $keywords;
        if($res==false){
            $data['informationlist'] = "";
            $data['count'] = "0";
            $data['current_count'] = "0";
        }
        $count_res = $this->t_service_information_model->getList($service_id,$keywords,'','',$it_id);
        $data['count'] = count($count_res);
        $data['current_count'] = count($res);
        //$this->config->load('uploads');		
        //$uploads_config= $this->config->item('serviceInformation');
        foreach ($res as $key=>$val) {
            $data['informationlist'][$key]['it_name'] = $this->t_information_type_model->get($val->it_id)->it_name;
            $data['informationlist'][$key]['si_id'] = $val->si_id;
            $data['informationlist'][$key]['si_title'] = $val->si_title;
            //$data['informationlist'][$key]['si_pic'] = $uploads_config['relative_thumb_1_path'].$val->si_pic;
            $data['informationlist'][$key]['si_addtime'] = $val->si_addtime;
        }
        //获取所有资讯分类数据
        $result = $this->t_information_type_model->getList();
        $typelist = array();
        foreach ($result as $k=>$v) {
            $typelist[$k]['it_id'] = $v->it_id;
            $typelist[$k]['it_name'] = $v->it_name;
            if($it_id == $v->it_id){
                $typelist[$k]['select'] = "1";
            }else{
                $typelist[$k]['select'] = "0";
            }
        }
        $data['it_list'] = $typelist;
        echojson(0,$data);
    }
    /**
     *description:编辑资讯
     *author:yanyalong
     *date:2014/04/21
     */
    public function edit(){
        $this->CheckAccessByKey('information_edit');
        safeFilter();
        $this->config->load('uploads');		
        $uploads_config= $this->config->item('serviceInformation');
        $si_id= isset($_POST['si_id'])?$_POST['si_id']:echojson(1,"","操作异常");
        $information_info = $this->t_service_information_model->get($si_id);       
        if($information_info==false) echojson(1,"","您正在操作一篇不存在的资讯");
        $data['si_id'] = $information_info->si_id;
        $data['si_title'] = $information_info->si_title;
        $data['si_desc'] = $information_info->si_desc;
        $data['si_content'] = htmlspecialchars_decode($information_info->si_content);
        $data['si_pic'] = $uploads_config['relative_thumb_1_path'].$information_info->si_pic;
        $data['is_show'] = $information_info->si_wap_isshow;
        $data['si_author'] = $information_info->si_author;
        //获取所有资讯分类数据
        $res = $this->t_information_type_model->getList();
        $typelist = array();
        foreach ($res as $key=>$val) {
            $typelist[$key]['it_id'] = $val->it_id;
            $typelist[$key]['it_name'] = $val->it_name;
            if($val->it_id==$information_info->it_id){
                $typelist[$key]['select'] = "1";
            }else{
                $typelist[$key]['select'] = "0";
            }
        }
        $data['it_list'] = $typelist;
        echojson(0,$data);
    }
    /**
     *description:新增幻灯片页面数据
     *author:yanyalong
     *date:2014/05/25
     */
    public function slide_add(){
        $data = array(
            "slide_id"=>"",
            "slide_title"=>"",
            "slide_type"=>"",
            "slide_url"=>"",
            "slide_pic"=>""
        );
        echojson(0,$data);
    }
}
