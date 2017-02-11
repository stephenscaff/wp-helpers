<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/**
 *  jumpoff_text_limit
 *  
 *  Function to limit text length outputs. Used in functions below
 *
 *  @param int  $string Number of chars to output
 *  @param int  $length Desired char length
 *  @param string  $replacer
 *  @return $string
 */ 

function jumpoff_text_limit($string, $length, $replacer) {
  if(strlen($string) > $length)
  return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;
  return $string;
}


/**
 *  jumpoff_excerpt
 *
 *  Outputs a shortened get_the_excerpt via length arg (by char)
 *
 *  @todo     change this to a return
 *  @param    int  $characters Number of chars to outputv
 *  @param    string  $rep Ellipser
 *  @example  jumpoff_excerpt(100);
 * 
 */ 
function jumpoff_excerpt($characters, $rep='...') {
  $excerpt = get_the_excerpt('', '', false);
  $shortened_excerpt = jumpoff_text_limit($excerpt, $characters, $rep);
  echo $shortened_excerpt;
}


/**
 *  jumpoff_title
 *
 *  Outputs a shortened the_title via length arg (by char)
 *
 *  @param int  $characters Number of chars to output
 *  @param string  $rep Ellipser
 *  @return $shortened_title
 */ 
function jumpoff_title($characters, $rep='...') {
  
  // Get the title via wp's the_title
  $title = the_title('', '', false);
  
  // Run through our text limit funciton
  $shortened_title = jumpoff_text_limit($title, $characters, $rep);

  // Return 
  return $shortened_title;
}


/**
 *  Insert html5 style Image and Captions
 *  Wraps images in figure, captions in a figcap.
 *  Takes place in editor via image_send_to_editor
 *
 *  @param $html (array|string) : images size - ie; full, medium, small)
 *  @param $id (integer) : image id
 *  @param $caption (string) : gets from attachment editor caption field
 *  @param $align (string) : alignment class
 *  @param $url (string) : image path
 *  @param $size (string|array) (Optional) Image size. Accepts any valid image size, or an array of width and height values in pixels (in that order).
 *  @param $alt (string) : gets from attachment editor alt field
 *  @return $img_figure
 */ 
function jumpoff_html5_image($html, $id, $caption, $title, $align, $url, $size, $alt) {
  
  // Get image attachment src
  $src  = wp_get_attachment_image_src( $id, $size, false );
  
  // Create our figure wrap
  $img_figure = "<figure id='media-" .$id . "' class='align-" . $align . "'>";
  
  // Add our image
  $img_figure .= "<img src='" . $src[0] . "' alt='" . $alt . "' />";
  
  // If we have a caption, add that too
  if ($caption) {
    $img_figure .= "<figcaption>" . $caption ."</figcaption>";
  }
  // Close our figure sammie
  $img_figure .= "</figure>";

  // Return our final figure image
  return $img_figure;
}
add_filter( 'image_send_to_editor', 'jumpoff_html5_image', 10, 9 );


/**
 * Video Embeds
 * 
 * Uses embed filter to wrap video oEmbeds in our flex-vid class
 * for responsive videos.
 */ 
function jumpoff_vid_embed($html, $url, $attr, $post_id) {
  return '<div class="flex-vid">' . $html . '</div>';
}
add_filter('embed_oembed_html', 'jumpoff_vid_embed', 99, 4);
