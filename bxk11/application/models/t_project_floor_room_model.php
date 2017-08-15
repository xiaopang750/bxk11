<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/12 20:25:22 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_project_floor_room_model extends CI_Model
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
	public $floor_room_id;

	/**
	 * @COLUMN_KEY		MUL
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $room_id;

	/**
	 * @COLUMN_KEY		MUL
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $floor_id;

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

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY floor_room_id
	 *
	 * @return 对象
	*/
	public function get($floor_room_id)
	{
		return $this->db->get_where('t_project_floor_room',array('floor_room_id' => $floor_room_id))->row();
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
	 * get_list(10,0) =>	select * from t_project_floor_room limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'floor_room_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_project_floor_room', $limit, $offset)->result();
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
	public function get_all($order_field = 'floor_room_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_project_floor_room')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_project_floor_room');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'floor_room_id', $order_type = 'ASC')
	{
		$this->db->from('t_project_floor_room')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_project_floor_room')->like($field_name, $keywords);
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
		$this->db->insert('t_project_floor_room', $this);
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
		return $this->db->update('t_project_floor_room', $this, array('floor_room_id' => $post['floor_room_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['user_id']) || empty($post['user_id'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['floor_room_id']) || empty($post['floor_room_id'])) return false;
		if(!isset($post['user_id']) || empty($post['user_id'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY floor_room_id
	*/
	public function delete($floor_room_id)
	{
		return $this->db->delete('t_project_floor_room',array('floor_room_id' => $floor_room_id));
	}
	/**
	 *description:删除房间标签数据
	 *author:yanyalong
	 *date:2013/12/16
	 */
	public function delByRoom($room_id){
		$this->db->query("delete from t_project_floor_room where room_id='$room_id'");
	}
	/**
	 *description:获取楼下的所有房间
	 *author:yanyalong
	 *date:2013/12/19
	 */
	public function getRoomByFloor($floor_id){
		return	$this->db->query("select * from t_project_floor_room fr left join t_project_room pr on pr.room_id=fr.room_id where fr.floor_id='$floor_id' and pr.room_status<99 limit 10")->result();
	}
	
	public function getFloorbyAll($floor_id){
		return	$this->db->query("select * from t_project_floor_room fr left join t_project_room pr on pr.room_id=fr.room_id where fr.floor_id='$floor_id' and pr.room_status not in(99,11,12) order by fr.room_id asc")->result_array();
	}
	/**
	 *description:获取楼下的所有房间
	 *author:yanyalong
	 *date:2013/12/19
	 */
	public function getFloorByRoom($room_id){
	return	$this->db->query("select * from t_project_floor_room where room_id='$room_id'")->result();
	}
	/**
	 *description:获取楼下的所有房间
	 *author:yanyalong
	 *date:2013/12/19
	 */
	public function getListByFloorRoom($floor_id,$room_id){
		return	$this->db->query("select * from t_project_floor_room fr left join t_project_room pr on pr.room_id=fr.room_id where fr.floor_id='$floor_id' and fr.room_id='$room_id' and pr.room_status<99")->result();
	}
	/**
	 *description:获取diy案例楼层的第一个房间
	 *author:yanyalong
	 *date:2014/01/01
	 */
	public function getRoomByDiyFloor($floor_id){
		return	$this->db->query("select * from t_project_floor_room where floor_id='$floor_id'")->row();
	}
	/**
	 * 根据房间id得到diy方案
	 * @param unknown_type $room_id
	 */
	public function getRoomidByDiyScheme($room_id){
		if(is_numeric($room_id) && isset($room_id) && $room_id != ''){
			return $this->db->query("SELECT scheme_id FROM t_project_scheme WHERE scheme_type=2 AND scheme_user_type=1 AND scheme_id IN (SELECT scheme_id FROM t_project_floor WHERE floor_id IN (SELECT floor_id FROM t_project_floor_room WHERE room_id={$room_id}))")->result_array();
		}else{
			return false;
		}
	}
	
}
