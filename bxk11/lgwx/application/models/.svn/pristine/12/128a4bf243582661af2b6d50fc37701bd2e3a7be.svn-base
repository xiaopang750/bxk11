<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/07/17 11:26:57 
 * dinghaochenAuthor: jia178
 */
class T_s_class_tag_model extends CI_Model
{
	public $s_c_tag_id='';

	public $s_tag_id='';

	public $s_class_id='';

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY s_c_tag_id
	 *
	 * @return 对象
	*/
	public function get($s_c_tag_id)
	{
		return $this->db->get_where('t_s_class_tag',array('s_c_tag_id' => $s_c_tag_id))->row();
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
		$this->db->insert('t_s_class_tag', $this);
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
        return $this->db->update('t_s_class_tag',$data,$where)?true:false;
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='s_c_tag_id',$where)
    {
         return $this->db->select($field)->get_where('t_s_class_tag',$where)->row();
    }   
    
    /**
     * 根据条件得到所有记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getAll($field='s_c_tag_id',$where){
        return $this->db->select($field)->get_where('t_s_class_tag',$where)->result();
    }
    
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY s_c_tag_id
	*/
	public function delete($s_c_tag_id)
	{
		return $this->db->delete('t_s_class_tag',array('s_c_tag_id' => $s_c_tag_id));
	}
	
}
