<?php
/**
 *  Grip Blog Page Option
 *
 * @since Grip 1.0.0
 *
 */
/*Blog Page Options*/
$wp_customize->add_section( 'grip_blog_page_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Blog Section Options', 'grip' ),
   'panel' 		 => 'grip_panel',
) );
/*Blog Page column number*/
$wp_customize->add_setting( 'grip_options[grip-column-blog-page]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-column-blog-page'],
    'sanitize_callback' => 'grip_sanitize_select'
) );
$wp_customize->add_control( 'grip_options[grip-column-blog-page]', array(
   'choices' => array(
    'one-column'    => __('Single Column','grip'),
    'two-columns'       => __('Two Column','grip'),
),
   'label'     => __( 'Blog Layout Column', 'grip' ),
   'description' => __('You can change the blog page and archive page layouts', 'grip'),
   'section'   => 'grip_blog_page_section',
   'settings'  => 'grip_options[grip-column-blog-page]',
   'type'      => 'select',
   'priority'  => 20,
) );
/*Blog Page Show content from*/
$wp_customize->add_setting( 'grip_options[grip-content-show-from]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-content-show-from'],
    'sanitize_callback' => 'grip_sanitize_select'
) );
$wp_customize->add_control( 'grip_options[grip-content-show-from]', array(
   'choices' => array(
    'excerpt'    => __('Excerpt','grip'),
    'content'    => __('Content','grip')
),
   'label'     => __( 'Select Content Display Option', 'grip' ),
   'description' => __('You can enable excerpt from Screen Options inside post section of dashboard', 'grip'),
   'section'   => 'grip_blog_page_section',
   'settings'  => 'grip_options[grip-content-show-from]',
   'type'      => 'select',
   'priority'  => 30,
) );
/*Blog Page excerpt length*/
$wp_customize->add_setting( 'grip_options[grip-excerpt-length]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-excerpt-length'],
    'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'grip_options[grip-excerpt-length]', array(
    'label'     => __( 'Size of Excerpt Content', 'grip' ),
    'description' => __('Enter the number per Words to show the content in blog page.', 'grip'),
    'section'   => 'grip_blog_page_section',
    'settings'  => 'grip_options[grip-excerpt-length]',
    'type'      => 'number',
    'priority'  => 40,
) );
/*Blog Page Pagination Options*/
$wp_customize->add_setting( 'grip_options[grip-pagination-options]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-pagination-options'],
    'sanitize_callback' => 'grip_sanitize_select'
) );
$wp_customize->add_control( 'grip_options[grip-pagination-options]', array(
   'choices' => array(
    'default'    => __('Default','grip'),
    'numeric'    => __('Numeric','grip')
),
   'label'     => __( 'Pagination Types', 'grip' ),
   'description' => __('Select the Required Pagination Type', 'grip'),
   'section'   => 'grip_blog_page_section',
   'settings'  => 'grip_options[grip-pagination-options]',
   'type'      => 'select',
   'priority'  => 50,
) );
/*Blog Page read more text*/
$wp_customize->add_setting( 'grip_options[grip-read-more-text]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-read-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'grip_options[grip-read-more-text]', array(
    'label'     => __( 'Enter Read More Text', 'grip' ),
    'description' => __('Read more text for blog and archive page.', 'grip'),
    'section'   => 'grip_blog_page_section',
    'settings'  => 'grip_options[grip-read-more-text]',
    'type'      => 'text',
    'priority'  => 60,
) );

/*Blog Page social sharing*/
$wp_customize->add_setting( 'grip_options[grip-enable-blog-sharing]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-enable-blog-sharing'],
    'sanitize_callback' => 'grip_sanitize_checkbox'
) );
$wp_customize->add_control( 'grip_options[grip-enable-blog-sharing]', array(
    'label'     => __( 'Enable Social Sharing', 'grip' ),
    'description' => __('Checked to Enable Social Sharing In Home Page,  Search Page and Archive page.', 'grip'),
    'section'   => 'grip_blog_page_section',
    'settings'  => 'grip_options[grip-enable-blog-sharing]',
    'type'      => 'checkbox',
    'priority'  => 70,
) );