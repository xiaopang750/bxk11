<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @abstract xml与库操作类
 * @author liuguangping
 * @version jia178 1.0 2013-12-10 21:15:00
 *
 */
class Roomlib_Class{
	protected $CI;
	protected $xmlaction;
	protected $xmldata;
	public $flg;
	//protected $xmlaction;
	public function __construct(){
		$this->CI =&get_instance();
		loadLib("XmlData_Class");
		$xmldata_bak = new XmlData_Class();
		$this->xmldata = $xmldata_bak;
	
		loadLib("XmlAction_Class");
		$xmlaction_bak = new XmlAction_Class();	
		$this->xmlaction = $xmlaction_bak;
		
/* 		$this->CI->load->library('xmldata_class');
		$this->CI->load->library('xmlaction_class');
		$this->xmlaction = $this->CI->xmlaction_class;
		$this->xmldata = $this->CI->xmldata_class; */
		$this->CI->config->load('uploads');
	}
	
	/**
	 * 3d场景预览
	 * @author liuguangping
	 * @param room_id 请求过来的值
	 */
	public function preview($room_id){
		//预览xml接口
		$this->CI->config->load('threed');
		$xmlsave = $this->CI->config->item('xml');
		$this->CI->config->load('uploads');
		$room3d_name =$this->CI->config->item('room_3d');
		$xmlPath = $xmlsave['upload_path'].$xmlsave['preview_xml'].'.xml';
		if(!file_exists($xmlPath)){
			return false;
		}
		$roomurl = roomurl($room_id);
		$roomurlsave = $_SERVER['DOCUMENT_ROOT'].$roomurl.$room3d_name['room_xml_name'].'.xml';
		$long = $roomurl;
		$isexists = $_SERVER['DOCUMENT_ROOT'].$roomurl.$room3d_name['long_name'];
	
		if(!file_exists($isexists)){
			
			$previem = $roomurl.'f.jpg';
		}else{
			$previem = $roomurl.$room3d_name['preview_name'];
		}
		$this->CI->load->model('t_project_room_model');
		$t_project_room = $this->CI->t_project_room_model;
		$room_fist = $t_project_room->get($room_id);
		if(!$room_fist){//没有这个房间或者是不正常的房间
			return false;
		}
		
		$chidSon[0] = array(
				"sonName"=>'hotspot',
				'sonNodeValue'=>'',
				'valueArray'=>$this->createhotspotinfo($room_id)
		);
		//echo "<pre>";
		//var_dump($chidSon);die;
		
		$rooms[] = array(
				'name'=>$room_id,
				'type'=>'cubetile',
				'url'=>$long,
				'preview'=>$previem,
				//'thumb'=>roomurl($vas).$xml['thumb_name'].'.jpg',
				'heading'=>'-90',
				'pan'=>'0',
				'fovMax'=>'130',
				'fovMin'=>'20',
				'title'=>$room_fist->room_name,
				'info'=>$room_id.':'.$room_fist->room_name.':'.$room_fist->room_thinking,
				'childs'=>$chidSon
			
		);
		
		$valueArray[] = array(
					
				"parentName"=>'vr',
				"nodeIndex" =>0,
				"sonName" =>'pano',
				'sonNodeValue'=>'',
				'valueArray'=>$rooms
		);
		if($this->xmldata->create3DXml($xmlPath,$valueArray,$roomurlsave)){
			return $roomurl.$room3d_name['room_xml_name'].'.xml';
		}else{
			return false;
		}
	}
	
	
	/**
	 * 3d编辑xml
	 * @author liuguangping
	 * @param room_id 请求过来的值
	 */
	public function editxml($room_id){
		//预览xml接口
		$this->CI->config->load('threed');
		$xmlsave = $this->CI->config->item('xml');
		$this->CI->config->load('uploads');
		$room3d_name =$this->CI->config->item('room_3d');
		$xmlPath = $xmlsave['upload_path'].$xmlsave['edit_xml'].'.xml';
		if(!file_exists($xmlPath)){
			return false;
		}
		$roomurl = roomurl($room_id);
		$roomurlsave = $_SERVER['DOCUMENT_ROOT'].$roomurl.$room3d_name['edit_xml_name'].'.xml';
		$long = $roomurl;
		$isexists = $_SERVER['DOCUMENT_ROOT'].$roomurl.$room3d_name['long_name'];
	
		if(!file_exists($isexists)){
				
			$previem = $roomurl.'f.jpg';
		}else{
			$previem = $roomurl.$room3d_name['preview_name'];
		}
		$this->CI->load->model('t_project_room_model');
		$t_project_room = $this->CI->t_project_room_model;
		$room_fist = $t_project_room->get($room_id);
		if(!$room_fist){//没有这个房间或者是不正常的房间
			return false;
		}
	
		
		//echo "<pre>";
		//var_dump($chidSon);die;
	
		$rooms[] = array(
				'name'=>$room_id,
				'type'=>'cubetile',
				'url'=>$long,
				'preview'=>$previem,
				//'thumb'=>roomurl($vas).$xml['thumb_name'].'.jpg',
				'heading'=>'-90',
				'pan'=>'0',
				'fovMax'=>'130',
				'fovMin'=>'20',
				'title'=>$room_fist->room_name,
				'info'=>$room_id.':'.$room_fist->room_name.':'.$room_fist->room_thinking,
				'childs'=>''
					
		);
	
		$valueArray[] = array(
					
				"parentName"=>'vr',
				"nodeIndex" =>0,
				"sonName" =>'pano',
				'sonNodeValue'=>'',
				'valueArray'=>$rooms
		);
		//var_dump($valueArray);die;
		if($this->xmldata->create3DXml($xmlPath,$valueArray,$roomurlsave)){
			return $roomurl.$room3d_name['edit_xml_name'].'.xml';
		}else{
			return false;
		}
	}
	/**
	 * 向单个热点中加入热点信息
	 * @param int $room_id 房间id
	 * @return string
	 */
	public function createhotspotinfo($room_id){
		$this->CI->load->helper('import_excel');
		$this->CI->load->model('t_project_room_bill_item_model');
		$t_project_room_bill_item = $this->CI->t_project_room_bill_item_model;
		$t_project_room_bill_item->room_id = $room_id;
		$hostspotre = $t_project_room_bill_item->getBillitemByItemAll();
		$this->CI->config->load('uploads');
		$product =$this->CI->config->item('product');
		$this->CI->config->load('threed');
		$hotspot_url =$this->CI->config->item('hotspot');
		//echo "<pre>";var_dump($hostspotre);die;
		$this->CI->load->model('t_certified_product_info_model');
		$t_certified_product_info = $this->CI->t_certified_product_info_model;
		if(isset($hostspotre) && $hostspotre){
			foreach($hostspotre as $key =>$valusp){
	
				$info = $t_certified_product_info->get($valusp['product_id']);
				if(isset($info) && $info){
					$product_info = cn_substr_utf8($info->product_description,0,280);
				}else{
					$product_info = "没产描述";//产品名
				}
				if($valusp['poduct_picurl']){
					$product_thumbpic = $valusp['poduct_picurl'];//产品缩略图
				}else{
					$product_thumbpic = $product['default_3'];
				}
	
				if(isset($valusp['poduct_url']) && $valusp['poduct_url'] !=''){
					$produc_url = $valusp['poduct_url'];//产品购买地址
				}else{
					$produc_url = $hotspot_url['url_hotspot'];
				}
		
				$array = array(
						'u'=>$valusp['hot_x'],
						'v'=>$valusp['hot_y'],
						'windowInfo' => "<img src='{$product_thumbpic}' width='120' height='120'/> {$product_info}<br/><br/><a href='{$produc_url}' target='_blank'>马上购买>></a>",
						'windowTitle' => $valusp['product_name'],
						'title'=>cn_substr_utf8($valusp['product_name'],0,33),
						'info'=>"<img src='{$product_thumbpic}' width='100' height='100'/> {$product_info}",
						'url'=>$produc_url
								);
				$arrti[] = $this->createhotspot($array);
			}
		}else{
			return '';
		}
		return $arrti;
	}
	/**
	 * 根据传入的参数得到单个热点
	 * @param array $hostspot array('u'=>10,'v'=>'-12','title'=>'','info'=>'','windowInfo'=>'','windowTitle'=>'')
	 * @return string
	 */
	public function createhotspot($hostspotarrg){
		$hotfilename = $this->CI->config->item('hotspot');
		//查找全局是否开启热点设置
		$this->CI->load->model('t_three_d_config_model');
		$t_three_d_config = $this->CI->t_three_d_config_model;
		$global_threed = $t_three_d_config->get_all();
		$global_threedrow = $global_threed[0];
		if($global_threedrow){
			if($global_threedrow->ishotspot == '1'){
				//热点配制
				$this->CI->load->model('t_three_hotspot_model');
				$t_three_hotspot = $this->CI->t_three_hotspot_model;
				$global_hotspot = $t_three_hotspot->get_all();
				$toshow = array('h_id','action','windowWidth','windowHeight','windowFont','windowColor1','windowColor2','windowAlpha');
				if($global_hotspot[0]){
					if($global_hotspot[0]->action == 'toShow'){
					
						foreach ($global_hotspot[0] as $key=>$vals){
							if($key != 'h_id'){
								if($key == "file"){
									$hostspot[$key] = $hotfilename['relative_path'].$vals;
								}else{
									$hostspot[$key]= $vals;
								}
							}
						}
						$hostspot['windowInfo'] = $hostspotarrg['windowInfo'];
						$hostspot['windowTitle'] = $hostspotarrg['windowTitle'];
					}else{
						foreach ($global_hotspot[0] as $key=>$vals){
							if(!in_array($key,$toshow)){
								if($key == "file"){
									$hostspot[$key] = $hotfilename['relative_path'].$vals;
								}else{
									$hostspot[$key]= $vals;
								}
							}
						}
						
						$hostspot['action'] = "toURL";
						$hostspot['info'] = $hostspotarrg['info'];
						$hostspot['url'] = $hostspotarrg['url'];
						$hostspot['target'] = '_blank';
					}
					$hostspot['u'] = $hostspotarrg['u'];
					$hostspot['v'] = $hostspotarrg['v'];
					$hostspot['title'] = $hostspotarrg['title'];
					$arrti = $hostspot;
					//要向子级中加入的标签 比如向场景pano中加入 hotspot 也可以向子级中加入 other标签
				
				}else{
					$arrti = '';
				}
		
			}else{
				$arrti = '';
			}
		}else{
			$arrti = '';
		}
		return $arrti;
	}
	
	/**
	 * 3d场景预览
	 * @author liuguangping
	 * @param room_id 请求过来的值
	 */
	public function preview1($room_id){
	
		//预览xml接口
		$this->CI->config->load('threed');
		$xmlsave = $this->CI->config->item('xml');
		$this->CI->config->load('uploads');
		$room3d_name =$this->CI->config->item('room_3d');
		$xmlPath = $xmlsave['upload_path'].$xmlsave['preview_xml'].'.xml';
		if(!file_exists($xmlPath)){
			return false;
		}
		$roomurl = roomurl($room_id);
		$roomurlsave = $_SERVER['DOCUMENT_ROOT'].$roomurl.$room3d_name['room_xml_name'].'.xml';
		$long = $roomurl;
		$isexists = $_SERVER['DOCUMENT_ROOT'].$roomurl.$room3d_name['long_name'];
	
		if(!file_exists($isexists)){
			$previem = $roomurl.'f.jpg';
		}else{
			$previem = $roomurl.$room3d_name['preview_name'];
		}
	
		$array_attribute = array('url'=>$long,'preview'=>$previem);

		if($this->xmldata->updataAttributXml($xmlPath,'pano',0,$array_attribute,$roomurlsave)){
			return $roomurl.$room3d_name['room_xml_name'].'.xml';
		}else{
			return false;
		}
	}
	
	/**
	 * 3d全景生成xml
	 * @author liuguangping
	 * @param scheme_id 方案id
	 * 
	 */
	public function xml3d($scheme_id){
		
		$this->CI->load->helper('content_fun');
		$this->CI->load->helper('import_excel');
		$xml = $this->CI->config->item('room_3d');
		if(!is_numeric($scheme_id)){
			
			return false;
			//echojson(1,'','方案ID只能为数字');
		}
		//楼层表
		$this->CI->load->model('t_project_floor_model');
		$t_project_floor = $this->CI->t_project_floor_model;
		//方案房间表
		$this->CI->load->model('t_project_room_model');
		$t_project_room = $this->CI->t_project_room_model;
		/* //楼层关系房间表
		$this->CI->load->model('t_project_floor_room_model');
		$t_project_floor_room = $this->CI->t_project_floor_room_model; */
		//查找房间
		$room_result = $t_project_room->select_where(array('scheme_id'=>$scheme_id,'room_status'=>1));
		//$room_status = twotoone_array($room_result,'room_status'); //方案下状态正常的房间
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
						$mappoint[$map['room_id']]['mapx'] = ($map['mapx']/405)*270;
						$mappoint[$map['room_id']]['mapy'] = ($map['mapy']/555)*370;
					}
				}
			}
		}
		if(isset($room_id)){
			foreach($room_id as $key=>$vals){
				foreach($vals as $val){
					if(in_array($val, $room_row)){
						$rofloor[$key][] = $val;//楼层对应的房间
						$room_floor[] = $val;//有状态正常的图钉的房间
							
					}
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
		if(isset($rofloor)){
			foreach($rofloor as $key=>$rofo){//$key代表层
				if(count($rofo)==1){//这是防止xml显示
					$pano_id = $rofo[0].'|';
				}else{
					$pano_id = implode('|',$rofo);
				}
				//$floor_file = getfloor1url($scheme_id,$floor[$key]['floor_id']).$floor[$key]['floor_pic1'];
				$floor_file = getfloor1url($scheme_id,$floor[$key]['floor_id']).$xml['pic1_1'];
				$pano[] = array('title'=>$panotile[$key],'file'=>$floor_file,'pano'=>$pano_id);//floor
					
			}
		}
		
		//pano场景 如果方案没场景则反出false
		if(isset($room_floor)){
				foreach ($room_floor as $vas){
					if(!isset($mappoint[$vas]['mapx']) || $mappoint[$vas]['mapx'] == ''){
						$mappoint[$vas]['mapx'] = 0;
					}
					if(!isset($mappoint[$vas]['mapy']) || $mappoint[$vas]['mapy'] == ''){
						$mappoint[$vas]['mapy'] = 0;
					}
					//热点
					//这个是向子级中加入子级 加入多个子级 pano->加入hotspot（类型）(其他节点类型)数组-> 该类型下的加入的个数（多个热点 （数组））
					$chidSon[0] = array(
							"sonName"=>'hotspot',
							'sonNodeValue'=>'',
							'valueArray'=>$this->createhotspotinfo($vas)
					);
					$rooms[] = array(
							'name'=>$vas,
							'type'=>'cubestrip',
							'url'=>roomurl($vas).$xml['long_name'],
							'preview'=>roomurl($vas).$xml['preview_name'],
							//'thumb'=>roomurl($vas).$xml['thumb_name'].'.jpg',
							'mapX'=>$mappoint[$vas]['mapx'],
							"mapY"=>$mappoint[$vas]['mapy'],
							'heading'=>'-90',
							'pan'=>'0',
							'fovMax'=>'130',
							'fovMin'=>'20',
							'title'=>$room_info[$vas]['room_name'],
							'info'=>$vas.':'.$room_info[$vas]['room_name'].':'.$room_info[$vas]['room_thinking'],
							'childs'=>$chidSon
					);
				}
			//父级上的属性
			$this->CI->load->model('t_project_scheme_model');
			$t_project_scheme = $this->CI->t_project_scheme_model;
			$t_project_scheme->scheme_id = $scheme_id;
			$projectscheme = $t_project_scheme->getSchemeByProject();
			$pname = $projectscheme->project_name;
			$pinfo = $projectscheme->scheme_thinking;
			$maparrt = array('pname'=>$pname,'pinfo'=>$pinfo);
			$valueArray[] = array(
								
							"parentName"=>'vr',
							"nodeIndex" =>0,
							"sonName" =>'pano',
							'sonNodeValue'=>'',
							'parentAttri'=>'',
							'valueArray'=>$rooms
					);
			if($this->flg != 1){
			$valueArray[] = 
					array(
			
							"parentName"=>'map',
							"nodeIndex" =>0,
							"sonName" =>'floor',
							'sonNodeValue'=>'',
							'parentAttri'=>$maparrt,
							'valueArray'=>$pano
							
					);
			}
	 		$this->CI->config->load('threed');
			$xmlsave = $this->CI->config->item('xml');
			$this->CI->config->load('uploads');
			$room3d_name = $this->CI->config->item('room_3d');
			if($this->flg == 1){
				
				$xmlPath = $xmlsave['upload_path'].$xmlsave['recommend_xml'].'.xml';
				if(!file_exists($xmlPath)){
					return false;
				}
			}else{
				$xmlPath = $xmlsave['upload_path'].$xmlsave['global_xml'].'.xml';
			}
			$roomurl = xmlurl($scheme_id);
			if($this->flg == 1){
				$savePath = $_SERVER['DOCUMENT_ROOT'].$roomurl.$room3d_name['recommend_xml_name'].'.xml';
			}else{
				$savePath = $_SERVER['DOCUMENT_ROOT'].$roomurl.$room3d_name['room_xml_name'].'.xml';
			}
			
			if($this->xmldata->create3DXml($xmlPath,$valueArray,$savePath)){
				return true;
				//return $roomurl.$room3d_name['room_xml_name'].'.xml';
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	//生成缩略图和xml
	public function createThumbXml($room_id){
		
		$room_id = $room_id;
		//预览xml接口
		$this->CI->config->load('uploads');
		$room3d_name = $this->CI->config->item('room_3d');
		if(!is_numeric($room_id)){
			return false;
			//echojson(1, '','房间号只能为数字');
		}
		$roomurl = roomurl($room_id);
		
		//$isexists = $_SERVER['DOCUMENT_ROOT'].$roomurl.$room3d_name['long_name'].'.jpg';
		$isexists = $_SERVER['DOCUMENT_ROOT'].$roomurl.'f.jpg';
		if(!file_exists($isexists)){
			return false;
			//echojson(1, '','该房间不存在，预览失败！');
		}
		//生成3d长条图和缩略图各预览图
		$this->CI->load->library('image_lib');
		if(!$this->CI->image_lib->pic_group($room_id)){
			return false;
			//echojson(1, '','预览图片生成失败！');
		}
		
		if($this->preview($room_id)){
			$this->CI->config->load('view');
			$url = $this->CI->config->item('index');
			$this->CI->load->helper('url');
			//$array = array('xml'=>site_url($url['roompreview']).'?room_id='.$room_id);
			return true;
			//echojson(0, $array,'生成成功！');
		}else{
			return false;
			//echojson(1, '','生成xml失败！');
		}
	}
	/*
	 * 生成js3dXML
	 */
	public function createJs3D($room_id){
		//$url = "http://192.168.1.87";
		$roomurl =roomurl($room_id);
		//$isexists = $_SERVER['DOCUMENT_ROOT'].$roomurl.$room3d_name['long_name'].'.jpg';
		$isexists = $_SERVER['DOCUMENT_ROOT'].$roomurl.'jsf.jpg';
		if(!file_exists($isexists)){
			return false;
			//echojson(1, '','该房间不存在，预览失败！');
		}
		$xmlPath = $_SERVER['DOCUMENT_ROOT'].$roomurl.'ok.xml';
		$Data['jsf'] = $roomurl.'jsf.jpg';
		$Data['jsb'] = $roomurl.'jsb.jpg';
		$Data['jsd'] = $roomurl.'jsd.jpg';
		$Data['jsl'] = $roomurl.'jsl.jpg';
		$Data['jsr'] = $roomurl.'jsr.jpg';
		$Data['jsu'] = $roomurl.'jsu.jpg';
		if($this->xmldata->createGlobalJsNode($xmlPath,$Data)){
			return true;
		}else{
			return false;
		}
		
	}
	
	//方案中的第一个楼层的room_id
	public function getSchemeFloorOneRoom($scheme_id){
		$this->CI->load->model('t_project_floor_model');
		$t_project_floor = $this->CI->t_project_floor_model;
		$this->CI->load->model('t_project_floor_room_model');
		$t_project_floor_room = $this->CI->t_project_floor_room_model;
		
		$foorresult = $t_project_floor->floorlist($scheme_id);
		$fooroneresult = $foorresult[0];
		$foornonenumber = $fooroneresult->floor_id; //第一个楼层的id
		
		//查找房间
		$orderfoor = $t_project_floor_room->getFloorbyAll($foornonenumber); //根据楼层得到房间适合设计师和DIY组合
		$room_row = twotoone_array($orderfoor,'room_id'); //方案下状态正常的房间
		if($fooroneresult->floor_map_coor){
			$map_room = getfloorroom($fooroneresult->floor_map_coor);//对图钉截取处理来的结果
			if($map_room){
				$room_id = twotoone_array($map_room,'room_id');//第一层的楼层房间
			}
		}
		//如果楼层中没有floor_map_coor值时取楼层中的房间（diy）
		if(isset($room_id)){
			foreach ($room_id as $value){
				if(in_array($value, $room_row)){
					$fistoneroom = $value;
					break;
				}
			}
			//
			if(!isset($fistoneroom)){
				if($room_row){
					$fistoneroom = $room_row['0'];
				}else{
					return false;
				}
				
			}
			return $fistoneroom;
		}else{
			if($room_row){
				return $floorbyroom_id = $room_row['0'];
			}else{
				return false;
			}
		}
		
		
	}
	//DIY用户方案
	public function diy3D($scheme_id){
		//diy方案只有一个楼层是以房间为单位  ===逻辑是楼层表中是否有 然后是根据楼层关系表来关联你以下载的（diy）的房间
		//根据方案得到默认一层的id
		if(!is_numeric($scheme_id)){
			return false;
			//echojson(1,'','方案ID只能为数字');
		}
		$this->CI->load->model('t_project_floor_model');
		$t_project_floor = $this->CI->t_project_floor_model;
		$this->CI->load->model('t_project_floor_room_model');
		$t_project_floor_room = $this->CI->t_project_floor_room_model;
		
		$this->CI->load->helper('content_fun');
		$this->CI->load->helper('import_excel');
		$xml = $this->CI->config->item('room_3d');
		
		$where = array('scheme_id'=>$scheme_id);
		$floorinfo = $t_project_floor->getFloor($field='floor_id',$where);
		if($floor_id = $floorinfo['0']['floor_id']){
			$floor = $t_project_floor_room->getFloorbyAll($floor_id);
			if($floor){
				foreach ($floor as $val){
					//热点
					//这个是向子级中加入子级 加入多个子级 pano->加入hotspot（类型）(其他节点类型)数组-> 该类型下的加入的个数（多个热点 （数组））
					$chidSon[0] = array(
							"sonName"=>'hotspot',
							'sonNodeValue'=>'',
							'valueArray'=>$this->createhotspotinfo($val['room_id'])
					);
					$rooms[] = array(
							'name'=>$val['room_id'],
							'type'=>'cubestrip',
							'url'=>roomurl($val['room_id']).$xml['long_name'],
							'preview'=>roomurl($val['room_id']).$xml['preview_name'],
							'thumb'=>roomurl($val['room_id']).$xml['thumb_name'],
							//'mapX'=>$mappoint[$vas]['mapx'],
							//"mapY"=>$mappoint[$vas]['mapy'],
							'heading'=>'-90',
							'pan'=>'0',
							'fovMax'=>'130',
							'fovMin'=>'20',	
							'title'=>$val['room_name'],
							'info'=>$val['room_id'].':'.$val['room_name'].':'.$val['room_thinking'],
							'childs'=>$chidSon
					);
				}
					
				$valueArray[] = array(
				
						"parentName"=>'vr',
						"nodeIndex" =>0,
						"sonName" =>'pano',
						'sonNodeValue'=>'',
						'valueArray'=>$rooms
				);
					
					
				$this->CI->config->load('threed');
				$xmlsave = $this->CI->config->item('xml');
				$this->CI->config->load('uploads');
				$room3d_name = $this->CI->config->item('room_3d');
				$xmlPath = $xmlsave['upload_path'].$xmlsave['diy_xml'].'.xml';
				$roomurl = xmlurl($scheme_id);
				$savePath = $_SERVER['DOCUMENT_ROOT'].$roomurl.$room3d_name['diy_xml_name'].'.xml';
				if($this->xmldata->create3DXml($xmlPath,$valueArray,$savePath)){
					return true;
				}else{
					return false;
				}
			}else{
				//该层无房间
				return false;
			}
			
		}else{
			//该方案下没有楼层
			return false;
		}
	
	}
	/**
	 * 根据房间生成diy和案例方案更新xml或生成 ，根据方案id生成更新xml
	 * @param Array $array=array('room_id'=>'','scheme_id'=>''); 
	 * 
	 */
	public function xmlUpdate($array=array('room_id'=>'','scheme_id'=>'')){
		
		$result_xml = array();
		if(isset($array['room_id']) && $array['room_id'] != ''){
			$this->CI->load->model('t_project_room_model');
			$t_project_room = $this->CI->t_project_room_model;
			//生成xml热点
			if($t_project_room->is_rooms($array['room_id'])){
				
				//房间生成热点
				if(!$this->preview($array['room_id'])){
					$result_xml['room'][] = $array['room_id'];
				}
				
			}
			if($result = $t_project_room->is_rooms($array['room_id'])){
				foreach($result as $valu){
					//方案生成热点(不包含diy)
					if(!$this->xml3d($valu['scheme_id'])){
						$result_xml['scheme'][] = $valu['scheme_id'];//所属房间的案例（不包含diy）
					}
				}
			}

			//生成和更新diy 根据房间查找diy方案、
			$this->CI->load->model('t_project_floor_room_model');
			$t_project_floor_room = $this->CI->t_project_floor_room_model;
			$diyscheme  = $t_project_floor_room->getRoomidByDiyScheme($array['room_id']);
			
			if($diyscheme){
				$diy_id = twotoone_array($diyscheme, 'scheme_id');
			}
			if(isset($diy_id) && !empty($diy_id)){
				foreach($diy_id as $vald){
					//生成diy
					if(!$this->diy3D($vald)){
						$result_xml['diy'][] = $vald;//所属房间的diy案例
					}
				}
			}
			
		}
		if(isset($array['scheme_id']) && $array['scheme_id'] != ''){
			$this->CI->load->model('t_project_scheme_model');
			$t_project_scheme = $this->CI->t_project_scheme_model;
			$sc = $t_project_scheme->get($array['scheme_id']);
			if($sc->scheme_user_type == 1){
				if(!$this->diy3D($array['scheme_id'])){
					$result_xml['scheme'][] = $array['scheme_id'];//案例
				}
			}else{
				if(!$this->xml3d($array['scheme_id'])){
					$result_xml['scheme'][] = $array['scheme_id'];//案例
				}
			}
			
		}
	
		return $result_xml;
	}
	
	public function xmlOneUpade($room_id='',$scheme_id=''){
		$this->CI->load->helper('import_excel');
		$this->CI->config->load('uploads');
		$upload_url = $this->CI->config->item('upload_file');
		$result = $this->xmlUpdate(array('room_id'=>$room_id,'scheme_id'=>$scheme_id));
		
		//js3dxml
		if(isset($room_id) && ($room_id !='')){
			$content = '';
			$this->CI->load->library('image_lib');
			$roomurl = roomurl($room_id);
			$isexists = $_SERVER['DOCUMENT_ROOT'].$roomurl.'jsf.jpg';
			$isexist_xml = $_SERVER['DOCUMENT_ROOT'].$roomurl.'f.jpg';
			if(file_exists($isexists) && file_exists($isexist_xml)){
				if(!$this->CI->image_lib->pic_group($room_id)){
					$content .= $room_id.":房间生成Js3dXml所需图片失败"."\r\n";
					//echojson(1, '','预览图片生成失败！');
				}
			}
			if(file_exists($isexists)){
				if(!$this->createJs3D($room_id)){
					$content .= $room_id.":房间生成Js3dXml失败"."\r\n";
						
				}
			}else{
				$content .= $room_id.":房间生成Js3dXml所需图片不全，生成失败"."\r\n";
			}
			
			$ulr = $upload_url['rs_url'];
			if($content){
				write_dary($content,$ulr);
			}
			
		}
		
		if($result){
			
			$message = '';
			if(isset($result['room'])){
				$room = implode(',',$result['room']);
				$message.=$room.":房间生成失败，请确认你的房间的数据是否上传齐全或全xml是否生成;"."\r\n";
			}
			if(isset($result['scheme'])){
				$scheme = implode(',',$result['scheme']);
				$message.=$scheme.":案例生成失败，请确认你的案例的数据是否上传齐全或全xml是否生成;"."\r\n";
			}
			if(isset($result['diy'])){
				$diy = implode(',',$result['diy']);
				$message.=$diy.":DIY案例生成失败，请确认你的DIY案例的数据是否上传齐全或全xml是否生成;"."\r\n";
			}
			
			$ulr = $upload_url['rs_url'];
			if($message){
				write_dary($message,$ulr);
			}
			
		}else{
			return true;
		}
	}
	

	

}
