<?php
/**
 * The sidebar containing the middle widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

if ( ! is_active_sidebar( 'bottom-sidebar' ) ) {
	return;
}
?>

<div class="sidebar-front-page">
	<?php dynamic_sidebar( 'bottom-sidebar' ); ?>
</div>