<?php
/**
* Plugin Name: What The Template
* Version: 1.0
* Description: This plugin shows what template file is being used for a page in the admin overview
* Author: Kevin van Hengst
* Author URI: http://www.kevinvanhenget.nl
*/

// Add template column to admin page overview
function page_what_template_column( $columns ) {

  $template_column = array(
    'template' => __( 'Template', 'Aternus' )
  );
  $columns = array_merge( $columns, $template_column );

  return $columns;
}
add_filter( 'manage_pages_columns', 'page_what_template_column' );

// Fill the template column with template name
function fill_page_overview_template_column( $column ) {

  global $post;

  switch ( $column ) {
    case  'template' :
      if( get_page_template_slug( $post->ID ) ) {
        echo get_page_template_slug( $post->ID );
      } else {
        echo "Default Template";
      }
      break;
  }
}
add_action( 'manage_pages_custom_column', 'fill_page_overview_template_column' );
