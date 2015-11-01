<?php
/**
 *  Contains custom functions used for the theme
 *  @package estella
 */

if( ! function_exists( 'estella_copyright_text' ) )
{
	function estella_copyright_text()
	{
		$default = sprintf( esc_html__( 'Theme: %1$s by %2$s.', 'estella' ), 'estella', '<a href="http://automattic.com/" rel="designer">Ghafir Sayed</a>' );

		$copyright_text = get_theme_mod( 'estella_copyright_text' , $default );

		return $copyright_text;
	}
}

if( ! function_exists( 'estella_site_branding' ) )
{
	function estella_site_branding()
	{
		$site_title   = get_bloginfo( 'name' );
		$site_logo    = get_theme_mod( 'estella_logo' );
		$hide_tagline = get_theme_mod( 'estella_hide_tagline' );
		$logo_class   = $site_logo ? ' screen-reader-text' : false;
		$desc_class   = $hide_tagline ? ' screen-reader-text' : false;

		if( $site_logo ){
			printf( '<img src="%s" alt="%s" >' , esc_url( $site_logo ), __( 'Logo' , 'estella' ) );
		}

		if ( is_front_page() && is_home() ){ ?>
			<h1 class="site-title<?php echo $logo_class; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html($site_title); ?></a></h1>
		<?php } else { ?>
			<h2 class="site-title<?php echo $logo_class; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html($site_title); ?></a></h2>
		<?php }

		?>

		<p class="site-description<?php echo $desc_class; ?>"><?php bloginfo( 'description' ); ?></p>

		<?php
	}
}

if( ! function_exists( 'estella_pagination' ) )
{
	function estella_pagination()
	{
		echo "<nav class='estella-pagination clearfix' >";
			echo paginate_links();
		echo "</nav>";
	}
}

/*==============================
          FILTERS
===============================*/

/**
 * Changes the tag cloud font sizes, so it better fits with the theme
 */

function estella_set_tag_cloud_sizes($args)
{
		 $args['smallest'] = 12;
	 $args['largest'] = 19;

	 return $args;

}

add_filter('widget_tag_cloud_args','estella_set_tag_cloud_sizes');

/*==============================
          for social links
===============================*/

function estella_mod( $key , $default = false )
{
	$estella_mod = get_theme_mod('estella_mod' );
	$saved_value = isset($estella_mod[$key]) && $estella_mod[$key] ? $estella_mod[$key] : $default;

	$keys_to_be_escaped = array(
		'theme_font',
				);

	if( in_array( $key , $keys_to_be_escaped ) ){
		$saved_value = esc_html( $saved_value ); //As suggested by kevinhaig
	}

	//Rest will be escaped at the point where we output the data.
	return $saved_value;
}


