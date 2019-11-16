<?php
/**
 * Single Post Hook Element.
 *
 * @package grip
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
/**
 * Display sidebar
 *
 * @param none
 * @return void
 *
 * @since Grip 1.0.0
 *
 */
if (!function_exists('grip_construct_sidebar')) :

    function grip_construct_sidebar()
    {
        /*  * Adds sidebar based on customizer option
      *
           * @since Grip 1.0.0
      */
        global $grip_theme_options;
        $sidebar = $grip_theme_options['grip-sidebar-archive-page'] ? $grip_theme_options['grip-sidebar-archive-page'] : 'right-sidebar';
        if (is_singular()) {
            $sidebar = $grip_theme_options['grip-sidebar-blog-page'] ? $grip_theme_options['grip-sidebar-blog-page'] : 'right-sidebar';
        }
        if (is_front_page()) {
            $sidebar = $grip_theme_options['grip-sidebar-front-page'] ? $grip_theme_options['grip-sidebar-front-page'] : 'right-sidebar';
        }
        if (($sidebar == 'right-sidebar') || ($sidebar == 'left-sidebar')) {
            get_sidebar();
        }
    }
endif;
add_action('grip_sidebar', 'grip_construct_sidebar', 10);

/**
 * Display Breadcrumb
 *
 * @param none
 * @return void
 *
 * @since Grip 1.0.0
 *
 */
if (!function_exists('grip_construct_breadcrumb')) :

    function grip_construct_breadcrumb()
    {
        global $grip_theme_options;
        //Check if breadcrumb is enabled from customizer
        if ($grip_theme_options['grip-extra-breadcrumb'] == 1):
            /**
             * Adds Breadcrumb based on customizer option
             *
             * @since Grip 1.0.0
             */
            ?>
            <div class="breadcrumbs">
                <?php
                $breadcrumb_args = array(
                    'container' => 'div',
                    'show_browse' => false
                );

                $grip_you_are_here_text = esc_html($grip_theme_options['grip-breadcrumb-text']);
                if (!empty($grip_you_are_here_text)) {
                    $grip_you_are_here_text = "<span class='breadcrumb'>" . $grip_you_are_here_text . "</span>";
                }
                echo "<div class='breadcrumbs init-animate clearfix'>" . $grip_you_are_here_text . "<div id='grip-breadcrumbs' class='clearfix'>";
                breadcrumb_trail($breadcrumb_args);
                echo "</div></div>";
                ?>
            </div>
        <?php
        endif;
    }
endif;
add_action('grip_breadcrumb', 'grip_construct_breadcrumb', 10);


/**
 * Filter to change excerpt lenght size
 *
 * @since 1.0.0
 */
if (!function_exists('grip_alter_excerpt')) :
    function grip_alter_excerpt($length)
    {
        if (is_admin()) {
            return $length;
        }
        global $grip_theme_options;
        $grip_excerpt_length = absint($grip_theme_options['grip-excerpt-length']);
        if (!empty($grip_excerpt_length)) {
            return $grip_excerpt_length;
        }
        return 50;
    }
endif;
add_filter('excerpt_length', 'grip_alter_excerpt');


/**
 * Post Navigation Function
 *
 * @param null
 * @return void
 *
 * @since 1.0.0
 *
 */
if (!function_exists('grip_posts_navigation')) :
    function grip_posts_navigation()
    {
        global $grip_theme_options;
        $grip_pagination_option = $grip_theme_options['grip-pagination-options'];
        if ($grip_pagination_option == 'default') {
            the_posts_navigation();
        } else {
            echo "<div class='candid-pagination'>";
            global $wp_query;
            $big = 999999999; // need an unlikely integer
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $wp_query->max_num_pages,
                'prev_text' => __('&laquo; Prev', 'grip'),
                'next_text' => __('Next &raquo;', 'grip'),
            ));
            echo "</div>";
        }
    }
endif;
add_action('grip_action_navigation', 'grip_posts_navigation', 10);


/**
 * Social Sharing Hook *
 * @param int $post_id
 * @return void
 *
 * @since 1.0.0
 *
 */
if (!function_exists('grip_constuct_social_sharing')) :
    function grip_constuct_social_sharing($post_id)
    {
        global $grip_theme_options;
        $grip_enable_blog_sharing = $grip_theme_options['grip-enable-blog-sharing'];
        $grip_enable_single_sharing = $grip_theme_options['grip-enable-single-sharing'];
        if (($grip_enable_blog_sharing != 1) && (!is_singular())) {
            return;
        }
        if (($grip_enable_single_sharing != 1) && (is_singular())) {
            return;
        }
        $grip_url = get_the_permalink($post_id);
        $grip_title = get_the_title($post_id);
        $grip_image = get_the_post_thumbnail_url($post_id);

        //sharing url
        $grip_twitter_sharing_url = esc_url('http://twitter.com/share?text=' . $grip_title . '&url=' . $grip_url);
        $grip_facebook_sharing_url = esc_url('https://www.facebook.com/sharer/sharer.php?u=' . $grip_url);
        $grip_pinterest_sharing_url = esc_url('http://pinterest.com/pin/create/button/?url=' . $grip_url . '&media=' . $grip_image . '&description=' . $grip_title);
        $grip_linkedin_sharing_url = esc_url('http://www.linkedin.com/shareArticle?mini=true&title=' . $grip_title . '&url=' . $grip_url);

        ?>
        <div class="meta_bottom">
            <div class="text_share header-text"><?php _e('Share', 'grip'); ?></div>
            <div class="post-share">
                <a target="_blank" href="<?php echo $grip_facebook_sharing_url; ?>"><i class="fa fa-facebook"></i></a>
                <a target="_blank" href="<?php echo $grip_twitter_sharing_url; ?>"><i class="fa fa-twitter"></i></a>
                <a target="_blank" href="<?php echo $grip_pinterest_sharing_url; ?>"><i class="fa fa-pinterest"></i></a>
                <a target="_blank" href="<?php echo $grip_linkedin_sharing_url; ?>"><i class="fa fa-linkedin"></i></a>
            </div>
        </div>
        <?php
    }
endif;
add_action('grip_social_sharing', 'grip_constuct_social_sharing', 10);