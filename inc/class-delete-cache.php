<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Delete Super Cache
 * Since Super Caceh doesn't seem to have an optin to delte cache
 * on post save, let's make one.
 *  
 * @todo build a toolbar button for easy access
 */
if (!class_exists('DeleteSuperCache')) {
  
  class DeleteSuperCache {
    // constructor for our save_post filter
    function __construct() {
      add_action( 'save_post', array( $this, 'delete_cache' ) );
    }

    public function delete_cache() {
      if ( function_exists( 'wp_cache_clean_cache' ) ){
        global $file_prefix;
        wp_cache_clean_cache( $file_prefix );
      }  
    }
  }
}

// Init Class
new DeleteSuperCache;