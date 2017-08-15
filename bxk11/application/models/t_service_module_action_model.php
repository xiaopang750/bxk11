<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/05/16 11:59:45 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_service_module_action_model extends CI_Model
{
	public $ma_id;

	public $ma_pid;

	public $ma_name;

	public $ma_pic;

	public $ma_key;

	public $ma_depth;

	public $ma_desc;

	public $ma_sort;

	public $service_types;

	public $is_open;

	public $ma_type;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->ma_name = '';
		$this->ma_pic = '';
		$this->ma_key = '';
		$this->ma_desc = '';
		$this->ma_sort = 0;
		$this->service_types = 0;
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY ma_id
	 *
	 * @return 对象
	*/
	public function get($ma_id)
	{
		return $this->db->get_where('t_service_module_action',array('ma_id' => $ma_id))->row();
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
	 * get_list(10,0) =>	select * from t_service_module_action limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'ma_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_module_action', $limit, $offset)->result();
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
	public function get_all($order_field = 'ma_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_module_action')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_service_module_action');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'ma_id', $order_type = 'ASC')
	{
		$this->db->from('t_service_module_action')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_service_module_action')->like($field_name, $keywords);
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
		$this->db->insert('t_service_module_action', $this);
		return $this->db->insert_id();
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY ma_id
	*/
	public function delete($ma_id)
	{
		return $this->db->delete('t_service_module_action',array('ma_id' => $ma_id));
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
		return $this->db->update('t_service_module_action',$data,$where)?true:false;
	}
	
	/**
	 * 根据条件得到单条记录
	 *
	 * @PRIMARY KEY rwfr_id
	 *
	 * @return 对象
	 */
	public function getOne($field='ma_id',$where)
	{
		 return $this->db->select($field)->get_where('t_service_module_action',$where)->row();
	}	

	/**
	 * 根据service_id 和 wid 来查找主键
	 *
	 * @PRIMARY KEY sw_id
	*/
	public function getArray($field='ma_id',$where){
		return $this->db->select($field)->get_where('t_service_module_action',$where)->result();
	}

	public function getOrderArray($field='ma_id',$where=array()){
		$whereS = '1=1';
		if($where){
			foreach ($where as $key => $value) {
				$whereS.=" AND $key=$value";
			}
		}
		return $this->db->query('select * from t_service_module_action where '.$whereS.' order by ma_sort desc,ma_id asc')->result();
	}
	
    /**
     *description:根据key获取功能信息
     *author:yanyalong
     *date:2014/05/20
     */
    public function getActionByKey($ma_key){
        return $this->db->query("select * from t_service_module_action where ma_key='$ma_key'")->row();
    }
    /**
     *description:根据id列表获取父类菜单
     *author:yanyalong
     *date:2014/05/20
     */
    public function getActionByIdList($rolelist){
        return $this->db->query("select * from t_service_module_action where ma_id in($rolelist)   and is_open=1 order by ma_sort desc")->result();
    }
    /**
     *description:根据父id获取子首位子id
     *author:yanyalong
     *date:2014/05/21
     */
    public function getActionById($ma_pid){
        return $this->db->query("select * from t_service_module_action where ma_pid=$ma_pid  and is_open=1 order by ma_sort desc limit 1")->row();
    }
    /**
     *description:获取所有三级页面信息
     *author:yanyalong
     *date:2014/05/21
     */
    public function getAction(){
        return $this->db->query("select * from t_service_module_action where ma_depth=3 and is_open=1 order by ma_sort desc")->result();
    }
}
