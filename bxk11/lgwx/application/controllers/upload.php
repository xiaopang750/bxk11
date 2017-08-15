<?php
/*description:上传功能控制器
 *author:yanyalong
 *date:2013/08/01
 */
class Upload extends MY_Controller {
    function __construct(){
        parent::__construct();
    }
    /**
     *description:经销商加盟相关
     *author:yanyalong
     *date:2014/03/20
     */
    public function serviceJoin(){
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';
        $this->config->load('uploads');		
        $config = $this->config->item("serviceJoin");		
        $this->load->library('upload');
        //$_FILES['userfile'] = $_FILES['file'];
        //上传图片文件
        $is_upload = $this->upload->img_upload_file($config);
        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            $imginfo = getimagesize($sourceimg);
            if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
                unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败,宽至少大于".$config['min_width']."高至少大于".$config['min_height']);
                return false;
            }
            $url = $config['relative_path'].$is_upload['upload_data']['file_name'];
            $name = $is_upload['upload_data']['file_name'];
            $this->outPut(0, $cb, $url, $name, "上传成功");
        }
    }

    public function outPut($code, $cb, $url, $name, $msg) {
        $arr = array();
        $arr['url'] = $url;

        $arr['name'] = $name;
        $data = json_encode( $arr );
        echo "<script>window.parent.$cb({err:$code, data:$data, msg:\"$msg\"})</script>"; 
    }
    /**
     *description:经销商门店相关
     *author:yanyalong
     *date:2014/03/20
     */
    public function serviceShop(){
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';
        $this->config->load('uploads');		
        $config = $this->config->item("serviceShop");		
        $this->load->library('upload');
        //上传图片文件
        $is_upload = $this->upload->img_upload_file($config);
        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            $imginfo = getimagesize($sourceimg);
            if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
                unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败,宽至少大于".$config['min_width']."高至少大于".$config['min_height']);
                return false;
            }
            $url = $config['relative_path'].$is_upload['upload_data']['file_name'];
            $name = $is_upload['upload_data']['file_name'];
            $this->outPut(0, $cb, $url, $name, "上传成功");
        }
    }
    /**
     *description:经销商帐号相关
     *author:yanyalong
     *date:2014/03/20
     */
    public function serviceUser(){
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';
        $this->config->load('uploads');		
        $config = $this->config->item("serviceUser");		
        $this->load->library('upload');
        //上传图片文件
        $is_upload = $this->upload->img_upload_file($config);
        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            $imginfo = getimagesize($sourceimg);
            if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
                unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败,宽至少大于".$config['min_width']."高至少大于".$config['min_height']);
                return false;
            }
            $url = $config['relative_path'].$is_upload['upload_data']['file_name'];
            $name = $is_upload['upload_data']['file_name'];
            $this->outPut(0, $cb, $url, $name, "上传成功");
        }
    }
    /**
     *description:经销商品牌授权书
     *author:yanyalong
     *date:2014/03/20
     */
    public function serviceBrandLicense(){
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';
        $this->config->load('uploads');		
        $config = $this->config->item("serviceBrandLicense");		
        $this->load->library('upload');
        //上传图片文件
        $is_upload = $this->upload->img_upload_file($config);
        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            $imginfo = getimagesize($sourceimg);
            if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
                unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败,宽至少大于".$config['min_width']."高至少大于".$config['min_height']);
                return false;
            }
            $url = $config['relative_path'].$is_upload['upload_data']['file_name'];
            $name = $is_upload['upload_data']['file_name'];
            $this->outPut(0, $cb, $url, $name, "上传成功");
        }
    }
    /**
     *description:经销商品牌授权书
     *author:yanyalong
     *date:2014/03/20
     */
    public function serviceApplyBrand(){
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';
        $this->config->load('uploads');		
        $config = $this->config->item("serviceApplyBrand");		
        $this->load->library('upload');
        //上传图片文件
        $is_upload = $this->upload->img_upload_file($config);
        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            //todo 现在不判断大小
            //$imginfo = getimagesize($sourceimg);
            /*if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
                unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败,宽至少大于".$config['min_width']."高至少大于".$config['min_height']);
                return false;
            }*/
            $url = $config['relative_path'].$is_upload['upload_data']['file_name'];
            $name = $is_upload['upload_data']['file_name'];
            $this->outPut(0, $cb, $url, $name, "上传成功");
        }
    }
    /**
     *description:经销商品牌系列
     *author:yanyalong
     *date:2014/03/20
     */
    public function serviceSenes(){
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';
        $this->config->load('uploads');		
        $config = $this->config->item("serviceBrandSeries");		
        $this->load->library('upload');
        //上传图片文件
        $is_upload = $this->upload->img_upload_file($config);
        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            $imginfo = getimagesize($sourceimg);
            if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
                unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败,宽至少大于".$config['min_width']."高至少大于".$config['min_height']);
                return false;
            }
            $url = $config['relative_path'].$is_upload['upload_data']['file_name'];
            $name = $is_upload['upload_data']['file_name'];
            $this->outPut(0, $cb, $url, $name, "上传成功");
        }
    }
    /**
     *description:商品缩略图
     *author:yanyalong
     *date:2014/03/20
     */
    public function serviceGoodsthumb(){
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';
        $this->config->load('uploads');		
        $config = $this->config->item("ServiceSeriesGoodsThumb");		
        $this->load->library('upload');
        //上传图片文件
        $is_upload = $this->upload->img_upload_file($config);
        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            $imginfo = getimagesize($sourceimg);
            if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
                unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败,宽至少大于".$config['min_width']."高至少大于".$config['min_height']);
                return false;
            }
            $url = $config['relative_path'].$is_upload['upload_data']['file_name'];
            $name = $is_upload['upload_data']['file_name'];
            $this->outPut(0, $cb, $url, $name, "上传成功");
        }
    }
    /**
     *description:商品贴面颜色图片
     *author:yanyalong
     *date:2014/03/20
     */
    public function serviceGoodscolor(){
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';
        $this->config->load('uploads');		
        $config = $this->config->item("ServiceSeriesGoodsColor");		
        $this->load->library('upload');
        //上传图片文件
        $is_upload = $this->upload->img_upload_file($config);
        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            $imginfo = getimagesize($sourceimg);
            if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
                unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败,宽至少大于".$config['min_width']."高至少大于".$config['min_height']);
                return false;
            }
            $url = $config['relative_path'].$is_upload['upload_data']['file_name'];
            $name = $is_upload['upload_data']['file_name'];
            $this->outPut(0, $cb, $url, $name, "上传成功");
        }
    }
    /**
     *description:幻灯片
     *author:yanyalong
     *date:2014/04/14
     */
    public function flashpic(){
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';
        $this->config->load('uploads');		
        $config = $this->config->item("serviceFlash");		
        $this->load->library('upload');
        //上传图片文件

        $is_upload = $this->upload->img_upload_file($config);

        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            $imginfo = getimagesize($sourceimg);
            if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
                unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败,宽至少大于".$config['min_width']."高至少大于".$config['min_height']);
                return false;
            }
            $url = $config['relative_path'].$is_upload['upload_data']['file_name'];

            $name = $is_upload['upload_data']['file_name'];
            $this->outPut(0, $cb, $url, $name, "上传成功");
        }
    }
    /**
     *description:微信上传
     *author:yanyalong
     *date:2014/04/21
     */
    public function weixin_top_pic(){
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';
        $this->config->load('uploads');		
        $config = $this->config->item("weixin_pic");		
        $this->load->library('upload');
        $time = time();
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        $timedir = $this->upload->mktimedir($config['upload_path']);
        $config['upload_path']  = $config['upload_path'].$time_relative_path;
        //上传图片文件
        $is_upload = $this->upload->img_upload_file($config);
        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            $imginfo = getimagesize($sourceimg);
            if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
                unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败,宽至少大于".$config['min_width']."高至少大于".$config['min_height']);
                return false;
            }
            $url = $_SERVER['HTTP_HOST'].$config['relative_upload'].$time_relative_path.$is_upload['upload_data']['file_name'];
            $name = $is_upload['upload_data']['file_name'];
            $this->outPut(0, $cb, $url, $name, "上传成功");
        }
    }
    /**
     *description:上传资讯封面
     *author:yanyalong
     *date:2014/05/22
     */
    public function information(){
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:$this->outPut(1, $cb, '','', '参数错误');
        $this->config->load('uploads');		
        $config = $this->config->item("serviceInformation");		
        $this->load->library('upload');
        $config['upload_path']  = $config['upload_path'];
        //上传图片文件
        $is_upload = $this->upload->img_upload_file($config);
        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            $imginfo = getimagesize($sourceimg);
            if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
                unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败,宽至少大于".$config['min_width']."高至少大于".$config['min_height']);
                return false;
            }
            $url = $config['relative_path'].$is_upload['upload_data']['file_name'];
            $name = $is_upload['upload_data']['file_name'];
            $this->outPut(0, $cb, $url, $name, "上传成功");
        }
    }

    /**
     *description:上传资讯封面
     *author:yanyalong
     *date:2014/05/22
     */
    public function albumService(){
        $cb = (isset($_POST['cb']) && $_POST['cb']) ? $_POST['cb'] : 'jia178callBack';
        $service_id= isset($_SESSION['service_id'])?$_SESSION['service_id']:$this->outPut(1, $cb, '','', '参数错误');
        $this->config->load('uploads');     
        $config = $this->config->item("serviceInformationContent"); 
        //$config['max_size'] = '512';       
        $this->load->library('upload');
        $pathStr = $config['upload_path'].$service_id.'/';

        $pathStr = $this->upload->mkdirs($config['upload_path'])?$pathStr:$this->outPut(1, $cb, '','', '创建目录失败');

        $config['upload_path']  = $pathStr;

        //上传图片文件
        $is_upload = $this->upload->img_upload_file($config);
        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            $imginfo = getimagesize($sourceimg);
            //if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
                //unlink($sourceimg);
                //$this->outPut(1, $cb, '','', "上传失败,宽至少大于".$config['min_width']."高至少大于".$config['min_height']);
                //return false;
            //}
            $url = $config['relative_upload'].$service_id.'/'.$is_upload['upload_data']['file_name'];

            $name = $is_upload['upload_data']['file_name'];

            $arr = array();
            $arr['url'] = $url;

            $arr['name'] = $name;
            $msg = "上传成功";

            $document_url = $_SERVER['DOCUMENT_ROOT'].$url; 
            $imginfo =getimagesize($document_url);
            $files['pic_url']= $url; 
            $files['pic_size']= $imginfo['0']."*".$imginfo['1']; 
            $files['pic_kb']= ceil(filesize($document_url)/1024)."KB"; 
            $files['document_url']= $document_url; 
            $files['pic_name']= $name;

            $arr['album_list'] = $files;

            $data = json_encode( $arr );
            echo "<script>window.parent.$cb({err:0, data:$data, msg:\"$msg\"})</script>";exit;
        }
    }
    /**
     *description:上传经销商logo
     *author:yanyalong
     *date:2014/05/22
     */
    public function serviceLogo(){
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';
        $this->config->load('uploads');		
        $config = $this->config->item("serviceLogo");		
        $this->load->library('upload');
        $time = time();
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        $timedir = $this->upload->mktimedir($config['upload_path']);
        $config['upload_path']  = $config['upload_path'].$time_relative_path;
        //上传图片文件
        $is_upload = $this->upload->img_upload_file($config);
        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            $imginfo = getimagesize($sourceimg);
            if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
                unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败,宽至少大于".$config['min_width']."高至少大于".$config['min_height']);
                return false;
            }
            $url = $config['relative_upload'].$time_relative_path.$is_upload['upload_data']['file_name'];
            $name = $is_upload['upload_data']['file_name'];
            $this->outPut(0, $cb, $url, $name, "上传成功");
        }
    }
    /**
     *description:上传商品搭配封面图
     *author:yanyalong
     *date:2014/05/22
     */
    public function goodsmatch(){
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';
        $this->config->load('uploads');		
        $config = $this->config->item("serviceGoodsMatch");		
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';
        $this->load->library('upload');
        //上传图片文件
        $is_upload = $this->upload->img_upload_file($config);
        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            $imginfo = getimagesize($sourceimg);
            if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
                unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败,宽至少大于".$config['min_width']."高至少大于".$config['min_height']);
                return false;
            }
            $url = $config['relative_path'].$is_upload['upload_data']['file_name'];

            $name = $is_upload['upload_data']['file_name'];
            $this->outPut(0, $cb, $url, $name, "上传成功");
        }
    }
    /**
     *description:通用按坐标裁切服务商相关图片
     *author:yanyalong
     *date:2014/06/26
     */
	public function crop_service_pic(){
		$sourceimg= isset($_POST['source'])?$this->input->post('source',true):'';
		$x= $this->input->post('x',true);
		$y= $this->input->post('y',true);
		$cutwidth= $this->input->post('cutwidth',true);
		$cutheight= $this->input->post('cutheight',true);
		$cropimg= $_SERVER['DOCUMENT_ROOT'].$sourceimg;
		$this->load->library('image_lib');	
        if(!file_exists($cropimg)){
			echojson(1,"","未检测到图片");
        }
		$this->load->library('image_lib');	
        $thumb = $this->image_lib->img_crop($cropimg,$x,$y,$cutwidth,$cutheight);
		if($thumb!=false){
			echojson(0,$sourceimg);
		}else{
			echojson(1,"","上传成功，裁切失败");
		}
	}

    /**
     *description:自定义模块上传
     *author:liuguangping
     *date:2014/07/09
     */
    public function wap_template_pic(){
        $service_id = isset($_SESSION['service_id']) && $_SESSION['service_id']?$_SESSION['service_id']:$this->outPut(1, $cb, '','', '请先登入在操作！');
        @$cb = $_POST['cb'] ? $_POST['cb'] : 'jia178callBack';
        $this->config->load('uploads');     
        $config = $this->config->item("serviceLogo");     
        $this->load->library('upload');
        $time = time();
        $time_relative_path = date('Y',$time).'/'.date('m',$time).'/'.date('d',$time).'/';
        $config['upload_path']  = $config['upload_path'].$time_relative_path;

        $timedir = $this->upload->mkdirs($config['upload_path']);
        //上传图片文件
        $is_upload = $this->upload->img_upload_file($config);

        if(empty($is_upload)){
            $this->outPut(1, $cb, '','', '上传的图片失败，图片格式，大小超限制，请正确上传');
            return false;
        }else{
            $sourceimg = $config['upload_path'].$is_upload['upload_data']['file_name'];
            $imginfo = getimagesize($sourceimg);
            if($imginfo[0]!=$config['min_width']||$imginfo[1]!=$config['min_height']){
                unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败,宽度为".$config['min_width']."px,高度为".$config['min_height'])."px";
                return false;
            }
            $url = $config['relative_upload'].$time_relative_path.$is_upload['upload_data']['file_name'];

            $name = $is_upload['upload_data']['file_name'];
            $data['service_wap_template_pic'] = $time_relative_path.$is_upload['upload_data']['file_name'];
            $map['service_id'] = $service_id;
            if(model('t_service_info')->updates_global($data,$map)){
                $this->outPut(0, $cb, $url, $name, "上传成功");
             }else{
                unlink($sourceimg);
                $this->outPut(1, $cb, '','', "上传失败，修改数据库失败！");
                return false;
             }
           
        }
    }   	
}

