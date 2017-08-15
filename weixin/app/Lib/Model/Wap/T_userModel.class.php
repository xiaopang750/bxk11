<?php 
class T_userModel extends Model {
	protected $dbName="jia178";
	/**
	 *description:获取用户信息
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function get($user_id){
		return $this->row("select * from $this->dbName.t_user where user_id='$user_id'");			
	}
	/**
	 *description:获取参加活动统计数
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function activeLikes($user_id){
		return $this->row("select count(*) count  from like where user_id='$user_id'")->count;			
	}
}

