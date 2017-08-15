<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/06/06 17:29:42 
 * dinghaochenAuthor: jia178
 */
class T_service_spreader_model extends CI_Model
{
	public $ss_id;

	public $spreader_code;

	public $ss_name;

	public $ss_phone;

	public $ss_clicks;

	public $ss_certifieds;

	public $ss_regs;

	public $ss_join_time;

	public $ss_service_reg_time;

	public $ss_type;

	public $ss_status;

	public $ss_desc;

	public $open_id;

	public $ss_qr;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY ss_id
	 *
	 * @return 对象
	*/
	public function get($ss_id)
	{
		return $this->db->get_where('t_service_spreader',array('ss_id' => $ss_id))->row();
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
	 * get_list(10,0) =>	select * from t_service_spreader limit 0,10
	 */
	public function get_list($p,$row, $order_field = 'ss_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_spreader', $p, $row)->result();
	}
	public function get_list1($p,$row, $order_field = 'ss_id', $order_type = 'ASC')
	{
		$limit = " limit ".($p-1)*$row.",".$row;
		$this->db->order_by($order_field, $order_type);
		$sql= "select * from t_service_spreader ".$limit;	
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
	public function get_all($order_field = 'ss_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_spreader')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_service_spreader');
	}
	public function count_all1($ss_name,$spreader_code,$rr_phone,$rr_grant_time1,$rr_grant_time2)
	{
		
		$sql = "select count(*) as nubs from t_service_spreader where 1";
		if($ss_name != ''){
			$sql .= " and ss_name = '".$ss_name."'";
		}
		if($spreader_code != ''){
			$sql .= " and spreader_code = '".$spreader_code."'" ;
		}
		if($rr_phone != ''){
			$sql .= " and ss_phone = '".$rr_phone."'";
		}
		if($rr_grant_time1 != ''){
			$sql .= " and ss_join_time >= '".$rr_grant_time1."'";
		}
		if($rr_grant_time2 != ''){			
			
			$rr_grant_time2=strtotime($rr_grant_time2)+86400;
			$rr_grant_time2=date('Y-m-d',$rr_grant_time2);			 
			$sql .= " and ss_join_time <= '".$rr_grant_time2."'";
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'ss_id', $order_type = 'ASC')
	{
		$this->db->from('t_service_spreader')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_service_spreader')->like($field_name, $keywords);
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
		$this->db->insert('t_service_spreader', $this);
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
		return $this->db->update('t_service_spreader', $this, array('ss_id' => $post['ss_id']));
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY ss_id
	*/
	public function delete($ss_id)
	{
		return $this->db->delete('t_service_spreader',array('ss_id' => $ss_id));
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
		return $this->db->update('t_service_spreader',$data,$where)?true:false;
	}
	
	/**
	 * 根据条件得到单条记录
	 *
	 * @PRIMARY KEY rwfr_id
	 *
	 * @return 对象
	 */
	public function getOne($field='ss_id',$where)
	{
		 return $this->db->select($field)->get_where('t_service_spreader',$where)->row();
	}	

	/**
	 * 根据service_id 和 ss_id 来查找主键
	 *
	 * @PRIMARY KEY sw_id
	*/
	public function getArray($field='ss_id',$where){
		return $this->db->select($field)->get_where('t_service_spreader',$where)->result();
	}

	/**
	 * 根据 spreader_code 推广者标识
	 *
	 * @PRIMARY KEY ss_id
	*/
	public function setIncrease($spreader_code,$field,$type){
    	$set = ($type == 'up')?"$field=$field+1":"$field=$field-1";
    	return $this->db->query("UPDATE t_service_spreader set {$set} WHERE spreader_code='".$spreader_code."'");
    }

	public function yesorno($nep,$id)
	{
		 $sql= "update t_service_spreader set ss_status=$nep where ss_id=$id";
		 return  $this->db->query($sql);
	}
	
	
	public function get_list2($p,$row, $data,$limit = 10, $offset = 0, $order_field = 'rr_id', $order_type = 'ASC')
	{	
		$limit = " limit ".($p-1)*$row.",".$row;
		$str="";
		foreach($data as $k=>$v){
			if($v!="" && $k!="per_page")
			{
			 if($k=="rr_grant_time1")
			 {
				$k="ss_join_time>";
				if($v=="")
				 {
					continue;	
				 }
			 }
			 if($k=="rr_grant_time2")
			 {
				 if($v=="")
				 {
					continue;	
				 }
				$k="ss_join_time<";
				$v=strtotime($v)+86400;
				$v=date('Y-m-d',$v);
			 }
			 $str.=" and ".$k."= '".$v."'";
			}
		} 
		
		$this->db->order_by($order_field, $order_type);
		$sql= "select * from t_service_spreader where 1 ".$str.$limit = " limit ".($p-1)*$row.",".$row;
	
		return  $this->db->query($sql)->result();
	}
}
