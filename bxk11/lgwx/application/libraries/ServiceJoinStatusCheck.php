<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class ServiceJoinStatusCheckFactory{
    public static function createObj($service_status){
        $obj = new ServiceStatusJoinCheck($service_status);
        if($obj instanceof JoinStatusCheckAbstract){
            return $obj->StatusCheck();
        }else{
            return false;	
        }
    }
}

//抽象类
abstract class JoinStatusCheckAbstract{
    abstract public function StatusCheck();
    public $service_status;
    public function __construct($service_status){
        $this->service_status = $service_status;
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_info_model');
        loadLib('ServiceUserAccess');
        $this->actionList = ServiceUserAccessFactory::getActionUrlList();
    }
}

/**
 *description:检测加盟状态(在相关页面中设置通行状态,然后根据通行状态和当前实际状态进行比对判断，若不同，则根据实际状态应该在的页面进行判断)
 if(in_array($res->service_status,array(21,22,24))) //通行状态
     ServiceJoinStatusCheckFactory::createObj($res->service_status);//根据当前实际状态进行判断
*author:yanyalong
    *date:2014/03/20
 */
class ServiceStatusJoinCheck extends JoinStatusCheckAbstract{
    public function StatusCheck(){
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $service_info= $this->CI->t_service_info_model->get($service_id);
        if($service_info->service_status<21){
            $url = $this->actionList->join_status;
            echojson(1,$url,"您的认证审核已通过，无需重新认证");
        }elseif($service_info->service_status<23){
            $url = $this->actionList->join_step1;
            echojson(1,$url,"您还没有添加提交认证申请");
        }elseif($service_info->service_status==23){
            $url = $this->actionList->join_step4;
            echojson(1,$url,"正在审核中，请耐心等待");
        }elseif($service_info->service_status==24){
            $url = $this->actionList->join_status;
            echojson(1,$url,"您的认证失败了");
        }
    }
}

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class ServiceJoinStatusIsTrueFactory{
    public static function createObj($actionKey,$actionType=""){
        $obj = new ServiceStatusJoinIsTrue($actionKey,$actionType);
        if($obj instanceof JoinStatusCheckIsTrueAbstract){
            return $obj->StatusCheck();
        }else{
            return false;	
        }
    }
}

//抽象类
abstract class JoinStatusCheckIsTrueAbstract{
    public $actionType;
    public $actionKey;
    abstract public function StatusCheck();
    public function __construct($actionKey,$actionType=""){
        $this->actionType = $actionType;
        $this->actionKey = $actionKey;
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_info_model');
    }
}

/**
 *description:检测加盟状态
 *author:yanyalong
 *date:2014/03/20
 */
class ServiceStatusJoinIsTrue extends JoinStatusCheckIsTrueAbstract{
    public function StatusCheck(){
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        if($service_id=="") echojson(1,"","异常操作");
        $service_info = $this->CI->t_service_info_model->get($service_id);
        if($service_info!=false&&$service_info->service_status>20){
            echojson(1,$this->actionList->$this->actionKey,"抱歉，在您的企业未进行认证或认证申请未成功之前，您还无法进行此操作！");
        }
    }
}
