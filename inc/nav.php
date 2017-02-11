<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/**
 *  Gets page link.
 *  For use with custom navigations
 *   
 *  @param     string $page_name
 *  @return    string 'is-active';
 *  @example   <a href="<?php echo jumpoff_page_url('home') ?>">Home</a>
 *  @example   <a href="<?php echo jumpoff_page_url('where to buy') ?>">Where to Buy</a>
 *  @example   <a href="<?php echo jumpoff_page_url('posttype', 1) ?>">Post Type</a>
 */
function jumpoff_page_url($page_name, $cpt=''){
  if ($cpt == true) {
    $page_url = esc_url( get_post_type_archive_link($page_name) );
  } else {
    $page_url = esc_url( get_permalink( get_page_by_title( $page_name ) ) );
  }
  return $page_url;
}


/**
 *  Nav Active Class.
 *  Adds 'is-active' class, outside of the wp nav
 *
 *  @param    string $page_name
 *  @return   string 'is-active';
 *  @example   <a class="<?php echo jumpoff_active_page('about'); ?>" href="">About</a>
 */
function jumpoff_active_page($page_name){
  if (is_page( $page_name ) || is_post_type_archive($page_name)) {
    return 'is-active';
  }
}
