<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:经销商登录提交
 *author:yanyalong
 *date:2014/03/20
 */
class login extends  MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('t_service_module_action_model');
        $this->load->model('t_service_info_model');
        $this->load->model('t_service_user_model');
        $this->load->model('t_service_role_auth_model');
        $this->load->model('t_service_wap_template_model');
        $this->load->model('t_service_wap_menu_model');
        $this->load->model('t_wap_template_model');
        $this->load->model('t_service_spreader_model');
        $this->load->model('t_service_shop_model');
    }
    /**
     *description:经销商登录提交
     *author:yanyalong
     *date:2014/03/20
     */
    public function index(){
        safeFilter();
        $user_login_code = $this->input->post('user_login_code',true);
        $password = $this->input->post('pass_word',true);
        $verify_code = $this->input->post('verify_code',true);
        //用户手机号
        if(trim($user_login_code)==""){
            echojson(1,'','请您填写手机/邮箱');
        }
        //验证码开始
        if(trim($verify_code)!=$_SESSION['captcha']){
            echojson(1,'','验证码不正确');
        }
        $this->load->model('t_service_user_model');
        $res = $this->t_service_user_model->getServiceUserInfoBylogin($user_login_code,md5($password));
        $url = $this->actionList->index;
        if($res!=false){
            session_unset();
            $_SESSION['service_user_id'] = $res->service_user_id;
            $_SESSION['service_user_name'] = $res->service_user_name;
            $_SESSION['service_id'] = $res->service_id;
            echojson(0,$url,"登陆成功");
        }else{
            echojson(1,$url,"登录失败，可能是会员名、用户名或密码错误");
        }
    }
    /**
     *description:退出登录
     *author:yanyalong
     *date:2014/03/25
     */
    public function loginout(){
        session_unset(); 
        header("location:".$this->actionList->service_login);
    }
    /**
     *description:临时用户注册
     *author:yanyalong
     *date:2014/04/23
     */
    public function reg(){
        safeFilter();
        //企业名称开始
        if(trim($_POST['service_name'])==""){
            echojson(1,'','企业简称必填');
        }
        if((strlen(trim($_POST['service_name'])) + mb_strlen(trim($_POST['service_name']),'UTF8'))/2>40){
            echojson(1,"","企业简称不能超过20个字");
        }
        /*//用户名称开始
        if(trim($_POST['user_name'])==""){
            echojson(1,'','帐号昵称必填');
        }*/
        //注册去掉昵称 改成默认为管理员
              /*  if((strlen(trim($_POST['user_name'])) + mb_strlen(trim($_POST['user_name']),'UTF8'))/2>20){
                    echojson(1,"","帐号名称不能超过10个字");
              }*/
        //用户手机号
        if(trim($_POST['user_phone'])==""){
            echojson(1,'','用户手机号不能为空');
        }
        if(!preg_match('/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/',$_POST['user_phone'])){
            echojson(1,"","手机号格式错误");
        }
        $service_info = $this->t_service_user_model->getServiceUserByPhone($_POST['user_phone']);
        if($service_info!=false){
            echojson(1,'','该手机号已经被申请过');
        }
        //用户邮箱
        if(trim($_POST['user_email'])==""){
            echojson(1,'','用户邮箱必填');
        }
        if(!preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',$_POST['user_email'])){
            echojson(1,'','用户邮箱格式不正确');
        }		
        $service_info = $this->t_service_user_model->getServiceUserByEmail($_POST['user_email']);
        if($service_info!=false){
            echojson(1,'','该邮箱已经被申请过');
        }
        if($_POST['user_password']==''){
            echojson(1,"",'密码不能为空');
        }
        if($_POST['reply_password']==''){
            echojson(1,"",'重复密码不能为空');
        }
        if(!preg_match('/^[a-zA-Z\d_]{6,16}$/',$_POST['user_password'])){
            echojson(1,"",'密码格式不正确');
        }		
        if($_POST['user_password']!=$_POST['reply_password']){
            echojson(1,"",'两次密码不一致');
        }
        $verify_code = $this->input->post('verify_code',true);
        //验证码开始
        if(trim($verify_code)!=$_SESSION['captcha']){
            echojson(1,'','验证码不正确');
        }
        $url = $this->actionList->index;
        $this->t_service_info_model->service_status = 21;
        $this->t_service_info_model->la_rank=1;
        $this->t_service_info_model->service_type_id=1;
        $this->t_service_info_model->service_name = $_POST['service_name'];
        $this->config->load('wap_template');		
        $template_config = $this->config->item("template");		
        $service_id = $this->t_service_info_model->insert();
        if($service_id!=false){
            $this->t_service_role_auth_model->service_id= $service_id;
            $this->t_service_role_auth_model->ra_name= "管理员";
            $this->t_service_role_auth_model->ra_auth= "";
            $this->t_service_role_auth_model->ra_status = 1;
            $this->t_service_role_auth_model->is_admin = 1;
            $ra_id = $this->t_service_role_auth_model->insert();
            if($ra_id!=false){
                $this->t_service_user_model->service_id = $service_id;
                $this->t_service_user_model->ra_id = $ra_id;
                //注册去掉昵称 改成默认为管理员
                $this->t_service_user_model->service_user_name= '管理员';
                //$this->t_service_user_model->service_user_name= $_POST['user_name'];
                $this->t_service_user_model->service_user_password = md5($_POST['user_password']);
                $this->t_service_user_model->service_user_realname = "";
                $this->t_service_user_model->service_user_phone= $_POST['user_phone'];
                $this->t_service_user_model->service_user_photo = "";
                $this->t_service_user_model->service_user_status = 1;
                $this->t_service_user_model->service_user_email= $_POST['user_email'];
                $service_user_id = $this->t_service_user_model->insert();
                $template_list = $this->t_service_wap_menu_model->geLsitByServiceType(1,1);
                $wap_template = $this->t_wap_template_model->get(1);
                $main_menu = "";
                $i = 0;
                foreach ($template_list as $keys=>$vals) {
                    if($vals->menu_level==1){
                        $main_menu .= $vals->menu_id."|".$vals->menu_url."|".$vals->menu_name.',';
                        $i++;
                    }else{
                        continue; 
                    }
                }
                $shortcut_menu = "";
                //$menucount = $wap_template->main_menu_count+$wap_template->shortcut_menu_count;
                //$j = $wap_template->main_menu_count;
                $template_list = $this->t_service_wap_menu_model->geLsitByServiceType(1,2);
                $i=1;
                foreach ($template_list as $key=>$val) {
                    if($val->menu_level==2){
                        $pic = $template_config['shortcut_url'].$wap_template->template_code."/".$i.".png";
                        $shortcut_menu .=  $val->menu_id."|".$val->menu_url."|".$val->menu_name."|".$pic.',';
                        //$j++;
                        $i++;
                    }else{
                        continue; 
                    }
                }
                $this->t_service_wap_template_model->template_id = 1;
                $this->t_service_wap_template_model->service_id= $service_id;
                $this->t_service_wap_template_model->main_menu= trim($main_menu,',');
                $this->t_service_wap_template_model->shortcut_menu= trim($shortcut_menu,',');
                $this->t_service_wap_template_model->is_use=1;
                $this->t_service_wap_template_model->insert();
                //session_unset();
                //$_SESSION['service_user_name'] = $_POST['user_name'];
                //注册去掉昵称 改成默认为管理员
                $_SESSION['service_user_name'] =  $this->t_service_user_model->service_user_name;
                $_SESSION['service_user_id'] = $service_user_id;
                $_SESSION['service_id'] = $service_id;
                //$_SESSION['service_type_id'] = '1';
                if($service_user_id!=false){
                    //注册成功更新服务商表的推广标识
                    $whereS['service_id'] = $service_id;
                    $dataS['spreader_code'] = md5($service_id);
                    $datas['service_reg_source_type'] = 0;
                    $this->t_service_info_model->updates_global($dataS,$whereS);
                    //推广操作
                    $spreader_code = isset($_POST['flg'])?$_POST['flg']:'';
                    //$spreader_code = "c5ff2543b53f4cc0ad3819a36752467b";
                    loadLib('LgwxSpreader');
                    $this->lgwxSpreader = new LgwxSpreader();
                    if($spreader_code){
                        $this->lgwxSpreader->spreader_code = $spreader_code;
                        $this->lgwxSpreader->service_id  = $service_id;
                        $map['spreader_code'] = $spreader_code;
                        $map['ss_status'] = 1;
                        if($rowR = $this->t_service_spreader_model->getOne('ss_type',$map)){
                            //更新注册来源类型
                            $updateD['service_reg_source_type'] = $rowR->ss_type;
                            $this->t_service_info_model->updates_global($updateD,array('service_id'=>$service_id));
                            $this->lgwxSpreader->ss_type = $rowR->ss_type;
                            $result = $this->lgwxSpreader->setRegConsole();
                        }
                    }
                    //生成推广二维码和分享地址
                    $this->lgwxSpreader->nickname = $this->t_service_role_auth_model->ra_name;
                    $this->lgwxSpreader->openid  = $service_id;
                    $this->lgwxSpreader->service_id = $service_id;
                    $this->lgwxSpreader->ss_phone = $_POST['user_phone'];
                    $this->lgwxSpreader->ss_type = 2;
                    $result = $this->lgwxSpreader->insertSpreader();
                    //创建服务商logo二维码
                    $config = C('uploads','serviceLogoQr');
                    $urls = $_SERVER['HTTP_HOST'].$config['text']."&service_id=".$service_id;
                    if(stripos($urls,'http://') === FALSE)
                        $urls = 'http://'.$urls;
                    $this->lgwxSpreader->createServiceQrCode($urls,$service_id,false);
                    //创建网上商城(即门店)
                    $this->t_service_shop_model->shop_name = "在线商城";
                    $this->t_service_shop_model->service_id= $service_id;
                    $this->t_service_shop_model->shop_status= 1;
                    $this->t_service_shop_model->shop_addtime= date("Y-m-d H:i:s");
                    $this->t_service_shop_model->insert();
                    echojson(0,$url,"注册成功");
                }else echojson(1,$url,"注册失败"); 
            }
        }else echojson(1,$url,"注册失败"); 
    }
}
