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

if( ! function_exists( 'estella_default_slides' ) ) :

	function estella_default_slides()
	{
		return apply_filters('estella_default_slides_array', array(
	        array
	            (
					'title'       => __('Demo Post One', 'estella'),
					'link' 		  => home_url( '/' ),
					'description' => __('This is description', 'estella'),
					'image'       => get_template_directory_uri() . '/images/slides/slide8.jpg',
	            ),
	        array
	            (
					'title'       => __('Demo Post Two', 'estella'),
					'link' 		  => home_url( '/' ),
					'description' => __('This is description', 'estella'),
					'image'       => get_template_directory_uri() . '/images/slides/slide7.jpg',
	            ),
	        array
	            (
					'title'       => __('Demo Post Three', 'estella'),
					'link' 		  => home_url( '/' ),
					'description' => __('This is description', 'estella'),
					'image'       => get_template_directory_uri() . '/images/slides/slide6.jpg',
	            ),
	        array
	            (
					'title'       => __('Demo Post Four', 'estella'),
					'link' 		  => home_url( '/' ),
					'description' => __('This is description', 'estella'),
					'image'       => get_template_directory_uri() . '/images/slides/slide5.jpg',
	            ),
	        array
	            (
					'title'       => __('Demo Post Five', 'estella'),
					'link' 		  => home_url( '/' ),
					'description' => __('This is description', 'estella'),
					'image'       => get_template_directory_uri() . '/images/slides/slide4.jpg',
	            ),
	        array
	            (
					'title'       => __('Demo Post Six', 'estella'),
					'link' 		  => home_url( '/' ),
					'description' => __('This is description', 'estella'),
					'image'       => get_template_directory_uri() . '/images/slides/slide3.jpg',
	            ),
	        array
	            (
					'title'       => __('Demo Post Seven', 'estella'),
					'link' 		  => home_url( '/' ),
					'description' => __('This is description', 'estella'),
					'image'       => get_template_directory_uri() . '/images/slides/slide2.jpg',
	            ),
	        array
	            (
					'title'       => __('Demo Post Eight', 'estella'),
					'link' 		  => home_url( '/' ),
					'description' => __('This is description', 'estella'),
					'image'       => get_template_directory_uri() . '/images/slides/slide1.jpg',
	            )
	    ) );
	}

endif; //estella_default_slides

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

//Font

if( ! function_exists( 'estella_font_url' ) )
{
	/**
	 * Returns the font url of the theme, we are returning it from a function to handle two things
	 * one is to handle the http problems and the other is so that we can also load it to post editor.
	 * @return string font url
	 */
	function estella_font_url()
	{
		/**
		 * Use font url without http://, we do this because google font without https have
		 * problem loading on websites with https.
		 * @var font_url
		 */
		$font_url = 'fonts.googleapis.com/css?family=Open+Sans|PT+Sans|Oxygen|Lato:400,600,700';

		return ( substr( site_url(), 0, 8 ) == 'https://') ? 'https://' . $font_url : 'http://' . $font_url;
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

if( ! function_exists( 'estella_mod' ) ) :

	function estella_mod( $key , $default = false )
	{
		$estella_mod = get_theme_mod('estella_mod' );

		$saved_value = isset($estella_mod[$key]) ? $estella_mod[$key] : $default;

		$keys_to_be_escaped = apply_filters('estella_key_to_be_escaped_array', array(
			'theme_font',
			'header_textcolor',
			'header_taglinecolor',
			'background_color',
			'header_background',
			'estella-footer-widgets_background',
			'estella-footer-widgets_textcolor',
			'estella-footer-widgets_linkcolor',
			'footer_bottom_textcolor',
			'footer_bottom_background_color',
			'theme_color',
			'hover_link_color',
			'header_text_placement',
			'logo_placement',
			'sidebar_position'
		) );

		if( in_array( $key , $keys_to_be_escaped ) ){
			$saved_value = esc_html( $saved_value ); //As suggested by kevinhaig
		}

		//Rest will be escaped at the point where we output the data.
		return $saved_value;
	}
endif; //estella_mod


