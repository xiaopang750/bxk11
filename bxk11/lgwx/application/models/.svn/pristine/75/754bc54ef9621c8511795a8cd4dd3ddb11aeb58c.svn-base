<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/07/14 10:45:37 
 * dinghaochenAuthor: jia178
 */
class T_content_model extends CI_Model
{
	public $content_id='';

	public $user_id='';

	public $content_content='';

	public $content_tag='';

	public $content_tag_id='';

	public $content_likes='';

	public $content_discs='';

	public $content_srcurl='';

	public $content_status='';

	public $content_views='';

	public $content_subtime='';

	public $content_albums='';

	public $pic_id='';

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY content_id
	 *
	 * @return 对象
	*/
	public function get($content_id)
	{
		return $this->db->get_where('t_content',array('content_id' => $content_id))->row();
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
		$this->db->insert('t_content', $this);
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
        return $this->db->update('t_content',$data,$where)?true:false;
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='content_id',$where)
    {
         return $this->db->select($field)->get_where('t_content',$where)->row();
    }   
    
    /**
     * 根据条件得到所有记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getAll($field='content_id',$where){
        return $this->db->select($field)->get_where('t_content',$where)->result();
    }
    
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY content_id
	*/
	public function delete($content_id)
	{
		return $this->db->delete('t_content',array('content_id' => $content_id));
	}
	
}
