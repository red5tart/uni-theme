<?php
/**
 * The sidebar containing the footer widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package uni-example
 */

if ( ! is_active_sidebar( 'footer-sidebar' ) ) {
	return;
}
?>

<div id="secondairy" class="sidebar-below">
	<?php dynamic_sidebar( 'footer-sidebar' ); ?>
</div><!-- #secondairy -->