<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @description 系统标签分类模块 
 * @author		yanyl
 */
class System_Class_Tag{

	//频道类型
	var $s_class_type;

	/**获取系统分类标签信息数组(用于博文发布)
	 *description:
	 *author:yanyalong
	 *date:2013/10/19
	 */
	public function getTagBySystemClass(){
		$tags = model("t_system_class")->getTagBySystemClass($this->s_class_type);
		if(empty($tags)) return false;
			$tagsarr= array();
			$i=0;
			$tagarr = array();
			foreach ($tags as $key=>$val) {
				if(!in_array($val['s_class_name'],$tagarr)){
					$tagarr[] = $val['s_class_name'];
				}
			}
			foreach ($tagarr as $key=>$val) {
				$i=0;
				foreach ($tags as $keys=>$vals) {
					if($vals['s_class_name']==$val){
						$tagsarr[$val][$i]['tag_id'] = $vals['tag_id'];
						$tagsarr[$val][$i]['tag_name'] = $vals['tag_name'];
						$tagsarr[$val][$i]['s_class_select'] = $vals['s_class_select'];
						$tagsarr[$val][$i]['s_class_regex'] = $vals['s_class_regex'];
						$tagsarr[$val][$i]['s_class_p_name'] = $vals['s_class_p_name'];
						$i++;
					}
				}
			}
			$i=0;
			$design = array();
			foreach($tagsarr as $key=>$val){
				$design[$i]['name'] = $key;
				$j=0;
				foreach($val as $keys=>$vals){
					$design[$i]['options'][$j]['tag_id']= $vals['tag_id'];
					$design[$i]['options'][$j]['tag_name'] = $vals['tag_name'];
					$design[$i]['select'] = $vals['s_class_select'];
					$design[$i]['regex'] = $vals['s_class_regex'];
					$design[$i]['pname'] = $vals['s_class_p_name'];
					$j++;
				}
				$i++;
			}
		return $design;
	}
}
