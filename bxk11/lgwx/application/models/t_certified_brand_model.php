<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/05/05 10:20:26 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_certified_brand_model extends CI_Model
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
	public $c_brand_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $c_brand_name;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $c_brand_ename;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(200)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $c_brand_logo;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(200)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $c_brand_website;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		text
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		text
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $c_brand_desc;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(200)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $c_brand_keywords;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY c_brand_id
	 *
	 * @return 对象
	*/
	public function get($c_brand_id)
	{
		return $this->db->get_where('t_certified_brand',array('c_brand_id' => $c_brand_id))->row();
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
	 * get_list(10,0) =>	select * from t_certified_brand limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'c_brand_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_certified_brand', $limit, $offset)->result();
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
	public function get_all($order_field = 'c_brand_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_certified_brand')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_certified_brand');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'c_brand_id', $order_type = 'ASC')
	{
		$this->db->from('t_certified_brand')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_certified_brand')->like($field_name, $keywords);
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
		$this->db->insert('t_certified_brand', $this);
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
		return $this->db->update('t_certified_brand', $this, array('c_brand_id' => $post['c_brand_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['c_brand_name']) || empty($post['c_brand_name'])) return false;
		if(!isset($post['c_brand_ename']) || empty($post['c_brand_ename'])) return false;
		if(!isset($post['c_brand_logo']) || empty($post['c_brand_logo'])) return false;
		if(!isset($post['c_brand_website']) || empty($post['c_brand_website'])) return false;
		if(!isset($post['c_brand_desc']) || empty($post['c_brand_desc'])) return false;
		if(!isset($post['c_brand_keywords']) || empty($post['c_brand_keywords'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['c_brand_id']) || empty($post['c_brand_id'])) return false;
		if(!isset($post['c_brand_name']) || empty($post['c_brand_name'])) return false;
		if(!isset($post['c_brand_ename']) || empty($post['c_brand_ename'])) return false;
		if(!isset($post['c_brand_logo']) || empty($post['c_brand_logo'])) return false;
		if(!isset($post['c_brand_website']) || empty($post['c_brand_website'])) return false;
		if(!isset($post['c_brand_desc']) || empty($post['c_brand_desc'])) return false;
		if(!isset($post['c_brand_keywords']) || empty($post['c_brand_keywords'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY c_brand_id
	*/
	public function delete($c_brand_id)
	{
		return $this->db->delete('t_certified_brand',array('c_brand_id' => $c_brand_id));
	}

	/**
	 * 查询系统认证品牌表的总条数 liuguangping
	 * @param String $key_word 关键字-微信号-公司名
	 */
	
	public function admin_search_count($key_word){
		
		return $this->db->query("SELECT c_brand_id FROM t_certified_brand WHERE (c_brand_name LIKE '%{$key_word}%' OR c_brand_ename LIKE '%{$key_word}%')")->result();
	
	}
	
	/**
	 * 查询系统认证品牌表
	 * @param Int $key_word  关键词
	 *
	 */
	
	public function admin_search($key_word,$offset,$limit){
		
		return $this->db->query("SELECT * FROM t_certified_brand WHERE (c_brand_name LIKE '%{$key_word}%' OR c_brand_ename LIKE '%{$key_word}%') ORDER BY c_brand_id DESC LIMIT {$offset},{$limit}")->result();
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
		return $this->db->update('t_certified_brand',$data,$where)?true:false;
	}
	
	/**
	 * 根据条件得到单条记录
	 *
	 * @PRIMARY KEY rwfr_id
	 *
	 * @return 对象
	 */
	public function getOne($field='c_brand_id',$where)
	{
		 return $this->db->select($field)->get_where('t_certified_brand',$where)->row();
	}	

	/**
	 * 根据service_id 和 wid 来查找主键
	 *
	 * @PRIMARY KEY sw_id
	*/
	public function getArray($field='c_brand_id',$where){
		return $this->db->select($field)->get_where('t_certified_brand',$where)->result();
	}
}
