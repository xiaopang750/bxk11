<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/06/21 16:18:04 
 * dinghaochenAuthor: jia178
 */
class T_service_shop_model extends CI_Model
{
	public $shop_id='';

	public $service_id='';

	public $shop_views='';

	public $shop_name='';

	public $shop_province_code='';

	public $shop_city_code='';

	public $shop_address='';

	public $shop_map='';

	public $shop_sort='';

	public $shop_explain='';

	public $shop_status='';

	public $shop_addtime='';

	public $shop_license='';

	public $shop_logo='';

	public $shop_pic1='';

	public $shop_pic2='';

	public $shop_pic3='';

	public $shop_laudit_desc='';

	public $shop_longitude='';

	public $shop_latitude='';

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY shop_id
	 *
	 * @return 对象
	*/
	public function get($shop_id)
	{
		return $this->db->get_where('t_service_shop',array('shop_id' => $shop_id))->row();
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
		$this->db->insert('t_service_shop', $this);
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
        return $this->db->update('t_service_shop',$data,$where)?true:false;
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='shop_id',$where)
    {
         return $this->db->select($field)->get_where('t_service_shop',$where)->row();
    }   
    
    /**
     * 根据条件得到所有记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getAll($field='shop_id',$where){
        return $this->db->select($field)->get_where('t_service_shop',$where)->result();
    }
    
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY shop_id
	*/
	public function delete($shop_id)
	{
		return $this->db->delete('t_service_shop',array('shop_id' => $shop_id));
	}
	

    /**
     * 根据主键获取单条记录
     *
     * @PRIMARY KEY s_class_id
     *
     * @return 对象
     */
    public function get_tag($field='shop_id',$where)
    {
        return $this->db->select($field)->get_where('t_service_shop',$where)->result_array();
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
        return $this->db->update('t_service_shop',$data,$where)?true:false;
    }

    /**
     * 查询经销商的总条数 liuguangping
     * @param Int $province 省
     * @param Int $city 市
     * @param Int $district 区
     * @param Int $service_status 状态
     * @param String $key_word 关键字-微信号-公司名
     */

    public function admin_search_count($province,$city,$district,$shop_status,$key_word,$service_name,$service_id){
        $where= " 1=1";
        if($province){
            $where.=" AND s.shop_province_code=".$province;
        }
        if($city){
            $where.=" AND s.shop_city_code=".$city;
        }

        if($shop_status && $shop_status !=0){
            $where.=" AND s.shop_status=".$shop_status;
        }
        if($service_id){
            $where.=" AND s.service_id=".$service_id;
        }
        return $this->db->query("SELECT s.* FROM t_service_shop as s JOIN t_service_info as i ON s.service_id=i.service_id WHERE ".$where." AND s.shop_name LIKE '%{$key_word}%' AND i.service_name LIKE '%$service_name%'")->result();

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

    public function admin_search($province,$city,$district,$shop_status,$key_word,$service_name,$service_id,$offset,$limit){
        $where= " 1=1";
        if($province){
            $where.=" AND s.shop_province_code=".$province;
        }
        if($city){
            $where.=" AND s.shop_city_code=".$city;
        }

        if($shop_status && $shop_status !=0){
            $where.=" AND s.shop_status=".$shop_status;
        }
        if($service_id){
            $where.=" AND s.service_id=".$service_id;
        }
        return $this->db->query("SELECT s.* FROM t_service_shop as s JOIN t_service_info as i ON s.service_id=i.service_id WHERE ".$where." AND s.shop_name LIKE '%{$key_word}%' AND i.service_name LIKE '%$service_name%' ORDER BY s.shop_id DESC LIMIT {$offset},{$limit}")->result();
    }

    /**
     *description:获取经销商门店管理列表
     *author:yanyalong
     *date:2014/03/24
     */
    public function getShopListById($service_id,$service_user_shop="",$is_manage=false){
        $where = "";
        if($service_user_shop!=""&&$is_manage==false){
            $where = " and shop_id in($service_user_shop) ";
        }
        return $this->db->query("select * from t_service_shop where service_id = $service_id and shop_status<'50' and shop_status<>'1' $where order by shop_id desc")->result();
    }
    /**
     *description:
     *author:yanyalong
     *date:2014/03/25
     */
    public function updateStatus($shop_id,$shop_status){
        return $this->db->query("update t_service_shop set shop_status='$shop_status' where  shop_id='$shop_id'");
    }
    /**
     *description:获取经销商门店信息
     *author:yanyalong
     *date:2014/03/26
     */
    public function getServiceShopInfo(){
        return $this->db->query("select * from t_service_shop where shop_name='$this->shop_name' and service_id='$this->service_id'")->row();
    }
    /**
     *description:根据service_id获取店铺
     *author:yanyalong
     *date:2014/04/02
     */
    public function getShopListByServiceId($service_id,$p="",$row=""){
        $limit = "";
        if($p!=""&&$row!=""){
		    $limit = ' limit '.($p-1)*$row.','.$row;
        }
        return $this->db->query("select * from t_service_shop where service_id='$service_id' and shop_status<10  and shop_status<>1 order by shop_id desc $limit")->result();
    }

    /**
     *description:获取经销商门店管理列表
     *author:yanyalong
     *date:2014/03/24
     */
    public function getShopList($service_id,$service_user_shop="",$is_manage=false){
        $where = "";
        if($service_user_shop!=""&&$is_manage==false){
            $where = " and shop_id in($service_user_shop) ";
        }
        return $this->db->query("select * from t_service_shop where shop_status in(1,2,3,11,12,13) and service_id = $service_id $where order by shop_id desc")->result();
    }
    /**
     *description:获取旗舰店信息
     *author:yanyalong
     *date:2014/04/26
     */
    public function getInfoByService($service_id){
        return $this->db->query("select * from t_service_shop where service_id=$service_id and shop_status=1")->row();
    }

    /**********************刘广平******2014/04/29***********************/
    /**
     *description:获取经销商门店管理列表
     *author:liuguangping
     *date:2014/04/29
     */
    public function getShopListByService($service_id,$limit){
        return $this->db->query("select * from t_service_shop where  service_id=$service_id and shop_status in(1,2) order by shop_status asc,shop_views desc,shop_sort asc,shop_id desc limit $limit")->result();
    }
    /**
     *description:获取经销商加盟实体店信息信息
     *author:yanyalong
     *date:2014/05/05
     */
    public function getShopByServiceJoin($service_id,$shop_status=""){
        $where = "";
        if($shop_status!="")
            $where = " and  shop_status in ($shop_status) ";
       return $this->db->query("select * from t_service_shop where service_id=$service_id $where limit 1")->row();
    }

    /**
     * 根据service_id 和 wid 来查找主键
     *
     * @PRIMARY KEY sw_id
    */
    public function getArray($field='shop_id',$where){
        return $this->db->select($field)->get_where('t_service_shop',$where)->result();
    }


    /**
     *description:根据service_id获取店铺
     *author:yanyalong
     *date:2014/04/02
     */
    public function getShopInfoByServiceId($service_id,$p="",$row=""){
        $limit = "";
        if($p!=""&&$row!=""){
            $limit = ' limit '.($p-1)*$row.','.$row;
        }
        return $this->db->query("select * from t_service_shop where service_id='$service_id' and shop_status>1 and shop_status<81 order by shop_id desc $limit")->result();
    }
}

