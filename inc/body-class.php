<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/** 
 *  Body Class (front end)
 *  Cleans up body classes, then adds custom classes, based on page or cpt names
 *  @return: $classes (string)
 */
function jumpoff_body_class($classes) {
  global $post, $page;

  // If a single post or page and is not Front Page
  if (is_single() OR is_page() && !is_front_page()) {
    $classes[] = basename(get_permalink());
  }

  // If blog index, post, or archive
  if (is_home() OR is_singular('post') OR is_post_type_archive( 'post' )) {
    $classes[] = 'blog';
  }
  // If a Woocommerce page
  if (is_woocommerce() OR is_product() OR is_shop()) {
    $classes[] = 'shop';
  }

  // Example for CPTs
  if (is_singular('portfolio') OR is_post_type_archive( 'portfolio' )) {
    $classes[] = 'portfolio';
  }

  // Remove Classes
  $home_id_class = 'page-id-' . get_option('page_on_front');
  $page_id_class = 'page-id-' . get_the_ID();
  $post_id_class = 'postid-' . get_the_ID();
  $page_template_pagename = 'page-template-' . get_the_title();;
  $page_template_templates = 'page-template-page-templates';
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
    $page_template_pagename,
    $page_template_templates,
    $page_template_name_class,
    $page_template_name_php
  );

  // Add specific classes
  // $classes[] = 'my-class';

  // Compute array difference
  $classes = array_diff($classes, $remove_classes);
  
  return $classes;
}

add_filter('body_class', 'jumpoff_body_class');




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
