<?php
/**
 * The sidebar containing the search page widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

if ( ! is_active_sidebar( 'sidebar-search' ) ) {
	return;
}
?>

<div class="sidebar-search-page">
	<?php dynamic_sidebar( 'sidebar-search' ); ?>
</div>