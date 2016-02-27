<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package estella
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'estella' ); ?></a>
	<header id="masthead" class="site-header" role="banner">
		<div class="estella-head-wrap">
		<?php do_action( 'estella_before_site_branding' ); ?>
				<!--1.SITE TITLE -->
				<div class="site-branding">

				<?php if ( estella_mod( 'upload_logo' ) ) : ?>

				    <div id="logo" class='estella-site-logo'>
				        <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( estella_mod( 'upload_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
				        <br><h2 class='site-description'><?php bloginfo( 'description' ); ?></h2>
				    </div>

				<?php else : ?>

		        	<h1 class='site-title'><a href='<?php echo apply_filters('estella_site_tiltle_url', esc_url( home_url( '/' ) ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h1>
		        	<h2 class='site-description'><?php bloginfo( 'description' ); ?></h2>

				<?php endif; ?>

			</div><!-- site-branding -->

				<?php do_action( 'estella_after_site_branding' ); ?>


			<div id="head-container" class="head-color">

				<?php do_action('estella_before_header_icons_extras' ); ?>

				<!-- 2.HEADER ICONS -->
				<div class="header-icons clear">

					<?php estella_social_media_icons(); ?>

				</div>
				<?php do_action('estella_header_social_container_extras' ); ?>


				<!-- 3.SEARCH BOX	 -->
					<div class="estella-search-bar">
						<?php if( get_theme_mod( 'estella_show_search' , true ) ) get_search_form();  ?> <!-- picks up the searchform.php file -->
						<?php do_action('estella_header_top_container_extras' ); ?>
					</div><!-- .estella-search-bar -->


				<!-- END HEADER ICONS -->


				<!-- 4.NAVIGATION-1 -->

				<nav id="site-navigation" class="main-navigation estella-navigation-one" role="navigation">
					<h1 class="screen-reader-text"><?php echo __('Main Navigation', 'estella') ?></h1>
					<div class="estella-navigation-first">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 3 ) ); ?>
					</div> <!-- END estella-navigation-first -->
				</nav><!-- #site-navigation -->
</div><!-- END estella-head-wrapper -->
		</div><!-- END head-container -->



					<?php do_action( 'estella_before_navigation' ); ?>
				<!-- NAVIGATION-2 -->
				<nav id="site-navigation" class="main-navigation estella-nav-two" role="navigation">


					<h1 class="screen-reader-text"><?php echo __('Main Navigation', 'estella') ?></h1>
					<?php do_action( 'estella_header_before_navicon' ); ?>
					<div class="navicon closed"><i class="fa fa-navicon estella-navicon"></i></div>

					<div class="estella-navigation-second">
						<div class="estella-nav-two-wrapper">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 3 ) ); ?>
						</div><!-- END estella-nav-two-wrapper -->
					</div><!-- END estella-navigation-second -->


				</nav><!-- #site-navigation -->

	</header><!-- #masthead -->

<?php
if (is_home() || is_front_page()) {
	get_template_part( 'template-parts/banner' );
}
?>

<?php do_action( 'estella_before_content' ); ?>
<div id="content" class="site-content">
<!-- *including flexslider.php file from template -parts folder -->
