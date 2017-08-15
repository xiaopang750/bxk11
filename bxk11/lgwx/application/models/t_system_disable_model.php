<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/10/18 20:09:08 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_system_disable_model extends CI_Model
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
	public $sdisable_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	1
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $sdisable_type;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	1
	 * @COLUMN_TYPE		varchar(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $sdisable_value;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY sdisable_id
	 *
	 * @return 对象
	*/
	public function get($sdisable_id)
	{
		return $this->db->get_where('t_system_disable',array('sdisable_id' => $sdisable_id))->row();
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
	 * get_list(10,0) =>	select * from t_system_disable limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'sdisable_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_system_disable', $limit, $offset)->result();
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
	public function get_all($order_field = 'sdisable_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_system_disable')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_system_disable');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'sdisable_id', $order_type = 'ASC')
	{
		$this->db->from('t_system_disable')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_system_disable')->like($field_name, $keywords);
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
		$this->db->insert('t_system_disable', $this);
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
		return $this->db->update('t_system_disable', $this, array('sdisable_id' => $post['sdisable_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['sdisable_id']) || empty($post['sdisable_id'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY sdisable_id
	*/
	public function delete($sdisable_id)
	{
		return $this->db->delete('t_system_disable',array('sdisable_id' => $sdisable_id));
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
		return $this->db->update('t_system_disable',$data,$where)?true:false;
	}
	

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY s_class_id
	 *
	 * @return 对象
	 */
	public function get_disable($field='sdisable_id',$where)
	{
		return $this->db->select($field)->get_where('t_system_disable',$where)->result_array();
	}
	
		/**
	 * @abstract 博文用用户名和条件搜索
	 * 
	 */
	public function disable_search($disable_status='',$disable_content='',$offset=0,$limit=10,$type=1){
		$where = ' AND 1=1';
		if($type != 1){
			$where .=" LIMIT {$offset},{$limit}";
		}
		if($disable_status == 4){
			return $this->db->query("SELECT d.*,u.user_nickname FROM t_system_disable as d LEFT JOIN t_user as u ON d.sdisable_value=u.user_id WHERE d.sdisable_type={$disable_status} AND u.user_nickname LIKE '%{$disable_content}%'{$where}")->result();
		}else{
			if($disable_status){
				return $this->db->query("SELECT * FROM t_system_disable WHERE sdisable_type={$disable_status} AND sdisable_value LIKE '%{$disable_content}%'{$where}")->result();
			}else{
				return $this->db->query("SELECT * FROM t_system_disable WHERE sdisable_value LIKE '%{$disable_content}%'{$where}")->result();
			}
		}

	}
	
}
