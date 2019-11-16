<?php
/**
 * Template part for displaying page content in page.php
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
            the_post_thumbnail();
        endif;
        ?>
        <div class="grip-content-area">
            <header class="entry-header">
                <?php the_title('<h1 class="entry-title" '.grip_get_microdata("heading").'>', '</h1>'); ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php
                the_content();

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'grip'),
                    'after' => '</div>',
                ));
                ?>
            </div><!-- .entry-content -->

            <?php if (get_edit_post_link()) : ?>
                <footer class="entry-footer">
                    <?php
                    edit_post_link(
                        sprintf(
                            wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                                __('Edit <span class="screen-reader-text">%s</span>', 'grip'),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            get_the_title()
                        ),
                        '<span class="edit-link">',
                        '</span>'
                    );
                    ?>
                </footer><!-- .entry-footer -->
            <?php endif; ?>
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
