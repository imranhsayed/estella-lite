<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package estella
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

<!-- 1.POST HEADING -->
		<div class="post-heading">
		<?php the_title_attribute( 'before=<h2 class="entry-title">  &after=</h2>' ); ?>
		</div>
		<div class="estella-author-name">
			<!-- Author name and icon -->
			<span class="estella-post-author"><?php echo __('By ', 'estella'); ?><?php the_author(); ?></span>
		</div>

	</header><!-- .entry-header -->
<!-- Breadcrumb -->
<?php
	if ( function_exists( "estella_breadcrumb" ) ) {
		estella_breadcrumb();
	}
?>
<!-- End Breadcrumb -->


<!-- 2.POST CONTENT -->
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'estella' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

<!-- 4.POST DATE and LEAVE A COMMENT -->
	<?php if ( 'post' == get_post_type() ) : ?>

			<footer class="entry-footer">
				<?php estella_entry_footer(); ?>
				<span class="estella-post-date"><?php the_date(); ?></span>
			</div><!-- .entry-footer -->

		<?php endif; ?>


</article><!-- #post-## -->
