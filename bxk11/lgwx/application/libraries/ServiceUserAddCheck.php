<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class ServiceUserAddCheckFactory{
    public static function createObj(){
        $obj = new UserAddCheck($_POST);
        if($obj instanceof UserAddCheckAbstract){
            return $obj->postCheck();
        }else{
            return false;	
        }
    }
}

//抽象类
abstract class UserAddCheckAbstract{
    public $post;
    public $user_id;
    abstract public function postCheck();
    public function __construct($post){
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_user_model');
        $this->post= $post;
    }
}

/**
 *description:检测经销商添加用户表单提交数据
 *author:yanyalong
 *date:2014/03/20
 */
class UserAddCheck extends UserAddCheckAbstract{
    //检测装修案例提交数据
    public function postCheck(){
            $is_manage = isset($_SESSION['is_manage'])?$_SESSION['is_manage']:'';
            if($is_manage!=true){
        $user_shop= (isset($this->post['user_shop'])||$this->post['user_shop']!="")?$this->post['user_shop']:echojson(1,"","至少选择一个门店");
        $user_module= (isset($this->post['user_module'])||$this->post['user_module']!="")?$this->post['user_module']:echojson(1,"","您至少需要为您添加的子帐号选择一项权限");
            }
        $user_phone= (isset($this->post['user_phone'])||$this->post['user_phone']!="")?$this->post['user_phone']:echojson(1,"","负责人电话不能为空");
        if(!preg_match('/^((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)$/',$user_phone)){
            echojson(1,"","电话号格式错误");
        }
    }
}

