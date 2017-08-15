<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/10/18 20:09:09 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_tag_model extends CI_Model
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
	public $tag_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $tag_name;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $tag_users;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	1
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $tag_type;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $tag_motif;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $tag_seokey;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $tag_seodesc;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $tag_img;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $tag_count;

	public function __construct()
	{
		parent::__construct();
		$this->tag_likes=0;
		$this->tag_users=0;
		$this->tag_count=0;
		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY tag_id
	 *
	 * @return 对象
	 */
	public function get($tag_id)
	{
		return $this->db->get_where('t_tag',array('tag_id' => $tag_id))->row();
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
	 * get_list(10,0) =>	select * from t_tag limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'tag_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_tag', $limit, $offset)->result();
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
	public function get_all($order_field = 'tag_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_tag')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_tag');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'tag_id', $order_type = 'ASC')
	{
		$this->db->from('t_tag')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_tag')->like($field_name, $keywords);
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
		$this->db->insert('t_tag', $this);
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
		return $this->db->update('t_tag', $this, array('tag_id' => $post['tag_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{


		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['tag_id']) || empty($post['tag_id'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY tag_id
	 */
	public function delete($tag_id)
	{
		return $this->db->delete('t_tag',array('tag_id' => $tag_id));
	}
	/**
	 *description:获取标签url列表
	 *author:yanyalong
	 *date:2013/11/06
	 */
	public function gettaglist_url($tag_namelist){
		if($tag_namelist!=""){
			$this->config->load('url');
			$config = $this->config->item('url');
			foreach (explode(',',$tag_namelist) as $key=>$val) {
				$res = $this->db->query("select s.s_class_name,t.tag_name,t.tag_id from t_tag t left join t_s_class_tag ts on ts.s_tag_id = t.tag_id left join t_system_class s on s.s_class_id=ts.s_class_id where t.tag_name='$val'")->row();
				if($res!=false){
					$tagname_arr[$key]= "<a href='$config[tagurl].$class.$config[tagpara].$val->tag_name'>".$val."</a>";
				}else{
					$tagname_arr[$key] = "<a href='$val'>".$val."</a>";
				}
			}
		}
		return $tagname_arr;		
	}
	/**
	 *description:获取标签url列表
	 *author:yanyalong
	 *date:2013/11/06
	 */
	public function taglist_url($s_class_type,$tagname_list,$rows=''){
		if(trim($tagname_list,',')=='') return '';
		$this->config->load('url');
		$config = $this->config->item('url');
		$tagname_arr = explode(',',$tagname_list);
		$tagname_new = "";
		foreach ($tagname_arr as $key=>$val) {
			$res = $this->classinfobytagname($s_class_type,$val);		
			if($res!=false){
				if($rows!=''){
					if($key<$rows){
						$tagname_new.= "<a href='$config[tagurl]$res->s_class_name$config[tagpara]$val' target='_blank'>".$val."</a>";
					}
				}else{
					$tagname_new.= "<a href='$config[tagurl]$res->s_class_name$config[tagpara]$val' target='_blank'>".$val."</a>";
				}
			}else{
				if($rows!=''){
					if($key<$rows){
						$tagname_new.= $val."&nbsp;&nbsp;";
					}
				}else{
					$tagname_new.= $val."&nbsp;&nbsp;";
				}
			}
		}
		return $tagname_new;		
	}
	/**
	 *description:获取标签下的灵感列表
	 *author:yanyalong
	 *date:2013/11/12
	 */
	public function contentlistbytag($tag_name,$p="",$row){
		$limit = "";
		$limit = ' limit '.($p-1)*$row.','.$row;
		return $this->db->query("select ct.content_id,c.content_disc,c.content_tag,c.user_id,c.content_content,c.content_title,c.content_project,c.content_likes,c.content_subtime,c.content_type from t_tag t LEFT JOIN t_content_tag ct on t.tag_id=ct.tag_id LEFT JOIN t_content c on c.content_id=ct.content_id where t.tag_name='$tag_name' and content_status<10 order by c.content_subtime desc $limit")->result();
	}
	/**
	 *description:获取标签基本信息(根据tag_name)
	 *author:yanyalong
	 *date:2013/08/29
	 */
	public function taginfobyname($tag_name){
		$res = $this->db->query("select * from t_tag where tag_name='$tag_name'")->row_array();
		if($res){
			return $res;
		}else{
			return false;
		}
	}
	/**
	 *description:根据标签名获取标签id
	 *author:yanyalong
	 *date:2013/08/30
	 */
	public function get_tag_id($tag_name){
		$res = $this->db->query("select tag_id from t_tag where tag_name='$tag_name'")->row_array();
		if($res){
			return $res['tag_id'];
		}else{
			return false;
		}
	}
	/**
	 *description:获取标签活跃用户
	 *author:yanyalong
	 *date:2013/08/29
	 */
	public function tagstar($tag_id,$user_id,$rows='10'){
		$user_idarr = $this->db->query("SELECT c.user_id,u.user_nickname,u.user_type from t_user u right join (SELECT user_id,count(user_id) count from t_content where content_id in(select content_id from t_content_tag where tag_id=$tag_id GROUP BY content_id) group by user_id ORDER BY count desc limit $rows) c on c.user_id=u.user_id order by c.count desc")->result_array();
		if(empty($user_idarr)) return false;
		return $user_idarr;
	}
	/**
	 *description:修改标签订阅数
	 *author:yanyalong
	 *date:2013/09/20
	 */
	public function modtag_users($tag_id,$modtype='+'){
		if($tag_id==''||$modtype=='') return false;
		$num = '1';
		$this->db->query("update t_tag set tag_users=tag_users$modtype$num where tag_id=$tag_id");
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY s_class_id
	 *
	 * @return 对象
	 */
	public function get_tag($field='tag_id',$where)
	{
		return $this->db->select($field)->get_where('t_tag',$where)->result_array();
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
		return $this->db->update('t_tag',$data,$where)?true:false;
	}


	/**
	 * 查找这个父类没有的标签
	 * @param string $field
	 * @param string $where
	 * @return array
	 * @author liuguangping
	 * @version jia178 v1.0 2013/11/7
	 */
	public function search_notag($field='*',$where='0',$like_name='',$limit=10,$offset=0,$order_field='tag_id',$order_type='ASC'){
		$sql ="SELECT ".$field." FROM t_tag WHERE tag_id NOT IN (".$where.") AND tag_name LIKE '%".$like_name."%' ORDER BY {$order_field} {$order_type} LIMIT {$offset},{$limit}";
		return $not_result = $this->db->query($sql)->result_array();

	}

	/**
	 * 查找这个父类没有的标签
	 * @param string $field
	 * @param string $where
	 * @return array
	 * @author liuguangping
	 * @version jia178 v1.0 2013/11/7
	 */
	public function count_search_notag($field='*',$where='0',$like_name=''){
		$sql ="SELECT ".$field." FROM t_tag WHERE tag_id NOT IN (".$where.") AND tag_name LIKE '%".$like_name."%'";
		return $not_result = $this->db->query($sql)->result_array();
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
	public function search_where($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'tag_id', $order_type = 'ASC' ,$where='')
	{
		if(!empty($where)){
			$this->db->where($where);
		}
		$this->db->from('t_tag')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
	public function count_search_where($field_name, $keywords , $where='')
	{
		if(!empty($where)){
			$this->db->where($where);
		}
		$this->db->from('t_tag')->like($field_name, $keywords);

		return $this->db->count_all_results();
	}


	/**
	 *description:更新标签统计信息
	 *author:yanyalong
	 *date:2013/11/18
	 */
	public function modcount($tag_id,$column,$type){
		if($tag_id==''||$column==''||$type=='') return false;
		$num = 1;
		$this->db->query("update t_tag set $column=$column$type$num where tag_id=$tag_id");
	}
	/**
	 *description:根据标签名称获取分类信息
	 *author:yanyalong
	 *date:2013/12/02
	 */
	public function classinfobytagname($s_class_type,$tag_name){
		return	$this->db->query("select tc.* from t_system_class tc where tc.s_class_id = 
			(SELECT ts.s_class_id from t_tag t 
			LEFT JOIN t_s_class_tag ts on ts.s_tag_id = t.tag_id 
			left join t_system_class tc on tc.s_class_id=ts.s_class_id 
			where t.tag_name='$tag_name' and tc.s_class_type=$s_class_type limit 1)")->row();		
	}
	/**
	 *description:根据标签名列表获取标签列表
	 *author:yanyalong
	 *date:2013/12/04
	 */
	public function tagIdByName($tag_namelist){
		$tag_namelist = "'".implode("','",explode(',',$tag_namelist))."'";
		return $this->db->query("select * from t_tag where tag_name in ($tag_namelist)")->result();		
	}

	/**
	 *description:获取标签列表中指定分类的标签信息
	 *author:yanyalong
	 *date:2013/11/06
	 */
	public function getTagInfoByTagClass($s_class_type,$tagid_list,$s_class_name=""){
		if(trim($tagid_list,',')=='') return '';
		$where = "";
		if($s_class_name!=""){
			$where = " and tc.s_class_name='$s_class_name' ";
		}
		return $this->db->query("select tc.* from t_system_class tc where tc.s_class_id = 
			(SELECT ts.s_class_id from t_tag t 
			LEFT JOIN t_s_class_tag ts on ts.s_tag_id = t.tag_id 
			left join t_system_class tc on tc.s_class_id=ts.s_class_id 
			where t.tag_id in ($tagid_list) and tc.s_class_type=$s_class_type $where limit 1)")->row();		
	}
	public function tagrank_byhot($p="",$rows="",$keyword=''){
		/*$where = "";
		if($keyword!=''){
			$where = " and t.tag_name like '%$keyword%' ";
		}
		$limit = "";
		if($p!=""&&$rows!=""){
			$limit = " limit ".($p-1)*$rows.",".$rows;
		}*/
		$res = $this->db->query("select * from t_tag")->result_array();
		if(empty($res)) return false;
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($res as $key=>$val) {
			$res[$key]['content_tag'] = $config['tagurl'].$val['tag_name'];
		}
		return $res;
	}
}

