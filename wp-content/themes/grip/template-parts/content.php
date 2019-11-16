<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package grip
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php grip_do_microdata('article'); ?>>
    <?php
    global $grip_theme_options;
    $grip_show_image = $grip_theme_options['grip-single-page-featured-image'];
    $grip_show_content = $grip_theme_options['grip-content-show-from'];
    $grip_thumbnail = (has_post_thumbnail() && ($grip_show_image == 1)) ? 'grip-has-thumbnail' : 'grip-no-thumbnail';
    ?>
    <div class="grip-content-container <?php echo $grip_thumbnail; ?>">
        <?php
        if ($grip_thumbnail == 'grip-has-thumbnail'):
            grip_post_thumbnail();
        endif;
        ?>
        <div class="grip-content-area">
            <header class="entry-header">
                <?php

                if (is_singular()) :
                    the_title('<h1 class="entry-title" '.grip_get_microdata("heading").'>', '</h1>');
                else :
                    the_title('<h2 class="entry-title" '.grip_get_microdata("heading").'><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                endif;

                if ('post' === get_post_type()) :
                    ?>
                    <div class="entry-meta">
                        <?php

                        grip_entry_category();
                        grip_posted_on();
                        grip_posted_by();
                        ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php
                if (is_singular()) :
                    the_content();
                else :
                    if ( $grip_show_content == 'excerpt' ) {
                        the_excerpt();
                    } else {
                        the_content();
                    }
                endif;

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'grip'),
                    'after' => '</div>',
                ));
                ?>

                <?php
                $grip_read_more_text =  $grip_theme_options['grip-read-more-text'];
                if ( ( !is_single() ) && ( $grip_show_content == 'excerpt' ) ) {
                    if(!empty($grip_read_more_text)){                ?>
                        <p><a href="<?php the_permalink(); ?>" class="read-more-text">
                            <?php echo esc_html( $grip_read_more_text ); ?>

                        </a></p>
                        <?php
                    }
                }
                ?>
            </div>
            <!-- .entry-content -->

            <footer class="entry-footer">
                <?php grip_entry_footer(); ?>
            </footer><!-- .entry-footer -->

            <?php
            /**
             * grip_social_sharing hook
             * @since 1.0.0
             *
             * @hooked grip_constuct_social_sharing -  10
             */
            do_action( 'grip_social_sharing' ,get_the_ID() );
            ?>
        </div> <!-- .grip-content-area -->
    </div> <!-- .grip-content-container -->
</article><!-- #post-<?php the_ID(); ?> -->
