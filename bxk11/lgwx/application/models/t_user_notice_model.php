<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/10/18 20:09:10 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_user_notice_model extends CI_Model
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
	public $notice_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(100)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $notice_title;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(500)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $notice_content;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		timestamp
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	CURRENT_TIMESTAMP
	 * @COLUMN_TYPE		timestamp
	 * @EXTRA			on update CURRENT_TIMESTAMP
	 * @COLUMN_COMMENT	
	 */
	public $notice_sendtime;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $notice_type;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		timestamp
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	0000-00-00 00:00:00
	 * @COLUMN_TYPE		timestamp
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $notice_expiry;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $user_id;

	public function __construct()
	{
		parent::__construct();
		$this->notice_title = "";
		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY notice_id
	 *
	 * @return 对象
	*/
	public function get($notice_id)
	{
		return $this->db->get_where('t_user_notice',array('notice_id' => $notice_id))->row();
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
	 * get_list(10,0) =>	select * from t_user_notice limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'notice_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_user_notice', $limit, $offset)->result();
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
	public function get_all($order_field = 'notice_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_user_notice')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_user_notice');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'notice_id', $order_type = 'ASC')
	{
		$this->db->from('t_user_notice')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_user_notice')->like($field_name, $keywords);
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
		$this->db->insert('t_user_notice', $this);
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
		return $this->db->update('t_user_notice', $this, array('notice_id' => $post['notice_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['notice_sendtime']) || empty($post['notice_sendtime'])) return false;
		if(!isset($post['notice_expiry']) || empty($post['notice_expiry'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['notice_id']) || empty($post['notice_id'])) return false;
		if(!isset($post['notice_sendtime']) || empty($post['notice_sendtime'])) return false;
		if(!isset($post['notice_expiry']) || empty($post['notice_expiry'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY notice_id
	*/
	public function delete($notice_id)
	{
		return $this->db->delete('t_user_notice',array('notice_id' => $notice_id));
	}
	
	/**
	 *description:删除已展示通知
	 *author:yanyalong
	 *date:2013/09/20
	 */
	public function delnotice($user_id,$row='5'){
		$this->db->query("delete from t_user_notice where user_id=$user_id order by notice_id desc limit $row");
	}
	/**
	 *description:获取我的通知
	 *author:yanyalong
	 *date:2013/08/19
	 */
	public function getnotice($user_id,$limit=0,$row='5'){
		$limit = ' limit '.($limit-1)*$row.','.$row;
		$notice_arr = $this->db->query("select count(notice_id) mnums from t_user_notice where user_id in(0,$user_id)")->row_array();
		if($notice_arr['mnums']==0) return false;
		//通知总数
		$res = $this->db->query("select * from t_user_notice where user_id in (0,$user_id) order by notice_id desc $limit")->result();
		foreach ($res as $key=>$val) {
			$notice_arr['notice'][$key]['notice_content'] = $val->notice_content;
			$notice_arr['notice'][$key]['notice_type'] = $val->notice_type;
			$notice_arr['notice'][$key]['notice_sendtime'] = $val->notice_sendtime;
			$notice_arr['notice'][$key]['notice_id'] = $val->notice_id;
		}
		$notice_arr['allpages'] = ceil($notice_arr['mnums']/$row);
		return $notice_arr;
	}
	/**
	 *description:删除所用通知
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function del_allnotice($user_id){
		return $this->db->query("delete from t_user_notice where user_id=$user_id");
	}
	
	/**
	 *description:批量删除通知
	 *author:yanyalong
	 *date:2013/08/23
	 */
	public function del_notices($notice_id_list){
		return $this->db->query("delete from t_user_notice where notice_id in ($notice_id_list)");
	}
    /**
     *description:获取经销商系统通知
     *author:yanyalong
     *date:2014/04/21
     */
    public function getListByService($service_id,$p="",$row=""){
        $limit = "";
        if($p!=""&&$row!=""){
		    $limit = ' limit '.($p-1)*$row.','.$row;
        }
        return $this->db->query("select * from t_user_notice where service_id=$service_id and notice_type='0' order by notice_id desc $limit ")->result();
    }
}
