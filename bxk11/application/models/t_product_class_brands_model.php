<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/06/17 15:44:08 
 * dinghaochenAuthor: jia178
 */
class T_product_class_brands_model extends CI_Model
{
	public $cb_id;

	public $brand_id;

	public $pc_id;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY cb_id
	 *
	 * @return 对象
	*/
	public function get($cb_id)
	{
		return $this->db->get_where('t_product_class_brands',array('cb_id' => $cb_id))->row();
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
	 * get_list(10,0) =>	select * from t_product_class_brands limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'cb_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_product_class_brands', $limit, $offset)->result();
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
	public function get_all($order_field = 'cb_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_product_class_brands')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_product_class_brands');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'cb_id', $order_type = 'ASC')
	{
		$this->db->from('t_product_class_brands')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_product_class_brands')->like($field_name, $keywords);
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
		$this->db->insert('t_product_class_brands', $this);
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
		return $this->db->update('t_product_class_brands', $this, array('cb_id' => $post['cb_id']));
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY cb_id
	*/
	public function delete($cb_id)
	{
		return $this->db->delete('t_product_class_brands',array('cb_id' => $cb_id));
	}
    /**
     *description:根据品牌获取分类信息
     *author:yanyalong
     *date:2014/06/17
     */
    public function getClassInfoByBrand($brand_id){
        return $this->db->query("select * from t_product_class_brands where brand_id in($brand_id)")->result();
    }
    /**
     *description:根据品牌删除关联分类信息
     *author:yanyalong
     *date:2014/06/17
     */
    public function delClsssByBrand($brand_id){
        return $this->db->query("delete from t_product_class_brands where brand_id='$brand_id'");
    }
	
    /**
     *description:获取服务商所有经营品牌所涉及到的一级分类
     *author:yanyalong
     *date:2014/06/21
     */
    public function getClassListByBrand($service_id){
     return $this->db->query("select * from t_product_class where pc_id in(select psb.pc_id from  t_service_brands_apply sba left join t_product_class_brands psb  on sba.brand_id=psb.brand_id where sba.service_id='$service_id'and sba.apply_status<81 group by psb.pc_id)")->result();
    }
}
