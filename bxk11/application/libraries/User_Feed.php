<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
abstract class GetFeed{

	/**
	 *description:产生动态用户id
	 *author:yanyalong
	 */
	public $user_id;
	/**
	 *description:动态产生操作项id,该数值随环境改变而改变，比如生成添加博文动态，则data_id为博文id，生成关注用户动态，则data_id为被关注用户id
	 *author:yanyalong
	 */
	public $data_id;

	abstract public function GetMyFeed();
	public function __construct($user_id="",$data_id=""){
		$this->CI = &get_instance();
		$this->CI->load->model('t_user_feeds_model');
		$this->CI->load->model('t_content_model');
		$this->CI->load->model('t_user_model');
		$this->CI->load->model('t_questions_model');
		$this->CI->load->model('t_tag_model');
		$this->CI->config->load('url');
		$this->urlConfig = $this->CI->config->item('url');
		$this->data_id = $data_id;
		$this->user_id= $user_id;
	}
}
/**
 *description:生成添加博文动态
 *author:yanyalong
 *date:2013/11/04
 */
class GetFeedByAddContent extends GetFeed{
	public function GetMyFeed(){
		$content  = $this->CI->t_content_model->get($this->data_id);
		$userinfo = $this->CI->t_user_model->get($this->user_id);
		if($content->content_type==1){
			$this->CI->t_user_feeds_model->feed_content = "发布了<a href='".$this->urlConfig['contenturl'].$this->data_id."' target='_blank'>".$content->content_title."</a>";
		}else{
			$this->CI->t_user_feeds_model->feed_content = "发布了<a href='".$this->urlConfig['producturl'].$this->data_id."' target='_blank'>".$content->content_title."</a>";
		}
		$this->CI->t_user_feeds_model->user_id = $this->user_id;
		$this->CI->t_user_feeds_model->feed_type = 1;
		return $this->CI->t_user_feeds_model->insert();
	}
}
/**
 *description:生成喜欢博文动态
 *author:yanyalong
 *date:2013/11/04
 */
class GetFeedByLikeContent extends GetFeed{
	public function GetMyFeed(){
		$content  = $this->CI->t_content_model->get($this->data_id);
		if($content->content_type==1){
			$this->CI->t_user_feeds_model->feed_content = "喜欢了<a href='".$this->urlConfig['contenturl'].$this->data_id."' target='_blank'>".$content->content_title."</a>";
		}else{
			$this->CI->t_user_feeds_model->feed_content = "喜欢了<a href='".$this->urlConfig['producturl'].$this->data_id."' target='_blank'>".$content->content_title."</a>";
		}
		$this->CI->t_user_feeds_model->user_id = $this->user_id;
		$this->CI->t_user_feeds_model->feed_type = 5;
		return $this->CI->t_user_feeds_model->insert();
	}
}

/**
 *description:生成评论博文动态(并增加积分动态)
 *author:yanyalong
 *date:2013/11/04
 */
class GetFeedByDiscContent extends GetFeed{
	public function GetMyFeed(){
		$content  = $this->CI->t_content_model->get($this->data_id);
		if($content->content_type==1){
			$this->CI->t_user_feeds_model->feed_content = "评论了<a href='".$this->urlConfig['contenturl'].$this->data_id."' target='_blank'>".$content->content_title."</a>";
		}else{
			$this->CI->t_user_feeds_model->feed_content = "评论了<a href='".$this->urlConfig['producturl'].$this->data_id."' target='_blank'>".$content->content_title."</a>";
		}
		$this->CI->t_user_feeds_model->user_id = $this->user_id;
		$this->CI->t_user_feeds_model->feed_type = 1;
		return $this->CI->t_user_feeds_model->insert();
	}
}

/**
 *description:生成评论博文动态(并增加积分动态)
 *author:yanyalong
 *date:2013/11/04
 */
class GetFeedByReadContent extends GetFeed{
	public function GetMyFeed(){
		$this->CI->t_user_feeds_model->feed_content = $this->data_id;
		$this->CI->t_user_feeds_model->user_id = $this->user_id;
		$this->CI->t_user_feeds_model->feed_type = 16;
		return $this->CI->t_user_feeds_model->insert();
	}
}

/**
 *description:生成回复评论博文动态
 *author:yanyalong
 *date:2013/11/04
 */
class GetFeedByReplyContent extends GetFeed{
	public function GetMyFeed(){
		$content  = $this->CI->t_content_model->get($this->data_id);
		if($content->content_type==1){
			$this->CI->t_user_feeds_model->feed_content = "回复了<a href='".$this->urlConfig['contenturl'].$this->data_id."' target='_blank'>".$content->content_title."</a>";
		}else{
			$this->CI->t_user_feeds_model->feed_content = "回复了<a href='".$this->urlConfig['producturl'].$this->data_id."' target='_blank'>".$content->content_title."</a>";
		}
		$this->CI->t_user_feeds_model->user_id = $this->user_id;
		$this->CI->t_user_feeds_model->feed_type = 1;
		return $this->CI->t_user_feeds_model->insert();
	}
}

/**
 *description:生成添加问题动态
 *author:yanyalong
 *date:2013/11/04
 */
class GetFeedByAddQuestion extends GetFeed{
	public function GetMyFeed(){
		$content  = $this->CI->t_questions_model->get($this->data_id);
		$userinfo = $this->CI->t_user_model->get($this->user_id);
		$this->CI->t_user_feeds_model->feed_content = "发布了<a href='".$this->urlConfig['questionurl'].$this->data_id."' target='_blank'>".$content->question_title."</a>";
		$this->CI->t_user_feeds_model->user_id = $this->user_id;
		$this->CI->t_user_feeds_model->feed_type = 2;
		return $this->CI->t_user_feeds_model->insert();
	}
}
/**
 *description:生成喜欢问题动态
 *author:yanyalong
 *date:2013/11/04
 */
class GetFeedByLikeQuestion extends GetFeed{
	public function GetMyFeed(){
		$content  = $this->CI->t_questions_model->get($this->data_id);
		$this->CI->t_user_feeds_model->feed_content = "喜欢了<a href='".$this->urlConfig['questionurl'].$thsi->data_id."' target='_blank'>".$content->question_title."</a>";
		$this->CI->t_user_feeds_model->user_id = $this->user_id;
		$this->CI->t_user_feeds_model->feed_type = 5;
		return $this->CI->t_user_feeds_model->insert();
	}
}

/**
 *description:生成回答问题动态
 *author:yanyalong
 *date:2013/11/04
 */
class GetFeedByDiscQuestion extends GetFeed{
	public function GetMyFeed(){
		$content  = $this->CI->t_questions_model->get($this->data_id);
		$this->CI->t_user_feeds_model->feed_content = "回答了<a href='".$this->urlConfig['questionurl'].$this->data_id."' target='_blank'>".$content->question_title."</a>";
		$this->CI->t_user_feeds_model->user_id = $this->user_id;
		$this->CI->t_user_feeds_model->feed_type = 2;
		return $this->CI->t_user_feeds_model->insert();
	}
}

/**
 *description:生成回复回答动态
 *author:yanyalong
 *date:2013/11/04
 */
class GetFeedByReplyQuestion extends GetFeed{
	public function GetMyFeed(){
		$content  = $this->CI->t_questions_model->get($this->data_id);
		$this->CI->t_user_feeds_model->feed_content = "回复了<a href='".$this->urlConfig['questionurl'].$this->data_id."' target='_blank'>".$content->question_title."</a>";
		$this->CI->t_user_feeds_model->user_id = $this->user_id;
		$this->CI->t_user_feeds_model->feed_type = 2;
		return $this->CI->t_user_feeds_model->insert();
	}
}

/**
 *description:生成回复回答动态
 *author:yanyalong
 *date:2013/11/04
 */
class GetFeedByFollow extends GetFeed{
	public function GetMyFeed(){
		$userinfo = $this->CI->t_user_model->get($this->data_id);
		$this->CI->t_user_feeds_model->feed_content = "关注了<a href='".$this->urlConfig['userspace'].$this->data_id."' target='_blank'>".$userinfo->user_nickname."</a>";
		$this->CI->t_user_feeds_model->user_id = $this->user_id;
		$this->CI->t_user_feeds_model->feed_type = 6;
		return $this->CI->t_user_feeds_model->insert();
	}
}

/**
 *description:生成订阅标签，主题动态
 *author:yanyalong
 *date:2013/11/04
 */
class GetFeedByTakeTag extends GetFeed{
	public function GetMyFeed(){
		$taginfo = $this->CI->t_tag_model->get($this->data_id);
		$this->CI->t_user_feeds_model->feed_content = "订阅了<a href='".$this->urlConfig['tagurl'].$taginfo->tag_name."' target='_blank'>".$taginfo->tag_name."</a>";
		$this->CI->t_user_feeds_model->user_id = $this->user_id;
		$this->CI->t_user_feeds_model->feed_type = 7;
		return $this->CI->t_user_feeds_model->insert();
	}
}

class Feed{
	public function Feed($feedTypeClass,$user_id="",$data_id=""){
		$obj = new $feedTypeClass($user_id,$data_id);
		if($obj instanceof GetFeed){//若当前对象的抽象继承于抽象类，则符合规范
			return $obj->GetMyFeed();
		}else{//否则显示错误信息
			return false;
		}
	}
}

