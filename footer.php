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
		<div class="footer-wrap">
		<?php do_action('estella-footer-widgets');  ?>
		<!-- //code for displaying footer widgets -->
			<?php if( is_active_sidebar('Footer Widgets' )): ?>

				<div id="custom-footer" class="clear">
					<?php dynamic_sidebar('Footer Widgets' ); ?>
				</div><!-- END #custom-footer -->

			<?php endif; ?>
		</div><!-- END .footer-wrap -->

		<div class="site-info clear">
			<div class="footer-wrap ">
			<?php do_action('estella_footer_site_info_begins');  ?>

			<div class="estella-footer-icons">
				<!-- ICONS -->
				<ul class="footer-icons">

					<?php estella_social_media_icons(); ?>
				</ul>
			</div> <!-- END estella-footer-icons -->

			<!-- POWERED BY -->
			<div class="estella-author-name">
				<ul>
					<li>
					<a href="http://wordpress.org/"><?php printf( __( 'Proudly powered by %s', 'estella' ), 'WordPress' ); ?></a>
					</li>
					<li>
					<span class="sep"> | </span>
					<?php printf( __( 'Theme: %1$s by %2$s.', 'estella' ), 'estella', '<a href="http://supernovathemes.com" rel="designer">Jyoti Sayed</a>' ); ?>
					</li>
				</ul>
			</div><!-- END estella-author-name -->

			</div> <!-- END .footer-wrap -->

			<?php do_action('estella_footer_site_info_ends');  ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

<div class="footer-scroll"><span></span></div>

<?php wp_footer(); ?>
</body>
</html>
