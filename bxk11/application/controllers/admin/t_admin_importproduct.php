<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @abstract 设计灵感批量导入操作类
 * @author liuguangping
 * @version 1.0 2013/10/08
 */
class T_admin_importproduct extends Admin_Controller{

	public $uploaded_msg;
	public $flg;//1扫描2上传
	public $url;
	public $excelm;
	public $libs;
	public $source_url;
	public $image_lib;
	
	public $t_system_class;
	public $t_s_class_tag;
	public $t_certified_product;
	public $t_certified_product_info;
	public $t_certified_product_tag;

	public function __construct(){

		parent::__construct();
		$this->config->load('uploads');
		$upload_file = $this->config->item('upload_file');
		$upload_product = $this->config->item('upload_product');
		
		$this->flg = $this->input->get('flg');
		$this->url = $upload_file['url'];
		$this->source_url =  $upload_product['source_url'];
		$this->PHPExcel_connect();
		

		$this->load->model('t_system_class_model');
		$this->t_system_class = $this->t_system_class_model;
		$this->load->model('t_s_class_tag_model');
		$this->t_s_class_tag = $this->t_s_class_tag_model;
		$this->load->model('t_certified_product_model');
		$this->t_certified_product = $this->t_certified_product_model;
		
		$this->load->model('t_certified_product_info_model');
		$this->t_certified_product_info = $this->t_certified_product_info_model;
		
		$this->load->model('t_certified_product_tag_model');
		$this->t_certified_product_tag = $this->t_certified_product_tag_model;
		
		
		
		$this->load->helper('import_excel');	
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->load->library('image_lib');
		$this->image_lib = $this->image_lib;
		$this->load->helper('url');
		//session_start();
	}
	public function index(){
		//echo $_SESSION['adminid'];die;
		$this->load->view('admin/importexcel/product');
	}
	
	public function PHPExcel_connect(){
		include_once $this->url.'/libraries/Classes/PHPExcel.php';
		include_once $this->url.'/libraries/Classes/PHPExcel/IOFactory.php';
	}
	/**
	 * @abstract 文件上传处理中心
	 * @author liuguangping
	 * @version 2013/11/12 优化
	 */
	public function upload_file(){
		
		if(!$upload = $_FILES['file']){
			$msg = setError(0,'上传错误，请正确上传！');
		}
		$this->uploaded_msg = $this->libs->upload_class($upload);
		if($data = $this->uploaded_msg){
			//文件上传
			if($data["status"] == '1'){
				$mergecontnet = $this->productarr($data["msg"],$this->flg);
				if($mergecontnet['status'] == 1){
					$msg= $mergecontnet;
				}else{
					//文件扫描出错
					$msg = $mergecontnet;
				}
				
			}else{
				$msg = $this->libs->upload_class($upload);
			}
		}
		if($msg['status'] == 1){
			//扫描成功
			$this->load->view('admin/importexcel/uploadproduct_file');
		}else{
			//扫描失败
			var_dump($msg['msg']);exit;
		}
	}
	//下载
	public function down_file($pat_arr=''){
		$this->libs->downproduct_file();
	}
	//上传
	public function upload(){
		if(isset($_SESSION['allname'])){
			//文件上传
			$this->insertdate_one();
		}else{
			echo "非法访问！";
		}
	}
	
	/**
		*设计的灵感数据
		*是个三维数组
		*一维存的是公共的数据还包括一张图片
		*二维是包含图片描素和图片名
		*三维是图片名和图片描素各详细数据
		*$allname  文件名
		*type 1扫描 2上传;
	*/	
	public function productarr($allname = '',$flg = 1){
		
		$field = "s_class_id,s_class_name";
		$where = array('s_class_type'=>12,'s_class_pid'=>0);
		$categorybig = $this->t_system_class->get_tag($field,$where);
		
		$s_class_id = $categorybig[0]['s_class_id'];
		$field = "s_class_name,s_class_id";
		$where = array('s_class_pid'=>$s_class_id);
		$categoryResutl = $this->t_system_class->get_tag($field,$where);
		
		$categorys = twoToOneBykey($categoryResutl, 's_class_name','s_class_id');
		
		$_SESSION['allname'] = $allname;
		if(empty($allname)) return setError(0,'请选择要导入的数据！');	
		$fileName =  $_SERVER['DOCUMENT_ROOT'].'/'.$allname;
		if (!file_exists($fileName))return setError(0,"文件".$fileName."不存在");
		$xlsPath = $allname; //指定要读取的exls路径 
		$type = 'Excel5';
		$xlsReader = PHPExcel_IOFactory::createReader($type);
		
		$objPHPExcel = PHPExcel_IOFactory::load($xlsPath);
		$objWorksheet = $objPHPExcel->getActiveSheet(); 
		$xlsReader->setReadDataOnly(true);
		$xlsReader->setLoadSheetsOnly(true);
		$Sheets = $xlsReader->load($xlsPath);
		//开始读取
		$objSheets = $Sheets->getSheet(0);
		$highestRow = $objSheets->getHighestRow(); //行数
		$highestColumn = $objSheets->getHighestColumn(); //取得总列 返回的是字母Q
	 	$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);//总列数
	 	if($highestRow<3){
	 		unlink($allname);
	 		return setError(0,"请不要传空表格。");
	 	}

	 	for($row = 3;$row<= $highestRow;$row++){
	 		
	 		//序列号
	 		$code = $objWorksheet->getCellByColumnAndRow(0,$row)->getValue();
	 		if(!$code){
	 			unlink($allname);
	 			return setError(0,"单元格A{$row}的编号不能为空,请检查你上传的excel的单元格A{$row}的编号!");
	 		}
	 		//产品名称
	 		$product_name = $objWorksheet->getCellByColumnAndRow(2,$row)->getValue();
	 		if(!$product_name){
	 			unlink($allname);
	 			return setError(0,"单元格A{$row}的产品名称不能为空,请检查你上传的excel的单元格A{$row}的产品名称!");
	 		}
	 		//商品大品类
	 		$category = $objWorksheet->getCellByColumnAndRow(6,$row)->getValue();
	 		
	 		//品类
	 		$category_tag = $objWorksheet->getCellByColumnAndRow(7,$row)->getValue();
	 		if(!$category){
	 			unlink($allname);
	 			return setError(0,"编号为{$code}的大品类不能为空,请检查你上传的excel的单元格G{$row}！");
	 		}else{
	 			//检查系统分类里是否有
	 			if(!in_array($category, $categorys)){
	 				unlink($allname);
	 				return setError(0,"编号为{$code}的大品类与库中不吻合,请检查你上传的excel的单元格G{$row}！");
	 			}
	 		}
	 		
	 		if(!$category_tag){
	 			unlink($allname);
	 			return setError(0,"编号为{$code}的品类不能为空,请检查你上传的excel的单元格H{$row}！");
	 		}else{
	 			//$result = $this->t_s_class_tag->getClassByTag(162);echo "<pre>";var_dump($categorys);die;
	 			foreach ($categorys as $keys=>$vals){
	 				if($vals== $category){
	 					$category_tag_id = $keys;
	 				}
	 			}
	 			//这个是大品类的id
	 			if(isset($category_tag_id)){
	 				//echo $category_tag_id;die;
	 				//根据大品类的id得到标签
	 				$tagbycategoryid = $this->t_s_class_tag->getClassByTag($category_tag_id);
	 				if(!empty($tagbycategoryid)){
	 					if(!in_array($category_tag, twotoone_array($tagbycategoryid, 'tag_name'))){
	 						unlink($allname);
	 						return setError(0,"编号为{$code}的--{$category}--的大品类下没有--{$category_tag}--的品类,请检查你上传的excel的单元格H{$row}！");
	 					}
	 				}else {
	 					unlink($allname);
	 					return setError(0,"编号为{$code}的--{$category}--大品类还没有这个--{$category_tag}--品类,请添加后再添加！");
	 				}
	 				
	 			}else{
	 				unlink($allname);
	 				return setError(0,"编号为{$code}的品类与库中不吻合,请检查你上传的excel的单元格G{$row}！");
	 			}
	 			
	 		}
	 		//echo "<pre>";var_dump(twotoone_array($tagbycategoryid, 'tag_name'));die;
	 		//款式
	 		$pattern = $objWorksheet->getCellByColumnAndRow(9,$row)->getValue();
	 		//品牌
	 		$brand = $objWorksheet->getCellByColumnAndRow(11,$row)->getValue();
	 		//系列
	 		$series = $objWorksheet->getCellByColumnAndRow(12,$row)->getValue();
	 		if(!$pattern){
	 			unlink($allname);
	 			return setError(0,"编号为{$code}的款式不能为空,请检查你上传的excel的单元格J{$row}！");
	 		}
	 		
	 		if(!$brand){
	 			unlink($allname);
	 			return setError(0,"编号为{$code}的品牌不能为空,请检查你上传的excel的单元格L{$row}！");
	 		}
	 		if(!$series){
	 			unlink($allname);
	 			return setError(0,"编号为{$code}的系列不能为空,请检查你上传的excel的单元格M{$row}！");
	 		}
	 	}

 		$_SESSION['allname'] = $allname;
 		return setError(1,'扫描成功！');
	 	
	}
	
	/**
	 * @abstract 读一行数据
	 * @author liuguangping
	 * @version 2013/11/12优化
	 */
	public function insertdate_one(){
		$this->config->load('uploads');
		$upload_url = $this->config->item('upload_product');
		$field = "s_class_id,s_class_name";
		$where = array('s_class_type'=>12,'s_class_pid'=>0);
		$categorybig = $this->t_system_class->get_tag($field,$where);
		
		$s_class_id = $categorybig[0]['s_class_id'];
		$field = "s_class_name,s_class_id";
		$where = array('s_class_pid'=>$s_class_id);
		$categoryResutl = $this->t_system_class->get_tag($field,$where);
		$categorys = twoToOneBykey($categoryResutl, 's_class_name','s_class_id');

		$allname = isset($_SESSION['allname'])?$_SESSION['allname']:'';

		$page = $this->input->get('page');
	
		if(!is_numeric($page) OR $page < 3 OR !$page)
			$page = 3;
		
		if(empty($allname)) echo "请选择要导入的数据！";
		
		$fileName =  $_SERVER['DOCUMENT_ROOT'].'/'.$allname; 
		if (!file_exists($fileName))echo "文件".$fileName."不存在";
		$xlsPath = $allname; //指定要读取的exls路径
		$type = 'Excel5';
		$xlsReader = PHPExcel_IOFactory::createReader($type);
		
		$objPHPExcel = PHPExcel_IOFactory::load($xlsPath);
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$xlsReader->setReadDataOnly(true);
		$xlsReader->setLoadSheetsOnly(true);
		$Sheets = $xlsReader->load($xlsPath);
		//开始读取
		$objSheets = $Sheets->getSheet(0);
		$highestRow = $objSheets->getHighestRow(); //行数
		$highestColumn = $objSheets->getHighestColumn(); //取得总列 返回的是字母Q
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);//总列数
		$row = $page;
		if($row <=$highestRow){
			$code = $objWorksheet->getCellByColumnAndRow(0,$row)->getValue();
			for($cels=0;$cels<$highestColumnIndex;$cels++ ){
					$valuss=strval($objWorksheet->getCellByColumnAndRow($cels, $row)->getValue());
					$ars[$code][$cels] = 	$valuss?$valuss:"无";	
			}
			//插入品牌
	
			//分类id
			$category = $ars[$code][6];
			foreach ($categorys as $keys=>$vals){
				if($vals== $category){
					$category_tag_id = $keys;
				}
			}
			$tagbycategoryid = $this->t_s_class_tag->getClassByTag($category_tag_id);
			
			$categorytag = $ars[$code][7];
			
		
			//标签id
			$categorytags = twoToOneBykeyObj($tagbycategoryid,'tag_name','tag_id');
			foreach ($categorytags as $ke=>$va){
				if($va== $categorytag){
					$s_tag_id= $ke;
					$ars[$code]['s_tag_id'] = $s_tag_id;
				}
			}
			// 参数 1 品牌名 2 行数 3 分类id
			$brand_id = $this->libs->insert_brand(trim($ars[$code][11]),$row,$category_tag_id);
			if($brand_id){
				$ars[$code]['brand_id'] = $brand_id;
				//插入系列表
				$series_id = $this->libs->insert_series($brand_id,trim($ars[$code][12]),$row);
				if($series_id){
					$ars[$code]['series_id'] = $series_id;
				}else{
					$ars[$code]['series_id'] = "";
				}
			}else{
				$ars[$code]['brand_id'] = "";
			}
				
			
			$s_c_tag_id = $this->t_s_class_tag ->get_tag('s_c_tag_id',array('s_tag_id'=>$s_tag_id,'s_class_id'=>$category_tag_id));
			//插入款式表
			$pattern_id = $this->libs->insert_pattern($s_c_tag_id[0]['s_c_tag_id'],trim($ars[$code][9]),$row);
			if($pattern_id){
				$ars[$code]['pattern_id'] = $pattern_id;
			}else{
				$ars[$code]['pattern_id'] = "";
			}
		}
		if($row <=$highestRow){
			$p = $row+1;
			$this->insetr_upload($ars);
			echo "需要一段时间，请耐心等待<br>上传中。。。。。。";
			echo "<script>window.location.href='".site_url('admin/t_admin_importproduct/insertdate_one')."?page={$p}'</script>";
		}else{
			echo "操作完成！！";
			$ulr = $upload_url['error_url'];
			if(file_exists($ulr)){
				$result = read_dary($ulr);
				$num = count($result)-1;
				for($i = $num;$i>=0;$i--){
					echo $result[$i]."<br>";
				}
				unset($_SESSION['allname']);
				@unlink($allname);
				@unlink($ulr);
			}
		}
		
	}
	
	/**
	 * @abstract 单条博文数据导入库
	 * @param array $array 一条博文数据
	 * @author liuguangping
	 * @version 2013/11/12 优化
	 * @return boolean
	 */
	public function insetr_upload($array){
		$this->config->load('uploads');
		$upload_url = $this->config->item('upload_product');
		//先裁图得到地址再保存
		foreach ($array as $ke=>$va){
			//产品的缩略图
			$source = $this->source_url.$ke.'/'.$va['10'];
			$this->load->library('upload');
			$productthumb = $this->upload->product_index_admin_import($source);
			if(!$productthumb){
				$productthumb = '';
				$mes = "该序列号：{$ke}的缩略图生成失败，原因有可能上传的图片不符合规则！;";
				$ulr = $upload_url['error_url'];
				write_dary($mes,$ulr);
			}
			//产品添加
			$this->t_certified_product->brand_id = $va["brand_id"];
			$this->t_certified_product->series_id = $va["series_id"];	
			$this->t_certified_product->pattern_id = $va["pattern_id"];	
			$this->t_certified_product->product_brand_code = $va["18"];		
			$this->t_certified_product->product_system_code = "JIA178".time().randcode(5);
			$this->t_certified_product->product_name = $va["2"];
			$this->t_certified_product->product_price = $va["17"];
			$this->t_certified_product->product_key_word = $va["2"];
			$this->t_certified_product->product_unit = $va["16"];
			$this->t_certified_product->product_long = $va["13"];
			$this->t_certified_product->product_width = $va["14"];
			$this->t_certified_product->product_high = $va["15"];
			$this->t_certified_product->product_pic = $productthumb;
			$this->t_certified_product->product_hot = 5;
			$this->t_certified_product->product_views = 0;
			$this->t_certified_product->product_like = 0;
			$this->t_certified_product->product_downs = 0;
			$this->t_certified_product->product_disc = 0;
			$this->t_certified_product->product_rooms = 0;
			$this->t_certified_product->product_service = 0;
			$this->t_certified_product->product_is_hot = 0;
			$this->t_certified_product->product_sort = 0;
			$this->t_certified_product->product_index = 0;
			$this->t_certified_product->product_status = 1;
			$insert_id = $this->t_certified_product->insert();
			//echo $insert_id;die;
			if(!$insert_id){
				$mes = "该序列号：{$ke}的认证产品表插入失败;";
				$ulr = $upload_url['error_url'];
				write_dary($mes,$ulr);
				return false;
			}else{
				//更新品牌下的产品数
				$this->load->model('t_product_brands_model');
				$this->t_product_brands_model->updataproduct_brands("brand_products",$va["brand_id"],1);
				
				//插入产品标签表
				$this->t_certified_product_tag->tag_id = $va["s_tag_id"];
				if($this->t_certified_product_tag->tag_id){
					$this->t_certified_product_tag->product_id = $insert_id;
					if(!$this->t_certified_product_tag->insert()){
						$mes = "该序列号：{$ke}的产品标签表插入失败;";
						$ulr = $upload_url['error_url'];
						write_dary($mes,$ulr);
					}
				}else{
					$mes = "该序列号：{$ke}的产品标签表插入失败;";
					$ulr = $upload_url['error_url'];
					write_dary($mes,$ulr);
				}
				
				//产品播放成功后
				//生成细节图
				$detailpicnum = $va['5'];
				for($i = 1;$i<=$detailpicnum;$i++){
					$detailsource = $this->source_url.$ke.'/'."xj".$i.'.jpg';
					
					$detailpic = $this->upload->product_admin_import($detailsource);
					if($detailpic){
						$detailpics[] = $detailpic;
					}else{
						$mes = "该序列号：{$ke}的--xj{$i}.jpg--细节图生成失败，原因有可能上传的图片不符合规则！;";
						$ulr = $upload_url['error_url'];
						write_dary($mes,$ulr);
						continue;
					}
				}
				if(isset($detailpics)){
					$details = implode('|', $detailpics);
				}else{
					$details = '';
				}
				//效果图
				$resultpicnum = $va['4'];
				for($j = 1;$j<=$resultpicnum;$j++){
					$resultsource = $this->source_url.$ke.'/'."xg".$j.'.jpg';
					$resultpic = $this->upload->product_admin_import($resultsource);

					if($resultpic){
						$resultpics[] = $resultpic;
					}else{
						$mes = "该序列号：{$ke}的--xg{$j}.jpg--效果图生成失败，原因有可能上传的图片不符合规则！;";
						$ulr = $upload_url['error_url'];
						write_dary($mes,$ulr);
						continue;
					}	
				}
				if(isset($resultpics)){
					$results = implode('|', $resultpics);
				}else{
					$results = '';
				}
				//尺寸图
				$sizepicnum = $va['3'];
				for($z= 1;$z<=$sizepicnum;$z++){
					$sizesource = $this->source_url.$ke.'/'."cc".$z.'.jpg';
					$sizepic = $this->upload->product_admin_import($sizesource);
				
					if($sizepic){
						$sizepics[] = $sizepic;
					}else{
						$mes = "该序列号：{$ke}的--cc{$z}.jpg--尺寸图生成失败，原因有可能上传的图片不符合规则！;";
						$ulr = $upload_url['error_url'];
						write_dary($mes,$ulr);
						continue;
					}
				}
				
				if(isset($sizepics)){
					$sizes = implode('|', $sizepics);
				}else{
					$sizes = '';
				}
				$this->t_certified_product_info->product_id = $insert_id;
				$this->t_certified_product_info->product_description = $va["19"];
				$this->t_certified_product_info->product_materials = $va["20"];
				$this->t_certified_product_info->product_auxiliary = $va["21"];
				$this->t_certified_product_info->product_details = $va["22"];
				$this->t_certified_product_info->product_detailspic = $details;
				$this->t_certified_product_info->product_resultpic = $results;
				$this->t_certified_product_info->product_sizepic = $sizes;
				$this->t_certified_product_info->product_model = '';
				$this->t_certified_product_info->insert();
				/* if(!$this->t_certified_product_info->insert()){
					$mes = "该序列号：{$ke}的认证产品信息表插入失败;";
					$ulr = $upload_url['error_url'];
					write_dary($mes,$ulr);
				} */
				return true;
			}		
			
		}
	}
	
}
