<?php 
class LikesModel extends Model {
	//protected $dbName = '';
	/**
	 *description:获取参加活动统计数
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function activeLikes($user_id){
		return $this->row("select count(*) count  from likes where user_id='$user_id'")->count;			
	}
	/**
	 *description:获取用户关注的活动
	 *author:yanyalong
	 *date:2014/02/25
	 */
	public function articleLikeList($user_id,$p,$row){
		$limit = "";
		if($p!=""&&$row!=""){
			$limit = " limit ".($p-1)*$row.",".$row;
		}
		return $this->result("select * from likes l left join  article a on l.article_id=a.id left join jia178.t_service_info ri on ri.service_id=a.uid where l.user_id='$user_id' $limit");			
	}
	/**
	 *description:用户是否关注
	 *author:liuguangping
	 *date:2014/02/25
	 */
	public function is_follow($user_id,$article_id,$type){
		return $this->row("select * from likes where article_id=".$article_id." and user_id=".$user_id." and type=".$type);			
	}
	/**
	 *description:关注
	 *author:liuguangping
	 *date:2014/02/25
	 */
	public function addFollow($user_id,$article_id,$type){
		$data['user_id'] = $user_id;
		$data['like_addtime'] = date("Y-m-d H:i:s",time());
		$data['type'] = $type;
		$data['article_id'] = $article_id;
		$where['article_id'] = $article_id;
		$where['user_id'] = $user_id;
		$where['type'] = $type;
		$this->where($where)->delete();
		if($this->data($data)->add()){
			return true;
		}else{
			return false;
		}
		
	}

	/**
	 *description:取消关注
	 *author:liuguangping
	 *date:2014/02/25
	 */
	public function cancelFollow($user_id,$article_id,$type){
		
		$where['article_id'] = $article_id;
		$where['user_id'] = $user_id;
		$where['type'] = $type;
		if($this->where($where)->delete()){
			return true;
		}else{
			return false;
		}
		
	}
}

