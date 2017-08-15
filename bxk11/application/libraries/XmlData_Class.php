<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @abstract xml与库操作类
 * @author liuguangping
 * @version jia178 1.0 2013-12-10 21:15:00
 *
 */
class XmlData_Class{
	protected $CI;
	protected $t_three_d_config;
	protected $t_three_face;
	protected $threed;
	protected $t_three_info;
	//protected $xmlaction;
	public function __construct(){
	
		$this->CI =& get_instance();
		$this->CI->config->load('threed');
		$this->threed = $this->CI->config->item('bgsound');
/* 		$this->CI->load->library('xmlaction_class');
		$this->xmlaction = $this->CI->xmlaction_class; */
		loadLib("XmlAction_Class");	
		$xmlaction_bak = new XmlAction_Class();
		$this->xmlaction = $xmlaction_bak;
	
		$this->CI->load->model('t_three_d_config_model');
		$this->t_three_d_config = $this->CI->t_three_d_config_model;
		$this->CI->load->helper('file');
		$this->CI->load->model('t_three_face_model');
		$this->t_three_face = $this->CI->t_three_face_model;
		$this->CI->load->model('t_three_info_model');
		$this->t_three_info = $this->CI->t_three_info_model;
	}
	

	//生成预览xml模板(己删除)
	public function createPreviewNode($xmlPath){
		$this->CI->config->load('threed');
		$control = $this->CI->config->item('control');
		$this->xmlaction->createSon('env','');
		$this->xmlaction->createSon('vr','');
		$this->xmlaction->createSon('ui','');
		$this->xmlaction->appendChild_node('env','type','cube','');
		$this->xmlaction->appendChild_node('env','autoRotateStart','false','');
		$this->xmlaction->appendChild_node('env','rate','1','');
		$this->xmlaction->appendChild_node('env','dragRate','1','');
		$this->xmlaction->appendChild_node('env','transition','camera','');
		$this->xmlaction->createsonNode('ui','control');
		$this->xmlaction->createsonNode('vr','pano');
		$vr_array = array('width'=>'100%','height'=>'100%','x'=>0,'y'=>0);
		$this->xmlaction->setNodeAttr('vr',$vr_array);

		
		$control_array = array('file'=>$control['swf_path'].'control4.swf','x'=>'50%','y'=>"95%");
		$this->xmlaction->setNodeAttr('control',$control_array);
		$xmlData = $this->xmlaction->getXML();
		if($xmlData){
			if(write_file($xmlPath, $xmlData)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}	
	
	//生成全局配置
	public function createGlobalNode($xmlPath){
		$global_threed = $this->t_three_d_config->get_all();
		$global_threedrow = $global_threed[0];
		//print_r($global_threedrow);die;
		$this->xmlaction->createSon('env','');
		$this->xmlaction->createSon('vr','');
		$this->xmlaction->createSon('ui','');
		
		
		$this->xmlaction->appendChild_node('env','type',$global_threedrow->type,'');
		if($global_threedrow->autoRotateStart == '1'){
			$this->xmlaction->appendChild_node('env','autoRotateStart','true','');
		}else{
			$this->xmlaction->appendChild_node('env','autoRotateStart','false','');
		}
		if($global_threedrow->autoRotateOnIdle == '1'){
			$this->xmlaction->appendChild_node('env','autoRotateOnIdle','true','');
		}else{
			$this->xmlaction->appendChild_node('env','autoRotateOnIdle','false','');
		}
		
		$this->xmlaction->appendChild_node('env','autoRotateDelay',$global_threedrow->autoRotateDelay,'');
		$this->xmlaction->appendChild_node('env','rate',$global_threedrow->rate,'');
		$this->xmlaction->appendChild_node('env','dragRate',$global_threedrow->dragRate,'');
		if($global_threedrow->hotspotInfo == '1'){
			$this->xmlaction->appendChild_node('env','hotspotInfo','true','');
		}else{
			$this->xmlaction->appendChild_node('env','hotspotInfo','false','');
		}
		$this->xmlaction->appendChild_node('env','transition','camera','');
		if($global_threedrow->debug == '1'){
			$this->xmlaction->appendChild_node('env','debug','true','');
		}else{
			$this->xmlaction->appendChild_node('env','debug','false','');
		}
		
		if($global_threedrow->isbgsound == '1'){
			if($global_threedrow->bgSound){
				$bgsound = array('file'=>$this->threed['relative_path'].$global_threedrow->bgSound,'loop'=>'true','volume'=>$global_threedrow->bgvolume);
				$this->xmlaction->appendChild_node('env','bgSound','',$bgsound);
			}
		}
		
	
		$vr_array = array('width'=>$global_threedrow->width,'height'=>$global_threedrow->height,'x'=>$global_threedrow->x,'y'=>$global_threedrow->y);
		//设置界面语言
		$language_array = array('fullScreen'=>$global_threedrow->fullScreen,'exitFullScreen'=>$global_threedrow->exitFullScreen,'showMap'=>$global_threedrow->showMap,'hideMap'=>$global_threedrow->hideMap,'showThumb'=>$global_threedrow->showThumb,'hideMap'=>$global_threedrow->hideMap,'hideThumb'=>$global_threedrow->hideThumb,'helpInfo'=>$global_threedrow->helpInfo);
		$this->xmlaction->appendChild_node('ui','language','',$language_array);
		//$this->xmlaction->setNodeAttr('language',$language_array);
		$this->xmlaction->setNodeAttr('vr',$vr_array);
		if($global_threedrow->islogo == 1){
			$face_threed = $this->t_three_face->get_all();
			$face_threedrow = $face_threed[0];
			if($face_threedrow){
				$face_array = array('type'=>'image','action'=>'toURL','target'=>'_blank','file'=>$this->threed['relative_path'].$face_threedrow->file,'x'=>$face_threedrow->x,'y'=>$face_threedrow->y,'url'=>$face_threedrow->url,'width'=>$face_threedrow->width,'height'=>$face_threedrow->height);
				$this->xmlaction->appendChild_node('ui','face','',$face_array);
			}
		}
		
		//信息面板
		if($global_threedrow->isinfo == 1){
			$info_threed = $this->t_three_info->get_all();
			$info_threedrow = $info_threed[0];
			//echo"<pre>";var_dump($info_threedrow);die;
			if($info_threedrow){
				$info_array = array('width'=>$info_threedrow->width,'height'=>$info_threedrow->height,'y'=>$info_threedrow->y,'x'=>$info_threedrow->x,'fontSize'=>$info_threedrow->fontSize,'fontColor'=>$info_threedrow->fontColor);
				$this->xmlaction->appendChild_node('ui','info','',$info_array);
			}
		}
		$xmlData = $this->xmlaction->getXML();
		if($xmlData){
			if(write_file($xmlPath, $xmlData)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		
		
	}
	//生成全局js配置
	public function createGlobalJsNode($xmlPath,$Data=''){

		$xmlData = <<<EOT
<?xml version="1.0" encoding="UTF-8"?>
<panorama id="" hideabout="1">
  <view fovmode="0" pannorth="0">
    <start pan="5.5" fov="80" tilt="1.5"/>
    <min pan="0" fov="80" tilt="-90"/>
    <max pan="360" fov="80" tilt="90"/>
  </view>
  <userdata title="" datetime="2013:05:23 21:01:02" description="" copyright="" tags="" author="" source="" comment="" info="" longitude="" latitude=""/>

  <hotspots width="180" height="20" wordwrap="1">
    <label width="180" backgroundalpha="1" enabled="1" height="20" backgroundcolor="0xffffff" bordercolor="0x000000" border="1" textcolor="0x000000" background="1" borderalpha="1" borderradius="1" wordwrap="1" textalpha="1"/>
    <polystyle mode="0" backgroundalpha="0.2509803921568627" backgroundcolor="0x0000ff" bordercolor="0x0000ff" borderalpha="1"/>
  </hotspots>

  <media/>

  <input tile0url="{$Data['jsf']}" prev5url="" prev4url="" prev3url="" prev2url="" prev1url="" prev0url="" tile5url="{$Data['jsd']}" tilesize="700" tile4url="{$Data['jsu']}" tile3url="{$Data['jsl']}" tilescale="1.014285714285714" tile2url="{$Data['jsb']}" tile1url="{$Data['jsr']}"/>

  <autorotate speed="0.200" nodedelay="0.00" startloaded="1" returntohorizon="0.000" delay="5.00"/>


  <control simulatemass="1" lockedmouse="0" lockedkeyboard="0" dblclickfullscreen="0" invertwheel="0" lockedwheel="0" invertcontrol="1" speedwheel="1" sensitivity="8"/>

</panorama>
EOT;
		if(write_file($xmlPath, $xmlData)){
			return true;
		}else{
			return false;
		}
	
	}
	/**
	 * 创建节点 liuguangping
	 * @param String $xmlPath xml路径
	 * @param String $parentName 父节点标识
	 * @param Int $nodeIndex 父节点索引
	 * @param String $sonName 创建的节点
	 * @param Array $attributeArr 创建的节点属性  空则无
	 * @param String $nodeValue 创建的节点内容 如果为空则节点为半闭合状态
	 * @param String $savePath 生成文件保存路径
	 * @return boolean
	 */
	public function create_C_T_M_Node($xmlPath,$parentName,$nodeIndex,$sonName,$attributeArr,$nodeValue='',$savePath){
			$this->xmlaction->appendChild_dest($xmlPath,$parentName,$nodeIndex,$sonName,$attributeArr,$nodeValue);
			$xmlData = $this->xmlaction->getXML();
			if($xmlData){
				if(write_file($savePath, $xmlData)){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
	}
	
	/**
	 * 删除节点 liuguangping
	 * @param String $xmlPath XML文件路径
	 * @param String $parentName 父节点标识
	 * @param Int $nodeIndex 父节点索引
	 * @param String $sonName 删除的子节点标识
	 * @param Int $sonIndex 删除的子节点索引
	 * @param String $savePath 生成文件保存路径
	 * @return boolean
	 */
	public function removeNode($xmlPath,$parentName,$nodeIndex,$sonName,$sonIndex,$savePath){
		$this->xmlaction->removeChilds($xmlPath,$parentName,$nodeIndex,$sonName,$sonIndex);
		$xmlData = $this->xmlaction->getXML();
		if($xmlData){
			if(write_file($savePath, $xmlData)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	/**
	 * 修改属性值 liuguangping
	 * @param String $xmlPath 要修改的xml地址
	 * @param String $nodeName 要修改节点
	 * @param Int $nodeIndex 要修改的节点索引
	 * @param Array $attribute $attributeName 要修改属性名 $newAttrValue 修改的属性值
	 * @param String $savaPath 保存的xml地址
	 * @return boolean
	 */
	public function updataAttributXml($xmlPath,$nodeName,$nodeIndex,$attribute,$savaPath){
		$this->xmlaction->setAttribute($xmlPath,$nodeName,$nodeIndex,$attribute);
		$xmlData = $this->xmlaction->getXML();
		if($xmlData){
			if(write_file($savaPath, $xmlData)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	/**
	 * 向多xml中插入相同节点内容 
	 * @param unknown_type $xmlPath
	 * @param unknown_type $valueArray 
	 * array(
	 * 	"room_id_key"=>
	 * 			array("
	 * 				'name'=>
	 * 			")
	 * 
	 * 
	 * )
	 * @return boolean
	 */
	public function createPano_bak($xmlPath,$parentName,$nodeIndex,$sonName,$nodeValue,$valueArray,$savePath){
		$this->xmlaction->loadXmlFile($xmlPath);
		$node = $this->xmlaction->doc->getElementsByTagName($parentName)->item($nodeIndex);
		foreach ($valueArray as $key=>$attriArray){
			if($nodeValue === ''){
				$chil = $this->xmlaction->doc->createElement($sonName);
			}else{
				$chil = $this->xmlaction->doc->createElement($sonName,$nodeValue);
			}
			
			if(!empty($attriArray)){
				foreach ($attriArray as $key=>$value){
					$att = $this->xmlaction->doc->createAttribute($key);
					$att->value = $value;
					$chil->appendChild($att);
				}
			}
			
			$node->appendChild($chil);
		}
		$xmlData = $this->xmlaction->getXML();
		if($xmlData){
			if(write_file($savePath, $xmlData)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		

	}
	
	
	
	
	 /**
	  * 向多xml中插入相同节点内容
	  * @param Sting $xmlPath 全局xml模板地址
	  * @param Sting $valueArray 要插入元素数组 
	  * 
	  * $valueArray = array(
						array(
								
								"parentName"=>'vr',
								"nodeIndex" =>0,
								 "sonName" =>'pano',
								'sonNodeValue'=>'',
								'valueArray'=>array(array('name'=>'a','file'=>''),array('name'=>'b','file'=>''))	
							),
							
						array(	
								"parentName"=>'map',
								"nodeIndex" =>0,
								 "sonName" =>'floor',
								'sonNodeValue'=>'',
								'valueHot'=>array();
								'valueArray'=>
									array(
									array('title'=>'一楼','file'=>'/threed/global/map1.png','pano'=>'1|2'),
									array('title'=>'一楼','file'=>'/threed/global/map1.png','pano'=>'6|4')
										)
						)
			); 
		
	  * @param String $savePath 保存文件地址
	  * @todo 添加热点 在一级中加入一个valueHot;
	  * @return boolean
	  */
	public function create3DXml($xmlPath,$valueArray,$savePath){
		$this->xmlaction->loadXmlFile($xmlPath);
		foreach ($valueArray as $sonValue){
			
			$node = $this->xmlaction->doc->getElementsByTagName($sonValue['parentName'])->item($sonValue['nodeIndex']);
			//修改父节点的属性值
			if($sonValue['parentName'] == 'vr'){
				$node->setAttribute('startpano',$sonValue['valueArray'][0]['name']);// 可以新建和修改
			}
			
			//valueHot 热点
			if(isset($sonValue['valueHot']) && $sonValue['valueHot']){
				foreach ($sonValue['valueHot'] as $value){
				
				}
			}
			//父级上的属性
			if(isset($sonValue['parentAttri']) && $sonValue['parentAttri']!=''){
				foreach( $sonValue['parentAttri'] as $pkey=>$pvalue){
					$node->setAttribute($pkey,$pvalue);
				}
			}
			foreach ($sonValue['valueArray'] as $attriArray){
				if($sonValue['sonName'] == 'pano')
				$name[] = $attriArray['name'];
				//新建子节点
				if($sonValue['sonNodeValue'] === ''){
					$chil = $this->xmlaction->doc->createElement($sonValue['sonName']);
				}else{
					$chil = $this->xmlaction->doc->createElement($sonValue['sonName'],$sonValue['sonNodeValue']);
				}
				//给子节点加属性
				if(!empty($attriArray)){
					foreach ($attriArray as $key=>$value){
						if($key != "childs"){
							$att = $this->xmlaction->doc->createAttribute($key);
							$att->value = $value;
							$chil->appendChild($att);
						}
					}
				}
				
				//向子级中加入子级 如像pano中加入hotspot
				if(isset($attriArray['childs']) && $attriArray['childs'] != '' && $attriArray['childs'] && !empty($attriArray['childs'])){
					foreach($attriArray['childs'] as $vu){
						//给子节点加属性
						if(!empty($vu['valueArray']) && isset($vu['valueArray'])){
							foreach ($vu['valueArray'] as $keys=>$values){
								if($vu['sonNodeValue'] === ''){
									$chilchil = $this->xmlaction->doc->createElement($vu['sonName']);
								}else{
									$chilchil = $this->xmlaction->doc->createElement($vu['sonName'],$vu['sonNodeValue']);
								}
								if(!empty($vu['valueArray']) && isset($vu['valueArray'])){
									foreach($values as $keyss=>$valuess){
										$chilchil->setAttribute($keyss,$valuess);
									}
								}
								//向子级中加入一个子级
								$chil->appendChild($chilchil);
								//$values
								
							}
						}
						
					}
					
				}
				
				$node->appendChild($chil);//把内存的xml数据全部加入进来
			}
		}
		//自动播放全景列表
		$playList = implode('|',$name);

		if(count($name)>0){
			$oChild =  $this->xmlaction->doc->getElementsByTagName('env')->item(0);
			$son =  $this->xmlaction->doc -> createElement('playList',$playList);//新建节点
			$oChild->appendChild($son);
		}
		$xmlData = $this->xmlaction->getXML();
		if($xmlData){
			if(write_file($savePath, $xmlData)){
				
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	
	
	}
	

}
