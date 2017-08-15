<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/06/06 17:29:42 
 * dinghaochenAuthor: jia178
 */
class T_service_spreader_rebate_record_model extends CI_Model
{
	public $rr_id;

	public $service_id;

	public $ss_type;

	public $spreader_code;

	public $rr_amount;

	public $rr_card_number;

	public $rr_grant_time;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY rr_id
	 *
	 * @return 对象
	*/
	public function get($rr_id)
	{
		return $this->db->get_where('t_service_spreader_rebate_record',array('rr_id' => $rr_id))->row();
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
	 * get_list(10,0) =>	select * from t_service_spreader_rebate_record limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'rr_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_spreader_rebate_record', $limit, $offset)->result();
	}
	
	public function get_list1($p,$row, $order_field = 'rr_id', $order_type = 'ASC')
	{	
		$limit = " limit ".($p-1)*$row.",".$row;
		$this->db->order_by($order_field, $order_type);
		$sql= "select service_company,t_service_spreader_rebate_record.* from t_service_spreader_rebate_record INNER JOIN t_service_info on t_service_spreader_rebate_record.service_id = t_service_info.service_id ".$limit;	
		return  $this->db->query($sql)->result();
	}
	public function get_list2($p,$row, $data,$order_field = 'rr_id', $order_type = 'ASC')
	{	
		$limit = " limit ".($p-1)*$row.",".$row;
		$str="";
		foreach($data as $k=>$v){
			if($v!="" && $k!="per_page")
			{
			 if($k=="rr_grant_time1")
			 {
				if($v=="")
				 {
					continue;	
				 }
				$k="rr_grant_time>";
			 }
			 if($k=="rr_grant_time2")
			 {
				 if($v=="")
				 {
					continue;	
				 }
				$k="rr_grant_time<";
				$v=strtotime($v)+86400;
				$v=date('Y-m-d',$v);
			 }
			 $str.=" and t_service_spreader_rebate_record.".$k."= '".$v."'";
			}
		} 
		
		$this->db->order_by($order_field, $order_type);
		$sql= "select service_company,t_service_spreader_rebate_record.* from t_service_spreader_rebate_record INNER JOIN t_service_info on t_service_spreader_rebate_record.service_id = t_service_info.service_id where 1 ".$str.$limit = " limit ".($p-1)*$row.",".$row;
		
		return  $this->db->query($sql)->result();
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
	public function get_all($order_field = 'rr_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_spreader_rebate_record')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_service_spreader_rebate_record');
	}

	public function count_all1($ss_type,$spreader_code,$rr_card_number,$rr_grant_time1,$rr_grant_time2)
	{
		
		$sql = "select count(*) as nubs from t_service_spreader_rebate_record where 1";
		if($ss_type != ''){
			$sql .= " and ss_type = ".$ss_type;
		}
		if($spreader_code != ''){
			$sql .= " and spreader_code = '".$spreader_code."'";
		}
		if($rr_card_number != ''){
			$sql .= " and rr_card_number = '".$rr_card_number."'";
		}
		if($rr_grant_time1 != ''){
			$sql .= " and rr_grant_time >= '".$rr_grant_time1."'";
		}
		if($rr_grant_time2 != ''){
			$rr_grant_time2=strtotime($rr_grant_time2)+86400;
			$rr_grant_time2=date('Y-m-d',$rr_grant_time2);		
			$sql .= " and rr_grant_time <= '".$rr_grant_time2."'";
		}
		
		$mes = $this->db->query($sql)->row_array();
		if($mes)
		{
			return $mes['nubs'];
		}		
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'rr_id', $order_type = 'ASC')
	{
		$this->db->from('t_service_spreader_rebate_record')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_service_spreader_rebate_record')->like($field_name, $keywords);
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
		$this->db->insert('t_service_spreader_rebate_record', $this);
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
		return $this->db->update('t_service_spreader_rebate_record', $this, array('rr_id' => $post['rr_id']));
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY rr_id
	*/
	public function delete($rr_id)
	{
		return $this->db->delete('t_service_spreader_rebate_record',array('rr_id' => $rr_id));
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
		return $this->db->update('t_service_spreader_rebate_record',$data,$where)?true:false;
	}
	
	/**
	 * 根据条件得到单条记录
	 *
	 * @PRIMARY KEY rwfr_id
	 *
	 * @return 对象
	 */
	public function getOne($field='rr_id',$where)
	{
		 return $this->db->select($field)->get_where('t_service_spreader_rebate_record',$where)->row();
	}	

	/**
	 * 根据service_id 和 sr_id 来查找主键
	 *
	 * @PRIMARY KEY sw_id
	*/
	public function getArray($field='rr_id',$where){
		return $this->db->select($field)->get_where('t_service_spreader_rebate_record',$where)->result();
	}
	
}
