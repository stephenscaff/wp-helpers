<?php
/**
 * Disable Single View
 *
 * Adds a Menu Item for custom post types to add options page fields.
 *
 * @author    Stephen Scaff
 * @package   INC
 * @version   1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Bail if accessed directlyfunction jumpoff_disable_single_cpt_views() {

add_action( 'template_redirect', 'jumpoff_no_single_cpt_views' );

function jumpoff_no_single_cpt_views() {

  $queried_post_type = get_query_var('post_type');

  // Add cpts here and they'll redirect to their archives
  $cpts_without_single_views = array( 'events', 'company_sections' );
  
  if ( is_single() && in_array( $queried_post_type, $cpts_without_single_views )  ) {
    wp_redirect( home_url( '/' . $queried_post_type . '/' ), 301 );
    exit;
  }
}