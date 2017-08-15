<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/12 20:25:23 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_project_room_model extends CI_Model
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
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $room_name;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(10)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $room_capability;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $room_size;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		text
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		text
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $room_thinking;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $room_sort;

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
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $room_type;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $room_downs;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		text
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		text
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $room_hotpints;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		datetime
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		datetime
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $room_subtime;
	public $room_keyword;
	public $room_status;
	public $room_is_hot;
	public $room_views;


	public function __construct()
	{
		parent::__construct();

		$this->room_name = "";
		$this->room_capability = "";
		$this->room_size = "";
		$this->room_thinking = "";
		$this->room_sort = 0;
		$this->room_downs = 0;
		$this->room_hotpints = "";
		$this->room_status = "21";
		$this->room_is_hot= 0;
		$this->room_views= 0;
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
		return $this->db->get_where('t_project_room',array('room_id' => $room_id))->row();
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
	 * get_list(10,0) =>	select * from t_project_room limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'room_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_project_room', $limit, $offset)->result();
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
		return $this->db->get('t_project_room')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_project_room');
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
		$this->db->from('t_project_room')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_project_room')->like($field_name, $keywords);
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
		$this->db->insert('t_project_room', $this);
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
		return $this->db->update('t_project_room', $this, array('room_id' => $post['room_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['room_name']) || empty($post['room_name'])) return false;
		if(!isset($post['room_capability']) || empty($post['room_capability'])) return false;
		if(!isset($post['room_size']) || empty($post['room_size'])) return false;
		if(!isset($post['room_thinking']) || empty($post['room_thinking'])) return false;
		if(!isset($post['room_sort']) || empty($post['room_sort'])) return false;
		if(!isset($post['user_id']) || empty($post['user_id'])) return false;
		if(!isset($post['room_downs']) || empty($post['room_downs'])) return false;
		if(!isset($post['room_hotpints']) || empty($post['room_hotpints'])) return false;
		if(!isset($post['room_subtime']) || empty($post['room_subtime'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['room_id']) || empty($post['room_id'])) return false;
		if(!isset($post['room_name']) || empty($post['room_name'])) return false;
		if(!isset($post['room_capability']) || empty($post['room_capability'])) return false;
		if(!isset($post['room_size']) || empty($post['room_size'])) return false;
		if(!isset($post['room_thinking']) || empty($post['room_thinking'])) return false;
		if(!isset($post['room_sort']) || empty($post['room_sort'])) return false;
		if(!isset($post['user_id']) || empty($post['user_id'])) return false;
		if(!isset($post['room_downs']) || empty($post['room_downs'])) return false;
		if(!isset($post['room_hotpints']) || empty($post['room_hotpints'])) return false;
		if(!isset($post['room_subtime']) || empty($post['room_subtime'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY room_id
	 */
	public function delete($room_id)
	{
		return $this->db->delete('t_project_room',array('room_id' => $room_id));
	}

	/**
	 *description:更新房间信息
	 *author:yanyalong
	 *date:2013/12/17
	 */
	public function uproom($room_id,$param){
		$set  = "set ";
		foreach ($param as $key=>$val) {
			$set .="$key='$val',";
		}		
		$set = trim($set,',');
		return $this->db->query("update t_project_room $set  where room_id='$room_id'");
	}
	/**
	 *description:修改房间状态
	 *author:yanyalong
	 *date:2013/12/17
	 */
	public function modRoomStatus($room_id,$status){
		return $this->db->query("update t_project_room set room_status=$status  where room_id='$room_id'");
	}
	/**
	 *  判断是否存在否则是否删除
	 *  @author liuguangping
	 */
	
	public function is_room($where=''){
		//var_dump($where);die;
		$wheres = '';
		if($where){
			foreach($where as $key=>$value){
				$wheres.=' and '.$key.'='.$value;
			}
		}else{
			$wheres = '';
		}

		return $this->db->query("select * from t_project_room where 1=1{$wheres}")->row_array()?true:false;
	}
	
	/**
	 * 根据条件查找内容
	 * @author liuguangping
	 */
	public function select_where($where='',$order_field = 'room_id', $order_type = 'ASC'){
		$childwhere = '';
		if($where){
			foreach($where as $key=>$value){
				$childwhere.=' and '.$key.'='.$value;
			}
		}
		return $this->db->query("select * from t_project_room where 1=1{$childwhere} order by {$order_field} {$order_type}")->result_array();
	}
	
	
	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY
	 *
	 * @return 对象
	 */
	public function get_room()
	{
		return $this->db->query("SELECT room_id FROM t_project_room WHERE room_status IN (1,11,12)")->result_array();
	}

	
	
	/**
	 * @abstract 样板间
	 *
	 */
	public function admin_search_count($room_status='',$room_type='',$a_start='',$a_end='',$like_nickname='',$like_title=''){
		$where = "AND 1=1";
		if($room_status != ''){
			$where .=" AND r.room_status=".$room_status;
		}
	
		if($room_type !=''){
			$where .=" AND r.room_type=".$room_type;
		}
	
		if($a_start != ''){
			$where .= " AND r.room_subtime >='".$a_start."'";
		}
		if($a_end !=''){
			$where .= " AND r.room_subtime <='".$a_end."'";
		}
	
		return $this->db->query("SELECT r.user_id,r.room_name FROM t_project_room as r left join (SELECT user_id,user_nickname FROM t_user) as u ON r.user_id = u.user_id WHERE u.user_nickname LIKE '%".$like_nickname."%' AND r.room_name LIKE '%".$like_title."%'".$where)->result();
	
	}
	
	
	/**
	 * @abstract 方案和条件搜索
	 *
	 */
	public function admin_search($room_status='',$room_type='',$a_start='',$a_end='',$like_nickname='',$like_title='',$offset=0,$limit=10){
		$where = "AND 1=1";
		if($room_status != ''){
			$where .=" AND r.room_status=".$room_status;
		}
	
		if($room_type !=''){
			$where .=" AND r.room_type=".$room_type;
		}
	
		if($a_start != ''){
			$where .= " AND r.room_subtime >='".$a_start."'";
		}
		if($a_end !=''){
			$where .= " AND r.room_subtime <='".$a_end."'";
		}
	
	
		return $this->db->query("SELECT u.user_nickname,r.room_id,r.room_is_hot,r.room_name,r.user_id,r.room_thinking,r.room_downs,r.room_type,r.room_subtime,r.room_status,r.room_thinking FROM t_project_room as r left join (SELECT user_nickname,user_id FROM t_user) as u ON r.user_id = u.user_id WHERE u.user_nickname LIKE '%".$like_nickname."%' AND r.room_name LIKE '%".$like_title."%'".$where." ORDER BY r.room_sort DESC,r.room_id DESC LIMIT {$offset},{$limit}")->result();
		//echo $this->db->last_query();exit;
	}
	
	/**
	 *  查找是否正常的方案
	 */
	public function is_rooms($where){
	
		return $this->db->query('SELECT room_id,scheme_id FROM t_project_room WHERE room_id IN ('.$where.') AND room_status=1 AND room_type=2')->result_array();
	
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
		return $this->db->update('t_project_room',$data,$where)?true:false;
	}
	/**
	 *description:根据样板间id列表获取样板间列表信息
	 *author:yanyalong
	 *date:2013/12/23
	 */
	public function getRoomById($room_idlist,$p="1",$row="6"){
		$limit = " limit ".($p-1)*$row.",".$row;
		return $this->db->query("select * from t_project_room r left join t_user u on u.user_id=r.user_id where r.room_id in ($room_idlist) $limit")->result();
	}

	/**
	 *description:获取案例的房间列表
	 *author:yanyalong
	 *date:2013/12/22
	 */
	public function getTheRoomListByTheme($scheme_id,$room_id=""){
		$where = "";
		if($room_id!=""){
			$where = " and room_id<>$room_id ";
		}
		$schemeinfo = model("t_project_scheme")->get($scheme_id);
		if($schemeinfo==false) return false;
		switch ($schemeinfo->scheme_user_type) {
			case '1':
			return $this->db->query("select * from t_project_room where room_id in (select room_id from t_project_floor_room where floor_id in (select floor_id from t_project_floor where scheme_id=$scheme_id)) $where and room_status<11 order by room_id desc")->result();
				break;
			case '2':
			return $this->db->query("select * from t_project_room where scheme_id=$scheme_id and room_status<11 $where order by room_id desc")->result();
				break;
		}
	}
	/**
	 *description:获取案例的房间列表
	 *author:yanyalong
	 *date:2013/12/22
	 */
	public function getTheRoomInfoById($room_id){
		return $this->db->query("select * from t_project_room pr left join  t_project_scheme ps on ps.scheme_id=pr.scheme_id left join t_project p on p.project_id=ps.project_id left join t_user_info ui on ui.user_id=pr.user_id left join t_project_floor_room pfr on pr.room_id=pfr.room_id left join t_project_floor pf on pf.floor_id=pfr.floor_id left join t_user u on u.user_id=pr.user_id where pr.room_id=$room_id")->row();
	}
	
	/**
	 *description:获取案例的房间列表
	 *author:liuguangping
	 *date:2014/2/26
	 */
	public function getRoomInfo($room_id){
		return $this->db->query("select * from t_project_room where room_id=$room_id")->row();
	}
	/**
	 *description:更新房间统计信息状态
	 *author:yanyalong
	 *date:2013/09/18
	 */
	public function room_status($room_id,$column,$type='+',$num='1'){
		if($room_id==''||$column==''||$type=='') return false;
		$this->db->query("update t_project_room set $column=$column$type$num where room_id=$room_id");
	}
	/**
	 *description:获取用户房间列表
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function getRoomListByUserId($user_id,$p,$row){
		$limit = " limit ".($p-1)*$row.",".$row;
		$user= model("t_user")->get($user_id);
		if($user->group_id<20){
			$scheme_user_type = 1;
		}elseif($user->group_id>20&&$user->group_id<30){
			$scheme_user_type = 2;
		}		
		return $this->db->query("select * from t_project_floor_room  where floor_id in(select f.floor_id from t_project_scheme ps left join t_project_floor f on ps.scheme_id=f.scheme_id where ps.user_id=$user_id and ps.scheme_status<99 and ps.scheme_user_type=$scheme_user_type) order by floor_room_id desc $limit")->result();
	}
}
