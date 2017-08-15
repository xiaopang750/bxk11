<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/06/17 10:42:43 
 * dinghaochenAuthor: jia178
 */
class T_product_class_model extends CI_Model
{
	public $pc_id;

	public $pc_name;

	public $pc_pid;

	public $pc_depth;

	public $pc_function;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY pc_id
	 *
	 * @return 对象
	*/
	public function get($pc_id)
	{
		return $this->db->get_where('t_product_class',array('pc_id' => $pc_id))->row();
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
	 * get_list(10,0) =>	select * from t_product_class limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'pc_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_product_class', $limit, $offset)->result();
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
	public function get_all($order_field = 'pc_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_product_class')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_product_class');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'pc_id', $order_type = 'ASC')
	{
		$this->db->from('t_product_class')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_product_class')->like($field_name, $keywords);
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
		$this->db->insert('t_product_class', $this);
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
		return $this->db->update('t_product_class', $this, array('pc_id' => $post['pc_id']));
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY pc_id
	*/
	public function delete($pc_id)
	{
		return $this->db->delete('t_product_class',array('pc_id' => $pc_id));
	}
    /**
     *description:根据父类产品分类获取所有自己分类
     *author:yanyalong
     *date:2014/06/17
     */
    public function getListByParentId($pc_pid){
        return $this->db->query("select * from t_product_class where pc_pid='$pc_pid'")->result();
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
		return $this->db->update('t_product_class',$data,$where)?true:false;
	}
	
	/**
	 * 根据条件得到单条记录
	 *
	 * @PRIMARY KEY rwfr_id
	 *
	 * @return 对象
	 */
	public function getOne($field='pc_id',$where)
	{
		 return $this->db->select($field)->get_where('t_product_class',$where)->row();
	}	

	/**
	 * 根据service_id 和 pc_id 来查找主键
	 *
	 * @PRIMARY KEY sw_id
	*/
	public function getArray($field='pc_id',$where){
		return $this->db->select($field)->get_where('t_product_class',$where)->result();
	}
    
    /**
     *description:根据分类id列表获取分类信息列表
     *author:yanyalong
     *date:2014/06/21
     */
    public function getListByIdList($pc_id){
        return $this->db->query("select * from t_product_class where pc_id in($pc_id)")->result();
    }
}
