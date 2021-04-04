<?php get_header( );?>
<main class="front-page-header">
  <div class="container">
    <div class="hero">
      <div class="left">
        <?php 
        //объявляем глобальную переменную
        global $post;

        $myposts = get_posts([ 
          'numberposts' => 1, 
        ]); 
        //проверяем, есть ли посты 
        if( $myposts ){ 
        //если есть, запускаем цикл 
        foreach( $myposts as $post ){ setup_postdata( $post ); ?>
        <!-- Выводим записи -->
        <img src="<?php the_post_thumbnail_url() ?>" alt="" class="post-thumb"
        />
        <?php $author_id = get_the_author_meta('ID') ?>
        <a href="<?php echo get_author_posts_url($author_id) ?>" class="author">
          <img
            src="<?php echo get_avatar_url($author_id) ?>"
            alt=""
            class="avatar"
          />
          <div class="author-bio">
            <span class="author-name"><?php the_author(); ?></span>
            <span class="author-rank">Должность</span>
          </div>
        </a>
        <div class="post-short">
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
          <h2 class="post-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...'); ?></h2>
          <a href="<?php echo get_permalink(); ?>" class="more">Читать далее</a>
        </div>
        <?php 
          }
        } else {
          // Постов не найдено
        ?>
        <p>Постов нет</p>
        <?php
          }

          wp_reset_postdata(); // Сбрасываем $post
        ?>
      </div>
      <!-- /.left -->
      <div class="right">
        <h3 class="recommended">Рекомендуем</h3>
        <ul class="posts-list">
          <?php 
          //объявляем глобальную переменную
          global $post;

          $myposts = get_posts([
            'offset' => 1, 
            'numberposts' => 5, 
            'orderby' => 'date', 
            'category_name' => 'javascript, css, html, web-design', 
          ]); 
          //проверяем, есть ли посты 
          if( $myposts ){ 
          //если есть, запускаем цикл 
          foreach( $myposts as $post ){ setup_postdata( $post ); ?>
          <!-- Выводим записи -->
          <li class="post">
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
            <a class="post-permalink" href="<?php echo get_the_permalink(); ?>">
              <h4 class="post-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...'); ?></h4>
            </a>
          </li>
          <?php 
              }
            } else {
              ?>
          <p>Постов нет</p>
          <?php
            }
          wp_reset_postdata(); // Сбрасываем $post
          ?>
        </ul>
      </div>
      <!-- /.right -->
    </div>
    <!-- /.hero -->
  </div>
  <!-- /.container -->
</main>

<!-- начало раздела серой плашки под блоком hero -->
<div class="container">
  <ul class="article-list">
    <?php 
      //объявляем глобальную переменную
      global $post;
  
      $myposts = get_posts([
        'numberposts' => 4, 
        'category_name' => 'articles', 
      ]); 
      //проверяем, есть ли посты
      if( $myposts ){ 
        //если есть, запускаем цикл 
        foreach( $myposts as $post ){
        setup_postdata( $post ); 
        ?>
      <!-- Выводим записи -->
      <li class="article-item">
        <a class="article-permalink" href="<?php echo get_the_permalink(); ?>">
          <h4 class="article-title"><?php echo wp_trim_words(get_the_title(), 6, '...'); ?></h4>
        </a>
        <img width="65" height="65" src="<?php 
        if( has_post_thumbnail() ) {
            echo get_the_post_thumbnail_url( null, 'thumb65');
          }
          else {
            echo get_template_directory_uri().'/assets/images/img-default.png';
          }
        ?>" alt="">
      </li>
      <?php 
        }
      } else {
        ?><p>Постов нет</p><?php
      }
    wp_reset_postdata(); // Сбрасываем $post
    ?>
  </ul>
  <!-- /.article-list - конец раздела серой плашки под блоком hero -->

  <div class="main-grid">
    <ul class="article-grid">
      <?php		
        global $post;
        //формируем запрос в базу данных
        $query = new WP_Query( [
          //получаем семь постов
          'posts_per_page' => 7,
          'category__not_in' => 32,
        ] );
        //проверяем,есть ли посты
        if ( $query->have_posts() ) {
          //создаем переменную-счетчик постов
          $cnt = 0;
          //пока посты есть, выводим их
          while ( $query->have_posts() ) {
            $query->the_post();
            //и увеличиваем счетчик постов
            $cnt++;
            switch ($cnt) {
              //выводим первый пост
              case '1':
                ?>
                  <li class="article-grid-item article-grid-item-1">
                    <a href="<?php echo the_permalink()?>" class="article-grid-permalink">
                      <span class="category-name"><?php $category = get_the_category(); echo $category[0]->name;?></span>
                      <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...');
                      ?></h4>
                      <p class="article-grid-excerpt">
                        <?php echo mb_strimwidth(get_the_excerpt(), 0, 120, '...'); ?>
                      </p>
                      <div class="article-grid-info">
                        <div class="author">
                          <?php $author_id = get_the_author_meta('ID') ?>
                          <img src="<?php echo get_avatar_url($author_id) ?>" alt="" class="author-avatar">
                          <span class="author-name"><strong><?php the_author() ?>: </strong> <?php the_author_meta('description') ?></span>
                          <div class="comments">
                            <svg width="15" height="15" class="icon comments-icon">
                              <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
                            </svg>
                            <span class="comments-counter">
                              <?php comments_number('0', '1', '%') ?>
                            </span>
                          </div>
                            <!-- /.comments -->
                        </div>
                        <!-- /.author -->
                      </div>
                      <!-- /.article-grid-info -->
                    </a>
                  </li>
                <?php
                break;

              //выводим второй пост
              case '2': 
                ?>
                  <li class="article-grid-item article-grid-item-2">
                    <img src="<?php if( has_post_thumbnail() ) {
                    echo get_the_post_thumbnail_url( null, 'hotnews-thumb');
                  }
                  else {
                    echo get_template_directory_uri().'/assets/images/img-default.png';
                  }?>" alt="" class="article-grid-thumb">
                    <a href="<?php echo the_permalink()?>" class="article-grid-permalink">
                      <span class="tag">
                        <?php 
                          $posttags = get_the_tags();
                          if ( $posttags ) {
                            echo $posttags[0]->name . ' ';
                          } ?>
                      </span>
                      <span class="category-name"><?php $category = get_the_category(); echo $category[0]->name;?></span>
                      <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...');
                      ?></h4>
                      <div class="article-grid-info">
                        <div class="author">
                          <?php $author_id = get_the_author_meta('ID') ?>
                          <img src="<?php echo get_avatar_url($author_id) ?>" alt="" class="author-avatar">
                          <div class="author-info">
                            <span class="author-name"><strong><?php the_author() ?></strong></span>
                            <span class="date"><?php the_time( 'j F' )?></span>
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
                      <!-- /.article-grid-info -->
                    </a>
                  </li>
                <?php 
                break;  

              //выводим третий пост
              case '3': 
                ?>
                  <li class="article-grid-item article-grid-item-3">
                    <a href="<?php echo the_permalink()?>" class="article-grid-permalink">
                      <img class="article-thumb" src="<?php if( has_post_thumbnail() ) {
                      echo get_the_post_thumbnail_url( null, 'hotnews-thumb');
                    }
                    else {
                      echo get_template_directory_uri().'/assets/images/img-default.png';
                    }?>" alt="">
                      <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(), 0, 50, '...');
                        ?></h4>
                    </a>
                  </li>
                <?php 
                break;
              
              //выводим остальные посты
              default:
                ?>
                  <li class="article-grid-item article-grid-item-default">
                    <a href="<?php echo the_permalink()?>" class="article-grid-permalink">
                      <h4 class="article-grid-title"><?php echo mb_strimwidth(get_the_title(), 0, 40, '...');?></h4>
                      <p class="article-grid-excerpt">
                        <?php echo mb_strimwidth(get_the_excerpt(), 0, 70, '...');
                      ?>
                      </p>
                      <span class="article-date"><?php the_time( 'j F Y' )?></span>
                    </a>
                  </li>
                <?php 
                break;
            }
            ?>
            <!-- Вывода постов, функции цикла: the_title() и т.д. -->
            <?php 
          }
        } else {
        // Постов не найдено
        }

        wp_reset_postdata(); // Сбрасываем $post
      ?>
    </ul>
    <!-- /.article-grid - конец плиточной раскладки слева -->

      <!-- Подключаем сайдбар -->
    <?php get_sidebar('main');?> 

  </div>
  <!-- /.main-grid -->
</div>
<!-- /.container -->
<?php		
global $post;

$query = new WP_Query( [
	'posts_per_page' => 1,
	'category_name' => 'investigation',
] );

if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
    ?>
    <section class="investigation" style="background: linear-gradient(0deg, rgba(64, 48, 61, 0.45), rgba(64, 48, 61, 0.45)), url(<?php if( has_post_thumbnail() ) {
      echo get_the_post_thumbnail_url( null, 'hotnews-thumb');
    }
    else {
      echo get_template_directory_uri().'/assets/images/img-default.png';
    }?>) no-repeat center center">
      <div class="container">
        <h2 class="investigation-title"><?php the_title();?></h2>
        <a href="<?php echo get_permalink(); ?>" class="more">Читать статью</a>
      </div>
    </section>
		<!-- Вывода постов, функции цикла: the_title() и т.д. -->
		<?php 
	}
} else {
	// Постов не найдено
}

wp_reset_postdata(); // Сбрасываем $post
?>
<!-- /.investigation -->

<div class="container">
  <div class="hotnews-wrapper">
    <div class="hotnews-column">
      <ul class="hotnews">
        <?php 
        global $post;

        $myposts = get_posts([
          'numberposts' => 6, 
          // 'orderby' => 'date', 
          'category_name' => 'news, hot, opinions, compilations', 
        ]); 
        if( $myposts ){ 
        foreach( $myposts as $post ){ setup_postdata( $post ); ?>
        <!-- Вывод записей -->
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
            <button class="bookmark">
              <svg width="14" height="18" class="icon comments-icon">
                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#bookmark"></use>
              </svg>
            </button>
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
                <?php echo mb_strimwidth(get_the_excerpt(), 0, 180, '...'); ?>
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
        <?php 
          }
        } else {
        ?>
        <p>Постов нет</p>
        <?php
          }
        wp_reset_postdata(); // Сбрасываем $post
        ?>
      </ul> 
    </div>
    <!-- /.hotnews-column -->
    <!-- Подключаем сайдбар -->
    <?php get_sidebar('bottom');?> 
  </div> <!-- /.hotnews-wrapper -->
</div>
<!-- /.container -->
<div class="special">
  <div class="container">
    <div class="special-grid">
      <?php 
        global $post;

        $query = new WP_Query( [
          'posts_per_page' => 1,
          'category_name' => 'photoreport'  
        ]); 

        if( $query->have_posts() ){ 
          while ( $query->have_posts() ){ 
            $query->the_post(); 
            ?>
        <div class="photo-report">
          <!-- Slider main container -->
          <div class="swiper-container photo-report-slider">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
              <!-- Slides -->
              <?php $images = get_attached_media( 'image' ); 
                foreach ($images as $image ) {
                  echo '<div class="swiper-slide"><img src="';
                  print_r($image -> guid); 
                  echo '"></div>';
                }
              ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        <div class="photo-report-content">
          <?php
            foreach (get_the_category() as $category) {
              printf(
                '<a href="%s" class="category-link ">%s</a>', 
                esc_url( get_category_link( $category ) ) , 
                esc_html( $category -> name )
              );
            }
          ?>
          <?php $author_id = get_the_author_meta('ID') ?>
          <a href="<?php echo get_author_posts_url($author_id) ?>" class="author">
            <img src="<?php echo get_avatar_url($author_id) ?>" class="author-avatar"/>
            <div class="author-bio">
              <span class="author-name"><?php the_author(); ?></span>
              <span class="author-rank">Должность</span>
            </div>
          </a>
          <h3 class="photo-report-title"><?php the_title(); ?></h3>
          <a href="<?php echo get_the_permalink( )?>" class="button photo-report-button">
            <svg width="19" height="15" class="icon photo-report-icon">
              <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#images"></use>
            </svg>
            Смотреть фото
            <span class="photo-report-counter"><?php echo count($images)?></span>
          </a>
        </div>
        <!-- /.photo-report-content -->
      </div>
      <!-- /.photo-report -->
        <?php 
          }
        } else {
        ?>
        <p>Постов нет</p>
        <?php
          }
        wp_reset_postdata(); // Сбрасываем $post
      ?>
      <div class="other">
        <?php		
        global $post;

        $query = new WP_Query( [
          'posts_per_page' => 1,
          'category_name' => 'career',
        ] );
        if ( $query->have_posts() ) {
          while ( $query->have_posts() ) {
            $query->the_post();
            ?>
            <div class="career-post">      
              <span class="category-name"><?php $category = get_the_category(); echo $category[0]->name;?></span>
              <h4 class="career-post-title"><?php echo mb_strimwidth(get_the_title(), 0, 60, '...');
              ?></h4>
              <p class="career-post-excerpt">
                <?php echo mb_strimwidth(get_the_excerpt(), 0, 120, '...'); ?>
              </p>
              <a href="<?php echo the_permalink()?>" class="article-grid-permalink">
                <div class="more">Читать далее</div>
              </a>
            </div>
            <!-- Вывода постов, функции цикла: the_title() и т.д. -->
            <?php 
          }
        } else {
          // Постов не найдено
        }

        wp_reset_postdata(); // Сбрасываем $post
        ?>
        <!-- Начало - career-other-posts -->
        <div class="other-wrapper">
          <?php		
          global $post;

          $query = new WP_Query( [
            'posts_per_page' => 2,
            'offset' => '7',
          ] );

          if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
              $query->the_post();
              ?>
              <div class="other-posts" >
                  <a href="<?php echo the_permalink()?>" class="article-grid-permalink">
                    <h4 class="other-posts-title"><?php echo mb_strimwidth(get_the_title(), 0, 20, '...');?></h4>
                    <p class="other-posts-excerpt">
                      <?php echo mb_strimwidth(get_the_excerpt(), 0, 86, '...');
                    ?>
                    </p>
                    <span class="article-date"><?php the_time( 'j F Y' )?></span>
                  </a>
              </div>
              <!-- Вывода постов, функции цикла: the_title() и т.д. -->
              <?php 
            }
          } else {
            // Постов не найдено
          }

          wp_reset_postdata(); // Сбрасываем $post
          ?>
        <!-- /.career-other-posts -->
        </div>
        <!-- /.other-wrapper -->
      </div>
      <!-- /.other -->
    </div>
    <!-- /.special-grid -->
  </div>
  <!-- /.container -->
</div>
<!-- /.special -->
<?php get_footer(); ?>