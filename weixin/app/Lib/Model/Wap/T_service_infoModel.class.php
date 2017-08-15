<?php 
class T_service_infoModel extends Model {
	protected $dbName="jia178";
	/**
	 *description:根据经销商token获取经销商基本信息
	 *author:liuguangping
	 *date:2014/02/25
	 */
	public function getInfoByToken($service_token){
		return $this->row("select * from $this->dbName.t_service_info  where service_token='".$service_token."' and service_status=1");			
	}

}



