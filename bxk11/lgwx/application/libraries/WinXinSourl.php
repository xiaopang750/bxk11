<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class WinXinSourlClass{
    //public $openid;
    public $service_id;
    public $sourl;
    public function  __construct() {
        $this->service_id = isset($_POST['service_id'])?$_POST['service_id']:'';    
        if($this->service_id==""){
            echojson(1,"","参数异常,缺少service_id");
        }
        $this->sourl();
    }
    public function sourl(){
        $this->sourl = "&service_id=".$this->service_id;
        return $this->sourl;
    }
}
