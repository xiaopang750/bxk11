<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/04/17 23:50:22 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_service_information_model extends CI_Model
{
	public $si_id;
	public $service_id;
	public $si_title;
	public $si_content;
	public $si_addtime;
	public $si_status;
	public $it_id;
	public $si_pic;
	public $si_likes;
	public $si_views;
	public $si_author;
	public $si_wap_isshow;
	public $si_keyword;
	public $si_desc;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY si_id
	 *
	 * @return 对象
	*/
	public function get($si_id)
	{
		return $this->db->get_where('t_service_information',array('si_id' => $si_id))->row();
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
	 * get_list(10,0) =>	select * from t_service_information limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'si_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_information', $limit, $offset)->result();
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
	public function get_all($order_field = 'si_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_information')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_service_information');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'si_id', $order_type = 'ASC')
	{
		$this->db->from('t_service_information')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_service_information')->like($field_name, $keywords);
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
		$this->db->insert('t_service_information', $this);
		return $this->db->insert_id();
	}
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY si_id
	*/
	public function delete($si_id)
	{
		return $this->db->delete('t_service_information',array('si_id' => $si_id));
	}
	
    /**
     *description:获取资讯列表
     *author:yanyalong
     *date:2014/04/21
     */
    public function getList($service_id,$keywords="",$p="",$row="",$it_id=""){
        $limit = "";
        if($p!=""&&$row!=""){
		    $limit = ' limit '.($p-1)*$row.','.$row;
        }
        $where_keywords= ($keywords!="")?" and si_title like '%$keywords%' ":"";
        $where_it_id = ($it_id!="")?" and it_id=$it_id ":"";
        return $this->db->query("select * from t_service_information where service_id=$service_id $where_keywords $where_it_id and si_status=1 order by si_id desc $limit ")->result();
    }
	public function updates_global($data,$where){
		return $this->db->update('t_service_information',$data,$where)?true:false;
	}
    /**
     *description:获取最新一条资讯
     *author:yanyalong
     *date:2014/04/26
     */
    public function getOneByNew($service_id){
       return $this->db->query("select * from t_service_information where service_id=$service_id and si_status=1 order by si_id desc limit 1")->row();
    }

    /**
	 * 根据条件得到单条记录
	 *
	 * @PRIMARY KEY rwfr_id
	 *
	 * @return 对象
	 */
	public function getOne($field='si_id',$where)
	{
		 return $this->db->select($field)->get_where('t_service_information',$where)->row();
	}	

	/**
	 * 根据service_id 和 wid 来查找主键
	 *
	 * @PRIMARY KEY sw_id
	*/
	public function getArray($field='si_id',$where){
		return $this->db->select($field)->get_where('t_service_information',$where)->result();
	}

	 /**
     * 根据 it_id 来查找
     *
     * @PRIMARY KEY it_id
    */
    public function getHotSport($field='*',$where,$offset=0,$limit=5){
    	$map = "1=1";
        if($where){
        	foreach ($where as $key => $value) {
        		 $map.=" AND $key=".$value;
        	}
        }
       return $this->db->query("SELECT $field FROM t_service_information WHERE ".$map." ORDER BY si_views DESC LIMIT {$offset},{$limit}")->result();
    }

    public function setIncrease($si_id,$type){
    	$set = ($type == 'up')?"si_views=si_views+1":"si_views=si_views-1";
    	return $this->db->query("UPDATE t_service_information set {$set} WHERE si_id = {$si_id}");
    }

    //平台资讯
    public function getInfoList($field='*',$where,$offset=0,$limit=5,$order_field='si_id',$order_type='DESC'){
        $map = "1=1";
        if($where){
        	foreach ($where as $key => $value) {
        		 $map.=" AND $key=".$value;
        	}
        }
       return $this->db->query("SELECT $field FROM t_service_information WHERE ".$map." ORDER BY {$order_field} {$order_type} LIMIT {$offset},{$limit}")->result();
    }
}
