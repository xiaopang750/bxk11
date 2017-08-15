<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
	/*
 * Generator By "Auto Codeigniter" At 2014/07/14 10:45:37 dinghaochenAuthor: jia178
 */
class T_ad_page_module_model extends CI_Model {
	// public $apm_id='';
	public $apm_pid = '';
	public $apm_name = '';
	public $apm_desc = '';
	public function __construct() {
		parent::__construct ();
		
		$this->load->database ();
	}
	
	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY apm_id
	 *
	 * @return 对象
	 */
	public function get($apm_id) {
		return $this->db->get_where ( 't_ad_page_module', array (
				'apm_id' => $apm_id 
		) )->row ();
	}
	
	/**
	 * 插入一条记录
	 *
	 * @Exception			Exception
	 *
	 * @return return $this->db->insert()
	 */
	public function insert() {
		$this->db->insert ( 't_ad_page_module', $this );
		return $this->db->insert_id ();
	}
	
	/**
	 * 修改
	 *
	 * @param array $data        	
	 * @param arrray $where        	
	 * @return boolean
	 * @author liuguangping
	 * @version jia178 v1.0 2013/11/7
	 */
	public function update($data, $where) {
		return $this->db->update ( 't_ad_page_module', $data, $where ) ? true : false;
	}
	
	/**
	 * 根据条件得到单条记录
	 *
	 * @PRIMARY KEY rwfr_id
	 *
	 * @return 对象
	 */
	public function getOne($field = 'apm_id', $where) {
		return $this->db->select ( $field )->get_where ( 't_ad_page_module', $where )->row ();
	}
	
	/**
	 * 根据条件得到所有记录
	 *
	 * @PRIMARY KEY rwfr_id
	 *
	 * @return 对象
	 */
	public function getAll($field = 'apm_id', $where) {
		return $this->db->select ( $field )->get_where ( 't_ad_page_module', $where )->result ();
	}
	
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY apm_id
	 */
	public function delete($apm_id) {
		return $this->db->delete ( 't_ad_page_module', array (
				'apm_id' => $apm_id 
		) );
	}
	
	/* 页面&模块添加 */
	public function page_add() {
		$this->db->insert ( 't_ad_page_module', $this );
		return $this->db->insert_id ();
	}
	
	/* 广告添加 */
	public function ad_add($data) {
		$this->db->insert ( 't_ad', $data );
		return $this->db->insert_id ();
	}
	/* 页面删除 */
	public function ad_del() {
		echo '广告删除';
	}
	
	/* 获取页面选择项 */
	public function option_str($op = 0) {
		$str = '';
		$query = $this->db->get_where ( 't_ad_page_module', 'apm_pid = 0' );
		if ($op == 0) {
			foreach ( $query->result () as $row ) {
				$str .= '<option value="' . $row->apm_id . '">' . $row->apm_name . '</option>';
			}
		} else {
			foreach ( $query->result () as $row ) {
				if ($row->apm_id == $op) {
					$str .= '<option selected="selected" value="' . $row->apm_id . '">' . $row->apm_name . '</option>';
				} else {
					$str .= '<option  value="' . $row->apm_id . '">' . $row->apm_name . '</option>';
				}
			}
		}
		
		return $str;
	}
	
	/* 获取模块选择项 */
	public function option_module($pid) {
		static $option_module;
		$query = $this->db->get_where ( 't_ad_page_module', 'apm_pid = ' . $pid );
		
		foreach ( $query->result () as $row ) {
			$option_module .= '<option value="' . $row->apm_id . '">' . $row->apm_name . '</option>';
		}
		return $option_module;
	}
	
	/* 模块列表 */
	public function model_list($apm_pid) {
		$where = array (
				'apm_pid' => $apm_pid 
		);
		return $this->getAll ( '*', $where );
	}
	public function page_list() {
		$where = array (
				'apm_pid' => 0 
		);
		return $this->getAll ( '*', $where );
	}
}
