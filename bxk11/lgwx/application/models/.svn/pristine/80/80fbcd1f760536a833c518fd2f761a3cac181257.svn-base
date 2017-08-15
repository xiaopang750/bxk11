<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/07/14 10:45:37 
 * dinghaochenAuthor: jia178
 */
class T_project_room_bill_item_model extends CI_Model
{
	public $item_id='';

	public $room_id='';

	public $item_type='';

	public $hot_status='';

	public $hot_x='';

	public $hot_y='';

	public $hot_angle='';

	public $goods_id='';

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY item_id
	 *
	 * @return 对象
	*/
	public function get($item_id)
	{
		return $this->db->get_where('t_project_room_bill_item',array('item_id' => $item_id))->row();
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
		$this->db->insert('t_project_room_bill_item', $this);
		return $this->db->insert_id();
	}

    /**
     * 修改
     * @param array $data
     * @param arrray $where
     * @return boolean
     * @author liuguangping
     * @version jia178 v1.0 2013/11/7
     */
    public function update($data,$where){
        return $this->db->update('t_project_room_bill_item',$data,$where)?true:false;
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='item_id',$where)
    {
         return $this->db->select($field)->get_where('t_project_room_bill_item',$where)->row();
    }   
    
    /**
     * 根据条件得到所有记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getAll($field='item_id',$where){
        return $this->db->select($field)->get_where('t_project_room_bill_item',$where)->result();
    }
    
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY item_id
	*/
	public function delete($item_id)
	{
		return $this->db->delete('t_project_room_bill_item',array('item_id' => $item_id));
	}
	
	/**
	 * @abstract 根据房间room_i获取 产品
	 */
	public function getBillitemByItem($field,$where){
		return $this->db->select($field)->get_where('t_project_room_bill_item',$where)->result_array();
	}
	
	/**
	 *description:根据产品id获取房间列表
	 *author:yanyalong
	 *date:2013/12/29
	 */
	public function getRoomListByProductId($product_id,$p="",$row=""){
		$limit = "";
		if($p!=""&&$row!=""){
		$limit = " limit ".($p-1)*$row.",".$row;
		}
		return $this->db->query("select * from  t_project_room pr left join t_user u on u.user_id=pr.user_id left join t_user_info ui on ui.user_id=pr.user_id where room_id in(select room_id from t_project_room_bill_item where product_id=$product_id) $limit")->result();
	}
	/**
	 *description:获取设计师样板间产品列表
	 *author:yanyalong
	 *date:2013/12/29
	 */
	public function getProductListByDesignRoomList($user_id){
	return $this->db->query("select * from t_certified_product cp left join t_product_brands pb on pb.brand_id=cp.brand_id left join t_certified_product_info cpi on cpi.product_id=cp.product_id  where cp.product_id in (select product_id from t_project_room_bill_item where room_id in (select room_id from t_project_room where user_id=$user_id))")->result();
	}
	/**
	 *description:获取房间产品详情
	 *author:yanyalong
	 *date:2013/12/29
	 */
	public function getProductListByDesignRoomId($room_id){
	return $this->db->query("select * from t_certified_product cp left join t_product_brands pb on pb.brand_id=cp.brand_id where cp.product_id in (select product_id from t_project_room_bill_item where room_id=$room_id)")->result();
	}
	/**
	 * @abstract 根据房间room_i获取 产品
	 */
	public function getBillitemByItemAll(){
		return $this->db->query("SELECT b.*,c.* FROM t_project_room_bill_item as b LEFT JOIN t_certified_product AS c ON b.product_id=c.product_id WHERE b.room_id={$this->room_id} AND b.hot_status=1")->result_array();
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
		return $this->db->update('t_project_room_bill_item',$data,$where)?true:false;
	}
}
