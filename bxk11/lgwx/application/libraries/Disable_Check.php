<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("content-Type: text/html; charset=Utf-8");     

/**
 *description:检测敏感词
 *author:yanyalong
 *date:2014/01/16
 */
class DisableCheckFactory{
	public static function createObj(){
		$Disable_Check = new Disable_Check();
		$_POST = $Disable_Check->replaceDisable();
		return $_POST;
	}
}

DisableCheckFactory::createObj();
/**
 *description:检测提交数据是否存在敏感词
 *author:yanyalong
 *date:2014/01/16
 */
Class Disable_Check{
	private $checkFlag;
	private $disableList;
	private $replaceWord;
	public function __construct(){
		$this->CI = &get_instance();
		$this->CI->load->model('t_system_disable_model');
		$this->CI->load->model('t_system_model');
		$this->disableList = $this->disableList(2);
		if($this->disableList!=false){
			foreach($_POST as $key=>$val){
				foreach ($this->disableList as $keys=>$vals) {
					$this->checkFlag = stripos($val,$vals->sdisable_value);
					if($this->checkFlag!=false||$this->checkFlag==0){
						$this->checkFlag=true;
						break;
					}
				}
			}
		}else{
			$this->checkFlag = false;
		}
	}
	/**
	 *description:获取敏感词库
	 *author:yanyalong
	 *date:2014/01/16
	 */
	public function disableList(){
		$sql = "SELECT * FROM t_system_disable where sdisable_type=2";
		return $this->CI->t_system_disable_model->db->query($sql)->result();	
	}
	/**
	 *description:替换敏感词
	 *author:yanyalong
	 *date:2014/01/16
	 */
	public function replaceDisable(){
		if($this->checkFlag==true){
			$this->getReplaceWord();
			$count = count($this->disableList);
			foreach($_POST as $key=>$val){
				foreach ($this->disableList as $keys=>$vals) {
					$val = str_replace($vals->sdisable_value,$this->replaceWord,$val);
				}
				$_POST[$key] = $val;
			}
		}
		return $_POST;
	}
	/**
	 *description:获取替换的单词
	 *author:yanyalong
	 *date:2014/01/16
	 */
	public function getReplaceWord(){
		$res = $this->CI->t_system_model->get("replace_word");
		if($this->replaceWord==false){
			$this->replaceWord="";
		}
		$this->replaceWord =$res->sys_value;
	}
}

