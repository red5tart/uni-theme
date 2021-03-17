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
      </div>
      <!-- /.container -->
    </footer>
  <?php wp_footer();?>
</body>
</html>