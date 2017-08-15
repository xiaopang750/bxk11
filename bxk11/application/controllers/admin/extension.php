<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 1.后台增加自助平台推广返利记录列表查看功能，主要包含：
    1.1根据返利发放时间范围查询返利记录，比如查询2014年6月11日到2014年7约15日之间的返利发放记录
    1.2根据充值卡号查询返利记录，比如查询卡号为123456789的返利记录
	1.3根据推广者标识查询返利记录，比如查询推广者标识为efe937780e95574250dabe07151bdc23的返利记录
	1.4根据推广类型查询返利记录,比如查询推广类型为1的推广返利记录
	1.5以上1.1~1.4功能应该是可以联合查询的，也可以单独查询
	1.6列表页里其它需要展示字段(推广注册服务商名称(联查t_service_info服务商基本信息表，推广者类型，返利数量，充值卡号，返利发放时间
 */
class Extension extends Admin_Controller
{	
	
	public function __construct(){
		
		parent::__construct();	
		$this->load->helper(array('form', 'url'));
		
	}

	public function index(){
		$this->load->model('T_service_spreader_rebate_record_model');
		$data['title']='家178-管理中心-推广-推广记录表';
		$data['menu']="member";//顶端选中
		$this->navpage = 'member/nav';

		$shutcut =$this->_getmenu();
		$data['mymenu'] = $shutcut['shortcut'];
		$data['base_url'] = config_item("site_url");

		$this->load->library ( 'pagination' );
		if(isset($_GET['per_page']) && is_numeric($_GET['per_page'])){
			$p = $_GET['per_page'];
		}else{
			$p=1;
		}		
		
		
		$url = base_url()."index.php/admin/extension/index?";
		$nb=3;
	
		$info=$_GET;
		if(empty($_GET['yincang']))
		{
			$_GET['yincang']='';
		}
		
		if($_GET['yincang']=='888')
		{
			unset($info['yincang']);
			$reg=$this->T_service_spreader_rebate_record_model->get_list2($p,$nb,$info);	
			$url=base_url()."index.php/admin/extension/index?ss_type=".$info['ss_type']."&spreader_code=".$info['spreader_code']."&rr_card_number=".$info['rr_card_number']."&rr_grant_time1=".$info['rr_grant_time1']."&rr_grant_time2=".$info['rr_grant_time2']."&yincang=888";
			$nubs =$this->T_service_spreader_rebate_record_model->count_all1($info['ss_type'],$info['spreader_code'],$info['rr_card_number'],$info['rr_grant_time1'],$info['rr_grant_time2']);
		}		
		else
		{	
			$nubs =$this->T_service_spreader_rebate_record_model->count_all();
			$reg=$this->T_service_spreader_rebate_record_model->get_list1($p,$nb);		
		}

		$this->fenye($nb,$nubs,$url);
		
		$reg['reg'] =$reg;		
		$this->load->view('admin/top',$data);
		$this->load->view("admin/{$this->navpage}");		
		$this->load->view('admin/extension/record',$reg);	
		$this->load->view('admin/foot');
	}
	
	public function alliance()
	{
		$this->load->model('T_service_spreader_model');
		$data['title']='家178-管理中心-推广-推广联盟';
		$data['menu']="member";//顶端选中
		$this->navpage = 'member/nav';

		$shutcut =$this->_getmenu();
		$data['mymenu'] = $shutcut['shortcut'];
		$data['base_url'] = config_item("site_url");

		$this->load->library ( 'pagination' );
		if(isset($_GET['per_page']) && is_numeric($_GET['per_page'])){
			$p = $_GET['per_page'];
		}else{
			$p=1;
		}		
		
		$url = base_url()."index.php/admin/extension/alliance?";
		$nb=3;	
		$info=$_GET;
		if(empty($_GET['yincang']))
		{
			$_GET['yincang']='';
		}			
		$info=$_GET;
		if(empty($_GET['yincang']))
		{
			$_GET['yincang']='';
		}
		if($_GET['yincang']=='888')
		{
			unset($info['yincang']);
			$reg=$this->T_service_spreader_model->get_list2($p,$nb,$info);	
			$url=base_url()."index.php/admin/extension/alliance?ss_name=".$info['ss_name']."&spreader_code=".$info['spreader_code']."&ss_phone=".$info['ss_phone']."&rr_grant_time1=".$info['rr_grant_time1']."&rr_grant_time2=".$info['rr_grant_time2']."&yincang=888";
			$nubs =$this->T_service_spreader_model->count_all1($info['ss_name'],$info['spreader_code'],$info['ss_phone'],$info['rr_grant_time1'],$info['rr_grant_time2']);
		}		
		else
		{	
			$nubs =$this->T_service_spreader_model->count_all();
			$reg=$this->T_service_spreader_model->get_list1($p,$nb);		
		}	
		$this->fenye($nb,$nubs,$url);	
		$reg['reg'] =$reg;		
		$this->load->view('admin/top',$data);
		$this->load->view("admin/{$this->navpage}");		
		$this->load->view('admin/extension/alliance',$reg);	
		$this->load->view('admin/foot');
	}
	public function alliance_s()
	{
	
		$this->load->model('T_service_spreader_model');
		$nep=$_GET['nep'];
		$id=$_GET['sid'];		
		$reg=$this->T_service_spreader_model->yesorno($nep,$id);
		if($reg==true)
		{
			echo '<script>alert("修改成功");window.location.href="alliance"</script>';
		}else
		{
			echo '<script>alert("修改失败");window.location.href="alliance"</script>';
		}
	}
	public function uploads()
	{
		$data['title']='家178-管理中心-推广-推广联盟';
		$data['menu']="member";//顶端选中
		$this->navpage = 'member/nav';	
		

		$this->load->library('image_lib');
		
		
		$this->suoluetu();
		//$this->shuiyin();
		$this->load->view('admin/top',$data);
		$this->load->view("admin/{$this->navpage}");		
		$this->load->view('admin/extension/uploads');	
		$this->load->view('admin/foot');
	}
	public function suoluetu()
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = 'D:/webserver/application/controllers/uploads/r.jpg';
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 30;
		$config['height'] = 30;

		$this->image_lib->initialize($config);

		$this->image_lib->resize();
		
	}
	public function shuiyin()
	{
		$config['source_image'] = 'D:/webserver/application/controllers/uploads/xcv.jpg';
        $config['wm_text'] = 'rainbow';
        $config['wm_type'] = 'text';
        $config['wm_font_path'] = './system/fonts/texb.ttf';
        $config['wm_font_size'] = '20';
        $config['wm_font_color'] = '000000';
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'center';
        $config['wm_padding'] = '20';
        $this->image_lib->initialize($config); 
        $this->image_lib->watermark();
	}
	public function do_uploads()
	{
		
		$data['title']='家178-管理中心-推广-推广联盟';
		$data['menu']="member";//顶端选中
		$this->navpage = 'member/nav';	
		
		$config['upload_path'] = 'D:/webserver/application/controllers/uploads';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
	
		$this->load->library('upload');
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());


			echo "<script>alert('".$error['error']."');history.go(-1);</script>";
		} 
		else
		{
			$data = array('upload_data' => $this->upload->data());

			echo "<script>alert('成功');history.go(-1);</script>";
		}
		$this->load->view('admin/top',$data);
		$this->load->view("admin/{$this->navpage}");		
		$this->load->view('admin/extension/uploads');	
		$this->load->view('admin/foot');
	}



	public function fenye($nubs,$counts,$url)
	{
		$this->load->library('Pagination');
		$config['per_page'] = $nubs;
		$config['total_rows'] = $counts;
		$config['base_url'] = $url;
		$config['use_page_numbers'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['prev_link'] = '上一页';
		$config['next_link'] = '下一页';
		$config['first_link'] = '首页';
  		$config['last_link'] = '尾页';
  		$config['full_tag_open'] = '<p>';
  		$config['full_tag_close'] = '</p>';
  		$config['num_links'] = 3;
		$this->pagination->initialize($config); 
	
	}

}
	
	