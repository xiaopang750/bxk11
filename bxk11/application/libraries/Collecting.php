<?php

	function get_args($name)
	{
		if(isset($_POST[$name]))return $_POST[$name];
		if(isset($_GET[$name]))return $_GET[$name];
		return null;
	}

	function read_file($filename)
	{
		$line = '';
		//检查目录是否存在
		if(file_exists($filename)){
		if ($file_handle = @fopen($filename, "r")) {
			while (!feof($file_handle)) {
			   $line .= fgets($file_handle);
			}
			fclose($file_handle);
		}}
		return $line;
	}

	function write_file($filename,$data)
	{
		if ($file_handle = @fopen($filename, "w+")) {
			fwrite($file_handle,$data);
			fclose($file_handle);
		}
	}

	function append_file($filename,$data)
	{
		if ($file_handle = fopen($filename, "a+")) {
			fwrite($file_handle,$data);
			fclose($file_handle);
		}
	}

	/* 
	 * $url 图片地址 
	 * $filepath 图片保存地址 
	 * return 返回下载的图片路径和名称 
	 */  
	function getimg($imgdata ) {  	
		include_once("./application/config/collect.php");
		$webRoot = $config['coll']['path'];
		$siteDomain = $config['coll']['siteDomain'];
		$db_filename = $siteDomain;
		$url = $imgdata["media"];
		if ($url == '') {  
			return false;  
		}  
		$ext = strrchr($url, '.');
		if ($ext != '.jpg') {  
			return false;  
		}

		$filepath = $webRoot;
		//判断路经是否存在  
		!is_dir($filepath)?mkdir($filepath):null;  
	  
		//获得随机的图片名，并加上后辍名  
		$filename = $config['coll']['img_name'];
	  
		//读取图片  
		$img = file_get_contents($url);

		//指定打开的文件  
		$fp = fopen($filepath.$filename, 'a');

		//写入图片到指定的文本  
		fwrite($fp, $img);  
		fclose($fp);
		$imgdata["serverurl"] =  $siteDomain.$filename;
		$imgdata["server_state"] = !0;
		$imgdata["add_datetime"] = date("Y-m-d H:i:s");
		$imgdata["name"] = $filename;
		return $imgdata;
	}  


	function get_imgdata()
	{
		global $db_filename;
		return json_decode(read_file($db_filename));
	}

	function add_imgdata($imgdata)
	{
		global $db_filename;
		$arr = get_imgdata();
		if($arr == "") $arr = array();
		$arr[] = $imgdata;
		write_file($db_filename,json_encode($arr));
	}


