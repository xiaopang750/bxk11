<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/12 20:25:23 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_project_scheme_model extends CI_Model
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
	public $scheme_id;

	/**
	 * @COLUMN_KEY		MUL
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
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
	public $scheme_name;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_designer_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(20)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_designer;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		text
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		text
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_thinking;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		float
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		float(8,2)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_cost;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_type;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_user_type;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_floors;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_rooms;

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
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_status;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_views;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_likes;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_disc;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_share;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_is_free;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_album;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_is_public;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(16)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_password;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		datetime
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		datetime
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_password_validity;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_xml;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_sort;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		datetime
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		datetime
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $scheme_subtime;
	public $scheme_is_hot;


	public function __construct()
	{
		parent::__construct();
		$this->scheme_name = "";
		$this->scheme_thinking = "";
		$this->scheme_cost = "";
		$this->scheme_type= "";
		$this->scheme_user_type= "";
		$this->scheme_floors =0;
		$this->scheme_rooms = 1;
		$this->scheme_views = 0;
		$this->scheme_downs = 0;
		$this->scheme_likes = 0;
		$this->scheme_disc= 0;
		$this->scheme_share= 0;
		$this->scheme_is_free= "";
		$this->scheme_album= 0;
		$this->scheme_is_public=1;
		$this->scheme_password= "";
		$this->scheme_xml= "";
		$this->scheme_sort= 0;
		$this->scheme_is_hot= 0;
		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY scheme_id
	 *
	 * @return 对象
	 */
	public function get($scheme_id)
	{
		return $this->db->get_where('t_project_scheme',array('scheme_id' => $scheme_id))->row();
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
	 * get_list(10,0) =>	select * from t_project_scheme limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'scheme_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_project_scheme', $limit, $offset)->result();
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
	public function get_all($order_field = 'scheme_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_project_scheme')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_project_scheme');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'scheme_id', $order_type = 'ASC')
	{
		$this->db->from('t_project_scheme')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_project_scheme')->like($field_name, $keywords);
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
		$this->db->insert('t_project_scheme', $this);
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
		return $this->db->update('t_project_scheme', $this, array('scheme_id' => $post['scheme_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['scheme_name']) || empty($post['scheme_name'])) return false;
		if(!isset($post['scheme_designer_id']) || empty($post['scheme_designer_id'])) return false;
		if(!isset($post['scheme_designer']) || empty($post['scheme_designer'])) return false;
		if(!isset($post['scheme_thinking']) || empty($post['scheme_thinking'])) return false;
		if(!isset($post['scheme_cost']) || empty($post['scheme_cost'])) return false;
		if(!isset($post['scheme_type']) || empty($post['scheme_type'])) return false;
		if(!isset($post['scheme_user_type']) || empty($post['scheme_user_type'])) return false;
		if(!isset($post['scheme_floors']) || empty($post['scheme_floors'])) return false;
		if(!isset($post['scheme_rooms']) || empty($post['scheme_rooms'])) return false;
		if(!isset($post['user_id']) || empty($post['user_id'])) return false;
		if(!isset($post['scheme_status']) || empty($post['scheme_status'])) return false;
		if(!isset($post['scheme_views']) || empty($post['scheme_views'])) return false;
		if(!isset($post['scheme_likes']) || empty($post['scheme_likes'])) return false;
		if(!isset($post['scheme_disc']) || empty($post['scheme_disc'])) return false;
		if(!isset($post['scheme_share']) || empty($post['scheme_share'])) return false;
		if(!isset($post['scheme_is_free']) || empty($post['scheme_is_free'])) return false;
		if(!isset($post['scheme_project']) || empty($post['scheme_project'])) return false;
		if(!isset($post['scheme_is_public']) || empty($post['scheme_is_public'])) return false;
		if(!isset($post['scheme_password']) || empty($post['scheme_password'])) return false;
		if(!isset($post['scheme_password_validity']) || empty($post['scheme_password_validity'])) return false;
		if(!isset($post['scheme_xml']) || empty($post['scheme_xml'])) return false;
		if(!isset($post['scheme_subtime']) || empty($post['scheme_subtime'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['scheme_id']) || empty($post['scheme_id'])) return false;
		if(!isset($post['scheme_name']) || empty($post['scheme_name'])) return false;
		if(!isset($post['scheme_designer_id']) || empty($post['scheme_designer_id'])) return false;
		if(!isset($post['scheme_designer']) || empty($post['scheme_designer'])) return false;
		if(!isset($post['scheme_thinking']) || empty($post['scheme_thinking'])) return false;
		if(!isset($post['scheme_cost']) || empty($post['scheme_cost'])) return false;
		if(!isset($post['scheme_type']) || empty($post['scheme_type'])) return false;
		if(!isset($post['scheme_user_type']) || empty($post['scheme_user_type'])) return false;
		if(!isset($post['scheme_floors']) || empty($post['scheme_floors'])) return false;
		if(!isset($post['scheme_rooms']) || empty($post['scheme_rooms'])) return false;
		if(!isset($post['user_id']) || empty($post['user_id'])) return false;
		if(!isset($post['scheme_status']) || empty($post['scheme_status'])) return false;
		if(!isset($post['scheme_views']) || empty($post['scheme_views'])) return false;
		if(!isset($post['scheme_likes']) || empty($post['scheme_likes'])) return false;
		if(!isset($post['scheme_disc']) || empty($post['scheme_disc'])) return false;
		if(!isset($post['scheme_share']) || empty($post['scheme_share'])) return false;
		if(!isset($post['scheme_is_free']) || empty($post['scheme_is_free'])) return false;
		if(!isset($post['scheme_project']) || empty($post['scheme_project'])) return false;
		if(!isset($post['scheme_is_public']) || empty($post['scheme_is_public'])) return false;
		if(!isset($post['scheme_password']) || empty($post['scheme_password'])) return false;
		if(!isset($post['scheme_password_validity']) || empty($post['scheme_password_validity'])) return false;
		if(!isset($post['scheme_xml']) || empty($post['scheme_xml'])) return false;
		if(!isset($post['scheme_subtime']) || empty($post['scheme_subtime'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY scheme_id
	 */
	public function delete($scheme_id)
	{
		return $this->db->delete('t_project_scheme',array('scheme_id' => $scheme_id));
	}

	/**
	 *description:获取我的装修案例
	 *author:yanyalong
	 *date:2013/12/16
	 */
	public function schemelist($user_id,$project_id,$scheme_type){
		return	$this->db->query("select * from t_project_scheme where user_id=$user_id and scheme_status<99 and scheme_type=$scheme_type and project_id=$project_id")->result();
	}
	/**
	 *description:查询用户是否创建了同名案例
	 *author:yanyalong
	 *date:2013/12/16
	 */
	public function is_has($scheme_name,$user_id,$project_id){
		return $this->db->query("select * from t_project_scheme where user_id=$user_id and project_id=$project_id and scheme_name='$scheme_name' and scheme_status<30")->result();
	}
	/**
	 *description:更新案例信息
	 *author:yanyalong
	 *date:2013/12/17
	 */
	public function upscheme($scheme_id,$param){
		$set  = "set ";
		foreach ($param as $key=>$val) {
			$set .="$key='$val',";
		}		
		$set = trim($set,',');
		return $this->db->query("update t_project_scheme $set  where scheme_id='$scheme_id'");
	}

	/**
	 *description:根据案例id列表获取案例列表信息
	 *author:yanyalong
	 *date:2013/12/22
	 */
	public function schemeListById($scheme_idlist,$p='1',$row='5'){
		$limit = " limit ".($p-1)*$row.",".$row;
		return $this->db->query("select * from t_project_scheme s left join t_project p on p.project_id=s.project_id left join t_user u on u.user_id=s.user_id where s.scheme_id in($scheme_idlist) and s.scheme_status=1 $limit")->result();
	}
	/**
	 *description:根据用户id获取案例列表信息
	 *author:yanyalong
	 *date:2013/12/22
	 */
	public function schemeListByUser($user_idlist,$p='1',$row='5'){
		$limit = " limit ".($p-1)*$row.",".$row;
		return $this->db->query("select * from t_project_scheme s left join t_project p on p.project_id=s.project_id left join t_user u on u.user_id=s.user_id left join t_user_info i on i.user_id=s.user_id where s.scheme_status=1 and s.user_id in($user_idlist) order by s.scheme_id desc $limit")->result();
	}

	/**
	 * @abstract 方案
	 * @author liuguangping
	 *
	 */
	public function admin_search_count($scheme_status='',$scheme_type='',$a_start='',$a_end='',$like_nickname='',$like_title='',$scheme_user_type=''){
		$where = "AND 1=1";
		if($scheme_status != ''){
			$where .=" AND s.scheme_status=".$scheme_status;
		}

		if($scheme_type !=''){
			$where .=" AND s.scheme_type=".$scheme_type;
		}

		if($a_start != ''){
			$where .= " AND s.scheme_subtime >='".$a_start."'";
		}
		if($a_end !=''){
			$where .= " AND s.scheme_subtime <='".$a_end."'";
		}
		if($scheme_user_type !=''){
			$where .=" AND s.scheme_user_type=".$scheme_user_type;
		}
		return $this->db->query("SELECT s.user_id,s.scheme_name FROM t_project_scheme as s left join (SELECT user_id,user_nickname FROM t_user) as u ON s.user_id = u.user_id WHERE u.user_nickname LIKE '%".$like_nickname."%' AND s.scheme_name LIKE '%".$like_title."%'".$where)->result();

	}


	/**
	 * @abstract 方案和条件搜索
	 * @author liuguangping
	 *
	 */
	public function admin_search($scheme_status='',$scheme_type='',$a_start='',$a_end='',$like_nickname='',$like_title='',$scheme_user_type,$offset=0,$limit=10){
		$where = "AND 1=1";

		if($scheme_status != ''){
			$where .=" AND s.scheme_status=".$scheme_status;
		}

		if($scheme_type !=''){
			$where .=" AND s.scheme_type=".$scheme_type;
		}

		if($a_start != ''){
			$where .= " AND s.scheme_subtime >='".$a_start."'";
		}
		if($a_end !=''){
			$where .= " AND s.scheme_subtime <='".$a_end."'";
		}
		if($scheme_user_type !=''){
			$where .=" AND s.scheme_user_type=".$scheme_user_type;
		}

		return $this->db->query("SELECT u.user_nickname,s.scheme_id,s.scheme_is_hot,s.scheme_name,s.user_id,s.scheme_disc,s.scheme_share,s.scheme_downs,s.scheme_album,s.scheme_is_public,s.scheme_is_free,s.scheme_user_type,s.scheme_views,s.scheme_type,s.scheme_subtime,s.scheme_status,s.scheme_thinking FROM t_project_scheme as s left join (SELECT user_nickname,user_id FROM t_user) as u ON s.user_id = u.user_id WHERE u.user_nickname LIKE '%".$like_nickname."%' AND s.scheme_name LIKE '%".$like_title."%'".$where." ORDER BY s.scheme_sort DESC,s.scheme_id DESC LIMIT {$offset},{$limit}")->result();
		//echo $this->db->last_query();exit;
	}
	/**
	 *  查找是否正常的方案
	 */
	public function is_scheme($where,$scheme_user_type=''){

		if($scheme_user_type){
			$yp = ' AND scheme_user_type='.$scheme_user_type;
		}else{
			$yp='';
		}
		return $this->db->query('SELECT scheme_id FROM t_project_scheme WHERE scheme_id IN ('.$where.') AND scheme_status=1 AND scheme_type=2'.$yp)->result_array();

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
		return $this->db->update('t_project_scheme',$data,$where)?true:false;
	}


	/**
	 *  查找是否正常的方案
	 */
	public function getSchemeByProject(){
		return $this->db->query('SELECT p.project_name,s.scheme_thinking FROM t_project_scheme AS s LEFT JOIN t_project AS p ON s.project_id=p.project_id WHERE s.scheme_id='.$this->scheme_id)->row();

	}

	/**
	 *description:获取案例详情信息
	 *author:yanyalong
	 *date:2013/12/24
	 */
	public function getSchemeInfo($scheme_id){
		return $this->db->query("SELECT * FROM t_project_scheme ps left join t_project p on p.project_id=ps.project_id left join t_house h on h.house_id=ps.house_id left join t_user_info u on ps.user_id=u.user_id left join t_house_apartment ha on ha.house_id=h.house_id left join t_user tu on u.user_id=tu.user_id where ps.scheme_id=$scheme_id")->row();
	}
	
	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY
	 *
	 * @return 对象
	 */
	public function get_scheme()
	{
		return $this->db->query("SELECT scheme_id FROM t_project_scheme WHERE scheme_status IN (1,11,12)")->result_array();
	}
	

	/**
	 *description:更新案例统计信息状态
	 *author:yanyalong
	 *date:2013/09/18
	 */
	public function scheme_status($scheme_id,$column,$type='+',$num='1'){
		if($scheme_id==''||$column==''||$type=='') return false;
		$this->db->query("update t_project_scheme set $column=$column$type$num where scheme_id=$scheme_id");
	}
	/**
	 *description:获取我的制定项目中的装修案例
	 *author:yanyalong
	 *date:2013/12/16
	 */
	public function schemelistByUserDiy($user_id,$project_id,$scheme_user_type){
		return	$this->db->query("select * from t_project_scheme where user_id=$user_id and scheme_status<99 and scheme_user_type=$scheme_user_type and project_id=$project_id")->result();
	}
	/**
	 *description:获取设计师默认案例
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function getDefaultByDesigner($user_id){
		return	$this->db->query("select * from t_project_scheme where user_id=$user_id and scheme_status=5")->row();
	}
	/**
	 *description:获取设计师的项目案例
	 *author:yanyalong
	 *date:2013/12/28
	 */
	public function getSchemeListByDesigner($user_id,$p="0",$row="0"){
		$limit = "";
		if($p!="0"&&$row!="0"){
			$limit = ' limit '.($p-1)*$row.','.$row;
		}
	 return	$this->db->query("select * from t_project_scheme ps left join t_project p on p.project_id=ps.project_id where ps.user_id=$user_id and ps.scheme_status<99   order by ps.scheme_id desc $limit")->result();
	}
}

