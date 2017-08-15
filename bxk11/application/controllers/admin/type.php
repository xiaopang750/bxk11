<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        dinghaochenAuthor: ��껳�
 *        Email: dotnet010@gmail.com

 */
class Type extends Admin_Controller
{	
	public $content;
	public $navpage;
	public $libs;
	public $t_system_class;
	public $limit;
	public $tag_model;
	public function __construct(){
		parent::__construct();
		$this->content = 'content';
		$this->navpage = 'content/nav';
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->load->model('t_system_class_model');
		$this->load->model('t_tag_model');
		$this->tag_model = $this->t_tag_model;
		$this->t_system_class = $this->t_system_class_model;
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');
		$this->limit =20;
	}
	public function index()
	{
		
		$data['title']='家178-内容管理-系统分类列表';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/type';
		$this->navpage = $this->navpage ;
		
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;

		
		$total_rows = $this->t_system_class->count_all();
		
		$office =  ($page-1)*($this->limit);

		$result['re'] = $this->t_system_class->get_list(40,$office,'s_class_sort','ASC');
		
		$this->libs->base_url = site_url('admin/type/index').'?search=0';
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$this->pagedata = $result;


		parent::_initpage();
	}
	
	public function add(){
		$data['title']='家178-内容管理-标签';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/type_add';
		$this->navpage = $this->navpage ;
		$order_field = 's_class_select';
		$order_type = 'DESC';
		$result['list'] = $this->t_system_class->get_all($order_field,$order_type);

		$this->pagedata = $result;
		parent::_initpage();
	}
	
	

	public function type_edit(){

		$data['title']='家178-内容管理-标签';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/type_edit';
		$this->navpage = $this->navpage ;
		$order_field = 's_class_select';
		$order_type = 'DESC';
		$result['list'] = $this->t_system_class->get_all($order_field,$order_type);
		$s_class_id = strip_tags($this->input->get('s_class_id'));
		if($s_class_id){
			$result['re'] = $this->t_system_class->get($s_class_id);
		}

		$this->pagedata = $result;

		parent::_initpage();
	}

	 public function dotype_add(){
	
	 	$ids = $this->input->post('ids',true);
		$this->t_system_class->s_class_pid = $this->input->post('s_class_id',true);
		$this->t_system_class->s_class_name = $this->input->post('s_class_name',true);
		$this->t_system_class->s_class_type = $this->input->post('s_class_type',true);
		$this->t_system_class->s_class_seodesc = $this->input->post('s_class_seodesc',true);
		$this->t_system_class->s_class_sort = $this->input->post('s_class_sort',true);
		$this->t_system_class->s_class_select = $this->input->post('s_class_select',true);
		$this->t_system_class->s_class_regex = $this->input->post('s_class_regex',true);
		$this->t_system_class->s_class_view = $this->input->post('s_class_view',true);
	
		$this->t_system_class->s_class_numbers = 0;
		
		if(!is_numeric($this->t_system_class->s_class_sort)){
			
			echo "<script>alert('该标签分类排序只能为数字！');window.location.href='".site_url('admin/type/add')."'</script>";exit;
		}


		$where = array('s_class_name'=>$this->t_system_class->s_class_name,'s_class_type'=>$this->t_system_class->s_class_type,'s_class_pid'=>$this->t_system_class->s_class_pid);
		$field = 's_class_pid';
		
		if($result = $this->t_system_class->get_tag($field,$where)){
			if(count($result)>2){
				echo "<script>alert('该类型和频道下以有这标签不能添加修改！');window.location.href='".site_url('admin/type/index')."'</script>";exit;
			}
		}
		if($this->t_system_class->s_class_pid != 0){
			$row_system_class = $this->t_system_class->get($this->t_system_class->s_class_pid);
			if(is_null ($row_system_class->s_class_depth)){
				$row_system_class->s_class_depth = 0;
			}
			$this->t_system_class->s_class_depth = ($row_system_class->s_class_depth)+1;
/* 			if($ids == ''){
				$this->t_system_class->system_class_status($this->t_system_class->s_class_pid,'s_class_numbers','+');
			} */
			
			$this->t_system_class->s_class_p_name = $row_system_class->s_class_name;
		}else{
			$this->t_system_class->s_class_depth = 1;
			$this->t_system_class->s_class_p_name = '';
		}
		
		//上传图片文件
		$this->config->load('uploads');
		$config = $this->config->item('theme');
		$this->load->library('upload');
		//上传图片文件
		$datav = $this->upload->img_upload_file($config);
		if($datav==false){
			$this->t_system_class->s_class_img = $this->input->post('s_class_imgv');
		}else{
			$sourceimg = $config['upload_path'].$datav['upload_data']['file_name'];
			$imginfo = getimagesize($sourceimg);
			if($imginfo[0]!=$config['min_width']||$imginfo[1]!=$config['min_height']){
				unlink($sourceimg);
				echo "<script>alert('上传失败,上传图片必需为851*312');window.location.href='".site_url('admin/type/index')."'</script>";exit;
			}
			
			
			if($ids!=''){
				$this->del_s_class_img($ids);
			}
			$this->load->library('image_lib');
			//$thumb = $this->image_lib->theme_thumb($sourceimg);
			$thumb = true;
			if($thumb==true){
				$this->t_system_class->s_class_img = $datav['upload_data']['file_name'];
			}else{
				$this->t_system_class->s_class_img = $this->input->post('s_class_imgv');
			}
		}
		
		if($ids){
			$data['s_class_pid'] = $this->t_system_class->s_class_pid;
			$data['s_class_name'] =	$this->t_system_class->s_class_name;
			$data['s_class_type'] = 	$this->t_system_class->s_class_type;
			$data['s_class_seodesc'] = $this->t_system_class->s_class_seodesc;
			$data['s_class_sort'] = $this->t_system_class->s_class_sort;
			$data['s_class_select'] = $this->t_system_class->s_class_select;
			$data['s_class_regex'] = $this->t_system_class->s_class_regex;
			$data['s_class_view'] = $this->t_system_class->s_class_view;
			$data['s_class_depth'] = $this->t_system_class->s_class_depth;
			$data['s_class_p_name'] = $this->t_system_class->s_class_p_name;
			
			$data['s_class_img'] =  $this->t_system_class->s_class_img;
			$where = array('s_class_id'=>$ids);
			/* $old = $this->t_system_class->get_tag('s_class_pid',array('s_class_id' =>$ids));
			if(!is_null($old[0]['s_class_pid']) && $old[0]['s_class_pid'] != 0){
				$nums  = $this->t_system_class->get_tag('s_class_numbers',array('s_class_id' =>$old[0]['s_class_pid']));
				if($nums != 0 && !is_null($num)){
					$this->t_system_class->system_class_status($old[0]['s_class_pid'],'s_class_numbers','-');
				}
			
			} */
			
			if($this->t_system_class->updates_global($data,$where)){
				
				
				if($ids != $data['s_class_pid']){
					//改了则新添加的加一 旧的减一
					$new = $this->t_system_class->get_tag('s_class_numbers',array('s_class_pid' =>$data['s_class_pid']));
					
		
					$this->t_system_class->updates_global(array('s_class_numbers'=>count($new)),array('s_class_id'=>$data['s_class_pid']));
					
						
				}
				
				
				echo "<script>alert('修改成功！');window.location.href='".site_url('admin/type/index')."'</script>";exit;
			}else{
				echo "<script>alert('修改失败！');window.location.href='".site_url('admin/type/add')."?s_class_id='".$ids."'</script>";exit;
			}
		}else{
			if($this->t_system_class->insert()){
				echo "<script>alert('该标签添加成功！');window.location.href='".site_url('admin/type/index')."'</script>";exit;
			}else{
				echo "<script>alert('该标签添加失败！');window.location.href='".site_url('admin/type/add')."?s_class_id=".$ids."'</script>";exit;
			}
		}
		
	
	}
	
	
	public function dotag_add(){
		
		$tag_name = $this->input->post('tag_name',true);
		$tag_name = $this->input->post('tag_name',true);
		$tag_type = $this->input->post('tag_type',true);
		$tag_motif = $this->input->post('tag_motif',true);
		$tag_seokey = $this->input->post('tag_seokey',true);
		$tag_seodesc = $this->input->post('tag_seodesc',true);
		$ids = $this->input->post('ids',true);
		$where = array('tag_name'=>$tag_name,'tag_type'=>$tag_type);
		$field = 'tag_id';
		if(empty($tag_name)){
			echo "<script>alert('该类型下的标签不能为空！');window.location.href='".site_url('admin/tag/add')."'</script>";exit;
		}
		
		if($ids == ''){
			if($res = $this->tag_model->get_tag($field,$where)){
				echo "<script>alert('该类型下的标签己有不能在添加！');window.location.href='".site_url('admin/tag/add')."'</script>";exit;
			}
		}
		//上传图片文件
		$this->config->load('uploads');
		$config = $this->config->item('tag');
		$this->load->library('upload');
		$this->upload->initialize($config);
		
		if($this->upload->do_upload('files')){
			$data = $this->upload->data();	
			$this->tag_model->tag_img = $data['file_name'];
		}else{
			$this->tag_model->tag_img = $this->input->post('tag_imgv');
		}
		
		$this->tag_model->tag_name = $tag_name;
		$this->tag_model->tag_type = $tag_type;
		$this->tag_model->tag_motif = $tag_motif;
		$this->tag_model->tag_seokey =$tag_seokey;
		$this->tag_model->tag_seodesc= tag_seodesc;
		$this->tag_model->tag_users= 0;
		$this->tag_model->tag_count= 0;
		if($ids){
			$data['tag_name'] =  $tag_name;
			$data['tag_type'] =  $tag_type;
			$data['tag_motif'] =  $tag_motif;
			$data['tag_seokey'] =  $tag_seokey;
			$data['tag_seodesc'] =  tag_seodesc;
			$data['tag_img'] =  $this->tag_model->tag_img;
			$where = array('tag_id'=>$ids);
			if($this->tag_model->updates_global($data,$where)){
				echo "<script>alert('修改成功！');window.location.href='".site_url('admin/tag/index')."'</script>";exit;
			}else{
				echo "<script>alert('修改失败！');window.location.href='".site_url('admin/tag/add')."?tag_id='".$ids."'</script>";exit;
			}
			
		}else{
			if($this->tag_model->insert()){
				echo "<script>alert('添加成功！');window.location.href='".site_url('admin/tag/index')."'</script>";exit;
			}else{
				echo "<script>alert('添加失败！');window.location.href='".site_url('admin/tag/add')."'</script>";exit;
			}
		}
		
		
	}
	
	public function dotagonly(){
		$s_class_name = $this->input->post('s_class_name',true);
		$s_class_type= $this->input->post('s_class_type',true);
		$s_class_pid= $this->input->post('s_class_pid',true);
		$where = array('s_class_name'=>$s_class_name,'s_class_type'=>$s_class_type,'s_class_pid'=>$s_class_pid);
		$field = 's_class_pid';
	
		if($this->t_system_class->get_tag($field,$where)){
			echo 0;
		}else{
			echo 1;
		}
	}
	
	public function dodel(){
		
		$ids = $this->input->post('ids');

		$idarr = explode(',',$ids);
		$temarr = array();
		$this->config->load('uploads');
		$config = $this->config->item('tag');
		foreach($idarr as $val){
			//$resul = $this->t_system_class->get($val);
			//@unlink($config['upload_path'].$resul->tag_img);
			$data = array('s_class_type'=>99);
			$where = array('s_class_id'=>$val);
			if($this->t_system_class->updates_global($data,$where)){
				$temarr[] = $val;
			}
		}
		
		if($temarr){
			echo json_encode($temarr);
		}else{
			echo "0";
		}
	}
	
	public function del_s_class_img($ids){
		
		$this->config->load('uploads');
		$config = $this->config->item('theme');
		$this->load->library('upload');
		
		$wherew = array('s_class_id'=>$ids);
		$fieldw = 's_class_img';
		$resv = $this->t_system_class->get_tag($fieldw,$wherew);
		
		$sourceimgs = $config['upload_path'].$resv[0]['s_class_img'];
		$thumb_1 = $config['thumb_1'].$resv[0]['s_class_img'];
		$thumb_2 = $config['thumb_2'].$resv[0]['s_class_img'];
		$thumb_3 = $config['thumb_3'].$resv[0]['s_class_img'];
		@unlink($sourceimgs);
		@unlink($thumb_1);
		@unlink($thumb_2);
		@unlink($thumb_3);
	}
}
