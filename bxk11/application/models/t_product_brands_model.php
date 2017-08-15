<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/27 11:50:49 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_product_brands_model extends CI_Model
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
	public $brand_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(50)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $brand_name;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		text
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		text
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $brand_seodesc;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $brand_img;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	0
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $brand_products;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	 
	 * @COLUMN_TYPE		varchar(255)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $brand_seokey;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY brand_id
	 *
	 * @return 对象
	*/
	public function get($brand_id)
	{
		return $this->db->get_where('t_product_brands',array('brand_id' => $brand_id))->row();
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
	 * get_list(10,0) =>	select * from t_product_brands limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'brand_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_product_brands', $limit, $offset)->result();
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
	public function get_all($order_field = 'brand_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_product_brands')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_product_brands');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'brand_id', $order_type = 'ASC')
	{
		$this->db->from('t_product_brands')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_product_brands')->like($field_name, $keywords);
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
		$this->db->insert('t_product_brands', $this);
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
		return $this->db->update('t_product_brands', $this, array('brand_id' => $post['brand_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['brand_name']) || empty($post['brand_name'])) return false;
		if(!isset($post['brand_seodesc']) || empty($post['brand_seodesc'])) return false;
		if(!isset($post['brand_img']) || empty($post['brand_img'])) return false;
		if(!isset($post['brand_products']) || empty($post['brand_products'])) return false;
		if(!isset($post['brand_seokey']) || empty($post['brand_seokey'])) return false;
		if(!isset($post['brand_url']) || empty($post['brand_url'])) return false;
		if(!isset($post['brand_services']) || empty($post['brand_services'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['brand_id']) || empty($post['brand_id'])) return false;
		if(!isset($post['brand_name']) || empty($post['brand_name'])) return false;
		if(!isset($post['brand_seodesc']) || empty($post['brand_seodesc'])) return false;
		if(!isset($post['brand_img']) || empty($post['brand_img'])) return false;
		if(!isset($post['brand_products']) || empty($post['brand_products'])) return false;
		if(!isset($post['brand_seokey']) || empty($post['brand_seokey'])) return false;
		if(!isset($post['brand_url']) || empty($post['brand_url'])) return false;
		if(!isset($post['brand_services']) || empty($post['brand_services'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY brand_id
	*/
	public function delete($brand_id)
	{
		return $this->db->delete('t_product_brands',array('brand_id' => $brand_id));
	}
	
	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY pattern_id
	 * @abstract 根据分类ID查找这个分类下的品牌
	 * @author liuguangping
	 *
	 * @return 数组
	 */
	public function getBrandNameByClassId($s_class_id)
	{
		return $this->db->query("SELECT p.brand_name,p.brand_id FROM t_product_brands AS p LEFT JOIN t_product_class_brands AS b ON p.brand_id=b.brand_id WHERE s_class_id=".$s_class_id)->result_array();
	}
	
/**
	 * @abstract 
	 * @author liuguangping
	 *
	 */
	public function admin_search_count($pattern_add='',$like_title=''){
		$where = " AND 1=1";
		
		if($pattern_add !='' && $pattern_add !=0){
			$where .= " AND s.s_class_id ='".$pattern_add."'";
		}
		return $this->db->query("SELECT b.*,s.s_class_id FROM t_product_brands AS b LEFT JOIN t_product_class_brands AS s ON b.brand_id=s.brand_id WHERE b.brand_name LIKE '%{$like_title}%'".$where)->result();
	}
	
	
	/**
	 * @abstract 方案和条件搜索
	 * @author liuguangping
	 */
	public function admin_search($pattern_add='',$like_title='',$offset=0,$limit=10){
		
		$where = " AND 1=1";
		if($pattern_add !='' && $pattern_add !=0){
			$where .= " AND s.s_class_id ='".$pattern_add."'";
		}
		
        $_classSelect = explode('|',$applyInfo->apply_classid);

		
	}
	
	/**
	 * 根据品牌查找品牌信息
	 * @author liuguangping 
	 */
	
	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY s_class_id
	 *
	 * @return 对象
	 */
	public function get_brand($field='brand_id',$where)
	{
		return $this->db->select($field)->get_where('t_product_brands',$where)->result_array();
	}
	
	/**
	 * 根据room_id 一更新房间应用数
	 * @author liuguangping
	 */
	public function updataproduct_brands($feild = "brand_products",$brand_id,$num=1){
		return $this->db->query("UPDATE t_product_brands SET $feild=$feild+$num WHERE brand_id={$brand_id}")?true:false;
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
		return $this->db->update('t_product_brands',$data,$where)?true:false;
	}
	
	
	public function getBrandByName($field,$where){
		return $this->db->select($field)->get_where('t_product_brands',$where)->row();	
	}
    /**
     *description:获取品牌基本信息
     *author:yanyalong
     *date:2014/04/08
     */
    public function getBrandInfoById($brandid){
		return $this->db->query("select * from t_product_brands pb left join t_service_brands_apply sba on sba.brand_id=pb.brand_id where pb.brand_id=$brandid and sba.apply_status<81")->row();
    }
    /**
     *description:获取经销商下属品牌所关联的所有分类
     *author:yanyalong
     *date:2014/04/14
     */
    public function getBrandInfoList(){
		return $this->db->query("select * from t_product_brands pb left join t_service_brands_apply sba on sba.brand_id=pb.brand_id where sba.apply_status<81")->result();
    }
}
