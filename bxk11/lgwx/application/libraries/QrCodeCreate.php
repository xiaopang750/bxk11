<?php

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        liuguangpingAuthor: 服务商管理
 *        Email: liuguangpingtest@163.com

 */

//namespace Endroid\Tests\QrCode;
//include $_SERVER['DOCUMENT_ROOT']."/studytest/qrcode/src/Endroid/QrCode/QrCode.php";
include __DIR__."/./qrcode/src/Endroid/QrCode/QrCode.php";
//use Endroid\QrCode\QrCode;

class QrCodeCreate{

	public $text='';
	public $size = 300;
	public $padding = 16;
	public $errorCorrection = 0;
	public $moduleSize = 4;
	public $backgroundColor = array('r' => 0, 'g' => 0, 'b' => 0);
	public $foregroundColor = array('r' => 255, 'g' => 255, 'b' => 255);
	public $version = 0;
	public $saveUrl;
	public $type = false; //true 生成中心图片
	private $qrCode;
	public $centerPic;//中心图片

	public function __construct(){
		$this->qrCode = new QrCode();
	}
	/**
	  * 
	  *$this->qrCode = new QrCode();
      *$this->qrCode->setText("Life is too short to be generating QR codes");
      *$this->qrCode->setSize(300);
      *$this->qrCode->create();
      *$this->assertTrue(true);
     */
    public function createQrCode(){//echo $this->saveUrl;die;
		
		$this->qrCode->setText($this->text);
		$this->qrCode->setSize($this->size); //大小
		$this->qrCode->setPadding($this->padding); //边框白色
		$this->qrCode->setErrorCorrection($this->errorCorrection);// 错误处理级别：L 1、M 0 、Q 3 、H 2
		$this->qrCode->setModuleSize($this->backgroundColor); 
		$this->qrCode->setBackgroundColor(array('r' => 0, 'g' => 0, 'b' => 0));
		$this->qrCode->setForegroundColor($this->foregroundColor);
		$this->qrCode->setVersion($this->version); //版本 黑点出现密集度
		$this->qrCode->render($this->saveUrl);

		//生成中心图片
		if($this->type){
			if( $this->saveUrl && file_exists($this->saveUrl)){
				$headlogo = $_SERVER['DOCUMENT_ROOT']."/lgwx/static/system/lgwx/person.png";
				$bklogo = $_SERVER['DOCUMENT_ROOT']."/lgwx/static/system/lgwx/bk.png";
				$QR = imagecreatefrompng($this->saveUrl);//外面那QR图
				$logo = $this->centerPic ? $this->centerPic : $headlogo;//中间那logo图
				if ($logo !== FALSE) {
				  $bk = imagecreatefromstring(file_get_contents($bklogo));
				  $logo = imagecreatefromstring(file_get_contents($logo));
				  //$bk = imagecreatefromstring(file_get_contents($logo));
				  $QR_width = imagesx($QR);
				  $QR_height = imagesy($QR);

				  $bk_width = imagesx($bk);
				  $bk_height = imagesy($bk);

				  $logo_width = imagesx($logo);
				  $logo_height = imagesy($logo);
				  $logo_width = imagesx($logo);
				  $logo_height = imagesy($logo);
				  $logo_qr_width = $QR_width/5;
				  $scale = $logo_width/$logo_qr_width;
				  $logo_qr_height = $logo_height/$scale;
				  $from_width = ($QR_width-$logo_qr_width)/2;
				  $col_ellipse = imagecolorallocate($QR, 0, 0, 0);
				  //边框
				  imagecopyresampled($QR, $bk, $from_width-2.5, $from_width-2.5, 0, 0, $logo_qr_width+8, $logo_qr_height+8, $bk_width, $bk_height);
				  imagepng($QR,$this->saveUrl);
				  imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
				}
				imagepng($QR,$this->saveUrl);
				imagedestroy($QR);
			}
		
		}

    }
}

