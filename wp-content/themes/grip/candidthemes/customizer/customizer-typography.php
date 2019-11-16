<?php 
/**
 *  Grip Typography Option
 *
 * @since Grip 1.0.0
 *
 */
/*Font and Typography Options*/
$wp_customize->add_section( 'grip_font_options', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Typography Options', 'grip' ),
   'panel' 		 => 'grip_panel',
) );
/*Font Family URL*/
$wp_customize->add_setting( 'grip_options[grip-font-family-url]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-font-family-url'],
    'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( 'grip_options[grip-font-family-url]', array(
    'label'     => __( 'URL of Font Family', 'grip' ),
    'description' => sprintf('%1$s <a href="%2$s" target="_blank">%3$s</a> %4$s',
        __( 'Insert', 'grip' ),
        esc_url('https://www.google.com/fonts'),
        __('Enter Google Font URL' , 'grip'),
        __('to add google Font.' ,'grip')
    ),
    'section'   => 'grip_font_options',
    'settings'  => 'grip_options[grip-font-family-url]',
    'type'      => 'url',
    'priority'  => 15,
) );
/*Font Family Name*/
$wp_customize->add_setting( 'grip_options[grip-font-family-name]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-font-family-name'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'grip_options[grip-font-family-name]', array(
    'label'     => __( 'Font Name', 'grip' ),
    'description' => __('Add Font Name here, Example: Barlow Semi Condensed, sans-serif', 'grip'),
    'section'   => 'grip_font_options',
    'settings'  => 'grip_options[grip-font-family-name]',
    'type'      => 'text',
    'priority'  => 15,
) );
/*Paragraph font Size*/
$wp_customize->add_setting( 'grip_options[grip-font-paragraph-font-size]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-font-paragraph-font-size'],
    'sanitize_callback' => 'grip_sanitize_number_range'
) );
$wp_customize->add_control( 'grip_options[grip-font-paragraph-font-size]', array(
    'label'     => __( 'Paragraph Font Size', 'grip' ),
    'description' => __('Size apply only for paragraphs, not headings. Font size between 12px to 20px.', 'grip'),
    'section'   => 'grip_font_options',
    'settings'  => 'grip_options[grip-font-paragraph-font-size]',
    'type'      => 'number',
    'priority'  => 15,
    'input_attrs' => array(
     'min' => 12,
     'max' => 20,
     'step' => 1,
 ),
) );