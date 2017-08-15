<?php
    session_start();
    /**
     * Created by JetBrains PhpStorm.
     * User: taoqili
     * Date: 12-1-16
     * Time: 上午11:44
     * To change this template use File | Settings | File Templates.
     */
    header("Content-Type: text/html; charset=utf-8");
    error_reporting( E_ERROR | E_WARNING );
    $service_root = $_SESSION['service_id'];
    $globalConfig = include( "config.php" );
  
    //需要遍历的目录列表，最好使用缩略图地址，否则当网速慢时可能会造成严重的延时
    //通过id查询的目录
    $paths = $globalConfig['imageSavePath'];

    $action = htmlspecialchars( $_POST[ "action" ] );

    //type_url 保存路径
    $type_url = htmlspecialchars( $_POST[ "type_url" ] );
    if ( $action == "get" ) {
        $files = array();
        foreach ( $paths as $path){
            if($path == $type_url){
                $path = $path.'/'.$service_root;
                $tmp = getfiles( $path );
                if($tmp){
                    $files = array_merge($files,$tmp);
                } 
            }
        }
        if ( !count($files) ) return;
        rsort($files,SORT_STRING);
        $str = "";
        foreach ( $files as $file ) {
            $str .= $file . "ue_separate_ue";
        }
        echo $str;
    }

    /**
     * 遍历获取目录下的指定类型的文件
     * @param $path
     * @param array $files
     * @return array
     */
    function getfiles( $path , &$files = array() )
    {
        if ( !is_dir( $path ) ) return null;
        $handle = opendir( $path );
        while ( false !== ( $file = readdir( $handle ) ) ) {
            if ( $file != '.' && $file != '..' ) {
                $path2 = $path . '/' . $file;
                if ( is_dir( $path2 ) ) {
                    getfiles( $path2 , $files );
                } else {
                    if ( preg_match( "/\.(gif|jpeg|jpg|png|bmp)$/i" , $file ) ) {
                        $files[] = $path2;
                    }
                }
            }
        }
        return $files;
    }
