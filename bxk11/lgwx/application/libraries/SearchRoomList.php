<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:工厂类，用以创建对象
 *author:yanyalong
 *date:2013/12/04
 */
class SearchRoomFactory{
	public static function createObj($sort,$area,$color,$style,$func,$keyword,$p,$row){
		$obj = new SearchRoomList($sort,$area,$color,$style,$func,$keyword,$p,$row);
		if($obj instanceof SearchRoom_Class){
			return $obj->Search();
		}else{
			return false;	
		}
	}
}

//抽象类
abstract class SearchRoom_Class{
	public $area;
	public $color;
	public $style;
	public $func;
	public $keyword;
	public $user_id;
	public $tag_count;
	public $where;
	public $sort;
	public $limit;
	abstract public function Search();
	public function __construct($sort,$area,$color,$style,$func,$keyword,$p,$row){
		$this->CI = &get_instance();
		$this->CI->load->model('t_project_room_model');
		$this->sort = "";
		if($sort=="1"){
			$this->sort = " and r.room_is_hot=1 ";
		}
		if($area!=""){
			$areaarr = explode('-',$area);
			$smallarea = $areaarr['0'];
			$bigarea= $areaarr['1'];
			$this->area = " and r.room_size>$smallarea and r.room_size<$bigarea ";
		}else{
			$this->area= "";
		}
		$this->tag_count = 0;
		$where = "";
		if($style!=""){
			$this->tag_count++;		
			$where .=$style;
		}
		if($func!=""){
			$this->tag_count++;		
			$where .=','.$func;
		}
		if($color!=""){
			$this->tag_count++;		
			$where .=','.$color;
		}
		$where = trim($where,',');
		if($where!=""){
			$this->where =" prt.tag_id in ($where) ";
		}else{
			$this->where =" 1 ";
		}
		$this->keyword = $keyword;
		$this->limit = " limit ".($p-1)*$row.",".$row;		
	}
}


/**
 *description:查询样板间
 *author:yanyalong
 *date:2013/12/23
 */
class SearchRoomList extends SearchRoom_Class{
	public function Search(){
		$sql = "select * from t_project_room r left join t_user  u on u.user_id= r.user_id left join t_user_info ui on ui.user_id=r.user_id where r.room_status=1 and r.room_type=2 and r.room_keyword like '%$this->keyword%' $this->area and r.room_id  
in(SELECT prt.room_id FROM t_project_room_tag prt where $this->where GROUP BY prt.room_id HAVING COUNT(prt.room_id)>=$this->tag_count) $this->sort order by room_id desc $this->limit";
		return $this->CI->t_project_room_model->db->query($sql)->result();	
	}
}



