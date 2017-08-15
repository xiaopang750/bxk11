<?php
class T_system_districtModel extends Model{
	protected $dbName="jia178";
	public function findArea($district_name,$code){
		
		$map['district_name'] = array('like','%'.$district_name.'%');
		$map['district_pcode'] = $code;
		return $this->where($map)->find();
		// /  $this->getLastSql();
	}

}

?>
