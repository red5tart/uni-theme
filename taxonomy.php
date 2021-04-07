<?php get_header( )?>
<div class="container">
  <h1 class="taxonomy-title">
    <?php single_term_title()?>  
  </h1>
    <div class="post-list">
    <?php while ( have_posts() ){ the_post(); ?>
      <div class="post-card">
        <a href="<?php echo get_permalink(); ?>" >
        <img src="<?php         if( has_post_thumbnail() ) {
            echo get_the_post_thumbnail_url();
          }
          else {
            echo get_template_directory_uri().'/assets/images/img-default.png';
          } ?>" alt="" class="post-card-thumb">
        <div class="post-card-text">
          <h2 class="post-card-title"><?php echo mb_strimwidth(get_the_title(), 0, 40, '...'); ?></h2>
          <p><?php echo mb_strimwidth(get_the_excerpt(), 0, 90, '...'); ?></p>
          <div class="author">
            <?php $author_id = get_the_author_meta('ID') ?>
            <img src="<?php echo get_avatar_url($author_id) ?>" alt="" class="author-avatar">
            <div class="author-info">
              <span class="author-name"><strong><?php the_author() ?></strong></span>
              <span class="date"><?php the_time( 'j M' )?></span>
              <div class="comments">
                <svg width="15" height="15" class="icon comments-icon-white">
                  <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
                </svg>
                <span class="comments-counter">
                  <?php comments_number('0', '1', '%') ?>
                </span>
              </div>
                <!-- /.comments -->
              <div class="likes">
                <svg width="13" height="13" class="icon comments-icon-white">
                  <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#heart"></use>
                </svg>
                <span class="comments-counter">
                  <?php comments_number('0', '1', '%') ?>
                </span>
              </div>
              <!-- /.likes -->
            </div>
            <!-- /.author-info -->
          </div>
          <!-- /.author -->
        </div>
        <!-- /.post-card-text -->
        </a>
      </div>
      <!-- /.post-card -->
    <?php } ?>
    <?php if ( ! have_posts() ){ ?>
      Записей нет.
    <?php } ?>
  </div><!-- /.posts-list -->
    <?php 
      $args = array (
        'prev_text'          => __('
          <svg width="15" height="7" class="icon pagination-prev-icon">
            <use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#left-arrow"></use>
          </svg>
          Назад
        '),
        'next_text'          => __('
          Вперед
          <svg width="15" height="7" class="icon pagination-next-icon">
            <use xlink:href="' . get_template_directory_uri() . '/assets/images/sprite.svg#arrow"></use>
          </svg>
        '),
      );
    the_posts_pagination( $args ); ?>
</div>
<?php get_footer( )?>