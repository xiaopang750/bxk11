<?php
/**
 *语音回复
**/
class ClassifyAction extends UserAction{
	public function index(){
		$db=D('Classify');
		$where['token']=session('token');
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->order('sorts desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->display();
	}
	
	public function add(){
		$this->display();
	}
	
	public function edit(){
		$id=$this->_get('id','intval');
		$info=M('Classify')->find($id);
		$this->assign('info',$info);
		$this->display();
	}
	
	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		if(D(MODULE_NAME)->where($where)->delete()){
			$this->success('操作成功',U(MODULE_NAME.'/index'));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index'));
		}
	}
	public function insert(){
		$this->all_insert();
	}
	public function upsave(){
		$this->all_save();
	}
	//动态列表
	public function dotaiList(){
		$db=D('Article');
		$count=$db->count();
		$page=new Page($count,2);
		$info=$db->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('page',$page->show());
		$this->assign('info',$info);
		$this->display();
	}
	public function addDotai(){
		$this->display();
	}
	public function insertDotai(){
		$map['title'] = $this->_post('title','trim','无标题');
		$map['description'] = $this->_post('description','trim','无简介');
		$map['author'] = $this->_post('author','intval','1');
		$map['form'] = $this->_post('url');
		$map['content'] = $this->_post('info');
		$map['imgs'] = $this->_post('pic');
		$map['uid'] = session('uid');
		$map['updatetime'] = '';
		$map['createtime'] = time();
		$article = M('Article');
		if($article->add($map)){
			$this->success("添加成功！",U('User/Classify/dotaiList'));
		}else{
			$this->error('添加失败！',U('User/Classify/addDotai'));
		}
		
	}
	
	public function editDotai(){
		$id=$this->_get('id','intval');
		$info=M('Article')->find($id);
		$this->assign('info',$info);
		$this->display();
	}
	public function upsaveDotai(){
		$id = $this->_post('id','intval');
		$map['title'] = $this->_post('title','trim','无标题');
		$map['description'] = $this->_post('description','trim','无简介');
		$map['author'] = $this->_post('author','intval','1');
		$map['form'] = $this->_post('url');
		$map['content'] = $this->_post('info');
		$map['imgs'] = $this->_post('pic');
		$map['uid'] = session('uid');
		$map['updatetime'] = time();
		$article = M('Article');
		if($article->where('id='.$id)->save($map)){
			$this->success("修改成功！",U('User/Classify/dotaiList'));
		}else{
			$this->error('修改失败！',U('User/Classify/editDotai',array('id'=>$id)));
		}
	}
}
?>