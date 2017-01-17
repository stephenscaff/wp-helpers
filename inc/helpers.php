<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/** 
 *   Get Slug
 *   Get category by page slug. Used for passing as var in `get_posts args
 *   @return $slug
 *   @example:
 *    if ( is_home() ) {
 *      $slug = null;
 *    } else {
 *      $slug = jumpoff_slug();
 *    }  
 */
function jumpoff_get_slug() {
  global $post;
  $slug = get_post( $post )->post_name;
  return $slug;
}


/** 
 *  Is Post Type
 *  Adds is_post_type conditional.
 *
 *  @param: $type (string)
 *  @return boolean (ture if is specified post_type)
 */
function is_post_type( $type ){
  global $wp_query;
  
  if($type == get_post_type($wp_query->post->ID)){
    return true;
  } 
  return false;
}