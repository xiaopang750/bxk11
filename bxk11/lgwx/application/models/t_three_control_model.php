<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/10/18 20:09:09 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_three_control_model extends CI_Model
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
	public $t_c_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $type;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $x;
	
	/**
	 * @COLUMN_KEY
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA
	 * @COLUMN_COMMENT
	 */
	public $y;
	
	/**
	 * @COLUMN_KEY
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA
	 * @COLUMN_COMMENT
	 */
	public $width;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	1
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $height;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $buttonWidth;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $buttonHeight;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $bgColor;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $bgAlpha;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $initialShow;
	/**
	 * @COLUMN_KEY
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA
	 * @COLUMN_COMMENT
	 */
	public $left;
	/**
	 * @COLUMN_KEY
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA
	 * @COLUMN_COMMENT
	 */
	public $right;
	public $up;
	public $down;
	public $zoomin;
	public $zoomout;
	public $full;
	public $eixtFull;
	public $prev;
	public $next;
	public $thumb;
	public $map;
	public $show;
	public $hide;
	
	public function __construct(){
		parent::__construct();
		
		$this->bgColor='FFFFFF';
		$this->initialShow='0';
		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY tag_id
	 *
	 * @return 对象
	 */
	public function get($tag_id)
	{
		return $this->db->get_where('t_three_control',array('t_c_id' => $tag_id))->row();
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
	 * get_list(10,0) =>	select * from t_tag limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 't_t_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_three_control', $limit, $offset)->result();
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
	public function get_all($order_field = 't_c_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_three_control')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_three_control');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 't_c_id', $order_type = 'ASC')
	{
		$this->db->from('T_three_control_model')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_three_control')->like($field_name, $keywords);
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
		$this->db->insert('t_three_control', $this);
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
		return $this->db->update('t_three_control', $this, array('t_c_id' => $this->t_c_id));
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
		if(!isset($post['t_c_id']) || empty($post['t_c_id'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY tag_id
	 */
	public function delete($tag_id)
	{
		return $this->db->delete('t_three_control',array('t_c_id' => $tag_id));
	}
	
	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY s_class_id
	 *
	 * @return 对象
	 */
	public function get_tag($field='t_c_id',$where)
	{
		return $this->db->select($field)->get_where('t_three_control',$where)->result_array();
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
		return $this->db->update('t_three_control',$data,$where)?true:false;
	}

}

