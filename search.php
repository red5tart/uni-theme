<?php get_header( );?> 
<div class="container">
  <h1 class="search-title">Результаты поиска по запросу:</h1>
  <div class="hotnews-wrapper">
    <div class="hotnews-column">
      <ul class="hotnews">
        <?php while ( have_posts() ){ the_post(); ?>
        <li class="hotnews-item">
          <a class="hotnews-item-permalink" href="<?php echo get_the_permalink(); ?>">
            <img class="hotnews-img" width="336" height="195" src="<?php 
            if( has_post_thumbnail() ) {
              echo get_the_post_thumbnail_url( null, 'hotnews-thumb');
            }
            else {
              echo get_template_directory_uri().'/assets/images/img-default.png';
            }
            ?>">
          </a>
          <div class="hotnews-info">
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
            <a class="hotnews-item-permalink" href="<?php echo get_the_permalink(); ?>">
              <h4 class="hotnews-title"><?php echo get_the_title(); ?></h4>
              <p class="hotnews-excerpt">
                <?php echo mb_strimwidth(get_the_excerpt(), 0, 120, '...'); ?>
              </p>
              <div class="hotnews-footer">
                <span class="hotnews-date"><?php the_time( 'j F' )?></span>
                <div class="hotnews-comments">
                  <svg width="15" height="15" class="icon comments-icon">
                    <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
                  </svg>
                  <span class="comments-counter">
                    <?php comments_number('0', '1', '%') ?>
                  </span>
                </div>
                <div class="hotnews-likes">
                  <svg width="13" height="13" class="icon comments-icon">
                    <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#heart"></use>
                  </svg>
                  <span class="comments-counter">
                    <?php comments_number('0', '1', '%') ?>
                  </span>
                </div>
              </div>
            </a>          
          </div>
          <!-- /.hotnews-info -->
        </li>
        <?php } ?>
        <?php if ( ! have_posts() ){ ?>
          Записей нет.
        <?php } ?>
      </ul>
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
    <!-- /.hotnews-column -->
    <!-- Подключаем сайдбар -->
    <?php get_sidebar('search');?> 
  </div>
  <!-- /.favorites -->
</div>
<!-- /.container -->
<?php get_footer( );?> 