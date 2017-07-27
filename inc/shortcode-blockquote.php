<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directly

/**
 * BlockquoteShortcode
 * Shortcode for creating blockquotes
 *
 * @example   [bquote format="long" cite="Carlos Danger"]
 * @see theme-glossary for details
 */
if (!class_exists('BlockquoteShortcode')) {

  class BlockquoteShortcode {

    // Constructor
    public function __construct() {
      add_shortcode('quote',  array($this, 'shortcode_output'));
    }

    // Output
    public function shortcode_output( $atts, $content = null )  {

      extract(shortcode_atts(array(
      'class'        => '',
      'cite'       => '',
      ), $atts));
  
      // Vars

      if ($class) {
        $class = $atts['class'];
      }
      // Cite
      if($cite){
        $cite = '<cite>' . $atts['cite'] . '</cite>'; 
      } 

      // Outputs
      $output = '<blockquote class="'. $class .'">' . $content . $cite . '</blockquote>';
      //$output = str_replace(array('<br />', '<br/>', '<br>', '<br>'), array('', '', '', ''), $output);
      $output = str_replace('<br>', '', $output);
      $output = wpautop($output);
      return $output;
    }
  }
}
// INIT Class
new BlockquoteShortcode();