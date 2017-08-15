<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class  Vuser extends  Wap_Controller {
    function __construct(){
        parent::__construct();
        loadLib('WinXinSourl');
        $this->SouriObj = new WinXinSourlClass();
        $this->load->model('t_like_service_shop_model');
        //$this->load->model('t_user_info_model');
        $this->load->model('t_user_model');
        $this->load->model('t_user_note_model');

    }
    /**
     *description:个人中心
     *author:yanyalong
     *date:2014/04/26
     */
    public function index(){
        $this->checkLogin();
        $user_id = $this->user_id;
        $res = $this->t_user_model->get($user_id);		
        $data['nickname'] = $_SESSION['nickname'];
        $data['user_id'] = $res->user_id;
        //$userinfo = $this->t_user_info_model->get($user_id);
        $data['user_pic'] = $res->user_pic_b;
        $data['goodsLikeUrl'] = $this->url_config['goodslikes'].$this->SouriObj->sourl;
        $data['shopLikesUrl'] = $this->url_config['shoplikes'].$this->SouriObj->sourl;
        $data['notesUrl'] =$this->url_config['notelist'].$this->SouriObj->sourl;
        $data['actsLikeUrl'] =$this->url_config['activitieslikes'].$this->SouriObj->sourl; 
        $data['notice'] = "#";
        $data['service_id'] = $_REQUEST['service_id'];
        echojson(0,$data);
    }
    /**
     *description:我的装修笔记
     *author:yanyalong
     *date:2014/06/22
     */
    public function notelist(){
        $this->checkLogin();
        $user_id = $this->user_id;      
        $p= isset($_POST['p'])?$_POST['p']:'';
        $num= isset($_POST['num'])?$_POST['num']:'';
        $countres = $this->t_user_note_model->getNoteListByUser($user_id);
        if($countres==false){
            $data['current_count'] = "0";
            $data['count'] = "0";
            echojson(1,"","无相关数据");
        }else{
            $res = $this->t_user_note_model->getNoteListByUser($user_id,$p,$num);
            $data['count'] = count($res);
            $data['current_count'] = count($countres);
            if($res==false){
                echojson(1,"","无相关数据");
            }else{
                foreach ($res as $key=>$val) {
                    $data['note_list'][$key]['note_date'] = date("Y/m/d",strtotime($val->note_addtime));
                    $data['note_list'][$key]['note_time'] = date("H:i",strtotime($val->note_addtime));
                    $data['note_list'][$key]['shop_name'] = $val->shop_name;
                    $data['note_list'][$key]['note_content'] = $val->note_content;
                    $data['note_list'][$key]['goods_url'] = $this->url_config['goodsinfo'].$this->SouriObj->sourl."&shop_id=".$val->shop_id."&goods_id=".$val->goods_id;
                }
                echojson(0,$data);
            }
        }
    }
    /**
     *description:获取我关注的店铺
     *author:yanyalong
     *date:2014/06/25
     */
    public function shoplikes(){
        $this->checkLogin();
        $user_id = $this->user_id;      
        $p= isset($_POST['p'])?$_POST['p']:'';
        $num= isset($_POST['num'])?$_POST['num']:'';
        $countres = $this->t_like_service_shop_model->getShopByUserLike($user_id);
        if($countres==false){
            $data['current_count'] = "0";
            $data['count'] = "0";
        }else{
            $res = $this->t_like_service_shop_model->getShopByUserLike($user_id,$p,$num);
            $data['count'] = count($res);
            $data['current_count'] = count($countres);
            if($res==false){
                echojson(1,"","无相关数据");
            }else{
                $this->config->load('uploads');
                $uploadconfig = $this->config->item("serviceShop");		
                foreach ($res as $key=>$val) {
                    $data['shoplist'][$key]['shop_name'] = $val->shop_name;
                    $data['shoplist'][$key]['shop_address'] = $val->shop_address;
                    $data['shoplist'][$key]['shop_url'] = $this->url_config['shoprecommend'].$this->SouriObj->sourl."&shop_id=".$val->shop_id;
                    $data['shoplist'][$key]['shop_pic1'] = $uploadconfig['relative_thumb_2_path'].$val->shop_pic1;
                    $data['shoplist'][$key]['shop_tel'] = $val->shop_tel;
                    if(in_array($val->shop_status,array(1,2))){
                        $data['shoplist'][$key]['certified_status'] = "1";
                    }else{
                        $data['shoplist'][$key]['certified_status'] = "0";
                    }
                }
                echojson(0,$data);
            }
        }
    }
}

