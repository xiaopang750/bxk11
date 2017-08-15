<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @abstract 设计灵感批量导入操作类
 * @author liuguangping
 * @version 1.0 2013/10/08
 */
class T_admin_importinformation extends Admin_Controller{

	public $uploaded_msg;
	public $flg;//1扫描2上传
	public $url;
	public $excelm;
	public $libs;
	public $source_url;
	public $image_lib;
	

	public $information_type;
	public $information;

	public function __construct(){

		parent::__construct();
		$this->config->load('uploads');
		$upload_file = $this->config->item('upload_file');
		$upload_product = $this->config->item('upload_information');
		
		$this->flg = $this->input->get('flg');
		$this->url = $upload_file['url'];
		$this->source_url =  $upload_product['source_url'];
		$this->PHPExcel_connect();
		
		$this->information_type = model('t_information_type');
		$this->information = model('t_service_information');
	
		
		
		
		$this->load->helper('import_excel');	
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->load->library('image_lib');
		$this->load->helper('content_fun');
		$this->image_lib = $this->image_lib;
		$this->load->helper('url');
		//session_start();
	}
	public function index(){
		//echo $_SESSION['adminid'];die;
		$this->load->view('admin/importexcel/information');
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
			$this->load->view('admin/importexcel/uploadinformation_file');
		}else{
			//扫描失败
			var_dump($msg['msg']);exit;
		}
	}
	//下载
	public function down_file($pat_arr=''){
		$this->libs->downinformation_file();
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
	 		
	 		//资讯标题
	 		$si_title = $objWorksheet->getCellByColumnAndRow(1,$row)->getValue();
	 		if(!$si_title){
	 			unlink($allname);
	 			return setError(0,"单元格A{$row}的资讯标题不能为空,请检查你上传的excel的单元格A{$row}的资讯标题!");
	 		}

	 		//判断封面图是否存在
	 		$si_pic = $objWorksheet->getCellByColumnAndRow(2,$row)->getValue();
	 		if(!$si_pic){
	 			unlink($allname);
	 			return setError(0,"单元格A{$row}的资讯封面图不能为空,请检查你上传的excel的单元格A{$row}的资讯封面图!");
	 		}
	 		$source = $this->source_url.$si_pic;
	 		if(!file_exists($source)){
	 			unlink($allname);
	 			return setError(0,"单元格A{$row}的资讯封面图不存在,请检查你上传的excel的单元格A{$row}的资讯封面图地址!");
	 		}

	 		//$si_title = (strlen_utf8($this->postParam->si_title) <20 && isset($this->postParam->si_title))?$this->postParam->si_title:jumpAjax('标题不能为空或长度至多为20个字',$url);
	 		//资讯摘要
	 		$si_abstract = $objWorksheet->getCellByColumnAndRow(3,$row)->getValue();
	 		if(!$si_abstract){
	 			unlink($allname);
	 			return setError(0,"单元格A{$row}的资讯摘要不能为空,请检查你上传的excel的单元格A{$row}的资讯摘要!");
	 		}

	 		//资讯正文
	 		$si_content = $objWorksheet->getCellByColumnAndRow(4,$row)->getValue();
	 		if(!$si_content){
	 			unlink($allname);
	 			return setError(0,"单元格A{$row}的资讯正文不能为空,请检查你上传的excel的单元格A{$row}的资讯正文!");
	 		}

	 		//资讯发布日期
	 		$si_addtime = $objWorksheet->getCellByColumnAndRow(5,$row)->getValue();
	 		if(!$si_addtime){
	 			unlink($allname);
	 			return setError(0,"单元格A{$row}的资讯发布日期不能为空,请检查你上传的excel的单元格A{$row}的资讯发布日期!");
	 		}

	 		//资讯发布日期
	 		$si_keyword = $objWorksheet->getCellByColumnAndRow(6,$row)->getValue();
	 		if(!$si_keyword){
	 			unlink($allname);
	 			return setError(0,"单元格A{$row}的资讯关键词不能为空,请检查你上传的excel的单元格A{$row}的资讯关键词!");
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
		$upload_url = $this->config->item('upload_information');
		

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
			//$code = $objWorksheet->getCellByColumnAndRow(0,$row)->getValue();
			$code = $row;
			for($cels=0;$cels<$highestColumnIndex;$cels++ ){
					$valuss=strval($objWorksheet->getCellByColumnAndRow($cels, $row)->getValue());
					$ars[$code][$cels] = $valuss?$valuss:"无";	
			}

			if($ars[$code]['0'] == '无'){
				$ars[$code]['0'] = "未分类";
			}
	
			
		}
		if($row <=$highestRow){
			$p = $row+1;
			$this->insetr_upload($ars);
			echo "需要一段时间，请耐心等待<br>上传中。。。。。。";
			echo "<script>window.location.href='".site_url('admin/t_admin_importinformation/insertdate_one')."?page={$p}'</script>";
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
			$source = $this->source_url.$va['2'];
			$this->load->library('upload');
			$infothumb = $this->upload->informationImport($source);
			if(!$infothumb){
				$infothumb = '';
				$mes = "该序列号：第{$ke}行的资讯封面图缩略图生成失败，原因有可能上传的图片不符合规则！;";
				$ulr = $upload_url['error_url'];
				write_dary($mes,$ulr);
			}
			//资讯分类
			$it_name = $va['0'];
			if(!$it_name) $it_name = "未分类";
			$where['it_type'] = 1;
			$where['it_name'] = $it_name;
			$it_nameR = $this->information_type->getOne('it_id',$where);
			$it_id = $it_nameR->it_id;

			//检查资讯添加时间
			$it_addtime = str_replace('x', '-', $va['5']);
			//echo $string;
			//$pattern = '/\d{4}-\d{1,2}-\d{1,2}\s\d{1,2}:\d{1,2}:\d{1,2}/';
			//$it_addtime = preg_match($pattern, "2014-05-30 0:00:00")? $string:date('Y-m-d H:i:s');
			//echo $it_addtime;die;
			//资讯添加
			$this->information->service_id = 0;
			$this->information->it_id = $it_id;
			$this->information->si_title = $va['1'];
			$this->information->si_content = htmlspecialchars(UtfToString($va['4']));
			$this->information->si_addtime = $it_addtime;
			$this->information->si_status = 1;
			$this->information->si_author = '系统';
			$this->information->si_pic = $infothumb;
			$this->information->si_likes = 0;
			$this->information->si_views = 0;
			$this->information->si_wap_isshow = 0;
			$this->information->si_keyword = $va['6'];
			$this->information->si_desc = $va['3'];
			
			$insert_id = $this->information->insert();
			//echo $insert_id;die;
			if(!$insert_id){
				$mes = "该序列号：第{$ke}行的资讯插入资讯表失败;";
				$ulr = $upload_url['error_url'];
				write_dary($mes,$ulr);
				return false;
			}else{
				return true;
			}		
			
		}
	}
	
}
