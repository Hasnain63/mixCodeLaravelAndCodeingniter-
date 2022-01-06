<?php

  function resizeImage($source_path,$new_path,$width,$hight){
      $CI =& get_instance();
    $config['image_library'] = 'gd2';
    $config['source_image'] = $source_path;
    $config['new_image'] = $new_path;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['max_width'] =$width;
    $config['max_height'] = $hight;
    
    $CI->load->library('image_lib', $config);
    $CI->image_lib->resize();
    $CI->image_lib->clear();
}