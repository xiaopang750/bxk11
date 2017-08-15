<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_service_wap_menu_model extends CI_Model
{
	public $menu_id;
	public $service_type_id;
	public $menu_name;
	public $menu_url;
	public $menu_level;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY menu_id
	 *
	 * @return 对象
	*/
	public function get($menu_id)
	{
		return $this->db->get_where('t_service_wap_menu',array('menu_id' => $menu_id))->row();
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
	 * get_list(10,0) =>	select * from t_service_wap_menu limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'menu_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_wap_menu', $limit, $offset)->result();
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
	public function get_all($order_field = 'menu_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_wap_menu')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_service_wap_menu');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'menu_id', $order_type = 'ASC')
	{
		$this->db->from('t_service_wap_menu')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_service_wap_menu')->like($field_name, $keywords);
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
		$this->db->insert('t_service_wap_menu', $this);
		return $this->db->insert_id();
	}
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY menu_id
	*/
	public function delete($menu_id)
	{
		return $this->db->delete('t_service_wap_menu',array('menu_id' => $menu_id));
	}
	
    /**
     *description:根据服务上类型获取模版菜单列表
     *author:yanyalong
     *date:2014/05/23
     */
    public function geLsitByServiceType($service_type_id,$menu_level="1"){
        return $this->db->query("select * from t_service_wap_menu where service_type_id=$service_type_id and menu_level=$menu_level")->result();
    }

      /*********************刘广平 2014/05/23******************************/
     /**
     * 查询经销商的总条数 liuguangping
     * @param Int $province 省
     * @param Int $city 市
     * @param Int $district 区
     * @param Int $service_status 状态
     * @param String $key_word 关键字-微信号-公司名
     */

    public function admin_search_count($key_word,$service_type_id){
        $where= " 1=1";
        if($service_type_id){
            $where.=" AND service_type_id=".$service_type_id;
        }
        return $this->db->query("SELECT * FROM t_service_wap_menu WHERE ".$where." AND menu_name LIKE '%{$key_word}%'")->result();

    }

    /**
     * 根据条件搜索房间
     * @param Int $brand_id 品牌id
     * @param Int $series_id 系列id
     * @param Int $pattern_id 款式id
     * @param Int $code 品牌编号,平台编号
     * @param Int $key_word  关键词
     *
     */

    public function admin_search($key_word,$service_type_id,$offset,$limit){
        $where= " 1=1";
        if($service_type_id){
            $where.=" AND service_type_id=".$service_type_id;
        }
        return $this->db->query("SELECT * FROM t_service_wap_menu WHERE ".$where." AND menu_name LIKE '%{$key_word}%' LIMIT {$offset},{$limit}")->result();
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='menu_id',$where)
    {
         return $this->db->select($field)->get_where('t_service_wap_menu',$where)->row();
    }   

    /**
     * 根据service_id 和 wid 来查找主键
     *
     * @PRIMARY KEY sw_id
    */
    public function getArray($field='menu_id',$where){
        return $this->db->select($field)->get_where('t_service_wap_menu',$where)->result();
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
        return $this->db->update('t_service_wap_menu',$data,$where)?true:false;
    }
}

