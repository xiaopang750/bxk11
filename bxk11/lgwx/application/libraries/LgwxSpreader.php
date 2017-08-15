<?php

/**
 * 灵感无限推广操作类
 * @author liuguangping
 * @version 1.0 2014/4/23
*/
class LgwxSpreader{

	const LGWX_REG_URL = "/lgwx/index.php/reg/index";
	// 以下是定义model属性
	public $openid; //微信公众openid
	private $CI;
	public $ss_phone;//推广者手机号
	public $nickname;
	public $service_id;
	public $spreader_code;
	public $ss_type;
	private $spreader;
	private $service_info;
	private $spreader_rebate;//自助平台推广返利表
	private $spreader_rebate_record;//自助平台推广返利记录表
	private $qrCode;

	public function __construct(){

		$this->CI = &get_instance();
		$this->CI->load->model('t_service_spreader_model');
		$this->CI->load->model('t_service_info_model');
		$this->CI->load->model('t_service_spreader_rebate_model');
		$this->CI->load->model('t_service_spreader_rebate_record_model');
		loadLib('QrCodeCreate');
		$this->qrCode = new QrCodeCreate();
		
		$this->CI->load->helper('import_excel');
		$this->CI->load->helper('url');
		$this->spreader = $this->CI->t_service_spreader_model;
		$this->service_info = $this->CI->t_service_info_model;
		$this->spreader_rebate = $this->CI->t_service_spreader_rebate_model;
		$this->spreader_rebate_record = $this->CI->t_service_spreader_rebate_record_model;
	}

	public function index(){
		
	}

	/**
	 * 根据条件 插入数据到推广联盟表中
	 * @author liuguangping
	 * @version 1.0 2014/6/9
	 * @return Array
	 *
	*/
	public function insertSpreader(){

		if($this->openid && $this->ss_phone && $this->nickname){
			$spreader_code = md5($this->openid);
			$where['spreader_code'] = $spreader_code;
			$where['ss_status'] = 1;
			if($this->spreader->getOne('ss_id',$where)){
				return $this->setMessage('1','','已经是推广者了，无需重复申请');
			}else{

				$this->spreader->spreader_code = $spreader_code;
				$this->spreader->ss_name = $this->nickname;
				$this->spreader->ss_phone = $this->ss_phone;
				$this->spreader->ss_clicks = 0;
				$this->spreader->ss_certifieds = 0;
				$this->spreader->ss_regs = 0;
				$this->spreader->ss_join_time = date('Y-m-d H:i:s');
				$this->spreader->ss_service_reg_time = '';
				$this->spreader->ss_type = $this->ss_type;
				$this->spreader->ss_status = 1;
				$this->spreader->ss_desc = '';
				$this->spreader->open_id = $this->openid;

				if($this->ss_type == 2){
					$this->spreader->open_id = '';
				}

				$this->spreader->ss_qr = '';
				if($insert_id = $this->spreader->insert()){
					$data = $_SERVER['HTTP_HOST'].self::LGWX_REG_URL."?flg=".$spreader_code;
					if(stripos($data, 'http://') === FALSE)
						$data = "http://".$data;
					$this->qrCode->text = $data;
					$config = C('uploads','serviceQr');
					$this->qrCode->size = $config['size'];
					$url = $config['upload_path'];
					if(!mkdirs($url)){ $this->spreader->delete($insert_id); return $this->setMessage('3',$data,'申请成功,生成二维码失败！');}
					$this->qrCode->saveUrl = $url.$config['file_name'];

					$this->qrCode->createQrCode();
					if(file_exists($this->qrCode->saveUrl)){
						$datas['ss_qr'] = $config['file_name'];
						$where['ss_id'] = $insert_id;
						$this->spreader->updates_global($datas,$where);
						$array['text_url'] = $data;
						$qr_url = $_SERVER['HTTP_HOST'].$config['relative_upload'].$datas['ss_qr'];
						if(stripos($qr_url, 'http://') === FALSE)
							$qr_url = "http://".$qr_url;
						$array['qr_url'] = $qr_url;
						return $this->setMessage('0',$array,'申请成功');
					}else {
						$this->spreader->delete($insert_id);
						return $this->setMessage('4',$data,'申请成功,生成二维码失败！');
					}
						
				}else{
					return $this->setMessage('2',$insert_id,'申请失败,重新输入sqtg+手机号码');
				}
			}

		}
	}

	/**
	 * 根据条件 更新推广联盟表中增量
	 * @author liuguangping
	 * @version 1.0 2014/6/9
	 * @return Boolean
	 *
	*/

	 public function setIncrease($spreader_code,$field='ss_clicks',$type='up'){
      
        $updateFlag = $this->spreader->setIncrease($spreader_code,$field,$type);

        return ($updateFlag)?true:false;
    }


   /**
	 * 根据条件 推广注册成功后的逻辑
	 * @author liuguangping
	 * @version 1.0 2014/6/10
	 * @param status 状态 data 数据 mes 提示信息
	 * @return Boolean
	 *
	*/
	public function setRegConsole(){

		$spreader_code = $this->spreader_code;
		$service_id = $this->service_id;
		$ss_type = $this->ss_type;
		
		//第一步事务
		$this->spreaderOne($spreader_code);
		//第二步事务
		$this->spreaderTwo($spreader_code,$service_id,$ss_type);
		
	}

	/**
	 * 根据条件 推广注册成功后的事务一
	 * @author liuguangping
	 * @version 1.0 2014/6/10
	 * @return Boolean
	 *
	*/
	public function spreaderOne($spreader_code){
		//更新推广联盟表数据的推广注册成功数,如果是初次注册，更新被推广用户首次注册时间
		$where['spreader_code'] = $spreader_code;
		$where['ss_status'] = 1;
		if($rowR = $this->spreader->getOne('ss_regs',$where)){
			$this->setIncrease($spreader_code,'ss_regs','up');
			if($rowR->ss_regs <= 0){
				$datas['ss_service_reg_time'] = date('Y-m-d H:i:s');
				$this->spreader->updates_global($datas,$where);
			}
		}
	}

	/**
	 * 根据条件 推广注册成功后的事务二
	 * @author liuguangping
	 * @version 1.0 2014/6/10
	 * @return Boolean
	 *
	*/
	public function spreaderTwo($spreader_code,$service_id,$ss_type){
		// 更新服务商信息表中的注册来源推广者标识字段，并根据推广返利表中的推广类型字段的值插入一条数据到返利记录表中
		$data['spreader_code_source'] = $spreader_code;
		$map['service_id'] = $service_id;
		$this->service_info->updates_global($data,$map);

		$this->spreader_rebate_record->service_id = $service_id;
		$this->spreader_rebate_record->ss_type = $ss_type;
		$this->spreader_rebate_record->spreader_code = $spreader_code;
		$this->spreader_rebate_record->rr_card_number = '';
		$this->spreader_rebate_record->rr_grant_time = '';

		if($ss_type == 1){//微信,则是返金钱
			$where['ss_type'] = 1;
		}else{ //商户,则是积分
			$where['ss_type'] = 2;
		}
		$where['sr_status'] = 1;
		$rowR = $this->spreader_rebate->getOne('*',$where);

		if($rowR){
			$this->spreader_rebate_record->rr_amount = $rowR->sr_amount;
			$insert_id = $this->spreader_rebate_record->insert();
		}
	}

	/**
	 * 根据条件 插入数据到推广联盟表中
	 * @author liuguangping
	 * @version 1.0 2014/6/9
	 * @param status 状态 data 数据 mes 提示信息
	 * @return Boolean
	 *
	*/
	public function setMessage($status,$data,$mes){
		$array['status'] = $status;
		$array['data'] = $data;
		$array['mes'] = $mes;
		return $array;
	}

	/**
	 * 根据条件 获取推广访谈录表中数据
	 * @author liuguangping
	 * @version 1.0 2014/6/9
	 * @param status 状态 data 数据 mes 提示信息
	 * @return Boolean
	 *
	*/
	public function getSprReRe(){

		$spreader_code = md5($this->openid);
		$map['spreader_code'] = $spreader_code;
		$map['ss_status'] = 1;
		if(!$this->spreader->getOne("*",$map)){
			return $this->setMessage('1','','您还没有成为推广者，请点击我要推广');
		}

		$dates = date("Y-m-d H:i:s",time()-3600*24*30);
		$resulut = array();
		$array = $this->spreader_rebate_record->getSprReRe($dates,$spreader_code);

		/*foreach ($array as $ky=>$vl){

			$imagArr['Title'] = '发卡时间：'.$vl->rr_grant_time.',充值卡号:'.$vl->rr_card_number;

			$imagArr['Description'] = '发卡时间：'.$vl->rr_grant_time.',充值卡号:'.$vl->rr_card_number;
			if(stripos($_SERVER['HTTP_HOST'],'http://') === false)
				$url = "http://".$_SERVER['HTTP_HOST']."/uploads/service/qr/default/default.jpg";
			else
				$url = $_SERVER['HTTP_HOST']."/uploads/service/qr/default/default.jpg";
			$imagArr['PicUrl'] = $url;
			$imagArr['Url'] = '';

			$resulut[] = $imagArr;
   		}*/
	   	if($array){

	   		$imagArr['Title'] = "返利记录";
			$imagArr['Description'] = "系统查询到您的".count($array)."条推广成功记录";
			if(stripos($_SERVER['HTTP_HOST'],'http://') === false)
				$url = "http://".$_SERVER['HTTP_HOST']."/uploads/service/qr/default/default.jpg";
			else
				$url = $_SERVER['HTTP_HOST']."/uploads/service/qr/default/default.jpg";
			$imagArr['PicUrl'] = $url;
			$imagArr['Url'] = site_url('weixin/showSpreader/showSpreaderReply')."?spreader_code=".$spreader_code;
			$resulut[] = $imagArr;
			return $this->setMessage('0',$resulut,'查询成功');
	   	}else{
			return $this->setMessage('2','','还没有人分享注册，请分享吧！');
	   	}
   
	}

	/**
	 * 根据条件 服务商logo qr
	 * @author liuguangping
	 * @version 1.0 2014/6/9
	 * @param text 内容 service_id 服务商id type 是否生成中心图 centerPic 中心图片地址
	 * @return Boolean
	 *
	*/
	public function createServiceQrCode($text,$service_id,$type=false,$centerPic=false){

		$this->qrCode->text = $text;
		$this->qrCode->type = $type;
		$this->qrCode->centerPic = $centerPic;
		$config = C('uploads','serviceLogoQr');
		$this->qrCode->size = $config['size'];
		$time = date('Y/m/d/');
		$url = $config['upload_path'].$time;
		if(!mkdirs($url)) return false;
		$this->qrCode->saveUrl = $url.$config['file_name'];

		$this->qrCode->createQrCode();
		if(file_exists($this->qrCode->saveUrl)){
			$where['service_id'] = $service_id;
			$datas['service_qr'] = $config['relative_upload'].$time.$config['file_name'];
			if(model('t_service_info')->updates_global($datas,$where)){
				return $datas['service_qr'];
			}else{
				@unlink($this->qrCode->saveUrl);
				return false;
			}
		}else {
			return false;
		}
	}
}