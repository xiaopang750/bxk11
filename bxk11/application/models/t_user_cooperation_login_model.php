<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/06/21 10:42:07 
 * dinghaochenAuthor: jia178
 */
class T_user_cooperation_login_model extends CI_Model
{
	public $cl_id;

	public $user_id;

	public $openid;

	public $token;

	public $refresh_token;

	public $expire_time;

	public $login_type;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY cl_id
	 *
	 * @return 对象
	*/
	public function get($cl_id)
	{
		return $this->db->get_where('t_user_cooperation_login',array('cl_id' => $cl_id))->row();
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
		$this->db->insert('t_user_cooperation_login', $this);
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
        return $this->db->update('t_user_cooperation_login',$data,$where)?true:false;
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='cl_id',$where)
    {
         return $this->db->select($field)->get_where('t_user_cooperation_login',$where)->row();
    }   
    
    /**
     * 根据条件得到所有记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getAll($field='cl_id',$where){
        return $this->db->select($field)->get_where('t_user_cooperation_login',$where)->result();
    }
    
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY cl_id
	*/
	public function delete($cl_id)
	{
		return $this->db->delete('t_user_cooperation_login',array('cl_id' => $cl_id));
	}
	
}
