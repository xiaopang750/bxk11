<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @description CI上传类库扩展类，用以实现实际业务逻辑
 * @author		yanyl
 */
class MY_Upload extends CI_Upload{
    public function __construct(){
        $this->CI = &get_instance();
        $this->CI->config->load('upload_dircheck');		
        $dirCheckConfig= $this->CI->config->item("updateDirCheck");		
        foreach ($dirCheckConfig as $key=>$val) {
            if(!file_exists($val)){
                mkdir($val);
            }
        }
        parent::__construct();
    }
    /**
     *author:yanyl
     *description:图片上传功能
     **/
    public function img_upload_file($config){
        $tmpdir = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/service/';
        $tmpdir = (isset($config['upload_path']) && $config['upload_path']) ? $config['upload_path'] : $tmpdir;

        if(!file_exists($tmpdir)){
            mkdir($tmpdir);
        }
        $this->initialize($config);
        if (!$this->do_upload()){
            return false;
        }else{
            $data = array('upload_data' => $this->data());
            return $data;
        }
    }
    /**
     *description:创建年月日目录
     *author:yanyalong
     *date:2013/12/13
     */
    function mktimedir($dir){
        if(!file_exists($dir)){
            mkdir($dir);
        }
        $datedir = date("Y").'/'.date("m").'/'.date("d").'/';
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        if(!file_exists($dir.$year)){
            mkdir($dir.$year);
        }
        if(!file_exists($dir.$year.'/'.$month)){
            mkdir($dir.$year.'/'.$month);
        }
        if(!file_exists($dir.$datedir)){
            mkdir($dir.$datedir);
        }
        return $dir.$datedir;
    }

    /**
     *  多目录创建
     *
     */

    public function mkdirs($dir)
    {
        if(!is_dir($dir))
        {
            if(!$this->mkdirs(dirname($dir))){
                
                return false;
            }
            if(!mkdir($dir,0777)){
                return false;
            }
        }
        return true;
    }
    

    public function makedir($dir){
        if(!file_exists($dir)){
            mkdir($dir);
        }
    }
}
