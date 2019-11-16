<?php 
/**
 *  Grip Single Page Option
 *
 * @since Grip 1.0.0
 *
 */
/*Single Page Options*/
$wp_customize->add_section( 'grip_single_page_section', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Single Post Options', 'grip' ),
   'panel' 		 => 'grip_panel',
) );
/*Featured Image Option*/
$wp_customize->add_setting( 'grip_options[grip-single-page-featured-image]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-single-page-featured-image'],
    'sanitize_callback' => 'grip_sanitize_checkbox'
) );
$wp_customize->add_control( 'grip_options[grip-single-page-featured-image]', array(
    'label'     => __( 'Enable Featured Image', 'grip' ),
    'description' => __('You can hide or show featured image on single page.', 'grip'),
    'section'   => 'grip_single_page_section',
    'settings'  => 'grip_options[grip-single-page-featured-image]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );
/*Related Post Options*/
$wp_customize->add_setting( 'grip_options[grip-single-page-related-posts]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-single-page-related-posts'],
    'sanitize_callback' => 'grip_sanitize_checkbox'
) );
$wp_customize->add_control( 'grip_options[grip-single-page-related-posts]', array(
    'label'     => __( 'Enable Related Posts', 'grip' ),
    'description' => __('3 Post from similar category will display at the end of the page.', 'grip'),
    'section'   => 'grip_single_page_section',
    'settings'  => 'grip_options[grip-single-page-related-posts]',
    'type'      => 'checkbox',
    'priority'  => 15,
) );
/*callback functions related posts*/
if ( !function_exists('grip_related_post_callback') ) :
  function grip_related_post_callback(){
      global $grip_theme_options;
      $related_posts = absint($grip_theme_options['grip-single-page-related-posts']);
      if( 1 == $related_posts ){
          return true;
      }
      else{
          return false;
      }
  }
endif;
/*Related Post Title*/
$wp_customize->add_setting( 'grip_options[grip-single-page-related-posts-title]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-single-page-related-posts-title'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'grip_options[grip-single-page-related-posts-title]', array(
    'label'     => __( 'Related Posts Title', 'grip' ),
    'description' => __('Give the appropriate title for related posts', 'grip'),
    'section'   => 'grip_single_page_section',
    'settings'  => 'grip_options[grip-single-page-related-posts-title]',
    'type'      => 'text',
    'priority'  => 15,
    'active_callback'=>'grip_related_post_callback'
) );
/* Single Page social sharing*/
$wp_customize->add_setting( 'grip_options[grip-enable-single-sharing]', array(
    'capability'        => 'edit_theme_options',
    'transport' => 'refresh',
    'default'           => $default['grip-enable-single-sharing'],
    'sanitize_callback' => 'grip_sanitize_checkbox'
) );
$wp_customize->add_control( 'grip_options[grip-enable-single-sharing]', array(
    'label'     => __( 'Enable Social Sharing', 'grip' ),
    'description' => __('Checked to Enable Social Sharing In Single post and page.', 'grip'),
    'section'   => 'grip_single_page_section',
    'settings'  => 'grip_options[grip-enable-single-sharing]',
    'type'      => 'checkbox',
    'priority'  => 20,
) );

/*Sticky Sidebar*/
$wp_customize->add_section( 'grip_sticky_sidebar', array(
   'priority'       => 20,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __( 'Sticky Sidebar', 'grip' ),
   'panel' 		 => 'grip_panel',
) );