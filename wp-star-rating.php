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
    add_comment_meta($comment_id, 'wpsr_rate', $_POST['wpsr_rate'], true);
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

function wpsr_ratings_in_form() { // TODO: Virker ikke.
  echo '
    <img src="<?php echo plugins_url('/res/star.svg'); ?>" id="wpsr_rate_1" />
    <span id="wpsr_rate_2">2</span>
    <span id="wpsr_rate_3">3</span>
    <span id="wpsr_rate_4">4</span>
    <span id="wpsr_rate_5">5</span>
    <span id="wpsr_rate_clear">Clear rating</span>
    <input type="hidden" name="wpsr_rate" id="wpsr_rate" value="" />
    ';
}


add_action('comment_post', 'wpsr_comment_ratings');
add_filter('comment_text', 'wpsr_render_ratings', 10, 3);
//add_filter('comments_template', 'wpsr_recipe_comments_template');
add_action('comment_form_top', 'wpsr_ratings_in_form'); // displays rating in comment form
wp_enqueue_script('wpsr-script', plugins_url('main.js', __FILE__), array('jquery'));
wp_enqueue_style('wpsr-style', plugins_url('css/wpsr_main.css', __FILE__));

/*
Life-cycle hooks
*/

function wpsr_install() {
    //activation code
}

register_activation_hook(__FILE__, 'wpsr_install');
?>
