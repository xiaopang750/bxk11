<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:资讯管理
 *author:liuguangping
 *date:2014/05/30
 */
class  InformationView extends CI_Controller {

    function __construct(){
        parent::__construct();
        $http_host = $_SERVER['HTTP_HOST'];
        if(stripos($http_host, 'jia178.com') === false)  jumpAjax('您好请正确访问，非法入侵',U());
        $this->load->model("t_service_information_model");
        $this->load->model("t_information_type_model");
    }

    /**
     *description:资讯列表数据(包括查询)
     *author:liuguangping
     *date:2014/05/30
     */
    public function getlist(){
        safeFilter();
        $cb = (isset($_GET['cb']) && $_GET['cb']) ? $_GET['cb'] : 'jia178callBack';
        $p= isset($_GET['p'])?$_GET['p']:'1';
        $num= isset($_GET['num'])?$_GET['num']:'10';
        $keywords = isset($_GET['keywords'])?$_GET['keywords']:'';
        $it_id = (isset($_GET['it_id']) && $_GET['it_id']) ? $_GET['it_id'] : '';
        $service_id = 0;

        $res = $this->t_service_information_model->getList($service_id,$keywords,$p,$num,$it_id);
        $data['keywords'] = $keywords;
        $data['it_id'] = $it_id;
        if($res==false){
            $data['informationlist'] = "";
            $data['count'] = "0";
            $data['current_count'] = "0";
        }
        $count_res = $this->t_service_information_model->getList($service_id,$keywords,'','',$it_id);
        $data['count'] = count($count_res);
        $data['current_count'] = count($res);
        foreach ($res as $key=>$val) {
            
            $data['informationlist'][$key]['si_id'] = $val->si_id;
            $data['informationlist'][$key]['si_title'] = $val->si_title;
            $config = C('uploads','service_InforMation');
            
            $pic = $_SERVER['HTTP_HOST'].$config['relative_path'].'thumb_2/'.$val->si_pic;
            $existsThumb2 = $config['thumb_2'].$val->si_pic;
            if( !file_exists($existsThumb2) ){
                $pic =  $_SERVER['HTTP_HOST'].$config['default_2'];
            }
            $pic_url = (stripos($pic,'http://') ===false) ? "http://".$pic:$pic;
            $data['informationlist'][$key]['si_pic'] = $pic_url;
            $data['informationlist'][$key]['si_content'] = htmlspecialchars_decode($val->si_content);
            $data['informationlist'][$key]['si_likes'] = $val->si_likes;
            $data['informationlist'][$key]['si_views'] = $val->si_views;
            $data['informationlist'][$key]['si_desc'] = $val->si_desc;
            $data['informationlist'][$key]['si_addtime'] = $val->si_addtime;
        }

        $this->outPut(0,$cb,$data,'获取成功');
    }

    /**
     *description:获取热点资讯
     *author:liuguangping
     *date:2014/05/30
     */
    public function getHostSport(){
        safeFilter();
        $cb = (isset($_GET['cb']) && $_GET['cb']) ? $_GET['cb'] : 'jia178callBack';
        $where['service_id'] = 0;
        $where['si_status'] = 1;
        $res = $this->t_service_information_model->getHotSport('si_id,si_title,si_pic,si_likes,si_views,si_desc',$where);

        $hostlist = array();
        foreach ($res as $key=>$val) {
            $hostlist[$key]['si_id'] = $val->si_id;
            $hostlist[$key]['si_title'] = $val->si_title;
            $config = C('uploads','service_InforMation');
            $pic = $_SERVER['HTTP_HOST'].$config['relative_path'].'thumb_1/'.$val->si_pic;
            $existsThumb1 = $config['thumb_1'].$val->si_pic;
            if( !file_exists($existsThumb1) ){
                $pic =  $_SERVER['HTTP_HOST'].$config['default_1'];
            }
            $pic_url = (stripos($pic,'http://') ===false) ? "http://".$pic:$pic;
            $hostlist[$key]['si_pic'] = $pic_url;
            $hostlist[$key]['si_likes'] = $val->si_likes;
            $hostlist[$key]['si_views'] = $val->si_views;
            $hostlist[$key]['si_desc'] = $val->si_desc;   
        }
        $data['host_list'] = $hostlist;
        $this->outPut(0,$cb,$data,'获取成功');
    }

     /**
     *description:获取资讯分类
     *author:liuguangping
     *date:2014/05/30
     */
    public function getType(){

        safeFilter();
        $cb = (isset($_GET['cb']) && $_GET['cb']) ? $_GET['cb'] : 'jia178callBack';
        $resType = $this->t_information_type_model->getList();
        $typelist = array();
        foreach ($resType as $key=>$val) {
            $typelist[$key]['it_id'] = $val->it_id;
            $typelist[$key]['it_name'] = $val->it_name;
            $where = "it_id = $val->it_id AND service_id = 0 AND si_status = 1";
            $typelist[$key]['si_count'] = count($this->t_service_information_model->getArray('si_id',$where));
        }

        $data['it_list'] = $typelist;

        $this->outPut(0,$cb,$data,'获取成功');
    }

    /**
     *description:阅读资讯
     *author:liuguangping
     *date:2014/05/30
     */
    public function readNews(){

        safeFilter();
        $cb = (isset($_GET['cb']) && $_GET['cb']) ? $_GET['cb'] : 'jia178callBack';
        $si_id= isset($_GET['si_id'])?$_GET['si_id']:$this->outPut(1,$cb,'','操作异常');
        $information_info = $this->t_service_information_model->get($si_id);       
        if($information_info==false) $this->outPut(1,$cb,'','您正在操作一篇不存在的资讯');
        $data['si_id'] = $information_info->si_id;
        $data['si_title'] = $information_info->si_title;
        $data['si_content'] = htmlspecialchars_decode($information_info->si_content);

        $config = C('uploads','service_InforMation');
        $pic = $_SERVER['HTTP_HOST'].$config['relative_path'].'thumb_2/'.$information_info->si_pic;
        $existsThumb2 = $config['thumb_2'].$information_info->si_pic;
        if( !file_exists($existsThumb2) ){
            $pic =  $_SERVER['HTTP_HOST'].$config['default_2'];
        }
        $pic_url = (stripos($pic,'http://') ===false) ? "http://".$pic:$pic;
        $data['si_pic'] = $pic_url;
        $data['si_likes'] = $information_info->si_likes;
        $data['si_desc'] = $information_info->si_desc;
        $data['si_views'] = $information_info->si_views;
        $data['si_author'] = $information_info->si_author;
        $data['si_addtime'] = $information_info->si_addtime;
        $data['it_id'] = $information_info->it_id;
        $data['it_name'] = $this->t_information_type_model->get($information_info->it_id)->it_name;
        $this->t_service_information_model->setIncrease($si_id,'up');
        $this->outPut(0,$cb,$data,'获取成功');
    }

    /**
     *description:跨域输出
     *author:liuguangping
     *date:2014/05/30
     */
    public function outPut($code, $cb, $data, $msg) {
        $data = json_encode( $data );
        echo "$cb({err:$code, data:$data, msg:\"$msg\"})";exit; 
    }
   
}
