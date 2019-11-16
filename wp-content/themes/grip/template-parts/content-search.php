<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package grip
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php grip_do_microdata('article'); ?>>
    <?php
    $grip_thumbnail = (has_post_thumbnail()) ? 'grip-has-thumbnail' : 'grip-no-thumbnail';
    ?>
    <div class="grip-content-container <?php echo $grip_thumbnail; ?>">
        <?php
        if (has_post_thumbnail()):
            grip_post_thumbnail();
        endif;
        ?>
        <div class="grip-content-area">
            <header class="entry-header">
                <?php
                if ('post' === get_post_type()) :
                    ?>
                    <div class="entry-meta">
                        <?php
                        grip_entry_category();
                        ?>
                    </div><!-- .entry-meta -->
                <?php endif;
                ?>
                <?php the_title(sprintf('<h2 class="entry-title" '.grip_get_microdata("heading").'><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

                <?php if ('post' === get_post_type()) : ?>
                    <div class="entry-meta">
                        <?php
                        grip_posted_on();
                        grip_posted_by();
                        ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
            </header><!-- .entry-header -->

            <div class="entry-summary">
                <?php
                $grip_show_content = 'excerpt';
                if ( $grip_show_content == 'excerpt' ) {
                    the_excerpt();
                } else {
                    the_content();
                }
                ?>
            </div><!-- .entry-summary -->

            <footer class="entry-footer">
                <?php grip_entry_footer(); ?>
            </footer><!-- .entry-footer -->
        </div> <!-- .grip-content-area -->
        <?php
        /**
         * grip_social_sharing hook
         * @since 1.0.0
         *
         * @hooked grip_constuct_social_sharing -  10
         */
        do_action( 'grip_social_sharing' ,get_the_ID() );
        ?>
    </div> <!-- .grip-content-container -->
</article><!-- #post-<?php the_ID(); ?> -->
