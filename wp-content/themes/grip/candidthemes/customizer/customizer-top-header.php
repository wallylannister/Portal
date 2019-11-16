<?php
/**
 *  Grip Top Header Option
 *
 * @since Grip 1.0.0
 *
 */
/*Top Header Options*/
$wp_customize->add_section( 'grip_header_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Top Header Options', 'grip' ),
   'panel' 		 => 'grip_panel',
) );
/*callback functions header section*/
if ( !function_exists('grip_header_active_callback') ) :
  function grip_header_active_callback(){
      global $grip_theme_options;
      $enable_header = absint($grip_theme_options['grip-enable-top-header']);
      if( 1 == $enable_header ){
          return true;
      }
      else{
          return false;
      }
  }
endif;
/*Enable Top Header Section*/
$wp_customize->add_setting( 'grip_options[grip-enable-top-header]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['grip-enable-top-header'],
   'sanitize_callback' => 'grip_sanitize_checkbox'
) );
$wp_customize->add_control( 'grip_options[grip-enable-top-header]', array(
   'label'     => __( 'Enable Top Header', 'grip' ),
   'description' => __('Checked to show the top header section like search and social icons', 'grip'),
   'section'   => 'grip_header_section',
   'settings'  => 'grip_options[grip-enable-top-header]',
   'type'      => 'checkbox',
   'priority'  => 5,
) );
/*Enable Social Icons In Header*/
$wp_customize->add_setting( 'grip_options[grip-enable-top-header-social]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['grip-enable-top-header-social'],
   'sanitize_callback' => 'grip_sanitize_checkbox'
) );
$wp_customize->add_control( 'grip_options[grip-enable-top-header-social]', array(
   'label'     => __( 'Enable Social Icons', 'grip' ),
   'description' => __('You can show the social icons here. Manage social icons from Appearance > Menus. Social Menu will display here.', 'grip'),
   'section'   => 'grip_header_section',
   'settings'  => 'grip_options[grip-enable-top-header-social]',
   'type'      => 'checkbox',
   'priority'  => 5,
   'active_callback'=>'grip_header_active_callback'
) );
/*Enable Search Icons In Header*/
$wp_customize->add_setting( 'grip_options[grip-enable-top-header-search]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['grip-enable-top-header-search'],
   'sanitize_callback' => 'grip_sanitize_checkbox'
) );
$wp_customize->add_control( 'grip_options[grip-enable-top-header-search]', array(
   'label'     => __( 'Enable Search Icons', 'grip' ),
   'description' => __('You can show the search field in header.', 'grip'),
   'section'   => 'grip_header_section',
   'settings'  => 'grip_options[grip-enable-top-header-search]',
   'type'      => 'checkbox',
   'priority'  => 5,
   'active_callback'=>'grip_header_active_callback'
) );
/*Enable Menu in top Header*/
$wp_customize->add_setting( 'grip_options[grip-enable-top-header-menu]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-enable-top-header-menu'],
    'sanitize_callback' => 'grip_sanitize_checkbox'
) );
$wp_customize->add_control( 'grip_options[grip-enable-top-header-menu]', array(
    'label'     => __( 'Menu in Header', 'grip' ),
    'description' => __('Top Header Menu will display here. Go to Appearance < Menu.', 'grip'),
    'section'   => 'grip_header_section',
    'settings'  => 'grip_options[grip-enable-top-header-menu]',
    'type'      => 'checkbox',
    'priority'  => 5,
    'active_callback'=>'grip_header_active_callback'
) );

/*Trending News*/
$wp_customize->add_setting( 'grip_options[grip-enable-trending-news]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-enable-trending-news'],
    'sanitize_callback' => 'grip_sanitize_checkbox'
) );
$wp_customize->add_control( 'grip_options[grip-enable-trending-news]', array(
    'label'     => __( 'Trending News in Header', 'grip' ),
    'description' => __('Trending News will appear on the top header.', 'grip'),
    'section'   => 'grip_header_section',
    'settings'  => 'grip_options[grip-enable-trending-news]',
    'type'      => 'checkbox',
    'priority'  => 5,
    'active_callback'=>'grip_header_active_callback'
) );

/*Slider Category Selection*/
$wp_customize->add_setting( 'grip_options[grip-trending-news-category]', array(
  'capability'        => 'edit_theme_options',
  'transport' => 'refresh',
  'default'           => $default['grip-trending-news-category'],
  'sanitize_callback' => 'absint'
) );
$wp_customize->add_control(
  new grip_Customize_Category_Dropdown_Control(
    $wp_customize,
    'grip_options[grip-trending-news-category]',
    array(
      'label'     => __( 'Select Category For Trending News', 'grip' ),
      'description' => __('Select the category from dropdown. It will appear on the header.', 'grip'),
      'section'   => 'grip_header_section',
      'settings'  => 'grip_options[grip-trending-news-category]',
      'type'      => 'category_dropdown',
      'priority'  => 5,
      'active_callback'=>'grip_header_active_callback'
    )
  )
);

/*Trending News*/
$wp_customize->add_setting( 'grip_options[grip-enable-trending-news-text]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-enable-trending-news-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'grip_options[grip-enable-trending-news-text]', array(
    'label'     => __( 'Trending News Text', 'grip' ),
    'description' => __('Write your own text in place of Trending news.', 'grip'),
    'section'   => 'grip_header_section',
    'settings'  => 'grip_options[grip-enable-trending-news-text]',
    'type'      => 'text',
    'priority'  => 5,
    'active_callback'=>'grip_header_active_callback'
) );