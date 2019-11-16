<?php

if ( ! function_exists( 'grip_load_widgets' ) ) :

    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function grip_load_widgets() {

        // Highlight Post.
        register_widget( 'Grip_Featured_Post' );

        // Author Widget.
        register_widget( 'Grip_Author_Widget' );
		
		// Social Widget.
        register_widget( 'Grip_Social_Widget' );

        // Post Slider Widget.
        register_widget( 'Grip_Post_Slider' );

        // Tabbed Widget.
        register_widget( 'Grip_Tabbed_Post' );

        // Category Column Widget.
        register_widget( 'Grip_Category_Column' );

        // Grid Layout Widget.
        register_widget( 'Grip_Grid_Post' );

        // Grid Advertisement Widget.
        register_widget( 'Grip_Advertisement_Widget' );

    }

endif;
add_action( 'widgets_init', 'grip_load_widgets' );


