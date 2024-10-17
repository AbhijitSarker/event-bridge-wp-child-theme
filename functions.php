<?php 

//these are my theme  functions


//theme title
add_theme_support( 'title-tag' );


//theme css and jquery file calling
function eb_css_js_file_calling(){
  wp_enqueue_style( 'eb-style', get_stylesheet_uri());

  wp_register_style( 'bootsrtap', get_template_directory_uri(  ).'/css/bootstrap.css', array(), 'v5.3.3', 'all');
  wp_register_style( 'custom', get_template_directory_uri(  ).'/css/custom.css', array(), 'v1.0.0', 'all');
  
  wp_enqueue_style( 'bootsrtap' );
  wp_enqueue_style( 'custom' );

  // //jquery
  wp_enqueue_script( 'jquery', get_template_directory_uri(  ).'/js/bootstrap.js', array(), 'v5.3.3', true );
  wp_enqueue_script( 'main', get_template_directory_uri(  ).'/js/min.js', array(), 'v1.0.0', true );

}
add_action( 'wp_enqueue_scripts', 'eb_css_js_file_calling' );