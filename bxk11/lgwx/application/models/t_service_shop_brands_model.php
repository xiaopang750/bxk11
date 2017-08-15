<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/03/19 18:32:00 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_service_shop_brands_model extends CI_Model
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
	public $shop_brands_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $brand_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $shop_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		smallint(6)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $shop_brands_sort;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY shop_brands_id
	 *
	 * @return 对象
	*/
	public function get($shop_brands_id)
	{
		return $this->db->get_where('t_service_shop_brands',array('shop_brands_id' => $shop_brands_id))->row();
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
	 * get_list(10,0) =>	select * from t_service_shop_brands limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'shop_brands_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_shop_brands', $limit, $offset)->result();
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
	public function get_all($order_field = 'shop_brands_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_shop_brands')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_service_shop_brands');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'shop_brands_id', $order_type = 'ASC')
	{
		$this->db->from('t_service_shop_brands')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_service_shop_brands')->like($field_name, $keywords);
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
		$this->db->insert('t_service_shop_brands', $this);
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
		return $this->db->update('t_service_shop_brands', $this, array('shop_brands_id' => $post['shop_brands_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['shop_brands_sort']) || empty($post['shop_brands_sort'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['shop_brands_id']) || empty($post['shop_brands_id'])) return false;
		if(!isset($post['shop_brands_sort']) || empty($post['shop_brands_sort'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY shop_brands_id
	*/
	public function delete($shop_brands_id)
	{
		return $this->db->delete('t_service_shop_brands',array('shop_brands_id' => $shop_brands_id));
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY s_class_id
	 *
	 * @return 对象
	 */
	public function get_tag($field='shop_brands_id',$where)
	{
		return $this->db->select($field)->get_where('t_service_shop_brands',$where)->result_array();
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
		return $this->db->update('t_service_shop_brands',$data,$where)?true:false;
	}

	//某个服务商下品牌与门店关联
	public function getBrandsByShopId($shop_id){
		return $this->db->query("SELECT * FROM t_service_shop_brands WHERE shop_id={$shop_id}")->result();
	}
	
	//某个服务商下品牌与门店关联
	public function getBrandsPageByShopId($shop_id,$offset,$limit){
		return $this->db->query("SELECT * FROM t_service_shop_brands WHERE shop_id={$shop_id} ORDER BY shop_brands_id DESC LIMIT {$offset},{$limit}")->result();
	}
	
    /**
     *description:根据门店id获取品牌
     *author:yanyalong
     *date:2014/03/26
     */
    public function getBrandsByShop($shop_id){
	return	$this->db->query("SELECT * FROM t_product_brands sba left join t_service_shop_brands ssb on ssb.brand_id=sba.brand_id WHERE ssb.shop_id=$shop_id ORDER BY ssb.brand_id DESC")->result();
    }
    /**
     *description:根据品牌id删除关联信息
     *author:yanyalong
     *date:2014/03/26
     */
    public function delByBrandId($brand_id){
		return $this->db->query("delete FROM t_service_shop_brands where brand_id=$brand_id");
    }
    /**
     *description:根据门店id删除关联信息
     *author:yanyalong
     *date:2014/03/26
     */
    public function delByShopId($shop_id){
		return $this->db->query("delete FROM t_service_shop_brands where shop_id=$shop_id");
    }
    /**
     *description:根据品牌id获取门店列表(带在线商城)
     *author:yanyalong
     *date:2014/03/26
     */
    public function getShopsByBrand($service_id,$brand_id){
    return	$this->db->query("(SELECT ss.* FROM t_service_shop ss left join t_service_shop_brands ssb on ss.shop_id=ssb.shop_id left join t_product_brands sba on ssb.brand_id=sba.brand_id WHERE ssb.brand_id=$brand_id) union  (select * from t_service_shop where shop_status=1 and service_id=$service_id) ORDER BY shop_id DESC")->result();
    }
}
