<?php
/**
 * @package estella
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<header class="entry-header">
<!-- 1.Featured `Image -->
		<?php if ( has_post_thumbnail( ) )
			{
				the_post_thumbnail( );

			}
		?>

<!-- 2.POST HEADING -->
		<div class="post-heading">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<span class="estella-post-date fa fa-calendar"><?php the_date(); ?></span>
			<span class="estella-post-author fa fa-user"><?php the_author(); ?></span>
		</div>

	</header><!-- .entry-header -->
	<div class="entry-content">
		<!--<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'estella' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?> -->

		<!-- 3.To display only few lines of the Post -->
				<?php the_excerpt(); ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'estella' ),
				'after'  => '</div>',
			) );
		?>


	</div><!-- .entry-content -->
<!-- 4.POST DATE and LEAVE A COMMENT -->
	<?php if ( 'post' == get_post_type() ) : ?>

		<?php endif; ?>
	<!-- 5.EDIT and READ MORE -->
	<footer class="entry-footer clear">
			<?php estella_entry_footer(); ?>
			<span class="edit-link"><?php edit_post_link( __( 'Edit', 'estella' ) ); ?></span>
			<span class="estella-continue-reading"><a href="<?php the_permalink(); ?>" class="hvr-shutter-out-horizontal"><?php _e('Continue Reading' , 'estella' ) ?></a></span>
	</footer><!-- .entry-footer -->




</article><!-- #post-## -->