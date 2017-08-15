<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/17 11:40:32 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_project_room_plane_model extends CI_Model
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
	public $room_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $room_pics;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		text
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		text
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $room_content;

	public function __construct()
	{
		parent::__construct();

		$this->room_pics = 0;
		$this->room_content = "";
		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY room_id
	 *
	 * @return 对象
	 */
	public function get($room_id)
	{
		return $this->db->get_where('t_project_room_plane',array('room_id' => $room_id))->row();
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
	 * get_list(10,0) =>	select * from t_project_room_plane limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'room_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_project_room_plane', $limit, $offset)->result();
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
	public function get_all($order_field = 'room_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_project_room_plane')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_project_room_plane');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'room_id', $order_type = 'ASC')
	{
		$this->db->from('t_project_room_plane')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_project_room_plane')->like($field_name, $keywords);
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
		$this->db->insert('t_project_room_plane', $this);
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
		return $this->db->update('t_project_room_plane', $this, array('room_id' => $post['room_id']));
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
		if(!isset($post['room_id']) || empty($post['room_id'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY room_id
	 */
	public function delete($room_id)
	{
		return $this->db->delete('t_project_room_plane',array('room_id' => $room_id));
	}

	/**
	 *description:更新案例信息
	 *author:yanyalong
	 *date:2013/12/17
	 */
	public function uproomplane($room_id,$param){
		$set  = "set ";
		foreach ($param as $key=>$val) {
			$set .="$key='$val',";
		}		
		$set = trim($set,',');
		return $this->db->query("update t_project_room_plane $set  where room_id='$room_id'");
	}
	/**
	 *description:获取房间平面图片信息
	 *author:yanyalong
	 *date:2013/12/19
	 */
	public function roomContent($room_id){
		$res = $this->db->query("select * from t_project_room_plane where room_id='$room_id' limit 1")->row();
		if($res==false){
			return false;		
		}else{
			$data = array();
			$data['room_pics'] = $res->room_pics;
			if($res->room_content!=""){
				$this->config->load('uploads');		
				$config = $this->config->item("room_2d");		
				foreach (explode('|',$res->room_content) as $key=>$val) {
					$imgcontent= explode(':',$val);
					$thumb = array('source','thumb_1','thumb_2','thumb_3','thumb_4','thumb_5');		
					foreach ($thumb as $keys=>$vals) {
						$img = d2roomurl($room_id,$vals).$imgcontent['0'];
						if(!file_exists($_SERVER['DOCUMENT_ROOT'].$img)){
							$img = $config['default_1'];
						}
						$data['content'][$key][$vals] =$img;
					}
					$data['content'][$key]['con'] = $imgcontent['1'];
				}			
				return $data;
			}else{
				return false;	
			}
		}
	}
}
