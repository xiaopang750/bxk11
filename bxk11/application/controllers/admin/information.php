<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        liuguangpingAuthor: 服务商管理
 *        Email: liuguangpingtest@163.com

 */
class Information extends Admin_Controller
{	
	//公共用的
	public $member;
	public $navpage;
	public $limit;
	public $libs;
	
	public $information_type;
	public $information;

	public function __construct(){
		parent::__construct();
		$this->member = "member";
		$this->navpage = 'member/nav';
		$this->information_type = model('t_information_type');
		print_r($this->information_type);

		$this->information = model('t_service_information');
	
		//共公有的
		$this->load->helper('import_excel');
		$this->load->helper('content_fun');
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->limit = 10;
		$this->load->helper('url');

	}

	public function index()
	{
		$data['title']='家178-管理中心-服务商-资讯分类列表';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'information/index'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
		$result=array();
		$key_word = isset($this->getParam->key_word)?$this->getParam->key_word:'';
		$it_type = isset($this->getParam->it_type)?$this->getParam->it_type:'';
		
		$page = isset($this->getParam->current_page)?$this->getParam->current_page:'';
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$total_rows = count($this->information_type->admin_search_count($key_word,$it_type));
		$office =  ($page-1)*($this->limit);
		$result['re'] = $this->information_type->admin_search($key_word,$it_type,$office,$this->limit);
		
		$this->libs->base_url = site_url('admin/information/index').'?search=0&key_word='.$key_word;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$result['key_word'] = $key_word;
		$result['it_type'] = $it_type;
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	
	public function add(){
		$data['title']='家178-管理中心-服务商-资讯分类添加';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'information/add'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
		$result=array();

		$this->pagedata = $result;//向页面加入加载数据
		parent::_initpage();//加载页面
	}

	public function doAdd(){
		$this->information_type->it_type = $this->postParam->it_type;
		$this->information_type->it_name = $this->postParam->it_name;
		$this->information_type->service_id = $this->postParam->service_id;
		
		if($this->information_type->insert()){
			jumpAjax('操作成功！',U('admin/information/index'));
		}else{
			jumpAjax('操作失败！',U('admin/information/add'));			
		}
	}

	public function edit(){
		$data['title']='家178-管理中心-服务商-资讯分类编辑';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'information/edit'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
		$result=array();
		$it_id = isset($this->getParam->it_id)?$this->getParam->it_id:'';
		$result['re'] = $this->information_type->get($it_id);
		$this->pagedata = $result;//向页面加入加载数据
		parent::_initpage();//加载页面
	}

	public function doEdit(){
		$data['it_type'] = $this->postParam->it_type;
		$data['it_name'] = $this->postParam->it_name;
		$data['service_id'] = $this->postParam->service_id;

		$where['it_id'] = $this->postParam->it_id;
		if($this->information_type->updates_global($data,$where))
			jumpAjax('操作成功！',U('admin/information/index'));
		else
			jumpAjax('操作成功！',U('admin/information/edit',array('it_id'=>$where['it_id'])));
	}

	public function doDel(){
		$ids = $this->input->post('ids');
		$idarr = explode(',',$ids);
		$temarr = array();
	
		foreach($idarr as $val){
			$result = $this->information_type->get($val);
			if($this->information_type->delete($val)){
				$temarr[] = $val;
			}
		}
		if($temarr){
			echo echojson('0',$temarr);
		}else{
			echo echojson('1',$temarr,'删除失败');
		}
	}

	public function sysList(){

		$data['title']='家178-管理中心-服务商-资讯分类列表';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'information/sysList'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
		$data=array();

        $p = isset($this->getParam->current_page)?$this->getParam->current_page:'';
        $num= $this->limit;
        $keywords = isset($this->getParam->key_word)?$this->getParam->key_word:'';
        $service_id= 0;
        $it_type = isset($this->getParam->it_type)?$this->getParam->it_type:'';

        $res = $this->information->getList($service_id,$keywords,$p,$num,$it_type);
        $data['keywords'] = $keywords;
        $data['it_type'] = $it_type;
        if($res==false){
            $data['informationlist'] = "";
            $data['count'] = "0";
            $data['current_count'] = "0";
        }
        $count_res = $this->information->getList($service_id,$keywords,'','',$it_type);
        $data['count'] = count($count_res);
        $data['current_count'] = count($res);
        foreach ($res as $key=>$val) {
             $data['informationlist'][$key]['it_name'] = $this->information_type->get($val->it_id)->it_name;
            $data['informationlist'][$key]['si_id'] = $val->si_id;
            $data['informationlist'][$key]['it_id'] = $val->si_id;
            $data['informationlist'][$key]['si_title'] = $val->si_title;
            $data['informationlist'][$key]['si_pic'] = $val->si_pic;
            $data['informationlist'][$key]['si_addtime'] = $val->si_addtime;
            $data['informationlist'][$key]['si_likes'] = $val->si_likes;
            $data['informationlist'][$key]['si_views'] = $val->si_views;
            $data['informationlist'][$key]['si_status'] = $val->si_status;
        }

        $resType = $this->information_type->getArray('*',array('it_type'=>1));
        $typelist = array();
        foreach ($resType as $key=>$val) {
            $typelist[$key]['it_id'] = $val->it_id;
            $typelist[$key]['it_name'] = $val->it_name;
            $where = "it_id = $val->it_id AND service_id = 0 AND si_status = 1";
            $typelist[$key]['selected'] = ($val->it_id == $it_type) ? 'selected':''; 
        }

        $data['it_list'] = $typelist;

    	
		$this->libs->base_url = U('admin/information/sysList').'?search=0&key_word='.$keywords."&it_type=".$it_type;
		$this->libs->total_rows = $data['count'];
		$this->libs->per_page = $this->limit;
		$data['p'] = $this->libs->show_page();

		$this->pagedata = $data;
		parent::_initpage();
	}

	public function sysAdd(){
		$data['title']='家178-管理中心-服务商-系统资讯添加';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'information/sysAdd'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
		$result=array();
		$resType = $this->information_type->getArray('*',array('it_type'=>1));
		$result['it_list'] = $resType;

		$this->pagedata = $result;//向页面加入加载数据
		parent::_initpage();//加载页面
	}

	public function doSysAdd(){
		$url = U('admin/information/sysAdd');		
		$si_title = (strlen_utf8($this->postParam->si_title) <30 && isset($this->postParam->si_title))?$this->postParam->si_title:jumpAjax('标题不能为空或长度至多为30个字',$url);
		$si_desc = (strlen_utf8($this->postParam->si_desc) <120 && isset($this->postParam->si_desc))?$this->postParam->si_desc:jumpAjax('摘要不能为空或长度至多为120个字',$url);
		$it_id = (isset($this->postParam->it_id) && $this->postParam->it_id)?$this->postParam->it_id:jumpAjax('请选择分类',$url);

		$this->load->library('upload');
		$c_picUrl = $this->upload->upSysInfoMationPic("si_pic");
		if($c_picUrl){
			$si_pic = $c_picUrl;
		}else{
			jumpAjax("请上传图片或上传失败",$url);
		}
		$si_content = isset($_REQUEST['si_content'])?$_REQUEST['si_content']:'';
		$si_keyword = isset($this->postParam->si_keyword)?$this->postParam->si_keyword:'';

		
		$this->information->service_id = 0;
		$this->information->it_id = $it_id;
		$this->information->si_title = $si_title;
		$this->information->si_desc = $si_desc;
		$this->information->si_content = htmlspecialchars(UtfToString($si_content));
		$this->information->si_addtime = date('Y-m-d H:i:s');
		$this->information->si_status = 1;
		$this->information->si_author = '系统';
		$this->information->si_pic = $si_pic;
		$this->information->si_likes = 0;
		$this->information->si_views = 0;
		$this->information->si_wap_isshow = 0;
		$this->information->si_keyword = $si_keyword;

		if($this->information->insert()){
			$url = site_url('admin/information/sysList');
			jumpAjax("操作成功",$url);
		}else{
			jumpAjax("操作失败",$url);
		}
	}

	public function sysEdit(){
		$url = site_url('admin/information/sysList');
		$data['title']='家178-管理中心-服务商-系统资讯编辑';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'information/sysEdit'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
		$result=array();
		$si_id = isset($this->getParam->si_id)?$this->getParam->si_id:jumpAjax('请正确传值',$url);
		$result['re'] = $this->information->get($si_id);
		$config = C('uploads','service_InforMation');
		$result['path'] = $config['relative_path'].'thumb_1/';
		$resType = $this->information_type->getArray('*',array('it_type'=>1));
		$result['it_list'] = $resType;
		$this->pagedata = $result;//向页面加入加载数据
		parent::_initpage();//加载页面

	}

	public function doSysEdit(){


		$si_id = isset($this->postParam->si_id)?$this->postParam->si_id:jumpAjax('请正确传值',U('admin/information/sysList'));
		$url = U('admin/information/sysEdit',array('si_id'=>$si_id));
		
		$si_title = (strlen_utf8($this->postParam->si_title) <30 && isset($this->postParam->si_title))?$this->postParam->si_title:jumpAjax('标题不能为空或长度至多为30个字',$url);
		$si_desc = (strlen_utf8($this->postParam->si_desc) <120 && isset($this->postParam->si_desc))?$this->postParam->si_desc:jumpAjax('摘要不能为空或长度至多为120个字',$url);
		$it_id = (isset($this->postParam->it_id) && $this->postParam->it_id)?$this->postParam->it_id:jumpAjax('请选择分类',$url);
		$si_pic_bak = $this->postParam->si_pic_bak;
		$this->load->library('upload');
		$c_picUrl = $this->upload->upSysInfoMationPic("si_pic");
		if($c_picUrl){
			$row = $this->information->get($si_id);
			$config = C('uploads','service_InforMation');
			$si_pic_source = $config['upload_path'].$row->si_pic;
			$si_pic_thumb1 = $config['thumb_1'].$row->si_pic;
			$si_pic_thumb2 = $config['thumb_2'].$row->si_pic;
  			@unlink($si_pic_source);
  			@unlink($si_pic_thumb1);
  			@unlink($si_pic_thumb2);
			$si_pic = $c_picUrl;
		}else{
			$si_pic = $si_pic_bak;
		}
		$si_content = isset($_REQUEST['si_content'])?$_REQUEST['si_content']:'';
		$si_keyword = isset($this->postParam->si_keyword)?$this->postParam->si_keyword:'';
		$si_likes = isset($this->postParam->si_likes)?$this->postParam->si_likes:0;
		$si_views = isset($this->postParam->si_views)?$this->postParam->si_views:0;

		$data['service_id'] = 0;
		$data['it_id'] = $it_id;
		$data['si_title'] = $si_title;

		$data['si_content'] = htmlspecialchars(UtfToString($si_content));
		$data['si_desc'] = $si_desc;
		$data['si_addtime'] = date('Y-m-d H:i:s');
		$data['si_status'] = 1;
		$data['si_author'] = '系统';
		$data['si_pic'] = $si_pic;
		$data['si_likes'] = $si_likes;
		$data['si_views'] = $si_views;
		$data['si_wap_isshow']= 0;
		$data['si_keyword'] = $si_keyword;
		$where['si_id'] = $this->postParam->si_id;
		if($this->information->updates_global($data,$where)){
			$url = U('admin/information/sysList');
			jumpAjax('操作成功！',$url);
		}else{
			jumpAjax('操作失败!',$url);
		}

	}

	public function doSysDel(){
		$ids = $this->input->post('ids');
		$idarr = explode(',',$ids);
		$temarr = array();
	
		foreach($idarr as $val){
			$result = $this->information->get($val);
			$where['si_id'] = $val;
			$data['si_status'] = 99;
			if($this->information->updates_global($data,$where)){
				$temarr[] = $val;
			}
		}
		if($temarr){
			echo echojson('0',$temarr);
		}else{
			echo echojson('1',$temarr,'删除失败');
		}
	}



	
}


