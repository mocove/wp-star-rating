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
    if ( 'wpsr_recipe' == get_post_type($post_id) ) {

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
      if (!add_post_meta($post_id, 'wpsr_number_of_ratings' , $count, true)) {
        update_post_meta($post_id, 'wpsr_number_of_ratings' , $count);
      }
      if (!add_post_meta($post_id, 'wpsr_average_rating' , $average, true)) {
        update_post_meta($post_id, 'wpsr_average_rating' , $average);
      }
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

function wpsr_render_average_rating($content) {
  $post_id = get_the_ID();
  $average = get_post_meta($post_id, 'wpsr_average_rating', true);
  $count = get_post_meta($post_id, 'wpsr_number_of_ratings', true);
  return 'Rating: ' . $average . ' (' . $count . ' ratings)<br />' . $content;
}

function wpsr_get_ratings_count() {
  $post_id = get_the_ID();
  $count = get_post_meta($post_id, 'wpsr_number_of_ratings', true);
  return $count;
}

function wpsr_get_average_count() {
  $post_id = get_the_ID();
  $average = get_post_meta($post_id, 'wpsr_average_rating', true);
  return $average;
}

function wpsr_ratings_in_form() {
  /* For checking for nesting at some point. Does not work, comment_parent is always 0. */
  /*
  $comment_id = get_comment_ID();
  $comment = get_comment($comment_id);
  $comment_has_parent = false;
  if ('0' != $comment->comment_parent) {
    $comment_has_parent = true;
  }
  */
  if ( 'wpsr_recipe' == get_post_type() ) {
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
}

function wpsr_register_custom_post_type() {
  register_post_type(
    'wpsr_recipe',
    array(
      'labels' => array(
        'name' => __('Recipes'),
        'singular_name' => __('Recipe')
      ),
      'supports' => array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'trackbacks',
        'comments',
        'custom-fields',
        'revisions'
      ),
      'public' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'recipe')
    )
  );
}

function wpsr_add_custom_post_type($query) {
  if(is_home() && $query->is_main_query()) {
    $query->set('post_type', array('post', 'wpsr_recipe'));
  }
  return $query;
}

function wpsr_get_custom_type_recipe_template($single_template) {
  global $post;

  if ($post->post_type == 'wpsr_recipe') {
    $single_template = dirname(__FILE__) . '/res/template/single-recipe.php';
  }
  return $single_template;
}

function wpsr_shortcodes_init() {
  function wpsr_get_ratings_count_on_recipe_shortcode($count = null) {
    $count = wpsr_get_ratings_count();
    return $count;
  }

  function wpsr_get_average_rating_on_recipe_shortcode($average = null, $count = null) {
    $average = wpsr_get_average_count();
    return $average;
  }

  add_shortcode('wpsr_get_ratings_count_on_recipe', 'wpsr_get_ratings_count_on_recipe_shortcode' );
  add_shortcode('wpsr_get_average_rating_on_recipe', 'wpsr_get_average_rating_on_recipe_shortcode' );
}

function wpsr_add_recipe_schema($content) {
  if (get_post_type() === 'wpsr_recipe' && in_the_loop() && is_main_query()) {
    $id = get_the_ID();

    /* parse ingredients */
    $recipe_string = get_post_meta($id, 'wpsr_recipe_recipeingredient', true);
    $recipe_array = explode(",", $recipe_string );
    $recipe_ingredients = "";
    foreach ($recipe_array as $ing) {
      $recipe_ingredients = $recipe_ingredients . '"' . $ing . '",';
    }
    $recipe_ingredients = rtrim($recipe_ingredients, ',');

    $schema =
    '<script type="application/ld+json">
      {
        "@context": "http://schema.org",
        "@type": "Recipe",
        "name": "' . get_post_meta($id, 'wpsr_recipe_name', true) . '",
        "image": [
          "' . get_post_meta($id, 'wpsr_recipe_image-1x1', true) . '",
          "' . get_post_meta($id, 'wpsr_recipe_image-4x3', true) . '",
          "' . get_post_meta($id, 'wpsr_recipe_image-16x9', true) . '"
        ],
        "author": {
          "@type": "Person",
          "name": "' . get_post_meta($id, 'wpsr_recipe_author-name', true) . '"
        },
        "datePublished": "' . get_post_meta($id, 'wpsr_recipe_datepublished', true) . '",
        "description": "' . get_post_meta($id, 'wpsr_recipe_description', true) . '",
        "aggregateRating": {
          "@type": "AggregateRating",
          "ratingValue": "' . wpsr_get_average_count() . '",
          "reviewCount": "' . wpsr_get_ratings_count() . '"
        },
        "prepTime": "' . get_post_meta($id, 'wpsr_recipe_preptime', true) . '",
        "totalTime": "' . get_post_meta($id, 'wpsr_recipe_totaltime', true) . '",
        "recipeYield": "' . get_post_meta($id, 'wpsr_recipe_recipeyield', true) . '",
        "nutrition": {
          "@type": "NutritionInformation",
          "servingSize": "' . get_post_meta($id, 'wpsr_recipe_nutrition-servingsize', true) . '",
          "calories": "' . get_post_meta($id, 'wpsr_recipe_nutrition-calories', true) . '",
          "fatContent": "' . get_post_meta($id, 'wpsr_recipe_nutrition-fatcontent', true) . '"
        },
        "recipeIngredient": [
          /* TODO */
          ' . $recipe_ingredients . '
        ],
        "recipeInstructions": "' . get_post_meta($id, 'wpsr_recipe_recipeinstructions', true) . '"
      }

    </script>';

    $content = $content . $schema;
    return $content;
  }
}

require plugin_dir_path(__FILE__) . 'res/custom-meta-boxes.php';

/*
actions and filter registrations
*/

add_action('init', 'wpsr_register_custom_post_type');
add_filter('pre_get_posts', 'wpsr_add_custom_post_type');
add_filter('single_template', 'wpsr_get_custom_type_recipe_template');
add_filter('the_content', 'wpsr_add_recipe_schema');
add_action('comment_post', 'wpsr_comment_ratings');
add_filter('comment_text', 'wpsr_render_ratings', 10, 3);
//add_filter('comments_template', 'wpsr_recipe_comments_template');
add_action('comment_form_top', 'wpsr_ratings_in_form'); // displays rating in comment form
add_filter('the_content', 'wpsr_render_average_rating');
add_action('init', 'wpsr_shortcodes_init');
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
