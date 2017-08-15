<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:经销商登录验证类
 *author:yanyalong
 *date:2014/03/20
 */
class ChcekServiceLogin{
    private $isLogin;
    private $loginFlag;
    private $currentAction;
    private $isNoNeedCheckLogin;
    public function __construct(){
        loadLib('ServiceUserAccess');
        $this->actionList = ServiceUserAccessFactory::getActionUrlList();
        $this->isLogin          = (isset($_SESSION['service_user_id'])&&$_SESSION['service_user_id']!="")?$_SESSION['service_user_id']:"";
        $this->loginFlag        = false;
        $this->currentAction    = $_SERVER['PHP_SELF'];
        $this->isNoNeedCheckLogin();
        $this->checkLogin();
        $this->getLoginFlagJson();
    }    
    /**
     *description:登录验证方法
     *author:yanyalong
     *date:2014/03/20
     */
    private function checkLogin(){
        $this->loginFlag = ($this->isLogin==true)?true:false;
    }
    /**
     *description:登录验证结果输出
     *author:yanyalong
     *date:2014/03/20
     */
    private function getLoginFlagJson(){
        if($this->isNoNeedCheckLogin==true&&$this->loginFlag==true){
            header("location:".$this->actionList->index);exit;
        }elseif($this->isNoNeedCheckLogin==true&&$this->loginFlag==false){
            return true;  
        }elseif($this->isNoNeedCheckLogin==false&&$this->loginFlag==false){
            $url = $this->actionList->service_login;
            echo "<script>alert('您还没有登陆！'); window.location='$url'</script>";exit;
        }elseif($this->ischeckAlreadyLogin==true&&$this->loginFlag==true){
            header("location:".$this->actionList->index);exit;
        }
    }
    /**
     *description:判断当前操作是否需要验证登录状态
     *author:yanyalong
     *date:2014/03/20
     */
    public function isNoNeedCheckLogin(){
        $this->currentAction = getActionByUrl($this->currentAction);
        $checkNoNeedArr = array(
            'login',
            'login/index',
            'reg',
            'reg/index',
            'post/login',
            'post/login/index',
            'post/join/index',
            'post/login/reg',
            'post/login/temp',
        );
        $checkAlreadyLoginArr = array(
            'lgwx/index.php',
            'index',
            'login/index',
        );
        $this->isNoNeedCheckLogin = (in_array($this->currentAction,$checkNoNeedArr))?true:false;
        $this->ischeckAlreadyLogin = (in_array($this->currentAction,$checkAlreadyLoginArr))?true:false;
    }

}
/**
 *description:经销商帐号登录验证工厂
 *author:yanyalong
 *date:2014/03/20
 */
class ServiceLoginFactory{
    public static function checkServiceLogin(){
        new ChcekServiceLogin();
    }
}


