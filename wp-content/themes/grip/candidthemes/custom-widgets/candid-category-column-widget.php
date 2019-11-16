<?php
/**
 * Grip Category Column Widget
 *
 * @since 1.0.0
 */
if (!class_exists('Grip_Category_Column')) {
    /**
     * Highlight Post widget class.
     *
     * @since 1.0.0
     */
    class Grip_Category_Column extends WP_Widget
    {
        private function defaults()
        {
            $defaults = array(
                'cat_id_1' => '',
                'cat_id_2' => '',
                'post_number' => 5,
            );
            return $defaults;

        }

        public function __construct()
        {
            $opts = array(
                'classname' => 'grip-cat_column',
                'description' => esc_html__('Two Category Column Widget.', 'grip'),
            );
            parent::__construct('grip_category_column_widget', esc_html__('Grip Category Column', 'grip'), $opts);
        }

        public function widget($args, $instance)
        {
            $instance = wp_parse_args((array)$instance, $this->defaults());

            $cat_id_1 = absint($instance['cat_id_1']);
            $cat_id_2 = absint($instance['cat_id_2']);
            $post_number = absint($instance['post_number']);

            echo $args['before_widget'];
            ?>
            <div class="block">
                <div class="row clear">
                    <div class="ct-two-cols">

                        <h2 class="widget-title">
                            <?php
                            if ($cat_id_1) {
                                ?>
                                <a href="<?php echo esc_url(get_category_link($cat_id_1)); ?>">
                                    <span class="ct-title-head ct-rotate">
                                        <?php echo esc_html(get_cat_name($cat_id_1)); ?>
                                    </span>
                                </a>
                                <?php
                            } else {
                                ?>
                                <span class="ct-title-head ct-rotate">
                                <?php echo esc_html(get_cat_name($cat_id_1)); ?>
                            </span>
                                <?php
                            }
                            ?>
                        </h2>

                        <?php
                        $i = 1;
                        $two_category_section = array(
                            'ignore_sticky_posts' => true,
                            'post_type' => 'post',
                            'cat' => $cat_id_1,
                            'posts_per_page' => $post_number,
                            'order' => 'DESC'
                        );
                        $two_category_section_query = new WP_Query($two_category_section);

                        if ($i == 1) {
                        ?>
                        <div class="ct-post-overlay">
                            <?php
                            while ($two_category_section_query->have_posts()):
                                $two_category_section_query->the_post();
                                $post_class = '';
                                if (has_post_thumbnail()) {

                                    ?>

                                    <div class="post-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('grip-carousel-img'); ?>
                                        </a>
                                    </div>

                                <?php } else {
                                    $post_class = 'post-relative';
                                } ?>
                                <div class="post-content <?php echo $post_class; ?>">
                                    <h3 class="post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="post-meta">
                                        <?php grip_posted_on(); ?>
                                    </div>
                                </div><!-- Post content end -->

                                <?php $i++;
                                break; endwhile;
                            }

                            ?>
                        </div><!-- Post Overaly Article end -->

                        <?php
                        if ($i >= 2)
                        {
                        ?>
                        <div class="list-post-block">
                            <ul class="list-post">
                                <?php
                                while ($two_category_section_query->have_posts()):
                                    $two_category_section_query->the_post();
                                    ?>
                                    <li>
                                        <div class="post-block-style">

                                            <?php

                                            if (has_post_thumbnail()) {
                                                ?>
                                                <div class="post-thumb">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail('thumbnail'); ?>
                                                    </a>
                                                </div><!-- Post thumb end -->
                                            <?php } ?>

                                            <div class="post-content">
                                                <h3 class="post-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                                <div class="post-meta">
                                                    <?php grip_posted_on(); ?>
                                                </div>
                                            </div><!-- Post content end -->
                                        </div><!-- Post block style end -->
                                    </li><!-- Li 1 end -->

                                    <?php $i++; endwhile;
                                wp_reset_postdata();
                                } ?>

                            </ul><!-- List post end -->
                        </div><!-- List post block end -->

                    </div><!-- Col 1 end -->

                    <div class="ct-two-cols">
                        <h2 class="widget-title">
                            <?php
                            if ($cat_id_2) {
                                ?>
                                <a href="<?php echo esc_url(get_category_link($cat_id_2)); ?>">
                                    <span class="ct-title-head ct-rotate">
                                        <?php echo esc_html(get_cat_name($cat_id_2)); ?>
                                    </span>
                                </a>
                                <?php
                            } else {
                                ?>
                                <span class="ct-title-head ct-rotate">
                                <?php echo esc_html(get_cat_name($cat_id_2)); ?>
                            </span>
                                <?php
                            }
                            ?>
                        </h2>
                        <div class="ct-post-overlay clearfix">
                            <?php
                            $i = 1;
                            $two_category_section = array(
                                'ignore_sticky_posts' => true,
                                'post_type' => 'post',
                                'cat' => $cat_id_2,
                                'posts_per_page' => $post_number,
                                'order' => 'DESC'
                            );
                            $two_category_section_query = new WP_Query($two_category_section);

                            if ($i == 1) {

                                $ID = array();
                                while ($two_category_section_query->have_posts()):
                                    $two_category_section_query->the_post();

                                    $ID[] = get_the_ID();

                                    $post_class = '';
                                    if (has_post_thumbnail()) {

                                        ?>

                                        <div class="post-thumb">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('grip-carousel-img'); ?>
                                            </a>
                                        </div>

                                    <?php } else {
                                        $post_class = 'post-relative';
                                    } ?>
                                    <div class="post-content <?php echo $post_class; ?>">
                                        <h3 class="post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="post-meta">
                                            <?php grip_posted_on(); ?>
                                        </div>
                                    </div><!-- Post content end -->

                                    <?php $i++;
                                    break;endwhile;
                            } ?>
                        </div><!-- Post Overaly Article end -->

                        <?php
                        if ($i >= 2) {
                            ?>
                            <div class="list-post-block">
                                <ul class="list-post">
                                    <?php
                                    while ($two_category_section_query->have_posts()):
                                        $two_category_section_query->the_post();
                                        ?>
                                        <li>
                                            <div class="post-block-style">

                                                <?php

                                                if (has_post_thumbnail()) {
                                                    ?>
                                                    <div class="post-thumb">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_post_thumbnail('thumbnail'); ?>
                                                        </a>
                                                    </div><!-- Post thumb end -->
                                                <?php } ?>

                                                <div class="post-content">
                                                    <h3 class="post-title">
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                    <div class="post-meta">
                                                        <?php grip_posted_on(); ?>
                                                    </div>
                                                </div><!-- Post content end -->
                                            </div><!-- Post block style end -->
                                        </li><!-- Li 1 end -->

                                        <?php $i++;endwhile;
                                    wp_reset_postdata(); ?>

                                </ul><!-- List post end -->
                            </div><!-- List post block end -->
                        <?php } ?>
                    </div><!-- Col 2 end -->
                </div><!-- Row end -->
            </div><!-- Block Lifestyle end -->
            <div class="gap-40"></div>

            <?php
            echo $args['after_widget'];
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['cat_id_1'] = (isset($new_instance['cat_id_1'])) ? absint($new_instance['cat_id_1']) : '';
            $instance['cat_id_2'] = (isset($new_instance['cat_id_2'])) ? absint($new_instance['cat_id_2']) : '';
            $instance['post_number'] = absint($new_instance['post_number']);
            return $instance;
        }

        public function form($instance)

        {
            $instance = wp_parse_args((array )$instance, $this->defaults());
            $cat_id_1 = absint($instance['cat_id_1']);
            $cat_id_2 = absint($instance['cat_id_2']);
            $post_number = absint($instance['post_number']);
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('cat_id_1')); ?>">
                    <strong><?php esc_html_e('Select First Category for Column One', 'grip'); ?></strong>
                </label><br/>
                <?php
                $grip_category_col_1_dropown_cat = array(
                    'show_option_none' => esc_html__('Uncategorized', 'grip'),
                    'orderby' => 'name',
                    'order' => 'asc',
                    'show_count' => 1,
                    'hide_empty' => 1,
                    'echo' => 1,
                    'selected' => $cat_id_1,
                    'hierarchical' => 1,
                    'name' => esc_attr($this->get_field_name('cat_id_1')),
                    'id' => esc_attr($this->get_field_name('cat_id_1')),
                    'class' => 'widefat',
                    'taxonomy' => 'category',
                    'hide_if_empty' => false,
                );
                wp_dropdown_categories($grip_category_col_1_dropown_cat);
                ?>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('cat_id_2')); ?>">
                    <strong><?php esc_html_e('Select Second Category for Column Two', 'grip'); ?></strong>
                </label><br/>
                <?php
                $grip_category_col_2_dropown_cat = array(
                    'show_option_none' => esc_html__('Uncategorized', 'grip'),
                    'orderby' => 'name',
                    'order' => 'asc',
                    'show_count' => 1,
                    'hide_empty' => 1,
                    'echo' => 1,
                    'selected' => $cat_id_2,
                    'hierarchical' => 1,
                    'name' => esc_attr($this->get_field_name('cat_id_2')),
                    'id' => esc_attr($this->get_field_name('cat_id_2')),
                    'class' => 'widefat',
                    'taxonomy' => 'category',
                    'hide_if_empty' => false,
                );
                wp_dropdown_categories($grip_category_col_2_dropown_cat);
                ?>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('post_number')); ?>"><strong><?php esc_html_e('Number of Posts:', 'grip'); ?></strong></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('post_number')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('post_number')); ?>" type="number"
                       value="<?php echo $post_number; ?>" min="1"/>
            </p>

            <?php
        }
    }
}