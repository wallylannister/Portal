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
 * Display related posts from same category
 *
 * @since 1.0.0
 *
 * @param int $post_id
 * @return void
 *
 */
if (!function_exists('grip_related_post')) :

    function grip_related_post($post_id)
    {

        global $grip_theme_options;
        if ($grip_theme_options['grip-single-page-related-posts'] == 0) {
            return;
        }
        $categories = get_the_category($post_id);
        if ($categories) {
            $category_ids = array();
            $category = get_category($category_ids);
            $categories = get_the_category($post_id);
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }
            $count = $category->category_count;
            if ($count > 1) { ?>
                <div class="related-pots-block">
                    <?php
                    $grip_related_post_title = $grip_theme_options['grip-single-page-related-posts-title'];
                    if(!empty($grip_related_post_title)):
                    ?>
                    <h2 class="widget-title">
                        <span class="ct-title-head ct-rotate"> <?php echo $grip_related_post_title; ?> </span>
                    </h2>
                    <?php
                    endif;
                    ?>
                    <ul class="related-post-entries clear">
                        <?php
                        $grip_cat_post_args = array(
                            'category__in' => $category_ids,
                            'post__not_in' => array($post_id),
                            'post_type' => 'post',
                            'posts_per_page' => 3,
                            'post_status' => 'publish',
                            'ignore_sticky_posts' => true
                        );
                        $grip_featured_query = new WP_Query($grip_cat_post_args);

                        while ($grip_featured_query->have_posts()) : $grip_featured_query->the_post();
                            ?>
                            <li>
                                <?php
                                if (has_post_thumbnail()):
                                    ?>
                                    <figure class="widget-image">
                                        <a href="<?php the_permalink() ?>">
                                            <?php the_post_thumbnail('grip-small-thumb'); ?>
                                        </a>
                                    </figure>
                                <?php
                                endif;
                                ?>
                                <div class="featured-desc">
                                    <h2 class="related-title">
                                        <a href="<?php the_permalink() ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>

                                    <div class="entry-meta">
                                        <?php
                                        grip_posted_on();
                                        ?>
                                    </div><!-- .entry-meta -->
                                </div>
                            </li>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </ul>
                </div> <!-- .related-post-block -->
                <?php
            }
        }
    }
endif;
add_action('grip_related_posts', 'grip_related_post', 10, 1);