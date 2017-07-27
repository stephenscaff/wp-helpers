<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/** 
 *  jumpoff_body_class
 *  Cleans up body classes, then adds custom, based on page or cpt names
 *  @return: $classes (string)
 */

add_filter('body_class', 'jumpoff_body_class');

function jumpoff_body_class($classes) {
  global $post, $page;

  // Get post type name
  $post_type_name = get_post_type();

  if (is_single() || is_page() && !is_front_page()) {
    $classes[] = 'page-'.basename(get_permalink());
  }
  if (is_home() || is_singular('post') || is_post_type_archive( 'post' )) {
    $classes[] = 'page-blog';
  }

  if (is_post_type_archive( )){
    $classes[] = 'page-'.$post_type_name;
  }

  if ($page_theme) {
    $classes[] = $page_theme;
  }

  // Remove Classes
  $home_id_class = 'page-id-' . get_option('page_on_front');
  $page_id_class = 'page-id-' . get_the_ID();
  $post_id_class = 'postid-' . get_the_ID();
  $page_template_name_class = 'page-template-page-' . basename(get_permalink());
  $page_template_name_php = 'page-template-page-' . basename(get_permalink()) . '-php';
 
  // Remove Classes Array
  $remove_classes = array(
    'page-template-default', 
    'page-template', 
    'single-format-standard',
    $home_id_class,
    $page_id_class,
    $post_id_class,
    $page_template_name_class,
    $page_template_name_php
  );

  // Add specific classes
  //$classes[] = 'page-is-loaded';

  // All together now
  $classes = array_diff($classes, $remove_classes);

  return $classes;
}




/** 
 *  Admin Body Class
 *  Adds an admin body class that we can use to 
 *  hide or target elements with css
 *
 *  @return: string $classes
 */
function jumpoff_admin_body_class( $classes ){ 

  global $post;

  if( !is_object($post) ) 
    return;
  
  // Make sure we're getting $post object
  setup_postdata( $post );

  // Returns an object that includes the screen’s ID, base, post type, taxonomy
  // @see https://developer.wordpress.org/reference/functions/get_current_screen
  $screen = get_current_screen();

  // Construct class form the post_name
  $page_name = 'admin-'.$post->post_name;
  
  // Construct class from post id
  $post_id = 'admin-post-'.$post->ID;
  
  // If post
  if ( 'post' == $screen->base ) {
    $classes .= ' ' . $screen->post_type . ' ' . $post_id . ' ' . $page_name;
  }

  // if default page.php
  if(basename(get_page_template()) === 'page.php'){
    $classes .= ' admin-page';
  }
  
  // Return our admin classes
  return $classes;
  
  // Reset
  wp_reset_postdata( $post );
}

add_filter( 'admin_body_class', 'jumpoff_admin_body_class' );
