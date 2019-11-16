<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package grip
 */
global $grip_theme_options;
$grip_theme_options = grip_get_options_value();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>
<body <?php body_class();?> <?php  grip_do_microdata('body');  ?>>
<?php
//wp_body_open hook from WordPress 5.2
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}
?>
<div id="page" class="site">
    <?php
    /**
     * grip_before_header hook.
     *
     * @since 1.0.0
     *
     * @hooked grip_do_skip_to_content_link - 10
     *
     */
    do_action('grip_before_header');


    /**
     * grip_header_start_container hook.
     *
     * @since 1.0.0
     *
     */
    do_action('grip_header_start');

    /**
     * grip_header hook.
     *
     * @since 1.0.0
     *
     * @hooked grip_construct_header - 10
     */
    do_action('grip_header');

    /**
     * grip_header_end_container hook.
     *
     * @since 1.0.0
     *
     */
    do_action('grip_header_end');

    /**
     * grip_after_header hook.
     *
     * @since 1.0.0
     *
     */
    do_action('grip_after_header');


    //Check if slider is enabled from customizer
    if ($grip_theme_options['grip-enable-slider'] == 1):
        /**
         * grip_carousel hook.
         *
         * @since 1.0.0
         *
         * @hooked grip_constuct_carousel - 10
         */
        do_action('grip_carousel');
    endif;
    ?>

    <div id="content" class="site-content">
        <?php
        $container_class = !is_page_template('elementor_header_footer') ? 'container-inner' : 'container-outer';
        ?>
        <div class="<?php esc_attr_e($container_class); ?> clear">