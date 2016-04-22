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
                COLORS
      ===============================*/

      $theme_colors = apply_filters('estella_theme_colors_array', array(
            array(
                      'slug'    =>'estella_mod[theme_color]',
                      'default' => '#daa520',
                      'label'   => __( 'Theme Color', 'estella' )
                  ),
            array(
                      'slug'    =>'estella_mod[hover_link_color]',
                      'default' => '#dd9933',
                      'label'   => __( 'Link Color (on hover)', 'estella' )
                  ),
            array(
                      'slug'    =>'estella_mod[header_textcolor]',
                      'default' => '#424242',
                      'label'   => __( 'Site Title Color', 'estella' )
                  ),
            array(
                      'slug'    =>'estella_mod[header_taglinecolor]',
                      'default' => '#424242',
                      'label'   => __( 'Site Tagline Color', 'estella' )
                  ),
            array(
                      'slug'    =>'estella_mod[header_background]',
                      'default' => '#ffffff',
                      'label'   => __( 'Header Background Color', 'estella' )
                  ),
            array(
                      'slug'    =>'estella_mod[estella-footer-widgets_background]',
                      'default' => '#fff',
                      'label'   => __( 'Footer widgets background color', 'estella' )
                  ),
            array(
                      'slug'    =>'estella_mod[estella-footer-widgets_textcolor]',
                      'default' => '#424242',
                      'label'   => __( 'Footer widgets text color', 'estella' )
                  ),

            array(
                      'slug'    =>'estella_mod[estella-footer-widgets_linkcolor]',
                      'default' => '#424242',
                      'label'   => __( 'Footer widgets link color', 'estella' )
                  ),
            array(
                      'slug'    =>'estella_mod[estella-footer_bottom_background_color]',
                      'default' => '#222',
                      'label'   => __( 'Footer bottom background color', 'estella' )
                  ),
            array(
                      'slug'    =>'estella_mod[estella-footer_bottom_textcolor]',
                      'default' => '#868686',
                      'label'   => __( 'Footer bottom text color', 'estella' )
                  ),
            array(
                      'slug'    =>'estella_mod[primary_nav_background_color]',
                      'default' => '#222222',
                      'label'   => __( 'Primary Menu Background Color', 'estella' )
                  ),
            array(
                      'slug'    =>'estella_mod[estella_primary_nav_color]',
                      'default' => '#fff',
                      'label'   => __( 'Primary Menu Color', 'estella' )
                  ),
            array(
                      'slug'    =>'estella_mod[secondary_nav_background_color]',
                      'default' => '#222222',
                      'label'   => __( 'Secondary Background Color', 'estella' )
                  ),
            ) );

      foreach( $theme_colors as $theme_color ) {
        $wp_customize->add_setting(
            $theme_color['slug'], array(
                'default'           => $theme_color['default'],
                'sanitize_callback' => 'sanitize_hex_color',
                'capability'        => 'edit_theme_options',
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $theme_color['slug'],
                array(
                'label'    => $theme_color['label'],
                'section'  => 'colors',
                'settings' => $theme_color['slug'],
                )
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
              'open-sans' => 'Open Sans',
              'pt-sans'   => 'PT Sans',
              'oxygen'    => 'Oxygen',
              'lato'      => 'Lato',
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

      /*==============================
                Extras
      ===============================*/


      $wp_customize->add_panel( 'estella_extras_pannel', array(
          'priority'       => 10,
          'capability'     => 'edit_theme_options',
          'title'          => __( 'Extras', 'estella' ),
      ) );

      //Header
      $wp_customize->add_section( 'estella_header_section' , array(
          'priority'       => 10,
          'capability'     => 'edit_theme_options',
          'title'          => esc_html__( "Header" , 'estella' ),
          'panel'          => 'estella_extras_pannel',
      ) );

      $wp_customize->add_setting( 'estella_show_search', array(
          'sanitize_callback' => 'sanitize_text_field',
          'default'        => true,
          'capability'     => 'edit_theme_options'
      ) );

      $wp_customize->add_control( 'estella_show_search', array(
          'settings' => 'estella_show_search',
          'label'    => 'Show Search',
          'section'  => 'estella_header_section',
          'type'     => 'checkbox'
      ) );

      //Posts

      $wp_customize->add_section( 'estella_posts_section' , array(
          'priority'       => 10,
          'capability'     => 'edit_theme_options',
          'title'          => esc_html__( "Posts" , 'estella' ),
          'panel'          => 'estella_extras_pannel',
      ) );

      $wp_customize->add_setting( 'estella_show_title_in_posts', array(
          'default'        => true,
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
      ) );

      $wp_customize->add_control( 'estella_show_title_in_posts', array(
          'settings' => 'estella_show_title_in_posts',
          'label'    => 'Show Title in posts',
          'section'  => 'estella_posts_section',
          'type'     => 'checkbox'
      ) );



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

function estella_sanitize_choices( $input, $setting ) {
  global $wp_customize;

  $control = $wp_customize->get_control( $setting->id );

  if ( array_key_exists( $input, $control->choices ) ) {
    return $input;
  } else {
    return $setting->default;
  }
}

new Estella_Customizer();
