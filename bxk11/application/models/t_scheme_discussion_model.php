<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/21 12:18:44 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_scheme_discussion_model extends CI_Model
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
	public $disc_id;

	/**
	 * @COLUMN_KEY		
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
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $disc_pid;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
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
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	1
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $disc_status;

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
		return $this->db->get_where('t_scheme_discussion',array('disc_id' => $disc_id))->row();
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
	 * get_list(10,0) =>	select * from t_scheme_discussion limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'disc_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_scheme_discussion', $limit, $offset)->result();
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
		return $this->db->get('t_scheme_discussion')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_scheme_discussion');
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
		$this->db->from('t_scheme_discussion')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_scheme_discussion')->like($field_name, $keywords);
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
		$this->db->insert('t_scheme_discussion', $this);
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
		return $this->db->update('t_scheme_discussion', $this, array('disc_id' => $post['disc_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['disc_pid']) || empty($post['disc_pid'])) return false;
		if(!isset($post['disc_con']) || empty($post['disc_con'])) return false;
		if(!isset($post['disc_time']) || empty($post['disc_time'])) return false;
		if(!isset($post['disc_status']) || empty($post['disc_status'])) return false;
		if(!isset($post['user_id']) || empty($post['user_id'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['disc_id']) || empty($post['disc_id'])) return false;
		if(!isset($post['disc_pid']) || empty($post['disc_pid'])) return false;
		if(!isset($post['disc_con']) || empty($post['disc_con'])) return false;
		if(!isset($post['disc_time']) || empty($post['disc_time'])) return false;
		if(!isset($post['disc_status']) || empty($post['disc_status'])) return false;
		if(!isset($post['user_id']) || empty($post['user_id'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY disc_id
	*/
	public function delete($disc_id)
	{
		return $this->db->delete('t_scheme_discussion',array('disc_id' => $disc_id));
	}
	
	/**
	 *description:添加一条评论
	 *author:yanyalong
	 *date:2013/11/07
	 */
	function manage($scheme_id,$user_id,$disc_con)
	{
		if($scheme_id==''||$user_id==''||$disc_con=='') return false;
		$schemeinfo= model('t_project_scheme')->get($scheme_id);
		if($schemeinfo==false) return false;
		$this->config->load('circuit');
		$config = $this->config->item('disc');
		$disc_status = ($config['disc_status']=='1')?'11':'1'; 
		$data = array(
			'scheme_id' => $scheme_id,
			'user_id' => $user_id,
			'disc_con' => $disc_con,
			'disc_pid' => '0',
			'disc_status' =>$disc_status,
		);
		$this->db->insert('t_scheme_discussion', $data);
		$disc_id = $this->db->insert_id();
		if($disc_id){
			//model("t_content")->content_status($scheme_id,'content_disc','+');
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
			'scheme_id' => $discinfo['scheme_id'],
			'disc_con' => $disc_con,
			'disc_pid' => $disc_pid,
			'disc_status' =>$disc_status
		);
		$this->db->insert('t_scheme_discussion', $data);
		$disc_id = $this->db->insert_id();
		if($disc_id){
			//model("t_content")->content_status($discinfo['scheme_id'],'content_disc','+');
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
		return $this->db->query("select * from t_scheme_discussion where disc_id=$disc_id")->row_array();
	}
	/**
	 *description:评论成功后回调评论内容
	 *author:chenyuda 
	 *date:2013/08/26
	 */
	function new_disc($disc_id)
	{
		$arr = $this->db->query("select dd.*,uu.user_nickname father_nickname from (select dis.disc_con father_disc_con,dis.user_id father_user_id,ds.disc_con child_disc_con,ds.disc_id,ds.user_nickname child_nickname,ds.user_id child_user_id,ds.scheme_id from (select d.disc_id,d.disc_pid,d.disc_con,d.user_id,u.user_nickname,d.scheme_id from t_scheme_discussion d left JOIN t_user u on u.user_id=d.user_id where d.disc_id=$disc_id order by disc_id desc) ds LEFT JOIN t_scheme_discussion dis on dis.disc_id=ds.disc_pid) dd left join t_user uu on uu.user_id=dd.father_user_id")->row_array();
		if(empty($arr)) return false;
		$this->config->load('url');
		$config = $this->config->item('url');
			if($arr['father_user_id']!=''){
				$disc['disc_str'] = "<a href=".$config['userspace'].$arr['child_user_id']." target='_blank'>".$arr['child_nickname']."</a> 回复了 "."<a href=".$config['userspace'].$arr['father_user_id']." target='_blank'>".$arr['father_nickname']."</a>".$arr['child_disc_con'];
			}else{
				$disc['disc_str'] = "<a href=".$config['userspace'].$arr['child_user_id']." target='_blank'>".$arr['child_nickname']."</a> 评论了灵感：".$arr['child_disc_con'];
			}	
			$disc['user_pic'] = model("t_user_info")->avatar($arr['child_user_id']);
			$disc['disc_id'] = $disc_id;
			$disc['nickname'] = $arr['child_nickname'];
			$disc['scheme_id'] = $arr['scheme_id'];
			$disc['userspace'] = $config['userspace'].$arr['child_user_id'];
		return $disc;
	}    
	/* 统计总条数 
	 */	function count_num($scheme_id)
	{
		$query = $this->db->query("select count(scheme_id) disc_num from t_scheme_discussion where scheme_id=$scheme_id and disc_status<10")->row_array();
		return $query['disc_num'];
	}
	
	/**
	 *description:显示某篇博文的评论内容
	 *author:chenyuda 
	 *date:2013/08/26
	 */
	function scheme_show($scheme_id,$p=1,$count='10')
	{
		$limit_first = ($p-1)*$count;
		$num = $this->count_num($scheme_id);
		$max_page = ceil($num/$count);
		$arr = $this->db->query("select dd.*,uu.user_nickname father_nickname from (select dis.disc_con father_disc_con,dis.user_id father_user_id,ds.disc_con child_disc_con,ds.disc_id,ds.user_nickname child_nickname,ds.user_id child_user_id from (select d.disc_id,d.disc_pid,d.disc_con,d.user_id,u.user_nickname from t_scheme_discussion d left JOIN t_user u on u.user_id=d.user_id where d.scheme_id=$scheme_id and disc_status<10 order by disc_id desc limit $limit_first,$count) ds LEFT JOIN t_scheme_discussion dis on dis.disc_id=ds.disc_pid) dd left join t_user uu on uu.user_id=dd.father_user_id")->result_array();
		if(empty($arr)) return false;
		$i=0;
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach($arr as $val){
			if($val['father_user_id']!=''){
				$disc[$i]['user_pic'] = model("t_user_info")->avatar($val['child_user_id']);
				$disc[$i]['disc_str'] = "<a href=".$config['userspace'].$val['child_user_id']." target='_blank'>".$val['child_nickname']."</a> 回复了 "."<a href=".$config['userspace'].$val['father_user_id']." target='_blank'>".$val['father_nickname']."</a>".$val['child_disc_con'];
			}else{
				$disc[$i]['user_pic'] = model("t_user_info")->avatar($val['child_user_id']);
				$disc[$i]['disc_str'] = "<a href=".$config['userspace'].$val['child_user_id']." target='_blank'>".$val['child_nickname']."</a> 评论了灵感：".$val['child_disc_con'];
			}	
			$disc[$i]['disc_id'] = $val['disc_id'];
			$disc[$i]['user_id'] = $val['child_user_id'];
			$disc[$i]['scheme_id'] = $scheme_id;
			$disc[$i]['nickname'] = $val['child_nickname'];
			$disc[$i]['userspace'] = $config['userspace'].$val['child_user_id'];
			$i++;
		}
		return $disc;
	}    
}
