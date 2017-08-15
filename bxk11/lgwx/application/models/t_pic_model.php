<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/07/16 17:19:09 
 * dinghaochenAuthor: jia178
 */
class T_pic_model extends CI_Model
{
	public $pic_id='';

	public $pic_url='';

	public $pic_type='';

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY pic_id
	 *
	 * @return 对象
	*/
	public function get($pic_id)
	{
		return $this->db->get_where('t_pic',array('pic_id' => $pic_id))->row();
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
		$this->db->insert('t_pic', $this);
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
        return $this->db->update('t_pic',$data,$where)?true:false;
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='pic_id',$where)
    {
         return $this->db->select($field)->get_where('t_pic',$where)->row();
    }   
    
    /**
     * 根据条件得到所有记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getAll($field='pic_id',$where){
        return $this->db->select($field)->get_where('t_pic',$where)->result();
    }
    
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY pic_id
	*/
	public function delete($pic_id)
	{
		return $this->db->delete('t_pic',array('pic_id' => $pic_id));
	}
	
}
