<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @abstract xml操作类
 * @author liuguangping
 * @version jia178 1.0 2013-12-10 21:15:00
 *
 */
class XmlAction_Class{
	public $doc;
	public $rootKey;
	public $status;
	public function  __construct() {
		$this->doc = new DOMDocument('1.0', 'utf-8');
		$this->doc -> formatOutput = true;
		$this->status = $this->doc -> createElement('rmpano');//create new key
		$this->rootKey = $this->status;
		$this->doc->appendChild($this->status);
	}

	public function createSon($sonName, $value){
		$this->deleteChild($sonName);
		$sonKey = $this->doc -> createElement($sonName);//新建节点
		$content = $this->doc -> createTextNode($value);//节点值
		$sonKey -> appendChild($content);
		$this->rootKey->appendChild($sonKey);
	}
	public function appendNodeValue($tagName, $appendValue){
		if(!$this->hasNodeName($tagName)){
			$this->createSon($tagName, '');
		}
		$this->rootKey->getElementsByTagName($tagName)->item(0)->nodeValue .= "\n".$appendValue;
	}
	/**
	 * 向缓存文件中写入
	 * @param string $tagName 
	 * @param string $node
	 * @param string $nodeValue
	 */
	public function appendChild_node($tagName,$node,$nodeValue,$attributeArr){
		$oChild = $this->rootKey->getElementsByTagName($tagName)->item(0);
		$sonKey = $this->doc -> createElement($node);//新建节点
		if($nodeValue !== ''){
			$content = $this->doc -> createTextNode($nodeValue);//节点值
			$sonKey -> appendChild($content);
		}
		if($attributeArr){
			foreach ($attributeArr as $key=>$value){
				$att = $this->doc->createAttribute($key);
				$att->value = $value;
				$sonKey->appendChild($att);
			}
		}
		$oChild->appendChild($sonKey);
		
	}
	
	public function setNodeAttr($tagName,$attributeArr){
		$oChild = $this->rootKey->getElementsByTagName($tagName)->item(0);
		if($attributeArr){
			foreach ($attributeArr as $key=>$value){
				$att = $this->doc->createAttribute($key);
				$att->value = $value;
				$oChild->appendChild($att);
			}
		}
	}
	//不用打开xml时加入儿子节点
	public function createsonNode($parentNode,$sonNode){
		$oChild = $this->rootKey->getElementsByTagName($parentNode)->item(0);
		$son = $this->doc -> createElement($sonNode);//新建节点
		$oChild->appendChild($son);
	}
	
	
	public function editNodevalue($tagName, $value){
		if(!$this->hasNodeName($tagName)){
			$this->createSon($tagName, '');
		}
		$this->rootKey->getElementsByTagName($tagName)->item(0)->nodeValue = $value;
	}
	public function deleteChild($tagName){
		if($this->hasNodeName($tagName))
			$this->rootKey -> removeChild($this->rootKey->getElementsByTagName($tagName)->item(0));
	}
	private function hasNodeName($tagName){
		$hasNode = false;
		$tempList = $this->doc->getElementsByTagName($tagName);
		foreach($tempList as $temp){
			if($temp->nodeName == $tagName)
				$hasNode = true;
		}
		return $hasNode;
	}
	public function loadXmlFile($xmlPath){
		return $this->doc->load($xmlPath);
	}
	
	/**
	 * 创建节点 liuguangping
	 * @param String $xmlPath xml路径
	 * @param String $parentName 父节点标识
	 * @param Int $nodeIndex 父节点索引
	 * @param String $sonName 创建的节点
	 * @param Array $attributeArr 创建的节点属性  空则无
	 * @param String $nodeValue 创建的节点内容 如果为空则节点为半闭合状态
	 * @return boolean
	 */
	public function appendChild_dest($xmlPath,$parentName,$nodeIndex,$sonName,$attributeArr,$nodeValue){
		$this->loadXmlFile($xmlPath);
		$node = $this->doc->getElementsByTagName($parentName)->item($nodeIndex);
		if($nodeValue === ''){
			$chil = $this->doc->createElement($sonName);
		}else{
			$chil = $this->doc->createElement($sonName,$nodeValue);
		}
		
		foreach ($attributeArr as $key=>$value){
			$att = $this->doc->createAttribute($key);
			$att->value = $value;
			$chil->appendChild($att);
		}

		$node->appendChild($chil);
	}
	
	/**
	 * 删除节点 liuguangping
	 * @param String $xmlPath XML文件路径
	 * @param String $parentName 父节点标识
	 * @param Int $nodeIndex 父节点索引
	 * @param String $sonName 删除的子节点标识
	 * @param Int $sonIndex 删除的子节点索引
	 * @return boolean
	 */
	public function removeChilds($xmlPath,$parentName,$nodeIndex,$sonName,$sonIndex){
		
		$node = $this->doc->getElementsByTagName($parentName)->item($nodeIndex);
		$sonNameObj = $this->doc->getElementsByTagName($sonName)->item($sonIndex);
		$node-> removeChild($sonNameObj);
		
	}
	/**
	 * 删除父节点 
	 * @param String $xmlPath 保存路径
	 * @param String $parentName 父节点名称
	 * @param Int $nodeIndex 父节点索引
	 * @return boolean
	 */
	public function removeParent($xmlPath,$parentName,$nodeIndex){
		//$this->loadXmlFile($xmlPath);
		$node = $this->doc->getElementsByTagName($parentName)->item($nodeIndex);
		$node->parentNode->removeChild($node);
		$xmlData = $this->doc->saveXML();
		if($xmlData){
			if(write_file($xmlPath, $xmlData)){
				return true;
			}else {
				return false;
			}
		}else{
			return false;
		}
	}
	/**
	 * chil 插入到before之前  liuguangping
	 * @param String $xmlPath xml路径
	 * @param String $parentName 父节点标识
	 * @param Int $nodeIndex 父节点索引
	 * @param String $sonName 插入节点
	 * @param String $nodeValue 插入的节点内容
	 * @param String $beforeNode 被插入的节点标识
	 * @param Array $attributeArr 插入的属性
	 */
	public function insertBefore_dest($xmlPath,$parentName,$nodeIndex,$sonName,$nodeValue,$beforeNode,$attributeArr){
		$this->loadXmlFile($xmlPath);
		$node = $this->doc->getElementsByTagName($parentName)->item($nodeIndex);
		$before = $this->doc->getElementsByTagName($beforeNode)->item(0);
		if($nodeValue === ''){
			$chil = $this->doc->createElement($sonName);
		}else{
			$chil = $this->doc->createElement($sonName,$nodeValue);
		}
		
		foreach ($attributeArr as $key=>$value){
			$att = $this->doc->createAttribute($key);
			$att->value = $value;
			$chil->appendChild($att);//chil 插入到before之前
		}
	
		$node->insertBefore($chil,$before);
	}
	/**
	 * 替换节点 liuguangping chil节点 替换原有replace节点
	 * @param String $xmlPath xml路径
	 * @param String $parentName 父节点标识
	 * @param Int $nodeIndex 父节点索引
	 * @param String $sonName 替换节点 
	 * @param String $nodeValue 替换的节点内容
	 * @param String $replaceNode 被替换节点
	 * @param Array $attributeArr 替换节点属性
	 */
	public function replaceChild_dest($xmlPath,$parentName,$nodeIndex,$sonName,$nodeValue,$replaceNode,$attributeArr){
		$this->loadXmlFile($xmlPath);
		$node = $this->doc->getElementsByTagName($parentName)->item($nodeIndex);
		$replace = $this->doc->getElementsByTagName($replaceNode)->item(0);
		if($nodeValue === ''){
			$chil = $this->doc->createElement($sonName);
		}else{
			$chil = $this->doc->createElement($sonName,$nodeValue);
		}
	
		foreach ($attributeArr as $key=>$value){
			$att = $this->doc->createAttribute($key);
			$att->value = $value;
			$chil->appendChild($att);//chil 替换原有replace
		}
	
		$node->replaceChild($chil,$replace);
	}
	/**
	 * 获取节点行数
	 * @param String $xmlPath xml路径
	 * @param String $node 节点标识
	 * @param Int $noIndex 节点索引
	 * @return number
	 */
	public function getLineNo_dest($xmlPath,$node,$noIndex){
		$this->loadXmlFile($xmlPath);
		return $this->doc->getElementsByTagName($node)->item($noIndex)->getLineNo();
	}
	/**
	 * xml文件属性修改
	 * @param String $xmlPath 修改的xml路径
	 * @param String $nodeName 修改的节点标识
	 * @param Int $nodeIndex 修改的节点索引
	 * @param Array $attribute $attributeName 要修改属性名 $newAttrValue 修改的属性值

	 */
	public function setAttribute($xmlPath,$nodeName,$nodeIndex,$attribute){		
		$this->loadXmlFile($xmlPath);
		$node = $this->doc->getElementsByTagName($nodeName)->item($nodeIndex);
		foreach($attribute as $attributeName=>$newAttrValue){
			$node->setAttribute($attributeName,$newAttrValue);
		}

	
	}
	public function setNodesByArray($xmlArray){
		$now = getdate(time());
		$dataCreated = $now['year'].'/'.$now['mon'].'/'.$now['mday'].' '.$now['hours'].':'.$now['minutes'].':'.$now['seconds'];
		$this->createSon('language', strtolower($xmlArray['basicInfo']['language']));
		$this->createSon('source', $xmlArray['basicInfo']['source']);
		$this->createSon('resumeUrl', $xmlArray['basicInfo']['resumeUrl']);
		$this->createSon('email', $xmlArray['basicInfo']['email']);
		$this->createSon('resumeGuid', $xmlArray['basicInfo']['resumeGuid']);
		$this->createSon('dateCreated', $dataCreated);
		$this->createSon('success','TRUE');
	}
	public function getXML(){
		return $this->doc->saveXML();
	}
}
