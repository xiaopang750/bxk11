<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        dinghaochenAuthor: ��껳�
 *        Email: dotnet010@gmail.com

 */
class Three_config extends Admin_Controller
{	
	public $content;
	public $navpage;
	public $libs;
	public $t_three_d_config;
	public $t_three_thumb;
	public $t_three_control;
	public $t_three_map;
	public $t_three_info;
	public $t_three_face;
	public $xmldata;
	public $t_three_hotspot;
	public function __construct(){
		parent::__construct();
		$this->content = 'index';
		$this->navpage = 'nav';
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->load->model('t_three_d_config_model');
		$this->t_three_d_config = $this->t_three_d_config_model;
		$this->load->model('t_three_thumb_model');
		$this->t_three_thumb = $this->t_three_thumb_model;
	
		$this->load->model('t_three_control_model');
		$this->t_three_control = $this->t_three_control_model;
		$this->load->model('t_three_info_model');
		$this->t_three_info = $this->t_three_info_model;
		$this->load->model('t_three_face_model');
		$this->t_three_face = $this->t_three_face_model;
		$this->load->model('t_three_map_model');
		$this->t_three_map = $this->t_three_map_model;
		$this->load->model('t_three_hotspot_model');
		$this->t_three_hotspot = $this->t_three_hotspot_model;
		loadLib("XmlData_Class");
		$xmldata_bak = new XmlData_Class();
		$this->xmldata = $xmldata_bak;
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');
		$this->limit = 10;
	}

	//3d配制
	public function index(){
	
		$data['title']='家178-管理中心-3d配制';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'three_config/index';
		$this->navpage = $this->navpage;
		$result = array();
		if($gre = $this->t_three_d_config->get_tag('*',"t_g_id !=''")){
			$result['global'] = $gre[0];
		}else{
			$result['global']['t_g_id'] = '';
			$result['global']['type'] = '';
			$result['global']['autoRotateStart'] = 0;
			$result['global']['autoRotateOnIdle'] = 0;
			$result['global']['autoRotateDelay'] = 5;
			$result['global']['rate'] = '0.6';
			$result['global']['dragRate'] = '1';
			$result['global']['hotspotInfo'] = '0';
			$result['global']['bgSound'] = '';
			$result['global']['width'] = '100%';
			$result['global']['height'] = '100%';
			$result['global']['x'] = '30%';
			$result['global']['y'] = '30%';
			$result['global']['ismap'] = 0;
			$result['global']['isthumb'] = 0;
			$result['global']['iscontrol'] = 0;
			$result['global']['islogo'] = 0;
			$result['global']['isinfo'] = 0;
			$result['global']['isbgsound'] = 0;
			$result['global']['ishotspot'] = 0;
			$result['global']['bgvolume'] = 1;
			$result['global']['debug'] = 0;
			$result['global']['fullScreen'] = 'FULLSCREEN';
			$result['global']['exitFullScreen'] = 'EXITFULLSCREEN';
			$result['global']['showMap'] = 'SHOWMAP';
			$result['global']['hideMap'] = 'HIDEMAP';
			$result['global']['showThumb'] = 'SHOWTHUMB';
			$result['global']['hideThumb'] = 'HIDETHUMB';
			$result['global']['helpInfo'] = 'HELPINFO';
		}

		
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function doadd(){
		$this->t_three_d_config->type = $this->input->post('type');
		$this->t_three_d_config->autoRotateStart = $this->input->post('autoRotateStart');
		$this->t_three_d_config->autoRotateOnIdle = $this->input->post('autoRotateOnIdle');
		$this->t_three_d_config->autoRotateDelay = $this->input->post('autoRotateDelay');
		$this->t_three_d_config->rate = $this->input->post('rate');
		$this->t_three_d_config->dragRate = $this->input->post('dragRate');
		$this->t_three_d_config->hotspotInfo = $this->input->post('hotspotInfo');
		$this->t_three_d_config->transition = $this->input->post('transition');
	
		$this->t_three_d_config->width = $this->input->post('width');
		$this->t_three_d_config->height = $this->input->post('height');
		$this->t_three_d_config->x = $this->input->post('x');
		$this->t_three_d_config->y = $this->input->post('y');
		$this->t_three_d_config->iscontrol = $this->input->post('iscontrol');
		$this->t_three_d_config->isthumb = $this->input->post('isthumb');
		$this->t_three_d_config->ismap = $this->input->post('ismap');
		$this->t_three_d_config->isinfo = $this->input->post('isinfo');
		$this->t_three_d_config->islogo = $this->input->post('islogo');
		$this->t_three_d_config->debug = $this->input->post('debug');
		
		$this->t_three_d_config->fullScreen = $this->input->post('fullScreen');
		$this->t_three_d_config->exitFullScreen = $this->input->post('exitFullScreen');
		$this->t_three_d_config->showMap = $this->input->post('showMap');
		$this->t_three_d_config->hideMap = $this->input->post('hideMap');
		$this->t_three_d_config->showThumb = $this->input->post('showThumb');
		$this->t_three_d_config->hideThumb = $this->input->post('hideThumb');
		$this->t_three_d_config->helpInfo = $this->input->post('helpInfo');
		$this->t_three_d_config->isbgsound = $this->input->post('isbgsound');
		$this->t_three_d_config->ishotspot = $this->input->post('ishotspot');
		$this->t_three_d_config->bgvolume = $this->input->post('bgvolume');;
		$this->config->load('threed');
		$config = $this->config->item('bgsound');
		$this->load->library('upload');
	
		$this->upload->initialize($config);
	
		if(mkdirs($config['upload_path'])){
			if($this->upload->do_upload('bgSound')){
				$data = $this->upload->data();
				$this->t_three_d_config->bgSound = $data['file_name'];
			}else{
				$this->t_three_d_config->bgSound = $this->input->post('bgsoundcopy');
			}
		}else{
			$this->t_three_d_config->bgSound = $this->input->post('bgsoundcopy');
		}
	
		if($this->t_three_d_config->t_g_id = $this->input->post('t_g_id')){
			if($this->t_three_d_config->update()){
				echo "<script>alert('配制成功！');window.location.href ='".site_url('admin/three_config/index')."'</script>";
			}else{
				echo "<script>alert('配制失败！');window.location.href ='".site_url('admin/three_config/index')."'</script>";
			}
		}else{
			if($this->t_three_d_config->insert()){
				echo "<script>alert('添加成功！');window.location.href ='".site_url('admin/three_config/index')."'</script>";
			}else{
				echo "<script>alert('添加失败！！');window.location.href ='".site_url('admin/three_config/index')."'</script>";
			}
		}
	
	
	}
	
	//索引图
	public function three_thumb(){
		$data['title']='家178-管理中心-3d索引图导航';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'three_config/three_thumb';
		$this->navpage = $this->navpage;
		
		$result = array();
		if($gre = $this->t_three_thumb->get_tag('*',"t_t_id !=''")){
			$result['thumb'] = $gre[0];
		}else{
			$result['thumb']['t_t_id'] ='';
			$result['thumb']['width'] = '';
			$result['thumb']['height'] = '';
			$result['thumb']['x'] = '';
			$result['thumb']['y'] = '';
			$result['thumb']['imageWidth'] = '120';
			$result['thumb']['imageHeight'] = '80';
			$result['thumb']['bgColor'] = 'FFFFFF';
			$result['thumb']['bgAlpha'] = '0';
			$result['thumb']['left'] = '';
			$result['thumb']['right'] = 0;
			$result['thumb']['border'] = 0;
			$result['thumb']['initialShow'] = '0';
		}
		$this->config->load('threed');
		$config = $this->config->item('thumb');
		$result['thumb']['path'] = $config['relative_path'];
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function dothumb_add(){
		$this->t_three_thumb->width = $this->input->post('width');
		$this->t_three_thumb->height = $this->input->post('height');
		$this->t_three_thumb->x = $this->input->post('x');
		$this->t_three_thumb->y = $this->input->post('y');
		$this->t_three_thumb->initialShow = $this->input->post('initialShow');
		$this->t_three_thumb->imageWidth = $this->input->post('imageWidth');
		$this->t_three_thumb->imageHeight = $this->input->post('imageHeight');
		$this->t_three_thumb->bgColor = $this->input->post('bgColor');
		$this->t_three_thumb->bgAlpha = $this->input->post('bgAlpha');
		
		$this->t_three_thumb->left = $this->input->post('left');
		$this->t_three_thumb->right = $this->input->post('right');
		$this->t_three_thumb->border = $this->input->post('border');
		
		$this->config->load('threed');
		$config = $this->config->item('thumb');
		$this->load->library('upload');

		if(mkdirs($config['upload_path'])){
			
			$config['file_name']  = 'thumbleft.png';
			$this->upload->initialize($config);
			if($this->upload->do_upload('left')){
				$data = $this->upload->data();
				$this->t_three_thumb->left = $data['file_name'];
			}else{
				$this->t_three_thumb->left = $this->input->post('leftcopy');
			}
			
			$config['file_name']  = 'thumbright.png';
			$this->upload->initialize($config);
			if($this->upload->do_upload('right')){
				$data = $this->upload->data();
				$this->t_three_thumb->right = $data['file_name'];
			}else{
				$this->t_three_thumb->right = $this->input->post('rightcopy');
			}
			
			$config['file_name']  = 'thumbborder.png';
			$this->upload->initialize($config);
			if($this->upload->do_upload('border')){
				$data = $this->upload->data();
				$this->t_three_thumb->border = $data['file_name'];
			}else{
				$this->t_three_thumb->border = $this->input->post('bordercopy');
			}
		}else{
			$this->t_three_thumb->left = $this->input->post('leftcopy');
			$this->t_three_thumb->right = $this->input->post('rightcopy');
			$this->t_three_thumb->border = $this->input->post('bordercopy');
		}
	
		if($this->input->post('t_t_id')){
			$this->t_three_thumb->t_t_id = $this->input->post('t_t_id');
			if($this->t_three_thumb->update()){
				echo "<script>alert('配制成功！');window.location.href ='".site_url('admin/three_config/three_thumb')."'</script>";
			}else{
				echo "<script>alert('配制失败！');window.location.href ='".site_url('admin/three_config/three_thumb')."'</script>";
			}
		}else{
			
			if($this->t_three_thumb->insert()){
				echo "<script>alert('添加成功！');window.location.href ='".site_url('admin/three_config/three_thumb')."'</script>";
			}else{
				echo "<script>alert('添加失败！！');window.location.href ='".site_url('admin/three_config/three_thumb')."'</script>";
			}
		}
	}
	
	//控制面板
	public function three_control(){
		$data['title']='家178-管理中心-3d控制面板';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'three_config/three_control';
		$this->navpage = $this->navpage;
		$result = array();
		if($gre = $this->t_three_control->get_tag('*',"t_c_id !=''")){
			$result['control'] = $gre[0];
		}else{
			$result['control']['t_c_id'] ='';
			$result['control']['type'] ='';
			$result['control']['width'] = '100%';
			$result['control']['height'] = '50';
			$result['control']['x'] = '50%';
			$result['control']['y'] = '-60';
			$result['control']['buttonWidth'] = '32';
			$result['control']['buttonHeight'] = '32';
			$result['control']['bgColor'] = 'FFFFFF';
			$result['control']['bgAlpha'] = '0';
			$result['control']['left'] = '0,64';
			$result['control']['right'] = '32,64';
			$result['control']['up'] = '0,96';
			$result['control']['down'] = '32,96';
			$result['control']['zoomin'] = '0,128';
			$result['control']['zoomout'] = '32,128';
			$result['control']['full'] = '0,192';
			$result['control']['eixtFull'] = '32,192';
			$result['control']['prev'] = '0,0';
			$result['control']['next'] = '32,0';
			$result['control']['thumb'] = '0,32';
			$result['control']['map'] = '32,32';
			$result['control']['show'] = '32,160';
			$result['control']['hide'] = '0,160';
			$result['control']['initialShow'] = '0';
		}
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function docontrol_add(){
		$this->t_three_control->type = $this->input->post('type');
		$this->t_three_control->width = $this->input->post('width');
		$this->t_three_control->height = $this->input->post('height');
		$this->t_three_control->x = $this->input->post('x');
		$this->t_three_control->y = $this->input->post('y');
		$this->t_three_control->initialShow = $this->input->post('initialShow');
		$this->t_three_control->buttonWidth = $this->input->post('buttonWidth');
		$this->t_three_control->buttonHeight = $this->input->post('buttonHeight');
		$this->t_three_control->bgColor = $this->input->post('bgColor');
		$this->t_three_control->bgAlpha = $this->input->post('bgAlpha');
	
		$this->t_three_control->left = $this->input->post('left');
		$this->t_three_control->right = $this->input->post('right');
		$this->t_three_control->up = $this->input->post('up');
		
	
		$this->t_three_control->down = $this->input->post('down');
		$this->t_three_control->zoomin = $this->input->post('zoomin');
		$this->t_three_control->zoomout = $this->input->post('zoomout');
		$this->t_three_control->full = $this->input->post('full');
		$this->t_three_control->eixtFull = $this->input->post('eixtFull');
		$this->t_three_control->prev = $this->input->post('prev');
		
		$this->t_three_control->next = $this->input->post('next');
		$this->t_three_control->thumb = $this->input->post('thumb');
		$this->t_three_control->map = $this->input->post('map');
		$this->t_three_control->show = $this->input->post('show');
		$this->t_three_control->hide = $this->input->post('hide');
		$this->t_three_control->type_recommend = $this->input->post('type_recommend');
		
	
		$this->config->load('threed');
		$config = $this->config->item('thumb');
		$this->load->library('upload');
	
		
	
		if($this->input->post('t_c_id')){
			$this->t_three_control->t_c_id = $this->input->post('t_c_id');
			if($this->t_three_control->update()){
				echo "<script>alert('配制成功！');window.location.href ='".site_url('admin/three_config/three_control')."'</script>";
			}else{
				echo "<script>alert('配制失败！');window.location.href ='".site_url('admin/three_config/three_control')."'</script>";
			}
		}else{
				
			if($this->t_three_control->insert()){
				echo "<script>alert('添加成功！');window.location.href ='".site_url('admin/three_config/three_control')."'</script>";
			}else{
				echo "<script>alert('添加失败！！');window.location.href ='".site_url('admin/three_config/three_control')."'</script>";
			}
		}
	}
	
	//地图面板
	public function three_map(){
		$data['title']='家178-管理中心-3d地图导航';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'three_config/three_map';
		$this->navpage = $this->navpage;
		$result = array();
		if($gre = $this->t_three_map->get_tag('*',"t_m_id !=''")){
			$result['map'] = $gre[0];
		}else{
			$result['map']['t_m_id'] ='';
			$result['map']['file'] ='';
			$result['map']['type'] ='';
			$result['map']['width'] = '30%';
			$result['map']['height'] = '100%';
			$result['map']['x'] = '70%';
			$result['map']['y'] = '0';
			$result['map']['align'] = '';
			$result['map']['radarColor'] = 'FFFFFF';
			$result['map']['radarSize'] = '75';
			$result['map']['scrollBar'] = '0';
			$result['map']['hotspot'] = '';
			$result['map']['activeState'] = '';
			$result['map']['overState'] = '';
			$result['map']['initialShow'] = '0';
		}
		$this->config->load('threed');
		$config = $this->config->item('map');
		$result['map']['path'] = $config['relative_path'];
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	
	public function domap_add(){
		$this->t_three_map->file = $this->input->post('file');
		$this->t_three_map->type = $this->input->post('type');

		$this->t_three_map->width = $this->input->post('width');
		$this->t_three_map->height = $this->input->post('height');
		$this->t_three_map->x = $this->input->post('x');
		$this->t_three_map->y = $this->input->post('y');
		$this->t_three_map->initialShow = $this->input->post('initialShow');
		$this->t_three_map->align = $this->input->post('align');
		$this->t_three_map->radarColor = $this->input->post('radarColor');
		$this->t_three_map->radarSize = $this->input->post('radarSize');
		$this->t_three_map->scrollBar = $this->input->post('scrollBar');
		
	
		$this->config->load('threed');
		$config = $this->config->item('map');
		$this->load->library('upload');
	
		if(mkdirs($config['upload_path'])){//setExt
			
			
			$config['file_name']  = 'hotspot';
	
			$this->upload->initialize($config);
			if($this->upload->do_upload('hotspot')){
				$data = $this->upload->data();
				$this->t_three_map->hotspot = $data['file_name'];
			}else{
				$this->t_three_map->hotspot = $this->input->post('hotspotcopy');
			}
				
	
			$config['file_name']  = 'over';
			$this->upload->initialize($config);
			if($this->upload->do_upload('overState')){
				$data = $this->upload->data();
				$this->t_three_map->overState = $data['file_name'];
			}else{
				$this->t_three_map->overState = $this->input->post('overStatecopy');
			}
				
		
			$config['file_name']  = 'active';
			$this->upload->initialize($config);
			if($this->upload->do_upload('activeState')){
				$data = $this->upload->data();
				$this->t_three_map->activeState = $data['file_name'];
			}else{
				$this->t_three_map->activeState = $this->input->post('activeStatecopy');
			}
		}else{
			$this->t_three_map->hotspot = $this->input->post('hotspotcopy');
			$this->t_three_map->overState = $this->input->post('overStatecopy');
			$this->t_three_map->activeState = $this->input->post('activeStatecopy');
		}
	
		if($this->input->post('t_m_id')){
			$this->t_three_map->t_m_id = $this->input->post('t_m_id');
			if($this->t_three_map->update()){
				//这个不用全局替换swf文件
				$map_copy_config = $this->config->item('map_copy');
				if($this->t_three_map->file == 'map'){
					
					copy($map_copy_config['upload_path'].$config['localmap_name'].'.swf', $config['swfplugins_path'].$config['localmap_name_bak'].'.swf');
				
				}else if($this->t_three_map->file == 'mapbak'){
					copy($map_copy_config['upload_path'].$config['localmap_name_bak'].'.swf', $config['swfplugins_path'].$config['localmap_name_bak'].'.swf');	
				}
				echo "<script>alert('配制成功！');window.location.href ='".site_url('admin/three_config/three_map')."'</script>";
			}else{
				echo "<script>alert('配制失败！');window.location.href ='".site_url('admin/three_config/three_map')."'</script>";
			}
		}else{
				
			if($this->t_three_map->insert()){
				//这个不用全局替换swf文件
				$map_copy_config = $this->config->item('map_copy');
				if($this->t_three_map->file == 'map'){
					copy($map_copy_config['upload_path'].$config['localmap_name'].'.swf', $config['swfplugins_path'].$map['localmap_name_bak'].'.swf');
					
				}else if($this->t_three_map->file == 'mapbak'){
					copy($map_copy_config['upload_path'].$config['localmap_name_bak'].'.swf', $config['swfplugins_path'].$map['localmap_name_bak'].'.swf');
				}
				echo "<script>alert('添加成功！');window.location.href ='".site_url('admin/three_config/three_map')."'</script>";
			}else{
				echo "<script>alert('添加失败！！');window.location.href ='".site_url('admin/three_config/three_map')."'</script>";
			}
		}
	}
	
	
	public function three_info(){
		$data['title']='家178-管理中心-3d信息面板';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'three_config/three_info';
		$this->navpage = $this->navpage;
		$result = array();
		if($gre = $this->t_three_info->get_tag('*',"t_info_id !=''")){
			$result['info'] = $gre[0];
		}else{
			$result['info']['t_info_id'] ='';
			$result['info']['width'] = '400';
			$result['info']['height'] = '200';
			$result['info']['x'] = '10';
			$result['info']['y'] = '10';
			$result['info']['fontSize'] = '16';
			$result['info']['fontColor'] = 'FFFFFF';
		}
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function doinfo_add(){
		$this->t_three_info->width = $this->input->post('width');
		$this->t_three_info->height = $this->input->post('height');
		$this->t_three_info->x = $this->input->post('x');
		$this->t_three_info->y = $this->input->post('y');
		$this->t_three_info->fontSize = $this->input->post('fontSize');
		$this->t_three_info->fontColor = $this->input->post('fontColor');
	
		
		if($this->input->post('t_info_id')){
			$this->t_three_info->t_info_id = $this->input->post('t_info_id');
			if($this->t_three_info->update()){
				echo "<script>alert('配制成功！');window.location.href ='".site_url('admin/three_config/three_info')."'</script>";
			}else{
				echo "<script>alert('配制失败！');window.location.href ='".site_url('admin/three_config/three_info')."'</script>";
			}
		}else{
				
			if($this->t_three_info->insert()){
				echo "<script>alert('添加成功！');window.location.href ='".site_url('admin/three_config/three_info')."'</script>";
			}else{
				echo "<script>alert('添加失败！！');window.location.href ='".site_url('admin/three_config/three_info')."'</script>";
			}
		}
	}
	
	
	//地图面板
	public function three_face(){
		$data['title']='家178-管理中心-3d地图导航';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'three_config/three_face';
		$this->navpage = $this->navpage;
		$result = array();
		if($gre = $this->t_three_face->get_tag('*',"t_face_id !=''")){
			$result['face'] = $gre[0];

		}else{
			$result['face']['t_face_id'] ='';
			$result['face']['file'] = '';
			$result['face']['x'] = 10;
			$result['face']['y'] = 10;
			$result['face']['height'] = 60;
			$result['face']['widht'] = 60;
			
		}
		$this->config->load('threed');
		$config = $this->config->item('face');
		$result['face']['path'] = $config['relative_path'];
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	
	public function doface_add(){
		$this->t_three_face->file = $this->input->post('file');
		$this->t_three_face->width = $this->input->post('width');
		$this->t_three_face->height = $this->input->post('height');
		$this->t_three_face->x = $this->input->post('x');
		$this->t_three_face->y = $this->input->post('y');
		$this->t_three_face->url = $this->input->post('url');
	
	
		$this->config->load('threed');
		$config = $this->config->item('face');
		$this->load->library('upload');
	
		if(mkdirs($config['upload_path'])){//setExt
				
			$this->upload->initialize($config);
			if($this->upload->do_upload('file')){
				$data = $this->upload->data();
				$this->t_three_face->file = $data['file_name'];
			}else{
				$this->t_three_face->file = $this->input->post('filecopy');
			}
	
		}else{
			$this->t_three_face->file = $this->input->post('file');

		}
	
		if($this->input->post('t_face_id')){
			$this->t_three_face->t_face_id = $this->input->post('t_face_id');
			if($this->t_three_face->update()){
				echo "<script>alert('配制成功！');window.location.href ='".site_url('admin/three_config/three_face')."'</script>";
			}else{
				echo "<script>alert('配制失败！');window.location.href ='".site_url('admin/three_config/three_face')."'</script>";
			}
		}else{
	
			if($this->t_three_face->insert()){
				echo "<script>alert('添加成功！');window.location.href ='".site_url('admin/three_config/three_face')."'</script>";
			}else{
				echo "<script>alert('添加失败！！');window.location.href ='".site_url('admin/three_config/three_face')."'</script>";
			}
		}
	}
	//热点
	public function three_hotspot(){
		$data['title']='家178-管理中心-3d热点设置';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'three_config/three_hotspot';
		$this->navpage = $this->navpage;
		$result = array();
		if($gre = $this->t_three_hotspot->get_tag('*',"h_id !=''")){
			$result['hotspot'] = $gre[0];
		
		}else{
			$result['hotspot']['h_id'] ='';
			$result['hotspot']['file'] ='';
			$result['hotspot']['type'] ='spot';
			$result['hotspot']['infoWidth'] = '300';
			$result['hotspot']['infoHeight'] = '300';
			$result['hotspot']['infoFont'] = 'FFFFFF';
			$result['hotspot']['infoColor1'] = '00AACC';
			$result['hotspot']['infoColor2'] = '00AACC';
			$result['hotspot']['infoAlpha'] = '.6';
			
			$result['hotspot']['action'] = '';
			$result['hotspot']['windowWidth'] = '360';
			$result['hotspot']['windowHeight'] = '180';
			$result['hotspot']['windowFont'] = '333333';
			$result['hotspot']['windowColor1'] = 'FFFFFF';
			$result['hotspot']['windowColor2'] = 'FFFFFF';
			$result['hotspot']['windowAlpha'] = '1';
				
		}
		$this->config->load('threed');
		$config = $this->config->item('hotspot');
		$result['hotspot']['path'] = $config['relative_path'];
	
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	//热点添加
	public function dohotspot_add(){
		$this->t_three_hotspot->file = $this->input->post('file');
		$this->t_three_hotspot->type = $this->input->post('type');
		$this->t_three_hotspot->infoWidth = $this->input->post('infoWidth');
		$this->t_three_hotspot->infoHeight = $this->input->post('infoHeight');
		$this->t_three_hotspot->infoFont = $this->input->post('infoFont');
		$this->t_three_hotspot->infoColor1 = $this->input->post('infoColor1');
		$this->t_three_hotspot->infoColor2 = $this->input->post('infoColor2');
		$this->t_three_hotspot->infoAlpha = $this->input->post('infoAlpha');
		
		$this->t_three_hotspot->action = $this->input->post('action');
		$this->t_three_hotspot->windowWidth = $this->input->post('windowWidth');
		$this->t_three_hotspot->windowHeight = $this->input->post('windowHeight');
		$this->t_three_hotspot->windowFont = $this->input->post('windowFont');
		$this->t_three_hotspot->windowColor1 = $this->input->post('windowColor1');
		$this->t_three_hotspot->windowColor2 = $this->input->post('windowColor2');
		$this->t_three_hotspot->windowAlpha = $this->input->post('windowAlpha');
	
	
		$this->config->load('threed');
		$config = $this->config->item('hotspot');
		$this->load->library('upload');
	
		if(mkdirs($config['upload_path'])){//setExt
	
			$this->upload->initialize($config);
			if($this->upload->do_upload('file')){
				$data = $this->upload->data();
				$this->t_three_hotspot->file = $data['file_name'];
			}else{
				$this->t_three_hotspot->file = $this->input->post('filecopy');
			}
	
		}else{
			$this->t_three_hotspot->file = $this->input->post('file');
	
		}
	
		if($this->input->post('h_id')){
			$this->t_three_hotspot->h_id = $this->input->post('h_id');
			if($this->t_three_hotspot->update()){
				echo "<script>alert('配制成功！');window.location.href ='".site_url('admin/three_config/three_hotspot')."'</script>";
			}else{
				echo "<script>alert('配制失败！');window.location.href ='".site_url('admin/three_config/three_hotspot')."'</script>";
			}
		}else{
	
			if($this->t_three_hotspot->insert()){
				echo "<script>alert('添加成功！');window.location.href ='".site_url('admin/three_config/three_hotspot')."'</script>";
			}else{
				echo "<script>alert('添加失败！！');window.location.href ='".site_url('admin/three_config/three_hotspot')."'</script>";
			}
		}
	}
	//生成xml
	public function createxml(){
		//生成全局xml模板
		$this->config->load('threed');
		$xmlsave = $this->config->item('xml');
		$global_threed = $this->t_three_d_config->get_all();
		$global_threedrow = $global_threed[0];
		$savePath = $xmlsave['upload_path'].$xmlsave['global_xml'].'.xml';
		$globaltrue = $this->xmldata->createGlobalNode($savePath);
		if($global_threedrow->ismap == '1'){
			$map = $this->config->item('map');
			$global_map = $this->t_three_map->get_all();
			$global_threedmap = $global_map[0];
			foreach($global_threedmap as $key=>$value){
				if($key !=='t_m_id'){
					if($key == 'file'){
						if($value == 'baidu'){
							$attributeArr[$key] = $map['swf_path'].$map['baidumap_name'].'.swf';
						}elseif($value == 'mapbak'){
							$attributeArr[$key] = $map['swf_path'].$map['localmap_name_bak'].'.swf';
						}else{
							$attributeArr[$key] = $map['swf_path'].$map['localmap_name_bak'].'.swf';
							//$attributeArr[$key] = $map['swf_path'].$map['localmap_name'].'.swf';
						}
					
					}elseif($key == 'scrollBar'){
						if($value == '1'){
							$attributeArr[$key] = 'true';
						}else{
							$attributeArr[$key] = 'false';
						}
					}elseif($key == 'hotspot' || $key == 'overState' ||$key == 'activeState'){
						$attributeArr[$key] = $map['relative_path'].$value;
					}elseif($key == 'initialShow'){
						if($value == '1'){
							$attributeArr[$key] = 'true';
						}else{
							$attributeArr[$key] = 'false';
						}
					}else{
						$attributeArr[$key] = $value;
					}
					
				}
				
				
			}
			$maptrue = $this->xmldata->create_C_T_M_Node($savePath,'ui',0,'map',$attributeArr,'',$savePath);
		}else{
			$maptrue = true;
		}
		
		if($global_threedrow->iscontrol == '1'){
			$thumb = $this->config->item('thumb');
			$control = $this->config->item('control');
			$global_control = $this->t_three_control->get_all();
			$global_threedcontrol = $global_control[0];

			foreach($global_threedcontrol as $key=>$value){
				if($key !=='t_c_id'){
					if($key == 'type'){
						$attributeArrcontrol['file'] =$control['swf_path'].$value.'.swf';
					}elseif($key == 'initialShow'){
						if($value == '1'){
							$attributeArrcontrol[$key] = 'true';
						}else{
							$attributeArrcontrol[$key] = 'false';
						}
					}else{
						$attributeArrcontrol[$key] = $value;
					}
		
				}
					
					
			}
			
			$conctroltrue = $this->xmldata->create_C_T_M_Node($savePath,'ui',0,'control',$attributeArrcontrol,'',$savePath);
		}else{
			$conctroltrue = true;
		}
	
	
		
		if($conctroltrue && $maptrue){

			echo "<script>window.location.href ='".site_url('admin/three_config/createroomxml')."'</script>";
		}else{
			echo "<script>alert('生成设计师模板xml失败！');window.location.href ='".site_url('admin/three_config/index')."'</script>";
		}
		
	}
	
	public function creatediyxml(){
		//生成DIYxml模板 缩略图和 控件导航
		$this->config->load('threed');
		$xmlsave = $this->config->item('xml');
		$global_threed = $this->t_three_d_config->get_all();
		$global_threedrow = $global_threed[0];
		$savePath = $xmlsave['upload_path'].$xmlsave['diy_xml'].'.xml';
	
		$globaltrue = $this->xmldata->createGlobalNode($savePath);
		if($global_threedrow->isthumb == '1'){
			$thumb = $this->config->item('thumb');
			$global_thumb = $this->t_three_thumb->get_all();
			$global_threedthumb = $global_thumb[0];
				
			foreach($global_threedthumb as $key=>$value){
				if($key !=='t_t_id'){
					if($key == 'left'||$key == 'right'||$key == 'border'){
						$attributeArrthumb[$key] = $thumb['relative_path'].$value;
					}elseif($key == 'baidu'){
						$attributeArrthumb[$key] = 'baidu.swf';
					}elseif($key == 'initialShow'){
						if($value == '1'){
							$attributeArrthumb[$key] = 'true';
						}else{
							$attributeArrthumb[$key] = 'false';
						}
					}else{
						$attributeArrthumb[$key] = $value;
					}
		
				}	
					
			}
			$attributeArrthumb['file'] = $thumb['swf_path'].$thumb['thumb_name'].'.swf';
		
			$diythumbtrue = $this->xmldata->create_C_T_M_Node($savePath,'ui',0,'thumb',$attributeArrthumb,'',$savePath);
		}else{
			$diythumbtrue = true;
		}
		
		if($global_threedrow->iscontrol == '1'){
			$thumb = $this->config->item('thumb');
			$control = $this->config->item('control');
			$global_control = $this->t_three_control->get_all();
			$global_threedcontrol = $global_control[0];
		
			foreach($global_threedcontrol as $key=>$value){
				if($key !=='t_c_id'){
					if($key == 'type'){
						$attributeArrcontrol['file'] =$control['swf_path'].$value.'.swf';
					}elseif($key == 'initialShow'){
						if($value == '1'){
							$attributeArrcontrol[$key] = 'true';
						}else{
							$attributeArrcontrol[$key] = 'false';
						}
					}else{
						$attributeArrcontrol[$key] = $value;
					}
		
				}
						
			}
				
			$diyconctroltrue = $this->xmldata->create_C_T_M_Node($savePath,'ui',0,'control',$attributeArrcontrol,'',$savePath);
		}else{
			$diyconctroltrue = true;
		}
		if($diythumbtrue && $diyconctroltrue){
			echo "<script>window.location.href ='".site_url('admin/three_config/createrecommend')."'</script>";
		}else{
			echo "<script>alert('生成DIY模板xml失败！');window.location.href ='".site_url('admin/three_config/index')."'</script>";
		}
		
	}
	
	//生成推荐xml模板
	public function createrecommend(){
		//生成推荐xml模板 和 控件导航
		$this->config->load('threed');
		$xmlsave = $this->config->item('xml');
		$global_threed = $this->t_three_d_config->get_all();
		$global_threedrow = $global_threed[0];
		$savePath = $xmlsave['upload_path'].$xmlsave['recommend_xml'].'.xml';
		$recommendtrue = $this->xmldata->createGlobalNode($savePath);
		if($global_threedrow->iscontrol == '1'){
				$control = $this->config->item('control');
				$global_control = $this->t_three_control->get_all();
				$global_threedcontrol = $global_control[0];
				
				foreach($global_threedcontrol as $key=>$value){
					if($key !=='t_c_id'){
						if($key == 'initialShow'){
							if($value == '1'){
								$attributeArrcontrol[$key] = 'true';
							}else{
								$attributeArrcontrol[$key] = 'false';
							}
						}else{
							if($key == 'type_recommend'){
								$attributeArrcontrol['file'] =$control['swf_path'].$value.'.swf';
							}else{
								$attributeArrcontrol[$key] = $value;
							}
							
						}
			
					}
						
						
				}
				
				$conctroltrue = $this->xmldata->create_C_T_M_Node($savePath,'ui',0,'control',$attributeArrcontrol,'',$savePath);
		}else{
			$conctroltrue = true;
		}
		
		if($recommendtrue && $conctroltrue){
			echo "<script>window.location.href ='".site_url('admin/three_config/createeditxml')."'</script>";
			//echo "<script>alert('生成全局模板xml成功！');window.location.href ='".site_url('admin/three_config/index')."'</script>";
		}else{
			echo "<script>alert('生成推荐模板xml失败！');window.location.href ='".site_url('admin/three_config/index')."'</script>";
		}
	}
	public function createroomxml_bak(){
		//生成预览xml模板
		$this->config->load('threed');
		$xmlsave = $this->config->item('xml');
		$savePath = $xmlsave['upload_path'].$xmlsave['preview_xml'].'.xml';
		$globaltrue = $this->xmldata->createPreviewNode($savePath);
		if($globaltrue){
			echo "<script>window.location.href ='".site_url('admin/three_config/creatediyxml')."'</script>";
		}else{
			echo "<script>alert('生成房间模板xml失败！');window.location.href ='".site_url('admin/three_config/index')."'</script>";
		}
	}
	
	
	public function createroomxml(){
		//生成预览xml模板
		$this->config->load('threed');
		$xmlsave = $this->config->item('xml');
		$global_threed = $this->t_three_d_config->get_all();
		$global_threedrow = $global_threed[0];
		$savePath = $xmlsave['upload_path'].$xmlsave['preview_xml'].'.xml';
		
		$globaltrue = $this->xmldata->createGlobalNode($savePath);
		if($global_threedrow->iscontrol == '1'){
			$thumb = $this->config->item('thumb');
			$control = $this->config->item('control');
			$global_control = $this->t_three_control->get_all();
			$global_threedcontrol = $global_control[0];
			
			foreach($global_threedcontrol as $key=>$value){
				if($key !=='t_c_id'){
					if($key == 'type'){
						$attributeArrcontrol['file'] =$control['swf_path'].$value.'.swf';
					}elseif($key == 'initialShow'){
						if($value == '1'){
							$attributeArrcontrol[$key] = 'true';
						}else{
							$attributeArrcontrol[$key] = 'false';
						}
					}else{
						$attributeArrcontrol[$key] = $value;
					}
		
				}
					
			}
		
			$roomconctroltrue = $this->xmldata->create_C_T_M_Node($savePath,'ui',0,'control',$attributeArrcontrol,'',$savePath);
		}else{
			$roomconctroltrue = true;
		}
		if($roomconctroltrue && $globaltrue){
			echo "<script>window.location.href ='".site_url('admin/three_config/creatediyxml')."'</script>";
		}else{
			echo "<script>alert('生成房间模板xml失败！');window.location.href ='".site_url('admin/three_config/index')."'</script>";
		}
		
	}
	
	
	public function createeditxml(){
		//生成热点编辑xml模板
		$this->config->load('threed');
		$xmlsave = $this->config->item('xml');
		$global_threed = $this->t_three_d_config->get_all();
		$global_threedrow = $global_threed[0];
		$savePath = $xmlsave['upload_path'].$xmlsave['edit_xml'].'.xml';
	
		$globaltrue = $this->xmldata->createGlobalNode($savePath);
		if($global_threedrow->iscontrol == '1'){
			$thumb = $this->config->item('thumb');
			$control = $this->config->item('control');
			$global_control = $this->t_three_control->get_all();
			$global_threedcontrol = $global_control[0];
				
			foreach($global_threedcontrol as $key=>$value){
				if($key !=='t_c_id'){
					if($key == 'type'){
						$attributeArrcontrol['file'] =$control['swf_path'].$value.'.swf';
					}elseif($key == 'initialShow'){
						if($value == '1'){
							$attributeArrcontrol[$key] = 'true';
						}else{
							$attributeArrcontrol[$key] = 'false';
						}
					}else{
						$attributeArrcontrol[$key] = $value;
					}
	
				}
					
			}
			
			$conctroltrue = $this->xmldata->create_C_T_M_Node($savePath,'ui',0,'control',$attributeArrcontrol,'',$savePath);
			
			$editcontrol['file'] = "/threed/plugins/editor.swf";
			$editcontrol['x'] = '350';
			$editcontrol['y'] = '218';
			$editconctroltrue = $this->xmldata->create_C_T_M_Node($savePath,'ui',0,'editor',$editcontrol,'',$savePath);
		}else{
			$conctroltrue = true;
		}
		if($conctroltrue && $editconctroltrue && $globaltrue){
			
			echo "<script>alert('生成全局模板xml成功！');window.location.href ='".site_url('admin/three_config/index')."'</script>";
		
		}else{
			echo "<script>alert('生成编辑热点模板xml失败！');window.location.href ='".site_url('admin/three_config/index')."'</script>";
		}
	
	}
	
	
	public function test(){
		loadLib('Roomlib_Class');
		$roomlib_bak = new Roomlib_Class();
		$this->roomlib_class = $roomlib_bak;
	
		var_dump($this->roomlib_class->createJs3D(705));die;
		
		loadLib('Roomlib_Class');
		$roomlib_bak = new Roomlib_Class();
		$this->roomlib_class = $roomlib_bak;
		var_dump($this->roomlib_class->createThumbXml(705));die;
		var_dump($this->roomlib_class->xml3d(824));die;
		$this->roomlib_class->flg = 1;
		$this->config->load('threed');
		$xmlsave = $this->config->item('xml');
		$xmlPath = $xmlsave['upload_path'].$xmlsave['recommend_xml'].'.xml';
		//echo $xmlPath;die;
		if(file_exists($xmlPath)){
			echo "ddd";die;
		}echo "dddddd";die;
		var_dump($this->roomlib_class->xml3d('6'));die;
/* 		$this->load->library('image_lib');
		$this->image_lib->pic_group(1);die; */
		
/* 		var_dump($this->roomlib_class->xml3d(6));die;
		var_dump($this->roomlib_class->createThumbXml('705'));die; */
		$this->load->library('image_lib');
		$result = $this->roomlib_class->getSchemeFloorOneRoom(6);
		echo $this->image_lib->createFirstRoomThumb(6,$result);die;
		var_dump($result[0]);die;
		var_dump($this->roomlib_class->xml3d(6));die;
		$this->load->library('Roomlib_Class');
		var_dump($this->roomlib_class->xml3d(6));die;

		
		$this->load->library('roomlib_class');
		echo  $this->roomlib_class->xml3d('6');die;
		$this->config->load('uploads');
		$xml = $this->config->item('room_3d');
		$scheme_id = isset($_POST['scheme_id'])?$this->input->post('scheme_id',true):'';
		$scheme_id = 6;
		if(!is_numeric($scheme_id)){
			echojson(1,'','方案id不是数字');
		}
		//楼层表
		$this->load->model('t_project_floor_model');
		$t_project_floor = $this->t_project_floor_model;
		//方案房间表
		$this->load->model('t_project_room_model');
		$t_project_room = $this->t_project_room_model;
		//楼层关系房间表
		$this->load->model('t_project_floor_room_model');
		$t_project_floor_room = $this->t_project_floor_room_model;
		//查找房间
		$room_result = $t_project_room->select_where(array('scheme_id'=>$scheme_id,'room_status'=>1));
		foreach($room_result as $ys){
			$room_info[$ys['room_id']]['room_name'] = $ys['room_name'];
			$room_info[$ys['room_id']]['room_thinking'] = $ys['room_thinking'];
		}
		
		$room_row = twotoone_array($room_result,'room_id'); //方案下状态正常的房间
		$field = 'floor_id,floor_pic1,floor_map_coor';
		$where = array('scheme_id'=>$scheme_id);
		$floor = $t_project_floor->getFloor($field,$where);
		$panotile=array('一楼','二楼','三楼','四楼','五楼','六楼','七楼','八楼','九楼','十楼');
		
		foreach ($floor as $key=>$val){
			$map_coor = explode('|',$val['floor_map_coor']);
			if($val['floor_map_coor']){
				$map_room = getfloorroom($val['floor_map_coor']);//对图钉截取处理来的结果 
				if($map_room){
					
					$room_id[] = twotoone_array($map_room,'room_id');//楼层房间详细信息
					foreach($map_room as $map){
						$mappoint[$map['room_id']]['mapx'] = $map['mapx'];
						$mappoint[$map['room_id']]['mapy'] = $map['mapy'];
					}
				}
			}
		}
		
		foreach($room_id as $key=>$vals){
			foreach($vals as $val){
				if(in_array($val, $room_row)){
					$rofloor[$key][] = $val;//楼层对应的房间
					$room_floor[] = $val;//有状态正常的图钉的房间
					
				}
			}	
		}
		//$roow_row > $room_floor 方案下房间范围大于  有图钉房间
		//根据楼层场景（房间）排序
		foreach($room_row as $fo){
			if(!in_array($fo, $room_floor)){
				$room_floor[] = $fo; //这个是把没图钉的房间加到有图钉的房间之后 就好好像根据楼层场景（房间）排序
			}
		}
		
		foreach($rofloor as $key=>$rofo){//$key代表层
			if(count($rofo)==1){//这是防止xml显示
				$pano_id = $rofo[0].'|';
			}else{
				$pano_id = implode('|',$rofo);
			}
			$floor_file = getfloor1url($scheme_id,$floor[$key]['floor_id']).$floor[$key]['floor_pic1'];
			$pano[] = array('title'=>$panotile[$key],'file'=>$floor_file,'pano'=>$pano_id);//floor
			
		}
		
		
		//pano场景
		foreach ($room_floor as $vas){
			if(!isset($mappoint[$vas]['mapx'])){
				$mappoint[$vas]['mapx'] = 0;
			}
			if(!isset($mappoint[$vas]['mapy'])){
				$mappoint[$vas]['mapy'] = 0;
			}
			$rooms[] = array(
					'name'=>$vas,
					'type'=>'cubestrip',
					'url'=>roomurl($vas).$xml['long_name'],
					'preview'=>roomurl($vas).$xml['preview_name'],
					'thumb'=>roomurl($vas).$xml['thumb_name'],
					'mapX'=>$mappoint[$val]['mapx'],
					"mapY"=>$mappoint[$vas]['mapy'],
					'heading'=>'-90',
					'pan'=>'0',
					'fovMax'=>'20',
					'fovMin'=>'20',
					'title'=>$room_info[$vas]['room_name'],
					'info'=>$room_info[$vas]['room_thinking']
			);
		}
		
		$valueArray[] = array(
							
						"parentName"=>'vr',
						"nodeIndex" =>0,
						"sonName" =>'pano',
						'sonNodeValue'=>'',
						'valueArray'=>$rooms
				);
		$valueArray[] = 
				array(
		
						"parentName"=>'map',
						"nodeIndex" =>0,
						"sonName" =>'floor',
						'sonNodeValue'=>'',
						'valueArray'=>$pano
						
				);

		
	
		
		
 		$this->config->load('threed');
		$xmlsave = $this->config->item('xml');
		$this->config->load('uploads');
		$room3d_name = $this->config->item('room_3d');
		$xmlPath = $xmlsave['upload_path'].$xmlsave['global_xml'].'.xml';
	
	/* 	$valueArray = array(
			array(
					
					"parentName"=>'vr',
					"nodeIndex" =>0,
					 "sonName" =>'pano',
					'sonNodeValue'=>'',
					'valueArray'=>
						array(
								
								array(
										'name'=>1,
										'type'=>'cubestrip',
										'url'=>'/uploads/room/1/1/long.jpg',
										'preview'=>'/uploads/room/1/1/preview.jpg',
										'thumb'=>'/uploads/room/1/1/thumb.jpg',
										'mapY'=>'116.45',
										"mapY"=>"39.9",
										'heading'=>'-90',
										'pan'=>'0',
										'fovMax'=>'20',
										'fovMin'=>'20',
										'title'=>'路径漫游1',
										'info'=>'google map同步导航！'
										
								),
								array(
										'name'=>2,
										'type'=>'cubestrip',
										'url'=>'/uploads/room/1/1/long.jpg',
										'preview'=>'/uploads/room/1/1/preview.jpg',
										'thumb'=>'/uploads/room/1/1/thumb.jpg',
										'mapY'=>'116.45',
										"mapY"=>"53",
										'heading'=>'-90',
										'pan'=>'0',
										'fovMax'=>'130',
										'fovMin'=>'20',
										'title'=>'路径漫游1',
										'info'=>'google map同步导航！'
								),
								array(
										'name'=>3,
										'type'=>'cubestrip',
										'url'=>'/uploads/room/1/1/long.jpg',
										'preview'=>'/uploads/room/1/1/preview.jpg',
										'thumb'=>'/uploads/room/1/1/thumb.jpg',
										'mapY'=>'16.45',
										"mapY"=>"53",
										'heading'=>'-90',
										'pan'=>'0',
										'fovMax'=>'130',
										'fovMin'=>'20',
										'title'=>'路径漫游1',
										'info'=>'google map同步导航！'
								)
								
								
						)
						
				),
				
			array(
						
					"parentName"=>'map',
					"nodeIndex" =>0,
					 "sonName" =>'floor',
					'sonNodeValue'=>'',
					'valueArray'=>
						array(
									array(
											'title'=>'一楼',
											'file'=>'/threed/global/map1.png',
											'pano'=>'1|2'
											),
									array(
											'title'=>'一楼',
											'file'=>'/threed/global/map1.png',
											'pano'=>'3'
									)
							)
			)
				); 
		 */
		
		
	
		//echo "<pre>";var_dump($valueArray);die;
	
		
		$roomurl = xmlurl($scheme_id);
		$savePath = $_SERVER['DOCUMENT_ROOT'].$roomurl.$room3d_name['room_xml_name'].'.xml';
		
		//$savePath = $xmlsave['upload_path'].'preview1.xml'; 
		if($this->xmldata->create3DXml($xmlPath,$valueArray,$savePath)){
			//$result  = array('xml'=>$xmlsave['relative_path'].'preview1.xml');
			
			$result  = array('xml'=>$roomurl.$room3d_name['room_xml_name'].'.xml');
			//echo '<pre>';var_dump($result);die;
			$this->load->view('admin/content/testxml',$result);
		}
	/* 	$savePath = $xmlsave['upload_path'].'preview1.xml';
		//向不同父级加入多个子级以及属性
		//echo $this->xmldata->createPano($xmlPath,$valueArray,$savePath);die;
		$valueArray = array(array(
										'name'=>1,
										'type'=>'cubestrip'
								),
								array(
										'name'=>2,
										'type'=>'cubestrip'
								));
		echo $this->xmldata->createPano1($xmlPath,'vr',0,'pano','',$valueArray,$savePath);die; */
		
/* 		
		//预览xml接口
		$this->config->load('threed');
		$xmlsave = $this->config->item('xml');
		$this->config->load('uploads');
		$room3d_name = $this->config->item('room_3d');
		$xmlPath = $xmlsave['upload_path'].$xmlsave['preview_xml'].'.xml';
		$room_id = $this->input->post('room_id',true);
		$room_id =1;
		if(!is_numeric($room_id)){
			echojson(1, '','房间号只能为数字');
		}
		$roomurl = roomurl($room_id);
		$isexists = $_SERVER['DOCUMENT_ROOT'].$roomurl.$room3d_name['long_name'].'.jpg';
		if(!file_exists($isexists)){
			echojson(1, '',' 该房间不存在，预览失败！'); 
		}
		$roomurlsave = $_SERVER['DOCUMENT_ROOT'].$roomurl.$room3d_name['room_xml_name'].'.xml';
		$long = $roomurl.$room3d_name['long_name'].'.jpg';
		$previem = $roomurl.$room3d_name['preview_name'].'.jpg';

		$array_attribute = array('url'=>$long,'preview'=>$previem);	
		if($this->xmldata->updataAttributXml($xmlPath,'pano',0,$array_attribute,$roomurlsave)){
			$array = array('xml'=>$roomurl.$room3d_name['room_xml_name'].'.xml');
			//echojson(0, $array,'生成成功！');
			$result  = array('xml'=>$roomurl.$room3d_name['room_xml_name'].'.xml');
			//var_dump($result);die;
			$this->load->view('admin/content/testxml',$result);
		}else{
			echojson(1,'', '生成xml失败！');
		}
	   */
	}
}

?>