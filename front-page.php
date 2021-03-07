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
        <img
          src="<?php the_post_thumbnail_url() ?>"
          alt=""
          class="post-thumb"
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
          <?php the_category(); ?>
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
            <?php the_category(); ?>
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
        <img width="65" height="65" src="<?php echo get_the_post_thumbnail_url( null, 'thumb65')?>" alt="">
      </li>
      <?php 
        }
      } else {
        ?><p>Постов нет</p><?php
      }
    wp_reset_postdata(); // Сбрасываем $post
    ?>
  </ul>
</div>
<!-- /.container -->
<!--конец раздела серой плашки под блоком hero -->
