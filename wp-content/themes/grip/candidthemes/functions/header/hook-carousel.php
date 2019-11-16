<?php
/**
 * Main Navigation Hook Element.
 *
 * @package grip
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('grip_constuct_carousel')) {
    /**
     * Add carousel on header
     *
     * @since 1.0.0
     */
    function grip_constuct_carousel()
    {
        ?>
        <?php
        if (is_front_page()) {
            global $grip_theme_options;
            //Check if search is enabled from customizer
            if ($grip_theme_options['grip-enable-slider'] == 1):
                $featured_cat = $grip_theme_options['grip-select-category'];
                $query_args = array(
                    'post_type' => 'post',
                    'ignore_sticky_posts' => true,
                    'posts_per_page' => 5,
                    'cat' => $featured_cat
                );

                $query = new WP_Query($query_args);
                $count = $query->post_count;
                //echo $count;
                if ($query->have_posts()) :
                    $i = 1;
                    ?>
                    <div class="grip-featured-block grip-ct-row clear">

                        <?php
                        while ($query->have_posts()) :
                            $query->the_post();
                            if ($i == 1) {
                                ?>
                                <div class="grip-col">
                                    <div class="featured-section-inner ct-post-overlay">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            ?>
                                            <div class="post-thumb">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('grip-carousel-img'); ?>
                                                </a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="featured-section-details post-content">
                                            <h3 class="post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="post-meta">
                                                <?php grip_posted_on(); ?>
                                            </div>
                                        </div>
                                    </div> <!-- .featured-section-inner -->
                                </div><!--.grip-col-->

                                <?php
                            } else {
                                if ($i == 2) {
                                    ?>
                                    <div class="grip-col grip-col-2">
                                    <div class="grip-inner-row clear">
                                    <?php
                                }
                                ?>
                                <div class="grip-col">
                                    <div class="featured-section-inner ct-post-overlay">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            ?>
                                            <div class="post-thumb">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('grip-carousel-img'); ?>
                                                </a>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                        <div class="featured-section-details post-content">
                                            <h3 class="post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="post-meta">
                                                <?php grip_posted_on(); ?>
                                            </div>
                                        </div>
                                    </div> <!-- .featured-section-inner -->
                                </div><!--.grip-col-->
                                <?php
                                if ($i == $count) {
                                    ?>
                                    </div>
                                    </div><!--.grip-col-->
                                    <?php
                                }
                            }
                            $i++;
                        endwhile;
                        wp_reset_postdata()
                        ?>
                    </div><!-- .grip-ct-row-->
                <?php
                endif;
            endif;
        }//is_front_page
    }
}
add_action('grip_carousel', 'grip_constuct_carousel', 10);