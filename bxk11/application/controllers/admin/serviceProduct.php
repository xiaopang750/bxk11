<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/27 10:30:17 
 *        liuguangpingAuthor: 刘广平
 *        Email: liuguangpingtest@163.com

 */
class ServiceProduct extends Admin_Controller
{	
	public $product;
	public $navpage;
	public $member;
	public $limit;
	public $libs;


	public $t_system_district;
	public $t_service_info;
	public $t_service_brands_apply;
	public $t_product_class_brands_series;
	public $t_service_goods;
	public $t_system_class;
	public $t_product_brands_series;
	public function __construct(){
		parent::__construct();
		$this->member = 'member';
		$this->navpage = 'member/nav';

		$this->load->model('t_system_district_model');
		$this->t_system_district = $this->t_system_district_model;
		$this->load->model('t_service_brands_apply_model');
		$this->t_service_brands_apply = $this->t_service_brands_apply_model;
		$this->load->model('t_service_info_model');
		$this->t_service_info = $this->t_service_info_model;
		$this->load->model('t_product_class_brands_series_model');
		$this->t_product_class_brands_series = $this->t_product_class_brands_series_model;
		$this->load->model('t_service_goods_model');
		$this->t_service_goods = $this->t_service_goods_model;
		$this->load->model('t_system_class_model');	
		$this->t_system_class = $this->t_system_class_model;
		$this->load->model('t_product_brands_series_model');	
		$this->t_product_brands_series = $this->t_product_brands_series_model;
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->limit = 10;
		$this->load->helper('url');
		
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');

	}
	public function index(){
		$data['title']='家178-产品管理';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'serviceProduct/index';
		$this->navpage = $this->navpage;
		$result = array();
		$product_add = $this->input->get('product_add');
		if($product_add){
			$field = "s_class_name,s_class_id";
			$where = array('s_class_pid'=>$product_add);
			$result['system_class'] = $this->t_system_class->get_tag($field,$where);
		
		}
		$field = "s_class_id,s_class_name";
		$where = array('s_class_type'=>12,'s_class_pid'=>0);
		$result['product_class'] = $this->t_system_class->get_tag($field,$where);
		
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		
		$key_word = $this->input->get('key_word');
		$service_name = $this->input->get('service_name');
		$goods_status = $this->input->get('goods_status');
		$goodsCodeT = $this->input->get('goodsCodeT');
		$s_class_id = $this->input->get('s_class_id');
		$service_id = $this->input->get('service_id');

		$total_rows = count($this->t_service_goods->admin_search_count($service_name,$goods_status,$goodsCodeT,$key_word,$s_class_id,$service_id));

		$office =  ($page-1)*($this->limit);

		$result['service_name'] = $service_name;
		$result['service_id'] = $service_id;
		$result['key_word'] = $key_word;
		$result['s_class_id'] = $s_class_id;
		$result['goods_status'] = $goods_status;
		$result['goodsCodeT'] = $goodsCodeT;
		$result['product_add'] = $product_add;
		$result['re'] = $this->t_service_goods->admin_search($service_name,$goods_status,$goodsCodeT,$key_word,$s_class_id,$service_id,$office,$this->limit);
		$this->libs->base_url = site_url('admin/serviceProduct/index').'?search=0&product_add='.$product_add.'&service_name='.$service_name."&goodsCodeT=".$goodsCodeT."&key_word=".$key_word."&s_class_id=".$s_class_id.'&goods_status='.$goods_status."&service_id=".$service_id;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function add(){

		$data['title']='家178-产品管理';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'serviceProduct/add';
		$this->navpage = $this->navpage;
		$result = array();

		$service_id = $this->input->get('service_id');
		$where['service_id'] = $service_id;
		$goods = $this->t_service_brands_apply->get_tag('*',$where);
		
		if($this->t_service_brands_apply->get_tag('*',$where) && $service_id && $goods['0']['brand_id']){
			$goods = $goods['0'];
			//品牌
			$wheres = "service_id in (".$service_id.") AND brand_id <> '' AND apply_status !=11";
			$result['brandR'] = $this->t_service_brands_apply->get_tag('brand_id,apply_brand_name',$wheres);
			
			//系列
			$seriesW['brand_id'] =  $goods['brand_id'];
			$seriesW['service_id'] =  $service_id;

			$seriesR = $this->t_product_brands_series->get_series('series_id,series_name',$seriesW);
			$result['seriesR'] = $seriesR;		
			//分类
			if(isset($seriesR) && $seriesR){
				$seriesArr = twotoone_array($seriesR,'series_id');
				$seriesS = implode(',', $seriesArr);
				$whereC = "series_id IN (".$seriesS.")";		
				$result['class_system'] = $this->t_product_class_brands_series->get_tag('s_class_id',$whereC );
			}

		}
		$result['goods'] = $goods;
		if($result['goods']){
		    $serviceInfo = $this->t_service_info->get($service_id);
			$province = $serviceInfo->service_province_code;
			$city = $serviceInfo->service_city_code;
			$district = '';
			$this->t_system_district->district_pcode = '0';
			$result['provincere'] = $this->t_system_district->getbypid();
		}else{
			$province = '';
			$city = '';
			$district = '';
			$this->t_system_district->district_pcode = '0';
			$result['provincere'] = $this->t_system_district->getbypid();
		}

		if($province == ''){
			$this->t_system_district->district_pcode = 0;
		
		}elseif($province && !$city){
			$this->t_system_district->district_pcode = $province;
			$result['cityre'] = $this->t_system_district->getbypid();
			$this->t_system_district->district_pcode = $province;
		
		}elseif($city && !$district){
			$field = 'service_id,service_name,service_company';
			$where['service_city_code'] = $city;
			$result['product_class'] = $this->t_service_info->get_tag($field,$where);
			$this->t_system_district->district_pcode = $province;
			$result['cityre'] = $this->t_system_district->getbypid();
			$this->t_system_district->district_pcode = $city;
			$result['disre'] = $this->t_system_district->getbypid();
			
			$this->t_system_district->district_pcode = $city;
			
		}else{
			
			$this->t_system_district->district_pcode = $province;
			$result['cityre'] = $this->t_system_district->getbypid();
			
			$this->t_system_district->district_pcode = $city;
			$result['disre'] = $this->t_system_district->getbypid();
			
			$this->t_system_district->district_pcode = $district;
		}
		
		$result['pxid'] = $province;
		$result['cid'] = $city;
		$result['did'] = $district;
		$result['randcode'] =  "JIA178".time().randcode(5);
		$result['product_hot'] = "5";

		$this->pagedata = $result;
		parent::_initpage();
	}
	public function doadd(){
		$this->t_service_goods->service_id = $this->input->post('service_id',true);
		$this->t_service_goods->brand_id = $this->input->post('brand_id',true);
		$this->t_service_goods->s_class_id = $this->input->post('s_class_id',true);
		$this->t_service_goods->series_id = $this->input->post('series_id',true);
		$this->t_service_goods->goods_title = $this->input->post('goods_title',true);
		$this->t_service_goods->good_key_word = $this->input->post('good_key_word',true);
		$this->t_service_goods->goods_price = $this->input->post('goods_price',true);
		$this->t_service_goods->goods_upset = $this->input->post('goods_upset',true);
		$this->t_service_goods->goods_code = $this->input->post('goods_code',true);
		$this->t_service_goods->goods_stock = $this->input->post('goods_stock',true);
		//$this->t_service_goods->product_id = 0;
		$this->t_service_goods->goods_sort = $this->input->post('goods_sort',true);
		$this->t_service_goods->good_size = $this->input->post('good_size',true);
		$this->t_service_goods->good_material = $this->input->post('good_material',true);
		$this->t_service_goods->good_unit = $this->input->post('good_unit',true);

		$this->t_service_goods->goods_desc = htmlspecialchars($this->input->post('goods_desc',true));
		//$this->t_service_goods->goods_desc = $this->input->post('goods_desc',true);
		$this->t_service_goods->goods_status = $this->input->post('goods_status',true);
		if($service_flg = $this->input->post('service_flg')){
			$url = site_url('admin/serviceProduct/add')."?service_id=".$service_flg;
			$indexurl =  site_url('admin/serviceProduct/index')."?service_id=".$service_flg;
		}else{
			$url = site_url('admin/serviceProduct/add');
			$indexurl =  site_url('admin/serviceProduct/index');
		}
		//贴面描述不能为空
		$color_title = $this->input->post('goods_color_title');
		foreach ($color_title as $vaslue) {
			if(!$vaslue){
				jumpAjax('贴面描述不能为空',$url);
			}
		}
		$this->t_service_goods->good_color = $this->goodsImplode();
		if(!$this->t_service_goods->good_color){
			jumpAjax('至少添加一张颜色贴面图或上传错误',$url);
		}
		$this->load->library('upload');
		$flg = false;
		$picArray = array();
		if($good_pic1 = $this->upload->upServiceProductPic("good_pic1")){
			$flg = true;
			$picArray[] = $good_pic1;
			
		}
		if($good_pic2 = $this->upload->upServiceProductPic("good_pic2")){
			$flg = true;
			$picArray[] = $good_pic2;
		}
		if($good_pic3 = $this->upload->upServiceProductPic("good_pic3")){
			$flg = true;
			$picArray[] = $good_pic3;
		}
		if($good_pic4 = $this->upload->upServiceProductPic("good_pic4")){
			$flg = true;
			$picArray[] = $good_pic4;
		}
		if($good_pic5 = $this->upload->upServiceProductPic("good_pic5")){
			$flg = true;
			$picArray[] = $good_pic5;
		}
		foreach ($picArray as $keys => $values) {
			$k=$keys+1;
			$pic = "good_pic$k";
			$this->t_service_goods->$pic = $values;
		}
		
		if(!$flg){
			jumpAjax('至少添加一张缩略图或上传失败！',$url);
		}
		if($goods_id = $this->t_service_goods->insert()){
			jumpAjax('添加成功！',$indexurl);
		}else{
			jumpAjax('添加失败！',$url);
		}
		
	}

	//商品颜色贴面上传
	public function goodsColor(){
		$this->load->library('upload');
		if(isset($_FILES['goods_color'])){
			if($goods_colorArr = $this->upload->doMulUpload("goods_color")){
				//图片裁切
				if($result = $this->upload->upServiceProductColor($goods_colorArr)){
					return $result;
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

	//商品颜色贴面图上拼接
	public function goodsImplode(){
		if($result = $this->goodsColor()){
			$goods_price = str_replace(',', '*', $this->input->post('goods_price'));
			$goods_color_title = str_replace(',', '*', $this->input->post('goods_color_title'));
			$good_color = array();
			foreach ($result as $key => $value) {
				$path = $value['time']."/".$value['name'];
				$good_color[] = $goods_color_title[$key].",".$path.','.$goods_price;
			}
			return $goods_colorStr = implode('|', $good_color);
		}else{
			return '';
		}
		
	}

	//商品颜色贴面图上拼接
	public function goodsImplodeS(){
		$goods_price = str_replace(',', '*', $this->input->post('goods_price'));
		$images_bak = str_replace(',', '*', $this->input->post('images_bak'));
		$goods_color_title = str_replace(',', '*', $this->input->post('goods_color_title_bak'));
		$good_color = array();
		if($images_bak){
			foreach ($images_bak as $key => $value) {
				$good_color[] = $goods_color_title[$key].",".$value.','.$goods_price;
			}
			return $goods_colorStr = implode('|', $good_color);	
		}else{
			return '';
		}
		
		
	}

	//ajax经销商
	public function doServiceInfo(){
		$city = $this->input->post('city');
		if($city){
			$field = 'service_id,service_name,service_company';
			$where = 'service_city_code ='.$city.' AND service_status NOT IN (11,81,99,21)';
			$result = $this->t_service_info->get_tag($field,$where);
			if($result){
				echojson(1,$result,'查找成功！');
			}else{
				echojson(0,'','该地区无经销商');
			}
		}else{
			echojson(0,'','查找失败！');
		}
	}

	//经销商品牌
	public function doServiceBrandInfo(){
		$service_id = $this->input->post('service_id');
		if(isset($service_id) && $service_id){
			$field = 'apply_id,brand_id,apply_brand_name';
			$where = "service_id =".$service_id." AND apply_status =1 AND brand_id <> ''";
			$result = $this->t_service_brands_apply->get_tag($field,$where);
			if($result){
				echojson(1,$result,'查找成功！');
			}else{
				echojson(0,'','该服务商无品牌或产品异常');
			}
		}else{
			echojson(0,'','查找失败！');
		}
	}

	//经销商分类
	public function doServiceCategory(){
		$series_id = $this->input->post('series_id');
		if(isset($series_id) && $series_id){
			$result = $this->t_product_class_brands_series->getSystemClassInfoBySeriesId($series_id);
			if($result){
				echojson(1,$result,'查找成功！');
			}else{
				echojson(0,'','该服务商无品牌或产品异常');
			}
		}else{
			echojson(0,'','查找失败！');
		}
	}

	//修改经销商品状态
	public function doGoodsStatus(){
		$status = $this->input->post('status',true);
		$goods_id = $this->input->post('question_id',true);
		$data = array('goods_status'=>$status);
		$where = array('goods_id'=>$goods_id);
		if($this->t_service_goods->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}

	public function edit(){

		$data['title']='家178-经销产品编辑';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'serviceProduct/edit';
		$this->navpage = $this->navpage;
		$this->config->load('uploads');
		$colorConfig = $this->config->item('service_color');
		$picConfig = $this->config->item('service_ProductPic');
		$result = array();
		$goods_id = $this->input->get('goods_id');
		if(!$goods_id){
			jumpAjax('非法操作！',site_url('admin/serviceProduct/index'));
		}
	
		$goods = $this->t_service_goods->get($goods_id);

		if($goods->service_id && $goods->brand_id && $goods->service_id){
			//品牌
			$wheres = "service_id in (".$goods->service_id.") AND brand_id <> '' AND apply_status !=11";
			$result['brandR'] = $this->t_service_brands_apply->get_tag('brand_id,apply_brand_name',$wheres);

			//系列
			$seriesW['brand_id'] =  $goods->brand_id;
			$seriesW['service_id'] =  $goods->service_id;

			$seriesR = $this->t_product_brands_series->get_series('series_id,series_name',$seriesW);
			$result['seriesR'] = $seriesR;		
			//分类
			if(isset($seriesR) && $seriesR){
				$seriesArr = twotoone_array($seriesR,'series_id');
				$seriesS = implode(',', $seriesArr);
				$whereC = "series_id IN (".$seriesS.")";		
				$result['class_system'] = $this->t_product_class_brands_series->get_tag('s_class_id',$whereC );
			}

		}
	    $result['goods'] = $goods;
	    $serviceInfo = $this->t_service_info->get($goods->service_id);
		$province = $serviceInfo->service_province_code;
		$city = $serviceInfo->service_city_code;
		$district = '';
		$this->t_system_district->district_pcode = '0';
		$result['provincere'] = $this->t_system_district->getbypid();
		if($province == ''){
			$this->t_system_district->district_pcode = 0;
		
		}elseif($province && !$city){
			$this->t_system_district->district_pcode = $province;
			$result['cityre'] = $this->t_system_district->getbypid();
			$this->t_system_district->district_pcode = $province;
		
		}elseif($city && !$district){
			$field = 'service_id,service_name,service_company';
			$where['service_city_code'] = $city;
			$result['product_class'] = $this->t_service_info->get_tag($field,$where);
			$this->t_system_district->district_pcode = $province;
			$result['cityre'] = $this->t_system_district->getbypid();
			$this->t_system_district->district_pcode = $city;
			$result['disre'] = $this->t_system_district->getbypid();
			
			$this->t_system_district->district_pcode = $city;
			
		}else{
			
			$this->t_system_district->district_pcode = $province;
			$result['cityre'] = $this->t_system_district->getbypid();
			
			$this->t_system_district->district_pcode = $city;
			$result['disre'] = $this->t_system_district->getbypid();
			
			$this->t_system_district->district_pcode = $district;
		}
		if($goods->good_color){
			$result['goods_excolor'] = $this->goodsColorEx($goods->good_color);
		}else{
			$result['goods_excolor'] = "";
		}
		$result["color_relative_path"] = $colorConfig['relative_path'].'thumb_1/';
		$result["pic_relative_path"] = $picConfig['relative_path'].'thumb_1/';
		$result['pxid'] = $province;
		$result['cid'] = $city;
		$result['did'] = $district;
		$this->pagedata = $result;
		parent::_initpage();
	}

	//颜色贴面数据处理
	public function goodsColorEx($good_color){
		if($good_color){
			$explodeStr = array();
			$goods_ex = explode("|", $good_color);

			foreach ($goods_ex as $key => $value) {
				$goodsex = explode(',', $value);
				$explodeStr[$key]['title'] = $goodsex[0];
				$explodeStr[$key]['picurl'] = $goodsex[1];
				$explodeStr[$key]['price'] = $goodsex[2];
			}
			return $explodeStr;
		}else{
			return '';
		}
	

	}

	public function doedit(){
		$oldres = $this->input->post('goods_id');
		$url = site_url('admin/serviceProduct/edit')."?goods_id=".$oldres;
		$service_id = $this->input->post('service_id',true);
		$brand_id = $this->input->post('brand_id',true);
		$data['service_id'] = $service_id;
		$data['brand_id'] = $brand_id;
		$data['s_class_id']=$this->input->post('s_class_id',true);
		$data['series_id']=$this->input->post('series_id',true);
		$data['goods_title'] = $this->input->post('goods_title',true);
		$data['good_key_word']=$this->input->post('good_key_word',true);
		$data['goods_price']=$this->input->post('goods_price',true);
		$data['goods_upset']=$this->input->post('goods_upset',true);
		
		$data['goods_code']=$this->input->post('goods_code',true);
		$data['goods_stock']=$this->input->post('goods_stock',true);
		$data['goods_sort']=$this->input->post('goods_sort',true);
		$data['good_size']=$this->input->post('good_size',true);
		
		$data['good_material']=$this->input->post('good_material',true);
		$data['good_unit']=$this->input->post('good_unit',true);
		$data['goods_desc']=htmlspecialchars($this->input->post('goods_desc',true));
		//$data['goods_desc']=$this->input->post('goods_desc',true);
		$data['goods_status']=$this->input->post('goods_status',true);
		$data['goods_status']=$this->input->post('goods_status',true);
		$picArray = array();
		$this->config->load('uploads');
		$config = $this->config->item('service_ProductPic');
		$this->load->library('upload');
		if($good_pic1 = $this->upload->upServiceProductPic("good_pic1")){
			$picArray[] = $good_pic1;
			@unlink($config['thumb_1'].$this->input->post("good_pic1_bak"));
			@unlink($config['upload_path'].$this->input->post("good_pic1_bak"));
		}else{
			$good_pic1 = $this->input->post("good_pic1_bak");
			if($good_pic1){
				$picArray[] = $good_pic1;
			}
		}

		if($good_pic2 = $this->upload->upServiceProductPic("good_pic2")){
			
			$picArray[] = $good_pic2;
			@unlink($config['thumb_1'].$this->input->post("good_pic2_bak"));
			@unlink($config['upload_path'].$this->input->post("good_pic2_bak"));
		}else{
			$good_pic2 = $this->input->post("good_pic2_bak");
			if($good_pic2){
				
				$picArray[] = $good_pic2;
			}
		}

		if($good_pic3 = $this->upload->upServiceProductPic("good_pic3")){
			
			$picArray[] = $good_pic3;
			@unlink($config['thumb_1'].$this->input->post("good_pic3_bak"));
			@unlink($config['upload_path'].$this->input->post("good_pic3_bak"));
		}else{
			$good_pic3 = $this->input->post("good_pic3_bak");
			if($good_pic3){
				
				$picArray[] = $good_pic3;
			}
		}

		if($good_pic4 = $this->upload->upServiceProductPic("good_pic4")){
			
			$picArray[] = $good_pic4;
			@unlink($config['thumb_1'].$this->input->post("good_pic4_bak"));
			@unlink($config['upload_path'].$this->input->post("good_pic4_bak"));
		}else{
			$good_pic4 = $this->input->post("good_pic4_bak");
			if($good_pic4){
				$picArray[] = $good_pic4;
			}
		}

		if($good_pic5 = $this->upload->upServiceProductPic("good_pic5")){
			
			$picArray[] = $good_pic5;
			@unlink($config['thumb_1'].$this->input->post("good_pic5_bak"));
			@unlink($config['upload_path'].$this->input->post("good_pic5_bak"));
		}else{
			$good_pic5= $this->input->post("good_pic5_bak");
			if($good_pic5){
			
				$picArray[] = $good_pic5;
			}
		}

		foreach ($picArray as $keys => $values) {
			$k=$keys+1;
			$pic = "good_pic$k";
			$data[$pic] = $values;
		}

		if(!$picArray){
			jumpAjax('至少添加一张缩略图或上传失败！',$url);
		}

		$editGoodColor = $this->goodsImplodeS();
		if($editGoodColor){
			if($editGoodColorR = $this->goodsImplode()){
				$data['good_color'] = $editGoodColorR."|".$editGoodColor;
			}else{
				$data['good_color'] = $editGoodColor;
			}
			
		}else{
			$data['good_color'] = $this->goodsImplode();
		}

		if(!$data['good_color']){
			jumpAjax('至少添加一张颜色贴面图或上传错误',$url);
		}
		
		$delGoddsColor = $this->input->post('delGoddsColor');
		if($delGoddsColor){
			$delGoddsColorArr = explode(',', $delGoddsColor);
			$this->dogoodsColorUnlink($delGoddsColorArr);
		}
		if($this->t_service_goods->updates_global($data,array('goods_id'=>$oldres))){
			jumpAjax("修改成功！",site_url('admin/serviceProduct/index'));
		
		}else{

			jumpAjax("修改成功！",$url);
		}
	}

	//删除颜色贴面图
	public function dogoodsColorUnlink($unlinUrl){
		if(!empty($unlinUrl) && $unlinUrl){
			$this->config->load('uploads');
			$config = $this->config->item('service_color');
			foreach ($unlinUrl as $key => $value) {
				$thumb1 = $config['thumb_1'].$value;
				@unlink($thumb1);
				@unlink($config['upload_path'].$value);
			}
		}
		
	
	}

}

	