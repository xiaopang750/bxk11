<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/06/21 11:53:27 
 * dinghaochenAuthor: jia178
 */
class T_like_service_goods_model extends CI_Model
{
	public $like_id='';

	public $goods_id='';

	public $user_id='';

	public $like_addtime='';

	public $shop_id='';

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY like_id
	 *
	 * @return 对象
	*/
	public function get($like_id)
	{
		return $this->db->get_where('t_like_service_goods',array('like_id' => $like_id))->row();
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
		$this->db->insert('t_like_service_goods', $this);
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
        return $this->db->update('t_like_service_goods',$data,$where)?true:false;
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='like_id',$where)
    {
         return $this->db->select($field)->get_where('t_like_service_goods',$where)->row();
    }   
    
    /**
     * 根据条件得到所有记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getAll($field='like_id',$where){
        return $this->db->select($field)->get_where('t_like_service_goods',$where)->result();
    }
    
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY like_id
	*/
	public function delete($like_id)
	{
		return $this->db->delete('t_like_service_goods',array('like_id' => $like_id));
	}
	
    /**
	 *description:获取用户是否关注过该商品
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function is_like($user_id,$goods_id,$shop_id){
		if($goods_id=="") return '0';
		$res = $this->db->query("select * from t_like_service_goods where user_id='$user_id' and goods_id=$goods_id  and shop_id=$shop_id")->row();			
		if($res!=false) return '1';
		return '0';
	}
	/**
	 *description:取消关注产品
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function del_like($user_id,$goods_id,$shop_id){
		if($goods_id=="") return '0';
		return $this->db->query("delete from t_like_service_goods where goods_id='$goods_id' and user_id='$user_id' and shop_id=$shop_id");			
	}
    /**
     *description:获取用户收藏商品
     *author:yanyalong
     *date:2014/04/27
     */
    public function getlistByLike($user_id,$p="",$row=""){
        $limit = "";
        if($p!=""&&$row!=""){
		    $limit = ' limit '.($p-1)*$row.','.$row;
        }
		return $this->db->query("select * from t_like_service_goods lsg left join t_service_goods sg on sg.goods_id=lsg.goods_id where lsg.user_id='$user_id' order by lsg.like_id desc $limit")->result();			
    }
    /**
     *description:根据门店id获取门店商品排行
     *author:yanyalong
     *date:2014/07/04
     */
    public function getRankByShopId($shop_id,$p="",$row=""){
        $limit = "";
        if($p!=""&&$row!=""){
		    $limit = ' limit '.($p-1)*$row.','.$row;
        }
		return $this->db->query("select count(*) like_count,sg.* from t_like_service_goods lsg left join t_service_goods sg on sg.goods_id=lsg.goods_id where lsg.shop_id='$shop_id' group by lsg.goods_id order by like_count desc $limit")->result();			
    }
}
