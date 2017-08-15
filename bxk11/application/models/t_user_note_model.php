<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/06/21 12:19:21 
 * dinghaochenAuthor: jia178
 */
class T_user_note_model extends CI_Model
{
	public $note_id='';

	public $goods_id='';

	public $user_id='';

	public $note_content='';

	public $note_facade='';

	public $note_comfort='';

	public $note_price='';

	public $note_addtime='';

	public $shop_id='';

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY note_id
	 *
	 * @return 对象
	*/
	public function get($note_id)
	{
		return $this->db->get_where('t_user_note',array('note_id' => $note_id))->row();
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
		$this->db->insert('t_user_note', $this);
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
        return $this->db->update('t_user_note',$data,$where)?true:false;
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='note_id',$where)
    {
         return $this->db->select($field)->get_where('t_user_note',$where)->row();
    }   
    
    /**
     * 根据条件得到所有记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getAll($field='note_id',$where){
        return $this->db->select($field)->get_where('t_user_note',$where)->result();
    }
    
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY note_id
	*/
	public function delete($note_id)
	{
		return $this->db->delete('t_user_note',array('note_id' => $note_id));
	}
	
    /**
     *description:获取我的装修笔记列表
     *author:yanyalong
     *date:2014/06/22
     */
    public function getNoteListByUser($user_id,$p="",$row=""){
        $limit = "";
        if($p!=""&&$row!=""){
		    $limit = ' limit '.($p-1)*$row.','.$row;
        }
		return $this->db->query("select * from t_user_note where user_id=$user_id order by note_id desc $limit")->result();			
    }
}
