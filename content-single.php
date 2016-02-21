<?php
/**
 * @package estella
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">


<!-- 1.POST HEADING -->
		<div class="post-single-heading">
		<?php the_title_attribute( ); ?>
		</div>
		<div class="estella-content-single-author-name">
			<!-- Author name and icon -->
			<h4 class="estella-post-author"><?php echo __('By ', 'estella'); ?><?php the_author(); ?></h4>
			<h4 class="estella-post-date"><span class="icon-calander"><?php the_date(); ?></span></h4>
		</div>



	</header><!-- .entry-header -->

<!-- 2.POST CONTENT -->
	<div class="entry-content estella-content-single">
<!-- Featured `Image -->
		<?php if ( has_post_thumbnail( ) )
		{
			the_post_thumbnail( );
			the_content();

		}
		else
			{
				//To display the default featured image in posts
				$img_url = esc_url(get_template_directory_uri() . '/images/default.png');

				echo "<img src={$img_url} >";
				the_content();
			}

	?>


		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'estella' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->



</article><!-- #post-## -->
