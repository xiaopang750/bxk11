<?php
class BaseAction extends Action
{
	protected function _initialize()
	{
		define('RES', THEME_PATH . 'common');
		define('STATICS', TMPL_PATH . 'static');
		$this->assign('action', $this->getActionName());
	}
	protected function all_insert($name = '', $back = '/index')
	{
		$name = $name ? $name : MODULE_NAME;
		$db   = D($name);
		if ($db->create() === false) {

			$this->error($db->getError());
		} else {
			$id = $db->add();
			if ($id) {
				$m_arr = array(
					'Img',
					'Text',
					'Voiceresponse',
					'Ordering',
					'Lottery',
					'Host',
					'Product',
					'Selfform',
					'Weidiaoyan',
					'Panorama'
				);
				if (in_array($name, $m_arr)) {
					$data['pid']     = $id;
					$data['module']  = $name;
					$data['token']   = session('token');
					$data['keyword'] = $_POST['keyword'];
					M('Keyword')->add($data);
				}
				$this->success('操作成功', U(MODULE_NAME . $back));
			} else {
				$this->error('操作失败', U(MODULE_NAME . $back));
			}
		}
	}
	protected function insert($name = '', $back = '/index')
	{
		$name = $name ? $name : MODULE_NAME;
		$db   = D($name);
		if ($db->create() === false) {
			$this->error($db->getError());
		} else {
			$id = $db->add();
			if ($id == true) {
				$this->success('操作成功', U(MODULE_NAME . $back));
			} else {
				$this->error('操作失败', U(MODULE_NAME . $back));
			}
		}
	}
	protected function save($name = '', $back = '/index')
	{
		$name = $name ? $name : MODULE_NAME;
		$db   = D($name);
		if ($db->create() === false) {
			$this->error($db->getError());
		} else {
			$id = $db->save();
			if ($id == true) {
				$this->success('操作成功', U(MODULE_NAME . $back));
			} else {
				$this->error('操作失败', U(MODULE_NAME . $back));
			}
		}
	}
	protected function all_save($name = '', $back = '/index')
	{
		$name = $name ? $name : MODULE_NAME;
		$db   = D($name);
		if ($db->create() === false) {
			$this->error($db->getError());
		} else {
			$id = $db->save();
			if ($id) {
				$m_arr = array(
					'Img',
					'Text',
					'Voiceresponse',
					'Ordering',
					'Lottery',
					'Host',
					'Product',
					'Selfform',
					'Weidiaoyan'
				);
				if (in_array($name, $m_arr)) {
					$data['pid']    = $_POST['id'];
					$data['module'] = $name;
					$data['token']  = session('token');
					$da['keyword']  = $_POST['keyword'];
					M('Keyword')->where($data)->save($da);
				}
				$this->success('操作成功', U(MODULE_NAME . $back));
			} else {
				$this->error('操作失败', U(MODULE_NAME . $back));
			}
		}
	}
	protected function all_del($id, $name = '', $back = '/index')
	{
		$name = $name ? $name : MODULE_NAME;
		$db   = D($name);
		if ($db->delete($id)) {
			$this->ajaxReturn('操作成功', U(MODULE_NAME . $back));
		} else {
			$this->ajaxReturn('操作失败', U(MODULE_NAME . $back));
		}
	}
	/**
	 *description:检查jia178.T_user_info表中是否已存在当前wecha_id
	 *author:yanyalong
	 *date:2014/02/28
	 */
	public function check_wecha(){
		$t_user_info= D('T_user_info');
		$wecha_id = $_REQUEST['wecha_id'];
		$userinfo = $t_user_info->getInfoByWecha_id($wecha_id);
		if(!isset($userinfo)||$userinfo==false){
			$t_user= D('T_user');
			$data['user_nickname'] = rand(10000,99999999);
			$data['group_id'] = 1;
			$user_id = $t_user->add($data);
			$info['user_id'] = $user_id;
			$info['user_weixinid'] = $wecha_id;
			$info['user_noticeoptions'] ="1,1,1,1,1";
			$info['user_mailoptions'] ="1,1";
			$t_user_info->add($info);
		}
	}
}
?>
