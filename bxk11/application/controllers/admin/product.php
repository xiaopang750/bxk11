<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/27 10:30:17 
 *        liuguangpingAuthor: 刘广平
 *        Email: liuguangpingtest@163.com

 */
class Product extends Admin_Controller
{	
	public $product;
	public $navpage;
	public $t_system_class;
	public $t_s_class_tag;
	public $t_system_product_pattern;
	public $t_product_brands;
	public $t_product_class_brands_series;
	public $brands_series;//产品系列
	public $t_product_brands_series;
	public $t_certified_product;
	public $t_service_info;
	public $t_service_goods;
	public $t_certified_product_tag;
	public $t_certified_product_info;
	public $t_certified_pack_item;
	public $t_certified_pack;
	public $limit;
	public $libs;
	public function __construct(){
		parent::__construct();
	
		$this->product = 'product';
		$this->navpage = 'product/nav';
		//require_once('./lib/FirePHPCore/fb.php');
		//ob_start();
		//fb('',FirePHP::TRACE);
		$this->load->model('t_system_class_model');	
		$this->t_system_class = $this->t_system_class_model;
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;	
		$this->load->model('t_s_class_tag_model');
		$this->t_s_class_tag = $this->t_s_class_tag_model;
		
		$this->load->model('t_service_info_model');
		$this->t_service_info = $this->t_service_info_model;
		$this->load->model('t_service_goods_model');
		$this->t_service_goods = $this->t_service_goods_model;
		
		//$this->load->model('t_certified_pack_item_model');
		//$this->t_certified_pack_item = $this->t_certified_pack_item_model;

		$this->load->model('t_system_product_pattern_model');
		$this->t_system_product_pattern = $this->t_system_product_pattern_model;
		
		//$this->load->model('t_certified_pack_model');
		//$this->t_certified_pack =  $this->t_certified_pack_model;
		
		$this->load->model('t_product_brands_model');
		$this->t_product_brands = $this->t_product_brands_model;
		$this->load->model('t_product_class_brands_model');
		$this->t_product_class_brands_series = $this->t_product_class_brands_model;
/*		$this->load->model('t_product_class_brands_series_model');
		$this->brands_series = $this->t_product_class_brands_series_model;*/
		$this->load->model('t_product_brands_series_model');
		$this->t_product_brands_series = $this->t_product_brands_series_model;
		//$this->load->model('t_certified_product_model');
		//$this->t_certified_product = $this->t_certified_product_model;
		//$this->load->model('t_certified_product_tag_model');
		//$this->t_certified_product_tag = $this->t_certified_product_tag_model;
		//$this->load->model('t_certified_product_info_model');
		//$this->t_certified_product_info = $this->t_certified_product_info_model;
		$this->limit = 10;
		$this->load->helper('url');
		
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');

	}
	public function index(){
		$data['title']='家178-产品管理';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/index';
		$this->navpage = $this->navpage;
		$result = array();

		$field = "s_class_id,s_class_name";
		$where = array('s_class_type'=>12,'s_class_pid'=>0);
		$result['product_class'] = $this->t_system_class->get_tag($field,$where);
		
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		
		$brand_id = $this->input->get('brand_id');
		$series_id = $this->input->get('series_id');
		$pattern_id = $this->input->get('pattern_id');
		$product_status =  $this->input->get('product_status');
		$code = $this->input->get('code');
		$key_word = $this->input->get('key_word');
		$product_name = $this->input->get('product_name');
		$total_rows = count($this->t_certified_product->admin_search_count($brand_id,$series_id,$pattern_id,$code,$key_word,$product_name,$product_status));
		$office =  ($page-1)*($this->limit);
		$result['brand_id'] = $brand_id;
		$result['series_id'] = $series_id;
		$result['pattern_id'] = $pattern_id;
		$result['code'] = $code;
		$result['key_word'] = $key_word;
		$result['product_name'] = $product_name;
		$result['product_status'] = $product_status;
		$result['re'] = $this->t_certified_product->admin_search($brand_id,$series_id,$pattern_id,$code,$key_word,$product_name,$product_status,$office,$this->limit);
		$this->libs->base_url = site_url('admin/product/index').'?search=0&brand_id='.$brand_id."&pattern_id=".$pattern_id."&code=".$code."&key_word=".$key_word."&key_word=".$key_word.'&product_status='.$product_status;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$this->pagedata = $result;
		parent::_initpage();

		
		/* $brand_id = $this->input->get('brand_id');
		$series_id = $this->input->get('series_id');
		$pattern_id = $this->input->get('pattern_id');
		$code = $this->input->get('code');
		$key_word = $this->input->get('key_word');
		
		$result['re'] = $this->t_certified_product->admin_searchproduct($brand_id,$series_id,$pattern_id,$code,$key_word); */
	}
	
	public function add(){
		
		$data['title']='家178-产品管理';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/add';
		$this->navpage = $this->navpage;
		$result = array();
		
		$field = "s_class_id,s_class_name";
		$where = array('s_class_type'=>12,'s_class_pid'=>0);
		$result['product_class'] = $this->t_system_class->get_tag($field,$where);
		$fieds = 'service_id,service_name';
		$result['service'] = $this->t_service_info->get_tag($fieds,"service_id !=''");

		$result['randcode'] =  "JIA178".time().randcode(5);
		$result['product_hot'] = "5";
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function doadd(){
		$this->t_certified_product->brand_id=$this->input->post('brand_id',true);
		$this->t_certified_product->series_id=$this->input->post('series_id',true);
		$this->t_certified_product->pattern_id=$this->input->post('pattern_id',true);
		$this->t_certified_product->product_system_code=$this->input->post('product_system_code',true);
		$this->t_certified_product->product_brand_code=$this->input->post('product_brand_code',true);
		$this->t_certified_product->product_name=$this->input->post('product_name',true);
		$this->t_certified_product->product_price=$this->input->post('product_price',true);
		$this->t_certified_product->product_key_word=str_replace('，', ',', $this->input->post('product_key_word',true));
		$this->t_certified_product->product_unit=$this->input->post('product_unit',true);
		
		$this->t_certified_product->product_long=$this->input->post('product_long',true);
		$this->t_certified_product->product_width=$this->input->post('product_width',true);
		$this->t_certified_product->product_high=$this->input->post('product_high',true);
		$this->t_certified_product->product_hot=$this->input->post('product_hot',true);
		$this->t_certified_product->product_views=0;
		$this->t_certified_product->product_like=0;
		$this->t_certified_product->product_downs=0;
		$this->t_certified_product->product_disc=0;
		$this->t_certified_product->product_rooms=0;
		$this->t_certified_product->product_service=0;
		$this->t_certified_product->product_is_hot=$this->input->post('product_is_hot',true);
		$this->t_certified_product->product_sort=$this->input->post('product_sort',true);
		$this->t_certified_product->product_index=$this->input->post('product_index',true);
		$this->t_certified_product->product_status=$this->input->post('product_status',true);
		
		$this->t_certified_product_info->product_description=$this->input->post('product_description',true);
		$this->t_certified_product_info->product_materials=$this->input->post('product_materials',true);
		$this->t_certified_product_info->product_auxiliary=$this->input->post('product_auxiliary',true);
		
		$this->t_certified_product_info->product_detailspic= '';
		$this->t_certified_product_info->product_details = "";
		$this->t_certified_product_info->product_sizepic = "";
		$this->t_certified_product_info->product_resultpic = "";
		$this->t_certified_product_info->product_model = '';
		
		/* $this->config->load('uploads');
		$config = $this->config->item('product');
		$this->load->library('upload');
		$this->upload->initialize($config);
		
		if(mkdirs($config['upload_path'])){
			if($this->upload->do_upload('product_thumb')){
				$data = $this->upload->data();
			
				if(mkdirs($config['thumb_1'])){
					if(copy($config['upload_path'].$data['file_name'], $config['thumb_1'].$data['file_name'])){
						$this->t_certified_product->product_pic = $config['thumb_relative_path'].$data['file_name'];
					}else{
						@unlink($config['upload_path'].$data['file_name']);
						$this->t_certified_product->product_pic = '';
					}
				}else{
					@unlink($config['upload_path'].$data['file_name']);
					$this->t_certified_product->product_pic = '';
				}
			}else{
				$this->t_certified_product->product_pic = '';
			}
		}else{
			$this->t_certified_product->product_pic = '';
		} */

		if($this->input->post('product_result') && $this->input->post('product_thumb')){
			$this->t_certified_product->product_pic = $this->input->post('product_thumb');
		}else{
			echo "<script type='text/javascript'>alert('请上传产品图片！');window.location.href='".site_url('admin/product/add')."'</script>";exit;
		}
		
		if($product_id = $this->t_certified_product->insert()){
			$this->t_product_brands->updataproduct_brands('brand_products',$this->t_certified_product->brand_id,'1');
			$this->t_certified_product_tag->tag_id = $this->input->post('s_c_tag_id',true);
			$this->t_certified_product_tag->product_id = $product_id;
			/* //效果图
			$this->config->load('uploads');
			$config = $this->config->item('result');
			$this->load->library('upload');
			$config['upload_path'] = $config['upload_path'].$product_id.'/';
			$this->upload->initialize($config);
			
			if(mkdirs($config['upload_path'])){
				if($this->upload->do_upload('product_result')){
					$data = $this->upload->data();
						
					if(mkdirs($config['b'].$product_id) && mkdirs($config['m'].$product_id)){
						$source = $config['upload_path'].$data['file_name'];
						$b = $config['b'].$product_id.'/'.$data['file_name'];
						$m = $config['m'].$product_id.'/'.$data['file_name'];
						if(copy($source, $b) && copy($source, $m)){
							$this->t_certified_product->product_resultpic = $data['file_name'];
						}else{
							@unlink($b);
							@unlink($m);
							$this->t_certified_product->product_pic = '';
						}
					}else{
						@unlink($config['upload_path'].$data['file_name']);
						$this->t_certified_product->product_pic = '';
					}
				}else{
					$this->t_certified_product->product_pic = '';
				}
			}else{
				$this->t_certified_product->product_pic = '';
			} */
			//$this->t_certified_product->product_pic = $this->input->post('product_pic');
			if($this->t_certified_product_tag->insert()){
				$this->t_certified_product_info->product_id = $product_id;
				$this->t_certified_product_info->product_resultpic = $this->input->post('product_result');
				$this->t_certified_product_info->insert();
				if($service_id = $this->input->post('service_id')){
					$this->t_service_goods->service_id = $service_id;
					$this->t_service_goods->product_id = $product_id;
					$this->t_service_goods->goods_price = $this->input->post('goods_price');
					$this->t_service_goods->goods_upset = $this->input->post('goods_upset');
					$this->t_service_goods->goods_title = $this->input->post('goods_title')?$this->input->post('goods_title'):'标题';
					$this->t_service_goods->goods_desc = $this->input->post('goods_desc')?$this->input->post('goods_desc'):'描述';
					$this->t_service_goods->goods_code = $this->input->post('goods_code')?$this->input->post('goods_code'):'123456';
					$this->t_service_goods->goods_stock = $this->input->post('goods_stock')?$this->input->post('goods_stock'):'1000';
					$this->t_service_goods->insert();
	
				}
				echo "<script type='text/javascript'>alert('添加成功！');window.location.href='".site_url('admin/product/add')."'</script>";exit;
			}else{
				echo "<script type='text/javascript'>alert('产品标签表,添加失败！');window.location.href='".site_url('admin/product/add')."'</script>";exit;
			}
			
		}else{
			echo "<script type='text/javascript'>alert('添加失败！');window.location.href='".site_url('admin/product/add')."'</script>";exit;
		}
		
	}
	//产品编辑
	public function edit(){
		$data['title']='家178-内容管理';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/edit';
		$this->navpage = $this->navpage;
		$result = array();
		$product_id = $this->input->get('product_id');
		if($product_id){
			$result['re'] = $this->t_certified_product->get($product_id);
			$result['info'] = $this->t_certified_product_info->get($product_id);
			$this->config->load('uploads');
			$index = $this->config->item('product');
			$result['index'] = $index['relative_path'].'index';
			$fieds = 'service_id,service_name';
			$result['service'] = $this->t_service_info->get_tag($fieds,"service_id !=''");
			$fiedsz = 'service_id,product_id,goods_title,goods_price,goods_upset';
			$where['product_id'] = $product_id;
			$result['service_goods'] = $this->t_service_goods->get_tag($fiedsz,$where);
			
			$field = "s_class_id,s_class_name";
			$where = array('s_class_type'=>12,'s_class_pid'=>0);
			$result['product_class'] = $this->t_system_class->get_tag($field,$where);
			
			$this->pagedata = $result;
			parent::_initpage();
		}else{
			echo "<script type='text/javascript'>alert('非法操作！');window.location.href='".site_url('admin/product/eidt')."?product_id={$product_id}'</script>";exit;
		}
		
	}
	public function doedit(){
		$brand_id = $this->input->post('brand_id',true);
		$series_id = $this->input->post('series_id',true);
		$pattern_id = $this->input->post('pattern_id',true);
		if($brand_id){
			$data['brand_id'] = $brand_id;
		}else{
			$data['brand_id'] = $this->input->post('brand_id_bak',true);
		}
		
		if($series_id){
			$data['series_id'] = $series_id;
		}else{
			$data['series_id'] = $this->input->post('series_id_bak',true);
		}
		
		if($pattern_id){
			$data['pattern_id']  = $pattern_id;
		}else{
			$data['pattern_id'] = $this->input->post('pattern_id_bak',true);
		}
		$data['product_brand_code']=$this->input->post('product_brand_code',true);
		$data['product_name']=$this->input->post('product_name',true);
		$data['product_hot'] = $this->input->post('product_hot',true);
		$data['product_price']=$this->input->post('product_price',true);
		$data['product_key_word']=str_replace('，', ',', $this->input->post('product_key_word',true));
		$data['product_unit']=$this->input->post('product_unit',true);
		
		$data['product_long']=$this->input->post('product_long',true);
		$data['product_width']=$this->input->post('product_width',true);
		$data['product_high']=$this->input->post('product_high',true);
		$data['product_hot']=$this->input->post('product_hot',true);
		
		$data['product_is_hot']=$this->input->post('product_is_hot',true);
		$data['product_sort']=$this->input->post('product_sort',true);
		$data['product_index']=$this->input->post('product_index',true);
		$data['product_status']=$this->input->post('product_status',true);
	
		
		$oldres = $this->t_certified_product->get($this->input->post('product_id'));
		//$this->config->load('uploads');
		//$index = $this->config->item('product');
		//$thumb_1name = $index['relative_path'].'index'.$oldres->product_pic;
		//$source_1name = $index['relative_path'].'source'.$oldres->product_pic;
		$thumb_1name ='uploads/product/index'.$oldres->product_pic;
		$source_1name ='uploads/product/source'.$oldres->product_pic;
		if($this->input->post('product_thumb',true)){
			$data['product_pic']= $this->input->post('product_thumb',true);
			@unlink($thumb_1name);
			@unlink($source_1name);
		}
		// 修改经销商商品表
		$fiedsz = 'service_id,product_id,goods_title,goods_price,goods_upset';
		$where['product_id'] = $this->input->post('product_id');
		$service_goods = $this->t_service_goods->get_tag($fiedsz,$where);
		if($service_goods){
			if($service_id = $this->input->post('service_id')){
				$dateinf['service_id'] = $service_id;
				$dateinf['goods_price'] = $this->input->post('goods_price');
				$dateinf['goods_upset'] = $this->input->post('goods_upset');
				$dateinf['goods_title'] = $this->input->post('goods_title')?$this->input->post('goods_title'):'标题';
				$dateinf['goods_desc']  = $this->input->post('goods_desc')?$this->input->post('goods_desc'):'描述';
				$dateinf['goods_code']  = $this->input->post('goods_code')?$this->input->post('goods_code'):'123456';
				$dateinf['goods_stock'] = $this->input->post('goods_stock')?$this->input->post('goods_stock'):'1000';
				$this->t_service_goods->updates_global($dateinf,array('product_id'=>$this->input->post('product_id')));
			}
		}else {
			if($service_id = $this->input->post('service_id')){
			$this->t_service_goods->service_id = $service_id;
			$this->t_service_goods->product_id = $this->input->post('product_id');
			$this->t_service_goods->goods_price = $this->input->post('goods_price');
			$this->t_service_goods->goods_upset = $this->input->post('goods_upset');
			$this->t_service_goods->goods_title = $this->input->post('goods_title')?$this->input->post('goods_title'):'标题';
			$this->t_service_goods->goods_desc = $this->input->post('goods_desc')?$this->input->post('goods_desc'):'描述';
			$this->t_service_goods->goods_code = $this->input->post('goods_code')?$this->input->post('goods_code'):'123456';
			$this->t_service_goods->goods_stock = $this->input->post('goods_stock')?$this->input->post('goods_stock'):'1000';
			$this->t_service_goods->insert();
			}
		}
		
		if($this->t_certified_product->updates_global($data,array('product_id'=>$this->input->post('product_id')))){
			$dateinfo['product_description']=$this->input->post('product_description',true);
			$dateinfo['product_materials']=$this->input->post('product_materials',true);
			$dateinfo['product_auxiliary']=$this->input->post('product_auxiliary',true);
			if($this->t_certified_product_info->updates_global($dateinfo,array('product_id'=>$this->input->post('product_id')))){
				
				echo "<script type='text/javascript'>alert('修改成功！');window.location.href='".site_url('admin/product/index')."'</script>";exit;
			}else{
				echo "<script type='text/javascript'>alert('修改失败！');window.location.href='".site_url('admin/product/edit')."?product_id={$this->input->post('product_id')}'</script>";exit;
			}
		}else{
			echo "<script type='text/javascript'>alert('修改失败！');window.location.href='".site_url('admin/product/edit')."?product_id={$this->input->post('product_id')}'</script>";exit;
		}
		
	}
	//产品款式
	public function pattern(){

		$data['title']='家178-内容管理';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/pattern';
		$this->navpage = $this->navpage;
		$result = array();
		
		$field = "s_class_id,s_class_name";
		$where = array('s_class_type'=>12,'s_class_pid'=>0);
		$result['product_class'] = $this->t_system_class->get_tag($field,$where);
		
		
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		//根据
		$s_tag_id = $this->input->get('s_c_tag_id'); //标签id
		$s_class_id = $this->input->get('s_class_id'); //分类id
		$pattern_type = $this->input->get('pattern_type'); //款式名

		$total_rows = count($this->t_system_product_pattern->admin_search_count($s_tag_id,$s_class_id,$pattern_type));
		$office =  ($page-1)*($this->limit);
		$result['pattern_type'] = $pattern_type;
		$result['re'] = $this->t_system_product_pattern->admin_search($s_tag_id,$s_class_id,$pattern_type,$office,$this->limit);
		$this->libs->base_url = site_url('admin/product/pattern').'?search=0&s_c_tag_id='.$s_tag_id."&s_class_id=".$s_class_id."&pattern_type=".$pattern_type;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();

		//require_once('./lib/FirePHPCore/fb.php');


		//echo "<pre>";var_dump($result);die;
		$this->pagedata = $result;
		parent::_initpage();

	}
	//编辑款式
	public function pattern_edit(){
		$data['title']='家178-内容管理';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/pattern_edit';
		$this->navpage = $this->navpage;
		$result = array();
		$pattern_id = $this->input->get('pattern_id');
		$result['re'] = $this->t_system_product_pattern->get($pattern_id);
		$this->config->load('uploads');
		$index = $this->config->item('product');
		$result['thumb_3'] = $index['relative_path'].'thumb_3';
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function dopattern_edit(){

		$data['pattern_type']=$this->input->post('pattern_type',true);
		$data['pattern_sort']=$this->input->post('pattern_sort',true);
		$data['pattern_seodesc']=$this->input->post('pattern_seodesc',true);
		$pattern = $this->t_system_product_pattern->get($this->input->post('pattern_id'));
		//$this->config->load('uploads');
		//$index = $this->config->item('product');
		//$thumb_1name = $index['relative_path'].'index'.$oldres->product_pic;
		//$source_1name = $index['relative_path'].'source'.$oldres->product_pic;
		$source_name ='uploads/product/source'.$pattern->pattern_img;
		$thumb_1name ='uploads/product/thumb_1'.$pattern->pattern_img;
		$thumb_2name ='uploads/product/thumb_2'.$pattern->pattern_img;
		$thumb_3name ='uploads/product/thumb_3'.$pattern->pattern_img;
		if($this->input->post('pattern_img')){
			@unlink($source_name);
			@unlink($thumb_1name);
			@unlink($thumb_2name);
			@unlink($thumb_3name);
			$data['pattern_img']=$this->input->post('pattern_img',true);
		}/* else{
			echo "<script type='text/javascript'>alert('请上传品牌图标！');window.location.href='".site_url('admin/product/brands_add')."'</script>";exit;
		} */
		if($this->t_system_product_pattern->updates_global($data,array('pattern_id'=>$this->input->post('pattern_id',true)))){
			
			echo "<script type='text/javascript'>alert('修改成功！');window.location.href='".site_url('admin/product/pattern')."'</script>";exit;
		}else{
			echo "<script type='text/javascript'>alert('修改失败！');window.location.href='".site_url('admin/product/pattern')."'</script>";exit;
		}
	}
	//款式删除
	public function dodelpattern(){
		$ids = $this->input->post('ids');
		$idarr = explode(',',$ids);
		$temarr = array();
		foreach($idarr as $val){
			
			if($this->t_system_product_pattern->delete($val)){
				$temarr[] = $val;
			}
		}
		if($temarr){
			echo json_encode($temarr);
		}else{
			echo "0";
		}
	}
	public function pattern_add(){
		$data['title']='家178-内容管理';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/pattern_add';
		$this->navpage = $this->navpage;
		$result = array();
		
		$field = "s_class_id,s_class_name";
		$where = array('s_class_type'=>12,'s_class_pid'=>0);
		$result['product_class'] = $this->t_system_class->get_tag($field,$where);
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function dopattern_add(){
		
		//$this->t_system_product_pattern->s_c_tag_id=$this->input->post('s_c_tag_id',true);
		$s_class_id = $this->input->post('s_class_id',true);
		$s_tag_id = $this->input->post('s_c_tag_id',true);
		$s_c_tag_id = $this->t_s_class_tag->get_tag('s_c_tag_id',array('s_class_id'=>$s_class_id,'s_tag_id'=>$s_tag_id));
		$this->t_system_product_pattern->s_c_tag_id=$s_c_tag_id[0]['s_c_tag_id'];
		$this->t_system_product_pattern->pattern_type=$this->input->post('pattern_type',true);

		$this->t_system_product_pattern->pattern_sort=$this->input->post('pattern_sort',true);
		$this->t_system_product_pattern->pattern_seodesc=$this->input->post('pattern_seodesc',true);
		if($this->input->post('pattern_img')){
			$this->t_system_product_pattern->pattern_img=$this->input->post('pattern_img',true);
		}else{
			echo "<script type='text/javascript'>alert('请上传品牌图标！');window.location.href='".site_url('admin/product/brands_add')."'</script>";exit;
		}
		if($this->t_system_product_pattern->get_pattern('pattern_id',array('s_c_tag_id'=>$s_c_tag_id[0]['s_c_tag_id'],'pattern_type'=>$this->t_system_product_pattern->pattern_type))){
			echo "<script type='text/javascript'>alert('不能在同一个分类下添加相同的款式！');window.location.href='".site_url('admin/product/pattern_add')."'</script>";exit;
		}else{
			if($this->t_system_product_pattern->insert()){
				echo "<script type='text/javascript'>alert('添加成功！');window.location.href='".site_url('admin/product/pattern_add')."'</script>";exit;
			}else{
				echo "<script type='text/javascript'>alert('添加失败！');window.location.href='".site_url('admin/product/pattern_add')."'</script>";exit;
			}
		}
	
	}
	//产品品牌
	public function brands(){
		$data['title']='家178-内容管理';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/brands';
		$this->navpage = $this->navpage;
		$result = array();

		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		
		$brand_name = $this->input->get('brand_name');
		//echo $brand_name;die;
		$total_rows = $this->t_product_brands->count_search('brand_name',$brand_name);
		$office =  ($page-1)*($this->limit);
		$result['brand_name'] = $brand_name;

		$result['re'] = $this->t_product_brands->search('brand_name',$brand_name,$this->limit,$office,'brand_id','DESC');

		$this->libs->base_url = site_url('admin/product/brands').'?search=0&brand_name='.$brand_name;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$this->pagedata = $result;
	
		parent::_initpage();
	}
	
	public function dodelbrand(){
		$ids = $this->input->post('ids');
		$idarr = explode(',',$ids);
		//var_dump($idarr);die;
		$temarr = array();
		foreach($idarr as $val){
			//删除系列
			$series = $this->t_product_brands_series->get_series('series_id',array('brand_id'=>$val));
			foreach ($series as $vals){
				$this->t_product_brands_series->delete($vals['series_id']);
			}
			//删除关联品牌表
			$t_product_class_brands_series = $this->t_product_class_brands_series->get_class_brands_series('b_s_id',array('brand_id'=>$val));
			foreach ($t_product_class_brands_series as $valb){
				$this->t_product_class_brands_series->delete($valb['b_s_id']);
			}
			if($this->t_product_brands->delete($val)){
				
				$temarr[] = $val;
			}
		}
		if($temarr){
			echo json_encode($temarr);
		}else{
			echo "0";
		}
	}
	//
	public function brands_add(){
		$data['title']='家178-内容管理';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/brands_add';
		$this->navpage = $this->navpage;
		$result = array();
		
		$field = "s_class_id,s_class_name";
		$where = array('s_class_type'=>12,'s_class_pid'=>0);
		$result['product_class'] = $this->t_system_class->get_tag($field,$where);

		$this->load->model('t_service_brands_apply_model');
		$apply_id = $this->input->get('apply_id');
		if(isset($apply_id)&&$apply_id){
			$result['apply'] = $this->t_service_brands_apply_model->get($apply_id);
			if(!file_exists('.'.$result['apply']->apply_brand_img)){
				jumpAjax('品牌图片未加，请审核不通过！',site_url('admin/member/service_brands_apply'));
			}
			$apply_classidS = $result['apply']->apply_classid;
			$result['apply_classid'] = explode('|', $apply_classidS);
		}
		$s_class_id = $result['product_class'][0]['s_class_id'];
		$field = "s_class_name,s_class_id";
		//这个是为了向导标识
		$result['service_id'] = $this->input->get('service_id',true);
		$where = array('s_class_pid'=>$s_class_id);
		$result['productTwo'] = $this->t_system_class->get_tag($field,$where);
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function dobrands_add(){
		
		$s_class_id=$this->input->post('s_class_id',true);
		$service_id=$this->input->post('service_id',true);
		$this->t_product_brands->brand_name=$this->input->post('brand_name',true);
		$this->t_product_brands->brand_ename=$this->input->post('brand_ename',true);
		$this->t_product_brands->brand_seodesc=$this->input->post('brand_seodesc',true);
		$this->t_product_brands->brand_products=0;
		$this->t_product_brands->brand_url=$this->input->post('brand_url',true);
		$this->t_product_brands->brand_services=0;
		$this->t_product_brands->brand_seokey=$this->input->post('brand_seokey',true);
		$brand_flg = $this->input->post('brand_apply_img');
		$apply_id = $this->input->post('apply_id');
		$url = site_url('admin/product/brands_add')."?apply_id=".$apply_id;
		if($brand_flg && !$this->input->post('brand_img')){
			$soucrPath = $_SERVER['DOCUMENT_ROOT'].$brand_flg;
			$this->config->load('uploads');
			$config = $this->config->item("brand");
			$destPath = $config['upload_path'];
			$this->load->library('upload');
			$time = date('Y/');
			$config['thumb_1'].=$time;
			$config['thumb_2'].=$time;
			$config['thumb_3'].=$time;
			$this->mkdirBrand($config);
			if($this->upload->moveFile($soucrPath,$destPath.$time)){
				$imginfo = getimagesize($soucrPath);
				$filename = basename($soucrPath);
				if($imginfo[0]<$config['min_width']||$imginfo[1]<$config['min_height']){
					@unlink($soucrPath);
					jumpAjax('图片不符合规范，请上传100*100',$url);
				}
				$this->load->library('image_lib');
				$config['flg'] = 'brand';
				$thumb= $this->image_lib->product_BrSe_thumb($soucrPath,$config);			
				if($thumb==true){
					$this->t_product_brands->brand_img = '/'.$time.$filename;
				}else{
					jumpAjax('品牌图标缩略图生成失败！',$url);
				}
			}
		}else{
			if($this->input->post('brand_img')){
				$this->t_product_brands->brand_img =$this->input->post('brand_img',true);
			}else{
				if($service_id){
					$url = site_url('admin/product/brands_add')."?service_id=".$service_id;
					//向导添加成功后跳入关联系统品牌
					jumpAjax('请上传品牌图标！',$url);
				}else{
					jumpAjax('请上传品牌图标！',site_url('admin/product/brands_add'));
				}
				
			}
		}
		
		$field = "brand_id";
		$where['brand_name'] = $this->t_product_brands->brand_name;
		//添加品牌
		$oldbarnd = $this->t_product_brands->get_brand($field,$where);
	
		if($oldbarnd){
			$brand_id = $oldbarnd['0']['brand_id'];
		}else{

			
			$brand_id = $this->t_product_brands->insert();//插入品牌表
			
		}
		/*//向申请品牌表中修改品牌信息 如果申请过来的只能改申请状态为审核中
		if($brand_id && $apply_id){
			
				$data['brand_id'] = $brand_id;
				$data['apply_brand_name'] = $this->t_product_brands->brand_name;
				$data['apply_brand_ename'] = $this->t_product_brands->brand_ename;
				if($s_class_id){
					$data['apply_classid'] = implode('|', $s_class_id);
				}
				$this->config->load('uploads');
				$config = $this->config->item('brand');
				$data['apply_brand_img'] = $config['relative_path'].'source'.$this->t_product_brands->brand_img;
				$map['apply_id'] = $apply_id;
				$this->load->model('t_service_brands_apply_model');
				$this->t_service_brands_apply_model->updates_global($data,$map);
		}*/
		$flg = array();
		if(!empty($s_class_id)){
			foreach ($s_class_id as $key=>$value){
				//产品类别品牌表
				$files = "b_s_id";
				$where = array(
						'brand_id'=>$brand_id,
						's_class_id'=>$value
						);
				$product_class_brands_series = $this->t_product_class_brands_series->get_class_brands_series($files,$where);
				if(!$product_class_brands_series){
					$this->t_product_class_brands_series->brand_id=$brand_id;
					$this->t_product_class_brands_series->s_class_id= $value;
					$b_s_id = $this->t_product_class_brands_series->insert();
					if(!$b_s_id){
						array_push($flg, $brand_id);
					}
				}
			}
		}
		//添加时没有系列，所以不用添加系列分类关联，请在编辑里加

		if(!$flg){	
			if($brand_flg){
				$url = site_url('admin/member/service_brands_apply');
				jumpAjax('添加成功！',$url);
			}else{

				if($service_id){
					$url = site_url('admin/member/service_brands_apply_system')."?service_id=".$service_id."&tags=1";
					//向导添加成功后跳入关联系统品牌
					jumpAjax('添加成功！',$url);
				}else{
					jumpAjax('添加成功！',site_url('admin/product/brands'));
				}
				
			}
		}else{
			if($brand_flg){
				jumpAjax('产品类别品牌表关联失败！',$url);
			}else{
				jumpAjax('产品类别品牌表关联失败！',site_url('admin/product/brands_add'));
			}
		}
		
	
	}

	public function mkdirBrand($mkdirArr){
		foreach ($mkdirArr as $key => $value) {
			if($key == 'thumb_1' || $key== 'thumb_2' || $key == 'thumb_3' || $key == 'source' || $key == 'default'){
				mkdirs($value);
			}
				
		}
	}
	
	public function edit_brand(){
		$data['title']='家178-内容管理';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/edit_brand';
		$this->navpage = $this->navpage;
		$result = array();
		$brand_id = $this->input->get('brand_id');
		$field = "s_class_id,s_class_name";
		$where = array('s_class_type'=>12,'s_class_pid'=>0);
		$result['product_class'] = $this->t_system_class->get_tag($field,$where);
		$s_class_id = $result['product_class'][0]['s_class_id'];
		$field = "s_class_name,s_class_id";
		$where = array('s_class_pid'=>$s_class_id);
		$result['productTwo'] = $this->t_system_class->get_tag($field,$where);
		$this->config->load('uploads');
		$index = $this->config->item('brand');
		$result['thumb_3'] = $index['relative_path'].'thumb_3';
		$result['re'] = $this->t_product_brands->get($brand_id);
		$filed = 's_class_id,b_s_id';
		$where = array(
				'brand_id'=>$brand_id
				);
		$result['exitsCategory'] = $this->t_product_class_brands_series->get_class_brands_series($filed,$where);
		$result['cateGoryId'] = twotoone_array($result['exitsCategory'], 's_class_id');
		//echo "<pre>";
		//var_dump($result);die;
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function doedit_brand(){
		$data['brand_name']=$this->input->post('brand_name',true);
		$data['brand_ename']=$this->input->post('brand_ename',true);
		$brand_id=$this->input->post('brand_id',true);
		$s_class_ids=$this->input->post('s_class_id',true);
		$data['brand_seodesc'] =$this->input->post('brand_seodesc',true);

		$data['brand_url']=$this->input->post('brand_url',true);
		$data['brand_seokey']=$this->input->post('brand_seokey',true);
		
		$brand = $this->t_product_brands->get($brand_id);
		//$this->config->load('uploads');
		//$index = $this->config->item('product');
		//$thumb_1name = $index['relative_path'].'index'.$oldres->product_pic;
		//$source_1name = $index['relative_path'].'source'.$oldres->product_pic;
		$source_name ='uploads/brand/source'.$brand->brand_img;
		$thumb_1name ='uploads/brand/thumb_1'.$brand->brand_img;
		$thumb_2name ='uploads/brand/thumb_2'.$brand->brand_img;
		$thumb_3name ='uploads/brand/thumb_3'.$brand->brand_img;
		if($this->input->post('brand_img')){
			@unlink($source_name);
			@unlink($thumb_1name);
			@unlink($thumb_2name);
			@unlink($thumb_3name);
			$data['brand_img']=$this->input->post('brand_img',true);
		}/* else{
			
			//echo "<script type='text/javascript'>alert('请上传品牌图标！');window.location.href='".site_url('admin/product/brands_add')."'</script>";exit;
		} */
		//先删除品牌类别关联表再添加
		$filed = 's_class_id,b_s_id';
		$where = array(
				'brand_id'=>$brand_id
				);
		$exitsCategory = $this->t_product_class_brands_series->get_class_brands_series($filed,$where);
		$cateGoryId = twotoone_array($exitsCategory, 'b_s_id');
		
		foreach ($cateGoryId as $v){
			$this->t_product_class_brands_series->delete($v);
		}
		
		if($this->t_product_brands->updates_global($data,array('brand_id'=>$brand_id))){
			//添加品牌类别关联
			if(!empty($s_class_ids)){
				foreach ($s_class_ids as $vsa){
					$this->t_product_class_brands_series->brand_id=$brand_id;
					$this->t_product_class_brands_series->s_class_id= $vsa;
					$b_s_id = $this->t_product_class_brands_series->insert();
				}

			}

			//查找该品牌下的系列，如果有则把系列分类关联表中的该系列数据删除再添加,如果品牌下没有系列则不做操作
			$Series_class_idRe = $this->brands_series->getSeries_class_idByBrandId($brand_id);
			if(!empty($Series_class_idRe)){
				foreach ($Series_class_idRe as $keys => $values) {
					$this->brands_series->delete($values->series_class_id);
				}
			}
			//根据品牌查找系列
			$series = $this->t_product_brands_series->get_series('series_id',array('brand_id'=>$brand_id));
			if(!empty($series)){
				foreach ($series as $ky => $vlue) {
					$this->brands_series->series_id = $vlue['series_id'];
					if(!empty($s_class_ids)){
						foreach ($s_class_ids as $vva){
							$this->brands_series->s_class_id = $vva;
							$this->brands_series->insert();
						}	
					}
					
				}

			}

			//修改品牌申请表
			$map['brand_id'] = $brand_id;
			$datas['apply_brand_name'] = $data['brand_name'];
			$datas['apply_brand_ename'] = $data['brand_ename'];
			$datas['apply_classid'] = implode('|', $s_class_ids);
			if($this->input->post('brand_img')){
				$this->config->load('uploads');
				$config = $this->config->item('brand');
				$datas['apply_brand_img'] = $config['relative_path'].'source'.$data['brand_img'];
			}
			$this->load->model('t_service_brands_apply_model');
			$this->t_service_brands_apply_model->updates_global($datas,$map);
		
		
			jumpAjax('修改成功！',site_url('admin/product/brands'));
		}else {
			$url = site_url('admin/product/edit_brand')."?brand_id='".$brand_id;
			jumpAjax('修改失败！',$url);
		}
	}
	//产品品牌系列
	public function brands_series(){
		$data['title']='家178-内容管理';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/brands_series';
		$this->navpage = $this->navpage;
		$result = array();
		
		$field = "s_class_id,s_class_name";
		$where = array('s_class_type'=>12,'s_class_pid'=>0);
		$result['product_class'] = $this->t_system_class->get_tag($field,$where);
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		//根据
		$brand_id = $this->input->get('brand_id'); //品牌id
		$s_class_id = $this->input->get('s_class_id'); //分类id
		$series_name = $this->input->get('series_name'); //款式名
		$series_status = $this->input->get('series_status');//系列状态
		$total_rows = count($this->t_product_brands_series->admin_search_count($brand_id,$s_class_id,$series_name,$series_status));
		$office =  ($page-1)*($this->limit);
		$result['series_name'] = $series_name;
		$result['re'] = $this->t_product_brands_series->admin_search($brand_id,$s_class_id,$series_name,$series_status,$office,$this->limit);
		$this->libs->base_url = site_url('admin/product/brands_series').'?search=0&s_class_id='.$s_class_id."&brand_id=".$brand_id."&series_name=".$series_name;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$result['series_status'] = $series_status;
		//echo "<pre>";var_dump($result);die;
		$this->pagedata = $result;
		parent::_initpage();
	}

	//状态
	public function doseriesstatus(){
		//状态
		$result = array();
		$result['series_status'] = $this->input->post('status');
		$where['series_id'] = $this->input->post('question_id');
		if($this->t_product_brands_series->updates_global($result,$where)){
			echo 1;exit;
		}else{
			echo 0;exit;
		}
	
	}
	
	public function series_edit(){
		$data['title']='家178-内容管理';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/series_edit';
		$this->navpage = $this->navpage;
		$result = array();
		$series_id = $this->input->get('series_id');
		$this->config->load('uploads');
		$index = $this->config->item('series');
		$result['thumb_3'] = $index['relative_path'].'source/';

		$result['re'] = $this->t_product_brands_series->get($series_id);
		//获取分类系列关联数据
		$map['series_id'] = $series_id;
		$seriesA = $this->brands_series->get_tag('s_class_id',$map);

		if($brands_class = $this->t_product_class_brands_series->getClassInfoByBrand($result['re']->brand_id)){
			if($seriesA){
					$seriesArr = twotoone_array($seriesA,'s_class_id');
					foreach ($brands_class as $key => $value) {
						if(in_array($value['s_class_id'], $seriesArr)){
							$brands_class[$key]['checked'] = true;
						}else{
							$brands_class[$key]['checked'] = false;
						}
					}
			}
			$result['brands_class'] = $brands_class;
		}else{
			$result['brands_class'] = '';
		}

		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function dodelseries(){
		$ids = $this->input->post('ids');
		$idarr = explode(',',$ids);
		$temarr = array();
		foreach($idarr as $val){
			$where['series_id'] =  $val;
			$data['series_status'] = 99;
			if($this->t_product_brands_series->updates_global($data,$where)){
				$temarr[] = $val;
			}
		}
		if($temarr){
			echo json_encode($temarr);
		}else{
			echo "0";
		}
	}
	public function doseries_edit(){
		$s_class_id = $this->input->post('s_class_id');
		$series_id = $this->input->post('series_id',true);
		$service_id = $this->input->post('service_id',true);
		$data['series_name']=$this->input->post('series_name',true);
		$data['series_seodesc']=$this->input->post('series_seodesc',true);
		$data['series_seokey']=$this->input->post('series_seokey',true);
		$data['series_ename']=$this->input->post('series_ename',true);
		
		
		$brand = $this->t_product_brands_series->get($this->input->post('series_id',true));
		//$this->config->load('uploads');
		//$index = $this->config->item('product');
		//$thumb_1name = $index['relative_path'].'index'.$oldres->product_pic;
		//$source_1name = $index['relative_path'].'source'.$oldres->product_pic;
		$source_name ='uploads/series/source'.$brand->series_img;
		$thumb_1name ='uploads/series/thumb_1'.$brand->series_img;
		if($this->input->post('brand_img')){
			@unlink($source_name);
			@unlink($thumb_1name);
			$data['series_img']=$this->input->post('brand_img',true);
		}
		$where['brand_id'] = $this->input->post('brand_id',true);;
		$where['series_name'] = $data['series_name'];
		if($service_id){
			$where['service_id'] = $service_id;
		}else{
			$where['service_id'] = 0;
		}

		if($seriesR = $this->t_product_brands_series->get_series('series_id',$where)){
			foreach($seriesR as $var){
				if($var['series_id'] != $series_id){
					jumpAjax('不能在同一个品牌中加入相同的系列！',site_url('admin/product/series_edit')."?series_id=".$series_id);
				}
			}
		}

		if($this->t_product_brands_series->updates_global($data,array('series_id'=>$series_id))){
			$map['series_id'] = $series_id;
			$oldSeriesA = $this->brands_series->get_tag('s_class_id,series_class_id',$map);
			//先把旧的系列删除在添加新的
			foreach ($oldSeriesA as $key => $value) {
				$this->brands_series->delete($value['series_class_id']);
			}
			if($s_class_id){
				$this->brands_series->series_id = $series_id;
				foreach ($s_class_id as $xik => $xlv) {
					$this->brands_series->s_class_id = $xlv;
					$this->brands_series->insert();
				}
			}
			jumpAjax('修改成功！',site_url('admin/product/brands_series'));
		}else{
			jumpAjax('修改失败！',site_url('admin/product/series_edit')."?series_id=".$series_id);
	
		}
	}
	//
	public function brands_series_add(){
		$data['title']='家178- 产品管理';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/brands_series_add';
		$this->navpage = $this->navpage;
		$result = array();
		
		$field = "s_class_id,s_class_name";
		$where = array('s_class_type'=>12,'s_class_pid'=>0);
		$result['product_class'] = $this->t_system_class->get_tag($field,$where);
		$result['brands'] = $this->t_product_brands->get_all();
		if($bar = $result['brands']['0']){
			$result['brand_id'] = $bar->brand_id;
			//根据品牌ID得到分类
			if($brands_class = $this->t_product_class_brands_series->getClassInfoByBrand($result['brand_id'])){
				$result['brands_class'] = $brands_class;
			}else{
				$result['brands_class'] = '';
			}			
		}
		//echo "<pre>";var_dump($result);die;
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function dobrands_series_add(){
		$this->t_product_brands_series->brand_id=$this->input->post('s_c_tag_id',true);
		$this->t_product_brands_series->series_name=$this->input->post('series_name',true);
		$this->t_product_brands_series->series_seodesc=$this->input->post('series_seodesc',true);
		$this->t_product_brands_series->series_seokey=$this->input->post('series_seokey',true);
		$this->t_product_brands_series->series_status=$this->input->post('series_status',true);
		$this->t_product_brands_series->series_addtime=date("Y-m-d H:i:s");
		$this->t_product_brands_series->service_id=0;
		$this->t_product_brands_series->series_ename=$this->input->post('series_ename',true);
		$brands_class = $this->input->post('s_class_id',true);
		
		if($this->input->post('brand_img')){
			$this->t_product_brands_series->series_img=$this->input->post('brand_img',true);
		}else{
			echo "<script type='text/javascript'>alert('请上传品牌图标！');window.location.href='".site_url('admin/product/brands_series_add')."'</script>";exit;
		}
		if($this->t_product_brands_series->get_series('series_id',array('brand_id'=>$this->t_product_brands_series->brand_id,'series_name'=>$this->t_product_brands_series->series_name,'service_id'=>0))){
			echo "<script type='text/javascript'>alert('不能在同一个品牌中加入相同的系列！');window.location.href='".site_url('admin/product/brands_series_add')."'</script>";exit;
		}else{
			if($service_id = $this->t_product_brands_series->insert()){
				// 插入产品系列品类表（查找该系列所属分类，如果没分类则不用加,有则加）
				/*$where['brand_id'] = $this->t_product_brands_series->brand_id;
				if($brands_class = $this->t_product_class_brands_series->get_class_brands_series('brand_id,s_class_id',$where)){
					$this->brands_series->series_id = $service_id;
					foreach ($brands_class as $key => $value) {
					  $this->brands_series->s_class_id = $value['s_class_id'];
					  $this->brands_series->insert();
					}
				}*/
				$this->brands_series->series_id = $service_id;
				if($brands_class){
					foreach ($brands_class as $key => $value) {
					  $this->brands_series->s_class_id = $value;
					  $this->brands_series->insert();
					}
				}
				jumpAjax('添加成功！',site_url('admin/product/brands_series'));
			}else{
				jumpAjax('添加失败！',site_url('admin/product/brands_series_add'));
			}
		}
	
	}
	
	//获取分类 下的标签
	public function doproductbChild(){
		$s_class_id = $this->input->post('p_pid',true);
		$result = $this->t_s_class_tag->getClassByTag($s_class_id);
		if($result){
			echojson('1', $result,'');
		}else{
			echojson(0, '',"获取数据失败！");
		}
	}
	//根据分类标签id获取该下面的款式
	public function dogetPatternNameBySid(){
		
		$s_c_tag_id = $this->input->post('sid');//标签id
		$s_class_id = $this->input->post('c_id');//分类id
		$s_c_tag_id = $this->t_s_class_tag->get_tag('s_c_tag_id',array('s_class_id'=>$s_class_id,'s_tag_id'=>$s_c_tag_id));
		$result = $this->t_system_product_pattern->get_pattern('pattern_id,pattern_type',array('s_c_tag_id'=>$s_c_tag_id[0]['s_c_tag_id']));
		if($result){
			echojson('1', $result,'');
		}else{
			echojson(0, '',"获取数据失败！");
		}
	}
	//根据品牌id获取该下面的系列
	public function dogetSeriesNameByBid(){
		$brand_id = $this->input->post('bid',true);
		$service_id = $this->input->post('service_id',true);
		$result = $this->t_product_brands_series->get_series('series_id,series_name',array('brand_id'=>$brand_id,'service_id'=>$service_id));

		if($result){
			echojson('1', $result,'');
		}else{
			echojson(0, '',"获取数据失败！");
		}
	}
	//根据分类id获取 下面的品牌
	public function dobrands(){
		$s_class_id = $this->input->post('p_pid',true);
		$result = $this->t_product_brands->getBrandNameByClassId($s_class_id);
		if($result){
			echojson('1', $result,'');
		}else{
			echojson(0, '',"获取数据失败！");
		}
	}
	//根据父级查找子级
	public function dogetProductNameByPid(){
		$s_class_id = $this->input->post('prid',true);
		$field = "s_class_name,s_class_id";
		$where = array('s_class_pid'=>$s_class_id);
		$result = $this->t_system_class->get_tag($field,$where);
		if($result){
			echojson('1', $result,'');
		}else{
			echojson(0, '',"获取数据失败！");
		}
	}
	
	public function dostatus(){
		$status = $this->input->post('status',true);
		$product_id = $this->input->post('question_id',true);
		$data = array('product_status'=>$status);
		$where = array('product_id'=>$product_id);
		if($this->t_certified_product->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}
	
	public function dois_hot(){
		$status = $this->input->post('status',true);
		$product_id = $this->input->post('ids',true);
		$data = array('product_is_hot'=>$status);
		$where = array('product_id'=>$product_id);
		if($this->t_certified_product->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}
	
	public function dois_index(){
		$status = $this->input->post('status',true);
		$product_id = $this->input->post('ids',true);
		$data = array('product_index'=>$status);
		$where = array('product_id'=>$product_id);
		if($this->t_certified_product->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}
	//套餐
	public function pack(){
		$data['title']='家178-套餐';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/pack';
		$this->navpage = $this->navpage;
		$result = array();
		
		$fieds = 'service_id,service_name';
		$result['service'] = $this->t_service_info->get_tag($fieds,"service_id !=''");
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		//根据
		$goods_id = $this->input->get('goods_id'); //品牌id
		$pack_name = $this->input->get('pack_name'); //款式名

		$total_rows = count($this->t_certified_pack->admin_search_count($goods_id,$pack_name));
	//	ECHO $goods_id;DIE;
		$office =  ($page-1)*($this->limit);
		$result['series_name'] = $pack_name;
		$result['goods_id'] = $goods_id;
		$result['re'] = $this->t_certified_pack->admin_search($goods_id,$pack_name,$office,$this->limit);
		$this->libs->base_url = site_url('admin/product/pack').'?search=0&goods_id='.$goods_id."&pack_name=".$pack_name;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		//echo "<pre>";var_dump($result);die;
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	//套餐
	public function pacK_edit(){
		$data['title']='家178-套餐';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/pack_edit';
		$this->navpage = $this->navpage;
		$result = array();
		//根据
		$pack_id = $this->input->get('pack_id'); //品牌id
		$fieds = 'service_id,service_name';
		$result['service'] = $this->t_service_info->get_tag($fieds,"service_id !=''");

		$result['re'] = $this->t_certified_pack->get($pack_id);
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function dopackEdit(){
		$data['goods_id']  = $this->input->post('goods_id',true);
		$data['pack_name'] = $this->input->post('pack_name',true);
		$where['pack_id']=$this->input->post('pack_id',true);
		
		if($this->t_certified_pack->updates_global($data,$where)){
			echo "<script type='text/javascript'>alert('添加成功！');window.location.href='".site_url('admin/product/pack')."'</script>";exit;
		}else{
			echo "<script type='text/javascript'>alert('添加失败！');window.location.href='".site_url('admin/product/pacK_edit')."?pack_id={$where['pack_id']}'</script>";exit;
		}
	}
	public function packAdd(){
		$data['title']='家178- 产品套餐添加';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/packAddadd';
		$this->navpage = $this->navpage;
		$result = array();
		
		$fieds = 'service_id,service_name';
		$result['service'] = $this->t_service_info->get_tag($fieds,"service_id !=''");
		//var_dump($result['service']);die;
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function dopackAddadd(){
		$this->t_certified_pack->goods_id=$this->input->post('goods_id',true);
		$this->t_certified_pack->pack_name=$this->input->post('pack_name',true);
		
		if($this->t_certified_pack->insert()){
			echo "<script type='text/javascript'>alert('添加成功！');window.location.href='".site_url('admin/product/packAdd')."'</script>";exit;
		}else{
			echo "<script type='text/javascript'>alert('添加失败！');window.location.href='".site_url('admin/product/dopackAddadd')."'</script>";exit;
		}
		
	}
	public function packitemAdd(){
		
		$data['title']='家178- 产品套餐添加';
		$data['menu']=$this->product;
		$this->data = $data;
		$this->page = 'product/packitemAdd';
		$result = array();
		$pack_id = $this->input->get('pack_id');
		$goods_id = $this->input->get('goods_id');
		
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$total_rows = count($this->t_service_goods->getPackByProductCount($goods_id));
		$office =  ($page-1)*($this->limit);

		$result['num'] = $total_rows;
		$result['re'] = $this->t_service_goods->getPackByProduct($goods_id,$this->limit,$office);
	
		$result['pack_id'] = $pack_id;
		$field = "product_id,pack_id,item_id";
		$where = array('pack_id'=>$pack_id);
		$result['packProduct'] = $this->t_certified_pack_item->get_tag($field,$where);
		$this->libs->base_url = site_url('admin/product/packitemAdd').'?search=0&goods_id='.$goods_id."&pack_id=".$pack_id;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$result['packProduct'] = twotoone_array($result['packProduct'],'product_id');
		//$result['reid'] = twotoone_array($result['re'],'product_id');
		$this->pagedata = $result;
	//	echo "<pre>";var_dump(implode(',', $result['reid']));die;
		parent::_initpage();

		
	}
	
	public function dopackitemAdd(){

		$ids = $this->input->post('ids');
		$idsAll = $this->input->post('alls');
		$pack_id = $this->input->post('pack_id');
		//var_dump($idsAll);die;
		$pack_item = $this->t_certified_pack_item->getInPackItem($idsAll,$pack_id);
		//var_dump($pack_item);die;
		if($pack_item){
			foreach ($pack_item as $valus){
				$this->t_certified_pack_item->delete($valus['item_id']);
			}
		}
		if(empty($ids)){echo 0;exit;}
		$string = '';
		$productArray = explode(',', $ids);
		foreach($productArray as $key=>$valu){
			$this->config->load('uploads');
			$upload = $this->config->item('product');
			$this->t_certified_pack_item->pack_id = $pack_id;
			$this->t_certified_pack_item->product_id = $valu;
			$poduct_url = site_url()."/product/info?pid=".$valu;
			$poduct_picurl = site_url().$upload['relative_path'].'index'.get_tag_name("t_certified_product_model", $valu, "product_pic");

			$poduct_name = get_tag_name("t_certified_product_model", $valu, "product_name");
			$this->t_certified_pack_item->poduct_url = $poduct_url;
			$this->t_certified_pack_item->poduct_picurl = $poduct_picurl;
			$this->t_certified_pack_item->poduct_name = $poduct_name;
			if(!$this->t_certified_pack_item->insert()){
				$string .= $valu;
			}
		}
		if(!$string){
			echo 0;exit;
		}else{
			echo json_encode($string);exit;
		}
		
	}

	//由品牌得到分类
	public function doClassByBrand_id(){
		$brand_id = $this->input->post('brand_id');
		$html = '';
		if($brand_id){
			if($brands_class = $this->t_product_class_brands_series->getClassInfoByBrand($brand_id)){
				foreach ($brands_class as $key => $value) {
					$html .= "<input type='checkbox' value='".$value['s_class_id']."' name='s_class_id[]'/>";
					$html .= $value['s_class_name'];
				}
				echo $html;exit;
			}else{
				echo 0;exit;
			}		
		}else{
			echo 0;exit;
		}
		
	}
	/*  public function addSql(){
		$result = $this->t_certified_product->get_all();
		foreach ($result as $key=>$val){
			$this->t_service_goods->service_id = 1;
			$this->t_service_goods->product_id = $val->product_id;
			$this->t_service_goods->goods_title = $val->product_name;
			$this->t_service_goods->goods_price = $val->product_id*10;
			$this->t_service_goods->goods_upset = ($val->product_id*10)-500;
			$this->t_service_goods->goods_desc =  $val->product_name;
			$this->t_service_goods->goods_code =  '';
			$this->t_service_goods->goods_stock =  '';
			$this->t_service_goods->insert();
		}
		var_dump($result);die;
	} */
}

	