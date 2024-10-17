<?php 

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


// Google Fonts Enqueue
function eb_add_google_fonts(){
  wp_enqueue_style('eb_google_fonts', 'https://fonts.googleapis.com/css2?family=Kaisei+Decol&family=Oswald&display=swap', false);
}
add_action('wp_enqueue_scripts', 'eb_add_google_fonts');


//Theme Function
function eb_customizar_register($wp_customize){
  $wp_customize->add_section('eb_header_area', array(
    'title' =>__('Header Area', 'EventBridge'),
    'description' => 'If you interested to update your header area, you can do it here.'
  ));

  $wp_customize->add_setting('eb_logo', array(
    'default' => get_bloginfo('template_directory') . '/img/logo.png',
  ));

  $wp_customize-> add_control(new WP_Customize_Image_Control($wp_customize, 'eb_logo', array(
    'label' => 'Logo Upload',
    'description' => 'If you interested to change or update your logo you can do it.',
    'setting' => 'eb_logo',
    'section' => 'eb_header_area',
  ) ));

  // Menu Position Option
  $wp_customize->add_section('eb_menu_option', array(
    'title' => __('Menu Position Option', 'EventBridge'),
    'description' => 'If you interested to change your menu position you can do it.'
  ));

  $wp_customize->add_setting('eb_menu_position', array(
    'default' => 'right_menu',
  ));

  $wp_customize-> add_control('eb_menu_position', array(
    'label' => 'Menu Position',
    'description' => 'Select your menu position',
    'setting' => 'eb_menu_position',
    'section' => 'eb_menu_option',
    'type' => 'radio',
    'choices' => array(
      'left_menu' => 'Left Menu',
      'right_menu' => 'Right Menu',
      'center_menu' => 'Center Menu',
    ),
  ));

}
add_action('customize_register', 'eb_customizar_register');


// Menu Register
register_nav_menu( 'main_menu', __('Main Menu', 'EventBridge') );


function eb_nav_description( $item_output, $item, $args ) {
  // Check if link_after exists and is not null; otherwise provide a default value
  $link_after = isset($args->link_after) ? $args->link_after : '';

  if ( !empty($item->description) ) {
      // Use the safe version of link after in str_replace
      $item_output = str_replace($link_after . '</a>', '<span class="walker_nav">' . esc_html($item->description) . '</span>' . $link_after . '</a>', $item_output);
  }
  
  return $item_output;
}
add_filter('walker_nav_menu_start_el', 'eb_nav_description', 10, 3);