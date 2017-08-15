<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @description CI图像处理类库扩展类，用以实现实际业务逻辑
 * @author		yanyl
 */
class MY_Image_lib extends CI_Image_lib{

    public function __construct(){
        parent::__construct();
    }
    /**
     *author:yanyl
     *description:修剪图片
     *param:$x:左侧修剪实际像素
     *param:$y:上侧修剪实际像素
     *param:$w:裁切后图片实际宽度
     *param:$h:裁切后图片实际高度
     **/
    public function img_crop($source_img,$x,$y,$cutwidth,$cutheight){
        $imginfo = getimagesize($source_img);
        $config['source_image'] = $source_img;
        $config['x_axis'] = $x;
        $config['y_axis'] = $y; 
        $config['width'] = $cutwidth;
        $config['height'] = $cutheight;
        $config['image_library'] = 'gd2';
        $config['maintain_ratio'] =false;
        $this->initialize($config);
        if(!$this->crop()){
            return false;
        }else{
            return $source_img;
        }
    }

    //等比缩放裁切
    function resizeimage($sourceimg,$toimg,$towidth,$toheight=''){
        $imginfo = getimagesize($sourceimg);
        $config['image_library'] = 'gd2';
        $config['source_image'] = $sourceimg;
        $config['maintain_ratio'] = TRUE;
        $config['new_image'] = $toimg;
        if($toheight!=''){
            $config['width'] = $towidth;
            $config['height'] = $toheight;
            //根据宽高缩放比例判断缩放依赖主轴，以比例低的为准
            if(($imginfo['0']/$towidth)>($imginfo['1']/$toheight)){
                $config['master_dim'] = 'height';
            }else{
                $config['master_dim'] = 'width';
            }
        }else{
            $config['master_dim'] = 'width';
            $config['width'] = $towidth;
            $config['height']= $imginfo[1]/($imginfo[0]/$towidth);	
        }
        $this->initialize($config);
        if($this->resize()){
            //$this->img_rotation($sourceimg,90);
            if($toheight!=''){
                $config['maintain_ratio'] = FALSE;
                $config['source_image'] = $config['new_image'];
                $thumb_info = getimagesize($config['new_image']);
                //新图片切割坐标
                if($thumb_info[0]>=$thumb_info[1]){
                    $cutwidth = ($thumb_info[0]-$towidth)/2;
                    $cutheight = 0;
                }else{
                    $cutheight = ($thumb_info[1]-$toheight)/2;
                    $cutwidth = 0;
                }
                $this->initialize($config);
                $cropflag = $this->img_crop($config['new_image'],$cutwidth,$cutheight,$towidth,$toheight);
                if($cropflag==false){
                    return false;
                }else{
                    return true;
                }
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
    //对上传的系列商品图像进行缩略图处理
    public function goods_thumb($sourceimg,$timedir){
        $this->CI = &get_instance();
        $this->CI->config->load('uploads');
        $imgname = basename($sourceimg);
        $thumb_config = $this->CI->config->item('ServiceSeriesGoodsThumb');
        $imginfo = getimagesize($sourceimg);
        $thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$timedir.$imgname,$thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y']); 	
        if($thumb_1==true){
            $thumb_2 = $this->resizeimage($sourceimg,$thumb_config['thumb_2'].$timedir.$imgname,$thumb_config['thumb_size_2_x'],$thumb_config['thumb_size_2_y']); 	
            if($thumb_2==true){
                $thumb_3 = $this->resizeimage($sourceimg,$thumb_config['thumb_3'].$timedir.$imgname,$thumb_config['thumb_size_3_x'],$thumb_config['thumb_size_3_y']); 	
                if($thumb_3==true){
                    $thumb_4 = $this->resizeimage($sourceimg,$thumb_config['thumb_4'].$timedir.$imgname,$thumb_config['thumb_size_4_x'],$thumb_config['thumb_size_4_y']); 	
                    if($thumb_4==true){
                        chmod($sourceimg,0644);
                        chmod($thumb_config['thumb_1'].$timedir.$imgname,0644);
                        chmod($thumb_config['thumb_2'].$timedir.$imgname,0644);
                        chmod($thumb_config['thumb_3'].$timedir.$imgname,0644);
                        chmod($thumb_config['thumb_4'].$timedir.$imgname,0644);
                        return true;
                    }else{
                        unlink($sourceimg);
                        unlink($thumb_config['thumb_1'].$timedir.$imgname);
                        unlink($thumb_config['thumb_2'].$timedir.$imgname);
                        unlink($thumb_config['thumb_3'].$timedir.$imgname);
                        return false;
                    }
                }else{
                    unlink($sourceimg);
                    unlink($thumb_config['thumb_1'].$timedir.$imgname);
                    unlink($thumb_config['thumb_2'].$timedir.$imgname);
                    return false;
                    return false;
                }                
            }else{
                unlink($sourceimg);
                unlink($thumb_config['thumb_1'].$timedir.$imgname);
                return false;
                return false;
            }
        }else{
            unlink($sourceimg);
            return false;
        }				
    }
    //幻灯片图片裁切
    public function service_flash_thumb($sourceimg,$timedir){
        $this->CI = &get_instance();
        $this->CI->config->load('uploads');
        $imgname = basename($sourceimg);
        $thumb_config = $this->CI->config->item('serviceFlash');
        $imginfo = getimagesize($sourceimg);
        $thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$timedir.$imgname,$thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y']); 	
        if($thumb_1==true){
            $thumb_2 = $this->resizeimage($sourceimg,$thumb_config['thumb_2'].$timedir.$imgname,$thumb_config['thumb_size_2_x'],$thumb_config['thumb_size_2_y']); 	
            if($thumb_2==true){
                chmod($sourceimg,0644);
                chmod($thumb_config['thumb_1'].$timedir.$imgname,0644);
                chmod($thumb_config['thumb_2'].$timedir.$imgname,0644);
                return true;
            }                
        }else{
            unlink($sourceimg);
            return false;
        }				
    }
    //门店图片图片裁切
    public function shop_thumb($sourceimg,$timedir){
        $this->CI = &get_instance();
        $this->CI->config->load('uploads');
        $imgname = basename($sourceimg);
        $thumb_config = $this->CI->config->item('serviceShop');
        $imginfo = getimagesize($sourceimg);
        $thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$timedir.$imgname,$thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y']); 	
        if($thumb_1==true){
            $thumb_2 = $this->resizeimage($sourceimg,$thumb_config['thumb_2'].$timedir.$imgname,$thumb_config['thumb_size_2_x'],$thumb_config['thumb_size_2_y']); 	
            if($thumb_2==true){
                $thumb_3 = $this->resizeimage($sourceimg,$thumb_config['thumb_3'].$timedir.$imgname,$thumb_config['thumb_size_3_x'],$thumb_config['thumb_size_3_y']); 	
                if($thumb_3==true){
                    $thumb_4 = $this->resizeimage($sourceimg,$thumb_config['thumb_4'].$timedir.$imgname,$thumb_config['thumb_size_4_x'],$thumb_config['thumb_size_4_y']); 	
                    if($thumb_4==true){
                        chmod($sourceimg,0644);
                        chmod($thumb_config['thumb_1'].$timedir.$imgname,0644);
                        chmod($thumb_config['thumb_2'].$timedir.$imgname,0644);
                        chmod($thumb_config['thumb_3'].$timedir.$imgname,0644);
                        chmod($thumb_config['thumb_4'].$timedir.$imgname,0644);
                        return true;
                    }else{
                        unlink($sourceimg);
                        unlink($thumb_config['thumb_1'].$timedir.$imgname);
                        unlink($thumb_config['thumb_2'].$timedir.$imgname);
                        unlink($thumb_config['thumb_3'].$timedir.$imgname);
                        return false;
                    }
                }else{
                    unlink($sourceimg);
                    unlink($thumb_config['thumb_1'].$timedir.$imgname);
                    unlink($thumb_config['thumb_2'].$timedir.$imgname);
                    return false;
                    return false;
                }                
            }else{
                unlink($sourceimg);
                unlink($thumb_config['thumb_1'].$timedir.$imgname);
                return false;
                return false;
            }
        }else{
            unlink($sourceimg);
            return false;
        }				
    }
    //服务商图文采编图片裁切
    public function information_thumb($sourceimg,$timedir){
        $this->CI = &get_instance();
        $this->CI->config->load('uploads');
        $imgname = basename($sourceimg);
        $thumb_config = $this->CI->config->item('serviceInformation');
        $imginfo = getimagesize($sourceimg);
        $thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$timedir.$imgname,$thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y']); 	
        if($thumb_1==true){
            $thumb_2 = $this->resizeimage($sourceimg,$thumb_config['thumb_2'].$timedir.$imgname,$thumb_config['thumb_size_2_x'],$thumb_config['thumb_size_2_y']); 	
            if($thumb_2==true){
                $thumb_3 = $this->resizeimage($sourceimg,$thumb_config['thumb_3'].$timedir.$imgname,$thumb_config['thumb_size_3_x'],$thumb_config['thumb_size_3_y']); 	
                if($thumb_3==true){
                    $thumb_4 = $this->resizeimage($sourceimg,$thumb_config['thumb_4'].$timedir.$imgname,$thumb_config['thumb_size_4_x'],$thumb_config['thumb_size_4_y']); 	
                    if($thumb_4==true){
                        chmod($sourceimg,0644);
                        chmod($thumb_config['thumb_1'].$timedir.$imgname,0644);
                        chmod($thumb_config['thumb_2'].$timedir.$imgname,0644);
                        chmod($thumb_config['thumb_3'].$timedir.$imgname,0644);
                        chmod($thumb_config['thumb_4'].$timedir.$imgname,0644);
                        return true;
                    }else{
                        unlink($sourceimg);
                        unlink($thumb_config['thumb_1'].$timedir.$imgname);
                        unlink($thumb_config['thumb_2'].$timedir.$imgname);
                        unlink($thumb_config['thumb_3'].$timedir.$imgname);
                        return false;
                    }
                }else{
                    unlink($sourceimg);
                    unlink($thumb_config['thumb_1'].$timedir.$imgname);
                    unlink($thumb_config['thumb_2'].$timedir.$imgname);
                    return false;
                    return false;
                }                
            }else{
                unlink($sourceimg);
                unlink($thumb_config['thumb_1'].$timedir.$imgname);
                return false;
                return false;
            }
        }else{
            unlink($sourceimg);
            return false;
        }				
    }
    //服务商商品优惠套餐图片裁切
    public function goods_match_thumb($sourceimg,$timedir){
        $this->CI = &get_instance();
        $this->CI->config->load('uploads');
        $imgname = basename($sourceimg);
        $thumb_config = $this->CI->config->item('serviceGoodsMatch');
        $imginfo = getimagesize($sourceimg);
        $thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$timedir.$imgname,$thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y']); 	
        if($thumb_1==true){
            $thumb_2 = $this->resizeimage($sourceimg,$thumb_config['thumb_2'].$timedir.$imgname,$thumb_config['thumb_size_2_x'],$thumb_config['thumb_size_2_y']); 	
            if($thumb_2==true){
                $thumb_3 = $this->resizeimage($sourceimg,$thumb_config['thumb_3'].$timedir.$imgname,$thumb_config['thumb_size_3_x'],$thumb_config['thumb_size_3_y']); 	
                if($thumb_3==true){
                    $thumb_4 = $this->resizeimage($sourceimg,$thumb_config['thumb_4'].$timedir.$imgname,$thumb_config['thumb_size_4_x'],$thumb_config['thumb_size_4_y']); 	
                    if($thumb_4==true){
                        chmod($sourceimg,0644);
                        chmod($thumb_config['thumb_1'].$timedir.$imgname,0644);
                        chmod($thumb_config['thumb_2'].$timedir.$imgname,0644);
                        chmod($thumb_config['thumb_3'].$timedir.$imgname,0644);
                        chmod($thumb_config['thumb_4'].$timedir.$imgname,0644);
                        return true;
                    }else{
                        unlink($sourceimg);
                        unlink($thumb_config['thumb_1'].$timedir.$imgname);
                        unlink($thumb_config['thumb_2'].$timedir.$imgname);
                        unlink($thumb_config['thumb_3'].$timedir.$imgname);
                        return false;
                    }
                }else{
                    unlink($sourceimg);
                    unlink($thumb_config['thumb_1'].$timedir.$imgname);
                    unlink($thumb_config['thumb_2'].$timedir.$imgname);
                    return false;
                    return false;
                }                
            }else{
                unlink($sourceimg);
                unlink($thumb_config['thumb_1'].$timedir.$imgname);
                return false;
                return false;
            }
        }else{
            unlink($sourceimg);
            return false;
        }				
    }
    //对上传的系列像进行缩略图处理
    public function series_thumb($sourceimg,$timedir){
        $this->CI = &get_instance();
        $this->CI->config->load('uploads');
        $imgname = basename($sourceimg);
        $thumb_config = $this->CI->config->item('serviceBrandSeries');
        $imginfo = getimagesize($sourceimg);
        $thumb_1 = $this->resizeimage($sourceimg,$thumb_config['thumb_1'].$timedir.$imgname,$thumb_config['thumb_size_1_x'],$thumb_config['thumb_size_1_y']); 	
        if($thumb_1==true){
            $thumb_2 = $this->resizeimage($sourceimg,$thumb_config['thumb_2'].$timedir.$imgname,$thumb_config['thumb_size_2_x'],$thumb_config['thumb_size_2_y']); 	
            if($thumb_2==true){
                $thumb_3 = $this->resizeimage($sourceimg,$thumb_config['thumb_3'].$timedir.$imgname,$thumb_config['thumb_size_3_x'],$thumb_config['thumb_size_3_y']); 	
                if($thumb_3==true){
                    $thumb_4 = $this->resizeimage($sourceimg,$thumb_config['thumb_4'].$timedir.$imgname,$thumb_config['thumb_size_4_x'],$thumb_config['thumb_size_4_y']); 	
                    if($thumb_4==true){
                        chmod($sourceimg,0644);
                        chmod($thumb_config['thumb_1'].$timedir.$imgname,0644);
                        chmod($thumb_config['thumb_2'].$timedir.$imgname,0644);
                        chmod($thumb_config['thumb_3'].$timedir.$imgname,0644);
                        chmod($thumb_config['thumb_4'].$timedir.$imgname,0644);
                        return true;
                    }else{
                        unlink($sourceimg);
                        unlink($thumb_config['thumb_1'].$timedir.$imgname);
                        unlink($thumb_config['thumb_2'].$timedir.$imgname);
                        unlink($thumb_config['thumb_3'].$timedir.$imgname);
                        return false;
                    }
                }else{
                    unlink($sourceimg);
                    unlink($thumb_config['thumb_1'].$timedir.$imgname);
                    unlink($thumb_config['thumb_2'].$timedir.$imgname);
                    return false;
                    return false;
                }                
            }else{
                unlink($sourceimg);
                unlink($thumb_config['thumb_1'].$timedir.$imgname);
                return false;
                return false;
            }
        }else{
            unlink($sourceimg);
            return false;
        }				
    }
}	
