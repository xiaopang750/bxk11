<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:资讯管理
 *author:yanyalong
 *date:2014/04/21
 */
class  Information extends   MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("t_service_information_model");
    }
    /**
     *description:添加资讯
     *author:yanyalong
     *date:2014/04/21
     */
    public function add(){
        $this->CheckAccessByKey('information_add');
        //safeFilter();
        $service_id= (isset($_SESSION['service_id']))?$_SESSION['service_id']:echojson(1,"","操作异常，缺少登录状态参数");
        $si_title= isset($_POST['si_title'])?$_POST['si_title']:echojson(1,"","资讯标题不能为空");
        if((strlen(trim($si_title)) + mb_strlen(trim($si_title),'UTF8'))/2>50) echojson(1,"","请输入不超过25个字的资讯标题");
        $si_author= isset($_POST['si_author'])?$_POST['si_author']:echojson(1,"","资讯作者不能为空");
        if((strlen(trim($si_author)) + mb_strlen(trim($si_author),'UTF8'))/2>20) echojson(1,"","请输入不超过10个字的资讯作者");
        $si_desc= isset($_POST['si_desc'])?$_POST['si_desc']:echojson(1,"","摘要不能为空");
        if((strlen(trim($si_desc)) + mb_strlen(trim($si_desc),'UTF8'))/2>300) echojson(1,"","请输入不超过120个字");
        $_si_pic= isset($_POST['si_pic'])?$_POST['si_pic']:echojson(1,"","资讯封面图片不能为空");
        $it_id= isset($_POST['it_id'])?$_POST['it_id']:echojson(1,"","请选择资讯分类");
        $si_content= isset($_REQUEST['si_content'])?$_REQUEST['si_content']:echojson(1,"","资讯内容不能为空");
        $isshow= (isset($_POST['isshow'])&&intval($_POST['isshow'])==1)?1:0;
        if($_si_pic==""||(!file_exists($_SERVER['DOCUMENT_ROOT'].$_si_pic))) echojson(1,"","必须上传图片"); 
        $this->load->library('upload');
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $this->config->load('uploads');	
        $this->load->library('image_lib');
        $config = $this->config->item("serviceInformation");
        $timedir = $this->upload->mktimedir($config['service_path']);
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        $this->upload->mktimedir($config['service_path']);
        $si_pic= basename($_si_pic);
        $si_pic_flag = (file_exists($_SERVER['DOCUMENT_ROOT'].$_si_pic))?(copy($_SERVER['DOCUMENT_ROOT'].$_si_pic,$timedir.$si_pic)):false;
        $this->load->library('image_lib');	
        $sourceimg = $config['service_path'].$time_relative_path.$si_pic;
        $this->upload->mktimedir($config['thumb_1']);
        $this->upload->mktimedir($config['thumb_2']);
        $this->upload->mktimedir($config['thumb_3']);
        $this->upload->mktimedir($config['thumb_4']);
        ($this->image_lib->information_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
        $this->t_service_information_model->si_pic= ($si_pic_flag==false)?"":$time_relative_path.$si_pic;
        $this->t_service_information_model->si_title = $si_title;
        $this->t_service_information_model->si_author = $si_author;
        $this->t_service_information_model->service_id= $service_id;
        $this->t_service_information_model->it_id= $it_id;
        $this->t_service_information_model->si_content = htmlspecialchars($si_content);
        $this->t_service_information_model->si_status=1;
        $this->t_service_information_model->si_desc = $si_desc;
        $this->t_service_information_model->si_likes=0;
        $this->t_service_information_model->si_views=0;
        $this->t_service_information_model->si_wap_isshow=$isshow;
        $this->t_service_information_model->si_keyword="";
        $si_id = $this->t_service_information_model->insert();
        $url = $this->actionList->information_list;
        ($si_id!=false)?echojson(0,$url,"添加成功"):echojson(1,"","添加失败");
    }

    /**
     *description:删除资讯
     *author:yanyalong
     *date:2014/04/21
     */
    public function del(){
        $this->CheckAccessByKey('information_edit');
        //safeFilter();
        $si_id= isset($_POST['si_id'])?$_POST['si_id']:echojson(1,"","操作异常");
        $data['si_status'] = "99";
        $updateFlag = $this->t_service_information_model->updates_global($data,array('si_id'=>$si_id));
        $url = $this->actionList->information_list;
        ($updateFlag)?echojson(0,$url,"删除成功"):echojson(1,"","删除失败");
    }
    /**
     *description:编辑资讯
     *author:yanyalong
     *date:2014/04/21
     */
    public function edit(){
        $this->CheckAccessByKey('information_edit');
        //safeFilter();
        $service_id= (isset($_SESSION['service_id']))?$_SESSION['service_id']:echojson(1,"","操作异常，缺少登录状态参数");
        $si_id= isset($_POST['si_id'])?$_POST['si_id']:echojson(1,"","异常操作，未检测到资讯id");
        $si_title= isset($_POST['si_title'])?$_POST['si_title']:echojson(1,"","资讯标题不能为空");
        if((strlen(trim($si_title)) + mb_strlen(trim($si_title),'UTF8'))/2>50) echojson(1,"","请输入不超过25个字的资讯标题");
        $si_desc= isset($_POST['si_desc'])?$_POST['si_desc']:echojson(1,"","摘要不能为空");
        if((strlen(trim($si_desc)) + mb_strlen(trim($si_desc),'UTF8'))/2>300) echojson(1,"","请输入不超过120个字的摘要信息");
        $si_author= isset($_POST['si_author'])?$_POST['si_author']:echojson(1,"","资讯作者不能为空");
        if((strlen(trim($si_author)) + mb_strlen(trim($si_author),'UTF8'))/2>20) echojson(1,"","请输入不超过10个字的资讯作者");
        $it_id= isset($_POST['it_id'])?$_POST['it_id']:echojson(1,"","请选择资讯分类");
        $si_content= isset($_REQUEST['si_content'])?$_REQUEST['si_content']:echojson(1,"","资讯内容不能为空");
        $isshow= (isset($_POST['isshow'])&&intval($_POST['isshow'])==1)?1:0;
        $_si_pic= isset($_POST['si_pic'])?$_POST['si_pic']:echojson(1,"","资讯封面图片不能为空");
        if($_si_pic==""||(!file_exists($_SERVER['DOCUMENT_ROOT'].$_si_pic))) echojson(1,"","必须上传资讯封面"); 
        $information_info = $this->t_service_information_model->get($si_id);       
        $this->load->library('upload');
        $time = time();
        $joinTime = date('Y-m-d H:i:s',$time);
        $this->config->load('uploads');	
        $this->load->library('image_lib');
        $config = $this->config->item("serviceInformation");
        $timedir = $this->upload->mktimedir($config['service_path']);
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        $this->upload->mktimedir($config['service_path']);
        $si_pic= basename($_si_pic);
        if(basename($information_info->si_pic)!=$si_pic){
        $si_pic_flag = (file_exists($_SERVER['DOCUMENT_ROOT'].$_si_pic))?(copy($_SERVER['DOCUMENT_ROOT'].$_si_pic,$timedir.$si_pic)):false;
        $this->load->library('image_lib');	
        $sourceimg = $config['service_path'].$time_relative_path.$si_pic;
        $this->upload->mktimedir($config['thumb_1']);
        $this->upload->mktimedir($config['thumb_2']);
        $this->upload->mktimedir($config['thumb_3']);
        $this->upload->mktimedir($config['thumb_4']);
        ($this->image_lib->information_thumb($sourceimg,$time_relative_path)==false)?echojson(1,"","图片裁切失败"):"";	
        $data['si_pic'] = ($si_pic_flag==false)?"":$time_relative_path.$si_pic;
        }
        $data['si_title'] = $si_title;
        $data['si_desc'] = $si_desc;
        $data['si_author'] = $si_author;
        $data['si_content'] = htmlspecialchars($si_content);
        $data['it_id'] = $it_id;
        $data['si_wap_isshow'] = $isshow;
        $updateFlag = $this->t_service_information_model->updates_global($data,array('si_id'=>$si_id));
        $url = $this->actionList->information_list;
        ($updateFlag)?echojson(0,$url,"编辑成功"):echojson(1,"","编辑失败");
    }
}

