<?php
/**
 * Dynamic CSS elements.
 *
 * @package grip
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


if (!function_exists('grip_dynamic_css')) :
    /**
     * Dynamic CSS
     *
     * @since 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function grip_dynamic_css()
    {

        global $grip_theme_options;
        $grip_font_family = $grip_theme_options['grip-font-family-name'] ?  wp_kses_post( $grip_theme_options['grip-font-family-name'] ) :  esc_html__('Poppins, sans-serif', 'grip');
        $grip_font_size = $grip_theme_options['grip-font-paragraph-font-size'] ? absint( $grip_theme_options['grip-font-paragraph-font-size'] ) : 16;
        $grip_primary_color = $grip_theme_options['grip-primary-color'] ?  esc_attr( $grip_theme_options['grip-primary-color'] ) : '#ff8800';
        $grip_header_color = get_header_textcolor();
        $grip_custom_css = '';

        if (!empty($grip_header_color)) {
            $grip_custom_css .= ".site-title, .site-title a { color: #{$grip_header_color}; }";
        }

        /* Typography Section */
        if (!empty($grip_font_family)) {
            $grip_custom_css .= "body { font-family: {$grip_font_family}; }";
        }

        if (!empty($grip_font_size)) {
            $grip_custom_css .= "body { font-size: {$grip_font_size}px; }";
        }

        /* Primary Color Section */
        if (!empty($grip_primary_color)) {
            //font-color
            $grip_custom_css .= ".entry-content a, .entry-title a:hover, .related-title a:hover, .posts-navigation .nav-previous a:hover, .post-navigation .nav-previous a:hover, .posts-navigation .nav-next a:hover, .post-navigation .nav-next a:hover, #comments .comment-content a:hover, #comments .comment-author a:hover, .main-navigation ul li a:hover, .main-navigation ul li.current-menu-item > a, .offcanvas-menu nav ul.top-menu li a:hover, .offcanvas-menu nav ul.top-menu li.current-menu-item > a, .post-share a:hover, .error-404-title, #grip-breadcrumbs a:hover, .entry-content a.read-more-text:hover, . { color : {$grip_primary_color}; }";

            //background-color
            $grip_custom_css .= ".trending-title, .search-form input[type=submit], input[type=\"submit\"], ::selection, #toTop, .breadcrumbs span.breadcrumb, article.sticky .grip-content-container, .candid-pagination .page-numbers.current, .candid-pagination .page-numbers:hover, .ct-title-head, .widget-title:before, .widget ul.ct-nav-tabs:before, .widget ul.ct-nav-tabs li.ct-title-head:hover, .widget ul.ct-nav-tabs li.ct-title-head.ui-tabs-active { background : {$grip_primary_color}; }";

            //border-color
            $grip_custom_css .= "blockquote, .search-form input[type=\"submit\"], input[type=\"submit\"], .candid-pagination .page-numbers { border-color : {$grip_primary_color}; }";
        }

        wp_add_inline_style('grip-style', $grip_custom_css);
    }
endif;
add_action('wp_enqueue_scripts', 'grip_dynamic_css', 99);