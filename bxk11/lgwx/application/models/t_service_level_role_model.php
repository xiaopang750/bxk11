<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/05/16 11:35:21 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_service_level_role_model extends CI_Model
{
	public $la_id;

	public $service_type_id;

	public $la_rank;

	public $la_name;

	public $la_desc;

	public $la_auth;

	public $la_ico;

	public $la_score;

	public $la_voucher_price;

	public $la_buy_price;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY la_id
	 *
	 * @return 对象
	*/
	public function get($la_id)
	{
		return $this->db->get_where('t_service_level_role',array('la_id' => $la_id))->row();
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
	 * get_list(10,0) =>	select * from t_service_level_role limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'la_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_level_role', $limit, $offset)->result();
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
	public function get_all($order_field = 'la_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_level_role')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_service_level_role');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'la_id', $order_type = 'ASC')
	{
		$this->db->from('t_service_level_role')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_service_level_role')->like($field_name, $keywords);
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
		$this->db->insert('t_service_level_role', $this);
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
		return $this->db->update('t_service_level_role', $this, array('la_id' => $post['la_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['la_sort']) || empty($post['la_sort'])) return false;
		if(!isset($post['la_name']) || empty($post['la_name'])) return false;
		if(!isset($post['la_desc']) || empty($post['la_desc'])) return false;
		if(!isset($post['la_auth']) || empty($post['la_auth'])) return false;
		if(!isset($post['la_ico']) || empty($post['la_ico'])) return false;
		if(!isset($post['la_score']) || empty($post['la_score'])) return false;
		if(!isset($post['la_voucher_price']) || empty($post['la_voucher_price'])) return false;
		if(!isset($post['la_buy_price']) || empty($post['la_buy_price'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['la_id']) || empty($post['la_id'])) return false;
		if(!isset($post['la_sort']) || empty($post['la_sort'])) return false;
		if(!isset($post['la_name']) || empty($post['la_name'])) return false;
		if(!isset($post['la_desc']) || empty($post['la_desc'])) return false;
		if(!isset($post['la_auth']) || empty($post['la_auth'])) return false;
		if(!isset($post['la_ico']) || empty($post['la_ico'])) return false;
		if(!isset($post['la_score']) || empty($post['la_score'])) return false;
		if(!isset($post['la_voucher_price']) || empty($post['la_voucher_price'])) return false;
		if(!isset($post['la_buy_price']) || empty($post['la_buy_price'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY la_id
	*/
	public function delete($la_id)
	{
		return $this->db->delete('t_service_level_role',array('la_id' => $la_id));
	}

	/**
	 * 根据条件搜索房间
	 * @param Int $brand_id 品牌id
	 * @param Int $series_id 系列id
	 * @param Int $pattern_id 款式id
	 * @param Int $service_id  服务商id
	 * @param Int $code 品牌编号,平台编号
	 * @param Int $key_word  关键词
	 *
	 */
	
	public function admin_search_count($service_type_id,$key_word){
		$where= "1=1";
	
		if($service_type_id){
			$where.=" AND service_type_id=".$service_type_id;
		}
		
		return $this->db->query("SELECT * FROM t_service_level_role WHERE $where AND la_name like '%".$key_word."%'")->result();
	
	}
	
	/**
	 * 根据条件搜索房间
	 * @param Int $brand_id 品牌id
	 * @param Int $series_id 系列id
	 * @param Int $pattern_id 款式id
	 * @param Int $service_id  服务商id
	 * @param Int $code 品牌编号,平台编号
	 * @param Int $key_word  关键词
	 *
	 */
	
	public function admin_search($service_type_id,$key_word,$offset,$limit){
		$where= "1=1";
	
		if($service_type_id){
			$where.=" AND service_type_id=".$service_type_id;
		}
		 return $this->db->query("SELECT * FROM t_service_level_role WHERE $where AND la_name like '%".$key_word."%' ORDER BY la_rank asc,la_id asc LIMIT {$offset},{$limit}")->result();

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
		return $this->db->update('t_service_level_role',$data,$where)?true:false;
	}
	
	/**
	 * 根据条件得到单条记录
	 *
	 * @PRIMARY KEY rwfr_id
	 *
	 * @return 对象
	 */
	public function getOne($field='la_id',$where)
	{
		 return $this->db->select($field)->get_where('t_service_level_role',$where)->row();
	}	

	/**
	 * 根据service_id 和 wid 来查找主键
	 *
	 * @PRIMARY KEY sw_id
	*/
	public function getArray($field='la_id',$where){
		return $this->db->select($field)->get_where('t_service_level_role',$where)->result();
	}

	public function getValueName($field,$where){
        return $this->db->select($field)->get_where('t_service_level_role',$where)->row();	
    }
	
    /**
     *description:根据服务商级别获取基本权限信息
     *author:yanyalong
     *date:2014/05/22
     */
    public function getRoleByRank($la_rank){
        return $this->db->query("select * from t_service_level_role where la_rank='$la_rank'")->row();
    }
}
