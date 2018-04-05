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
    wpsr_update_average_rating($comment_id);
}

function wpsr_update_average_rating($comment_id) {
  $comment = get_comment($comment_id);
  $post_id = $comment->comment_post_ID;

  //get all ratings on post and calculate average
  $args = array(
    'post_id' => $post_id,
    'meta_query' => array(
      array(
        'key' => 'wpsr_rate'
      )
    )
  );

  $comments_with_ratings = get_comments($args);

  $count = 0;
  $sum = 0;

  foreach ($comments_with_ratings as $comment_with_rating) {
    $v = (int)get_comment_meta($comment_with_rating->comment_ID, 'wpsr_rate', true);
    if ($v > 0 && $v < 6) {
        $count = $count + 1;
        $sum = $sum + $v;
    }
  }
  $average = round($sum / $count, 1);
  if (!add_post_meta($post_id, 'wpsr_average_rating' , $average, true)) {
    update_post_meta($post_id, 'wpsr_average_rating' , $average);
  }
}

function wpsr_render_ratings($comment_text, $comment) {
    $rating = get_comment_meta($comment->comment_ID, 'wpsr_rate', true);

    //check for rating on comment and display stars
    if (isset($rating) && $rating !== '') {
      $stars = '';
      for ($i=0; $i < $rating; $i++) {
        $stars = $stars . '<span class="wpsr_rated"><svg xmlns="http://www.w3.org/2000/svg" width="255" height="240" viewBox="0 0 51 48"><title>Star</title><path fill="#F8D64E" stroke="#000" d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z"/></svg></span>';
      }
      return 'Rating: ' . $stars . '<br />' . $comment_text;
    }
    else {
      return $comment_text;
    }
}

// function wpsr_recipe_comments_template($comment_template) {
//   global $post;
//   return dirname(__FILE__) . '/recipe_comments.php';
// }

function wpsr_ratings_in_form() {
  echo '
    <span id="wpsr_rate_1" class="wpsr_rating">
      <svg xmlns="http://www.w3.org/2000/svg" width="255" height="240" viewBox="0 0 51 48">
      <title>1 Star</title>
      <path fill="none" stroke="#000" d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z"/>
      </svg>
    </span>
    <span id="wpsr_rate_2" class="wpsr_rating">
      <svg xmlns="http://www.w3.org/2000/svg" width="255" height="240" viewBox="0 0 51 48">
      <title>2 Stars</title>
      <path fill="none" stroke="#000" d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z"/>
      </svg>
    </span>
    <span id="wpsr_rate_3" class="wpsr_rating">
      <svg xmlns="http://www.w3.org/2000/svg" width="255" height="240" viewBox="0 0 51 48">
      <title>3 Stars</title>
      <path fill="none" stroke="#000" d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z"/>
      </svg>
    </span>
    <span id="wpsr_rate_4" class="wpsr_rating">
      <svg xmlns="http://www.w3.org/2000/svg" width="255" height="240" viewBox="0 0 51 48">
      <title>4 Stars</title>
      <path fill="none" stroke="#000" d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z"/>
      </svg>
    </span>
    <span id="wpsr_rate_5" class="wpsr_rating">
      <svg xmlns="http://www.w3.org/2000/svg" width="255" height="240" viewBox="0 0 51 48">
      <title>5 Stars</title>
      <path fill="none" stroke="#000" d="m25,1 6,17h18l-14,11 5,17-15-10-15,10 5-17-14-11h18z"/>
      </svg>
    </span>
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
