<?php
/**
 * Grip Theme Customizer default values
 *
 * @package Grip
 */
if ( !function_exists('grip_default_theme_options_values') ) :
    function grip_default_theme_options_values() {
        $default_theme_options = array(
            /*Top Header Section Default Value*/
            'grip-primary-color' => '#ff005b',
            /*Top Header Section Default Value*/
            'grip-enable-top-header'=> true,
            'grip-enable-top-header-social'=> true,
            'grip-enable-top-header-search'=> true,
            'grip-enable-top-header-menu'=> true,
            'grip-enable-trending-news' => true,
            'grip-enable-trending-news-text'=> esc_html__('Trending News','grip'),
            'grip-trending-news-category'=> 0,
            /*Header Ads Default Value*/
            'grip-enable-ads-header'=> false,
            'grip-header-ads-image'=> '',
            'grip-header-ads-image-link'=> 'https://www.candidthemes.com/themes/grip/',
            /*Slider Section Default Value*/
            'grip-enable-slider' => true,
            'grip-select-category'=> 0,

            /*Sidebars Default Value*/
            'grip-sidebar-blog-page'=>'right-sidebar',
            'grip-sidebar-front-page' => 'right-sidebar',
            'grip-sidebar-archive-page'=> 'right-sidebar',
            /*Blog Page Default Value*/
            'grip-column-blog-page'=> 'one-column',
            'grip-content-show-from'=>'excerpt',
            'grip-excerpt-length'=>25,
            'grip-pagination-options'=>'numeric',
            'grip-read-more-text'=> esc_html__('Read More','grip'),
            'grip-enable-blog-sharing'=> true,
            /*Single Page Default Value*/
            'grip-single-page-featured-image'=> true,
            'grip-single-page-related-posts'=> true,
            'grip-single-page-related-posts-title'=> esc_html__('Related Posts','grip'),
            'grip-enable-single-sharing'=> true,
            /*Sticky Sidebar Options*/
            'grip-enable-sticky-sidebar'=> true,
            /*Footer Section*/
            'grip-footer-copyright' =>  esc_html__('All Right Reserved 2019.','grip'),
            'grip-go-to-top'=> true,
            /*Font Options*/
            'grip-font-family-url'=> esc_url('//fonts.googleapis.com/css?family=Roboto:300', 'grip'),
            'grip-font-family-name'=> esc_html__('Roboto, sans-serif', 'grip'),
            'grip-font-paragraph-font-size'=> 16,
            /*Extra Options*/
            'grip-extra-breadcrumb'=> true,
            'grip-breadcrumb-text'=>  esc_html__('You are Here','grip'),
            'grip-enable-category-color'=>false,
            /*Home Page Content Hide*/
            'grip-front-page-content' => false,
        );
        return apply_filters( 'grip_default_theme_options_values', $default_theme_options );
    }
endif;

/**
 *  Grip Theme Options and Settings
 *
 * @since Grip 1.0.0
 *
 * @param null
 * @return array grip_get_options_value
 *
 */
if ( !function_exists('grip_get_options_value') ) :
    function grip_get_options_value() {
        $grip_default_theme_options_values = grip_default_theme_options_values();
        $grip_get_options_value = get_theme_mod( 'grip_options');
        if( is_array( $grip_get_options_value )){
            return array_merge( $grip_default_theme_options_values, $grip_get_options_value );
        }
        else{
            return $grip_default_theme_options_values;
        }
    }
endif;