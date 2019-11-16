<?php
/**
 * Grip Featured Post Widget.
 *
 * @since 1.0.0
 */
if (!class_exists('Grip_Featured_Post')) :

    /**
     * Highlight Post widget class.
     *
     * @since 1.0.0
     */
    class Grip_Featured_Post extends WP_Widget
    {

        function __construct()
        {
            $opts = array(
                'classname' => 'grip-featured-post',
                'description' => esc_html__('Displays Featured Post in Home Page. Place it in Home Widget Area Top.', 'grip'),
            );

            parent::__construct('grip-featured-post', esc_html__('Grip Featured Post', 'grip'), $opts);
        }


        function widget($args, $instance)
        {
            $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
            echo $args['before_widget'];

            $cat_id = !empty($instance['cat']) ? $instance['cat'] : '';

            if (!empty($title)) {
                echo $args['before_title'];
                if(!empty($cat_id)){
                    ?>
                    <a href="<?php echo esc_url(get_category_link($cat_id)); ?>"> <?php echo esc_html($title); ?> </a>
                    <?php
                }else{
                    echo esc_html($title);
                }
                echo $args['after_title'];
            }

            $post_number = !empty($instance['post-number']) ? $instance['post-number'] : 5;

            $query_args = array(
                'post_type' => 'post',
                'cat' => absint($cat_id),
                'posts_per_page' => absint($post_number),
                'ignore_sticky_posts' => true
            );

            $query = new WP_Query($query_args);
            $count = $query->post_count;
            if ($query->have_posts()) :
                $i = 1;

                ?>
                <div class="ct-grid-post clear">
                    <?php
                    while ($query->have_posts()) :
                        $query->the_post();
                        ?>
                        <?php

                        if ($i == 1) {
                            ?>
                            <div class="ct-two-cols ct-first-column">
                                <section class="ct-grid-post-list">
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
                                    <div class="post-content">
                                        <h3 class="post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="post-meta">
                                            <?php grip_posted_on(); ?>
                                        </div>
                                        <div class="post-excerpt">
                                            <?php echo the_excerpt(); ?>
                                        </div>
                                    </div><!-- Post content end -->
                                </section>

                            </div>
                            <?php
                        } else {
                            if ($i == 2) {
                                ?>

                                <div class="ct-two-cols">

                                <div class="list-post-block">
                                <ul class="list-post">
                                <?php
                            }
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
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="post-content">
                                        <div class="featured-post-title">
                                            <h3 class="post-title"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h3>
                                            <?php
                                            ?>
                                            <div class="entry-meta">
                                                <?php grip_posted_on(); ?>
                                            </div><!-- .entry-meta -->
                                            <?php
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php
                            if ($i == $count) {
                                ?>
                                </ul>
                                </div> <!-- .list-post-block -->
                                </div> <!-- .ct-two-cols -->
                                <?php
                            }
                        }
                        ?>
                        <?php
                        $i++;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php
            endif;

            echo $args['after_widget'];

        }

        function update($new_instance, $old_instance)
        {
            $instance = $old_instance;

            $instance['title'] = sanitize_text_field($new_instance['title']);

            $instance['cat'] = absint($new_instance['cat']);

            $instance['post-number'] = absint($new_instance['post-number']);

            return $instance;

        }

        function form($instance)
        {

            // Defaults.
            $defaults = array(
                'cat' => 0,
                'title' => esc_html__('Recent Posts', 'grip'),
                'post-number' => 5,
            );

            $instance = wp_parse_args((array)$instance, array(
                'cat' => ''
            ));
            $instance = wp_parse_args((array)$instance, array(
                'title' => ''
            ));
            $instance = wp_parse_args((array)$instance, array(
                'post-number' => 5
            ));
            ?>
            <p>
                <label
                        for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'grip'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
                       value="<?php echo esc_attr($instance['title']); ?>"/>
            </p>
            <p class="custom-dropdown-posts">
                <label for="<?php echo esc_attr($this->get_field_name('cat')); ?>">
                    <strong><?php esc_html_e('Select Category: ', 'grip'); ?></strong>
                </label>
                <?php
                $cat_args = array(
                    'orderby' => 'name',
                    'hide_empty' => 0,
                    'id' => $this->get_field_id('cat'),
                    'name' => $this->get_field_name('cat'),
                    'class' => 'widefat',
                    'taxonomy' => 'category',
                    'selected' => absint($instance['cat']),
                    'show_option_all' => esc_html__('Show Recent Posts', 'grip')
                );
                wp_dropdown_categories($cat_args);
                ?>
            </p>

            <p>
                <label
                        for="<?php echo esc_attr($this->get_field_id('post-number')); ?>"><?php esc_html_e('Number of Posts to Display:', 'grip'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('post-number')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('post-number')); ?>" type="number"
                       value="<?php echo esc_attr($instance['post-number']); ?>"/>
            </p>

            <?php
        }
    }

endif;