<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since estella 1.0
 */

class estella_Customizer_Admin extends estella_Customizer {

	public function __construct()
	{
		// Setup the Theme Customizer settings and controls...
		add_action( 'customize_register' , array( $this , 'register' ) );

		// Enqueue live preview javascript in Theme Customizer admin screen
		add_action( 'customize_preview_init' , array( $this , 'live_preview' ) );

    add_action( 'customize_controls_enqueue_scripts', array( $this , 'load_customizer_controls_scripts' )  );

    add_action( 'wp_ajax_estella_load_variants_subsets' , array( $this, 'load_variants_subsets' ) );

	}

   /**
    * This hooks into 'customize_register' (available as of WP 3.4) and allows
    * you to add new sections and controls to the Theme Customize screen.
    *
    * Note: To enable instant preview, we have to actually write a bit of custom
    * javascript. See live_preview() for more.
    *
    * @see add_action('customize_register',$func)
    * @param \WP_Customize_Manager $wp_customize
    * @since estella 1.0
    */
   public static function register ( $wp_customize )
   {

          /*==============================
                MEDIA SECTION
      ===============================*/

      $wp_customize->add_section( 'estella_social_media_section', array(
          'title'       => __('Social Media', 'estella'),
          'description' => __('Example for Phone url: tel:+13174562564', 'estella'),
          'priority'    => 50,
          'capability'  => 'edit_theme_options',
      ) );

      $estella_social_sites = estella_customizer_social_media_array();

      foreach($estella_social_sites as $estella_social_site)
      {
          $wp_customize->add_setting( "estella_mod[{$estella_social_site}]", array(
              'sanitize_callback' => 'esc_url_raw',
              'capability'        => 'edit_theme_options',
          ) );

          $wp_customize->add_control( "estella_mod[{$estella_social_site}]" , array(
              'label'    => sprintf( __( "%s url:", 'estella' ) , $estella_social_site ),
              'settings' => "estella_mod[{$estella_social_site}]",
              'section'  => 'estella_social_media_section',
              'type'     => 'text',
              'priority' => 10,
          ) );
      }





      /*==============================
            Site title & Tagline
      ===============================*/

      //Logo
      $wp_customize->add_setting( 'estella_logo',
         array(
            'default'           => "",
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
         ));

      $wp_customize->add_control(
            new WP_Customize_Image_Control($wp_customize, 'estella_logo',
             array(
                'label'    => __( 'Choose Site Logo', 'estella' ),
                'section'  => 'title_tagline',
                'settings' => 'estella_logo',
                'description' => __( 'Remove logo to display site title.' , 'estella' )
             )
      ));

      //Hide tagline
      $wp_customize->add_setting( 'estella_hide_tagline', array(
          'default' => '',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'estella_sanitize_checkboxes',
      ));

      $wp_customize->add_control(
          new WP_Customize_Control(
          $wp_customize, 'estella_hide_tagline', array(
              'label'    => __( 'Hide Tagline', 'estella' ),
              'section'  => 'title_tagline',
              'settings' => 'estella_hide_tagline',
              'type'     => 'checkbox',
          ))
      );


      /************************** GENERAL ***************************/

      $wp_customize->add_panel( 'estella_general_panel',
        array(
            'priority'       => 10,
            'capability'     => 'edit_theme_options',
            'theme_supports' => '',
            'title'          => __( 'General', 'estella' ),
        ));

      /*==============================
                  FAVICON
      ===============================*/

      $wp_customize->add_section( 'estella_favicon_section',
         array(
            'title'       => __( 'Favicon', 'estella' ),
            'capability'  => 'edit_theme_options',
            'description' => __('', 'estella'), //Descriptive tooltip
            'panel'       => 'estella_general_panel'
        ));

      $wp_customize->add_setting( 'estella_favicon',
         array(
            'default'    => "",
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw',
         ));

      $wp_customize->add_control(
            new WP_Customize_Image_Control($wp_customize, 'estella_favicon',
             array(
                'label'    => __( 'Choose Favicon', 'estella' ),
                'section'  => 'estella_favicon_section',
                'settings' => 'estella_favicon',
             )
      ));

      /*==============================
                SIDEBAR POSITIONS
      ===============================*/

      $wp_customize->add_section( 'estella_sidebar_position_section',
         array(
            'title'       => __( 'Sidebar Position', 'estella' ),
            'capability'  => 'edit_theme_options',
            'description' => __('', 'estella'), //Descriptive tooltip
            'panel'       => 'estella_general_panel'
        ));

      $wp_customize->add_setting( 'estella_sidebar_position', array(
          'default' => 'right',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'estella_sanitize_choices',
      ));

      $wp_customize->add_control(
          new WP_Customize_Control(
          $wp_customize, 'estella_sidebar_position', array(
              'label'    => __( 'Sidebar Position', 'estella' ),
              'section'  => 'estella_sidebar_position_section',
              'settings' => 'estella_sidebar_position',
              'type'     => 'radio',
              'choices'  => array( 'left' => __( 'Left' , 'estella' ) , 'right' => __( 'Right' , 'estella' )  )
          ))
      );

      /*==============================
            Footer Copyright Text
      ===============================*/

      $wp_customize->add_section( 'estella_copyright_text_section',
         array(
            'title'       => __( 'Copyright Text', 'estella' ),
            'capability'  => 'edit_theme_options',
            'description' => __('Will override the footer copyright text', 'estella'), //Descriptive tooltip
            'panel'       => 'estella_general_panel'
        ));


      //SPECIAL FONTS
      $wp_customize->add_setting( 'estella_copyright_text',
         array(
            'default'           => '',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
         ));

      $wp_customize->add_control(
              'estella_copyright_text',
             array(
                'label'    => __( 'Copyright Text', 'estella' ),
                'section'  => 'estella_copyright_text_section',
                'settings' => 'estella_copyright_text',
                'type'     => 'text',
             )
      );

      /*==============================
                SLIDER
      ===============================*/

      $wp_customize->add_panel( 'estella_pannel', array(
          'priority'       => 10,
          'capability'     => 'edit_theme_options',
          'title'          => __( 'Slider Options', 'estella' ),
          'description'    => __( 'Add slider', 'estella' ),
      ) );

      for ( $i=1; $i <= 8; $i++ )
      {
        $wp_customize->add_section( 'estella_section_' . $i, array(
            'priority'       => 10,
            'capability'     => 'edit_theme_options',
            'title'          => sprintf( __( 'Slide %s' , 'estella' ), $i ),
            'description'    => __( 'Add slide', 'estella' ),
            'panel'          => 'estella_pannel',
        ) );

        $wp_customize->add_setting( 'estella_slides['.$i.'][title]', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control( 'estella_slides['.$i.'][title]', array(
            'priority' => 10,
            'section'  => 'estella_section_' . $i,
            'label'    => __( 'Title', 'estella' ),
            'settings' => 'estella_slides['.$i.'][title]',
        ) );

        $wp_customize->add_setting( 'estella_slides['.$i.'][description]', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control( 'estella_slides['.$i.'][description]', array(
            'priority' => 10,
            'section'  => 'estella_section_' . $i,
            'label'    => __('Description', 'estella' ),
            'settings' => 'estella_slides['.$i.'][description]',
        ) );

        $wp_customize->add_setting( 'estella_slides['.$i.'][link]', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control( 'estella_slides['.$i.'][link]', array(
            'priority' => 10,
            'section'  => 'estella_section_' . $i,
            'label'    => __( 'Link', 'estella' ),
            'settings' => 'estella_slides['.$i.'][link]',
        ) );

        $wp_customize->add_setting( 'estella_slides['.$i.'][image]', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'capability'        => 'edit_theme_options',
        ) );

        $wp_customize->add_control( new WP_Customize_Image_Control ( $wp_customize, 'estella_slides['.$i.'][image]', array(
            'priority' => 10,
            'section'  => 'estella_section_' . $i,
            'label'    => __( 'Image', 'estella' ),
            'settings' => 'estella_slides['.$i.'][image]',
        ) ) );

      }

      //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
      $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
      $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
      $wp_customize->remove_control('header_image');
      //$wp_customize->remove_control('header_textcolor');

   }

   /**
    * This outputs the javascript needed to automate the live settings preview.
    * Also keep in mind that this function isn't necessary unless your settings
    * are using 'transport'=>'postMessage' instead of the default 'transport'
    * => 'refresh'
    *
    * Used by hook: 'customize_preview_init'
    *
    * @see add_action('customize_preview_init',$func)
    * @since estella 1.0
    */
   public static function live_preview() {
      //To avoid caching during development
      wp_enqueue_script(
           'estella-themecustomizer', // Give the script a unique ID
           estella_CUSTOMIZER_JS . '/customizer-live-preview.js',
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '1.0', // Define a version (optional)
           true // Specify whether to put in footer (leave this true)
      );
   }

   public function load_customizer_controls_scripts()
   {
      wp_enqueue_script(
           'estella-customizer-control-scripts', // Give the script a unique ID
           estella_CUSTOMIZER_JS . '/customizer-control.js',
           array(  'jquery' ), // Define dependencies
           '1.0', // Define a version (optional)
           true // Specify whether to put in footer (leave this true)
      );

   }

   public function load_variants_subsets()
   {
      $font_value = isset($_REQUEST['font_value']) ? $_REQUEST['font_value'] : false;

      $variants = estella_get_google_fonts_variants( false, false, $font_value );
      $subsets = estella_get_google_fonts_subsets( false, false, $font_value );

      echo json_encode( array( 'variants' => $variants, 'subsets' => $subsets ) );

      die();
   }

}

new estella_Customizer_Admin();
