<?php
/**
 *  Grip Sidebar Option
 *
 * @since Grip 1.0.0
 *
 */
/*Blog Page Options*/
$wp_customize->add_section( 'grip_sidebar_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Sidebar Options', 'grip' ),
   'panel' 		 => 'grip_panel',
) );
/*Front Page Sidebar Layout*/
$wp_customize->add_setting( 'grip_options[grip-sidebar-blog-page]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-sidebar-blog-page'],
    'sanitize_callback' => 'grip_sanitize_select'
) );
$wp_customize->add_control( 'grip_options[grip-sidebar-blog-page]', array(
   'choices' => array(
    'right-sidebar'   => __('Right Sidebar','grip'),
    'left-sidebar'    => __('Left Sidebar','grip'),
    'no-sidebar'      => __('No Sidebar','grip'),
    'middle-column'   => __('Middle Column','grip')
),
   'label'     => __( 'Inner Pages Sidebar', 'grip' ),
   'description' => __('This sidebar will work for all Pages', 'grip'),
   'section'   => 'grip_sidebar_section',
   'settings'  => 'grip_options[grip-sidebar-blog-page]',
   'type'      => 'select',
   'priority'  => 10,
) );

/*Front Page Sidebar Layout*/
$wp_customize->add_setting( 'grip_options[grip-sidebar-front-page]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-sidebar-front-page'],
    'sanitize_callback' => 'grip_sanitize_select'
) );
$wp_customize->add_control( 'grip_options[grip-sidebar-front-page]', array(
   'choices' => array(
    'right-sidebar'   => __('Right Sidebar','grip'),
    'left-sidebar'    => __('Left Sidebar','grip'),
    'no-sidebar'      => __('No Sidebar','grip'),
    'middle-column'   => __('Middle Column','grip')
),
   'label'     => __( 'Front Page Sidebar', 'grip' ),
   'description' => __('This sidebar will work for Front Page', 'grip'),
   'section'   => 'grip_sidebar_section',
   'settings'  => 'grip_options[grip-sidebar-front-page]',
   'type'      => 'select',
   'priority'  => 10,
) );

/*Archive Page Sidebar Layout*/
$wp_customize->add_setting( 'grip_options[grip-sidebar-archive-page]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-sidebar-archive-page'],
    'sanitize_callback' => 'grip_sanitize_select'
) );
$wp_customize->add_control( 'grip_options[grip-sidebar-archive-page]', array(
   'choices' => array(
    'right-sidebar'   => __('Right Sidebar','grip'),
    'left-sidebar'    => __('Left Sidebar','grip'),
    'no-sidebar'      => __('No Sidebar','grip'),
    'middle-column'   => __('Middle Column','grip')
),
   'label'     => __( 'Archive Page Sidebar', 'grip' ),
   'description' => __('This sidebar will work for all Archive Pages', 'grip'),
   'section'   => 'grip_sidebar_section',
   'settings'  => 'grip_options[grip-sidebar-archive-page]',
   'type'      => 'select',
   'priority'  => 10,
) );