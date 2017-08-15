<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description: 公众号管理
 *author:liuguagnping
 *date:2014/04/19
 */
class Weixin extends MY_Controller {
    private $weixin;
    private $t_service_weixin_reply;
    private $menu_diy;
    private $t_service_weixin_follow_reply;
    private $menu_config;
    private $service_token;
    private $sysToken; //系统token
    private $service_infomation;
    private $service_webfalsh;

    function __construct(){
        parent::__construct();
        $this->load->model("t_weixin_model");
        $this->weixin = $this->t_weixin_model;
        $this->load->model("t_service_weixin_reply_model");
        $this->t_service_weixin_reply= $this->t_service_weixin_reply_model;
        $this->load->model("t_service_menu_diy_model");
        $this->menu_diy= $this->t_service_menu_diy_model;
        $this->load->model("t_service_menu_config_model");
        $this->menu_config= $this->t_service_menu_config_model;
        $this->load->helper('import_excel');
        //$this->load->model("t_service_lbs_reply_model");
        $this->load->model('t_service_weixin_follow_reply_model');
        $this->t_service_weixin_follow_reply = $this->t_service_weixin_follow_reply_model;
        $this->load->model("t_service_information_model");
        $this->service_infomation = $this->t_service_information_model;
        $this->load->model("t_service_wap_slide_model");
        $this->service_webfalsh = $this->t_service_wap_slide_model;
        $this->sysToken = "jia178";
        loadLib('ServiceUserAccess');
        $this->actionList = ServiceUserAccessFactory::getActionUrlList();
    }

    /**
     *description:公众号智能绑定
     *author:liuguangping
     *date:2014/04/19
     */
    public function add_auto(){

        safeFilter();
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,'','服务商为空，非法操作！');
        $wx_user = trim($this->input->post('wx_user'));
        $wx_pass = trim($this->input->post('wx_pass'));
        if(trim($wx_user)=="") echojson(1,'','此项为必填');
        if(trim($wx_pass)=="") echojson(1,'','此项为必填');

        //查询该服务商下有没有正常的公众，没有则添加的公众号为默认
        if($this->weixin->getWeixinList($service_id)){
            $this->weixin->wx_is_default = 0; 
        }else{
            $this->weixin->wx_is_default = 1; 
        }

        //判断账号是否唯一
        //$this->isUser($wx_user);

        //TODO 微信公众平台帐号，我用的是公众号名称  申请后我置为4
        $this->weixin->wx_name = $wx_user;
        $this->weixin->wx_pass = $wx_pass;
        $this->weixin->wx_create_time = date('Y-m-d H:i:s');
        $this->weixin->wx_status = 4;
        $url = $this->getUrl('weixin_list');
        if($wid = $this->weixin->insert()){
            //service_token生成
            $data['service_token'] = md5(md5($wid.time()).time());
            $where['wid'] = $wid;
            if($this->weixin->updates_global($data,$where)){
                echojson(0,$url,'操作成功');
            }else{
                echojson(1,$url,'service_token生成失败！');
            }

        }else{
            echojson(1,$url,'操作失败');
        }
    }

    /**
     *description:公众号是否唯一
     *author:liuguangping
     *date:2014/04/19
     */
    public function isUser($user_name){
        safeFilter();
        $wx_user = $user_name;
        $field = 'wid';
        $map['wx_name'] = $wx_user;
        if($this->weixin->getOne($field,$map)){
            echojson(1,'','微信公众平台帐号己存在不能添加，重新输入！');
        }
    }

     /**
     *description:公众号是否唯一
     *author:liuguangping
     *date:2014/04/19
     */
    public function isWx_id($wx_id,$wid){
        safeFilter();
        $wx_id = $wx_id;
        $field = 'wid';
        //$map['wx_id'] = $wx_id;
        $map = "wx_id = '$wx_id' AND wx_status !=99";
        if($result = $this->weixin->getArray($field,$map)){
            if($wid){
                foreach ($result as $key => $value) {
                    if($value->wid != $wid){
                          echojson(1,'','微信公众平台帐号己存在不能添加，重新输入！');
                    }
                 }  
            }else{
                echojson(1,'','微信公众平台帐号己存在不能添加，重新输入！');
            }
        }
    }

    /**
     *description:公众号普通添加
     *author:liuguangping
     *date:2014/04/19
     */
    public function add(){

        safeFilter();
        loadLib("WeixinUserFormCheck");
        WeixinUserFormCheck::createObj('add');
        //服务商
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,'','服务商为空，非法操作！');
        $wid = $this->input->post('wid',true);
        $wid = isset($wid) && $wid?$wid:"";

        $this->weixin->wx_type = trim($this->input->post('wx_type'));
        $this->weixin->wx_name = trim($this->input->post('wx_name'));
        $this->weixin->wx_email = trim($this->input->post('wx_email'));
        $this->weixin->wx_id = trim($this->input->post('wx_id'));
        $this->weixin->wx_code = trim($this->input->post('wx_code'));
        /* $this->weixin->wx_province = trim($this->input->post('wx_province'));
        $this->weixin->wx_city = trim($this->input->post('wx_city'));*/
        $this->weixin->wx_create_time = date('Y-m-d H:i:s');
        $this->weixin->wx_end_time = date('Y-m-d H:i:s',time()+3600*24*365);
        $this->weixin->wx_appid = trim($this->input->post('wx_appid'));
        $this->weixin->service_id = $service_id;
        $this->weixin->wx_rand = "";
        $this->weixin->wx_pass = '';
        $this->weixin->wx_appsecret = trim($this->input->post('wx_appsecret'));
        $this->weixin->wx_status = 0;//验证成功为1

        //判断账号是否唯一
        $this->isWx_id($this->weixin->wx_id,$wid);
        //TODO这个这次迭代不做，下次改成weixin_list
        //$url = $this->getUrl('weixin_list');
        $url = $this->actionList->weixin_add;
        $data['api_url'] = '';
        $data['api_token'] = '';
        $data['wid'] = '';
        $data['weixin_list_url'] = $url;
        /*********TODO这个这次迭代做*******/
       
        if($wid){
            //编辑
            $this->weixin->service_token = md5(md5($wid.time()).time());
            $this->weixin->wid = $wid;
            if($this->weixin->update()){
                $data['weixin_list_url'] = $this->actionList->weixin_add;
                $urls = $_SERVER['HTTP_HOST'].$this->actionList->api_url.$this->weixin->service_token;
                if(stripos($urls,'http://') === FALSE)
                $urls = 'http://'.$urls;  
                $data['api_url'] = $urls;
                $data['api_token'] = $this->weixin->service_token;
                $data['wid'] = $wid;
                $data['wx_type'] = $this->weixin->wx_type;
                //TODO这个这次迭代不做，下次改成weixin_list
                $data['weixin_list_url'] = $this->actionList->weixin_list;
                
                echojson(0,$data,'操作成功');
            }else{
               echojson(1,$data,'操作失败'); 
            }

        }else{
            //添加
           if($wid = $this->weixin->insert()){
                $datas['service_token'] = md5(md5($wid.time()).time());
                $wheres['wid'] = $wid;
                if($this->weixin->updates_global($datas,$wheres)){
                    $urls = $_SERVER['HTTP_HOST'].$this->actionList->api_url.$datas['service_token'];
                    if(stripos($urls,'http://') === FALSE)
                    $urls = 'http://'.$urls;  
                    $data['api_url'] = $urls;
                    $data['api_token'] = $datas['service_token'];
                    $data['wid'] = $wid;
                    //TODO这个这次迭代不做，下次改成weixin_list
                    //$data['weixin_list_url'] = $config['weixin_list'];
                    $data['weixin_list_url'] = $this->actionList->weixin_list;
                   
              
                    echojson(0,$data,'操作成功');
                }else{
                    echojson(1,$data,'service_token生成失败！');
                }
            }else{
                echojson(1,$data,'操作失败');
            }

        }
       
    }

    /*******临时用的公众号编辑*******/
    public function add_edit(){
        //如果是服务号则修改邮箱和AppID，AppSecret在生成一次菜单，服务号则只能改邮箱
        safeFilter();
        $this->CheckAccessByKey('weixin_add');
        loadLib("WeixinUserFormCheck");
        WeixinUserFormCheck::createObj('edit');
        $wid = $this->input->post('wid',true);
        $weixinR = $this->weixin->get($wid);
        $data['wx_email'] = trim($this->input->post('wx_email',true));
        if($weixinR->wx_type == 1){
            $data['wx_appid'] = trim($this->input->post('wx_appid',true));
            $data['wx_appsecret'] = trim($this->input->post('wx_appsecret',true));
        }
        $map['wid'] = $wid;

        $url = $this->getUrl('weixin_list');
        if($this->weixin->updates_global($data,$map)){
            if($weixinR->wx_type == 1){
                loadLib('WechatMenu');
                $weixinObj = new WechatMenu($weixinR->service_token);
                $weixinObj->createMenu();
                //if($this->defalutMenu($weixinR->service_token)){
                    echojson(0,$url,'操作成功');
                //}else{
                   // echojson(1,$url,'菜单生成失败！');
                //}
            }else{
               echojson(0,$url,'操作成功'); 
            }
        }else{
            echojson(1,$url,'操作失败');
        }
    }
    /************end********/

    /**
     *description:公众号创建成功
     *author:liuguangping
     *date:2014/04/19
     */
    public function addInformation(){
       //服务商
        $config = C('wap_template','wap_welcome');
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,'','服务商为空，非法操作！');
        $this->service_infomation->si_title = $config['si_title'];
        $this->service_infomation->si_content = $config['si_content'];
        $this->service_infomation->service_id = $service_id;
        $this->service_infomation->si_addtime = date("Y-m-d H:i:s");
        $this->service_infomation->si_status = 1;
        $this->service_infomation->it_id = 1;
        $this->service_infomation->si_author = "系统";
        $pic_url = $_SERVER['HTTP_HOST'].$config['si_pic'];
        if(stripos($pic_url,"http://") === false) $pic_url = "http://".$pic_url;
        $this->service_infomation->si_pic = $pic_url;
        $this->service_infomation->si_likes = 0;
        $this->service_infomation->si_views = 0;
        $this->service_infomation->si_wap_isshow = 1;
        $this->service_infomation->si_keyword = $config['si_keyword'];
        $this->service_infomation->si_desc = $config['si_desc'];
        if($this->service_infomation->insert()){
            return true;
        }else{
            return false;
        }
    }

     /**
     *description:公众号创建web falsh
     *author:liuguangping
     *date:2014/04/19
     */
    public function addWebFash(){
       //服务商
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,'','服务商为空，非法操作！');
        $where['service_id'] = $service_id;
        $where['slide_default'] = 1;
        if(!$this->service_webfalsh->getArray('slide_id',$where)){
            $config = C('wap_template','wap_slide');
            $query1 = "INSERT INTO t_service_wap_slide (slide_title,slide_pic,slide_url,service_id,slide_type,slide_default) VALUES ('".$config['title_1']."','".$config['slide_1']."','#',{$service_id},'1','1');";
            $query2 = "INSERT INTO t_service_wap_slide (slide_title,slide_pic,slide_url,service_id,slide_type,slide_default) VALUES ('".$config['title_2']."','".$config['slide_2']."','#',{$service_id},'1','1');";
            $query3 = "INSERT INTO t_service_wap_slide (slide_title,slide_pic,slide_url,service_id,slide_type,slide_default) VALUES ('".$config['title_3']."','".$config['slide_3']."','#',{$service_id},'1','1');";
        
            if($this->service_webfalsh->query($query1) && $this->service_webfalsh->query($query2) && $this->service_webfalsh->query($query3)){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

     /**
     *description:公众号创建默认菜单
     *author:liuguangping
     *date:2014/04/19
     */

     public function defalutMenu($service_token){
            $flg = false;
            $isExists = $this->menu_diy->getOne('*',array('service_token'=>$service_token)); 
            if(!$isExists){
                $config = C('weixin_default','weixin_menu');
                $query1 = "INSERT INTO t_service_menu_diy (smd_pid,smd_name,smd_sort,service_token,smd_type,smd_content) VALUES (0,'".$config['smd_name_1']."',1,'{$service_token}',{$config['smd_type_1']},{$config['smd_content_1']});";
                $query2 = "INSERT INTO t_service_menu_diy (smd_pid,smd_name,smd_sort,service_token,smd_type,smd_content) VALUES (0,'".$config['smd_name_2']."',2,'{$service_token}',{$config['smd_type_2']},{$config['smd_content_2']});";
                $query3 = "INSERT INTO t_service_menu_diy (smd_pid,smd_name,smd_sort,service_token,smd_type,smd_content) VALUES (0,'".$config['smd_name_3']."',3,'{$service_token}',{$config['smd_type_3']},{$config['smd_content_3']});";
            
                if($this->menu_diy->query($query1) && $this->menu_diy->query($query2) && $this->menu_diy->query($query3)){
                    $flg = true;
                }else{
                    $flg = false;
                }

            }else{
               $flg = true; 
            }
           
            return $flg;
     }

     /**
     *description:公众号测试绑定
     *author:liuguangping
     *date:2014/04/19
     */
    public function auth(){

        safeFilter();
        $this->CheckAccessByKey('weixin_add');
        //自增id主键
        //TODO这个这次迭代不做，下次改成weixin_list
        $url = $this->actionList->weixin_list;
        $wid = trim($this->input->post('wid'))?trim($this->input->post('wid')):echojson(1,'','非法操作！');
        $wx_rand = trim($this->input->post('wx_rand'));
        $weixinR = $this->weixin->get($wid);
        if($weixinR->wx_rand == $wx_rand){
            $data['wx_status'] = 1;
            $where['wid'] = $wid;
            if($this->weixin->updates_global($data,$where)){
                //成功后添加生成web菜单资讯web falsh
                if($weixinR->wx_type == 1){
                    if($this->defalutMenu($weixinR->service_token)){
                        $this->addInformation();
                        $this->addWebFash();
                    }
                }
                echojson(0,$url,'操作成功');
            }else{
                echojson(1,$url,'操作失败');
            }
           
        }else{
            echojson(1,$url,'操作失败');
        }
  
    }

    /**
     *description:公众号普通编辑
     *author:liuguangping
     *date:2014/04/19
     */
    public function edit(){

        safeFilter();
        loadLib("WeixinUserFormCheck");
        WeixinUserFormCheck::createObj('edit');

        $wid = trim($this->input->post('wid'));
        $data['wx_type'] = trim($this->input->post('wx_type'));
        $data['wx_name'] = trim($this->input->post('wx_name'));
        $data['wx_email'] = trim($this->input->post('wx_email'));
        $data['wx_id'] = trim($this->input->post('wx_id'));
        $data['wx_code'] = trim($this->input->post('wx_code'));
        if($data['wx_type'] == 1){
            $data['wx_appid'] = trim($this->input->post('wx_appid'));
            $data['wx_appsecret'] = trim($this->input->post('wx_appsecret'));
        } 
        $map['wid'] = $wid;

        $url = $this->getUrl('weixin_list');
        if($this->weixin->updates_global($data,$map)){
            echojson(0,$url,'操作成功');
        }else{
            echojson(1,$url,'操作失败');
        }
    }

    /**
     *description:公众号普通删除
     *author:liuguangping
     *date:2014/04/19
     */
    public function del(){

        safeFilter();
        $this->CheckAccessByKey('weixin_add');
        $wid = trim($this->input->post('wid'))?trim($this->input->post('wid')):echojson(1,'','微信id为空，非法操作！');
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,'','服务商为空，非法操作！');
       
        $data['wx_status'] = 99;
        $where['wid'] = $wid;

        $url = $this->getUrl('weixin_list');
        if($this->weixin->updates_global($data,$where)){
            echojson(0,$url,'操作成功'); 
        }else{
            echojson(1,$url,'操作失败');
        }
    }

    /**
     *description:公众号设为默认
     *author:liuguangping
     *date:2014/04/19
     */
    public function set_default(){

        safeFilter();
        $this->CheckAccessByKey('weixin_add');
        $wid = trim($this->input->post('wid'))?trim($this->input->post('wid')):echojson(1,'','微信id为空，非法操作！');
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,'','服务商为空，非法操作！');

        //首先把这个经销商的公众号公众号设为默认字段设为0然后在把提交过来的改为1
        $serWidW['service_id'] = $service_id;

        $result = $this->weixin->getArray('wid',$serWidW);
        $widR = twotoone_array($result,'wid');
        $widS = implode(',', $widR);
        $weiXinData['wx_is_default'] = 0;
        $weiXinW = "wid in ( ".$widS. ")";

        $url = $this->getUrl('weixin_list');
        if($this->weixin->updates_global($weiXinData,$weiXinW)){
            $data['wx_is_default'] = 1;
            $where['wid'] = $wid;
            if($this->weixin->updates_global($data,$where)){
                echojson(0,$url,'操作成功');
            }else{
                echojson(1,$url,'操作失败');
            }
        }else{
            echojson(1,$url,'操作失败');
        }
    }

    /**
     *description:当前公众号切换(修改session中的service_token值并刷新页面即可)
     *author:liuguangping
     *date:2014/04/21
     */
    public function change(){
        
        $this->CheckAccessByKey('weixin_add');
        safeFilter();
        $service_token = isset($_POST['service_token']) && $_POST['service_token']?trim($_POST['service_token']):echojson(1,'','非法操作！');
        $wx_name = isset($_POST['wx_name']) && $_POST['wx_name']?trim($_POST['wx_name']):echojson(1,'','非法操作！');
        $_SESSION['service_token'] =  $service_token;
        $_SESSION['wx_name'] =  $wx_name;
        echojson(0,'','操作成功');
           
    }

    /**
     *description:公众号关注回复 和自动回复
     *author:liuguangping
     *date:2014/04/21
     */
    public function follow_mes_reply(){

        safeFilter();
        //service_token 
        $weixin_list_url = $this->actionList->weixin_list;
        $service_token = isset($_POST['service_token']) && $_POST['service_token'] && (strlen_utf8($_POST['service_token'])==32)?$_POST['service_token']:echojson(1,$url,'您还没有选择公众账号哦');
        if(!$this->weixin->getOne('wid',array('service_token'=>$service_token,'wx_status'=>1)))  echojson(1,$weixin_list_url,'请您正确选择公众号，再添加');
        $reply_url = $this->actionList->follow_reply.$service_token;
        $rwfr_id = trim($this->input->post('rwfr_id'))?trim($this->input->post('rwfr_id')):'';
        $rwfr_content = isset($_POST['rwfr_content']) && $_POST['rwfr_content']?$_POST['rwfr_content']:"";
        $rwfr_type = isset($_POST['rwfr_type']) && $_POST['rwfr_type']?$_POST['rwfr_type']:"";

        if($rwfr_type=="") echojson(1, $reply_url ,'请您先选择回复类型');
        if($rwfr_type == 2)  $reply_url = $this->actionList->msg_reply_list;
        if(stringLen_utf8($rwfr_content)<1 || stringLen_utf8($rwfr_content)>160) echojson(1,$reply_url,"文字必须为1到600个字");

        $where['rwfr_type'] = $rwfr_type;
        $where['service_token'] = $service_token;
        $rowR = $this->t_service_weixin_follow_reply->getOne('*',$where);
        $datas['reply_url'] = $reply_url;
        if($rowR){
            //编辑
            $data['rwfr_content'] = $rwfr_content;
            $datas['rwfr_id'] = $rwfr_id;
            
            if($this->t_service_weixin_follow_reply->updates_global($data,$where)){

                echojson(0,$datas,'修改成功');
            }else{
                echojson(1,$datas,'修改失败');
            } 
        }else{
            //添加
            $this->t_service_weixin_follow_reply->rwfr_content = $rwfr_content;
            $this->t_service_weixin_follow_reply->service_token = $service_token;
            $this->t_service_weixin_follow_reply->rwfr_type = $rwfr_type;
            if($insert_id = $this->t_service_weixin_follow_reply->insert()){
                $datas['rwfr_id'] = $insert_id;
                echojson(0,$datas,'修改成功');
            }else{
                $datas['rwfr_id'] = '';
                echojson(1,$datas,'修改失败');
            }
        }
    }

     /**
     *description:公众号关注回复 和自动回复删除
     *author:liuguangping
     *date:2014/06/12
     */
    public function follow_mes_del(){
        $rwfr_id = isset($_POST['rwfr_id']) && $_POST['rwfr_id']?$_POST['rwfr_id']:"";
        if($rwfr_id){
            if($this->t_service_weixin_follow_reply->delete($rwfr_id)){
                echojson(0,'','删除成功');
            }else{
                echojson(1,'','删除失败');
            }
        }else{
            echojson(1,'','非法操作');
        }
    }

    /**
     *description:公众号添加文字图文回复提交
     *author:liuguangping
     *date:2014/04/21
     */
    public function text_imageadd(){
      
        safeFilter();
        $url = $this->actionList->weixin_list;
        //添加关键字时图文和文字判断唯一 这里只能添加一个关键字不能分隔
        $service_token = isset($_POST['service_token']) && $_POST['service_token'] && (strlen_utf8($_POST['service_token'])==32)?$_POST['service_token']:echojson(1,$url,'您还没有选择公众账号哦');
        if(!$this->weixin->getOne('wid',array('service_token'=>$service_token,'wx_status'=>1)))  echojson(1,$url,'请您正确选择公众号，再添加');
        $reply_keyword = trim($this->input->post('reply_keyword'));
        $reply_content = trim($this->input->post('reply_content'));
        $reply_type  = trim($this->input->post('reply_type'));
        $reply_id = isset($_POST['reply_id']) && $_POST['reply_id']?$_POST['reply_id']:"";

        if($reply_keyword) {
            if(strlen_utf8($reply_keyword)>30) echojson(1,"","关键字必须为1到30个字");
        }else{
            echojson(1,"","关键字不能为空");
        }
        
        if(!$reply_content) echojson(1,"","内容必须不能为空");
        if($reply_type == 1){
            if($reply_content){
                if(strlen_utf8($reply_keyword)>300) echojson(1,"","内容必须为1到300个字");
            }
        }else{
             if($reply_content){
                $explode = explode(',', str_replace('，', ',', $reply_content));
                if(count($explode)>10) echojson(1,"","资讯不能超过10条");
            }
        }

        if(!$this->isReply_keyword($reply_keyword,$service_token,$reply_id)) echojson(1,"","请输入关键字己存在，不能重复");
        $this->t_service_weixin_reply->reply_keyword = $reply_keyword;
        $this->t_service_weixin_reply->reply_content = $reply_content;
        $this->t_service_weixin_reply->reply_type = $reply_type;
        $this->t_service_weixin_reply->reply_status = 1;
        $this->t_service_weixin_reply->service_token = $service_token;
        $url = $this->getUrl('text_reply_list');
        if($reply_id){
            $datas['reply_keyword'] = $reply_keyword;
            $datas['reply_type'] = $reply_type;
            $datas['reply_content'] = $reply_content;
            $map['reply_id'] = $reply_id;
            $data['url'] = $url;
            $data['reply_keyword'] = $reply_keyword;
            $data['reply_id'] = $reply_id;
            $data['reply_type'] = $reply_type;
            $data['service_token'] = $service_token;
            $data['reply_content'] = $reply_content;
            if($this->t_service_weixin_reply->updates_global($datas,$map)) echojson(0,$data,'修改成功'); else echojson(1,$data,'修改失败');
        }else{
            if($insert_id = $this->t_service_weixin_reply->insert()){
                $data['url'] = $url;
                $data['reply_id'] = $insert_id ;
                $data['reply_keyword'] = $reply_keyword;
                $data['reply_type'] = $reply_type;
                $data['service_token'] = $service_token;
                if($reply_type == 1){
                    $data['reply_content'] = $reply_content;
                    $data['reply_type_mes'] = "文字";
                    $data['reply_top_mes'] = $reply_keyword."(文字)";
                }else{

                    $reply_content = explode(',', str_replace('，', ',', $reply_content));

                    $content = $this->informationInfo($reply_content);
                    $data['reply_content'] = $content;

                    $data['reply_type_mes'] = "图文";
                    $data['reply_top_mes'] = $reply_keyword."(图文)";
                } 
                echojson(0,$data,'添加成功');
            }else{
                $data['url'] = $url;
                $data['reply_id'] = '' ;
                $data['reply_keyword'] = '';
                $data['reply_type'] = '';
                $data['service_token'] = $service_token;
                $data['reply_type_mes'] = '';
                $data['reply_top_mes'] = '';
                $data['reply_content'] = '';
                echojson(1,$data,'添加失败');
            }
        }
       
    }

    /**
     *description:资讯选中后返回的数据接口
     *author:liuguangping
     *date:2014/06/13
     */
    public function information_selected_list(){
        safeFilter();
        $reply_content = trim($this->input->post('reply_content'))?$this->input->post('reply_content'):echojson(1,"","内容必须不能为空");
        $reply_type = trim($this->input->post('reply_type'))?$this->input->post('reply_type'):echojson(1,"","类型必须不能为空");;
        
        if($reply_type == 2){
            $reply_content = explode(',', str_replace('，', ',', $reply_content));
            if(count($reply_content)>10) echojson(1,"","资讯不能超过10条");
            $content = $this->informationInfo($reply_content);
        }else{
            $content = $reply_content;
        }

        $data['reply_content'] = $content;
        $data['reply_type'] = $reply_type;
        if($content) $data['reply_selected'] = implode(',', twotoone_array($content,'si_id')); else $data['reply_selected'] = '';
        echojson(0,$data,'操作成功');
    }

     /**
     *description:返回资讯数据
     *author:liuguangping
     *date:2014/06/13
     */
    public function informationInfo($reply_content){
        $array = array();
        if($reply_content){
            foreach ($reply_content as $ke => $va) {
                $reply_array = array();
                $whereInO['si_id'] = $va;
                $whereInO['si_status'] = 1;
                $infoOneR = $this->service_infomation->getOne('*',$whereInO);
                 //var_dump($infoOneR);die;
                if($infoOneR){
                   $reply_array['si_id'] = $infoOneR->si_id;
                   $reply_array['si_url'] = $infoOneR->si_pic;
                   $reply_array['si_title'] = $infoOneR->si_title;
                   $reply_array['si_pic'] = $infoOneR->si_pic;
                   $reply_array['si_addtime'] = $infoOneR->si_addtime; 
                }
                if($reply_array){
                    $array[] = $reply_array; 
                }
            }
            if(empty($array)){
                $array = '';
            }

        }else{
            $array = ''; 
        }
        return $array;
    }
    /**
     *description:公众号添加文字回复提交
     *author:liuguangping
     *date:2014/04/21
     */
    public function text_replyadd(){
         safeFilter();
        $url = $this->actionList->weixin_add;
        //添加关键字时图文和文字判断唯一 这里只能添加一个关键字不能分隔
        $service_token = isset($_SESSION['service_token']) && $_SESSION['service_token']?$_SESSION['service_token']:echojson(1,$url,'您还没有绑定公众账号哦');
        $reply_keyword = trim($this->input->post('reply_keyword'));
        $reply_match_type  = trim($this->input->post('reply_match_type'));
        $reply_desc = trim($this->input->post('reply_desc'));
        if(strlen_utf8($reply_desc)>1000) echojson(1,"","请输入不超过1000个字的回复描述");
        if(!$this->isReply_keyword($reply_keyword,$service_token,'')) echojson(1,"","请输入关键字己存在，不能重复");
        $this->t_service_weixin_reply->reply_keyword = $reply_keyword;
        $this->t_service_weixin_reply->reply_match_type = $reply_match_type;
        $this->t_service_weixin_reply->reply_desc = $reply_desc;
        $this->t_service_weixin_reply->reply_type = 1;
        $this->t_service_weixin_reply->reply_status = 1;
        $this->t_service_weixin_reply->service_token = $service_token;
        $url = $this->getUrl('text_reply_list');
        if($this->t_service_weixin_reply->insert()){
            echojson(0,$url,'操作成功');
        }else{
            echojson(1,$url,'操作失败');
        }
    }

    /**
     *description:公众号编辑文字回复页面数据
     *author:liuguangping
     *date:2014/04/21
     */
    public function text_replyedit(){

        safeFilter();

        //添加关键字时图文和文字判断唯一 这里只能添加一个关键字不能分隔
        $service_token = isset($_SESSION['service_token']) && $_SESSION['service_token']?$_SESSION['service_token']:echojson(1,'','服务商token为空，非法操作！');
        $reply_id = trim($this->input->post('reply_id'))?trim($this->input->post('reply_id')):echojson(1,'','非法操作！');
        $reply_keyword = trim($this->input->post('reply_keyword'));
        $reply_match_type  = trim($this->input->post('reply_match_type'));
        $reply_desc = trim($this->input->post('reply_desc'));
        
        if(strlen_utf8($reply_desc)>1000) echojson(1,"","请输入不超过1000个字的回复描述");
        if(!$this->isReply_keyword($reply_keyword,$service_token,$reply_id)) echojson(1,"","请输入关键字己存在，不能重复");
    
        $data['reply_keyword'] = $reply_keyword;
        $data['reply_match_type'] = $reply_match_type;
        $data['reply_desc'] = $reply_desc;
        $where['reply_id'] = $reply_id;

        $url = $this->getUrl('text_reply_list');
        if($this->t_service_weixin_reply->updates_global($data,$where)){
            echojson(0,$url,'操作成功');
        }else{
            echojson(1,$url,'操作失败');
        }
    }

    /**
     *description:删除文字，图文回复提交
     *author:liuguangping
     *date:2014/04/19
     */
    public function reply_text_img_del(){
  
        safeFilter();

        //TODO 先不查是文字还是图文，后期在详细权限
        $this->CheckAccessByKey('text_reply_edit');
        $reply_id = trim($this->input->post('reply_id'))?trim($this->input->post('reply_id')):echojson(1,'','关键回复id为空，非法操作！');
        //判断是否是默认状态，默认状态 不能删除
    
        $data['reply_status'] = 99;
        $where['reply_id'] = $reply_id;

        $url = $this->getUrl('text_reply_list');
        if($this->t_service_weixin_reply->updates_global($data,$where)){
            echojson(0,$url,'操作成功');
        }else{
            echojson(1,$url,'操作失败');
        }
    }

     /**
     *description:公众号添加图文回复提交
     *author:liuguangping
     *date:2014/04/21
     */
    public function img_replyadd(){

        safeFilter();
        loadLib("WeixinImgReplyFormCheck");
        WeixinImgReplyFormCheck::createObj('add');

        //添加关键字时图文和文字判断唯一 这里只能添加一个关键字不能分隔
        $service_token = isset($_SESSION['service_token']) && $_SESSION['service_token']?$_SESSION['service_token']:echojson(1,'','服务商token为空，非法操作！');
        $reply_keyword = trim($this->input->post('reply_keyword'));
        $reply_match_type  = trim($this->input->post('reply_match_type'));
        $reply_desc = trim($this->input->post('reply_desc'));
        $reply_title = trim($this->input->post('reply_title'));
        $reply_top_pic  = trim($this->input->post('reply_top_pic'));
        $reply_content = trim($this->input->post('reply_content'));
        $reply_outurl = trim($this->input->post('reply_outurl'));

        if(!$this->isReply_keyword($reply_keyword,$service_token,'')) echojson(1,"","请输入关键字己存在，不能重复");
       
        $this->t_service_weixin_reply->reply_keyword = $reply_keyword;
        $this->t_service_weixin_reply->reply_match_type = $reply_match_type;
        $this->t_service_weixin_reply->reply_desc = $reply_desc;
        $this->t_service_weixin_reply->reply_title = $reply_title;
        $this->t_service_weixin_reply->reply_top_pic = $reply_top_pic;
        $this->t_service_weixin_reply->reply_content = htmlspecialchars($reply_content);
        $this->t_service_weixin_reply->reply_outurl = $reply_outurl;
        $this->t_service_weixin_reply->reply_type = 2;
        $this->t_service_weixin_reply->reply_status = 1;
        $this->t_service_weixin_reply->service_token = $service_token;

        $url = $this->getUrl('img_reply_list');
        if($this->t_service_weixin_reply->insert()){
            echojson(0,$url,'操作成功');
        }else{
            echojson(1,$url,'操作失败');
        }
    }

    /**
     *description:公众号编辑文字回复页面数据
     *author:liuguangping
     *date:2014/04/21
     */
    public function img_replyedit(){
 
        safeFilter();
        loadLib("WeixinImgReplyFormCheck");
        WeixinImgReplyFormCheck::createObj('edit');

        $reply_id = trim($this->input->post('reply_id'));
        //添加关键字时图文和文字判断唯一 这里只能添加一个关键字不能分隔
        $service_token = isset($_SESSION['service_token']) && $_SESSION['service_token']?$_SESSION['service_token']:echojson(1,'','服务商token为空，非法操作！');
        $reply_keyword = trim($this->input->post('reply_keyword'));
        $reply_match_type  = trim($this->input->post('reply_match_type'));
        $reply_desc = trim($this->input->post('reply_desc'));
        $reply_title = trim($this->input->post('reply_title'));
        $reply_top_pic  = trim($this->input->post('reply_top_pic'));
        $reply_content = trim($this->input->post('reply_content'));
        $reply_outurl = trim($this->input->post('reply_outurl'));

        if(!$this->isReply_keyword($reply_keyword,$service_token,$reply_id)) echojson(1,"","关键字己存在，不能重复");
       
        $data['reply_keyword'] = $reply_keyword;
        $data['reply_match_type'] = $reply_match_type;
        $data['reply_desc'] = $reply_desc;
        $data['reply_title'] = $reply_title;
        $data['reply_top_pic'] = $reply_top_pic;
        $data['reply_content'] = htmlspecialchars($reply_content);
        $data['reply_outurl'] = $reply_outurl;
        $map['reply_id'] = $reply_id;

        $resultRow = $this->t_service_weixin_reply->getOne('reply_top_pic',array('reply_id'=>$reply_id));
        if($resultRow){
            $oldReply_top_pic = $resultRow->reply_top_pic;
        }
        
        $url = $this->getUrl('img_reply_list');
        if($this->t_service_weixin_reply->updates_global($data,$map)){
            //TODO图片的删除地址不怎么清楚，下次改动在改；
            if(stripos($oldReply_top_pic,'http://'))
                $oldReply_top_pic = "http://".$oldReply_top_pic;
            @unlink($oldReply_top_pic);
            echojson(0,$url,'操作成功');
        }else{
            echojson(1,$url,'操作失败');
        }
    }

    /**
     *description:保存appid
     *author:liuguangping
     *date:2014/04/19
     */
    public function save_appid(){

        safeFilter();
    
        //TODO 先不查是文字还是图文，后期在详细权限
        //$this->CheckAccessByKey('weixin_add');
        //$this->CheckAccessByKey('diy_menu_list');
        $service_token = isset($_SESSION['service_token']) && $_SESSION['service_token']?$_SESSION['service_token']:echojson(1,'','服务商token为空，非法操作！');
        $service_id = isset($_SESSION['service_id'])?$_SESSION['service_id']:echojson(1,'','服务商为空，非法操作！');
        $wx_appid = isset($_POST['wx_appid'])?trim($this->input->post('wx_appid')):echojson(1,'','微信APPID不能为空，非法操作！');
        $wx_appsecret = isset($_POST['wx_appsecret'])?trim($this->input->post('wx_appsecret')):echojson(1,'','微信appsecret不能为空，非法操作！');

        //判断是否有没有，有修改没有提示
        $field = "wx_appid,wx_appsecret,wid";
        $where['service_token'] = $service_token;
        $where['service_id'] = $service_id;
        $resultR = $this->weixin->getOne($field,$where);
        $url = $this->getUrl('diy_menu_list');
        if($resultR){
            $data['wx_appid'] = $wx_appid;
            $data['wx_appsecret'] = $wx_appsecret;
            $map['wid'] = $resultR->wid;
            if($this->weixin->updates_global($data,$map)){
                echojson(0,$url,'操作成功');
            }else{
                echojson(1,$url,'操作失败');
            } 
        }else{
            $url = $this->getUrl('weixin_add');
            echojson(1,$url,'请先添加公众号，在添加数据！');
        }
    }
    
   /**
     *description:判断关键字是否唯一
     *author:liuguangping
     *date:2014/04/21
     */
    public function isReply_keyword($reply_keyword,$service_token,$reply_id){
        $where['reply_keyword'] = $reply_keyword;
        $where['service_token'] = $service_token;
        $result = $this->t_service_weixin_reply->getArray('reply_id',$where);
        if($reply_id){
            foreach ($result as $key => $value) {
                if($value->reply_id != $reply_id) 
                    return false;
            }
            return true;
        }else{
            if($result){
                return false;
            }else{
                return true;
            }  
        }
        
    }

    /**
     *description:获取url
     *author:liuguangping
     *date:2014/04/21
     */
    public function getUrl($urlFlg){
        return $this->actionList->$urlFlg;
    }
 
    /**
     *description:检查同级下菜单唯一
     *author:liuguangping
     *date:2014/04/21
     */
    public function isSnameCheck($smd_pid,$smd_name,$service_token,$smd_id){
        $where['smd_pid'] = $smd_pid;
        $where['smd_name'] = $smd_name;
        $where['service_token'] = $service_token;
        $result = $this->menu_diy->getArray('smd_id',$where);
        if($smd_id){
            foreach ($result as $key => $value) {
                if($value->smd_id != $smd_id) 
                    return false;
            }
            return true;
        }else{
            if($result){
                return false;
            }else{
                return true;
            }  
        }
        
    }

    //获取菜单
    public function getMenuList(){

        $filed = '*';
        $service_token = isset($_SESSION['service_token']) && $_SESSION['service_token']?$_SESSION['service_token']:echojson(1,'','服务商token为空，非法操作！');
        //$service_token = 'liuguangping';
        $where['smd_pid'] = 0;
        //$where['smd_is_show'] = 1;
        $where['smd_status'] = 1;
        $where['service_token'] = $service_token;
        $menuR = $this->menu_diy->getMenuInfo($filed,$where,'smd_sort','ASC','');
        $list = array();
        if($menuR){
            foreach ($menuR as $keys => $values) {
                $list['menu_list'][$keys]['smd_id'] = $values->smd_id;
                $list['menu_list'][$keys]['smd_name'] = $values->smd_name;
                $where['smd_pid'] = $values->smd_id;
                $order_field='smd_sort';
                $order_type='ASC';
                $limit = '';
                $menuChildR = $this->menu_diy->getMenuInfo($filed,$where,$order_field,$order_type,$limit);

                if($menuChildR){
                    foreach ($menuChildR as $key => $value) {
                         $list['menu_list'][$keys]['smd_son_list'][$key]['son_smd_id'] = $value->smd_id;
                         $list['menu_list'][$keys]['smd_son_list'][$key]['son_smd_name'] = $value->smd_name;
                    }
                }else{
                  $list['menu_list'][$keys]['smd_son_list'] = '';
                }
            }
            return $list;
        }else{
            return false;
        }
    }

    /******************************后续所加****************************/

     /**
     *description:添加菜单提交
     *author:liuguangping
     *date:2014/04/19
     */
    public function diy_menu_add(){

        safeFilter();
        loadLib("diyMenuFormCheck");    
        diyMenuFormCheck::createObj('add');


        //TODO 先不查是文字还是图文，后期在详细权限
        //$this->CheckAccessByKey('diy_menu_list');
        $service_token = $this->input->post("service_token");
        $service_token = isset($service_token) && $service_token?$service_token:echojson(1,'','服务商token为空，非法操作！');
        $smd_pid = $this->input->post('smd_pid',true);
        $smd_name = $this->input->post('smd_name',true);

        if($smd_pid){
            //判断名称是否唯一
            if(intval($this->menu_count($smd_pid,$service_token))>=5) echojson(1,'','二级菜单最多只能五个'); 
            if(!$this->isSnameCheck($smd_pid,$smd_name,$service_token,'')) echojson(1,'','二级菜单名字己占用，请重新输入！');
        }else{
            $smd_pid = 0;
            if(intval($this->menu_count($smd_pid,$service_token))>=3) echojson(1,'','一级菜单最多只能三个'); 
            if(!$this->isSnameCheck(0,$smd_name,$service_token,'')) echojson(1,'','一级菜单名字己占用，请重新输入！');
        }

        $this->service_token = $service_token;
        $weixinR = $this->weixin->getOne('wid',array('service_token'=>$service_token));
        $url = $this->actionList->diy_menu_list."&wid=".$weixinR->wid;

        $this->menu_diy->smd_pid = $smd_pid;
        $this->menu_diy->smd_sort = intval($this->menu_count($smd_pid,$service_token))+1;
        $this->menu_diy->smd_name = $smd_name;
        $this->menu_diy->service_token = $service_token;
        if($smd_id = $this->menu_diy->insert()){
           
            //把父级smd_type == '' smd_content ==''; 子级
            if($smd_pid){

                $resultV['smd_id'] = $smd_id;
                $resultV['smd_sort'] = intval($this->menu_count($smd_pid,$service_token));
                $resultV['smd_content'] = '';
                $resultV['smd_type'] = '';
                $resultV['smd_name'] = $smd_name;

                $data['smd_type'] = '';
                $data['smd_content'] = '';
                $where['smd_id'] = $smd_pid;
                if(!$this->menu_diy->updates_global($data,$where)){
                    $this->menu_diy->delete($smd_id);
                    echojson(1,'','添加失败');
                }
            }else{

                $resultV['smd_pid'] = $smd_id;
                $resultV['smd_psort'] = intval($this->menu_count($smd_pid,$service_token));
                $resultV['smd_content'] = '';
                $resultV['smd_ptype'] = '';
                $resultV['smd_pname'] = $smd_name;
                $resultV['smd_son_list'] = '';
            }
            echojson(0,$resultV,'添加成功');
        }else{
            echojson(1,'','添加失败');
        }
       
    }

    /**
     *description:菜单判断个数
     *author:liuguangping
     *date:2014/04/19
     */
    public function diy_menu_count(){
        safeFilter();
        $smd_pid = $this->input->post("smd_pid",true);
        if(!isset($smd_pid)) echojson(1,'','非法操作');
        $service_token = $_POST['service_token'];
        $service_token = isset($service_token) && $service_token?$service_token:echojson(1,'','服务商token为空，非法操作！');
        if($smd_pid){
            intval($this->menu_count($smd_pid,$service_token))>=5?echojson(0,'','允许添加'):echojson(1,'','二级菜单最多只能五个'); 
        }else{
            intval($this->menu_count(0,$service_token))>=3?echojson(0,'','允许添加'):echojson(1,'','一级菜单最多只能三个');
        }
    }

    /**
     *description:菜单判断个数控制器
     *author:liuguangping
     *date:2014/04/19
     */
    public function menu_count($smd_pid,$service_token){
        $where['smd_pid'] = $smd_pid;
        $where['service_token'] = $service_token;
        $result = $this->menu_diy->getArray('smd_id',$where);
        return count($result);
      
    }

    /**
     *description:修改菜单名称提交
     *author:liuguangping
     *date:2014/04/19
     */
    public function diy_menu_name_mod(){

        safeFilter();
        loadLib("diyMenuFormCheck");    
        diyMenuFormCheck::createObj('edit');

        //TODO 先不查是文字还是图文，后期在详细权限
        //$this->CheckAccessByKey('diy_menu_list');
        $service_token = $this->input->post("service_token");
        $service_token = isset($service_token) && $service_token?$service_token:echojson(1,'','服务商token为空，非法操作！');
        $smd_id = $this->input->post('smd_id',true);
        $smd_name = $this->input->post('smd_name',true);
        $diyInfo = model('t_service_menu_diy')->get($smd_id);
        if($diyInfo->smd_pid != 0){
            //判断名称是否唯一
            if(!$this->isSnameCheck($diyInfo->smd_pid,$smd_name,$service_token,$smd_id)) echojson(1,'','二级菜单名字己占用，请重新输入！');
        }else{
            if(!$this->isSnameCheck(0,$smd_name,$service_token,$smd_id)) echojson(1,'','一级菜单名字己占用，请重新输入！');
        }

        $data['smd_name'] = $smd_name;
        $where['smd_id'] = $smd_id;
        if($this->menu_diy->updates_global($data,$where)){
            echojson(0,'','编辑成功！');
        }else{
            echojson(1,'','编辑失败！');
        }
      
    }

    /**
     *description:删除菜单提交
     *author:liuguangping
     *date:2014/04/19
     */
    public function diy_menu_del(){
         safeFilter();
        //TODO 先不查是文字还是图文，后期在详细权限
        //$this->CheckAccessByKey('diy_menu_list');
        $flg = true;
        $smd_id = $this->input->post('smd_id',true);
        if($smd_id == '' || !is_numeric($smd_id)) echojson(1,'','菜单id填写非法');
        
        $diyInfo = model('t_service_menu_diy')->get($smd_id);
        if($diyInfo->smd_pid == 0){
            //判断名称是否唯一
            $where['smd_pid'] = $smd_id;
            $result = $this->menu_diy->getArray('smd_id',$where);
            if($result){

                foreach ($result as $key => $value) {
                    if(!$this->menu_diy->delete($value->smd_id)) $flg = false;
                }

                if($flg){
                    if(!$this->menu_diy->delete($smd_id)) $flg = false;
                }
            }else{
               if(!$this->menu_diy->delete($smd_id)) $flg = false;
            }
            
        }else{
            if(!$this->menu_diy->delete($smd_id)) $flg = false;
        }

       $flg?echojson(0,'','删除成功'):echojson(1,'','删除失败');
    }

    /**
     *description:菜单排序
     *author:liuguangping
     *date:2014/04/19
     */
    public function diy_menu_sort(){
         safeFilter();
        //$_POST['sortData'] = "1^12,11|2^13|3";
        //TODO 先不查是文字还是图文，后期在详细权限
        //$this->CheckAccessByKey('diy_menu_list');
        $flg = true;
        $sortData  = $this->input->post('sortData',true);
        if($sortData == '') echojson(1,'','菜单id填写非法');
        $this->sortConsole($sortData)?echojson(0,'','操作成功!'):echojson(1,'','操作失败!');
    }

     /**
     *description:菜单排序处理
     *author:liuguangping
     *data 父id1^子id1,子id2,子id3,子id4,子id5|父id2^子id1,子id2,子id3,子id4,子id5|父id3^子id1,子id2,子id3,子id4,子id5
     *date:2014/04/19
     */
     public function sortConsole($sortData){

        $flg = true;
        $exData = explode('|', $sortData);  
        if($exData){
            foreach ($exData as $key => $value) {
                $exTwoData = explode('^', $value);
                if($exTwoData){
                    $data['smd_sort'] = $key+1;
                    $where['smd_id'] = $exTwoData['0'];
                    if(!$this->menu_diy->updates_global($data,$where)) $flg = false;
                    if(isset($exTwoData['1'])){
                        $exThreeData = explode(',', $exTwoData['1']);

                        if($exThreeData){
                           foreach ($exThreeData as $ke => $val) {
                                $data['smd_sort'] = $ke+1;
                                $where['smd_id'] = $val;
                                if(!$this->menu_diy->updates_global($data,$where)) $flg = false;
                            } 
                            
                        }else{
                            continue;
                        }
                        
                    }else{
                        continue;
                    }
                }else{
                    continue;
                }
               
            }
        }else{
            $flg = false;
        }
        return $flg;
     }

    /**
     *description:生成自定义菜单
     *author:liuguangping
     *date:2014/04/19
     */
    public function save_menu(){
        //$_POST['service_token'] = 'liuguangping';
        safeFilter();
        $service_token = $this->input->post('service_token',true);
        $service_token = isset($service_token) && $service_token?$service_token:echojson(1,'','服务商token为空，非法操作！');
        loadLib('WechatMenu');
        $weixinObj = new WechatMenu($service_token);
        if($weixinObj->createMenu()){
            $url = $this->actionList->weixin_list;
            echojson(0,$url,'发布成功！');
        }else{
            echojson(1,'','发布失败！');
        }
    }

    /**
     *description:菜单中添加动作内容
     *author:liuguangping
     *date:2014/04/19
     */
    public function diy_menu_content(){
        safeFilter();
        $smd_id = $this->input->post('smd_id',true);
        $smd_list_type = $this->input->post('smd_list_type',true);
        if($smd_id == '' || !is_numeric($smd_id)) echojson(1,'','置响应动作非法');
        if($smd_list_type == '' || !is_numeric($smd_list_type)) echojson(1,'','置响应动作标识非法');
        $smd_type = $this->input->post('smd_type',true);
        if($smd_type == '' || !is_numeric($smd_type)) echojson(1,'','还未设置响应动作,请检查！');
        $smd_content = $this->input->post('smd_content',true);
        if(!$smd_content) echojson(1,'','存在还未设置响应动作的菜单，请检查');
        
        $data['smd_type'] = $smd_type;
        $data['smd_content'] = $smd_content;
        $where['smd_id'] = $smd_id;

        $result = array();
    
        $result['smd_id'] = $smd_id;
        if($smd_list_type == 0){
             $result['smd_ptype'] = $smd_type;
         }else{
            $result['smd_type'] = $smd_type;
         }

        if($smd_type == 1){
            $result['smd_content'] = $smd_content;
        }elseif($smd_type == 2){
            if($smd_content){
                $inId = explode(',', $smd_content);
                foreach ($inId as $ke =>$va) {
                    $whereInO['si_id'] = $va;
                    $whereInO['si_status'] = 1;
                    $infoOneR = $this->service_infomation->getOne('*',$whereInO);
                    if($infoOneR){
                        $result['smd_content'][$ke]['si_url'] = $infoOneR->si_pic;
                        $result['smd_content'][$ke]['si_title'] = $infoOneR->si_title;
                        $result['smd_content'][$ke]['si_pic'] = $infoOneR->si_pic; 
                        $result['smd_content'][$ke]['si_addtime'] = $infoOneR->si_addtime; 
                    }else{
                        $result['smd_content'][$ke] = ''; 
                    }
                    
                }
            }else{
               $result['smd_content'] = ''; 
            }
        }elseif($smd_type == 3){
            $result['smd_content'] = $smd_content;
        }else{
          
            $result['smd_content'] = '';
        }
 
        if($this->menu_diy->updates_global($data,$where)){
            echojson(0,$result,'操作成功！');
        }else{
            echojson(1,$result,'操作失败！');
        }
    }
  
}
