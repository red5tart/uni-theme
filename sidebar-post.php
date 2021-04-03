<?php
/**
 * блок 4 статей той же категории внизу страницы поста
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */
?>

<div class="sidebar-post-wrapper">
  <ul>
    <?php
    
    $category = get_the_category();
    $cat_add_id = $category[0]->term_id;
    $args = array( 'numberposts' => 4, 'orderby' => 'rand', 'cat' =>$cat_add_id, 'post__not_in'  => array(get_the_ID()));
    $rand_posts = get_posts( $args );
    foreach( $rand_posts as $post ) : ?>
      <li>
        <a href="<?php the_permalink(); ?>">
          <img width="263" height="180" src="<?php 
          if( has_post_thumbnail() ) {
              echo get_the_post_thumbnail_url( null, 'hotnews-thumb');
            }
            else {
              echo get_template_directory_uri().'/assets/images/img-default.png';
            }
          ?>" alt="">
          <?php the_title(); ?>
            <div class="views">
              <svg width="15" height="11" class="icon comments-icon-white">
                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#eye"></use>
              </svg>
              <span class="comments-counter">
                <?php comments_number('0', '1', '%') ?>
              </span>
            </div><!-- /.views -->
            <div class="comments">
              <svg width="15" height="15" class="icon comments-icon-white">
                <use xlink:href="<?php echo get_template_directory_uri()?>/assets/images/sprite.svg#comment"></use>
              </svg>
              <span class="comments-counter">
                <?php comments_number('0', '1', '%') ?>
              </span>
            </div> <!-- /.comments -->
        </a>
      </li>
    <?php endforeach; ?>
    <?php wp_reset_postdata() ?>
  </ul>`
</div>