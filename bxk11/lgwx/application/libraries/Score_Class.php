<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @description 积分类模块 
 * @author		yanyl
 */
class Score_Class{

	public $user_id;
	public $score_key;
	function __construct($user_id,$score_key){
		$this->CI = &get_instance();
		$this->CI->load->model('t_user_model');
		$this->CI->load->model('t_system_score_model');
		$this->CI->load->model('t_content_model');
		$this->CI->load->model('t_questions_model');
		$this->CI->load->model('t_answer_model');
		$this->CI->load->model('t_user_feeds_model');
		$this->user_id = $user_id;
		$this->score_key= $score_key;
		$this->score = $this->CI->t_system_score_model->get($score_key);			
		$this->user_score= $this->CI->t_user_model->get($user_id)->user_score;			
	}		
	/**
	 *description:判断用户积分是否满足操作要求
	 *author:yanyalong
	 *date:2013/11/23
	 */
	public function checkScore(){
		if($this->score->score_get>0){
			return true;
		}else{
			if($this->user_score<abs($this->score->score_get)){
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
	public function modScore(){
		if($this->score->score_get>0){
			$this->CI->t_user_model->user_status($this->user_id,'user_vailable_score','+',$this->score->score_get);
			$this->CI->t_user_model->user_status($this->user_id,'user_score','+',$this->score->score_get);
			return true;
		}else{
			$this->CI->t_user_model->user_status($this->user_id,'user_score','+',$this->score->score_get);
			return true;
		}
	}
	/**
	 *description:判断用户当日操作次数是否满足奖励积分要求
	 *author:yanyalong
	 *date:2013/11/25
	 */
	public function checkMax(){
		switch ($this->score_key) {
		case 'content_add':
			if($this->CI->t_content_model->getconts($this->user_id)->count==$this->score->score_daily_max||$this->CI->t_content_model->getconts($this->user_id)->count<$this->score->score_daily_max||$this->score->score_daily_max=="0"){
				return true;	
			}else{ return false;}		
			break;
		case 'discussion_add':
			if($this->CI->t_content_discussion_model->getconts($this->user_id)->count<$this->score->score_daily_max||$this->CI->t_content_discussion_model->getconts($this->user_id)->count==$this->score->score_daily_max||$this->score->score_daily_max=="0"){
				return true;	
			}else{ return false;}		
			break;
		case 'question_add':
			return true;
			break;
		case 'answer_add':
			if($this->CI->t_answer_model->getconts($this->user_id)->count<$this->score->score_daily_max||$this->CI->t_answer_model->getconts($this->user_id)->count==$this->score->score_daily_max||$this->score->score_daily_max=="0"){
				return true;	
			}else{ return false;}		
			break;
		case 'like_add':
			$user_feed_count = $this->CI->t_user_feeds_model->getconts($this->user_id,5)->count;
			if($user_feed_count<$this->score->score_daily_max||$user_feed_count==$this->score->score_daily_max||$this->score->score_daily_max=="0"){
				return true;	
			}else{ return false;}		
			break;
		case 'follow_add':
			$user_feed_count = $this->CI->t_user_feeds_model->getconts($this->user_id,6)->count;
			if($user_feed_count<$this->score->score_daily_max||$user_feed_count==$this->score->score_daily_max||$this->score->score_daily_max=="0"){
				return true;	
			}else{ return false;}		
			break;
		case 'take_add':
			$user_feed_count = $this->CI->t_user_feeds_model->getconts($this->user_id,7)->count;
			if($user_feed_count<$this->score->score_daily_max||$user_feed_count==$this->score->score_daily_max||$this->score->score_daily_max=="0"){
				return true;	
			}else{ return false;}		
			break;
		}
	}
}

