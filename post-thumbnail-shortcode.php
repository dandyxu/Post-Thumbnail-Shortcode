<?php
/**
    Plugin Name: Post Thumbnail Shortcode
    Plugin URI: http://localhost/CyerBeta170404/
    Description: This plugin will provide a shortcode to display the thumbnail of the most recent post in What Matters for Students category
    Author: Dandy Xu
    Version: 2.1
    Author URI: https://github.com/dandyxu
 */

function post_thumbnail_shortcode($content = null){
    // Check if there is existing function called "post_thumbnail_shortcode"
    if(!function_exists('post_thumbnail_shortcode'))
        return;

    // The Query
        $the_query = new WP_Query( array( 'post_type' => 'what_student_matter') );

    // The Loop
        if ( $the_query->have_posts() ) {

            // Get Recent Post
            $args = array( 'numberposts' => '1', 'post_type' => 'what_student_matter' );
            $recent_posts = wp_get_recent_posts( $args );

            //echo '<ul>';
            foreach( $recent_posts as $recent ){
                //echo '<li><a href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"].'</a> </li> ';
                $content = $recent["post_content"];
            }

            //while ( $the_query->have_posts() ) {
            //    $the_query->the_post();
            //    echo '<li>' . get_the_title() . '</li>';
            //}
            //echo '</ul>';
            /* Restore original Post Data */
            wp_reset_postdata();

        } else {
            // no posts found
        }

        return $content;
}

add_shortcode('post-thumbnail', 'post_thumbnail_shortcode');