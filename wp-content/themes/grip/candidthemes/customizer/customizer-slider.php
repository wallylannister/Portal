<?php
/**
 *  Grip Slider Option
 *
 * @since Grip 1.0.0
 *
 */
/*Slider Options*/
$wp_customize->add_section( 'grip_slider_section', array(
 'priority'       => 20,
 'capability'     => 'edit_theme_options',
 'theme_supports' => '',
 'title'          => __( 'Featured Section', 'grip' ),
 'panel' 		 => 'grip_panel',
) );
/*callback functions slider*/
if ( !function_exists('grip_slider_active_callback') ) :
  function grip_slider_active_callback(){
    global $grip_theme_options;
    $enable_slider = absint($grip_theme_options['grip-enable-slider']);
    if( 1 == $enable_slider ){
      return true;
    }
    else{
      return false;
    }
  }
endif;
/*Slider Enable Option*/
$wp_customize->add_setting( 'grip_options[grip-enable-slider]', array(
 'capability'        => 'edit_theme_options',
 'transport' => 'refresh',
 'default'           => $default['grip-enable-slider'],
 'sanitize_callback' => 'grip_sanitize_checkbox'
) );
$wp_customize->add_control( 'grip_options[grip-enable-slider]', array(
 'label'     => __( 'Enable Featured Section', 'grip' ),
 'description' => __('Checked to Featured Section In Home Page.', 'grip'),
 'section'   => 'grip_slider_section',
 'settings'  => 'grip_options[grip-enable-slider]',
 'type'      => 'checkbox',
 'priority'  => 5,
) );
/*Slider Category Selection*/
$wp_customize->add_setting( 'grip_options[grip-select-category]', array(
  'capability'        => 'edit_theme_options',
  'transport' => 'refresh',
  'default'           => $default['grip-select-category'],
  'sanitize_callback' => 'absint'
) );
$wp_customize->add_control(
  new grip_Customize_Category_Dropdown_Control(
    $wp_customize,
    'grip_options[grip-select-category]',
    array(
      'label'     => __( 'Select Category For Featured Section', 'grip' ),
      'description' => __('From the dropdown select the category for the featured section. Category having post will display in below dropdown.', 'grip'),
      'section'   => 'grip_slider_section',
      'settings'  => 'grip_options[grip-select-category]',
      'type'      => 'category_dropdown',
      'priority'  => 5,
      'active_callback'=>'grip_slider_active_callback'
    )
  )
);