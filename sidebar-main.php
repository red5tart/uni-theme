<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

if ( ! is_active_sidebar( 'main-sidebar' ) ) {
	return;
}
?>

<aside class="sidebar-front-page">
	<?php dynamic_sidebar( 'main-sidebar' ); ?>
</aside>