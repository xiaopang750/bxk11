<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:门店管理
 *author:yanyalong
 *date:2014/03/25
 */
class ShopManage{
    public $shopInfo;
    public function __construct($shopInfo){
        $this->shopInfo = $shopInfo;
        $this->CI = &get_instance();
        $this->CI->load->model('t_service_shop_model');
        loadLib('ServiceUserAccess');
        $this->actionList = ServiceUserAccessFactory::getActionUrlList();
    }
    /**
     *description:取消门店申请
     *author:yanyalong
     *date:2014/03/25
     */
    public function clearstatus(){
        $url = $this->actionList->shop_list;
        if($this->CI->t_service_shop_model->updateStatus($this->shopInfo->shop_id,3)){
           echo "<script>alert('取消成功！'); window.location='$url'</script>";exit;
        }else{
            echo "<script>alert('取消失败！'); window.location='$url'</script>";exit;
        }
    }
    /**
     *description:删除门店
     *author:yanyalong
     *date:2014/03/25
     */
    public function delShop(){
        $url = $this->actionList->shop_list;
        if($this->CI->t_service_shop_model->updateStatus($this->shopInfo->shop_id,99)){
            echojson(0,"","操作成功！");
        }else{
            echojson(1,"","操作失败！");
        }

    }
    /**
     *description:门店停业
     *author:yanyalong
     *date:2014/03/25
     */
    public function downShop(){
        $url = $this->actionList->shop_list;
        if($this->CI->t_service_shop_model->updateStatus($this->shopInfo->shop_id,12)){
        $url = $this->actionList->shop_list;
            echojson(0,$this->actionList->shop_edit.'&shopid='.$this->shopInfo->shop_id,"操作成功！");
        }else{
            echojson(1,"","操作失败！");
        }

    }
}


/**
 *description:门店管理工厂
 *author:yanyalong
 *date:2014/03/25
 */
class ShopManageFactory{
    private static $shopManageObj;
    public function creatObj($shopInfo){
        $this->shopManageObj = new ShopManage($shopInfo);
    }
    public function clearStatusShop(){
        $this->shopManageObj->clearstatus();
    }
    public function delShop(){
        $this->shopManageObj->delShop();
    }
    public function downShop(){
        $this->shopManageObj->downShop();
    }
}

