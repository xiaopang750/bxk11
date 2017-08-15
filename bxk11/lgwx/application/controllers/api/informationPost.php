<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:资讯管理
 *author:liuguangping
 *date:2014/05/30
 */
class  InformationPost extends CI_Controller {
    function __construct(){
        parent::__construct();
        $http_host = $_SERVER['HTTP_HOST'];
        if(stripos($http_host, 'jia178.com') === false)  jumpAjax('您好请正确访问，非法入侵',U());
        $this->load->model("t_service_information_model");
    }
   
    
    /**
     *description:阅读自增
     *author:liuguangping
     *date:2014/05/30
     */
    public function setIncrease(){
      
        safeFilter();
        $cb = (isset($_GET['cb']) && $_GET['cb']) ? $_GET['cb'] : 'jia178callBack';
        $si_id= (isset($_GET['si_id']) && $_GET['si_id']) ? $_GET['si_id'] : $this->outPut(1,$cb,'','异常操作，未检测到资讯id');
        $updateFlag = $this->t_service_information_model->setIncrease($si_id,'up');

        ($updateFlag)?$this->outPut(0,$cb,'','操作成功'):$this->outPut(1,$cb,'','操作失败');
    }

     /**
     *description:跨域输出
     *author:liuguangping
     *date:2014/04/21
     */
    public function outPut($code, $cb, $data, $msg) {
        $data = json_encode( $data );
        echo "$cb({err:$code, data:$data, msg:\"$msg\"})";exit; 
    }
}

