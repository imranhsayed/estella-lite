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

	public static function generate_css( $selector, $property, $mod_name, $prefix = '', $postfix = '', $default = false, $echo = true )
	{
	      $return = '';

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
	         $return = ( isset($mod) && ! empty( $mod ) ) ?
	                sprintf('%s { %s:%s; }', $selector, $property, $prefix.$mod.$postfix) :
	                false;
	    }

	    if( $echo ){
	      echo $return;
	    }
	    else{
	      return $return;
	    }
	}

}
new Estella_Customizer_Front();