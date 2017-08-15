<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        liuguangpingAuthor: 服务商管理
 *        Email: liuguangpingtest@163.com

 */
class ServiceBrSe extends Admin_Controller
{	
	//公共用的
	public $member;
	public $navpage;
	public $limit;
	public $libs;
	public $pagedata;
	public $t_service_brands_apply;
	public $t_product_brands_series;
	public $t_service_info;
	public $t_product_class_brands_series;
	public $brands_series;//产品系列
	public function __construct(){
		
		parent::__construct();
		$this->member = "member";
		$this->navpage = 'member/nav';

		$this->load->model('t_product_brands_series_model');
		$this->t_product_brands_series = $this->t_product_brands_series_model;
		$this->load->model('t_service_brands_apply_model');
		$this->t_service_brands_apply = $this->t_service_brands_apply_model;
		$this->load->model('t_service_info_model');
		$this->t_service_info = $this->t_service_info_model;
		$this->load->model('t_product_class_brands_model');
		$this->t_product_class_brands_series = $this->t_product_class_brands_model;
		$this->load->model('t_product_class_brands_series_model');
		$this->brands_series = $this->t_product_class_brands_series_model;
	

		//共公有的
		$this->load->helper('import_excel');
		$this->load->helper('content_fun');
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->limit = 10;
		$this->load->helper('url');

	}
	public function index()
	{
		jumpAjax("",site_url('admin/serviceBrSe/series'));
	}

	//取得参数
	public function post_param(){
		return $this->input->post();
	}
	
	//get参数
	public function get_param(){
		return $this->input->get();
	}
	
	//经销商系列
	public function series(){

		$data['title']='家178-管理中心-服务商';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'serviceBrSe/series'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单

		$result = array();
		$getResult = $this->get_param();

		$key_word = isset($getResult['key_word'])?trim($getResult['key_word']):"";
		$brand_id = isset($getResult['brand_id'])?trim($getResult['brand_id']):"";
		$service_id = isset($getResult['service_id'])?trim($getResult['service_id']):"";
		$series_status = isset($getResult['series_status'])?trim($getResult['series_status']):"";

		//分页
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		//总条数
		$total_rows = count($this->t_product_brands_series->service_search_count($brand_id,$service_id,$key_word,$series_status));
		
		$office =  ($page-1)*($this->limit);
		//结果
		$result['re'] = $this->t_product_brands_series->service_search($brand_id,$service_id,$key_word,$series_status,$office,$this->limit);
		$this->libs->base_url = site_url('admin/serviceBrSe/series').'?search=0&brand_id='.$brand_id."&key_word=".$key_word."&service_id=".$service_id;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();

		$result['brand_id'] = $brand_id;
		$result['service_id'] = $service_id;
		$result['series_status'] = $series_status;
		$result['key_word'] = $key_word;

		$this->pagedata = $result;//向页面加入加载数据
		parent::_initpage();//加载页面
	}




	//经销商品牌系列添加
	public function serviceBrSeadd(){
		$data['title']='家178- 产品管理';
		$data['menu']=$this->member;
		$this->data = $data;
		$this->page = 'serviceBrSe/serviceBrSeAdd';
		$this->navpage = $this->navpage;
		$result = array();
		//品牌
		$getResult = $this->get_param();
		$brand_id = isset($getResult['brand_id'])?trim($getResult['brand_id']):"";
		$service_id = isset($getResult['service_id'])?trim($getResult['service_id']):"";
		$result['service'] = $this->t_service_info->get_all();
	
		if($service_id){
			$field = 'brand_id,apply_brand_name';
			$where['service_id'] =  $service_id;
			//查找商务商己生效的品牌
			$where['apply_status'] =  1;
			$result['brands'] = $this->t_service_brands_apply->get_tag($field,$where);
			if($brand_id){
				$result['brands_class'] = $this->t_product_class_brands_series->getClassInfoByBrand($brand_id);
			}

			//var_dump($result['brands'] );die;
		}


		$field = "s_class_id,s_class_name";
		$where = array('s_class_type'=>12,'s_class_pid'=>0);
		//$result['product_class'] = $this->t_system_class->get_tag($field,$where);
		$result['brand_id'] = $brand_id;
		$result['service_id'] = $service_id;
		$this->pagedata = $result;
		parent::_initpage();
	}

	//经销商品牌系列添加提交
	public function doServiceBrSeAdd(){
		$this->t_product_brands_series->brand_id=$this->input->post('s_c_tag_id',true);
		//系列分类
		$s_class_id=$this->input->post('s_class_id',true);

		$this->t_product_brands_series->series_name=$this->input->post('series_name',true);
		$this->t_product_brands_series->series_seodesc = $this->input->post('series_seodesc',true);
		$this->t_product_brands_series->series_seokey = $this->input->post('series_seokey',true);
		$this->t_product_brands_series->series_status = $this->input->post('series_status',true);
		$this->t_product_brands_series->service_id = $this->input->post('service_id',true);
		$this->t_product_brands_series->series_ename = $this->input->post('series_ename',true);
		$getResult = $this->get_param();
		$this->t_product_brands_series->series_addtime=date("Y-m-d H:i:s");
		$brand_id = isset($getResult['brand_id_bak'])?trim($getResult['brand_id_bak']):"";
		$service_id = isset($getResult['service_id_bak'])?trim($getResult['service_id_bak']):"";
		
		if($this->input->post('brand_img')){
			$this->t_product_brands_series->series_img=$this->input->post('brand_img',true);
		}else{
			$url = site_url('admin/serviceBrSe/serviceBrSeadd')."?brand_id=".$brand_id."&service_id=".$service_id;
			jumpAjax("请上传品牌图标！",$url);
		}
		if($this->t_product_brands_series->get_series('series_id',array('brand_id'=>$this->t_product_brands_series->brand_id,'series_name'=>$this->t_product_brands_series->series_name,'service_id'=>$this->t_product_brands_series->service_id))){
			$url = site_url('admin/serviceBrSe/serviceBrSeadd')."?brand_id=".$brand_id."&service_id=".$service_id;
			jumpAjax("不能在同一个品牌中加入相同的系列！",$url);
		}else{
			if($series_id = $this->t_product_brands_series->insert()){

				// 插入产品系列品类表（查找该系列所属分类，如果没分类则不用加,有则加）
				/*$where['brand_id'] = $this->t_product_brands_series->brand_id;
				if($brands_class = $this->t_product_class_brands_series->get_class_brands_series('brand_id,s_class_id',$where)){
					$this->brands_series->series_id = $series_id;
					foreach ($brands_class as $key => $value) {
					  $this->brands_series->s_class_id = $value['s_class_id'];
					  $this->brands_series->insert();
					}
				}*/
				$this->brands_series->series_id = $series_id;
				foreach ($s_class_id as $key => $value) {
				  $this->brands_series->s_class_id = $value;
				  $this->brands_series->insert();
				}
				$url = site_url('admin/serviceBrSe/series')."?brand_id=".$brand_id."&service_id=".$service_id;
				jumpAjax("添加成功！",$url);
			}else{
				$url = site_url('admin/serviceBrSe/serviceBrSeadd')."?brand_id=".$brand_id."&service_id=".$service_id;
				jumpAjax("添加失败！",$url);
			}
		}
	
	}

	//ajax根据服务商id得到品牌
	public function doBrandsBServiceId(){
		$service_id = $this->input->post('service_id');
		$field = 'brand_id,apply_brand_name';
		$where['service_id'] =  $service_id;
		$where['apply_status'] =  1;
		$brands = $this->t_service_brands_apply->get_tag($field,$where);
		if($brands){
			echojson('1',$brands,'获取数据成功！');
		}else{
			echojson('0',"",'获取数据成败！');
		}
	}

}
