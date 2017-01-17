<?php

/**
 *  jumpoff_get_posts();
 *
 *  Modular Get Posts Function
 *
 *  @param    string  $post_cat     Category-nicename or null for all posts)
 *  @param    int     $num_posts    Number of posts to show
 *  @param    string  $content_type File name for content, ie; 'posts' = partials/content/content-posts
 *  @example  jumpoff_get_posts('category-name', 7) or jumpoff_get_posts(null, 7) 
 *  @return   $posts
 */ 

function jumpoff_get_posts($post_cat, $num_posts, $content_type){
  global $post ; 

  $args = array(
   'posts_per_page'   => $num_posts,
   'offset'           => 0,
   'category_name'    => $post_cat,
  );

  $posts = get_posts( $args );

  foreach ( $posts as $post ) : setup_postdata( $post );
   
   // Get template form partials/content/content-category-featured
   // Change as needed
   get_template_part( 'partials/content/content', $content_type );

  endforeach;
  
  wp_reset_postdata();

  return $posts;
}

/**
 *  jumpoff_cpts()
 *
 *  Get Posts by custom post type
 *
 *  @param    string $post_type The Post Type
 *  @param    int  $num_posts  Number of posts. use -1 for all.
 *  @param    string  $content_type Content loop file name (all are prefixed with 'content-'')
 *  @example  jumpoff_cpts('team', '10', 'team')
 *  @return   $posts
 */ 

function jumpoff_cpts($post_type, $num_posts, $content_type){
  global $post ; 

  $args = array(
    'posts_per_page'   => $num_posts,
    'post_type'        => $post_type,
    'orderby'          => 'date',
    'order'            => 'DESC',
  );

  foreach ( $posts as $post ) : setup_postdata( $post );
    // Get template in dir partials/content/content
    // Assumes template names are like 'content-posts'
    get_template_part( 'partials/content/content', $content_type );
  
  endforeach;
  
  wp_reset_postdata();

  return $posts;
}