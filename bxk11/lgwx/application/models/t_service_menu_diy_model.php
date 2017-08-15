<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/05/19 00:04:42 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_service_menu_diy_model extends CI_Model
{
	/**
	 * @COLUMN_KEY		PRI
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $smd_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $smd_pid;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(20)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $smd_name;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(3)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $smd_sort;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $service_token;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(1)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $smd_type;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(500)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $smd_content;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->smd_sort = 0;
		$this->smd_type = '';
		$this->smd_content = '';
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY smd_id
	 *
	 * @return 对象
	*/
	public function get($smd_id)
	{
		return $this->db->get_where('t_service_menu_diy',array('smd_id' => $smd_id))->row();
	}
	

	/**
	 * 获取记录列表
	 * 
	 * 默认参数：获取按主键升序排列的前10条记录
	 *
	 * @param $limit		每页纪录数
	 * @param $offset		结果集的偏移
	 * @param $order_field	排序字段
	 * @param $order_type	排序类型 ASC | DESC
	 *
	 * @return				对象数组
	 * get_list(10,0) =>	select * from t_service_menu_diy limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'smd_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_menu_diy', $limit, $offset)->result();
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
	public function get_all($order_field = 'smd_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_menu_diy')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_service_menu_diy');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'smd_id', $order_type = 'ASC')
	{
		$this->db->from('t_service_menu_diy')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_service_menu_diy')->like($field_name, $keywords);
		return $this->db->count_all_results();
	}

	/**
	 * 插入一条记录
	 *
	 * @Exception			Exception
	 *
	 * @return				return $this->db->insert()
	 */
	public function insert()
	{
		$this->db->insert('t_service_menu_diy', $this);
		return $this->db->insert_id();
	}

	/**
	 * 更新一条记录
	 *
	 * @Exception			Exception
	 * 
	 * @return				return $this->db->update()
	 */
	public function update()
	{
		return $this->db->update('t_service_menu_diy', $this, array('smd_id' => $post['smd_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['smd_pid']) || empty($post['smd_pid'])) return false;
		if(!isset($post['smd_name']) || empty($post['smd_name'])) return false;
		if(!isset($post['smd_sort']) || empty($post['smd_sort'])) return false;
		if(!isset($post['service_token']) || empty($post['service_token'])) return false;
		if(!isset($post['smd_type']) || empty($post['smd_type'])) return false;
		if(!isset($post['smd_content']) || empty($post['smd_content'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['smd_id']) || empty($post['smd_id'])) return false;
		if(!isset($post['smd_pid']) || empty($post['smd_pid'])) return false;
		if(!isset($post['smd_name']) || empty($post['smd_name'])) return false;
		if(!isset($post['smd_sort']) || empty($post['smd_sort'])) return false;
		if(!isset($post['service_token']) || empty($post['service_token'])) return false;
		if(!isset($post['smd_type']) || empty($post['smd_type'])) return false;
		if(!isset($post['smd_content']) || empty($post['smd_content'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY smd_id
	*/
	public function delete($smd_id)
	{
		return $this->db->delete('t_service_menu_diy',array('smd_id' => $smd_id));
	}

	/*******************刘广平修改*******2014/04/21*******************/
	
	/**
	 * 获取菜单信息
	 *
	 * @PRIMARY KEY smd_id
	*/
	public function getMenuInfo($where,$order_field='smd_id',$order_type='ASC',$limit=3,$offset=0){

		$this->db->from('t_service_menu_diy');
		$this->db->where($where);
		return $this->db->order_by($order_field, $order_type)->limit($limit, $offset)->get()->result();
		
		
	}

	/**
	 * 修改
	 * @param array $data
	 * @param arrray $where
	 * @return boolean
	 * @author liuguangping
	 * @version jia178 v1.0 2013/11/7
	 */
	public function updates_global($data,$where){
		return $this->db->update('t_service_menu_diy',$data,$where)?true:false;
	}
	
	/**
	 * 根据条件得到单条记录
	 *
	 * @PRIMARY KEY rwfr_id
	 *
	 * @return 对象
	 */
	public function getOne($field='smd_id',$where)
	{
		 return $this->db->select($field)->get_where('t_service_menu_diy',$where)->row();
	}	

	/**
	 * 根据service_id 和 wid 来查找主键
	 *
	 * @PRIMARY KEY sw_id
	*/
	public function getArray($field='smd_id',$where){
		return $this->db->select($field)->get_where('t_service_menu_diy',$where)->result();
	}

	/**
	 * 根据service_id 和 wid 来查找主键
	 *
	 * @PRIMARY KEY sw_id
	*/
	public function getSortArray($field='smd_id',$where,$limit){
		$whereS = "1=1";
		if(!empty($where) && is_array($where)){
			foreach ($where as $key => $value) {
				$whereS .= " AND $key='$value'";
			}
		}
		if(!$limit){
			$limitNum = " limit $limit";
		}else{
			$limitNum = '';
		}
		$ascR = array();
		$descR = array();
		$result = $this->db->query("select * from t_service_menu_diy where $whereS order by smd_sort asc,smd_id asc".$limitNum)->result();

		foreach ($result as $key => $value) {
			if($value->smd_sort != 0){
				$ascR[$key] = $value;
			}else{
				$descR[$key] = $value;
			}
		}
		return array_merge($ascR,$descR);
	}

	 /**
	 *description:执行sql
	 *author:liguangping
	 *date:2014/06/03
	 */
    public function query($sql){
    	if($sql){
    		return $this->db->query($sql)?true:false;
    	}else{
    		return false;
    	}
    }
	
}
