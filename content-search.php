<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package estella
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

<!-- 2.Featured `Image -->
		<?php if ( has_post_thumbnail( ) )
		{
			the_post_thumbnail( );

		}


	?>
<!-- 2.POST HEADING -->
		<div class="post-heading">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		</div>
		<div class="estella-author-name">
			<!-- Author name and icon -->
			<h4 class="estella-post-author"><?php echo __('By ', 'estella'); ?><?php the_author(); ?></h4>
		</div>



	</header><!-- .entry-header -->

<!-- 3.POST CONTENT -->
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

<!-- 4.POST DATE and LEAVE A COMMENT -->
	<?php if ( 'post' == get_post_type() ) : ?>

			<div class="head-post">

				<!-- Leave a comment and edit ,function coming from inc>template-tags.php -->
				<li class="estella-post-comment"><?php estella_entry_footer(); ?><span class="leave-comment">|</span></li>

				<!-- Date posted on -->
				<li class="estella-post-date"><span class="icon-calander"><?php the_date(); ?></span></li>

			</div><!-- .head-post -->

		<?php endif; ?>

<!-- 5.EDIT and READ MORE -->
	<footer class="entry-footer clear">
		<ul>
			<!-- Edit Post -->
			<li><?php edit_post_link( __( 'Edit', 'estella' ), '<span class="edit-link">', '</span>' ); ?></li>
			<!-- Read More Tab -->
			<li><span><a href="<?php the_permalink(); ?>"><?php _e('Continue Reading' , 'estella' ) ?></a></span></li>
		</ul>
	</footer><!-- .entry-footer -->



</article><!-- #post-## -->
