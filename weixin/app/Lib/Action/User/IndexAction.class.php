<?php
class IndexAction extends UserAction{
	//公众帐号列表
	public function index(){
		$where['uid']=session('uid');
		$group=D('User_group')->select();
		foreach($group as $key=>$val){
			$groups[$val['id']]['did']=$val['diynum'];
			$groups[$val['id']]['cid']=$val['connectnum'];
		}
		unset($group);
		$db=M('Wxuser');
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('info',$info);
		$this->assign('group',$groups);
		$this->assign('page',$page->show());
		$this->display();
	}
	//添加公众帐号
	public function add(){
		$randLength=6;
		$chars='abcdefghijklmnopqrstuvwxyz';
		$len=strlen($chars);
		$randStr='';
		for ($i=0;$i<$randLength;$i++){
			$randStr.=$chars[rand(0,$len-1)];
		}
		$tokenvalue=$randStr.time();
		$this->assign('tokenvalue',$tokenvalue);
		$this->assign('email',time().'@yourdomain.com');
		//地理信息
		if (C('baidu_map_api')){
			//$locationInfo=json_decode(file_get_contents('http://api.map.baidu.com/location/ip?ip='.$_SERVER['REMOTE_ADDR'].'&coor=bd09ll&ak='.C('baidu_map_api')),1);
			///$this->assign('province',$locationInfo['content']['address_detail']['province']);
			//$this->assign('city',$locationInfo['content']['address_detail']['city']);
			//var_export($locationInfo);
		}
	
		
		$this->display();
	}
	public function edit(){
		$id=$this->_get('id','intval');
		$where['uid']=session('uid');
		$res=M('Wxuser')->where($where)->find($id);
		$this->assign('info',$res);
		$this->display();
	}
	
	public function editsms(){
		$id=$this->_get('id','intval');
		$where['uid']=session('uid');
		$res=M('Wxuser')->where($where)->find($id);
		$this->assign('info',$res);
		$this->display();
	}

	public function editemail(){
		$id=$this->_get('id','intval');
		$where['uid']=session('uid');
		$res=M('Wxuser')->where($where)->find($id);
		$this->assign('info',$res);
		$this->display();
	}
	
	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		$user = D('Wxuser')->where($where)->find();
		if(D('Wxuser')->where($where)->delete()){
			//保存到178库里t_service_info经销商表
			$map['service_token'] = $user['token'];
			$data['service_status'] = '99';
			if(D('T_service_info')->where($map)->save($data)){
				$this->success('操作成功',U(MODULE_NAME.'/index'));
			}else{
				$this->error('同步Jia178操作失败,weinxin成功!',U(MODULE_NAME.'/index'));
			}
			
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index'));
		}
	}
	
	public function upsave(){
		//保存到178库里t_service_info经销商表
		$data['service_wxname'] = $this->_post('wxname','trim');
		$data['service_wxid'] = $this->_post('wxid','trim');
		$tokens = $this->_post('token','trim');
		$data['service_wxuser'] = $this->_post('weixin','trim');
		$data['service_status'] = 1;
		$service_province_code = $this->_post('province','trim');
		$province = D('T_system_district')->findArea($service_province_code,0);
		if($province){
			$data['service_province_code'] = $province['district_code'];
			$service_city_code = $this->_post('city','trim');
			$city = D('T_system_district')->findArea($service_city_code,$province['district_code']);
			if($city){
				$data['service_city_code'] = $city['district_code'];
			}else{
				$data['service_city_code'] = '';
			}
			
		}else{
			$data['service_province_code'] = '';
			$data['service_city_code'] = '';
		}
		
		$wheres['service_token'] = $tokens;

		D('T_service_info')->where($wheres)->save($data);
		
		$this->all_save('Wxuser');
	}
	
	public function insert(){
		$data=M('User_group')->field('wechat_card_num')->where(array('id'=>session('gid')))->find();
		$users=M('Users')->field('wechat_card_num')->where(array('id'=>session('uid')))->find();
		if($users['wechat_card_num']<$data['wechat_card_num']){
			
		}else{
			$this->error('您的VIP等级所能创建的公众号数量已经到达上线，请购买后再创建',U('User/Index/index'));exit();
		}
		//$this->all_insert('Wxuser');
		//



		$db=D('Wxuser');
		if($db->create()===false){
			$this->error($db->getError());
		}else{
			$id=$db->add();
			if($id){
				M('Users')->field('wechat_card_num')->where(array('id'=>session('uid')))->setInc('wechat_card_num');
				$this->addfc();
				$username = $_SESSION['uname'];
				$where = array('service_name'=>$username);
				//保存到178库里t_service_info经销商表
				$data['service_wxname'] = $this->_post('wxname','trim');
				$data['service_wxuser'] = $this->_post('weixin','trim');
				$data['service_wxid'] = $this->_post('wxid','trim');
				$data['service_token'] = $this->_post('token','trim');
				$data['service_status'] = 1;
				$service_province_code = $this->_post('province','trim');
				$province = D('T_system_district')->findArea($service_province_code,0);
				if($province){
					$data['service_province_code'] = $province['district_code'];
					$service_city_code = $this->_post('city','trim');
					$city = D('T_system_district')->findArea($service_city_code,$province['district_code']);
					if($city){
						$data['service_city_code'] = $city['district_code'];
					}else{
						$data['service_city_code'] = '';
					}
					
				}else{
					$data['service_province_code'] = '';
					$data['service_city_code'] = '';
				}
				
				$service_id = D('T_service_info')->data($data)->where($where)->save();
				if($service_id){
					$this->success('操作成功',U('Index/index'));
				}else{
					$this->error('同步Jia178操作失败,weinxin成功！',U('Index/index'));
				}
				
			}else{
				$this->error('操作失败',U('Index/index'));
			}
		}
		
	}
	
	//功能
	public function autos(){
		$this->display();
	}
	
	public function addfc(){
		$token_open=M('Token_open');
		$open['uid']=session('uid');
		$open['token']=$_POST['token'];
		$gid=session('gid');
		$fun=M('Function')->field('funname,gid,isserve')->where('`gid` <= '.$gid)->select();
		foreach($fun as $key=>$vo){
			$queryname.=$vo['funname'].',';
		}
		$open['queryname']=rtrim($queryname,',');
		$token_open->data($open)->add();
	}
	
	public function usersave(){
		$pwd=$this->_post('password');
		if($pwd!=false){
			$data['password']=md5($pwd);
			$data['id']=$_SESSION['uid'];
			if(M('Users')->save($data)){
				$datas['service_passwd'] = md5($pwd);
				$where = array('service_name'=>$_SESSION['checkreg']);
				$service_id = D('T_service_info')->data($datas)->where($where)->save();
				$this->success('密码修改成功！',U('Index/index'));
			}else{
				$this->error('密码修改失败！',U('Index/index'));
			}
		}else{
			$this->error('密码不能为空!',U('Index/useredit'));
		}
	}
	//处理关键词
	public function handleKeywords(){
		$Model = new Model();
		//检查system表是否存在
		$keyword_db=M('Keyword');
		$count = $keyword_db->where('pid>0')->count();
		//
		$i=intval($_GET['i']);
		//
		if ($i<$count){
			$img_db=M($data['module']);
			$back=$img_db->field('id,text,pic,url,title')->limit(9)->order('id desc')->where($like)->select();
			//
			$rt=$Model->query("CREATE TABLE IF NOT EXISTS `tp_system_info` (`lastsqlupdate` INT( 10 ) NOT NULL ,`version` VARCHAR( 10 ) NOT NULL) ENGINE = MYISAM CHARACTER SET utf8");
			$this->success('关键词处理中:'.$row['des'],'?g=User&m=Create&a=index');
		}else {
			exit('更新完成，请测试关键词回复');
		}
	}
}
?>