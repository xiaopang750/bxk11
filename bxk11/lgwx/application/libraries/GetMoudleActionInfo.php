<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:根据action_id获取模块操作相关信息
 *author:yanyalong
 *date:2014/03/25
 */
class GetMoudleActionInfoById{
    public $action_id;
    public $actionInfo;
    public function __construct($action_id){
        $this->action_id = $action_id;        
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_module_action_model');
    }
    public function getMoudleActionInfo(){
        $this->actionInfo = $this->CI->t_service_module_action_model->getActionInfoById($this->action_id);
    }
    public function getMoudleActionKey(){
        return $this->actionInfo->action_key;
    }
}

/**
 *description:根据action_key获取模块操作相关信息
 *author:yanyalong
 *date:2014/03/25
 */
class GetMoudleActionInfoByKey{
    public $action_key;
    public $actionInfo;
    public function __construct($action_key){
        $this->action_key= $action_key;        
    }
    public function getMoudleActionInfo(){
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_module_action_model');
        $this->actionInfo=$this->CI->t_service_module_action_model->getActionInfoByKey($this->action_key);
    }
    public function getMoudleActionId(){
        return $this->actionInfo->action_id;
    }
}
/**
 *description:获取模块操作相关数据
 *author:yanyalong
 *date:2014/03/25
 */
class MoudleActionFactory{
    //根据action_id获取操作相关信息
    public static function GetMoudleActionInfoById($aciton_id){
        $GetMoudleActionInfoById = new GetMoudleActionInfoById($aciton_id);
        $GetMoudleActionInfoById->getMoudleActionInfo();
        return $GetMoudleActionInfoById->actionInfo;
    }
    //根据action_id获取操作action_key
    public static function GetMoudleActionKeyById($aciton_id){
        $GetMoudleActionKeyById = new GetMoudleActionKeyById($aciton_id);
        $GetMoudleActionInfoById->getMoudleActionInfo();
        return $GetMoudleActionKeyById->getMoudleActionKey();
    }
    //根据action_key获取操作相关信息
    public static function GetMoudleActionInfoByKey($action_key){
        $GetMoudleActionInfoByKey= new GetMoudleActionInfoByKey($action_key);
        $GetMoudleActionInfoByKey->getMoudleActionInfo();
        $GetMoudleActionInfoByKey->actionInfo;
    }
    //根据action_key获取操作action_id
    public static function GetMoudleActionIdByKey($action_key){
        $GetMoudleActionInfoByKey = new GetMoudleActionInfoByKey($action_key);
        $GetMoudleActionInfoByKey->getMoudleActionInfo();
        return $GetMoudleActionInfoByKey->getMoudleActionId();
    }
}
