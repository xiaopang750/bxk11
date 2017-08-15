<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/12 20:25:22 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_project_floor_model extends CI_Model
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
	public $floor_id;

	/**
	 * @COLUMN_KEY		MUL
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
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $floor_sort;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(200)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $floor_pic1;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(200)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $floor_pic2;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(200)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $floor_pic3;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(200)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $floor_pic4;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(200)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $floor_rooms;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		text
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		text
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $floor_map_coor;

	public function __construct()
	{
		parent::__construct();

		$this->floor_sort = 0;
		$this->floor_pic1 = "";
		$this->floor_pic2 = "";
		$this->floor_pic3 = "";
		$this->floor_pic4 = "";
		$this->floor_map_coor = "";
		$this->floor_rooms = 0;
		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY floor_id
	 *
	 * @return 对象
	 */
	public function get($floor_id)
	{
		return $this->db->get_where('t_project_floor',array('floor_id' => $floor_id))->row();
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
	 * get_list(10,0) =>	select * from t_project_floor limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'floor_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_project_floor', $limit, $offset)->result();
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
	public function get_all($order_field = 'floor_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_project_floor')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_project_floor');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'floor_id', $order_type = 'ASC')
	{
		$this->db->from('t_project_floor')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_project_floor')->like($field_name, $keywords);
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
		$this->db->insert('t_project_floor', $this);
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
		return $this->db->update('t_project_floor', $this, array('floor_id' => $post['floor_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['floor_sort']) || empty($post['floor_sort'])) return false;
		if(!isset($post['floor_pic1']) || empty($post['floor_pic1'])) return false;
		if(!isset($post['floor_pic2']) || empty($post['floor_pic2'])) return false;
		if(!isset($post['floor_pic3']) || empty($post['floor_pic3'])) return false;
		if(!isset($post['floor_pic4']) || empty($post['floor_pic4'])) return false;
		if(!isset($post['floor_rooms']) || empty($post['floor_rooms'])) return false;
		if(!isset($post['floor_map_coor']) || empty($post['floor_map_coor'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['floor_id']) || empty($post['floor_id'])) return false;
		if(!isset($post['floor_sort']) || empty($post['floor_sort'])) return false;
		if(!isset($post['floor_pic1']) || empty($post['floor_pic1'])) return false;
		if(!isset($post['floor_pic2']) || empty($post['floor_pic2'])) return false;
		if(!isset($post['floor_pic3']) || empty($post['floor_pic3'])) return false;
		if(!isset($post['floor_pic4']) || empty($post['floor_pic4'])) return false;
		if(!isset($post['floor_rooms']) || empty($post['floor_rooms'])) return false;
		if(!isset($post['floor_map_coor']) || empty($post['floor_map_coor'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	floor_room * @PRIMARY KEY floor_id
	 */
	public function delete($floor_id)
	{
		return $this->db->delete('t_project_floor',array('floor_id' => $floor_id));
	}

	/**
	 * 根据方案id楼层信息
	 * @param $scheme_id
	 * @author liuguangping
	 */
	public function getFloor($field='*',$where,$order_field='floor_id', $order_type='ASC'){
		
		return $this->db->select($field)->order_by($order_field, $order_type)->get_where('t_project_floor',$where)->result_array();
	
	}

	/**
	 *description:统计方案下楼层数
	 *author:yanyalong
	 *date:2013/12/19
	 */
	public function numByScheme($scheme_id){
		return $this->db->query("select count(*) count from t_project_floor where scheme_id='$scheme_id'")->row();
	}
	/**
	 *description:获取方案下的楼层列表信息
	 *author:yanyalong
	 *date:2013/12/19
	 */
	public function floorlist($scheme_id){
		return $this->db->query("select * from t_project_floor where scheme_id='$scheme_id'")->result();
	}


	/**
	 *description:更新楼层信息
	 *author:yanyalong
	 *date:2013/12/17
	 */
	public function upfloor($floor_id,$param){
		$set  = "set ";
		foreach ($param as $key=>$val) {
			$set .="$key='$val',";
		}		
		$set = trim($set,',');
		return $this->db->query("update t_project_floor $set  where floor_id='$floor_id'");
	}
	/**
	 *description:获取案例下的一楼第一个房间
	 *author:yanyalong
	 *date:2013/12/22
	 */
	public function getTheOneRoomByScheme($scheme_id){
		$schemeinfo = model("t_project_scheme")->get($scheme_id);
		if($schemeinfo==false){
			return "";
		}
		if($schemeinfo->scheme_user_type==2){
		$floor = $this->db->query("select * from t_project_floor where scheme_id='$scheme_id'")->row();
		if($floor==false||$floor->floor_map_coor==""){
			return "";	
		}
		$floorarr = explode(',',$floor->floor_map_coor);
		$room_id = $floorarr['0'];
		if($room_id!=""){
		return $room_id;
		}else{
			return "";	
		}
		}elseif($schemeinfo->scheme_user_type==1){
		$floor = $this->db->query("select * from t_project_floor where scheme_id='$scheme_id'")->row();
		if($floor==false){
			return "";	
		}else{
			$room = model("t_project_floor_room")->getRoomByDiyFloor($floor->floor_id);		
			if($room==false){
				return "";	
			}else{
				return $room->room_id;	
			}
		}
		}else{
			return "";	
		}
	}
	/**
	 *description:获取DIY案例下的一楼第一个房间
	 *author:yanyalong
	 *date:2013/12/22
	 */
	public function getTheOneRoomByDiyScheme($scheme_id){
		$floor = $this->db->query("select * from t_project_floor where scheme_id='$scheme_id'")->row();
		if($floor==false){
			return "";	
		}
		$room = $this->db->query("select * from t_project_floor_room where floor_id='$floor->floor_id'")->row();
		if($room!=false){
		return $room->room_id;
		}else{
			return "";	
		}
	}
}
