<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<!-- шапка поста -->
	<header class="entry-header <?php echo get_post_type();?>-header" style="background: linear-gradient(0deg, rgba(38, 45, 51, 0.75), rgba(38, 45, 51, 0.75));">
    <div class="container">
      <div class="post-header-wrapper">
        <div class="post-header-nav">
          <?php
            foreach (get_the_category() as $category) {
              printf(
                '<a href="%s" class="category-link %s">%s</a>', 
                esc_url( get_category_link( $category ) ) , 
                esc_html( $category -> slug ),
                esc_html( $category -> name )
              );
            }
          ?>
        </div>
        <!-- /.post-header-nav -->
        <div class="video">
          <?php 
            $video_link = get_field('video_link');
            $pos1 = stripos($video_link, 'youtu');
            $pos2 = stripos($video_link, 'vimeo');
            if ($pos1 !== false) {
              ?>
              <iframe width="100%" height="450" src="https://www.youtube.com/embed/<?php
                $vid_id_yt = explode('?v=', get_field('video_link'));
                echo end($vid_id_yt);
                ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              <?php
              } elseif ($pos2 !== false) {
                ?>
                <div style="padding:54.69% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/<?php
                  $vid_id_vm = explode('com/', get_field('video_link'));
                  echo end($vid_id_vm);
                ?>?title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
                <?php
              } else {
                echo 'не та ссылка';
            }
          ?>
        </div>
        <div class="lesson-title-wrapper">
          <?php
          // проверяем, точно ли мы на странице поста
          if ( is_singular() ) :
            the_title( '<h1 class="lesson-title">', '</h1>' );
          else :
            the_title( '<h2 class="lesson-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
          endif;?>
        </div>
        <!-- /.post-title-wrapper -->
        <div class="post-header-info">
          <div class="post-header-date">
            <svg width="15" height="15" class="icon date-icon">
              <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#clock"></use>
            </svg>
            <?php the_time( 'j F, G:i' )?>
          </div>
        </div>
        <!-- /.post-header-info -->
      </div>
      <!-- /.post-header-wrapper -->
      </div>
    <!-- /.container -->
	</header><!-- .entry-header -->

  <div class="container">
    <!-- Содержимое поста -->
    <div class="post-content">
      <?php
      // выводим содержимое
      the_content(
        sprintf(
          wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'uni-example' ),
            array(
              'span' => array(
                'class' => array(),
              ),
            )
          ),
          wp_kses_post( get_the_title() )
        )
      );

      wp_link_pages(
        array(
          'before' => '<div class="page-links">' . esc_html__( 'Страницы:', 'uni-theme' ),
          'after'  => '</div>',
        )
      );
      ?>
    </div><!-- .post-content -->
    <!-- Подвал поста -->
    <footer class="post-footer">
      <?php 
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'uni-example' ) );
        if ( $tags_list ) {
          /* translators: 1: list of tags. */
          printf( '<span class="tags-links">' . esc_html__( '%1$s', 'uni-example' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
        // Поделиться в соцсетях
        meks_ess_share();
      ?>
    </footer><!-- .post-footer -->
  </div>
  <!-- /.container -->
</article> 