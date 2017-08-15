<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/06/06 17:29:42 
 * dinghaochenAuthor: jia178
 */
class T_service_spreader_rebate_model extends CI_Model
{
	public $sr_id;

	public $sr_type;

	public $sr_unit;

	public $sr_amount;

	public $sr_status;

	public $sr_desc;

	public $ss_type;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY sr_id
	 *
	 * @return 对象
	*/
	public function get($sr_id)
	{
		return $this->db->get_where('t_service_spreader_rebate',array('sr_id' => $sr_id))->row();
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
	 * get_list(10,0) =>	select * from t_service_spreader_rebate limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'sr_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_spreader_rebate', $limit, $offset)->result();
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
	public function get_all($order_field = 'sr_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_spreader_rebate')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_service_spreader_rebate');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'sr_id', $order_type = 'ASC')
	{
		$this->db->from('t_service_spreader_rebate')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_service_spreader_rebate')->like($field_name, $keywords);
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
		$this->db->insert('t_service_spreader_rebate', $this);
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
		return $this->db->update('t_service_spreader_rebate', $this, array('sr_id' => $post['sr_id']));
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY sr_id
	*/
	public function delete($sr_id)
	{
		return $this->db->delete('t_service_spreader_rebate',array('sr_id' => $sr_id));
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
		return $this->db->update('t_service_spreader_rebate',$data,$where)?true:false;
	}
	
	/**
	 * 根据条件得到单条记录
	 *
	 * @PRIMARY KEY rwfr_id
	 *
	 * @return 对象
	 */
	public function getOne($field='sr_id',$where)
	{
		 return $this->db->select($field)->get_where('t_service_spreader_rebate',$where)->row();
	}	

	/**
	 * 根据service_id 和 sr_id 来查找主键
	 *
	 * @PRIMARY KEY sw_id
	*/
	public function getArray($field='sr_id',$where){
		return $this->db->select($field)->get_where('t_service_spreader_rebate',$where)->result();
	}
	
}
