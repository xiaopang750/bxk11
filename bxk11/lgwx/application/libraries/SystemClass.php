<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:系统分类
 *author:yanyalong
 *date:2014/04/01
 */
class SystemClass{
    private $classType;
    private $columnArr;
    public function __construct($classType,$columnArr){
        $this->classType = $classType;
        $this->columnArr = $columnArr;
        $this->CI = &get_instance();
        $this->CI->load->model('t_system_class_model');
    }    
    /**
     *description:根据系统分类类型获取系统分类信息
     *author:yanyalong
     *date:2014/04/01
     */
    public function getSystemByType(){
        $res = $this->CI->t_system_class_model->classlist($this->classType);
        if($res==false) return false;
        $list = array();
        foreach ($res as $key=>$val) {
            foreach ($this->columnArr as $keys=>$vals) {
                $list[$key][$vals] = $val->$keys;
            }
        }
        return array_values($list);
    }
}
/**
 *description:系统分类工厂
 *author:yanyalong
 *date:2014/04/02
 */
class SystemClassFactory{
    public function creatObj($classType,$columnArr){
        $SystemClassObj = new SystemClass($classType,$columnArr);
        return $SystemClassObj->getSystemByType();
    }
}

