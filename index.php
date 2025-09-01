<?php
/*
Plugin Name: Simple Testimonials
Description: Adds a Testimonials custom post type and [testimonials] shortcode.
Version: 1.0
Author: Your Name
*/

if ( ! defined( 'ABSPATH' ) ) exit;

// Register Custom Post Type
function st_register_testimonials() {
    register_post_type( 'testimonial', array(
        'labels' => array(
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial'
        ),
        'public' => true,
        'supports' => array('title', 'editor')
    ));
}
add_action( 'init', 'st_register_testimonials' );

// Shortcode
function st_display_testimonials() {
    $args = array( 'post_type' => 'testimonial', 'posts_per_page' => 5 );
    $query = new WP_Query( $args );
    $output = '<div class="testimonials">';
    while ( $query->have_posts() ) {
        $query->the_post();
        $output .= '<div class="testimonial"><h3>'.get_the_title().'</h3><p>'.get_the_content().'</p></div>';
    }
    $output .= '</div>';
    wp_reset_postdata();
    return $output;
}
add_shortcode( 'testimonials', 'st_display_testimonials' );
