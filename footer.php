<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package estella
 */
?>

	</div><!-- #content -->

	<?php do_action( 'estella_above_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">


			<div class="estella-footer-widgets">
				<div class="estella-wrap">
				<?php do_action('estella-footer-widgets');  ?>
				<?php if( is_active_sidebar('Footer Widgets' )): ?>
					<?php dynamic_sidebar('Footer Widgets' ); ?>
				<?php endif; ?>
				</div>
			</div>

			<?php do_action('estella_footer_site_info_begins');  ?>

			<div class="estella-site-info">
				<div class="estella-wrap">
				<a href="http://wordpress.org/"><?php printf( __( 'Proudly powered by %s', 'estella' ), 'WordPress' ); ?></a>
				<?php printf( __( 'Theme: %1$s.', 'estella' ), '<a href="http://supernovathemes.com" rel="designer">Estella</a>' ); ?>
				</div>
			</div>

			<?php do_action('estella_footer_site_info_ends');  ?>

	</footer><!-- #colophon -->

<span class="footer-scroll"></span>

<?php wp_footer(); ?>

</body>
</html>
