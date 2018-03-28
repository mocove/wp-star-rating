<?php
/*
Plugin Name: wp-star-rating
Plugin URI: https://martinove.dk
Description: WordPress star rating plugin.
Version 0.0.1
Author: Martin Ove Christensen
Author URI: https://martinove.dk
*/

function wpsr_hello_world() {
    echo "Hello World.";
}

function wpsr_comment_ratings($comment_id) {
    add_comment_meta($comment_id, 'wpsr_rate', 'test', true);
}

function wpsr_render_ratings($comment_text, $comment) {
    $rating = get_comment_meta($comment->comment_ID, 'wpsr_rate', true);
    return $rating;
}

add_action('comment_post', 'wpsr_comment_ratings');
add_filter('comment_text', 'wpsr_render_ratings', 10, 3);

/*
Life-cycle hooks
*/

function wpsr_install() {
    //activation code
}

register_activation_hook(__FILE__, 'wpsr_install');
?>