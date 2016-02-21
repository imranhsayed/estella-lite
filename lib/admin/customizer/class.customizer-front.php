<?php

/**
 * Handles frontend
 */

class estella_Customizer_Front extends estella_Customizer_Admin
{

	public function __construct()
	{
		// Output custom CSS to live site
		add_action( 'wp_head' , array( $this , 'header_output' ) );
		add_action( 'wp_enqueue_scripts' , array( $this, 'enqueue_font' ) );
	}

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 */
	public function header_output() {
		do_action( 'estella_customizer_header_output' );
		$favicon = get_theme_mod( 'estella_favicon' );

	   if( $favicon ) { ?>
	   <link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>" />
	   <?php } ?>

	   <!--Customizer CSS-->
	   <style type="text/css"><?php self::custom_css(); ?></style>
	   <!--/Customizer CSS-->

	   <?php
	}

	public function enqueue_font()
	{
		$special_font_url = estella_library_get_google_font_uri( 'estella_special_font', 'Arizonia' , 'estella_special_font_variant' , 'estella_special_font_subset' );
		$body_font_url    = estella_library_get_google_font_uri( 'estella_body_font', 'Source Sans Pro', 'estella_body_font_variant', 'estella_body_font_subset' );

		if( $special_font_url ) wp_enqueue_style( 'estella_special_font' , $special_font_url );
		if( $body_font_url ) wp_enqueue_style( 'estella_body_font' , $body_font_url );
	}

	/**
	 * Generates all css
	 * @return css output
	 */
	public static function custom_css()
	{
		//Backgroud image and background color is handled by wordpress

		do_action('estella_customizer_custom_css');
	}

}



new estella_Customizer_Front();