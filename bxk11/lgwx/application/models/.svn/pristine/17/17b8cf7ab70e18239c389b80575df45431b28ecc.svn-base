<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/10/18 20:09:08 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_system_admin_model extends CI_Model
{
	/**
	 * @COLUMN_KEY		PRI
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			auto_increment
	 * @COLUMN_COMMENT	
	 */
	public $admin_id;

	/**
	 * @COLUMN_KEY		MUL
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $agroup_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(16)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $admin_name;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(32)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $admin_pass;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(16)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $admin_lastip;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $admin_addid;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		timestamp
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	CURRENT_TIMESTAMP
	 * @COLUMN_TYPE		timestamp
	 * @EXTRA			on update CURRENT_TIMESTAMP
	 * @COLUMN_COMMENT	
	 */
	public $admin_addtime;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(16)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $admin_addip;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(16)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $admin_nikename;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	1
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $admin_status;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY admin_id
	 *
	 * @return 对象
	*/
	public function get1($admin_id)
	{
		$_date = $this->db->get_where('t_system_admin',array('admin_id' => $admin_id))->row();
		return $_date;
	}
	public function get($admin_id)
	{
		$_date = $this->db->get_where('t_system_admin',array('admin_id' => $admin_id))->row();
		$this->admin_id=$_date->admin_id;
		$this->user_id=$_date->user_id;
		$this->agroup_id=$_date->agroup_id;
		$this->admin_pass=$_date->admin_pass;
		$this->admin_lastip=$_date->admin_lastip;
		$this->admin_addid=$_date->admin_addid;
		$this->admin_addtime=$_date->admin_addtime;
		$this->admin_addip=$_date->admin_addip;
		$this->admin_name=$_date->admin_name;
		$this->admin_nikename=$_date->admin_nikename;

		return $_date;
	}

	public function get_by_name($_admin_name)
	{
		$_date=$this->db->get_where('t_system_admin',array('admin_name'=>$_admin_name))->row();
		if($_date){
			$this->admin_id=$_date->admin_id;
			//$this->user_id=$_date->user_id;
			$this->agroup_id=$_date->agroup_id;
			$this->admin_pass=$_date->admin_pass;
			$this->admin_lastip=$_date->admin_lastip;
			$this->admin_addid=$_date->admin_addid;
			$this->admin_addtime=$_date->admin_addtime;
			$this->admin_addip=$_date->admin_addip;
			$this->admin_name=$_date->admin_name;
			$this->admin_nikename=$_date->admin_nikename;
			return $_date;
		}else{
			return false;
		}
		
		
	}

	/**
	 * 获取所有记录
	 *
	 * 默认参数：获取按主键升序排列的所有记录
	 *
	 * @param $order_field	排序字段
	 * @param $order_type	排序类型 ASC | DESC
	 *
	 * @return				对象数组
	 */
	public function get_all($order_field = 'admin_id', $order_type = 'DESC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_system_admin')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_system_admin');
	}

	/**
	 * 查询	
	 *
	 * 默认参数：根据查询字段和关键词，返回按主键升序排列的前10条记录
	 *
	 * @param $field_name	查询的字段
	 * @param $keywords		查询的关键字
	 * @param $limit		每页纪录数
	 * @param $offset		结果集的偏移
	 * @param $order_field	排序字段
	 * @param $order_type	排序类型 ASC | DESC
	 *
	 * @return				对象数组
	 */
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'admin_id', $order_type = 'ASC')
	{
		$this->db->from('t_system_admin')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
		return $this->db->get()->result();
	}

	/**
	 * 获取满足查询条件的所有记录总数，用于查询结果的分页
	 *
	 * @param $field_name	查询的字段
	 * @param $keywords		查询的关键字
	 *
	 * @return				整形
	 */
	public function count_search($field_name, $keywords)
	{
		$this->db->from('t_system_admin')->like($field_name, $keywords);
		return $this->db->count_all_results();
	}

	/**
	 * 插入一条记录
	 *
	 * @Exception			Exception
	 *
	 * @return				return $this->db->insert()
	 */
	public function insert($data)
	{
		$sql = "select admin_name from t_system_admin where admin_name='".$data['admin_name']."'";
		$reg = $this->db->query($sql)->result();
		if($reg)
		{
			return false;
		}
		$cdata = array(
			'admin_nikename'=>$data['admin_nikename'],
			'admin_name'=>$data['admin_name'],
			'admin_pass'=>md5($data['admin_pass']),
			'admin_addtime'=>date("Y-m-d H:i:s", time()),
			'admin_status'=>$data['admin_status'],
			'admin_addid'=>$_SESSION['admin_id']
		);
		
		$this->db->insert('t_system_admin', $cdata);
		return $this->db->insert_id();
	}

	/**
	 * 更新一条记录
	 *
	 * @Exception			Exception
	 * 
	 * @return				return $this->db->update()
	 */
	public function update($data)
	{
		$sql="update t_system_admin set admin_nikename='".$data['admin_nikename']."',admin_name='".$data['admin_name']."', admin_status=".$data['admin_status']." where admin_id=".$data['admin_id'];
	
		$reg = $this->db->query($sql);
	

		return $reg;
	}
	public function update2($data)
	{
		$sql="update t_system_admin set admin_pass='".md5($data['admin_pass'])."' where admin_id=".$data['admin_id'];
		$reg = $this->db->query($sql);
	

		return $reg;
	}


	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['admin_addtime']) || empty($post['admin_addtime'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['admin_id']) || empty($post['admin_id'])) return false;
		if(!isset($post['admin_addtime']) || empty($post['admin_addtime'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY admin_id
	*/
	public function delete1($admin_id)
	{
		return $this->db->delete('t_system_admin',array('admin_id' => $admin_id));
	}
	
}
