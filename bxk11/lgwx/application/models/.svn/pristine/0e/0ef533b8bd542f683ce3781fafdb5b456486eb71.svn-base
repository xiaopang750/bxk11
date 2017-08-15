<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_product_brands_series_model extends CI_Model
{
	public $series_id;

	public $brand_id;

	public $series_name="";

	public $series_seodesc="";

	public $series_seokey="";

	public $service_id;

	public $series_ename="";

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY series_id
	 *
	 * @return 对象
	*/
	public function get($series_id)
	{
		return $this->db->get_where('t_product_brands_series',array('series_id' => $series_id))->row();
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
	 * get_list(10,0) =>	select * from t_product_brands_series limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'series_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_product_brands_series', $limit, $offset)->result();
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
	public function get_all($order_field = 'series_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_product_brands_series')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_product_brands_series');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'series_id', $order_type = 'ASC')
	{
		$this->db->from('t_product_brands_series')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_product_brands_series')->like($field_name, $keywords);
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
		$this->db->insert('t_product_brands_series', $this);
		return $this->db->insert_id();
	}
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY series_id
	*/
	public function delete($series_id)
	{
		return $this->db->delete('t_product_brands_series',array('series_id' => $series_id));
	}
	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY pattern_id
	 * @author liuguangping
	 *
	 * @return 数组
	 */
	public function get_series($field='series_id',$where)
	{
		return $this->db->select($field)->get_where('t_product_brands_series',$where)->result_array();
	}
	
	
	/**
	 * 根据分类id，标签id和款式名 搜索款式条数
	 * @param Int $s_tag_id
	 * @param Int $s_class_id
	 * @param String $pattern_type
	 */
	public function admin_search_count($brand_id,$s_class_id,$series_name,$series_status){
		$where= "1=1";
		if($brand_id){
			$where.=" AND brand_id=".$brand_id;
		}
		if($s_class_id){
			$where.=" AND s_class_id=".$s_class_id;
		}
		if($series_status){
			$where.=" AND series_status=".$series_status;
		}
		return $this->db->query("SELECT * FROM t_product_brands_series WHERE brand_id IN (SELECT brand_id FROM t_product_class_brands_series WHERE ".$where.") AND series_name LIKE '%{$series_name}%'")->result();
	}
	
	/**
	 * 根据分类id，标签id和款式名 搜索款式
	 * @param Int $s_tag_id
	 * @param Int $s_class_id
	 * @param String $pattern_type
	 * @param Int $offset
	 * @param Int $limit
	 */
	public function admin_search($brand_id,$s_class_id,$series_name,$series_status,$offset,$limit){
		$where= "1=1";
		if($brand_id){
			$where.=" AND brand_id=".$brand_id;
		}
		if($s_class_id){
			$where.=" AND s_class_id=".$s_class_id;
		}
		if($series_status){
			$where.=" AND series_status=".$series_status;
		}
		
		return $this->db->query("SELECT * FROM t_product_brands_series WHERE brand_id IN (SELECT brand_id FROM t_product_class_brands_series WHERE ".$where.") AND series_name LIKE '%{$series_name}%' ORDER BY series_id DESC LIMIT {$offset},{$limit}")->result();
	
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
		
		return $this->db->update('t_product_brands_series',$data,$where)?true:false;
	}

	/**
	 * 根据分类id，标签id和款式名 搜索款式条数
	 * @param Int $s_tag_id
	 * @param Int $s_class_id
	 * @param String $pattern_type
	 */
	public function service_search_count($brand_id,$service_id,$key_word,$series_status){
		$where= " AND 1=1";
		if($brand_id){
			$where.=" AND brand_id=".$brand_id;
		}
		if($service_id){
			$where.=" AND service_id=".$service_id;
		}
		if($series_status){
			$where.=" AND series_status=".$series_status;
		}

		return $this->db->query("SELECT * FROM t_product_brands_series WHERE (series_name LIKE '%{$key_word}%' OR service_id IN (SELECT service_id FROM t_service_info WHERE service_name LIKE '%{$key_word}%' UNION SELECT service_id FROM t_service_brands_apply WHERE apply_brand_name LIKE '%{$key_word}%' AND service_id <> '' AND brand_id <> '')) AND service_id <> 0".$where)->result();
	}
	
	/**
	 * 根据分类id，标签id和款式名 搜索款式
	 * @param Int $s_tag_id
	 * @param Int $s_class_id
	 * @param String $pattern_type
	 * @param Int $offset
	 * @param Int $limit
	 */
	public function service_search($brand_id,$service_id,$key_word,$series_status,$offset,$limit){
		$where=" AND 1=1";
		if($brand_id){
			$where.=" AND brand_id=".$brand_id;
		}
		if($service_id){
			$where.=" AND service_id=".$service_id;
		}
		if($series_status){
			$where.=" AND series_status=".$series_status;
		}
		return $this->db->query("SELECT * FROM t_product_brands_series WHERE (series_name LIKE '%{$key_word}%' OR service_id IN (SELECT service_id FROM t_service_info WHERE service_name LIKE '%{$key_word}%' UNION SELECT service_id FROM t_service_brands_apply WHERE apply_brand_name LIKE '%{$key_word}%' AND service_id <> '' AND brand_id <> '')) AND service_id <> 0".$where." ORDER BY series_id DESC LIMIT {$offset},{$limit}")->result();

	}

    /**
     *description:根据品牌id获取系列
     *author:yanyalong
     *date:2014/04/09
     */
    public function getSeriesByBrand($service_id,$brand_id="",$series_status="2",$keywords="",$p="",$row=""){
        $limit = "";
         if($p!=""&&$row!=""){
		    $limit = ' limit '.($p-1)*$row.','.$row;
        }
        $where_keywords = ($keywords!="")?" and pbs.series_name like '%$keywords%' ":"";
        $where_brand = ($brand_id!="")?" pbs.brand_id in($brand_id) and ":"";
	    return $this->db->query("select * from t_product_brands_series pbs left join t_service_brands_apply sba on sba.brand_id=pbs.brand_id where sba.apply_status<81 and $where_brand pbs.series_status in ($series_status) $where_keywords and pbs.service_id=$service_id group by pbs.series_id order by pbs.series_id desc $limit ")->result();

    }
    /**
     *description:根据系列名称和品牌id获取系列信息
     *author:yanyalong
     *date:2014/04/11
     */
    public function getSeriesInfoByName($brand_id,$series_name){
		return $this->db->query("select * from t_product_brands_series pbs where pbs.brand_id=$brand_id and series_name='$series_name'")->row();
    }
    /**
     *description:根据系列英文名称和品牌id获取系列信息
     *author:yanyalong
     *date:2014/04/11
     */
    public function getSeriesInfoByEname($brand_id,$series_ename){
		return $this->db->query("select * from t_product_brands_series pbs where pbs.brand_id=$brand_id and series_ename='$series_ename'")->row();
    }
}

