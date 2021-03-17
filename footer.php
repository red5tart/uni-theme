    <footer class="footer">
      <div class="container">
        <?php 
          if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
            return;
          }
          ?>
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
            ?>
          </div>
          <!-- /.footer-info -->
      </div>
      <!-- /.container -->
    </footer>
  <?php wp_footer();?>
</body>
</html>