<?php
class MYURI extends CI_URI {
	function _explode_segments()
	{
		foreach(explode("/", preg_replace("|/*(.+?)/*$|", "\1", $this->uri_string)) as $val)
		{
			$val = trim($this->_filter_uri(rawurlencode($val))); if ($val != '')
		{
			$this->segments[] = rawurldecode($val);
		}
		}
	}
}
