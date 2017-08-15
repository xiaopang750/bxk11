<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/05/19 12:08:53 
 * dinghaochenAuthor: jia178
 */
class T_service_wap_template_model extends CI_Model
{
	public $swt_id;

	public $template_id;

	public $service_id;

	public $main_menu;

	public $shortcut_menu;

	public $is_use;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY swt_id
	 *
	 * @return 对象
	*/
	public function get($swt_id)
	{
		return $this->db->get_where('t_service_wap_template',array('swt_id' => $swt_id))->row();
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
	 * get_list(10,0) =>	select * from t_service_wap_template limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'swt_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_wap_template', $limit, $offset)->result();
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
	public function get_all($order_field = 'swt_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_wap_template')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_service_wap_template');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'swt_id', $order_type = 'ASC')
	{
		$this->db->from('t_service_wap_template')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_service_wap_template')->like($field_name, $keywords);
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
		$this->db->insert('t_service_wap_template', $this);
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
		return $this->db->update('t_service_wap_template', $this, array('swt_id' => $post['swt_id']));
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY swt_id
	*/
	public function delete($swt_id)
	{
		return $this->db->delete('t_service_wap_template',array('swt_id' => $swt_id));
	}
	
    /**
     *description:获取服务上商当前应用模版
     *author:yanyalong
     *date:2014/05/23
     */
    public function getTemplateUseInfoByService($service_id){
       return $this->db->query("select * from t_service_wap_template where service_id=$service_id and is_use=1")->row(); 
    }
    /**
     *description:获取服务商应用模版列表
     *author:yanyalong
     *date:2014/05/23
     */
    public function getTemplateListByService($service_id){
       return $this->db->query("select * from t_service_wap_template where service_id=$service_id")->result(); 
    }
	public function updates_global($data,$where){
		return $this->db->update('t_service_wap_template',$data,$where)?true:false;
	}
}
