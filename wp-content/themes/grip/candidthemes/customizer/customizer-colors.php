<?php 
/**
 *  Grip Color Option
 *
 * @since Grip 1.0.0
 *
 */
/* Primary Color Section Inside Core Color Option */
$wp_customize->add_setting( 'grip_options[grip-primary-color]',
    array(
        'default'           => $default['grip-primary-color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(                 
        $wp_customize,
        'grip_options[grip-primary-color]',
        array(
            'label'       => esc_html__( 'Primary Color', 'grip' ),
            'description' => esc_html__( 'Applied to main color of site.', 'grip' ),
            'section'     => 'colors',  
        )
    )
);