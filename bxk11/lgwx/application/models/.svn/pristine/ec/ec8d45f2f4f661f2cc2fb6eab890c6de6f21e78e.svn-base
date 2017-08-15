<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/05/19 00:16:27 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_information_type_model extends CI_Model
{
	/**
	 * @COLUMN_KEY		PRI
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $it_id;

	/**
	 * @COLUMN_KEY		MUL
	 * @DATA_TYPE		int
	 * @IS_NULLABLE		YES
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		int(11)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $service_id;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		varchar
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		varchar(20)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $it_name;

	/**
	 * @COLUMN_KEY		
	 * @DATA_TYPE		smallint
	 * @IS_NULLABLE		NO
	 * @COLUMN_DEFAULT	
	 * @COLUMN_TYPE		smallint(2)
	 * @EXTRA			
	 * @COLUMN_COMMENT	
	 */
	public $it_type;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY it_id
	 *
	 * @return 对象
	*/
	public function get($it_id)
	{
		return $this->db->get_where('t_information_type',array('it_id' => $it_id))->row();
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
	 * get_list(10,0) =>	select * from t_information_type limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'it_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_information_type', $limit, $offset)->result();
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
	public function get_all($order_field = 'it_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_information_type')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_information_type');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'it_id', $order_type = 'ASC')
	{
		$this->db->from('t_information_type')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_information_type')->like($field_name, $keywords);
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
		$this->db->insert('t_information_type', $this);
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
		return $this->db->update('t_information_type', $this, array('it_id' => $post['it_id']));
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_insert($post)
	{
		if(!isset($post['it_name']) || empty($post['it_name'])) return false;
		if(!isset($post['it_type']) || empty($post['it_type'])) return false;

		return true;
	}

	/**
	 * 确认数据库表中的不能为空的列是否存在于$post数组中
	 */
	private function validation_db_is_not_nullable_rules_by_update($post)
	{
		if(!isset($post['it_id']) || empty($post['it_id'])) return false;
		if(!isset($post['it_name']) || empty($post['it_name'])) return false;
		if(!isset($post['it_type']) || empty($post['it_type'])) return false;

		return true;
	}

	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY it_id
	*/
	public function delete($it_id)
	{
		return $this->db->delete('t_information_type',array('it_id' => $it_id));
	}
    /**
     *description:获取资讯分类列表
     *author:yanyalong
     *date:2014/05/23
     */
    public function getList(){
       return $this->db->query("select * from t_information_type where it_type=1")->result(); 
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

    public function admin_search_count($key_word,$it_type){
        $where= " 1=1";
        if($it_type){
            $where.=" AND it_type=".$it_type;
        }
        return $this->db->query("SELECT * FROM t_information_type WHERE ".$where." AND it_name LIKE '%{$key_word}%'")->result();

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

    public function admin_search($key_word,$it_type,$offset,$limit){
        $where= " 1=1";
        if($it_type){
            $where.=" AND it_type=".$it_type;
        }
        return $this->db->query("SELECT * FROM t_information_type WHERE ".$where." AND it_name LIKE '%{$key_word}%' LIMIT {$offset},{$limit}")->result();
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='it_id',$where)
    {
         return $this->db->select($field)->get_where('t_information_type',$where)->row();
    }   

    /**
     * 根据service_id 和 wid 来查找主键
     *
     * @PRIMARY KEY sw_id
    */
    public function getArray($field='it_id',$where){
        return $this->db->select($field)->get_where('t_information_type',$where)->result();
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
        return $this->db->update('t_information_type',$data,$where)?true:false;
    }
}
