<?php
//Добавление расширенных возможностей
if ( ! function_exists( 'uni_theme_setup' ) ) :

  function uni_theme_setup() {
    // Добавление тэга title 
    add_theme_support( 'title-tag' );

    // Добавление пользовательского логотипа
    add_theme_support( 'custom-logo', [
      'width'       => 163,
      'flex-height' => true,
      'header-text' => 'Uni Theme',
      'unlink-homepage-logo' => false, // WP 5.5
    ] );

    // Регистрация меню
    register_nav_menus( [
      'header_menu' => 'Меню в шапке',
      'footer_menu' => 'Меню в подвале'
    ] );
  }
endif;
add_action( 'after_setup_theme', 'uni_theme_setup' );

//Подключение стилей и скриптов

function enqueue_unitheme_style() {
  wp_enqueue_style( 'style', get_stylesheet_uri() );
  wp_enqueue_style( 'uni-theme', get_template_directory_uri(  ) . '/assets/css/uni-theme.css', 'style');
}
add_action( 'wp_enqueue_scripts', 'enqueue_unitheme_style' );