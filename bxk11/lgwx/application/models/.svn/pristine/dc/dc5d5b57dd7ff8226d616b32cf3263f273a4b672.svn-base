<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/07/14 10:45:37 
 * dinghaochenAuthor: jia178
 */
class T_album_model extends CI_Model
{
	//public $album_id='';

	public $user_id='';

	public $album_name='';

	public $album_explain='';

	public $album_ctime='';

	public $album_count='';

	public $album_recommend_time='';

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->user_id = $_SESSION['user_id'] ;
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY album_id
	 *
	 * @return 对象
	*/
	public function get($album_id)
	{
		return $this->db->get_where('t_album',array('album_id' => $album_id))->row();
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
		$this->db->insert('t_album', $this);
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
        return $this->db->update('t_album',$data,$where)?true:false;
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='album_id',$where)
    {
         return $this->db->select($field)->get_where('t_album',$where)->row();
    }   
    
    /**
     * 根据条件得到所有记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getAll($field = '*'){
    	$where = array('user_id'=>$this->user_id);
        return $this->db->select($field)->get_where('t_album',$where)->result();
    }
    
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY album_id
	*/
	public function delete($album_id)
	{
		return $this->db->delete('t_album',array('album_id' => $album_id,'user_id'=>$this->user_id));
	}
	

	/*插入灵感辑*/
	public function add(){
		return  $this->insert();
	}
	
	/*灵感辑点击*/
	public function click($id){
		$res = $this->getOne('album_count',array('album_id'=>$id))->row();
		$count = $res->album_count + 1;
		$this->update(array('album_count'=>$count), array('album_id'=>$id));
		return $this->album_count + 1;
	}
	
	/*更新评论时间*/
	public function recomm($id){
		$date = date('y-m-d h:i:s',time());;
		$this->update(array('album_count'=>$date), array('album_id'=>$id));
		return $this->album_count + 1;
	}
	
	/*返回灵感辑下拉列表字符串*/
	public function get_album_option(){
		$res = $this->getAll();
		var_dump($res);
		exit;
	}
	
}
