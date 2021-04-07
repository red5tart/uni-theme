<?php
//Добавление расширенных возможностей
if ( ! function_exists( 'uni_theme_setup' ) ) :

  function uni_theme_setup() {
    // Добавление тэга title 
    add_theme_support( 'title-tag' );

    // Добавление миниатюр
    add_theme_support( 'post-thumbnails', array( 'post' ) );  

    // Добавление пользовательского логотипа
    add_theme_support( 'custom-logo', [
      'width'       => 163,
      'flex-height' => true,
      'header-text' => 'Uni Theme',
      'unlink-homepage-logo' => false, // WP 5.5
    ] );

    // Регистрация меню
    register_nav_menus( [
      'header_menu' => 'Меню в шапке',
      'footer_menu' => 'Меню в подвале'
		] );
		
			// хук, через который подключается функция
			// регистрирующая новые таксономии (create_lesson_taxonomies)
			add_action( 'init', 'create_lesson_taxonomies' );

			// функция, создающая 2 новые таксономии "genres" и "authors" для постов типа "lesson"
			function create_lesson_taxonomies(){

				// Добавляем древовидную таксономию 'genre' (как категории)
				register_taxonomy('genre', array('lesson'), array(
					'hierarchical'  => true,
					'labels'        => array(
						'name'              => _x( 'Genres', 'taxonomy general name' ),
						'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
						'search_items'      =>  __( 'Search Genres' ),
						'all_items'         => __( 'All Genres' ),
						'parent_item'       => __( 'Parent Genre' ),
						'parent_item_colon' => __( 'Parent Genre:' ),
						'edit_item'         => __( 'Edit Genre' ),
						'update_item'       => __( 'Update Genre' ),
						'add_new_item'      => __( 'Add New Genre' ),
						'new_item_name'     => __( 'New Genre Name' ),
						'menu_name'         => __( 'Genre' ),
					),
					'show_ui'       => true,
					'query_var'     => true,
					'rewrite'       => array( 'slug' => 'the_genre' ), // свой слаг в URL
				));

				// Добавляем НЕ древовидную таксономию 'author' (как метки)
				register_taxonomy('author', 'lesson',array(
					'hierarchical'  => false,
					'labels'        => array(
						'name'                        => _x( 'Authors', 'taxonomy general name' ),
						'singular_name'               => _x( 'Author', 'taxonomy singular name' ),
						'search_items'                =>  __( 'Search Authors' ),
						'popular_items'               => __( 'Popular Authors' ),
						'all_items'                   => __( 'All Authors' ),
						'parent_item'                 => null,
						'parent_item_colon'           => null,
						'edit_item'                   => __( 'Edit Author' ),
						'update_item'                 => __( 'Update Author' ),
						'add_new_item'                => __( 'Add New Author' ),
						'new_item_name'               => __( 'New Author Name' ),
						'separate_items_with_commas'  => __( 'Separate authors with commas' ),
						'add_or_remove_items'         => __( 'Add or remove authors' ),
						'choose_from_most_used'       => __( 'Choose from the most used authors' ),
						'menu_name'                   => __( 'Authors' ),
					),
					'show_ui'       => true,
					'query_var'     => true,
					'rewrite'       => array( 'slug' => 'the_author' ), // свой слаг в URL
				));
			}
			
		add_action('init', 'my_custom_init');
			function my_custom_init(){
				register_post_type('lesson', array(
					'labels'             => array(
						'name'               => 'Уроки', // Основное название типа записи
						'singular_name'      => 'Урок', // отдельное название записи типа Book
						'add_new'            => 'Добавить новый',
						'add_new_item'       => 'Добавить новый урок',
						'edit_item'          => 'Редактировать урок',
						'new_item'           => 'Новый урок',
						'view_item'          => 'Посмотреть урок',
						'search_items'       => 'Искать уроки',
						'not_found'          => 'Уроков не найдено',
						'not_found_in_trash' => 'В корзине уроков не найдено',
						'parent_item_colon'  => '', //для родителей (у древовидных типов)
						'menu_name'          => 'Уроки'

						),
					'public'             => true,
					'publicly_queryable' => true,
					'show_ui'            => true,
					'show_in_menu'       => true,
					'show_in_rest'       => true,
					'query_var'          => true,
					'rewrite'            => true,
					'capability_type'    => 'post',
					'has_archive'        => true,
					'hierarchical'       => false,
					'menu_position'      => 5,
					'menu_icon'				   => 'dashicons-welcome-learn-more',
					'supports'           => array('title','editor', 'thumbnail','custom-fields','comments')
				) );
			}
  }
endif;
add_action( 'after_setup_theme', 'uni_theme_setup' );

/* Register widget area / подключение  сайдбара-2
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function uni_theme_widgets_init() {
	register_sidebar(array(
			'name'          => esc_html__( 'Сайдбар на главной сверху', 'uni-theme' ),
			'id'            => 'main-sidebar',
			'description'   => esc_html__( 'Колонка виджетов справа вверху', 'uni-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
		register_sidebar(array(
			'name'          => esc_html__( 'Сайдбар на главной сбоку', 'uni-theme' ),
			'id'            => 'bottom-sidebar',
			'description'   => esc_html__( 'Виджет средней части главной страницы', 'uni-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
				register_sidebar(array(
			'name'          => esc_html__( 'Меню в подвале', 'uni-theme' ),
			'id'            => 'sidebar-footer',
			'description'   => esc_html__( 'Добавьте сюда меню', 'uni-theme' ),
			'before_widget' => '<section id="%1$s" class="footer-menu %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer-menu-title">',
			'after_title'   => '</h2>',
		));
				register_sidebar(array(
			'name'          => esc_html__( 'Текст в подвале', 'uni-theme' ),
			'id'            => 'sidebar-footer-text',
			'description'   => esc_html__( 'Добавьте сюда текст', 'uni-theme' ),
			'before_widget' => '<section id="%1$s" class="footer-text %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '',
			'after_title'   => '',
		));
				register_sidebar(array(
			'name'          => esc_html__( 'Сайдбар страницы поиска', 'uni-theme' ),
			'id'            => 'sidebar-search',
			'description'   => esc_html__( 'Добавьте сюда виджет', 'uni-theme' ),
			'before_widget' => '<section id="%1$s" class="footer-text %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '',
			'after_title'   => '',
		));
}
add_action( 'widgets_init', 'uni_theme_widgets_init' );

/**
 * Добавление нового виджета Downloader_Widget.
 */
class Downloader_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'downloader_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: downloader_widget
			'Полезные файлы',
			array( 'description' => 'Файлы для скачивания', 'classname' => 'widget-downloader', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_downloader_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_downloader_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title'];
		$description = $instance['description'];
		$link = $instance['link'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		if ( ! empty( $description ) ) {
			echo '<p>' . $description . '</p>';
		}
		if ( ! empty( $link ) ) {
			echo '<a target="_blank" class="widget-link" href="' . $link . '">
			<svg width="20" height="20" class="icon widget-link-icon"><use xlink:href="' . get_template_directory_uri(). '/assets/images/sprite.svg#download"></use></svg>
			Скачать</a>';
		}
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Полезные файлы';
		$description = @ $instance['description'] ?: 'Описание';
		$link = @ $instance['link'] ?: 'http://yandex.ru';		

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
			<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Описание:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Ссылка на файл:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';		


		return $instance;
	}

	// скрипт виджета
	function add_downloader_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
	}

	// стили виджета
	function add_downloader_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Downloader_Widget

// регистрация Downloader_Widget в WordPress
function register_downloader_widget() {
	register_widget( 'Downloader_Widget' );
}
add_action( 'widgets_init', 'register_downloader_widget' );

/**
 * Добавление нового виджета Social_Widget.
 */
class Social_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: social_widget
			'Социальные сети',
			array( 'description' => 'Наши соцсети', 'classname' => 'widget-social', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_social_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_social_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title'];
		$link1 = $instance['link1'];
		$link2 = $instance['link2'];
		$link3 = $instance['link3'];
		$link4 = $instance['link4'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		echo('<div class="widget-social-wrapper">');
		if ( ! empty( $link1 ) ) {
			echo '<a target="_blank" class="widget-link" href="' . $link1 . '">
			<svg width="50" height="50" class="icon widget-social-icon widget-social-icon-fb"><use xlink:href="' . get_template_directory_uri(). '/assets/images/sprite.svg#fb"></use></svg>
			</a>';
		}
		if ( ! empty( $link2 ) ) {
			echo '<a target="_blank" class="widget-link" href="' . $link2 . '">
			<svg width="50" height="50" class="icon widget-social-icon widget-social-icon-ig"><use xlink:href="' . get_template_directory_uri(). '/assets/images/sprite.svg#ig"></use></svg>
			</a>';
		}
		if ( ! empty( $link3 ) ) {
			echo '<a target="_blank" class="widget-link" href="' . $link3 . '">
			<svg width="50" height="50" class="icon widget-social-icon widget-social-icon-vk"><use xlink:href="' . get_template_directory_uri(). '/assets/images/sprite.svg#vk"></use></svg>
			</a>';
		}
		if ( ! empty( $link4 ) ) {
			echo '<a target="_blank" class="widget-link" href="' . $link4 . '">
			<svg width="50" height="50" class="icon widget-social-icon widget-social-icon-tw"><use xlink:href="' . get_template_directory_uri(). '/assets/images/sprite.svg#tw"></use></svg>
			</a>';
		}
		echo('</div>');
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Наши сети';
		$link1 = @ $instance['link1'] ?: '';
		$link2 = @ $instance['link2'] ?: '';		
		$link3 = @ $instance['link3'] ?: '';		
		$link4 = @ $instance['link4'] ?: '';		

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e( 'facebook:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link1' ); ?>" name="<?php echo $this->get_field_name( 'link1' ); ?>" type="text" value="<?php echo esc_attr( $link1 ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link2' ); ?>"><?php _e( 'instagram:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link2' ); ?>" name="<?php echo $this->get_field_name( 'link2' ); ?>" type="text" value="<?php echo esc_attr( $link2 ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link3' ); ?>"><?php _e( 'vk' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link3' ); ?>" name="<?php echo $this->get_field_name( 'link3' ); ?>" type="text" value="<?php echo esc_attr( $link3 ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link4' ); ?>"><?php _e( 'twitter' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'link4' ); ?>" name="<?php echo $this->get_field_name( 'link4' ); ?>" type="text" value="<?php echo esc_attr( $link4 ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['link1'] = ( ! empty( $new_instance['link1'] ) ) ? strip_tags( $new_instance['link1'] ) : '';
		$instance['link2'] = ( ! empty( $new_instance['link2'] ) ) ? strip_tags( $new_instance['link2'] ) : '';
		$instance['link3'] = ( ! empty( $new_instance['link3'] ) ) ? strip_tags( $new_instance['link3'] ) : '';
		$instance['link4'] = ( ! empty( $new_instance['link4'] ) ) ? strip_tags( $new_instance['link4'] ) : '';							


		return $instance;
	}

	// скрипт виджета
	function add_social_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_my_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('my_widget_script', $theme_url .'/my_widget_script.js' );
	}

	// стили виджета
	function add_social_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_my_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.my_widget a{ display:inline; }
		</style>
		<?php
	}

} 
// конец класса Social_Widget

// регистрация Social_Widget в WordPress
function register_social_widget() {
	register_widget( 'Social_Widget' );
}
add_action( 'widgets_init', 'register_social_widget');

/**
 * Добавление нового виджета Recent_Posts_Widget.
 */
class Recent_Posts_Widget extends WP_Widget {

	// Регистрация виджета используя основной класс
	function __construct() {
		// вызов конструктора выглядит так:
		// __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
		parent::__construct(
			'recent_posts_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: recent_posts_widget
			'Недавно опубликовано',
			array( 'description' => 'Последние посты', 'classname' => 'widget-recent-posts', )
		);

		// скрипты/стили виджета, только если он активен
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			add_action('wp_enqueue_scripts', array( $this, 'add_recent_posts_widget_scripts' ));
			add_action('wp_head', array( $this, 'add_recent_posts_widget_style' ) );
		}
	}

	/**
	 * Вывод виджета во Фронт-энде
	 *
	 * @param array $args     аргументы виджета.
	 * @param array $instance сохраненные данные из настроек
	 */
	function widget( $args, $instance ) {
		$title = $instance['title'];
		$count = $instance['count'];

		echo $args['before_widget'];

		if ( ! empty( $count ) ) {
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			echo '<div class="widget-recent-posts-wrapper">';
			global $post;
			$postslist = get_posts( array( 'posts_per_page' => $count, 'order'=> 'DESC', 'orderby' => 'date' ) );
			foreach ( $postslist as $post ){
				setup_postdata($post);
				?>
				<a href="<?php the_permalink( )?>" class="recent-post-link">
				<img src="<?php echo get_the_post_thumbnail_url( null,'thumb65') ?>" alt="">
					<div class="recent-post-info">
						<h4><?php echo mb_strimwidth(get_the_title(), 0, 33, '...'); ?></h4>
						<span class="recent-post-time">
							<?php $time_diff = human_time_diff( get_post_time('U'), current_time('timestamp') );
							echo "$time_diff назад";
							//> 5 лет назад?>	
						</span>
					</div>
					</a>
				<?php
			}
			wp_reset_postdata();
			echo '</div>';
		}
		echo $args['after_widget'];
	}

	/**
	 * Админ-часть виджета
	 *
	 * @param array $instance сохраненные данные из настроек
	 */
	function form( $instance ) {
		$title = @ $instance['title'] ?: 'Недавно опубликовано';
		$count = @ $instance['count'] ?: '7';	

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Заголовок:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
			<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Количество постов:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>">
		</p>
		<?php 
	}

	/**
	 * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance новые настройки
	 * @param array $old_instance предыдущие настройки
	 *
	 * @return array данные которые будут сохранены
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';	
		return $instance;
	}

	// скрипт виджета
	function add_recent_posts_widget_scripts() {
		// фильтр чтобы можно было отключить скрипты
		if( ! apply_filters( 'show_recent_posts_widget_script', true, $this->id_base ) )
			return;

		$theme_url = get_stylesheet_directory_uri();

		wp_enqueue_script('recent_posts_widget_script', $theme_url .'/recent_posts_widget_script.js' );
	}

	// стили виджета
	function add_recent_posts_widget_style() {
		// фильтр чтобы можно было отключить стили
		if( ! apply_filters( 'show_recent_posts_widget_style', true, $this->id_base ) )
			return;
		?>
		<style type="text/css">
			.recent_posts_widget a{ display:inline; }   
		</style>
		<?php
	}

} 
// конец класса Recent_Posts_Widget

// регистрация Recent_Posts_Widget в WordPress
function register_recent_posts_widget() {
	register_widget( 'Recent_Posts_Widget' );
}
add_action( 'widgets_init', 'register_recent_posts_widget' );

//Подключение стилей и скриптов

function enqueue_unitheme_style() {
  wp_enqueue_style( 'style', get_stylesheet_uri() );
  wp_enqueue_style( 'swiper-slider', get_template_directory_uri(  ) . '/assets/css/swiper-bundle.min.css', 'style');
	wp_enqueue_style( 'uni-theme', get_template_directory_uri(  ) . '/assets/css/uni-theme.css', 'style');
	wp_enqueue_style( 'Roboto-Slab', 'https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@700&display=swap');
	wp_deregister_script( 'jquery-core' );
	wp_register_script( 'jquery-core', '//code.jquery.com/jquery-3.6.0.min.js');
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'swiper', get_template_directory_uri(  ) . '/assets/js/swiper-bundle.min.js', null, time(), true);
	wp_enqueue_script( 'scripts', get_template_directory_uri(  ) . '/assets/js/scripts.js', 'swiper', time(), true);
}
add_action( 'wp_enqueue_scripts', 'enqueue_unitheme_style' );

add_action( 'wp_enqueue_scripts', 'adminAjax_data', 99 );
function adminAjax_data(){
	wp_localize_script( 'jquery', 'adminAjax',
		array(
			'url' => admin_url('admin-ajax.php')
		)
	);
}

add_action('wp_ajax_contacts_form', 'ap_ajax_form');
add_action('wp_ajax_nopriv_contacts_form', 'ap_ajax_form');

function ap_ajax_form() {
	$contact_name = $_POST['contact_name'];
	$contact_email = $_POST['contact_email'];
	$contact_comment = $_POST['contact_comment'];
	$message = 'Пользователь с именем ' . $contact_name . ' отправил вопрос "' . $contact_comment . '", указав обратный адрес ' . $contact_email . '.';
/* 	$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	mail('red5tart@mail.ru', 'заявка через форму на сайте', $message, $headers );
	echo "ok"; */
	
	$headers = 'From: Red27 <red5tart@mail.ru>' . "\r\n";

	$sent_message = wp_mail('spellstone@yandex.ru', 'Новая заявка через форму на сайте', $message, $headers);
	// выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция
	if ( $sent_message ) {
		echo "Все получилось";
	} else {
		echo "Где-то ошибка";
	}
	wp_die();
}

## меняем настройки облака тегов
add_filter( 'widget_tag_cloud_args', 'edit_widget_tag_cloud_args');
function edit_widget_tag_cloud_args($args) {
	$args['unit'] = 'px';
	$args['smallest'] = '14';
	$args['largest'] = '14';
	$args['orderby'] = 'name';
	$args['number'] = '10';
	return $args;
}

## отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
	// размеры которые нужно удалить
	return array_diff( $sizes, [
		'medium_large',
		'large',
		'1536x1536',
		'2048x2048',
  ] );
}

##добавляем миниатюры нужных размеров (65х65 и 336х195)
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'thumb65', 65, 65, true ); // Кадрирование изображения
	add_image_size( 'hotnews-thumb', 336, 195, true ); 
}

## меняем стиль многоточия 
add_filter('excerpt_more', function($more) {
	return '...';
});

//склоняем слова после числительных
function plural_form($number, $after) {
	$cases = array (2, 0, 1, 1, 1, 2);
	echo $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
}