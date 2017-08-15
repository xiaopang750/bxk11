<?php
/**
 *description:用户信息
 *author:yanyalong
 *date:2013/11/05
 */
class Content extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:灵感博文详情加载页
	 *author:yanyalong
	 *date:2013/11/06
	 */
	public function designinfo(){
		safeFilter();
		$content_id= isset($_GET['cid'])?$this->input->get('cid'):"";
		$res = model("t_content")->get($content_id);
		if($res!=false){
			$data['title'] = $res->content_title;
		}else{
			$data['title'] = "不存在的灵感博文";
		}
		$data['config']	= $this->myinfo();
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['designinfo'],$data);	
	}
	/**
	 *description:家居美图详情加载页
	 *author:yanyalong
	 *date:2013/11/07
	 */
	public function productinfo(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['productinfo']);	
	}
	/**
	 *description:我的喜欢(家居美图)
	 *author:yanyalong
	 *date:2013/11/12
	 */
	public function likeproduct(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['likeproduct']);	
	}
	/**
	 *description:我的喜欢(灵感博文)
	 *author:yanyalong
	 *date:2013/11/12
	 */
	public function likedesign(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['likedesign']);	
	}

	/**
	 *description:我的喜欢(装修问题)
	 *author:yanyalong
	 *date:2013/11/12
	 */
	public function likequestion(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['likequestion']);	
	}
}

