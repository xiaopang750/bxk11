<?php
function isAndroid(){
	if(strstr($_SERVER['HTTP_USER_AGENT'],'Android')) {
		return 1;
	}
	return 0;
}
/**
 *description:json返回
 *author:yanyalong
 *param:$flag 0：数据结果为空或执行失败等,1：执行成功或存在相应数据，message:消息说明
 *date:2014/02/25
 */
if(!function_exists('echojson'))
{
	function echojson($status,$data,$msg="") {
		echo "{".'"err":'.intval($status).",".'"data"'.":".json_encode($data).",".'"msg"'.":".json_encode($msg)."}";exit;
	}
}
/**
 *description:前端加载静态文件
 *author:yanyalong
 *date:2013/11/27
 */
function loadInclude($url){
	return include_once $_SERVER['DOCUMENT_ROOT']."/views/include/".$url;
}
/**
 *description:根据房间id获取平面房间路径
 *author:yanyalong
 *date:2013/12/14
 */
function d2roomurl($room_id,$dir){
	return '/uploads/room/'.$dir.'/'.ceil($room_id/1000).'/'.$room_id.'/';
}
/**
 *description:获取楼层平面布置图地址
 *author:yanyalong
 *date:2013/12/18
 */
function getfloor1url($scheme_id,$floor_id){
	$picurl = '/uploads/scheme/'.ceil($scheme_id/1000).'/'.$scheme_id.'/'.$floor_id.'/';
	return $picurl;
}

/**
 *description:根据房间id获取全景房间路径
 *author:yanyalong
 *date:2013/12/14
 */
function roomurl($room_id){
	return '/uploads/room/'.ceil($room_id/1000).'/'.$room_id.'/';
}

/**
 * @参数 arrs 二维数组
 * @键值 keys 要得到的键名
 * @return 以键值为建的一维数组
 * @author liuguangping
 * @date：2013/10/8 
 */
if(!function_exists('twotoone_array'))
{
	function twotoone_array($arrs,$keys){
		$ar = array();
		foreach ($arrs as $ke=>$va){
			foreach ($va as $kes=>$vals){
				if($kes == $keys){
					$ar[] = $vals;
				}
			}
		}
		return $ar;
	}
}
?>
