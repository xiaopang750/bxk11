<?php
/**
 *	FROM表单接口
 *  @author liuguangping
 *  @version 1.1
 *  
 */
interface httpCheckInterFace
{
	//post处理接口
	public function postCheck();
	//get处理接口
	public function getCheck();
}