<?php
/**
 * Header Hook Element.
 *
 * @package grip
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


if (!function_exists('grip_do_skip_to_content_link')) {
    /**
     * Add skip to content link before the header.
     *
     * @since 1.0.0
     */
    function grip_do_skip_to_content_link()
    {
        ?>
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'grip'); ?></a>
        <?php
    }
}
add_action('grip_before_header', 'grip_do_skip_to_content_link', 10);

if (!function_exists('grip_header_start_container')) {
    /**
     * Add header html open tag
     *
     * @since 1.0.0
     */
    function grip_header_start_container()
    {
        ?>
        <header id="masthead" class="site-header" <?php grip_do_microdata('header'); ?>>
        <?php

    }
}
add_action('grip_header_start', 'grip_header_start_container', 10);


if (!function_exists('grip_construct_header')) {
    /**
     * Add header block.
     *
     * @since 1.0.0
     */
    function grip_construct_header()
    {
        /**
         * grip_after_header_open hook.
         *
         * @since 1.0.0
         *
         */
        do_action('grip_after_header_open');
        ?>
        <div class="overlay"></div>
        <?php
        global $grip_theme_options;

        //Check if top header is enabled from customizer
        if ($grip_theme_options['grip-enable-top-header'] == 1):

            /**
             * grip_top_bar hook.
             *
             * @since 1.0.0
             *
             * @hooked grip_before_top_bar - 5
             * @hooked grip_trending_news - 10
             * @hooked grip_top_header_right_start - 15
             * @hooked grip_top_social_menu - 20
             * @hooked grip_top_menu - 25
             * @hooked grip_top_search - 30
             * @hooked grip_top_header_right_end - 35
             * @hooked grip_after_top_bar - 40
             */
            do_action('grip_top_bar');
        endif; // $grip_theme_options['grip-enable-top-header']


        /**
         * grip_main_header hook.
         *
         * @since 1.0.0
         *
         * @hooked grip_construct_main_header - 10
         *
         */
        do_action('grip_main_header');


        /**
         * grip_main_navigation hook.
         *
         * @since 1.0.0
         *
         * @hooked grip_construct_main_navigation - 10
         *
         */
        do_action('grip_main_navigation');


        /**
         * grip_before_header_close hook.
         *
         * @since 1.0.0
         *
         */
        do_action('grip_before_header_close');

    }
}
add_action('grip_header', 'grip_construct_header', 10);


if (!function_exists('grip_header_end_container')) {
    /**
     * Add header html close tag
     *
     * @since 1.0.0
     */
    function grip_header_end_container()
    {
        ?>
        </header><!-- #masthead -->
        <?php

    }
}
add_action('grip_header_end', 'grip_header_end_container', 10);