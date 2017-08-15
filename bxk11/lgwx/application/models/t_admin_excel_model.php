<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class T_admin_excel_model extends CI_Model{
	public $tag_id;
	public $table;
	public $where;
	public $limit;
	public $office;
	public $field;
	public $data;
	public $ma;
	public $resulttype;
	public $sql;
	public function __construct(){	
		parent::__construct();
		$this->load->database();
		$this->resulttype = 'result_array';
	}
	
	/**++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	//删除标签
	public function delete_tag(){
		return $this->db->delete($this->table, array('tag_id' => $this->tag_id))?true:false;
	}
	
	//查找棉签
	public function select_tag(){
		$resulttyp = $this->resulttype;
		$result = $this->db->select($this->field)->get_where($this->table,$this->where,$this->limit,$this->office)->{$resulttyp}();
		return $result?$result:false;
	}
	//插入
	public function insertinto_tag(){
		return $this->db->insert($this->table, $this->data)?$this->db->insert_id():false;
	}
	//修改
	public function updates_tag(){
		return $this->db->update($this->table,$this->data,$this->where)?true:false;
	}
	//最
	public function select_limit(){
		$x = "select_".$this->ma;
		return $this->db->{$x}($this->field)->get($this->table)->row_array();
	}
	//wher
	public function where_arry(){
		return $this->db->{$this->where_if}($this->field)->get($this->table)->{$this->resulttype}();
	}
	//query
	public function query_arr(){
		return $this->db->query($this->sql)->{$this->resulttype}();
	}
	//获取一条数据
	public function get_one(){
		return $this->db->get_where($this->table,$this->where)->row();
		
	}

}