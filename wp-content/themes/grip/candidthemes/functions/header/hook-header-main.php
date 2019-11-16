<?php
/**
 * Main Header Hook Element.
 *
 * @package grip
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('grip_construct_main_header')) {
    /**
     * Add main header block
     *
     * @since 1.0.0
     */
    function grip_construct_main_header()
    {
        ?>
        <?php

        $has_header_image = has_header_image();
        if (!empty($has_header_image)) {
            ?>
            <div class="logo-wrapper-block" style="background-image: url(<?php echo header_image(); ?>);">
            <?php
        } else {
            ?>
            <div class="logo-wrapper-block">
            <?php
        }
        ?>
        <div class="container-inner clear logo-wrapper-container">
        <div class="logo-wrapper float-left">
            <div class="site-branding">

                <div class="grip-logo-container">
                    <?php
                    if (function_exists('the_custom_logo')) {

                        the_custom_logo();

                    }
                    if (is_front_page() && is_home()) : ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                                  rel="home"><?php bloginfo('name'); ?></a></h1>
                    <?php else : ?>
                        <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                                 rel="home"><?php bloginfo('name'); ?></a></p>
                    <?php
                    endif;

                    $description = get_bloginfo('description', 'display');
                    if ($description || is_customize_preview()) : ?>
                        <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                    <?php
                    endif; ?>
                </div> <!-- grip-logo-container -->
            </div><!-- .site-branding -->
        </div> <!-- .logo-wrapper -->
        <?php
        global $grip_theme_options;
        //Check if header advertisement is enabled from customizer
        if ($grip_theme_options['grip-enable-ads-header'] == 1):
            $grip_header_ad_image = esc_url($grip_theme_options['grip-header-ads-image']);
            $grip_header_ad_url = esc_url($grip_theme_options['grip-header-ads-image-link']);
            ?>
            <div class="logo-right-wrapper float-right clear">
                <?php
                if (!empty($grip_header_ad_image) && (!empty($grip_header_ad_url))) {
                    ?>
                    <a href="<?php echo $grip_header_ad_url ?>" target="_blank"> <img
                                src="<?php echo $grip_header_ad_image; ?>" class="float-right"> </a>
                    <?php
                } else if (!empty($grip_header_ad_image)) {
                    ?>
                    <img src="<?php echo $grip_header_ad_image; ?>" class="float-right">
                    <?php
                }
                ?>
            </div> <!-- .logo-right-wrapper -->
        <?php
        endif;
        ?>
        </div> <!-- .container-inner -->
        </div> <!-- .logo-wrapper-block -->
        <?php
    }
}
add_action('grip_main_header', 'grip_construct_main_header', 10);