<?php 
/**
 *  Grip Footer Option
 *
 * @since Grip 1.0.0
 *
 */
/*Footer Options*/
$wp_customize->add_section( 'grip_footer_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Footer Options', 'grip' ),
   'panel' 		 => 'grip_panel',
) );
/*Copyright Setting*/
$wp_customize->add_setting( 'grip_options[grip-footer-copyright]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-footer-copyright'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'grip_options[grip-footer-copyright]', array(
    'label'     => __( 'Copyright Text', 'grip' ),
    'description' => __('Enter your own copyright text.', 'grip'),
    'section'   => 'grip_footer_section',
    'settings'  => 'grip_options[grip-footer-copyright]',
    'type'      => 'text',
    'priority'  => 15,
) );
/*Go to Top Setting*/
$wp_customize->add_setting( 'grip_options[grip-go-to-top]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-go-to-top'],
    'sanitize_callback' => 'grip_sanitize_checkbox'
) );
$wp_customize->add_control( 'grip_options[grip-go-to-top]', array(
    'label'     => __( 'Enable Go to Top', 'grip' ),
    'description' => __('Checked to Enable Go to Top', 'grip'),
    'section'   => 'grip_footer_section',
    'settings'  => 'grip_options[grip-go-to-top]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );