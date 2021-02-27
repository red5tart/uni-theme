<?php
add_action( 'wp_enqueue_scripts', 'enqueue_unitheme_style' );
function enqueue_unitheme_style() {
  wp_enqueue_style( 'style', get_stylesheet_uri() );
  wp_enqueue_style( 'uni-theme', get_template_directory_uri(  ) . '/assets/css/uni-theme.css', 'style', null, null );
}