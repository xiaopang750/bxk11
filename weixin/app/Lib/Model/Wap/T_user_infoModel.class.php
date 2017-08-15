<?php 
class T_user_infoModel extends Model {
	protected $dbName="jia178";
	/**
	 *description:获取用户信息
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function get($user_id){
		return $this->row("select * from $this->dbName.t_user_info where user_id='$user_id'");			
	}
	/**
	 *description:根据wecha_id获取用户基本信息
	 *author:yanyalong
	 *date:2014/02/26
	 */
	public function getInfoByWecha_id($wecha_id){
		return $this->row("select * from $this->dbName.t_user_info where user_weixinid='$wecha_id'");			
	}
}


