<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/27 10:30:17 
 *        liuguangpingAuthor: 刘广平
 *        Email: liuguangpingtest@163.com

 */
class Certified extends Admin_Controller
{	
	public $certified;
	public $navpage;
	public $t_certified_brand;
	public $limit;
	public $libs;
	public function __construct(){
		parent::__construct();
	
		$this->certified = 'certified';
		$this->navpage = 'certified/nav';
		$this->load->model('t_certified_brand_model');
		$this->t_certified_brand = $this->t_certified_brand_model;
		$this->limit = 10;
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->load->helper('url');
		
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');
	}
	public function index(){
		$data['title']='家178-产品管理';
		$data['menu']=$this->certified;
		$this->data = $data;
		$this->page = 'certified/index';
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
		
	

		if($this->input->post('product_result') && $this->input->post('product_thumb')){
			$this->t_certified_product->product_pic = $this->input->post('product_thumb');
		}else{
			echo "<script type='text/javascript'>alert('请上传产品图片！');window.location.href='".site_url('admin/product/add')."'</script>";exit;
		}
		
		if($product_id = $this->t_certified_product->insert()){
			$this->t_product_brands->updataproduct_brands('brand_products',$this->t_certified_product->brand_id,'1');
			$this->t_certified_product_tag->tag_id = $this->input->post('s_c_tag_id',true);
			$this->t_certified_product_tag->product_id = $product_id;
		
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

	public function sysBrand(){
		$data['title']='家178-产品管理';
		$data['menu']=$this->certified;
		$this->data = $data;
		$this->page = 'certified/sysBrand';
		$this->navpage = $this->navpage;
		$result = array();

		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$brand_id = $this->input->get('brand_id');
		$key_word = $this->input->get('key_word');
		$total_rows = count($this->t_certified_brand->admin_search_count($key_word));
		$office =  ($page-1)*($this->limit);
	
		$result['brand_id'] = $brand_id;
		$result['key_word'] = $key_word;
		$result['re'] = $this->t_certified_brand->admin_search($key_word,$office,$this->limit);
		$this->libs->base_url = site_url('admin/certified/sysBrand').'?search=0&key_word='.$key_word."&brand_id=".$brand_id;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		
		$this->pagedata = $result;
		parent::_initpage();
	}

	public function addSysBrand(){

		$data['title']='家178-产品管理';
		$data['menu']=$this->certified;
		$this->data = $data;
		$this->page = 'certified/addSysBrand';
		$this->navpage = $this->navpage;
		$result = array();
		//为了编辑的关联认证品牌
		$result['brand_id'] = $this->input->get('brand_id');
		$this->pagedata = $result;
		parent::_initpage();
	}

	public function doAddSysBrand(){
		$this->t_certified_brand->c_brand_name = $this->input->post('c_brand_name',true);
		$this->t_certified_brand->c_brand_ename = $this->input->post('c_brand_ename',true);
		$this->t_certified_brand->c_brand_logo = $this->input->post('brand_img',true);
		$this->t_certified_brand->c_brand_website = $this->input->post('c_brand_website',true);
		$this->t_certified_brand->c_brand_desc = $this->input->post('c_brand_desc',true);
		$this->t_certified_brand->c_brand_keywords = $this->input->post('c_brand_keywords',true);
		$brand_id = $this->input->post('brand_id');
		if($this->t_certified_brand->insert()){
			if($brand_id){
				$url = site_url('admin/certified/sysBrand')."?brand_id=".$brand_id;
			}else{
				$url = site_url('admin/member/index');
			}
			jumpAjax('操作成功',$url);
		}else{
			if($brand_id){
				$url = site_url('admin/certified/sysBrand')."?brand_id=".$brand_id;
			}else{
				$url = site_url('admin/member/index');
			}
			jumpAjax('操作失败',$url);
		}
	}

	public function editCertifiedBrand(){

		$data['title']='家178-产品管理';
		$data['menu']=$this->certified;
		$this->data = $data;
		$this->page = 'certified/editCertifiedBrand';
		$this->navpage = $this->navpage;
		$result = array();
		$c_brand_id = $this->input->get('c_brand_id');
		$result['brand_id'] = $this->input->get('brand_id');
		//为了编辑的关联认证品牌
		$result['re'] = $this->t_certified_brand->get($c_brand_id);
		$this->pagedata = $result;
		parent::_initpage();
	}

	public function doEditSysBrand(){
		$data['c_brand_name'] = $this->input->post('c_brand_name',true);
		$data['c_brand_ename'] = $this->input->post('c_brand_ename',true);
		$data['c_brand_logo'] = $this->input->post('brand_img',true);
		$data['c_brand_website'] = $this->input->post('c_brand_website',true);
		$data['c_brand_desc'] = $this->input->post('c_brand_desc',true);
		$data['c_brand_keywords'] = $this->input->post('c_brand_keywords',true);
		$brand_id = $this->input->post('brand_id');
		$where['c_brand_id'] = $this->input->post('c_brand_id',true);
		if($this->t_certified_brand->updates_global($data,$where)){
			if($brand_id){
				$url = site_url('admin/certified/sysBrand')."?brand_id=".$brand_id;
			}else{
				$url = site_url('admin/member/index');
			}
			jumpAjax('操作成功',$url);
		}else{
			if($brand_id){
				$url = site_url('admin/certified/sysBrand')."?brand_id=".$brand_id;
			}else{
				$url = site_url('admin/member/index');
			}
			jumpAjax('操作失败',$url);
		}
	}


}

