<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package grip
 */

?>
</div> <!-- .container-inner -->
</div><!-- #content -->
<?php

/**
 * grip_before_footer hook.
 *
 * @since 1.0.0
 *
 */
do_action('grip_before_footer');


/**
 * grip_header hook.
 *
 * @since 1.0.0
 *
 * @hooked grip_footer_start - 10
 * @hooked grip_footer_widget - 10
 * @hooked grip_footer_siteinfo - 10
 * @hooked grip_footer_end - 10
 */
do_action('grip_footer');
?>

<?php
/**
 * grip_construct_gototop hook
 *
 * @since 1.0.0
 *
 */
do_action('grip_gototop');

?>

<?php

/**
 * grip_after_footer hook.
 *
 * @since 1.0.0
 *
 */
do_action('grip_after_footer');
?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
