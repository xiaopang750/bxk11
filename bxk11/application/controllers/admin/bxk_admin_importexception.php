<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @abstract 设计灵感批量导入操作类
 * @author liuguangping
 * @version 1.0 2013/10/08
 */
class Bxk_admin_importexception extends CI_Controller{
	public $syles;
	public $colors;
	public $uploaded_msg;
	public $count;//图片的数目
	public $prname;//项目名称
	public $hmodel;//户型
	public $tdescripttion;//主题描素
	public $price;//造价
	public $themes;//主题
	public $flg;//1扫描2上传
	public $expv;//以什么来截取标签
	public $url;
	public $excelm;
	public $areas;
	public $mjex;//面积分割
	public $countprice;
	public $libs;
	public $source_url;
	public $fenge;
	public $sediao;
	public $huxing;
	public $suozd;
	public $mianji;
	public $zaojiao;
	public $user_ids;
	public $infomes;
	public $image_lib;

	public function __construct(){
	
		parent::__construct();
		$this->config->load('uploads');
		$upload_file = $this->config->item('upload_file');
		$this->count = $upload_file['count'];
		$this->styles = $upload_file['styles'];
		$this->colors = $upload_file['colors'];
		$this->prname = $upload_file['prname'];
		$this->hmodel = $upload_file['hmodel'];
		$this->tdescripttion = $upload_file['tdescripttion'];
		$this->price =$upload_file['price'];
		$this->themes = $upload_file['themes'];
		$this->flg = $this->input->get('flg');
		$this->expv = $upload_file['expv'];
		$this->user_ids = $upload_file['user_id'];

		$this->url = $upload_file['url'];
		$this->source_url =  $upload_file['source_url'];
		$this->areas =$upload_file['areas'];
		$this->mjex = $upload_file['mjex'];
		$this->countprice = $upload_file['countprice'];
		$this->fenge = $upload_file['fenge'];
		$this->sediao = $upload_file['sediao'];
		$this->huxing = $upload_file['huxing'];
		$this->suozd = $upload_file['suozd'];
		$this->mianji = $upload_file['mianji'];
		$this->zaojiao = $upload_file['zaojiao'];
		$this->PHPExcel_connect();
		$this->load->model('bxk_admin_excel_model');
		$this->excelm = $this->bxk_admin_excel_model;
		$this->load->helper('import_excel');	
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->load->library('image_lib');
		$this->image_lib = $this->image_lib;
		$this->load->helper('url');
		session_start();
	}
	public function index(){
		$this->load->view('admin/bxk_admin_importexception/index');
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
					
					$mergecontnet = $this->bokearr($data["msg"],$this->flg);
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
				$this->load->view('admin/bxk_admin_importexception/upload_file');
			}else{
				//扫描失败
				var_dump($msg['msg']);exit;
			}
	}
	//下载
	public function down_file($pat_arr=''){
	
		$this->libs->down_file();
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
	public function bokearr($allname = '',$flg = 1){

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
	 		//首项第一行图片数
	 		$picnums = $objWorksheet->getCellByColumnAndRow($this->count, $row)->getValue();
	 		//首项第一行序列号
	 		$tilesv = $objWorksheet->getCellByColumnAndRow(0,$row)->getValue();
	 		if(!$tilesv){
	 			unlink($allname);
	 			return setError(0,"单元格A{$row}的序列号不能为空或者是上个序列的图片张数和H的张数不吻合,请检查你上传的excel的单元格A{$row}的序列号和图片张数!");
	 		}
	 		if(!$picnums){
	 			unlink($allname);
	 			return setError(0,"序列号为{$tilesv}的图片数错误,请检查你上传的excel的单元格C{$row}！");
	 		}
	
			//首项后几行
	 		for($tem = 1;$tem < $picnums;$tem++){
 				$row++;
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
		
		$allname = $_SESSION['allname'];

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
	
		
		//echo $highestRow;die;
		for($row = $page;$row<= $highestRow;$row++){
			
			//首项第一行图片数
			$picnums = $objWorksheet->getCellByColumnAndRow($this->count, $row)->getValue();
			//首项第一行序列号
			$tilesv = $objWorksheet->getCellByColumnAndRow(0,$row)->getValue();
			
			
			$tagthme = array();
			//首项第一行
			for($cels=0;$cels<$highestColumnIndex;$cels++ ){
				$valuss=strval($objWorksheet->getCellByColumnAndRow($cels, $row)->getValue());
			 	
				$r9 = strval($objWorksheet->getCellByColumnAndRow(9, $row)->getValue());
				$r10 = strval($objWorksheet->getCellByColumnAndRow(10, $row)->getValue());
				$r16 = strval($objWorksheet->getCellByColumnAndRow(16, $row)->getValue());
				$r14 = strval($objWorksheet->getCellByColumnAndRow(14, $row)->getValue());
				$r1 = strval($objWorksheet->getCellByColumnAndRow(1, $row)->getValue());
				$r4 = strval($objWorksheet->getCellByColumnAndRow(4, $row)->getValue());
				$r5 = strval($objWorksheet->getCellByColumnAndRow(5, $row)->getValue());
				$r6 = strval($objWorksheet->getCellByColumnAndRow(6, $row)->getValue());
				$r10 = strval($objWorksheet->getCellByColumnAndRow(10, $row)->getValue());
			
				if($r1 === '' && $cels == 1){
					$ars[$tilesv][1] = $this->themes;
				}elseif($r4 === '' && $cels == 4){
					$ars[$tilesv][4] = $this->styles;
				}elseif($r5 === '' && $cels == 5){
					$ars[$tilesv][5] = $this->colors;
				}elseif($r6 === '' && $cels == 6){
					$ars[$tilesv][6] = $this->tdescripttion;
				}elseif($r9 === '' && $cels == 9){
					$ars[$tilesv][9] = $this->prname;
				}elseif($r10 === '' && $cels == 10){
					$ars[$tilesv][10] = $this->hmodel;
				}elseif($r14 === '' && $cels == 14){
					$mj_s = $this->areas;
					$ars[$tilesv][14] = $mj_s[0];
					 
				}elseif($r16 === '' && $cels == 16){
					$zj_s = $this->countprice;
					$ars[$tilesv][16] = $zj_s[0];
				}else{
					$ars[$tilesv][] = 	$valuss?$valuss:"无";
				}
		
				
				$ars[$tilesv]['s_id'] = $tilesv;
			}
		
			//添加设计标签风格
			if($st = trim(strip_tags($ars[$tilesv][4]))){
				$ars[$tilesv]['tag'][] = $this->libs->typeclass($this->fenge,cn_substr_utf8(trim($st),0,50),'E',$row);
			}
		 	
			//色调
			if($st = trim(strip_tags($ars[$tilesv][5]))){
				$ars[$tilesv]['tag'][] =$this->libs->typeclass($this->sediao,cn_substr_utf8(trim($st),0,50),'F',$row);
			}
		 	
			/* 	//户型
			 if($st = trim(strip_tags($ars[$tilesv][10]))){
			$ars[$tilesv]['tag'][] =$this->libs->typeclass($this->huxing,$st,'K',$row);
		 	
			} */
		 	
			//面积先导入面积参数
			foreach ($this->areas as $vlu){
				$result['mj'][] = $this->libs->typeclass($this->mianji,$vlu,'O',$row);
			}
		 	
			//面积添加标签
			$va = trim(strip_tags($ars[$tilesv][14]));
			$ars[$tilesv]['tag'][] = $this->libs->insertap($result['mj'],cn_substr_utf8(trim($va),0,50));
			 
			// 造价
			foreach ($this->countprice as $vlu){
					
				$result['zj'][] = $this->libs->typeclass($this->zaojiao,cn_substr_utf8(trim($vlu),0,50),'Q',$row);
	
			}
			$zj = trim(strip_tags($ars[$tilesv][16]));
			$ars[$tilesv]['tag'][] = $this->libs->insertap($result['zj'],cn_substr_utf8(trim(trim($zj)),0,50));
			//首项后几行
			$i = 1;
			for($tem = 1;$tem < $picnums;$tem++){
				$row++;
				$i++;
				$arv = array();
				$value7 = $objWorksheet->getCellByColumnAndRow(7, $row)->getValue();
				$value8 = $objWorksheet->getCellByColumnAndRow(8, $row)->getValue();
				$arv['pic_id']= $value7?$value7:"jiasuibian_imagename";
				$arv['content']= $value8?$value8:"jiasuibian_description";
				$ar[$tilesv][] = $arv;
				
					
			}
		
	
		//把首项插入第一张图片插入总数组中
		$arvs = array(
				'pic_id'=>$ars[$tilesv][7],
				'content'=>$ars[$tilesv][8]
		);
		$ar[$tilesv][] = $arvs;
		$ars[$tilesv]['images']=$ar[$tilesv];
		if($i == $picnums){
			break;
		}
		}
		if($row <=$highestRow){
			$p = $row+1;
			$this->insetr_upload($ars);
			echo "需要一段时间，请耐心等待<br>上传中。。。。。。";
			echo "<script>window.location.href='".site_url('admin/bxk_admin_importexception/insertdate_one')."?page={$p}'</script>";
		}else{
			echo "操作完成！！";
			
			$result = read_dary();
			$num = count($result)-1;
			for($i = $num;$i>=0;$i--){
				echo $result[$i]."<br>";
			}
			unset($_SESSION['allname']);
			unlink($allname);
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
				$design = $this->config->item('design');
				foreach ($array as $ke=>$va){
					//查找设计师的名子
					$this->excelm->table='t_user';
					$this->excelm->where = array('user_nickname'=>trim($va['15']));
					if($user = $this->excelm->get_one()){
						$user_id = $user->user_id;
					}else{
						$user_model = model('t_user');
						$user_info_model = model('t_user_info');
						$user_model->user_nickname =  cn_substr_utf8(trim($va['15']),0,15);
						$user_model->user_passwd = md5('jia178');
						$user_model->user_likes=0;
						$user_model->user_follows=0;
						$user_model->user_fans=0;
						$user_model->user_content=0;
						$user_model->user_type=1;
						$user_model->user_follows=0;
						$user_model->user_recommend=0;
						if($userid = $user_model->insert()){
							$user_email = $userid.'@jia178.com';
							$data = array('user_email' => $user_email);
							$where = array('user_id'=>$userid);
							if(!$user_model->updates_global($data,$where)){
								$mes = "用户user_id{$userid}:该序列号：{$ke}的t_user表的邮箱：{$user_email}插入失败！;";
								write_dary($mes);
								continue;
							}else{
								//插入t_user_info
								$user_id = $userid;
								$user_info_model->user_id = $user_id;
								if(!$user_info_model->insert()){
									$mes = "用户user_id{$userid}:该序列号：{$ke}的t_user_info表：{$user_email}插入失败！;";
									write_dary($mes);
									continue;
								}
							}
						}else{
							$mes = "用户user_id{$userid}:该序列号：{$ke}的t_user表的用户和博文：".trim($va['15'])."插入失败！;";
							write_dary($mes);
							continue;
						}
	
					}
					$countimg=0;
					$picinfo = array();
					foreach ($va['images'] as $vas){
						$source = $this->source_url.$ke.'/'.$vas['pic_id'].'.jpg';
						$destination = $design['upload_path'].$design['file_name'].$ke.$vas['pic_id'].'.jpg';
						if(copy_file($source,$destination)){
							
							$thumb= $this->image_lib->blog_thumb($destination);
							if($thumb){
								$pic_id = model('t_pic')->pic_add($destination,$user_id,$vas['content']);
								
								$picinfo[] = $pic_id.':'.basename($destination).':'.$vas['content'];
								$countimg++;
							}else{
								$mes = "用户user_id{$userid}:该序列号：{$ke}的第：{$vas['pic_id']}.jpg的图片上传失败！;";
								write_dary($mes);
							}
	
						}
					}
	
					$content_img = "[img]".$countimg."{";
					foreach ($picinfo as $key=>$val) {
						$content_img .= $val.',';
					}
					$content_img  =trim($content_img,',');
					$content_img .="}[/img]";
					//插入装修日记记录
					if(!empty($va['6'])){
						$content_content = "[content]".$va['6']."[/content]".$content_img;
					}
	
					$taglist = implode(',', twotoone_array($va['tag'],'tag_name'));
					$tagidlist = implode(',', twotoone_array($va['tag'],'tag_id'));
					$content_id = model('t_content')->content_add($user_id,$tagidlist,$taglist,cn_substr_utf8($va['1'],0,50),$content_content,1);
					if($content_id){
						model("t_user")->user_status($user_id,'user_content','+');
						$tagid_list = implode(',', twotoone_array($va['tag'],'tag_id'));
						if(!empty($tagid_list)){
							//插入装修日记用到的标签id到灵感博文标签表
	
							$res = model('t_content_tag')->content_tags_add(trim($tagid_list,','),$content_id);
	
							if($res){
								$i = 1;
							}else{
								$mes = "用户user_id{$userid}该序列号：{$ke}的t_content_tags表的内容标签：{$tagid_list}插入失败！;";
								write_dary($mes);
								continue;
							}
						}
					}else{
						$mes = "用户user_id{$userid}该序列号：{$ke}的bxk_content表的内容插入失败！;";
						write_dary($mes);
						continue;
					}
				}
				if($i == 1){
					return true;
				}else{
					$mes = "用户user_id{$userid}该序列号：{$ke}的插入失败！";
					write_dary($mes);
					return  false;
				}
	}
	
}