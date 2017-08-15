<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class areaList{
    function __construct(){
        $this->CI = &get_instance();
        $this->CI->load->model('t_system_district_model');
    }
    /**
     *description:根据选中信息获取省份城市信息
     *author:yanyalong
     *date:2014/03/21
     */
    public function getAreaList($province="",$city=""){
        //所在地区开始
        $this->CI->t_system_district_model->district_pcode = "0";
        $district_province= $this->CI->t_system_district_model->getDepthByPcode();
        $province_select = ($province!="")?$province:$district_province[0]['district_code'];
        $this->CI->t_system_district_model->district_pcode=$province_select;
        $district_city= $this->CI->t_system_district_model->getDepthByPcode();
        $city_select= ($city!="")?$city:$district_city[0]['district_code'];
        foreach ($district_province as $key=>$val) {
            if(in_array($province_select,$val)){
                $district_province[$key]['select'] = "1";	
            }
            continue;
        }
        foreach ($district_city as $key=>$val) {
            if(in_array($city_select,$val)){
                $district_city[$key]['select'] = "1";	
            }
            continue;
        }
        $area['province'] = $district_province;
        $area['city'] = $district_city;
        return $area;
    }
}

class areaListByPcode{
    private $district_pcode;
    function __construct($district_pcode){
        $this->district_pcode = $district_pcode;
        $this->CI = &get_instance();
        $this->CI->load->model('t_system_district_model');
    }
    /**
     *description:根据省份区号获取地区列表信息
     *author:yanyalong
     *date:2014/03/21
     */
    public function getdistrict(){
        $this->CI->t_system_district_model->district_pcode = $this->district_pcode;
        $res = $this->CI->t_system_district_model->getDepthByPcode();
        if($res==false){
            echojson(1,"",'无相关结果');
        }else{
            echojson(0,$res);
        }
    }
}
class areaListByCode{
    private $district_code;
    private $district_info;
    function __construct($district_code){
        $this->district_code = $district_code;
        $this->CI = &get_instance();
        $this->CI->load->model('t_system_district_model');
    }
    /**
     *description:根据据子地区获取地区信息
     *author:yanyalong
     *date:2014/03/25
     */
    public function DistrictInfo(){
        $this->CI->t_system_district_model->district_code=$this->district_code;
        $this->district_info= $this->CI->t_system_district_model->getInfoByCode(); 
    }
    public function getDistrictInfo(){
        $this->DistrictInfo();
        return $this->district_info;
    }
}
class GetAreaListFactory{
    public function getAreaList($province_select="",$city_select=""){
        $areaList = new areaList();
        return $areaList->getAreaList($province_select,$city_select);
    }
    public function getAreaListByPcode($district_pcode){
        $areaListByPcode = new areaListByPcode($district_pcode);
        $areaListByPcode->getdistrict();
    }
    public function getAreaInfoByCode($district_code){
        $areaListByCode= new areaListByCode($district_code);
        return $areaListByCode->getDistrictInfo();
    }
}

