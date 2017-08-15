<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/07/17 11:37:15 
 * dinghaochenAuthor: jia178
 */
class T_system_class_model extends CI_Model
{
	public $s_class_id='';

	public $s_class_pid='';

	public $s_class_depth='';

	public $s_class_name='';

	public $s_class_numbers='';

	public $s_class_type='';

	public $s_class_seodesc='';

	public $s_class_img='';

	public $s_class_sort='';

	public $s_class_p_name='';

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY s_class_id
	 *
	 * @return 对象
	*/
	public function get($s_class_id)
	{
		return $this->db->get_where('t_system_class',array('s_class_id' => $s_class_id))->row();
	}
	

	/**
	 * 插入一条记录
	 *
	 * @Exception			Exception
	 *
	 * @return				return $this->db->insert()
	 */
	public function insert()
	{
		$this->db->insert('t_system_class', $this);
		return $this->db->insert_id();
	}

    /**
     * 修改
     * @param array $data
     * @param arrray $where
     * @return boolean
     * @author liuguangping
     * @version jia178 v1.0 2013/11/7
     */
    public function update($data,$where){
        return $this->db->update('t_system_class',$data,$where)?true:false;
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='s_class_id',$where)
    {
         return $this->db->select($field)->get_where('t_system_class',$where)->row();
    }   
    
    /**
     * 根据条件得到所有记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getAll($field='s_class_id',$where){
        return $this->db->select($field)->get_where('t_system_class',$where)->result();
    }
    
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY s_class_id
	*/
	public function delete($s_class_id)
	{
		return $this->db->delete('t_system_class',array('s_class_id' => $s_class_id));
	}
	
    /**
     *description:获取分类下所有标签的博文的喜欢、订阅、博文总数
     *author:yanyalong
     *date:2013/12/02
     */
    public function countbyclass($s_class_id){
        return $this->db->query("select sum(tag_likes) likes,sum(tag_count) contents,sum(tag_users) takes from t_tag where tag_id in(select s_tag_id from t_s_class_tag where s_class_id=$s_class_id)")->row();		
    }
    /**
     *description:跟具当前分类名称获取分类基本信息
     *author:yanyalong
     *date:2013/12/02
     */
    public function classinfobyname($s_class_name){
        return $this->db->query("select * from t_system_class where s_class_name='$s_class_name'")->row();
    }
    /**
     *description:获取分类下的灵感列表
     *author:yanyalong
     *date:2013/12/02
     */
    public function contentlistbyclass($t_class_id,$p="",$row,$order=""){
        if($order=="hot"){
            $order  = " order by hot desc";
        }else{
            $order  = " order by c.content_subtime desc ";
        }
        $limit = "";
        $limit = ' limit '.($p-1)*$row.','.$row;
        return $this->db->query("select c.content_disc,c.content_recommend+c.content_likes+c.content_share hot,ct.content_id,c.content_tag,c.user_id,c.content_content,c.content_title,c.content_project,c.content_likes,c.content_subtime,c.content_type 
            from t_tag t LEFT JOIN t_content_tag ct on t.tag_id=ct.tag_id 
            LEFT JOIN t_content c on c.content_id=ct.content_id 
            where t.tag_id in(
                SELECT ts.s_tag_id from t_system_class sc inner join t_s_class_tag ts on ts.s_class_id=sc.s_class_id where sc.s_class_id=$t_class_id
            ) and content_status<10 
            $order $limit")->result();
    }
    /**
     *description:获取系统分类列表
     *author:yanyalong
     *date:2013/12/02
     */
    public function classlist($s_class_type,$classpname=""){
        $where = "";
        if($classpname!=""){
            $where = " and s_class_p_name='$classpname' ";
        }
        return $this->db->query("SELECT ts.*,st.s_class_name class_pname from t_system_class ts left join (select s_class_id,s_class_name from t_system_class) st on st.s_class_id=ts.s_class_pid where ts.s_class_depth=2 and s_class_type=$s_class_type $where")->result();		
    }


    /**
     *description:根据当前标签id获取当前分类下的标签列表
     *author:yanyalong
     *date:2013/12/03
     */
    public function classlisttag($s_class_type,$s_class_name){
        return $this->db->query("select * from t_tag where tag_id in(select s_tag_id from t_s_class_tag ts left join t_system_class sc on ts.s_class_id=sc.s_class_id where sc.s_class_type={$s_class_type} and sc.s_class_name='$s_class_name')")->result_array();
    }
    /**
     *description:根据当前标签id获取当前分类下的标签列表
     *author:yanyalong
     *date:2013/12/03
     */
    public function taglist($s_class_name){
        return $this->db->query("select * from t_tag where tag_id in(select s_tag_id from t_s_class_tag ts left join t_system_class sc on ts.s_class_id=sc.s_class_id where s_class_name='$s_class_name') order by tag_count desc")->result();
    }	

    /**
     * 根据分类名查找下面关联的标签
     * liuguagnping 
     */
    public function getCategoryByTags($where){

        return $this->db->query("SELECT t.tag_id,t.tag_name FROM t_tag AS t LEFT JOIN (SELECT c.s_tag_id,c.s_class_id FROM t_s_class_tag as c LEFT JOIN t_system_class as s ON s.s_class_id = c.s_class_id WHERE s.s_class_name ='".$where[0]."' OR s.s_class_name='".$where[1]."' AND s.s_class_type=13) as z ON t.tag_id=z.s_tag_id WHERE z.s_class_id!='' AND t.tag_type!=99")->result_array();
    }
    /**
     *description:根据分类id获取分类信息
     *author:yanyalong
     *date:2014/04/08
     */
    public function getSysClassListById($class_idlist){
        $where = " and s_class_id in($class_idlist)" ;
        if($class_idlist==""){
            return false;
        }
        return $this->db->query("select * from t_system_class where 1 $where")->result();
    }
    
}
