<?php
/**
 *description:全局状态配置
 *author:yanyalong
 *date:2014/03/25
 */
//门店相关
//根据状态检索门店操作项
//全部 <50    操作项
//已认证(旗舰店,分店)  1，2  已认证-停业,编辑.停业后变停业(12) 编辑完成后变审核中(11)
//审核中  11  审核中-编辑,取消审核. 编辑完成后状态不变(11)，取消审核后状态变取消审核(14)
//停业  12 停业-目前没有对应项
//审核失败 13 审核失败-重新认证(到编辑页) 失败原因存在shop_explain字段
//取消审核 14  取消审核-重新认证(到编辑页)
$config['service_shop_search']['1'] = "2,3,4,11,12,13,14";
$config['service_shop_search']['2'] = "2";
$config['service_shop_search']['3'] = "3";
$config['service_shop_search']['4'] = "4";
$config['service_shop_search']['5'] = "11";
$config['service_shop_search']['6'] = "12";
$config['service_shop_search']['7'] = "13";

$config['service_shop']['1'] = "全部";
$config['service_shop']['2'] = "已认证";
$config['service_shop']['3'] = "未认证";
$config['service_shop']['4'] = "参与企业认证";
$config['service_shop']['5'] = "审核中";
$config['service_shop']['6'] = "停业";
$config['service_shop']['7'] = "审核失败";

//列表状态显示
//$config['service_shop_status']['1'] = "";  //已认证 
$config['service_shop_status']['2'] = "已认证"; //已认证 
$config['service_shop_status']['3'] = "未认证"; //未认证 
$config['service_shop_status']['4'] = "参与企业认证"; //未认证 
$config['service_shop_status']['11'] = "审核中"; //审核中 
$config['service_shop_status']['12'] = "停业"; //停业 
$config['service_shop_status']['13'] = "审核失败"; //审核失败 

//操作项显示
//$config['service_shop_action']['1'] = "";  //已认证 
$config['service_shop_action']['2'] = "shop_to_brand|shop_down"; //已认证 
$config['service_shop_action']['3'] = "shop_to_brand|shop_down|shop_edit|shop_certified|shop_del"; //未认证 
$config['service_shop_action']['4'] = ""; //参与企业认证
$config['service_shop_action']['11'] = "shop_clear"; //审核中 
$config['service_shop_action']['12'] = "shop_open|shop_del"; //停业 
$config['service_shop_action']['13'] = "shop_to_brand|shop_again_apply|loser_cause|shop_del|shop_down|shop_edit"; //审核失败 

//操作项名称
$config['service_shop_action_name']['shop_edit'] = '编辑';
$config['service_shop_action_name']['shop_again_apply'] = '重新认证';
$config['service_shop_action_name']['shop_del'] = '删除';
$config['service_shop_action_name']['shop_clear'] = '取消认证';
$config['service_shop_action_name']['loser_cause'] = '失败原因';
$config['service_shop_action_name']['shop_certified'] = '认证';
$config['service_shop_action_name']['shop_down'] = '停业';
$config['service_shop_action_name']['shop_open'] = '开业';
$config['service_shop_action_name']['shop_to_brand'] = '经营品牌';



//品牌相关
//根据状态检索品牌操作项
//搜索项
//全部
//已认证
//审核中
//认证到期
//认证失败
$config['apply_brand_search']['1'] = "1,2,3,4,11,12,13";
$config['apply_brand_search']['2'] = "1";
$config['apply_brand_search']['3'] = "2";
$config['apply_brand_search']['4'] = "11";
$config['apply_brand_search']['5'] = "12";
$config['apply_brand_search']['6'] = "13";

$config['apply_brand']['1'] = "全部";
$config['apply_brand']['2'] = "已认证";
$config['apply_brand']['3'] = "未认证";
$config['apply_brand']['4'] = "审核中";
$config['apply_brand']['5'] = "认证到期";
$config['apply_brand']['6'] = "认证失败";

//列表状态显示
//列表项
//已认证  1  下架
//审核中  11  取消审核
//已到期 12  重新认证
//审核失败  13 重新认证|删除[失败原因]
$config['brand_status']['1'] = "已认证";
$config['brand_status']['2'] = "未认证";
$config['brand_status']['3'] = "已下架";
$config['brand_status']['4'] = "参与企业认证";
$config['brand_status']['11'] = "审核中";
$config['brand_status']['12'] = "认证已到期"; 
$config['brand_status']['13'] = "认证失败";  

//操作项显示
$config['brand_action']['1'] = "brand_down";  //下架(删除)
$config['brand_action']['2'] = "brand_edit|brand_certified|brand_down|brand_del";  //认证
$config['brand_action']['3'] = "brand_up|brand_edit|brand_certified|brand_del";  //认证
$config['brand_action']['4'] = "";  //参与企业认证
$config['brand_action']['11'] = "brand_cancel"; //取消审核
$config['brand_action']['12'] = "apply_repeat|brand_del|brand_down"; //重新认证(编辑)
$config['brand_action']['13'] = "apply_repeat|loser_cause|brand_del|brand_down"; //重新认证(编辑)|失败原因|删除

//操作项名称
$config['brand_action_name']['apply_repeat'] = '重新认证';
$config['brand_action_name']['brand_edit'] = '编辑';
$config['brand_action_name']['brand_down'] = '下架';
$config['brand_action_name']['brand_cancel'] = '取消认证';
$config['brand_action_name']['brand_del'] = '删除';
$config['brand_action_name']['loser_cause'] = '失败原因';
$config['brand_action_name']['brand_certified'] = '认证';
$config['brand_action_name']['brand_up'] = '上架';

//全局判断当前页面是否合法配置
$config['brand_edit']['model'] = 't_service_brands_apply';//品牌
$config['brand_edit']['key'] = 'apply_id';
$config['brand_edit']['id_key'] = 'aid';
$config['shop_edit']['model'] = 't_service_shop';//门店
$config['shop_edit']['id_key'] = 'shopid';
$config['shop_edit']['key'] = 'shop_id';
$config['information_edit']['model'] = 't_service_information';//资讯
$config['information_edit']['id_key'] = 'si_id';
$config['information_edit']['key'] = 'si_id';
$config['slide_edit']['model'] = 't_service_wap_slide';//幻灯片
$config['slide_edit']['id_key'] = 'slide_id'; //地址上的标识
$config['slide_edit']['key'] = 'slide_id'; //标识
$config['weixin_edit']['model'] = 't_weixin';//公众号
$config['weixin_edit']['id_key'] = 'wid'; //地址上的标识
$config['weixin_edit']['key'] = 'wid'; //库标识

//wap站品牌搜索配置(不显示已下架)
$config['wap_apply_brand_search']['1'] = "1,2,4,11,12,13";
