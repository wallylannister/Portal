<?php
/**
 * Grip Post Slider Widget
 *
 * @since 1.0.0
 */
if (!class_exists('Grip_Post_Slider')) :

    /**
     * Highlight Post widget class.
     *
     * @since 1.0.0
     */
    class Grip_Post_Slider extends WP_Widget
    {

        function __construct()
        {
            $opts = array(
                'classname' => 'grip-post-slider',
                'description' => esc_html__('Display post in Slider Form. Suitable on Sidebars.', 'grip'),
            );

            parent::__construct('grip-post-slider', esc_html__('Grip Post Slider', 'grip'), $opts);
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


            $post_number = !empty($instance['post-number']) ? $instance['post-number'] : '';

            $query_args = array(
                'post_type' => 'post',
                'cat' => absint($cat_id),
                'posts_per_page' => absint($post_number),
                'ignore_sticky_posts' => true
            );

            $query = new WP_Query($query_args); ?>
            
            <div class="grip-slider-container">
                <section class="section-slider">
                    <div class="header-carousel">
                        <ul class="ct-post-carousel slider">
                            <?php
                            while ($query->have_posts()) : $query->the_post();
                                $carousel_block_class = has_post_thumbnail() ? 'carousel-thumbnail-block' : '';
                                ?>
                                <li>
                                    <div class="ct-carousel-inner <?php echo $carousel_block_class; ?>">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('grip-carousel-img');
                                            }
                                            ?>
                                        </a>

                                        <div class="slide-details">
                                            <div class="slider-content-inner">
                                                <div class="slider-content">
                                                    <h2>
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h2>
                                                    <span class="entry-meta">
                                                        <?php echo get_the_date(); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- .ct-carousel-inner -->
                                    <div class="overly"></div>
                                </li>
                            <?php endwhile;
                            wp_reset_postdata(); ?>
                        </ul>
                    </div> <!-- .header-carousel  -->
                </section> <!-- .section-slider -->
            </div><!-- .grip-slider-container -->
            <?php         
            echo $args['after_widget']; ?>            
            <?php 
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
                'title' => esc_html__('Recent Posts', 'grip' ),
                'post-number' => 5,
            );
            
            $instance = wp_parse_args((array)$instance, $defaults);
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