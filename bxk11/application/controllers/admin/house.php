<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/16 16:10:17 
 *       liuguangpingAuthor: liuguangping
 *        Email: liuguangpingtest@163.com

 */
class House extends Admin_Controller
{	
	public $content;
	public $navpage;
	public $libs;
	public $t_system_class;
	public $limit;
	public $tag_model;
	public $t_system_district;
	public $t_house;
	public $t_house_apartment;
	public $t_s_class_tag;
	public function __construct(){
		parent::__construct();
		$this->content = 'content';
		$this->navpage = 'content/nav';
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->load->model('t_system_class_model');
		$this->load->model('t_s_class_tag_model');
		$this->t_s_class_tag = $this->t_s_class_tag_model;
		$this->load->model('t_system_district_model');
		$this->t_system_district = $this->t_system_district_model;
		$this->load->model('t_house_model');
		$this->t_house = $this->t_house_model;
		
		$this->load->model('t_house_apartment_model');
		$this->t_house_apartment = $this->t_house_apartment_model;
		
		$this->load->model('t_tag_model');
		$this->tag_model = $this->t_tag_model;
		$this->t_system_class = $this->t_system_class_model;
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');
		$this->limit = 10;
	}
	public function index(){
		$data['title']='家178-内容管理- 楼盘列表';
		$data['menu']=$this->content;
		$this->data = $data;
		$result = array();
	 	$this->page = 'content/house';
		$this->navpage = $this->navpage ;
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;

		$house_status = $this->input->get('house_status');
		$house_type = $this->input->get('house_type');
		$ka_start = $this->input->get('ka_start');
		$ka_end = $this->input->get('ka_end');
		$ea_start = $this->input->get('ea_start');
		$ea_end = $this->input->get('ea_end');
		$user_name = trim($this->input->get('user_name'));
		$house_name = trim($this->input->get('house_name'));
		$house_province = trim($this->input->get('house_province'));
		$house_city = trim($this->input->get('house_city'));
		$this->t_system_district->district_pcode = '0';
		$result['house_province_source'] = $this->t_system_district->getbypid();
		if($house_province !=0){
			$this->t_system_district->district_pcode = $house_province;
			$result['house_city_source'] = $this->t_system_district->getbypid();
		}
		if(!isset($result['house_city_source'])){
			$result['house_city_source'] = '';
		}
		if($ka_start >$ka_end){
			$a_start ="";
			$a_end = '';
		}
		if($ea_start >$ea_end){
			$ea_start ="";
			$ea_end = '';
		}
		$total_rows = count($this->t_house->admin_search_count($house_status,$house_type,$ka_start,$ka_end,$ea_start,$ea_end,$house_province,$house_city,$user_name,$house_name));
		//$total_rows = $this->t_project_scheme->count_all();
		$office =  ($page-1)*($this->limit);
		$result['house_status'] = $house_status;
		$result['house_type'] = $house_type;
		$result['ka_start'] = $ka_start;
		$result['ka_end'] = $ka_end;
		$result['ea_start'] = $ea_start;
		$result['ea_end'] = $ea_end;
		$result['user_name'] = $user_name;
		$result['house_name'] = $house_name;
		$result['house_province'] = $house_province;
		$result['house_city'] = $house_city;
		$result['re'] = $this->t_house->admin_search($house_status,$house_type,$ka_start,$ka_end,$ea_start,$ea_end,$house_province,$house_city,$user_name,$house_name,$office,$this->limit);
		$this->libs->base_url = site_url('admin/house/index').'?search=0&house_status='.$house_status."&house_type=".$house_type."&ka_start=".$ka_start."&ka_end=".$ka_end."&ea_start=".$ea_start."&ea_end=".$ea_end."&user_name=".$user_name."&house_name=".$house_name;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function add(){

		$data['title']='家178-内容管理-楼盘添加';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/house_add';
		$this->navpage = $this->navpage ;
		$result = array();
		$this->t_system_district->district_pcode = '0';
		$result['house_province'] = $this->t_system_district->getbypid();
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function doprovince(){
		$house_province_pid = $this->input->post('house_province_pid',true);
		$this->t_system_district->district_pcode = $house_province_pid;
		$house_city = $this->t_system_district->getbypid();

		if($house_city){
			echojson(1, $house_city);
		}else{
			echojson(0, $house_city,'数据结果为空或执行失败等');
		}
	}
	
	public function dohouse(){
		$this->t_house->house_name = $this->input->post('house_name');
		$this->t_house->house_explain = $this->input->post('house_explain');
		$this->t_house->house_developer_id = 0;
		$this->t_house->house_developer = '';
		if($this->input->post('house_province')){
			$this->t_house->house_province = $this->input->post('house_province');
		}else{
			echo "<script>alert('省份不能为空！');window.location.href='".site_url('admin/house/add')."'</script>";
		}
		
		if($this->input->post('house_city')){
			$this->t_house->house_city = $this->input->post('house_city');
		}else{
			echo "<script>alert('市不能为空！');window.location.href='".site_url('admin/house/add')."'</script>";
		}
		//var_dump($this->input->post('house_city'));die;
		$this->t_house->house_address = $this->input->post('house_address');
		$this->t_house->user_id = 0;
		$this->t_house->house_type = 1;
		$this->t_house->house_opendate = $this->input->post('house_opendate');
		$this->t_house->house_checkdate = $this->input->post('house_checkdate');
		$this->t_house->house_url = $this->input->post('house_url');	
		$this->t_house->house_link = '';
		$this->t_house->house_activity = '';	
		$this->t_house->house_designers = $this->input->post('house_designers');	
		$this->t_house->house_schemes = $this->input->post('house_schemes');
		$this->t_house->house_is_hot = $this->input->post('house_is_hot');
		$this->t_house->house_is_recommend = $this->input->post('house_is_recommend');
		$this->t_house->house_status = $this->input->post('house_status');	
		$this->t_house->house_layouts = 0;
		$this->t_house->house_views = 0;
		$this->t_house->house_likes = 0;
		$this->t_house->house_sort = $this->input->post('house_sort');
		$this->t_house->house_pic1 = $this->input->post('house_pic1');
		$this->t_house->house_pic2 = $this->input->post('house_pic2');
		$this->t_house->house_pic3 = $this->input->post('house_pic3');
		if(!is_numeric($this->t_house->house_sort)){
			echo "<script>alert('该市楼盘排序不是数字！');window.location.href='".site_url('admin/house/add')."'</script>";
		}
		if($this->t_house->get_house('house_id',array('house_name'=>$this->t_house->house_name ,'house_city'=>$this->t_house->house_city))){
			echo "<script>alert('该市楼盘己有,不能重复添加！');window.location.href='".site_url('admin/house/add')."'</script>";
		}
		if($this->t_house->insert()){
			echo "<script>alert('添加成功！');window.location.href='".site_url('admin/house/index')."'</script>";
		}
		
	}
	
	public function house_apartment(){
		
		$data['title']='家178-内容管理-户型列表';
		$data['menu']=$this->content;
		$this->data = $data;
		$result = array();
	 	$this->page = 'content/house_apartment';
		$this->navpage = $this->navpage ;
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;

		$apartment_status = $this->input->get('apartment_status');
		$apartment_type = $this->input->get('apartment_type');
		$apartment_category_id = $this->input->get('apartment_category_id');
		$house_id = $this->input->get('house_id');
		$user_name = trim($this->input->get('user_name'));
		$apartment_name = trim($this->input->get('apartment_name'));
		$house_province = trim($this->input->get('house_province'));
		$house_city = trim($this->input->get('house_city'));
		$this->t_system_district->district_pcode = '0';
		$result['house_province_source'] = $this->t_system_district->getbypid();
		if($house_province !=0){
			$this->t_system_district->district_pcode = $house_province;
			$result['house_city_source'] = $this->t_system_district->getbypid();
		}
		if(!isset($result['house_city_source'])){
			$result['house_city_source'] = '';
		}
		if($house_city !=0){
			$house_city = $house_city;
			$where = array('house_city'=>$house_city);
			$result['house'] = $this->t_house->get_house('house_id,house_name',$where);
		}
		if(!isset($result['house'])){
			$result['house'] = '';
		}
		$s_class_idarr = $this->t_system_class->classlisttag('13','户型');
		$result['list'] = $s_class_idarr;
		$total_rows = count($this->t_house_apartment->admin_search_count($apartment_status,$apartment_type,$house_id,$user_name,$apartment_name,$apartment_category_id));
		//$total_rows = $this->t_project_scheme->count_all();
		$office =  ($page-1)*($this->limit);
		$result['apartment_status'] = $apartment_status;
		$result['apartment_type'] = $apartment_type;
		$result['user_name'] = $user_name;
		$result['apartment_name'] = $apartment_name;
		$result['apartment_category_id']  = $apartment_category_id;
		$result['house_province'] = $house_province;
		$result['house_city'] = $house_city;
		$result['house_id'] = $house_id;
		//echo "<pre>";var_dump($result['house_id']);die;
		if(!isset($house_id)) $result['house_id'] = 0;
		$result['re'] = $this->t_house_apartment->admin_search($apartment_status,$apartment_type,$house_id,$user_name,$apartment_name,$apartment_category_id,$office,$this->limit);
		//echo "<pre>";var_dump($result['re']);die;
		$this->libs->base_url = site_url('admin/house/house_apartment').'?search=0&apartment_status='.$apartment_status."&apartment_type=".$apartment_type."&apartment_category_id=".$apartment_category_id."&user_name=".$user_name."&apartment_name=".$apartment_name."&house_id=".$house_id;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$this->pagedata = $result;
		parent::_initpage();
	}

	public function house_apartment_add(){

		//echo $this->t_house_apartment->count_all();die;
		$data['title']='家178-内容管理-户型添加';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/house_apartment_add';
		$this->navpage = $this->navpage ;
		$result = array();
		$this->t_system_district->district_pcode = '0';
		$result['house_province'] = $this->t_system_district->getbypid();
		$s_class_idarr = $this->t_system_class->classlisttag('13','户型');
		$result['list'] = $s_class_idarr;
		
		$this->pagedata = $result;
		parent::_initpage();
	}

	public function dohouse_apartment(){
	
		$this->t_house_apartment->apartment_name = $this->input->post('apartment_name');
		$this->t_house_apartment->house_id = $this->input->post('house_id');
		if($this->t_house_apartment->house_id == '0'){
			echo "<script>alert('楼盘不能为空！');window.location.href='".site_url('admin/house/house_apartment_add')."'</script>";
		}
		$this->t_house_apartment->apartment_category_id = $this->input->post('apartment_category_id');
		if($this->t_house_apartment->apartment_category_id == '0'){
			echo "<script>alert('户型不能为空！');window.location.href='".site_url('admin/house/house_apartment_add')."'</script>";
		}
		
		$tag_name = $this->tag_model->get($this->t_house_apartment->apartment_category_id);
	
		$this->t_house_apartment->apartment_category = $tag_name->tag_name;

		$this->t_house_apartment->apartment_title = $this->input->post('apartment_title');
		$this->t_house_apartment->apartment_status = $this->input->post('apartment_status');
		$this->t_house_apartment->apartment_type = $this->input->post('apartment_type');
		$this->t_house_apartment->user_id = 0;
		$this->t_house_apartment->apartment_size = $this->input->post('apartment_size');
		if(!is_numeric($this->t_house_apartment->apartment_size)){
			echo "<script>alert('该市楼盘面积不是数字！');window.location.href='".site_url('admin/house/add')."'</script>";
		}
		$this->t_house_apartment->apartment_schemes = 0;
		$this->t_house_apartment->apartment_views = 0;
		$this->t_house_apartment->housing_name ='';
		$this->t_house_apartment->apartment_floors =0;
		$this->t_house_apartment->apartment_is_hot = $this->input->post('apartment_is_hot');
		$this->t_house_apartment->apartment_is_recommend = $this->input->post('apartment_is_recommend');
		$this->t_house_apartment->apartment_sort = $this->input->post('apartment_sort');
		$upload_name = basename($this->input->post('apartment_floor_pic1'));
		$this->t_house_apartment->apartment_floor_pic1 = '';
		$this->t_house_apartment->apartment_floor_pic2 = $this->input->post('apartment_floor_pic2');
		$this->t_house_apartment->apartment_floor_pic3 = $this->input->post('apartment_floor_pic3');
		$this->t_house_apartment->apartment_floor_pic4 = $this->input->post('apartment_floor_pic4');
		if($this->t_house_apartment->get_apartment('apartment_id',array('house_id'=>$this->t_house_apartment->house_id,'apartment_name'=>$this->t_house_apartment->apartment_name))){
			echo "<script>alert('楼盘中己有这个户型！');window.location.href='".site_url('admin/house/house_apartment_add')."'</script>";
		}
		if(!is_numeric($this->t_house_apartment->apartment_sort)){
			echo "<script>alert('户型排序不是数字！');window.location.href='".site_url('admin/house/house_apartment_add')."'</script>";
		}
		if($apartment_id = $this->t_house_apartment->insert()){
			$this->load->library('image_lib');
			$this->image_lib->apartment_thumb($_SERVER['DOCUMENT_ROOT'].$this->input->post('apartment_floor_pic1'),$apartment_id);
			$this->t_house_apartment->updates_global(array('apartment_floor_pic1'=>$upload_name),array('apartment_id'=>$apartment_id));
			echo "<script>alert('添加成功！');window.location.href='".site_url('admin/house/house_apartment')."'</script>";
		}else{
			echo "<script>alert('添加失败！');window.location.href='".site_url('admin/house/house_apartment_add')."'</script>";
		}
	}
	
	public function docity(){
		$house_city_pid = $this->input->post('house_city_pid',true);
		$house_city = $house_city_pid;
		$where = array('house_city'=>$house_city);
		$house = $this->t_house->get_house('house_id,house_name',$where);
		if($house_city){
			echojson(1, $house);
		}else{
			echojson(0, $house,'数据结果为空或执行失败等');
		}
	}
	
	public function dostatus(){
		$status = $this->input->post('status',true);
		$house_id = $this->input->post('question_id',true);
		$data = array('house_status'=>$status);
		$where = array('house_id'=>$house_id);
		if($this->t_house->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}
	
	public function doapartmentstatus(){
		$status = $this->input->post('status',true);
		$house_id = $this->input->post('question_id',true);
		$data = array('apartment_status'=>$status);
		$where = array('apartment_id'=>$house_id);
		if($this->t_house_apartment->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}
	
	public function dois_hot(){
		$status = $this->input->post('status',true);
		$room_id = $this->input->post('ids',true);
		$data = array('house_is_hot'=>$status);
		$where = array('house_id'=>$room_id);
		if($this->t_house->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}
	
	public function doapartmentis_hot(){
		$status = $this->input->post('status',true);
		$room_id = $this->input->post('ids',true);
		$data = array('apartment_is_hot'=>$status);
		$where = array('apartment_id'=>$room_id);

		if($this->t_house_apartment->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}
	
	//编辑 
	public function edit(){
	
		$data['title']='家178-内容管理-楼盘编辑';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/house_edit';
		$this->navpage = $this->navpage ;
		$result = array();
		$house_id = $this->input->get('house_id');
		if(isset($house_id)){
			$result['re'] = $this->t_house->get($house_id);
			$res = $this->t_house->get($house_id);
		
			if($res->house_province !=0){
				$this->t_system_district->district_pcode = $res->house_province;
				$result['house_city_source'] = $this->t_system_district->getbypid();
			}
			if(!isset($result['house_city_source'])){
				$result['house_city_source'] = '';
			}
		}else{
			$result['re'] = '';
			echo "<script type='javascript'>alert('你加截楼盘id不正确！');window.location.href='".site_url('admin/house/index')."'</script>";
		}
		$this->t_system_district->district_pcode = '0';
		$result['house_province'] = $this->t_system_district->getbypid();
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function doedit(){
		$this->t_house->house_id = $this->input->post('house_id');
		$this->t_house->house_name = $this->input->post('house_name');
		$this->t_house->house_explain = $this->input->post('house_explain');
		$this->t_house->house_developer_id = 0;
		$this->t_house->house_developer = '';
		if($this->input->post('house_province')){
			$this->t_house->house_province = $this->input->post('house_province');
		}else{
			echo "<script>alert('省份不能为空！');window.location.href='".site_url('admin/house/add')."'</script>";
		}
	
		if($this->input->post('house_city')){
			$this->t_house->house_city = $this->input->post('house_city');
		}else{
			echo "<script>alert('市不能为空！');window.location.href='".site_url('admin/house/add')."'</script>";
		}
		//var_dump($this->t_house->house_city);die;
		$this->t_house->house_address = $this->input->post('house_address');
		$this->t_house->user_id = 0;
		$this->t_house->house_type = 1;
		$this->t_house->house_opendate = $this->input->post('house_opendate');
		$this->t_house->house_checkdate = $this->input->post('house_checkdate');
		$this->t_house->house_url = $this->input->post('house_url');
		$this->t_house->house_link = '';
		$this->t_house->house_activity = '';
		$this->t_house->house_designers = $this->input->post('house_designers');
		$this->t_house->house_schemes = $this->input->post('house_schemes');
		$this->t_house->house_is_hot = $this->input->post('house_is_hot');
		$this->t_house->house_is_recommend = $this->input->post('house_is_recommend');
		$this->t_house->house_status = $this->input->post('house_status');
		$this->t_house->house_layouts = 0;
		$this->t_house->house_views = 0;
		$this->t_house->house_likes = 0;
		$this->t_house->house_sort = $this->input->post('house_sort');
		$this->t_house->house_pic1 = $this->input->post('house_pic1');
		$this->t_house->house_pic2 = $this->input->post('house_pic2');
		$this->t_house->house_pic3 = $this->input->post('house_pic3');
		if(!is_numeric($this->t_house->house_sort)){
			echo "<script>alert('该市楼盘排序不是数字！');window.location.href='".site_url('admin/house/add')."'</script>";
		}
		if($resu = $this->t_house->get_house('house_id,house_city',array('house_name'=>$this->t_house->house_name ,'house_city'=>$this->t_house->house_city))){
			if($resu[0]->house_city != $this->t_house->house_city){
			
			echo "<script>alert('该市楼盘己有,不能重复添加！');window.location.href='".site_url('admin/house/edit')."?house_id=".$this->t_house->house_id ."'</script>";
			}
		}
		//var_dump($this->t_house);die;
		if($this->t_house->update()){
			echo "<script>alert('编辑成功！');window.location.href='".site_url('admin/house/index')."'</script>";
		}
	
	}
	
	public function house_apartment_edit(){
	
		//echo $this->t_house_apartment->count_all();die;
		$data['title']='家178-内容管理-户型添加';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/house_apartment_edit';
		$this->navpage = $this->navpage ;
		$result = array();
		$aprtment_id = $this->input->get('apartment_id');
	
		if(isset($aprtment_id)){

			$result['re']  = $this->t_house_apartment->get($aprtment_id);

		}else{
			$result['re'] = '';
			echo "<script type='javascript'>alert('你加截楼盘id不正确！');window.location.href='".site_url('admin/house/index')."'</script>";
		}

		$s_class_idarr = $this->t_system_class->classlisttag('13','户型');
		$result['list'] = $s_class_idarr;
	
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function dohouse_apartment_edit(){
		$apartment_id = $this->input->post('apartment_id',true);
		$data['apartment_category_id']  = $this->input->post('apartment_name');
		$data['apartment_category_id'] = $this->input->post('apartment_category_id');
		if($data['apartment_category_id'] == '0'){
			echo "<script>alert('户型不能为空！');window.location.href='".site_url('admin/house/house_apartment_edit')."?apartment_id=".$apartment_id."'</script>";
		}
	
		$tag_name = $this->tag_model->get($data['apartment_category_id']);
	
		$data['apartment_category'] = $tag_name->tag_name;
	
		$data['apartment_title'] = $this->input->post('apartment_title');
		$data['apartment_status']= $this->input->post('apartment_status');
		$data['apartment_type'] = $this->input->post('apartment_type');
		$data['apartment_size'] = $this->input->post('apartment_size');
		if(!is_numeric($data['apartment_size'])){
			echo "<script>alert('该市楼盘面积不是数字！');window.location.href='".site_url('admin/house/house_apartment_edit')."?apartment_id=".$apartment_id."'</script>";
		}

		$data['housing_name'] ='';
		$data['apartment_floors'] =0;
		$data['apartment_is_hot'] = $this->input->post('apartment_is_hot');
		$data['apartment_is_recommend'] = $this->input->post('apartment_is_recommend');
		$data['apartment_sort'] = $this->input->post('apartment_sort');
		$upload_name = basename($this->input->post('apartment_floor_pic1'));
		$data['apartment_floor_pic2'] = $this->input->post('apartment_floor_pic2');
		$data['apartment_floor_pic3'] = $this->input->post('apartment_floor_pic3');
		$data['apartment_floor_pic4'] = $this->input->post('apartment_floor_pic4');
		if(!is_numeric($data['apartment_sort'])){
			echo "<script>alert('户型排序不是数字！');window.location.href='".site_url('admin/house/house_apartment_edit')."?apartment_id=".$apartment_id."'</script>";
		}
		if($house_apar = $this->t_house_apartment->get($apartment_id)){
				$apartment_floor_pic1copys = $house_apar->apartment_floor_pic1;
		}
		if($this->t_house_apartment->updates_global($data,array('apartment_id'=>$apartment_id))){
			if($this->input->post('apartment_floor_pic1') != ''){
				
				$this->load->library('image_lib');
				$this->image_lib->apartment_thumb($_SERVER['DOCUMENT_ROOT'].$this->input->post('apartment_floor_pic1'),$apartment_id);
				
				if($this->t_house_apartment->updates_global(array('apartment_floor_pic1'=>$upload_name),array('apartment_id'=>$apartment_id))){
					$sourcename = removeapartment($apartment_id,'source').$apartment_floor_pic1copys;
					//echo $sourcename;die;
					$thumb_1name = removeapartment($apartment_id,'thumb_1').$apartment_floor_pic1copys;
					@unlink($sourcename);
					@unlink($thumb_1name);
				}
			}
			
			echo "<script>alert('编辑成功！');window.location.href='".site_url('admin/house/house_apartment')."'</script>";
		}else{
			echo "<script>alert('编辑失败！');window.location.href='".site_url('admin/house/house_apartment_edit')."?apartment_id=".$apartment_id."'</script>";
		}
	}
	
}

?>
