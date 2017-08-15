<?php
/**
 * 
 * @author liuguangping
 * @version 1.0 2013/10/8
 */
class Operation_data {
	public $url;
	public $ext_arr;//上传格式
	public $excelm;
	public $CI;
	public $max_size;
	public $save_url;
	public $table;
	public $base_url;
	public $total_rows;
	public $per_page;
	public $t_product_brands;
	public $t_product_class_brands_series;
	public $t_product_brands_series;
	public $t_system_product_pattern;
	public function __construct(){

		$this->CI =& get_instance();
		$this->CI->config->load('uploads');
		$upload_file = $this->CI->config->item('upload_file');
		$this->url = $upload_file['url'];
		$this->ext_arr = explode('|',$upload_file['ext_arr']);
		$this->excelm = model('t_admin_excel');
		$this->max_size = $upload_file['max_size'];
		$this->save_url = $upload_file['save_url'];
		$this->excelm->table = 't_tag';
		$this->t_product_brands = model('t_product_brands');
		$this->t_product_class_brands_series = model('t_product_class_brands_series');
		$this->t_product_brands_series = model('t_product_brands_series');
		$this->t_system_product_pattern = model('t_system_product_pattern');
	}
	/**
	 * 下载博文模板
	 * @param string $pat_arr
	 */
	public function down_file($pat_arr=''){
		
		$objExcel = new PHPExcel();
		$objWriter = new PHPExcel_Writer_Excel5($objExcel);     // 用于其他版本格式
		//设置文档基本属性
		$objProps = $objExcel->getProperties();
		//创建人
		$objProps->setCreator("jia178");
		//最后修改人
		$objProps->setLastModifiedBy("jia178");
		//标题
		$objProps->setTitle("jia178_boke");
		//题目
		$objProps->setSubject("jia178_boke");
		//描述
		$objProps->setDescription("Test document, jia178 by PHPExcel.");
		//关键字
		$objProps->setKeywords("jia178_boke");
		//类别
		$objProps->setCategory("jia178_boke");
		//设置当前的sheet
		$objExcel->setActiveSheetIndex(0);
		$objActSheet = $objExcel->getActiveSheet();
		//设置当前活动sheet的名称
		$objActSheet->setTitle('jia178_boke');
		//*************************************
		//设置单元格内容
		//由PHPExcel根据传入内容自动判断单元格内容类型
		$objActSheet->setCellValue('A1', "首批推送设计方案");
		$objActSheet->setCellValue('A2', "序号");
		$objActSheet->setCellValue('B2', "主题");
		$objActSheet->setCellValue('C2', "图片张数");
		$objActSheet->setCellValue('D2', "主题标签");
		$objActSheet->setCellValue('E2', "风格");
		$objActSheet->setCellValue('F2', "色调");
		$objActSheet->setCellValue('G2', "主题描述");
		$objActSheet->setCellValue('H2', "图片名");
		$objActSheet->setCellValue('I2', "图片描述");
		$objActSheet->setCellValue('J2', "项目名称");
	
		$objActSheet->setCellValue('K2', "户型");
		$objActSheet->setCellValue('L2', "省");
		$objActSheet->setCellValue('M2', "市");
		$objActSheet->setCellValue('N2', "小区");
		$objActSheet->setCellValue('O2', "面积");
		$objActSheet->setCellValue('P2', "设计师");
		$objActSheet->setCellValue('Q2', "公司");
		$objActSheet->setCellValue('R2', "造价");

		//合并单元格
		//设置字体
		$objActSheet->mergeCells('A1:R1');
		$objStyleA1 = $objActSheet->getStyle('A1');
		$objFontA1 = $objStyleA1->getFont();
		$objFontA1->setSize(20);
		$objFontA1->setBold(true);
		$objFontA1->getColor()->setARGB('#000000');
		//设置对齐方式
		$objAlignA1 = $objStyleA1->getAlignment();
		$objAlignA1->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objAlignA1->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objActSheet->getStyle('A2:R2')->getFont()->setSize(12)->setBold(true);
	
		//垂直居中
		$objActSheet->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$outputFileName = "JIA178_BOKE.xls";
		header("Content-Type:application/octet-stream;charset=utf-8");
		header('Content-Disposition: attachment; filename=' . $outputFileName);
			
		$objWriter->save('php://output');
	}
	
	/**
	 * 下载产品模板
	 * @param string $pat_arr
	 */
	public function downproduct_file($pat_arr=''){
	
		$objExcel = new PHPExcel();
		$objWriter = new PHPExcel_Writer_Excel5($objExcel);     // 用于其他版本格式
		//设置文档基本属性
		$objProps = $objExcel->getProperties();
		//创建人
		$objProps->setCreator("jia178");
		//最后修改人
		$objProps->setLastModifiedBy("jia178");
		//标题
		$objProps->setTitle("jia178_product");
		//题目
		$objProps->setSubject("jia178_product");
		//描述
		$objProps->setDescription("Test document, jia178 by PHPExcel.");
		//关键字
		$objProps->setKeywords("jia178_product");
		//类别
		$objProps->setCategory("jia178_product");
		//设置当前的sheet
		$objExcel->setActiveSheetIndex(0);
		$objActSheet = $objExcel->getActiveSheet();
		//设置当前活动sheet的名称
		$objActSheet->setTitle('jia178_product');
		//*************************************
		//设置单元格内容
		//由PHPExcel根据传入内容自动判断单元格内容类型
		$objActSheet->setCellValue('A1', "首批推送产品");
		$objActSheet->setCellValue('A2', "编号");
		$objActSheet->setCellValue('B2', "所属项目房间");
		$objActSheet->setCellValue('C2', "产品名称");
		$objActSheet->setCellValue('D2', "尺寸图");
		$objActSheet->setCellValue('E2', "效果图");
		$objActSheet->setCellValue('F2', "细节图");
		$objActSheet->setCellValue('G2', "大品类");
		$objActSheet->setCellValue('H2', "品类");
		$objActSheet->setCellValue('I2', "产品链接");
		$objActSheet->setCellValue('J2', "款式名称");
		$objActSheet->setCellValue('K2', "缩略图片名");
		$objActSheet->setCellValue('L2', "品牌");
	
		$objActSheet->setCellValue('M2', "系列");
		$objActSheet->setCellValue('N2', "长(直径)");
		$objActSheet->setCellValue('O2', "宽");
		$objActSheet->setCellValue('P2', "高");
		$objActSheet->setCellValue('Q2', "单位");
		$objActSheet->setCellValue('R2', "价格");
		$objActSheet->setCellValue('S2', "品牌编号(工厂)");
		$objActSheet->setCellValue('T2', "产品描述");
		$objActSheet->setCellValue('U2', "主材描述");
		$objActSheet->setCellValue('V2', "辅材描述");
		$objActSheet->setCellValue('W2', "细节描述");
		
	
		//合并单元格
		//设置字体
		$objActSheet->mergeCells('A1:W1');
		$objStyleA1 = $objActSheet->getStyle('A1');
		$objFontA1 = $objStyleA1->getFont();
		$objFontA1->setSize(20);
		$objFontA1->setBold(true);
		$objFontA1->getColor()->setARGB('#000000');
		//设置对齐方式
		$objAlignA1 = $objStyleA1->getAlignment();
		$objAlignA1->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objAlignA1->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objActSheet->getStyle('A2:W2')->getFont()->setSize(12)->setBold(true);
	
		//垂直居中
		$objActSheet->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$outputFileName = "JIA178_PRODUCT.xls";
		header("Content-Type:application/octet-stream;charset=utf-8");
		header('Content-Disposition: attachment; filename=' . $outputFileName);
			
		$objWriter->save('php://output');
	}
	/**
	 * 上传
	 * @param array $upfile_arr  上传FILIE
	 *  $ext array;
	 *  $size string;
	 *  $urls  string;
	 *  
	 * @return array
	 */
	public function upload_class($upfile_arr,$ext ='',$size='',$urls=''){
		if(!$ext){
			$ext = $this->ext_arr;
		}
		if(!$size){
			$size = $this->max_size;
		}
		if(!$urls){
			$urls = $this->save_url;
		}
		if($upfile_arr === false OR !is_array($upfile_arr))return setError(0,'非法访问！');
	
		$error = $upfile_arr['error'];
		if($error>0){
			switch($error){
				case 1:
					//文件大小超出了服务器的空间大小
					return setError(0,'文件大小超出了服务器的空间大小');
					break;
	
				case 2:
					// 要上传的文件大小超出浏览器限制
					return setError(0,'要上传的文件大小超出浏览器限制');
					break;
					 
				case 3:
					// 文件仅部分被上传
					return setError(0,'文件仅部分被上传');
					break;
					 
				case 4:
					// 没有找到要上传的文件
					return setError(0,"没有找到要上传的文件");
					break;
					 
				case 5:
					// 服务器临时文件夹丢失
					return setError("服务器临时文件夹丢失");
					break;
	
				case 6:
					// 文件写入到临时文件夹出错
					return setError(0,'文件写入到临时文件夹出错.');
					break;
	
	
				default:
					//文件写入到临时文件夹出错
					return setError(0,'写入临时记忆文件失败.');
					break;
			}
	
		}else{
			if(is_uploaded_file($upfile_arr['tmp_name'])){
				$name_ext = setExt($upfile_arr['name']);
				if(!in_array($name_ext,$ext)) return setError(0,'你上传的文件格式不正确，请核对格式');
				if($upfile_arr['size']>($size)) return setError(0,'你上传的文件太大，请选择小于2M的文件');
				$save_file = $urls.time()."_".rand(1000,99999)."_abc.".$name_ext;
				if(!move_uploaded_file($upfile_arr['tmp_name'],$save_file)){
					return setError(0,'文件保存失败，请重新上传！');
				}else{
					return setError(1,$save_file);
				}
			}else{
				return setError(0,'非法上传文件!');
			}
		}
	
	}
	
	/**
	 * 分页
	 */
	public function show_page(){
		$this->CI->load->library('pagination');
		$config['base_url'] = $this->base_url;
		$config['total_rows'] = $this->total_rows;
		$config['use_page_numbers'] = TRUE;
	
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'current_page';
	
		$config['uri_segment'] = 5;
		//$config['num_links'] = 3;
	
		$config['first_link'] = ' 首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		
		$config['per_page'] = $this->per_page;
		$this->CI->pagination->initialize($config);
		return $this->CI->pagination->create_links();
	}
	
	//计算面积在那个范围
	public function mjzj($result,$pinf,$keys,$cou){

		preg_match("/(\d*[\s\S]?\d+)/", $result['tag_name'],$re);
	
		$ex = explode('~',$re[1]);


		if($keys == 0){
			if($pinf<$ex[0]){
				return $result['tag_id'];
			}else{
				return false;
			}
		}elseif ($keys == ($cou-1)){
			if($pinf>=$ex[0]){
				return $result['tag_id'];
			}else{
				return false;
			}
		}else{
			if(!empty($ex[1])){
				if(($ex[0]-$pinf<=0) && ($ex[1]-$pinf>0)){
					return $result['tag_id'];
				}else{
					return false;
				}
			}
		}
	
	}
	
	public function insertap($result,$va,$default='无'){

 			if($va == $default){
 				return add_arr($result[0]['tag_id'], $result[0]['tag_name'], 1);
 			}else{
 				preg_match("/(\d+)/",$va,$cha);
 				$pinf = $cha[1];
 				foreach ($result as $key=>$val){
 					
 					if($id = $this->mjzj($val,$pinf,$key,count($result))){
 						return add_arr($id,$val['tag_name'],1);
 						break;
 					}else{
 						continue;
 					}
 					return false;
 				}
 			}
	}

	public function inserttag($tag_name,$cell,$row,$vlue){
		$this->excelm->table = 't_tag';
		$this->excelm->field = 'tag_id';
		$this->excelm->resulttype = 'row_array';
		$this->excelm->where=array('tag_name'=>$tag_name);
		if($rows = $this->excelm->select_tag()){
			return add_arr($rows['tag_id'],$tag_name,1);
		}else{
			
			$this->excelm->data = array(
					'tag_name'=>$tag_name,
					'tag_users'=>'0',
					'tag_type'=>1,
					'tag_motif'=>'0',
					'tag_seokey'=>$tag_name,
					'tag_seodesc'=>$tag_name,
					'tag_count'=>0
			);
			//添加标签表
			if($s_tag_id =$this->excelm->insertinto_tag()){
				//标签成功，添加标签和分类关联
				$this->excelm->table = 't_system_class';
				$this->excelm->field = 's_class_id';
				$this->excelm->resulttype = 'row_array';
				$this->excelm->where=array('s_class_name'=>$vlue);
				if($rows = $this->excelm->select_tag()){
					$this->excelm->table = 't_s_class_tag';
					$this->excelm->data = array(
							's_tag_id'=>$s_tag_id,
							's_class_id'=>$rows['s_class_id']
					);
					if($this->excelm->insertinto_tag()){
						model("t_system_class")->system_class_status($rows['s_class_id'],'s_class_numbers','+');
						return add_arr($s_tag_id,$tag_name,1);
					}else{
						$mes = "该".$tag_name."所在单元格{$cell}{$row}的插入分类关联数据失败!";
						write_dary($mes);
					}
				}else{
					$mes = "该".$tag_name."所在单元格{$cell}{$row}的无该分类插入数据失败!";
					write_dary($mes);
				}
				
			}else {
				//插入标签关联表失败
				$mes = "该".$tag_name."所在单元格{$cell}{$row}的插入数据失败!";
				write_dary($mes);
			}
			
		}
		
	}
	
	public function typeclass($type,$st,$cols,$row){

		//插入 系统分类表  t_system_class
		$this->excelm->table = 't_system_class';
		$this->excelm->field = 's_class_id';
		$this->excelm->resulttype = 'row_array';
		$this->excelm->where=array('s_class_name'=>$type);
		if($rows = $this->excelm->select_tag()){
			return $this->insertag($rows['s_class_id'],$st ,$cols,$row);
		}else{
			$this->excelm->data = array(
					's_class_pid'=>0,
					's_class_depth'=>1,
					's_class_name'=>$type,
					's_class_numbers'=>0,
					's_class_type'=>11,
					's_class_sort'=>0,
					's_class_view'=>0
			);
			if($s_class_id =$this->excelm->insertinto_tag()){
				return $this->insertag($s_class_id,trim($st),$cols,$row);
			}
		}
	}
	//插入标签表和分类标签关联表
	public function insertag($s_class_id,$tag_name,$cell,$row){
		$this->excelm->table = 't_s_class_tag';
		$this->excelm->field = 's_tag_id';
		$this->excelm->resulttype = 'result_array';
		$this->excelm->where=array('s_class_id'=>$s_class_id);
		//分类标签关联表没有的话，则说明这个类中没有这个标签，则考虑标签表有没有，标签表是唯一的
		if(!$result = $this->excelm->select_tag()){
			//查找标签表中是否有没
			$this->excelm->table = 't_tag';
 			$this->excelm->field = 'tag_id';
 			$this->excelm->resulttype = 'row_array';
 			$this->excelm->where=array('tag_name'=>$tag_name);
 			if($rows = $this->excelm->select_tag()){
 				// 有
 				$this->excelm->table = 't_s_class_tag';
 				$this->excelm->data = array(
 						's_tag_id'=>$rows['tag_id'],
 						's_class_id'=>$s_class_id
 				);
 				if($this->excelm->insertinto_tag()){
 					return add_arr($rows['tag_id'],$tag_name,1);
 				}else{
 					//插入标签关联表失败
 					$mes = "该".$tag_name."所在单元格{$cell}{$row}的插入数据失败！";
 					write_dary($mes);
 				}
 				
 			
 			}else{
 				
 				$this->excelm->table = 't_tag';
 				$this->excelm->data = array(
 						'tag_name'=>$tag_name,
 						'tag_users'=>0,
 						'tag_type'=>1,
 						'tag_motif'=>0,
 						'tag_count'=>0
 				);
 				//添加成功时，则添加分类标签关联表
 				if($s_tag_id =$this->excelm->insertinto_tag()){
 					$this->excelm->table = 't_s_class_tag';
 					$this->excelm->data = array(
 							's_tag_id'=>$s_tag_id,
 							's_class_id'=>$s_class_id
 					);
 					if($this->excelm->insertinto_tag()){
 						return add_arr($s_tag_id,$tag_name,1);
 					}else{
 						//插入标签关联表失败
 						$mes = "该".$tag_name."所在单元格{$cell}{$row}的插入数据失败！";
 						write_dary($mes);
 					}
 				}else{
 					// 添加标签表失败
 					$mes = "该".$tag_name."所在单元格{$cell}{$row}的插入数据失败！";
 					write_dary($mes);
 				}
 				
 				
 			}
			

		}else{
			//关联表中有数据
			//查找标签表中是否有没 、、这个标签有是否在分类关联标签中关联 如果标签表没有这个表标签，则说明分类关联表中不可能 被关联
			$this->excelm->table = 't_tag';
			$this->excelm->field = 'tag_id';
			$this->excelm->resulttype = 'row_array';
			$this->excelm->where=array('tag_name'=>$tag_name);
			if($rows = $this->excelm->select_tag()){
				$s_class_idarr = twotoone_array($result,'s_tag_id');
				//标签是否在这个分类标签关联表中关联
				if(!in_array($rows['tag_id'], $s_class_idarr)){
					// 没在分类标签关联表中关联
					$this->excelm->table = 't_s_class_tag';
					$this->excelm->data = array(
							's_tag_id'=>$rows['tag_id'],
							's_class_id'=>$s_class_id
					);
					if($this->excelm->insertinto_tag()){
							return add_arr($rows['tag_id'],$tag_name,1);
					}else{
						//插入标签关联表失败
						$mes = "该".$tag_name."所在单元格{$cell}{$row}的插入数据失败！";
						write_dary($mes);
					}
				}else{
					return add_arr($rows['tag_id'],$tag_name,1);
				}
				
			}else{
			
				$this->excelm->table = 't_tag';
				$this->excelm->data = array(
						'tag_name'=>$tag_name,
						'tag_users'=>0,
						'tag_type'=>1,
						'tag_motif'=>0,
						'tag_count'=>0
				);
				//添加成功时，则添加分类标签关联表
				if($s_tag_id =$this->excelm->insertinto_tag()){
					$this->excelm->table = 't_s_class_tag';
					$this->excelm->data = array(
							's_tag_id'=>$s_tag_id,
							's_class_id'=>$s_class_id
					);
					if($this->excelm->insertinto_tag()){
						return add_arr($s_tag_id,$tag_name,1);
					}else{
						//插入标签关联表失败
						$mes = "该".$tag_name."所在单元格{$cell}{$row}的插入数据失败！";
						write_dary($mes);
					}
				}else{
					// 添加标签表失败
					$mes = "该".$tag_name."所在单元格{$cell}{$row}的插入数据失败！";
					write_dary($mes);
				}
			}
		}	
	}
	//插入品牌表和产品类别品牌表
	public function insert_brand($brand_name,$row,$category_id){
		$this->CI->config->load('uploads');
		$upload_url = $this->CI->config->item('upload_product');
		//先判断品牌表中是否有 如果没有则插入品牌表 再插入产品类别品牌表 再抬出品牌id 如果品牌表中有，则判断产品类别品牌表中是否关联了，没有关联再返出品牌id 如果关联了则返回品牌id
		if($brand = $this->t_product_brands->get_brand('brand_id',array('brand_name'=>$brand_name))){
			if($this->t_product_class_brands_series->get_class_brands_series('b_s_id',array('brand_id'=>$brand[0]['brand_id'],'s_class_id'=>$category_id))){
				return $brand[0]['brand_id'];
			}else{
				$this->t_product_class_brands_series->brand_id = $brand[0]['brand_id'];
				$this->t_product_class_brands_series->s_class_id = $category_id;
				if($this->t_product_class_brands_series->insert()){
					return $brand[0]['brand_id'];
				}else{
					$mes = "该<<".$brand_name.">>品牌所在单元格L{$row}插入产品类别品牌表数据失败！";
					$ulr = $upload_url['error_url'];
					write_dary($mes,$ulr);
					return false;
				}
			}
		}else{
			$this->t_product_brands->brand_name = $brand_name;
			$this->t_product_brands->brand_seodesc = $brand_name;
			$this->t_product_brands->brand_img = "";
			$this->t_product_brands->brand_products = 0;
			$this->t_product_brands->brand_seokey = $brand_name;
			$this->t_product_brands->brand_url = "http://www.jia178.com";
			$this->t_product_brands->brand_services = 0;
			if($inset_id = $this->t_product_brands->insert()){
				$this->t_product_class_brands_series->brand_id = $inset_id;
				$this->t_product_class_brands_series->s_class_id = $category_id;
				if($this->t_product_class_brands_series->insert()){
					return $inset_id;
				}else{
					$mes = "该<<".$brand_name.">>品牌所在单元格L{$row}插入产品类别品牌表数据失败！";
					$ulr = $upload_url['error_url'];
					write_dary($mes,$ulr);
					return false;
				}
			}else{
				$mes = "该<<".$brand_name.">>品牌所在单元格L{$row}插入产品品牌表数据失败！";
				$ulr = $upload_url['error_url'];
				write_dary($mes,$ulr);
				return false;
			}
		}
	}
	//插入系列表
	public function insert_series($brand_id,$series_name,$row){
		$this->CI->config->load('uploads');
		$upload_url = $this->CI->config->item('upload_product');
		if($series = $this->t_product_brands_series->get_series('series_id',array('brand_id'=>$brand_id,'series_name'=>$series_name))){
			return $series[0]['series_id'];
		}else{
			$this->t_product_brands_series->brand_id = $brand_id;
			$this->t_product_brands_series->series_name = $series_name;
			$this->t_product_brands_series->series_seodesc = $series_name;
			$this->t_product_brands_series->series_seokey = $series_name;
			if($inset_id = $this->t_product_brands_series->insert()){
				return $inset_id;
			}else{
				$mes = "该<<".$series_name.">>系列所在单元格M{$row}插入产品品牌系列表数据失败！";
				$ulr = $upload_url['error_url'];
				write_dary($mes,$ulr);
				return false;
			}
		}
	}
	//插入款式
	public function insert_pattern($s_c_tag_id,$pattern_type,$row){
		$this->CI->config->load('uploads');
		$upload_url = $this->CI->config->item('upload_product');
		if($pattern = $this->t_system_product_pattern->get_pattern('pattern_id',array('s_c_tag_id'=>$s_c_tag_id,'pattern_type'=>$pattern_type))){
			return $pattern[0]['pattern_id'];
		}else{
			$this->t_system_product_pattern->s_c_tag_id = $s_c_tag_id;
			$this->t_system_product_pattern->pattern_type = $pattern_type;
			$this->t_system_product_pattern->pattern_img = '';
			$this->t_system_product_pattern->pattern_sort = 0;
			$this->t_system_product_pattern->pattern_seodesc = $pattern_type;
			if($inset_id = $this->t_system_product_pattern->insert()){
				return $inset_id;
			}else{
				$mes = "该<<".$pattern_type.">>款式所在单元格J{$row}插入产品款式表数据失败！";
				$ulr = $upload_url['error_url'];
				write_dary($mes,$ulr);
				return false;
			}
		}
	}
}
