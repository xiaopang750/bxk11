<?php 
	header("content-type:text/html;charset=utf-8"); 
	include('./application/config/collect.php');
	/**
	 * 将目标url的内容写成字符串
     */
	function curl_file_get_contents($durl)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $durl);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$r = curl_exec($ch);
		curl_close($ch);
		// 调用去掉js、css
		$str = del_str($r);
		return $str;
	}
	/** 
	 * 保存图片到本地
	 * $url 图片地址 
	 * $filepath 图片保存地址 
	 * return 文件名
	 */  
    function getimg($url, $filepath)
	{
		include('./application/config/collect.php');
		if ($url == '') 
		{  
			return false;  
		}  
		$ext = strrchr($url, '.');  

		if ($ext != '.gif' && $ext != '.jpg') 
		{  
			return false;  
		}
		// 判断路经是否存在  
		!is_dir($filepath)?mkdir($filepath):null;  
		// 获得随机的图片名，并加上后辍名 
		$filename = $config['coll']['img_name'];	
		// 读取图片  
		$img = @ file_get_contents($url);
		// 指定打开的文件  
		$fp =  fopen($filepath.'/'.$filename, 'a');  
		// 写入图片到指定的文本  
		fwrite($fp, $img);  
		fclose($fp);
		// 查看图片大小  如果图片没有内容---->删除  
		$imgs = $filepath.'/'.$filename;
		$img_bit = filesize($imgs);
		if($img_bit == 0)
		{
			unlink($imgs);
			return '';
		}
		return $filename;
	}

	/**
	 * 修改字符编码
     */
	function  character(&$info)
	{
		// 判断传递的参数是数组还是字符串
		if(is_array($info))
		{
			foreach($info as &$val)
			{
				$val = iconv("GB2312//IGNORE","UTF-8//IGNORE",$val);
			}
			return $info;
		}else
		{
			$info = iconv("GB2312//IGNORE","UTF-8//IGNORE",$val);
			return $info;
		}
		
	}

	/**
	 * 去掉字符串中的js  css代码
	 * 去掉一些特殊字符
     */
	function del_str($strr)
	{
		$pattern=array ("'<script[^>]*?>.*?</script>'si",	//去掉 javascript
						"'<style[^>]*?>.*?</style>'si",		//去掉 css 样式
						// "'([rn])[s]+'", 					// 去掉空白字符 
						// "'&(quot|#34);'i", 				// 替换 HTML 实体 
						// "'&(amp|#38);'i", 
						// "'&(lt|#60);'i", 
						// "'&(gt|#62);'i", 
						// "'&(nbsp|#160);'i", 
						// "'&(iexcl|#161);'i", 
						// "'&(cent|#162);'i", 
						// "'&(pound|#163);'i", 
						// "'&(copy|#169);'i", 
						// "'&(ensp|#8194);'i",
						// "'&(emsp|#8195);'i",
						);
		$str = preg_replace($pattern,'',$strr);
		return $str;
	}

	/**
	 * 采集文章中的图片
	 * 判断图片的路径是否完整、有没有中文
	 * return 字符串
     */
	function coll_img($arr,$new_arr,$url,$filepath,$md5){
		$i = 1;
		foreach($arr as $value)
		{
			$url_host = @ parse_url($value);
			$new_url = @ $url_host['host'];
			// 判断url是否齐全、有没有中文
			if($new_url != '')
			{
				preg_match("/[\x{4e00}-\x{9fa5}]+/u", $value, $matches);
				if(empty($matches))
				{
					$val = $value;
				}
				else
				{
					$strc = preg_replace("/[\x{4e00}-\x{9fa5}]+/u",urlencode($matches[0]), $value);
					$val = $strc;
				}
			}
			else
			{
				preg_match("/[\x{4e00}-\x{9fa5}]+/u", $value, $matches);
				if(empty($matches)){
					$val = 'http://'.$url.$value;
				}
				else
				{
					$strc = preg_replace("/[\x{4e00}-\x{9fa5}]+/u",urlencode($matches[0]), $value);
					$val = 'http://'.$url.$strc;
				}
			}
			// 调用图片采集函数
			$tmp = getimg($val,$filepath);
			$info['img'][$i] = $tmp;
			$i++;
		}
		foreach ($new_arr as $key => $val) 
		{
			foreach ($info['img'] as $keys => $vals) 
			{
				if($key==$keys)
				{
					$new_arr[$key] = str_replace($md5,$vals,$val);	
				}
			}
		}
		$new_str = trim(implode('[img]',$new_arr),$md5);
		return $new_str;
	}

	/**
	 * 采集详细内容--->文章 主要处理 并返回数据
	 * 数组$outstr、$outstr为空只要 url  title内容
	 * return $data数组
     */
	function main_show($outstr,$outstr2,$str,$filepath,$url,$getUrl)
	{
		// 判断$outstr、$outstr2数组是否为空
		if(empty($outstr) || empty($outstr2))
		{
			preg_match('#<title>.*</title>#isU',$str,$outstr);
			if(!empty($outstr)){
				// 判断字符编码格式
				$encode = mb_detect_encoding($outstr[0], array("ASCII",'UTF-8','GB2312',"GBK",'BIG5'));
				if($encode != "UTF-8")
				{
					// 转换成 urf-8 编码
					$outstr = character($outstr);
				}
				$data['title'] = strip_tags($outstr[0]);
				$data['url'] = $getUrl;
				$data['content'] = '';
				return $data;
			}
			else
			{
				return '';
			}
		}
		// 去掉html标签、与自定义标签相符的标签
		$data['title'] =  strip_tags($outstr[0]);
		$data['url'] = $getUrl;
		$outstr2[0] = strip_tags($outstr2[0],"<img>");
		$outstr2[0] = preg_replace('/(\[img\])|(\[\/img\])/','',$outstr2[0]);
		$md5 = md5('@#$');
		// 替换 <img> 标签
		$new_str = preg_replace('#<img (.*)>#isU','[img]'.$md5.'[/img]',$outstr2[0]);
		preg_match_all('%src="(.*?)"%',$outstr2[0],$outstr3);
		// 去掉 $outstr3 中的空值
		$arr = array_filter($outstr3);
		// 判断文章中是否有图片
		if(empty($arr))
		{
			$data['content'] = $new_str;
			return $data;
		}
		else
		{
			$new_str = $md5.$new_str;
			$new_arr = explode('[img]', $new_str);
			$data['content'] = coll_img($outstr3[1],$new_arr,$url,$filepath,$md5);
			return $data;
		}
	}

?>