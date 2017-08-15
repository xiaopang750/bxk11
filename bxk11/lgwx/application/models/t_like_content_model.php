<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/07/17 11:37:14 
 * dinghaochenAuthor: jia178
 */
class T_like_content_model extends CI_Model
{
	public $like_id='';

	public $user_id='';

	public $content_id='';

	public $like_addtime='';

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
		return $this->db->get_where('t_like_content',array('like_id' => $like_id))->row();
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
		$this->db->insert('t_like_content', $this);
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
        return $this->db->update('t_like_content',$data,$where)?true:false;
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
         return $this->db->select($field)->get_where('t_like_content',$where)->row();
    }   
    
    /**
     * 根据条件得到所有记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getAll($field='like_id',$where){
        return $this->db->select($field)->get_where('t_like_content',$where)->result();
    }
    
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY like_id
	*/
	public function delete($like_id)
	{
		return $this->db->delete('t_like_content',array('like_id' => $like_id));
	}
	
}
