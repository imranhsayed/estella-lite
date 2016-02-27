<?php

class Estella_Customizer_Front extends Estella_Customizer
{
	public function __construct()
	{
		// Output custom CSS to live site
		add_action( 'wp_head' , array( $this , 'css_output' ) );
	}

	/**
	* This will output the custom WordPress settings to the live theme's WP head.
	* @since estella 1.0
	*/
	public static function css_output()
	{
	  //Handle Favicon
	  $favicon_url = estella_mod('theme_favicon');
	  if($favicon_url){
	    echo '<link rel="shortcut icon" type="image" href="'.esc_url($favicon_url).'">';
	  }
	  ?>
	  <!--Customizer CSS-->
	  <style type="text/css">
	      <?php self::custom_css(); ?>
	  </style>
	  <!--/Customizer CSS-->
	  <?php
	}

	public static function custom_css()
	{

	   self::create_color_scheme();
	   self::generate_css( 'body', 'font-family', 'theme_font', '"', '"', "Open Sans" );
	}

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @uses get_theme_mod()
	 * @param string $selector CSS selector
	 * @param string/array $property The name of the CSS *property* to modify
	 * @param string/array $mod_name The name of the 'theme_mod' option to fetch
	 * @param string/array $prefix Optional. Anything that needs to be output before the CSS property
	 * @param string/array $postfix Optional. Anything that needs to be output after the CSS property
	 * @return string Returns a single line of CSS with selectors and a property.
	 * @since estella 1.1.2
	 */

	public static function generate_css( $selector, $property, $mod_name, $prefix = '', $postfix = '', $default = false, $echo = true, $media_query = false )
	{
	      $return = $media_query ? "@media only screen and {$media_query} {" : '';

	      $selector = is_array( $selector) ? join( ',' , $selector ) : $selector;

	    if( is_array( $property ) && is_array($mod_name) ){
	      $return .= $selector . '{';
	      foreach ($property as $key => $property ) {
	        $mod = is_array( $default ) ? estella_mod($mod_name[$key], $default[$key]) : estella_mod($mod_name[$key], $default) ;
	        $this_prefix  = is_array($prefix)  ? $prefix[$key]  : $prefix;
	        $this_postfix = is_array($postfix) ? $postfix[$key] : $postfix;
	        $return .= ( isset($mod) && ! empty( $mod ) ) ?
	               sprintf( '%s:%s;', $property , $this_prefix.$mod.$this_postfix ) :
	               false;
	      }
	      $return .= "}";
	    }
	    else
	    {
	      $mod = estella_mod($mod_name, $default );
	         $return .= ( isset($mod) && ! empty( $mod ) ) ?
	                sprintf('%s { %s:%s; }', $selector, $property, $prefix.$mod.$postfix) :
	                false;
	    }

	    $return .= $media_query ? "}" : false;

	    if( $echo ){
	      echo $return;
	    }
	    else{
	      return $return;
	    }
	}

	/*color theme*/
	public static function create_color_scheme() {

		//=====================
		//THEME COLOR
		//=====================

		//color
		$color_selectors = apply_filters('estella_create_color_scheme_array', array (
			'.estella-slider-title',
			// '.site-header .site-title a',

		) );

		//Site Title color
		$color_site_title_selectors = apply_filters('estella_color_site_title_selectors_array', array (

			'.site-header .site-title a',


		) );

		//Site Tagline Color
		$color_site_description_selectors = apply_filters('estella_color_site_description_selectors_array', array (

			'.site-header .site-description',


		) );

		//Header Background Color
		$color_header_background_selectors = apply_filters('estella_color_header_background_selectors_array', array (

			'.site-header',


		) );
		//Footer widgets background color
		$color_footer_widgets_background_selectors = apply_filters('estella_footer_widgets_background_selectors_array', array (

			'.estella-footer-widgets',
			'.estella-footer-widgets .widget',


		) );
		// Footer widgets text color
		$color_footer_widgets_text_selectors = apply_filters('estella_footer_widgets_text_selectors_array', array (

			'.estella-footer-widgets .widget h3',

		) );
		//Footer widgets link color
		$color_footer_widgets_link_selectors = apply_filters('estella_footer_widgets_link_selectors_array', array (

			'.estella-footer-widgets a',

		) );
		//Footer bottom background color
		$background_color_footer_bottom_selectors = apply_filters('estella_background_color_footer_bottom_selectors_array', array (

			'.estella-site-info',

		) );
		//Footer bottom text color
		$color_footer_bottom_text_selectors = apply_filters('estella_color_footer_bottom_text_selectors_array', array (

			'.estella-site-info',

		) );
		//Primary Menu Color
		$color_primary_menu_selectors = apply_filters('estella_color_primary_menu_selectors_array', array (

			'.site-header .estella-navigation-second ul li a',
			'.site-header .estella-navigation-second .sub-menu li a',
		) );
		//Primary Menu Background Color
		$color_primary_menu_background_selectors = apply_filters('estella_color_primary_menu_background_selectors_array', array (
			'.site-header .estella-navigation-second ul li a',
			 '.site-header .estella-navigation-second .sub-menu li a',
			 '.site-header .menu-testing-menu-container, .site-header .estella-navigation-second',
			 '.estella-slider-content',
			 '.site-header .estella-nav-two',
			 '#page .estella-head-color',

		) );




		//background
		$background_color_selectors = apply_filters('estella_background_color_selectors_array', array(

			'.widget-title',
			'.current-date',
			'.entry-header:after',
			'.estella-footer-widgets .widget h3:after',
			'.estella-pagination .current',
			'.estella-latest-post-tag',
			'button',
			'input[type="button"]',
			'input[type="reset"]',
			'input[type="submit"]',
			'button:hover',
			'input[type="button"]:hover',
			'input[type="reset"]:hover',
			'input[type="submit"]:hover',
		) );

		//border color
		$border_color_selectors = apply_filters('estella_border_color_selectors_array', array(
			'a:hover, a:active',
			'.estella-pagination .current',

		) );

		//border-top-color
		$border_top_color_selectors = apply_filters('estella_border_top_color_selectors_array', array(

			'.widget-title:after',
		) );
		//

		self::generate_css( $color_selectors, 'color', 'theme_color', false, false, '#daa520' );
		self::generate_css( $background_color_selectors, 'background', 'theme_color', false, false, '#daa520' );
		self::generate_css( $border_color_selectors, 'border-color', 'theme_color', false, false, '#daa520' );
		self::generate_css( $border_top_color_selectors, 'border-top-color', 'theme_color', false, false, '#daa520' );
		self::generate_css( $color_site_title_selectors, 'color', 'header_textcolor', false, false, '#424242' );
		self::generate_css( $color_site_description_selectors, 'color', 'header_taglinecolor', false, false, '#424242' );
		self::generate_css( $color_header_background_selectors, 'background', 'header_background', false, false, '#fff' );
		self::generate_css( $color_footer_widgets_background_selectors, 'background', 'estella-footer-widgets_background', false, false, '#fff' );
		self::generate_css( $color_footer_widgets_text_selectors, 'color', 'estella-footer-widgets_textcolor', false, false, '#424242' );
		self::generate_css( $color_footer_widgets_link_selectors, 'color', 'estella-footer-widgets_linkcolor', false, false, '#424242' );
		self::generate_css( $background_color_footer_bottom_selectors, 'background', 'estella-footer_bottom_background_color', false, false, '#222' );
		self::generate_css( $color_footer_bottom_text_selectors, 'color', 'estella-footer_bottom_textcolor', false, false, '#868686' );
		self::generate_css( $color_primary_menu_selectors, 'color', 'estella_primary_nav_color', false, false, '#fff' );
		self::generate_css( $color_primary_menu_background_selectors, 'background', 'primary_nav_background_color', false, false, '#222222' );

		//=====================
		//LINK COLOR( ON HOVER )
		//=====================

		//color (on hover)
		$color_hover_selectors = apply_filters('estella_color_hover_selectors_array', array(
			'.site-header .site-title a:hover',
			'a:hover',
			'a:active',
			'.breadcrumbs li a:hover',
			'p a:hover',
			'.head-color .header-icons ul li .fa:hover',
		) );

		//background should change on hover.
		$background_color_hover_selectors = apply_filters('estella_background_color_hover_selectors_array', array(
			'button:hover',
			'input[type="button"]:hover',
			'input[type="reset"]:hover',
			'input[type="submit"]:hover',
			'button:hover',
			'input[type="button"]:hover',
			'input[type="reset"]:hover',
			'input[type="submit"]:hover',
			'.hvr-sweep-to-right:before',
			'.hvr-shutter-out-horizontal:before',
			'.estella-footer-widgets h3:after',
			'.menu-testing-menu-container li:hover ul, .estella-navigation-second li:hover ul',
		) );

		// border color (on hover)
		$border_color_hover_selectors = apply_filters('estella_border_color_hover_selectors_array', array(
			'.estella-pagination a:hover',
			'.estella-pagination .next:hover',
			'.estella-pagination .prev:hover',
			'.estella-pagination .last:hover',
		) );

		self::generate_css( $color_hover_selectors, 'color', 'hover_link_color', false, false, '#dd9933' );
		self::generate_css( $background_color_hover_selectors, 'background', 'hover_link_color', false, false, '#dd9933' );
		self::generate_css( $border_color_hover_selectors, 'border-color', 'hover_link_color', false, false, '#dd9933' );


	}
/*color theme end*/

}
new Estella_Customizer_Front();