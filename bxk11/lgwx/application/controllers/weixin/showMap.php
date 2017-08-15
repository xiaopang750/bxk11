<?php

class ShowMap extends CI_Controller{

	private $weixin_reply;
	private $weixinReply;
	private $service_shop;
	private $service_info;
	private $service_information;
	public function __construct(){

		parent::__construct();
		$this->load->helper('url');
		//$this->load->model('t_service_lbs_reply_model');
		//$this->weixin_reply = $this->t_service_lbs_reply_model;
		$this->load->model('t_service_weixin_reply_model');
		$this->weixinReply = $this->t_service_weixin_reply_model;
		$this->load->model('t_service_shop_model');
		$this->service_shop = $this->t_service_shop_model;
		$this->load->model('t_service_info_model');
		$this->service_info = $this->t_service_info_model;
		$this->load->model('t_service_information_model');
		$this->service_information = $this->t_service_information_model;
	}

	public function index(){

	}

	/**
	 * 显示图片
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function showInfo(){
		 safeFilter();
		 $lbs_id = $this->input->get('lbs_id');
		 $result = $this->weixin_reply->get($lbs_id);
		 $data['lbs_id'] = $result->lbs_id;
		 $data['lbs_name'] = $result->lbs_name;
		 $data['lbs_address'] = $result->lbs_address;
		 $data['lbs_phone'] = $result->lbs_phone;
		 $data['lbs_content'] = htmlspecialchars_decode($result->lbs_content);
		 if(stripos($result->lbs_logourl, 'http://') === false)
			$picurl = "http://".$result->lbs_logourl;
		 else
			$picurl = $result->lbs_logourl;
		 $data['lbs_logourl'] = $picurl;
		 $x = $this->input->get('x');
		 $y = $this->input->get('y');
		 $ak = $this->input->get('ak');
		 $data['lbs_longitude'] = $result->lbs_longitude;
		 $data['lbs_latitude'] = $result->lbs_latitude;
		 $data['map_url'] = site_url('weixin/showMap/show')."?x=".$x."&y=".$y."&lbs_longitude=".$data['lbs_longitude']."&lbs_latitude=".$data['lbs_latitude']."&ak=".$ak;
		 //$data['mapUrl'] = "http://api.map.baidu.com/staticimage?center=".$result->lbs_longitude.",".$result->lbs_latitude."&markers=".$result->lbs_longitude.",".$result->lbs_latitude."&width=1024&height=200&zoom=11";
		 $this->load->view('weixin/showInfo',$data);
	}

	/**
	 * 显示地图
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function show(){
		 safeFilter();
		 $data['x'] = $this->input->get('x');
		 $data['y'] = $this->input->get('y');
		 $data['lbs_longitude'] = $this->input->get('lbs_longitude');
		 $data['lbs_latitude'] = $this->input->get('lbs_latitude');
		 $data['ak'] = $this->input->get('ak');
		 $this->load->view('weixin/show',$data);
	}

	/**
	 * 显示图文详细信息
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function showImgReply(){
		safeFilter();
		$reply_id = $this->input->get('reply_id');
		$appid = $this->input->get('appid');
		$username = $this->input->get('username');
		$result = $this->weixinReply->get($reply_id);
		$data['reply_id'] = $result->reply_id;
		$data['appid'] = $appid;
		$data['reply_keyword'] = $result->reply_keyword;
		$data['reply_title'] = $result->reply_title;
		$data['reply_desc'] = $result->reply_desc;
		if(stripos($result->reply_top_pic, 'http://') === false)
			$picurl = "http://".$result->reply_top_pic;
		 else
			$picurl = $result->reply_top_pic;
		$data['reply_top_pic'] = $picurl;
		$data['reply_content'] = htmlspecialchars_decode($result->reply_content);
		$data['username'] = $username;
		$data['url_reply'] = site_url('weixin/showMap/showImgReply')."?reply_id=".$reply_id.'&appid='.$appid."&username=".$username;
		$this->load->view('weixin/showImgReply',$data);
	}

	/**
	 * 显示资讯
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function showInformation(){
		safeFilter();
		$si_id = $this->input->get('si_id');
		$appid = $this->input->get('appid');
		$username = $this->input->get('username');
		$result = $this->service_information->get($si_id);
		$data['si_id'] = $result->si_id;
		$data['appid'] = $appid;
		$data['si_desc'] = $result->si_desc;
		$data['si_title'] = $result->si_title;
		if(stripos($result->si_pic, 'http://') === false)
			$picurl = "http://".$result->si_pic;
		 else
			$picurl = $result->si_pic;
		$data['si_pic'] = $picurl;
		$data['si_content'] = htmlspecialchars_decode($result->si_content);
		$data['si_addtime'] = date("Y-m-d",strtotime($result->si_addtime));
		$data['si_keyword'] = $result->si_keyword;
		$data['username'] = $username;
		$data['url_reply'] = site_url('weixin/showMap/showInformation')."?si_id=".$si_id.'&appid='.$appid."&username=".$username;
		$this->load->view('weixin/showInformation',$data);
	}

	/**
	 * 显示门店信息
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function showShopInfo(){
		 safeFilter();
		 $shop_id = $this->input->get('shop_id');
		 $result = $this->service_shop->get($shop_id);
		 $service_info = $this->service_info->get($result->service_id);
		 $data['lbs_id'] = $result->shop_id;
		 $data['lbs_name'] = $result->shop_name;
		 $data['lbs_address'] = $result->shop_address;
		 $data['lbs_phone'] = $service_info->service_phone;
		 $data['lbs_content'] = htmlspecialchars_decode($result->shop_explain);
		 $this->config->load('uploads');
		 $config = $this->config->item('serviceShop');
		 if(!$result->shop_logo){
		  	$result->shop_logo = $config['relative_upload'].$result->shop_pic1;
		 }
		 $shopLogo = $_SERVER['HTTP_HOST'].$result->shop_logo;
		 if(stripos($shopLogo, 'http://') === false)
			$picurl = "http://".$shopLogo;
		 else
			$picurl = $shopLogo;
		 $data['lbs_logourl'] = $picurl;
		 $x = $this->input->get('x');
		 $y = $this->input->get('y');
		 $ak = $this->input->get('ak');
		 $data['lbs_longitude'] = $result->shop_longitude;
		 $data['lbs_latitude'] = $result->shop_latitude;
		 $data['map_url'] = site_url('weixin/showMap/show')."?x=".$x."&y=".$y."&lbs_longitude=".$data['lbs_longitude']."&lbs_latitude=".$data['lbs_latitude']."&ak=".$ak;
		 //$data['mapUrl'] = "http://api.map.baidu.com/staticimage?center=".$result->lbs_longitude.",".$result->lbs_latitude."&markers=".$result->lbs_longitude.",".$result->lbs_latitude."&width=1024&height=200&zoom=11";
		 $this->load->view('weixin/showInfo',$data);
	}

}