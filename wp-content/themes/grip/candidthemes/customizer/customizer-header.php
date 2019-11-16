<?php
/**
 *  Grip Header Option
 *
 * @since Grip 1.0.0
 *
 */
/*Top Header Options*/
$wp_customize->add_section( 'grip_header_ads_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Header Ads Options', 'grip' ),
   'panel' 		 => 'grip_panel',
) );
/*callback functions header section*/
if ( !function_exists('grip_ads_header_active_callback') ) :
  function grip_ads_header_active_callback(){
      global $grip_theme_options;
      $enable_ads_header = absint($grip_theme_options['grip-enable-ads-header']);
      if( 1 == $enable_ads_header ){
          return true;
      }
      else{
          return false;
      }
  }
endif;

/*Enable Top Header Section*/
$wp_customize->add_setting( 'grip_options[grip-enable-ads-header]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['grip-enable-ads-header'],
   'sanitize_callback' => 'grip_sanitize_checkbox'
) );
$wp_customize->add_control( 'grip_options[grip-enable-ads-header]', array(
   'label'     => __( 'Show Header Advertisement', 'grip' ),
   'description' => __('Checked to Enable the header ads. You will get the option to add adsese code in Premium version.', 'grip'),
   'section'   => 'grip_header_ads_section',
   'settings'  => 'grip_options[grip-enable-ads-header]',
   'type'      => 'checkbox',
   'priority'  => 10,
) );

/*Header Ads Image*/
$wp_customize->add_setting( 'grip_options[grip-header-ads-image]', array(
    'capability'    => 'edit_theme_options',
    'default'     => $default['grip-header-ads-image'],
    'sanitize_callback' => 'grip_sanitize_image'
) );
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'grip_options[grip-header-ads-image]',
        array(
            'label'   => __( 'Header Ad Image', 'grip' ),
            'section'   => 'grip_header_ads_section',
            'settings'  => 'grip_options[grip-header-ads-image]',
            'type'      => 'image',
            'priority'  => 10,
            'active_callback' => 'grip_ads_header_active_callback',
            'description' => __( 'Recommended image size of 728*90', 'grip' )
        )
    )
);

/*Ads Image Link*/
$wp_customize->add_setting( 'grip_options[grip-header-ads-image-link]', array(
    'capability'    => 'edit_theme_options',
    'default'     => $default['grip-header-ads-image-link'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'grip_options[grip-header-ads-image-link]', array(
    'label'   => __( 'Header Ads Image Link', 'grip' ),
    'section'   => 'grip_header_ads_section',
    'settings'  => 'grip_options[grip-header-ads-image-link]',
    'type'      => 'url',
    'active_callback' => 'grip_ads_header_active_callback',
    'priority'  => 20
) );