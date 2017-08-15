<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/10/18 20:09:09 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_tag_take_model extends CI_Model
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
	public $take_id;

	/**
	 * @COLUMN_KEY		MUL
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $tag_id;

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
	 * @DATA_TYPE		timestamp
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	CURRENT_TIMESTAMP
	 * @COLUMN_TYPE		timestamp
	 * @EXTRA			on update CURRENT_TIMESTAMP
	 * @COLUMN_COMMENT	
	 */
	public $take_addtime;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY take_id
	 *
	 * @return 对象
	 */
	public function get($take_id)
	{
		return $this->db->get_where('t_tag_take',array('take_id' => $take_id))->row();
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
	 * get_list(10,0) =>	select * from t_tag_take limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'take_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_tag_take', $limit, $offset)->result();
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
	public function get_all($order_field = 'take_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_tag_take')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_tag_take');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'take_id', $order_type = 'ASC')
	{
		$this->db->from('t_tag_take')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_tag_take')->like($field_name, $keywords);
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
		$this->db->insert('t_tag_take', $this);
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
		return $this->db->update('t_tag_take', $this, array('take_id' => $post['take_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['take_addtime']) || empty($post['take_addtime'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['take_id']) || empty($post['take_id'])) return false;
		if(!isset($post['take_addtime']) || empty($post['take_addtime'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY take_id
	 */
	public function delete($take_id)
	{
		return $this->db->delete('t_tag_take',array('take_id' => $take_id));
	}

	/**
	 *description:批量订阅主题
	 *author:yanyalong
	 *date:2013/08/05
	 */
	public function subs_add($tagid_list,$user_id){
		$subs_arr = explode(',',$tagid_list);
		$count = count($subs_arr);
		$i=0;
		foreach($subs_arr as $key=>$tag_id){
			if($this->sub_add($tag_id,$user_id)!=false){
				$i++;
			}
		}
		if($i<$count){
			return false;
		}else{
			return true;
		}
	}
	/**
	 *description:订阅一个主题
	 *author:yanyalong
	 *date:2013/08/05
	 */
	public function sub_add($tag_id,$user_id){
		$take = $this->exist_take($tag_id,$user_id);
		if($take=='1'){
			return false;
		}else{
			$data['tag_id'] = $tag_id;
			$data['user_id'] = $user_id;
			$res = $this->db->insert('t_tag_take', $data);
			if($res){
				return true;
			}else{
				return false;
			}
		}
	}
	/**
	 *description:查询是否订阅过某主题
	 *author:yanyalong
	 *date:2013/11/05
	 */
	public function exist_take($tag_id,$user_id){
		if($tag_id==''||$user_id=='') return '1';
		$res = $this->db->query("select take_id from t_tag_take where tag_id='$tag_id' and user_id='$user_id'")->row_array();
		if($res){
			return '1';
		}else{
			return '0';
		}
	}

	/**
	 *description:获取用户订阅数
	 *author:yanyalong
	 *date:2013/11/06
	 */
	public function take_nums($user_id){
		$res = $this->db->query("select count(user_id) count from t_tag_take where user_id=$user_id")->row_array();
		return $res['count'];
	}
	/**
	 *description:获取我订阅的标签，主题列表
	 *author:yanyalong
	 *date:2013/08/25
	 */
	public function gettag_take($user_id){
		if($user_id!=''){
			$tagarr =  $this->db->query("select tag_id from t_tag_take where user_id in($user_id) order by take_id desc")->result_array();
			if($tagarr!=false){
				$taglist = "";
				foreach ($tagarr as $key=>$val) {
					$taglist.=$val['tag_id'].',';	
				}
				return trim($taglist,',');
			}else{
				return '';
			}
		}else{
			return '';
		}
	}
	/**
	 *description:获取我订阅的标签，主题列表(用于发现好灵感)
	 *author:yanyalong
	 *date:2013/08/25
	 */
	public function find_sublist($user_id,$rows='5'){
		if($user_id=='') return false;
		$tagarr =  $this->db->query("select tag.tag_name from t_tag_take take left join t_tag tag on take.tag_id=tag.tag_id where take.user_id=$user_id order by take.take_id desc")->result_array();
		$tagname_new = "";
		$this->config->load('url');
		$config = $this->config->item('url');
		foreach ($tagarr as $key=>$val) {
			if($rows!=''){
				if($key<$rows){
					$tagname_new.= "<a href='$config[tagurl]$val[tag_name]'>".$val['tag_name']."</a>";
				}
			}else{
				$tagname_new.= "<a href='$config[tagurl]$val'>".$val."</a>";
			}
		}
		if(empty($tagname_new)) return false;
		return $tagname_new;
	}
	/**
	 *description:取消订阅
	 *author:yanyalong
	 *date:2013/09/22
	 */
	public function del_sub($tag_id,$user_id){
		return $this->db->query("delete from t_tag_take where user_id=$user_id and tag_id=$tag_id");
	}
	/**
	 *description:根据标签id获取标签信息
	 *author:yanyalong
	 *date:2013/11/13
	 */
	public function getbytake($user_id){
		return $this->db->query("select tag.tag_name,tag.tag_id,tag.tag_users,tag.tag_count from t_tag_take take left join t_tag tag on take.tag_id=tag.tag_id where take.user_id=$user_id order by take.take_id desc")->result();
	}
	/**
	 *description:获取用户订阅标签信息名称列表
	 *author:yanyalong
	 *date:2013/12/27
	 */
	public function gettaglistByUser($user_id,$s_class_type,$rows=""){
		$this->config->load('url');
		$config = $this->config->item('url');
		$res = $this->getbytake($user_id);	
		$tagname_new = "";
		foreach ($res as $key=>$val) {
			$res = model("t_tag")->classinfobytagname($s_class_type,$val->tag_name);		
			if($res==false) return false;
			if($rows!=''){
				if($key<$rows){
					$tagname_new[$key]['tag_url'] = $config['tagurl'].$res->s_class_name.$config['tagpara'].$val->tag_name;
					$tagname_new[$key]['tag_name'] = $val->tag_name;
				}
			}else{
				$tagname_new[$key]['tag_url'] = $config['tagurl'].$res->s_class_name.$config['tagpara'].$val->tag_name;
				$tagname_new[$key]['tag_name'] = $val->tag_name;
			}
		}
		return $tagname_new;
	}
}
