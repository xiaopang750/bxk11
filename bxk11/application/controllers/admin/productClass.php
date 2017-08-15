<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        dinghaochenAuthor: ��껳�
 *        Email: dotnet010@gmail.com

 */
class productClass extends Admin_Controller
{	

	/**
     * 
     * @author 刘广平 <liuguangpingtest@163.com>
     */
    static protected $pc_function = array(
                array('id'=>'0','title'=>'不限'),
            	array('id'=>'1','title'=>'卧室'),
            	array('id'=>'2','title'=>'客厅'),
            	array('id'=>'3','title'=>'餐厅'),
            	array('id'=>'4','title'=>'书房'),
            	array('id'=>'5','title'=>'儿童房'),
            	array('id'=>'6','title'=>'厨房'),
            	array('id'=>'7','title'=>'卫浴室'),
 
    );
	private $product_class;
	public function __construct(){
		parent::__construct();

		$this->content = 'index';
		$this->navpage = 'nav';

		$this->load->library('operation_data');

		$this->libs = $this->operation_data;


		$this->load->model('t_product_class_model');
		$this->product_class = $this->t_product_class_model;

		$this->load->helper('fromcheck');
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');

		$this->limit = 10;
	}
	public function index(){

		$data['title']='家178-管理中心-增值服务';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'productClass/index';
		$result = array();

		$result['list'] = $this->getTree();

		///echo "<pre>";var_dump($result['list']);die;
		$this->pagedata = $result;
		parent::_initpage();
	
	}
	

	 /**
     * 获取分类详细信息
     * @param  milit   $id 分类ID或标识
     * @param  boolean $field 查询字段
     * @return array     分类信息
     * @author 刘广平 <liuguangpingtest@163.com>
     */
    public function info($id, $field = '*'){
        /* 获取分类信息 */
        $map = array();
        if(is_numeric($id)){ //通过ID查询
            $map['pc_id'] = $id;
        } else { //通过标识查询
            $map['pc_name'] = $id;
        }
        return ($this->product_class->getOne($field,$map));
    }

    /**
     * 获取分类树，指定分类则返回指定分类极其子分类，不指定则返回所有分类树
     * @param  integer $id    分类ID
     * @param  boolean $field 查询字段
     * @return array          分类树
     * @author 刘广平 <liuguangpingtest@163.com>
     */
    public function getTree($id = 0, $field = "*"){
        /* 获取当前分类信息 */
        if($id){
            $info = $this->info($id);
            $id   = $info['pc_id'];
        }

        /* 获取所有分类 */
        //$map  = array('status' => 1);
        $list = objectToArray($this->product_class->get_all());
        $list = list_to_tree($list, $pk = 'pc_id', $pid = 'pc_pid', $child = 'son', $root = $id);

        /* 获取返回数据 */
        if(isset($info)){ //指定分类则返回当前分类极其子分类
            $info['_'] = $list;
        } else { //否则返回所有分类
            $info = $list;
        }

        return $info;
    }

	public function add(){
		
		$data['title']='家178-管理中心-添加微信选项';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'productClass/add';
		$this->navpage = $this->navpage;
		$result = (object) 'result';
		$pc_id = isset($this->getParam->pc_pid)?$this->getParam->pc_pid:0;
		$row = $this->product_class->get($pc_id);
		$result->pc_pname = isset($row->pc_name)?$row->pc_name:'无';
		$result->pc_functionR = self::$pc_function;
		$result->pc_pid = $pc_id;
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function doadd(){

		$url = site_url('admin/productClass/add');
		$pc_name = $this->postParam->pc_name;
		$pc_function = $this->postParam->pc_function;
		$pc_pid = $this->postParam->pc_pid;

		if(!$pc_name){
			jumpAjax("产品分类名称不能为空",$url);
		}

		if(!$this->is_productClass($pc_name,'')){
			jumpAjax("产品分类名称己占用",$url);
		}

		$this->product_class->pc_name = $pc_name;
		$this->product_class->pc_function = $pc_function;
		$this->product_class->pc_pid = $pc_pid;
		if($pc_pid == 0){
			$pc_depth = 0;
			$this->product_class->pc_function = "";
		}else{
			$row = $this->product_class->get($pc_pid);
			$pc_depth = $row->pc_depth;
		}
		
		$this->product_class->pc_depth = $pc_depth+1;
		//$this->product_class->product_id = '';
		if($this->product_class->insert()){
			$url = site_url('admin/productClass/index');
			jumpAjax("操作成功",$url);
		}else{
			jumpAjax("操作失败",$url);
		}
	}

	public function edit(){
		$data['title']='家178-管理中心-编辑';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'productClass/edit';
		$this->navpage = $this->navpage;
		$result = array();
		$pc_id = $this->getParam->pc_id;
		$result = $this->product_class->get($pc_id);
		$pc_pid = $this->info($pc_id,'pc_pid,pc_name');
		if($pc_pid->pc_pid){
			$pc_name = $this->info($pc_pid->pc_pid,'pc_name');
			$result->pc_pname = $pc_name->pc_name;
		}else{
			$result->pc_pname = "无";
		}
		$result->pc_functionR = self::$pc_function;
		$results['re'] = $result;
		$this->pagedata = $result;
		parent::_initpage();
	}

	public function getMessage($is_ajax,$status,$data,$mes){
		if(!$is_ajax){
			echojson($status,$data,$mes);
		}else{
			jumpAjax($mes,$data);
		}
	}

	public function doedit(){
		
		$pc_id = $this->postParam->pc_id;
		$pc_name = $this->postParam->pc_name;
		$is_ajax = isset($this->postParam->pc_ajax)?1:0;
		
		$url = site_url('admin/productClass/edit')."?pc_id=".$pc_id;

		if(!$pc_name){
			$this->getMessage($is_ajax, 1, $url, '名称不能为空');
		}
		
		if(!$this->is_productClass($pc_name,$pc_id)){
			$this->getMessage($is_ajax, 1, $url, "名称不能重复");
		}

		if($is_ajax){
			$data['pc_function'] = $this->postParam->pc_function;
		}
		$data['pc_name'] = $pc_name;
	
		$where['pc_id'] = $pc_id;
		if($this->product_class->updates_global($data,$where)){
			$url = site_url('admin/productClass/index');
			$this->getMessage($is_ajax, 0, $url, "操作成功");
		}else{
			$this->getMessage($is_ajax, 1, $url, "操作失败");
		}
	}

	//判断菜单名称是否存在
	public function is_productClass($pc_name,$pc_id){
		$where['pc_name'] = $pc_name;
		$result = $this->product_class->getArray('*',$where);
		if($result){
			if($pc_id){
				$is_productClass = twotoone_array($result,'pc_id');
				foreach($is_productClass as $va){
					if($pc_id != $va){
						return false;
					}
				}
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}

	public function is_AjaxProduct(){
		$pc_id = $this->input->post('id');
		$pc_name = $this->input->post('key');
		if($this->is_productClass($pc_name,$pc_id)){
			echo 0;
		}else{
			echo 1;
		}
	}

	public function doDel(){
		$ids = $this->input->post('ids');
		if(!$ids){
			echojson('1','','参数错误');
        }
		$idarr = explode(',',$ids);
		$temarr = array();
		foreach($idarr as $val){
			$result = $this->product_class->get($val);
			$child = $this->product_class->getArray('pc_id',array('pc_pid'=>$val));
			if(!empty($child)){
				echojson('1','','请先删除该分类下的子分类');
       		}
			if($this->product_class->delete($val)){
				$temarr[] = $val;
			}
		}
		if($temarr){
			$url = site_url('admin/productClass/index');
			//jumpAjax("删除成功",$url);
			echojson('0',$temarr);
		}else{
			echojson('1',$temarr,'删除失败');
		}
	}
}

