<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/16 16:10:17 
 *       liuguangpingAuthor: liuguangping
 *        Email: liuguangpingtest@163.com

 */
class Room extends Admin_Controller
{	
	public $content;
	public $navpage;
	public $libs;
	public $limit;
	public $t_project_room;
	public $t_system_class;
	public $t_certified_product;
	public $t_project_room_bill_item;
	public function __construct(){
		parent::__construct();
		$this->content = 'content';
		$this->navpage = 'content/nav';
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->load->model('t_project_room_model');
		$this->t_project_room = $this->t_project_room_model;
		$this->load->model('t_system_class_model');
		$this->t_system_class = $this->t_system_class_model;
		$this->load->model('t_certified_product_model');
		$this->t_certified_product = $this->t_certified_product_model;
		$this->load->model('t_project_room_bill_item_model');
		$this->t_project_room_bill_item = $this->t_project_room_bill_item_model;
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');
		//$this->load->helper('file');
		$this->limit = 10;
	}
	public function index(){
	
		$data['title']='家178-内容管理-方案列表';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/room';
		$this->navpage = $this->navpage ;
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;

		$room_status = $this->input->get('room_status');
		$room_type = $this->input->get('room_type');
		$a_start = $this->input->get('a_start');
		$a_end = $this->input->get('a_end');
		$user_name = trim($this->input->get('user_name'));
		$room_name = trim($this->input->get('room_name'));
	
		if($a_start >$a_end){
			$a_start ="";
			$a_end = '';
		}
	
		$total_rows = count($this->t_project_room->admin_search_count($room_status,$room_type,$a_start,$a_end,$user_name,$room_name));
		//$total_rows = $this->t_project_scheme->count_all();
		
		$office =  ($page-1)*($this->limit);
		
		//$result['re'] = $this->blog_model->get_list($this->limit,$office,'content_id','DESC');
		$result['room_status'] = $room_status;
		$result['room_type'] = $room_type;
		$result['a_start'] = $a_start;
		$result['a_end'] = $a_end;
		$result['user_name'] = $user_name;
		$result['room_name'] = $room_name;
		
		$result['re'] = $this->t_project_room->admin_search($room_status,$room_type,$a_start,$a_end,$user_name,$room_name,$office,$this->limit);
		$this->libs->base_url = site_url('admin/room/index').'?search=0&room_status='.$room_status."&room_type=".$room_type."&a_start=".$a_start."&a_end=".$a_end."&user_name=".$user_name."&room_name=".$room_name;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function dostatus(){
		$status = $this->input->post('status',true);
		$room_id = $this->input->post('question_id',true);
		$data = array('room_status'=>$status);
		$where = array('room_id'=>$room_id);
		if($this->t_project_room->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}
	
	public function dois_hot(){
		$status = $this->input->post('status',true);
		$room_id = $this->input->post('ids',true);
		$data = array('room_is_hot'=>$status);
		$where = array('room_id'=>$room_id);
		if($this->t_project_room->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}
	public function addProduct(){
		$data['title']='家178-内容管理-楼盘添加';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/addProduct';
		$this->navpage = $this->navpage ;
		$result = array();
		$field = "s_class_id,s_class_name";
		$where = array('s_class_type'=>12,'s_class_pid'=>0);
		$result['product_class'] = $this->t_system_class->get_tag($field,$where);
		$result['randcode'] =  "JIA178".time().randcode(5);
		$room_id = $this->input->get('room_id');
		$result['room_id'] = $room_id;
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function dogetProduct(){
		$brand_id = $this->input->post('brand_id',true);
		$series_id = $this->input->post('series_id',true);
		$pattern_id = $this->input->post('pattern_id',true);
		$code = $this->input->post('code',true);
		$key_word = $this->input->post('key_word',true);

		$result = $this->t_certified_product->admin_ajax_searchproduct($brand_id,$series_id,$pattern_id,$code,$key_word);
// 		/var_dump($result);die;
		if($result){
			echojson('1', $result,'');
		}else{
			echojson(0, '',"获取数据失败！");
		}
		
	}
	public function doProductItem(){
		
		$this->t_project_room_bill_item->product_id = $this->input->post('product_id',true);
		$this->load->model('t_certified_product_model');
		
		$row = $this->t_certified_product_model->get($this->t_project_room_bill_item->product_id);
		$this->t_project_room_bill_item->room_id = $this->input->post('room_id',true);


		//日后调节
		//$this->t_project_room_bill_item->poduct_url = $this->input->post('poduct_url',true);
		//$this->t_project_room_bill_item->poduct_picurl = $this->input->post('poduct_picurl',true);
		//$this->t_project_room_bill_item->service_id = $this->input->post('service_id',true);
		//$this->t_project_room_bill_item->item_type = $this->input->post('item_type',true);
		//$this->t_project_room_bill_item->poduct_name = $row->product_name;
		//$this->t_project_room_bill_item->hot_status = $this->input->post('hot_status',true);
		//$this->t_project_room_bill_item->hot_angle = $this->input->post('hot_angle',true);
		$this->config->load('uploads');
		$config = $this->config->item('product');
		$this->t_project_room_bill_item->poduct_picurl =base_url().$config['relative_path'].'index'.$row->product_pic;
		$this->t_project_room_bill_item->service_id=0;
		$this->t_project_room_bill_item->item_type=1;
		$this->t_project_room_bill_item->poduct_name=$row->product_name;
		$this->t_project_room_bill_item->hot_status = 1;
		$this->t_project_room_bill_item->hot_angle=0;
		$this->t_project_room_bill_item->poduct_url=site_url().'/product/info?pid='.$row->product_id;



		$this->t_project_room_bill_item->hot_x = $this->input->post('hot_x',true);
		$this->t_project_room_bill_item->hot_y = $this->input->post('hot_y',true);
		if($this->t_project_room_bill_item->poduct_picurl){
			$this->t_project_room_bill_item->poduct_picurl =base_url().$config['relative_path'].'index'.$row->product_pic;
		}else{
			echo "<script type='text/javascript'>alert('请上传图片！');window.location.href='".site_url('admin/room/addProduct')."?room_id={$this->input->post('room_id',true)}'</script>";exit;
		}
		if($this->t_project_room_bill_item->insert()){
			$roomInfo = $this->t_project_room->getRoomInfo($this->input->post('room_id',true));

			if($roomInfo->room_type == 2){
		
				//生成xml热点
				loadLib('Roomlib_Class');
				$roomlib_bak = new Roomlib_Class();
				$this->roomlib_class = $roomlib_bak;
				$result = $this->roomlib_class->xmlUpdate(array('room_id'=>$this->t_project_room_bill_item->room_id,'scheme_id'=>''));
			}
			$this->t_certified_product->updataproduct_rooms("product_rooms",$this->t_project_room_bill_item->product_id,1);
			
			echo "<script>alert('房间装修单项添加成功！');window.location.href='".site_url('admin/room/index')."'</script>";exit;
		}else{
			echo "<script>alert('房间装修单项添加失败！');window.location.href='".site_url('admin/room/addProduct')."?room_id={$this->input->post('room_id',true)}'</script>";exit;
		}
	}
	public function item(){
		$data['title']='家178-内容管理-房间装修清单项添加';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/item';
		$this->navpage = $this->navpage ;
	
		$result = array();
		$room_id = $this->input->get('room_id');
		$result['room_id'] = $room_id;
		$result['re'] = $this->t_project_room_bill_item->getBillitemByItem('*',array('room_id'=>$room_id));
		$result['num'] = count($result['re']);
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function doitemstatus(){
		$status = $this->input->post('status',true);
		$item_id = $this->input->post('question_id',true);
		$data = array('hot_status'=>$status);
		$where = array('item_id'=>$item_id);
		if($this->t_project_room_bill_item->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}
	public function dodel_item(){
		$ids = $this->input->post('ids');
		$idarr = explode(',',$ids);
		
		$temarr = array();
		foreach($idarr as $val){
			$reo = $this->t_project_room_bill_item->get($val);
			$this->t_certified_product->updataproduct_rooms("product_rooms",$reo->product_id,-1);
			if($this->t_project_room_bill_item->delete($val)){
				$temarr[] = $val;
			}
		}
		if($temarr){
			echo json_encode($temarr);
		}else{
			echo "0";
		}
	}
	public function item_edit(){
		$data['title']='家178-内容管理-房间装修清单项添加';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/item_edit';
		$this->navpage = $this->navpage;
		$result = array();
		$item_id = $this->input->get('item_id');
		$result['re'] = $this->t_project_room_bill_item->get($item_id);
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function doitem_edit(){
		$this->config->load('uploads');
		$config = $this->config->item('product');
		$row = $this->t_certified_product_model->get($this->input->post('product_id',true));
		
		$data['poduct_url'] = site_url().'/product/info?pid='.$row->product_id;;
		$data['poduct_picurl'] = base_url().$config['relative_path'].'index'.$row->product_pic;
		////$data['item_type']= $this->input->post('item_type',true);
		//$data['service_id']  = $this->input->post('service_id',true);
		$data['hot_status']  = $this->input->post('hot_status',true);
		$data['hot_x']  = $this->input->post('hot_x',true);
		$data['hot_y'] = $this->input->post('hot_y',true);
		//$data['hot_angle']  = $this->input->post('hot_angle',true);
		/* if($this->input->post('poduct_picurl')){
			$data['poduct_picurl'] = $this->input->post('poduct_picurl');
		}else{
			echo "<script type='text/javascript'>alert('请上传图片！');window.location.href='".site_url('admin/room/item_edit')."?room_id={$this->input->post('room_id',true)}'</script>";exit;
		} */
		
		if($this->t_project_room_bill_item->updates_global($data,array('item_id'=>$this->input->post('item_id')))){
			$room = $this->input->post('room_id');
			if($room){
				//生成xml热点
				loadLib('Roomlib_Class');
				$roomlib_bak = new Roomlib_Class();
				$this->roomlib_class = $roomlib_bak;
				$result = $this->roomlib_class->xmlUpdate(array('room_id'=>$room,'scheme_id'=>''));
			}
			echo "<script>alert('修改成功！');window.location.href='".site_url('admin/room/item')."?room_id={$this->input->post('room_id',true)}'</script>";exit;
		}else{
			echo "<script>alert('修改失败！');window.location.href='".site_url('admin/room/item_edit')."?item_id={$this->input->post('item_id',true)}'</script>";exit;
		}
	}
	public function addhotspot(){
 		$room_id = $this->input->get('room_id');
		loadLib('Roomlib_Class');
		$roomlib_bak = new Roomlib_Class();
		$this->roomlib_class = $roomlib_bak;

		if($isexists = $this->roomlib_class->editxml($room_id)){
			//echo $isexists;die;
			$result  = array('xml'=>$isexists,'title'=>'家178-获取热点');
			$this->load->view('admin/content/addhotspot',$result);
		}else{
			echo "<script>alert('你的房间的数据不正常，请确认你的房间的数据是否上传齐全或全xml是否生成！');window.location.href='".site_url('admin/room/addProduct')."?room_id={$room_id}'</script>";exit;
		}
	}
	
	public function roomShow(){
		$room_id = $this->input->get('room_id');
		if(is_numeric($room_id) && $room_id!='' && isset($room_id)){
			loadLib('Roomlib_Class');
			$roomlib_bak = new Roomlib_Class();
			$this->roomlib_class = $roomlib_bak;
			$result = $this->roomlib_class->xmlUpdate(array('room_id'=>$room_id,'scheme_id'=>''));
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
				if(!isset($result['room'])){
					//echo $message;die;
					echo "<script>alert('".$message."');window.open('".site_url('room/previewShow')."?rid={$room_id}')</script>";
					echo "<script>window.location.href='".site_url('admin/room/index')."'</script>";exit;
				}else{
					echo "<script>alert('生成失败！');window.location.href='".site_url('admin/room/index')."'</script>";exit;
				}
				
			}else{
				
				echo "<script>alert('生成成功！');window.open('".site_url('room/previewShow')."?rid={$room_id}')</script>";
				echo "<script>window.location.href='".site_url('admin/room/index')."'</script>";exit;
			}
		
		}else{
			echo "<script>alert('你传入的参不对，请核对！');window.location.href='".site_url('admin/room/index')."'</script>";exit;
		}
	}
	//批量生成样板间和关联的案例xml
	public function roomUpade(){
		$rooms = $this->t_project_room->get_room();
		$counts = count($rooms);
		$page = $this->input->get('page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$office =  ($page-1)*1;
		//echo $counts;die;
	
		$output = array_slice($rooms, $office, 1);
	
		if($page<=$counts){
			$p = $page+1;
			loadLib('Roomlib_Class');
			$roomlib_bak = new Roomlib_Class();
			$this->roomlib_class = $roomlib_bak;
			$this->roomlib_class->xmlOneUpade($output[0]['room_id'],'');
			echo "需要一段时间，请耐心等待<br>更新中。。。。。。";
			echo "<script>window.location.href='".site_url('admin/room/roomUpade')."?page={$p}'</script>";
		}else{
			echo "操作完成！！";
			$this->config->load('uploads');
			$upload_url = $this->config->item('upload_file');
			$ulr = $upload_url['rs_url'];
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
