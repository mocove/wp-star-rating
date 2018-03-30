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

    //check for rating on comment
    if (isset($rating) && $rating !== '' ) {
      return 'Rating: ' . $rating . '<br / />' . $comment_text;
    }
    else {
      return $comment_text;
    }
}

// function wpsr_recipe_comments_template($comment_template) {
//   global $post;
//   return dirname(__FILE__) . '/recipe_comments.php';
// }

function wpsr_ratings_in_form($fields) {
  $fields['wpsr_rating'] = '';
  return $fields;
}

add_action('comment_post', 'wpsr_comment_ratings');
add_filter('comment_text', 'wpsr_render_ratings', 10, 3);
//add_filter('comments_template', 'wpsr_recipe_comments_template');
add_filter('comment_form_default_fields', 'wpsr_ratings_in_form'); // displays rating in comment form
wp_enqueue_script('wpsr-script', plugins_url('main.js', __FILE__), array('jquery'));

/*
Life-cycle hooks
*/

function wpsr_install() {
    //activation code
}

register_activation_hook(__FILE__, 'wpsr_install');
?>
