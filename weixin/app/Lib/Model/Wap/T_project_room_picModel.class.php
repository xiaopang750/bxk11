<?php 
class T_project_room_picModel extends Model {
	protected $dbName="jia178";
	/**
	 *description:获取2d房间信息
	 *author:yanyalong
	 *date:2014/02/26
	 */
	public function getRoomInfoByRoomId($room_id){
		return $this->row("select * from $this->dbName.t_project_room p left join $this->dbName.t_project_room_pic pic on pic.room_id=p.room_id where p.room_id='$room_id'");			
	}

		

}

