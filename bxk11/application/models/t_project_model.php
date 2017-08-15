<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/12 20:25:22 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_project_model extends CI_Model
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
	public $project_id;

	/**
	 * @COLUMN_KEY		MUL
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_id;

	/**
	 * @COLUMN_KEY		MUL
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $house_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $project_name;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $project_user_type;

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

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		float
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		float(8,2)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $project_budget;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		text
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		text
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $project_demand;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(20)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $project_owner;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $project_schemes;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $project_status;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		datetime
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		datetime
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $project_subtime;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(20)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $project_house_name;

	public function __construct()
	{
		parent::__construct();

		$this->project_schemes =0;
		$this->project_house_name ="";
		$this->apartment_id ="";
		$this->project_name = "";
		$this->project_budget = "";
		$this->project_demand= "";
		$this->project_owner= "";
		$this->project_house_name= "";
		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY project_id
	 *
	 * @return 对象
	*/
	public function get($project_id)
	{
		return $this->db->get_where('t_project',array('project_id' => $project_id))->row();
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
	 * get_list(10,0) =>	select * from t_project limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'project_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_project', $limit, $offset)->result();
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
	public function get_all($order_field = 'project_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_project')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_project');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'project_id', $order_type = 'ASC')
	{
		$this->db->from('t_project')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_project')->like($field_name, $keywords);
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
		$this->db->insert('t_project', $this);
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
		return $this->db->update('t_project', $this, array('project_id' => $post['project_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['project_name']) || empty($post['project_name'])) return false;
		if(!isset($post['project_user_type']) || empty($post['project_user_type'])) return false;
		if(!isset($post['user_id']) || empty($post['user_id'])) return false;
		if(!isset($post['project_budget']) || empty($post['project_budget'])) return false;
		if(!isset($post['project_demand']) || empty($post['project_demand'])) return false;
		if(!isset($post['project_owner']) || empty($post['project_owner'])) return false;
		if(!isset($post['project_schemes']) || empty($post['project_schemes'])) return false;
		if(!isset($post['project_status']) || empty($post['project_status'])) return false;
		if(!isset($post['project_subtime']) || empty($post['project_subtime'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['project_id']) || empty($post['project_id'])) return false;
		if(!isset($post['project_name']) || empty($post['project_name'])) return false;
		if(!isset($post['project_user_type']) || empty($post['project_user_type'])) return false;
		if(!isset($post['user_id']) || empty($post['user_id'])) return false;
		if(!isset($post['project_budget']) || empty($post['project_budget'])) return false;
		if(!isset($post['project_demand']) || empty($post['project_demand'])) return false;
		if(!isset($post['project_owner']) || empty($post['project_owner'])) return false;
		if(!isset($post['project_schemes']) || empty($post['project_schemes'])) return false;
		if(!isset($post['project_status']) || empty($post['project_status'])) return false;
		if(!isset($post['project_subtime']) || empty($post['project_subtime'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY project_id
	*/
	public function delete($project_id)
	{
		return $this->db->delete('t_project',array('project_id' => $project_id));
	}
	/**
	 *description:获取我的装修项目列表
	 *author:yanyalong
	 *date:2013/12/15
	 */
	public function projectlist($user_id){
		return $this->db->query("select * from t_project where user_id=$user_id and project_status<11")->result();
	}
	
	/**
	 *description:查询用户是否创建了同名项目
	 *author:yanyalong
	 *date:2013/12/16
	 */
	public function is_has($project_name,$user_id){
		return $this->db->query("select * from t_project where user_id=$user_id and project_name='$project_name'")->result();
	}
	/**
	 *description:查询用户是否创建了同名项目
	 *author:yanyalong
	 *date:2013/12/16
	 */
	public function is_hasByPid($project_id,$user_id){
		return $this->db->query("select * from t_project where user_id=$user_id and project_id='$project_id'")->row();
	}
	/**
	 *description:获取用户案例数
	 *author:yanyalong
	 *date:2013/12/24
	 */
	public function getSumSchemeByProject($user_id){
		//return $this->db->query("select sum(project_schemes) count from t_project where user_id=$user_id")->row();
	return $this->db->query("select count(*) count from t_project_scheme where user_id=$user_id")->row();
	}
	/**
	 *description：获取用户默认项目
	 *author:yanyalong
	 *date:2013/12/25
	 */
	public function GetProjectInfoByDefault($user_id){
		return $this->db->query("select * from t_project where user_id=$user_id and project_status=5")->row();
	}
	/**
	 *description:更新案例统计信息状态
	 *author:yanyalong
	 *date:2013/09/18
	 */
	public function project_status($project_id,$column,$type='+',$num='1'){
		if($project_id==''||$column==''||$type=='') return false;
		$this->db->query("update t_project set $column=$column$type$num where project_id=$project_id");
	}
	/**
	 *description:获取项目楼盘信息
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function getHouseInfoByProject($project_id){
		return $this->db->query("select * from t_project p left join t_house h on h.house_id=p.house_id where p.project_id=$project_id")->row();
	}
}
