<?php
/**
 *description:用户信息
 *author:yanyalong
 *date:2013/11/05
 */
class User extends  User_Controller {
	function __construct(){
		parent::__construct();
	}
	/**
	 *description:我发布的灵感博文
	 *author:yanyalong
	 *date:2013/11/06
	 */
	//public function mydesign(){
		//$this->checklogin();
		//$this->config->load('view');
		//$config = $this->config->item('index');
		//$this->load->view($config['mydesign']);	
	//}
	/**
	 *description:我发布的装修问题
	 *author:yanyalong
	 *date:2013/11/06
	 */
	//public function myquestion(){
		//$this->checklogin();
		//$this->config->load('view');
		//$config = $this->config->item('index');
		//$this->load->view($config['myquestion']);	
	//}
	/**
	 *description:我发布的家居美图
	 *author:yanyalong
	 *date:2013/11/06
	 */
	//public function myproduct(){
		//$this->checklogin();
		//$this->config->load('view');
		//$config = $this->config->item('index');
		//$this->load->view($config['myproduct']);	
	//}
	//退出登录
	function logout(){
		safeFilter();
		$url= isset($_GET['url'])?$this->input->get('url'):"";
		setcookie("user_email","",time()+3600*24*7,'/');
		setcookie("user_nickname","",time()+3600*24*7,'/');
		setcookie("user_id","",time()-3600*24*7,'/');
		setcookie("notice_show",'',time()-3600*24*7,'/');
		session_unset();
				
		$urlflag = ltrim(ltrim((dirname($url).'/'.basename($url)),($this->config->base_url().'\/')),'dex.php');
		$urlarr = array('/post/design');
		if(in_array($urlflag,$urlarr)){
			$url = "/index.php/user/home";	
		}
		if($url==''){
			$url = "/index.php/user/home";	
		}
		header("Location:$url");exit;
	}	
	/**
	 *description:注册页
	 *author:yanyalong
	 *date:2013/11/05
	 */
	public function regist()
	{
		$this->checklogin();
		$data['config']	= $this->myinfo();
		$data['title']	= "注册";
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$data['authorizeURL'] = authorizeURL();
		$this->load->view($config['regist'],$data);	
	}
	/**
	 *description:登录页
	 *author:yanyalong
	 *date:2013/11/05
	 */
	public function login()
	{
		$this->checklogin();
		$data['config']	= $this->myinfo();
		$data['title']	= "登录";
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$data['authorizeURL'] = authorizeURL();
		$this->load->view($config['login'],$data);
	}
	/**
	 *description:首页
	 *author:yanyalong
	 *date:2013/11/05
	 */
	public function home()
	{
		$this->checklogin();
		$this->config->load('url');
		$config = $this->config->item('url');
		$data['config']	= $this->myinfo();
		$data['title']	= "家一起吧 jia178 家178 专业在线家装平台-装修 设计师 装饰 家装 在线家装 家居 建材 灵感 创意 效果图";
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		/*$this->sm->assign($data);
        $this->sm->show($config['home']);
		或
		$this->sm->view($config['home'],$data);
        */
		$this->load->view($config['home'],$data);
	}
	/**
	 *description:我的个人中心
	 *author:yanyalong
	 *date:2013/11/13
	 */
	//function my(){
		//$this->checklogin();
		//$this->config->load('view');
		//$config = $this->config->item('index');
		//$this->load->view($config['my']);	
	//}
	/**
	 *description:个人主页搜索我的灵感
	 *author:yanyalong
	 *date:2013/11/14
	 */
	//public function search(){
		//$this->config->load('view');
		//$config = $this->config->item('index');
		//$this->load->view($config['mysearch']);	
	//}
	/**
	 *description:寻找好友
	 *author:yanyalong
	 *date:2013/11/15
	 */
	//public function findfriend(){
		//$this->config->load('view');
		//$config = $this->config->item('index');
		//$this->load->view($config['findfriend']);	
	//}
	/**
	 *description:个人主页
	 *author:yanyalong
	 *date:2013/11/11
	 */
	public function index(){
		$data['config']	= $this->myinfo();
		$data['title']	= "个人主页";
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['user_index'],$data);	
	}
	/**
	 *description:个人主页灵感集
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function album(){
		$data['config']	= $this->myinfo();
		$data['title']	= "灵感辑";
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['album_index'],$data);	
	}
	/**
	 *description:个人主页产品推荐(产品详情)
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function product(){
		$data['config']	= $this->myinfo();
		$data['title']	= "推荐产品";
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['user_product'],$data);	
	}
	/**
	 *description:个人主页收藏产品
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function likeproduct(){
		$data['config']	= $this->myinfo();
		$data['title']	= "收藏产品";
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['likeproduct'],$data);	
	}
	/**
	 *description:个人主页楼盘方案(设计师)
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function scheme(){
		$data['config']	= $this->myinfo();
		$data['title']	= "楼盘方案";
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['designscheme'],$data);	
	}
		
	/**
	 *description:产品推荐
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function project(){
		$data['config']	= $this->myinfo();
		$data['title']	= "楼盘方案";
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['project_user'],$data);	
	}
}


