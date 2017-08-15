<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/06/13 03:46:13 
 * dinghaochenAuthor: jia178
 */
class T_service_goods_match_model extends CI_Model
{
	public $gm_id;

	public $gm_name;

	public $gm_pic;

	public $gm_list;

	public $gm_desc;

	public $gm_price;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY gm_id
	 *
	 * @return 对象
	*/
	public function get($gm_id)
	{
		return $this->db->get_where('t_service_goods_match',array('gm_id' => $gm_id))->row();
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
	 * get_list(10,0) =>	select * from t_service_goods_match limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'gm_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_goods_match', $limit, $offset)->result();
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
	public function get_all($order_field = 'gm_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_goods_match')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_service_goods_match');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'gm_id', $order_type = 'ASC')
	{
		$this->db->from('t_service_goods_match')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_service_goods_match')->like($field_name, $keywords);
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
		$this->db->insert('t_service_goods_match', $this);
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
		return $this->db->update('t_service_goods_match', $this, array('gm_id' => $post['gm_id']));
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY gm_id
	*/
	public function delete($gm_id)
	{
		return $this->db->delete('t_service_goods_match',array('gm_id' => $gm_id));
	}
	
    /**
     *description:根据名称检测服务商是否存在同名商品搭配
     *author:yanyalong
     *date:2014/06/13
     */
    public function getGmInfoByName($service_id,$gm_name){
      return $this->db->query("select * from t_service_goods_match where service_id='$service_id' and gm_name='$gm_name'")->row();
    }

    /**
     *description:更新一条数据
     *author:yanyalong
     *date:2014/06/13
     */
	public function updates_global($data,$where){
		return $this->db->update('t_service_goods_match',$data,$where)?true:false;
	}
    /**
     *description:获取服务商商品搭配列表
     *author:yanyalong
     *date:2014/06/13
     */
    public function getList($service_id,$p="",$row=""){
        $limit = "";
        if($p!=""&&$row!=""){
		    $limit = ' limit '.($p-1)*$row.','.$row;
        }
      return $this->db->query("select * from t_service_goods_match where service_id='$service_id' order by gm_id  desc $limit ")->result();
    }
    /**
     *description:根据商品id获取服务商商品搭配列表
     *author:yanyalong
     *date:2014/06/13
     */
    public function getListByGoodsId($goods_id,$p="",$row=""){
        $limit = "";
        if($p!=""&&$row!=""){
		    $limit = ' limit '.($p-1)*$row.','.$row;
        }
      return $this->db->query("select * from t_service_goods_match where gm_list like '%$goods_id%' order by gm_id  desc $limit ")->result();
    }
}
