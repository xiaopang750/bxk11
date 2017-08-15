<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/27 12:04:38 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_system_product_pattern_model extends CI_Model
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
	public $pattern_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $s_c_tag_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(20)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $pattern_type;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $pattern_img;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $pattern_sort;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $pattern_seodesc;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY pattern_id
	 *
	 * @return 对象
	*/
	public function get($pattern_id)
	{
		return $this->db->get_where('t_system_product_pattern',array('pattern_id' => $pattern_id))->row();
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
	 * get_list(10,0) =>	select * from t_system_product_pattern limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'pattern_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_system_product_pattern', $limit, $offset)->result();
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
	public function get_all($order_field = 'pattern_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_system_product_pattern')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_system_product_pattern');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'pattern_id', $order_type = 'ASC')
	{
		$this->db->from('t_system_product_pattern')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_system_product_pattern')->like($field_name, $keywords);
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
		$this->db->insert('t_system_product_pattern', $this);
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
		return $this->db->update('t_system_product_pattern', $this, array('pattern_id' => $post['pattern_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['pattern_type']) || empty($post['pattern_type'])) return false;
		if(!isset($post['pattern_img']) || empty($post['pattern_img'])) return false;
		if(!isset($post['pattern_sort']) || empty($post['pattern_sort'])) return false;
		if(!isset($post['pattern_seodesc']) || empty($post['pattern_seodesc'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['pattern_id']) || empty($post['pattern_id'])) return false;
		if(!isset($post['pattern_type']) || empty($post['pattern_type'])) return false;
		if(!isset($post['pattern_img']) || empty($post['pattern_img'])) return false;
		if(!isset($post['pattern_sort']) || empty($post['pattern_sort'])) return false;
		if(!isset($post['pattern_seodesc']) || empty($post['pattern_seodesc'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY pattern_id
	*/
	public function delete($pattern_id)
	{
		return $this->db->delete('t_system_product_pattern',array('pattern_id' => $pattern_id));
	}
	
	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY pattern_id
	 * @author liuguangping
	 *
	 * @return 数组
	 */
	public function get_pattern($field='pattern_id',$where)
	{
		return $this->db->select($field)->get_where('t_system_product_pattern',$where)->result_array();
	}
	
	/**
	 * 根据分类id，标签id和款式名 搜索款式条数
	 * @param Int $s_tag_id
	 * @param Int $s_class_id
	 * @param String $pattern_type
	 */
	public function admin_search_count($s_tag_id,$s_class_id,$pattern_type){
		$where= "1=1";
		if($s_tag_id){
			$where.=" AND s_tag_id=".$s_tag_id;
		}
		if($s_class_id){
			$where.=" AND s_class_id=".$s_class_id;
		}
		return $this->db->query("SELECT pattern_id FROM t_system_product_pattern WHERE s_c_tag_id IN (SELECT s_c_tag_id FROM t_s_class_tag WHERE ".$where.") AND pattern_type LIKE '%{$pattern_type}%'")->result();
	}
	
	/**
	 * 根据分类id，标签id和款式名 搜索款式
	 * @param Int $s_tag_id
	 * @param Int $s_class_id
	 * @param String $pattern_type
	 * @param Int $offset
	 * @param Int $limit
	 */
	public function admin_search($s_tag_id,$s_class_id,$pattern_type,$offset,$limit){
		$where= "1=1";
		if($s_tag_id){
			$where.=" AND s_tag_id=".$s_tag_id;
		}
		if($s_class_id){
			$where.=" AND s_class_id=".$s_class_id;
		}
		
		return $this->db->query("SELECT * FROM t_system_product_pattern WHERE s_c_tag_id IN (SELECT s_c_tag_id FROM t_s_class_tag WHERE ".$where.") AND pattern_type LIKE '%{$pattern_type}%' ORDER BY pattern_id DESC LIMIT {$offset},{$limit}")->result();
	
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
		return $this->db->update('t_system_product_pattern',$data,$where)?true:false;
	}
}
