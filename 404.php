<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package estella
 */

get_header(); ?>

<div class="estell-page-header">
	<h1 class="estella-page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'estella' ); ?></h1>
</div>

<div class="estell-404-search-container">
	<?php get_search_form(); ?>
</div>