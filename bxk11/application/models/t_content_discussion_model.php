<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/10/18 20:09:06 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_content_discussion_model extends CI_Model
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
	public $disc_id;

	/**
	 * @COLUMN_KEY		MUL
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $content_id;

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
	public $disc_pid;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(200)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $disc_con;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		timestamp
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	CURRENT_TIMESTAMP
	 * @COLUMN_TYPE		timestamp
	 * @EXTRA			on update CURRENT_TIMESTAMP
	 * @COLUMN_COMMENT	
	 */
	public $disc_time;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	1
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $disc_status;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY disc_id
	 *
	 * @return 对象
	*/
	public function get($disc_id)
	{
		return $this->db->get_where('t_content_discussion',array('disc_id' => $disc_id))->row();
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
	 * get_list(10,0) =>	select * from t_content_discussion limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'disc_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_content_discussion', $limit, $offset)->result();
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
	public function get_all($order_field = 'disc_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_content_discussion')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_content_discussion');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'disc_id', $order_type = 'ASC')
	{
		$this->db->from('t_content_discussion')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_content_discussion')->like($field_name, $keywords);
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
		$this->db->insert('t_content_discussion', $this);
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
		return $this->db->update('t_content_discussion', $this, array('disc_id' => $post['disc_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['disc_time']) || empty($post['disc_time'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['disc_id']) || empty($post['disc_id'])) return false;
		if(!isset($post['disc_time']) || empty($post['disc_time'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY disc_id
	*/
	public function delete($disc_id)
	{
		return $this->db->delete('t_content_discussion',array('disc_id' => $disc_id));
	}
	/**
	 *description:添加一条评论
	 *author:yanyalong
	 *date:2013/11/07
	 */
	function manage($content_id,$user_id,$disc_con)
	{
		if($content_id==''||$user_id==''||$disc_con=='') return false;
		$contentinfo= model('t_content')->contentinfo($content_id);
		if($contentinfo==false) return false;
		$this->config->load('circuit');
		$config = $this->config->item('disc');
		$disc_status = ($config['disc_status']=='1')?'11':'1'; 
		$data = array(
			'content_id' => $content_id,
			'user_id' => $user_id,
			'disc_con' => $disc_con,
			'disc_pid' => '0',
			'disc_status' =>$disc_status,
		);
		$this->db->insert('t_content_discussion', $data);
		$disc_id = $this->db->insert_id();
		if($disc_id){
			model("t_content")->content_status($content_id,'content_disc','+');
			return $disc_id;
		}else{
			return false;
		}
	}
	/**
	 *description:添加一条回复
	 *author:yanyalong
	 *date:2013/11/07
	 */
	function reply($user_id,$disc_con,$disc_pid)
	{
		if($user_id==''||$disc_con==''||$disc_pid=='') return false;
		$this->config->load('circuit');
		$config = $this->config->item('disc');
		$disc_status = ($config['disc_status']=='1')?'11':'1'; 
		$discinfo = $this->discinfo($disc_pid);
		if(empty($discinfo)) return false;
		$data = array(
			'user_id' => $user_id,
			'content_id' => $discinfo['content_id'],
			'disc_con' => $disc_con,
			'disc_pid' => $disc_pid,
			'disc_status' =>$disc_status
		);
		$this->db->insert('t_content_discussion', $data);
		$disc_id = $this->db->insert_id();
		if($disc_id){
			model("t_content")->content_status($discinfo['content_id'],'content_disc','+');
			return $disc_id;
		}else{
			return false;
		}
	}
	/**
	 *description:获取一条评论信息
	 *author:yanyalong
	 *date:2013/08/07
	 */
	public function discinfo($disc_id){
		return $this->db->query("select * from t_content_discussion where disc_id=$disc_id")->row_array();
	}
	/**
	 *description:评论成功后回调评论内容
	 *author:chenyuda 
	 *date:2013/08/26
	 */
	function new_disc($disc_id)
	{
		$arr = $this->db->query("select dd.*,uu.user_nickname father_nickname from (select dis.disc_con father_disc_con,dis.user_id father_user_id,ds.disc_con child_disc_con,ds.disc_id,ds.user_nickname child_nickname,ds.user_id child_user_id,ds.content_id from (select d.disc_id,d.disc_pid,d.disc_con,d.user_id,u.user_nickname,d.content_id from t_content_discussion d left JOIN t_user u on u.user_id=d.user_id where d.disc_id=$disc_id order by disc_id desc) ds LEFT JOIN t_content_discussion dis on dis.disc_id=ds.disc_pid) dd left join t_user uu on uu.user_id=dd.father_user_id")->row_array();
		if(empty($arr)) return false;
		$this->config->load('url');
		$config = $this->config->item('url');
			if($arr['father_user_id']!=''){
				$disc['disc_str'] = "<a href=".$config['userspace'].$arr['child_user_id'].">".$arr['child_nickname']."</a> 回复了 "."<a href=".$config['userspace'].$arr['father_user_id'].">".$arr['father_nickname']."</a>".$arr['child_disc_con'];
			}else{
				$disc['disc_str'] = "<a href=".$config['userspace'].$arr['child_user_id'].">".$arr['child_nickname']."</a> 评论了灵感：".$arr['child_disc_con'];
			}	
			$disc['user_pic'] = model("t_user_info")->avatar($arr['child_user_id']);
			$disc['disc_id'] = $disc_id;
			$disc['nickname'] = $arr['child_nickname'];
			$disc['content_id'] = $arr['content_id'];
			$disc['userspace'] = $config['userspace'].$arr['child_user_id'];
		return $disc;
	}    
	/* 统计总条数 
	 */	function count_num($content_id)
	{
		$query = $this->db->query("select count(content_id) disc_num from t_content_discussion where content_id=$content_id and disc_status<10")->row_array();
		return $query['disc_num'];
	}
	/**
	 *description:显示某篇博文的评论内容
	 *author:chenyuda 
	 *date:2013/08/26
	 */
	function content_show($content_id,$p=1,$count='10')
	{
		$limit_first = ($p-1)*$count;
		$num = $this->count_num($content_id);
		$max_page = ceil($num/$count);
		$arr = $this->db->query("select dd.*,uu.user_nickname father_nickname from (select dis.disc_con father_disc_con,dis.user_id father_user_id,ds.disc_con child_disc_con,ds.disc_id,ds.user_nickname child_nickname,ds.user_id child_user_id from (select d.disc_id,d.disc_pid,d.disc_con,d.user_id,u.user_nickname from t_content_discussion d left JOIN t_user u on u.user_id=d.user_id where d.content_id=$content_id and disc_status<10 order by disc_id desc limit $limit_first,$count) ds LEFT JOIN t_content_discussion dis on dis.disc_id=ds.disc_pid) dd left join t_user uu on uu.user_id=dd.father_user_id")->result_array();
		if(empty($arr)) return false;
		$i=0;
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach($arr as $val){
			if($val['father_user_id']!=''){
				$disc[$i]['user_pic'] = model("t_user_info")->avatar($val['child_user_id']);
				$disc[$i]['disc_str'] = "<a href=".$config['userspace'].$val['child_user_id'].">".$val['child_nickname']."</a> 回复了 "."<a href=".$config['userspace'].$val['father_user_id'].">".$val['father_nickname']."</a>".$val['child_disc_con'];
			}else{
				$disc[$i]['user_pic'] = model("t_user_info")->avatar($val['child_user_id']);
				$disc[$i]['disc_str'] = "<a href=".$config['userspace'].$val['child_user_id'].">".$val['child_nickname']."</a> 评论了灵感：".$val['child_disc_con'];
			}	
			$disc[$i]['disc_id'] = $val['disc_id'];
			$disc[$i]['user_id'] = $val['child_user_id'];
			$disc[$i]['content_id'] = $content_id;
			$disc[$i]['nickname'] = $val['child_nickname'];
			$disc[$i]['userspace'] = $config['userspace'].$val['child_user_id'];
			$i++;
		}
		return $disc;
	}    
	/**
	 *description:获取当日某用户评论博文数
	 *author:yanyalong
	 *date:2013/11/25
	 */
	public function getconts($user_id){
		return $this->db->query("SELECT count(*) count FROM `t_content_discussion` where user_id=$user_id  and UNIX_TIMESTAMP(disc_time)>UNIX_TIMESTAMP(CURRENT_DATE()) and UNIX_TIMESTAMP(disc_time)<UNIX_TIMESTAMP(CURRENT_DATE()+1)")->row();
	}

}
