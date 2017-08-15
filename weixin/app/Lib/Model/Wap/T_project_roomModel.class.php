<?php 
class T_project_roomModel extends Model {
	protected $dbName="jia178";

	public function getPageList($listRows,$row){

		$where = array(
				'room_status'=>1
				);
		$where['room_status']  = array('lt',11);

		return $this->field('room_id,room_name,room_type,room_capability')->where($where)->limit($listRows ,$row)->order('room_subtime desc')->select();

	}


	public function getPageCount(){
	
		$where = array(
				'room_status'=>1
		);
		return $this->field('room_id,room_name,room_type,room_capability')->where($where)->count();
	
	}

	/**
	 *description:获取2d房间信息
	 *author:yanyalong
	 *date:2014/02/26
	 */
	public function getInfoByRoom_id($room_id){
		return $this->row("select * from $this->dbName.t_project_room pr left join $this->dbName.t_project_floor_room pfr on pfr.room_id=pr.room_id left join $this->dbName.t_project_floor pf on pf.floor_id=pfr.floor_id left join $this->dbName.t_project_room_plane prp on prp.room_id=pr.room_id where pr.room_id='$room_id'");			
	}

		

}

