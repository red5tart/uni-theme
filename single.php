<?php get_header('post');?>

	<main class="site-main">

		<?php
    // запускаем цикл wordpress, проверяем, есть ли посты
    while ( have_posts() ) :
      // если пост есть, выводим содержимое
			the_post();
      // находим шаблон для вывода поста в папке template_parts
      get_template_part( 'template-parts/content', get_post_type() );

			// Если комментарии к записи открыты, выводим комментарии
      if ( comments_open() || get_comments_number() ) :
        // находим файл comments.php и выводим его
				comments_template();
			endif;

		endwhile; // Конец цикла WP
		?>

	</main><!-- .site-main -->
<?php get_footer( );?>