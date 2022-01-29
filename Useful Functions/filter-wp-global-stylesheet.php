<?php
/**
 * Reference URL
 * @url https://github.com/WordPress/gutenberg/issues/38252#issuecomment-1024348024
 *
 * WordPress Issue URL
 * @url https://github.com/WordPress/gutenberg/issues/38252
 */

/**
 * Lowering specificity of WordPress global styles.
 */
add_action( 'init', function() {

    // WP5.9+ only.
    if ( ! function_exists( 'wp_get_global_stylesheet' ) ) {
        return;
    }

    // Dequeue original WP global styles.
    remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );

    // Enqueue WP global styles early.
    add_action( 'wp_enqueue_scripts', function() {

        // Lower CSS code specificity.
        $stylesheet = str_replace( [ 'body', '!important' ], [ ':root', '' ], wp_get_global_stylesheet() );

        if ( empty( $stylesheet ) ) {
            return;
        }

        wp_register_style( 'wp-global-styles', false );
        wp_add_inline_style( 'wp-global-styles', $stylesheet );
        wp_enqueue_style( 'wp-global-styles' );
    }, 0 );
} );