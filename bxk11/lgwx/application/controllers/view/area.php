<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:地区相关数据获取控制器
 *author:yanyalong
 *date:2014/03/20
 */
class area extends  MY_Controller {
    function __construct(){
        parent::__construct();
    }
    /**
     *description:获取省份城市信息
     *author:yanyalong
     *date:2014/03/21
     */
    public function index(){
        safeFilter();
        loadLib('Area');
        $areaList = GetAreaListFactory::getAreaList();
        echojson("0",$areaList); 
    }
    /**
     *description:根据省份区号获取地区列表信息
     *author:yanyalong
     *date:2014/03/21
     */
    public function getdistrict(){
        safeFilter();
        loadlib('Area');
        $district_pcode= $this->input->post('district_pcode',true);
        GetAreaListFactory::getarealistbypcode($district_pcode);
    }
}
