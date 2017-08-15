<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/05/19 12:08:54 
 * dinghaochenAuthor: jia178
 */
class T_wap_template_model extends CI_Model
{
	public $template_id;

	public $service_type_id;

	public $service_id;

	public $template_name;

	public $template_code;

	public $template_status;

	public $template_is_default;

	public $template_type;

	public $main_menu_count;

	public $shortcut_menu_count;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY template_id
	 *
	 * @return 对象
	*/
	public function get($template_id)
	{
		return $this->db->get_where('t_wap_template',array('template_id' => $template_id))->row();
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
	 * get_list(10,0) =>	select * from t_wap_template limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'template_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_wap_template', $limit, $offset)->result();
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
	public function get_all($order_field = 'template_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_wap_template')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_wap_template');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'template_id', $order_type = 'ASC')
	{
		$this->db->from('t_wap_template')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_wap_template')->like($field_name, $keywords);
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
		$this->db->insert('t_wap_template', $this);
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
		return $this->db->update('t_wap_template', $this, array('template_id' => $post['template_id']));
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY template_id
	*/
	public function delete($template_id)
	{
		return $this->db->delete('t_wap_template',array('template_id' => $template_id));
	}
	
    /**
     *description:获取指定服务商类型下的模板
     *author:yanyalong
     *date:2014/05/23
     */
    public function geLsitByServiceType($service_type_id){
       return $this->db->query("select * from t_wap_template where service_type_id=$service_type_id and template_status=1")->result(); 
       
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

    public function admin_search_count($key_word,$template_type){
        $where= " 1=1";
        if($template_type){
            $where.=" AND template_type=".$template_type;
        }
        return $this->db->query("SELECT * FROM t_wap_template WHERE ".$where." AND template_name LIKE '%{$key_word}%'")->result();

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

    public function admin_search($key_word,$template_type,$offset,$limit){
        $where= " 1=1";
        if($template_type){
            $where.=" AND template_type=".$template_type;
        }
        return $this->db->query("SELECT * FROM t_wap_template WHERE ".$where." AND template_name LIKE '%{$key_word}%' LIMIT {$offset},{$limit}")->result();
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='template_id',$where)
    {
         return $this->db->select($field)->get_where('t_wap_template',$where)->row();
    }   

    /**
     * 根据service_id 和 wid 来查找主键
     *
     * @PRIMARY KEY sw_id
    */
    public function getArray($field='template_id',$where){
        return $this->db->select($field)->get_where('t_wap_template',$where)->result();
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
        return $this->db->update('t_wap_template',$data,$where)?true:false;
    }
}
