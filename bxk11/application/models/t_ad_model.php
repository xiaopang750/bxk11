<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/07/14 10:29:09 
 * dinghaochenAuthor: jia178
 */
class T_ad_model extends CI_Model
{
	//public $ad_id='';

	public $ad_title='';

	public $apm_id='';

	public $ad_key='';

	public $ad_desc='';

	public $ad_pic='';

	public $ad_type='';

	public $ad_data_id='';

	public $ad_url='';

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY ad_id
	 *
	 * @return 对象
	*/
	public function get($ad_id)
	{
		return $this->db->get_where('t_ad',array('ad_id' => $ad_id))->row();
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
		$this->db->insert('t_ad', $this);
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
    public function update($where){
        return $this->db->update('t_ad',$this,$where)?true:false;
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='ad_id',$where)
    {
         return $this->db->select($field)->get_where('t_ad',$where)->row();
    }   
    
    /**
     * 根据条件得到所有记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getAll($field='ad_id',$where){
        return $this->db->select($field)->get_where('t_ad',$where)->result();
    }
    
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY ad_id
	*/
	public function delete($ad_id)
	{
		return $this->db->delete('t_ad',array('ad_id' => $ad_id));
	}
	
	/*获取页面选择项*/
	public function option_str(){
		static $str ;
		$query = $this->db->get_where('t_ad_page_module','apm_pid = 0');
	
		foreach ($query->result() as $row){
			$str .= '<option value="'.$row->apm_id.'">'.$row->apm_name.'</option>';
		}
		return $str;
	}
	
	/*获取模块选择项*/
	public function option_module($pid){
		static $option_module ;
		$query = $this->db->get_where('t_ad_page_module','apm_pid = '.$pid);
	
		foreach ($query->result() as $row){
			$option_module .= '<option value="'.$row->apm_id.'">'.$row->apm_name.'</option>';
		}
		return $option_module;
	}
	
	/*模块列表*/
	public function model_list(){
		return $this->db->get('t_ad_page_module')->result();
	}
	

	
}
