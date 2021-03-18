    <footer class="footer">
      <div class="container">
        <div class="footer-menu-bar">
          <?php dynamic_sidebar( 'sidebar-footer' ); ?>
        </div>
        <!-- /.footer-menu-bar -->
        <div class="footer-info">
          <?php 
            wp_nav_menu( [
              'theme_location'  => 'footer_menu',
              'container'       => 'nav', 
              'menu_class'      => 'footer-nav', 
              'echo'            => true,
            ] );        

            $instance = array (
              'title' => '',
              'link1' => 'http:/facebook.com',
              'link2' => 'http:/instagram.com',
              'link3' => 'http:/vkontakte.com',
              'link4' => 'http:/twitter.com'                         
            );
            $args = array (
              'before_widget' => '<div class="footer-social">',
              'after_widget' => '</div>',
            );
            the_widget( 'Social_Widget', $instance, $args );
          ?>
        </div>
        <!-- /.footer-info -->
        <?php 
        if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
          return;
        }
        ?>
        <div class="footer-text-wrapper">
          <?php dynamic_sidebar( 'sidebar-footer-text' ); ?>
          <span class="footer-copyright"><?php echo date('Y') . ' &copy; ' . get_bloginfo( 'name' );?></span>
          <!-- /.footer-copyright -->
        </div>
        <!-- /.footer-text-wrapper -->
      </div>
      <!-- /.container -->
    </footer>
  <?php wp_footer();?>
</body>
</html>