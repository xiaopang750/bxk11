<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/21 12:18:44 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_project_scheme_use_model extends CI_Model
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
	public $scheme_use_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $project_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(20)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_use_name;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		timestamp
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	CURRENT_TIMESTAMP
	 * @COLUMN_TYPE		timestamp
	 * @EXTRA			on update CURRENT_TIMESTAMP
	 * @COLUMN_COMMENT	
	 */
	public $scheme_use_addtime;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->scheme_use_name = "";
		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY scheme_use_id
	 *
	 * @return 对象
	 */
	public function get($scheme_use_id)
	{
		return $this->db->get_where('t_project_scheme_use',array('scheme_use_id' => $scheme_use_id))->row();
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
	 * get_list(10,0) =>	select * from t_project_scheme_use limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'scheme_use_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_project_scheme_use', $limit, $offset)->result();
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
	public function get_all($order_field = 'scheme_use_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_project_scheme_use')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_project_scheme_use');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'scheme_use_id', $order_type = 'ASC')
	{
		$this->db->from('t_project_scheme_use')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_project_scheme_use')->like($field_name, $keywords);
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
		$this->db->insert('t_project_scheme_use', $this);
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
		return $this->db->update('t_project_scheme_use', $this, array('scheme_use_id' => $post['scheme_use_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['scheme_use_name']) || empty($post['scheme_use_name'])) return false;
		if(!isset($post['scheme_use_addtime']) || empty($post['scheme_use_addtime'])) return false;
		if(!isset($post['user_id']) || empty($post['user_id'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['scheme_use_id']) || empty($post['scheme_use_id'])) return false;
		if(!isset($post['scheme_use_name']) || empty($post['scheme_use_name'])) return false;
		if(!isset($post['scheme_use_addtime']) || empty($post['scheme_use_addtime'])) return false;
		if(!isset($post['user_id']) || empty($post['user_id'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY scheme_use_id
	 */
	public function delete($scheme_use_id)
	{
		return $this->db->delete('t_project_scheme_use',array('scheme_use_id' => $scheme_use_id));
	}

	/**
	 *description:获取案例应用信息
	 *author:yanyalong
	 *date:2013/12/25
	 */
	public function getSchemeUseByProjectSchemeUser($project_id,$scheme_id,$user_id){
		return $this->db->query("select * from t_project_scheme_use where project_id=$project_id and scheme_id=$scheme_id and user_id=$user_id")->row();
	}
	/**
	 *description:更新案例统计信息状态
	 *author:yanyalong
	 *date:2013/09/18
	 */
	public function scheme_status($scheme_use_id,$project_id,$user_id,$status,$type){
		return $this->db->query("update t_project_scheme_use set scheme_use_is_now=$status where scheme_use_id $type $scheme_use_id and project_id=$project_id and user_id=$user_id");
	}
	/**
	 *description:获取普通用户默认案例
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function getDefaultByUser($user_id,$project_id){
		return $this->db->query("select * from t_project_scheme_use where user_id=$user_id and project_id=$project_id and scheme_use_is_now=1")->row();
	}
	/**
	 *description:获取普通用户案例列表
	 *author:yanyalong
	 *date:2013/12/28
	 */
	public function getSchemeListByCommonUserId($user_id,$p="0",$row="0"){
		$limit = "";
		if($p!="0"&&$row!="0"){
			$limit = ' limit '.($p-1)*$row.','.$row;
		}
		return $this->db->query("select *,ps.user_id from t_project_scheme ps left join t_project p on p.project_id=ps.project_id left join t_house h on h.house_id=p.house_id left join t_house_apartment ha on ha.apartment_id=p.apartment_id left join t_user u on u.user_id=ps.user_id left join t_user_info ui on ui.user_id=u.user_id where ps.scheme_id in (select scheme_id from t_project_scheme_use where user_id=$user_id) and ps.scheme_status<99  order by ps.scheme_id desc $limit")->result();
	}
}
