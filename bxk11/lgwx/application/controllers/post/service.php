<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:企业信息
 *author:yanyalong
 *date:2014/04/08
 */
class  service extends  MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("t_service_wap_slide_model");
        $this->load->model('t_service_info_model');
        $this->load->model('t_service_information_model');
        loadLib('ServiceUserAccess');
        $this->actionList = ServiceUserAccessFactory::getActionUrlList();
    }
    /**
     *description:企业基本信息设置
     *author:yanyalong
     *date:2014/05/06
     */
    public function serviceSet(){
        $this->CheckAccessByKey('service_set');
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:'';
        $res = $this->t_service_info_model->get($service_id);
        if($res==false) echojson(1,"","数据异常");
        //if($res->service_status==22)  echojson(1,"","亲爱的用户,您当前申请了企业认证，在审核期间不能进行此操作哦！");
        loadLib('ServiceSet');
        ServiceSetCheckFactory::createobj();
        $data['service_company']= $_POST['service_company'];
        $data['service_email'] = $_POST['service_email'];
        $data['service_license_code'] = $_POST['service_license_code'];
        $data['service_organization_code'] = $_POST['service_organization_code'];
        $data['service_person'] = $_POST['service_person'];
        $data['service_person_work'] = $_POST['service_person_work'];
        $data['service_person_phone'] = $_POST['service_person_phone'];
        $data['service_desc']= $_POST['service_desc'];
        $data['service_logo'] = $_POST['service_logo'];
        $updateFlag = $this->t_service_info_model->updates_global($data,array('service_id'=>$service_id));
        ($updateFlag!=false)?echojson(0,$this->actionList->service_set,"操作成功"):echojson(1,$this->actionList->service_set,"操作失败");
    }
    /**
     *description:新增幻灯片页面数据
     *author:yanyalong
     *date:2014/05/25
     */
    public function slide_add(){
        //幻灯片标题名称
        if($_POST['slide_title']==""){
            echojson(1,"","幻灯片标题不能为空");
        }
        if((strlen(trim($_POST['slide_title'])) + mb_strlen(trim($_POST['slide_title']),'UTF8'))/2>50){
            echojson(1,"","幻灯片标题不能超过25个字");
        }
        if($_POST['slide_type']==""){
            echojson(1,"","幻灯片类型无法识别");
        }
        if($_POST['slide_url']==""){
            echojson(1,"","幻灯片链接地址不能为空");
        }
        if($_POST['shop_id']==""){
            echojson(1,"","请选择门店");
        }
        $service_id = $_SESSION['service_id'];
        $res = $this->t_service_wap_slide_model->getSlideListByService($service_id,0,$_POST['shop_id']);
        if(!$this->isOnlyOne($service_id,$_POST['shop_id'],$_POST['slide_title'])) echojson(1,"","对不起，该门店下以有这个幻灯片，不能重复添加！");
        if(count($res)>4) echojson(1,"","对不起，您最多只能添加五条幻灯片数据");
        $_slide_pic = $_POST['slide_pic'];
        if($_slide_pic==""||(!file_exists($_SERVER['DOCUMENT_ROOT'].$_slide_pic))) echojson(1,"","必须上传图片"); 
        $this->load->library('upload');
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $this->config->load('uploads');	
        $this->load->library('image_lib');
        $config = $this->config->item("serviceFlash");
        $timedir = $this->upload->mktimedir($config['service_path']);
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        $this->upload->mktimedir($config['service_path']);
        $slide_pic= basename($_slide_pic);
        $slide_pic_flag = (file_exists($_SERVER['DOCUMENT_ROOT'].$_slide_pic))?(copy($_SERVER['DOCUMENT_ROOT'].$_slide_pic,$timedir.$slide_pic)):false;
        $this->load->library('image_lib');	
        $sourceimg = $config['service_path'].$time_relative_path.$slide_pic;
        $this->upload->mktimedir($config['thumb_1']);
        $this->upload->mktimedir($config['thumb_2']);
        ($this->image_lib->service_flash_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
        $this->t_service_wap_slide_model->slide_pic= ($slide_pic_flag==false)?"":$time_relative_path.$slide_pic;
        $this->t_service_wap_slide_model->slide_title = $_POST['slide_title'];
        $this->t_service_wap_slide_model->slide_url = $_POST['slide_url'];
        $this->t_service_wap_slide_model->service_id = $service_id;
        $this->t_service_wap_slide_model->slide_type = $_POST['slide_type'];
        $this->t_service_wap_slide_model->slide_default = 0;
        $this->t_service_wap_slide_model->shop_id= $_POST['shop_id'];
        $slide_id = $this->t_service_wap_slide_model->insert();
        $url = $this->actionList->slide_list."&shop_id=".$_POST['shop_id'];
        if($slide_id!=false) echojson(0,$url,"添加成功");
        else echojson(1,$url,"添加失败");
    }
    /**
     *description:幻灯片名称唯一性
     *author:yanyalong
     *date:2014/05/25
     */
    public function isOnlyOne($service_id,$shop_id,$slide_title,$slide_id=false){
        //编辑
        $where['slide_title'] = $slide_title;
        $where['service_id'] = $service_id;
        $where['shop_id'] = $shop_id;
        if($slide_id){
            $where['slide_id'] = $slide_id;
            $res = $this->t_service_wap_slide_model->getArray('slide_id',$where);
            foreach ($res as $key => $value) {
                if($value->slide_id != $slide_id){
                    return false;
                }else{
                    return true;
                }
            }
        }else{
            $res = $this->t_service_wap_slide_model->getOne('slide_id',$where);
            if($res){
                return false;
            }else{
                return true;
            }
        }
    }
    /**
     *description:编辑幻灯片
     *author:yanyalong
     *date:2014/05/25
     */
    public function slide_edit(){
        $slide_id = (isset($_POST['slide_id']))?$_POST['slide_id']:echojson(1,"","参数错误");
        $shop_id = (isset($_POST['shop_id']))?$_POST['shop_id']:echojson(1,"","参数错误");
        //幻灯片标题名称
        if($_POST['slide_title']==""){
            echojson(1,"","幻灯片标题不能为空");
        }
        if((strlen(trim($_POST['slide_title'])) + mb_strlen(trim($_POST['slide_title']),'UTF8'))/2>50){
            echojson(1,"","幻灯片标题不能超过25个字");
        }
        if($_POST['slide_type']==""){
            echojson(1,"","幻灯片类型无法识别");
        }
        if($_POST['slide_url']==""){
            echojson(1,"","幻灯片链接地址不能为空");
        }
        if($_POST['shop_id']==""){
            echojson(1,"","请选择门店");
        }
        $res = $this->t_service_wap_slide_model->get($slide_id);
        $service_id = $_SESSION['service_id'];
        if(!$this->isOnlyOne($service_id,$shop_id,$_POST['slide_title'],$slide_id)) echojson(1,"","对不起，该门店下以有这个幻灯片，不能重复添加！");
        $_slide_pic = $_POST['slide_pic'];
        if($_slide_pic==""||(!file_exists($_SERVER['DOCUMENT_ROOT'].$_slide_pic))) echojson(1,"","必须上传图片"); 
        $slide_pic= basename($_slide_pic);
        if(basename($res->slide_pic)!=$slide_pic){
            $this->load->library('upload');
            $time = time();
            $joinTime = date('Y-m-d H:i:s',$time);
            $this->config->load('uploads');	
            $this->load->library('image_lib');
            $config = $this->config->item("serviceFlash");
            $timedir = $this->upload->mktimedir($config['service_path']);
            $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
            $this->upload->mktimedir($config['service_path']);
            $slide_pic= basename($_slide_pic);
            $slide_pic_flag = (file_exists($_SERVER['DOCUMENT_ROOT'].$_slide_pic))?(copy($_SERVER['DOCUMENT_ROOT'].$_slide_pic,$timedir.$slide_pic)):false;
            $this->load->library('image_lib');	
            $sourceimg = $config['service_path'].$time_relative_path.$slide_pic;
            $this->upload->mktimedir($config['thumb_1']);
            $this->upload->mktimedir($config['thumb_2']);
            ($this->image_lib->service_flash_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
            $data['slide_pic'] = ($slide_pic_flag==false)?"":$time_relative_path.$slide_pic;
        }
        $data['slide_title']= $_POST['slide_title'];
        $data['slide_url']= $_POST['slide_url'];
        $data['slide_type']= $_POST['slide_type'];
        $data['shop_id']= $_POST['shop_id'];
        $res = $this->t_service_wap_slide_model->updates_global($data,array('slide_id'=>$slide_id));
        $url = $this->actionList->slide_list."&shop_id=".$shop_id;
        if($res!=false) echojson(0,$url,"编辑成功");
        else echojson(1,$url,"编辑失败");
    }
    /**
     *description:删除幻灯片
     *author:yanyalong
     *date:2014/05/25
     */
    public function slide_del(){
        $slide_id = (isset($_POST['slide_id']))?$_POST['slide_id']:echojson(1,"","参数错误");
        $res = $this->t_service_wap_slide_model->delete($slide_id);
        $url = $this->actionList->slide_list;
        if($res!=false) echojson(0,$url,"删除成功");
        else echojson(1,$url,"删除失败");
    }
    /**
     *description:为幻灯片选择资讯
     *author:yanyalong
     *date:2014/05/26
     */
    public function slide_information_select(){
        $si_id= (isset($_POST['si_id']))?$_POST['si_id']:echojson(1,"","参数错误");
        $res = $this->t_service_information_model->get($si_id);
        $this->config->load('wap_url');		
        $wap_config = $this->config->item("wap");
        $data['slide_url'] = $wap_config['informationinfo']."&service_id=".$_SESSION['service_id']."&si_id=".$res->si_id;
        $this->config->load('uploads');
        $silde_config = $this->config->item("serviceInformation");      
        $data['slide_pic'] = $silde_config['relative_upload'].$res->si_pic;
        $data['slide_thumb'] = $silde_config['relative_thumb_1_path'].$res->si_pic;
        $data['slide_type'] = "1";
        echojson(0,$data);
    }
}

