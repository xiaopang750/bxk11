<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/03/19 18:32:00 
 * dinghaochenAuthor: 丁昊臣
 * Email: dotnet010@gmail.com
 */
class T_service_user_model extends CI_Model
{
	public $service_user_id;
	public $service_id;
	public $ra_id;
	public $service_user_name;
	public $service_user_password;
	public $service_user_realname;
	public $service_user_phone;
	public $service_user_photo;
	public $service_user_addtime;
	public $service_user_status;
	public $service_user_email;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
        $this->service_user_photo = "";
        $this->service_user_status = "1";
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY service_user_id
	 *
	 * @return 对象
	*/
	public function get($service_user_id)
	{
		return $this->db->get_where('t_service_user',array('service_user_id' => $service_user_id))->row();
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
	 * get_list(10,0) =>	select * from t_service_user limit 0,10
	 */
	public function get_list($limit = 10, $offset = 0, $order_field = 'service_user_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_user', $limit, $offset)->result();
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
	public function get_all($order_field = 'service_user_id', $order_type = 'ASC')
	{
		$this->db->order_by($order_field, $order_type);
		return $this->db->get('t_service_user')->result();
	}

	/**
	 * 获取表中所有记录的行数，用于分页 
	 */
	public function count_all()
	{
		return $this->db->count_all('t_service_user');
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
	public function search($field_name, $keywords, $limit = 10, $offset = 0, $order_field = 'service_user_id', $order_type = 'ASC')
	{
		$this->db->from('t_service_user')->like($field_name, $keywords)->order_by($order_field, $order_type)->limit($limit, $offset);
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
		$this->db->from('t_service_user')->like($field_name, $keywords);
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
		$this->db->insert('t_service_user', $this);
		return $this->db->insert_id();
	}
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY service_user_id
	*/
	public function delete($service_user_id)
	{
		return $this->db->delete('t_service_user',array('service_user_id' => $service_user_id));
	}
	
    /**
     *description:登录验证查询
     *author:yanyalong
     *date:2014/03/21
     */
    public function getServiceUserInfoBylogin($user_login_code,$service_user_password){
		return $this->db->query("select * from t_service_user su where (su.service_user_phone='$user_login_code' or su.service_user_email='$user_login_code') and su.service_user_password='$service_user_password' and su.service_user_status=1")->row();
    }
    /**
     *description:获取经销商账号基本信息
     *author:yanyalong
     *date:2014/03/24
     */
    public function getServiceInfoByUid(){
		return $this->db->query("select * from t_service_user su left join t_service_info si on si.service_id=su.service_id left join t_system_district sd on si.service_city_code=sd.district_code left join t_service_shop ss on ss.service_id=si.service_id where su.service_user_id='$this->service_user_id'and ss.shop_status=1")->row();
    }
    /**
     *description:修改经销商帐号密码
     *author:yanyalong
     *date:2014/03/24
     */
	public function update_passwd($service_user_password,$service_user_id){
		$data = array(
			'service_user_password' => $service_user_password
		);
		$this->db->where('service_user_id', $service_user_id);
		return $this->db->update('t_service_user', $data);
	}


	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY s_class_id
	 *
	 * @return 对象
	 */
	public function get_tag($field='service_user_id',$where)
	{
		return $this->db->select($field)->get_where('t_service_user',$where)->result_array();
	}
	
	/**
	 * 查询模块的总条数 liuguangping
	 * @param Int $module_status 状态
	 * @param String $key_word 关键字-模块名-key
	 * @author liuguangping
	 * @version jia178 v1.0 2014/3/25
	 */
	
	public function admin_search_count($service_id,$key_word,$starttime,$status,$stoptime){
		$where= " AND 1=1";
		if($starttime && $stoptime){
			if($starttime>=$stoptime){
				$where .= " AND u.service_user_addtime<'".$stoptime."'";
			}else{
				$where .= " AND u.service_user_addtime<'".$stoptime."' AND u.service_user_addtime>'".$starttime."'";
			}
		}elseif($starttime && !$stoptime){
			$where .= " AND u.service_user_addtime>'".$starttime."'";
		}else{
			$where .= " AND u.service_user_addtime<'".$stoptime."'";
		}
		if(isset($service_id) && $service_id){
			$where .= " AND u.service_id=".$service_id;
		}
		if(isset($status) && $status){
			$where .= " AND u.service_user_status=".$status;
		}
		return $this->db->query("SELECT service_user_id FROM t_service_user as u JOIN t_service_info AS i ON u.service_id=i.service_id WHERE (i.service_name LIKE '%{$key_word}%' OR u.service_user_name LIKE '%{$key_word}%')".$where)->result();
		
	}
	
	/**
	 * 根据条件搜索房间
	 * @param Int $module_status 状态
	 * @param String $key_word 关键字-模块名-key
	 * @author liuguangping
	 * @version jia178 v1.0 2014/3/25
	 *
	 */
	
	public function admin_search($service_id,$key_word,$starttime,$stoptime,$status,$offset,$limit){
		$where= " AND 1=1";
		if($starttime && $stoptime){
			if($starttime>=$stoptime){
				$where .= " AND u.service_user_addtime<'".$stoptime."'";
			}else{
				$where .= " AND u.service_user_addtime<'".$stoptime."' AND u.service_user_addtime>'".$starttime."'";
			}
		}elseif($starttime && !$stoptime){
			$where .= " AND u.service_user_addtime>'".$starttime."'";
		}elseif(!$starttime && $stoptime){
			$where .= " AND u.service_user_addtime<'".$stoptime."'";
		}
		if(isset($service_id) && $service_id){
			$where .= " AND u.service_id=".$service_id;
		}
		if(isset($status) && $status){
			$where .= " AND u.service_user_status=".$status;
		}
		return $this->db->query("SELECT u.*,i.service_name FROM t_service_user as u JOIN t_service_info AS i ON u.service_id=i.service_id WHERE (i.service_name LIKE '%{$key_word}%' OR u.service_user_name LIKE '%{$key_word}%')".$where." ORDER BY u.service_user_id DESC LIMIT {$offset},{$limit}")->result();
	    
	}

    /**
     *description:获取经销商子帐号
     *author:yanyalong
     *date:2014/03/25
     */
    public function getServiceUserListById(){
		return $this->db->query("select * from t_service_user su left join t_service_info si on si.service_id=su.service_id where su.service_id='$this->service_id' and su.service_user_status<11 order by su.service_user_id desc")->result();
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
        return $this->db->update('t_service_user',$data,$where)?true:false;
    }
    /**
     *description:获取经销商下的指定用户
     *author:yanyalong
     *date:2014/03/27
     */
    public function getServiceUserInfo(){
		return $this->db->query("select * from t_service_user where service_id='$this->service_id' and service_user_name='$this->service_user_name'")->row();
    }
    /**
     *description:获取经销商下的指定用户
     *author:yanyalong
     *date:2014/03/27
     */
    public function getServiceUserInfoByName($service_user_name){
		return $this->db->query("select * from t_service_user where service_user_name='$service_user_name' and service_user_status=21")->row();
    }
    /**
     *description:验证登录
     *author:yanyalong
     *date:2014/03/27
     */
    public function getServiceUserInfoByTempUser($service_user_name,$service_user_password){
		return $this->db->query("select * from t_service_user where service_user_name='$service_user_name' and service_user_password='$service_user_password' and service_user_status=21")->row();
    }
    /**
     *description:根据用户手机号查询
     *author:yanyalong
     *date:2014/05/12
     */
    public function getServiceUserByPhone($service_user_phone){
        return $this->db->query("select * from t_service_user where service_user_phone='$service_user_phone' and service_user_status<81")->row();
    }
    /**
     *description:根据用户邮箱查询
     *author:yanyalong
     *date:2014/05/12
     */
    public function getServiceUserByEmail($service_user_email){
        return $this->db->query("select * from t_service_user where service_user_email='$service_user_email' and service_user_status<81")->row();
    }
    /**
     *description:根据用户id获取用户权限信息
     *author:yanyalong
     *date:2014/05/20
     */
    public function getRoleByUserId($service_user_id){
        return $this->db->query("select * from t_service_user su left join t_service_role_auth ra  on ra.ra_id=su.ra_id where su.service_user_id='$service_user_id' and su.service_user_status<81")->row();
    }
}
