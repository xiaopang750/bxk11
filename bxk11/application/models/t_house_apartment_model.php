<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/12 20:25:22 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_house_apartment_model extends CI_Model
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
	public $apartment_name;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_category_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_category;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(100)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_title;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_status;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_type;

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
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_size;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		float(8,2)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_schemes;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_views;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		char
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		char(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $housing_name;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_is_hot;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_is_recommend;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_sort;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_floors;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_floor_pic1;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_floor_pic2;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_floor_pic3;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		text
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		text
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $apartment_use_size;
	public $apartment_floor_pic4;

	public function __construct()
	{
		parent::__construct();

		$this->apartment_name="";
		$this->apartment_title="";
		$this->apartment_schemes=0;
		$this->apartment_views=0;
		$this->housing_name="";
		$this->apartment_is_hot=0;
		$this->apartment_is_recommend=0;
		$this->apartment_sort=0;
		$this->apartment_floors=0;
		$this->apartment_floor_pic2="";
		$this->apartment_floor_pic3="";
		$this->apartment_floor_pic4="";
		$this->apartment_use_size="";
		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY apartment_id
	 *
	 * @return 对象
	*/
	public function get($apartment_id)
	{
		return $this->db->get_where('t_house_apartment',array('apartment_id' => $apartment_id))->row();
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
	 * get_list(10,0) =>	select * from t_house_apartment limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'apartment_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_house_apartment', $limit, $offset)->result();
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
	public function get_all($order_field = 'apartment_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_house_apartment')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_house_apartment');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'apartment_id', $order_type = 'ASC')
	{
		$this->db->from('t_house_apartment')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_house_apartment')->like($field_name, $keywords);
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
		$this->db->insert('t_house_apartment', $this);
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
		return $this->db->update('t_house_apartment', $this, array('apartment_id' => $post['apartment_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['apartment_name']) || empty($post['apartment_name'])) return false;
		if(!isset($post['apartment_category_id']) || empty($post['apartment_category_id'])) return false;
		if(!isset($post['apartment_category']) || empty($post['apartment_category'])) return false;
		if(!isset($post['apartment_title']) || empty($post['apartment_title'])) return false;
		if(!isset($post['apartment_status']) || empty($post['apartment_status'])) return false;
		if(!isset($post['apartment_type']) || empty($post['apartment_type'])) return false;
		if(!isset($post['user_id']) || empty($post['user_id'])) return false;
		if(!isset($post['apartment_size']) || empty($post['apartment_size'])) return false;
		if(!isset($post['apartment_schemes']) || empty($post['apartment_schemes'])) return false;
		if(!isset($post['apartment_views']) || empty($post['apartment_views'])) return false;
		if(!isset($post['housing_name']) || empty($post['housing_name'])) return false;
		if(!isset($post['apartment_is_hot']) || empty($post['apartment_is_hot'])) return false;
		if(!isset($post['apartment_is_recommend']) || empty($post['apartment_is_recommend'])) return false;
		if(!isset($post['apartment_sort']) || empty($post['apartment_sort'])) return false;
		if(!isset($post['apartment_floors']) || empty($post['apartment_floors'])) return false;
		if(!isset($post['apartment_floor_pic1']) || empty($post['apartment_floor_pic1'])) return false;
		if(!isset($post['apartment_floor_pic2']) || empty($post['apartment_floor_pic2'])) return false;
		if(!isset($post['apartment_floor_pic3']) || empty($post['apartment_floor_pic3'])) return false;
		if(!isset($post['apartment_floor_pic4']) || empty($post['apartment_floor_pic4'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['apartment_id']) || empty($post['apartment_id'])) return false;
		if(!isset($post['apartment_name']) || empty($post['apartment_name'])) return false;
		if(!isset($post['apartment_category_id']) || empty($post['apartment_category_id'])) return false;
		if(!isset($post['apartment_category']) || empty($post['apartment_category'])) return false;
		if(!isset($post['apartment_title']) || empty($post['apartment_title'])) return false;
		if(!isset($post['apartment_status']) || empty($post['apartment_status'])) return false;
		if(!isset($post['apartment_type']) || empty($post['apartment_type'])) return false;
		if(!isset($post['user_id']) || empty($post['user_id'])) return false;
		if(!isset($post['apartment_size']) || empty($post['apartment_size'])) return false;
		if(!isset($post['apartment_schemes']) || empty($post['apartment_schemes'])) return false;
		if(!isset($post['apartment_views']) || empty($post['apartment_views'])) return false;
		if(!isset($post['housing_name']) || empty($post['housing_name'])) return false;
		if(!isset($post['apartment_is_hot']) || empty($post['apartment_is_hot'])) return false;
		if(!isset($post['apartment_is_recommend']) || empty($post['apartment_is_recommend'])) return false;
		if(!isset($post['apartment_sort']) || empty($post['apartment_sort'])) return false;
		if(!isset($post['apartment_floors']) || empty($post['apartment_floors'])) return false;
		if(!isset($post['apartment_floor_pic1']) || empty($post['apartment_floor_pic1'])) return false;
		if(!isset($post['apartment_floor_pic2']) || empty($post['apartment_floor_pic2'])) return false;
		if(!isset($post['apartment_floor_pic3']) || empty($post['apartment_floor_pic3'])) return false;
		if(!isset($post['apartment_floor_pic4']) || empty($post['apartment_floor_pic4'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY apartment_id
	*/
	public function delete($apartment_id)
	{
		return $this->db->delete('t_house_apartment',array('apartment_id' => $apartment_id));
	}
	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY s_class_id
	 *
	 * @return 对象
	 */
	public function get_apartment($field='apartment_id',$where)
	{
		return $this->db->select($field)->get_where('t_house_apartment',$where)->result();
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
		return $this->db->update('t_house_apartment',$data,$where)?true:false;
	}
	
	/**
	 *description:获取户型图
	 *author:yanyalong
	 *date:2013/12/15
	 */
	public function getFloorPic($apartment_category_id,$house_id,$user_id){
		return $this->db->query("select * from t_house_apartment where house_id=$house_id and apartment_category_id=$apartment_category_id and user_id in(0,$user_id) order by user_id")->result();
	}

	/**
	 *description:获取系统默认户型图
	 *author:yanyalong
	 *date:2013/12/15
	 */
	public function getApartmentInfoByHouseId($house_id){
		return $this->db->query("select * from t_house_apartment where house_id=$house_id and apartment_name='默认户型'")->row();
	}
	
	/**
	 * @abstract
	 * @author liuguangping
	 *
	 */
	public function admin_search_count($apartment_status='',$apartment_type='',$house_id='',$like_nickname='',$like_title='',$apartment_category_id=''){
		$where = " AND 1=1";
		if($apartment_status != ''){
			$where .=" AND s.apartment_status=".$apartment_status;
		}
	
		if($apartment_type !=''){
			$where .=" AND s.apartment_type=".$apartment_type;
		}
		if($house_id !='' && $house_id !=0){
			$where .=" AND s.house_id=".$house_id;
		}

		if($apartment_category_id !='' && $apartment_category_id !=0){
			
			$where .=" AND s.apartment_category_id=".$apartment_category_id;
		}
		
		if($apartment_type == 1 || $apartment_type==''){
			return $this->db->query("SELECT s.user_id,s.apartment_name FROM t_house_apartment as s WHERE s.apartment_name LIKE '%".$like_title."%'".$where)->result();
		}else{
			return $this->db->query("SELECT s.user_id,s.apartment_name FROM t_house_apartment as s left join (SELECT user_id,user_nickname FROM t_user) as u ON s.user_id = u.user_id WHERE u.user_nickname LIKE '%".$like_nickname."%' AND s.apartment_name LIKE '%".$like_title."%'".$where)->result();
		}
	
	
	}
	
	
	/**
	 * @abstract 方案和条件搜索
	 * @author liuguangping
	 */
	public function admin_search($apartment_status='',$apartment_type='',$house_id='',$like_nickname='',$like_title='',$apartment_category_id='',$offset=0,$limit=10){
		$where = " AND 1=1";
		if($apartment_status != ''){
			$where .=" AND s.apartment_status=".$apartment_status;
		}
	
		if($apartment_type !=''){
			$where .=" AND s.apartment_type=".$apartment_type;
		}
		if($house_id !='' && $house_id !=0){
			$where .=" AND s.house_id=".$house_id;
		}

		if($apartment_category_id !='' && $apartment_category_id !=0){
			
			$where .=" AND s.apartment_category_id=".$apartment_category_id;
		}
		
		if($apartment_type == 1  || $apartment_type==''){
 			 return $this->db->query("SELECT s.house_id,s.apartment_category_id,s.apartment_schemes,s.apartment_category,s.apartment_id,s.apartment_is_hot,s.apartment_name,s.user_id,s.apartment_type,s.apartment_views,s.apartment_size,s.apartment_is_recommend,s.apartment_views,s.apartment_status FROM t_house_apartment as s WHERE s.apartment_name LIKE '%".$like_title."%'".$where." ORDER BY s.apartment_id DESC LIMIT {$offset},{$limit}")->result();
 			 //echo $this->db->last_query();exit;
		}else{
			 return $this->db->query("SELECT u.user_nickname,s.house_id,s.apartment_schemes,s.apartment_category_id,s.apartment_category,s.apartment_id,s.apartment_is_hot,s.apartment_name,s.user_id,s.apartment_type,s.apartment_views,s.apartment_size,s.apartment_is_recommend,s.apartment_views,s.apartment_status FROM t_house_apartment as s left join (SELECT user_nickname,user_id FROM t_user) as u ON s.user_id = u.user_id WHERE u.user_nickname LIKE '%".$like_nickname."%' AND s.apartment_name LIKE '%".$like_title."%'".$where." ORDER BY s.apartment_id DESC LIMIT {$offset},{$limit}")->result();
			echo $this->db->last_query();exit;
		}
	
	
	}
	
}
