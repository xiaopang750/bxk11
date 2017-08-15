<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/10/18 20:09:09 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_user_follow_model extends CI_Model
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
	public $follow_id;

	/**
	 * @COLUMN_KEY		MUL
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $fgroup_id;

	/**
	 * @COLUMN_KEY		MUL
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $user_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $follow_uid;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	1
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $follow_utype;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		timestamp
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	CURRENT_TIMESTAMP
	 * @COLUMN_TYPE		timestamp
	 * @EXTRA			on update CURRENT_TIMESTAMP
	 * @COLUMN_COMMENT	
	 */
	public $follow_time;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY follow_id
	 *
	 * @return 对象
	 */
	public function get($follow_id)
	{
		return $this->db->get_where('t_user_follow',array('follow_id' => $follow_id))->row();
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
	 * get_list(10,0) =>	select * from t_user_follow limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'follow_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_user_follow', $limit, $offset)->result();
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
	public function get_all($order_field = 'follow_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_user_follow')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_user_follow');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'follow_id', $order_type = 'ASC')
	{
		$this->db->from('t_user_follow')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_user_follow')->like($field_name, $keywords);
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
		$this->db->insert('t_user_follow', $this);
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
		return $this->db->update('t_user_follow', $this, array('follow_id' => $post['follow_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['follow_time']) || empty($post['follow_time'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['follow_id']) || empty($post['follow_id'])) return false;
		if(!isset($post['follow_time']) || empty($post['follow_time'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY follow_id
	 */
	public function delete($follow_id)
	{
		return $this->db->delete('t_user_follow',array('follow_id' => $follow_id));
	}

	/**
	 *description:查询是否关注了某人
	 *author:yanyalong
	 *date:2013/08/21
	 */
	public function is_follow($user_id,$follow_uid){
		if($user_id=='') return '0';
		$res = $this->db->query("select follow_id from t_user_follow where user_id=$user_id and follow_uid=$follow_uid")->row_array();
		if($res){
			return '1';
		}else{
			return '0';
		}
	}
	/**
	 *description:取消关注一个人
	 *author:yanyalong
	 *date:2013/09/17
	 */
	public function del_follow(){
		return  $this->db->query("delete from t_user_follow where follow_uid=$this->follow_uid and user_id=$this->user_id");
	}
	/*
		查询当前登录用户的fans
		*author:chenyuda
		 *date:2013/08/27
	 */
	function dis_fan($user_id,$p='1',$rows='10')
	{
		$this->load->database();
		$limit_first = ($p-1)*$rows;
		$num = $this->num($user_id);
		$max_page = ceil($num/$rows);
		$res = $this->db->query("select t_user.user_nickname,t_user.user_email,t_user.user_id,t_user_follow.follow_time,t_user_follow.follow_id,t_user_follow.follow_uid from t_user_follow left join t_user on t_user_follow.user_id = t_user.user_id where t_user_follow.follow_uid = $user_id limit $limit_first,$rows")->result();
		if(empty($res)){
			return false;
		}
		$this->config->load('url');
		$config = $this->config->item('url');
		$fanslist = array();
		foreach ($res as $key=>$val) {
			$fanslist[$key]['user_pic'] = model('t_user_info')->avatar($val->user_id);
			$fanslist[$key]['userspace'] = $config['userspace'].$val->user_id;
			$fanslist[$key]['user_id'] = $val->user_id;
			$fanslist[$key]['user_nickname'] = ($val->user_nickname!="")?$val->user_nickname:$val->user_email;
			$fanslist[$key]['is_follow'] = $this->is_follow($user_id,$val->user_id);
		}
		$arr['follow'] = $fanslist;
		$arr['allpages'] = $max_page;
		$arr['num'] = $num;
		return $arr;
	}
	/*
		分页总条数
		*author:chenyuda
		*date:2013/08/27
	 */
	function num($user_id)
	{
		$res = $this->db->query("select count(*) count from t_user_follow where follow_uid = $user_id")->row();
		return $res->count;
	}
	/**
	 *description:我的关注
	 *author:yanyalong
	 *date:2013/09/18
	 */
	public function myfollows($user_id,$p='1',$rows='10'){
		$limit = " limit ".($p-1)*$rows.','.$rows;	
		$res = $this->db->query("select f.follow_time,f.follow_uid,u.user_nickname from t_user_follow f left join t_user u on u.user_id=f.follow_uid where f.user_id=$user_id and u.user_type<50 order by f.follow_time desc $limit")->result_array();
		if(empty($res)) return false;
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($res as $key=>$val) {
			$followarr['follow'][$key]['user_pic'] = model("t_user_info")->avatar($val['follow_uid']);
			$followarr['follow'][$key]['user_nickname'] = $val['user_nickname'];
			$followarr['follow'][$key]['follow_uid'] = $val['follow_uid'];
			$followarr['follow'][$key]['userspace'] = $config['userspace'].$val['follow_uid'];
		}
		$res2 = $this->db->query("select count(*) count from t_user_follow where user_id=$user_id")->row_array();
		$followarr['allpages'] = ceil($res2['count']/$rows);	
		return $followarr;
	}
	/**
	 *description:搜索我的的关注
	 *author:yanyalong
	 *date:2013/11/12
	 */
	function follow_search($user_nickname,$user_id,$p='1',$rows='10')
	{
		$limit = "limit ".($p-1)*$rows.",".$rows;
		$res= $this->db->query("select a.user_nickname,c.follow_uid from t_user as a right join t_user_follow as c on a.user_id = c.follow_uid where a.user_nickname like '%$user_nickname%' and c.user_id=$user_id $limit")->result_array();
		$this->config->load('url');
		$config = $this->config->item('url');
		if(empty($res)) return false;		
		foreach ($res as $key=>$val) {
			$res[$key]['user_pic'] = model('t_user_info')->avatar($val['follow_uid']);
			$res[$key]['userspace'] = $config['userspace'].$val['follow_uid'];
		}
		$user_arr['follow'] = $res;	
		$count= $this->db->query("select count(*) count from t_user as a right join t_user_follow as c on a.user_id = c.follow_uid where a.user_nickname like '%$user_nickname%' and c.user_id=$user_id")->row_array();
		$user_arr['allpages'] = ceil($count['count']/$rows);	
		$user_arr['num'] = $count['count'];	

		return $user_arr;
	}
	/**
	 *description:搜索我的粉丝
	 *author:yanyalong
	 *date:2013/11/12
	 */
	function fans_search($user_nickname,$user_id,$p='1',$rows='10')
	{
		$limit = "limit ".($p-1)*$rows.",".$rows;
		$res= $this->db->query("select a.user_nickname,c.user_id from t_user as a right join t_user_follow as c on a.user_id = c.user_id where a.user_nickname like '%$user_nickname%' and c.follow_uid=$user_id $limit")->result_array();
		$this->config->load('url');
		$config = $this->config->item('url');
		if(empty($res)) return false;		
		foreach ($res as $key=>$val) {
			$res[$key]['user_pic'] = model('t_user_info')->avatar($val['user_id']);
			$res[$key]['userspace'] = $config['userspace'].$val['user_id'];
		}
		$user_arr['follow'] = $res;	
		$count= $this->db->query("select count(*) count from t_user as a right join t_user_follow as c on a.user_id = c.user_id where a.user_nickname like '%$user_nickname%' and c.follow_uid=$user_id")->row_array();
		$user_arr['allpages'] = ceil($count['count']/$rows);	
		$user_arr['num'] = $count['count'];	
		return $user_arr;
	}
	/**
	 *description:获取我的关注的用户
	 *author:yanyalong
	 *date:2013/08/24
	 */
	public function myfollow($user_id){
		$res = $this->db->query("select f.follow_uid from t_user_follow f left join t_user u on u.user_id=f.follow_uid where f.user_id in ($user_id) and u.user_type<50")->result_array();
		if(!empty($res)){
			$followstr = "";
			foreach ($res as $key=>$val) {
				$followstr.=$val['follow_uid'].',';	
			}
			return trim($followstr,',');
		}else{
			return false;
		}
	}
	/**
	 *description:获取当日某用户关注数
	 *author:yanyalong
	 *date:2013/11/25
	 */
	public function getconts($user_id){
		return $this->db->query("SELECT count(*) count FROM `t_user_follow` where user_id=$user_id  and UNIX_TIMESTAMP(follow_time)>UNIX_TIMESTAMP(CURRENT_DATE()) and UNIX_TIMESTAMP(follow_time)<UNIX_TIMESTAMP(CURRENT_DATE()+1)")->row();
	}
}
