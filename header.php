<!DOCTYPE html> <!-- начало 3 урока 18:44, скорость 1.4 -->
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Universal</title>
  <?php wp_head(  ); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="header">
  <div class="container">
    <div class="header-wrapper">
      <?php 
        if( has_custom_logo() ){
          the_custom_logo();
        } else {
          echo 'Uni Theme';
        }
      ?>
      <?php 
        wp_nav_menu( [
          'theme_location'  => 'header_menu',
          'container'       => 'nav', 
          'container_class' => 'header-nav', 
          'menu_class'      => 'header-menu', 
          'echo'            => true,
        ] );
      ?>
      <?php get_search_form(); ?>
    </div>
    <!-- /.header-wrapper -->
  </div>
</header>