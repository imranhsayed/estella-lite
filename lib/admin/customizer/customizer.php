<?php
  /**
   * Contains options for Customizer Admin
   * @package estella
   * @since estella 1.0
   */

class Estella_Customizer {

   public function __construct()
   {
      // Setup the Theme Customizer settings and controls...
      add_action( 'customize_register' , array( $this , 'register' ) );

      // Enqueue live preview javascript in Theme Customizer admin screen
      add_action( 'customize_preview_init' , array( $this , 'live_preview' ) );
   }

   /**
   * Add postMessage support for site title and description for the Customizer.
   * @param WP_Customize_Manager $wp_customize Customizer object.
   */
  public static function register ( $wp_customize ) {

      /*==============================
                MEDIA SECTION
      ===============================*/

      $wp_customize->add_section( 'estella_social_media_section', array(
          'title'      => __('Social Media', 'estella'),
          'priority'   => 50,
          'capability' => 'edit_theme_options',

      ) );

      $estella_social_sites = estella_customizer_social_media_array();

      foreach($estella_social_sites as $estella_social_site)
      {
          $wp_customize->add_setting( "estella_mod[{$estella_social_site}]", array(
              'default'           => '',
              'sanitize_callback' => 'esc_url_raw',
              'capability'        => 'edit_theme_options',

          ));

          $wp_customize->add_control( "estella_mod[{$estella_social_site}]" , array(
              'label'    => sprintf( __( "%s url:", 'estella' ) , $estella_social_site ),
              'settings' => "estella_mod[{$estella_social_site}]",
              'section'  => 'estella_social_media_section',
              'type'     => 'text',
              'priority' => 10,
          ) );
      }




      /*==============================
                      SLIDER
            ===============================*/



            $wp_customize->add_panel( 'estella_slider_pannel', array(
                'priority'       => 10,
                'capability'     => 'edit_theme_options',
                'title'          => __( 'Slider Options', 'estella' ),
                'description'    => __( 'Add slider', 'estella' ),
            ) );

            for ( $i=1; $i <= 8; $i++ ) {

            $wp_customize->add_section( 'estella_slider_section_' . $i, array(
                'priority'       => 10,
                'capability'     => 'edit_theme_options',
                'title'          => sprintf( __( 'Slide %s' , 'estella' ), $i ),
                'description'    => __( 'Add slides', 'estella' ),
                'panel'          => 'estella_slider_pannel',
            ) );

            $wp_customize->add_setting( 'estella_slides['.$i.'][title]', array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
                'capability'        => 'edit_theme_options',
            ) );

            $wp_customize->add_control( 'estella_slides['.$i.'][title]', array(
                'priority' => 10,
                'section'  => 'estella_slider_section_' . $i,
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
                'section'  => 'estella_slider_section_' . $i,
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
                'section'  => 'estella_slider_section_' . $i,
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
                'section'  => 'estella_slider_section_' . $i,
                'label'    => __( 'Image', 'estella' ),
                'settings' => 'estella_slides['.$i.'][image]',
            ) ) );


      }


      //Theme Font

      $wp_customize->add_section('estella_font_section', array(
          'title'         => __( 'Theme Font', 'estella' ),
          'capability'  => 'edit_theme_options',

      ) );

      $wp_customize->add_setting('estella_mod[theme_font]', array(
          'default'           => 'Open Sans',
          'sanitize_callback' => 'estella_sanitize_choices',
          'transport'         => 'postMessage',
          'capability'        => 'edit_theme_options',
      ) );

      $wp_customize->add_control('estella_mod[theme_font]', array(
          'section'       => 'estella_font_section',
          'label'         => __( 'Theme Font', 'estella' ),
          'type'          => 'select',
          'settings'      => 'estella_mod[theme_font]',
          'choices'       => array(
              'sansserif' => 'sans-serif',
              'serif'     => 'serif',
              'courier'   => 'Courier New',
              'open-sans' => 'Open Sans',
      ) ) );


      /*==============================
              LOGO & FAVICON
      ===============================*/

      //Upload logo

      $wp_customize->add_setting( 'estella_mod[upload_logo]', array(
          'sanitize_callback' => 'esc_url_raw',
          'capability'        => 'edit_theme_options',
      ) );

      $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'estella_mod[upload_logo]', array(
          'label'    => __( 'Upload logo', 'estella' ),
          'section'  => 'title_tagline',
          'settings' => 'estella_mod[upload_logo]',
      ) ) );



      // We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
      $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

  }


   /**
    * This outputs the javascript needed to automate the live settings preview.
    * Also keep in mind that this function isn't necessary unless your settings
    * are using 'transport'=>'postMessage' instead of the default 'transport'
    * @since estella 1.0
    */
  public static function live_preview() {
    wp_enqueue_script(
        'estella-themecustomizer', // Give the script a unique ID
        get_template_directory_uri() . '/js/theme-customizer.js', // Define the path to the JS file
        array(  'jquery', 'customize-preview' ), // Define dependencies
        '1.0', // Define a version (optional)
        true // Specify whether to put in footer (leave this true)
    );

  }

}

new Estella_Customizer();
