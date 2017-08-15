<?php 
class T_like_serviceModel extends Model {
	protected $dbName="jia178";
	/**
	 *description:获取用户是否关注过该经销商
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function is_follow($user_id,$service_id){
		$res = $this->row("select * from $this->dbName.t_like_service where user_id='$user_id' and service_id=$service_id");			
		if(!empty($res)) return '1';
		return '0';
	}
	/**
	 *description:取消关注经销商
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function del_follow($user_id,$service_id){
		return $this->execute("delete from $this->dbName.t_like_service where service_id='$service_id' and user_id='$user_id'");			
	}
	/**
	 *description:获取关注经销商统计数
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function serviceLikes($user_id){
		return $this->row("select count(*) count  from $this->dbName.t_like_service where user_id='$user_id'")->count;			
	}
	/**
	 *description:获取用户关注的经销商
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function serviceLikeList($user_id,$p,$row){
		$limit = "";
		if($p!=""&&$row!=""){
			$limit = " limit ".($p-1)*$row.",".$row;
		}
		return $this->result("select * from $this->dbName.t_like_service ls left join $this->dbName.t_service_info si on si.service_id=ls.service_id where ls.user_id='$user_id' $limit");			
	}
}


