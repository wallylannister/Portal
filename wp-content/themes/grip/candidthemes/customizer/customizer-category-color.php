<?php
/**
 *  Grip Category Color Option
 *
 * @since Grip 1.0.0
 *
 */
/*Category Color Options*/
$wp_customize->add_section('grip_category_color_setting', array(
    'priority'      => 40,
    'title'         => __('Category Color', 'grip'),
    'description'   => __('You can select the different color for each category.', 'grip'),
    'panel'          => 'grip_panel'
));

/*Enable Top Header Section*/
$wp_customize->add_setting( 'grip_options[grip-enable-category-color]', array(
   'capability'        => 'edit_theme_options',
   'transport' => 'refresh',
   'default'           => $default['grip-enable-category-color'],
   'sanitize_callback' => 'grip_sanitize_checkbox'
) );
$wp_customize->add_control( 'grip_options[grip-enable-category-color]', array(
   'label'     => __( 'Enable Category Color', 'grip' ),
   'description' => __('Checked to enable the category color and select the required color for each category.', 'grip'),
   'section'   => 'grip_category_color_setting',
   'settings'  => 'grip_options[grip-enable-category-color]',
   'type'      => 'checkbox',
   'priority'  => 1,
) );

/*callback functions header section*/
if ( !function_exists('grip_colors_active_callback') ) :
  function grip_colors_active_callback(){
      global $grip_theme_options;
      $enable_color = absint($grip_theme_options['grip-enable-category-color']);
      if( 1 == $enable_color ){
          return true;
      }
      else{
          return false;
      }
  }
endif;

$i = 1;
$args = array(
    'orderby' => 'id',
    'hide_empty' => 0
);
$categories = get_categories( $args );
$wp_category_list = array();
foreach ($categories as $category_list ) {
    $wp_category_list[$category_list->cat_ID] = $category_list->cat_name;

    $wp_customize->add_setting('grip_theme_options[cat-'.get_cat_id($wp_category_list[$category_list->cat_ID]).']', array(
        'default'           => $default['grip-primary-color'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(
    	new WP_Customize_Color_Control(
    		$wp_customize,
		    'grip_theme_options[cat-'.get_cat_id($wp_category_list[$category_list->cat_ID]).']',
		    array(
		    	'label'     => sprintf(__('"%s" Color', 'grip'), $wp_category_list[$category_list->cat_ID] ),
			    'section'   => 'grip_category_color_setting',
			    'settings'  => 'grip_theme_options[cat-'.get_cat_id($wp_category_list[$category_list->cat_ID]).']',
			    'priority'  => $i,
                'active_callback'   => 'grip_colors_active_callback'
		    )
	    )
    );
    $i++;
}