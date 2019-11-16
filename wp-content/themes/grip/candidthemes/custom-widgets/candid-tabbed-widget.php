<?php
/**
 * Grip Post Tabbed Widget
 *
 * @since 1.0.0
 */
if (!class_exists('Grip_Tabbed_Post')) :

    /**
     * Highlight Post widget class.
     *
     * @since 1.0.0
     */
    class Grip_Tabbed_Post extends WP_Widget
    {

        function __construct()
        {
            $opts = array(
                'classname' => 'grip-tabbed',
                'description' => esc_html__('Tabbed Widget for multiple content.', 'grip'),
            );
            parent::__construct('grip-tabbed', esc_html__('Grip Tabbed', 'grip'), $opts);
        }

        function widget($args, $instance)
        {
            $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
            echo $args['before_widget'];


            if (!empty($title)) {
                echo $args['before_title'] . esc_html($title) . $args['after_title'];
            }
            $popular_title = !empty($instance['popular_title']) ? $instance['popular_title'] : '';
            $recent_title = !empty($instance['recent_title']) ? $instance['recent_title'] : '';
            $post_number = !empty($instance['post-number']) ? $instance['post-number'] : '';

            ?>
            <div class="ct-tabs">

                <ul class="nav nav-tabs ct-nav-tabs">
                    <?php if (!empty($popular_title)) { ?>
                        <li class="ct-title-head ct-rotate active"><a data-toggle="tab"
                          href="#home"><?php esc_html_e($popular_title); ?></a>
                      </li>
                  <?php } ?>
                  <?php if (!empty($recent_title)) { ?>
                    <li class="ct-title-head ct-rotate"><a data-toggle="tab"
                     href="#menu1"><?php esc_html_e($recent_title); ?></a>
                 </li>
             <?php } ?>
         </ul>

         <div class="tab-content">
            <?php if (!empty($popular_title)) { ?>
                <div id="home" class="tab-pane fade in active">
                    <section class="featured-posts-block">
                        <?php
                        $p_query_args = array(
                            'post_type' => 'post',
                            'posts_per_page' => absint($post_number),
                            'ignore_sticky_posts' => true,
                            'orderby' => 'comment_count'
                        );
                        $p_query = new WP_Query($p_query_args);
                        if ($p_query->have_posts()) :
                            ?>
                            <div class="list-post-block">
                                <ul class="list-post">
                                    <?php
                                    while ($p_query->have_posts()):
                                        $p_query->the_post();
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

                                    <?php endwhile;
                                    wp_reset_postdata(); ?>

                                </ul><!-- List post end -->
                            </div><!-- List post block end -->
                            <?php
                        endif;
                        ?>
                    </section>
                </div>
            <?php } ?>
            <?php if (!empty($recent_title)) { ?>
                <div id="menu1" class="tab-pane fade">
                    <section class="featured-posts-block">
                        <?php
                        $query_args = array(
                            'post_type' => 'post',
                            'posts_per_page' => absint($post_number),
                            'ignore_sticky_posts' => true
                        );
                        $query = new WP_Query($query_args);
                        if ($query->have_posts()) :
                            ?>
                            <div class="list-post-block">
                                <ul class="list-post">
                                    <?php
                                    while ($query->have_posts()):
                                        $query->the_post();
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

                                    <?php endwhile;
                                    wp_reset_postdata(); ?>

                                </ul><!-- List post end -->
                            </div><!-- List post block end -->
                            <?php

                        endif;
                        ?>
                    </section>
                </div>
            <?php } ?>
        </div>
    </div> <!-- .ct-tabs -->

    <?php
    echo $args['after_widget'];
}

function update($new_instance, $old_instance)
{
    $instance = $old_instance;

    $instance['title'] = sanitize_text_field($new_instance['title']);
    $instance['popular_title'] = sanitize_text_field($new_instance['popular_title']);
    $instance['recent_title'] = sanitize_text_field($new_instance['recent_title']);
    $instance['post-number'] = absint($new_instance['post-number']);

    return $instance;
}

function form($instance)
{
            // Defaults.
    $defaults = array(
        'title' => esc_html__('Recent Posts', 'grip'),
        'popular_title' => esc_html__('Popular Posts', 'grip'),
        'recent_title' => esc_html__('Recent Posts', 'grip'),
        'post-number' => 5,
    );

    $instance = wp_parse_args((array)$instance, $defaults);
    ?>
    <p>
        <label
        for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Widget Title:', 'grip'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
        name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
        value="<?php echo esc_attr($instance['title']); ?>"/>
    </p>
    <p>
        <label
        for="<?php echo esc_attr($this->get_field_id('popular_title')); ?>"><?php esc_html_e('Popular Title:', 'grip'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('popular_title')); ?>"
        name="<?php echo esc_attr($this->get_field_name('popular_title')); ?>" type="text"
        value="<?php echo esc_attr($instance['popular_title']); ?>"/>
    </p>
    <p>
        <label
        for="<?php echo esc_attr($this->get_field_id('recent_title')); ?>"><?php esc_html_e('Recent Title:', 'grip'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('recent_title')); ?>"
        name="<?php echo esc_attr($this->get_field_name('recent_title')); ?>" type="text"
        value="<?php echo esc_attr($instance['recent_title']); ?>"/>
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