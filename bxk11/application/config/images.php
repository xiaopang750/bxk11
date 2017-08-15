<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*图片裁切相关配置信息
*/
/**
*修剪图片配置信息
*/
$config['crop']['image_library'] = 'gd2';
$config['crop']['maintain_ratio'] = '10000000';
$config['crop']['unlink'] = TRUE;
/**
*生成缩略图配置信息
*/
$config['thumb']['image_library'] = 'gd2';
$config['thumb']['master_dim'] = 'auto';
$config['thumb']['maintain_ratio'] = TRUE;
$config['thumb']['unlink'] = TRUE;
$config['thumb']['url'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/blog/source/';

