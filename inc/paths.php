<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/** 
 *  Image path
 *  An image path helper that gets template path of images
 *
 *  @example <img src="<?php echo jumpoff_img(); ?>/my-img.jpg">
 */
function jumpoff_img(){
  $template_path = bloginfo('template_directory');
  $img_path = $template_path . '/assets/images';
  return $img_path;
}

/** 
 *  Get Assets Path
 *  An asset path helper that gets template path at /assets
 *  
 *  @example <video src="<?php jumpoff_path(); ?>/videos/vide.mp4">
 */
function jumpoff_path(){
  $template_path = bloginfo('template_directory');
  $path = $template_path . '/assets';
  return $path;
}

/** 
 *  Get SVG Path
 *  An asset path helper that gets template path for 
 *  svgs, stored at 'assets/images/svg/'
 *
 *  Make sure to rename your svg with a .php ext
 *
 *  @example <?php echo jumpoff_svg('my-svg'); ?>
 */
function jumpoff_svg($svg){
  $get_svg = get_template_part( 'assets/images/svgs/' . $svg);
  return $get_svg;
}
