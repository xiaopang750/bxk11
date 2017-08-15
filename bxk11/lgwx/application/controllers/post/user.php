<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:获取用户权限菜单列表
 *author:yanyalong
 *date:2014/03/24
 */
class  user extends  MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('t_service_user_model');
        $this->load->model('t_service_info_model');
        $this->load->model('t_service_module_action_model');

    }
    public function password(){
        //todo 这里库里还要加个权限
        //$this->CheckAccessByKey('user_pass');
        $this->CheckAccessByKey('service_user_mod');
        safeFilter();
        $oldPassWord= $this->input->post('oldPassWord',true);
        $newPassWord= $this->input->post('newPassWord',true);
        $reNewPassWord= $this->input->post('reNewPassWord',true);
        $service_user_id= isset($_SESSION['service_user_id'])?$_SESSION['service_user_id']:"";
        $serviceInfo= $this->t_service_user_model->get($service_user_id);	
        if($serviceInfo->service_user_password!=md5($oldPassWord)){
            echojson(1,"",'原密码输入错误');
        }
        if($oldPassWord==''||$newPassWord==''||$reNewPassWord=='')
        {
            echojson(1,"",'输入项不完整');
        }
        if(!preg_match('/^[a-zA-Z\d_]{6,16}$/',$newPassWord)){
            echojson(1,"",'密码格式不正确');
        }		
        if($newPassWord!=$reNewPassWord){
            echojson(1,"",'两次密码不一致');
        }
        $res= $this->t_service_user_model->update_passwd(md5($newPassWord),$service_user_id);
        if($res==false){
            echojson(1,"",'修改失败');
        }else{
            $url = $this->actionList->index;
            echojson(0,$url,'修改成功');
        }
    }
    /**
     *description:添加帐号
     *author:yanyalong
     *date:2014/03/27
     */
    public function add(){
        $this->CheckAccessByKey('user_add');
        $service_user_id= isset($_SESSION['service_user_id'])?$_SESSION['service_user_id']:"";
        $this->load->model('t_service_user_model');
        loadlib('ServiceShopManage');
        ServiceShopManageFactory::creatObj($service_user_id);
        $ShopList = ServiceShopManageFactory::searchServiceShopList(1,array('shop_id','shop_name'));
        if($ShopList==false){
            echojson(1,'','操作异常，请先添加过门店再做此操作');
        }
        safeFilter();
        loadLib('ServiceUserAddCheck');
        ServiceUserAddCheckFactory::createObj();
        //用户名称开始
        if(trim($_POST['user_name'])==""){
            echojson(1,'','帐号名称不能为空');
        }
        if((strlen(trim($_POST['user_name'])) + mb_strlen(trim($_POST['user_name']),'UTF8'))/2>50){
            echojson(1,"","帐号名称不能超过25个字");
        }
        $this->t_service_user_model->service_user_name= $_POST['user_name'];
        $this->t_service_user_model->service_id= (isset($_SESSION['service_id']))?$_SESSION['service_id']:echojson(1,'','登录异常');
        if($this->t_service_user_model->getServiceUserInfo()!=false){
            echojson(1,'','已存在同名子账号');
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
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $this->config->load('uploads');		
        $config = $this->config->item("serviceUser");		
        $this->load->library('upload');
        $timedir = $this->upload->mktimedir($config['service_path']);
        if($_POST['user_photo']!=""){
            $_POST['user_photo'] = (isset($_POST['user_photo'])&&$_POST['user_photo']!="")?basename($_POST['user_photo']):"";
            $user_photo = ($_POST['user_photo']!=""&&file_exists($config['upload_path'].$_POST['user_photo']))?(copy($config['upload_path'].$_POST['user_photo'],$timedir.$_POST['user_photo'])).(unlink($config['upload_path'].$_POST['user_photo'])):false;
            $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
            $upliad_relative_path = $config['relative_upload'].$time_relative_path;
            $this->t_service_user_model->service_user_photo= ($user_photo==false)?"":$upliad_relative_path.$_POST['user_photo'];
        }
        $user_module = "'".str_replace(",","','",$_POST['user_module'])."'";
        $user_actionsList = $this->t_service_module_action_model->getActionByModule($user_module);    
        if($user_actionsList==false){echojson(1,'','数据异常');}
        $user_actions ="";
        foreach ($user_actionsList as $key=>$val) {
            $user_actions .= "'$val->action_key',";
        }
        $this->t_service_user_model->service_id= (isset($_SESSION['service_id']))?$_SESSION['service_id']:echojson(1,"","操作异常");
        $this->t_service_user_model->service_user_name= $_POST['user_name'];
        $this->t_service_user_model->service_user_password= md5($_POST['user_password']);
        $this->t_service_user_model->service_user_shop= $_POST['user_shop'];
        $this->t_service_user_model->service_user_actions= trim($user_actions,',');
        $this->t_service_user_model->service_user_realname= $_POST['user_realname'];
        $this->t_service_user_model->service_user_phone= $_POST['user_phone'];
        $this->t_service_user_model->service_user_addtime = $joinTime;
        $this->t_service_user_model->service_user_id= $this->t_service_user_model->insert();
        $url = $this->actionList->user_list;
        ($this->t_service_user_model->service_user_id!=false)?echojson(0,$url,"添加子账号成功"):echojson(1,"","添加子账号失败了");
    }
    /**
     *description:编辑子账号
     *author:yanyalong
     *date:2014/03/27
     */
    public function edit(){
        $this->CheckAccessByKey('user_edit');
        safeFilter();
        loadLib('ServiceUserAddCheck');
        ServiceUserAddCheckFactory::createObj();
        $user_password = isset($_POST['user_password'])?$_POST['user_password']:"";
        $reply_password = isset($_POST['reply_password'])?$_POST['reply_password']:"";
        if($user_password!=""||$reply_password!=""){
            if(!preg_match('/^[a-zA-Z\d_]{6,16}$/',$user_password)){
                echojson(1,"",'密码格式不正确');
            }elseif($user_password!=$reply_password){
                echojson(1,"",'两次密码不一致');
            }else{
                $data['service_user_password']= md5($user_password);
            }
        }
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $this->config->load('uploads');		
        $config = $this->config->item("serviceUser");		
        $this->load->library('upload');
        $timedir = $this->upload->mktimedir($config['service_path']);
        $service_user_id = (isset($_POST['service_user_id'])&&$_POST['service_user_id']!="")?$_POST['service_user_id']:"异常操作";
        $serviceUserInfo= $this->t_service_user_model->get($service_user_id);
        $serviceInfo = $this->t_service_info_model->get($serviceUserInfo->service_id);
        $is_manage = ($serviceInfo->service_name==$serviceUserInfo->service_user_name)?true:false;
        if(!isset($_POST['user_photo'])){echojson(1,"","异常操作");}
        if($serviceUserInfo->service_user_photo!=$_POST['user_photo']){
            $_POST['user_photo'] = (isset($_POST['user_photo'])&&$_POST['user_photo']!="")?basename($_POST['user_photo']):"";
            $user_photo = ($_POST['user_photo']!=""&&file_exists($config['upload_path'].$_POST['user_photo']))?(copy($config['upload_path'].$_POST['user_photo'],$timedir.$_POST['user_photo'])).(unlink($config['upload_path'].$_POST['user_photo'])):false;
            $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
            $upliad_relative_path = $config['relative_upload'].$time_relative_path;
            $data['service_user_photo'] = ($user_photo==false)?"":$upliad_relative_path.$_POST['user_photo'];
        }
        if($is_manage!=true){
            $user_module = "'".str_replace(",","','",$_POST['user_module'])."'";
            $user_actionsList = $this->t_service_module_action_model->getActionByModule($user_module);    
            if($user_actionsList==false){echojson(1,'','数据异常');}
            $user_actions ="";
            foreach ($user_actionsList as $key=>$val) {
                $user_actions .= "'$val->action_key',";
            }
            $data['service_user_actions'] = trim($user_actions,',');
            $data['service_user_shop'] = $_POST['user_shop'];
        }
        $data['service_user_realname'] = $_POST['user_realname'];
        $data['service_user_phone'] = $_POST['user_phone'];
        $updateFlag = $this->t_service_user_model->updates_global($data,array('service_user_id'=>$service_user_id));
        $url = $this->actionList->user_list;
        ($updateFlag!=false)?echojson(0,$url,"修改子账号成功"):echojson(1,"","修改子账号失败了");
    }
    /**
     *description:删除子帐号
     *author:yanyalong
     *date:2014/03/27
     */
    public function del(){
        $this->CheckAccessByKey('user_edit');
        $service_user_id = (isset($_GET['uid'])&&$_GET['uid']!="")?$_GET['uid']:"异常操作";
        $userInfo= $this->t_service_user_model->get($service_user_id);
        if($userInfo==false){
            echojson(1,"","无相关数据"); 
        }
        $serviceInfo = $this->t_service_info_model->get($userInfo->service_id);
        ($serviceInfo->service_name==$userInfo->service_user_name)?echojson(1,"","管理员帐号无法删除哦"):"";
        $data['service_user_status'] = "99";
        $updateFlag = $this->t_service_user_model->updates_global($data,array('service_user_id'=>$service_user_id));
        $url = $this->actionList->user_list;
        if($updateFlag!=false){
            echo "<script>alert('删除成功！'); window.location='$url'</script>";exit;
        }else{
            echo "<script>alert('删除失败！'); window.location='$url'</script>";exit;
        }
    }
    /**
     *description:用户信息修改
     *author:yanyalong
     *date:2014/05/25
     */
   public function setServiceUserinfo(){
        $service_user_id= isset($_SESSION['service_user_id'])?$_SESSION['service_user_id']:'';

        $serviceUserInfo = $this->t_service_user_model->get($service_user_id);
        //用户手机号
        if(trim($_POST['user_phone'])==""){
            echojson(1,'','用户手机号不能为空');
        }
        if(!preg_match('/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/',$_POST['user_phone'])){
            echojson(1,"","手机号格式错误");
        }
        $service_info = $this->t_service_user_model->getServiceUserByPhone($_POST['user_phone']);
        if($serviceUserInfo->service_user_phone!=$_POST['user_phone']&&$service_info!=false){
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
        if($serviceUserInfo->service_user_email!=$_POST['user_email']&&$service_info!=false){
            echojson(1,'','该邮箱已经被申请过');
        }
        $data['service_user_email'] = $_POST['user_email'];
        $data['service_user_phone'] = $_POST['user_phone'];
        $res= $this->t_service_user_model->updates_global($data,array('service_user_id'=>$service_user_id));
        if($res==false){
            echojson(1,"",'修改失败');
        }else{
            $url = $this->actionList->index;
            echojson(0,$url,'修改成功');
        }
    }
}
