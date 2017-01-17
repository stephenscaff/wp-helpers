<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/**
 *  Featured Image helper with fallbacks
 *
 *  1. Get Ft Image
 *  2. Get Post attachement
 *  3. Get First image in post content
 *  4. Get fallbacks
 *  
 * @param   $size (array|string) : images size - ie; full, medium, small)
 * @param   $id   (string) :       image id
 * @return  $related_img;
 */ 

function jumpoff_ft_img($size, $post_id = '') {
  
  global $post, $posts;

  // Allow loading posts by ID instead of relying on global $post/loop
  if ($post_id) { 
    $post = get_post($post_id); 
  }

  // Read featured image data for image url.
  $image_id = get_post_thumbnail_id();

  // Get image src of attached image
  // @see https://developer.wordpress.org/reference/functions/wp_get_attachment_image_src/
  $attached_to_post = wp_get_attachment_image_src( get_post_thumbnail_id(), $size, false);
  
  // Set attached image as the returned related image.
  $related_img =  $attached_to_post[0];                         

  // Check Post for image attachments
  if ($related_img == "") {
    
    $attachments = get_children( array(
      'post_parent'    => get_the_ID(),
      'post_type'      => 'attachment',
      'numberposts'    => 1, 
      'post_status'    => 'inherit',
      'post_mime_type' => 'image',
      'order'          => 'ASC',
      'orderby'        => 'menu_order ASC'
    ));
    
    // If we found attached image
    if(!empty($attachments)) {

      // Loop through attachments
      foreach ( $attachments as $attachment_id => $attachment ) {
         
         if (wp_get_attachment_image($attachment_id) != "") {

          // Set attched image as related image
          $related_img = wp_get_attachment_url( $attachment_id );
        }                       
      }  
    } else { 
      // If no ft image set, let's get the first image within post 
      $first_img = '';
      ob_start();
      ob_end_clean();

      // Find that shit
      if( $output = preg_match_all('/<img.+src=\'"[\'""].*>/i', $post->post_content, $matches) ) {
        $first_img = $matches[1][0];
      }

      // If we have a first image
      if(!empty($first_img)) {

        // Set first image found as related image
        $related_img = $first_img;
      
      } else {
        
        // Get dir
        $template_dir = get_bloginfo('template_directory');

        // Array of fallback images to deliver randomly
        $random_no_images = array(
          'placeholder-1.jpg', 
          'placeholder-2.jpg', 
          'placeholder-3.jpg', 
        );

        // Randomize array of fallbacks
        $random_number = array_rand($random_no_images);
        $random_image = $random_no_images[$random_number];

        // Set placeholder path for out random fallbacks
        $related_img = $template_dir."/assets/images/placeholders/$random_image";  
      }
    }   
  }  
  // return our image
  return $related_img;
}