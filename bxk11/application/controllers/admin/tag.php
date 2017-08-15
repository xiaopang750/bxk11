<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        dinghaochenAuthor: ��껳�
 *        Email: dotnet010@gmail.com

 */
class Tag extends Admin_Controller
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
		$this->load->helper('file');
		$this->limit = 10;
	}
	public function index(){
		$data['title']='家178-内容管理-标签列表';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/tag';
		$this->navpage = $this->navpage ;
		$tag_type = $this->input->get('tag_type');
		
		$tag_name = $this->input->get('tag_name');
		if($tag_type != ''){
			$where = array('tag_type'=>$tag_type);
		}else{
			$where = '';
		}
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		
		$total_rows = $this->t_tag_model->count_search_where('tag_name',$tag_name,$where);
		
		$offset =  ($page-1)*($this->limit);
		$result['tag_type'] = $tag_type;
		$result['tag_name'] = $tag_name;
		$result['re'] = $this->t_tag_model->search_where('tag_name', $tag_name, $this->limit, $offset, 'tag_id', 'DESC' ,$where);
		$this->libs->base_url = site_url('admin/tag/index').'?search=0&tag_type'.$tag_type.'&=tag_name='.$tag_name;
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
		$this->page = 'content/tag_add';
		$this->navpage = $this->navpage ;
		$result = array();
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function tag_add_type(){
		$data['title']='家178-内容管理-标签';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/tag_add_type';
		$this->navpage = $this->navpage ;

		$result['pid'] = strip_tags(trim($this->input->get('p_id')));
	
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	
	public function add_edit(){
		$data['title']='家178-内容管理-标签';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/tag_add_edit';
		$this->navpage = $this->navpage ;
		$tag_id = strip_tags($this->input->get('tag_id'));
		//echo $tag_id;exit;
		if($tag_id){
			$this->config->load('uploads');
			$config = $this->config->item('theme');
			$this->load->library('upload');
			$result['url']= $config['upload_path'];
			$result['re'] = $this->tag_model->get($tag_id);
		}
		$result['pid'] = strip_tags(trim($this->input->get('p_id')));
	
		$this->pagedata = $result;
		parent::_initpage();
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
		
		
		$this->config->load('uploads');
		$config = $this->config->item('theme');
		$this->load->library('upload');
		//上传图片文件
		$datav = $this->upload->img_upload_file($config);
		if($datav==false){
			if($tag_type == 2){
				$this->tag_model->tag_img = $this->input->post('tag_imgv');
			}else{
				if($ids!=''){
					$this->del_tag_img($ids);
				}
				$this->tag_model->tag_img = '';
			}
		}else{
			
			$sourceimg = $config['upload_path'].$datav['upload_data']['file_name'];
			$imginfo = getimagesize($sourceimg);
			if($imginfo[0]!=$config['min_width']||$imginfo[1]!=$config['min_height']){
				unlink($sourceimg);
				echo "<script>alert('上传失败,上传图片必需应为1000*333')</script>";exit;
			}


			if($ids!=''){
				$this->del_tag_img($ids);
			}
			$this->load->library('image_lib');
			//$thumb = $this->image_lib->theme_thumb($sourceimg);
			$thumb = true;
			if($thumb==true){
				$this->tag_model->tag_img = $datav['upload_data']['file_name'];
			}else{
				$this->tag_model->tag_img = $this->input->post('tag_imgv');
			}
			
		}
		/* //上传图片文件
		$this->config->load('uploads');
		$config = $this->config->item('theme');
		$this->load->library('upload');
		$this->upload->initialize($config);
		
		if($this->upload->do_upload('files')){
			$data = $this->upload->data();	
			$this->tag_model->tag_img = $data['file_name'];
		}else{
			$this->tag_model->tag_img = $this->input->post('tag_imgv');
		} */
		
		$this->tag_model->tag_name = $tag_name;
		$this->tag_model->tag_type = $tag_type;
		$this->tag_model->tag_motif = $tag_motif;
		$this->tag_model->tag_seokey =$tag_seokey;
		$this->tag_model->tag_seodesc= $tag_seodesc;
		$this->tag_model->tag_users= 0;
		$this->tag_model->tag_count= 0;
		$this->load->model('t_system_model');
		$system = $this->t_system_model->get('tag_recommend');

		if($ids){
			$tagresult = $this->tag_model->get_tag('tag_type',array('tag_id'=>$ids));
			$data['tag_name'] =  $tag_name;
			$data['tag_type'] =  $tag_type;
			$data['tag_motif'] =  $tag_motif;
			$data['tag_seokey'] =  $tag_seokey;
			$data['tag_seodesc'] =  $tag_seodesc;
			$data['tag_img'] =  $this->tag_model->tag_img;
			$where = array('tag_id'=>$ids);
			if($this->tag_model->updates_global($data,$where)){
				//添加推荐主题
				 if(($tagresult['0']['tag_type']=='2') && ($tag_type!='2')){
				 	$sys_result = del_same($ids,$system->sys_value);
				 }else if(($tagresult['0']['tag_type']!='2') && ($tag_type=='2')){
				 	if($system->sys_value == '' || !$system->sys_value){
						$sys_result = $ids;
					}else{
						$sys_result = $system->sys_value.','.$ids;
					}
				 	
				 }else{
				 	$sys_result = $system->sys_value;
				 }
				$d['sys_value'] = $sys_result;
			    $w['sys_key'] = $system->sys_key;
				$this->t_system_model->updates_global($d,$w);
         
				echo "<script>alert('修改成功！');window.location.href='".site_url('admin/tag/index')."'</script>";exit;
				
				 
				
			}else{
				echo "<script>alert('修改失败！');window.location.href='".site_url('admin/tag/add')."?tag_id='".$ids."'</script>";exit;
			}
			
		}else{
			if($tag_id = $this->tag_model->insert()){
				//添加推荐主题
				if($tag_type == 2){
					
					$this->t_system_model->sys_key = 'tag_recommend';
					$this->t_system_model->sys_key_cn = '';
					$this->t_system_model->sys_value = $tag_id;
					$this->t_system_model->sys_group = 0;
					if($system){
						if($system->sys_value == '' || !$system->sys_value){
							$dd['sys_value'] = $tag_id;
						}else{
							$dd['sys_value'] = $system->sys_value.','.$tag_id;
						}
						$wh['sys_key'] = $system->sys_key;
						$this->t_system_model->updates_global($dd,$wh);
					}else{
						$this->t_system_model->insert();
					}
				}
		
				$t_s_class_tag = model('t_s_class_tag');
				$t_s_class_tag->s_tag_id = $tag_id;
				if(trim($this->input->post('t_class_id')) !=''){
					$t_s_class_tag->s_class_id = $this->input->post('t_class_id');
					$t_s_class_tag->insert();
				}
				echo "<script>alert('添加成功！');window.location.href='".site_url('admin/tag/index')."'</script>";exit;
			}else{
				echo "<script>alert('添加失败！');window.location.href='".site_url('admin/tag/add')."'</script>";exit;
			}
		}
		
		
	}
	
	
	public function dostatus(){
		$status = $this->input->post('status',true);
		$question_id = $this->input->post('question_id',true);
		$data = array('question_status'=>$status);
		$where = array('question_id'=>$question_id);
		if($this->question_model->updates_global($data,$where)){
			echo "1";
		}else{
			echo "0";
		}
	}
	
	public function dotagonly(){
		$tag_name = $this->input->post('tag_name',true);
		$tag_type = $this->input->post('tag_type',true);
		$where = array('tag_name'=>$tag_name,'tag_type'=>$tag_type);
		$field = 'tag_id';
		if($this->tag_model->get_tag($field,$where)){
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
			$resul = $this->tag_model->get($val);
			if($resul->tag_type=='2'){
				$this->load->model('t_system_model');
				$system = $this->t_system_model->get('tag_recommend');
				$sys_result = del_same($val,$system->sys_value);
				$d['sys_value'] = $sys_result;
				$w['sys_key'] = 'tag_recommend';
				$this->t_system_model->updates_global($d,$w);
			}
			//$this->del_tag_img($val);
			//@unlink($config['upload_path'].$resul->tag_img);
			$data = array('tag_type'=>99);
			$where = array('tag_id'=>$val);
			if($this->tag_model->updates_global($data,$where)){
				$temarr[] = $val;
			}
		}
		if($temarr){
			echo json_encode($temarr);
		}else{
			echo "0";
		}
	}
	
	public function add_system(){
		$data['title']='家178-内容管理-关联标签';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/s_class_addtag';
		$this->navpage = $this->navpage ;
		$s_class_id = $this->input->get('s_class_id');
		
		$field = 's_tag_id';
		$where = array('s_class_id'=>$s_class_id);
		
		$s_class_result = model('t_s_class_tag')->get_tag($field,$where);
		$s_class_id_arr = twotoone_array($s_class_result,'s_tag_id');//己有的标签
/* 		$tag_result = 	twotoone_array($this->tag_model->get_all(),'tag_id');
		
		foreach($tag_result as $vaid){
			if(!in_array($vaid,$s_class_id_arr)){
				$tag_arr[] =  $vaid;
			}
		}
		$result['s_class_id'] =$s_class_id; */
		$where = implode(',',$s_class_id_arr);
		$field = 'tag_name,tag_id';
		$order_field = 'tag_id';
		$order_type = 'DESC';
		
		$page = $this->input->get('current_page');
	
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$office =  ($page-1)*($this->limit);
		$total_rows =count($this->tag_model->count_search_notag($field,$where));

		$like_name = '';
		$result['re'] = $this->tag_model->search_notag($field,$where,'',$this->limit,$office,$order_field,$order_type);
		$this->libs->base_url = site_url('admin/tag/add_system').'?s_class_id='.$s_class_id.'&search=0';
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$result['s_class_id'] = $s_class_id;
		$result['num'] = $total_rows;
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function add_system_tag(){
			
		$ids = $this->input->post('ids');
		$t_s_id = $this->input->post('t_s_id');
		$idarr = explode(',',$ids);
		$temarr = array();
		foreach($idarr as $val){
			$t_s_class_tag = model('t_s_class_tag');
			$t_s_class_tag->s_tag_id = $val;
			$t_s_class_tag->s_class_id = $t_s_id;
			
			if($t_s_class_tag->insert()){
				$temarr[] = $val;
			}
		}
		if($temarr){
			echo json_encode($temarr);
		}else{
			echo "0";
		}
	}
	
	public function del_tag_img($ids){
		
		$this->config->load('uploads');
		$config = $this->config->item('theme');
		$this->load->library('upload');
		
		$wherew = array('tag_id'=>$ids);
		$fieldw = 'tag_img';
		$resv = $this->tag_model->get_tag($fieldw,$wherew);
		
		$sourceimgs = $config['upload_path'].$resv[0]['tag_img'];
		$thumb_1 = $config['thumb_1'].$resv[0]['tag_img'];
		$thumb_2 = $config['thumb_2'].$resv[0]['tag_img'];
		$thumb_3 = $config['thumb_3'].$resv[0]['tag_img'];
		@unlink($sourceimgs);
		@unlink($thumb_1);
		@unlink($thumb_2);
		@unlink($thumb_3);
	}
	
	public function importtt(){
		
		$data['title']='家178-内容管理-导入分类和标签';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/importtt';
		$this->navpage = $this->navpage ;
		$result = array();
		$this->pagedata = $result;
		parent::_initpage();
		
	}
	
	public function doimport(){
	 	//上传图片文件
		$this->config->load('uploads');
		$config = $this->config->item('importtt');
		$this->load->library('upload');
		$this->upload->initialize($config);

		if($this->upload->do_upload()){
			$data = $this->upload->data();
			$tmp_src = $data['full_path'];
			$content = read_file($tmp_src);

			if($content){
				//echo "<pre>";
				$error = '';
				$importarr = json_decode($content,true);
				//var_dump($importarr);die;
				foreach ($importarr as $k=>$value){
		
					foreach($value as $key=>$val){
						$importdata = array(
								's_class_name'=>$key,
								's_class_pid'=>'0',
								's_class_depth'=>'1',
								's_class_numbers'=> count($val),
								's_class_type'=>$k,
								's_class_sort'=>0,
								's_class_seodesc'=>$key,
								's_class_p_name'=>'',
								's_class_view'=>1
								);
						if($prendp_id = $this->importinsert($importdata)){
								if(empty($val)){
									continue;
								}
								foreach ($val as $pkey=>$pval){
									//echo $pkey;die;
									$importdata = array(
											's_class_name'=>$pkey,
											's_class_pid'=>$prendp_id,
											's_class_depth'=>'2',
											's_class_numbers'=> count($pval),
											's_class_type'=>$k,
											's_class_sort'=>0,
											's_class_seodesc'=>$pkey,
											's_class_p_name'=>$key,
											's_class_view'=>1
									);
									if($p_id = $this->importinsert($importdata)){
										if(empty($pval)){
											continue;
										}
										foreach($pval as $val){
											// 抽入标签和关联表
											$arr = array('tag_name'=>$val,'s_class_id'=>$p_id);
											if(!$this->tag_type($arr)){
												$error .= ','.$val;
												continue;
											}
										}
										
											
									}else{
										//第二层失败
										$error .= ','.$pkey;
										continue;
									}
								}						
								//echo $prendp_id;die;
						}else{
							//第一层失败
							$error .= ','.$key;
							continue;
						}
						
					}
				}
				@unlink($tmp_src);
				if($error != ''){
					echo "<script>alert('{$error}数据导入失败，请检查后在上传！');window.location.href='".site_url('admin/tag/importtt')."'</script>";exit;
				}else{
					echo "<script>alert('数据导入成功！');window.location.href='".site_url('admin/type/index')."'</script>";exit;
				}
			}else{
				@unlink($tmp_src);
				echo "<script>alert('数据读取失败，请检查后在上传！');window.location.href='".site_url('admin/tag/importtt')."'</script>";exit;
			}
			
		}else{
			$error = $this->upload->display_errors();
			@unlink($tmp_src);
			echo "<script>alert('上传失败，请检查后在上传！{$error}');window.location.href='".site_url('admin/tag/importtt')."'</script>";exit;
		} 
	}
	public function importinsert($importdata){
		$field = 's_class_id';
		$where = array(
				's_class_name'=>$importdata['s_class_name'],
				's_class_pid'=>$importdata['s_class_pid'],
				's_class_type'=>$importdata['s_class_type']
		);
		if(!$result = $this->t_system_class->get_tag($field,$where)){
			$this->t_system_class->s_class_pid = $importdata['s_class_pid'];
			$this->t_system_class->s_class_depth = $importdata['s_class_depth'];
			$this->t_system_class->s_class_name = $importdata['s_class_name'];
			$this->t_system_class->s_class_numbers = $importdata['s_class_numbers'];
			$this->t_system_class->s_class_type = $importdata['s_class_type'];
			$this->t_system_class->s_class_seodesc = $importdata['s_class_seodesc'];
			$this->t_system_class->s_class_sort = $importdata['s_class_sort'];
			$this->t_system_class->s_class_p_name = $importdata['s_class_p_name'];
			$this->t_system_class->s_class_view = $importdata['s_class_view'];
			if($prendp_id = $this->t_system_class->insert()){
				return $prendp_id;
			}else{
				return false;
			}
		}else{
			return $result[0]['s_class_id'];
		}
	}
	// 抽入标签和关联表
	public function tag_type($arr){

		$field = 'tag_id';
		$where = array('tag_name'=>$arr['tag_name']);
		if(!$tag_re = $this->tag_model->get_tag($field,$where)){
			$this->tag_model->tag_name= $arr['tag_name'];
			$this->tag_model->tag_type= '2';
			$this->tag_model->tag_users= '0';
			$this->tag_model->tag_motif= '1';
			$this->tag_model->tag_seokey= $arr['tag_name'];
			$this->tag_model->tag_seodesc= $arr['tag_name'];
			$this->tag_model->tag_count= '0';
			if(!$tag_id = $this->tag_model->insert()){
				return false;
			}
		}else{
			$tag_id =$tag_re[0]['tag_id'];
		}
		$field = 's_c_tag_id';
		$where = array('s_tag_id'=>$tag_id,'s_class_id'=>$arr['s_class_id']);
			
		$this->load->model('t_s_class_tag_model');
		if(!$type_re = $this->t_s_class_tag_model->get_tag($field,$where)){
			$this->t_s_class_tag_model->s_tag_id= $tag_id;
			$this->t_s_class_tag_model->s_class_id= $arr['s_class_id'];
			$this->t_s_class_tag_model->s_class_sort= 0;
			$this->t_s_class_tag_model->s_class_status =1;
			if(!$tag_id = $this->t_s_class_tag_model->insert()){
				return false;
			}
		}
		return true;
	}
}

?>