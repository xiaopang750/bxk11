<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/04/17 23:50:23 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_weixin_model extends CI_Model
{
	/**
	 * @COLUMN_KEY		PRI
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(10)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $wid;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $wx_appid;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $wx_appsecret;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $wx_name;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $wx_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $wx_code;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $wx_pass;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(20)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $wx_province;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(20)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $wx_city;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(100)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $wx_email;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $service_token;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(1)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $wx_type;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		timestamp
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	CURRENT_TIMESTAMP
	 * @COLUMN_TYPE		timestamp
	 * @EXTRA			on update CURRENT_TIMESTAMP
	 * @COLUMN_COMMENT	
	 */
	public $wx_create_time;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		timestamp
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	0000-00-00 00:00:00
	 * @COLUMN_TYPE		timestamp
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $wx_end_time;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(3)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $wx_status;
	public $wx_rand;
	public $access_token;
	public $access_token_expire;
	public $access_token_time;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->wx_appid = '';
		$this->wx_appsecret = '';
		$this->wx_name = '';
		$this->wx_id = '';
		$this->wx_pass = '';
		$this->wx_code = '';
		$this->wx_province = '';
		$this->wx_city = '';
		$this->wx_email = '';
		$this->service_token = '';
		$this->wx_type= 0;
		$this->wx_create_time = '';
		$this->wx_end_time = '';
		$this->wx_status = '';
		$this->access_token = '';
		$this->access_token_expire = '';
		$this->access_token_time = '';
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY wid
	 *
	 * @return 对象
	*/
	public function get($wid)
	{
		return $this->db->get_where('t_weixin',array('wid' => $wid))->row();
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
	 * get_list(10,0) =>	select * from t_weixin limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'wid', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_weixin', $limit, $offset)->result();
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
	public function get_all($order_field = 'wid', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_weixin')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_weixin');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'wid', $order_type = 'ASC')
	{
		$this->db->from('t_weixin')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_weixin')->like($field_name, $keywords);
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
		$this->db->insert('t_weixin', $this);
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
		return $this->db->update('t_weixin', $this, array('wid' => $this->wid));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['wx_appid']) || empty($post['wx_appid'])) return false;
		if(!isset($post['wx_appsecret']) || empty($post['wx_appsecret'])) return false;
		if(!isset($post['wx_name']) || empty($post['wx_name'])) return false;
		if(!isset($post['wx_id']) || empty($post['wx_id'])) return false;
		if(!isset($post['wx_code']) || empty($post['wx_code'])) return false;
		if(!isset($post['wx_pass']) || empty($post['wx_pass'])) return false;
		if(!isset($post['wx_province']) || empty($post['wx_province'])) return false;
		if(!isset($post['wx_city']) || empty($post['wx_city'])) return false;
		if(!isset($post['wx_email']) || empty($post['wx_email'])) return false;
		if(!isset($post['service_token']) || empty($post['service_token'])) return false;
		if(!isset($post['wx_create_time']) || empty($post['wx_create_time'])) return false;
		if(!isset($post['wx_end_time']) || empty($post['wx_end_time'])) return false;
		if(!isset($post['wx_status']) || empty($post['wx_status'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['wid']) || empty($post['wid'])) return false;
		if(!isset($post['wx_appid']) || empty($post['wx_appid'])) return false;
		if(!isset($post['wx_appsecret']) || empty($post['wx_appsecret'])) return false;
		if(!isset($post['wx_name']) || empty($post['wx_name'])) return false;
		if(!isset($post['wx_id']) || empty($post['wx_id'])) return false;
		if(!isset($post['wx_code']) || empty($post['wx_code'])) return false;
		if(!isset($post['wx_pass']) || empty($post['wx_pass'])) return false;
		if(!isset($post['wx_province']) || empty($post['wx_province'])) return false;
		if(!isset($post['wx_city']) || empty($post['wx_city'])) return false;
		if(!isset($post['wx_email']) || empty($post['wx_email'])) return false;
		if(!isset($post['service_token']) || empty($post['service_token'])) return false;
		if(!isset($post['wx_create_time']) || empty($post['wx_create_time'])) return false;
		if(!isset($post['wx_end_time']) || empty($post['wx_end_time'])) return false;
		if(!isset($post['wx_status']) || empty($post['wx_status'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY wid
	*/
	public function delete($wid)
	{
		return $this->db->delete('t_weixin',array('wid' => $wid));
	}
	

	/*****************刘广平*******2014/04/19*****************/

	/**
	* 根据条件得到数据 wx_appid wx_appsecret
	* @author liuguangping
	* @version 1.0 2014/04/19
	*/
	public function getWeixiInfo($where,$wx_end_time){
		$map =' 1=1';
		if($where){
			foreach ($where as $key => $value) {
				$map .= " AND $key='$value'"; 
			}
		}
		$map .= " AND wx_end_time>'".$wx_end_time."'";
		return $this->db->query("SELECT * FROM t_weixin WHERE".$map)->row();

	}

	/**
	* 获取公众号列页
	* @author liuguangping
	* @version 1.0 2014/04/19
	*/
	public function getWeixinList($service_id){
		return $this->db->query("select w.wid,w.wx_name,w.wx_code,w.wx_create_time,w.wx_end_time,w.service_id from t_weixin as w where w.service_id=".$service_id." and w.wx_status=1")->result();

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
		return $this->db->update('t_weixin',$data,$where)?true:false;
	}
	
	/**
	 * 根据条件得到单条记录
	 *
	 * @PRIMARY KEY rwfr_id
	 *
	 * @return 对象
	 */
	public function getOne($field='wid',$where)
	{
		 return $this->db->select($field)->get_where('t_weixin',$where)->row();
	}	

	/**
	 * 根据service_id 和 wid 来查找主键
	 *
	 * @PRIMARY KEY sw_id
	*/
	public function getArray($field='wid',$where){
		return $this->db->select($field)->get_where('t_weixin',$where)->result();
	}

    /**
     *description:获取默认微信公众平台绑定帐号基本信息
     *author:yanyalong
     *date:2014/04/21
     */
    public function getInfoByDefault($service_id){
		return $this->db->query("select * from t_weixin where service_id=$service_id")->row();		
    }
    /**
     *description:获取公众号列表
     *author:yanyalong
     *date:2014/04/22
     */
    public function getList($service_id){
		return $this->db->query("select * from t_weixin where service_id=$service_id and wx_status=1 order by wid desc ")->result();		
    }
}
