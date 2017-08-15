<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/05/19 00:10:24 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_service_wap_slide_model extends CI_Model
{
	public $slide_id;

	public $slide_title;

	public $slide_pic;

	public $slide_url;

	public $service_id;

	public $slide_type;

	public $slide_default;

	public $shop_id;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY slide_id
	 *
	 * @return 对象
	*/
	public function get($slide_id)
	{
		return $this->db->get_where('t_service_wap_slide',array('slide_id' => $slide_id))->row();
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
	 * get_list(10,0) =>	select * from t_service_wap_slide limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'slide_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_wap_slide', $limit, $offset)->result();
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
	public function get_all($order_field = 'slide_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_wap_slide')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_service_wap_slide');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'slide_id', $order_type = 'ASC')
	{
		$this->db->from('t_service_wap_slide')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_service_wap_slide')->like($field_name, $keywords);
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
		$this->db->insert('t_service_wap_slide', $this);
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
		return $this->db->update('t_service_wap_slide', $this, array('slide_id' => $post['slide_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['slide_title']) || empty($post['slide_title'])) return false;
		if(!isset($post['slide_pic']) || empty($post['slide_pic'])) return false;
		if(!isset($post['slide_url']) || empty($post['slide_url'])) return false;
		if(!isset($post['service_id']) || empty($post['service_id'])) return false;
		if(!isset($post['slide_type']) || empty($post['slide_type'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['slide_id']) || empty($post['slide_id'])) return false;
		if(!isset($post['slide_title']) || empty($post['slide_title'])) return false;
		if(!isset($post['slide_pic']) || empty($post['slide_pic'])) return false;
		if(!isset($post['slide_url']) || empty($post['slide_url'])) return false;
		if(!isset($post['service_id']) || empty($post['service_id'])) return false;
		if(!isset($post['slide_type']) || empty($post['slide_type'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY slide_id
	*/
	public function delete($slide_id)
	{
		return $this->db->delete('t_service_wap_slide',array('slide_id' => $slide_id));
	}
	
    /**
     *description:获取服务商所有幻灯片列表
     *author:yanyalong
     *date:2014/05/25
     */
    public function getSlideListByService($service_id,$slide_default=0,$shop_id=''){
    	$where = 'and 1=1';
		if($shop_id){
			$where = " and shop_id=$shop_id";
		}
       return $this->db->query("select * from t_service_wap_slide where service_id=$service_id $where and slide_default=$slide_default")->result();
    }
    public function updates_global($data,$where){
        return $this->db->update('t_service_wap_slide',$data,$where)?true:false;
    }

     /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='slide_id',$where)
    {
         return $this->db->select($field)->get_where('t_service_wap_slide',$where)->row();
    }   

    /**
     * 根据service_id 和 wid 来查找主键
     *
     * @PRIMARY KEY sw_id
    */
    public function getArray($field='slide_id',$where){
        return $this->db->select($field)->get_where('t_service_wap_slide',$where)->result();
    }

	 /**
	 *description:执行sql
	 *author:liguangping
	 *date:2014/06/03
	 */
    public function query($sql){
    	if($sql){
    		return $this->db->query($sql)?true:false;
    	}else{
    		return false;
    	}
    }
}
