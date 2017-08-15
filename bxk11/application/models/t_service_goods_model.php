<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/06/17 16:24:19 
 * dinghaochenAuthor: jia178
 */
class T_service_goods_model extends CI_Model
{
	public $goods_id='';

	public $service_id='';

	public $product_id='';

	public $goods_title='';

	public $goods_price='';

	public $goods_member_price='';

	public $goods_desc='';

	public $goods_code='';

	public $goods_stock='';

	public $brand_id='';

	public $pc_id='';

	public $series_id='';

	public $goods_key_word='';

	public $goods_sort='';

	public $goods_size='';

	public $goods_material='';

	public $pu_id='';

	public $goods_pic1='';

	public $goods_pic2='';

	public $goods_pic3='';

	public $goods_pic4='';

	public $goods_pic5='';

	public $goods_color='';

	public $goods_status='';

	public $goods_addtime='';

	public $goods_model_number='';

	public $goods_price_is_show='';

	public $goods_recommend='';

	public $goods_views='';

	public $goods_likes='';

	public $goods_scheme_recommends='';

	public $goods_comments='';

	public $goods_notes='';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY goods_id
	 *
	 * @return 对象
	*/
	public function get($goods_id)
	{
		return $this->db->get_where('t_service_goods',array('goods_id' => $goods_id))->row();
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
	 * get_list(10,0) =>	select * from t_service_goods limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'goods_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_goods', $limit, $offset)->result();
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
	public function get_all($order_field = 'goods_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_goods')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_service_goods');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'goods_id', $order_type = 'ASC')
	{
		$this->db->from('t_service_goods')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_service_goods')->like($field_name, $keywords);
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
		$this->db->insert('t_service_goods', $this);
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
		return $this->db->update('t_service_goods', $this, array('goods_id' => $post['goods_id']));
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY goods_id
	*/
	public function delete($goods_id)
	{
		return $this->db->delete('t_service_goods',array('goods_id' => $goods_id));
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
		return $this->db->update('t_service_goods',$data,$where)?true:false;
	}

	/**
	 * 根据条件搜索房间
	 * @param Int $brand_id 品牌id
	 * @param Int $series_id 系列id
	 * @param Int $pattern_id 款式id
	 * @param Int $service_id  服务商id
	 * @param Int $code 品牌编号,平台编号
	 * @param Int $key_word  关键词
	 *
	 */
	
	public function admin_search_count($service_name,$goods_status,$goods_code,$key_word,$s_class_id,$service_id){
		$where= " AND 1=1";
	
		if($s_class_id){
			$where.=" AND s_class_id=".$s_class_id;
		}
		if($service_id){
			$where.=" AND service_id=".$service_id;
		}
		
		if($goods_status && $goods_status !=0){
			$where.=" AND goods_status=".$goods_status;
		}
		return $this->db->query("SELECT * FROM t_service_goods WHERE service_id IN (
SELECT b.service_id FROM (SELECT s.service_id as service_id FROM t_product_brands_series as s LEFT JOIN t_product_brands as p ON s.brand_id=p.brand_id WHERE s.service_id <> 0 AND (p.brand_name LIKE '%{$key_word}%' OR s.series_name LIKE '%{$key_word}%')
) as x JOIN (SELECT service_id as service_id FROM t_service_info WHERE service_name LIKE '%{$service_name}%') as b ON x.service_id=b.service_id
) AND (goods_code LIKE '%{$goods_code}%' OR goods_title LIKE '%{$goods_code}%')".$where)->result();
	
	}
	
	/**
	 * 根据条件搜索房间
	 * @param Int $brand_id 品牌id
	 * @param Int $series_id 系列id
	 * @param Int $pattern_id 款式id
	 * @param Int $service_id  服务商id
	 * @param Int $code 品牌编号,平台编号
	 * @param Int $key_word  关键词
	 *
	 */
	
	public function admin_search($service_name,$goods_status,$goods_code,$key_word,$s_class_id,$service_id,$offset,$limit){
		$where= " AND 1=1";
	
		if($s_class_id){
			$where.=" AND s_class_id=".$s_class_id;
		}

		if($service_id){
			$where.=" AND service_id=".$service_id;
		}

		if($goods_status && $goods_status !=0){
			$where.=" AND goods_status=".$goods_status;
		}
		 return $this->db->query("SELECT * FROM t_service_goods WHERE service_id IN (
				SELECT b.service_id FROM 
				(SELECT s.service_id as service_id FROM t_product_brands_series as s LEFT JOIN t_product_brands as p ON s.brand_id=p.brand_id WHERE s.service_id <> 0 AND (p.brand_name LIKE '%{$key_word}%' OR s.series_name LIKE '%{$key_word}%')
				) as x 
		 		JOIN 
				 (SELECT service_id as service_id FROM t_service_info WHERE service_name LIKE '%{$service_name}%') as b ON x.service_id=b.service_id
				) AND (goods_code LIKE '%{$goods_code}%' OR goods_title LIKE '%{$goods_code}%')".$where." ORDER BY goods_id DESC LIMIT {$offset},{$limit}")->result();

	}
    /**
     *description:根据系列id和商品名称获取商品信息
     *author:yanyalong
     *date:2014/04/11
     */
    public function getGoodsInfoByTitle($series_id,$goods_title){
		return $this->db->query("select * from t_service_goods where series_id=$series_id and goods_title='$goods_title'")->row();
    }
    /**
     *description:根据系列id和商品编码获取商品信息
     *author:yanyalong
     *date:2014/04/11
     */
    public function getGoodsInfoByCode($series_id,$goods_code){
		return $this->db->query("select * from t_service_goods where series_id=$series_id and goods_code='$goods_code'")->row();
    }
    /**
     *description:商品通用搜索
     *author:yanyalong
     *date:2014/04/14
     */
    public function getGoodsList($service_id,$classid="",$brandid="",$seriesid="",$code="",$p="",$row="",$sort=""){
        $limit = "";
        if($p!=""&&$row!=""){
		    $limit = ' limit '.($p-1)*$row.','.$row;
        }
        $where_class = ($classid!="")?" and  sg.pc_id=$classid ":"";
        $where_brand = ($brandid!="")?" and sg.brand_id=$brandid":"";
        $where_series= ($seriesid!="")?" and sg.series_id=$seriesid":"";
        $where_code= ($code!="")?" and sg.goods_code like '%$code%' ":"";
        $order = "";
        if($sort=="desc"){
            $order = " sg.goods_price desc,";
        }elseif($sort=="asc"){
            $order = " sg.goods_price asc,";
        }
       return $this->db->query("select * from t_service_goods sg left join t_service_brands_apply sba on sba.brand_id=sg.brand_id left join t_product_brands_series pbs on pbs.series_id=sg.series_id where sg.goods_status=1 and sba.apply_status<81 and pbs.series_status=2 and sg.goods_status=1  and sg.service_id=$service_id $where_class $where_brand $where_series $where_code group by sg.goods_id order by $order sg.goods_id desc $limit")->result();
    }
    /**
     *description:获取品牌下所有商品
     *author:yanyalong
     *date:2014/06/12
     */
    public function getGoodsListByBrand($brand_id,$p="",$row=""){
        $limit = "";
        if($p!=""&&$row!=""){
		    $limit = ' limit '.($p-1)*$row.','.$row;
        }
      return $this->db->query("select * from t_service_goods where brand_id in($brand_id) order by goods_id desc $limit")->result();
    }
    /**
     *description:根据商品id列表获取商品列表
     *author:yanyalong
     *date:2014/06/13
     */
    public function getListByIdList($idList){
      return $this->db->query("select * from t_service_goods where goods_id in($idList) order by goods_id desc")->result();
    }
    /**
     *description:商品通用搜索
     *author:yanyalong
     *date:2014/04/14
     */
    public function getGoodsListBySeriesId($service_id,$brandid="",$seriesid="",$p="",$row="",$goods_id=""){
        $limit = "";
        if($p!=""&&$row!=""){
		    $limit = ' limit '.($p-1)*$row.','.$row;
        }
        $where_brand = ($brandid!="")?" and sg.brand_id=$brandid":"";
        $where_series= ($seriesid!="")?" and sg.series_id=$seriesid":"";
        $where_goodsid= ($goods_id!="")?" and sg.goods_id<>$goods_id":"";
       return $this->db->query("select * from t_service_goods sg left join t_service_brands_apply sba on sba.brand_id=sg.brand_id left join t_product_brands_series pbs on pbs.series_id=sg.series_id where sg.goods_status=1 and sba.apply_status<81 and pbs.series_status=2 and sg.goods_status=1  and sg.service_id=$service_id $where_brand $where_series $where_goodsid group by sg.goods_id order by sg.goods_id desc $limit")->result();
    }
}
