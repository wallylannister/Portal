<?php
/**
 * Front page hook for all WordPress Conditions
 *
 * @param null
 * @return null
 *
 * @since Grip 1.1.0
 *
 */
if (!function_exists('grip_front_page')) :

    function grip_front_page()
    {
        ?>
        <?php
        if (is_active_sidebar('grip-home-widget-area')) {
            dynamic_sidebar('grip-home-widget-area');
        }
        global $grip_theme_options;
        $grip_front_page_content = $grip_theme_options['grip-front-page-content'];
        if (false === $grip_front_page_content) {
            if ('posts' == get_option('show_on_front')) {
                if (have_posts()) :
                    /* Start the Loop */
                    while (have_posts()) : the_post();

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part('template-parts/content', get_post_format());
                    endwhile;
                    /**
                     * grip_post_navigation hook
                     * @since Grip 1.0.0
                     *
                     * @hooked grip_posts_navigation -  10
                     */
                    do_action('grip_action_navigation');

                else :
                    get_template_part('template-parts/content', 'none');
                endif;
            } else {
                while (have_posts()) : the_post();
                    get_template_part('template-parts/content', 'page');

                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                endwhile; // End of the loop.
            }
        }
    }

    ?>
<?php
endif;
add_action('grip_action_front_page', 'grip_front_page', 10);


/**
 * Header elements.
 *
 * @package grip
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
/**
 * Function to list categories of a post
 *
 * @param int $post_id
 * @return void Lists of categories with its link
 *
 * @since 1.0.0
 *
 */
if (!function_exists('grip_list_category')) :
    function grip_list_category($post_id = 0)
    {

        if (0 == $post_id) {
            global $post;
            if (isset($post->ID)) {
                $post_id = $post->ID;
            }
        }
        if (0 == $post_id) {
            return null;
        }
        $categories = get_the_category($post_id);
        $separator = '&nbsp;';
        $output = '';
        if ($categories) {
            $output .= '<span class="cat-name"><i class="fa fa-folder-open"></i>';
            foreach ($categories as $category) {
                $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '"  rel="category tag">' . esc_html($category->cat_name) . '</a>' . $separator;
            }
            $output .= '</span>';
            echo trim($output, $separator);
        }

    }
endif;


/**
 * Function to modify tag clouds font size
 *
 * @param none
 * @return array $args
 *
 * @since 1.0.0
 *
 */
if (!function_exists('grip_tag_cloud_widget')) :
    function grip_tag_cloud_widget($args)
    {
        $args['largest'] = 12; //largest tag
        $args['smallest'] = 12; //smallest tag
        $args['unit'] = 'px'; //tag font unit
        return $args;
    }
endif;
add_filter('widget_tag_cloud_args', 'grip_tag_cloud_widget');


/**
 * Callback functions for comments
 *
 * @param $comment
 * @param $args
 * @param $depth
 * @return void
 *
 * @since 1.0.0
 *
 */
if (!function_exists('grip_commment_list')) :

    function grip_commment_list($comment, $args, $depth)
    {
        $args['avatar_size'] = apply_filters('grip_comment_avatar_size', 50);

        if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) : ?>

            <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
            <div class="comment-body">
                <?php _e('Pingback:', 'grip'); // WPCS: XSS OK. ?><?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'grip'), '<span class="edit-link">', '</span>'); ?>
            </div>

        <?php else : ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
            <article id="div-comment-<?php comment_ID(); ?>"
                     class="comment-body" <?php grip_do_microdata('comment-body'); ?>>
                <footer class="comment-meta">
                    <?php
                    if (0 != $args['avatar_size']) {
                        echo get_avatar($comment, $args['avatar_size']);
                    }
                    ?>
                    <div class="comment-author-info">
                        <div class="comment-author vcard" <?php grip_do_microdata('comment-author'); ?>>
                            <?php printf('<span itemprop="name" class="fn"><strong>%s</strong></span>', get_comment_author_link()); ?>
                        </div><!-- .comment-author -->

                        <div class="entry-meta comment-metadata">
                            <span><i class="fa fa-calendar"></i><a
                                        href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                                <time datetime="<?php comment_time('c'); ?>" itemprop="datePublished">
                                    <?php printf( // WPCS: XSS OK.
                                    /* translators: 1: date, 2: time */
                                        _x('%1$s at %2$s', '1: date, 2: time', 'grip'),
                                        get_comment_date(),
                                        get_comment_time()
                                    ); ?>s
                                </time>
                            </a></span>
                            <?php edit_comment_link(__('Edit', 'grip'), '<span class="edit-link"><i class="fa fa-pencil"></i> ', '</span>'); ?>
                            <?php
                            comment_reply_link(array_merge($args, array(
                                'add_below' => 'div-comment',
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'],
                                'before' => '<span class="reply"><i class="fa fa-comment-o"></i> ',
                                'after' => '</span>',
                            )));
                            ?>
                        </div><!-- .comment-metadata -->
                    </div><!-- .comment-author-info -->

                    <?php if ('0' == $comment->comment_approved) : ?>
                        <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'grip'); // WPCS: XSS OK. ?></p>
                    <?php endif; ?>
                </footer><!-- .comment-meta -->

                <div class="comment-content" itemprop="text">
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->
            </article><!-- .comment-body -->
        <?php
        endif;
    }
endif;

/**
 * Add sidebar class in body
 *
 * @since 1.0.0
 *
 */
if (!function_exists('grip_custom_body_class')) :
    function grip_custom_body_class($classes)
    {
        global $grip_theme_options;
        $grip_sidebar = $grip_theme_options['grip-sidebar-archive-page'];
        if(is_singular()){
            $grip_sidebar = $grip_theme_options['grip-sidebar-blog-page'];
        }
        if(is_front_page()){
            $grip_sidebar = $grip_theme_options['grip-sidebar-front-page'];
        }
        $grip_sticky_sidebar = $grip_theme_options['grip-enable-sticky-sidebar'];
        $classes[] = 'ct-boxed';
        if ($grip_sticky_sidebar == 1) {
            $classes[] = 'ct-sticky-sidebar';
        }
        if ($grip_sidebar == 'no-sidebar') {
            $classes[] = 'no-sidebar';
        } elseif ($grip_sidebar == 'left-sidebar') {
            $classes[] = 'left-sidebar';
        } elseif ($grip_sidebar == 'middle-column') {
            $classes[] = 'middle-column';
        } else {
            $classes[] = 'right-sidebar';
        }
        return $classes;
    }
endif;

add_filter('body_class', 'grip_custom_body_class');

/**
 * Remove ... From Excerpt
 *
 * @since 1.0.0
 *
 */
if (!function_exists('grip_excerpt_more')) :
    function grip_excerpt_more($more)
    {
        if (!is_admin()) {
            return '';
        }
    }
endif;
add_filter('excerpt_more', 'grip_excerpt_more');


/**
 * Add class in post list
 *
 * @since 1.0.0
 *
 */
add_filter('post_class', 'grip_post_column_class');
function grip_post_column_class($classes)
{
    global $grip_theme_options;
    if (!is_singular()) {
        $classes[] = esc_attr($grip_theme_options['grip-column-blog-page']);
    }
    return $classes;
}