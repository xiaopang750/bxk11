<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2014/07/14 10:45:38 
 * dinghaochenAuthor: jia178
 */
class T_user_model extends CI_Model
{
	public $user_id='';

	public $user_type='';

	public $user_likes='';

	public $user_follows='';

	public $user_fans='';

	public $user_contents='';

	public $user_nickname='';

	public $user_passwd='';

	public $user_email='';

	public $user_mobile='';

	public $user_views='';

	public $user_reg_time='';

	public $user_pic_b='';

	public $user_pic_m='';

	public $user_pic_s='';

	public $user_sex='';

	public $user_marry='';

	public $user_hometown='';

	public $user_residency='';

	public $province_code='';

	public $city_code='';

	public $user_address='';

	public $user_realname='';

	public $user_idcard='';

	public $user_idpic='';

	public $user_fax='';

	public $user_phone='';

	public $user_company='';

	public $user_skills='';

	public $user_summary='';

	public $user_experience='';

	public $user_reg_ip='';

	public $user_domain='';

	public $user_worker='';

	public $user_unionid='';

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	/**
	 * 根据主键获取单条记录
	 *
	 * @PRIMARY KEY user_id
	 *
	 * @return 对象
	*/
	public function get($user_id)
	{
		return $this->db->get_where('t_user',array('user_id' => $user_id))->row();
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
		$this->db->insert('t_user', $this);
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
        return $this->db->update('t_user',$data,$where)?true:false;
    }

    /**
     * 根据条件得到单条记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getOne($field='user_id',$where)
    {
         return $this->db->select($field)->get_where('t_user',$where)->row();
    }   
    
    /**
     * 根据条件得到所有记录
     *
     * @PRIMARY KEY rwfr_id
     *
     * @return 对象
     */
    public function getAll($field='user_id',$where){
        return $this->db->select($field)->get_where('t_user',$where)->result();
    }
    
	/**
	 * 根据主键删除单条记录
	 *
	 * @PRIMARY KEY user_id
	*/
	public function delete($user_id)
	{
		return $this->db->delete('t_user',array('user_id' => $user_id));
	}
	
	/**
	 *description:获取用户基本信息
	 *author:yanyalong
	 *date:2013/08/07
	 */
	public function userinfo($user_id){
		return $this->db->query("select * from t_user where user_id=$user_id")->row_array();
	}
	/**
	 *description:修改用户昵称
	 *author:yanyalong
	 *date:2013/09/25
	 */
	public function update_nick($user_nickname,$user_id)
	{
		$nick_flag=$this->add_name($user_nickname,$user_id);
		if($nick_flag==true) return 1;
		$data = array(
			'user_nickname' => $user_nickname
		);
		$this->db->where('user_id', $user_id);
		$res = $this->db->update('t_user', $data);
		if($res==false) return 2;
		return 3;
	}

	/**
	 *description:修改用户邮箱
	 *author:yanyalong
	 *date:2013/09/25
	 */
	public function update_email($user_email,$user_id)
	{
		$email_flag=$this->check_email($user_email,$user_id);
		if($email_flag==true) return 1;
		$data = array(
			'user_email' => $user_email
		);
		$this->db->where('user_id', $user_id);
		$res = $this->db->update('t_user', $data);
		if($res==false) return 2;
		return 3;
	}

	/**
	 *description:更新用户统计信息状态
	 *author:yanyalong
	 *date:2013/09/18
	 */
	public function user_status($user_id,$column,$type='+',$num='1'){
		if($user_id==''||$column==''||$type=='') return false;
		$this->db->query("update t_user set $column=$column$type$num where user_id=$user_id");

	}
	/**
	 *description:判断用户名是否存在
	 *author:yanyalong
	 *date:2013/09/25
	 */
	function add_name($user_nickname,$user_id){
		$this->load->database();
		$res = $this->db->query("select * from t_user where user_nickname='$user_nickname'")->row_array();
		if(empty($res)) return false;
		if($res['user_id']==$user_id) return false;
		return true;
	}
	/**
	 *description:判断邮箱是否存在
	 *author:yanyalong
	 *date:2013/09/25
	 */
	function check_email($user_email,$user_id){
		$this->load->database();
		$res = $this->db->query("select * from t_user where user_email='$user_email'")->row_array();
		if(empty($res)) return false;
		if($res['user_id']==$user_id) return false;
		return true;
	}

	//注册
	function sign($nick_email,$user_passwd,$img,$group_id)
	{
		$this->load->database();
		$query = $this->db->get_where('t_user',array('user_email' => $nick_email));
		if($nick_email=='' || $user_passwd=='')
		{	
			return 1;
		}else{
			$num = count($query->result_array());
			if($num > 0)
			{	
				return 2;
			}else{ 
				if(strtoupper($img)!=strtoupper($_SESSION["image"])){
					return 3;
				}else{
					$data = array(
						'user_email' => $nick_email,
						'user_passwd' => md5($user_passwd),
						'user_likes'=>0,
						'user_follows'=>0,
						'user_fans'=>0,
						'user_content'=>0,
						'user_type'=>1,
						'user_follows'=>0,
						'user_content'=>0,
						'user_recommend'=>0,
						'group_id'=>$group_id,
						'user_nickname'=>$nick_email
					);
					$this->db->insert('t_user', $data);
					$_SESSION['user_id'] = $this->db->insert_id();
					$_SESSION['user_email'] = $nick_email;
					$_SESSION['user_nickname'] = $nick_email;
					return 4;
				}
			}
		}
	}
	//登录验证
	function login_on_get($user_email,$password,$remeber)
	{
		$this->load->database();
		$userinfo=$this->db->get_where('t_user',array('user_email' => $user_email , 'user_passwd' => md5($password)))->row_array();
		if(empty($userinfo)) return false;
		if($remeber == '1'){	
			setcookie("user_email",$userinfo['user_email'],time()+3600*24*7,'/	');
			setcookie("user_nickname",$userinfo['user_nickname'],time()+3600*24*7,'/');
			setcookie("user_id",$userinfo['user_id'],time()+3600*24*7,'/');
			setcookie("notice_show",'1',time()+3600*24*7,'/');
			$_SESSION['user_id'] = $userinfo['user_id'];
			$_SESSION['user_nickname'] = $userinfo['user_nickname'];
			$_SESSION['user_email'] = $userinfo['user_email'];
			$_SESSION['notice_show'] = '1';
		}else{	
			$_SESSION['user_id'] = $userinfo['user_id'];
			$_SESSION['user_email'] = $userinfo['user_email'];
			$_SESSION['user_nickname'] = $userinfo['user_nickname'];
			$_SESSION['notice_show'] = '1';
		}
		return true;
	}


	/**
	 *description:更新有用无用 +1
	 *author:baohanbin
	 *date:2013/11/08
	 */
	public function up_recommend($id)
	{

		$mes = $this->db->query("UPDATE t_user set user_recommend = user_recommend+1 where user_id = $id"); 
		return $mes;
	}

	/**
	 *description:更新有用无用 —1
	 *author:baohanbin
	 *date:2013/11/08
	 */
	public function del_recommend($id)
	{
		$mes = $this->db->query("UPDATE t_user set user_recommend = user_recommend-1 where user_id = $id"); 
		return $mes;
	}

	/**
	 * 修改
	 * @param array $data
	 * @param arrray $where
	 * @return boolean
	 * @author liuguangping
	 * @version jia178 v1.0 2013/11/7
	 */
	public function updates_global($data,$where){
		return $this->db->update('t_user',$data,$where)?true:false;
	}

	/**
	 *description:后台统计用户信息列表
	 *author:baohanbin
	 *date:2013/11/12
	 */
	public function count_list_amdin($nicname,$email,$starttime,$stoptime)
	{
		$sql = "select count(t_user.user_id) as nubs from t_user where user_type < 50";
		if($nicname != ''){
			$sql .= " and user_nickname like '%$nicname%'";
		}
		if($email != ''){
			$sql .= " and user_email like '%$email%'";
		}
		if($starttime != ''){
			$sql .= " and user_reg_time >= '$starttime'";
		}
		if($stoptime != ''){
			$sql .= " and user_reg_time <= '$stoptime'";
		}
		$mes = $this->db->query($sql)->row_array();
		if($mes)
		{
			return $mes['nubs'];
		}		
	}
	/**
	 *description:修改用户类型，做出假的删除
	 *author:baohanbin
	 *date:2013/11/12
	 */
	public function del_use_f()
	{
		return $this->db->query("UPDATE t_user set user_type = 99 where user_id = $this->user_id");

	}


	/**
	 *description:搜索用户
	 *author:yanyalong
	 *date:2013/11/13
	 */
	public function user_search($keyword,$p,$row){
		$limit = " limit ".($p-1)*$row.",".$row;
		$res = $this->db->query("select user_id,user_nickname from t_user where user_nickname like '%$keyword%' and user_type<50 order by user_fans desc $limit")->result_array();
		$count = $this->db->query("select count(*) count from t_user where user_nickname like '%$keyword%' and user_type<50")->row_array();
		$this->config->load('url');
		$config = $this->config->item('url');
		if($count['count']=="0"){
			$userlist = "";
		}else{
			$userlist['user_list'] = $res;
			$userlist['num'] = $count['count'];
		}
		return $userlist;
	}
	/**
	 *description:后台获取用户信息列表
	 *author:baohanbin
	 *date:2013/11/12
	 */
	public function usrelistadmin($p,$row,$nicname,$email,$starttime,$stoptime)
	{
		$limit = " limit ".($p-1)*$row.",".$row;
		$sql = "select t_user.user_id,user_nickname,user_sex,user_email,user_type,province_code as provinceid,user_reg_time from t_user where user_type < 50";
		if($nicname != ''){
			$sql .= " and user_nickname like '%$nicname%'";
		}
		if($email != ''){
			$sql .= " and user_email like '%$email%'";
		}
		if($starttime != ''){
			$sql .= " and user_reg_time >= '$starttime'";
		}
		if($stoptime != ''){
			$sql .= " and user_reg_time <= '$stoptime'";
		}
		$sql .= $limit;
		$mes = $this->db->query($sql); 
		return $mes->result();
	}

	/**
	 *description:获取个人详细信息
	 *author:yanyalong
	 *date:2013/11/14
	 */
	public function userfull($user_id){
		return $this->db->query("select * from t_user  where t_user.user_id=$user_id and user_type < 50")->row(); 
	}
	/**
	 *description:修改用户密码
	 *author:yanyalong
	 *date:2013/09/25
	 */
	public function update_passwd($user_passwd,$user_id)
	{
		$data = array(
			'user_passwd' => $user_passwd
		);
		$this->db->where('user_id', $user_id);
		return $this->db->update('t_user', $data);
	}

	/**
	 *description:根据用户邮箱查询数据-----忘记密码
	 *author:baohanbin
	 *date:2013/11/14
	 */
	public function emailname()
	{
		return $this->db->query("select * from t_user where user_email = '$this->user_email'")->row_array(); 
	}

	/**
	 *description:根据用户邮箱查询数据是否存在-----忘记密码
	 *author:baohanbin
	 *date:2013/11/14
	 */
	public function codeemail($email,$code)
	{

		return $this->db->query("select t_user.user_id from t_user left join t_user_feeds on t_user.user_id = t_user_feeds.user_id where feed_content = '$code' and user_email = '$email'")->row_array();
	}
	/**
	 *description:根据用户邮箱查询数据是否存在-----忘记密码
	 *author:baohanbin
	 *date:2013/11/14
	 */
	public function updatepwd()
	{
		return $this->db->query("UPDATE t_user set user_passwd = '$this->user_passwd' where user_id = $this->user_id ");
	}
	/**
	 *description:获取首页推荐家装达人
	 *author:yanyalong
	 *date:2013/11/15
	 */
	public function explore($p,$row){
		$limit = " limit ".($p-1)*$row.",".$row;
		$res['list'] = $this->db->query("select * from t_user where user_type=2 $limit")->result();		
		$res['count']= floor($this->db->query("select count(*) count from t_user where user_type=2")->row()->count/$row);		
		return $res;
	}
	/**
	 *description:判断邮箱有没有重复的 出了本身自己的id
	 *author:baohanbin
	 *date:2013/11/19
	 */
	public function sel_email(){
		$res = $this->db->query("select * from t_user where user_id != $this->user_id and user_email='$this->user_email'")->row_array();
		if(empty($res)){
			return true;
		}else{
			return false;
		}
	}
	/**
	 *description:判断昵称有没有重复的 出了本身自己的id
	 *author:baohanbin
	 *date:2013/11/19
	 */
	public function sel_nicname(){
		$res = $this->db->query("select * from t_user where user_id != $this->user_id and user_nickname='$this->user_nickname'")->row_array();
		if(empty($res)){
			return true;
		}else{
			return false;
		}
	}

	public function getuser(){
		$res = $this->db->query("show tables")->result();
		$res3 = array();
		foreach ($res as $key=>$val) {
			$res2 = $this->db->query("show COLUMNS from $val->Tables_in_jiaceshi")->result();
			foreach ($res2 as $keys=>$vals) {
				$res3[] = $vals->Field;	
			}
		}
		return $res3;
	}
	/**
	 *description:判断用户积分及当日同类操作次数是否满足操作要求
	 *author:yanyalong
	 *date:2013/11/23
	 */
	public function checkScore($user_id,$score_key){
		$score = model("t_system_score")->get($score_key)->score_get;			
		if($score>0){
			return true;
		}else{
			if(model("t_user")->get($user_id)->user_score<abs($score)){
				return false;
			}else{
				return true;
			}
		}
	}
	/**
	 *description:修改用户积分信息
	 *author:yanyalong
	 *date:2013/11/23
	 */
	public function modScore($user_id,$score_key){
		$score = model("t_system_score")->get($score_key)->score_get;			
		if($score>0){
			model("t_user")->user_status($user_id,'user_vailable_score','+',$score);
			model("t_user")->user_status($user_id,'user_score','+',$score);
			return true;
		}else{
			model("t_user")->user_status($user_id,'user_score','+',$score);
			return true;
		}
	}

	
	
	/**
	 *  是否是设计师
	 *  @todo 先预定设计师为 user_type = 3 
	 */
	public function is_designer($where){
	
		return $this->db->query('SELECT user_id FROM t_user WHERE user_id IN ('.$where.') AND group_id>=21 AND group_id<=29')->result_array();
	
	}
	

	/**
	 *description:根据用户id列表获取用户列表
	 *author:yanyalong
	 *date:2013/12/22
	 */
	public function getUserByUserIdList($user_idlist,$row=""){
		return $this->db->query("select * from t_user u left join t_user_info i on i.user_id=u.user_id where u.user_id in ($user_idlist) limit $row")->result();
	}
	/**
	 *description:获取用户发布的最新灵感
	 *author:yanyalong
	 *date:2013/12/28
	 */
	public function contentListByUser($user_id,$p,$row){
		$limit = ' limit '.($p-1)*$row.','.$row;
	return	$this->db->query("select * from t_content c where c.user_id='$user_id' and c.content_status<10 order by c.content_subtime desc $limit")->result();
	}
    
}
