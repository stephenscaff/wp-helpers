<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 *  Categories List
 *  Returns cats wtih content to output as list
 *
 *  @return string $category_item
 */
function jumpoff_categories_list() {

  // Get Categories
  $categories = get_categories();

  // Cat Item
  $category_item = '';

  // Got Cats?
  if ( $categories ) {  
    
    // Loop through cats
    foreach ( $categories as $category ) {

      // If there was an error, continue to the next term.
      if ( is_wp_error( $categories ) ) {
        continue;
      }
      // Category Link
      $category_link = get_category_link( $category->term_id );

      // Category List Item
      $category_item .= '<li><a href="' . $category_link . '">' . $category->name . '</a></li>';
    }
    return $category_item;
  }
}


/**
 *  Single Post Categorey 
 *  Returns a post's cat (first in cat array)
 *  by name or it's archive url
 *  
 *  @param string $type ('name' or 'url') The cat's name or archive link 
 *  @return string $single_cat;
 */
function jumpoff_post_cat($type){
  
  global $post;
  
  // Get cats from post id
  $categories = get_the_category($post->ID);

  if ($categories){
    
    $single_cat = '';

    if ($type === 'name'){
      $single_cat = $categories[0]->cat_name;
    }

    if ($type === 'url'){
      $single_cat = esc_url( get_category_link( $categories[0]->term_id ) );
    }

    return $single_cat;
  }
} 

/**
 *  Get a Post's Term
 *  Gets the term of a given post, within a provided taxonomy
 *
 *  @param string $taxonomy The name of desired taxonomy 
 *  @return $term
 */
function jumpoff_post_term($taxonomy, $type) {

  global $post;
    
  // get_post_terms with post id and provided taxonomy.
  // @see: https://codex.wordpress.org/Function_Reference/wp_get_post_terms
  $terms = wp_get_post_terms($post->ID, $taxonomy);
  
  foreach ( $terms as $term ) {
    
    // If there was an error, continue to the next term.
    if ( is_wp_error( $term ) ) {
      continue;
    }
    // if name, get term name
    if ($type === 'name') {
      $term = $term->name;
    } 

    // or if 'url', get the term's archive link
    elseif ($type === 'url') {
      $term = esc_url( get_term_link($term) );
    }
  }
  return $term;
}
