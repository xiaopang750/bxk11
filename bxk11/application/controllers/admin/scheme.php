<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/16 16:10:17 
 *       liuguangpingAuthor: liuguangping
 *        Email: liuguangpingtest@163.com

 */
class Scheme extends Admin_Controller
{	
	public $content;
	public $navpage;
	public $libs;
	public $limit;
	public $t_project_scheme;
	public function __construct(){
		parent::__construct();
		$this->content = 'content';
		$this->navpage = 'content/nav';
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->load->model('t_project_scheme_model');
		$this->t_project_scheme = $this->t_project_scheme_model;
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');
		//$this->load->helper('file');
		$this->limit = 10;
	}
	public function index(){
		$data['title']='家178-内容管理-方案列表';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/scheme';
		$this->navpage = $this->navpage ;
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;

		$scheme_status = $this->input->get('scheme_status');
		$scheme_type = $this->input->get('scheme_type');
		$a_start = $this->input->get('a_start');
		$a_end = $this->input->get('a_end');
		$user_name = trim($this->input->get('user_name'));
		$scheme_name = trim($this->input->get('scheme_name'));
		$scheme_user_type = trim($this->input->get('scheme_user_type'));
		if($a_start >$a_end){
			$a_start ="";
			$a_end = '';
		}

		$total_rows = count($this->t_project_scheme->admin_search_count($scheme_status,$scheme_type,$a_start,$a_end,$user_name,$scheme_name,$scheme_user_type));
		//$total_rows = $this->t_project_scheme->count_all();
		$office =  ($page-1)*($this->limit);
		
		//$result['re'] = $this->blog_model->get_list($this->limit,$office,'content_id','DESC');
		$result['scheme_status'] = $scheme_status;
		$result['scheme_type'] = $scheme_type;
		$result['a_start'] = $a_start;
		$result['a_end'] = $a_end;
		$result['user_name'] = $user_name;
		$result['scheme_name'] = $scheme_name;
		$result['scheme_user_type'] = $scheme_user_type;
		
		$result['re'] = $this->t_project_scheme->admin_search($scheme_status,$scheme_type,$a_start,$a_end,$user_name,$scheme_name,$scheme_user_type,$office,$this->limit);
		$this->libs->base_url = site_url('admin/scheme/index').'?search=0&scheme_status='.$scheme_status."&scheme_type=".$scheme_type."&a_start=".$a_start."&a_end=".$a_end."&user_name=".$user_name."&scheme_name=".$scheme_name."&scheme_user_type=".$scheme_user_type;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$this->pagedata = $result;
		 //var_dump($result);die; 
		parent::_initpage();
	}
	
	public function dostatus(){
		$status = $this->input->post('status',true);
		$scheme_id = $this->input->post('question_id',true);
		$data = array('scheme_status'=>$status);
		$where = array('scheme_id'=>$scheme_id);
		if($this->t_project_scheme->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}
	
	public function dois_hot(){
		$status = $this->input->post('status',true);
		$room_id = $this->input->post('ids',true);
		$data = array('scheme_is_hot'=>$status);
		$where = array('scheme_id'=>$room_id);
		if($this->t_project_scheme->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
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
	public function schemeShow(){
		$scheme_id = $this->input->get('scheme_id');
		$type = $this->input->get('type');
		if(is_numeric($scheme_id) && $scheme_id!='' && isset($scheme_id)){
			loadLib('Roomlib_Class');
			$roomlib_bak = new Roomlib_Class();
			$this->roomlib_class = $roomlib_bak;
			$result = $this->roomlib_class->xmlUpdate(array('room_id'=>'','scheme_id'=>$scheme_id));
			if($result){
				$message = '';
				if(isset($result['room'])){
					$room = implode(',',$result['room']);
					$message.=$room.":房间生成失败，请确认你的房间的数据是否上传齐全或全xml是否生成;";
				}
				if(isset($result['scheme'])){
					$scheme = implode(',',$result['scheme']);
					$message.=$scheme.":案例生成失败，请确认你的案例的数据是否上传齐全或全xml是否生成;";
				}
				if(isset($result['diy'])){
					$diy = implode(',',$result['diy']);
					$message.=$diy.":DIY案例生成失败，请确认你的DIY案例的数据是否上传齐全或全xml是否生成;";
				}
				if(isset($result['scheme'])){
				
					if($type == 1){
						echo "<script>alert('".$message."');window.open('".site_url('room/xml3DdiyShow')."?sid={$scheme_id}')</script>";
					}else{
						echo "<script>alert('".$message."');window.open('".site_url('room/xml3dShow')."?sid={$scheme_id}')</script>";
					}
					echo "<script>window.location.href='".site_url('admin/scheme/index')."'</script>";exit;
				}else{
					echo "<script>alert('生成成功！');window.location.href='".site_url('admin/scheme/index')."'</script>";exit;
				}
		
			}else{
				if($type == 1){
					echo "<script>alert('生成成功！');window.open('".site_url('room/xml3DdiyShow')."?sid={$scheme_id}')</script>";
				}else{
					echo "<script>alert('生成成功！');window.open('".site_url('room/xml3dShow')."?sid={$scheme_id}')</script>";
					
				}
				echo "<script>window.location.href='".site_url('admin/scheme/index')."'</script>";exit;
			}
		
		}else{
			echo "<script>alert('你传入的参不对，请核对！');window.location.href='".site_url('admin/scheme/index')."'</script>";exit;
		}
	}
	/**
	 * 批量生成案例xml
	 */
	public function schemeUpade(){
		$schemes = $this->t_project_scheme->get_scheme();
		$counts = count($schemes);
		$page = $this->input->get('page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$office =  ($page-1)*1;
		
		$output = array_slice($schemes, $office, 1);
		loadLib('Roomlib_Class');
		$roomlib_bak = new Roomlib_Class();
		$this->roomlib_class = $roomlib_bak;
		if($page<=$counts){
			$p = $page+1;
			$this->roomlib_class->xmlOneUpade('',$output[0]['scheme_id']);
			echo "需要一段时间，请耐心等待<br>更新中。。。。。。";
			echo "<script>window.location.href='".site_url('admin/scheme/schemeUpade')."?page={$p}'</script>";
		}else{
			echo "操作完成！！";
			$this->config->load('uploads');
			$upload_url = $this->config->item('upload_file');
			$ulr = $upload_url['rs_url'];
			
			
			//生成推荐xml
			$this->load->model('t_system_model');
			$t_system = $this->t_system_model;
			$recommend = $t_system->get('scheme_recommend');
			if($recommend->sys_value && isset($recommend->sys_value)){
				$recommend_val = explode(',',$recommend->sys_value);
				//首页推荐
				$recommend_val[] = "852";
				//echo "<pre>";var_dump($recommend_val);die;
				$messagev = '';
				foreach ($recommend_val as $vaz){
					$this->roomlib_class->flg = 1;
					//生成推荐xml
					if(!$this->roomlib_class->xml3d($vaz)){
						$messagev.=$vaz.":案例频道首页轮播案例生成失败，请确认你的案例的数据是否上传齐全或全xml是否生成;"."\r\n";
						
					}
				}
				if($messagev !=''){
					write_dary($messagev,$ulr);
				}
			}
			
			$result = read_dary($ulr);
			$num = count($result)-1;
			for($i = $num;$i>=0;$i--){
				echo $result[$i]."<br>";
			}
			@unlink($ulr);exit;
		}
		
	}
	
}

?>
