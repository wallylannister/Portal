<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package grip
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
        /**
         * grip_before_main_content hook.
         *
         * @since 0.1
         */
        do_action( 'grip_before_main_content' );

        /**
         * grip_breadcrumb hook.
         *
         * @since 1.0
         * @hooked grip_construct_breadcrumb -  10
         *
         */
        do_action( 'grip_breadcrumb' );

		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation();

            /**
             * grip_after_single_post_navigation hook
             * @since Grip 1.0.0
             *
             */
            do_action( 'grip_after_single_post_navigation' );


            /**
             * grip_related_posts hook
             * @since Grip 1.0.0
             *
             * @hooked grip_related_posts -  10
             */
            do_action( 'grip_related_posts' ,get_the_ID() );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.

        /**
         * grip_after_main_content hook.
         *
         * @since 0.1
         */
        do_action( 'grip_after_main_content' );
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
/**
 * grip_sidebar hook
 * @since Grip 1.0.0
 *
 * @hooked grip_sidebar -  10
 */
do_action( 'grip_sidebar');

get_footer();
