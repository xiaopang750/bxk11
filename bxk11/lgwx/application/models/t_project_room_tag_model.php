<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/12 20:25:23 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_project_room_tag_model extends CI_Model
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
	public $room_tag_id;



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
	public $tag_id;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY room_tag_id
	 *
	 * @return 对象
	*/
	public function get($room_tag_id)
	{
		return $this->db->get_where('t_project_room_tag',array('room_tag_id' => $room_tag_id))->row();
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
	 * get_list(10,0) =>	select * from t_project_room_tag limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'room_tag_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_project_room_tag', $limit, $offset)->result();
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
	public function get_all($order_field = 'room_tag_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_project_room_tag')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_project_room_tag');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'room_tag_id', $order_type = 'ASC')
	{
		$this->db->from('t_project_room_tag')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_project_room_tag')->like($field_name, $keywords);
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
		$this->db->insert('t_project_room_tag', $this);
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
		return $this->db->update('t_project_room_tag', $this, array('room_tag_id' => $post['room_tag_id']));
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
		if(!isset($post['room_tag_id']) || empty($post['room_tag_id'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY room_tag_id
	*/
	public function delete($room_tag_id)
	{
		return $this->db->delete('t_project_room_tag',array('room_tag_id' => $room_tag_id));
	}
	/**
	 *description:删除房间标签数据
	 *author:yanyalong
	 *date:2013/12/16
	 */
	public function delTagByRoom($room_id){
		$this->db->query("delete from t_project_room_tag where room_id='$room_id'");
	}
	/**
	 *description:获取房间标签列表
	 *author:yanyalong
	 *date:2013/12/20
	 */
	public function getTaglist($room_id){
		$res = $this->db->query("select * from t_project_room_tag where room_id='$room_id'")->result();
		if($res==false){
			return false;
		}else{
			$tags = array();
			$tags[] = $res['0']->tag_id;
			$tags[] = $res['1']->tag_id;
			$tags[] = $res['2']->tag_id;
		}
		return $tags;
	}
	/**
	 *description:获取房间的标签信息
	 *author:yanyalong
	 *date:2013/12/23
	 */
	public function getTagByRoom($room_id){
		return $this->db->query("select * from t_project_room_tag r left join t_tag t on t.tag_id=r.tag_id where room_id='$room_id'")->result();
	}
	/**
	 *description:根据房间id获取房间功能
	 *author:yanyalong
	 *date:2013/12/24
	 */
	public function getFuncByRoomId($room_id,$s_class_name){
		return $this->db->query("select * from t_project_room_tag r left join t_tag t on t.tag_id=r.tag_id left join t_s_class_tag tsc on tsc.s_tag_id=t.tag_id left join t_system_class sc on tsc.s_class_id=sc.s_class_id where r.room_id='$room_id' and sc.s_class_name='$s_class_name'")->row();
	}
}