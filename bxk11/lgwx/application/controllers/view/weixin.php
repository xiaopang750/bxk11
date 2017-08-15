<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description: 公众号管理页面
 *author:liuguagnping
 *date:2014/04/19
 */
class Weixin extends MY_Controller {
    private $t_weixin;
    private $t_service_weixin_follow_reply;
    private $t_service_weixin_reply;
    private $menu_diy;
    private $menu_config;
    private $information;

    function __construct(){
        parent::__construct();
        $this->load->model("t_weixin_model");
        $this->t_weixin = $this->t_weixin_model;
        $this->load->model("t_service_weixin_follow_reply_model");
        $this->t_service_weixin_follow_reply = $this->t_service_weixin_follow_reply_model;
        $this->load->model("t_service_weixin_reply_model");
        $this->t_service_weixin_reply= $this->t_service_weixin_reply_model;
        $this->load->model("t_service_menu_diy_model");
        $this->menu_diy= $this->t_service_menu_diy_model;
        $this->load->model("t_service_menu_config_model");
        $this->menu_config= $this->t_service_menu_config_model;
        $this->load->model("t_service_information_model");
        $this->information = $this->t_service_information_model;
        $this->load->helper('import_excel');
        loadLib('ServiceUserAccess');
        $this->actionList = ServiceUserAccessFactory::getActionUrlList();

    }

    /**
     *description:公众号管理列表
     *author:liuguangping
     *date:2014/04/19
     */
    public function getlist(){
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,'','服务商为空，请正确操作！');

        $field = 'wid,wx_name,wx_code,wx_create_time,wx_end_time,service_id,service_token,wx_type';
        $map = "service_id =$service_id AND wx_status != 99";

        $url = $this->actionList->weixin_add;
        $urledit = $this->actionList->weixin_edit;
        $res = $this->t_weixin->getArray($field,$map);
        if($res){
            $successAr = array();
            foreach ($res as $key => $value) {
                //TODO 过期我置为3
                if($value->wx_end_time < date('Y-m-d H:i:s')){
                    $data['wx_status'] = 3;
                    $where['wid'] = $value->wid;
                    $this->t_weixin->updates_global($data,$where);
                    //如果是默认
                }else{
                    $successAr['weixin_list'][$key]['wid'] = $value->wid;
                    if($value->wx_type == 1){
                        $wx_typeName = "服务号";
                    }elseif($value->wx_type == 2){
                        $wx_typeName = "订阅号";
                    }else{
                         $wx_typeName = "非法操作";
                    }
                    $successAr['weixin_list'][$key]['wx_typeName'] = $wx_typeName;
                    $successAr['weixin_list'][$key]['wx_type'] = $value->wx_type;
                    $successAr['weixin_list'][$key]['wx_name'] = $value->wx_name;
                    $successAr['weixin_list'][$key]['service_token'] = $value->service_token;
                }

            }
            $successAr['wx_add_url'] = $url;
            $successAr['wx_edit_url'] = $this->actionList->weixin_edit;
            $successAr['diy_menu_list_url'] = $this->actionList->diy_menu_list;
            $successAr['wx_setReply_url'] = $this->actionList->follow_reply;
            echojson(0,$successAr);
        }else{
            $successAr['weixin_list'] = '';
            $successAr['wx_add_url'] = $this->actionList->weixin_add;
            $successAr['wx_edit_url'] = $this->actionList->weixin_edit;
            $successAr['diy_menu_list_url'] = $this->actionList->diy_menu_list;
            $successAr['wx_setReply_url'] = $this->actionList->follow_reply;
            echojson(0,$successAr,'你还没添加公众号！数据为空');
        }
    }

    //公众号智能添加数据
    public function add_auto(){
        $url = $this->getUrl('weixin_add');
        $this->config->load('url');
        $config = $this->config->item('url');
        $data['add_url'] = $url;
        $data['regist_url'] = $config['weixin_regist_url'];
        $data['wx_user'] = '';
        $data['wx_pass'] = '';
        echojson(0,$data);
    }

    //公众号智能添加
    public function add(){
        //$url = $this->getUrl('weixin_add_auto');
        /************todo临时编辑，后去掉************/
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,'','服务商为空，非法操作！');
        $where['service_id'] = $service_id;

        $wid = $this->input->post('wid',true);
        $wid = isset($wid) && $wid?$wid:"";
        if($wid) $where['wid'] = $wid;
        $where['wid'] = $wid;
        $weixinR = $this->t_weixin->getOne('*',$where);
        $weixin_regist_url = $this->actionList->weixin_regist_url;
        $weixin_list_url = $this->actionList->weixin_list;
        if($weixinR){
            $urls = $_SERVER['HTTP_HOST'].$this->actionList->api_url.$weixinR->service_token;
            if(stripos($urls,'http://') === FALSE)
            $urls = 'http://'.$urls;
            $data['api_url'] = $urls;
            $data['api_token'] = $weixinR->service_token;

            $data['wid'] = $weixinR->wid;
            $data['wx_appid'] = $weixinR->wx_appid;
            $data['wx_type'] = $weixinR->wx_type;
            $data['wx_appsecret'] = $weixinR->wx_appsecret;
            $data['wx_name'] = $weixinR->wx_name;
            $data['wx_id'] = $weixinR->wx_id;
            $data['wx_code'] = $weixinR->wx_code;
            $data['wx_email'] = $weixinR->wx_email;
            $data['wx_status'] = $weixinR->wx_status;
        }else{
            $data['api_url'] = "";
            $data['api_token'] = "";
            $data['wid'] = "";
            $data['wx_appid'] = "";
            $data['wx_appsecret'] = "";
            $data['wx_name'] = "";
            $data['wx_id'] = "";
            $data['wx_code'] = "";
            $data['wx_email'] = "";
            $data['wx_status'] = 0;
            $data['wx_type'] = "";
        }
        //************end************/
        $data['weixin_regist_url'] = $weixin_regist_url;
        $data['weixin_infohelp_url'] = $weixin_regist_url;
        $data['weixin_appidhelp_url'] = $weixin_regist_url;
        $data['weixin_tokenhelp_url'] = $weixin_regist_url;
        $data['weixin_list_url'] = $weixin_list_url;
        echojson(0,$data);
    }

    //公众号智能编辑
    public function edit(){

        safeFilter();
        $wid = trim($this->input->post('wid'));
        if(trim($wid)=="") echojson(1,'','请正确操作！');
        $res = $this->t_weixin->get($wid);
        $this->config->load('url');
        $config = $this->config->item('url');
        $urls = $_SERVER['HTTP_HOST'].$config['api_url'].$res->service_token;
        if(stripos($urls,'http://') === FALSE)
        $urls = 'http://'.$urls;
       
        if($res){
                    $data['wid'] = $wid;
                $data['wx_type'] = $res->wx_type;
                $data['wx_name'] = $res->wx_name;
               $data['wx_email'] = $res->wx_email;
                  $data['wx_id'] = $res->wx_id;
                $data['wx_code'] = $res->wx_code;
               $data['wx_appid'] = $res->wx_appid;
           $data['wx_appsecret'] = $res->wx_appsecret;
                $data['api_url'] = $urls;
              $data['api_token'] = $res->service_token;
             
            echojson(0,$data);

        }else{
            echojson(1,'','无相关数据');
        }
    }

    //公众号关注回复
    public function follow_reply(){

        safeFilter();
        $url = $this->actionList->weixin_list;
        $service_token = isset($_POST['service_token']) && (strlen_utf8($_POST['service_token'])==32)?$_POST['service_token']:"";
        if($service_token=="") echojson(1,$url,'请您选择公众号，再添加');
        if(!$this->t_weixin->getOne('wid',array('service_token'=>$service_token,'wx_status'=>1)))  echojson(1,$url,'请您选择公众号，再添加');
        $field = "*";
        $where['service_token'] = $service_token;
        $where['rwfr_type'] = 1;
        $data['reply_nav']['0']['text'] = "被添加自动回复";
        $data['reply_nav']['0']['url'] = $this->actionList->follow_reply.$service_token;
        $data['reply_nav']['0']['selected'] = 1;
        $data['reply_nav']['1']['text'] = "消息自动回复";
        $data['reply_nav']['1']['url'] = $this->actionList->msg_reply_list.$service_token;
        $data['reply_nav']['1']['selected'] = 0;
        $data['reply_nav']['2']['text'] = "关键词自动回复";
        $data['reply_nav']['2']['url'] = $this->actionList->text_reply_list.$service_token;
        $data['reply_nav']['2']['selected'] = 0;

        $rowR = $this->t_service_weixin_follow_reply->getOne($field,$where);
        if($rowR){
            $data['rwfr_id'] = $rowR->rwfr_id;
            $data['rwfr_content'] = $rowR->rwfr_content;
            $data['rwfr_type'] = 1;
            $data['service_token'] = $rowR->service_token;
            echojson(0,$data);
        }else{
            $data['rwfr_id'] = '';
            $data['rwfr_content'] = '';
            $data['rwfr_type'] = 1;
            $data['service_token'] = $service_token;
            echojson(0,$data,'无数据，请添加！');
        }
    }

    //消息自动回复
    public function msg_reply_list(){
    
        safeFilter();
        $url = $this->actionList->weixin_list;
        $service_token = isset($_POST['service_token']) && (strlen_utf8($_POST['service_token'])==32)?$_POST['service_token']:"";
        if($service_token=="") echojson(1,$url,'请您选择公众号，再添加');
        if(!$this->t_weixin->getOne('wid',array('service_token'=>$service_token,'wx_status'=>1)))  echojson(1,$url,'请您选择公众号，再添加');
        $field = "*";
        $where['service_token'] = $service_token;
        $where['rwfr_type'] = 2;

        $rowR = $this->t_service_weixin_follow_reply->getOne($field,$where);
        $data['reply_nav']['0']['text'] = "被添加自动回复";
        $data['reply_nav']['0']['url'] = $this->actionList->follow_reply.$service_token;
        $data['reply_nav']['0']['selected'] = 0;
        $data['reply_nav']['1']['text'] = "消息自动回复";
        $data['reply_nav']['1']['url'] = $this->actionList->msg_reply_list.$service_token;
        $data['reply_nav']['1']['selected'] = 1;
        $data['reply_nav']['2']['text'] = "关键词自动回复";
        $data['reply_nav']['2']['url'] = $this->actionList->text_reply_list.$service_token;
        $data['reply_nav']['2']['selected'] = 0;
        if($rowR){
            $data['rwfr_id'] = $rowR->rwfr_id;
            $data['rwfr_content'] = $rowR->rwfr_content;
            $data['rwfr_type'] = 2;
            $data['service_token'] = $rowR->service_token;
            echojson(0,$data);
        }else{
            $data['rwfr_id'] = '';
            $data['rwfr_content'] = '';
            $data['rwfr_type'] = 2;
            $data['service_token'] = $service_token;
            echojson(0,$data,'无数据，请添加！');
        }
    }

    //关键字回复
    public function text_reply_list(){

        safeFilter();
        $url = $this->actionList->weixin_list;
        $service_token = isset($_POST['service_token']) && (strlen_utf8($_POST['service_token'])==32)?$_POST['service_token']:"";
        if($service_token=="") echojson(1,$url,'请您选择公众号，再添加');
        if(!$this->t_weixin->getOne('wid',array('service_token'=>$service_token,'wx_status'=>1)))  echojson(1,$url,'请您选择公众号，再添加');


        $data['reply_nav']['0']['text'] = "被添加自动回复";
        $data['reply_nav']['0']['url'] = $this->actionList->follow_reply.$service_token;
        $data['reply_nav']['0']['selected'] = 0;
        $data['reply_nav']['1']['text'] = "消息自动回复";
        $data['reply_nav']['1']['url'] = $this->actionList->msg_reply_list.$service_token;
        $data['reply_nav']['1']['selected'] = 0;
        $data['reply_nav']['2']['text'] = "关键词自动回复";
        $data['reply_nav']['2']['url'] = $this->actionList->text_reply_list.$service_token;
        $data['reply_nav']['2']['selected'] = 1;
        
        $where['service_token'] = $service_token;
        $where['reply_status'] = 1;

        $resultR = $this->t_service_weixin_reply->getReplyList('*',$where);

        if($resultR){
            foreach ($resultR as $key => $value) {
                $data['reply_text_list'][$key]['reply_id'] = $value->reply_id;
                $data['reply_text_list'][$key]['reply_keyword'] = $value->reply_keyword;
                $data['reply_text_list'][$key]['reply_type'] = $value->reply_type;
                if($value->reply_type == 1){
                    $data['reply_text_list'][$key]['reply_type_mes'] = "文字";
                    $data['reply_text_list'][$key]['reply_top_mes'] = $value->reply_keyword."(文字)";
                    $data['reply_text_list'][$key]['reply_content'] = $value->reply_content;
                }else{
                    $data['reply_text_list'][$key]['reply_type_mes'] = "图文";
                    $data['reply_text_list'][$key]['reply_top_mes'] = $value->reply_keyword."(图文)";
                    $reply_content = explode(',', str_replace('，', ',', $value->reply_content));

                    if($reply_content){
                        foreach ($reply_content as $ke => $va) {
                            $array = array();
                            $whereInO['si_id'] = $va;
                            $whereInO['si_status'] = 1;
                            $infoOneR = $this->information->getOne('*',$whereInO);
                
                            if($infoOneR){
                               $array['si_id'] = $infoOneR->si_id;
                               $array['si_url'] = $infoOneR->si_pic;
                               $array['si_title'] = $infoOneR->si_title;
                               $array['si_pic'] = $infoOneR->si_pic;
                               $array['si_addtime'] = $infoOneR->si_addtime; 
                            }
                           if($array){
                                $data['reply_text_list'][$key]['reply_content'][] = $array;
                           }
                        }
                        if(!isset($data['reply_text_list'][$key]['reply_content'])){
                            $data['reply_text_list'][$key]['reply_content'] = '';
                        }

                    }else{
                        $data['reply_text_list'][$key]['reply_content'] = ''; 
                    }
                    $content = $data['reply_text_list'][$key]['reply_content'];
                    if($content) $data['reply_text_list'][$key]['reply_content_selected'] = implode(',', twotoone_array($content,'si_id')); else $data['reply_text_list'][$key]['reply_content_selected'] = '';
                } 
            }
            echojson('0',$data,'获取数据成功');
        }else{
            $data['reply_text_list'] = '';
            echojson('0',$data,'暂无无数据');
        }
    }


    //文字回复列表页面
    public function text_replylist(){
        safeFilter();
        $this->config->load('url');
        $config = $this->config->item('url');
        $url = $config['weixin_add'];
        $service_token = isset($_SESSION['service_token']) && $_SESSION['service_token']?$_SESSION['service_token']:echojson(1,$url,'您还没有绑定公众账号哦');
        $keywords = trim($this->input->post('keywords'));
        $page = $this->input->post('p');

        $num = is_numeric($this->input->post('num') && $this->input->post('num'))?trim($this->input->post('num')):0;
        if(!is_numeric($page) OR $page < 1 OR !$page)
            $page = 1;

        //总条数
        $total_rows = count($this->t_service_weixin_reply->search_count($keywords,$service_token,1));
        $office =  ($page-1)*($num);

        //结果
        if($office){
            $result = $this->t_service_weixin_reply->search_list($keywords,$service_token,1,$office,$num);
        }else{
            $result = $this->t_service_weixin_reply->search_count($keywords,$service_token,1);
        }

        $array = array();
        $url = $this->getUrl('text_reply_add');
        //每页多少条
        $current_count = count($result);
        if($result){
            foreach ($result as $key => $value) {
                $array['reply_text_list'][$key]['reply_id'] = $value->reply_id;
                $array['reply_text_list'][$key]['reply_keyword'] = $value->reply_keyword;
                $array['reply_text_list'][$key]['reply_desc'] = $value->reply_desc;
                if($value->reply_match_type == 1) 
                    $array['reply_text_list'][$key]['reply_match_type'] = "全字匹配";
                else
                    $array['reply_text_list'][$key]['reply_match_type'] = "模糊匹配";
            }
            $this->config->load('url');
            $config = $this->config->item('url');
            $array['text_reply_add_url'] = $url;
            $array['text_reply_edit_url'] = $config['text_reply_edit_url'];
            $array['count'] = $total_rows;
            $array['current_count'] = $current_count; 
            echojson(0,$array);
        }else{
        
            $array['reply_text_list'] = '';
            $this->config->load('url');
            $config = $this->config->item('url');
            $array['text_reply_add_url'] = $url;
            $array['text_reply_edit_url'] = $config['text_reply_edit_url'];
            echojson(0,$array,'无数据');
        }
    }

    //文字回复添加
    public function text_replyadd(){
        $service_token = isset($_SESSION['service_token']) && $_SESSION['service_token']?$_SESSION['service_token']:echojson(1,'','您还没有绑定公众账号哦');
        $data['reply_id'] = '';
        $data['reply_keyword'] = '';
        $data['reply_match_type'] = '';
        $data['reply_desc'] = '';
        echojson(0,$data);
    }

    //文字回复编辑
    public function text_replyedit(){

        safeFilter();
        isset($_SESSION['service_token']) && $_SESSION['service_token']?$_SESSION['service_token']:echojson(1,'','您还没有绑定公众账号哦');
        $reply_id = trim($this->input->post('reply_id')) && is_numeric($this->input->post('reply_id'))?$this->input->post('reply_id'):echojson(1,'','非法传参');
        $where['reply_id'] = $reply_id;
        $filed = 'reply_id,reply_keyword,reply_match_type,reply_desc';
        if($result = $this->t_service_weixin_reply->getOne($filed,$where)){
            $data['reply_id'] = $result->reply_id;
            $data['reply_keyword'] = $result->reply_keyword;
            $data['reply_match_type'] = $result->reply_match_type;
            $data['reply_desc'] = $result->reply_desc;
            echojson(0,$data);
        }else{
            echojson(1,'','无数据，请添加！');
        }
    }

     //图文回复列表页面
    public function img_replylist(){
        safeFilter();
        $this->config->load('url');
        $config = $this->config->item('url');
        $url = $config['weixin_add'];
        $service_token = isset($_SESSION['service_token']) && $_SESSION['service_token']?$_SESSION['service_token']:echojson(1,$url,'您还没有绑定公众账号哦');
        $keywords = trim($this->input->post('keywords'));
        $page = $this->input->post('p');
        $num = (is_numeric($this->input->post('num')) && $this->input->post('num'))?trim($this->input->post('num')):0;
        if(!is_numeric($page) OR $page < 1 OR !$page)
            $page = 1;

        //总条数
        $total_rows = count($this->t_service_weixin_reply->search_count($keywords,$service_token,2));
        $office =  ($page-1)*($num);

        //结果
        if($office){
            $result = $this->t_service_weixin_reply->search_list($keywords,$service_token,2,$office,$num);
        }else{
            $result = $this->t_service_weixin_reply->search_count($keywords,$service_token,2);
        }

        $array = array();
        $url = $this->getUrl('img_reply_add');
       //每页多少条
        $current_count = count($result);
        if($result){
            foreach ($result as $key => $value) {
            $array['reply_img_list'][$key]['reply_id'] = $value->reply_id;
            $array['reply_img_list'][$key]['reply_keyword'] = $value->reply_keyword;
            $array['reply_img_list'][$key]['reply_desc'] = $value->reply_desc;
            if($value->reply_match_type == 1) 
                $array['reply_img_list'][$key]['reply_match_type'] = "全字匹配";
            else
                $array['reply_img_list'][$key]['reply_match_type'] = "模糊匹配";
            }
            $this->config->load('url');
            $config = $this->config->item('url');
            $array['img_reply_add_url'] = $url;
            $array['img_reply_edit_url'] = $config['img_reply_edit_url'];
            $array['count'] = $total_rows;
            $array['current_count'] = $current_count; 
            echojson(0,$array);
        }else{
            $array['reply_img_list'] = '';
            $this->config->load('url');
            $config = $this->config->item('url');
            $array['img_reply_add_url'] = $url;
            $array['img_reply_edit_url'] = $config['img_reply_edit_url'];
            echojson(0,$array,'无数据');
        }
    }



    //图文回复添加
    public function img_replyadd(){

        isset($_SESSION['service_token']) && $_SESSION['service_token']?$_SESSION['service_token']:echojson(1,'','您还没有绑定公众账号哦');
        $data['reply_id'] = '';
        $data['reply_keyword'] = '';
        $data['reply_match_type'] = '';
        $data['reply_title'] = '';
        $data['reply_desc'] = '';
        $data['reply_top_pic'] = '';
        $data['reply_content'] = '';
        $data['reply_outurl'] = '';
        echojson(0,$data);
    }

    //图文回复编辑
    public function img_replyedit(){

        safeFilter();
        isset($_SESSION['service_token']) && $_SESSION['service_token']?$_SESSION['service_token']:echojson(1,'','您还没有绑定公众账号哦');
        $reply_id = trim($this->input->post('reply_id')) && is_numeric($this->input->post('reply_id'))?$this->input->post('reply_id'):echojson(1,'','非法传参');
        $where['reply_id'] = $reply_id;
        $filed = 'reply_id,reply_keyword,reply_match_type,reply_desc,reply_outurl,reply_content,reply_top_pic,reply_title';
        if($result = $this->t_service_weixin_reply->getOne($filed,$where)){
            $data['reply_id'] = $result->reply_id;
            $data['reply_keyword'] = $result->reply_keyword;
            $data['reply_match_type'] = $result->reply_match_type;
            $data['reply_desc'] = $result->reply_desc;
            $data['reply_title'] = $result->reply_title;
            $data['reply_top_pic'] = $result->reply_top_pic;
            $data['reply_content'] = htmlspecialchars_decode($result->reply_content);
            $data['reply_outurl'] = $result->reply_outurl;
            echojson(0,$data);
        }else{
            echojson(1,'','无相关数据');
        }
    }

    
    //自定义菜单列表页面
    public function diy_menu(){
        loadLib('diyMenu');
        $diyMenu = new DiyMenu();
        $wid = trim($this->input->post('wid'));
        $url = $this->actionList->weixin_add;
        if(trim($wid)=="") echojson(1,$url,'请先添加公众号，正确操作！');
        $res = $this->t_weixin->get($wid);
        $diyMenu->service_token =$res->service_token;
    
        $menuR = $diyMenu->getMenuList();
       
        $menuR['service_token'] = $res->service_token;
        echojson(0,$menuR,'成功');
    }

    

    //保存appid数据接口数据
    public function save_appid(){

        //TODO 先不查是文字还是图文，后期在详细权限
        $this->CheckAccessByKey('weixin_add');
        $this->CheckAccessByKey('diy_menu_list');
        $service_token = isset($_SESSION['service_token']) && $_SESSION['service_token']?$_SESSION['service_token']:echojson(1,'','您还没有绑定公众账号哦');
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,'','服务商为空，非法操作！');

        $field = "wx_appid,wx_appsecret,wid";
        $where['service_token'] = $service_token;
        $where['service_id'] = $service_id;
        $resultR = $this->t_weixin->getOne($field,$where);
        if($resultR){
            $menuRs['wx_appid'] = $resultR->wx_appid;
            $menuRs['wx_appsecret'] = $resultR->wx_appsecret;
            echojson(0,$menuRs);
        }else{
            $menuRs['wx_appid'] = '';
            $menuRs['wx_appsecret'] = '';
            echojson(0,$menuRs);
        }
    }

    //获取url
    public function getUrl($urlFlg){
        $url = $this->actionList->$urlFlg;
        return $url;
    }

    /****************最终版本*************************/

    /**
     *description:diy菜单获取菜单配置列表
     *author:liuguangping
     *date:2014/04/19
     */
    public function diy_menu_config(){

        $array = $this->menu_config_data();
        $data['informationlist'] = $array;
        if($array) echojson(0,$data,'操作成功！'); else echojson(1,'','无相关数据');
    }

    public function menu_config_data(){
        $array = array();
        $result = $this->menu_config->get_all();
        if($result){
           foreach ($result as $key => $value) {
               $array[$key]['c_id'] = $value->c_id;
               $array[$key]['c_name'] = $value->c_name; 
           }
        }else{
            $array = '';
        }

        if($array)  return $array; else return false;
    }

    /**
     *description:自定义菜单待选资讯列表
     *author:liuguangping
     *date:2014/04/19
     */
    public function diy_menu_information_list(){

        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,'','服务商为空，请正确操作！');
        $array = array();
        $where['service_id'] = $service_id;
        $result = $this->information->getList($where['service_id']);
        if($result){
           foreach ($result as $key => $value) {
               $array[$key]['si_id'] = $value->si_id;
               $array[$key]['si_title'] = $value->si_title;
               $array[$key]['si_pic'] = $value->si_pic; 
               $array[$key]['si_addtime'] = $value->si_addtime;
           }
        }else{
            $array = '';
        }
        $data['informationlist'] = $array;
        if($array) echojson(0,$data,'操作成功！'); else echojson(1,'','无相关数据');
    }
}
