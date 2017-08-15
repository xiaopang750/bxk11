<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class SearchSchemeFactory{
	public static function createObj($sort,$area,$cost,$style,$func,$keyword,$p,$row){
		$obj = new SearchSchemeList($sort,$area,$cost,$style,$func,$keyword,$p,$row);
		if($obj instanceof SearchScheme_Class){
			return $obj->Search();
		}else{
			return false;	
		}
	}
}

//抽象类
abstract class SearchScheme_Class{
	public $area;
	public $cost;
	public $style;
	public $func;
	public $keyword;
	public $user_id;
	public $tag_count;
	public $where;
	public $sort;
	public $limit;
	abstract public function Search();
	public function __construct($sort,$area,$cost,$style,$func,$keyword,$p,$row){
		$this->CI = &get_instance();
		$this->CI->load->model('t_project_scheme_model');
		$this->sort = "";
		if($sort=="1"){
			$this->sort = " and ps.scheme_is_hot=1 ";
		}
		if($area!=""){
			$areaarr = explode('-',$area);
			$smallarea = $areaarr['0'];
			$bigarea= $areaarr['1'];
			$this->area = " and ha.apartment_size>$smallarea and ha.apartment_size<$bigarea ";
		}else{
			$this->area= "";
		}
		if($cost!=""){
			$costarr= explode('-',$cost);
			$smallcost = $costarr['0'];
			$bigcost= $costarr['1'];
			$this->cost= " and ps.scheme_cost>$smallcost and ps.scheme_cost<$bigcost ";
		}else{
			$this->cost= "";
		}
		$this->tag_count = 0;
		$where = "";
		if($style!=""){
			$this->tag_count++;		
			$where .=$style;
		}
		$where = trim($where,',');
		if($where!=""){
			$this->where =" pst.tag_id in ($where) ";
		}else{
			$this->where =" 1 ";
		}
		$this->func = "";
		if($func!=""){
			$this->func =" and ha.apartment_category_id=$func ";
		}
		$this->keyword= $keyword;
		$this->limit = " limit ".($p-1)*$row.",".$row;		
	}
}


/**
 *description:查询装修案例
 *author:yanyalong
 *date:2013/12/23
 */
class SearchSchemeList extends SearchScheme_Class{
	public function Search(){
		$sql = "SELECT * FROM `t_project_scheme` ps left join t_house_apartment ha on ha.house_id=ps.house_id left join t_project p on p.project_id=ps.project_id left join t_user_info ui on ui.user_id=ps.scheme_designer_id where ps.scheme_name like '%$this->keyword%' $this->cost and ps.scheme_type=2 and ps.scheme_status=1 and ps.scheme_user_type=2 and ps.scheme_id in(SELECT pst.scheme_id FROM t_project_scheme_tag pst where $this->where	 
			GROUP BY pst.scheme_id HAVING COUNT(pst.scheme_id)>=$this->tag_count) $this->area $this->func $this->sort group by ps.scheme_id order by ps.scheme_id desc $this->limit";	
		return $this->CI->t_project_scheme_model->db->query($sql)->result();	
	}
}


