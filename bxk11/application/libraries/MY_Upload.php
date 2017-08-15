<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @description CI上传类库扩展类，用以实现实际业务逻辑
 * @author		yanyl
 */
class MY_Upload extends CI_Upload{
	public function __construct(){
        $this->CI = &get_instance();
        $this->CI->config->load('upload_dircheck');		
        $dirCheckConfig= $this->CI->config->item("updateDirCheck");
        foreach ($dirCheckConfig as $key=>$val) {
            if(!file_exists($val)){
                mkdir($val);
            }
        }
		parent::__construct();
	}
	/**
	 *author:yanyl
	 *description:图片上传功能
	 **/
	public function img_upload_file($config){
		$this->initialize($config);
		if (!$this->do_upload()){
			return false;
		}else{
			$data = array('upload_data' => $this->data());
			return $data;
		}
	}

	/**
	 *author:yanyl
	 *description:swf图片上传功能
	 **/
	public function swf_upload_file($config,$type){
		switch ($type) {
		case 'blog':
			$this->blogdir();
			break;
		case 'apartment':
			$tempdir = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/';
			$temp_apartmentdir = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/apartment';
			if(!file_exists($tempdir)){
				mkdir($tempdir);
			}
			if(!file_exists($temp_apartmentdir)){
				mkdir($temp_apartmentdir);
			}
			break;
		}
		$this->initialize($config);
		if (!$this->swf_do_upload()){
			return false;
		}else{
			$data = array('upload_data' => $this->data());
			return $data;
		}
	}
	/**
	 *description:创建不存在的目录
	 *author:yanyalong
	 *date:2013/12/13
	 */
	public function blogdir(){
		$blogdir = $_SERVER['DOCUMENT_ROOT'].'/uploads/blog/source/';
		$thumb_1_dir = $_SERVER['DOCUMENT_ROOT'].'/uploads/blog/thumb_1/';
		$thumb_2_dir = $_SERVER['DOCUMENT_ROOT'].'/uploads/blog/thumb_2/';
		$thumb_3_dir = $_SERVER['DOCUMENT_ROOT'].'/uploads/blog/thumb_3/';
		$thumb_4_dir = $_SERVER['DOCUMENT_ROOT'].'/uploads/blog/thumb_4/';
		//若不存在时间目录则新建
		$this->mktimedir($blogdir);
		$this->mktimedir($thumb_1_dir);
		$this->mktimedir($thumb_2_dir);
		$this->mktimedir($thumb_3_dir);
		$this->mktimedir($thumb_4_dir);
	}
	/**
	 *description:创建年月日目录
	 *author:yanyalong
	 *date:2013/12/13
	 */
	function mktimedir($dir){
		$datedir = date("Y").'/'.date("m").'/'.date("d").'/';
		$year = date('Y');
		$month = date('m');
		$day = date('d');
		if(!file_exists($dir.$year)){
			mkdir($dir.$year);
		}
		if(!file_exists($dir.$year.'/'.$month)){
			mkdir($dir.$year.'/'.$month);
		}
		if(!file_exists($dir.$datedir)){
			mkdir($dir.$datedir);
		}
	}

	// --------------------------------------------------------------------

	/**
	 *description:重写do_opload函数
	 *author:yanyalong
	 *date:2013/12/05
	 */
	public function swf_do_upload($field = 'userfile')
	{

		// Is $_FILES[$field] set? If not, no reason to continue.
		if ( ! isset($_FILES[$field]))
		{
			$this->set_error('upload_no_file_selected');
			return FALSE;
		}
		// Is the upload path valid?
		if ( ! $this->validate_upload_path())
		{
			// errors will already be set by validate_upload_path() so just return FALSE
			return FALSE;
		}

		// Was the file able to be uploaded? If not, determine the reason why.
		if ( ! is_uploaded_file($_FILES[$field]['tmp_name']))
		{
			$error = ( ! isset($_FILES[$field]['error'])) ? 4 : $_FILES[$field]['error'];

			switch($error)
			{
			case 1:	// UPLOAD_ERR_INI_SIZE
				$this->set_error('upload_file_exceeds_limit');
				break;
			case 2: // UPLOAD_ERR_FORM_SIZE
				$this->set_error('upload_file_exceeds_form_limit');
				break;
			case 3: // UPLOAD_ERR_PARTIAL
				$this->set_error('upload_file_partial');
				break;
			case 4: // UPLOAD_ERR_NO_FILE
				$this->set_error('upload_no_file_selected');
				break;
			case 6: // UPLOAD_ERR_NO_TMP_DIR
				$this->set_error('upload_no_temp_directory');
				break;
			case 7: // UPLOAD_ERR_CANT_WRITE
				$this->set_error('upload_unable_to_write_file');
				break;
			case 8: // UPLOAD_ERR_EXTENSION
				$this->set_error('upload_stopped_by_extension');
				break;
			default :   $this->set_error('upload_no_file_selected');
				break;
			}

			return FALSE;
		}


		// Set the uploaded data as class variables
		$this->file_temp = $_FILES[$field]['tmp_name'];
		$this->file_size = $_FILES[$field]['size'];
		$this->_file_mime_type($_FILES[$field]);
		$this->file_type = preg_replace("/^(.+?);.*$/", "\\1", $this->file_type);
		$this->file_type = strtolower(trim(stripslashes($this->file_type), '"'));
		$this->file_name = $this->_prep_filename($_FILES[$field]['name']);
		$this->file_ext	 = $this->get_extension($this->file_name);
		$this->client_name = $this->file_name;

		// Is the file type allowed to be uploaded?
		if ( ! $this->is_allowed_filetype(true)) //此处填入true可避免格式检测错误 
		{
			$this->set_error('upload_invalid_filetype');
			return FALSE;
		}

		// if we're overriding, let's now make sure the new name and type is allowed
		if ($this->_file_name_override != '')
		{
			$this->file_name = $this->_prep_filename($this->_file_name_override);

			// If no extension was provided in the file_name config item, use the uploaded one
			if (strpos($this->_file_name_override, '.') === FALSE)
			{
				$this->file_name .= $this->file_ext;
			}

			// An extension was provided, lets have it!
			else
			{
				$this->file_ext	 = $this->get_extension($this->_file_name_override);
			}

			if ( ! $this->is_allowed_filetype(TRUE))
			{
				$this->set_error('upload_invalid_filetype');
				return FALSE;
			}
		}

		// Convert the file size to kilobytes
		if ($this->file_size > 0)
		{
			$this->file_size = round($this->file_size/1024, 2);
		}

		// Is the file size within the allowed maximum?
		if ( ! $this->is_allowed_filesize())
		{
			$this->set_error('upload_invalid_filesize');
			return FALSE;
		}

		// Are the image dimensions within the allowed size?
		// Note: This can fail if the server has an open_basdir restriction.
		if ( ! $this->is_allowed_dimensions())
		{
			$this->set_error('upload_invalid_dimensions');
			return FALSE;
		}

		// Sanitize the file name for security
		$this->file_name = $this->clean_file_name($this->file_name);

		// Truncate the file name if it's too long
		if ($this->max_filename > 0)
		{
			$this->file_name = $this->limit_filename_length($this->file_name, $this->max_filename);
		}

		// Remove white spaces in the name
		if ($this->remove_spaces == TRUE)
		{
			$this->file_name = preg_replace("/\s+/", "_", $this->file_name);
		}

		/*
		 * Validate the file name
		 * This function appends an number onto the end of
		 * the file if one with the same name already exists.
		 * If it returns false there was a problem.
		 */
		$this->orig_name = $this->file_name;

		if ($this->overwrite == FALSE)
		{
			$this->file_name = $this->set_filename($this->upload_path, $this->file_name);

			if ($this->file_name === FALSE)
			{
				return FALSE;
			}
		}

		/*
		 * Run the file through the XSS hacking filter
		 * This helps prevent malicious code from being
		 * embedded within a file.  Scripts can easily
		 * be disguised as images or other file types.
		 */
		if ($this->xss_clean)
		{
			if ($this->do_xss_clean() === FALSE)
			{
				$this->set_error('upload_unable_to_write_file');
				return FALSE;
			}
		}

		/*
		 * Move the file to the final destination
		 * To deal with different server configurations
		 * we'll attempt to use copy() first.  If that fails
		 * we'll use move_uploaded_file().  One of the two should
		 * reliably work in most environments
		 */
		if ( ! @copy($this->file_temp, $this->upload_path.$this->file_name))
		{
			if ( ! @move_uploaded_file($this->file_temp, $this->upload_path.$this->file_name))
			{
				$this->set_error('upload_destination_error');
				return FALSE;
			}
		}

		/*
		 * Set the finalized image dimensions
		 * This sets the image width/height (assuming the
		 * file was an image).  We use this information
		 * in the "data" function.
		 */
		$this->set_image_properties($this->upload_path.$this->file_name);

		return TRUE;
	}


	/**
	 *description:创建平面布置图所需目录
	 *author:yanyalong
	 *date:2013/12/13
	 */
	public function floor_pic1($scheme_id,$floor_id){
		$picdir[0]= $_SERVER['DOCUMENT_ROOT'].'/uploads/scheme/';
		$picdir[1]= $picdir[0].ceil($scheme_id/1000).'/';
		$picdir[2]= $picdir[1].$scheme_id.'/';
		$picdir[3]= $picdir[2].$floor_id.'/';
		//若不存在时间目录则新建
		foreach($picdir as $key=>$val){
			$this->makedir($val);
		}
		$picurl = '/uploads/scheme/'.ceil($scheme_id/1000).'/'.$scheme_id.'/'.$floor_id.'/';
		return $picurl;
	}
	/**
	 *description:创建平面效果图所需目录
	 *author:yanyalong
	 *date:2013/12/13
	 */
	public function room_2d($room_id){
		$picdir[0]= $_SERVER['DOCUMENT_ROOT'].'/uploads/room/source/';
		$picdir[1]= $picdir[0].ceil($room_id/1000).'/';
		$picdir[2]= $picdir[1].$room_id.'/';
		//若不存在时间目录则新建
		foreach($picdir as $key=>$val){
			$this->makedir($val);
		}
		$picurl = '/uploads/room/source/'.ceil($room_id/1000).'/'.$room_id.'/';
		return $picurl;
	}
	public function makedir($dir){
		if(!file_exists($dir)){
			mkdir($dir);
		}
	}
	/**
	 *description:创建3d场景图所需目录
	 *author:yanyalong
	 *date:2013/12/13
	 */
	public function room_3d($room_id){
		$picdir[0]= $_SERVER['DOCUMENT_ROOT'].'/uploads/room/';
		$picdir[1]= $picdir[0].ceil($room_id/1000).'/';
		$picdir[2]= $picdir[1].$room_id.'/';
		//若不存在时间目录则新建
		foreach($picdir as $key=>$val){
			$this->makedir($val);
		}
		$picurl = '/uploads/room/'.ceil($room_id/1000).'/'.$room_id.'/';
		return $picurl;
	}
	/**
	 *description:检测产品图片目录是否存在
	 *author:yanyalong
	 *date:2013/12/29
	 */
	public function product_dir(){
		$timedir = date("Y-m",time());
		$yeardir = date("Y",strtotime($timedir))."/";
		$monthdir = $yeardir.date("m",strtotime($timedir))."/";
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/';
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/source/';
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/thumb_1/';
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/thumb_2/';
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/thumb_3/';
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/index/';
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/source/'.$yeardir;
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/thumb_1/'.$yeardir;
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/thumb_2/'.$yeardir;
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/thumb_3/'.$yeardir;
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/index/'.$yeardir;
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/source/'.$monthdir;
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/thumb_1/'.$monthdir;
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/thumb_2/'.$monthdir;
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/thumb_3/'.$monthdir;
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/product/index/'.$monthdir;
		//若不存在时间目录则新建
		foreach($picdir as $key=>$val){
			$this->makedir($val);
		}
		return $monthdir;
	}

	/**
	 *description:检测产品品牌目录是否存在
	 *author:yanyalong
	 *date:2013/12/29
	 */
	public function brandDir(){
		$timedir = date("Y-m",time());
		$yeardir = date("Y",strtotime($timedir))."/";
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/brand/';
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/brand/source/';
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/brand/default/';
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/brand/thumb_1/';
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/brand/thumb_2/';
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/brand/thumb_3/';

		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/brand/source/'.$yeardir;
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/brand/thumb_1/'.$yeardir;
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/brand/default/'.$yeardir;
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/brand/thumb_2/'.$yeardir;
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/brand/thumb_3/'.$yeardir;
		
		//若不存在时间目录则新建
		foreach($picdir as $key=>$val){
			$this->makedir($val);
		}
		return $yeardir;
	}
	
	/**
	 *description:检测产品品牌目录是否存在
	 *author:yanyalong
	 *date:2013/12/29
	 */
	public function seriesDir(){
		$yeardir = date("Y",time())."/";
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/series/';
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/series/source/';
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/series/default/';
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/series/thumb_1/';


		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/series/source/'.$yeardir;
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/series/thumb_1/'.$yeardir;
		$picdir[]= $_SERVER['DOCUMENT_ROOT'].'/uploads/series/default/'.$yeardir;
		
		//若不存在时间目录则新建
		foreach($picdir as $key=>$val){
			$this->makedir($val);
		}
		return $yeardir;
	}
	
	/**
	 *description:上传产品缩略图导入
	 *author:liuguangping
	 *date:2013/12/29
	 */
	public function  product_index_admin_import($source){
		$datedir= $this->product_dir();
		$this->CI =& get_instance();
		$this->CI->config->load('uploads');
		$config = $this->CI->config->item("product");
		//上传图片文件
		$config['upload_path'].=$datedir;
		$config['index'].=$datedir;
	
		$filename = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).".jpg";
		$destination =  $config['upload_path'].$filename;
		if(@copy($source,$destination)){
			$imginfo = getimagesize($destination);
			if($imginfo[0]<$config['thumb_size_index_x']||$imginfo[1]<$config['thumb_size_index_x']){
				unlink($destination);
				return false;
			}
			$this->CI->load->library('image_lib');
			$thumb= $this->CI->image_lib->product_index_thumb($destination,$config);
			if($thumb==true){
				$imgurl = '/'.$datedir.$filename;
				return $imgurl;
			}else{
				return false;
			}
		}else{
			return false;
		}	
	}
	
	/**
	 *description:上传细节图，效果图
	 *author:liuguangping
	 *date:2013/12/29
	 */
	public function  product_admin_import($source){
		$datedir= $this->product_dir();
		$this->CI =& get_instance();
		$this->CI->config->load('uploads');
		$config = $this->CI->config->item("product");
		//上传图片文件
		$config['upload_path'].=$datedir;
		$config['thumb_1'].=$datedir;
		$config['thumb_2'].=$datedir;
		$config['thumb_3'].=$datedir;
	
		$filename = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).".jpg";
		$destination =  $config['upload_path'].$filename;

		if(@copy($source,$destination)){
			$imginfo = getimagesize($destination);
			if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
				unlink($destination);
				return false;
			}
			$this->CI->load->library('image_lib');
			$thumb= $this->CI->image_lib->product_thumb($destination,$config);
			if($thumb==true){
				$imgurl = '/'.$datedir.$filename;
				return $imgurl;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	/**
	 * 经销商上证件上传
	 * @author liuguangping
	 * @param string fileName 文件域名
	 */
	public function upService($fileName){
		$this->CI =& get_instance();
		$this->CI->config->load('uploads');
		$config = $this->CI->config->item('service');
		$save_file = md5(time()."_".rand(1000,99999)."_abc").'.jpg';
		$config['file_name'] = $save_file;
		$this->CI->load->helper('import_excel');
		$time = date('Y/m/d',time());
		$filePath = $config['relative_path']."source/".$time.'/'.$save_file;
		$config['upload_path'] = $config['upload_path'].$time.'/';
		$this->initialize($config);
		if(mkdirs($config['upload_path'])){
			if (!$this->do_upload($fileName)){
				return false;
			}else{
				$data = $this->data();
				$sourcePath = $config['upload_path'].$save_file;
				if($data['image_width']<$config['min_width'] || $data['image_height']<$config['min_height']){
					@unlink($sourcePath);
					return false;
				}
				if($data['file_size']>$config['max_size']){
					@unlink($sourcePath);
					return false;
				}
				return $filePath;
			}
		}else{
			return false;
		}
		
	}
	
	
	/**
	 * 经销商模块图标上传
	 * @author liuguangping
	 * @param string fileName 文件域名
	 */
	public function upServiceModule($fileName){
		$this->CI =& get_instance();
		$this->CI->config->load('uploads');
		$config = $this->CI->config->item('service_module');
		$save_file = md5(time()."_".rand(1000,99999)."_abc").'.jpg';
		$config['file_name'] = $save_file;
		$this->CI->load->helper('import_excel');
		$filePath = "/uploads/service/modules/source/".$save_file;
		//$config['upload_path'] = $config['upload_path'].date('Y/m/d',time()).'/';
		$this->initialize($config);
		if(mkdirs($config['upload_path'])){
			if (!$this->do_upload($fileName)){
				return false;
			}else{
				return $filePath;
			}
		}else{
			return false;
		}
	
	}
	
	/**
	 * 门店认证图标上传
	 * @author liuguangping
	 * @param string fileName 文件域名
	 */
	public function upLicenseModule($fileName){
		$this->CI =& get_instance();
		$this->CI->config->load('uploads');
		$config = $this->CI->config->item('service_license');
		$save_file = md5(time()."_".rand(1000,99999)."_abc").'.jpg';
		$config['file_name'] = $save_file;
		$this->CI->load->helper('import_excel');
		$time = date('Y/m',time());
		$filePath = $config['relative_path']."source/".$time.'/'.$save_file;
		$config['upload_path'] = $config['upload_path'].$time.'/';
		$this->initialize($config);
		if(mkdirs($config['upload_path'])){
			if (!$this->do_upload($fileName)){
				return false;
			}else{
				$data = $this->data();
				$sourcePath = $config['upload_path'].$save_file;
				if($data['image_width']<$config['min_width'] || $data['image_height']<$config['min_height']){
					@unlink($sourcePath);
					return false;
				}
				if($data['file_size']>$config['max_size']){
					@unlink($sourcePath);
					return false;
				}
				return $filePath;
			}
		}else{
			return false;
		}
	
	}

	/**
	 * 门店员工图标上传
	 * @author liuguangping
	 * @param string fileName 文件域名
	 */
	public function upServiceUser($fileName){
		$this->CI =& get_instance();
		$this->CI->config->load('uploads');
		$config = $this->CI->config->item('service_user');
		$save_file = md5(time()."_".rand(1000,99999)."_abc").'.jpg';
		$config['file_name'] = $save_file;
		$this->CI->load->helper('import_excel');
		$time = date('Y/m',time());
		$filePath = $config['relative_path']."source/".$time.'/'.$save_file;
		$config['upload_path'] = $config['upload_path'].$time.'/';
		$this->initialize($config);
		if(mkdirs($config['upload_path'])){
			if (!$this->do_upload($fileName)){
				return false;
			}else{
				$data = $this->data();
				$sourcePath = $config['upload_path'].$save_file;
				if($data['image_width']<$config['min_width'] || $data['image_height']<$config['min_height']){
					@unlink($sourcePath);
					return false;
				}
				if($data['file_size']>$config['max_size']){
					@unlink($sourcePath);
					return false;
				}
				return $filePath;
			}
		}else{
			return false;
		}
	
	}

	/**
	 * 对CI多文件上传重写
	 * @author liuguangping
	 * @param string field 文件域名
	 */
	public function doMulUpload($field = 'userfile'){
		$this->CI =& get_instance();
		$this->CI->load->helper('import_excel');
        $count=count($_FILES["$field"]["name"]);//页面取的默认名称
		$this->CI->config->load('uploads');
		$config = $this->CI->config->item('service_color');
		$time = date('Y/m/d',time());
		$config['upload_path'] = $config['upload_path'].$time.'/';

        $file_arr=array();
        if(mkdirs($config['upload_path'])){
	        for($i=0;$i<$count;$i++){
	        	$j = $i;
		        $pseudo_field_name = md5('_psuedo_' . $field . uniqid().time(). '_' . $i);
		        $_FILES[$pseudo_field_name] =   array('name' => $_FILES[$field]['name'][$i],
		                                                  'size' => $_FILES[$field]['size'][$i], 
		                                                  'type' => $_FILES[$field]['type'][$i],
		                                                  'tmp_name' => $_FILES[$field]['tmp_name'][$i], 
		                                                  'error' => $_FILES[$field]['error'][$i]
		                                            );
		        $save_file = $pseudo_field_name.".".'jpg';
				$config['file_name'] = $save_file;
				$config['overwrite'] = true;
				$filePath = $config['relative_path']."source/".$time.'/'.$save_file;
			  	$this->initialize($config);
			  	if ($this->CI->upload->do_upload($pseudo_field_name)) { //默认名是:userfile
			            //$data = $this->CI->upload->data();
			            $in_data=array();
			            $in_data["name"] = $save_file;//文件名
			            $in_data["path"] = $filePath;//保存的路径
			            $in_data['time'] = $time;
			            $file_arr[$i]=$in_data;        
		        }
	        }
	        return$file_arr;
        }else{
        	return false;
        }
	}


	/**
	 * 经销商产品缩略图上传
	 * @author liuguangping
	 * @param string fileName 文件域名
	 */
	public function upServiceProductPic($fileName){
		$this->CI =& get_instance();
		$this->CI->config->load('uploads');
		$config = $this->CI->config->item('service_ProductPic');
		$save_file = md5(time()."_".rand(1000,99999)."_abc").'.jpg';
		$config['file_name'] = $save_file;
		$this->CI->load->library('image_lib');
		$this->CI->load->helper('import_excel');
		$time = date('Y/m/d',time());
		$filePath = $config['relative_path']."source/".$time.'/'.$save_file;
		$config['upload_path'] = $config['upload_path'].$time.'/';
		$config['thumb_1'] = $config['thumb_1'].$time.'/';
		$this->initialize($config);
		if(mkdirs($config['upload_path']) && mkdirs($config['thumb_1'])){
			if($_FILES[$fileName]['size']>$config['max_size']*1024){
				return false;
			}
			if (!$this->do_upload($fileName)){
				return false;
			}else{
				//上传功后裁切
				$sourcePath = $config['upload_path'].$save_file;
				list($width,$height)= getimagesize($sourcePath);

				if($width < $config['min_width'] || $height < $config['min_height']){
					@unlink($sourcePath);
					return false;
				}else{	
					if($this->CI->image_lib->service_product_picThumb($sourcePath,$config)){
						return $time.'/'.$save_file;
					}else{
						return false;
					}
				}
				
			}
		}else{
			return false;
		}
	
	}

	/**
	 * 经销商产品颜色贴面上传
	 * @author liuguangping
	 * @param Array colorArr 上传后的文件数组
	 */
	public function upServiceProductColor($colorArr){

		$this->CI =& get_instance();
		$this->CI->config->load('uploads');
		$config = $this->CI->config->item('service_color');
		$this->CI->load->library('image_lib');
		$this->CI->load->helper('import_excel');
		$time = $colorArr['0']['time'];
		$config['upload_path'] = $config['upload_path'].$time.'/';
		$config['thumb_1'] = $config['thumb_1'].$time.'/';
		$sucessA = array();
		if(mkdirs($config['upload_path']) && mkdirs($config['thumb_1'])){
			foreach ($colorArr as $key => $value) {
				$sourcePath = $config['upload_path'].$value['name'];
				if($this->CI->image_lib->service_product_colorThumb($sourcePath,$config)){
					$sucessA[$key]['path'] = $value['path'];
					$sucessA[$key]['name'] = $value['name'];
					$sucessA[$key]['time'] = $value['time'];
				}
			}
			if($sucessA){
				return $sucessA;
			}else{
				return false;
			}
	
		}else{
			return false;
		}
	
	}

	/**
	 * 微信（后台）菜单项
	 * @author liuguangping
	 * @param string fileName 文件域名
	 */
	public function upMenuPicModule($fileName){
		$this->CI =& get_instance();
		$this->CI->config->load('uploads');
		$config = $this->CI->config->item('service_WeixinMenu');
		$save_file = md5(time()."_".rand(1000,99999)."_abc").'.jpg';
		$config['file_name'] = $save_file;
		$this->CI->load->library('image_lib');
		$this->CI->load->helper('import_excel');
		$time = date('Y/m/d',time());
		$filePath = $config['relative_path']."source/".$time.'/'.$save_file;
		$config['upload_path'] = $config['upload_path'].$time.'/';
		$config['thumb_1'] = $config['thumb_1'].$time.'/';
		$this->initialize($config);
		if(mkdirs($config['upload_path']) && mkdirs($config['thumb_1'])){
			if($_FILES[$fileName]['size']>$config['max_size']*1024){
				return false;
			}
			if (!$this->do_upload($fileName)){
				return false;
			}else{
				//上传功后裁切
				$sourcePath = $config['upload_path'].$save_file;
				list($width,$height)= getimagesize($sourcePath);

				if($width < $config['min_width'] || $height < $config['min_height']){
					@unlink($sourcePath);
					return false;
				}else{	
					if($this->CI->image_lib->service_weixinMenu_picThumb($sourcePath,$config)){
						return $time.'/'.$save_file;
					}else{
						return false;
					}
				}
				
			}
		}else{
			return false;
		}
	
	}


	/**
	 * 图片复制上传
	 * @author liuguangping
	 * @param string sourcePath 源文件
	 * @param string destPath 目标文件
	 */

	public function moveFile($sourcePath,$destPath){
		$this->CI =& get_instance();
		$this->CI->load->helper('import_excel');
		if(mkdirs($destPath)){
			if(!file_exists($sourcePath)){
				return false;
			}else{
				$filename = substr($sourcePath,strrpos($sourcePath,'/'));
				if(!@copy($sourcePath,$destPath.$filename)){
					if(!@move_uploaded_file($sourcePath, $destPath.$filename)){
						return false;
					}else{
						return true;
					}
				}else{
					return true;
				}
			}
		}else{
			return false;
		}
		
	}

	/**
	 * 资讯上传裁切项
	 * @author liuguangping
	 * @param string fileName 文件域名
	 */
	public function upSysInfoMationPic($fileName){
		$this->CI =& get_instance();
		$this->CI->config->load('uploads');
		$config = $this->CI->config->item('service_InforMation');
		$save_file = md5(time()."_".rand(1000,99999)."_abc").'.jpg';
		$config['file_name'] = $save_file;
		$this->CI->load->library('image_lib');
		$this->CI->load->helper('import_excel');
		$time = date('Y/m/d',time());
		$filePath = $config['relative_path']."source/".$time.'/'.$save_file;
		$config['upload_path'] = $config['upload_path'].$time.'/';
		$config['thumb_1'] = $config['thumb_1'].$time.'/';
		$config['thumb_2'] = $config['thumb_2'].$time.'/';
		$this->initialize($config);
		if(mkdirs($config['upload_path']) && mkdirs($config['thumb_1']) && mkdirs($config['thumb_2'])){
			if($_FILES[$fileName]['size']>$config['max_size']*1024){
				return false;
			}
			if (!$this->do_upload($fileName)){
				return false;
			}else{
				//上传功后裁切
				$sourcePath = $config['upload_path'].$save_file;
				list($width,$height)= getimagesize($sourcePath);

				if($width < $config['min_width'] || $height < $config['min_height']){
					@unlink($sourcePath);
					return false;
				}else{	
					if($this->CI->image_lib->service_InforMation_picThumb($sourcePath,$config)){
						return $time.'/'.$save_file;
					}else{
						return false;
					}
				}
				
			}
		}else{
			return false;
		}
	
	}

	/**
	 *description:上传产品缩略图导入
	 *author:liuguangping
	 *date:2013/12/29
	 */
	public function  informationImport($source){
		
		$this->CI =& get_instance();
		$this->CI->config->load('uploads');
		$config = $this->CI->config->item("service_InforMation");
		$this->CI->load->helper('import_excel');
		$save_file = md5(md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999))).".jpg";
		$config['file_name'] = $save_file;
		$time = date('Y/m/d',time());
		$filePath = $config['relative_path']."source/".$time.'/'.$save_file;
		$config['upload_path'] = $config['upload_path'].$time.'/';
		$config['thumb_1'] = $config['thumb_1'].$time.'/';
		$config['thumb_2'] = $config['thumb_2'].$time.'/';

		if(mkdirs($config['upload_path']) && mkdirs($config['thumb_1']) && mkdirs($config['thumb_2'])){
			$destination =  $config['upload_path'].$save_file;
			if(@copy($source,$destination)){
				$imginfo = getimagesize($destination);
				if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
					unlink($destination);
					return false;
				}
				$this->CI->load->library('image_lib');
				$sourcePath = $destination;
				if($this->CI->image_lib->service_InforMation_picThumb($sourcePath,$config)){
					return $time.'/'.$save_file;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	
}
