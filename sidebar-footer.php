<?php
/**
 * The sidebar containing the footer widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

if ( ! is_active_sidebar( 'footer-sidebar' ) ) {
	return;
}
?>

<div id="secondary2" class="sidebar-below">
	<?php dynamic_sidebar( 'footer-sidebar' ); ?>
</div><!-- #secondary2 -->