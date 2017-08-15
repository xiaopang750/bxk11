<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_service_weixin_reply_model extends CI_Model
{
	public $reply_id;

	public $reply_keyword;

	public $reply_content;

	public $reply_type;

	public $reply_status;

	public $service_token;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->reply_keyword = '';
		$this->reply_content = '';
		$this->reply_type = 1;
		$this->reply_status = 1;
		$this->service_token = '';
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY reply_id
	 *
	 * @return 对象
	*/
	public function get($reply_id)
	{
		return $this->db->get_where('t_service_weixin_reply',array('reply_id' => $reply_id))->row();
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
	 * get_list(10,0) =>	select * from t_service_weixin_reply limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'reply_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_weixin_reply', $limit, $offset)->result();
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
	public function get_all($order_field = 'reply_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_weixin_reply')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_service_weixin_reply');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'reply_id', $order_type = 'ASC')
	{
		$this->db->from('t_service_weixin_reply')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_service_weixin_reply')->like($field_name, $keywords);
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
		$this->db->insert('t_service_weixin_reply', $this);
		return $this->db->insert_id();
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY reply_id
	*/
	public function delete($reply_id)
	{
		return $this->db->delete('t_service_weixin_reply',array('reply_id' => $reply_id));
	}
	
	/*****************刘广平*******2014/04/21*****************/
	/**
	 * 修改
	 * @param array $data
	 * @param arrray $where
	 * @return boolean
	 * @author liuguangping
	 * @version jia178 v1.0 2013/11/7
	 */
	public function updates_global($data,$where){
		return $this->db->update('t_service_weixin_reply',$data,$where)?true:false;
	}
	
	/**
	 * 根据条件得到单条记录
	 *
	 * @PRIMARY KEY rwfr_id
	 *
	 * @return 对象
	 */
	public function getOne($field='reply_id',$where)
	{
		 return $this->db->select($field)->get_where('t_service_weixin_reply',$where)->row();
	}	

	/**
	 * 根据service_id 和 wid 来查找主键
	 *
	 * @PRIMARY KEY sw_id
	*/
	public function getArray($field='reply_id',$where){
		return $this->db->select($field)->get_where('t_service_weixin_reply',$where)->result();
	}


	/**
	 * 根据service_id 和 wid 来查找主键
	 *
	 * @PRIMARY KEY sw_id
	*/
	public function getReplyList($field='reply_id',$where){
		$map = '1=1';
		if($where){
			foreach ($where as $key => $value) {
				$map .=" AND $key='".$value."'"; 
			}
		}
		return $this->db->query("SELECT $field FROM t_service_weixin_reply WHERE ".$map.' ORDER BY reply_id DESC')->result();
	}

	/**
	 * 查询模块的总条数 liuguangping
	 * @param Int $action_status 状态
	 * @param String $key_word 关键字-模块名-key
	 */
	
	public function search_count($key_word,$service_token,$reply_type){
		$where= " AND 1=1 AND reply_status=1";
		if($reply_type){
			$where .= " AND reply_type=$reply_type";
		}else{
			$where .= " AND reply_type=1";
		}
		if($service_token){
			$where .= " AND service_token='$service_token'";
		}else{
			return false;
		}
		return $this->db->query("SELECT * FROM t_service_weixin_reply WHERE reply_keyword LIKE '%{$key_word}%'".$where.' ORDER BY reply_id ASC')->result();
	
	}
	
	/**
	 * 根据条件搜索
	 *
	 * @param String $key_word 
	 *
	 */
	
	public function search_list($key_word, $service_token, $reply_type, $offset, $limit){
		$where= " AND 1=1 AND reply_status=1";
		if($reply_type){
			$where .= " AND reply_type=$reply_type";
		}else{
			$where .= " AND reply_type=1";
		}
		if($service_token){
			$where .= " AND service_token='$service_token'";
		}else{
			return false;
		}
		return $this->db->query("SELECT * FROM t_service_weixin_reply WHERE reply_keyword LIKE '%{$key_word}%'".$where." ORDER BY reply_id ASC LIMIT {$offset},{$limit}")->result();
	}

	/**
	 * 根据条件得到记录
	 *
	 * @PRIMARY KEY rwfr_id
	 *
	 * @return 对象
	 */
	public function getLikeKeyword($status,$token,$keywords)
	{
		$where = " 1=1";
		if($status){
			$where .= " AND reply_status=1";
		}
		if($token){
			$where .= " AND service_token='".$token."'";
		}
		return $this->db->query("SELECT * FROM t_service_weixin_reply WHERE".$where." AND reply_keyword LIKE '%".$keywords."%'")->result();
	}
}
