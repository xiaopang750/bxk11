<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/17 15:23:37 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_system_district_model extends CI_Model
{
	/**
	 * @COLUMN_KEY		PRI
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			auto_increment
	 * @COLUMN_COMMENT	
	 */
	public $district_id;
	
	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $district_name;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $district_pcode;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $district_code;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11) unsigned zerofill
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $district_depth;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY district_id
	 *
	 * @return 对象
	*/
	public function get($district_id)
	{
		return $this->db->get_where('t_system_district',array('district_id' => $district_id))->row();
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
	 * get_list(10,0) =>	select * from t_system_district limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'district_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_system_district', $limit, $offset)->result();
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
	public function get_all($order_field = 'district_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_system_district')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_system_district');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'district_id', $order_type = 'ASC')
	{
		$this->db->from('t_system_district')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_system_district')->like($field_name, $keywords);
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
		$this->db->insert('t_system_district', $this);
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
		return $this->db->update('t_system_district', $this, array('district_id' => $post['district_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['district_name']) || empty($post['district_name'])) return false;
		if(!isset($post['district_pcode']) || empty($post['district_pcode'])) return false;
		if(!isset($post['district_code']) || empty($post['district_code'])) return false;
		if(!isset($post['district_depth']) || empty($post['district_depth'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['district_id']) || empty($post['district_id'])) return false;
		if(!isset($post['district_name']) || empty($post['district_name'])) return false;
		if(!isset($post['district_pcode']) || empty($post['district_pcode'])) return false;
		if(!isset($post['district_code']) || empty($post['district_code'])) return false;
		if(!isset($post['district_depth']) || empty($post['district_depth'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY district_id
	*/
	public function delete($district_id)
	{
		return $this->db->delete('t_system_district',array('district_id' => $district_id));
	}
	
	/**
	 *description:根据子邮编获取地区信息
	 *author:yanyalong
	 *date:2013/11/14
	 */

	public function getbypid(){
		return $this->db->query("select district_id,district_code,district_name,district_pcode,district_depth from t_system_district where district_pcode = $this->district_pcode")->result_array(); 
	}
	public function getcityinfo($district_code){
		return $this->db->query("select * from t_system_district where district_code = $district_code")->row(); 
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
		return $this->db->update('t_system_district',$data,$where)?true:false;
	}
	
	/**
	 * 根据district_code 查内容
	 * @param arrray $where
	 * @return boolean
	 * @author liuguangping
	 * @version jia178 v1.0 2013/11/7
	 */
	public function get_data($where){
		return $this->db->get_where('t_system_district',$where)->result_array();
	}

	/**
	 *description:根据分类级别获取地区列表
	 *author:yanyalong
	 *date:2013/11/14
	 */
	public function getDepthByPcode(){
		return $this->db->query("select district_name,district_code from t_system_district where district_pcode = $this->district_pcode")->result_array(); 
	}
	
    /**
     *description:根据地区编码获取地区相关信息
     *author:yanyalong
     *date:2014/03/24
     */
    public function getInfoByCode(){
		return $this->db->query("select * from t_system_district where district_code = $this->district_code")->row(); 
    }

}
