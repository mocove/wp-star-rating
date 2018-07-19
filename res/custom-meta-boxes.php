<?php
/*
custom boxes
*/

function wpsr_add_meta_box() {
  add_meta_box(
    '1',
    'Recipe meta data',
    'recipe_meta_box_html',
    'wpsr_recipe'
  );
}

function recipe_meta_box_html($post) {
  /*
    name
    image 1x1
    image 4x3
    image 16x9
    author.name
    datePublished
    description
    keywords
    aggregateRating.ratingValue
    aggregateRating.reviewCount
    prepTime
    cookTime
    totalTime
    recipeYield
    recipeCategory
    recipeCuisine
    nutrition.servingSize
    nutrition.calories
    nutrition.fatContent
    recipeIngredient []
    recipeInstructions
  */

  ?>
  <label for="wpsr_recipe_name">name</label>
  <input type="text" name="wpsr_recipe_name" id="wpsr_recipe_name" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_name', true); ?>" />
  <br />

  <label for="wpsr_recipe_image-1x1">image-1x1</label>
  <input type="text" name="wpsr_recipe_image-1x1" id="wpsr_recipe_image-1x1" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_image-1x1', true); ?>" />
  <br />

  <label for="wpsr_recipe_image-4x3">image-4x3</label>
  <input type="text" name="wpsr_recipe_image-4x3" id="wpsr_recipe_image-4x3" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_image-4x3', true); ?>" />
  <br />

  <label for="wpsr_recipe_image-16x9">image-16x9</label>
  <input type="text" name="wpsr_recipe_image-16x9" id="wpsr_recipe_image-16x9" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_image-16x9', true); ?>" />
  <br />

  <label for="wpsr_recipe_author-name">author.name</label>
  <input type="text" name="wpsr_recipe_author-name" id="wpsr_recipe_author-name" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_author-name', true); ?>" />
  <br />

  <label for="wpsr_recipe_datepublished">datePublished YYYY-MM-DD</label>
  <input type="text" name="wpsr_recipe_datepublished" id="wpsr_recipe_datepublished" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_datepublished', true); ?>" />
  <br />

  <label for="wpsr_recipe_description">description</label>
  <input type="text" name="wpsr_recipe_description" id="wpsr_recipe_description" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_description', true); ?>" />
  <br />

  <label for="wpsr_recipe_keywords">keywords. Input as comma-separated: key1, key2, key3</label>
  <input type="text" name="wpsr_recipe_keywords" id="wpsr_recipe_keywords" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_keywords', true); ?>" />
  <br />

  <label for="wpsr_recipe_aggregaterating-ratingvalue">aggregateRating.ratingValue</label>
  <input readonly type="text" name="wpsr_recipe_aggregaterating-ratingvalue" id="wpsr_recipe_aggregaterating-ratingvalue" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_aggregaterating-ratingvalue', true); ?>" />
  <br />

  <label for="wpsr_recipe_aggregaterating-reviewcount">aggregateRating.reviewCount</label>
  <input readonly type="text" name="wpsr_recipe_aggregaterating-reviewcount" id="wpsr_recipe_aggregaterating-reviewcount" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_aggregaterating-reviewcount', true); ?>" />
  <br />

  <label for="wpsr_recipe_preptime">prepTime</label>
  <input type="text" name="wpsr_recipe_preptime" id="wpsr_recipe_preptime" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_preptime', true); ?>" />
  <br />

  <label for="wpsr_recipe_cooktime">cookTime</label>
  <input type="text" name="wpsr_recipe_cooktime", id="wpsr_recipe_cooktime" value="<?php echo get_post_meta($post->ID, 'wpsr_cooktime', true); ?>" />
  <br />

  <label for="wpsr_recipe_totaltime">totalTime</label>
  <input type="text" name="wpsr_recipe_totaltime" id="wpsr_recipe_totaltime" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_totaltime', true); ?>" />
  <br />

  <label for="wpsr_recipe_recipeyield">recipeYield</label>
  <input type="text" name="wpsr_recipe_recipeyield" id="wpsr_recipe_recipeyield" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_recipeyield', true); ?>" />
  <br />

  <label for="wpsr_recipe_recipecategory">recipeCategory</label>
  <input type="text" name="wpsr_recipe_recipecategory" id="wpsr_recipe_recipecategory" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_recipecategory', true); ?>" />
  <br />

  <label for="wpsr_recipe_recipecuisine">recipeCuisine</label>
  <input type="text" name="wpsr_recipe_recipecuisine" id="wpsr_recipe_recipecuisine" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_recipecuisine', true); ?>" />
  <br />

  <label for="wpsr_recipe_nutrition-servingsize">nutrition.servingSize</label>
  <input type="text" name="wpsr_recipe_nutrition-servingsize" id="wpsr_recipe_nutrition-servingsize" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_nutrition-servingsize', true); ?>" />
  <br />

  <label for="wpsr_recipe_nutrition-calories">nutrition.calories</label>
  <input type="text" name="wpsr_recipe_nutrition-calories" id="wpsr_recipe_nutrition-calories" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_nutrition-calories', true); ?>" />
  <br />

  <label for="wpsr_recipe_nutrition-fatcontent">nutrition.fatContent</label>
  <input type="text" name="wpsr_recipe_nutrition-fatcontent" id="wpsr_recipe_nutrition-fatcontent" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_nutrition-fatcontent', true); ?>" />
  <br />

  <label for="wpsr_recipe_recipeingredient">recipeIngredient. Input as comma-separated: ing1, ing2, ing3</label>
  <input type="text" name="wpsr_recipe_recipeingredient" id="wpsr_recipe_recipeingredient" value="<?php echo get_post_meta($post->ID, 'wpsr_recipe_recipeingredient', true); ?>" />
  <br />

  <label for="wpsr_recipe_recipeinstructions">recipeInstructions. Include []. See <a target="_blank" href="https://developers.google.com/search/docs/data-types/recipe#recipe_properties">Recipe at Google</a></label>
  <textarea cols="80" name="wpsr_recipe_recipeinstructions" id="wpsr_recipe_recipeinstructions"><?php echo esc_textarea(get_post_meta($post->ID, 'wpsr_recipe_recipeinstructions', true)); ?></textarea>

  <?php
}

function wpsr_save_meta_box_data($post_id) {
  $metakeys = [
    "wpsr_recipe_name",
    "wpsr_recipe_image-1x1",
    "wpsr_recipe_image-4x3",
    "wpsr_recipe_image-16x9",
    "wpsr_recipe_author-name",
    "wpsr_recipe_datepublished",
    "wpsr_recipe_description",
    "wpsr_recipe_keywords",
    "wpsr_recipe_aggregaterating-ratingvalue",
    "wpsr_recipe_aggregaterating-reviewcount",
    "wpsr_recipe_recipeyield",
    "wpsr_recipe_recipecategory",
    "wpsr_recipe_recipecuisine",
    "wpsr_recipe_preptime",
    "wpsr_recipe_cooktime",
    "wpsr_recipe_totaltime",
    "wpsr_recipe_nutrition-servingsize",
    "wpsr_recipe_nutrition-calories",
    "wpsr_recipe_nutrition-fatcontent",
    "wpsr_recipe_recipeingredient",
    "wpsr_recipe_recipeinstructions"
  ];
  foreach ($metakeys as $key) {
    if(array_key_exists($key, $_POST)) {
      update_post_meta(
        $post_id,
        $key,
        $_POST[$key]
      );
    }
  }
}

add_action('add_meta_boxes', 'wpsr_add_meta_box');
add_action('save_post', 'wpsr_save_meta_box_data');

?>
