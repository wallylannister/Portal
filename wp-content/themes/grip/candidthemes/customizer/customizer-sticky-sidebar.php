<?php 
/**
 *  Grip Sticky Sidebar Option
 *
 * @since Grip 1.0.0
 *
 */
/*Sticky Sidebar Setting*/
$wp_customize->add_setting( 'grip_options[grip-enable-sticky-sidebar]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-enable-sticky-sidebar'],
    'sanitize_callback' => 'grip_sanitize_checkbox'
) );
$wp_customize->add_control( 'grip_options[grip-enable-sticky-sidebar]', array(
    'label'     => __( 'Sticky Sidebar Option', 'grip' ),
    'description' => __('Enable and Disable sticky sidebar from this section.', 'grip'),
    'section'   => 'grip_sticky_sidebar',
    'settings'  => 'grip_options[grip-enable-sticky-sidebar]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );