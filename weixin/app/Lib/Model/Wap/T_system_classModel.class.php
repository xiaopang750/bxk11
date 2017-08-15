<?php 
class T_system_classModel extends Model {
	protected $dbName="jia178";
	/**
	 *description:根据系统大分类获取小分类
	 *author:yanyalong
	 *date:2014/03/06
	 */
	public function getClassListByClassType($s_class_type,$s_class_depth){
		return $this->result("select * from $this->dbName.t_system_class where s_class_type='$s_class_type' and s_class_depth='$s_class_depth'");
	}
}


