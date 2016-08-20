<?php
/**
* Plugin Name: What The Template
* Version: 1.0
* Description: This plugin shows what template file is being used for a page in the admin overview
* Author: Kevin van Hengst
* Author URI: http://www.kevinvanhenget.nl
*/

if( !class_exists('WhatTheTemplate') ):

class WhatTheTemplate {

  function __construct() {

    add_filter( 'manage_pages_columns', array( $this, 'wtt_page_template_column') );
    add_action( 'manage_pages_custom_column', array( $this, 'wtt_fill_template_column') );

  }

  // Add template column to admin page overview
  static function wtt_page_template_column( $columns ) {

    $template_column = array(
      'template' => __( 'Template', 'Aternus' )
    );
    $columns = array_merge( $columns, $template_column );

    return $columns;

  }

  // Fill the template column with template name
  static function wtt_fill_template_column( $column ) {

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

}

function what_the_template_initializer(){

  global $wtt;
  
  if( !isset($wtt) )
  {
    $wtt = new WhatTheTemplate();
  }
  
  return $wtt;

}

// initialize WhatTheTemplate
what_the_template_initializer();

endif;

?>
