<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/10/18 20:09:08 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_system_model extends CI_Model
{
	/**
	 * @COLUMN_KEY		PRI
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(40)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $sys_key;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(100)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $sys_key_cn;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		text
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		text
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $sys_value;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $sys_group;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY sys_key
	 *
	 * @return 对象
	 */
	public function get($sys_key)
	{
		return $this->db->get_where('t_system',array('sys_key' => $sys_key))->row();
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
	 * get_list(10,0) =>	select * from t_system limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'sys_key', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_system', $limit, $offset)->result();
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
	public function get_all($order_field = 'sys_key', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_system')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_system');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'sys_key', $order_type = 'ASC')
	{
		$this->db->from('t_system')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_system')->like($field_name, $keywords);
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
		$this->db->insert('t_system', $this);
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
		return $this->db->update('t_system', $this, array('sys_key' => $post['sys_key']));
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
		if(!isset($post['sys_key']) || empty($post['sys_key'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY sys_key
	 */
	public function delete($sys_key)
	{
		return $this->db->delete('t_system',array('sys_key' => $sys_key));
	}
	/**
	 *description:随机查询推荐订阅主题（仅tag_id列表）
	 *author:yanyalong
	 *date:2013/11/05
	 */
	public function tag_id_recommend($rows){
		$sys_value = $this->db->query("select sys_value from t_system where sys_key='tag_recommend'")->row_array();
		if(!empty($sys_value)){
			$theme_list = $sys_value['sys_value'];
			if(trim($theme_list,',')==''){
				return false;	
			}else{
				return trim($theme_list);
			}
		}else{
			return false;
		}
	}

	/**
	 *description:随机查询推荐订阅主题
	 *author:yanyalong
	 *date:2013/08/05
	 */
	public function theme_recommend($rows='12'){
		$sys_value = $this->db->query("select sys_value from t_system where sys_key='tag_recommend'")->row_array();
		if(!empty($sys_value)){
			$theme_list = $sys_value['sys_value'];
			if(trim($theme_list,',')==''){
				return "";	
			}
			$theme_arr = $this->db->query("SELECT tag_id,tag_name,tag_img FROM `t_tag`  where tag_id in($theme_list) order by RAND() limit $rows")->result_array();
			if(!empty($theme_arr)){
				$this->config->load('uploads');
				$config = $this->config->item('theme');
				$this->config->load('url');
				$config_url = $this->config->item('url');
				foreach ($theme_arr as $key=>$val) {
					if(!file_exists($config['thumb_2'].$val['tag_img'])){
						$theme[$key]['motif_pic'] = $this->config->base_url().$config['default_2']; 	
					}else{
						$theme[$key]['motif_pic'] = $config['relative_path'].'thumb_2/'.$val['tag_img'];	
					}
					$theme[$key]['motif_url'] = $config_url['tagurl'].$val['tag_name'];		
					$theme[$key]['motif'] = $val['tag_name'];		
				}
				return $theme;
			}
		}else{
			return "";
		}
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
		return $this->db->update('t_system',$data,$where)?true:false;
	}

	
	/**
	 * 插入一条记录
	 *
	 * @Exception			Exception
	 *
	 * @return				return $this->db->insert()
	 */
	public function inserts()
	{
		return $this->db->insert('t_system', $this);
	}

	/**
	 *description:查询有没有每日之星的
	 *author:baohanbin
	 *date:2013/11/28
	 */
	public function sel_key_cn(){
		$info = $this->db->query("select * from t_system where sys_key_cn='每日之星'")->result();
		if(empty($info)) return false;
		return $info;
	}

	/**
	 *description:修改每日之星
	 *author:baohanbin
	 *date:2013/11/28
	 */
	public function up_daily(){
		return $this->db->query("UPDATE t_system set sys_value = $this->sys_value where sys_key = '$this->sys_key'");
	}
	

}
